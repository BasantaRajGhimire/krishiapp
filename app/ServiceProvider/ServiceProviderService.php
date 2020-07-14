<?php

namespace App\ServiceProvider;

use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;
use App\BaseModel;

class ServiceProviderService extends BaseModel
{
    public $timestamps=false;
    public $table = 'serviceprovider_services';
    protected $fillable = ['service_id','service_provider_id'];
 	

 	public function getInsertData($services, $userid){
 		foreach($services as $s){
 			$serviceRows[] = [
 					'service_id' => $s,
 					'service_provider_id' => $userid,
 			]; 
 		}
 		return $serviceRows;
 	} 	
 	public function getUserDetails($userid){
 		$data = $this::select('s.name')
					// ->join('service_types as s','service_id','=','s.id')
					->join('add_services as s','service_id','=','s.id')
					->where('service_provider_id', $userid)
					->groupBy('s.name')
					->get();
 		return $data;
 	}
}