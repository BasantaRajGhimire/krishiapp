<?php

namespace App\Http\Controllers;

use App\Admin\AdminUsers;
use App\Admin\ServiceType;
use App\Admin\CompanyClass;
use App\Auth;
use App\Buyer\ClientUsers;
use App\District;
use App\Events\Notification;
use App\Mails\RegisterMail;
use App\Material;
use App\ServiceProvider\SellerType;
use App\ServiceProvider\ServiceProviderMaterial;
use App\ServiceProvider\ServiceProviderService;
use App\ServiceProvider\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;
use Validator;

class AuthController extends Controller
{

    public function index()
    {
        return view('admin.auth.index');
    }

    public function clientIndex()
    {
        return view('client.auth.login');
    }

    public function sellerIndex()
    {
        return view('service_provider.auth.login');
    }

    public function adminIndex()
    {
        return view('admin.auth.login');
    }

    public function showList()
    {
        return view('admin.auth.list');
    }

    public function create()
    {
        return view('admin.auth.signup');
    }
    public function clientRegisterIndex(){
        $district = District::all();
        return view('client.auth.register')->with('district', $district);
    }

    public function sellerRegisterIndex()
    {
        $district = District::all();
        $materials = Material::all();
        $services = ServiceType::all();
        $sellerType = SellerType::all();
        $companyClass = CompanyClass::all();
        return view('service_provider.auth.register')
            ->with('materials', $materials)
            ->with('services', $services)
            ->with('companyClass', $companyClass)
            ->with('sellerType', $sellerType)
            ->with('district', $district);
    }

    public function sellerRegisterStore(Request $r, RegisterMail $mail)
    {
        // return response()->json($r->all(), 500);
        $model = new User(); 
        //$model->owner_name = 
        if ($model->validate($r->all())) {
            $req = $r->except(['_token', 'confirm_password']);
            $model->fill($req);
            $model->company_name = $r->contact_name;
            $model->company_email = $r->email;
            $model->service_category = ((isset($r->materials)?'M':'S'));
            $model->password = Hash::make($r->password);
            $model->status = 2;
            $model->owner_name = $r->owner_type==2?$r->multiowner_name:$r->owner_name;
            DB::beginTransaction();
            try {
                $model->save();   
                if(isset($r->project_details)){
                    $projectDetails = $model->getInsertProjectDetailsData($r->project_details,$r->project_links,'5');
                    if(!empty($projectDetails)){
                        DB::table('serviceprovider_pastproject')->insert($projectDetails);
                    }
                }
                if (isset($r->materials)) {
                    $materialRows = (new ServiceProviderMaterial())->getInsertData($r->materials, $model->id);
                    ServiceProviderMaterial::insert($materialRows);
                }
                if (isset($r->services)) {
                    $serviceRows = (new ServiceProviderService())->getInsertData($r->services, $model->id);
                    ServiceProviderService::insert($serviceRows);
                }
                //$status = $model->login($model->email, $r->password);

                DB::commit();

                $mail->sendRegisterEmail($model);

                $msg = 'Your registration form has been submited. Our team will contact you soon. So, Stay touch in your provided email.';
                return response()->json($msg);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json('Server error', 500);
            }
        } else {
            return response()->json($this->errorMessage($model->errors), 500);
        }
    }

    public function buyerRegister(Request $r, RegisterMail $mail)
    {
        $model = new ClientUsers();
        if ($model->validate($r->all())) {
            $req = $r->except(['_token', 'confirm_password', 'password']);
            $model->fill($req);
            $model->remember_token = $r->input('_token');
            $model->password = Hash::make($r->password);
            $model->save();
            $mail->sendRegisterEmail($model);
//            $status = $auth->login($model->email, $r->password);


            return response()->json($this->successMessage());
        } else {
            return response()->json($this->errorMessage($model->errors), 500);
        }
    }

    public function loginAdmin(Request $r)
    {
        $username = $r->input('email');
        $password = $r->input('password');
        return $this->handleLogin($username, $password);
    }

