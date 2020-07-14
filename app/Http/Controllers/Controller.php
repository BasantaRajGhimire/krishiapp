<?php

namespace App\Http\Controllers;

use App\Upload;
use App\UploadGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function errorMessage($message = null, $title = null, $callback = null)
    {
        if ($title == null) {
            $title = "Error";
        }
        if ($message == null) {
            $message = "Operation failed.";
        }
        return $this->prepareMessage(0, $title, $message, $callback);
    }

    public function successMessage($message = null, $title = null, $callback = null)
    {
        if ($title == null) {
            $title = "Success";
        }
        if ($message == null) {
            $message = "Operation Successful.";
        }
        return $this->prepareMessage(1, $title, $message, $callback);
    }

    public function warningMessage($message = null, $title = null)
    {
        if ($title == null) {
            $title = "Warning";
        }
        if ($message == null) {
            $message = "Operation succeeded with warning.";
        }
        return $this->prepareMessage(2, $title, $message);
    }

    public function infoMessage($message = null, $title = null)
    {
        if ($title == null) {
            $title = "Info";
        }
        if ($message == null) {
            $message = "";
        }
        return $this->prepareMessage(3, $title, $message);
    }

    public function prepareMessage($status, $title, $message, $callBack = null)
    {
        $messageArray = [
            'status' => $status,
            'title' => $title,
            'message' => $message
        ];
        if (!empty($callBack)) {
            $messageArray['callback'] = $callBack;
        }
        return $messageArray;
    }

    public function standardMessages()
    {
        return [
            'item_added' => '',
            'item_updated' => '',
            'item_deletd' => '',
            'item_add_failed' => '',
            'item_update_failed' => '',
            'item_delete_failed' => ''
        ];
    }

    public function getMpdfInstance()
    {
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                public_path('fonts'),
            ]),
            'fontdata' => $fontData + [
                    'nirmala' => [
                        'R' => 'nirmala.ttf',
                        'B' => 'nirmalab.ttf',
                        'useOTL' => 0xFF,
                    ],
                    'kalimati' => [
                        'R' => 'kalimati.ttf',
                    ]
                ]
        ]);

        $mpdf->allow_charset_conversion = true;
        return $mpdf;
    }

    public function manageUploads($image, $savepath, $gid = "")
    {
        if ($gid == "" || $gid == null || $gid == 0) {
            $maxGroupId = UploadGroup::max('group_id');
            $gid = $maxGroupId + 1;
        } else {
            $gid = $gid;
        }

        $savepathgid = $savepath . '/' . $gid;
        // if (!Storage::directories($savepathgid)) {
        //     Storage::makeDirectory($savepathgid, 0777, true);
        // }
        $original_filename = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $upload_size = $image->getClientSize();
        $name = 'client_posts'.(new \Datetime())->format('U').'.'.$extension;;

        $image->storeAs(
                        'client_posts',$name ,'file-repo'
                    );

        $uploadData['filename'] = $name;
        $uploadData['original_filename'] = $original_filename;
        $uploadData['filebasepath'] = $savepath;
        $uploadData['filepath'] = $savepathgid;
        $uploadData['upload_type'] = $extension;
        $uploadData['upload_size'] = $upload_size;
        if ($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "PNG" || $extension == "JPG" || $extension == "JPEG" || $extension == "gif" || $extension == "GIF") {
            $uploadData['mime_type'] = "image";
        } else {
            $uploadData['mime_type'] = "doc";
        }

        $upload = Upload::create($uploadData);


        $uploadGroupData['group_id'] = $gid;
        $uploadGroupData['upload_id'] = $upload->id;

        $uploadgroups = UploadGroup::create($uploadGroupData);

        return $uploadgroups->group_id;

    }

    //deletes previous images takes an instance of model (For E.g. Profile, Notice)
    public function deleteUploads($obj)
    {
        foreach ($obj->upload_groups as $upload_group) {
            Storage::delete($upload_group->upload->filepath . '/' . $upload_group->upload->filename);

            //delete record of previous image
            $upload_group->upload->delete();
            $upload_group->delete();

            //delete directory if empty
            if (!Storage::files($upload_group->upload->filepath)) {
                Storage::deleteDirectory($upload_group->upload->filepath);
            }

        }
        return 1;
    }
    public function spaceToDashConverter($string){
        $url = explode(' ',$string);
        $val = '';
        if(count($url) > 1){
            foreach ($url as $key => $value) {
                if($key == count($url)-1){
                    $val .= $value;
                }else{
                    $val .= $value.'-';
                }
            }
            $dashString = strtolower($val);
        }else{
            $dashString = strtolower($url[0]);
        }
        return $dashString;
    }

}
