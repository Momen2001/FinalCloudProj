@extends('layouts.lab')
@section('title',trans('global.show') .' '. trans('cruds.main_service.title'))
@section('content')
    @include('includes.lab.toolbar')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.main_service.title') }}</span>
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
                    <th class="min-w-80px"> {{ trans('cruds.hospital.fields.id') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.hospital.fields.photo') }}</th>

                    <th class="min-w-140px">{{ trans('cruds.hospital.fields.name') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.hospital.fields.name') }}</th>
                     <th class="min-w-100px text-end"> {{ trans('global.actions') }}</th>
                    <th class="min-w-100px text-end"> {{ trans('global.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($hospital_main_services  as $key => $main_service)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </td>
                        <td>
                            <a href="#" class="text-dark fw-bold text-hover-primary fs-6">#{{ $main_service->id }}</a>
                        </td>
                        <td>

                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-3">
                                    <img src="{{ $main_service->photo }}" class="" alt="">
                                </div>

                                <div class="d-flex justify-content-start flex-column">
                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6"> </a>
                                    <span class="text-gray-400 fw-semibold d-block fs-7"> </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#"
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $main_service->translate('en')->title ?? '' }}</a>
                        </td>
                        <td>
                            <a href="#"
                               class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $main_service->translate('ar')->title ?? '' }}</a>
                        </td>



                        <td class="text-end">
                            <a href="{{ route('lab.main-service.edit', $main_service->id) }}"
                               class="btn btn-icon btn-info btn-active-color-white btn-sm me-1">
                                @include('partials.icons.edit')
                            </a>



                        </td>
                        <td class="text-end">
                                <a href="{{ route('lab.adjust-services.show', $main_service->id) }}"
                                   class="btn  btn-bg-info text-white btn-active-color-primary btn-sm me-1">
                                    {{trans('global.adjust')}}  {{trans('cruds.services.title')}}
                                </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


