<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Admin\FrontendBrandLogo;
use App\Http\Controllers\Controller;

class FrontendBrandLogoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$models = Material::all();
        return view('admin.frontend.brand_logo.index');
        }
    public function showList(Request $request){
        return view('admin.frontend.brand_logo.list');
    }
    public function listData(Request $request) {
        $model = new FrontendBrandLogo();
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
        return view('admin.frontend.brand_logo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r) {
        // return $r->
        $model = new FrontendBrandLogo();
        if ($model->validate($r->all())) {           
            $logo = $r->brand_logo;
            $extension = $logo->getClientOriginalExtension();
            $namefile = $r->brand_name.'-'.(new \Datetime())->format('U').'.'.$extension;
            $save = $logo->storeAs(
                    'brand_logo',$namefile ,'file-repo'
                );
            $model->brand_logo = '/brand_logo/'.$namefile;
            $model->brand_name = $r->brand_name;
            if($model->save()){
                return response()->json($this->successMessage());
            }else{
                return response()->json($this->errorMessage('Sorry, Server not responding. Try again!!'));
            }
        } else {
         return response()->json($this->errorMessage($model->errors),500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $model = FrontendBrandLogo::find($id);
        return response()->json($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //return $request;
        $model = new FrontendBrandLogo();
        if($model->validate($request->all())){
            $model = FrontendBrandLogo::find($id);
            $req = $request->except(['_token']);
            $model->fill($req);
            $model->save();
            return response()->json($this->successMessage());
        } else {
          return redirect()->back()->withErrors(['errors' => $model->errors])->withInput();
         return response()->json($this->errorMessage($model->errors),500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $model = FrontendBrandLogo::find($id);
        if ($model->delete()) {
            return response()->json($this->successMessage());
        } else {
            return response()->json($this->errorMessage($model->errors),500);
        }
    }

}
