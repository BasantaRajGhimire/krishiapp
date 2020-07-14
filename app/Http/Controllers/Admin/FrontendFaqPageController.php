<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Admin\FrontendFaqPage;
use App\Http\Controllers\Controller;

class FrontendFaqPageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$models = Material::all();
        return view('admin.frontend.faqpage.index');
        }
    public function showList(Request $request){
        return view('admin.frontend.faqpage.list');
    }
    public function listData(Request $request) {
        $model = new FrontendFaqPage();
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
            $rwrd = DB::table($model->getTable())->where('question', 'LIKE', "%$search%")->orwhere('question_number', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.frontend.faqpage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $model = new FrontendFaqPage();
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
        $model = FrontendFaqPage::find($id);
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
        $validator = Validator::make($request->all(),
                    [
                        'question'=>'required|string',
                        'answer'=>'required|string',

                    ]);
        if($validator->passes()){
            $model = FrontendFaqPage::find($id);
            $req = $request->except(['_token','question_number']);
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
        $model = FrontendFaqPage::find($id);
        if ($model->delete()) {
            return response()->json($this->successMessage());
        } else {
            return response()->json($this->errorMessage($model->errors),500);
        }
    }

}
