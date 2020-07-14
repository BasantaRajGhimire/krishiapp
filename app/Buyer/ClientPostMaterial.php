<?php

namespace App\Buyer;
use App\BaseModel;
use DB;
class ClientPostMaterial extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "client_post_materials";
	public $timestamps = false;
	protected $fillable = ['material_id','material_type_id','brand_id','quantity'];
	protected $rules = [
			'category'=> 'required|string',
            'district' => 'required|string',
            'address' => 'required|string',
            'material_id'=> 'required|string',
            'brand_id' => 'required|string',
            'quantity' => 'required|integer',
            'description' => 'required|string|max:200',
            'estimated_cost' => 'nullable|integer|min:1',
	];

	public function getPostDetails($postid, $status=null){
		$data = DB::table('client_post as cp')->select('cu.name as Client Name','cu.mobile as Phone Number','cu.email as Email','cp.category as Category','mi.name as Material','mt.material_type_name as Material Type Name','mb.brand_name as Brand Name','cpm.quantity as Quantity','cp.estimated_cost as Estimated Cost','cp.duration_days as Duration Days','cp.address as Address','cp.description as Description','cp.created_at as PostedAt')
					->leftjoin('client_post_materials as cpm','cp.id','=','cpm.post_id')
					->leftjoin('client_users as cu','cu.id','=','cp.client_id')
					->leftjoin('material_items as mi','mi.id','=','cpm.material_id')
					->leftjoin('material_types as mt','mt.id','=','cpm.material_type_id')
					->leftjoin('material_brands as mb','mb.id','=','cpm.brand_id')
					->where('cp.id', $postid)
					->first();
		$data->Category = 'Material';
		$data->Description = '<p align="justify">'.$data->Description.'</p>';
		return $data;
	}
        
}

