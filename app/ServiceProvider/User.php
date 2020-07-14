<?php

namespace App\ServiceProvider;

use App\BaseModel;
use DB;
use Carbon\Carbon;
use Hash;

class User extends BaseModel
{

    public $timestamps = false;
    public $table = 'service_provider_users';
    protected $fillable = ['contact_name', 'mobile', 'email', 'vendor_type', 'district', 'address', 'website','reg_date','reg_num','company_class','owner_type','company_address','company_phone1','company_phone2','vat_no', 'have_branches', 'description'];
    protected $rules = [
        'contact_name' => 'required|string',
        'mobile' => 'required|integer|digits:10',
        'email' => 'required|email|unique:service_provider_users',
        'password' => 'required|string|min:6',
        'confirm_password' => 'required_with:password|same:password|min:6',
        'district'=>'required|integer',
        'vendor_type' => 'required|string',
        'reg_num' => 'required|integer',
        'reg_date' => 'required|date',
        'company_class' => 'required|string',
        'company_address' =>'required|string',
        'company_phone1' =>'required|digits_between: 8,10',
        'company_phone2' => 'required|digits_between: 8,10',
        'vat_no' => 'required|string',

    ];

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('d M, Y');
    }

    public function getInsertProjectDetailsData($projectDetails, $projectLinks, $userid){
        $rows = [];
        foreach($projectDetails as $k => $pd){
            foreach($projectLinks as $l => $pl){
                if($k == $l && !empty($pd)){
                    $rows[] = [
                        'project_detail' => $pd,
                        'project_link' => $pl,
                        'service_provider_id' => $userid,
                    ];
                }
            }
        }
        return $rows;
    }

    public function login($username, $password)
    {
        $user = User::where('email', '=', $username)->first();

        if (!empty($user)) {
            if ($user->status == 0 || $user->status == 2 || $user->status == 3){
                return -2;
            }
            if($user->status == 4){
                return -3;
            }
            if (Hash::check($password, $user->password)) {
                session([
                    'logged_in_seller' => true,
                    'suserid' => $user->id
                ]);
                return true;
            } else {
                return false;
            }
        }
        return -1;
    }

    public function loginwithEmailVerification($email){
        $user = User::where('email', '=', $email)->first();

        if (!empty($user)) {
            if ($user->status == 2) {
                return -2;
            }
            if($user->status == 3){
                return -3;
            }
            if (!empty($user->email_verified_at)) {
                return false;
            }else{
                $model= User::find($user->id);
                $model->status = 1;
                $model->email_verified_at = now();
                $model->save();
                session([
                    'logged_in_seller' => true,
                    'suserid' => $user->id
                ]);                
                return true;
            }
        }
        return false;
    }

    public function profiles(){
        return $this->hasMany('\App\ServiceProvider\Profile', 'service_provider_id', 'id');
    }

    public function getUser($userid = null)
    {
        if (empty($userid)) {
            $userid = session('suserid');
        }
        $user = $this::find($userid);
        return $user;
    }
    public function countUnreadMessages(){
        $userid = session('suserid');
        return DB::table('support_messages')->where('user_table', 'V')->where('user_id', $userid)->whereNull('read_at')->count();
    }
    public function getMessages(){
        $userid = session('suserid');
        return DB::table('support_messages')->where('user_table', 'V')->where('user_id', $userid)->orderBy('created_at', 'desc')->get();
    }
    public function userPenalty(){
        return $this->hasOne('\App\ServiceProvider\UserPenalty', 'service_provider_id', 'id')->orderBy('serviceprovider_penalty_for_newbid.created_at', 'desc');
    }
    public function getPenaltyDetailsIfExist($userid){
        $model = DB::table('serviceprovider_penalty_for_newbid')->where('service_provider_id', $userid)->where('expired_at','>',now())->orderBy('created_at', 'desc')->first();
        if(!empty($model)){
            return $model;
        }else{
            return false;
        }
    }
    public function getMonthlyWiseWinPost(){
        $year = date('Y');   
        $data = DB::table('client_post as cp')->join('serviceprovider_bid_post as spbp','spbp.post_id','=','cp.id')->where('spbp.service_provider_id', session('userid'))->where('cp.status' , 5)->where('cp.updated_at','like', $year.'%')->get(['cp.updated_at'])->groupBy(function($date) {
                        return Carbon::parse($date->updated_at)->format('m');
                });
        for($i=1; $i < 13 ;$i++){
            foreach($data as $k => $d){
                if($i == intVal($k) ){
                    $dt[intVal($k)] = $d->count();
                    $i++;
                }
            }
            $dt[$i] = 0;
        }
        return $dt;
    }

}
