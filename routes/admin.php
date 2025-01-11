<?php


use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Api\SchedulesHospitalMainServicesController;
use App\Http\Controllers\Lab\DoctorsController as LabDoctorsController;
use App\Http\Controllers\Lab\HospitalMedicalSessionsController;
use App\Http\Controllers\Lab\OrderController;
use App\Http\Controllers\Patient\OrderController as PatientOrderController;


Route::post('/filter/cities', [HomeController::class, 'filterCities'])->name('admin.filterCities');
Route::post('/filter/subcategory', [HomeController::class, 'filterSubcategory'])->name('admin.filterSubcategory');
Route::get('change/language/{lang}', [HomeController::class, 'change_language'])->name('change_language');
Route::get('get/reject/reasons', [HomeController::class, 'getRejectReasons'])->name('get.reject.reasons');

Route::group(['middleware' => ['auth']], function () {
    Route::impersonate();
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'ChickAdminAuth']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');
    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');
    // Users
    Route::delete('user/destroy', 'UsersController@massDestroy')->name('user.massDestroy');
    Route::get('user/change-password', [UsersController::class, 'changePassword'])->name('user.changePassword');
    Route::post('user/change-password', [UsersController::class, 'saveChangePassword'])->name('user.saveChangePassword');
    Route::resource('user', 'UsersController');
    Route::resource('notifications', 'NotificationsController');
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
    Route::resource('/patient', 'PatientController');
    Route::resource('/lab', 'LabController');
    Route::resource('/manager', 'AdminController');
    Route::resource('/main-service', 'MainServiceController');
     Route::resource('/order', 'OrderController');
    Route::resource('/advertisement', 'AdvertisementsController');
    Route::resource('/service', 'ServiceController');
    Route::resource('/medicalType', 'MedicalTypeController');
    Route::resource('/reportTypes', 'ReportTypesController');
    Route::resource('/countries', 'CountriesController');

    Route::resource('settings', 'SettingController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
    Route::post('settings/save-setting', 'SettingController@saveSetting')->name('settings.saveSetting');

    Route::group(['prefix' => 'cities', 'as' => 'cities.'], function () {
        Route::get('country/{countryId}', [CitiesController::class, 'index'])->name('index');
        Route::get('{cityId}/edit', [CitiesController::class, 'edit'])->name('edit');
        Route::PUT('{cityId}/update', [CitiesController::class, 'update'])->name('update');
        Route::post('store/{countryId}', [CitiesController::class, 'store'])->name('store');
        Route::delete('{cityId}/delete', [CitiesController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'subcategories', 'as' => 'subcategories.'], function () {
        Route::get('/category/{categoryId}', [SubcategoryController::class, 'index'])->name('index');
        Route::get('{subcategoriesId}/edit', [SubcategoryController::class, 'edit'])->name('edit');
        Route::PUT('{subcategoriesId}/update', [SubcategoryController::class, 'update'])->name('update');
        Route::post('store', [SubcategoryController::class, 'store'])->name('store');
        Route::delete('{subcategoriesId}/delete', [SubcategoryController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'medicalSessions', 'as' => 'medicalSessions.'], function () {
        Route::get('', [MedicalSessionsController::class, 'index'])->name('index');
        Route::get('show/{serviceId}', [MedicalSessionsController::class, 'show'])->name('show');
        Route::get('show/details/{medicalSessionsId}', [MedicalSessionsController::class, 'details'])->name('details');
        Route::get('create/{serviceId}', [MedicalSessionsController::class, 'create'])->name('create');
        Route::post('store/{serviceId}', [MedicalSessionsController::class, 'store'])->name('store');
        Route::get('edit/{serviceId}', [MedicalSessionsController::class, 'edit'])->name('edit');
        Route::put('update/{serviceId}', [MedicalSessionsController::class, 'update'])->name('update');

    });

    Route::group(['prefix' => 'offer', 'as' => 'offer.'], function () {
        Route::get('', [OfferController::class, 'index'])->name('index');
        Route::get('acceptance', [OfferController::class, 'Acceptance'])->name('acceptance');
        Route::get('rejected', [OfferController::class, 'Rejected'])->name('rejected');
        Route::get('updateShowing/{id}', [OfferController::class, 'updateShowing'])->name('updateShowing');
        Route::get('show/{offerId}', [OfferController::class, 'show'])->name('show');
        Route::post('accept/{offerId}', [OfferController::class, 'accept'])->name('accept');
        Route::post('reject/{offerId}', [OfferController::class, 'reject'])->name('reject');
        Route::get('{offerId}/reject-reason', [OfferController::class, 'getRejectReason'])->name('rejectReason');
    });

});





Route::group(['prefix' => 'lab', 'as' => 'lab.', 'namespace' => 'Lab', 'middleware' => ['auth', '2fa', 'ChickLabAuth']], function () {
    Route::get('user/change-password', [UsersController::class, 'labChangePassword'])->name('user.changePassword');
    Route::post('user/change-password', [UsersController::class, 'saveChangePassword'])->name('user.saveChangePassword');
    Route::resource('main-service', 'MainServiceController');
    Route::resource('doctor', 'DoctorsController');
    Route::resource('patient', 'LabPatientController');
    Route::resource('doctor-service', 'DoctorServicesController');
    Route::resource('orders', 'OrderController');
    Route::resource('education', 'DoctorEducationController');
    Route::resource('experience', 'DoctorExperiencesController');

    Route::post('order/assign/doctor', [OrderController::class, 'orderAssignDoctor'])->name('orders.orderAssignDoctor');
    Route::post('order/add/medical/test', [OrderController::class, 'storeMedicalTest'])->name('orders.addMedicalTest');
    Route::post('order/{orderId}/start/work', [OrderController::class, 'orderStartWork'])->name('orderStartWork');
    Route::post('order/{orderId}/accept', [OrderController::class, 'acceptOrder'])->name('acceptOrder');
    Route::post('order/{orderId}/complete', [OrderController::class, 'completeOrder'])->name('completeOrder');
    Route::post('order/{orderId}/reject', [OrderController::class, 'rejectOrder'])->name('rejectOrder');
    Route::post('/{hospitalId}/update-schedule/main-services/{mainServiceId}', [SchedulesHospitalMainServicesController::class, 'update'])->name('update-schedule');
    Route::resource('insurance/main-services', 'InsuranceMainServicesController', [
        'names' => [
            'show' => 'insurance.main-services.show',
            'edit' => 'insurance.main-services.edit',
            'update' => 'insurance.main-services.update',
            'store' => 'insurance.main-services.store',
            'destroy' => 'insurance.main-services.destroy',
        ]]);
    Route::resource('adjust/services', 'AdjustServiceController', [
        'names' => [
            'show' => 'adjust-services.show',
            'edit' => 'adjust-services.edit',
            'update' => 'adjust-services.update',
            'store' => 'adjust-services.store',
            'destroy' => 'adjust-services.destroy',
        ]]);
    Route::post('adjust/services/details', [AdjustServiceController::class, 'servicesDetails'])->name('adjust-services.servicesDetails');
    Route::post('filter/service/by/mainService', [HospitalMedicalSessionsController::class, 'filterServiceByMainService'])->name('labFilterServiceByMainService');

    Route::get('doctor/{doctirId}/edit/schedule/outside', [LabDoctorsController::class, 'editScheduleOutside'])->name('doctor.edit.scheduleOutside');
    Route::post('doctor/{doctirId}/update/schedule/outside', [LabDoctorsController::class, 'updateScheduleOutside'])->name('doctor.update.scheduleOutside');
    Route::get('doctor/{doctorId}/edit/schedule/inside', [LabDoctorsController::class, 'editScheduleInside'])->name('doctor.edit.scheduleInside');
    Route::post('doctor/{doctorId}/update/schedule/inside', [LabDoctorsController::class, 'updateSchedulInside'])->name('doctor.update.scheduleInside');


});


Route::group(['prefix' => 'patient', 'as' => 'patient.', 'namespace' => 'Patient', 'middleware' => ['auth', '2fa', 'ChickPatientAuth']], function () {
    Route::get('user/change-password', [UsersController::class, 'labChangePassword'])->name('user.changePassword');
    Route::post('user/change-password', [UsersController::class, 'saveChangePassword'])->name('user.saveChangePassword');

    Route::resource('orders', 'OrderController');
    Route::resource('/address', 'AddressController');
    Route::get('/labs-by-service/{id}', [PatientOrderController::class, 'getLabsByService'])->name('labs.by.service');
    Route::get('schedule/lab/{id}', [PatientOrderController::class, 'hospitalDivisionHourScheduleMainService'])->name('lab.schedule');


});
