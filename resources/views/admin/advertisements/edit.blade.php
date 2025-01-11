@extends('layouts.main')
@section('title',trans('global.edit',[],session('locale')) .' '. trans('cruds.advertisements.title_singular',[],session('locale')))
@section('content')
    @include('includes.toolbar')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit',[],session('locale')) }} {{ trans('cruds.advertisements.title_singular',[],session('locale')) }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formUpdateAdvertisement"
                      novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-13 text-center">
                        </div>
                        <input type="hidden" name="id" value="{{$advertisement->id}}">

                        @include('includes.form.photo',['name'=>'photo','value'=>$advertisement->photo])
                        <div class="row g-9 mb-8">


                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.advertisements.fields.title_ar',[],session('locale')),'placeholder'=>trans('cruds.advertisements.fields.title_ar',[],session('locale')),'id'=>'title_ar','name'=>'title_ar','span'=>'title_ar','value'=>$advertisement->translate('ar')->title ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.advertisements.fields.title_en',[],session('locale')),'placeholder'=>trans('cruds.advertisements.fields.title_en',[],session('locale')),'id'=>'title_en','name'=>'title_en','span'=>'title_en','value'=>$advertisement->translate('en')->title ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.advertisements.fields.description_ar',[],session('locale')),'placeholder'=>trans('cruds.advertisements.fields.description_ar',[],session('locale')),'id'=>'description_ar','name'=>'description_ar','span'=>'description_ar','value'=>$advertisement->translate('ar')->description ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.advertisements.fields.description_en',[],session('locale')),'placeholder'=>trans('cruds.advertisements.fields.description_en',[],session('locale')),'id'=>'description_en','name'=>'description_en','span'=>'description_en','value'=>$advertisement->translate('en')->description  ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.advertisements.fields.btn_text_ar',[],session('locale')),'placeholder'=>trans('cruds.advertisements.fields.btn_text_ar',[],session('locale')),'id'=>'btn_text_ar','name'=>'btn_text_ar','span'=>'btn_text_ar','value'=> $advertisement->translate('ar')->btn_text  ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.advertisements.fields.btn_text_en',[],session('locale')),'placeholder'=>trans('cruds.advertisements.fields.btn_text_en',[],session('locale')),'id'=>'btn_text_en','name'=>'btn_text_en','span'=>'btn_text_en','value'=> $advertisement->translate('en')->btn_text ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.advertisements.fields.link',[],session('locale')),'placeholder'=>trans('cruds.advertisements.fields.link',[],session('locale')),'id'=>'link','name'=>'link','span'=>'link','value'=> $advertisement->link  ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.advertisements.fields.btn_show',[],session('locale')) }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.advertisements.fields.btn_show',[],session('locale'))}}"
                                        name="btn_show" id="btn_show">
                                    <option value=""
                                            disabled>{{trans('cruds.select',[],session('locale'))}} {{trans('cruds.advertisements.fields.btn_show',[],session('locale'))}}</option>
                                    <option value="0"
                                            @if($advertisement->btn_show == 0 ) selected @endIf>{{trans('cruds.hidden',[],session('locale'))}}</option>
                                    <option value="1"
                                            @if($advertisement->btn_show == 1 ) selected @endIf>{{trans('cruds.show',[],session('locale'))}}</option>
                                </select>
                                <span class="text-danger errors"
                                      id="btn_show_error"> </span>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.advertisements.fields.status',[],session('locale')) }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.advertisements.fields.status',[],session('locale'))}}"
                                        name="status" id="status">
                                    <option value=""
                                            disabled>{{trans('cruds.select',[],session('locale'))}} {{trans('cruds.advertisements.fields.status',[],session('locale'))}}</option>
                                    <option value="0"
                                            @if($advertisement->status == 0 ) selected @endIf>{{trans('cruds.hidden',[],session('locale'))}}</option>
                                    <option value="1"
                                            @if($advertisement->status == 1 ) selected @endIf>{{trans('cruds.show',[],session('locale'))}}</option>
                                </select>
                                <span class="text-danger errors"
                                      id="status_error"> </span>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.advertisements.fields.color_degree',[],session('locale')) }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.advertisements.fields.color_degree',[],session('locale'))}}"
                                        name="color_degree" id="color_degree">
                                    <option value=""
                                            disabled>{{trans('cruds.select',[],session('locale'))}} {{trans('cruds.advertisements.fields.color_degree',[],session('locale'))}}</option>
                                    <option value="#ced514"
                                            @if($advertisement->color_degree == "#ced514" ) selected @endIf> #ced514
                                    </option>
                                    <option value="#11bec2"
                                            @if($advertisement->color_degree == "#11bec2" ) selected @endIf>  #11bec2
                                    </option>
                                    <option value="#0ed22c"
                                            @if($advertisement->color_degree == "#0ed22c" ) selected @endIf> #0ed22c
                                    </option>
                                </select>
                                <span class="text-danger errors"
                                      id="color_degree_error"> </span>
                            </div>


                            <div class="separator separator-dashed my-10"></div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        <a class="btn btn-light-primary" onclick="history.back();">
                                            {{ trans('global.back',[],session('locale')) }}
                                        </a>
                                        <button class="btn btn-primary mr-2" type="button"
                                                id="btn_update_advertisement"> {{ trans('global.edit',[],session('locale')) }}</button>

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
        $(document).on('click', '#btn_update_advertisement', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdateAdvertisement')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route("admin.advertisement.update",$advertisement->id)}}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_update_advertisement').html();

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
                    $('#btn_update_advertisement').html('save');

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
