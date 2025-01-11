<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainServiceRequest;
use App\Http\Requests\Hospital\RejectOrderRequest;
use App\Http\Requests\Lab\MedicalTestRequest;
use App\Http\Resources\OrderMedicalTestResource;
use App\Models\Order;
use App\Models\OrderMedical;
use App\Models\User;
use App\Traits\OrderTrait;
use Gate;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use OrderTrait;

    public function index(Request $request)
    {
        $orderStatus = $request->orderStatus;
        $data = $this->indexTrait($orderStatus);
        return view('lab.orders.index', $data);
    }

    public function show($orderId)
    {
        $hospitalId = auth()->user()->id;
        $hospitalDoctors = User::query()->WhereDoctorInHospital($hospitalId)->pluck('id')->toArray();
        $data['order'] = Order::query()->findOrFail($orderId);
        $data['doctors'] = $this->getSuggestDoctors($data['order']['id']);
        if ($data['order']['hospital_id'] == $hospitalId || in_array($data['order']['doctor_id'], $hospitalDoctors)) {
            return view('lab.orders.show', $data);
        } else {
            return redirect()->route('lab.orders.index');
        }
    }

    public function getSuggestDoctors($orderId)
    {
        $order = Order::query()->find($orderId);
        //check order type (service or package)

        $services = $order->ordersServices->pluck('id')->toArray();

        if ($services != null) {
            $docs = User::query()->WhereDoctorInHospital(auth()->user()->id)->whereHas('doctorService')->get();
            $selectDoctors = [];

            if (count($docs) != 0) {
            foreach ($docs as $doctor) {
                $doctor_service_id = $doctor->doctorService->pluck('pivot.service_id')->toArray();
                $array = array_diff($services, $doctor_service_id);

                if ($array == null) {
                    //get  all doctors that provide the same service selected by the patient
                    $selectDoctors[] = $doctor->id;
                }
                $doctors = User::query()->whereIn('id', $selectDoctors)->get();
            }
            }else{
                $doctors = [];
            }
        }

        return $doctors;
    }


    public function edit($mainServiceId)
    {
        $data = $this->editTrait($mainServiceId);
        return view('lab.mainService.edit', $data);
    }

    public function update(MainServiceRequest $request, $MainServiceId)
    {

    }


    public function orderStartWork($orderId)
    {
        return $this->orderStartWorkTrait($orderId);

    }


    public function acceptOrder($orderId)
    {
        return $this->acceptOrderTrait($orderId);
    }

    public function completeOrder($orderId)
    {
        return $this->completeOrderTrait($orderId);

    }

    public function rejectOrder(RejectOrderRequest $request, $orderId)
    {
        return $this->rejectOrderTrait($orderId,$request);
    }

    public function orderAssignDoctor(Request $request)
    {
        return $this->orderAssignDoctorTrait($request);
    }

    public function storeMedicalTest(MedicalTestRequest $request): \Illuminate\Http\JsonResponse
    {
        try {

            $order = Order::query()->find($request->order_id);
            if ($order) {
                 OrderMedical::query()->create([
                    'order_id' => $request->order_id,
                    'description' => $request->description,
                    'instruction' => $request->instruction,
                ]);
                return response()->json(['status' => true, 'msg' => trans('global.create_successfully')]);

            } else {
                return response()->json(['status' => false, 'msg' => trans('global.sorry_cant_add_medical_test')]);
            }
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'msg' => trans('global.some_error')]);
        }
    }
}
