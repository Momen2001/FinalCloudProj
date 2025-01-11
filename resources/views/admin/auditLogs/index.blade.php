@extends('layouts.main')
@section('content')
    @include('includes.toolbar')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label fw-bold fs-3 mb-1">{{ trans('global.view',[],session('locale')) }} {{ trans('cruds.auditLog.title',[],session('locale')) }}</span>
            </h3>

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
                    <th class="min-w-80px">   {{ trans('cruds.auditLog.fields.id',[],session('locale')) }}</th>
                    <th class="min-w-140px">  {{ trans('cruds.auditLog.fields.description',[],session('locale')) }}</th>
                    <th class="min-w-120px">  {{ trans('cruds.auditLog.fields.subject_id',[],session('locale')) }}</th>
                    <th class="min-w-120px">  {{ trans('cruds.auditLog.fields.subject_type',[],session('locale')) }}</th>
                    <th class="min-w-120px">  {{ trans('cruds.auditLog.fields.user_id',[],session('locale')) }}</th>
                    <th class="min-w-120px">   {{ trans('cruds.auditLog.fields.host',[],session('locale')) }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.auditLog.fields.created_at',[],session('locale')) }}</th>
                    <th class="min-w-100px text-end">  {{ trans('global.operation',[],session('locale')) }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($auditLogs as $key => $auditLog)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-dark fw-bold text-hover-primary fs-6">  {{ $key+1 }}</a>
                        </td>
                        <td>
                            <a href="#"
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6"> {{ $auditLog->description ?? '' }}</a>
                        </td>
                        <td>
                            <a href="#"
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $auditLog->subject_id ?? '' }}</a>
                        </td>
                        <td>
                            <a href="#"
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6"> {{ $auditLog->subject_type ?? '' }}
                            </a>
                        </td>
                        <td>
                            <a href="#"
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">  {{ $auditLog->user_id ?? '' }}
                            </a>
                        </td>
                        <td>
                            <a href="#"
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">  {{ $auditLog->host ?? '' }}
                            </a>
                        </td>
                        <td>
                            <a href="#"
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6"> {{ $auditLog->created_at ?? '' }}
                            </a>
                        </td>
                        <td class="text-end">
{{--                            @can('user_show')--}}
                                <a href="   {{ route('admin.audit-logs.show', $auditLog->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    @include('partials.icons.show')
                                </a>
{{--                            @endcan--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

