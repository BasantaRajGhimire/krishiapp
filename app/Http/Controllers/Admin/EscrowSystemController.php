<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Buyer\CLientPost;
use App\Buyer\ClientUsers;
use App\Buyer\EscrowSystemClientPhaseWisePayment;
use App\ServiceProvider\EscrowSystemClientWinPostServiceProvider;
use App\ServiceProvider\EscrowSystemServiceProviderPhaseWisePayment;
use App\Admin\EscrowSystemClientCancelServiceProviderPaymentRequest;
use App\Admin\EscrowSystemServiceProviderGetPaymentDetails;
use App\Buyer\EscrowSystemClientDepoDetails;
use App\Http\Controllers\Controller;

class EscrowSystemController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRequestLoadAmount() {
        //$models = Material::all();
        return view('admin.escrow_system.request_load_amount');
    }
    public function indexApprovedAmountLoaded(){
        return view('admin.escrow_system.request_amount_for_release');
    }
    public function noResponsePaymentIndex(){
        return view('admin.escrow_system.no_response_payment');
    }
    public function joinTableQuery($model){
        $rwrd = DB::table($model->getTable().' as esw')->select('esw.id','esw.voucher_id','esw.post_id','esw.amount_deposit','cp.description','cu.name','esw.deposit_from','esw.payment_slip')->leftjoin('client_post as cp','cp.id','=','esw.post_id')->leftjoin('client_users as cu','cu.id','=','cp.client_id')
            ->where('esw.status','PENDING');
        return $rwrd;
    }
    public function joinServiceProviderAmountTableQuery($model){
        $rwrd = DB::table($model->getTable().' as esw')->select('esw.id','esw.post_id','esw.total_amount','esw.phase','cp.description','cu.name','spu.contact_name')->leftjoin('client_post as cp','cp.id','=','esw.post_id')->leftjoin('client_users as cu','cu.id','=','cp.client_id')->leftjoin('serviceprovider_win_clientpost as spwcp','spwcp.post_id','=','cp.id')->leftjoin('service_provider_users as spu','spu.id','=','spwcp.service_provider_id')
            ->where('esw.status','Request')
            ->where('esw.is_approved', 1);
        return $rwrd;
    }

    public function joinClientPostPaymentCancelTable($model){
        $rwrd = DB::table($model->getTable().' as escp')->select('escp.id','escp.post_id','escp.espid','escp.client_comment','escp.serviceprovider_comment','escp.phase','cp.description')->leftjoin('client_post as cp','cp.id','=','escp.post_id')->where('escp.is_solved',0);
        return $rwrd;
    }
    public function requestListData(Request $request) {
        $model = new EscrowSystemClientDepoDetails();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = $this::joinTableQuery($model);
        //$rwrd = $rwrd->where('ecd.status','PENDING');
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = DB::table($model->getTable())->where('esw.post_id', 'LIKE', "%$search%")->orwhere('cu.name', 'LIKE', "%$search%")->orWhere('spu.contact_name','LIKE','%$search%')->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }
    public function approvedRequestAmountListData(Request $request) {
        $model = new EscrowSystemServiceProviderPhaseWisePayment();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = $this::joinServiceProviderAmountTableQuery($model);
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = DB::table($model->getTable())->where('esw.post_id', 'LIKE', "%$search%")->orwhere('cu.name', 'LIKE', "%$search%")->orWhere('spu.contact_name','LIKE','%$search%')->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }

    public function noResponsePaymentListData(Request $request){
        $model = new EscrowSystemClientCancelServiceProviderPaymentRequest();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = $this::joinClientPostPaymentCancelTable($model);
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = DB::table($model->getTable())->where('escp.post_id', 'LIKE', "%$search%")->orwhere('cu.name', 'LIKE', "%$search%")->orWhere('spu.contact_name','LIKE','%$search%')->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }
    public function updateInfo(Request $r){
        // return $r->all();
        DB::beginTransaction();
        try{
            DB::table('escrowsystem_client_depo_details')->where('id',$r->eswid)->where('post_id', $r->ecdid)->update(['voucher_id' => $r->voucher_id,'amount_deposit' => $r->amount_deposit,'deposit_from' => $r->deposit_from]);
           DB::commit();
            return response()->json($this->successMessage('Succesfully Updated'));
        }catch(\Exception $e){
           DB::rollback();
           return response()->json('Server Error', 500);
        }
    }

    public function approveLoadAmount($ecdid){
        $update = EscrowSystemClientDepoDetails::find($ecdid);
        $Model = new EscrowSystemClientPhaseWisePayment();
        $clientPayment = EscrowSystemClientPhaseWisePayment::where('post_id', $update->post_id)->get();
        $depositAmount = $update->amount_deposit;
        $update->status = 'APPROVED';
        DB::beginTransaction();
        try{
            $update->save();
            foreach($clientPayment as $k => $v){
                if($depositAmount > 0 && ($v->status =='Pending' || $v->status=='Processing')){
                    $rows[] = [
                                'esp_id' =>$v->id,
                                'payment_file_id' => $update->id,
                            ];
                    if($depositAmount >= $v->remaining_amount){
                        $row = EscrowSystemClientPhaseWisePayment::find($v->id);
                        $row->deposit_amount = $v->total_amount;
                        $row->remaining_amount = 0;
                        $row->status = 'Completed';
                        $row->save();
                        $depositAmount = $depositAmount - $v->remaining_amount;
                    }else{
                        $row = EscrowSystemClientPhaseWisePayment::find($v->id);
                        $row->deposit_amount = $depositAmount;
                        $row->remaining_amount = $v->total_amount - $depositAmount;
                        $row->status = 'Processing';
                        $row->save();
                        $depositAmount = 0;
                    }
                }
            }
           DB::table('escrowsystem_clientpost_relation_paymentfile')->insert($rows);
            DB::commit();
            //return $rows;
            return response()->json($this->successMessage());
        }catch(\Exception $e){
            DB::rollback();
            return response()->json('Server Error Try Again', 500);
        }

    }
    public function rejectLoadAmount($ecdid){
        DB::beginTransaction();
        try{
            $update = EscrowSystemClientDepoDetails::find($ecdid);
            $update->status = 'REJECTED';
            $update->save();
            $userid = CLientPost::find($update->post_id)->client_id;
            $userToken = ClientUsers::find($userid)->remember_token;
            $row = [
                'user_id' => $userid,
                'user_table' => 'C',
                'title' => 'Your request has been canceled, please upload again.',
                'type' => 'Payment Request Rejected',
                'url' => 'client-post/'.$update->post_id.'?post_token='.$userToken,
            ];
            DB::table('support_messages')->insert($row);
            DB::commit();
            return response()->json($this->successMessage());
        }catch(\Exception $e){
            DB::rollback();
            return response()->json('Server Error Try Again', 500);
        }
    }

    public function releaseRequestBalance(Request $r){
    	// return response()->json($r->all(), 500);
    	$model = EscrowSystemServiceProviderPhaseWisePayment::find($r->request_id);
    	// return response()->json($model, 500);
    	if($model->post_id == $r->post_id){
    		$paymentDetails = new EscrowSystemServiceProviderGetPaymentDetails();
    		if($paymentDetails->validate($r->all())){
    			DB::beginTransaction();
    			try{
	    			$paymentDetails->fill($r->all());
	    			$paymentDetails->essppwp_id = $model->id;
	                $file = $r->payment_slip;  
	                $originalFile = $file->getClientOriginalName();
	                $extension = $file->getClientOriginalExtension();
	                $namefile = 'payment-slip'.(new \Datetime())->format('U').'-'.$r->win_id.'.'.$extension;
	                $save = $file->storeAs(
                            'payment-slip',$namefile ,'file-repo'
                        );
                	$paymentDetails->payment_slip = $namefile;
	    			$paymentDetails->save();
		    		$model->withdraw_amount = $model->remaining_amount;
		    		$model->remaining_amount = $model->remaining_amount - $model->withdraw_amount;
		    		$model->status = 'Released';

                    $row = [
                        'user_id' => $model->service_provider_id,
                        'user_table' => 'V',
                        'title' => 'Client requested amount has been released to your account',
                        'type' => 'Payment released',
                        'url' => 'post/'.$model->post_id,
                    ];
                    DB::table('support_messages')->insert($row);
		    		$model->save(); 
		    		DB::commit();
	    			return response()->json($this->successMessage('Succesfully Released Amount'));
	    		}catch(\Exception $e){
	    			DB::rollback();
	    			return response()->json($this->errorMessage('Server Error'), 500);
	    		}
    		}else{
    			return response()->json($this->errorMessage($paymentDetails->errors), 500);
    		}
    	}else{
    		return response()->json($this->errorMessage('Requested Data Invalid !!'), 500);
    	}
    }
    public function cancelPaymentRequest(Request $r){
        $check = EscrowSystemClientCancelServiceProviderPaymentRequest::find($r->id);
        if(!empty($check) && $check->post_id == $r->post_id && $check->espid == $r->espid){
            DB::beginTransaction();
            try{
                $check->is_solved = 1;
                $check->save();
                $model = EscrowSystemServiceProviderPhaseWisePayment::find($r->espid);
                $model->status = 'Pending';
                $model->is_approved = 0;
                $model->save();
                DB::commit();
                return response()->json($this->successMessage());

            }catch(\Exception $e){
                DB::rollback();
                return response()->json($this->errorMessage('Server Error !!'), 500);
            }
        }else{
            return response()->json($this->errorMessage('Provided Data Invalid'), 500);
        }
    }
    public function sendPaymentRequestAgain(Request $r){
        $check = EscrowSystemClientCancelServiceProviderPaymentRequest::find($r->id);
        if(!empty($check) && $check->post_id == $r->post_id && $check->espid == $r->espid){
            DB::beginTransaction();
            try{
                $check->is_solved = 1;
                $check->save();
                $model = EscrowSystemServiceProviderPhaseWisePayment::find($r->espid);
                $model->is_approved = 0;
                $model->save();
                DB::commit();
                return response()->json($this->successMessage());
            }catch(\Exception $e){
                DB::rollback();
                return response()->json($this->errorMessage('Server Error'), 500);
            }

        }else{
            return response()->json($this->errorMessage('Provided Data Mismatched!!'), 500);
        }
    }

}
