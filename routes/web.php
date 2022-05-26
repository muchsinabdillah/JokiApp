<?php

use App\Models\Transactiondeliverie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PusatController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\PacketController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PricelistController;
use App\Http\Controllers\PrintResiController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\PerwakilanController;
use App\Http\Controllers\UserCourierController;
use App\Http\Controllers\SearchRegenciesController;
use App\Http\Controllers\TransactionCourierComplete;
use App\Http\Controllers\CaptchaValidationController;
use App\Http\Controllers\RevenueInformationController;
use App\Http\Controllers\TransactionTransitController;
use App\Http\Controllers\TransactionDeliveryController;
use App\Http\Controllers\TransactionTransitPusatController;
use App\Http\Controllers\TransactionDeliveryKurirController;
use App\Http\Controllers\TransactionCourierCompleteController;
use Illuminate\Routing\PendingResourceRegistration;

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
 

// Route::get('/', 'App\Http\Controllers\AuthController@index')->name('login');
Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');

Route::get('register', function () {
    return view('login.register');
});
Route::get('/', function () {
    return view('welcome');
});
Route::post('trackingproses', [TransactionDeliveryController::class, 'trackingproses'])->name('trackingproses');
    
Route::get('/trackingpacket', function () {
    return view('tracking');
});


 

Route::get('verify', function () {
    return view('verify.verify');
});
Route::post('proses_register', [RegisterController::class, 'store'])->name('proses_register');
Route::get('registersuccess', function () {
    return view('login.registersuccess');
});

Route::get('verificationregistration/{id}', [RegisterController::class, 'show']);

Route::post('sendverification', [RegisterController::class, 'edit']);

Route::post('getRegistrationMitraKurirByIDJson', [MasterDataController::class, 'getRegistrationMitraKurirByIDJson'])->name('getRegistrationMitraKurirByIDJson');

Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
    
    Mail::to('muchsin.abdillah@gmail.com')->send(new \App\Mail\RegisterMail($details));

    dd("Email is Sent.");
});

Route::get('contact-form-captcha', [CaptchaValidationController::class, 'index']);
Route::post('captcha-validation', [CaptchaValidationController::class, 'capthcaFormValidate']);
Route::get('reload-captcha', [CaptchaValidationController::class, 'reloadCaptcha']);

// Route::get('register', 'App\Http\Controllers\AuthController@register')->name('register'); 

Route::post('proses_login', [AuthController::class, 'proses_login']);
Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

// Route::get('tracking', 'App\Http\Controllers\AuthController@index')->name('login');

//searching - auto complete
Route::get('autocomplete', [SearchRegenciesController::class, 'autocomplete'])->name('autocomplete');
Route::get('autocompleteRegencies', [SearchRegenciesController::class, 'autocompleteRegencies'])->name('autocompleteRegencies');
Route::get('autocompleteprovinces', [SearchRegenciesController::class, 'autocompleteprovinces'])->name('autocompleteprovinces');
Route::get('autocompletevillages', [SearchRegenciesController::class, 'autocompletevillages'])->name('autocompletevillages');
Route::get('autocompletedistrits', [SearchRegenciesController::class, 'autocompletedistrits'])->name('autocompletedistrits');
Route::get('autocompletepacket', [SearchRegenciesController::class, 'autocompletepacket'])->name('autocompletepacket');
    

