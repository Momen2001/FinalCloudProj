@extends('layouts.main')
@section('title',trans('global.show',[],session('locale')) .' '. trans('cruds.medicalType.title_singular',[],session('locale')))
@section('content')
    @include('includes.toolbar')

    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('global.view',[],session('locale')) }} {{ trans('cruds.medicalType.title_singular',[],session('locale')) ." ".  $medicalType->name }}  </h3>
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
                                                {{ trans('cruds.medicalType.fields.photo',[],session('locale')) }}
                                            </th>
                                            <td>
                                               <img src="{{$medicalType->photo}}" style="max-height: 100px;max-width: 100px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.medicalType.fields.title_ar',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{$medicalType->translate('ar')->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.medicalType.fields.title_en',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{$medicalType->translate('en')->title  }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.medicalType.fields.status',[],session('locale')) }}
                                            </th>
                                            <td class="">
                                                <span
                                                    class="badge badge-light-danger">@if($medicalType->status ==1) {{trans('cruds.active',[],session('locale'))}} @else {{trans('cruds.un_active',[],session('locale'))}} @endif</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.medicalType.fields.status',[],session('locale')) }}
                                            </th>
                                            <td class="">
                                                <span
                                                    class="badge badge-light-danger">{{$medicalType->GetParent()}}</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <a class="btn btn-default badge badge-light-primary" onclick="history.back();">
                                            {{ trans('global.return_back',[],session('locale')) }}
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
