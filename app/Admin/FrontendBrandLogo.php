<?php

namespace App\Admin;
use App\BaseModel;
class FrontendBrandLogo extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "frontend_brandlogo";
	public $timestamps = false;
	protected $fillable = ['brand_name','brand_logo'];
	protected $rules = [
			'brand_name' => 'required|string',
         	'brand_logo' => 'required|mimes:jpeg,jpg,png,pdf',
	];
 
 public function brandLogo(){
 	$data = $this::all();
 	return $data;
 }       
}

