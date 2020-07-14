<?php

namespace App\ServiceProvider;

use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;
use App\BaseModel;

class SellerType extends BaseModel
{
    public $timestamps=false;
    public $table = 'vendor_type';
    // protected $fillable = ['contact_name','company_name','mobile','email','provider_type','district','address','website','have_branches','description'];
    // protected $rules = [
    //      'contact_name' => 'required|string',
    //      'mobile' => 'required|integer',
    //      'email' => 'required|email|unique:service_provider_users',
    //      'password' => 'required|string|min:6',
    //      'confirm_password' => 'required_with:password|same:password|min:6',
    //      //'provider_type' => 'required|string',
    //      'district' => 'required|string',
    //     ]; 

    function getNameFromId($typeid){
        $model = SellerType::find($typeid);
        return $model->name;
    }
}