<?php


use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\DoctorEducationController;
use App\Http\Controllers\Api\DoctorExperienceController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\SchedulesDoctorController;
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


Route::group(['namespace' => 'Api', 'middleware' => ['localization', 'fcmNotification']], function () {
    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('/my-reservations', [ReservationController::class, 'doctorReservations']);
        Route::get('/reservation-details', [ReservationController::class, 'doctorReservationDetails']);
        Route::post('/reservation/change/status', [DoctorController::class, 'changeStatus']);
        Route::post('/update/profile', [DoctorController::class, 'updateProfile']);
        Route::get('/profile/info', [DoctorController::class, 'profileInfo']);
        Route::post('/update/external/info', [DoctorController::class, 'updateExternalInfo']);
        Route::post('/store/medical/test', [DoctorController::class, 'storeMedicalTest']);
        Route::post('/show/medical/test', [DoctorController::class, 'showOrderMedicalTest']);
        Route::post('/delete/medical/test', [DoctorController::class, 'deleteOrderMedicalTest']);
        Route::get('/home', [DoctorController::class, 'home']);

        Route::group(['middleware' => ['ChickDoctorAuth']], function () {
            Route::group(['prefix' => 'schedule-outside-hospital'], function () {
                Route::get('/show', [SchedulesDoctorController::class, 'show']);
                Route::post('/update', [SchedulesDoctorController::class, 'update']);
            });
            Route::group(['prefix' => 'schedule-inside-hospital'], function () {
                Route::get('/show', [SchedulesDoctorController::class, 'showScheduleInHospital']);
                Route::post('/update', [SchedulesDoctorController::class, 'updateScheduleInHospital']);
            });
            Route::group(['prefix' => 'education'], function () {
                Route::get('/index', [DoctorEducationController::class, 'index']);
                Route::get('/show/{educationId}', [DoctorEducationController::class, 'show']);
                Route::post('/store', [DoctorEducationController::class, 'store']);
                Route::post('/update/{education_id}', [DoctorEducationController::class, 'update']);
                Route::delete('/destroy/{education_id}', [DoctorEducationController::class, 'destroy']);
            });
            Route::group(['prefix' => 'experience'], function () {
                Route::get('/index', [DoctorExperienceController::class, 'index']);
                Route::get('/show/{experienceId}', [DoctorExperienceController::class, 'show']);
                Route::post('/store', [DoctorExperienceController::class, 'store']);
                Route::post('/update/{experienceId}', [DoctorExperienceController::class, 'update']);
                Route::delete('/destroy/{experienceId}', [DoctorExperienceController::class, 'destroy']);
            });
        });
    });
});
