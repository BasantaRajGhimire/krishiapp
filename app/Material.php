<?php

namespace App;
use App\BaseModel;
class Material extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "material_items";
	public $timestamps = false;
	protected $fillable = ['name','description'];
	protected $rules = [
            'name'=>'required|string',
            'description'=>'string|nullable',
	];
        
}

