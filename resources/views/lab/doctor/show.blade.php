@extends('layouts.lab')
@section('title',trans('global.show') .' '. trans('cruds.doctor.title'))
@section('content')
    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('global.view') }} {{ trans('cruds.doctor.title_singular') ." ". "#" . $doctor->id }}  </h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body py-3">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                        <tbody>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.photo') }}
                                            </th>
                                            <td>
                                                <img src="{{ $doctor->photo }}" style="height: 100px;width: 100px">
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.id') }}
                                            </th>
                                            <td>
                                                {{ $doctor->id }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.first_name') }}
                                            </th>
                                            <td>
                                                {{ $doctor->first_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.last_name') }}
                                            </th>
                                            <td>
                                                {{ $doctor->last_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.first_name_en') }}
                                            </th>
                                            <td>
                                                {{ $doctor->first_name_en }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.last_name_en') }}
                                            </th>
                                            <td>
                                                {{ $doctor->last_name_en }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.birth_date') }}
                                            </th>
                                            <td>
                                                {{ $doctor->birth_date }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.phone') }}
                                            </th>
                                            <td>
                                                {{ $doctor->phone }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.country') }}
                                            </th>
                                            <td>
                                                {{ $doctor->country->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.city') }}
                                            </th>
                                            <td>
                                                {{ $doctor->city->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.passport') }}
                                            </th>
                                            <td>
                                                {{ $doctor->passport_id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.email') }}
                                            </th>
                                            <td>
                                                {{ $doctor->email }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.experience_start_work') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->experience_start_work }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.emergency_online_price') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->emergency_online_price }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.emergency_home_visit_price') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->emergency_home_visit_price }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.online_price') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->online_price }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.home_visit_price') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->home_visit_price }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.in_hospital_price') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->in_hospital_price }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.speciality') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->speciality }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.license') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->license }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.bio') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->bio }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.education') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->education }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.experience') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->experience }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.gender') }}
                                            </th>
                                            <td>
                                                {{$doctor->gender }}
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.can_work_emergency_online') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->can_work_emergency_online== 1? trans('global.active'):trans('global.un_active') }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.can_work_emergency_home_visit') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->can_work_emergency_home_visit== 1? trans('global.active'):trans('global.un_active') }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.can_work_in_home_visit') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->can_work_in_home_visit== 1? trans('global.active'):trans('global.un_active') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.can_work_in_hospital') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->can_work_in_hospital== 1? trans('global.active'):trans('global.un_active') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.doctor.fields.can_work_online') }}
                                            </th>
                                            <td>
                                                {{$doctor->doctorSetting->can_work_online== 1? trans('global.active'):trans('global.un_active') }}
                                            </td>
                                        </tr>


                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <a class="btn btn-default badge badge-light-primary" onclick="history.back();">
                                            {{ trans('global.return_back') }}
                                        </a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
