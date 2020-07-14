<?php

namespace App\ServiceProvider;

use App\BaseModel;

class ServiceProviderForgetPassword extends BaseModel
{
    protected $primaryKey = 'id';
    protected $table = "serviceprovider_forget_password";
    protected $dates = ['created_at', 'expired_at'];
    public $timestamps = false;
    protected $fillable = ['email', '_token'];
    // protected $rules = [
    //     'email' => 'required|email',
    //     '_token' => 'required|string',
    // ];
}