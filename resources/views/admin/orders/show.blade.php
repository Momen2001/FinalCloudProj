@extends('layouts.main')
@section('title',trans('global.show') .' '. trans('cruds.orders.title_singular'))
@section('content')
    @include('includes.toolbar')

    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            {{ trans('global.view') }} {{ trans('cruds.orders.title_singular') }} #{{$order->order_id}}

                            <div class="card-toolbar m-4">
                                <span
                                    class="badge
                                    @if(in_array($order->status,[OrderStatus()['rejected'],OrderStatus()['cancel']]))
                                        badge-light-danger
                                    @elseif(in_array($order->status,[OrderStatus()['awaitingAccept'],
                                    OrderStatus()['awaitingPayment'],
                                    OrderStatus()['inProgress'],
                                    OrderStatus()['awaitingImplementation']]))
                                        badge-info
                                        @else
                                        badge-light-success
                                    @endIf  fw-bold me-auto px-4 py-3">
                                    {{OrderStatusByNumber_Web()[$order->status]}}</span>

                                @if($order->specialization)
                                    <span
                                        class="badge  badge-info  fw-bold me-auto px-4 py-3">{{trans('cruds.specializations.title_singular') .' '. $order->specialization->title}} </span>
                                @endIf
                                @if($order->mainService)
                                    <span
                                        class="badge badge-info fw-bold me-auto px-4 py-3">{{trans('cruds.main_service.title_singular') .' '. $order->mainService->title}} </span>
                                @endIf
                            </div>


                        </h1>
                    </div>
                </div>
                <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar-->


            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <!--begin::Order details page-->
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                            <!--begin:::Tabs-->
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-lg-n2 me-auto">
                                <!--begin:::Tab item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                       href="#kt_ecommerce_sales_order_summary">{{ trans('cruds.orders.order_summary') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                       href="#kt_ecommerce_sales_order_history">{{trans('cruds.orders.order_history')}}</a>
                                </li>
                            </ul>

                            {{--                            <a href="/metronic8/demo1/../demo1/apps/ecommerce/sales/edit-order.html"--}}
                            {{--                               class="btn btn-success btn-sm me-lg-n7">Edit Order</a>--}}
                            {{--                            <!--end::Button-->--}}

                        </div>
                        <!--begin::Order summary-->
                        <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                            <!--begin::Order details-->
                            <div class="card card-flush py-4 ">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{trans('cruds.orders.order_details')}} </h2>
                                    </div>
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                            <!--begin::Table body-->
                                            <tbody class="fw-semibold text-gray-600">
                                            <!--begin::Date-->


                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2"><svg width="20"
                                                                                                    height="21"
                                                                                                    viewBox="0 0 20 21"
                                                                                                    fill="none"
                                                                                                    xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3"
      d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z"
      fill="currentColor"/>
<path
    d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z"
    fill="currentColor"/>
</svg>
                                                         </span>
                                                        <!--end::Svg Icon--> {{trans('cruds.orders.fields.booking_date')}}
                                                    </div>
                                                </td>

                                                <td class="fw-bold text-end">{{$order->booking_date}}</td>
                                            </tr>
                                            <!--end::Date-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2"><svg width="20"
                                                                                                    height="21"
                                                                                                    viewBox="0 0 20 21"
                                                                                                    fill="none"
                                                                                                    xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3"
      d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z"
      fill="currentColor"/>
<path
    d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z"
    fill="currentColor"/>
</svg>
                                                        </span>
                                                        <!--end::Svg Icon--> {{trans('cruds.orders.fields.booking_day_en')}}
                                                    </div>
                                                </td>

                                                <td class="fw-bold text-end">{{$order->booking_day_en}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2"><svg width="20"
                                                                                                    height="21"
                                                                                                    viewBox="0 0 20 21"
                                                                                                    fill="none"
                                                                                                    xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3"
      d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z"
      fill="currentColor"/>
<path
    d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z"
    fill="currentColor"/>
</svg>
                                                        </span>
                                                        <!--end::Svg Icon--> {{trans('cruds.orders.fields.booking_hour')}}
                                                    </div>
                                                </td>

                                                <td class="fw-bold text-end">{{$order['booking_hour']}}</td>
                                            </tr>

                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Order details-->

                            <!--begin::Customer details-->
                            <div class="card card-flush py-4  flex-row-fluid">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{trans('cruds.orders.customer_patient')}}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                            <!--begin::Table body-->
                                            <tbody class="fw-semibold text-gray-600">
                                            <!--begin::Customer name-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2">
                                                            <svg width="18"
                                                                 height="18"
                                                                 viewBox="0 0 18 18"
                                                                 fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3"
      d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z"
      fill="currentColor"/>
<path
    d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z"
    fill="currentColor"/>
<rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"/>
</svg>
                                                        </span>
                                                        <!--end::Svg Icon--> {{trans('cruds.orders.fields.owner_patient_id')}}
                                                    </div>
                                                </td>

                                                <td class="fw-bold text-end">
                                                    <div class="d-flex align-items-center justify-content-end">

                                                        <!--begin::Name-->
                                                        <a
                                                            class="text-gray-600 text-hover-primary">
                                                            {{$order->ownerPatient->first_name}} </a>
                                                        <!--end::Name-->
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2"><svg width="18"
                                                                                                    height="18"
                                                                                                    viewBox="0 0 18 18"
                                                                                                    fill="none"
                                                                                                    xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3"
      d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z"
      fill="currentColor"/>
<path
    d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z"
    fill="currentColor"/>
<rect x="7" y="6" width="4" height="4" rx="2" fill="currentColor"/>
</svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        @if($order->subPatient)
                                                            {{trans('cruds.orders.fields.sub_patient_passport_id')}}
                                                        @else
                                                            {{trans('cruds.orders.fields.owner_passport_id')}}
                                                        @endif
                                                    </div>
                                                </td>
                                                @if($order->subPatient)
                                                    <td class="fw-bold text-end">
                                                        <div class="d-flex align-items-center justify-content-end">
                                                            <!--begin::Name-->
                                                            <a
                                                                class="text-gray-600 text-hover-primary">
                                                                {{$order->subPatient->passport_id}}
                                                            </a>
                                                            <!--end::Name-->
                                                        </div>
                                                    </td>

                                                @else
                                                    <td class="fw-bold text-end">
                                                        <div class="d-flex align-items-center justify-content-end">

                                                            <!--begin::Name-->
                                                            <a class="text-gray-600 text-hover-primary">
                                                                {{$order->ownerPatient->passport_id}}

                                                            </a>
                                                            <!--end::Name-->
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                            <!--end::Customer name-->

                                            <!--begin::Customer email-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2"><svg width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    fill="none"
                                                                                                    xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
      fill="currentColor"/>
<path
    d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
    fill="currentColor"/>
</svg>
                                                        </span>
                                                        <!--end::Svg Icon--> {{trans('cruds.orders.fields.ownerPatientEmail')}}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <a
                                                        class="text-gray-600 text-hover-primary">
                                                        {{$order->ownerPatient->email}} </a>
                                                </td>
                                            </tr>
                                            <!--end::Payment method-->

                                            <!--begin::Date-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2"><svg width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    fill="none"
                                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z"
                                                        fill="currentColor"/>
                                                    <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor"/>
                                                    </svg>
                                                    </span>
                                                        <!--end::Svg Icon--> {{trans('cruds.orders.fields.ownerPatientPhone')}}
                                                    </div>
                                                </td>

                                                <td class="fw-bold text-end">{{$order->ownerPatient->getFullPhone()}}</td>
                                            </tr>
                                            <!--end::Date-->
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Customer details-->
                            <!--begin::Documents-->
                            <div class="card card-flush py-4  flex-row-fluid">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{trans('cruds.orders.documents')}}</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                            <!--begin::Table body-->
                                            <tbody class="fw-semibold text-gray-600">
                                            <!--begin::Invoice-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2"><svg width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    fill="none"
                                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3"
                                                              d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                              fill="currentColor"/>
                                                        <path
                                                            d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                            fill="currentColor"/>
                                                        <path
                                                            d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                            fill="currentColor"/>
                                                        </svg>
                                                        </span>
                                                        <!--end::Svg Icon--> {{trans('cruds.orders.fields.sub_total')}}
                                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                           data-bs-toggle="tooltip" title=""
                                                           data-bs-original-title="View the invoice generated by this order."></i>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end"><a

                                                        class="text-gray-600 text-hover-primary">{{$order->sub_total}}
                                                        {{trans('global.sar')}} </a></td>
                                            </tr>
                                            <!--end::Invoice-->
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/finance/fin008.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2"><svg width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    fill="none"
                                                                                                    xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z"
      fill="currentColor"/>
