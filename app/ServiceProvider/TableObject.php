<?php

namespace App\ServiceProvider;

use Illuminate\Database\Eloquent\Model;
//use App\BaseModel;
use DB;

class TableObject extends Model
{
	// protected $users;
	// public function __construct(User $users){
	// 	$this->users = $users;
	// } 
	public function makeTableObjectMaterial($postid=null){
		$data =  $this::makeTableClientPost($postid);
		$data =  $data->where('cp.category','M')
					->select('cp.id as postid','cu.name as client_name','mi.name','mt.material_type_name','mb.brand_name','cpm.quantity','cp.duration_days','cp.description','cp.created_at','cp.expired_at','up.filename as file_attached')
					->leftJoin('client_post_materials as cpm','cp.id','=','cpm.post_id')
					->leftjoin('serviceprovider_material as spm','cpm.material_id','=','spm.material_id')
					->leftjoin('material_items as mi','mi.id','=','cpm.material_id')
					->leftjoin('material_types as mt','mt.id','=','cpm.material_type_id')
					->leftjoin('material_brands as mb','mb.id','=','cpm.brand_id')
					->leftjoin('client_users as cu','cu.id','=','cp.client_id');
		return $data;
	}
	public function makeTableObjectService($postid=null){
		$data =  $this::makeTableClientPost($postid);
		$data =  $data->where('cp.category','S')
						->join('client_post_services as cps','cps.post_id','=','cp.id')
						->join('serviceprovider_services as sps','sps.service_id','=','cps.service_id')
						// ->join('serviceprovider_services as sps','sps.service_id','=','cps.service_type_id')
						->join('service_types as st','st.id','=','cps.service_type_id')
						->join('add_services as as','as.id','=','cps.service_id')
						->join('client_users as cu','cu.id','=','cps.client_id');
		return $data;
	}
	public function makeTableClientPost($postid=null){
		$qry = DB::table('client_post as cp')->leftjoin('uploads as up','up.id','=','cp.file_id');
		if(!empty($postid)){
			$qry = $qry->where('cp.postid', $postid);
		}
		return $qry;
	}
	public function makeWinClientPostDetails(){		
		$obj = $this::makeTableClientPost();
		$data = $obj->join('serviceprovider_win_clientpost as sw','sw.post_id','=','cp.id')
					->join('serviceprovider_bid_post as sbcp','sbcp.bid_id','=','sw.bid_id')
					->join('service_provider_users as spu','spu.id','=','sw.service_provider_id')
					->join('client_users as cu','cu.id','=','sw.client_id');
		return $data;
	}
	public function makeJoinPostwithBid($userid){
		$qry = DB::table('client_post as cp')->select('spbp.post_id','cp.category','cp.description','cp.status as post_status','spbp.status as bid_status','spbp.bid_amount','spbp.bid_id','spbp.updated_at')->join('serviceprovider_bid_post as spbp','spbp.post_id','=','cp.id')->where('spbp.service_provider_id', $userid)->where('spbp.status','!=',0)->orderBy('spbp.updated_at','desc');
		return $qry;
	}
}