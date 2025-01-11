@extends('layouts.main')
@section('title',trans('global.show',[],session('locale')) .' '. trans('cruds.medicalType.title',[],session('locale')))
@section('content')
    @include('includes.toolbar')
    @include('admin.medicalType.create')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label fw-bold fs-3 mb-1">{{ trans('global.view',[],session('locale')) }} {{ trans('cruds.medicalType.title',[],session('locale')) }}</span>
            </h3>
            <div class="card-toolbar">

                <div class="card-toolbar">
                    <a href="{{route('admin.medicalType.create',[],session('locale'))}}" class="btn btn-sm btn-light-primary"
                       data-bs-toggle="modal"
                       data-bs-target="#kt_modal_new_target">
                        <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                        {{ trans('global.add',[],session('locale')) }} {{ trans('cruds.medicalType.title_singular',[],session('locale')) }}</a>
                </div>
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
                    <th class="min-w-80px"> {{ trans('cruds.medicalType.fields.id',[],session('locale')) }}</th>
                    <th class="min-w-140px">{{ trans('cruds.medicalType.fields.photo',[],session('locale')) }}</th>
                    <th class="min-w-140px">{{ trans('cruds.medicalType.fields.title',[],session('locale')) }}</th>
                    <th class="min-w-120px">{{ trans('cruds.medicalType.fields.status',[],session('locale')) }}</th>
                    <th class="min-w-120px">{{ trans('cruds.medicalType.fields.parent',[],session('locale')) }}</th>
                    <th class="min-w-100px text-end"> {{ trans('global.actions',[],session('locale')) }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($medicalType as $key =>  $item)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.medicalType.show', $item->id) }}"
                               class="text-dark fw-bold text-hover-primary fs-6">#{{ $item->id }}</a>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-3">
                                    <img src="{{ $item->photo }}" class="" alt="">
                                </div>

                                <div class="d-flex justify-content-start flex-column">
                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6"> </a>
                                    <span class="text-gray-400 fw-semibold d-block fs-7"> </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.medicalType.show', $item->id) }}"
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $item->title ?? '' }}</a>
                        </td>


                        <td><span
                                class="badge  @if($item->status ==1) badge-success  @else badge-danger  @endIf">
                               @if($item->status ==1) {{trans('cruds.active',[],session('locale'))}}@else  {{trans('cruds.un_active',[],session('locale'))}}@endIf
                            </span>
                        </td>

                        <td><span
                                class="badge  @if($item->parent == 0)  badge-info  @else badge-warning  @endIf">
                                {{$item->GetParent()}}
                            </span>
                        </td>

                        <td class="text-end">
                                <a href="{{ route('admin.medicalType.edit', $item->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    @include('partials.icons.edit')
                                </a>

                                <a href="{{ route('admin.medicalType.show', $item->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    @include('partials.icons.show')
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

        $(document).on('click', '#btn_save_specialization', function (e) {
            $('#btn_save_specialization').html('{{trans('global.save',[],session('locale'))}} <i class="fa fa-spinner fa-spin"></i>');
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#formSaveSpecialization')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.medicalType.store") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save_specialization').html('save');
                    if (data.status == true) {

                        document.getElementById("formSaveSpecialization").reset();
                        setTimeout(function () {
                            var url = "{{ route('admin.medicalType.index') }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                        }, 0);

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error',[],session('locale'))}}", "{{trans('global.sorry_some_error',[],session('locale'))}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_save_specialization').html("save");

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

