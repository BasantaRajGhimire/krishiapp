<?php

namespace App\Buyer;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class EscrowSystemClientPhaseWisePayment extends BaseModel
{
    public $timestamps=false;
    public $primaryKey = 'id';
    public $table = 'escrowsystem_client_phase_wise_payment';
     
}