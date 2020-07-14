<?php

namespace App\RegisterValidationPhase;
use App\BaseModel;
class FirstPhase extends BaseModel
{
	protected $rules = [
            'vendor_type'=>'required|integer',
            'contact_name'=>'required|string',            
			'email' => 'required|email|unique:service_provider_users',
			'mobile' => 'required|integer|digits:10',
	        'password' => 'required|string|min:6',
	        'confirm_password' => 'required_with:password|same:password|min:6',
	];
        
}

