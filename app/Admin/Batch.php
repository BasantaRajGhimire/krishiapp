<?php

namespace App\Admin;
use App\BaseModel;
class Batch extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "batches";
	public $timestamps = false;
	protected $fillable = ['name','description'];
	protected $rules = [
			'name'=>'required|string',
			'icon' => 'nullable|string',
            'description' => 'required|string',
	];
        
}

