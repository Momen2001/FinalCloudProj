@extends('layouts.lab')
@section('title',trans('global.show') .' '. trans('cruds.doctor.title'))
@section('content')

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span
                    class="card-label fw-bold fs-3 mb-1">{{ trans('global.view',[],session('locale')) }} {{ trans('cruds.doctor.title',[],session('locale')) }}</span>
            </h3>
            <div class="card-toolbar">
                {{--                @can('doctor_create')--}}
                <a href="{{route('lab.doctor.create')}}" class="btn btn-sm btn-light-primary"
                   data-bs-target="#kt_modal_new_target">
                    <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                    {{ trans('global.add',[],session('locale')) }} {{ trans('cruds.doctor.title_singular',[],session('locale')) }}</a>
                {{--                @endcan--}}
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fw-bold text-muted">
                        <th class="w-25px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </th>
                        <th class="min-w-150px"> {{ trans('cruds.doctor.fields.id',[],session('locale')) }}</th>
                        <th class="min-w-140px">    {{ trans('cruds.doctor.fields.name',[],session('locale')) }}</th>
                        <th class="min-w-120px"> {{ trans('cruds.doctor.fields.email',[],session('locale')) }}</th>
                        <th class="min-w-100px text-end"> {{ trans('global.actions',[],session('locale')) }}</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    @foreach ($doctors  as $key => $doctor)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                </div>
                            </td>
                            <td>
                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">#{{ $key+1 }}</a>
                            </td>
                            <td>
                                <a href="#"
                                   class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $doctor->first_name ?? '' }}</a>
                                <span
                                    class="text-muted fw-semibold text-muted d-block fs-7">{{ $doctor->last_name ?? ''}}</span>
                            </td>
                            <td>
                                <a href="#"
                                   class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $doctor->email ?? '' }}</a>
                                <span
                                    class="text-muted fw-semibold text-muted d-block fs-7">{{ $doctor->email_verified_at ? 'verified at' :'not verified at' }}</span>
                            </td>


                            <td class="text-end">
                                    <a href="{{ route('lab.doctor.show', $doctor->id) }}"
                                       class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                        @include('partials.icons.show')
                                    </a>

                                <a href="{{ route('lab.doctor.edit', $doctor->id) }}"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    @include('partials.icons.edit')
                                </a>

                                <button category_id_attr="{{$doctor->id}}"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                        onclick="Confirm_Delete(this)"
                                        data-url="{{ route('lab.doctor.destroy', $doctor->id) }}">
                                    @include('partials.icons.delete')
                                </button>


                                <a href="{{ route('lab.doctor-service.show', $doctor->id) }}"
                                   class="btn  btn-bg-info text-white btn-active-color-primary btn-sm me-1 m-3">
                                    {{trans('cruds.doctor_services.title_singular')}}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
    <!--end::Tables Widget 13-->

@endsection


