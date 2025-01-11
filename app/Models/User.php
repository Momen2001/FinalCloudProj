<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasFactory;
    use Auditable;
    use HasApiTokens;
    use Impersonate;

    public $table = 'users';

    protected $hidden = [
        'remember_token', 'two_factor_code',
        'password', 'verification_token'
    ];

    public $appends = ['lab_name'];


    protected $dates = [
        'email_verified_at',
        'verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
        'two_factor_expires_at',
    ];
    const USER_TYPE = [
        'Admin'=> 1,
        'Lab'=> 2,
        'Patient'=> 3,
        'Doctor'=> 4,

    ];


    protected $guarded = [''];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

    }

    public function getType()
    {
        switch ($this->role_id) {
            case '1';
                return 'Admin';
                break;
            case '2':
                return 'Lab';
                break;
            case '3':
                return 'Patient';
                break;
            case '4':
                return 'Doctor';
                break;
        }
    }

    public function scopeWhereAdmin($q)
    {
        return $q->where('role_id', 1);
    }

    public function scopeWhereHospital($q)
    {
        return $q->where('role_id', 5);
    }


    public function scopeWhereHospitalOrLab($q)
    {
        return $q->where('role_id', 5)->orWhere('role_id', 2);
    }

    public function scopeWherePatient($q)
    {
        return $q->where('role_id', 3);
    }

    public function scopeWhereDoctor($q)
    {
        return $q->where('role_id', 4);
    }

    public function scopeWhereLab($q)
    {
        return $q->where('role_id', 2);
    }

    public function getProviderName()
    {
        if ( in_array($this->getType(),["Hospital","Lab"])) {
            return get_default_lang() == "ar" ? $this->provider_name_ar : $this->provider_name_en;
        } elseif ($this->getType() == "Doctor") {
            return get_default_lang() == "ar" ? trans('global.dr', [], 'ar') . ' ' .  $this->first_name . ' ' . $this->last_name : trans('global.dr', [], 'en') . ' ' .  $this->first_name_en . ' ' . $this->last_name_en;
        } elseif ($this->getType() == "Patient") {
            return get_default_lang() == "ar" ?  $this->first_name . ' ' . $this->last_name :    $this->first_name_en . ' ' . $this->last_name_en;
        }
    }

    public function getLabNameAttribute()
    {
        return get_default_lang() == "ar" ? $this->provider_name_ar : $this->provider_name_en;
    }
    public function getTranslationName()
    {
        if (get_default_lang() == "ar") {
            return trans('global.dr', [], 'ar') . ' ' . $this->first_name . " " . $this->last_name;
        } else {
            return trans('global.dr', [], 'en') . ' ' . $this->first_name_en . " " . $this->last_name_en;
        }
    }

    public function getPatientFullName()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getTranslationAboutUs()
    {
        if (get_default_lang() == "ar") {
            return $this->about_us_ar;
        } else {
            return $this->about_us_en;
        }
    }

    public function scopeWhereDoctorInHospital($q, $hospitalId)
    {
        // get doctors work in hospital
        return $q->where('role_id', 4)->whereHas('doctorSetting', function ($qq) use ($hospitalId) {
            return $qq->where('hospital_id', $hospitalId);
        });
    }

    public function scopeWhereDoctorInHospitalCanWorkInSide($q, $hospitalId)
    {
        // get doctors work in hospital
        return $q->where('role_id', 4)->whereHas('doctorSetting', function ($qq) use ($hospitalId) {
            return $qq->where('hospital_id', $hospitalId)->whereCanWorkInHospital();
        });
    }

