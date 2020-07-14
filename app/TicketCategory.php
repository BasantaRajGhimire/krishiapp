<?php

namespace App;
use App\BaseModel;
class TicketCategory extends BaseModel
{
	protected $primaryKey='id';
	protected $table = "ticket_categories";
	public $timestamps = false;
	protected $fillable = ['name'];
	protected $rules = [
            'name'=>'required|string',
	];
        
}