<path opacity="0.3"
      d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z"
      fill="currentColor"/>
<path
    d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z"
    fill="currentColor"/>
</svg>
                                                         </span>
                                                        {{trans('cruds.orders.fields.vat_value')}}
                                                    </div>
                                                </td>

                                                <td class="fw-bold text-end">
                                                    {{$order->vat}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm011.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2"><svg width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    fill="none"
                                                                                                    xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3"
      d="M21.6 11.2L19.3 8.89998V5.59993C19.3 4.99993 18.9 4.59993 18.3 4.59993H14.9L12.6 2.3C12.2 1.9 11.6 1.9 11.2 2.3L8.9 4.59993H5.6C5 4.59993 4.6 4.99993 4.6 5.59993V8.89998L2.3 11.2C1.9 11.6 1.9 12.1999 2.3 12.5999L4.6 14.9V18.2C4.6 18.8 5 19.2 5.6 19.2H8.9L11.2 21.5C11.6 21.9 12.2 21.9 12.6 21.5L14.9 19.2H18.2C18.8 19.2 19.2 18.8 19.2 18.2V14.9L21.5 12.5999C22 12.1999 22 11.6 21.6 11.2Z"
      fill="currentColor"/>
<path
    d="M11.3 9.40002C11.3 10.2 11.1 10.9 10.7 11.3C10.3 11.7 9.8 11.9 9.2 11.9C8.8 11.9 8.40001 11.8 8.10001 11.6C7.80001 11.4 7.50001 11.2 7.40001 10.8C7.20001 10.4 7.10001 10 7.10001 9.40002C7.10001 8.80002 7.20001 8.4 7.30001 8C7.40001 7.6 7.7 7.29998 8 7.09998C8.3 6.89998 8.7 6.80005 9.2 6.80005C9.5 6.80005 9.80001 6.9 10.1 7C10.4 7.1 10.6 7.3 10.8 7.5C11 7.7 11.1 8.00005 11.2 8.30005C11.3 8.60005 11.3 9.00002 11.3 9.40002ZM10.1 9.40002C10.1 8.80002 10 8.39998 9.90001 8.09998C9.80001 7.79998 9.6 7.70007 9.2 7.70007C9 7.70007 8.8 7.80002 8.7 7.90002C8.6 8.00002 8.50001 8.2 8.40001 8.5C8.40001 8.7 8.30001 9.10002 8.30001 9.40002C8.30001 9.80002 8.30001 10.1 8.40001 10.4C8.40001 10.6 8.5 10.8 8.7 11C8.8 11.1 9 11.2001 9.2 11.2001C9.5 11.2001 9.70001 11.1 9.90001 10.8C10 10.4 10.1 10 10.1 9.40002ZM14.9 7.80005L9.40001 16.7001C9.30001 16.9001 9.10001 17.1 8.90001 17.1C8.80001 17.1 8.70001 17.1 8.60001 17C8.50001 16.9 8.40001 16.8001 8.40001 16.7001C8.40001 16.6001 8.4 16.5 8.5 16.4L14 7.5C14.1 7.3 14.2 7.19998 14.3 7.09998C14.4 6.99998 14.5 7 14.6 7C14.7 7 14.8 6.99998 14.9 7.09998C15 7.19998 15 7.30002 15 7.40002C15.2 7.30002 15.1 7.50005 14.9 7.80005ZM16.6 14.2001C16.6 15.0001 16.4 15.7 16 16.1C15.6 16.5 15.1 16.7001 14.5 16.7001C14.1 16.7001 13.7 16.6 13.4 16.4C13.1 16.2 12.8 16 12.7 15.6C12.5 15.2 12.4 14.8001 12.4 14.2001C12.4 13.3001 12.6 12.7 12.9 12.3C13.2 11.9 13.7 11.7001 14.5 11.7001C14.8 11.7001 15.1 11.8 15.4 11.9C15.7 12 15.9 12.2 16.1 12.4C16.3 12.6 16.4 12.9001 16.5 13.2001C16.6 13.4001 16.6 13.8001 16.6 14.2001ZM15.4 14.1C15.4 13.5 15.3 13.1 15.2 12.9C15.1 12.6 14.9 12.5 14.5 12.5C14.3 12.5 14.1 12.6001 14 12.7001C13.9 12.8001 13.8 13.0001 13.7 13.2001C13.6 13.4001 13.6 13.8 13.6 14.1C13.6 14.7 13.7 15.1 13.8 15.4C13.9 15.7 14.1 15.8 14.5 15.8C14.8 15.8 15 15.7 15.2 15.4C15.3 15.2 15.4 14.7 15.4 14.1Z"
    fill="currentColor"/>
</svg>
                                                         </span>
                                                        <!--end::Svg Icon--> {{trans('cruds.orders.fields.total')}}

                                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                           data-bs-toggle="tooltip" title=""
                                                           data-bs-original-title="Reward value earned by customer when purchasing this order."></i>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{$order->total}} {{trans('global.sar')}}</td>
                                            </tr>

                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm011.svg-->
                                                        <span class="svg-icon svg-icon-2 me-2"><svg width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    fill="none"
                                                                                                    xmlns="http://www.w3.org/2000/svg">
