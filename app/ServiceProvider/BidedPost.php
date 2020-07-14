<?php

namespace App\ServiceProvider;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;
use DB;
use App\Buyer\ClientPost;
use App\ServiceProvider\User;

class BidedPost extends Model
{
	protected $users;
	protected $obj;
	public function __construct(User $users, TableObject $obj){
		$this->users = $users;
		$this->obj = $obj;
	}
	public function getBidedPost($postid=null){
		$user = $this->users->find(session('suserid'));
		$userid = $user->id;
		$category = $user->service_category;
		if($category == 'M'){
			return $this->getBidedMaterialPost($userid,$postid);
		}
		else if($category == 'S'){
			return $this->getBidedServicePost($userid,$postid);
		}else{
			return $this->getBidedBothPost($userid,$postid);
		}
	}  

	public function getBidedMaterialPost($userid,$postid=null){
	$obj = $this->obj->makeTableObjectMaterial();		
		$data = $obj->join('serviceprovider_bid_post as spbp','spbp.post_id','=','cp.id')
					->where('spbp.service_provider_id', $userid);
		if(!empty($postid)){
		$data = $data->where('cp.id', $postid)
					->where('spbp.post_id', $postid);
		}else{
			$data =	$data->where('cp.status', 1)
							->where('spbp.status', 1);
		}
		$data = $data->select('cp.id as postid','cu.name as client_name','mi.name as category_name','mt.material_type_name as category_type','mb.brand_name as category_brand','cpm.quantity as quantity','cp.duration_days as bid_duration','cp.created_at','spbp.bid_amount','cp.expired_at','cp.description as description','up.filename')
					->groupBy('cp.id','cu.name','mi.name','mt.material_type_name','mb.brand_name','cpm.quantity','cp.duration_days','cp.description','cp.created_at','spbp.bid_amount','cp.expired_at','up.filename')
					->orderBy('spbp.created_at', 'desc')
					->get();
		return $data;
	}
	public function getBidedServicePost($userid,$postid=null){
		$obj = $this->obj->makeTableObjectService();
		$data = $obj->join('serviceprovider_bid_post as spbp','spbp.post_id','=','cp.id');
		if(!empty($postid)){
		$data = $data->where('cp.id', $postid)
						->where('spbp.post_id', $postid);
		}else{
			$data=$data->where('cp.status', 1)
						->where('spbp.status', 1)
						->whereDate('cp.expired_at','>=', \Carbon\Carbon::now());
		}
		$data = $data->where('spbp.service_provider_id', $userid)
					->select('cp.id as postid','cu.name as client_name','st.service_type_name','as.name as service_name','cp.duration_days','cp.description','cp.created_at','spbp.bid_amount','cp.expired_at')
					->groupBy('cp.id','cu.name','st.service_type_name','as.name','cp.duration_days','cp.description','cp.created_at','spbp.bid_amount','cp.expired_at')
					->get();
		return $data;

	}    
	public function getBidedBothPost($userid,$postid=null){
		$material =  $this::getBidedMaterialPost($userid, $postid);
		$service = 	$this::getBidedServicePost($userid, $postid);
		$len = count($service);
		foreach($material as $m){
				$service[$len] = $m;
				$len++;
		}
		return $service;
	}
	
	public function getWinPostDetails(){
		$obj = $this->obj->makeWinClientPostDetails();
		$data = $obj->whereIn('sw.status',[1,2])
					->where('sw.service_provider_id', session('suserid'))
					->where('sw.stars','!=','-1')
					->select('cp.id','sw.winid','sw.client_id','sw.service_provider_id','sw.remarks','sw.stars','sbcp.comment_on_bid','sbcp.bid_amount','sbcp.created_at as bided_at','cp.created_at','sw.status','cp.description','cu.name')
					->orderBy('sw.created_at','desc')
					->get();
		return $data;
	}
	public function getAllBidedActivityPost($userid)
    {
    	$post = $this->obj->makeJoinPostwithBid($userid);
    	$data = $post->get();
        return $data;
    }
}