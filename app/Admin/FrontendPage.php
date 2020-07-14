<?php

namespace App\Admin;
use App\BaseModel;
class FrontendPage extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "frontend_page";
	public $timestamps = false;
	protected $fillable = ['slug','content'];
	protected $rules = [
            'slug'=>'required|string',
            'content' => 'required|string',
	];
        
}

