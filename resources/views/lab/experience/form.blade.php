<div class="row g-9 mb-8">
    <input type="hidden" name="id" value="{{isset($experience)?$experience->id:null}}">

    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'text','label'=> trans('cruds.experiences.fields.company_ar'),'placeholder'=> trans('cruds.experiences.fields.company_ar'),'id'=>'company_ar','name'=>'company_ar','span'=>'company_ar','value'=>isset($experience)?$experience->translate('ar')->company:null ])
        </div>
    </div>

    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'text','label'=> trans('cruds.experiences.fields.company_en'),'placeholder'=> trans('cruds.experiences.fields.company_en'),'id'=>'company_en','name'=>'company_en','span'=>'company_en','value'=>isset($experience)?$experience->translate('en')->company:null  ])
        </div>
    </div>


    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.textarea',['label'=> trans('cruds.experiences.fields.details_ar'),'placeholder'=> trans('cruds.experiences.fields.details_ar'),'id'=>'details_ar','name'=>'details_ar','span'=>'details_ar','value'=>isset($experience)?$experience->translate('ar')->details:null ])
        </div>
    </div>
    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.textarea',['label'=> trans('cruds.experiences.fields.details_en'),'placeholder'=> trans('cruds.experiences.fields.details_en'),'id'=>'details_en','name'=>'details_en','span'=>'details_en','value'=>isset($experience)?$experience->translate('en')->details:null  ])
        </div>
    </div>


    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'text','label'=> trans('cruds.experiences.fields.position_ar'),'placeholder'=> trans('cruds.experiences.fields.position_ar'),'id'=>'position_ar','name'=>'position_ar','span'=>'position_ar','value'=>isset($experience)?$experience->translate('ar')->position:null  ])
        </div>
    </div>

    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'text','label'=> trans('cruds.experiences.fields.position_en'),'placeholder'=> trans('cruds.experiences.fields.position_en'),'id'=>'position_en','name'=>'position_en','span'=>'position_en','value'=>isset($experience)?$experience->translate('en')->position:null ])
        </div>
    </div>


    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'date','label'=> trans('cruds.experiences.fields.start_at'),'placeholder'=> trans('cruds.experiences.fields.start_at'),'id'=>'start_at','name'=>'start_at','span'=>'start_at','value'=>isset($experience)?$experience->start_at:null  ])
        </div>
    </div>
    <div class="col-md-6 fv-row">
        <div class="d-flex flex-column mb-8 fv-row">
            @include('includes.form.input',['type'=>'date','label'=> trans('cruds.experiences.fields.end_at'),'placeholder'=> trans('cruds.experiences.fields.end_at'),'id'=>'end_at','name'=>'end_at','span'=>'end_at','value'=>isset($experience)?$experience->end_at:null  ])
        </div>
    </div>

    <div class="col-md-6 fv-row">
        <label
            class="required fs-6 fw-semibold mb-2">{{ trans('cruds.experiences.fields.doctor_id') }}</label>
        <select class="form-select form-select-solid" data-control="select2"
                data-hide-search="true"
                data-placeholder="{{trans('cruds.experiences.fields.doctor_id')}}"
                name="doctor_id" id="doctor_id">
            <option value=""
                    disabled>{{trans('cruds.select')}}{{trans('cruds.experiences.fields.doctor_id')}}</option>
            @foreach($doctors as $id => $doctor)
                <option
                    value="{{$doctor->id}}" @if(isset($experience))
                @if($experience->doctor_id ==$doctor->id)
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
            class="required fs-6 fw-semibold mb-2">{{ trans('cruds.experiences.fields.country_id') }}</label>
        <select class="form-select form-select-solid" data-control="select2"
                data-hide-search="true"
                data-placeholder="{{trans('cruds.experiences.fields.country_id')}}"
                name="country_id" id="country_id">
            <option value=""
                    disabled>{{trans('cruds.select')}}{{trans('cruds.experiences.fields.country_id')}}</option>
            @foreach($countries as $id => $country)
                <option value="{{$country->id}}"
                        @if(isset($experience))
                        @if($experience->country_id ==$country->id)
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
