<?php

namespace App\Buyer;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;
use DB;
use Carbon\Carbon;
use Hash;

class ClientUsers extends BaseModel
{
    // public $timestamps=false;
    public $table = 'client_users';
    protected $fillable = ['name', 'email','occupation','dob','mobile','gender','district','address'];
    protected $rules = [
         'name' => 'required',
         'email' => 'required|email||unique:client_users',
         'password' => 'required|string|min:6',
         'confirm_password' => 'required_with:password|same:password|min:6',
         'occupation' => 'required|string',
         'mobile' =>'required|integer',
         'dob' =>'required|string',
         'gender' =>'required|string',
         'district'=>'required|integer',
         'address' =>'required|string',

        ]; 

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('d M, Y');
    }
    public function login($username, $password) {
    $user = \App\Buyer\ClientUsers::where('email', '=', $username)->first();
    if (!empty($user)) {
        if($user->status == '2'){
            return -2;
        }
        if (Hash::check($password, $user->password)) {
            session([
                'email_verified' => !empty($user->email_verified_at)?true:false,
                'logged_in_client' => true,
                'cuserid' => $user->id
            ]);
            return true;
        } else {
            return false;
        }
    } 
    return -1;
	}

    public function loginWithToken($email, $token){
        $user = \App\Buyer\ClientUsers::where('email', $email)->where('remember_token', $token)->first();
        if(!empty($user)){
            if(!empty($user->email_verified_at)){
                return false;
            }
            $model = \App\Buyer\ClientUsers::find($user->id);
            $model->email_verified_at= now();
            $model->save();
            session([
                    'logged_in_client' => true,
                    'cuserid' => $user->id
                ]);
            return true;
        }else{
            return false;
        }

    }

    public function countUnreadMessages(){
        $userid = session('cuserid');
        return DB::table('support_messages')->where('user_table', 'C')->where('user_id', $userid)->whereNull('read_at')->count();
    }
    public function getMessages(){
        $userid = session('cuserid');
        return DB::table('support_messages')->where('user_table', 'C')->where('user_id', $userid)->orderBy('created_at', 'desc')->get();
    }
    
}
