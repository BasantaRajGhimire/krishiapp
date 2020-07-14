<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer\ClientUsers;
use App\Http\Controllers\Controller;
use App\Mails\ForgetPasswordMail;
use App\Buyer\ClientForgetPassword;
use Carbon\Carbon;
use DB;
use Hash;
use Validator;
use Illuminate\Http\Request;

class ClientUserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.client_users.users');
    }
    public function loginClientWithToken(Request $r){
        $email = $r->input('email');
        $remember_token = $r->input('remember_token');
        $auth = new ClientUsers();
        $status = $auth->loginWithToken($email, $remember_token);        
        if ($status === true) {
            return redirect('/client');
        } else {
            return redirect()->to('/client/auth')->with('err', 'Email verification Token doesnot matched');
        }
    }
    public function listData(Request $request)
    {
        $model = new ClientUsers();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        $status = $request->status;
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = ClientUsers::select('client_users.id','name','email','mobile','district_name','address','occupation','status','client_users.created_at')
                                ->leftjoin('district as d','d.id','=','client_users.district')
                                ->where('status', $status);
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = $rwrd->where(function($qry) use($search){
                        $qry->where('name', 'LIKE', "%$search%")
                            ->orwhere('email', 'LIKE', "%$search%")
                            ->orwhere('phone_number', 'LIKE', "%$search%");
                    })->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }

    public function getBrand(Request $r)
    {
        $model = new \App\Admin\MaterialBrand();
        if ($r->materialid) {
            $model = $model->where('material_id', $r->materialid)->get();
        } else {
            $model = $model->where('material_type_id', $r->typeid)->get();
        }
        return response()->json($model);
    }

    public function getServices($servicetypeid)
    {
        $model = \App\Admin\Service::where('service_type_id', $servicetypeid)->get();
        return response()->json($model);
    }

    public function checkOldPassword(Request $r){
        $user = ClientUsers::find(session('cuserid'));
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
            $model = ClientUsers::find(session('cuserid'));
            $model->password = Hash::make($r->new_password);
            $model->save();
            return response()->json($this->successMessage());
        }else{
            return response()->json($this->errorMessage($validate->errors()), 500);
        }
    }
    public function deactivateUser($id){
        $model = ClientUsers::find($id);
        $model->status = 2;
        if($model->save()){
            return response()->json($this->successMessage('Selected User is successfully deactivated'));
        }else{
            return response()->json($this->errorMessage('Server Error'), 500);
        }
    }
    public function activateUser($id){
        $model = ClientUsers::find($id);
        $model->status = 1;
        if($model->save()){
            return response()->json($this->successMessage('Selected User is successfully activated now'));
        }else{
            return response()->json($this->errorMessage('Server Error'), 500);
        }
    }
    public function forgetPasswordIndex(){
        return view('client.auth.forget-password.enter-email');
    }
    public function checkEmailForgetPassword(Request $r,ForgetPasswordMail $mail){
        $user = ClientUsers::where('email',$r->email)->first();
        if(!empty($user)){
            DB::beginTransaction();
            try{
                ClientForgetPassword::where('user_id', $user->id)->where('email', $r->email)->where('status', 0)->update(['status' => 2]);      
                $rand = Carbon::now();
                $model = new ClientForgetPassword();
                $model->fill($r->all());
                $model->user_id = $user->id;
                $model->_token = md5($rand.'C'.$user->id);;
                if($model->save()){
                    $user->password_token = $model->_token;
                    $mail->sendEmail($user);
                    DB::commit();
                    return redirect()->back()->with('msg','Your reset password has been sent to your email.');
                }else{
                    DB::commit();
                    return redirect()->back()->with('err','Server not responding. Try later again!!');
                }
            }catch(\Exception $e){
                DB::rollback();
                return redirect()->back()->with('err','Server not responding. Try later again!!');
            }
        }else{
            return redirect()->back()->with('err','Your Email doesnot exist.' );
        }
    }
    public function checkTokenFromMail($token){
        return view('client.auth.forget-password.new-password',compact('token'));
    }
    public function changeNewPasswordAfterForget(Request $r, $token){
        $validate = Validator::make($r->all(),[
                'email' => 'required|email',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password|min:8',
        ]);
        if($validate->passes()){
            DB::beginTransaction();
            try{
                $model = ClientForgetPassword::where('email', $r->email)->where('_token', $token)->where('status', 0)->first();
                if(!empty($model)){
                    $model->status = 1;
                    $model->token_verified_at = Carbon::now();
                    $model->save();
                    $user = ClientUsers::find($model->user_id);
                    $user->password = Hash::make($r->new_password);
                    $user->save();
                    DB::commit();
                    return redirect('/client/auth')->with('msg','Your Password has been successfully changed. Login with new password here.');
                }else{
                    return redirect()->back()->with('err', 'Sorry, Your token with email has been mismatched')->withInput();
                }
            }catch(\Exception $e){
                DB::rollback();
                return redirect()->back()->with('err','Server not responding. Try later again!!')->withInput();
            }
        }else{
            // return $validate->errors();
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

    }
}
