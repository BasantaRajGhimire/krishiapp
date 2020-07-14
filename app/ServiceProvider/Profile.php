<?php

namespace App\ServiceProvider;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'service_provider_profile';

    public function user(){
        return $this->belongsTo('\App\ServiceProvider\User', 'service_provider_id', 'id');
    }
}
