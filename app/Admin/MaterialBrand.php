<?php

namespace App\Admin;
use App\BaseModel;
class MaterialBrand extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "material_brands";
	public $timestamps = false;
	protected $fillable = ['material_type_id','material_id','brand_name','amount','brand_description'];
	protected $rules = [
            'material_type_id'=>'integer|nullable',
            'material_id' => 'required|integer',
            'brand_name' => 'required|string',
            'amount' => 'required|integer',
            'brand_description' => 'required|string',
	];
        
}

