<?php

namespace App\ServiceProvider;

use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;
use App\BaseModel;

class ServiceProviderMaterial extends BaseModel
{
    public $timestamps=false;
    public $table = 'serviceprovider_material';
    protected $fillable = ['material_id','service_provider_id'];
     
    public function getInsertData($materials, $userid){
 		foreach($materials as $m){
 			$materialRows[] = [
 					'material_id' => $m,
 					'service_provider_id' => $userid,
 			]; 
 		}
 		return $materialRows;
 	}
 	public function getUserDetails($userid){
 		$data = $this::select('name')
					->leftjoin('material_items as mi','material_id','=','mi.id')
					// ->join('vndor_category as v','v.id','=','vendor_id')
					->where('service_provider_id', $userid)
					->groupBy('mi.name')
					->get();
 		return $data;
 	}
}