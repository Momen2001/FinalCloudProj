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
        <a href="{{route('lab_home')}}">
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
                    <a class="menu-link" href="{{route('lab_home')}}">
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
                     class="menu-item {{   request()->is(  "lab/orders*"    )    ? "here show" : ""   }} menu-accordion">

                        <span class="menu-link ">
                        @include('includes.icon.order-icon')
                        <span class="menu-title"> {{ trans('cruds.orders.title') }}</span>
                        <span class="menu-arrow"></span>
                        </span>
                    {{--                        @can('permission_access')--}}
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') === null ? 'active' : '' }} "
                               href="{{route('lab.orders.index')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('global.all') }} {{ trans('cruds.orders.title') }}</span>
                                <span class="order-count">{{orderProvideCount(null)}}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class=" menu-link  {{ request()->query('orderStatus') == OrderStatus()['awaitingPayment'] ? 'active' : '' }} "


                               href="{{route('lab.orders.index',['orderStatus'=>OrderStatus()['awaitingPayment']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_awaitingPayment') }}</span>
                                <span
                                    class="order-count">{{orderProvideCount(OrderStatus()['awaitingPayment']) }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') == OrderStatus()['awaitingAccept'] ? 'active' : '' }} "
                               href="{{route('lab.orders.index',['orderStatus'=>OrderStatus()['awaitingAccept']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_awaitingAccept') }}</span>
                                <span
                                    class="order-count">{{ orderProvideCount(OrderStatus()['awaitingAccept'])  }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') == OrderStatus()['awaitingImplementation'] ? 'active' : '' }} "
                               href="{{route('lab.orders.index',['orderStatus'=>OrderStatus()['awaitingImplementation']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_awaitingImplementation') }}</span>
                                <span
                                    class="order-count">{{ orderProvideCount(OrderStatus()['awaitingImplementation']) }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class=" menu-link  {{ request()->query('orderStatus') == OrderStatus()['inProgress'] ? 'active' : '' }} "
                               href="{{route('lab.orders.index',['orderStatus'=> OrderStatus()['inProgress']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_inProgress') }}</span>
                                <span class="order-count">{{   orderProvideCount(OrderStatus()['inProgress'])}}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ request()->query('orderStatus') == OrderStatus()['completed'] ? 'active' : '' }}"
                               href="{{ route('lab.orders.index', ['orderStatus' => OrderStatus()['completed']]) }}">
                                    <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                    </span>
                                <span class="menu-title">{{ trans('cruds.orders.orders_completed') }}</span>
                                <span class="order-count">{{orderProvideCount(OrderStatus()['completed'])}}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') == OrderStatus()['cancel'] ? 'active' : '' }}"
                               href="{{route('lab.orders.index',['orderStatus'=>OrderStatus()['cancel']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_cancel') }}</span>
                                <span class="order-count">{{orderProvideCount(OrderStatus()['cancel'])}}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') == OrderStatus()['rejected'] ? 'active' : '' }}"
                               href="{{route('lab.orders.index',['orderStatus'=>OrderStatus()['rejected']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_rejected') }}</span>
                                <span class="order-count">{{orderProvideCount(OrderStatus()['rejected'])}}</span>
                            </a>
                        </div>
                    </div>

                    {{-- @endcan --}}
                </div>
                <div data-kt-menu-trigger="click"
                     class="menu-item {{ request()->is("lab/main-service*")   ? "here show" : ""   }} menu-accordion">
                        <span class="menu-link ">
                       @include('includes.icon.services-icon')
                        <span class="menu-title"> {{ trans('cruds.main_service.title') }}</span>
                        <span class="menu-arrow"></span>
                        </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{request()->is("lab/main-service*") ? 'active' : ''}}"
                               href="{{route('lab.main-service.index')}}">
                                            <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                            </span>
                                <span
                                    class="menu-title">{{trans('cruds.show')}} {{ trans('cruds.main_service.title') }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{request()->is("lab/main-service*") ? 'active' : ''}}"
                               href="{{ route('lab.main-service.edit', mainServiceById()['Lab']) }}">
                                            <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                            </span>
                                <span
                                    class="menu-title">{{ trans('global.edit') }} {{ trans('cruds.main_service.schedule') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click"
                     class="menu-item {{  request()->is(  "lab/doctor*") ||  request()->is(  "lab/patient*"    )   ? "here show" : ""   }} menu-accordion">
                        <span class="menu-link ">
                        @include('includes.icon.users-icon')
                        <span class="menu-title"> {{ trans('cruds.userManagement.title') }}</span>
                        <span class="menu-arrow"></span>
                        </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{request()->is("lab/doctor*") ? 'active' : ''}}"
                               href="{{route('lab.doctor.index')}}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span
                                    class="menu-title">{{trans('cruds.show')}} {{ trans('cruds.user.fields.doctors') }}</span>
                            </a>
                        </div>
                    </div>

                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{request()->is("lab/patient*") ? 'active' : ''}}"
                               href="{{route('lab.patient.index')}}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span
                                    class="menu-title">{{trans('cruds.show')}} {{ trans('cruds.user.patients') }}</span>
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
