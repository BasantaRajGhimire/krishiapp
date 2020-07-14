<?php

namespace App\Admin;
use App\BaseModel;
class CompanyClass extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "company_class";
	public $timestamps = false;
	protected $fillable = ['name'];
	protected $rules = [
            'name'=>'required|string',
	];
        
}

