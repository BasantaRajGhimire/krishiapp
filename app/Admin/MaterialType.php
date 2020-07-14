<?php

namespace App\Admin;
use App\BaseModel;
class MaterialType extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "material_types";
	public $timestamps = false;
	protected $fillable = ['material_type_name','material_id','type_description'];
	protected $rules = [
            'material_type_name'=>'required|string',
            'material_id' => 'required|integer',
            'type_description'=>'string|nullable',
	];
        
}

