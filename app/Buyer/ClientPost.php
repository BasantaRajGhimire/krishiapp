<?php

namespace App\Buyer;

use App\BaseModel;

class ClientPost extends BaseModel
{
    protected $primaryKey = 'id';
    protected $table = "client_post";
    protected $dates = ['created_at', 'expired_at'];
    public $timestamps = false;
    protected $fillable = ['category', 'district', 'address', 'estimated_cost', 'duration_days', 'description', 'file_id'];
    protected $rules = [
        'category' => 'required|string',
        'district' => 'required|string',
        'address' => 'required|string',
        'description' => 'required|string|max:200',
    ];

    public function countPost($status = [])
    {
        if (empty($status)) {
            $count = $this::where('client_id', session('cuserid'))->count();
        } else {
            $count = $this::where('client_id', session('cuserid'))->whereIn('status', $status)->count();
        }
        return $count;
    }

    public function latestPost($postid = null)
    {
        $district = new \App\BaseModel();
        $model = $this::where('client_id', session('cuserid'))->orderBy('created_at', 'desc')->first();
        if (!empty($model)) {
            $model->district = $district->getDistrict(['district_name'], ['id' => $model->district])->district_name;
            $model->status = $this::getStatus($model->status);
        }
        return $model;
    }

    public function getClientPost($limit = null, $status = [])
    {
        $model = $this::where('client_id', session('cuserid'));
        if (!empty($status)) {
            $model = $model->whereIn('status', $status);
        }
        return $model->orderBy('created_at', 'desc')->limit($limit)->get();
    }

    public function getStatus($num)
    {
        $status = $num == 0 ? 'Pending' : ($num == 1 ? 'Approved' : ($num == 2 ? 'Rejected' : ($num == 3 ? 'Completed' : ($num == 4 ? 'Expired' : 'Delivered'))));
        return $status;
    }

    public function getAllPost($userid)
    {
        $pendingPost = ClientPost::where('client_id', $userid)->where('status', 0)->get();
        $approvedPost = ClientPost::where('client_id', $userid)->where('status', 1)->get();
        $rejectedPost = ClientPost::where('client_id', $userid)->where('status', 2)->get();
        $awardedPost = ClientPost::where('client_id', $userid)->where('status', 3)->get();
        $onDeliveryPost = ClientPost::where('client_id', $userid)->where('status', 5)->get();
        $data = ['pendingPost' => $pendingPost, 'approvedPost' => $approvedPost, 'rejectedPost' => $rejectedPost, 'awardedPost' => $awardedPost, 'onDeliveryPost' => $onDeliveryPost];
        return $data;
    }

    public function service_provider_bid_posts()
    {
        return $this->hasMany('\App\ServiceProvider\ServiceProviderBidPost', 'post_id', 'id');
    }

    public function upload_groups()
    {
        return $this->hasMany('App\UploadGroup', 'group_id', 'file_id');
    }

    public function getFileInfo()
    {
        $filepath = '';
        if ($this->file_id) {
            foreach ($this->upload_groups as $upload_group) {
                $file = $upload_group->upload;

                if ($file) {
                    $filepath = url('/').'/'.$file->filebasepath.'/'.$file->filename;
                    $originalFilename = $file->original_filename;
                }
            }
        }
        return [
            'filepath' => $filepath,
            'originalFilename' => $originalFilename,

        ];
    }

}

