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
        <a href="{{route('admin_home')}}">
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
                    <a class="menu-link" href="{{route('admin_home')}}">
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
                     class="menu-item {{ request()->is("admin/order*")     ? "here show" : ""   }} menu-accordion">

                        <span class="menu-link ">
                        @include('includes.icon.order-icon')
                        <span class="menu-title"> {{ trans('cruds.orders.title') }}</span>
                        <span class="menu-arrow"></span>
                        </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        {{--                        <div class="menu-item">--}}
                        {{--                            <a class=" menu-link {{request()->is("admin/order*") ? 'active' : ''}} "--}}
                        {{--                               href="{{route('admin.order.index')}}">--}}
                        {{--                                        <span class="menu-bullet">--}}
                        {{--                                        <span class="bullet bullet-dot"></span>--}}
                        {{--                                        </span>--}}
                        {{--                                <span--}}
                        {{--                                    class="menu-title">{{ trans('cruds.show') }} {{ trans('cruds.orders.title') }}</span>--}}
                        {{--                            </a>--}}
                        {{--                        </div>--}}


                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') === null ? 'active' : '' }} "
                               href="{{route('admin.order.index')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('global.all') }} {{ trans('cruds.orders.title') }}</span>
                                <span class="order-count">{{orderCount(null)}}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class=" menu-link  {{ request()->query('orderStatus') == OrderStatus()['awaitingPayment'] ? 'active' : '' }} "


                               href="{{route('admin.order.index',['orderStatus'=>OrderStatus()['awaitingPayment']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_awaitingPayment') }}</span>
                                <span
                                    class="order-count">{{orderCount(OrderStatus()['awaitingPayment']) }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') == OrderStatus()['awaitingAccept'] ? 'active' : '' }} "
                               href="{{route('admin.order.index',['orderStatus'=>OrderStatus()['awaitingAccept']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_awaitingAccept') }}</span>
                                <span
                                    class="order-count">{{ orderCount(OrderStatus()['awaitingAccept'])  }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') == OrderStatus()['awaitingImplementation'] ? 'active' : '' }} "
                               href="{{route('admin.order.index',['orderStatus'=>OrderStatus()['awaitingImplementation']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_awaitingImplementation') }}</span>
                                <span
                                    class="order-count">{{ orderCount(OrderStatus()['awaitingImplementation']) }}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class=" menu-link  {{ request()->query('orderStatus') == OrderStatus()['inProgress'] ? 'active' : '' }} "
                               href="{{route('admin.order.index',['orderStatus'=> OrderStatus()['inProgress']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_inProgress') }}</span>
                                <span
                                    class="order-count">{{   orderCount(OrderStatus()['inProgress'])}}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link {{ request()->query('orderStatus') == OrderStatus()['completed'] ? 'active' : '' }}"
                               href="{{ route('admin.order.index', ['orderStatus' => OrderStatus()['completed']]) }}">
                                    <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                    </span>
                                <span class="menu-title">{{ trans('cruds.orders.orders_completed') }}</span>
                                <span class="order-count">{{orderCount(OrderStatus()['completed'])}}</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') == OrderStatus()['cancel'] ? 'active' : '' }}"
                               href="{{route('admin.order.index',['orderStatus'=>OrderStatus()['cancel']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_cancel') }}</span>
                                <span class="order-count">{{orderCount(OrderStatus()['cancel'])}}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('orderStatus') == OrderStatus()['rejected'] ? 'active' : '' }}"
                               href="{{route('admin.order.index',['orderStatus'=>OrderStatus()['rejected']])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.orders.orders_rejected') }}</span>
                                <span class="order-count">{{orderCount(OrderStatus()['rejected'])}}</span>
                            </a>
                    </div>
                    </div>


                </div>


                <div data-kt-menu-trigger="click"
                     class="menu-item {{ request()->is("admin/permissions*") ||request()->is( "admin/roles*") || request()->is("admin/doctor*")||  request()->is("admin/lab*")|| request()->is("admin/manager*")|| request()->is("admin/patient*") ? "here show" : ""   }} menu-accordion">

                        <span class="menu-link ">
                        @include('includes.icon.users-icon')
                        <span class="menu-title"> {{ trans('cruds.userManagement.title') }}</span>
                        <span class="menu-arrow"></span>
                         </span>


                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{request()->is("admin/manager*") ? 'active' : ''}}"
                               href="{{route('admin.manager.index')}}">
                                            <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                            </span>
                                <span class="menu-title">{{ trans('cruds.user.admin') }}</span>
                            </a>
                        </div>
                    </div>

                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{request()->is("admin/patient*") ? 'active' : ''}}"
                               href="{{route('admin.patient.index')}}">
                                            <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                            </span>
                                <span class="menu-title">{{ trans('cruds.user.patients') }}</span>
                            </a>
                        </div>
                    </div>


                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{request()->is("admin/lab*") ? 'active' : ''}}"
                               href="{{route('admin.lab.index')}}">
                                            <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                            </span>
                                <span class="menu-title">{{ trans('cruds.lab.title') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click"
                     class="menu-item {{ request()->is("admin/main-service*") ||request()->is( "admin/service*")  || request()->is("admin/medicalType*")        ? "here show" : ""   }} menu-accordion">

                        <span class="menu-link ">
                        @include('includes.icon.services-icon')

                        <span class="menu-title">{{ trans('global.adjust_service') }}</span>
                        <span class="menu-arrow"></span>
                            <!--end::Svg Icon--></span>

                    {{--                        @can('permission_access')--}}
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class=" menu-link {{request()->is("admin/main-service*") ? 'active' : ''}} "
                               href="{{route('admin.main-service.index')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.show') }} {{ trans('cruds.main_service.title') }}</span>
                            </a>
                        </div>
                    </div>


                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class=" menu-link {{request()->is("admin/medicalType*") ? 'active' : ''}} "
                               href="{{route('admin.medicalType.index')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.show') }} {{ trans('cruds.medicalType.title') }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div data-kt-menu-trigger="click"
                             class="menu-item menu-accordion {{ request()->is( "admin/service")   ? "here show" : ""   }}">
													<span class="menu-link">
														<span class="menu-bullet">
															<span class="bullet bullet-dot"></span>
														</span>
														<span
                                                            class="menu-title">{{ trans('cruds.show') }} {{ trans('cruds.services.title') }}</span>
														<span class="menu-arrow"></span>
													</span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">


                                <div class="menu-item">
                                    <a class="menu-link {{request()->query('main_service_id') == mainServiceById()['Lab'] ? 'active' : '' }}"
                                       href="{{route('admin.service.index',['main_service_id'=>mainServiceById()['Lab']])}}">
																<span class="menu-bullet">
																	<span class="bullet bullet-dot"></span>
																</span>
                                        <span
                                            class="menu-title">{{ trans('cruds.services.single_title') }} {{ trans('cruds.services.lab') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- @endcan --}}
                </div>

                <div data-kt-menu-trigger="click"
                     class="menu-item {{ request()->is("admin/advertisement*")    ? "here show" : ""   }} menu-accordion">
                        <span class="menu-link ">
                        @include('includes.icon.app-icon')
                        <span class="menu-title">  {{ trans('cruds.advertisements.title') }}</span>
                        <span class="menu-arrow"></span>
                        </span>
                    {{--                        @can('permission_access')--}}
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class=" menu-link {{request()->is("admin/advertisement*") ? 'active' : ''}} "
                               href="{{route('admin.advertisement.index')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.show') }} {{ trans('cruds.advertisements.title') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click"
                     class="menu-item {{ request()->is("admin/notifications*")    ? "here show" : ""   }} menu-accordion">
                        <span class="menu-link ">
                        @include('includes.icon.notification-icon')
                        <span class="menu-title">  {{ trans('cruds.notifications.title') }}</span>
                        <span class="menu-arrow"></span>
                        </span>
                    {{--                        @can('permission_access')--}}
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class=" menu-link {{request()->is("admin/notifications*") ? 'active' : ''}} "
                               href="{{route('admin.notifications.index')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.show') }} {{ trans('cruds.notifications.title') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click"
                     class="menu-item {{ request()->is("admin/reportTypes*")    ? "here show" : ""   }} menu-accordion">
                        <span class="menu-link ">
                        @include('includes.icon.report-icon')


                        <span class="menu-title">  {{ trans('cruds.reportTypes.title') }}</span>
                        <span class="menu-arrow"></span>
                        </span>
                    {{--                        @can('permission_access')--}}
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class=" menu-link {{request()->is("admin/reportTypes*") ? 'active' : ''}} "
                               href="{{route('admin.reportTypes.index')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.show') }} {{ trans('cruds.reportTypes.types') }}</span>
                            </a>
                        </div>
                    </div>
                </div>


                <div data-kt-menu-trigger="click"
                     class="menu-item {{ request()->is("admin/countries*")    ? "here show" : ""   }} menu-accordion">
                        <span class="menu-link ">
                        @include('includes.icon.countries-icon')

                            <!--end::Svg Icon--></span>
                    <span class="menu-title"> {{ trans('cruds.country.countriesAndCities') }}</span>
                    <span class="menu-arrow"></span>
                    </span>

                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class=" menu-link {{request()->is("admin/countries*") ? 'active' : ''}} "
                               href="{{route('admin.countries.index')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.show') }} {{ trans('cruds.countries') }}</span>
                            </a>
                        </div>
                    </div>

                </div>

                <div data-kt-menu-trigger="click"
                     class="menu-item {{ request()->is("admin/audit-logs*")    ? "here show" : ""   }} menu-accordion">
                        <span class="menu-link ">
                        @include('includes.icon.log-icon')
                        <span class="menu-title"> {{ trans('cruds.auditLog.title') }}</span>
                        <span class="menu-arrow"></span>
                        </span>

                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link {{request()->is("admin/audit-logs*") ? 'active' : ''}}"
                               href="{{route('admin.audit-logs.index')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span class="menu-title"> {{ trans('cruds.auditLog.title') }}</span>
                            </a>
                        </div>
                    </div>

                </div>

                <div data-kt-menu-trigger="click"
                     class="menu-item {{ request()->is("admin/settings*") ||request()->is("admin/languagesFile*")    ? "here show" : ""   }} menu-accordion">
                        <span class="menu-link ">
                        @include('includes.icon.setting-icon')
                        <span class="menu-title">  {{ trans('cruds.setting.title') }}</span>
                        <span class="menu-arrow"></span>
                        </span>
                    {{--                        @can('permission_access')--}}
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class=" menu-link {{ request()->query('lang') == "ar" ? 'active' : ''}} "
                               href="{{route('admin.settings.index',['lang'=>"ar"])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.show') }} {{trans('cruds.arabic')}} </span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class=" menu-link {{request()->query('lang') == "en" ? 'active' : ''}} "
                               href="{{route('admin.settings.index',['lang'=>"en"])}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.show') }}  {{trans('cruds.english')}} </span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class=" menu-link {{request()->is("admin/languagesFile*") ? 'active' : ''}} "
                               href="{{url('languagesFile')}}">
                                        <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                        </span>
                                <span
                                    class="menu-title">{{ trans('cruds.show') }}  {{trans('global.languagesFile')}} </span>
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

