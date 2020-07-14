<?php

namespace App\ServiceProvider;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;
use DB;
use App\Buyer\ClientPost;
use App\Buyer\ClientUsers;
use App\ServiceProvider\TableObject;

class WinPostDetails extends Model
{
	protected $obj;
	public function __construct(TableObject $obj){
		$this->obj = $obj;
	}
	public function getSingleWinPostDetails(){		
		$obj = $this->obj->makeWinClientPostDetails();
		$data = $obj->whereIn('sw.status',[1])
					->where('sw.service_provider_id', session('suserid'))
					->where('sw.stars','!=','-1')
					->select('cp.id','sw.winid','sw.client_id','sw.service_provider_id','sw.remarks','sw.stars','sbcp.comment_on_bid','sbcp.bid_amount','sbcp.created_at as bided_at','cp.created_at','sw.status','cp.description','cu.name')
					->orderBy('sw.created_at','desc')
					->first();
		return $data;
	}
	public function getRatings(){		
        $data = DB::table('serviceprovider_win_clientpost')->select(DB::Raw('sum(CASE WHEN stars = "1" then 1 else 0 END) as one'), DB::Raw('sum(CASE WHEN stars = "2" then 1 else 0 END) as two'),DB::Raw('sum(CASE WHEN stars = "3" then 1 else 0 END) as three'), DB::Raw('sum(CASE WHEN stars = "4" then 1 else 0 END) as four'), DB::Raw('sum(CASE WHEN stars = "5" then 1 else 0 END) as five'), DB::Raw('sum(CASE WHEN stars != "-1" then 1 else 0 END) as total'))->where('service_provider_id', session('suserid'))->get();
        return $data;
	}
	
}