@extends('layouts.main')
@section('title',trans('global.edit') .' '. trans('cruds.patients.title_singular'))
@section('content')
    @include('includes.toolbar')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit') }} {{ trans('cruds.patients.title_singular') }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formUpdateUser" novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-13 text-center">
                        </div>
                        <input type="hidden" name="id" value="{{$patient->id}}">
                        @include('includes.form.photo',['name'=>'photo','value'=>$patient->photo])
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.patients.fields.first_name'),'placeholder'=>trans('cruds.patients.fields.name'),'id'=>'first_name','name'=>'first_name','span'=>'first_name','value'=>$patient->first_name ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.patients.fields.last_name'),'placeholder'=>trans('cruds.patients.fields.last_name'),'id'=>'last_name','name'=>'last_name','span'=>'last_name','value'=>$patient->last_name ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'email','label'=>trans('cruds.patients.fields.email'),'placeholder'=>trans('cruds.patients.fields.email'),'id'=>'email','name'=>'email','span'=>'email','value'=>$patient->email ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'password','label'=>trans('cruds.patients.fields.password'),'placeholder'=>trans('cruds.patients.fields.password'),'id'=>'password','name'=>'password','span'=>'password','value'=>null ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.patients.fields.passport_id'),'placeholder'=>trans('cruds.patients.fields.passport_id'),'id'=>'passport_id','name'=>'passport_id','span'=>'passport_id','value'=>$patient->passport_id ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.patients.fields.phone'),'placeholder'=>trans('cruds.patients.fields.phone'),'id'=>'phone','name'=>'phone','span'=>'phone','value'=>$patient->phone  ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.patients.fields.gender') }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.patients.fields.gender')}}"
                                        name="gender" id="gender">
                                    <option value="">{{trans('cruds.patients.fields.gender')}}</option>

                                    <option @if($patient->gender  == "male" ) selected
                                            @endif value="male">{{trans('global.male')}}
                                    </option>

                                    <option @if($patient->gender  == "female" ) selected
                                            @endif value="female">{{trans('global.female')}}
                                    </option>
                                </select>

                                <span class="text-danger errors"
                                      id="gender_error"> </span>
                            </div>

                             <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.patients.fields.insurance_company') }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.patients.fields.insurance_company')}}"
                                        name="insurance_comp_id" id="insurance_comp_id">
                                    <option value="">{{trans('cruds.patients.fields.insurance_company')}}</option>
                                    @foreach($insurance_companies as  $insurance_company)
                                        <option @if($patient->insurance_comp_id  == $insurance_company->id) selected
                                                @endif value={{$insurance_company->id}}>{{$insurance_company->title}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger errors"
                                      id="insurance_comp_id_error"> </span>
                            </div>

                            {{-- Note:  patient country must be saudia --}}
                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.patients.fields.country') }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.patients.fields.country')}}"
                                        name="country_id" id="country_id">
                                    <option value="">{{trans('cruds.patients.fields.country')}}</option>
                                    @foreach($countries as $id => $country)
                                        <option @if($patient->country_id  == $country->id) selected
                                                @endif value={{$country->id}}>{{$country->title}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger errors"
                                      id="country_id_error"> </span>
                            </div>


                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.patients.fields.city') }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.patients.fields.city')}}"
                                        name="city_id" id="city_id">
                                    <option value="">{{trans('cruds.patients.fields.city')}}</option>
                                    @foreach($cities as $id => $city)
                                        <option @if($patient->city_id  == $city->id) selected
                                                    @endif value={{$city->id}}>{{$city->title}} </option>
                                    @endforeach
                                </select>
                                <span class="text-danger errors"
                                      id="city_id_error"> </span>
                            </div>

                            <div class="separator separator-dashed my-10"></div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        <a class="btn btn-light-primary" onclick="history.back();">
                                            {{ trans('global.back') }}
                                        </a>
                                        <button class="btn btn-primary mr-2" type="button"
                                                id="btn_update_user"> {{ trans('global.edit') }}</button>

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
        $(document).on('click', '#btn_update_user', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdateUser')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route("admin.patient.update",$patient->id)}}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_update_user').html();

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
                    $('#btn_update_user').html('save');

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
