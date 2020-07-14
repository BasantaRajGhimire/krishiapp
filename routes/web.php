<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
//use Session;
use Illuminate\Support\Facades\Artisan;

/* Admin Routes */ 
Route::group([ 'prefix' => 'admin' , 'middleware' => ['loggedin']], function() {
    Route::get('/', function () {
        return view('admin.main');
    });
    Route::get('/auth/logout', 'AuthController@logout');

    /* Materials */
    Route::get('/aboutus','Admin\FrontendController@aboutUs');
    Route::get('/privacy-policy','Admin\FrontendController@privacyPolicyIndex');
    Route::get('/tac','Admin\FrontendController@termsAndConditionIndex');
    Route::post('/frontend','Admin\FrontendController@storeContent');
    Route::post('/frontend/{id}', 'Admin\FrontendController@updateContent');

    Route::get('/brand-logo/list','Admin\FrontendBrandLogoController@showList');
    Route::get('/brand-logo/list-data','Admin\FrontendBrandLogoController@listData');
    Route::resource('/brand-logo','Admin\FrontendBrandLogoController');

    Route::get('/faq/list','Admin\FrontendFaqPageController@showList');
    Route::get('/faq/list-data','Admin\FrontendFaqPageController@listData');
    Route::resource('/faq','Admin\FrontendFaqPageController');

    Route::get('/contactus/list-data','Admin\ContactusController@listData');
    Route::post('/contactus/send-mail','Admin\ContactusController@sendMailAndUpdateStatus');
    Route::resource('contactus','Admin\ContactusController');

    Route::get('/request-quote/list-data','Admin\RequestedForQuoteController@listData');
    Route::post('/request-quote/send-email','Admin\RequestedForQuoteController@sendEmail');
    Route::resource('request-quote','Admin\RequestedForQuoteController');

    Route::get('/image-slider/list','Admin\ImageSliderController@showList');
    Route::get('/image-slider/list-data','Admin\ImageSliderController@listData');
    Route::POST('image-slider/{id}/update','Admin\ImageSliderController@update');
    Route::resource('image-slider','Admin\ImageSliderController');

    Route::get('/material/list','Admin\MaterialController@showList');
    Route::get('/material/list-data','Admin\MaterialController@listData');
    Route::resource('/material','Admin\MaterialController');

    Route::get('/material-type/list','Admin\MaterialTypeController@showList');
    Route::get('/material-type/list-data','Admin\MaterialTypeController@listData');
    Route::resource('/material-type','Admin\MaterialTypeController');

    Route::get('/material-brand/list','Admin\MaterialBrandController@showList');
    Route::get('/material-brand/list-data','Admin\MaterialBrandController@listData');
    Route::get('/material-brand/{materialid}/get-types','Admin\MaterialBrandController@getTypesFromItem');
    Route::resource('/material-brand','Admin\MaterialBrandController');

    /*Services*/
    Route::get('/service-type/list','Admin\ServiceTypeController@showList');
    Route::get('/service-type/list-data','Admin\ServiceTypeController@listData');
    Route::resource('/service-type','Admin\ServiceTypeController');

    Route::get('/services/list','Admin\ServiceController@showList');
    Route::get('/services/list-data','Admin\ServiceController@listData');
    Route::resource('/services','Admin\ServiceController');

    Route::get('/company-class/list','Admin\CompanyClassController@showList');
    Route::get('/company-class/list-data','Admin\CompanyClassController@listData');
    Route::resource('/company-class','Admin\CompanyClassController');

    //Batch

    Route::get('/badge/list','Admin\BatchController@showList');
    Route::get('/badge/list-data','Admin\BatchController@listData');
    Route::resource('/badge','Admin\BatchController');

    // Client Ticket Category

    Route::get('/client-ticket/category/list','Admin\ClientTicketCategoryController@showList');
    Route::get('/client-ticket/category/list-data','Admin\ClientTicketCategoryController@listData');
    Route::resource('client-ticket/category','Admin\ClientTicketCategoryController');

    // Client Ticket Title

    Route::get('/client-ticket/title/list','Admin\ClientTicketTitleController@showList');
    Route::get('/client-ticket/title/list-data','Admin\ClientTicketTitleController@listData');
    Route::resource('/client-ticket/title','Admin\ClientTicketTitleController');

    // Vendor Ticket Category

    Route::get('/serviceprovider-ticket/category/list','Admin\ServiceProviderTicketCategoryController@showList');
    Route::get('/serviceprovider-ticket/category/list-data','Admin\ServiceProviderTicketCategoryController@listData');
    Route::resource('/serviceprovider-ticket/category','Admin\ServiceProviderTicketCategoryController');

    // Vendor Ticket Title

    Route::get('/serviceprovider-ticket/title/list','Admin\ServiceProviderTicketTitleController@showList');
    Route::get('/serviceprovider-ticket/title/list-data','Admin\ServiceProviderTicketTitleController@listData');
    Route::resource('/serviceprovider-ticket/title','Admin\ServiceProviderTicketTitleController');


    /* Users */

    Route::get('/users/list','AuthController@showList');
    Route::get('/users/list-data','AuthController@listData');
    Route::resource('/users','AuthController');

    Route::get('user-roles','Admin\UserRoleController@index');
    Route::post('user-roles/manage-permission','Admin\UserRoleController@managePermission');

    Route::get('/client-users/list-data','Buyer\ClientUserController@listData');
    Route::get('/client-users','Buyer\ClientUserController@index');
    Route::post('client-users/deactivate/{userid}','Buyer\ClientUserController@deactivateUser');
    Route::post('client-users/activate/{userid}','Buyer\ClientUserController@activateUser');
    Route::get('client-post/edit/{postid}','Admin\ClientPostController@edit');
    Route::put('client-post/update/{postid}','Admin\ClientPostController@updatePost');
    Route::get('client-post','Admin\ClientPostController@index');
    Route::get('client-post/{postid}/details','Admin\ClientPostController@postDetails');
    Route::post('client-post/{postid}/approve','Admin\ClientPostController@approvePost');
    Route::post('client-post/{postid}/reject','Admin\ClientPostController@rejectPost');
    Route::get('/client-post/list-data','Admin\ClientPostController@listData');
    Route::get('/client-post/proccessfor-bidding','Admin\ClientPostController@processingPostIndex');
    Route::get('/client-post/completed-bids','Admin\ClientPostController@completedPostIndex');
    Route::get('/client-post/processing-data','Admin\ClientPostController@processingData');
    Route::get('/client-post/completed-data','Admin\ClientPostController@completedData');

    Route::get('/serviceprovider-user/request-data','Admin\ServiceProviderController@requestData');
    Route::post('/serviceprovider-user/{userid}/approve','Admin\ServiceProviderController@approveUser');
    Route::post('/serviceprovider-user/{userid}/update-badge','Admin\ServiceProviderController@updateBadge');
    Route::post('/serviceprovider-user/{userid}/reject','Admin\ServiceProviderController@rejectUser');
    Route::get('/serviceprovider-user/{userid}/details','Admin\ServiceProviderController@userDetails');
    Route::get('/serviceprovider-user/request','Admin\ServiceProviderController@requestIndex');
    Route::get('/serviceprovider-user/users-data','Admin\ServiceProviderController@authorizedUserData');
    Route::post('serviceprovider-user/activate/{userid}','Admin\ServiceProviderController@activateUser');
    Route::post('serviceprovider-user/deactivate/{userid}','Admin\ServiceProviderController@deactivateUser');
    Route::get('/serviceprovider-user','Admin\ServiceProviderController@index');
    Route::get('client-post/{postid}/service-providers','Admin\ClientPostController@getServiceProviderFromPost');

    Route::get('client-ticket/open','Admin\ClientTicketController@openIndex');
    Route::get('client-ticket/open/list-data','Admin\ClientTicketController@openTicketData');
    Route::get('client-ticket/open/{ticketid}','Admin\ClientTicketController@updateStatus');
    Route::get('client-ticket/processing','Admin\ClientTicketController@processingIndex');
    Route::get('client-ticket/processing/list-data','Admin\ClientTicketController@processingTicketData');
    Route::get('client-ticket/processing/{ticketid}','Admin\ClientTicketController@updateStatus');
    Route::get('client-ticket/closed','Admin\ClientTicketController@ClosedIndex');
    Route::get('client-ticket/closed/list-data','Admin\ClientTicketController@closedTicketData');

    Route::get('serviceprovider-ticket/open','Admin\VendorTicketController@openIndex');
    Route::get('serviceprovider-ticket/open/list-data','Admin\VendorTicketController@openTicketData');    
    Route::get('serviceprovider-ticket/open/{ticketid}','Admin\VendorTicketController@updateStatus');
    Route::get('serviceprovider-ticket/processing','Admin\VendorTicketController@processingIndex');
    Route::get('serviceprovider-ticket/processing/list-data','Admin\VendorTicketController@processingTicketData');  
    Route::get('serviceprovider-ticket/processing/{ticketid}','Admin\VendorTicketController@updateStatus');
    Route::get('serviceprovider-ticket/closed','Admin\VendorTicketController@ClosedIndex');
    Route::get('serviceprovider-ticket/closed/list-data','Admin\VendorTicketController@closedTicketData');

    Route::get('client-post/request-load-amount/list-data','Admin\EscrowSystemController@requestListData');
    Route::get('client-post/approved-requestamount-loaded/list-data','Admin\EscrowSystemController@approvedRequestAmountListData');
    Route::post('client-post/approved-requestamount-loaded/balance-release','Admin\EscrowSystemController@releaseRequestBalance');
    Route::post('client-post/request-load-amount/{ecdid}/approve','Admin\EscrowSystemController@approveLoadAmount');
    Route::post('client-post/request-load-amount/{ecdid}/reject','Admin\EscrowSystemController@rejectLoadAmount');
    Route::get('client-post/no-response-payment','Admin\EscrowSystemController@noResponsePaymentIndex');
    Route::get('client-post/no-response-payment/list-data','Admin\EscrowSystemController@noResponsePaymentListData');
    Route::post('client-post/no-response-payment/cancel-request','Admin\EscrowSystemController@CancelPaymentRequest');
    Route::post('client-post/no-response-payment/send-request-again','Admin\EscrowSystemController@sendPaymentRequestAgain');
    Route::post('client-post/request-load-amount/edit','Admin\EscrowSystemController@updateInfo');
    Route::get('client-post/request-load-amount','Admin\EscrowSystemController@indexRequestLoadAmount');
    Route::get('client-post/approved-amount-loaded','Admin\EscrowSystemController@indexApprovedAmountLoaded');
    
    //Load Aamount
    Route::post('/load-amount','Admin\ServiceProviderController@loadAmount');

    //Reporting for service provider
    Route::get('serviceprovider-report','Admin\ServiceProviderReportingController@index');
    Route::get('serviceprovider-report/download','Admin\ServiceProviderReportingController@monthlyReport');
    Route::get('/serviceprovider-report/list-data','Admin\ServiceProviderReportingController@monthlyReport');

    //Reporting for client
    Route::get('client-report','Admin\ClientReportingController@index');
    Route::get('client-report/download','Admin\ClientReportingController@monthlyReport');
    Route::get('/client-report/list-data','Admin\ClientReportingController@monthlyReport');

    //Error log activity

    Route::get('error-log','Admin\ErrorLogActivityController@index');
    Route::get('error-log/list-data','Admin\ErrorLogActivityController@listData');
});