Route::group(['middleware' => ['auth']], function () {
    
    
    // search - master data
    Route::get('getDataPacketJSon', [MasterDataController::class, 'getDataPacketJSon'])->name('getDataPacketJSon');
    Route::get('getDataShipingTypeJSon', [MasterDataController::class, 'getDataShipingTypeJSon'])->name('getDataShipingTypeJSon');
    Route::post('getDataPengirimanByIDJson', [MasterDataController::class, 'getDataPengirimanByIDJson'])->name('getDataPengirimanByIDJson');
    
    Route::post('getDataShippingJSon', [MasterDataController::class, 'getDataShippingJSon'])->name('getDataShippingJSon');
    Route::post('getDataPriceJSon', [MasterDataController::class, 'getDataPriceJSon'])->name('getDataPriceJSon');
    Route::post('getDeliveryPacketByIDJson', [MasterDataController::class, 'getDeliveryPacketByIDJson'])->name('getDeliveryPacketByIDJson');
    Route::get('getDataMasterHistoryDeliveryJSon', [MasterDataController::class, 'getDataMasterHistoryDeliveryJSon'])->name('getDataMasterHistoryDeliveryJSon');
    Route::get('getDataMasterCouriersJSon', [MasterDataController::class, 'getDataMasterCouriersJSon'])->name('getDataMasterCouriersJSon');
    Route::get('getDataMasterCouriersbyRegenciesJSon', [MasterDataController::class, 'getDataMasterCouriersbyRegenciesJSon'])->name('getDataMasterCouriersbyRegenciesJSon');
    Route::post('showstatuspacketJson', [TransactionDeliveryController::class, 'showstatuspacketJson'])->name('showstatuspacketJson');
    Route::get('autocompletemerchant', [
    SearchRegenciesController::class, 'autocompletemerchant'])->name('autocompletemerchant');
    Route::get('autocompletecourier', [SearchRegenciesController::class, 'autocompletecourier'])->name('autocompletecourier');
 
    Route::get('pdf', [PrintResiController::class, 'bypas']);

    //delivery
    Route::get('dashboard/delivery', [TransactionDeliveryController::class, 'index']);
    Route::get('dashboard/delivery/create', [TransactionDeliveryController::class, 'create']);
    Route::post('dashboard/delivery/insert', [TransactionDeliveryController::class, 'store']);
    Route::get('dashboard/delivery/view/{id}', [TransactionDeliveryController::class, 'show']);
    Route::post('dashboard/delivery/delete', [TransactionDeliveryController::class, 'update']);

    //transit
    Route::get('dashboard/transit', [TransactionTransitController::class, 'index']);
    Route::post('dashboard/transit/create', [TransactionTransitController::class, 'store']);
    Route::get('dashboard/transitpusat', [TransactionTransitPusatController::class, 'index']);

    //delivery kurir
    Route::get('dashboard/deliverykurir', [TransactionDeliveryKurirController::class, 'index']);
    Route::post('dashboard/deliverykurir/create', [TransactionDeliveryKurirController::class, 'store']);
    Route::get('dashboard/data', [PerwakilanController::class, 'dashboardperwakilan']);

    //information
    Route::get('dashboard/revenuedetail', [RevenueInformationController::class, 'index']);

    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::resource('admin', AdminController::class); 

        // merchant
        Route::resource('dashboard/merchant', MerchantController::class);
        Route::get('dashboard/merchant/create', [MerchantController::class, 'create']);
        Route::post('dashboard/merchant/insert', [MerchantController::class, 'store']);
        Route::post('dashboard/merchant/update', [MerchantController::class, 'update']);
        Route::get('dashboard/merchant/view/{id}', [MerchantController::class, 'show']);

        // courier
        Route::resource('dashboard/courier', CourierController::class);
        Route::get('dashboard/courier/create', [CourierController::class, 'create']);
        Route::post('dashboard/courier/insert', [CourierController::class, 'store']);
        Route::post('dashboard/courier/update', [CourierController::class, 'update']);
        Route::get('dashboard/courier/view/{id}', [CourierController::class, 'show']);

        //packet
        Route::resource('dashboard/packet', PacketController::class);
        Route::get('dashboard/packet/create', [PacketController::class, 'create']);
        Route::post('dashboard/packet/insert', [PacketController::class, 'store']);
        Route::get('dashboard/packet/view/{id}', [PacketController::class, 'show']);
        Route::post('dashboard/packet/update', [PacketController::class, 'update']);

        //pricelist
        Route::resource('dashboard/pricelist', PricelistController::class);
        Route::get('dashboard/pricelist/create', [PricelistController::class, 'create']);
        Route::post('dashboard/pricelist/insert', [PricelistController::class, 'store']);
        Route::get('dashboard/pricelist/view/{id}', [PricelistController::class, 'show']);
        Route::post('dashboard/pricelist/update', [PricelistController::class, 'update']);

        //user-login
        Route::resource('dashboard/userlogin', UserController::class);
        Route::get('dashboard/userlogin/create', [UserController::class, 'create']);
        Route::post('dashboard/userlogin/insert', [UserController::class, 'store']);
        Route::get('dashboard/userlogin/view/{id}', [UserController::class, 'show']);
        Route::post('dashboard/userlogin/update', [UserController::class, 'update']);

        //user-login-courier
        Route::resource('dashboard/userlogincourier', UserCourierController::class);
        Route::get('dashboard/userlogincourier/create', [UserCourierController::class, 'create']);
        Route::post('dashboard/userlogincourier/insert', [UserCourierController::class, 'store']);
        Route::get('dashboard/userlogincourier/view/{id}', [UserCourierController::class, 'show']);
        Route::post('dashboard/userlogincourier/update', [UserCourierController::class, 'update']);

        // Register Verification
        Route::get('dashboard/verification', [RegisterController::class, 'index']);
        Route::get('dashboard/verificationFinish', [RegisterController::class, 'history']);
        Route::post('dashboard/Confirmation', [RegisterController::class, 'create']);
        Route::post('dashboard/Finished', [RegisterController::class, 'update']);

    });
    // route perwakilan
    Route::group(['middleware' => ['cek_login:perwakilan']], function () {
        Route::resource('perwakilan', PerwakilanController::class);
       
    });
    // route mitra
    Route::group(['middleware' => ['cek_login:mitra']], function () {
        Route::resource('mitra', MitraController::class);
       
    });
    // route mitra
    Route::group(['middleware' => ['cek_login:pusat']], function () {
        Route::resource('pusat', PusatController::class);
    });
    // route mitra
    Route::group(['middleware' => ['cek_login:driver']], function () {
        Route::get('driver', [TransactionCourierCompleteController:: class, 'index']);
        Route::get('dashboard/delivery/kurir/{id}', [TransactionCourierCompleteController::class, 'show']);
        Route::post('dashboard/delivery/kurir/arrived', [TransactionCourierCompleteController::class, 'update'])->name('arrived');
    });
    

 
});