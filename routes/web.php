<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardHomeController;
use App\Http\Controllers\PaytabsPaymentController;


Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');

Route::get('/', [AuthController::class, 'login_page']);
Route::view('/page-orientation', 'welcome')->name('page-orientation');
Route::view('privacy', 'privacy')->name('privacy');
Route::view('support', 'support')->name('support');
Route::post('register', [AuthController::class, 'register'])->name('user.register');
Route::get('register', [AuthController::class, 'register_page'])->name('site_register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('login', [AuthController::class, 'login_page'])->name('get_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/patient/register', [AuthController::class, 'patientRegister'])->name('patient.register');

Route::get('/admin/home', [DashboardHomeController::class, 'admin'])
    ->middleware('auth', 'ChickAdminAuth')->name('admin_home');

Route::get('/hospital/home', [DashboardHomeController::class, 'hospital'])
    ->middleware('auth', 'ChickHospitalAuth')->name('hospital_home');

Route::get('/lab/home', [DashboardHomeController::class, 'lab'])
    ->middleware('auth', 'ChickLabAuth')->name('lab_home');

Route::get('/patient/home', [DashboardHomeController::class, 'patient'])
    ->middleware('auth', 'ChickPatientAuth')->name('patient_home');


Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});

Route::group(['prefix' => 'api/paytabs', 'as' => 'paytabs.'], function () {
    Route::get('payment', [PaytabsPaymentController::class, 'createPayPage'])->name('createPayPage');
    Route::post('callback', [PaytabsPaymentController::class, 'callback'])->name('callback')
        ->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
});


include 'admin.php';

