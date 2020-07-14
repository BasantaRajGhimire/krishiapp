<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\ImageSlider;
use File;
use DB;

class ImageSliderController extends Controller
{
    public function index() {
        //$models = Material::all();
        return view('admin.frontend.image_slider.index');
        }
    public function showList(Request $request){
        return view('admin.frontend.image_slider.list');
    }
    public function listData(Request $request) {
        $model = new ImageSlider();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        if ($search == null) {
            $rwrd = DB::table($model->getTable())->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = DB::table($model->getTable())->where('brand_name', 'LIKE', "%$search%")->orwhere('id', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.frontend.image_slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r) {
        $model = new ImageSlider;
        $this->validate($r, $model->rules);       
        $logo = $r->banner_image;
        $extension = $logo->getClientOriginalExtension();
        $namefile = $this->spaceToDashConverter($r->title).'-'.(new \Datetime())->format('U').'.'.$extension;
        $save = $logo->storeAs(
                'image_slider',$namefile ,'file-repo'
            );
        $model->fill($r->except(['_token','banner_image']));
        $model->banner_image = '/image_slider/'.$namefile;
        if($model->save()){
            return redirect('admin/image-slider')->withMsg('Successfully added image sliders.');
        }else{
            return response()->withErr($this->errorMessage('Sorry, Server not responding. Try again!!'));
        }
    }

    public function edit($id){
        $model = ImageSlider::find($id);
        return view('admin.frontend.image_slider.edit')->withEdit($model);
    }

    public function update(Request $r, $id){
        $this->validate($r, [
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
        $model = ImageSlider::find($id);
        $model->fill($r->except(['_token','id']));
        $model->save();
        if($model->save()){
            return redirect('admin/image-slider')->withMsg('Successfully updated image sliders.');
        }else{
            return response()->withErr($this->errorMessage('Sorry, Server not responding. Try again!!'));
        }
    }

    public function destroy($id) {
        $model = ImageSlider::find($id);
        File::delete($model->banner_image);
        if ($model->delete()) {
            return response()->json($this->successMessage());
        } else {
            return response()->json($this->errorMessage($model->errors),500);
        }
    }
}
