@extends('layouts.main')
@section('content')
    @include('includes.toolbar')
    @include('admin.managers.create')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label fw-bold fs-3 mb-1">{{ trans('global.view',[],session('locale')) }} {{ trans('cruds.user.admin',[],session('locale')) }}</span>
            </h3>
            <div class="card-toolbar">
                    <a href=" " class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                       data-bs-target="#kt_modal_new_target">
                        <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                        {{ trans('global.add',[],session('locale')) }} {{ trans('cruds.user.manager',[],session('locale')) }}</a>
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
                    <th class="min-w-80px"> {{ trans('cruds.user.fields.id',[],session('locale')) }}</th>
                    <th class="min-w-140px">{{ trans('cruds.user.fields.name',[],session('locale')) }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.user.fields.email',[],session('locale')) }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.user.fields.phone',[],session('locale')) }}</th>
                    <th class="min-w-120px">{{ trans('cruds.user.fields.verified',[],session('locale')) }}</th>
                    <th class="min-w-100px text-end"> {{ trans('global.actions',[],session('locale')) }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($admins  as $key => $admin)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </td>
                        <td>
                            <a  class="text-dark fw-bold text-hover-primary fs-6">#{{ $admin->id }}</a>
                        </td>
                        <td>
                            <a
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $admin->first_name ?? '' }}</a>
                            <span
                                class="text-muted fw-semibold text-muted d-block fs-7">{{ $admin->last_name ?? ''}}</span>
                        </td>
                        <td>
                            <a
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $admin->email ?? '' }}</a>
                        </td>
                        <td>
                            <a
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $admin->intro ?? '' }}
                                -{{ $admin->phone ?? '' }}</a>
                        </td>

                        <td>
                        <span
                            class="badge badge-light-success">
                            {{ $admin->verified ?trans('cruds.verified',[],session('locale')) : trans('cruds.un_verified',[],session('locale')) }}
                        </span>
                        </td>

                        <td class="text-end">
                                <a href="{{ route('admin.manager.show', $admin->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    @include('partials.icons.show')
                                </a>

                                <a href="{{ route('admin.manager.edit', $admin->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    @include('partials.icons.edit')
                                </a>

                                <button category_id_attr="{{$admin->id}}"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                        onclick="Confirm_Delete(this)"
                                        data-url="{{ route('admin.manager.destroy', $admin->id) }}">
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

        $(document).on('click', '#btn_save_user', function (e) {
            $('#btn_save_user').html('{{trans('global.save',[],session('locale'))}} <i class="fa fa-spinner fa-spin"></i>');
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#formSaveUser')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.manager.store") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save_user').html('save');
                    if (data.status == true) {

                        document.getElementById("formSaveUser").reset();
                        setTimeout(function () {
                            var url = "{{ route('admin.manager.index') }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                        }, 0);

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error',[],session('locale'))}}", "{{trans('global.sorry_some_error',[],session('locale'))}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_save_user').html("save");

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

