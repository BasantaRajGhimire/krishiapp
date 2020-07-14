<?php

namespace App\Http\Controllers\Buyer;

use App\Admin\MaterialBrand;
use App\Admin\MaterialType;
use App\Admin\ServiceType;
use App\Buyer\ClientPost;
use App\Buyer\ClientPostMaterial;
use App\Buyer\ClientPostService;
use App\ServiceProvider\ServiceProviderWinClientPost;
use App\Buyer\EscrowSystemClientPhaseWisePayment;
use App\Buyer\EscrowSystemClientDepoDetails;
use App\ServiceProvider\EscrowSystemServiceProviderPhaseWisePayment;
use App\Admin\EscrowSystemClientCancelServiceProviderPaymentRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Material;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ClientPostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $material = Material::all();
        $serviceType = ServiceType::all();
        return view('client.client_post')->with('material', $material)->with('serviceType', $serviceType);
    }

    public function activityIndex()
    {
        $userid = session('cuserid');
        $posts = new ClientPost();
        $posts = $posts->getAllPost($userid);
        // return $posts;
        return view('client.activity')->with('posts', $posts);
    }

    public function showList(Request $request)
    {
        return view('admin.material_brand.list');
    }

    public function listData(Request $request)
    {
        $model = new MaterialBrand();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = DB::table($model->getTable() . ' as mb')->select('mb.id', 'mi.name', 'mt.material_type_name', 'mb.brand_name', 'mb.amount')->join('material_items as mi', 'mi.id', '=', 'mb.material_id')->join('material_types as mt', 'mt.id',
            '=', 'mb.material_type_id');
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = DB::table($model->getTable())->where('mi.name', 'LIKE', "%$search%")->orwhere('mt.material_type_name', 'LIKE', "%$search%")->orwhere('mb.brand_name', 'LIKE', "%$search%")->orwhere('mb.amount', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $clientPost = new ClientPost();
        $clientMaterial = new ClientPostMaterial();
        $clientService = new ClientPostService();
        $reqClientPost = $request->except(['_token']);

        $key = '';
        $val = '';

        // validation
        if ($request->hasFile('doc')) {
            $this->validate($request, [
                'category' => 'required|string',
                'description' => 'required|string|max:200',
                'doc' => 'mimes:doc,docx,xls,xlsx,ppt,pptx,txt,pdf'
            ]);
        } else {
            if ($request->category == 'M') {
                if (!$clientMaterial->validate($request->all())) {
                    $errors = $clientMaterial->errors;
                    return redirect()->back()->withErrors($clientMaterial->errors)->withInput();
                }
            } else if ($request->category == 'S') {
                if (!$clientService->validate($request->all())) {
                    $errors = $clientMaterial->errors;
                    return redirect()->back()->withErrors($clientMaterial->errors)->withInput();
                }
            }
        }
        do {
            if ($request->category == 'M') {
                $clientPost->fill($reqClientPost);
                $clientPost->client_id = session('cuserid');
                $clientPost->duration_days = $request->duration_days ?? 5;
                $clientPost->expired_at = Carbon::now()->addDays($request->duration_days ?? 5);
                $clientPost->status = 0;
                if ($clientPost->save()) {
                    $clientMaterial->fill($reqClientPost);
                    $clientMaterial->client_id = $clientPost->client_id;
                    $clientMaterial->post_id = $clientPost->id;
                    $clientMaterial->material_id = $request->material_id ?? 0;
                    $clientMaterial->material_type_id = $request->material_type_id ?? 0;
                    $clientMaterial->brand_id = $request->brand_id ?? 0;
                    $clientMaterial->quantity = $request->quantity ?? 0;
                    $clientMaterial->status = 0;
                    $clientMaterial->save();

                    $key = 'success';
                    $val = 'Your Post has been submited to admin. Our team will reply within 24 hours';
                    break;

                } else {
                    $key = 'msg';
                    $val = 'Server Error';
                    break;
                }
            } else if ($request->category == 'S') {
                // return 'ok';
                $reqClientPost = $request->except(['_token']);
                $clientPost->fill($reqClientPost);
                $clientPost->client_id = session('cuserid');
                $clientPost->status = 0;
                $clientPost->duration_days = $request->duration_days ?? 5;
                $clientPost->expired_at = Carbon::now()->addDays($request->duration_days ?? 5);
                if ($clientPost->save()) {
                    $clientService->fill($reqClientPost);
                    $clientService->status = 0;
                    $clientService->client_id = $clientPost->client_id;
                    $clientService->post_id = $clientPost->id;
                    $clientService->save();

                    $key = 'success';
                    $val = 'Your Post has been submitted to admin. Our team will reply within 24 hours';
                    break;
                } else {
                    $key = 'msg';
                    $val = 'Server Error';
                    break;
                }
            }
        } while (0);
        //Handle File Upload
        if ($request->hasFile('doc')) {
            $file = $request->file('doc');
            $groupId = $clientPost->file_id == 0 ? 0 : $clientPost->file_id;
            $fileId = $this->manageUploads($file, 'client_posts', $groupId);
            $clientPost->file_id = $fileId;

            $clientPost->save();
        }

        return back()->with($key, $val);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        $model = MaterialBrand::find($id);
        return response()->json($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //return $request;
        $model = new MaterialBrand();
        if ($model->validate($request->all())) {
            $model = MaterialBrand::find($id);
            $req = $request->except(['_token']);
            $model->fill($req);
            $model->save();
            return response()->json($this->successMessage());
        } else {
            //   return redirect()->back()->withErrors(['errors' => $model->errors])->withInput();
            return response()->json($this->errorMessage($model->errors), 500);
        }
    }

    public function activateEscrowSystem(Request $r){
        // return $r->all();
        $winPost = ServiceProviderWinClientPost::find($r->id);
        if(!empty($winPost) && ($winPost->post_id == $r->postid)){
            $i= 1;
            for($i;$i<5;$i++ ){
                $client[]=[
                    'client_id'=> $winPost->client_id,
                    'post_id' =>$winPost->post_id,
                    'total_amount' => intVal($winPost->amount/4),
                    'deposit_amount' => 0,
                    'remaining_amount' => intVal($winPost->amount/4),
                    'phase' => config('constants.escrow_system.phase.'.$i),
                    'status' => 'Pending',

                ];
                $serviceProvider[] = [
                    'service_provider_id' => $winPost->service_provider_id,
                    'post_id' => $winPost->post_id,
                    'total_amount' => intVal($winPost->amount/5),
                    'withdraw_amount' => 0,
                    'remaining_amount' => intVal($winPost->amount/5),
                    'phase' => config('constants.escrow_system.phase.'.$i),
                    'status' => 'Pending',
                ];
            }
            // return $serviceProvider;
            $client[3]['total_amount'] += ($winPost->amount % 4);
            $client[3]['remaining_amount'] += ($winPost->amount % 4);
            $serviceProvider[3]['total_amount'] += $serviceProvider[3]['total_amount'] + ($winPost->amount % 5);
            $serviceProvider[3]['remaining_amount'] += $serviceProvider[3]['remaining_amount'] + ($winPost->amount % 5);            
            $row = [
                'user_id' => $winPost->service_provider_id,
                'user_table' => 'V',
                'title' => 'Client activated escrow system for payment phase.',
                'type' => 'Escrow System Activated',
                'url' => 'post/'.$winPost->post_id,
            ];
            DB::beginTransaction();
            try{
                DB::table('support_messages')->insert($row);
                DB::table('escrowsystem_client_phase_wise_payment')->insert($client);
                DB::table('escrowsystem_serviceprovider_phase_wise_payment')->insert($serviceProvider);
                DB::commit();
                return response()->json($this->successMessage());
                }
            catch(\Exception $e){
                DB::rollback();
                return response()->json($this->errorMessage('Server Error'), 500);

            }
        }else{
            return response()->json($this->errorMessage('Invalid Token Mismatched'),500);
        }
    }
    public function cancelEscrowSystem($postid, Request $r){
        // return $r->all();
        $check = EscrowSystemClientPhaseWisePayment::find($r->escrow_id);
        if(!empty($check) && $check->post_id == $postid){            
            DB::beginTransaction();
            try{
                EscrowSystemClientPhaseWisePayment::where('post_id', $postid)->delete();
                EscrowSystemServiceProviderPhaseWisePayment::where('post_id', $postid)->delete();
                DB::commit();
                // return 'ok';
                return redirect()->back()->withMsg('Successfully cancelled ecsrow system.');
            }catch(Exception $e){
                DB::rollBack();
                return 'ok';
                return redirect()->back()->withErr('Something error occurs. Try again!!');
            }
        }
    }
    public function directReleasePaymentOrder(Request $r){
        $model = EscrowSystemServiceProviderPhaseWisePayment::find($r->espid);
        if($model->post_id == $r->postid){
            $model->is_approved = 1;
            if($model->save()){
            return response()->json($this->successMessage('payment has been confirmed from you.So, admin will release payment.'));
            }else{
                return response()->json($this->errorMessage('Server doesnot respond, Try again later'), 500);
            }
        }
    }
    public function paymentForEscrowSystem(Request $r){     

        // return $r->all();    
        $model = new EscrowSystemClientDepoDetails();
        if ($model->validate($r->all())) { 
           DB::beginTransaction();
            try{
        //         $model = EscrowSystemClientWinPostServiceProvider::where('win_id', $r->win_id)->where('post_id',$r->post_id)->first();
        //        //return $model;
                if(isset($r->status)){
                    EscrowSystemServiceProviderPhaseWisePayment::where('post_id', $r->post_id)->where('status', 'Request')->where('is_approved', 0)->update(['is_approved' => 1]);
                }
                $file = $r->payment_slip;  
                $originalFile = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $namefile = 'payment-slip'.(new \Datetime())->format('U').'-'.$r->win_id.'.'.$extension;
                $save = $file->storeAs(
                            'payment-slip',$namefile ,'file-repo'
                        );
                $model->fill($r->except(['_token','payment_slip']));
                $model->payment_slip = $namefile;
                $model->save();
        //        $update = EscrowSystemClientWinPostServiceProvider::find($model->id);
        //         $update->amount_deposit = $model->amount_deposit + $r->amount_deposit;
        //         $update->status = 'COM';
        //         $update->save();
        //         // return response()->json($update, 500);
        //         DB::table('escrowsystem_client_depo_details')->insert([
        //                         'eswid' => $update->id ?? 5,
        //                         'payment_slip' => $namefile,
        //                         'amount_deposit' => $r->amount_deposit,
        //                         'deposit_from' => $r->deposit_from,
        //         ]);
                DB::commit();
                return response()->json('Your payment request has been successfully send to admin. We will approve it within 2 days.'); 
            }catch(\Exception $e){
               DB::rollback();
               return response()->json('Server Error! Try again', 500);
            }
        }else{
            return response()->json($this->errorMessage($model->errors), 500);
        }
    }

    public function cancelPaymentRequest(Request $r){
        $validation = Validator::make($r->all(),[
            'client_comment' => 'required|string',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors(), 500);
        }else{
            $model = new EscrowSystemClientCancelServiceProviderPaymentRequest();
            $postid = $r->postid;
            $id = $r->phaseid;
            $check = EscrowSystemServiceProviderPhaseWisePayment::find($id);
            if(!empty($check) && $check->post_id == $postid){
                // return 'ok';
                DB::beginTransaction();
                try{
                    $model->espid = $id;
                    $model->post_id = $postid;
                    $model->phase = $r->phase;
                    $model->client_comment = $r->client_comment;
                    $model->save();
                    $check->is_approved = 2;
                    $check->save();
                    $row = [
                        'user_id' => $check->service_provider_id,
                        'user_table' => 'V',
                        'title' => 'Client has rejected your payment request',
                        'type' => 'Payment Request has been rejected',
                        'url' => 'post/'.$postid,
                    ];
                    DB::table('support_messages')->insert($row);
                    DB::commit();
                    return response()->json($this->successMessage('Your request cancel message has been send to vendor.'));
                }catch(\Exception $e){
                    DB::rollback();
                    return response()->json($this->errorMessage('Sorry, Server Error!!'), 500);
                }
            }else{
                return response()->json($this->errorMessage('Data Request Mismatch'), 500);
            }
            return $check;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Request $request, $id)
    {
        $model = MaterialBrand::find($id);
        if ($model->delete()) {
            return response()->json($this->successMessage());
        } else {
            return response()->json($this->errorMessage($model->errors), 500);
        }
    }

    public
    function getTypesFromItem($materialid)
    {
        $model = MaterialType::where('material_id', $materialid)->get();
        return response()->json($model);
    }

}
