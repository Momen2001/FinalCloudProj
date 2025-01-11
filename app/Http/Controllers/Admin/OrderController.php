<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainServiceRequest;
use App\Models\MainService;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        //  abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $orderStatus = $request->orderStatus;
        $data['orders'] = Order::query()->when($orderStatus, function ($qq) use($orderStatus){
            return $qq->where('status',$orderStatus);
        })->orderBy('id','DESC')->get();
        return view('admin.orders.index', $data);
    }

    public function show($orderId)
    {
        //  abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['order'] = Order::query()->find($orderId);
        return view('admin.orders.show', $data);
    }

    public function edit($mainServiceId)
    {
        // abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['main_service'] = MainService::query()->find($mainServiceId);

        return view('admin.mainService.edit', $data);
    }

    public function update(MainServiceRequest $request, $MainServiceId)
    {
        $MainService = MainService::query()->find($MainServiceId);

        DB::beginTransaction();

        $file = null;
        if ($request->has('photo')) {
            $file = uploadImage('main-service', $request->photo);
        }

        $data = [
            'ar' => [
                "title" => $request->title_ar
            ],
            'en' => [
                "title" => $request->title_en
            ],
            'status' => $request->status,
            'photo' => $file,
        ];

        $MainService->update($data);
        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

}
