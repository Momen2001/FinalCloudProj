<?php

namespace App\Http\Controllers;

use App\Models\User;


class DashboardHomeController extends Controller
{

    public function admin()
    {
         return view('admin.home');
    }

    public function hospital()
    {
        $hospital_id = auth()->user()->id;
        $data['orderPaymentForHospital'] = \App\Models\OrderPayment::query()->where('status_transaction', 'success')->whereHas('order', function ($order) use ($hospital_id) {
            $order->where('hospital_id', $hospital_id);
        })->sum('amount');
        $data['countHospitalMainServices'] = auth()->user()->hospitalMainServices()->count();
        $data['doctorsHospital'] = User::query()->WhereDoctorInHospital($hospital_id)->count();
        return view('hospital.home', $data);
    }

    public function lab()
    {
        $lab_id = auth()->user()->id;
        $data['totalPayments'] = \App\Models\OrderPayment::query()->where('status_transaction', 'success')->whereHas('order', function ($order) use ($lab_id) {
            $order->where('hospital_id', $lab_id);
        })->sum('amount');

        $data['totalOrders'] = \App\Models\Order::query()->where('hospital_id', $lab_id)->count();

        return view('lab.home',$data);
    }
    public function patient()
    {
        $patient_id = auth()->user()->id;
        $data['totalPayments'] = \App\Models\OrderPayment::query()
            ->where('status_transaction', 'success')->whereHas('order', function ($order) use ($patient_id) {
            $order->where('owner_patient_id', $patient_id);
        })->sum('amount');

        $data['totalOrders'] = \App\Models\Order::query()->where('owner_patient_id', $patient_id)->count();

        return view('patient.home',$data);
    }
}







