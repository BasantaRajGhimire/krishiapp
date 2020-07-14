<?php

namespace App;
use App\BaseModel;
class MenuSetup extends BaseModel
{
	protected $primaryKey='menu_id';
	protected $table = "menus";
	public $timestamps = false;
	protected $fillable = ['menu_parent_id','menu_name','menu_url','menu_icon','menu_order'];
	protected $rules = [
			'menu_parent_id' =>'required|string',
            'menu_name'=>'required|string',
            'menu_url'=>'string|nullable',
            'menu_icon' =>'string|nullable',
            'menu_order' => 'string|nullable',
	];
        
}

