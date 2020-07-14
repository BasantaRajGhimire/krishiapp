<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class EscrowSystemClientCancelServiceProviderPaymentRequest extends BaseModel
{
    public $timestamps=false;
    public $primaryKey = 'id';
    public $table = 'escrowsystem_client_cancel_serviceprovider_paymentrequest';
    // protected $fillable = ['post_id','voucher_id','deposit_amount','deposit_from','payment_slip'];
    // protected $rules = [
    // 	'voucher_id' => 'required|string',
	   //  'deposit_amount' => 'required|integer',
	   //  'deposit_from' => 'required|string',
	   //  'payment_slip' => 'required|mimes:jpeg,jpg,png,pdf',
    // ]; 
}