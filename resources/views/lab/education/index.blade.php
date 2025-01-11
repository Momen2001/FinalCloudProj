@extends('layouts.lab')
@section('title',trans('global.show') .' '. trans('cruds.educations.title'))
@section('content')
    @include('includes.lab.toolbar')
    @include('lab.education.create')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.educations.title') }}</span>
            </h3>
            <div class="card-toolbar">
                <a href=" " class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                   data-bs-target="#kt_modal_new_target">
                    <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                    {{ trans('global.add') }} {{ trans('cruds.educations.title_singular') }}</a>
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
                    <th class="min-w-80px"> {{ trans('cruds.educations.fields.id') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.educations.fields.doctor_id') }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.educations.fields.completion_date') }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.educations.fields.country_id') }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.educations.fields.university') }}</th>
                    <th class="min-w-120px">{{ trans('cruds.educations.fields.department') }}</th>
                    <th class="min-w-120px">{{ trans('cruds.educations.fields.degree') }}</th>
                    <th class="min-w-100px text-end"> {{ trans('global.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($educations as $key => $education)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </td>
                        <td>
                            <a class="text-dark fw-bold text-hover-primary fs-6">#{{ $education->id }}</a>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $education->doctor->email ?? '' }}</a>

                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $education->completion_date ?? '' }}</a>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $education->country->title ?? '' }}
                            </a>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $education->university ?? '' }}
                            </a>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $education->department ?? '' }}
                            </a>
                        </td>

                        <td><span
                                class="badge    badge-success   ">
                             {{ $education->degree}}
                            </span>
                        </td>

                        <td class="text-end">
                                <a href="{{ route('lab.education.edit', $education->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    @include('partials.icons.edit')
                                </a>

                            <button category_id_attr="{{$education->id}}"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                    onclick="Confirm_Delete(this)"
                                    data-url="{{ route('lab.education.destroy', $education->id) }}">
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
                url: "{{ route("lab.education.store") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save').html('save');
                    if (data.status == true) {
                        document.getElementById("formSave").reset();
                        setTimeout(function () {
                            var url = "{{ route('lab.education.index') }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                        }, 0);
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

@endsection

