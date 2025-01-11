@extends('layouts.main')
@section('title',trans('global.show') .' '. trans('cruds.patients.title'))

@section('content')
    @include('includes.toolbar')

    <div class="card mb-5 mb-xl-8">

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
                    <th class="min-w-120px">{{ trans('cruds.patients.fields.verified') }}</th>
                    <th class="min-w-120px">{{ trans('cruds.patients.fields.created_at') }}</th>
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

                        <td>
                                    <span
                                        class="badge @if($patient->verified) badge-light-success @else badge-light-danger @endif ">  {{ $patient->verified ?trans('cruds.verified') : trans('cruds.un_verified') }} </span>
                        </td>
                        <td>
                            <span class="badge badge-light-info">  {{  $patient->created_at  }} </span>
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.patient.show', $patient->id) }}"
                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                @include('partials.icons.show')
                            </a>

                            <a href="{{ route('admin.patient.edit', $patient->id) }}"
                               class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                @include('partials.icons.edit')
                            </a>

{{--                            <button category_id_attr="{{$patient->id}}"--}}
{{--                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"--}}
{{--                                    onclick="Confirm_Delete(this)"--}}
{{--                                    data-url="{{ route('admin.patient.destroy', $patient->id) }}">--}}
{{--                                @include('partials.icons.delete')--}}
{{--                            </button>--}}
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

