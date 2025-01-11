<?php

 use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\UpdatePhoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'middleware' => ['localization', 'fcmNotification']], function () {

    Route::group(['prefix' => 'auth', 'namespace' => '\Auth'], function () {
        Route::post('register', [RegisterController::class, 'register'])->name('patient_register');
        Route::post('login-patient', [LoginController::class, 'loginPatient']);
        Route::post('login-doctor', [LoginController::class, 'loginDoctor']);
        Route::post('check-code', [RegisterController::class, 'check_code']);
        Route::post('update-phone', [UpdatePhoneController::class, 'update_phone'])->middleware('auth:api');
        Route::post('check-code-forget-password', [RegisterController::class, 'check_code_forget_password']);
        Route::post('resend-code', [RegisterController::class, 'resendCode']);
        Route::post('update-password', [RegisterController::class, 'resetPassword'])->middleware('auth:api');
        Route::post('forget-password', [RegisterController::class, 'forgetPassword']);
        Route::post('logout', [LoginController::class, 'logout'])->middleware(['auth:api']);
    });

});
