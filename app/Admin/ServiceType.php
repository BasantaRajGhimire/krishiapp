<?php

namespace App\Admin;
use App\BaseModel;
class ServiceType extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "service_types";
	public $timestamps = false;
	protected $fillable = ['service_type_name','type_description'];
	protected $rules = [
            'service_type_name'=>'required|string',
            'type_description'=>'string|nullable',
	];
        
}

