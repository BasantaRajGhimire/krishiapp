<?php

namespace App\Admin;
use App\BaseModel;
use Carbon\Carbon;
class ContactusForm extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "contact_us_form";
	public $timestamps = false;
	protected $fillable = ['name','email','message'];
	protected $rules = [
            'name'=>'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
	];

	public function getCreatedAtAttribute($value){
		return Carbon::parse($value)->format('d M, Y H:m:s');
	}
	public function getUpdatedAtAttribute($value){
		return Carbon::parse($value)->format('d M, Y H:m:s');
	}
        
}

