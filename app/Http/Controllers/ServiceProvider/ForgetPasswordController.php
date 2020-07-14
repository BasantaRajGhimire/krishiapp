<?php

namespace App\Http\Controllers\ServiceProvider;

use App\ServiceProvider\User;
use App\Http\Controllers\Controller;
use App\Mails\ForgetPasswordMail;
use App\ServiceProvider\ServiceProviderForgetPassword;
use Carbon\Carbon;
use DB;
use Hash;
use Validator;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgetPasswordIndex(){
        return view('service_provider.auth.forget-password.enter-email');
    }
    public function checkEmailForgetPassword(Request $r,ForgetPasswordMail $mail){
        $user = User::where('email',$r->email)->first();
        if(!empty($user)){
            DB::beginTransaction();
            try{
                ServiceProviderForgetPassword::where('user_id', $user->id)->where('email', $r->email)->where('status', 0)->update(['status' => 2]);      
                $rand = Carbon::now();
                $model = new ServiceProviderForgetPassword();
                $model->fill($r->all());
                $model->user_id = $user->id;
                $model->_token = md5($rand.'S'.$user->id);
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
        return view('service_provider.auth.forget-password.new-password',compact('token'));
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
                $model = ServiceProviderForgetPassword::where('email', $r->email)->where('_token', $token)->where('status', 0)->first();
                if(!empty($model)){
                    $model->status = 1;
                    $model->token_verified_at = Carbon::now();
                    $model->save();
                    $user = User::find($model->user_id);
                    $user->password = Hash::make($r->new_password);
                    $user->save();
                    DB::commit();
                    return redirect('/service-provider/auth')->with('msg','Your Password has been successfully changed. Login with new password here.');
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
