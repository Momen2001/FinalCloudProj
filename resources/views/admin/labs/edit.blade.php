@extends('layouts.main')
@section('title',trans('global.edit',[],session('locale')) .' '. trans('cruds.lab.title_singular',[],session('locale')))
@section('content')
    @include('includes.toolbar')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit',[],session('locale')) }} {{ trans('cruds.lab.title_singular',[],session('locale')) }}</h3>
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
                        <input type="hidden" name="id" value="{{$lab->id}}">
                        @include('includes.form.photo',['name'=>'photo','value'=>$lab->photo])

                        <div id="map" style="height: 250px; width: 100%;margin-bottom: 5%"></div>
                        <input type="hidden" id="latitude" name="latitude"
                               value="{{$lab->hospitalLocation->latitude}}">
                        <input type="hidden" id="longitude" name="longitude"
                               value="{{$lab->hospitalLocation->longitude}}">

                        <span id="latitude_error" class="text-danger errors"></span>
                        <span id="longitude_error" class="text-danger errors"></span>
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.lab.fields.first_name',[],session('locale')),'placeholder'=>trans('cruds.lab.fields.name',[],session('locale')),'id'=>'first_name','name'=>'first_name','span'=>'first_name','value'=>$lab->first_name ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.lab.fields.last_name',[],session('locale')),'placeholder'=>trans('cruds.lab.fields.last_name',[],session('locale')),'id'=>'last_name','name'=>'last_name','span'=>'last_name','value'=>$lab->last_name ])
                                </div>
                            </div>


                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.lab.fields.provider_name_ar',[],session('locale')),'placeholder'=>trans('cruds.lab.fields.provider_name_ar',[],session('locale')),'id'=>'provider_name_ar','name'=>'provider_name_ar','span'=>'provider_name_ar','value'=>$lab->provider_name_ar ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.lab.fields.provider_name_en',[],session('locale')),'placeholder'=>trans('cruds.lab.fields.provider_name_en',[],session('locale')),'id'=>'provider_name_en','name'=>'provider_name_en','span'=>'provider_name_en','value'=>$lab->provider_name_en ])
                                </div>
                            </div>



                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'email','label'=>trans('cruds.lab.fields.email',[],session('locale')),'placeholder'=>trans('cruds.lab.fields.email',[],session('locale')),'id'=>'email','name'=>'email','span'=>'email','value'=>$lab->email ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'password','label'=>trans('cruds.lab.fields.password',[],session('locale')),'placeholder'=>trans('cruds.lab.fields.password',[],session('locale')),'id'=>'password','name'=>'password','span'=>'password','value'=>null ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.lab.fields.phone',[],session('locale')),'placeholder'=>trans('cruds.lab.fields.phone',[],session('locale')),'id'=>'phone','name'=>'phone','span'=>'phone','value'=>$lab->phone  ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.hospital.fields.latitude'),'placeholder'=>trans('cruds.hospital.fields.latitude'),'id'=>'latitude','name'=>'latitude','span'=>'latitude','value'=>$lab ->hospitalLocation ?->latitude  ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.hospital.fields.longitude'),'placeholder'=>trans('cruds.hospital.fields.longitude'),'id'=>'longitude','name'=>'longitude','span'=>'longitude','value'=>$lab->hospitalLocation?->longitude  ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.hospital.fields.location_ar'),'placeholder'=>trans('cruds.hospital.fields.location_ar'),'id'=>'location_ar','name'=>'location_ar','span'=>'location_ar','value'=>$lab->hospitalLocation?->translate('ar')->location  ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.hospital.fields.location_en'),'placeholder'=>trans('cruds.hospital.fields.location_en'),'id'=>'location_en','name'=>'location_en','span'=>'location_en','value'=>$lab->hospitalLocation?->translate('en')->location   ])
                                </div>
                            </div>

                            {{--                            <div class="col-md-6 fv-row">--}}
                            {{--                                <div class="d-flex flex-column mb-8 fv-row">--}}
                            {{--                                    @include('includes.form.input',['type'=>'file','label'=>trans('cruds.lab.fields.photo'),'placeholder'=>trans('cruds.lab.fields.photo'),'id'=>'photo','name'=>'photo','span'=>'photo','value'=>null  ])--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}


                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.lab.fields.country',[],session('locale')) }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.lab.fields.country',[],session('locale'))}}"
                                        name="country_id" id="country_id">
                                    <option value="">{{trans('cruds.lab.fields.country',[],session('locale'))}}</option>
                                    @foreach($countries as $id => $country)
                                        <option @if($lab->country_id  == $country->id) selected
                                                @endif value={{$country->id}}>{{$country->title}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger errors"
                                      id="country_id_error"> </span>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.lab.fields.city',[],session('locale')) }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.lab.fields.city',[],session('locale'))}}"
                                        name="city_id" id="city_id">
                                    <option value="">{{trans('cruds.lab.fields.city',[],session('locale'))}}</option>
                                    @foreach($cities as $id => $city)
                                        <option @if($lab->city_id  == $city->id) selected
                                                @endif value={{$city->id}}>{{$city->title}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger errors"
                                      id="city_id_error"> </span>
                            </div>
                            <div class="card-header">
                                <h3 class="card-title">{{ trans('global.edit') }} {{ trans('cruds.main_service.title') }}</h3>
                                <div class="card-toolbar">
                                    <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-stack mb-10">
                                <div class="col-md-12 fv-row  ">

                                    <div class="card-body p-0">
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table
                                                class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9"
                                                id="kt_api_keys_table">
                                                <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                                                <tr>
                                                    <th class="w-150px min-w-150px ps-4">{{ trans('cruds.hospital.fields.name') }}</th>
                                                    <th class="w-120px min-w-120px ">{{ trans('cruds.main_service.fields.photo') }}</th>
                                                    <th class="w-120px min-w-120px">{{ trans('cruds.main_service.fields.commission') }}</th>
                                                    <th class="w-180px min-w-180px">{{ trans('cruds.main_service.fields.B2B') }}</th>
                                                    <th class="w-220px min-w-220px"> {{ trans('cruds.main_service.fields.payment_methods') }} </th>
                                                </tr>
                                                </thead>
                                                <tbody class="fs-6 fw-bold text-gray-600">
                                                <tr data-main-service-id="{{ $main_service->id }}">

                                                    <input name="main_service_id"
                                                           type="hidden" value="{{$main_service->id}}">

                                                    <span id="main_service_id_error"
                                                          class="text-danger errors"></span>
                                                    <td>{{ $main_service->title ?? '' }}</td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-50px me-3">
                                                                <img src="{{ $main_service->photo }}"/>
                                                            </div>
                                                        </div>
                                                    </td>


                                                    <td class="ps- p-4">
                                                        <input type="number"
                                                               class="form-control form-control-solid"
                                                               style="width: 150px"
                                                               @if(checkHospitalHaveMainService($lab->id, $main_service->id))
                                                                   value="{{checkHospitalHaveMainService($lab->id, $main_service->id)->commission}}"
                                                               @endif
                                                               placeholder="نسبة الربح"
                                                               name="commission"
                                                               id="commission" min="0"/>
                                                        <span id="commission_error"
                                                              class="text-danger errors"></span>
                                                    </td>

                                                    <td class="ps-9">
                                                        <div class="w-150px position-relative">
                                                            <select class="form-select form-select-solid"
                                                                    data-control="select2"
                                                                    data-hide-search="true"
                                                                    data-placeholder="{{ trans('cruds.main_service.fields.B2B') }}"
                                                                    name="support_B2B">

                                                                <option
                                                                    value="1"
                                                                    @if(checkHospitalMainServiceSupportB2B($lab->id, $main_service->id) == 1) selected @endif> {{trans('global.available')}} </option>
                                                                <option
                                                                    value="0"
                                                                    @if(checkHospitalMainServiceSupportB2B($lab->id, $main_service->id)== 0) selected @endif> {{trans('global.not_available')}}</option>

                                                            </select>
                                                            <span id="support_B2B_error"
                                                                  class="text-danger errors"></span>

                                                        </div>
                                                    </td>

                                                    <td class="pe-9">
                                                        <div class="w-220px position-relative">
                                                            <select class="form-select form-select-solid"
                                                                    data-control="select2" multiple
                                                                    data-hide-search="true"
                                                                    data-placeholder="{{ trans('cruds.main_service.fields.payment_methods') }}"
                                                                     name="payment_methods[]">
                                                                <option value=""
                                                                        disabled>{{trans('cruds.select')}} {{ trans('cruds.main_service.fields.payment_methods') }}</option>

                                                                @foreach($payment_methods as $id => $payment_method)
                                                                    <option
                                                                        value="{{$payment_method->id}}"
                                                                        @if(in_array($payment_method->id,getPaymentMainServiceForHospital($lab->id,$main_service->id)->pluck('payment_method_id')->toArray())) selected @endif>{{$payment_method->title}}</option>
                                                                @endforeach
                                                            </select>

                                                            <span id="payment_methods_{{ $main_service->id }}_error"
                                                                  class="text-danger errors"></span>

                                                        </div>
                                                    </td>

                                                </tr>
                                                </tbody>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    </div>

                                </div>
                            </div>

                            <div class="separator separator-dashed my-10"></div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        <a class="btn btn-light-primary" onclick="history.back();">
                                            {{ trans('global.back',[],session('locale')) }}
                                        </a>
                                        <button class="btn btn-primary mr-2" type="button"
                                                id="btn_update_user"> {{ trans('global.edit',[],session('locale')) }}</button>
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
                url: "{{route("admin.lab.update",$lab->id)}}",
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
                        Swal.fire("{{trans('global.sorry_some_error',[],session('locale'))}}", "{{trans('global.sorry_some_error',[],session('locale'))}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_update_user').html('save');

                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        // for loop to all validation and show all validate
                        $("#" + key + "_error").text(val[0]);
                        Swal.fire(val[0],);
                    });
                }
            });
        });
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJTtcmuJwWrUmkLoNms7o5gIbC78ph2Fo&callback=initMap">
    </script>
    <script>
        let map;
        let marker;

        function initMap() {
            // Get initial latitude and longitude from the input fields
            const initialLat = parseFloat(document.getElementById("latitude").value) || 23.8859;
            const initialLng = parseFloat(document.getElementById("longitude").value) || 45.0792;

            const initialLocation = {lat: initialLat, lng: initialLng};

            // Initialize the map
            map = new google.maps.Map(document.getElementById("map"), {
                center: initialLocation,
                zoom: 8,
            });

            // Place the initial marker on the map
            marker = new google.maps.Marker({
                position: initialLocation,
                map: map,
                draggable: true, // Allow dragging the marker
            });

            // Update the latitude and longitude inputs when the marker is dragged
            marker.addListener("dragend", () => {
                const position = marker.getPosition();
                document.getElementById("latitude").value = position.lat();
                document.getElementById("longitude").value = position.lng();
            });

            // Add a click listener to update marker position
            map.addListener("click", (e) => {
                const lat = e.latLng.lat();
                const lng = e.latLng.lng();

                // Update the marker position
                marker.setPosition(e.latLng);

                // Update the latitude and longitude inputs
                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;

                // Clear error messages if any
                document.getElementById("latitude_error").innerText = '';
                document.getElementById("longitude_error").innerText = '';
            });
        }
    </script>
@endsection
