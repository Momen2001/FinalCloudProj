<?php

namespace App\Traits;

use App\Models\Category;
use App\Models\Offer;
use App\Models\PaymentHospitalMainService;
use App\Models\PaymentMethod;
use App\Models\User;


trait OfferTrait
{
    public function indexTrait(): array
    {
        $hospitalId = auth()->user()->id;
        $data['offers'] = Offer::query()->whereHospital($hospitalId)->orderById()->get();
        return $data;
    }

    public function editTrait($offerId): array
    {
        $authHospitalId = auth()->user()->id;
        $offerMainServiceId = mainServiceById()['Offer'];
        $data['offer'] = Offer::query()->whereHospital($authHospitalId)->find($offerId);
        $data['doctors'] = User::query()->whereDoctorInHospital($authHospitalId)
            ->whereHas('doctorSetting', function ($qq) {
                return $qq->where('can_work_in_hospital', 1);
            })->OrderById()->get();
        $data['categories'] = Category::query()->get();

        $payment_method_ids = PaymentHospitalMainService::query()
            ->paymentMainServiceForHospital($authHospitalId, $offerMainServiceId)->pluck('payment_method_id')->toArray();
        $data['payment_methods'] = PaymentMethod::query()->active()->whereIn('id', $payment_method_ids)->get();
        return $data;
    }


}
