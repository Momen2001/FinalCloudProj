@extends('layouts.lab')
@section('title',trans('global.show') .' '. trans('cruds.doctor_services.title_singular'))
@section('content')
    @include('includes.lab.toolbar')
    @include('lab.doctorServices.create')
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.doctor_services.title_singular') }} ({{$doctor->getProviderName()}})</span>
            </h3>
            <div class="card-toolbar">
                <a href=" " class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                   data-bs-target="#kt_modal_new_target">
                    <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                    {{ trans('global.create') }} {{ trans('cruds.doctor_services.title_singular') }}
                </a>
            </div>
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
                    <th class="min-w-80px"> {{ trans('cruds.services.title_singular') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.main_service.title_singular') }}</th>
                    <th class="min-w-140px">{{ trans('global.delete') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($doctor->doctorService  as   $doctorService)

                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </td>
                        <td>
                            <a href="#"
                               class="text-dark fw-bold text-hover-primary fs-6">#{{ $doctorService->title }}</a>
                        </td>
                        <td>
                            <a href="#"
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $doctorService->mainService->title ?? '' }}</a>
                        </td>

                        <td>
                            <button category_id_attr="{{$doctorService->id}}"
                                    class="btn btn-icon btn-danger btn-active-color-white btn-sm"
                                    onclick="Confirm_Delete(this)"
                                    data-url="{{ route('lab.doctor-service.destroy', $doctorService->pivot->id) }}">
                                @include('partials.icons.delete')
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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

        $(document).on('click', '#btn_save', function (e) {
            $('#btn_save').html('{{trans('global.save')}} <i class="fa fa-spinner fa-spin"></i>');
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#formSave')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("lab.doctor-service.store") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save').html('save');
                    if (data.status == true) {
                        document.getElementById("formSave").reset();
                   location.reload();
                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_save').html("save");

                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        // for loop to all validation and show all validate
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });
    </script>

    <script>
        $(document).on('change', '#mains_service_id', function (e) {
            e.preventDefault();
            let main_service_id = $(this).val();
            $('#service_id').empty();
            $('#service_description').empty();
            $('#msg').empty();
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("lab.labFilterServiceByMainService") }}",
                data: {'main_service_id': main_service_id, 'doctor_id': {{$doctor->id}}}, // send this data to controller
                dataType: 'json',
                success: function (data) {
                    $('#msg').text(data.msg);
                    $('select[name="service_id"]').empty();
                    $('select[name="service_id"]').append('<option value="">"{{trans('cruds.medicalSessions.title')}}</option>');
                    $.each(data.services, function (key, value) {
                        $('select[name="service_id"]').append(`<option value="${value.id}">${value.title}</option>`);
                    });
                }
            });
        });
    </script>

    <script>
        $('#service_id').change(function () {
            let service_id = $(this).val();
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("lab.adjust-services.servicesDetails") }}",
                data: {'service_id': service_id}, // send this data to controller
                dataType: 'json',
                success: function (data) {
                    $('#service_description').text(data.service.description);
                }
            });
        })
    </script>

@endsection

