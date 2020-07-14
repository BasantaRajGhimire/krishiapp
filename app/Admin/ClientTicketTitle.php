<?php

namespace App\Admin;

use App\BaseModel;
class ClientTicketTitle extends BaseModel
{
    protected $primaryKey='id';
	protected $table = "client_ticket_title";
	public $timestamps = false;
	protected $fillable = ['name','category_id'];
	protected $rules = [
            'name'=>'required|string',
            'category_id' => 'required|string'
	];
}
