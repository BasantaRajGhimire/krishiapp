<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\ServiceType;
use App\Admin\ServiceProviderExport;
use DB;
use Excel;
use Carbon\Carbon;

class ServiceProviderReportingController extends Controller
{
    public function index(){
        $month = DB::table('months')->get();
        $vendorType = DB::table('vendor_type')->get();
        $model = ServiceType::all();
        return view('admin.serviceprovider_reporting.index')->withServiceType($model)->withVendorType($vendorType)->withMonth($month);
    }
    public function monthlyReport(Request $request){
        $year = date('Y');
        $entry = $request->input("entry")?? 10;
        // $search = $request->input("search", null);
        $page = $request->input("page", null);
        if ($page == null) {
            $page = 1;
        }
        $data  = DB::table('serviceprovider_bid_post as spbp')
                    ->select(DB::raw('spu.id,spu.contact_name,case when spu.status = 0 then "Unverified" when spu.status =1 then "Verified" when spu.status =3 then "Rejected" else "Inactive" end  as status,b.name as badge,spu.average_stars as stars,spu.total_reviews as reviews,SUM(case when spbp.status = 4 then 1 else 0 end) as completedbids,SUM(case when spbp.status = 3 then 1 else 0 end) as running_won_bids,SUM(case when spbp.status = 1 then 1 else 0 end) as running_requested_bids'))
                    ->leftjoin('service_provider_users as spu','spu.id','=','spbp.service_provider_id')
                    ->leftjoin('batches as b','b.id','=','spu.badge');
        if(!empty($request->category)){
            $data->where('spu.vendor_type', $request->category);
        }
        if(!empty($request->year)){
            $data->where('spbp.updated_at','like', $request->year.'%');
        }
        if(!empty($request->month)){
            $year = $request->year ?? $year;
            $data->where('spbp.updated_at','like', $year.'-'.$request->month.'%');
        }

        if(!empty($request->date_to) && !empty($request->date_from)){
            $startDate = $request->date_from.' 00:00:00';
            $endDate = $request->date_to.' 23:59:59';
            $data->whereBetween('spbp.updated_at', [$startDate, $endDate]);
        }
        $data = $data->groupBy('spu.id','spu.contact_name','b.name','spu.average_stars','spu.total_reviews','spu.status');
        if(isset($request->file)){
            $data = $data->get();
            return Excel::download(new ServiceProviderExport($data), 'users.xlsx');
        }        
        return $data->paginate($entry, ['*'], 'page', $page);
    }
}
