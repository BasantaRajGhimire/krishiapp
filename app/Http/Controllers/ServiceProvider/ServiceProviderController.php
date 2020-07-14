<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use App\ServiceProvider\BidedPost;
use App\ServiceProvider\NewBidPost;
use App\ServiceProvider\Profile;
use App\ServiceProvider\ServiceProviderBidPost;
use App\ServiceProvider\User;
use App\ServiceProvider\ServiceProviderWinClientPost;
use App\ServiceProvider\EscrowSystemServiceProviderPhaseWisePayment;
use App\Admin\EscrowSystemServiceProviderGetPaymentDetails;
use App\Admin\EscrowSystemClientCancelServiceProviderPaymentRequest;
use App\ServiceProvider\WinPostDetails;
use App\Mails\ApprovedAwardedBidMail;
use App\Buyer\ClientUsers;
use App\Buyer\ClientPost;
use Carbon\Carbon;
use DB;
use PDF;
use Hash;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServiceProviderController extends Controller
{
    protected $posts;
    protected $user;
    protected $bidedPost;
    protected $winPost;

    public function __construct(NewBidPost $posts, User $user, BidedPost $bidedPost, WinPostDetails $winPost)
    {
        //$this->middleware('loggedinseller');
        $this->bidedPost = $bidedPost;
        $this->posts = $posts;
        $this->user = $user;
        $this->winPost = $winPost;
    }

    public function newBidIndex(User $user)
    {
        $users = User::with('UserPenalty')->find(session('suserid'))->toArray();
        // return response()->json($users);
        if($users['user_penalty']== null || $users['user_penalty']['expired_at'] < now()){
            $posts = $this->posts->getNewBid();
            // return $posts;
            return view('service_provider.new_bid')->with('posts', $posts);
        }else{
            // return 'ok';
            return view('service_provider.new_bid')->with('err','Sorry You have been block for bidding new post upto '.Carbon::parse($users['user_penalty']['expired_at'])->format('d M').' because you donot have response for bided post within 2 days of expiry');
        }
    }

    public function singlePost($postid, Request $r)
    {
        if(isset($r->status)){
            DB::table('support_messages')->where('id', $r->status)->update(['read_at' => now()]);
        }
        $valid = ServiceProviderBidPost::where('service_provider_id', session('suserid'))->where('post_id', $postid)->where('bid_amount', '>', 0)->first();
        if (!empty($valid)) {
            $post['post'] = $this->bidedPost->getBidedPost($postid);
            if ($valid->status == '3' || $valid->status == '4') {
                $post['win'] = DB::table('serviceprovider_win_clientpost')->where('post_id', $postid)->where('service_provider_id', session('suserid'))->first();
                $escrowSystem = EscrowSystemServiceProviderPhaseWisePayment::where('post_id', $postid)->get();
                if(!empty($escrowSystem)){
                    $post['escrow_system']  = $escrowSystem;
                    $post['payment_info'] = EscrowSystemServiceProviderGetPaymentDetails::where('post_id', $postid)->get();
                    foreach($escrowSystem as $v){
                        if($v->is_approved == '2'){
                            $requestReject = EscrowSystemClientCancelServiceProviderPaymentRequest::where('espid', $v->id)->where('post_id', $v->post_id)->where('phase', $v->phase)->whereNull('serviceprovider_comment')->first();
                            $post['request_cancel'] = $requestReject;
                        }
                    }
                }
            }
            // return $post;
            return view('service_provider.single_post')->with('data', $post);
        } else {
            return view('service_provider.single_post')->with('err', 'Invalid Token');
        }
    }

    public function requestForAmount(Request $r){
        $postid = $r->post_id;
        $pendingCheck = EscrowSystemServiceProviderPhaseWisePayment::where('post_id', $postid)->where('status', 'Pending')->first();

        if(!empty($pendingCheck)){
            $model = EscrowSystemServiceProviderPhaseWisePayment::find($pendingCheck->id);
            $model->status = 'Request';
            DB::beginTransaction();
            try{
                $model->save();
                $winPost = ServiceProviderWinClientPost::where('post_id', $model->post_id)->first();
                $user = ClientUsers::find($winPost->client_id);
                $row = [
                    'user_id' => $winPost->client_id,
                    'user_table' => 'C',
                    'title' => 'Your service provider has requested payment',
                    'type' => 'Request Phase Payment ',
                    'url' => 'client-post/'.$postid.'?post_token='.$user->remember_token,
                ];
                DB::table('support_messages')->insert($row);
                DB::commit();
                return response()->json($this->successMessage());
            }catch(\Exception $e){
                DB::rollback();
                return response()->json($this->errorMessage('Server Error , Try Again !!'), 500);
            }

        }else{
            return response()->json($this->errorMessage('Your payment request has been already completed.'), 500);
        }
    }
    public function clientDetailsForWinPost(Request $r, $winid){       
        $model = ServiceProviderWinClientPost::find($winid);
        if($model->status==1 && $model->service_provider_id == session('suserid')){
            $clientPost = ClientPost::find($model->post_id);
            $post['post'] = $this->bidedPost->getBidedPost($model->post_id);
            $post['client_details'] = DB::table('client_users')->select('name','email','mobile')->where('id',$model->client_id)->first();
            $post['client_details']->district = \App\District::find($clientPost->district)->district_name;
            $post['client_details']->address = $clientPost->address;
            $post['client_details']->post_id = $clientPost->id;
            // $post['client_details']->post_description = $clientPost->description;
            $post['client_details']->order_date = Carbon::parse($clientPost->created_at)->format('d M');
            if(isset($r->status)){
                $pdf = PDF::loadView('service_provider.pdf.client-details', array('data' =>$post));
                return $pdf->download('document.pdf');
            }
            $post['winid'] = $winid;
            return view('service_provider.client-details')->with('data', $post);
        }else{
            return back()->with('err', 'Sorry Invalid Token');
        }

    }
    public function payForWinDetails($winid, ApprovedAwardedBidMail $mail){
        $model = ServiceProviderWinClientPost::find($winid);
        $user = ClientUsers::find($model->client_id);

        if($model->service_provider_id == session('suserid')){
            DB::beginTransaction();
            try{
                $model->status = 1;
                $model->save();
                $clientPost = clientPost::find($model->post_id);
                $clientPost->status = 5;
                $clientPost->save();
                $bidPost = ServiceProviderBidPost::find($model->bid_id);
                $bidPost->status = 4;
                $bidPost->save();
                $messages = [
                        [
                            'user_id' => $model->client_id,
                            'user_table' => 'C',
                            'type' => 'Approved Awarded Bid',
                            'title' => 'Your awarded bid has been approved.See more...',
                            'url' => 'client-post/'.$model->post_id.'?post_token='.$user->remember_token
                        ],
                        [
                            'user_id' => $model->service_provider_id,
                            'user_table' => 'V',
                            'type' => 'Paid Rewarded Bid Post',
                            'title' => 'Click here to view client details',
                            'url' => 'post/'.$model->post_id
                        ]
                    ];
                DB::table('support_messages')->insert($messages);
                $mail->sendApprovedAwardEMail($user, $model->post_id);
                DB::commit();
                return back()->with('msg', 'Your Paymwnt has been successfully cleared. You may now view a client details.');
            }catch(\Exception $e){
                return back()->with('err','Server Error try again later.');
            }
        }else{
            return back()->with('err','Sorry Invalid Token');
        }
    }
    public function loginVendorWithEmailVerification(Request $r){
        $email = $r->input('email');
        $auth = new User();
        Session::forget('logged_in_seller');
        Session::forget('suserid');
        $status = $auth->loginwithEmailVerification($email);
        if($status === true){
            return redirect('/service-provider');
        }else if($status == -2){            
            return response()->json('Your registration has not been activated yet by admin. Or, contact to our admin');
        }else if($status == -3){
            return response()->json('Your registration for service provider has been rejected. So, please contact admin section');
        }else{
            return redirect('/service-provider/auth')->with('err', 'Email verification token mismatched!! Contact Customer Care.');
        }
    }

    public function profile()
    {
        $posts = $this->bidedPost->getBidedPost();
        //return response()->json($posts);
        return view('service_provider.auth.profile')->with('posts', $posts);
    }

    public function getProfile($type)
    {
        $user = User::findorfail(Session('suserid'));
        $items = $user->profiles()->where('type', $type)->get();
        $html = view('service_provider.partials.add_table', compact('items'))->render();
        return response()->json([
            'success' => true,
            'html' => $html,
        ]);
    }

    public function addProfile(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'name' => 'required|between:2,100',
            'number' => 'required|numeric|max:99'
        ]);
        $user = User::findorfail(Session('suserid'));

        // raise profile progress
        $progress = false;
        if (count($user->profiles()->where('type', $request->type)->get()) == 0) {
            $user->profile_progress += config('constants.percentage_to_raise_per_profile_component');
            $user->save();
            $progress = true;
        }

        $profile = new Profile;
        $profile->service_provider_id = $user->id;
        $profile->name = $request->name;
        $profile->number = $request->number;
        $profile->type = $request->type;
        $profile->save();

        $items = $user->profiles()->where('type', $request->type)->get();

        $html = view('service_provider.partials.add_table', compact('items'))->render();

        if ($profile->save()) {
            return response()->json([
                'success' => true,
                'progress' => $progress,
                'message' => 'Added Successfully.',
                'html' => $html,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ]);
        }
    }

    public function deleteProfile($id)
    {
        $profile = Profile::findorfail($id);
        $type = $profile->type;
        $deduce = false;

        if ($profile->delete()) {
            // decrease profile progress
            $user = User::findorfail(Session('suserid'));
            if (count($user->profiles()->where('type', $type)->get()) == 0) {
                $user->profile_progress -= config('constants.percentage_to_raise_per_profile_component');
                $user->save();
                $deduce = true;
            }
            return response()->json([
                'success' => true,
                'deduce' => $deduce,
                'message' => 'Deleted Successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ]);
        }
    }


    public function timeline()
    {
        $posts = $this->bidedPost->getBidedPost();
        return view('service_provider.timeline')->with('posts', $posts);
    }

    public function storeBidAmount(Request $r)
    {
        $user = $this->user->getUser();
        $model = new ServiceProviderBidPost();
        if ($model->validate($r->all())) {
            $model = $model->where('post_id', $r->post_id)
                           ->where('service_provider_id', $user->id)
                           ->update([
                                'status' => 1,
                                'bid_amount' => $r->bid_amount, 
                                'comment_on_bid' => $r->comment_on_bid
                            ]);
            if ($model) {
                return response()->json('ok');
            } else {
                return response()->json('error', 500);
            }
        } else {
            return response()->json($model->errors, 500);
        }
    }

    public function commentOnPaymentRequestCancel(Request $r){
        // return $r->all();
        $validation = Validator::make($r->all(),[
            'serviceprovider_comment' => 'required|string',
        ]);
        if($validation->fails()){
            // return $validation->errors();
            return redirect()->back()->with('validation','please provider your comment');
        }else{
            $check = EscrowSystemClientCancelServiceProviderPaymentRequest::find($r->comment_id);
            // return $check;
            if(!empty($check) && ($check->espid == $r->phaseid) && ($check->phase == $r->phase)){
                $check->serviceprovider_comment = $r->serviceprovider_comment;
                $check->save();
                return redirect()->back()->with('msg','Your comment has been send successfully.');
            }
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $rules = [
            'email' => 'sometimes|required|email|unique:service_provider_users,email',
            'phone_number' => 'sometimes|required|numeric|max:9999999999'
        ];

        $customMessages = [
            'phone_number.max' => 'Please enter a valid phone number.'
        ];

        $this->validate($request, $rules, $customMessages);

        if ($request->email && strlen($request->email) != 0) {
            $user = \App\ServiceProvider\User::find($id);
            $user->email = $request->email;
            $user->save();

            Session::forget('logged_in_seller');
            Session::forget('suserid');

            $response = [
                'success' => true,
                'logout' => true,
                'data' => $user->email,
                'message' => 'Email Changed.'

            ];
        } elseif ($request->phone_number && strlen($request->phone_number) != 0) {
            $user = \App\ServiceProvider\User::find($id);
            $user->mobile = $request->phone_number;
            $user->save();
            $response = [
                'success' => true,
                'data' => $user->mobile,
                'message' => 'Phone Number Changed.'
            ];
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Oops!! Something went wrong!'
            ]);
        }
        return response()->json($response);
    }

    public function reviewPost(){
        $data = $this->bidedPost->getWinPostDetails();
        // return $data;
        return view('service_provider.review')->with('posts', $data);
    }
    public function checkOldPassword(Request $r){
        $user = User::find(session('suserid'));
        if(Hash::check($r->old_password, $user->password)){
            return response()->json($user->password);
        }
        return response()->json($this->errorMessage('Please enter a correct password.'), 500);
    }
    public function changePassword(Request $r){
        $validate = Validator::make($r->all(),[
            'new_password'=> 'required|string|min:6',
            'confirm_password' => 'required_with:new_password|same:new_password|min:6'
        ]);
        if($validate->passes()){
            $model = User::find(session('suserid'));
            $model->password = Hash::make($r->new_password);
            $model->save();
            return response()->json($this->successMessage());
        }else{
            return response()->json($this->errorMessage($validate->errors()), 500);
        }
    }

    
    public function activityIndex(){
        $userid = session('suserid');
        $posts = $this->bidedPost->getAllBidedActivityPost($userid);
        $ratings = $this->winPost->getRatings();
        // return $ratings;
        // return $posts;
        return view('service_provider.activity')->with('posts', $posts)->with('ratings', $ratings[0]);
    }

    public function getGraphData(){
        $data = ServiceProviderBidPost::where('service_provider_id', session('suserid'))->where('status',4)->groupBy('created_at')->get();
        return $data;
    }
}
