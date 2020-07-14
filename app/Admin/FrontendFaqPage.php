<?php

namespace App\Admin;
use App\BaseModel;
class FrontendFaqPage extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "frontend_faqpage";
	public $timestamps = false;
	protected $fillable = ['question_number','question','answer'];
	protected $rules = [
			'question_number' => 'required|unique:frontend_faqpage,question_number',
            'question'=>'required|string',
            'answer' => 'required|string',
	];
        
}

