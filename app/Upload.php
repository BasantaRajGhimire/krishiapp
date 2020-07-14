<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $guarded = [];

    public function upload_group(){
        return $this->belongsTo('App\UploadGroup', 'upload_id', 'id');
    }
}
