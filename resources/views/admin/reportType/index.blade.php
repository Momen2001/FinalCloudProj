@extends('layouts.main')
@section('title',trans('global.show') .' '. trans('cruds.reportTypes.title'))
@section('content')
    @include('includes.toolbar')
    @include('admin.reportType.create')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.reportTypes.title') }}</span>
            </h3>
            <div class="card-toolbar">
                    <a href=" " class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                       data-bs-target="#kt_modal_new_target">
                        <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                        {{ trans('global.add') }} {{ trans('cruds.reportTypes.title_singular') }}</a>
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
                    <th class="min-w-80px"> {{ trans('cruds.reportTypes.fields.id') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.reportTypes.fields.photo') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.reportTypes.fields.title_ar') }}</th>
                    <th class="min-w-100px text-end"> {{ trans('global.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($reportTypes as $key =>  $reportType)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.service.show', $reportType->id) }}"
                               class="text-dark fw-bold text-hover-primary fs-6">#{{ $reportType->id }}</a>
                        </td>
                        <td>

                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-3">
                                    <img src="{{ $reportType->photo }}" class="" alt="">
                                </div>

                                <div class="d-flex justify-content-start flex-column">
                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6"> </a>
                                    <span class="text-gray-400 fw-semibold d-block fs-7"> </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.service.show', $reportType->id) }}"
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $reportType->title ?? '' }}</a>
                        </td>

                        <td class="text-end">
                                <a href="{{ route('admin.reportTypes.edit', $reportType->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    @include('partials.icons.edit')
                                </a>

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

        $(document).on('click', '#btn_save_report_type', function (e) {
            $('#btn_save_report_type').html('{{trans('global.save')}} <i class="fa fa-spinner fa-spin"></i>');
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#formSaveReportType')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.reportTypes.store") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save_report_type').html('save');
                    if (data.status == true) {

                        document.getElementById("formSaveReportType").reset();
                        setTimeout(function () {
                            var url = "{{ route('admin.reportTypes.index') }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                        }, 0);

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_save_report_type').html("save");

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

