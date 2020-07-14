<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Buyer\ClientPost;
use App\Buyer\ClientUsers;
use App\ServiceProvider\User;
use App\BaseModel;

class AdminUsers extends BaseModel
{
    public $timestamps=false;
    public $table = 'admin_users';
    protected $fillable = ['name','email'];
    protected $rules = [
         'name' => 'string|required',
         'email' => 'required|email|unique:admin_users',
         'password' => 'required|string|min:6',
         'confirm_password' => 'required_with:password|same:password|min:6',
        ]; 


    public function clientPostCount(){
    	$model = ClientPost::count();
    	return $model;
    }
    public function clientRegisteredCount(){
    	$model = ClientUsers::count();
    	return $model;
    }
    public function serviceProviderRegisteredCount(){
    	$model = User::count();
    	return $model;
    }
    public function completedBidPostCount(){
    	$model = ClientPost::where('status', 5)->count();
    	return $model;
    }
 }
