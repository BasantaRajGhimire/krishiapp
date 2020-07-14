<?php

  

namespace App\Http\Controllers;

  

use Illuminate\Http\Request;
use App\RegisterValidationPhase\FirstPhase;
use App\RegisterValidationPhase\SecondPhase;
use App\Buyer\ClientUsers;
use App\Admin\FrontendPage;
use App\Material;
use App\Admin\Service;
use App\Admin\FrontendFaqPage;
use App\Admin\ContactusForm;

use Notification;

use App\Notifications\MyFirstNotification;

  

class HomeController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    // public function __construct()

    // {

    //     $this->middleware('loggedinclient');

    // }

    public function getItems($id){
        if($id == 10001 ||  $id == 10002){
            $model = Material::all();
        }else{
            $model = Service::where('service_type_id', $id)->get();
        }
        return response()->json($model);

    }

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function index()

    {

        return view('home');

    }

    public function aboutUs(){
        $data = FrontendPage::where('slug', 'AU')->first();
        return view('frontend.about')->with('data', $data);
    }
    public function termsAndConditions(){
        $data = FrontendPage::where('slug', 'TAC')->first();
        return view('frontend.tac')->with('data', $data);
    }

    public function privacyPolicy(){
        $data = FrontendPage::where('slug', 'PP')->first();
        return view('frontend.privacy-policy')->with('data', $data);
    }
    public function faqIndex(){
        $data = FrontendFaqPage::all();
        return view('frontend.faq')->with('data', $data);
    }
    public function storeContactForm(Request $r){
        $model = new ContactusForm();
        if($model->validate($r->all())){
            $model->fill($r->except(['_token']));
            $model->status = 'PENDING';
            $model->save();
            return response()->json($this->successMessage('Your Contact form has been successfully send.'));
        }else{
            return response()->json($this->errorMessage($model->errors), 500);
        }
    }

    public function validateUserPhase(Request $r){
        if($r->phase == 1){
            $model = new FirstPhase();
        }
        if($r->phase == 2){
            $model = new SecondPhase();
        }        
        if($model->validate($r->all())){
            return response()->json('ok');
        }else{
            return response()->json($this->errorMessage($model->errors), 500);
        }
    }

  

}