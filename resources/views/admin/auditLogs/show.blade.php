@extends('layouts.main')
@section('title',trans('global.create',[],session('locale')) .''. trans('cruds.user.title_singular',[],session('locale')))
@section('content')
    @include('includes.toolbar')
    <div class="card">
    <div class="card-header">
        {{ trans('global.show',[],session('locale')) }} {{ trans('cruds.auditLog.title',[],session('locale')) }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.audit-logs.index') }}">
                    {{ trans('global.back_to_list',[],session('locale')) }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.auditLog.fields.id',[],session('locale')) }}
                        </th>
                        <td>
                            {{ $auditLog->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditLog.fields.description',[],session('locale')) }}
                        </th>
                        <td>
                            {{ $auditLog->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditLog.fields.subject_id',[],session('locale')) }}
                        </th>
                        <td>
                            {{ $auditLog->subject_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditLog.fields.subject_type',[],session('locale')) }}
                        </th>
                        <td>
                            {{ $auditLog->subject_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditLog.fields.user_id',[],session('locale')) }}
                        </th>
                        <td>
                            {{ $auditLog->user_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditLog.fields.properties',[],session('locale')) }}
                        </th>
                        <td>
                            {{ $auditLog->properties }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditLog.fields.host',[],session('locale')) }}
                        </th>
                        <td>
                            {{ $auditLog->host }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.auditLog.fields.created_at',[],session('locale')) }}
                        </th>
                        <td>
                            {{ $auditLog->created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.audit-logs.index') }}">
                    {{ trans('global.back_to_list',[],session('locale')) }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
