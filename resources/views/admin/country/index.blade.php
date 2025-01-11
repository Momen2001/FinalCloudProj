@extends('layouts.main')
@section('title',trans('global.show') .' '. trans('cruds.country.title'))
@section('content')
    @include('includes.toolbar')
    @include('admin.reportType.create')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.country.title') }}</span>
            </h3>
        </div>
        <div class="card-body py-3">

            <table id="kt_datatable_dom_positioning"
                   class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                <thead>
                <tr class="fw-bold fs-6 text-gray-800 px-7">
                    <th class="w-25px">
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                        </div>
                    </th>
                    <th class="min-w-80px"> {{ trans('cruds.country.fields.id') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.country.fields.flag') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.country.fields.title') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.country.fields.iso3') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.country.fields.iso2') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.country.fields.timezone') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.country.fields.phone_code') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.country.fields.status') }}</th>
                    <th class="min-w-100px">  {{ trans('cruds.cities.title') }}</th>
                    <th class="min-w-100px text-end"> {{ trans('global.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($countries as $key =>  $country)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </td>
                        <td>
                            #{{ $country->id }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-50px me-3">
                                    <img src="{{ $country->flag }}" class="" alt="">
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ $country->title ?? '' }}
                        </td>
                        <td>
                            {{ $country->iso3 ?? '' }}
                        </td>
                        <td>
                            {{ $country->iso2 ?? '' }}
                        </td>
                        <td>
                            {{ $country->timezone ?? '' }}
                        </td>
                        <td>
                            {{ $country->phone_code ?? '' }}
                        </td>

                        <td>
                            <span
                                class="badge  @if($country->status ==1) badge-success  @else badge-danger  @endIf">
                               @if($country->status ==1) {{trans('cruds.active')}} @else  {{trans('cruds.un_active')}}@endIf
                            </span>
                        </td>
                        <td>
                            <div class="card-toolbar">
                                <a href="{{ route('admin.cities.index', $country->id) }}"
                                   data-bs-target="#kt_modal_new_target">
                                <span class="badge badge-warning">
                                    {{ trans('cruds.cities.title') }}
                            </span>
                                </a>
                            </div>

                        </td>
                        <td class="text-end">
                                 <a href="{{ route('admin.countries.edit', $country->id) }}"
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


