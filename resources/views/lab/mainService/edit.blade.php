@extends('layouts.lab')
@section('title',trans('global.edit') .' '. trans('cruds.main_service.title_singular'))
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit') }} {{ trans('cruds.main_service.title_singular') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>

                        <button class="btn btn-sm btn-primary" type="button"
                                id="btn_update"> {{ trans('global.edit') }}</button>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formUpdate" novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-13 text-center">
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-4 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'number','label'=>trans('cruds.hospital.fields.time_before_receiving'),'placeholder'=>trans('cruds.hospital.fields.time_before_receiving'),'id'=>'time_before_receiving','name'=>'time_before_receiving','span'=>'time_before_receiving','value'=>$hospitalMainService->time_before_receiving ])
                                </div>
                            </div>
                            @if(!in_array($hospitalMainService->main_service_id, [mainServiceById()['Caregiver'], mainServiceById()['TeleMedicUrgent'], mainServiceById()['TeleMedic'], mainServiceById()['HomeVisitUrgent'], mainServiceById()['HomeCare']]))

                                <div class="col-md-6 col-lg-4 fv-row">
                                    <label
                                        class="required fs-6 fw-semibold mb-2">{{ trans('cruds.hospital.fields.can_work_out_side') }}</label>
                                    <div class="d-flex flex-column mb-8 fv-row">
                                        <select class="form-select form-select-solid" data-control="select2"
                                                data-hide-search="true"
                                                data-placeholder="{{trans('cruds.hospital.fields.can_work_out_side')}}"
                                                name="can_work_out_side" id="can_work_out_side">
                                            <option value="0"
                                                    @if($hospitalMainService->can_work_out_side ==0) selected @endif>{{trans('global.out_side_hospital')}}
                                            </option>

                                            <option value="1"
                                                    @if($hospitalMainService->can_work_out_side ==1) selected @endif>{{trans('global.inside_hospital')}}
                                            </option>

                                            <option value="2"
                                                    @if($hospitalMainService->can_work_out_side ==2) selected @endif>{{trans('global.inside_and_out_side_hospital')}}
                                            </option>
                                        </select>
                                        <span class="text-danger errors"
                                              id="can_work_out_side_error"> </span>
                                    </div>
                                </div>
                            @endif

                            @if($hospitalMainService->main_service_id == mainServiceById()['Offer'])

                            <div class="col-md-6 col-lg-4 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.hospital.fields.payment_methods') }}</label>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <select class="form-select form-select-solid" data-control="select2"
                                            data-hide-search="true"
                                            data-placeholder="{{trans('cruds.hospital.fields.payment_methods')}}"
                                            name="payment_method_ids[]" id="payment_method_ids" multiple>
                                        @foreach($paymentMethods as $paymentMethod)
                                            <option value="{{$paymentMethod->id}}" @if( in_array($paymentMethod->id,$hospitalPaymentIds))selected @endif
                                            >{{$paymentMethod->title}}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger errors"
                                          id="payment_method_ids_error"> </span>
                                </div>
                            </div>
                            @endif

                            <div></div>
                        </div>
                    </div>
                </form>
            </div>


            <div class="card card-custom example example-compact mt-4">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit') }} {{ trans('cruds.main_service.schedule') }} {{ trans('cruds.main_service.title_singular') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>

                        <button class="btn btn-sm btn-primary" type="button"
                                id="btn_update_schedule"> {{ trans('global.edit') }}</button>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formUpdateSchedule"
                      novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-13 text-center">
                        </div>
                        <div class="row g-9 mb-8">
                            @foreach(staticDays() as $staticDays)
                                <div class="col-md-6 col-lg-3 fv-row">
                                    <div class="d-flex flex-column mb-8 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2 text-primary">
                                            <span class="required">{{ trans('global.days') }}</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                               title="Specify a target name for future usage and reference"></i>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text"  class="form-control form-control-solid text-primary"  disabled value="{{$staticDays}}"/>

                                        <input type="hidden" id="days" name="days[{{$staticDays}}]" value="{{$staticDays}}">
                                        <span class="text-danger errors"
                                              id="days[{{$staticDays}}]_error"> </span>
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3 fv-row">
                                    <label
                                        class="required fs-6 fw-semibold mb-2">{{ trans('global.check_active') }}</label>
                                    <div class="d-flex flex-column mb-8 fv-row">
                                        <select class="form-select form-select-solid" data-control="select2"
                                                data-hide-search="true"
                                                data-placeholder="{{trans('cruds.hospital.fields.active')}}"
                                                name="days[{{$staticDays}}][active]" id="days[{{$staticDays}}][active]">
                                            <option value="1"
                                                    @if(MainServicesHospitalValue($hospitalMainService->hospital_id,$hospitalMainService->main_service_id,$staticDays) == 1)
                                                    selected @endif> {{trans('global.active')}}</option>
                                            <option value="0"
                                                    @if(MainServicesHospitalValue($hospitalMainService->hospital_id,$hospitalMainService->main_service_id,$staticDays) == 0)
                                                    selected @endif
                                            >{{trans('global.un_active')}}</option>
                                        </select>
                                        <span class="text-danger errors"
                                              id="days[$staticDays][active]_error"> </span>
                                    </div>
                                </div>
                                 <div class="col-md-4 col-lg-6 fv-row">
                                    <label
                                        class="required fs-6 fw-semibold mb-2">{{ trans('cruds.hospital.fields.work_hours') }}</label>
                                    <select class="form-select form-select-solid" data-control="select2" multiple
                                            data-hide-search="true"
                                            data-placeholder="{{trans('cruds.hospital.fields.work_hours')}}"
                                            name="days[{{$staticDays}}][work_hours][]"
                                            id="work_hours[{{$staticDays}}][work_hours]">
                                        @foreach(staticHorses() as $staticHorses)
                                            <option value="{{$staticHorses}}"
                                                    @if(in_array($staticHorses,MainServicesHospitalHouses($hospitalMainService->hospital_id,$hospitalMainService->main_service_id,$staticDays)) )
                                                    selected @endif
                                            >{{trans('global.house').' '. $staticHorses}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger errors"
                                          id="main_services_error"> </span>
                                </div>
                            @endforeach
                            <div></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
 @endsection


@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '#btn_update', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdate')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route("lab.main-service.update", $hospitalMainService->main_service_id)}}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_update').html();

                    if (data.status == true) {
                        Swal.fire({
                            title: data.msg,
                            text: data.msg,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "{{trans('global.confirmation')}}",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    // $('#btn_update').html('save');

                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        // for loop to all validation and show all validate
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });


        $(document).on('click', '#btn_update_schedule', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdateSchedule')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route("lab.update-schedule",[$hospitalMainService->hospital_id,$hospitalMainService->main_service_id])}}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_update_schedule').html();

                    if (data.status == true) {
                        Swal.fire({
                            title: data.msg,
                            text: data.msg,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "{{trans('global.confirmation')}}",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_update_schedule').html('save');

                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        // for loop to all validation and show all validate
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });


    </script>
@endsection
