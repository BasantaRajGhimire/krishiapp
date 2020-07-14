<?php

namespace App\Admin;

use App\BaseModel;

class ServiceProviderTicketTitle extends BaseModel
{
    protected $primaryKey='id';
	protected $table = "serviceprovider_ticket_title";
	public $timestamps = false;
	protected $fillable = ['name','category_id'];
	protected $rules = [
            'name'=>'required|string',
            'category_id' => 'required|string'
	];
}
