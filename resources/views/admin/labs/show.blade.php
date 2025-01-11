@extends('layouts.main')
@section('title',trans('global.show',[],session('locale')) .' '. trans('cruds.lab.title',[],session('locale')))

@section('content')
    @include('includes.toolbar')

    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('global.view',[],session('locale')) }} {{ trans('cruds.lab.title_singular',[],session('locale')) ." ". "#" . $lab->id }}  </h3>
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
                                                {{ trans('cruds.lab.fields.photo',[],session('locale')) }}
                                            </th>
                                            <td>
                                                <img src="{{ $lab->photo }}" style="height: 100px;width: 100px">
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.lab.fields.id',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $lab->id }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.lab.fields.first_name',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $lab->first_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.lab.fields.last_name',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $lab->last_name }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.lab.fields.provider_name_ar',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $lab->provider_name_ar }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.lab.fields.provider_name_en',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $lab->provider_name_en }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.lab.fields.phone',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $lab->phone }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.lab.fields.country',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $lab->country->title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.lab.fields.city',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $lab->city->title }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ trans('cruds.lab.fields.email',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $lab->email }}
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