Route::group([ 'prefix' => 'admin' , 'middleware' => 'loggedout'], function() {
    Route::get('/auth', 'AuthController@adminIndex');
    Route::post('/auth/login', 'AuthController@loginAdmin');
});
/*Admin Section Finish*/

/*Client Routes */
Route::group([ 'prefix' => 'client' , 'middleware' => ['loggedinclient']], function() {
    
    Route::get('/', function () {
        return view('client.main');
    });


    Route::get('/get-material-types/{materialid}','Admin\MaterialBrandController@getTypesFromItem');
    Route::get('/get-brand','Buyer\ClientUserController@getBrand');
    Route::get('/get-services/{servicetypeid}','Buyer\ClientUserController@getServices');
    Route::get('/support-ticket/{categoryid}/get-title','Buyer\ClientTicketController@getTitle');
    Route::resource('/support-ticket','Buyer\ClientTicketController');
    Route::get('/post/reviews','Buyer\ClientPostTimelineController@reviewPost');
    Route::post('/post/store-review','Buyer\ClientPostTimelineController@reviewStore');
    Route::post('/post/cancel-payment-request','Buyer\ClientPostController@cancelPaymentRequest');
    Route::resource('/post', 'Buyer\ClientPostController');
    Route::get('/activity','Buyer\ClientPostController@activityIndex');
    Route::get('/profile','Buyer\ClientPostTimelineController@profile');
    Route::post('/updateProfile/{id}','Buyer\ClientPostTimelineController@updateProfile');
    Route::get('/timeline','Buyer\ClientPostTimelineController@timeline');
    Route::get('/awarded-post','Buyer\ClientPostTimelineController@awardedPost');
    Route::get('/client-post/award/{bid_id}','Buyer\ClientPostTimelineController@markBidAsWon');
    Route::get('/client-post/{postid}','Buyer\ClientPostTimelineController@getPostDetails');
    Route::post('/client-post/{postid}/cancel-escrow','Buyer\ClientPostController@cancelEscrowSystem');
    Route::post('activate-escrow-system','Buyer\ClientPostController@activateEscrowSystem');
    Route::post('payment-for-escrow','Buyer\ClientPostController@paymentForEscrowSystem');
    Route::post('direct-releasepayment-order','Buyer\ClientPostController@directReleasePaymentOrder');
    Route::get('/check-old-password','Buyer\ClientUserController@checkOldPassword');
    Route::post('/change-password','Buyer\ClientUserController@changePassword');
    Route::get('/auth/logout', 'AuthController@clientLogout');
});
Route::group([ 'prefix' => 'client' , 'middleware' => 'loggedoutclient'], function() {
    Route::get('/auth', 'AuthController@clientIndex');
    Route::post('/auth/login', 'AuthController@loginClient');
    Route::get('/auth/forget-password','Buyer\ClientUserController@forgetPasswordIndex');
    Route::post('/auth/send-email','Buyer\ClientUserController@checkEmailForgetPassword');
    Route::post('/auth/token/{token}','Buyer\ClientUserController@changeNewPasswordAfterForget');
    Route::get('/auth/token/{token}','Buyer\ClientUserController@checkTokenFromMail');
    Route::get('/verification/login','Buyer\ClientUserController@loginClientWithToken');
    Route::get('/register','AuthController@clientRegisterIndex');
});

