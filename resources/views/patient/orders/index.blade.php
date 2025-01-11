@extends('layouts.patient')
@section('title',trans('global.show') .' '. trans('cruds.orders.title_singular'))
@section('content')
    @include('includes.patient.toolbar')

    <div class="card mb-5 mb-xl-8">
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <!--begin::Toolbar-->

            <!--end::Toolbar-->
            <!--begin::Post-->
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <!--begin::Container-->
                <div id="kt_content_container" class="container-xxl">

                    <div class="card">
                        <!--begin::Header-->
                        <div class="card-header card-header-stretch">
                            <!--begin::Title-->
                            <div class="card-title">
                                <h3>{{ trans('global.view',[],session('locale')) }} {{ trans('cruds.orders.title',[],session('locale')) }}</h3>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body p-0">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table id="kt_datatable_dom_positioning"
                                       class="table table-row-bordered table-row-dashed gy-5 gs-7 border rounded">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                                        <th class="w-25px">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            </div>
                                        </th>
                                        <th class="min-w-80px">{{ trans('cruds.orders.fields.id',[],session('locale')) }}</th>
                                        <th class="min-w-120px">{{ trans('cruds.orders.service_provider',[],session('locale')) }}</th>
                                        <th class="min-w-120px">{{ trans('cruds.orders.fields.owner_patient_id',[],session('locale')) }}</th>
                                        <th class="min-w-140px">{{ trans('cruds.orders.fields.order_id',[],session('locale')) }}</th>
                                        <th class="min-w-120px">{{ trans('cruds.orders.fields.main_service_id',[],session('locale')) }}</th>
                                        <th class="min-w-120px">{{ trans('cruds.orders.fields.insurance_company_id',[],session('locale')) }}</th>
                                        <th class="min-w-120px">{{ trans('cruds.orders.fields.status',[],session('locale')) }}</th>
                                        <th class="min-w-100px text-end">{{ trans('global.actions',[],session('locale')) }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <td>
                                                <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                </div>
                                            </td>
                                            <td>
                                                <a class="text-dark fw-bold text-hover-primary fs-6">#{{ $order->id }}</a>
                                            </td>
                                            @if($order->doctor)
                                                <td>{{$order->doctor->getProviderName()}}</td>
                                            @else
                                                <td>{{ trans('cruds.orders.in_lab')}}</td>
                                            @endif
                                            <td>{{$order->ownerPatient->first_name}}</td>

                                            <td>
                                                <a class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">#{{ $order->order_id ?? '' }}</a>
                                            </td>
                                            <td>
                                                <a class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $order->mainService->title ?? '' }}</a>
                                            </td>
                                            <td>
                                                <a class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $order->insuranceComp ? $order->insuranceComp->title : trans('cruds.not_have') }}</a>
                                            </td>
                                            <td>
                                                <span class="badge


                                                 @if($order->status ==OrderStatus()['rejected'])
                                                  badge-danger
                                                  @elseif($order->status == OrderStatus()['cancel'])
                                                  badge-dark
                                                   @elseif($order->status == OrderStatus()['awaitingAccept'] )
                                                   badge-light-primary
                                                   @elseif($order->status == OrderStatus()['awaitingPayment'])
                                                    badge-info
                                                     @else
                                                      badge-success
                                                       @endIf">
                                                    {{ OrderStatusByNumber()[$order->status] }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('patient.orders.show', $order->id) }}"
                                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    @include('partials.icons.show')
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Body-->
                    </div>

                </div>
                <!--end::Container-->
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>

    </script>

@endsection

