<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Material;
use App\ServiceProvider\User;
use App\ServiceProvider\ServiceProviderMaterial;
use App\ServiceProvider\ServiceProviderService;
use App\ServiceProvider\ServiceProviderBidPost;
use App\Admin\ServiceProviderLoadAmount;
use App\Mails\RegisterMail;
use App\Http\Controllers\Controller;

class ServiceProviderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.service_provider.users');
    }
    public function requestIndex() {
        //$models = Material::all();
        return view('admin.service_provider.user_request');
        }
    public function requestData(Request $r){
            $data = $this::data($r, 2);
            return $data;
    }
    public function authorizedUserData(Request $r){
        $data = $this::data($r, $r->status);
        return $data;
    }
    public function data(Request $request, $status) {
        $model = new User();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = User::select('service_provider_users.id','contact_name','company_name','b.id as badge_id','b.name as badge','email','mobile','d.district_name','service_provider_users.status','service_provider_users.created_at')->leftJoin('batches as b','b.id','=','badge')->leftjoin('district as d','d.id','=','service_provider_users.district')->where('status', $status);
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry,['*'],'page', $page);
        } else {
            $rwrd = $rwrd->where('sp.contact_name', 'LIKE', "%$search%")->orwhere('sp.email', 'LIKE', "%$search%")->orwhere('sp.mobile', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }
    public function userDetails($userid){
        // return $userid;
        $category = User::find($userid)->service_category;
        $data = $this::getUserInfo($userid);
        $mModel = new ServiceProviderMaterial();
        $sModel = new ServiceProviderService();
         if($category == 'M'){
            $data->materials = $mModel->getUserDetails($userid);
             
         }elseif($category == 'S'){
            $data->services = $sModel->getUserDetails($userid);
         }else{
            $data->materials = $mModel->getUserDetails($userid);
            $data->services = $sModel->getUserDetails($userid);
         }
        return response()->json($data);
    }
    public function getUserInfo($userid){
        $district = new \App\BaseModel();        
        $user = User::select('contact_name','company_name','v.name as category','company_email','company_address','reg_date','reg_num','vat_no','email','mobile','district','address as user_address','owner_name')->leftjoin('vendor_category as v','v.id','=','service_provider_users.vendor_type')->find($userid);
        $user->district = $district->getDistrict(['district_name'], ['id' => $user->district])->district_name;
        return $user;
    }
    public function approvePost(Request $r, $postid){
        $model = new ServiceProviderBidPost();
        $rows = $model->getInsertValue($r);
        $status = ServiceProviderBidPost::insert($rows);
        if($status == true){
            $data = ClientPost::find($postid);
            $data->status = 1;
            if($data->save()){
                return response()->json($this->successMessage('Post has been approved'));
            }else{
                return response()->json($this->errorMessage('Error on server, try again!!'), 500);
            }        
        }else{
            return response()->json($this->errorMessage('Server Error'), 500);
        }
    }
    public function rejectPost($postid){
        $data = ClientPost::find($postid);
        $data->status = 2;
        if($data->save()){
            return response()->json($this->successMessage('Post has been rejected'));
        }else{
            return response()->json($this->errorMessage('Error on server, try again!!'), 500);
        }
    }
    public function loadAmount(Request $r){
        $model = new ServiceProviderLoadAmount();
        if ($model->validate($r->all())) {
            $model->fill($r->all());
            if($model->save()){
                return response()->json($this->successMessage());
            }else{
                return response()->json($this->errorMessage('Server Error'), 500);
            }

        } else {
            return response()->json($model->errors, 500);
        }
    }
    public function approveUser($userid, Request $r, RegisterMail $mail){
        // return $r->all();
        $model = User::find($userid);
        $model->status = 0;
        $model->badge = $r->badge;
        if($model->save()){
            $mail->sendRegisterEmail($model);
            return response()->json($this->successMessage('Email has been send to User.'));
        }
        return response()->json($this->errorMessage('Server Error'), 500);
    }
    public function rejectUser($userid, RegisterMail $mail){
       $model = User::find($userid);
        $model->status = 3;
        if($model->save()){
            $mail->sendRegisterEmail($model);
            return response()->json($this->successMessage('User Rejected! Email has been send to User.'));
        }
        return response()->json($this->errorMessage('Server Error'), 500); 
    }
    public function updateBadge($userid, Request $r){
        $model = User::find($userid);
        $model->badge = $r->badge;
        $model->save();
        return response()->json($this->successMessage('Badge has been updated on this user.'));
    }

    public function activateUser($userId){
        $model = User::find($userId);
        $model->status = 1;
        if($model->save()){
            return response()->json($this->successMessage('Selected User is successfully deactivated'));
        }else{
            return response()->json($this->errorMessage('Server Error'), 500);
        }
    }
    public function deactivateUser($id){
        $model = User::find($id);
        $model->status = 4;
        if($model->save()){
            return response()->json($this->successMessage('Selected User is successfully deactivated'));
        }else{
            return response()->json($this->errorMessage('Server Error'), 500);
        }
    }
}
