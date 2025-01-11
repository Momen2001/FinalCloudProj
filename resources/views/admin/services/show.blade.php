@extends('layouts.main')
@section('title',trans('global.show') .' '. trans('cruds.services.title_singular'))
@section('content')
    @include('includes.toolbar')

    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('global.view') }} {{ trans('cruds.services.title_singular') ." ".  $service->name }}  </h3>
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
                                                {{ trans('cruds.services.fields.photo') }}
                                            </th>
                                            <td>
                                               <img src="{{$service->photo}}" style="max-height: 100px;max-width: 100px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.services.fields.title_ar') }}
                                            </th>
                                            <td>
                                                {{$service->translate('ar')->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.services.fields.title_en') }}
                                            </th>
                                            <td>
                                                {{$service->translate('en')->title  }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.services.fields.description_ar') }}
                                            </th>
                                            <td>
                                                {{ $service->translate('ar')->description }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.services.fields.description_en') }}
                                            </th>
                                            <td>
                                                {{ $service->translate('en')->description }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.services.fields.instructions_ar') }}
                                            </th>
                                            <td>
                                                {{ $service->translate('ar')->instructions  }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.services.fields.instructions_en') }}
                                            </th>
                                            <td>
                                                {{$service->translate('en')->instructions  }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.services.fields.instructions_ar') }}
                                            </th>
                                            <td>
                                                {{$service->translate('ar')->include }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.services.fields.instructions_en') }}
                                            </th>
                                            <td>
                                                {{$service->translate('en')->include }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.services.fields.status') }}
                                            </th>
                                            <td class="">
                                                <span
                                                    class="badge badge-light-danger">@if($service->status ==1) {{trans('cruds.active')}} @else {{trans('cruds.un_active')}} @endif</span>
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
