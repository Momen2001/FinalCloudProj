<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'orders';
    protected $guarded = [];

    const UseInsurance = [
        'UsedInsurance' => 1,
        'NotUsedInsurance' => 0,
    ];

    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }

    public function ownerPatient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_patient_id', 'id');
    }

    public function hospital(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'hospital_id', 'id');
    }

    public function doctor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function address(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

    public function medicalTest(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderMedical::class, 'order_id', 'id');
    }


    public function mainService(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MainService::class, 'main_service_id', 'id');
    }

    public function ordersServices(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'order_services');
    }



    public function orderInsurance(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(OrderInsurance::class, 'order_id', 'id');
    }

    public function offer(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }

    public function orderRate(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(OrderRate::class, 'order_id', 'id');
    }

    public function orderPayment(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderPayment::class, 'order_id', 'id');
    }

    public function orderAttachment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(OrderAttachment::class, 'order_id', 'id');
    }

    public function coupon(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(OrderCoupon::class, 'order_id', 'id');
    }

    public function orderMedicalSession(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderMedicalSession::class, 'order_id', 'id');
    }

    public function scopeCheckDoctorIfFree($query, $doctor_id, $booking_date, $booking_day_en, $booking_hour)
    {
        $query->where('doctor_id', $doctor_id)
            ->where('booking_date', $booking_date)
            ->where('booking_day_en', $booking_day_en)
            ->where('booking_hour', $booking_hour)
            ->whereHas('orderPayment', function ($query) {
                return $query->where('status_transaction', 'success');
            });
    }

    public function scopeCheckHospitalHasReservationMainService($query, $hospital_id, $main_service_id, $booking_date, $booking_day_en, $booking_hour)
    {
        $query->where('hospital_id', $hospital_id)
            ->where('main_service_id', $main_service_id)
            ->where('booking_date', $booking_date)
            ->where('booking_day_en', $booking_day_en)
            ->where('booking_hour', $booking_hour)
            ->whereHas('orderPayment', function ($query) {
                return $query->where('status_transaction', 'success');
            });
    }

    public function scopeMyOrder($query)
    {
        return $query->where('owner_patient_id', auth()->user()->id);
    }

    public function scopeDoctorOrders($query, $user_id)
    {
        return $query->where('doctor_id', $user_id);
    }

    public function scopeWhereHospitalOrders($query, $hospital_id)
    {
        return $query->where('hospital_id', $hospital_id)->orWhereHas('doctor', function ($q) use ($hospital_id) {
            $q->whereHas('doctorSetting', function ($qq) use ($hospital_id) {
                $qq->where('hospital_id', $hospital_id);
            });
        });
    }

    public function scopeWhereCanPayment($query)
    {
        return $query->whereIn('status', [OrderStatus()['awaitingPayment'],]);
    }

    public function scopeWhereCanChangeBookingTime($query)
    {
        return $query->whereIn('status', [OrderStatus()['awaitingAccept'],OrderStatus()['awaitingPayment'],OrderStatus()['awaitingImplementation'],]);
    }

    public function scopeWhereCompleted($query)
    {
        return $query->where('status', OrderStatus()['completed']);
    }

    public function scopeWhereCanCancel($query)
    {
        return $query->whereIn('status', [
            OrderStatus()['awaitingAccept'],
            OrderStatus()['awaitingPayment'],
            OrderStatus()['awaitingImplementation'],
        ]);
    }

    public function orderAverageRate()
    {
        if ($this->orderRate) {
            $rate = (($this->orderRate->experience_rate + $this->orderRate->politeness_rate + $this->orderRate->respond_rate) / 3);
            $rate = round($rate, 1);
        } else {
            $rate = null;
        }
        return $rate;
    }

    function calculateOrderRatingPercentage()
    {
        //Note: this function can use to hospital rate or doctor rate

        // $totalPossiblePoints Total possible points (assuming each rating is out of 10)
        $totalPossiblePoints = 15; // 5 experience_rate + 5 politeness_rate + 5 respond_rat

        // Sum the ratings
        if ($this->orderRate) {
            $totalPoints = $this->orderRate->experience_rate + $this->orderRate->politeness_rate + $this->orderRate->respond_rate;
            // Calculate the percentage
            $percentageRating = ($totalPoints / $totalPossiblePoints) * 100;

            return round($percentageRating, 2); // Round to 2 decimal places
        } else {
            return 0;
        }
    }

    public function getHospitalInformation()
    {
        if ($this->hospital_id) {
            return $this->hospital;
        } elseif ($this->doctor) {
            return $this->doctor->doctorSetting->hospital;
        }
    }

    public function getDiscount()
    {
        return $this->sub_total - $this->total;
    }

    public function scopeWhereOffer($query, $offerId)
    {
        return $query->where('offer_id', $offerId);
    }
}



