<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Admin\ClientExport;
use DB;

class ClientReportingController extends Controller
{
    public function index(){
        $month = DB::table('months')->get();
        return view('admin.client_reporting.index')->withMonth($month);
    }
    public function monthlyReport(Request $request){
        // return $request;
        $year = date('Y');
        $entry = $request->input("entry")?? 10;
        // $search = $request->input("search", null);
        $page = $request->input("page", null);
        if ($page == null) {
            $page = 1;
        }
        $data  = DB::table('client_users as cu')
                    ->select(DB::raw('cu.id,cu.name,case when cu.status = 1 then "Verified"  else "Inactive" end  as status,SUM(case when cp.status = 0 then 1 else 0 end) as pending_post,SUM(case when cp.status = 1 then 1 else 0 end) as bidding_post,SUM(case when cp.status = 2 then 1 else 0 end) as rejected_requested_bids,SUM(case when cp.status = 3 then 1 else 0 end) as handover_post,SUM(case when cp.status = 5 then 1 else 0 end) as delivered_post'))
                    ->leftjoin('client_post as cp','cp.client_id','=','cu.id');
        if(!empty($request->year)){
            $data->where('cp.updated_at','like', $request->year.'%');
        }
        if(!empty($request->month)){
            $year = $request->year ?? $year;
            $data->where('cp.updated_at','like', $year.'-'.$request->month.'%');
        }

        if(!empty($request->date_to) && !empty($request->date_from)){
            $startDate = $request->date_from.' 00:00:00';
            $endDate = $request->date_to.' 23:59:59';
            $data->whereBetween('cp.updated_at', [$startDate, $endDate]);
        }
        $data = $data->groupBy('cu.id','cu.name','cu.status');
        if(isset($request->file)){
            $data = $data->get();
            return Excel::download(new ClientExport($data), 'users.xlsx');
        }
        return $data->paginate($entry, ['*'], 'page', $page);
    }
}
