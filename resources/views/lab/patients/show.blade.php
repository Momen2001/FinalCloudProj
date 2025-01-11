@extends('layouts.lab')
@section('title',trans('global.show') .' '. trans('cruds.patients.title'))
@section('content')
    @include('includes.lab.toolbar')

    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('global.view') }} {{ trans('cruds.patients.title_singular') ." ". "#" . $patient->id }}  </h3>
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
                                                {{ trans('cruds.patients.fields.photo') }}
                                            </th>
                                            <td>
                                                <img src="{{ $patient->photo }}" style="height: 100px;width: 100px">
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.patients.fields.id') }}
                                            </th>
                                            <td>
                                                {{ $patient->id }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.patients.fields.first_name') }}
                                            </th>
                                            <td>
                                                {{ $patient->first_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.patients.fields.last_name') }}
                                            </th>
                                            <td>
                                                {{ $patient->last_name }}
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>
                                                {{ trans('cruds.patients.fields.phone') }}
                                            </th>
                                            <td>
                                                {{ $patient->phone }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.patients.fields.country') }}
                                            </th>
                                            <td>
                                                {{ $patient->country->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.patients.fields.city') }}
                                            </th>
                                            <td>
                                                {{ $patient->city ? $patient->city->title : "لم يتم الإختيار"}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.patients.fields.email') }}
                                            </th>
                                            <td>
                                                {{ $patient->email }}
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
