<?php

namespace App\ServiceProvider;

use App\BaseModel;
use DB;
use Illuminate\Http\Request;

class ServiceProviderBidPost extends BaseModel
{
    public $timestamps = false;
    protected $primaryKey = 'bid_id';
    public $table = 'serviceprovider_bid_post';
    protected $fillable = ['post_id', 'bid_amount'];
    protected $rules = [
            'bid_amount' => 'required|integer|min:1',
            'comment_on_bid' => 'required|string|max:200',
    ];

    public function getLatestPost($userid)
    {
        $latestWinPost = DB::table('serviceprovider_win_clientpost')->where('service_provider_id', $userid)->orderBy('created_at', 'desc')->first();
        $data = '';
        //return $latestWinPost;
        if (!empty($latestWinPost)) {
            $data = $this::joinTables($userid);
            $data = $data->where('spbp.bid_id', $latestWinPost->bid_id)
                ->select('cp.id as postid', 'cp.description', 'cu.name', 'spbp.bid_amount', 'cp.created_at')
                ->first();
            $data->win_status = $latestWinPost->status;
        }
        return $data;
    }

    public function countPost($status)
    {
        $count = ServiceProviderBidPost::where('service_provider_id', session('suserid'))->where('status', $status)->count();
        return $count;
    }

    public function getBidCount($postid)
    {
        $count = ServiceProviderBidPost::where('post_id', $postid)->where('status', 1)->count();
        return $count;
    }

    public function joinTables($userid = null)
    {
        if ($userid == null) {
            $userid = session('suserid');
        }
        $model = DB::table('serviceprovider_bid_post as spbp')
            ->select('cp.id', 'spbp.bid_id', 'cu.name', 'spbp.bid_amount', 'spbp.created_at as bided_at')
            ->join('client_post as cp', 'cp.id', '=', 'spbp.post_id')
            ->join('client_users as cu', 'cu.id', 'cp.client_id')
            ->where('spbp.service_provider_id', $userid);
        return $model;
    }

    public function getVendorBidPost($status = null)
    {
        $model = $this::joinTables();
        if (!empty($status)) {
            $model = $model->where('spbp.status', $status);
        }
        $model = $model->limit(5)
            ->get();
        return $model;
    }

    public function getAutoBidProvidersData($category)
    {
        $serviceproviders = User::select('id')->where('service_category', $category)->orWhere('service_category', 'B')->get();
        foreach ($serviceproviders as $k => $s) {
            $data[$k] = $s->id;
        }
        return $data;
    }

    public function getInsertValue(Request $r)
    {
        $serviceProvider = $r->service_provider;
        foreach ($serviceProvider as $sp) {
            $rows[] = [
                'service_provider_id' => $sp,
                'post_id' => $r->post_id,
                'bid_amount' => 0,
                'status' => 0
            ];
        }
        return $rows;
    }

    public function getWinDetails($postid)
    {
        $data = DB::table('serviceprovider_win_clientpost as spwcp')
            ->select('spu.contact_name','spu.average_stars', 'spu.company_name','spu.badge', 'spwcp.amount', 'spbp.comment_on_bid', 'spbp.created_at','spwcp.winid')
            ->join('service_provider_users as spu', 'spu.id', '=', 'spwcp.service_provider_id')
            ->where('spwcp.post_id', $postid)
            ->join('serviceprovider_bid_post as spbp', 'spbp.bid_id', '=', 'spwcp.bid_id')
            ->orderBy('spwcp.created_at','desc')
            ->first();
        return $data;
    }
}