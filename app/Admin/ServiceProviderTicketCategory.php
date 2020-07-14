<?php

namespace App\Admin;

use App\BaseModel;

class ServiceProviderTicketCategory extends BaseModel
{
    protected $primaryKey='id';
	protected $table = "serviceprovider_ticket_category";
	public $timestamps = false;
	protected $fillable = ['name'];
	protected $rules = [
            'name' => 'required|string',
	];
}
