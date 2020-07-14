<?php

namespace App\Buyer;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;
use DB;
use App\Buyer\ClientPost;
use App\Buyer\ClientUsers;
use App\ServiceProvider\TableObject;

class ClientTimelineInfo extends Model
{
	protected $obj;
	public function __construct(TableObject $obj){
		$this->obj = $obj;
	}
	public function getSinglePost($postid, $category){
		if($category == 'M'){
			return $this->getNewBidMaterialPost($postid);
		}
		else{
			return $this->getNewBidServicePost($postid);
		}
	}  
	public function getNewBidMaterialPost($postid){	
	$obj = $this->obj->makeTableObjectMaterial();	
	$data = $obj->where('cp.id', $postid)
				->groupBy('cp.id','cu.name','mi.name','mt.material_type_name','mb.brand_name','cpm.quantity','cp.duration_days','cp.description','cp.created_at','cp.expired_at','up.filename')
				->orderBy('cp.created_at', 'desc')
				->get();
		return $data;
	}
	public function getNewBidServicePost($postid){
		$obj = $this->obj->makeTableObjectService();
		$data = $obj->where('cp.id', $postid)
						->groupBy('cp.id','cu.name','st.service_type_name','as.name','cp.duration_days','cp.estimated_cost','cp.description','cps.land_area','cps.no_of_storey','floor_space','cp.created_at','cp.expired_at')
						->select('cp.id as postid','cu.name as client_name','st.service_type_name','as.name as service_name','cp.duration_days','cp.estimated_cost','land_area','cps.no_of_storey','floor_space','cp.description','cp.created_at','cp.expired_at')
						->get();
		return $data;

	} 
	public function getWinPostDetails(){
		$obj = $this->obj->makeWinClientPostDetails();
		$data = $obj->whereIn('sw.status',[1,2])
					->where('sw.client_id', session('cuserid'))
					->select('cp.id','sw.winid','sw.client_id','sw.service_provider_id','sw.remarks','sw.stars','sbcp.comment_on_bid','sbcp.bid_amount','sbcp.created_at as bided_at','cp.created_at','sw.status','cp.description','spu.contact_name','spu.badge')
					->orderBy('sw.stars','asc')
					->get();
		return $data;
	}
	public function getSingleWinPostDetails(){		
		$obj = $this->obj->makeWinClientPostDetails();
		$data = $obj->whereIn('sw.status',[1,2])
					->where('sw.client_id', session('cuserid'))
					->where('sw.stars','-1')
					->select('cp.id','sw.winid','sw.client_id','sw.service_provider_id','sw.remarks','sw.stars','sbcp.comment_on_bid','sbcp.bid_amount','sbcp.created_at as bided_at','cp.created_at','sw.status','cp.description','spu.contact_name','spu.badge')
					->orderBy('sw.created_at','desc')
					->first();
		return $data;
	}
}