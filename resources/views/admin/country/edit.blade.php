@extends('layouts.main')
@section('title',trans('global.edit') .' '. trans('cruds.country.title_singular'))
@section('content')
    @include('includes.toolbar')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit') }} {{ trans('cruds.country.title_singular') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formSaveReportType"
                      novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-13 text-center">
                        </div>
                        <input type="hidden" name="id" value="{{$country->id}}">

                        @include('includes.form.photo',['name'=>'flag','value'=>$country->flag])
                        <div class="row g-9 mb-8">

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=> trans('cruds.country.fields.title_ar'),'placeholder'=> trans('cruds.country.fields.title_ar'),'id'=>'title_ar','name'=>'title_ar','span'=>'title_ar','value'=>$country->translate('ar')->title ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=> trans('cruds.country.fields.title_en'),'placeholder'=> trans('cruds.country.fields.title_en'),'id'=>'title_en','name'=>'title_en','span'=>'title_en','value'=>$country->translate('en')->title ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=> trans('cruds.country.fields.iso3'),'placeholder'=> trans('cruds.country.fields.iso3'),'id'=>'iso3','name'=>'iso3','span'=>'iso3','value'=>$country->iso3 ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=> trans('cruds.country.fields.iso2'),'placeholder'=> trans('cruds.country.fields.iso2'),'id'=>'iso2','name'=>'iso2','span'=>'iso2','value'=>$country->iso2 ])
                                </div>
                            </div>
                           <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=> trans('cruds.country.fields.phone_code'),'placeholder'=> trans('cruds.country.fields.phone_code'),'id'=>'phone_code','name'=>'phone_code','span'=>'phone_code','value'=>$country->phone_code ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=> trans('cruds.country.fields.timezone'),'placeholder'=> trans('cruds.country.fields.timezone'),'id'=>'timezone','name'=>'timezone','span'=>'timezone','value'=>$country->timezone ])
                                </div>
                            </div>


                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.country.fields.status') }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.country.fields.status')}}"
                                        name="status" id="status">
                                    <option value=""
                                            disabled>{{trans('cruds.select')}} {{trans('cruds.country.fields.status')}}</option>
                                    <option value="1" @if($country->status == 1) selected @endif>{{trans('global.active')}}</option>
                                    <option value="0" @if($country->status == 0) selected @endif>{{trans('global.un_active')}}</option>

                                </select>
                                <span class="text-danger errors"
                                      id="status_error"> </span>
                            </div>

                            <div class="separator separator-dashed my-10"></div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        <a class="btn btn-light-primary" onclick="history.back();">
                                            {{ trans('global.back') }}
                                        </a>
                                        <button class="btn btn-primary mr-2" type="button"
                                                id="btn_update_report_type"> {{ trans('global.edit') }}</button>

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
        $(document).on('click', '#btn_update_report_type', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formSaveReportType')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route("admin.countries.update",$country->id)}}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_update_report_type').html();

                    if (data.status == true) {
                        Swal.fire({
                            title: data.msg,
                            text: data.msg,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "{{trans('global.confirmation')}}",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_update_report_type').html('save');

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
