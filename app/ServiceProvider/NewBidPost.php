<?php

namespace App\ServiceProvider;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;
use DB;
use App\Buyer\ClientPost;
use App\ServiceProvider\User;
use App\ServiceProvider\TableObject;

class NewBidPost extends Model
{
	protected $users;
	protected $obj;
	public function __construct(User $users, TableObject $obj){
		$this->users = $users;
		$this->obj = $obj;
	}
	public function getNewBid(){
		$user = $this->users->find(session('suserid'));
		$userid = $user->id;
		$category = $user->service_category;
		if($category == 'M'){
			return $this->getNewBidMaterialPost($userid);
		}
		else if($category == 'S'){
			return $this->getNewBidServicePost($userid);
		}else{
			return $this->getNewBidBothPost($userid);
		}
	}  
	public function getNewBidMaterialPost($userid){	
	$obj = $this->obj->makeTableObjectMaterial();	
	$data = $obj->leftJoin('serviceprovider_bid_post as spbp', 
				function($q) use($userid){
				$q->on('spbp.post_id','=','cp.id')
					->where('spbp.service_provider_id','=', $userid);
				})
				->where('cp.status', 1)
				->where('spbp.status', 0)
				->groupBy('cp.id','cu.name','mi.name','mt.material_type_name','mb.brand_name','cpm.quantity','cp.duration_days','cp.description','cp.created_at','cp.expired_at','up.filename')
				->orderBy('cp.created_at', 'desc')
				->get();
		return $data;
	}
	public function getNewBidServicePost($userid){
		$obj = $this->obj->makeTableObjectService();
		$data = $obj->leftJoin('serviceprovider_bid_post as spbp', function($q) use($userid){
							$q->on('spbp.post_id','=','cp.id')
								->where('spbp.service_provider_id','=', $userid);
						})
						->where('cp.status', 1)
						->where('spbp.status', 0)
						->groupBy('cp.id','cu.name','st.service_type_name','as.name','cp.duration_days','cp.estimated_cost','cp.description','cps.land_area','cps.no_of_storey','floor_space','cp.created_at','cp.expired_at')
						->select('cp.id as postid','cu.name as client_name','st.service_type_name','as.name as service_name','cp.duration_days','cp.estimated_cost','land_area','cps.no_of_storey','floor_space','cp.description','cp.created_at','cp.expired_at')
						->get();
		return $data;

	}  
	public function getNewBidBothPost($userid){
		$material =  $this::getNewBidMaterialPost($userid);
		$service = 	$this::getNewBidServicePost($userid);
		$len = count($service);
		foreach($material as $m){
				$service[$len] = $m;
				$len++;
		}
		return $service;
	}
}