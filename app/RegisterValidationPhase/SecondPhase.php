<?php

namespace App\RegisterValidationPhase;
use App\BaseModel;
class SecondPhase extends BaseModel
{
	protected $rules = [            
        'reg_num' => 'required|integer|min:0',
        'reg_date' => 'required|date',
        'company_class' => 'required|string',
        'company_address' =>'required|string',
        'company_phone1' =>'required|digits_between: 8,10',
        'company_phone2' => 'required|digits_between: 8,10',
        'vat_no' => 'required|integer|min:0',
        'owner_name'=>'required_without:multiowner_name',
        'multiowner_name'=>'required_without:owner_name',
	];
        
}

