<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\RequestedForQuote;
use App\Mails\SendQuoteOnEmail;
use DB;
use Validator;

class RequestedForQuoteController extends Controller
{
    public function index(){
        // return 'ok';
        return view('admin.frontend.quote-request');
    }
    public function listData(Request $request){
        // return 'ok';
        $model = new RequestedForQuote;
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = RequestedForQuote::where('status', $request->status);
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = $rwrd->where('product_name', 'LIKE', "%$search%")->orwhere('email_address', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }
    public function store(Request $r){
        $model = new RequestedForQuote;
        // return response()->json($model->rules);
        // $this->validate($r, $model->rules);
        if($model->validate($r->all())){
            $model->fill($r->except(['_token']));
            $model->status = 'PENDING';
            $model->save();
            return redirect()->back()->withMsg('Successfully send request to admin');
        }else{
            return redirect()->back()->withErrors($model->errors)->withInput();
            // return response()->json($model->errors, 500);
        }
    }
    public function sendEmail(Request $r, SendQuoteOnEmail $send){
        $validator = Validator::make($r->all(), [
            'quote' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json($this->errorMessage($validator->errors()), 500);
        }
        $model = RequestedForQuote::find($r->id);
        $model->status = 'APPROVED';
        $model->replied_message = $r->quote;
        $model->save();
        $model->quote = $r->quote;
        $send->sendQuote($model);
        return response()->json($this->successMessage('Quote has been successfully send to email'));
    }
}