Route::group([ 'prefix' => 'service-provider' , 'middleware' => ['loggedinseller']], function() {
    Route::get('/', function () {
        return view('service_provider.main');
    });

    Route::get('/get-monthly-bid-graph','ServiceProvider\ServiceProviderController@getGraphData');
    Route::get('/new-bids', 'ServiceProvider\ServiceProviderController@newBidIndex');
    Route::get('/post/reviews','ServiceProvider\ServiceProviderController@reviewPost');
    Route::get('/activity','ServiceProvider\ServiceProviderController@activityIndex');
    Route::get('/profile', 'ServiceProvider\ServiceProviderController@profile');
    Route::post('/updateProfile/{id}', 'ServiceProvider\ServiceProviderController@updateProfile');
    Route::get('/getProfile/{type}', 'ServiceProvider\ServiceProviderController@getProfile');
    Route::get('/deleteProfile/{id}', 'ServiceProvider\ServiceProviderController@deleteProfile');
    Route::post('/addProfile', 'ServiceProvider\ServiceProviderController@addProfile');
    Route::post('/bid-amount','ServiceProvider\ServiceProviderController@storeBidAmount');
    Route::get('/support-ticket/{categoryid}/get-title','ServiceProvider\VendorTicketController@getTitle');
    Route::resource('/support-ticket','ServiceProvider\VendorTicketController');
    Route::get('/timeline','ServiceProvider\ServiceProviderController@timeline');

    Route::post('/post/request-for-amount','ServiceProvider\ServiceProviderController@requestForAmount');
    Route::get('post/{postid}','ServiceProvider\ServiceProviderController@singlePost');
    Route::post('post/comment-on-request-cancel','ServiceProvider\ServiceProviderController@commentOnPaymentRequestCancel');
    Route::get('pay-for-details/{winid}','ServiceProvider\ServiceProviderController@payForWinDetails');
    Route::get('client-details/{winid}','ServiceProvider\ServiceProviderController@clientDetailsForWinPost');

    Route::get('/check-old-password','ServiceProvider\ServiceProviderController@checkOldPassword');
    Route::post('/change-password','ServiceProvider\ServiceProviderController@changePassword');
    Route::get('/auth/logout', 'AuthController@vendorLogout');
});
Route::group([ 'prefix' => 'service-provider' , 'middleware' => 'loggedoutseller'], function() {
    Route::get('/auth', 'AuthController@sellerIndex');
    Route::post('register/validate','HomeController@validateUserPhase');
    Route::get('/register','AuthController@sellerRegisterIndex');
    Route::post('register-form','AuthController@sellerRegisterStore');
    Route::post('/auth/login', 'AuthController@loginSeller');    
    Route::get('/auth/forget-password','ServiceProvider\ForgetPasswordController@forgetPasswordIndex');
    Route::post('/auth/send-email','ServiceProvider\ForgetPasswordController@checkEmailForgetPassword');
    Route::post('/auth/token/{token}','ServiceProvider\ForgetPasswordController@changeNewPasswordAfterForget');
    Route::get('/auth/token/{token}','ServiceProvider\ForgetPasswordController@checkTokenFromMail');
    Route::get('/verification/login','ServiceProvider\ServiceProviderController@loginVendorWithEmailVerification');
});
/*Client Section Finish*/


