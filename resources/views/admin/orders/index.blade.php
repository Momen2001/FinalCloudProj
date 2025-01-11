@extends('layouts.main')
@section('title',trans('global.show') .' '. trans('cruds.orders.title'))
@section('content')
    @include('includes.toolbar')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.orders.title') }}</span>
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">


            <table id="kt_datatable_dom_positioning"
                   class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                <tr class="fw-bold fs-6 text-gray-800 px-7">
                    <th class="w-25px">
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                        </div>
                    </th>
                    <th class="min-w-80px"> {{ trans('cruds.orders.fields.id') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.orders.fields.order_id') }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.orders.fields.main_service_id') }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.orders.fields.owner_patient_id') }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.orders.service_provider') }}</th>
                    <th class="min-w-120px">{{ trans('cruds.orders.fields.status') }}</th>
                    <th class="min-w-100px text-end"> {{ trans('global.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($orders  as $key => $order)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </td>
                        <td>
                            <a class="text-dark fw-bold text-hover-primary fs-6">#{{ $order->id }}</a>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">#{{ $order->order_id ?? '' }}</a>

                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $order->mainService->title ?? '' }}</a>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $order->ownerPatient->email ?? '' }}
                            </a>
                            <span
                                class="text-muted fw-semibold text-muted d-block fs-7">{{  $order->ownerPatient->getFullPhone() ?? ''}}+</span>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $order->getHospitalInformation()?->getProviderName()?? '' }}
                            </a>
                            <span
                                class="text-muted fw-semibold text-muted d-block fs-7">{{ $order->getHospitalInformation()?->getFullPhone()?? ''}}+</span>
                        </td>
                        <td>
                            <span
                                class="badge  @if(in_array($order->status,[OrderStatus()['rejected'],OrderStatus()['cancel']])) badge-danger @else badge-success @endIf">
                                {{ OrderStatusByNumber_Web()[$order->status]  }}
                            </span>
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.order.show', $order->id) }}"
                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                @include('partials.icons.show')
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

