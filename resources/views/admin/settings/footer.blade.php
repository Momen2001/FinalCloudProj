<div class="tab-pane fade" id="footer" role="tabpanel">
    <form id="footerForm" method="post" action="{{route('admin.settings.saveSetting')}}" class="form">
        @csrf
            <!--begin::Input group-->
            <input type="hidden" name="local" value="{{$lang}}">


            <div class="row g-9 mb-8">
                <div class="col-md-6 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.facebook') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="facebook" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.facebook') }}" id="facebook" value="{{editContent('facebook',$lang)}}">
                        <span class="text-danger errors"
                              id="facebook_error"> </span>
                    </div>
                </div>

                <div class="col-md-6 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.twitter') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="twitter" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.twitter') }}" id="twitter" value="{{editContent('twitter',$lang)}}">
                        <span class="text-danger errors"
                              id="twitter_error"> </span>
                    </div>
                </div>

                <div class="col-md-6 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.instagram') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="instagram" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.instagram') }}" id="instagram" value="{{editContent('instagram',$lang)}}">
                        <span class="text-danger errors"
                              id="instagram_error"> </span>
                    </div>
                </div>

                <div class="col-md-6 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.linkedin') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="text" name="linkedin" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.linkedin') }}" id="instagram" value="{{editContent('linkedin',$lang)}}">
                        <span class="text-danger errors"
                              id="linkedin_error"> </span>
                    </div>
                </div>
            </div>



            <div class="text-end">
                <button class="btn btn-primary mr-2" type="submit"
                        id="btn_save_footer"> {{ trans('global.save') }}</button>
            </div>
    </form>
</div>

