<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class EscrowSystemServiceProviderGetPaymentDetails extends BaseModel
{
    public $timestamps=false;
    public $primaryKey = 'id';
    public $table = 'escrowsystem_serviceprovider_getpayment_details';
    protected $fillable = ['post_id','voucher_id','deposit_amount','deposit_from','payment_slip'];
    protected $rules = [
    	'voucher_id' => 'required|string',
	    'deposit_amount' => 'required|integer|min:0',
	    'deposit_from' => 'required|alpha_words',
	    'payment_slip' => 'required|mimes:jpeg,jpg,png,pdf',
    ]; 
}