/*No Middleware Access Routes*/


Route::get('/', function(){
  return view('welcome');
});
Route::get('aboutus','HomeController@aboutUs');
Route::get('tac','HomeController@termsAndConditions');
Route::get('privacy-policy','HomeController@privacyPolicy');
Route::get('faq','HomeController@faqIndex');
Route::post('contact-form','HomeController@storeContactForm');
Route::get('/payment-integrity','AuthController@paymentIntegrity');
Route::get('/api/get-items/{id}','HomeController@getItems');
Route::post('/client/register-form', 'AuthController@buyerRegister');
Route::post('quote/store','Admin\RequestedForQuoteController@store');
Route::get('get-hash', function() {
    echo Hash::make(Request::input('input'));
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return "Cache is cleared";
});
Route::get('/menusetup/list','MenuSetupController@showList');
Route::get('menusetup/list-data','MenuSetupController@listData');
Route::resource('/menusetup','MenuSetupController');
Route::get('phase-payment/{amount}',function($amount){
    $i= 1;
            for($i;$i<5;$i++ ){
                $client[]=[
                    'total_amount' => intVal($amount/5),
                    'deposit_amount' => 0,
                    'remaining_amount' => intVal($amount/5),
                    'phase' => config('constants.escrow_system.phase.'.$i),
                    'status' => 'Pending',
                ];
            }
            $client[3]['total_amount'] += $client[3]['total_amount'] + ($amount % 5); 

    return $client;
});