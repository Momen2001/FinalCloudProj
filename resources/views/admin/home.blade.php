@extends('layouts.main')
@section('title',trans('global.project_name') )
@section('content')
    @include('includes.toolbar')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">

            <div class="row g-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xl-6" style="height: 300px">

                    <div class="card card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body p-0 d-flex justify-content-between flex-column overflow-hidden">
                            <!--begin::Hidden-->
                            <div class="d-flex flex-stack flex-wrap flex-grow-1 px-9 pt-9 pb-3">
                                <div class="me-2">
                                    <span
                                        class="fw-bold text-gray-800 d-block fs-3">{{trans('global.sum_amount_order_payment')}}</span>
                                    {{--                                    <span class="text-gray-400 fw-bold">Oct 8 - Oct 26 23</span>--}}
                                </div>


                                <div class="fw-bold fs-3 text-info">
                                    {{\App\Models\OrderPayment::sum('amount')}} {{trans('global.sar')}}
                                </div>
                            </div>
                            <!--end::Hidden-->

                            <!--begin::Chart-->
                            <div class="mixed-widget-10-chart" data-kt-color="info" style="height: 200px"></div>
                            <!--end::Chart-->
                        </div>
                    </div>
                </div>


                <div class="card card-flush h-xl-100 col-lg-6">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span
                                class="card-label fw-bold text-gray-800">{{trans('cruds.statistics')}} {{trans('cruds.main_service.title')}}</span>

{{--                                                        <span class="text-gray-400 pt-2 fw-semibold fs-6">{{trans('cruds.')}}</span>--}}
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body d-flex justify-content-between flex-column py-3 ">
                        <!--begin::Block-->
                        <div class="m-0"></div>
                        <!--end::Block-->

                        <!--begin::Table container-->
                        <div  class="hover-scroll-overlay-y pe-6 me-n6" style="height: 300px">
                            <!--begin::Table-->
                            <table class="table table-row-dashed gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                <tr class="fs-7 fw-bold border-0 text-gray-400">
                                    <th class="min-w-300px">{{trans('cruds.main_service.title')}}</th>
                                    <th class="min-w-100px">{{trans('global.order_count')}}  </th>
                                </tr>
                                </thead>
                                <!--end::Table head-->

                                <!--begin::Table body-->
                                <tbody>


                                @foreach(\App\Models\MainService::all() as $mainService)
                                    <tr>
                                        <td>
                                            <a href="#"
                                               class="text-gray-600 fw-bold text-hover-primary mb-1 fs-6">{{$mainService->title}}</a>
                                        </td>
                                        <td class="d-flex align-items-center border-0">
                                            <span
                                                class="fw-bold text-gray-800 fs-6 me-3">{{$mainService->orders->count()}}</span>

                                            <div class="progress rounded-start-0">

                                                @if($mainService->orders->count() != 0)
                                                    <div class="progress-bar bg-success m-0" role="progressbar"
                                                         style="height: 12px;width: {{$mainService->orders->count()}}px"
                                                         aria-valuenow="{{$mainService->orders->count()}}"
                                                         aria-valuemin="0"
                                                         aria-valuemax="{{$mainService->orders->count()}}px"></div>
                                                @else
                                                    <div class="progress-bar bg-danger m-0" role="progressbar"
                                                         style="height: 12px;width: 166px" aria-valuenow="166"
                                                         aria-valuemin="0" aria-valuemax="166px"></div>

                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Table Widget 11-->
            </div>

            <!--begin::Table widget 11-->





            <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Tables Widget 9-->
                    <div class=" card-xl-stretch mb-5 mb-xl-8">

                        <div class="card-body py-3">
                            <!--begin::Table container-->
                            <div class="row g-5 g-xl-8">
                                <div class="col-xl-3">
                                    <!--begin::Statistics Widget 5-->
                                    <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                            <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"/>
														<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5"
                                                              fill="black"/>
														<rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"/>
														<rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"/>
													</svg>
												</span>
                                            <!--end::Svg Icon-->
                                            <div
                                                class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{\App\Models\MainService::Active()->count()}}</div>
                                            <div
                                                class="fw-bold text-gray-800">{{trans('global.main_service_count')}}</div>
                                        </div>
                                        <!--end::Body-->
                                    </a>
                                    <!--end::Statistics Widget 5-->
                                </div>

                                <div class="col-xl-3">
                                    <!--begin::Statistics Widget 5-->
                                    <a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<path opacity="0.3"
                                                              d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z"
                                                              fill="black"/>
														<path
                                                            d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z"
                                                            fill="black"/>
													</svg>
												</span>
                                            <!--end::Svg Icon-->
                                            <div
                                                class="text-white fw-bolder fs-2 mb-2 mt-5">{{\App\Models\User::WhereDoctor()->count()}}
                                            </div>
                                            <div
                                                class="fw-bold text-white">{{trans('global.doctors_count')}}</div>
                                        </div>
                                        <!--end::Body-->
                                    </a>
                                    <!--end::Statistics Widget 5-->
                                </div>

                                <div class="col-xl-3">
                                    <!--begin::Statistics Widget 5-->
                                    <a href="#" class="card bg-success  hoverable card-xl-stretch mb-xl-8">
                                        <!--begin::Body-->
                                        <div class="card-body">
                                                <span class="svg-icon svg-icon-dark svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Code/Done-circle.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <path
                                                            d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z"
                                                            fill="#000000" fill-rule="nonzero"/>
                                                    </g>
                                                </svg>
                                                </span>
                                            <div
                                                class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">{{\App\Models\User::WhereHospital()->count()}}
                                            </div>
                                            <div
                                                class="fw-bold text-gray-100">{{trans('global.hospital_count')}}</div>
                                        </div>
                                        <!--end::Body-->
                                    </a>
                                    <!--end::Statistics Widget 5-->
                                </div>


                                <div class="col-xl-3">
                                    <!--begin::Statistics Widget 5-->
                                    <a href="#" class="card bg-danger  hoverable card-xl-stretch mb-xl-8">
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                            <span class="svg-icon svg-icon-white svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Code/Error-circle.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <path
                                                            d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z"
                                                            fill="#000000"/>
                                                    </g>
                                                </svg><!--end::Svg Icon--></span>
                                            <!--end::Svg Icon-->
                                            <div
                                                class="text-white fw-bolder fs-2 mb-2 mt-5">{{\App\Models\Order::count()}}
                                            </div>
                                            <div
                                                class="fw-bold text-white">{{trans('global.order_count')}}</div>
                                        </div>
                                        <!--end::Body-->
                                    </a>
                                    <!--end::Statistics Widget 5-->
                                </div>

                                <div class="col-xl-3">
                                    <!--begin::Statistics Widget 5-->
                                    <a href=""
                                       class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Code/Warning-2.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path
                                                            d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z"
                                                            fill="#000000" opacity="0.3"/>
                                                        <rect fill="#000000" x="11" y="9" width="2" height="7" rx="1"/>
                                                        <rect fill="#000000" x="11" y="17" width="2" height="2" rx="1"/>
                                                    </g>
                                                </svg></span>

                                            <div
                                                class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{\App\Models\User::WherePatient()->count()}}
                                            </div>
                                            <div
                                                class="fw-bold text-gray-800">{{trans('global.patient_count')}}</div>
                                        </div>
                                        <!--end::Body-->
                                    </a>
                                    <!--end::Statistics Widget 5-->
                                </div>
                            </div>


                            <!--end::Table container-->
                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--end::Tables Widget 9-->
                </div>
                <!--end::Col-->

            </div>


        </div>
    </div>


    <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">

        </div>
    </div>


