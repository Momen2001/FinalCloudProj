@extends('layouts.main')
@section('title',trans('global.show') .' '. trans('cruds.services.title'))
@section('content')
    @include('includes.toolbar')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.services.title') }}</span>
            </h3>
            <div class="card-toolbar">
                <a href="{{route('admin.service.create')}}" class="btn btn-sm btn-light-primary"
                   data-bs-target="#kt_modal_new_target">
                    <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                    {{ trans('global.add') }} {{ trans('cruds.services.title_singular') }}</a>
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
                    <th class="min-w-80px"> {{ trans('cruds.services.fields.id') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.services.fields.title_ar') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.services.fields.main_service') }}</th>

                    <th class="min-w-120px">{{ trans('cruds.services.fields.status') }}</th>
                    <th class="min-w-100px text-end"> {{ trans('global.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($services as $key =>  $service)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.service.show', $service->id) }}"
                               class="text-dark fw-bold text-hover-primary fs-6">#{{ $service->id }}</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.service.show', $service->id) }}"
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $service->title ?? '' }}</a>
                        </td>
                        <td>
                            {{ $service->mainService->title ?? '' }}
                        </td>

                        <td><span
                                class="badge  @if($service->status ==1) badge-success  @else badge-danger  @endIf">
                               @if($service->status ==1) {{trans('cruds.active')}}@else  {{trans('cruds.un_active')}}@endIf
                            </span>
                        </td>

                        <td class="text-end">
                                <a href="{{ route('admin.service.edit', $service->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    @include('partials.icons.edit')
                                </a>

                                <a href="{{ route('admin.service.show', $service->id) }}"
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

    </script>
@endsection

