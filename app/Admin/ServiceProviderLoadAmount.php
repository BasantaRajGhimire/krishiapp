<?php

namespace App\Admin;
use App\BaseModel;
class ServiceProviderLoadAmount extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "serviceprovider_loadamount";
	public $timestamps = false;
	protected $fillable = ['load_amount','remarks','service_provider_id'];
	protected $rules = [
            'load_amount'=>'required|integer',
            'remarks' => 'required|string',
            'service_provider_id'=>'required|integer',
	];
        
}

