<?php

namespace App\Buyer;

use App\BaseModel;

class ClientForgetPassword extends BaseModel
{
    protected $primaryKey = 'id';
    protected $table = "client_forget_password";
    protected $dates = ['created_at', 'expired_at'];
    public $timestamps = false;
    protected $fillable = ['email', '_token'];
    // protected $rules = [
    //     'email' => 'required|email',
    //     '_token' => 'required|string',
    // ];
}