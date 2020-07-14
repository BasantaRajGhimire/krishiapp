<?php

namespace App\Admin;

use App\BaseModel;
use Carbon\Carbon;

class RequestedForQuote extends BaseModel
{
    // public $timestamps=false;
    public $table = 'requested_for_quotes';
    protected $fillable = ['product_name','user_name','mobile','email_address','description','status'];
    public $rules = [
         'product_name' => 'string|required',
         'user_name' => 'required|string',
         'mobile' => 'required|integer|digits:10',
         'email_address' => 'required|email',
         'description' => 'required|string|max:200',
        ];
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('d M, Y H:m:s');
    }
    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->format('d M, Y H:m:s');
    }
}
