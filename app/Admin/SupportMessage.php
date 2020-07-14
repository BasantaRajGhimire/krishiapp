<?php

namespace App\Admin;
use App\BaseModel;
class SupportMessage extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "support_messages";
	public $timestamps = false;
	// protected $fillable = ['name','title','description'];
	// protected $rules = [
 //            'name'=>'required|string',
 //            'service_type_id' => 'required|integer',
 //            'description'=>'string|nullable',
	// ];

        
}

