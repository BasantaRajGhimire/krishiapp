<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Material;
use App\Admin\MaterialType;
use App\Admin\MaterialBrand;
use App\Http\Controllers\Controller;

class MaterialBrandController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.material_brand.index');
        }
    public function showList(Request $request){
        return view('admin.material_brand.list');
    }
    public function listData(Request $request) {
        $model = new MaterialBrand();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = DB::table($model->getTable().' as mb')->select('mb.id','mi.name','mt.material_type_name','mb.brand_name','mb.amount')->join('material_items as mi','mi.id','=','mb.material_id')->leftjoin('material_types as mt','mt.id',
            '=','mb.material_type_id');
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = DB::table($model->getTable())->where('mi.name', 'LIKE', "%$search%")->orwhere('mt.material_type_name', 'LIKE', "%$search%")->orwhere('mb.brand_name', 'LIKE', "%$search%")->orwhere('mb.amount','LIKE',"%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $models = Material::all();
        return view('admin.material_brand.create')->with('material', $models);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $model = new MaterialBrand();
        if ($model->validate($request->all())) {
            $req = $request->except(['_token']);
            $model->fill($req);
            $model->save();
            return response()->json($this->successMessage());
        } else {
        //   return redirect()->back()->withErrors(['errors' => $model->errors])->withInput();
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
        $model = MaterialBrand::find($id);
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
        $model = new MaterialBrand();
        if ($model->validate($request->all())) {
            $model = MaterialBrand::find($id);
            $req = $request->except(['_token']);
            $model->fill($req);
            $model->save();
            return response()->json($this->successMessage());
        } else {
        //   return redirect()->back()->withErrors(['errors' => $model->errors])->withInput();
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
        $model = MaterialBrand::find($id);
        if ($model->delete()) {
            return response()->json($this->successMessage());
        } else {
            return response()->json($this->errorMessage($model->errors),500);
        }
    }
    public function getTypesFromItem($materialid){
        $model = MaterialType::where('material_id', $materialid)->get();
        return response()->json($model);
    }

}
