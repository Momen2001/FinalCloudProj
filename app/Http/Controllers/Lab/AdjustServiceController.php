<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hospital\CreateServicesRequest;
use App\Http\Requests\Hospital\UpdatePriceServicesRequest;
use App\Models\HospitalMainService;
use App\Models\HospitalServices;
use App\Models\Service;
use App\Traits\AdjustServiceTrait;
use Illuminate\Http\Request;


class AdjustServiceController extends Controller
{
    use AdjustServiceTrait;

    public function index()
    {

    }

    public function store(CreateServicesRequest $request)
    {
        return $this->storeTrait($request);

    }

    public function edit($labServicesId)
    {
        $hospital_id = auth()->user()->id;
        $data['hospitalServices'] = HospitalServices::query()->where('hospital_id', $hospital_id)->find($labServicesId);

        if ($data['hospitalServices']) {
            return view('lab.adjustService.edit', $data);
        } else {
            return redirect()->back();
        }
    }

    public function update(UpdatePriceServicesRequest $request, $labServicesId)
    {
        return $this->updateTrait($request, $labServicesId);
    }

    public function show($mainServiceId)
    {
        $hospitalId = auth()->user()->id;
        $checkHospitalHasMainService = HospitalMainService::query()->HospitalHasMainService($hospitalId, $mainServiceId)->first();
        if ($checkHospitalHasMainService) {

            $data['hospitalServices'] = HospitalServices::query()->GetServicesBelongsToMainService($hospitalId, $mainServiceId)->with('service')->get();
            $servicesUses = $data['hospitalServices']->pluck('service_id')->toArray();
            $data['services'] = Service::query()->Active()->whereNotIn('id', $servicesUses)->WhereMainService($mainServiceId)->get();
            $data['main_service_id'] = $mainServiceId;

            if ($data['services']->count() == 0) {
                $data['msg'] = trans('global.not_available_other_services');
            } else {
                $data['msg'] = trans('global.select_services');
            }

            return view('lab.adjustService.index', $data);
        } else {
            toastr()->error(trans('global.sorry_cant_open_this_main_service'), ['timeOut' => 20000, 'closeButton' => true]);
            return redirect()->back();
        }

    }

    public function servicesDetails(Request $request)
    {
        $service = Service::query()->find($request->service_id);
        return response()->json([
            'status' => true,
            'service' => $service,
        ]);

    }

    public function destroy($labServicesId)
    {
        return $this->destroyTrait($labServicesId);
    }

}
