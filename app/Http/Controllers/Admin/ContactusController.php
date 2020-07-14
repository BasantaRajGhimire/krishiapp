<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Admin\ContactusForm;
use App\Http\Controllers\Controller;
use App\Mails\SendMessageFromContactUs;

class ContactusController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$models = Material::all();
        return view('admin.frontend.contactus-send');
        }
    public function listData(Request $request) {
        $model = new ContactusForm();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        if ($search == null) {
            $rwrd = ContactUsForm::where('status',$request->status)->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = DB::table($model->getTable())->where('name', 'LIKE', "%$search%")->orwhere('email', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }
    public function sendMailAndUpdateStatus(Request $r, SendMessageFromContactUs $send){
        // return $r->all();
        $validator = Validator::make($r->all(), [
            'message' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json($this->errorMessage($validator->errors()), 500);
        }
        $model = ContactusForm::find($r->id);
        $model->status = $r->status==1?'APPROVED':'REJECTED';
        $model->replied_message = $r->message;
        $model->save();
        $model->message = $r->message;
        $send->sendMessage($model);
        // return $model;
        return response()->json($this->successMessage('Message has been successfully send to email'));
    }

}
