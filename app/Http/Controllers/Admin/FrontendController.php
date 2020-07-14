<?php

namespace App\Http\Controllers\Admin;  

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\FrontendPage;
class FrontendController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */
    public function aboutUs(){
        $data = FrontendPage::where('slug', 'AU')->first();
        if(!empty($data)){
            return view('admin.frontend.aboutus')->with('data', $data);
        }else{            
            return view('admin.frontend.aboutus');
        }
    }

    public function privacyPolicyIndex(){
        $data = FrontendPage::where('slug', 'PP')->first();
        if(!empty($data)){
            return view('admin.frontend.privacy-policy')->with('data', $data);
        }else{            
            return view('admin.frontend.privacy-policy');
        }
    }
    public function termsAndConditionIndex(){
       $data = FrontendPage::where('slug', 'TAC')->first();
        if(!empty($data)){
            return view('admin.frontend.tac')->with('data', $data);
        }else{            
            return view('admin.frontend.tac');
        } 
    }
    public function storeContent(Request $r){
        $model = new FrontendPage();
        $model->fill($r->all());
        if($model->save()){
            return response()->json($this->successMessage());
        }else{
            return response()->json($this->errorMessage('Server not responding, Try again later!!'), 500);
        }
    }
    public function updateContent(Request $r, $id){
        $model = FrontendPage::find($id);
        if($model->slug == $r->slug){
            $model->content = $r->content;
            if($model->save()){
                return response()->json($this->successMessage('Successfully updated data!'));
            }else{
                return response()->json($this->errorMessage('Error on loading server, Try again later!!'), 500);
            }
        }
    }

}