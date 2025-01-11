@extends('layouts.lab')
@section('title',trans('global.edit') .' '. trans('cruds.doctor.updateDoctorScheduleOutside'))
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">

            <div class="card card-custom example example-compact mt-4">
                <div class="card-header">
                    <h3 class="card-title">  {{ trans('cruds.doctor.updateDoctorScheduleOutside') }}</h3>
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

                            @foreach($drWorkSchedule['days'] as $staticDays=>$object)

                                <div class="col-md-6 col-lg-3 fv-row">
                                    <div class="d-flex flex-column mb-8 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2 text-primary">
                                            <span class="required">{{ trans('global.days') }}</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                               title="Specify a target name for future usage and reference"></i>
                                        </label>
                                        <!--end::Label-->
                                        <input type="text" class="form-control form-control-solid text-primary" disabled
                                               value="{{$staticDays}}"/>

                                        <input type="hidden" id="days" name="days[{{$staticDays}}]"
                                               value="{{$staticDays}}">
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
                                                data-placeholder="{{trans('cruds.lab.fields.active')}}"
                                                name="days[{{$staticDays}}][active]" id="days[{{$staticDays}}][active]">
                                            <option value="1"
                                                    @if($object['active']) selected @endif> {{trans('global.active')}}</option>
                                            <option value="0" @if(!$object['active']) selected @endif
                                            >{{trans('global.un_active')}}</option>
                                        </select>
                                        <span class="text-danger errors"
                                              id="days[$staticDays][active]_error"> </span>
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-6 fv-row">
                                    <label
                                        class="required fs-6 fw-semibold mb-2">{{ trans('cruds.lab.fields.work_hours') }}</label>
                                    <select class="form-select form-select-solid" data-control="select2" multiple
                                            data-hide-search="true"
                                            data-placeholder="{{trans('cruds.lab.fields.work_hours')}}"
                                            name="days[{{$staticDays}}][work_hours][]"
                                            id="work_hours[{{$staticDays}}][work_hours]">
                                        @foreach(staticHorses() as $staticHorses)
                                            <option value="{{$staticHorses}}"
                                                    @if(in_array($staticHorses , $object['work_hours']) )
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


        $(document).on('click', '#btn_update_schedule', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdateSchedule')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route("lab.doctor.update.scheduleOutside",$doctor->id)}}",
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
                            showCancelButton: true,
                            confirmButtonText: "{{trans('global.confirmation')}}",
                            cancelButtonText: "{{trans('global.confirmationAndBack')}}",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-warning"
                            },

                            preConfirm: () => {
                                // Redirect only if the confirm button is clicked
                                {{--window.location.href = "{{ route('lab.doctor.edit',$doctor->id) }}";--}}
                            }
                        }).then((result) => {
                            // Handle redirection if cancel button is clicked
                            if (result.dismiss === Swal.DismissReason.cancel) {
                                // Redirect to another route or perform any other action
                                window.location.href = "{{ route('lab.doctor.edit',$doctor->id) }}";
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
