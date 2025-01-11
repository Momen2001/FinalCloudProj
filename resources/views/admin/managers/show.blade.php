@extends('layouts.main')
@section('content')
    @include('includes.toolbar')

    <div>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('global.view',[],session('locale')) }} {{ trans('cruds.user.title_singular',[],session('locale')) ." ".  $user->name }}  </h3>
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
                                                {{ trans('cruds.user.fields.id',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $user->id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.name',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.email',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.email_verified_at',[],session('locale')) }}
                                            </th>
                                            <td>
                                                {{ $user->email_verified_at }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.verified',[],session('locale')) }}
                                            </th>
                                            <td>
                                                <input type="checkbox"
                                                       disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.two_factor',[],session('locale')) }}
                                            </th>
                                            <td>
                                                <input type="checkbox"
                                                       disabled="disabled" {{ $user->two_factor ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.roles',[],session('locale')) }}
                                            </th>
                                            <td class="">
                                                @foreach($user->roles as $key => $roles)
                                                    <span class="badge badge-light-danger">{{ $roles->title }}</span>
                                                @endforeach
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


                    @isset($user->information_user )

                        <div class="card-body py-3 mt-8">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
                                    <h3> {{ trans('cruds.user.fields.more_information',[],session('locale')) }}</h3>
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
                                                    {{ trans('cruds.user.fields.municipal_name',[],session('locale')) }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->lgu_name_arabic?? '' }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.mem_name_arabic',[],session('locale')) }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->mem_name_arabic?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.dis_name_arabic',[],session('locale')) }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->dis_name_arabic?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.lgu_ArabicType',[],session('locale')) }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->lgu_ArabicType?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.Category_name_arabic',[],session('locale')) }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->Category_name_arabic?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.lgu_Arabic_SelWay',[],session('locale')) }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->lgu_Arabic_SelWay?? '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    {{ trans('cruds.user.fields.lgu_TypeofAppointment',[],session('locale')) }}
                                                </th>
                                                <td>
                                                    {{json_decode( $user->information_user->data_information)->lgu_TypeofAppointment?? '' }}
                                                </td>
                                            </tr>


                                            </tbody>
                                        </table>
                                        <div class="form-group">
                                            <a class="btn btn-default badge badge-light-primary"
                                               onclick="history.back();">
                                                {{ trans('global.return_back',[],session('locale')) }}
                                            </a>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endisset


                </div>
            </div>
        </div>
    </div>

@endsection
