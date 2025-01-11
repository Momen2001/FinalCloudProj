@extends('layouts.main')
@section('title',trans('global.edit') .' '. trans('cruds.services.title_singular'))
@section('content')
    @include('includes.toolbar')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit') }} {{ trans('cruds.services.title_singular') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formUpdateService"
                      novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-13 text-center">
                        </div>
                        <input type="hidden" name="id" value="{{$service->id}}">
                        @include('includes.form.photo',['name'=>'photo','value'=>$service->photo])
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=> trans('cruds.services.fields.title_ar'),'placeholder'=> trans('cruds.services.fields.title_ar'),'id'=>'title_ar','name'=>'title_ar','span'=>'title_ar','value'=>$service->translate('ar')->title ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=> trans('cruds.services.fields.title_en'),'placeholder'=> trans('cruds.services.fields.title_en'),'id'=>'title_en','name'=>'title_en','span'=>'title_en','value'=>$service->translate('en')->title ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.textarea',['label'=> trans('cruds.services.fields.description_ar'),'placeholder'=> trans('cruds.services.fields.description_ar'),'id'=>'description_ar','name'=>'description_ar','span'=>'description_ar','value'=>$service->translate('ar')->description ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.textarea',['label'=> trans('cruds.services.fields.description_en'),'placeholder'=> trans('cruds.services.fields.description_en'),'id'=>'description_en','name'=>'description_en','span'=>'description_en','value'=>$service->translate('en')->description ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.textarea',['label'=> trans('cruds.services.fields.instructions_ar'),'placeholder'=> trans('cruds.services.fields.instructions_ar'),'id'=>'instructions_ar','name'=>'instructions_ar','span'=>'instructions_ar','value'=>$service->translate('ar')->instructions  ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.textarea',['label'=> trans('cruds.services.fields.instructions_en'),'placeholder'=> trans('cruds.services.fields.instructions_en'),'id'=>'instructions_en','name'=>'instructions_en','span'=>'instructions_en','value'=>$service->translate('en')->instructions ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.textarea',['label'=>trans('cruds.services.fields.include_ar'),'placeholder'=>trans('cruds.services.fields.include_ar'),'id'=>'include_ar','name'=>'include_ar','span'=>'include_ar','value'=>$service->translate('ar')->include  ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.textarea',['label'=>trans('cruds.services.fields.include_en'),'placeholder'=>trans('cruds.services.fields.include_en'),'id'=>'include_en','name'=>'include_en','span'=>'include_en','value'=>$service->translate('en')->include  ])
                                </div>
                            </div>


                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{trans('cruds.coupons.fields.status')  }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.coupons.fields.status')}}"
                                        name="status" id="status">
                                    <option value=""
                                            disabled>{{trans('cruds.select')}} {{trans('cruds.coupons.fields.status')}}</option>
                                    <option value="1"
                                            @if($service->status ==1) selected @endif >{{trans('cruds.active')}}</option>
                                    <option value="0"
                                            @if($service->status ==0) selected @endif >{{trans('cruds.un_active')}}</option>
                                </select>
                                <span class="text-danger errors"
                                      id="status_error"> </span>
                            </div>


                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.hospital.fields.specializations') }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.hospital.fields.specializations')}}"
                                        name="main_service_id" id="main_service_id">
                                    <option value=""
                                            disabled>{{trans('cruds.select')}}{{trans('cruds.hospital.fields.specializations')}}</option>
                                    @foreach($mainServices as $id => $mainService)
                                        <option value="{{$mainService->id}}"
                                                @if($mainService->id == $service->main_service_id) selected @endIf>
                                            {{$mainService->title}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger errors"
                                      id="specializations_error"> </span>
                            </div>


                            <div class="separator separator-dashed my-10"></div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        <a class="btn btn-light-primary" onclick="history.back();">
                                            {{ trans('global.back') }}
                                        </a>
                                        <button class="btn btn-primary mr-2" type="button"
                                                id="btn_update_service"> {{ trans('global.edit') }}</button>

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
        $(document).on('click', '#btn_update_service', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdateService')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route("admin.service.update",$service->id)}}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_update_service').html();

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
                    $('#btn_update_service').html('save');

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
