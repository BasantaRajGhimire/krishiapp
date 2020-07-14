<?php

namespace App\Admin;

use App\BaseModel;

class ClientTicketCategory extends BaseModel
{
    protected $primaryKey='id';
	protected $table = "client_ticket_category";
	public $timestamps = false;
	protected $fillable = ['name'];
	protected $rules = [
            'name' => 'required|string',
	];
}
