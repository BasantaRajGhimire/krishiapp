<?php

namespace App\Admin;
use App\BaseModel;
class Service extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "add_services";
	public $timestamps = false;
	protected $fillable = ['name','service_type_id','description'];
	protected $rules = [
            'name'=>'required|string',
            'service_type_id' => 'required|integer',
            'description'=>'string|nullable',
	];
        
}

