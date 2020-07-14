<?php

namespace App;

use DB;
use Hash;
use Session;
use App\Admin\AdminUsers;

class Auth {

    public function login($username, $password) {
        $user = AdminUsers::where('email', '=', $username)->first();
        if (!empty($user)) {
            if (Hash::check($password, $user->password)) {
                session([
                    'logged_in' => true,
                    'userid' => $user->id,
                    'usertype' => $user->usertype,
                ]);
                return true;
            } else {
                return false;
            }
        } 
        return -1;
    }

    public function logout() {
        Session::forget('logged_in');
        Session::forget('userid');
    }

    public function getClientUser($clientid) {
        $user = DB::table('client_users as e')
                //->join('hr_darbandi as d', 'e.id', '=', 'd.empid')
                ->where('e.id', '=', $clientid)
                ->first();
        return $user;
    }
    public function getVendorUser($vendorid) {
        $user = DB::table('service_provider_users as s')
                //->join('hr_darbandi as d', 'e.id', '=', 'd.empid')
                ->where('s.id', '=', $vendorid)
                ->first();
        $vendorType = \App\Admin\ServiceType::find($user->vendor_type);
        // dd($vendorType);
        if(!empty($user)){
            if(!empty($user->badge)){
                $badge = \App\Admin\Batch::find($user->badge);
                $user->badge_name = $badge->name;
                $user->badge_description = $badge->description;
            }
            if(!empty($vendorType->service_type_name)){
                // dd($vendorType);
                $user->vendor_type = $vendorType->service_type_name;
            }else{
                $user->vendor_type = $user->vendor_type=="10001"?"Manufacturer":"Wholeseller/Retailer"; 
            }
        }
        // dd($user);
        return $user;
    }

    public function getSystemUser($uid) {
        $sysUser = AdminUsers::where('id',$uid)->first();
        return $sysUser;
    }
    public function userTable(){
        return (session('userid')?'Admin':(session('cuserid')?'Client':'Service Provider'));
    }

}
