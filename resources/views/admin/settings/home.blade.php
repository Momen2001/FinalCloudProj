<div class="tab-pane fade show active" id="home" role="tabpanel">
    <form id="contactInformationForm" method="post" action="{{route('admin.settings.saveSetting')}}" class="form">
        @csrf
            <!--begin::Input group-->
            <input type="hidden" name="local" value="{{$lang}}">
            <hr>
            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_get_to_know_us_description" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_get_to_know_us_description">{!! editContent('home_section_get_to_know_us_description',$lang) !!}</textarea>
                        <span class="text-danger errors"
                              id="home_section_get_to_know_us_description_error"> </span>
                    </div>
                </div>
            </div>
            <hr>
{{--            section_Features--}}
            <div class="row g-9 mb-8">
                <strong>{{ trans('cruds.setting.fields.home_section_features') }}</strong>
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_features_title_1" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_features_title_1" value="{{editContent('home_section_features_title_1',$lang)}}">
                        <span class="text-danger errors"
                              id="home_section_features_title_1_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_features_description_1" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_features_description_1">{{editContent('home_section_features_description_1',$lang)}}</textarea>
                        <span class="text-danger errors"
                              id="home_section_features_description_1_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_features_title_2" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_features_title_2" value="{{editContent('home_section_features_title_2',$lang)}}">
                        <span class="text-danger errors"
                              id="home_section_features_title_2_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_features_description_2" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_features_description_2">{{editContent('home_section_features_description_2',$lang)}}</textarea>
                        <span class="text-danger errors"
                              id="home_section_features_description_2_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_features_title_3" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_features_title_3" value="{{editContent('home_section_features_title_3',$lang)}}">
                        <span class="text-danger errors"
                              id="home_section_features_title_3_error"> </span>
                    </div>
                </div>

            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_features_description_3" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_features_description_3">{{editContent('home_section_features_description_3',$lang)}}</textarea>
                        <span class="text-danger errors"
                              id="home_section_features_description_3_error"> </span>
                    </div>
                </div>
            </div>

            <hr>

{{--            section how to choose--}}

            <div class="row g-9 mb-8">
                <strong>{{ trans('cruds.setting.fields.home_section_how_to_choose') }}</strong>
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_how_to_choose_title_1" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_how_to_choose_title_1" value="{{editContent('home_section_how_to_choose_title_1',$lang)}}">
                        <span class="text-danger errors"
                              id="home_section_how_to_choose_title_1_error"> </span>
                    </div>
                </div>

            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_how_to_choose_description_1" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_how_to_choose_description_1">{{editContent('home_section_how_to_choose_description_1',$lang)}}</textarea>
                        <span class="text-danger errors"
                              id="home_section_how_to_choose_description_1_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_how_to_choose_title_2" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_how_to_choose_title_2" value="{{editContent('home_section_how_to_choose_title_2',$lang)}}">
                        <span class="text-danger errors"
                              id="home_section_how_to_choose_title_2_error"> </span>
                    </div>
                </div>

            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_how_to_choose_description_2" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_how_to_choose_description_2">{{editContent('home_section_how_to_choose_description_2',$lang)}}</textarea>
                        <span class="text-danger errors"
                              id="home_section_how_to_choose_description_2_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.title') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="home_section_how_to_choose_title_3" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.title') }}" id="home_section_how_to_choose_title_3" value="{{editContent('home_section_how_to_choose_title_3',$lang)}}">
                        <span class="text-danger errors"
                              id="home_section_how_to_choose_title_3_error"> </span>
                    </div>
                </div>

            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.description') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="home_section_how_to_choose_description_3" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.description') }}" id="home_section_how_to_choose_description_3">{{editContent('home_section_how_to_choose_description_3',$lang)}}</textarea>
                        <span class="text-danger errors"
                              id="home_section_how_to_choose_description_3_error"> </span>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-primary mr-2" type="submit"
                        id="btn_save_contact_information"> {{ trans('global.save') }}</button>
            </div>
    </form>
</div>

