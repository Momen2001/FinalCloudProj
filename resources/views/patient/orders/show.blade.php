@extends('layouts.patient')
@section('title',trans('global.show') .' '. trans('cruds.orders.title_singular'))
@section('content')
    @include('includes.lab.toolbar')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1"> {{ trans('global.view') }} {{ trans('cruds.orders.title_singular') }}
                        #{{$order->order_id}}</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('lab_home')}}"
                               class="text-muted text-hover-primary">{{ trans('global.home') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('lab.orders.index')}}"
                               class="text-muted text-hover-primary">{{ trans('cruds.orders.title') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-xl-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Card body-->
                            <div class="card-body pt-15">
                                <!--begin::Summary-->
                                <div class="d-flex flex-center flex-column mb-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-150px symbol-circle mb-7">
                                        <img src="{{$order->ownerPatient->photo}}" alt="image"/>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#"
                                       class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">{{trans('cruds.orders.fields.owner_patient_id')}}
                                        : {{$order->ownerPatient->first_name}}</a>
                                    <!--end::Name-->
                                    <!--begin::Email-->
                                    <a
                                        class="fs-5 fw-bold text-muted text-hover-primary mb-6">{{$order->ownerPatient->getFullPhone()}}</a>
                                    <!--end::Email-->
                                </div>
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bolder">{{ trans('cruds.orders.fields.status') }}</div>
                                    <!--begin::Badge-->
                                    <div class="badge
                                      @if($order->status == OrderStatus()['rejected'])
                                                  badge-danger
                                                  @elseif($order->status == OrderStatus()['cancel'])
                                                  badge-dark
                                                   @elseif($order->status == OrderStatus()['awaitingAccept'] )
                                                   badge-light-primary
                                                   @elseif($order->status == OrderStatus()['awaitingPayment'])
                                                    badge-info @else badge-success
                                                       @endIf d-inline" id="orderStatusName">
                                        {{ OrderStatusByNumber()[$order->status] }}</div>


                                    <!--begin::Badge-->
                                </div>
                                <div class="separator separator-dashed my-3"></div>

                                @if($order->status == OrderStatus()['awaitingPayment'])

                                    <div class="d-flex flex-stack fs-4 py-3">
                                        <div class="fw-bolder">{{ trans('global.go_to_payment') }}</div>
                                        <!--begin::Badge-->
                                        <div>
                                            <a class="btn btn-sm btn-bg-danger"
                                               href="{{route('paytabs.createPayPage',['order_id'=>$order->id])}}">
                                                <span class="svg-icon svg-icon-2 bi-credit-card"></span>
                                                {{ trans('global.go_to_payment') }}
                                            </a>
                                        </div>
                                        <!--begin::Badge-->
                                    </div>

                                @endif

                                <div class="separator separator-dashed my-3"></div>




                                <!--begin::Details content-->
                                <div class="pb-5 fs-6">
                                    <!--begin::Details item-->
                                    @if($order->specialization)
                                        <div
                                            class="fw-bolder mt-5">{{trans('cruds.specializations.title_singular')  }}</div>
                                        <div class="text-dark">{{  $order->specialization->title}}</div>
                                        <div class="separator separator-dashed my-3"></div>
                                    @endIf


                                    <div
                                        class="fw-bolder mt-5">{{trans('cruds.orders.fields.payment_type')  }}</div>
                                    <div
                                        class="text-dark">{{  $order->payment_type == paymentTypeByName()['PaymentOnline'] ? trans('global.pay_online'): trans('global.pay_by_hand')}}</div>

                                    <div class="separator separator-dashed my-3"></div>


                                    <div class="fw-bolder mt-5">{{trans('cruds.orders.fields.order_type')}}</div>
                                    <div
                                        class="text-dark">{{order_type_translate_by_number()[$order->order_type]}}</div>

                                    <div class="separator separator-dashed my-3"></div>

                                    <div class="fw-bolder mt-5">{{trans('cruds.orders.fields.booking_date')}}</div>
                                    <div class="text-dark">{{$order->booking_day_en}}
                                        - {{$order->booking_date}} {{$order['booking_hour']}} </div>

                                    <div class="separator separator-dashed my-3"></div>

                                    <div class="fw-bolder mt-5">
                                        {{$order->subPatient ? trans('cruds.orders.fields.sub_patient_passport_id') :trans('cruds.orders.fields.owner_passport_id')}}
                                    </div>

                                    <div
                                        class="text-dark">{{$order->subPatient ? $order->subPatient->passport_id :$order->ownerPatient->passport_id}}
                                    </div>

                                    <div class="separator separator-dashed my-3"></div>

                                    <div class="fw-bolder mt-5">{{trans('cruds.orders.fields.sub_patient_id')}}</div>
                                    <div
                                        class="text-dark">  {{$order->subPatient ? $order->subPatient->first_name .'# ' .$order->subPatient->id :trans('cruds.not_have_sub_patient')}}
                                    </div>

                                    <!--begin::Details item-->
                                </div>
                                <!--end::Details content-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                   href="#kt_ecommerce_customer_overview">{{ trans('cruds.orders.order_summary') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                   href="#kt_ecommerce_customer_advanced"> {{ trans('cruds.orders.order_setting') }}</a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_customer_overview" role="tabpanel">
                                <div class="row row-cols-1 row-cols-md-2 mb-6 mb-xl-9">
                                    <div class="col">
                                        <!--begin::Card-->
                                        <div class="card pt-4 h-md-100 mb-6 mb-md-0">
                                            <!--begin::Card header-->
                                            <div class="card-header border-0">
                                                <!--begin::Card title-->
                                                <div class="card-title">
                                                    <h2 class="fw-bolder">{{trans('cruds.main_service.title_singular') }}</h2>
                                                </div>
                                                <!--end::Card title-->
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <div class="fw-bolder fs-2">
                                                    <div class="d-flex">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen030.svg-->
                                                        <div
                                                            class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                            <a href="">
                                                                <div class="symbol-label">
                                                                    <img src="{{$order->mainService->photo}}"
                                                                         alt="Dan Wilson" class="w-100">
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <!--end::Svg Icon-->
                                                        <div
                                                            class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">{{$order->mainService->title}}

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>

                                    <div class="col">
                                        <!--begin::Reward Tier-->
                                        <a  class="card bg-info hoverable h-md-100">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen020.svg-->
                                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M14 18V16H10V18L9 20H15L14 18Z"
                                                                              fill="currentColor"/>
																		<path opacity="0.3"
                                                                              d="M20 4H17V3C17 2.4 16.6 2 16 2H8C7.4 2 7 2.4 7 3V4H4C3.4 4 3 4.4 3 5V9C3 11.2 4.8 13 7 13C8.2 14.2 8.8 14.8 10 16H14C15.2 14.8 15.8 14.2 17 13C19.2 13 21 11.2 21 9V5C21 4.4 20.6 4 20 4ZM5 9V6H7V11C5.9 11 5 10.1 5 9ZM19 9C19 10.1 18.1 11 17 11V6H19V9ZM17 21V22H7V21C7 20.4 7.4 20 8 20H16C16.6 20 17 20.4 17 21ZM10 9C9.4 9 9 8.6 9 8V5C9 4.4 9.4 4 10 4C10.6 4 11 4.4 11 5V8C11 8.6 10.6 9 10 9ZM10 13C9.4 13 9 12.6 9 12V11C9 10.4 9.4 10 10 10C10.6 10 11 10.4 11 11V12C11 12.6 10.6 13 10 13Z"
                                                                              fill="currentColor"/>
																	</svg>
																</span>
                                                <!--end::Svg Icon-->
                                                <div
                                                    class="text-white fw-bolder fs-2 mt-5">{{$order->hospital->getProviderName()}}</div>
                                                <div
                                                    class="fw-bold text-white">{{$order->hospital->getFullPhone()}}+</div>
                                            </div>
                                            <!--end::Body-->
                                        </a>
                                        <!--end::Reward Tier-->
                                    </div>
                                </div>
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>{{trans('cruds.orders.order_details')}}</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 pb-5">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed gy-5"
                                               id="kt_table_customers_payment">

                                            <tbody class="fs-6 fw-bold text-gray-600">
                                            @if($order->doctor)
                                                <tr>
                                                    <!--begin::order=-->
                                                    <td>
                                                        <a
                                                            class="text-dark text-hover-primary mb-1">{{trans('cruds.orders.fields.doctor_id')}}</a>
                                                    </td>

                                                    <td>
                                                        <a href="{{route('lab.doctor.show',$order->doctor->id)}}"
                                                           class="text-dark text-hover-primary mb-1">{{$order->doctor->getProviderName()}}</a>
                                                    </td>

                                                </tr>
                                            @endif



                                            <tr>
                                                <td>
                                                    <a class="text-dark text-hover-primary mb-1">{{trans('cruds.orders.fields.sub_total')}}</a>
                                                </td>
                                                <td class="text-dark">{{$order->sub_total}} {{trans('global.sar')}}</td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <a class="text-dark text-hover-primary mb-1"> {{trans('cruds.orders.fields.vat_value')}}</a>
                                                </td>
                                                <td class="text-dark"> {{$order->vat}}</td>
                                            </tr>

                                            <tr>
                                                <!--begin::order=-->
                                                <td>
                                                    <a class="text-dark text-hover-primary mb-1"> {{trans('cruds.orders.fields.total')}}</a>
                                                </td>
                                                <td class="text-dark">{{ $order->total < 0 ? 0 : $order->total}} {{trans('global.sar')}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <!--begin::order=-->
                                                <td>
                                                    <a class="text-dark text-hover-primary mb-1">{{trans('cruds.orders.fields.rate')}}</a>
                                                </td>
                                                <td class="text-dark">{{$order->orderAverageRate() ==null? trans('cruds.not_been_rated'): $order->orderAverageRate() }}</td>
                                            </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->

                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->

                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>{{trans('cruds.orders.fields.medicals_type')}}</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    @isset($order->medicalTest)
                                        <div class="card-body pt-0 pb-5">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed gy-5"
                                                   id="kt_table_customers_payment">
                                                <tbody class="fs-6 fw-bold text-gray-600">
                                                <tr>
                                                    <td>
                                                        <a class="text-dark text-hover-primary mb-1">{{trans('cruds.orders.fields.medicalTest')}}</a>
                                                    </td>
                                                    <td class="text-dark">{{trans('cruds.description')}}</td>
                                                    <td class="text-dark">{{trans('cruds.orders.fields.instruction')}}</td>
                                                </tr>

                                                @foreach($order->medicalTest as $medical )
                                                    <tr>
                                                        <td>
                                                            <a class="symbol symbol-50px">
                                                              <span class="symbol-label"
                                                                    style="background-image:url({{$medical->photo}});"></span>
                                                            </a>
                                                        </td>
                                                        <td class="text-dark"> {{$medical->description}}</td>
                                                        <td class="text-dark"> {{$medical->instruction}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                    @endisset
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>

                            <div class="tab-pane fade" id="kt_ecommerce_customer_advanced" role="tabpanel">
                                <!--begin::Card-->
                                @if($order->status == OrderStatus()['inProgress'])
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>{{trans('cruds.orders.order_setting')}}</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 pb-5">
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed gy-5"
                                                   id="kt_table_users_login_session">
                                                <!--begin::Table body-->
                                                <tbody class="fs-6 fw-bold text-gray-600">




                                                    <tr>
                                                        <td>{{ trans('cruds.orders.complete') }}</td>
                                                        <td class="text-end">
                                                            <button
                                                                class="btn btn-sm btn-warning"
                                                                onclick="OrderStartWork(this)"
                                                                data-url="{{ route('lab.completeOrder',$order->id) }}">
                                                                <span
                                                                    class="svg-icon svg-icon-2 bi-check-circle"></span>
                                                                {{trans('cruds.orders.complete')}}
                                                            </button>
                                                        </td>
                                                    </tr>




                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                @endif
                                <!--end::Card-->
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pb-5">
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Content-->
                                            <div class="d-flex flex-column">
                                                <span>{{trans('cruds.orders.fields.comment')}} {{trans('cruds.patient')}}:</span>
                                            </div>
                                            <!--end::Content-->
                                            <!--begin::Action-->

                                            <!--end::Action-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin:Separator-->
                                        <!--end:Separator-->
                                        <!--begin::Disclaimer-->
                                        <div class="text-gray-600">
                                            @if($order->order_attachment)
                                                {{$order->order_attachment->comment ? $order->order_attachment->comment  : trans('cruds.not_have_any_comment') }}
                                            @else
                                                {{ trans('cruds.not_have_any_comment')}}
                                            @endif
                                        </div>
                                        <div class="separator separator-dashed my-5"></div>

                                        <div class="d-flex flex-column">
                                            <span>  {{trans('cruds.orders.fields.address_id')}}:</span>
                                        </div>

                                        <div class="text-gray-600">
                                            @if($order['address'])
                                                {{trans('cruds.title')}}
                                                :   {{$order->address->title ? $order->address->title : trans('cruds.not_have_any_address_title') }}
                                                <br>
                                                {{trans('cruds.description')}}
                                                :     {{$order->address->description ? $order->address->description : trans('cruds.not_have_any_address_description') }}
                                            @else
                                                {{ trans('cruds.not_have_any_address_title')}}
                                            @endif
                                        </div>
                                        <!--end::Disclaimer-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                                <!--begin::Card-->


                                @if(count($order->ordersServices) != 0 )
                                    <div class="card pt-4 mb-6 mb-xl-9">
                                        <div class="row">
                                            <div
                                                class="card card-flush py-4 flex-row-fluid overflow-hidden col-lg-4 m-3">
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
                                                        <table
                                                            class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
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
                                    </div>
                                @endif

                                <div class="card pt-4 mb-6 mb-xl-9">
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
                                    </div>
                                </div>




                                <!--end::Card-->
                            </div>
                            <!--end:::Tab pane-->
                        </div>
                        <!--end:::Tab content-->
                    </div>
                    <!--end::Content-->
                </div>

            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>

@endsection

@section('script')


@endsection