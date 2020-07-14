<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadGroup extends Model
{
    protected $guarded = [];

    public function upload(){
        return $this->hasOne('App\Upload', 'id', 'upload_id');
    }
}