    public function loginClient(Request $r)
    {
        $email = $r->input('email');
        $password = $r->input('password');
        $auth = new ClientUsers();
        $status = $auth->login($email, $password);
        if ($status === -1) {
            return response()->json('User may not exist or not activated yet.', 500);
        }elseif ($status === true) {
            // event(new Notification($email, 'Hey I am here!'));
            return response()->json($this->successMessage('Login Successful.'));
        }elseif($status == -2){
            return response()->json('Your account has been deactivated. Please contact customer support!', 500);
        }  else {
            return response()->json('Invalid password credential!', 500);
        }
    }

    public function loginSeller(Request $r)
    {
        $email = $r->input('email');
        $password = $r->input('password');
        $auth = new User();
        $status = $auth->login($email, $password);
        if ($status === -2) {
            return response()->json('Your account is not verified.', 500);
        } elseif ($status === -1) {
            return response()->json('User may not exist or not activated yet.', 500);
        } elseif ($status === -3) {
            return response()->json('Your account has been deactivated. please contact support team.', 500);
        } elseif ($status === true) {
            return response()->json('ok');
        } else {
            return response()->json('Invalid password credential!', 500);
        }
    }

    public function handleLogin($username, $password)
    {
        $auth = new Auth();
        $status = $auth->login($username, $password);
        if ($status === -1) {
            return response()->json($this->errorMessage('User may not exist or not activated yet.'), 500);
        } elseif ($status === true) {
            return response()->json($this->successMessage('Login Successful.'));
        } else {
            return response()->json($this->errorMessage('Invalid password credential!'), 500);
        }
    }

    public function logout()
    {
        $auth = new Auth();
        $auth->logOut();
        return redirect('/');
    }
    public function clientLogout() {
        Session::forget('logged_in_client');
        Session::forget('email_verified');
        Session::forget('cuserid');
        return redirect('/');
    }
    public function vendorLogout() {
        Session::forget('logged_in_seller');
        Session::forget('suserid');
        return redirect('/');
    }

    public function store(Request $r)
    {
        $model = new AdminUsers();
        if ($model->validate($r->all())) {
            $req = $r->except(['_token', 'password', 'confirm_password']);
            $model->fill($req);
            $model->password = Hash::make($r->password);
            $model->save();
            return response()->json($this->successMessage());
        } else {
            return response()->json($this->errorMessage($model->errors), 500);
        }
    }

    public function listData(Request $request)
    {
        $model = new AdminUsers();
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
            $rwrd = DB::table($model->getTable())->where('name', 'LIKE', "%$search%")->orwhere('email', 'LIKE', "%$search%")->paginate($entry, ['*'], 'page', $page);
        }
        return $rwrd;
    }

    public function edit($id)
    {
        $model = AdminUsers::find($id);
        return response()->json($model);
    }

    public function update(Request $r, $id)
    {
        $validation = Validator::make($r->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:admin_users,email,' . $id,
        ]);
        if ($validation->fails()) {
            return response()->json($this->errorMessage($validation->errors()), 500);
        } else {
            $model = AdminUsers::find($id);
            $model->fill($r->except('_token'));
            $model->save();
            return response()->json($this->successMessage());
        }

    }

    public function paymentIntegrity(Request $r)
    {
        $token = $r->token;
        $amount = $r->amount;
        $args = http_build_query(array(
            'token' => $token,
            'amount' => $amount
        ));
        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key test_secret_key_a71fda82e08c4504bbd415abc8dcae92'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return response()->json($response);


    }

// JSON    {"idx":"GvZtJHkEFJmsFUQsSHTRdb","type":{"idx":"2jwzDS9wkxbkDFquJqfAEC","name":"Wallet payment"},"state":{"idx":"DhvMj9hdRufLqkP8ZY4d8g","name":"Completed","template":"is complete"},"amount":1000,"fee_amount":30,"refunded":false,"created_on":"2019-07-18T21:52:28.024550+05:45","user":{"idx":"yBcSJvKKofxpPMbo29raVV","name":"Raju Poudel","mobile":"9845807543"},"merchant":{"idx":"eFpWXGFc6AXA3fzmyBSiSK","name":"Freelancer","mobile":"raju@saipal.org"}}
}
