<?php

namespace App\Admin;

use App\BaseModel;

class ImageSlider extends BaseModel
{
    protected $primaryKey='id';
	protected $table = "frontend_imagesliders";
	public $timestamps = true;
	protected $fillable = ['title','banner_image','description'];
	public $rules = [
            'title' => 'required|string',
            'description' => 'required|string',
         	'banner_image' => 'required|mimes:jpeg,jpg,png,pdf',
	];
}
