<?php

namespace App\ServiceProvider;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class UserPenalty extends BaseModel
{
    public $timestamps=false;
    public $primaryKey = 'id';
    public $table = 'serviceprovider_penalty_for_newbid';
    // protected $fillable = ['contact_name','company_name','mobile','email','provider_type','district','address','website','have_branches','description'];
    // protected $rules = [
    //      'amount_deposit' => 'required|integer',
    //      'deposit_from' => 'required|string',
    //      'payment_slip' => 'required|mimes:jpeg,jpg,png,pdf',
    //     ]; 
}