@endsection



 @section('script')

     <script>
         var initMixedWidget10 = function() {
             var charts = document.querySelectorAll('.mixed-widget-10-chart');

             var color;
             var height;
             var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
             var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
             var baseLightColor;
             var secondaryColor = KTUtil.getCssVariableValue('--bs-gray-300');
             var baseColor;
             var options;
             var chart;

             [].slice.call(charts).map(function(element) {
                 color = element.getAttribute("data-kt-color");
                 height = parseInt(KTUtil.css(element, 'height'));
                 baseColor = KTUtil.getCssVariableValue('--bs-' + color);

                 options = {
                     series: [{
                         name: 'Net Profit',
                         data: [{{profitAmount(1)}}, {{profitAmount(2)}}, {{profitAmount(3)}}, {{profitAmount(4)}}, {{profitAmount(5)}}, {{profitAmount(6)}}, {{profitAmount(7)}}, {{profitAmount(8)}}, {{profitAmount(9)}}, {{profitAmount(10)}}, {{profitAmount(11)}}, {{profitAmount(12)}}]
                     }, {
                         name: 'Revenue',
                         data: [{{profitAmount(1)}}, {{profitAmount(2)}}, {{profitAmount(3)}}, {{profitAmount(4)}}, {{profitAmount(5)}}, {{profitAmount(6)}}, {{profitAmount(7)}}, {{profitAmount(8)}}, {{profitAmount(9)}}, {{profitAmount(10)}}, {{profitAmount(11)}}, {{profitAmount(12)}}]
                     }],
                     chart: {
                         fontFamily: 'inherit',
                         type: 'bar',
                         height: height,
                         toolbar: {
                             show: false
                         }
                     },
                     plotOptions: {
                         bar: {
                             horizontal: false,
                             columnWidth: ['50%'],
                             endingShape: 'rounded'
                         },
                     },
                     legend: {
                         show: false
                     },
                     dataLabels: {
                         enabled: false
                     },
                     stroke: {
                         show: true,
                         width: 2,
                         colors: ['transparent']
                     },
                     xaxis: {
                         categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                         axisBorder: {
                             show: false,
                         },
                         axisTicks: {
                             show: false
                         },
                         labels: {
                             style: {
                                 colors: labelColor,
                                 fontSize: '12px'
                             }
                         }
                     },
                     yaxis: {
                         y: 0,
                         offsetX: 0,
                         offsetY: 0,
                         labels: {
                             style: {
                                 colors: labelColor,
                                 fontSize: '12px'
                             }
                         }
                     },
                     fill: {
                         type: 'solid'
                     },
                     states: {
                         normal: {
                             filter: {
                                 type: 'none',
                                 value: 0
                             }
                         },
                         hover: {
                             filter: {
                                 type: 'none',
                                 value: 0
                             }
                         },
                         active: {
                             allowMultipleDataPointsSelection: false,
                             filter: {
                                 type: 'none',
                                 value: 0
                             }
                         }
                     },
                     tooltip: {
                         style: {
                             fontSize: '12px'
                         },
                         y: {
                             formatter: function (val) {
                                 return "$" + val + " revenue"
                             }
                         }
                     },
                     colors: [baseColor, secondaryColor],
                     grid: {
                         padding: {
                             top: 10
                         },
                         borderColor: borderColor,
                         strokeDashArray: 4,
                         yaxis: {
                             lines: {
                                 show: true
                             }
                         }
                     }
                 };

                 chart = new ApexCharts(element, options);
                 chart.render();
             });
         }

     </script>


@endsection