<path opacity="0.3"
      d="M21.6 11.2L19.3 8.89998V5.59993C19.3 4.99993 18.9 4.59993 18.3 4.59993H14.9L12.6 2.3C12.2 1.9 11.6 1.9 11.2 2.3L8.9 4.59993H5.6C5 4.59993 4.6 4.99993 4.6 5.59993V8.89998L2.3 11.2C1.9 11.6 1.9 12.1999 2.3 12.5999L4.6 14.9V18.2C4.6 18.8 5 19.2 5.6 19.2H8.9L11.2 21.5C11.6 21.9 12.2 21.9 12.6 21.5L14.9 19.2H18.2C18.8 19.2 19.2 18.8 19.2 18.2V14.9L21.5 12.5999C22 12.1999 22 11.6 21.6 11.2Z"
      fill="currentColor"/>
<path
    d="M11.3 9.40002C11.3 10.2 11.1 10.9 10.7 11.3C10.3 11.7 9.8 11.9 9.2 11.9C8.8 11.9 8.40001 11.8 8.10001 11.6C7.80001 11.4 7.50001 11.2 7.40001 10.8C7.20001 10.4 7.10001 10 7.10001 9.40002C7.10001 8.80002 7.20001 8.4 7.30001 8C7.40001 7.6 7.7 7.29998 8 7.09998C8.3 6.89998 8.7 6.80005 9.2 6.80005C9.5 6.80005 9.80001 6.9 10.1 7C10.4 7.1 10.6 7.3 10.8 7.5C11 7.7 11.1 8.00005 11.2 8.30005C11.3 8.60005 11.3 9.00002 11.3 9.40002ZM10.1 9.40002C10.1 8.80002 10 8.39998 9.90001 8.09998C9.80001 7.79998 9.6 7.70007 9.2 7.70007C9 7.70007 8.8 7.80002 8.7 7.90002C8.6 8.00002 8.50001 8.2 8.40001 8.5C8.40001 8.7 8.30001 9.10002 8.30001 9.40002C8.30001 9.80002 8.30001 10.1 8.40001 10.4C8.40001 10.6 8.5 10.8 8.7 11C8.8 11.1 9 11.2001 9.2 11.2001C9.5 11.2001 9.70001 11.1 9.90001 10.8C10 10.4 10.1 10 10.1 9.40002ZM14.9 7.80005L9.40001 16.7001C9.30001 16.9001 9.10001 17.1 8.90001 17.1C8.80001 17.1 8.70001 17.1 8.60001 17C8.50001 16.9 8.40001 16.8001 8.40001 16.7001C8.40001 16.6001 8.4 16.5 8.5 16.4L14 7.5C14.1 7.3 14.2 7.19998 14.3 7.09998C14.4 6.99998 14.5 7 14.6 7C14.7 7 14.8 6.99998 14.9 7.09998C15 7.19998 15 7.30002 15 7.40002C15.2 7.30002 15.1 7.50005 14.9 7.80005ZM16.6 14.2001C16.6 15.0001 16.4 15.7 16 16.1C15.6 16.5 15.1 16.7001 14.5 16.7001C14.1 16.7001 13.7 16.6 13.4 16.4C13.1 16.2 12.8 16 12.7 15.6C12.5 15.2 12.4 14.8001 12.4 14.2001C12.4 13.3001 12.6 12.7 12.9 12.3C13.2 11.9 13.7 11.7001 14.5 11.7001C14.8 11.7001 15.1 11.8 15.4 11.9C15.7 12 15.9 12.2 16.1 12.4C16.3 12.6 16.4 12.9001 16.5 13.2001C16.6 13.4001 16.6 13.8001 16.6 14.2001ZM15.4 14.1C15.4 13.5 15.3 13.1 15.2 12.9C15.1 12.6 14.9 12.5 14.5 12.5C14.3 12.5 14.1 12.6001 14 12.7001C13.9 12.8001 13.8 13.0001 13.7 13.2001C13.6 13.4001 13.6 13.8 13.6 14.1C13.6 14.7 13.7 15.1 13.8 15.4C13.9 15.7 14.1 15.8 14.5 15.8C14.8 15.8 15 15.7 15.2 15.4C15.3 15.2 15.4 14.7 15.4 14.1Z"
    fill="currentColor"/>
