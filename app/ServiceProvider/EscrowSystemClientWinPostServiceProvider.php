<?php

namespace App\ServiceProvider;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class EscrowSystemClientWinPostServiceProvider extends BaseModel
{
    public $timestamps=false;
    public $primaryKey = 'id';
    public $table = 'escrowsystem_client_winpost_serviceprovider';
    // protected $fillable = ['contact_name','company_name','mobile','email','provider_type','district','address','website','have_branches','description'];
    protected $rules = [
    	 'voucher_id' => 'required|string',
         'amount_deposit' => 'required|integer',
         'deposit_from' => 'required|string',
         'payment_slip' => 'required|mimes:jpeg,jpg,png,pdf',
        ]; 
}