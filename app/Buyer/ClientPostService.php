<?php

namespace App\Buyer;

use App\BaseModel;
use DB;

class ClientPostService extends BaseModel
{
    protected $primaryKey = 'id';
    protected $table = "client_post_services";
    public $timestamps = false;
    protected $fillable = ['service_type_id', 'service_id', 'land_area', 'no_of_storey', 'floor_space'];
    protected $rules = [
        'category' => 'required|string',
        'district' => 'required|string',
        'address' => 'required|string',
        'service_type_id' => 'required|string',
        'service_id' => 'required|string',
        'land_area' => 'required_if:service_id,2',
        'no_of_storey' => 'required_if:service_id,2',
        'floor_space' => 'required_if:service_id,2',
        'description' => 'required|string|max:200',
        'estimated_cost' => 'nullable|integer|min:1',
    ];

    public function getPostDetails($postid, $status = null)
    {
        $data = DB::table('client_post as cp')->select('cu.name as Client Name', 'cu.mobile as Phone Number', 'cu.email as Email', 'cp.category as Category', 'st.service_type_name as Service Type Name', 'as.name as Service','cpm.land_area','cpm.no_of_storey','cpm.floor_space', 'cp.estimated_cost as Estimated Cost', 'cp.duration_days as Duration Days', 'cp.address as Address', 'cp.description as Description', 'cp.created_at as PostedAt')
            ->join('client_post_services as cpm', 'cp.id', '=', 'cpm.post_id')
            ->join('client_users as cu', 'cu.id', '=', 'cp.client_id')
            ->join('service_types as st', 'st.id', '=', 'cpm.service_type_id')
            ->join('add_services as as', 'as.id', '=', 'cpm.service_id')
            ->where('cp.id', $postid)
            ->first();
        $data->Category = 'Service';
        $data->Description = '<p align="justify">' . $data->Description . '</p>';
        return $data;
    }
}

