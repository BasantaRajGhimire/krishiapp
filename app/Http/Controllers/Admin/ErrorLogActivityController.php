<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\DbLog;
use App\Http\Controllers\Controller;

class ErrorLogActivityController extends Controller
{
    public function index(){
        return view('admin.error_log_activity');
    }
    public function listData(Request $request){
        $model = new DbLog();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = DbLog::orderBy('created_at','desc');
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = $rwrd->where('user_id', 'LIKE', "%$search%")->orwhere('exception', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }
}
