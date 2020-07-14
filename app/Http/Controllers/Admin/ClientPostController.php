<?php

namespace App\Http\Controllers\Admin;

use App\Admin\MaterialBrand;
use App\Admin\MaterialType;
use App\Admin\Service;
use App\Admin\ServiceType;
use App\Buyer\ClientPost;
use App\Buyer\ClientPostMaterial;
use App\Buyer\ClientPostService;
use App\District;
use App\Http\Controllers\Controller;
use App\Material;
use App\ServiceProvider\ServiceProviderBidPost;
use App\ServiceProvider\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ClientPostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$models = Material::all();
        return view('admin.client_post.index');
    }

    public function showList(Request $request)
    {
        return view('admin.add_material.list');
    }

    public function processingPostIndex()
    {
        return view('admin.client_post.processing');
    }

    public function completedPostIndex()
    {
        return view('admin.client_post.completed');
    }

    public function processingData(Request $r)
    {
        $data = $this::data($r, 1);
        return response()->json($data);
    }

    public function completedData(Request $r)
    {
        $data = $this::data($r, 3);
        return response()->json($data);
    }

    public function listData(Request $r)
    {
        $data = $this::data($r, 0);
        return response()->json($data);
    }

    public function data(Request $request, $status)
    {
        $model = new ClientPost();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = DB::table($model->getTable() . ' as cp')->select('cp.id', 'cp.client_id', DB::raw('case when cp.category="S" then "Service" else "Material" end as category'), 'cp.address', 'cp.estimated_cost', 'cp.duration_days', 'cp.file_id', 'cu.name', 'cu.email', 'cu.mobile')->join('client_users as cu', 'cu.id', '=', 'cp.client_id')->where('cp.status', $status)->orderBy('cp.created_at','desc');
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd =$rwrd->where('cu.name', 'LIKE', "%$search%")->orwhere('cu.email', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }

        foreach ($rwrd as $r) {
            $cp = ClientPost::find($r->id);
            $filepath = '';
            $originalFilename = '';
            if ($cp->file_id) {

                foreach ($cp->upload_groups as $upload_group) {
                    $file = $upload_group->upload;

                    if ($file) {
                        $filepath = url('/') . '/' . $file->filebasepath . '/' . $file->filename;
                        $originalFilename = $file->original_filename;
                    }
                }
            }
            $r->filepath = $filepath;
            $r->originalFilename = $originalFilename;
        }

        return $rwrd;
    }

    public function postDetails($postid)
    {
        $userid = session('userid');
        $category = ClientPost::find($postid)->category;
        if ($category == 'M') {
            $data = new ClientPostMaterial();
            $data = $data->getPostDetails($postid, 0);
        } else {
            $data = new ClientPostService();
            $data = $data->getPostDetails($postid, 0);
        }
        $data->PostedAt = Carbon::parse($data->PostedAt)->format('d M');
        return response()->json($data);
    }

    public function getServiceProviderFromPost($postid = 1)
    {
        $category = ClientPost::find($postid)->category;
        $c = [$category, 'B'];
        $users = User::select('id', 'contact_name')->whereIn('service_category', $c)->where('status', 1)->get();
        return $users;
    }

    public function approvePost(Request $r, $postid)
    {
        $model = new ServiceProviderBidPost();
        if (!isset($r->service_provider)) {
            $category = ClientPost::find($postid)->category;
            $data = $model->getAutoBidProvidersData($category);
            $r['service_provider'] = $data;
        }
        $rows = $model->getInsertValue($r);
        $status = ServiceProviderBidPost::insert($rows);
        if ($status == true) {
            $data = ClientPost::find($postid);
            $data->status = 1;
            if ($data->save()) {
                return response()->json($this->successMessage('Post has been approved'));
            } else {
                return response()->json($this->errorMessage('Error on server, try again!!'), 500);
            }
        } else {
            return response()->json($this->errorMessage('Server Error'), 500);
        }
    }

    public function rejectPost($postid)
    {
        $data = ClientPost::find($postid);
        $data->status = 2;
        if ($data->save()) {
            return response()->json($this->successMessage('Post has been rejected'));
        } else {
            return response()->json($this->errorMessage('Error on server, try again!!'), 500);
        }
    }

    public function edit($postid)
    {
        $data = ClientPost::find($postid);

        if ($data->category == 'M') {
            $data['material'] = ClientPostMaterial::where('post_id', $data->id)->first();
            if ($data['material']) {
                $data['materialType'] = MaterialType::where('material_id', $data['material']->material_id)->get();
                $data['material_brand'] = MaterialBrand::where('material_id', $data['material']->material_id)->orWhere('material_type_id', $data['material_type_id'])->get();
            }
        } else {
            $data['services'] = ClientPostService::where('post_id', $data->id)->first();
            $data['service'] = $data['services'] ? Service::where('service_type_id', $data['services']->service_type_id)->get() : [];
        }
        if ($data->file_id) {
            $data['filepath'] = $data->getFileInfo()['filepath'];
            $data['originalFilename'] = $data->getFileInfo()['originalFilename'];
        }
        // return $data;
        $district = District::all();
        $material = Material::all();
        $serviceType = ServiceType::all();
        return view('admin.client_post.edit')->with('material', $material)->with('serviceType', $serviceType)->with('district', $district)->with('data', $data);
    }

    public function updatePost(Request $request, $postid)
    {
        $clientPost = ClientPost::find($postid);
        $clientMaterial = new ClientPostMaterial();
        $clientService = new ClientPostService();
        $reqClientPost = $request->except(['_token']);
        $clientPost->fill($reqClientPost);
        $clientPost->client_id = session('cuserid');
        $clientPost->status = 0;
        if ($request->category == 'M') {
            if ($clientMaterial->validate($request->all())) {
                if ($clientPost->save()) {
                    $clientMaterial->fill($reqClientPost);
                    $clientMaterial->client_id = $clientPost->client_id;
                    $clientMaterial->post_id = $clientPost->id;
                    $clientMaterial->status = 0;
                    $clientMaterial->save();
                    return response()->json($this->successMessage());
                } else {
                    return response()->json($this->errorMessage('Server Error'), 500);
                }
            } else {
                $errors = $clientMaterial->errors;
                return response()->json($this->errorMessage($errors), 500);
            }
        } else {
            if ($clientService->validate($request->all())) {
                if ($clientPost->save()) {
                    $clientService->fill($reqClientPost);
                    $clientService->status = 0;
                    $clientService->client_id = $clientPost->client_id;
                    $clientService->post_id = $clientPost->id;
                    $clientService->save();
                    return response()->json($this->successMessage());
                } else {
                    return response()->json($this->errorMessage('Server Error'), 500);
                }
            } else {
                return response()->json($this->errorMessage($clientService->errors), 500);
            }
        }
    }
}
