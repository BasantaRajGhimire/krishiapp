<?php

namespace App\ServiceProvider;
use App\BaseModel;
use Carbon\Carbon;

class VendorTicket extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "service_provider_tickets";
	public $timestamps = false;
	protected $fillable = [ 'category_id','title', 'priority', 'message'];
	protected $rules = [
			'title'     => 'required',
            'category_id'  => 'required',
            'priority'  => 'required',
            'message'   => 'required',
			'screenshot' => 'mimes:jpg,jpeg,png',
	];
	public function getCreatedAtAttribute($value){
		return Carbon::parse($value)->format('d M, Y H:m:s');
	}
	public function getUpdatedAtAttribute($value){
		return Carbon::parse($value)->format('d M, Y H:m:s');
	}

}