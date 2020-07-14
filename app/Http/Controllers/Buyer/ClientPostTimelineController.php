<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer\ClientPost;
use App\Buyer\ClientTimelineInfo;
use App\Buyer\ClientUsers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Mails\RegisterMail;
use App\ServiceProvider\ServiceProviderBidPost;
use App\Buyer\EscrowSystemClientPhaseWisePayment;
use App\Buyer\EscrowSystemClientDepoDetails;
use App\ServiceProvider\EscrowSystemServiceProviderPhaseWisePayment;
use App\ServiceProvider\User;
use App\Mails\AwardMail;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientPostTimelineController extends Controller
{
    protected $post;
    protected $user;
    protected $info;

    public function __construct(ClientUsers $user, ClientPost $post, ClientTimelineInfo $info)
    {
        $this->post = $post;
        $this->user = $user;
        $this->info = $info;
    }

    public function profile()
    {
        $posts = $this->post->getClientPost();
        return view('client.auth.profile')->with('posts', $posts);
    }
    public function awardedPost(){
        $posts = $this->post->getClientPost(null, [3]);
        // return $posts;
        return view('client.awarded_post')->with('posts', $posts);
    }
    public function timeline()
    {
        $posts = $this->post->getClientPost(null, [0,1,2,4]);
        // return $posts;
        return view('client.timeline')->with('posts', $posts);
    }

    public function getPostDetails($postid, Request $r)
    {
        if(isset($r->status)){
            DB::table('support_messages')->where('id', $r->status)->update(['read_at' => now()]);
        }
        // return \Carbon\Carbon::now()->addDays(5)->endOfDay();
        $data = $this::getSinglePostData($postid, $r);
        $comments = DB::table('serviceprovider_bid_post as spbp')->join('service_provider_users as spu','spu.id','=','spbp.service_provider_id')->where('spbp.post_id', $postid)
            ->where('spbp.status', config('constants.BID_POST_STATUS.PROCESSING'))
            ->select('spbp.bid_id', 'spbp.comment_on_bid', 'spbp.bid_amount', 'spbp.created_at','spu.average_stars','spu.badge')
            ->orderBy('bid_amount')
            ->get();

        // return $data;
        if ($data == false) {
            return view('client.single_post')->with('err', 'Invalid Token !!');
        } else {
             // return $data['escrow_activate']->status;
             // return $data;
            return view('client.single_post')
                ->with('data', $data)
                ->with('comments', $comments);
        }
    }

    public function getSinglePostData($postid, $r)
    {
        $post = $this->post->with('service_provider_bid_posts')->find($postid);
        $user = $this->user->find($post->client_id);
        if ($user->remember_token == $r->post_token) {
            $data['post'] = $this->info->getSinglePost($postid, $post->category);
            //return $post->status;
            $data['status'] = $this->post->getStatus($post->status);
            if ($post->status == 1) {
                $data['bid_count'] = (new ServiceProviderBidPost())->getBidCount($postid);
            }
            if ($post->status == 3 || $post->status == 5) {
                $data['wins_details'] = (new ServiceProviderBidPost())->getWinDetails($postid);
                if($post->status == 5){
                    $data['escrow_activate'] = EscrowSystemClientPhaseWisePayment::where('post_id', $postid)->orderBy('created_at','desc')->first();
                    if(!empty($data['escrow_activate'])){
                        $data['payment_details'] = EscrowSystemClientPhaseWisePayment::where('post_id', $postid)->get();
                        $data['nextPaymentPhase'] = EscrowSystemClientPhaseWisePayment::where('post_id', $postid)->where(function($qry){ $qry->where('status','Pending')->orWhere('status','Processing'); })->first();
                        $firstPhasePending = EscrowSystemClientDepoDetails::where('post_id', $postid)->where('status','PENDING')->count();
                        $data['firstPhasePending'] = $firstPhasePending!=0?true:false;
                        $data['payment_info'] = EscrowSystemClientDepoDetails::where('post_id', $postid)->get();
                        $data['request-amount'] = EscrowSystemServiceProviderPhaseWisePayment::where('post_id', $postid)->where('is_approved', 0)->where('status', 'Request')->first();
                    }
                }
            }
            return $data;
        } else {
            return 0;
        }
    }

    public function reviewPost(){
        $data = $this->info->getWinPostDetails();
        // return $data;
        return view('client.review')->with('posts', $data);
    }
    public function reviewStore(Request $r){
        // return $r->all();
        $user = new User();
        DB::beginTransaction();
        try{
            $user = DB::table('serviceprovider_win_clientpost')->where('winid', $r->wd)->first();
            $user = User::find($user->service_provider_id);
            $user->average_stars = (($user->average_stars * $user->total_reviews) + $r->rating) / ($user->total_reviews + 1);
            $user->total_reviews = $user->total_reviews + 1;
            $user->save();
            //$rating = $user->ManageRatings($r->wd, $r->rating);            
            $model = DB::table('serviceprovider_win_clientpost')
                ->where('winid', $r->wd)
                ->where('post_id', $r->pd)
                ->update(['stars'=> $r->rating??1,'remarks'=>$r->comment]);
            DB::commit();
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollback();          
            return redirect()->back()->with('msg','Server Error');
        }
    }
    public function markBidAsWon($bid_id, AwardMail $mail)
    {
        $serviceprovider_bidpost = ServiceProviderBidPost::findorfail($bid_id);

        DB::beginTransaction();
        try {
            $serviceprovider_bidpost->status = config('constants.BID_POST_STATUS.WIN');
            $serviceprovider_bidpost->save();

            $row = [
                'post_id' => $serviceprovider_bidpost->post_id,
                'service_provider_id' => $serviceprovider_bidpost->service_provider_id,
                'client_id' => session('cuserid'),
                'bid_id' => $bid_id,
                'amount' => $serviceprovider_bidpost->bid_amount,
                'expired_at' => now()->addDays(2)->format('Y-m-d').' 23:59:00',
            ];
            $clientPost = ClientPost::find($row['post_id']);
            $clientPost->status = 3;
            $clientPost->save();
            DB::table('serviceprovider_win_clientpost')->insert($row);
            $user = User::find($serviceprovider_bidpost->service_provider_id);
            $mail->sendAwardEMail($user, $serviceprovider_bidpost->post_id);
            DB::commit();
            return back()->with('success', 'Your bid has been successfully Awarded');
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with('error', $ex->getMessage());
        }
    }

    public function updateProfile(Request $request, $id, RegisterMail $mail)
    {
        $rules = [
            'email' => 'sometimes|required|email|unique:client_users:email',
            'mobile' => 'sometimes|required|numeric|digits:10'
        ];

        $customMessages = [
            'mobile.max' => 'Please enter a valid phone number.'
        ];

        $this->validate($request, $rules, $customMessages);

        if ($request->email && strlen($request->email) != 0) {
            $user = ClientUsers::find($id);
            $user->email = $request->email;
            $user->save();

            $mail->sendRegisterEmail($user);

            Session::forget('logged_in_client');
            Session::forget('email_verified');
            Session::forget('cuserid');

            $response = [
                'success' => true,
                'logout' => true,
                'data' => $user->email,
                'message' => 'Email Changed.'

            ];
        } elseif ($request->mobile && strlen($request->mobile) != 0) {
            $user = ClientUsers::find($id);
            $user->mobile = $request->mobile;
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

}
