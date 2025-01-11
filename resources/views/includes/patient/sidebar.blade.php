<style>
    .menu-title {
        font-weight: bold !important;
    }

    .order-count {
        display: inline-block;
        background-color: #ffffff;
        color: #2d2929;
        border-radius: 40%;
        padding: 5px 8px;
        /*margin-left: 1px;*/
        font-size: 11px;
        font-weight: bold;
    }
</style>
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{route('patient_home')}}">
            <img src="{{asset('assets/HakeemLogo.png')}}" width="100" height="80" alt="">
            {{--            <h6 style="color: #7E53FD"> {{ trans('panel.site_title') }}</h6>--}}
        </a>
        @include('includes.icon.sidebar-toggle')
    </div>
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
             data-kt-scroll-offset="0">
            <div
                class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a class="menu-link" href="{{route('patient_home')}}">
                        @include('includes.icon.sidebar-icon')
                        <span class="menu-title text-warning"> {{ trans('global.dashboard') }} </span>
                    </a>
                </div>

                <div class="menu-item">
                    <div class="menu-content pt-8 pb-2">
                      <span
                          class="menu-section text-muted text-uppercase fs-8 ls-1"> {{ trans('global.list') }}</span>
                    </div>
                </div>

                <div data-kt-menu-trigger="click"
                     class="menu-item {{   request()->is(  "patient/orders*"    )    ? "here show" : ""   }} menu-accordion">

                        <span class="menu-link ">
                        @include('includes.icon.order-icon')
                        <span class="menu-title"> {{ trans('cruds.orders.title') }}</span>
                        <span class="menu-arrow"></span>
                        </span>
                    {{--                        @can('permission_access')--}}
                    <div class="menu-sub menu-sub-accordion menu-active-bg">

                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') === null ? 'active' : '' }} "
                               href="{{route('patient.orders.create')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('global.create') }} {{ trans('cruds.orders.title_singular') }}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') === null ? 'active' : '' }} "
                               href="{{route('patient.orders.index')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('global.all') }} {{ trans('cruds.orders.title') }}</span>
                                <span class="order-count">{{orderPatientCount(null)}}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class=" menu-link  {{ request()->query('orderStatus') == OrderStatus()['awaitingPayment'] ? 'active' : '' }} "


                               href="{{route('patient.orders.index',['orderStatus'=>OrderStatus()['awaitingPayment']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_awaitingPayment') }}</span>
                                <span
                                    class="order-count">{{orderPatientCount(OrderStatus()['awaitingPayment']) }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') == OrderStatus()['awaitingAccept'] ? 'active' : '' }} "
                               href="{{route('patient.orders.index',['orderStatus'=>OrderStatus()['awaitingAccept']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_awaitingAccept') }}</span>
                                <span
                                    class="order-count">{{ orderPatientCount(OrderStatus()['awaitingAccept'])  }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') == OrderStatus()['awaitingImplementation'] ? 'active' : '' }} "
                               href="{{route('patient.orders.index',['orderStatus'=>OrderStatus()['awaitingImplementation']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_awaitingImplementation') }}</span>
                                <span
                                    class="order-count">{{ orderPatientCount(OrderStatus()['awaitingImplementation']) }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class=" menu-link  {{ request()->query('orderStatus') == OrderStatus()['inProgress'] ? 'active' : '' }} "
                               href="{{route('patient.orders.index',['orderStatus'=> OrderStatus()['inProgress']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_inProgress') }}</span>
                                <span class="order-count">{{   orderPatientCount(OrderStatus()['inProgress'])}}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ request()->query('orderStatus') == OrderStatus()['completed'] ? 'active' : '' }}"
                               href="{{ route('patient.orders.index', ['orderStatus' => OrderStatus()['completed']]) }}">
                                    <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                    </span>
                                <span class="menu-title">{{ trans('cruds.orders.orders_completed') }}</span>
                                <span class="order-count">{{orderPatientCount(OrderStatus()['completed'])}}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') == OrderStatus()['cancel'] ? 'active' : '' }}"
                               href="{{route('patient.orders.index',['orderStatus'=>OrderStatus()['cancel']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_cancel') }}</span>
                                <span class="order-count">{{orderPatientCount(OrderStatus()['cancel'])}}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') == OrderStatus()['rejected'] ? 'active' : '' }}"
                               href="{{route('patient.orders.index',['orderStatus'=>OrderStatus()['rejected']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_rejected') }}</span>
                                <span class="order-count">{{orderPatientCount(OrderStatus()['rejected'])}}</span>
                            </a>
                        </div>
                    </div>
                 </div>

                <div data-kt-menu-trigger="click"
                     class="menu-item {{ request()->is("patient/address*")    ? "here show" : ""   }} menu-accordion">
                        <span class="menu-link ">
                        @include('includes.icon.report-icon')


                        <span class="menu-title">  {{ trans('cruds.address.title') }}</span>
                        <span class="menu-arrow"></span>
                        </span>
                    {{--                        @can('permission_access')--}}
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class=" menu-link {{request()->is("patient/address*") ? 'active' : ''}} "
                               href="{{route('patient.address.index')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.show') }} {{ trans('cruds.address.title') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end::Aside menu-->
    <!--begin::Footer-->
    <div class="aside-footer flex-column-auto" id="kt_aside_footer"></div>
    <!--end::Footer-->
</div>

