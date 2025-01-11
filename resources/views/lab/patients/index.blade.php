@extends('layouts.lab')
@section('title',trans('global.show') .' '. trans('cruds.patients.title'))

@section('content')
    @include('includes.lab.toolbar')

    <div class="card mb-5 mb-xl-8">

        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                    <span
                        class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.patients.title') }}</span>
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
                    <th class="min-w-80px"> {{ trans('cruds.patients.fields.id') }}</th>
                    <th class="min-w-140px">{{ trans('cruds.patients.fields.name') }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.patients.fields.email') }}</th>
                    <th class="min-w-120px"> {{ trans('cruds.patients.fields.phone') }}</th>
                     <th class="min-w-100px text-end"> {{ trans('global.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($patients  as $key => $patient)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </td>
                        <td>
                            <a class="text-dark fw-bold text-hover-primary fs-6">#{{ $patient->id }}</a>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $patient->first_name ?? '' }}</a>
                            <span
                                class="text-muted fw-semibold text-muted d-block fs-7">{{ $patient->last_name ?? ''}}</span>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $patient->email ?? '' }}</a>
                        </td>
                        <td>
                            <a
                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $patient->intro ?? '' }}
                                -{{ $patient->phone ?? '' }}</a>
                        </td>

                        <td class="text-end">
                            <a href="{{ route('lab.patient.show', $patient->id) }}"
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
    </script>

@endsection