//    public function getFullName()
//    {
//        return "$this->first_name  $this->last_name";
//    }
//
    public function translateFirstName()
    {
        return get_default_lang() == 'en' ? $this->first_name_en : $this->first_name;
    }
    public function translateLastName()
    {
        return get_default_lang() == 'en' ? $this->last_name_en : $this->last_name;
    }

    public function getFullPhone()
    {
        return $this->intro . $this->phone;
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

//    public function setEmailVerifiedAtAttribute($value)
//    {
//        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
//    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

//    public function setVerifiedAtAttribute($value)
//    {
//        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
//    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getTwoFactorExpiresAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTwoFactorExpiresAtAttribute($value)
    {
        $this->attributes['two_factor_expires_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function age()
    {
        return \Carbon\Carbon::parse($this->birth_date)->diff(\Carbon\Carbon::now())->format('%y '.trans('global.year'));
    }

    public function doctorExperienceCount()
    {
        return \Carbon\Carbon::parse($this->doctorSetting->experience_start_work)->diff(\Carbon\Carbon::now())->format('%y '.trans('global.year'));
    }

    public function getGender()
    {
        return $this->gender == 'male' ? trans('global.male') : trans('global.female');

    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function walletPatient(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(WalletPatient::class, 'patient_id', 'id');
    }
    public function hospitalLocation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(HospitalLocation::class, 'hospital_id', 'id');
    }

    public function doctorSetting(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(DoctorSetting::class, 'doctor_id', 'id');
    }



    public function hospitalOffers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Offer::class, 'hospital_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }



    public function getPhotoAttribute($value): string
    {
        if (!$value) {
            return asset('assets/user.png');
        }
        return asset('storage/users/' . $value);
    }

    public function getBirthDateAttribute($value): string
    {
        return Carbon::parse($value)->locale('en')->isoFormat('D MMM Y');
    }

    public function scopeUserByPhone($query, $phone, $intro)
    {
        return $query->where('phone', "$phone")->where('intro', "$intro");
    }

    public function scopeUserByEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function address(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function educations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Education::class, 'doctor_id', 'id');
    }

    public function experiences(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Experience::class, 'doctor_id', 'id');
    }

    public function doctorWorkOutsideSchedules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        //doctor Work Schedules  outside hospital (online) or (home visit)
        return $this->hasMany(WorkSchedule::class, 'doctor_id', 'id');
    }

    public function doctorWorkInsideSchedules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        //doctor Work Schedules  inside hospital
        return $this->hasMany(ScheduleInHospital::class, 'doctor_id', 'id');
    }


    public function HospitalServices(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'hospital_services', 'hospital_id', 'service_id')->withPivot('hospital_id', 'id', 'service_id', 'price');
    }

    public function doctorService(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
         return $this->belongsToMany(Service::class, 'doctor_services', 'doctor_id', 'service_id')->withPivot('id')->wherePivotNull('deleted_at');

    }



    public function hospitalMainServices(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(MainService::class, 'hospital_main_services', 'hospital_id', 'main_service_id')->withPivot('can_work_out_side', 'time_before_receiving')->wherePivotNull('deleted_at');
    }

    public function insuranceHospitalMainService(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

        return $this->hasMany(InsuranceHospitalMainService::class, 'hospital_id', 'id');
    }

    public function scopeHospitalWorkMainServices($query, $mainService)
    {
        return $query->whereHas('hospitalMainServices', function ($q) use ($mainService) {
            return $q->where('main_service_id', $mainService);
        });
    }

    public function scopeHospitalWorkMainServicesValidation($query, $mainService, $placeServiceProvided)
    {
        //placeServiceProvided == 0 (hospital can provide the main services just outside hospital)
        //placeServiceProvided == 1 (hospital can provide the main services just inside hospital)
        //placeServiceProvided == 2 (hospital can provide the main services  inside and outside hospital)
        //this function return hospital work in main service  and check if this hospital  work inside or outside
        return $query->whereHas('hospitalMainServices', function ($q) use ($mainService, $placeServiceProvided) {
            return $q->where('main_service_id', $mainService->id)->whereIn('can_work_out_side', [$placeServiceProvided, placeServiceProvided()['inside_and_out_side_hospital']]);
        });
    }

    public function scopeHospitalWorkInServices($query, $service)
    {
        return $query->whereHas('hospitalServices', function ($q_) use ($service) {
            return $q_->where('service_id', $service);
        });
    }



    public function scopeHospitalWorkInMedicalSessions($query, $medical_session_id)
    {
        return $query->whereHas('hospitalMedicalSessions', function ($q_) use ($medical_session_id) {
            return $q_->where('medical_session_id', $medical_session_id);
        });
    }

    public function HospitalMedicalSessions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(MedicalSession::class, 'medical_session_hospitals', 'hospital_id', 'medical_session_id')->withPivot('hospital_id', 'id', 'medical_session_id', 'price')->wherePivot('deleted_at', null);
    }

    public function medicalRecords(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MedicalReport::class, 'patient_id', 'id');
    }

    public function scopeOrderById($q)
    {
        return $q->orderBy('id', 'DESC');
    }

    public function getPatientOrderCount($patientId): string
    {
        $derCount = Order::query()->where('owner_patient_id', $patientId)->count();
        return (string)$derCount;
    }

    public function couponHospitals(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Coupon::class, 'hospital_coupons', 'hospital_id', 'coupon_id');
    }

    public function canImpersonate()
    {
        // For example
        return $this->getType() == 'Admin';
    }

    public function doctorRatingPercentageToAllOrders($doctorId)
    {
        $doctorOrders = Order::query()->doctorOrders($doctorId)->whereHas('orderRate')->get();
        if ($doctorOrders->count() != 0) {
            $orderRatingPercentage = [];
            foreach ($doctorOrders as $doctorOrder) {
                $orderRatingPercentage[] = $doctorOrder->calculateOrderRatingPercentage();
            }
            $orderRatingPercentage = array_sum($orderRatingPercentage) / $doctorOrders->count();
            return round($orderRatingPercentage, 2);
        } else {
            return 0;
        }
    }

    public function hospitalRatingPercentageToAllOrders($hospitalId)
    {
        $hospitalOrders = Order::query()->whereHospitalOrders($hospitalId)->whereHas('orderRate')->get();

        if ($hospitalOrders->count() != 0) {
            $orderRatingPercentage = [];
            foreach ($hospitalOrders as $hospitalOrder) {
                $orderRatingPercentage[] = $hospitalOrder->calculateOrderRatingPercentage();
            }
            $orderRatingPercentage = array_sum($orderRatingPercentage) / $hospitalOrders->count();
            return round($orderRatingPercentage, 2);

        } else {
            return 0;
        }
    }

    public function ordersHospitalWhereHasRating($hospitalId)
    {
        return Order::query()->whereHas('orderRate')->whereHospitalOrders($hospitalId)->get();
    }

    public function orderDoctorCount($doctorId)
    {
        return Order::query()->doctorOrders($doctorId)->count();
    }
    public function orderDoctorWhereHasRating($doctorId)
    {
        return Order::query()->whereHas('orderRate')->doctorOrders($doctorId)->get();
    }

    public function scopeWhereInId($qq, $ids)
    {
        return $qq->whereIn('id', $ids);
    }

    public function scopeWhereHospitalNotDeleted($q)
    {
        return $q->whereHas('doctorSetting', function ($q) {
            $q->whereHas('hospital', function ($qq) {
                return $qq->whereNull('deleted_at');
            });
        });
    }

    public function getDoctorMainServicePrice($request)
    {
        $mainServiceId = $request->main_service_id;
        $mainServicePrice = null;
        if ($mainServiceId == mainServiceById()['Appointment']) {
            $mainServicePrice = $this->doctorSetting['in_hospital_price'];
        } else if ($mainServiceId == mainServiceById()['HomeVisitUrgent']) {
            $mainServicePrice = $this->doctorSetting['emergency_home_visit_price'];
        } else if ($mainServiceId == mainServiceById()['TeleMedicUrgent']) {
            $mainServicePrice = $this->doctorSetting['emergency_online_price'];
        } else if ($mainServiceId == mainServiceById()['TeleMedic']) {
            $mainServicePrice = $this->doctorSetting['online_price'];
        }
        return $mainServicePrice;

    }
}