</svg>
                                                         </span>
                                                        <!--end::Svg Icon--> {{trans('cruds.orders.fields.rate')}}

                                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                           data-bs-toggle="tooltip" title=""
                                                           data-bs-original-title="Reward value earned by customer when purchasing this order."></i>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{$order->orderAverageRate() ==null? trans('cruds.not_been_rated'): $order->orderAverageRate() }} </td>
                                            </tr>
                                            <!--end::Rewards-->
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Documents-->
                        </div>

                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary"
                                 role="tab-panel">
                                <!--begin::Orders-->
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                                        <!--begin::Payment address-->
                                        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>{{trans('cruds.orders.fields.comment')}} {{trans('cruds.patient')}}</h2>
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <div class="card-body pt-0">
                                                @if($order->order_attachment)
                                                    {{$order->order_attachment->comment ? $order->order_attachment->comment  : trans('cruds.not_have_any_comment') }}
                                                @else
                                                    {{ trans('cruds.not_have_any_comment')}}
                                                @endif
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Payment address-->
                                        <!--begin::Shipping address-->
                                        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">

                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>{{trans('cruds.orders.fields.address_id')}}</h2>
                                                </div>
                                            </div>

                                            <div class="card-body pt-0">
                                                 @if($order->address)
                                                    {{trans('cruds.title')}}
                                                    :   {{$order->address->title ? $order->address->title : trans('cruds.not_have_any_address_title') }}
                                                    <br>
                                                    {{trans('cruds.description')}}
                                                    :     {{$order->address->description ? $order->address->description : trans('cruds.not_have_any_address_description') }}
                                                @else
                                                    {{ trans('cruds.not_have_any_address_title')}}
                                                @endif
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Shipping address-->
                                    </div>

                                    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>{{trans('cruds.orders.fields.medicals_type')}}</h2>
                                            </div>
                                        </div>

                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="min-w-175px">{{trans('cruds.orders.fields.medicalTest')}}</th>
                                                        <th class="min-w-100px text-end">{{trans('cruds.orders.fields.medical_type')}}</th>
                                                        <th class="min-w-70px text-end">{{trans('cruds.description')}}</th>
                                                        <th class="min-w-100px text-end">{{trans('cruds.orders.fields.instruction')}}  </th>
                                                    </tr>
                                                    </thead>
                                                    <!--end::Table head-->

                                                    <!--begin::Table body-->
                                                    <tbody class="fw-semibold text-gray-600">

                                                    @isset($order->medicalTest)
                                                        @foreach($order->medicalTest as $medical )
                                                            <tr>
                                                                <!--begin::Product-->
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <!--begin::Thumbnail-->
                                                                        <a
                                                                            class="symbol symbol-50px">
                                                                    <span class="symbol-label"
                                                                          style="background-image:url({{$medical->photo}});"></span>
                                                                        </a>
                                                                        <!--end::Thumbnail-->

                                                                        <!--begin::Title-->
                                                                        <div class="ms-5">
                                                                            <a
                                                                                class="fw-bold text-gray-600 text-hover-primary">{{$medical->medicalType->title}}
                                                                            </a>
                                                                        </div>
                                                                        <!--end::Title-->
                                                                    </div>
                                                                </td>
                                                                <!--end::Product-->

                                                                <!--begin::SKU-->
                                                                <td class="text-end">
                                                                    {{$medical->medicalType->title}}
                                                                </td>
                                                                <!--end::SKU-->

                                                                <!--begin::Quantity-->
                                                                <td class="text-end">
                                                                    {{$medical->description}}

                                                                </td>
                                                                <!--end::Quantity-->

                                                                <!--begin::Price-->
                                                                <td class="text-end">
                                                                    {{$medical->instruction}}

                                                                </td>
                                                                <!--end::Price-->


                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                    </tbody>
                                                    <!--end::Table head-->
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                        </div>
                                        <!--end::Card body-->
                                    </div>

                                    <div class="row">
                                        <div class="card card-flush py-4 flex-row-fluid overflow-hidden   col-lg-7 m-3">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>{{trans('cruds.medicalSessions.title')}}</h2>
                                                </div>
                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                            <th class="min-w-40px">{{trans('cruds.medicalSessions.fields.photo')}}</th>
                                                            <th class="min-w-150px text-end">{{trans('cruds.services.title_singular')}}</th>
                                                            <th class="min-w-150px text-end">{{trans('cruds.medicalSessions.fields.count_sessions')}}  </th>
                                                        </tr>
                                                        </thead>

                                                        <tbody class="fw-semibold text-gray-600">

                                                        @isset($order->orderMedicalSession)
                                                            @foreach($order->orderMedicalSession as $orderMedicalSession )
                                                                <tr>
                                                                    <!--begin::Product-->
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <!--begin::Thumbnail-->
                                                                            <a
                                                                                class="symbol symbol-50px">
                                                                    <span class="symbol-label"
                                                                          style="background-image:url({{$orderMedicalSession->medicalSession->photo}});"></span>
                                                                            </a>

                                                                        </div>
                                                                    </td>

                                                                    <td class="text-end">
                                                                        {{$orderMedicalSession->medicalSession->service->title}}
                                                                    </td>

                                                                    <td class="text-end">
                                                                        {{$orderMedicalSession->medicalSession->count_sessions}}
                                                                    </td>
                                                                    <!--end::Price-->
                                                                </tr>
                                                            @endforeach
                                                        @endisset
                                                        </tbody>
                                                        <!--end::Table head-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                            </div>
                                            <!--end::Card body-->
                                        </div>

                                        <div class="card card-flush py-4 flex-row-fluid overflow-hidden col-lg-4 m-3">
                                            <!--begin::Card header-->
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>{{trans('cruds.services.title')}}</h2>
                                                </div>
                                            </div>
                                            <!--end::Card header-->

                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                            <th class="min-w-175px">{{trans('cruds.medicalSessions.fields.photo')}}</th>
                                                            <th class="min-w-100px text-end">{{trans('cruds.services.title_singular')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <!--end::Table head-->

                                                        <!--begin::Table body-->
                                                        <tbody class="fw-semibold text-gray-600">

                                                        @isset($order->ordersServices)
                                                            @foreach($order->ordersServices as $ordersServices )

                                                                <tr>
                                                                    <!--begin::Product-->
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <!--begin::Thumbnail-->
                                                                            <a
                                                                                class="symbol symbol-50px">
                                                                    <span class="symbol-label"
                                                                          style="background-image:url({{$ordersServices->photo}});"></span>
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                    <!--end::Product-->
                                                                    <!--begin::SKU-->
                                                                    <td class="text-end">
                                                                        {{$ordersServices->title}}
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        @endisset
                                                        </tbody>
                                                        <!--end::Table head-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                    </div>
                                    <!--end::Product List-->
                                </div>
                                <!--end::Orders-->
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_ecommerce_sales_order_history" role="tab-panel">
                                <div class="row">
                                    <div class="card card-flush py-4 flex-row-fluid col-lg-4 m-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>{{trans('cruds.orders.fields.order_attachments')}}</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                                                    <!--begin::Table body-->
                                                    <tbody class="fw-semibold text-gray-600">
                                                    @isset($order->orderAttachment)
                                                        @if($order->orderAttachment->attachment_file)
                                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                                <!--begin::Card-->
                                                                <div class="card h-100 ">
                                                                    <!--begin::Card body-->
                                                                    <div
                                                                        class="card-body d-flex justify-content-center text-center flex-column p-8">
                                                                        <!--begin::Name-->
                                                                        <a href="{{$order->orderAttachment->attachment_file  }}"
                                                                           class="text-gray-800 text-hover-primary d-flex flex-column">
                                                                            <!--begin::Image-->
                                                                            <div class="symbol symbol-75px mb-5">
                                                                                <img
                                                                                    src="{{asset('assets/media/svg/files/folder-document.svg')}}"
                                                                                    class="theme-light-show"
                                                                                    alt=""/>
                                                                            </div>
                                                                            <div class="fs-5 fw-bold mb-2">
                                                                                {{trans('cruds.download')}}
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            {{trans('cruds.not_have_any_attachment_file')}}
                                                        @endif
                                                    @endisset
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end::Block-->
                                </div>
                                <!--end::Order data-->
                            </div>
                            <!--end::Orders-->
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

@endsection


@section('script')

@endsection
