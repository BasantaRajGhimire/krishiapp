<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\ServiceProviderTicketCategory;
use DB;

class ServiceProviderTicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.vendor_ticket_category.index');
    }

    public function showList(){
        return view('admin.vendor_ticket_category.list');
    }

    public function listData(Request $request) {
        $model = new ServiceProviderTicketCategory();
        $entry = $request->input("entry");
        $search = $request->input("search", null);
        $page = $request->input("page", null);
        // return [$pgno,$srch];
        if ($page == null) {
            $page = 1;
        }
        $rwrd = DB::table($model->getTable().' as mt')->select('mt.id','mt.name');
        if ($search == null) {
            $rwrd = $rwrd->paginate($entry, ['*'], 'page', $page);
        } else {
            $rwrd = DB::table($model->getTable())->where('mt.name', 'LIKE', "%$search%")->orwhere('mt.id', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor_ticket_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new ServiceProviderTicketCategory();
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = ServiceProviderTicketCategory::find($id);
        return response()->json($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = new ServiceProviderTicketCategory();
        if ($model->validate($request->all())) {
            $model = ServiceProviderTicketCategory::find($id);
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
    public function destroy($id)
    {
        $model = ServiceProviderTicketCategory::find($id);
        if ($model->delete()) {
            return response()->json($this->successMessage());
        } else {
            return response()->json($this->errorMessage($model->errors),500);
        }
    }
}
