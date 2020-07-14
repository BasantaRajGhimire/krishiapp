<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserRole extends Model
{
   	public $timestamps=false;
   	public $table = 'user_menus';
   	protected $fillable = [];
	protected $rules = [
         'user_id' => 'integer',
         'menu_id'=>'integer',
         
          ]; 

    public function getUserMenus(){ 	
       $data = DB::table('menus')->join('user_menus as um','um.menu_id','=','menus.menu_id')->where('um.user_id', session('userid'))->orderBy('menu_order','asc')->get();
       if($data !='[]'){
        foreach($data as $k=>$d){
            $menuItems[]= ['name'=>$d->menu_name,'url' => $d->menu_url,'icon'=>$d->menu_icon,'menu_id'=>$d->menu_id,'childs' => $this->getChildItems($d->menu_id)];
        }
      }else{
          $menuItems=[];      
      }
      return $menuItems;
    }

    public function getChildItems($menuId){
        $data = DB::table('menus as m')->select(['m.menu_id','m.menu_url','m.menu_name','m.menu_icon'])->where('menu_parent_id', $menuId)->orderBy('menu_order','asc')->get();
        return $data;
    }


 }


 