<div class="card-body">

    <div class="row">

        @if(isset($doctor)?$doctor->id:null )
            <input value="{{$doctor->id}}" type="hidden" name="id">
        @endif

        <div class="row g-9 mb-8">
            <div class="col-md-12 text-center fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.photo',['name'=>'photo','value'=>isset($doctor)?$doctor->photo:null])
                </div>
            </div>

            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.doctor.fields.first_name'),'placeholder'=>trans('cruds.doctor.fields.first_name'),'id'=>'first_name','name'=>'first_name','span'=>'first_name','value'=>isset($doctor)?$doctor->first_name:null ])
                </div>
            </div>
            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.doctor.fields.last_name'),'placeholder'=>trans('cruds.doctor.fields.last_name'),'id'=>'last_name','name'=>'last_name','span'=>'last_name','value'=>isset($doctor)?$doctor->last_name:null ])
                </div>
            </div>
        </div>
        <div class="col-md-6 fv-row">
            <div class="d-flex flex-column mb-8 fv-row">
                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.doctor.fields.first_name_en'),'placeholder'=>trans('cruds.doctor.fields.first_name_en'),'id'=>'first_name_en','name'=>'first_name_en','span'=>'first_name_en','value'=>isset($doctor)?$doctor->first_name_en:null ])
            </div>
        </div>
        <div class="col-md-6 fv-row">
            <div class="d-flex flex-column mb-8 fv-row">
                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.doctor.fields.last_name_en'),'placeholder'=>trans('cruds.doctor.fields.last_name_en'),'id'=>'last_name_en','name'=>'last_name_en','span'=>'last_name_en','value'=>isset($doctor)?$doctor->last_name_en:null  ])
            </div>
        </div>


        <div class="col-md-6 fv-row">
            <div class="d-flex flex-column mb-8 fv-row">
                {{--{{}}--}}
                {{--                @include('includes.form.input',['type'=>'date','label'=>trans('cruds.doctor.fields.birth_date'),'placeholder'=>trans('cruds.doctor.fields.birth_date'),'id'=>'birth_date','name'=>'birth_date','span'=>'birth_date','value'=>\Illuminate\Support\Carbon::parse($doctor->birth_date)->format('m-d-y')])--}}
                @include('includes.form.input',['type'=>'date','label'=>trans('cruds.doctor.fields.birth_date'),'placeholder'=>trans('cruds.doctor.fields.birth_date'),'id'=>'birth_date','name'=>'birth_date','span'=>'birth_date','value'=>isset($doctor)? \Illuminate\Support\Carbon::parse($doctor->birth_date)->format('Y-m-d'):null ])

            </div>
        </div>


        <div class="col-md-6 fv-row">
            <div class="d-flex flex-column mb-8 fv-row">
                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.doctor.fields.phone'),'placeholder'=>trans('cruds.doctor.fields.phone'),'id'=>'phone','name'=>'phone','span'=>'phone','value'=>isset($doctor)?$doctor->phone:null ])
            </div>
        </div>

        <div class="col-md-6 fv-row">
            <label
                class="required fs-6 fw-semibold mb-2">{{ trans('cruds.hospital.fields.country',[],session('locale')) }}</label>
            <div class="d-flex flex-column mb-8 fv-row">

                <select class="form-select form-select-solid" data-control="select2"
                        data-hide-search="true"
                        data-placeholder="{{trans('cruds.hospital.fields.country')}}"
                        name="country_id" id="country_id">
                    <option value="">{{trans('cruds.hospital.fields.country')}}</option>
                    @foreach($countries as $id => $country)
                        <option @if(isset($doctor)?$doctor->country_id== $country->id:false )  selected
                                @endif value={{$country->id}}>{{$country->title}}</option>
                    @endforeach
                </select>
                <span class="text-danger errors"
                      id="country_id_error"> </span>
            </div>
        </div>

        <div class="col-md-6 fv-row">
            <label
                class="required fs-6 fw-semibold mb-2">{{ trans('cruds.hospital.fields.city',[],session('locale')) }}</label>
            <div class="d-flex flex-column mb-8 fv-row">

                <select class="form-select form-select-solid" data-control="select2"
                        data-hide-search="true"
                        data-placeholder="{{trans('cruds.hospital.fields.city')}}"
                        name="city_id" id="city_id">
                    <option value="">{{trans('cruds.hospital.fields.city')}}</option>
                    @if(isset($doctor))
                        @foreach($cities as $city)
                            <option value="{{$city->id}}"
                                    @if(isset($doctor)?$doctor->city_id== $city->id:false )  selected
                                @endif> {{$city->title}}</option>
                        @endforeach
                    @endif

                </select>
                <span class="text-danger errors"
                      id="city_id_error"> </span>
            </div>
        </div>


            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'email','label'=>trans('cruds.doctor.fields.email'),'placeholder'=>trans('cruds.doctor.fields.email'),'id'=>'email','name'=>'email','span'=>'email','value'=>isset($doctor)?$doctor->email:null ])
                </div>
            </div>

            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'password','label'=>trans('cruds.doctor.fields.password'),'placeholder'=>trans('cruds.doctor.fields.password'),'id'=>'password','name'=>'password','span'=>'password','value'=>null ])
                </div>
            </div>
            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.doctor.fields.passport'),'placeholder'=>trans('cruds.doctor.fields.passport'),'id'=>'passport_id','name'=>'passport_id','span'=>'passport_id','value'=>isset($doctor)?$doctor->passport_id:null])
                </div>
            </div>


            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'date','label'=>trans('cruds.doctor.fields.experience_start_work'),'placeholder'=>trans('cruds.doctor.fields.experience_start_work'),'id'=>'experience_start_work','name'=>'experience_start_work','span'=>'experience_start_work','value'=>isset($doctor)?$doctor->doctorSetting->experience_start_work:null ])
                </div>
            </div>

            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.doctor.fields.speciality'),'placeholder'=>trans('cruds.doctor.fields.speciality'),'id'=>'speciality','name'=>'speciality','span'=>'speciality','value'=>isset($doctor)?$doctor->doctorSetting->speciality:null ])
                </div>
            </div>

            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.doctor.fields.speciality_en'),'placeholder'=>trans('cruds.doctor.fields.speciality_en'),'id'=>'speciality_en','name'=>'speciality_en','span'=>'speciality_en','value'=>isset($doctor)?$doctor->doctorSetting->speciality_en:null ])
                </div>
            </div>
            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.doctor.fields.bio'),'placeholder'=>trans('cruds.doctor.fields.bio'),'id'=>'bio','name'=>'bio','span'=>'bio','value'=>isset($doctor)?$doctor->doctorSetting->bio:null ])
                </div>
            </div>
            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.doctor.fields.bio_en'),'placeholder'=>trans('cruds.doctor.fields.bio_en'),'id'=>'bio_en','name'=>'bio_en','span'=>'bio_en','value'=>isset($doctor)?$doctor->doctorSetting->bio_en:null ])
                </div>
            </div>
            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.doctor.fields.license'),'placeholder'=>trans('cruds.doctor.fields.license'),'id'=>'license','name'=>'license','span'=>'license','value'=>isset($doctor)?$doctor->doctorSetting->license:null ])
                </div>
            </div>

        <div class="col-md-6 fv-row">
            <label
                class="required fs-6 fw-semibold mb-2">{{ trans('cruds.doctor.fields.gender',[],session('locale')) }}</label>
            <div class="d-flex flex-column mb-8 fv-row">

                <select class="form-select form-select-solid" data-control="select2"
                        data-hide-search="true"
                        data-placeholder="{{trans('cruds.doctor.fields.gender')}}"
                        name="gender" id="gender">
                    <option value="">{{trans('cruds.doctor.fields.gender')}}</option>
                    <option value="female"
                            @if(isset($doctor)?$doctor->gender == "female":false) selected @endif>{{trans('cruds.doctor.fields.female')}}</option>
                    <option value="male"
                            @if(isset($doctor)?$doctor->gender == "male":false) selected @endif>{{trans('cruds.doctor.fields.male')}}</option>
                </select>
                <span class="text-danger errors"
                      id="gender_error"> </span>
            </div>
        </div>





            <div class="col-md-6 fv-row bg-light-warning p-5">
                <label
                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.doctor.fields.can_work_in_home_visit',[],session('locale')) }}</label>
                <div class="d-flex flex-column mb-8 fv-row">

                    <select class="form-select form-select-solid" data-control="select2"
                            data-hide-search="true"
                            data-placeholder="{{trans('cruds.doctor.fields.can_work_in_home_visit')}}"
                            name="can_work_in_home_visit" id="can_work_in_home_visit">

                        <option value="1"
                                @if(isset($doctor)?$doctor->doctorSetting->can_work_in_home_visit == 0 :false) selected @endif >{{trans('global.active')}}</option>
                        <option value="0"
                                @if(isset($doctor)?$doctor->doctorSetting->can_work_in_home_visit == 0 :false) selected @endif>{{trans('global.un_active')}}</option>
                    </select>
                    <span class="text-danger errors"
                          id="can_work_in_home_visit_error"> </span>
                </div>
            </div>

            <div class="col-md-6 fv-row bg-light-warning p-5 ">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'number','label'=>trans('cruds.doctor.fields.home_visit_price'),'placeholder'=>trans('cruds.doctor.fields.home_visit_price'),'id'=>'home_visit_price','name'=>'home_visit_price','span'=>'home_visit_price','value'=>isset($doctor)?$doctor->doctorSetting->home_visit_price:null  ])
                </div>
            </div>

            <div class="col-md-6 fv-row bg-light-dark p-5 ">
                <label
                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.doctor.fields.can_work_in_hospital',[],session('locale')) }}</label>
                <div class="d-flex flex-column mb-8 fv-row">

                    <select class="form-select form-select-solid" data-control="select2"
                            data-hide-search="true"
                            data-placeholder="{{trans('cruds.doctor.fields.can_work_in_hospital')}}"
                            name="can_work_in_hospital" id="can_work_in_hospital">

                        <option value="1"
                                @if(isset($doctor)?$doctor->doctorSetting->can_work_in_hospital == 0 :false) selected @endif>{{trans('global.active')}}</option>
                        <option value="0"
                                @if(isset($doctor)?$doctor->doctorSetting->can_work_in_hospital == 0 :false) selected @endif>{{trans('global.un_active')}}</option>
                    </select>
                    <span class="text-danger errors"
                          id="can_work_in_hospital_error"> </span>
                </div>
            </div>

            <div class="col-md-6 fv- bg-light-dark p-5 ">
                <div class="d-flex flex-column mb-8 fv-row">
                    @include('includes.form.input',['type'=>'number','label'=>trans('cruds.doctor.fields.in_hospital_price'),'placeholder'=>trans('cruds.doctor.fields.in_hospital_price'),'id'=>'in_hospital_price','name'=>'in_hospital_price','span'=>'in_hospital_price','value'=>isset($doctor)?$doctor->doctorSetting->in_hospital_price:null  ])
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
                        id="btn_save"> {{ trans('global.save',[],session('locale')) }}</button>

            </div>
        </div>
    </div>
    <input type="hidden">
    <div></div>
</div>
