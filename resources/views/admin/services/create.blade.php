@extends('layouts.main')
@section('title',trans('global.create') .' '. trans('cruds.services.title_singular'))
@section('content')
    @include('includes.toolbar')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.create') }} {{ trans('cruds.services.title_singular') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->

                <form id="formSaveService" class="form" action="#" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-13 text-center">
                        </div>
                        <div class="row g-9 mb-8">

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=> trans('cruds.services.fields.title_ar'),'placeholder'=> trans('cruds.services.fields.title_ar'),'id'=>'title_ar','name'=>'title_ar','span'=>'title_ar','value'=>null ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=> trans('cruds.services.fields.title_en'),'placeholder'=> trans('cruds.services.fields.title_en'),'id'=>'title_en','name'=>'title_en','span'=>'title_en','value'=>null ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.textarea',['label'=> trans('cruds.services.fields.description_ar'),'placeholder'=> trans('cruds.services.fields.description_ar'),'id'=>'description_ar','name'=>'description_ar','span'=>'description_ar','value'=>null ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.textarea',['label'=> trans('cruds.services.fields.description_en'),'placeholder'=> trans('cruds.services.fields.description_en'),'id'=>'description_en','name'=>'description_en','span'=>'description_en','value'=>null ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.textarea',['label'=> trans('cruds.services.fields.instructions_ar'),'placeholder'=> trans('cruds.services.fields.instructions_ar'),'id'=>'instructions_ar','name'=>'instructions_ar','span'=>'instructions_ar','value'=>null ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.textarea',['label'=> trans('cruds.services.fields.instructions_en'),'placeholder'=> trans('cruds.services.fields.instructions_en'),'id'=>'instructions_en','name'=>'instructions_en','span'=>'instructions_en','value'=>null ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.textarea',['label'=>trans('cruds.services.fields.include_ar'),'placeholder'=>trans('cruds.services.fields.include_ar'),'id'=>'include_ar','name'=>'include_ar','span'=>'include_ar','value'=>null ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.textarea',['label'=>trans('cruds.services.fields.include_en'),'placeholder'=>trans('cruds.services.fields.include_en'),'id'=>'include_en','name'=>'include_en','span'=>'include_en','value'=>null ])
                                </div>
                            </div>


                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{trans('cruds.services.fields.status')  }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.services.fields.status')}}"
                                        name="status" id="status">
                                    <option value=""
                                            disabled>{{trans('cruds.select')}} {{trans('cruds.services.fields.status')}}</option>
                                    <option value="1">{{trans('cruds.active')}}</option>
                                    <option value="0">{{trans('cruds.un_active')}}</option>
                                </select>
                                <span class="text-danger errors"
                                      id="status_error"> </span>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'file','label'=>trans('cruds.services.fields.photo'),'placeholder'=>trans('cruds.services.fields.photo'),'id'=>'photo','name'=>'photo','span'=>'photo','value'=>null ])
                                </div>
                            </div>

                            @if($customServiceId !=null)
                                <div class="col-md-6 fv-row">
                                    <input type="hidden" value="{{$customServiceId}}"
                                           name="main_service_id" id="main_service_id">
                                    <span class="text-danger errors"
                                          id="main_service_id_error"> </span>
                                </div>
                            @else
                                <div class="col-md-6 fv-row">
                                    <label
                                        class="required fs-6 fw-semibold mb-2">{{ trans('cruds.services.fields.main_service') }}</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                            data-hide-search="true"
                                            data-placeholder="{{trans('cruds.services.fields.main_service')}}"
                                            name="main_service_id" id="main_service_id">
                                        <option value=""
                                                disabled>{{trans('cruds.select')}} {{trans('cruds.services.fields.main_service')}}</option>
                                        @foreach($mainServices as $id => $mainService)
                                            <option value="{{$mainService->id}}">
                                                {{$mainService->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger errors"
                                          id="main_service_id_error"> </span>
                                </div>
                            @endif


                            <div class="separator separator-dashed my-10"></div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        <a class="btn btn-light-primary" onclick="history.back();">
                                            {{ trans('global.back') }}
                                        </a>
                                        <button class="btn btn-primary mr-2" type="button"
                                                id="btn_save_service"> {{ trans('global.create') }}</button>

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

        $(document).on('click', '#btn_save_service', function (e) {
            $('#btn_save_service').html('{{trans('global.save')}} <i class="fa fa-spinner fa-spin"></i>');
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#formSaveService')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.service.store") }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save_service').html('save');
                    if (data.status == true) {

                        document.getElementById("formSaveService").reset();
                        @if($customServiceId == mainServiceById()['SupportiveService'])
                        setTimeout(function () {
                            var url = "{{ route('admin.medicalSessions.index') }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                        }, 0);
                        @else
                        setTimeout(function () {
                            var url = "{{ route('admin.service.index') }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                        }, 0);
                        @endif


                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_save_service').html("save");

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
