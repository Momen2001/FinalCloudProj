@extends('layouts.main')
@section('title',trans('global.edit',[],session('locale')) .' '. trans('cruds.medicalType.title_singular',[],session('locale')))
@section('content')
    @include('includes.toolbar')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit',[],session('locale')) }} {{ trans('cruds.medicalType.title_singular',[],session('locale')) }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formUpdateServiceMedicalType"
                      novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-13 text-center">
                        </div>
                        <input type="hidden" name="id" value="{{$medicalType->id}}">

                        @include('includes.form.photo',['name'=>'photo','value'=>$medicalType->photo])
                        <div class="row g-9 mb-8">

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=> trans('cruds.medicalType.fields.title_ar',[],session('locale')),'placeholder'=> trans('cruds.medicalType.fields.title_ar',[],session('locale')),'id'=>'title_ar','name'=>'title_ar','span'=>'title_ar','value'=>$medicalType->translate('ar')->title ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=> trans('cruds.medicalType.fields.title_en',[],session('locale')),'placeholder'=> trans('cruds.medicalType.fields.title_en',[],session('locale')),'id'=>'title_en','name'=>'title_en','span'=>'title_en','value'=>$medicalType->translate('en')->title ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{trans('cruds.medicalType.fields.status',[],session('locale'))  }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.medicalType.fields.status',[],session('locale'))}}"
                                        name="status" id="status">
                                    <option value=""
                                            disabled>{{trans('cruds.select',[],session('locale'))}} {{trans('cruds.medicalType.fields.status',[],session('locale'))}}</option>
                                    <option value="1"
                                            @if($medicalType->status ==1) selected @endif >{{trans('cruds.active',[],session('locale'))}}</option>
                                    <option value="0"
                                            @if($medicalType->status ==0) selected @endif >{{trans('cruds.un_active',[],session('locale'))}}</option>
                                </select>
                                <span class="text-danger errors"
                                      id="status_error"> </span>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.medicalType.fields.parent',[],session('locale')) }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.medicalType.fields.parent',[],session('locale'))}}"
                                        name="parent" id="parent">

                                    <option
                                        value="0" @if($medicalType->parent ==0) selected @endif>{{trans('cruds.medicalType.parent_not_follow',[],session('locale'))}}</option>
                                    @foreach ($allMedicalType as $key =>  $item)
                                        <option
                                            value="{{$item->id}}" @if($item->id == $medicalType->parent) selected @endif>{{$item->title}}</option>
                                    @endforeach

                                </select>
                                <span class="text-danger errors"
                                      id="parent_error"> </span>
                            </div>


                            <div class="separator separator-dashed my-10"></div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        <a class="btn btn-light-primary" onclick="history.back();">
                                            {{ trans('global.back',[],session('locale')) }}
                                        </a>
                                        <button class="btn btn-primary mr-2" type="button"
                                                id="btn_update_medicalType"> {{ trans('global.edit',[],session('locale')) }}</button>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden">
                            <div></div>
                        </div>
                    </div>
                </form>


            </div>
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
        $(document).on('click', '#btn_update_medicalType', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdateServiceMedicalType')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route("admin.medicalType.update",$medicalType->id)}}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_update_medicalType').html();

                    if (data.status == true) {
                        Swal.fire({
                            title: data.msg,
                            text: data.msg,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "{{trans('global.confirmation',[],session('locale'))}}",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error',[],session('locale'))}}", "{{trans('global.sorry_some_error',[],session('locale'))}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_update_medicalType').html('save');

                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        // for loop to all validation and show all validate
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });
    </script>
@endsection
