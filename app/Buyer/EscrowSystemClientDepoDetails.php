<?php

namespace App\Buyer;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class EscrowSystemClientDepoDetails extends BaseModel
{
    public $timestamps=false;
    public $primaryKey = 'id';
    public $table = 'escrowsystem_client_depo_details';
    protected $fillable = ['post_id','voucher_id','amount_deposit','deposit_from','payment_slip'];
    protected $rules = [
    	'voucher_id' => 'required|string',
	    'amount_deposit' => 'required|integer',
	    'deposit_from' => 'required|string',
	    'payment_slip' => 'required|mimes:jpeg,jpg,png,pdf',
    ]; 
}