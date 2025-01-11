<div class="row g-9 mb-8">
    <input type="hidden" name="id" value="{{isset($education)?$education->id:null}}">

    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'text','label'=> trans('cruds.educations.fields.degree_ar'),'placeholder'=> trans('cruds.educations.fields.degree_ar'),'id'=>'degree_ar','name'=>'degree_ar','span'=>'degree_ar','value'=>isset($education)?$education->translate('ar')->degree:null ])
        </div>
    </div>

    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'text','label'=> trans('cruds.educations.fields.degree_en'),'placeholder'=> trans('cruds.educations.fields.degree_en'),'id'=>'degree_en','name'=>'degree_en','span'=>'degree_en','value'=>isset($education)?$education->translate('en')->degree:null  ])
        </div>
    </div>

    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'text','label'=> trans('cruds.educations.fields.department_ar'),'placeholder'=> trans('cruds.educations.fields.department_ar'),'id'=>'department_ar','name'=>'department_ar','span'=>'department_ar','value'=>isset($education)?$education->translate('ar')->department:null  ])
        </div>
    </div>

    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'text','label'=> trans('cruds.educations.fields.department_en'),'placeholder'=> trans('cruds.educations.fields.department_en'),'id'=>'department_en','name'=>'department_en','span'=>'department_en','value'=>isset($education)?$education->translate('en')->department:null ])
        </div>
    </div>

    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.textarea',['label'=> trans('cruds.educations.fields.details_ar'),'placeholder'=> trans('cruds.educations.fields.details_ar'),'id'=>'details_ar','name'=>'details_ar','span'=>'details_ar','value'=>isset($education)?$education->translate('ar')->details:null ])
        </div>
    </div>
    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.textarea',['label'=> trans('cruds.educations.fields.details_en'),'placeholder'=> trans('cruds.educations.fields.details_en'),'id'=>'details_en','name'=>'details_en','span'=>'details_en','value'=>isset($education)?$education->translate('en')->details:null  ])
        </div>
    </div>


    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'text','label'=> trans('cruds.educations.fields.specialization_ar'),'placeholder'=> trans('cruds.educations.fields.specialization_ar'),'id'=>'degree_ar','name'=>'specialization_ar','span'=>'specialization_ar','value'=>isset($education)?$education->translate('ar')->specialization:null  ])
        </div>
    </div>

    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'text','label'=> trans('cruds.educations.fields.specialization_en'),'placeholder'=> trans('cruds.educations.fields.specialization_en'),'id'=>'specialization_en','name'=>'specialization_en','span'=>'specialization_en','value'=>isset($education)?$education->translate('en')->specialization:null ])
        </div>
    </div>


    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'text','label'=> trans('cruds.educations.fields.university_ar'),'placeholder'=> trans('cruds.educations.fields.university_ar'),'id'=>'university_ar','name'=>'university_ar','span'=>'university_ar','value'=>isset($education)?$education->translate('ar')->university:null ])
        </div>
    </div>

    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'text','label'=> trans('cruds.educations.fields.university_en'),'placeholder'=> trans('cruds.educations.fields.university_en'),'id'=>'university_en','name'=>'university_en','span'=>'university_en','value'=>isset($education)?$education->translate('en')->university:null ])
        </div>
    </div>


    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'date','label'=> trans('cruds.educations.fields.completion_date'),'placeholder'=> trans('cruds.educations.fields.completion_date'),'id'=>'completion_date','name'=>'completion_date','span'=>'completion_date','value'=>isset($education)?$education->completion_date:null  ])
        </div>
    </div>

    <div class="col-md-6 fv-row">
        <label
            class="required fs-6 fw-semibold mb-2">{{ trans('cruds.educations.fields.doctor_id') }}</label>
        <select class="form-select form-select-solid" data-control="select2"
                data-hide-search="true"
                data-placeholder="{{trans('cruds.educations.fields.doctor_id')}}"
                name="doctor_id" id="doctor_id">
            <option value=""
                    disabled>{{trans('cruds.select')}}{{trans('cruds.educations.fields.doctor_id')}}</option>
            @foreach($doctors as $id => $doctor)
                <option
                    value="{{$doctor->id}}"  @if(isset($education))
                @if($education->doctor_id ==$doctor->id)
                selected
                    @endif
                    @endif>{{$doctor->first_name .' '.$doctor->last_name}}</option>
            @endforeach
        </select>
        <span class="text-danger errors"
              id="doctor_id_error"> </span>
    </div>

    <div class="col-md-6 fv-row">
        <label
            class="required fs-6 fw-semibold mb-2">{{ trans('cruds.educations.fields.country_id') }}</label>
        <select class="form-select form-select-solid" data-control="select2"
                data-hide-search="true"
                data-placeholder="{{trans('cruds.educations.fields.country_id')}}"
                name="country_id" id="country_id">
            <option value=""
                    disabled>{{trans('cruds.select')}}{{trans('cruds.educations.fields.country_id')}}</option>
            @foreach($countries as $id => $country)
                <option value="{{$country->id}}"
                        @if(isset($education))
                        @if($education->country_id ==$country->id)
                        selected
                    @endif
                    @endif>
                    {{$country->title}}
                </option>
            @endforeach
        </select>
        <span class="text-danger errors"
              id="country_id_error"> </span>
    </div>
</div>
<div class="text-center">
    <button class="btn btn-primary mr-2" type="button"
            id="btn_save"> {{ trans('global.save') }}</button>
</div>
