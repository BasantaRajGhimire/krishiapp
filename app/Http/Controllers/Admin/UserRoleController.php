<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use DB;
use App\Admin\AdminUsers;
use App\MenuSetup;


class UserRoleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $menu_parent = MenuSetup::where('menu_parent_id' ,0)->orderBy('menu_order','asc')->get();
        //return $menu_parent;
        return view('admin.user_roles.index')->with('menu_parent', $menu_parent);
    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = \App\Role::select('id', 'name', 'display_name')->get();
        return view('user_roles.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function managePermission(Request $r){
        if(isset($r->permissions)){
            foreach($r->permissions as $k=>$p){
                $rows[] = [
                    'user_id' => $r->user_id,
                    'menu_id' => $k
                ];
            }
            DB::table('user_menus')->where('user_id', '=', $r->user_id)->delete();
            $data = DB::table('user_menus')->insert($rows);
            if(!$data){
                return response()->json($this->errorMessage('Server Error'), 500);
            }
            return response()->json($this->successMessage());
        }else{
            return response()->json($this->errorMessage('Please give at least one permission'), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $model = \App\Users::select(['name','username','id'])->find($id);
        $model->roles = $model->getUserRolesItems($id);
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
        $model = \App\Users::find($id);
        $req = $request->except(['id', '_token']);
        if (isset($req['roles']) && count($req['roles']) > 0) {
            $model->saveUserRolesItems($model->id, $req['roles']);
        } else {
            $model->removeUserRolesItems($model->id);
        }
        return response()->json($this->successMessage(t_message('Roles Updated for the user.')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $model = Role::find($id);
        $model->delete();
        return response()->json($this->successmessage(t_message('Item Successfully Deleted')));
    }

    public function getSelectOptions() {
        $model = new Role();
        $data = $model->getSelectedData(['id', 'name'], 'name', "id,=,1");
        return $data;
    }

}
