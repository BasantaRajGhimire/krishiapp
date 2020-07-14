<?php

namespace App;
use App\BaseModel;
class District extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "district";
	public $timestamps = false;
	protected $fillable = ['district_name','disctrict_code'];
	protected $rules = [
            'district_name'=>'required|string',
            'district_code' => 'required|integer',
	];
        
}

