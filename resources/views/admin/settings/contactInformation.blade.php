<div class="tab-pane fade" id="contact_information" role="tabpanel">
    <form id="contactInformationForm" method="post" action="{{route('admin.settings.saveSetting')}}" class="form">
    @csrf
    <!--begin::Input group-->
        <input type="hidden" name="local" value="{{$lang}}">
        <div class="row g-9 mb-8">
            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">{{ trans('cruds.setting.fields.address') }}</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                           title="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" name="address" class="form-control form-control-solid"
                           placeholder="{{ trans('cruds.setting.fields.address') }}" id="address"
                           value="{{editContent('address',$lang)}}">
                    <span class="text-danger errors"
                          id="address_error"> </span>
                </div>
            </div>

            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">{{ trans('cruds.setting.fields.mobile') }}</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                           title="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" name="mobile" class="form-control form-control-solid"
                           placeholder="{{ trans('cruds.setting.fields.mobile') }}" id="mobile"
                           value="{{editContent('mobile',$lang)}}">
                    <span class="text-danger errors"
                          id="mobile_error"> </span>
                </div>
            </div>

            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">{{ trans('cruds.setting.fields.email') }}</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                           title="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="email" name="email" class="form-control form-control-solid"
                           placeholder="{{ trans('cruds.setting.fields.email') }}" id="email"
                           value="{{editContent('email',$lang)}}">
                    <span class="text-danger errors"
                          id="email_error"> </span>
                </div>
            </div>

            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">{{ trans('cruds.setting.fields.hakeem_lat') }}</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                           title="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="hakeem_lat" name="hakeem_lat" class="form-control form-control-solid"
                           placeholder="{{ trans('cruds.setting.fields.hakeem_lat') }}" id="hakeem_lat"
                           value="{{editContent('hakeem_lat',$lang)}}">
                    <span class="text-danger errors"
                          id="hakeem_lat_error"> </span>
                </div>
            </div>

            <div class="col-md-6 fv-row">
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">{{ trans('cruds.setting.fields.hakeem_long') }}</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                           title="Specify a target name for future usage and reference"></i>
                    </label>
                    <!--end::Label-->
                    <input type="hakeem_long" name="hakeem_long" class="form-control form-control-solid"
                           placeholder="{{ trans('cruds.setting.fields.hakeem_long') }}" id="hakeem_long"
                           value="{{editContent('hakeem_long',$lang)}}">
                    <span class="text-danger errors"
                          id="hakeem_long_error"> </span>
                </div>
            </div>
        </div>



        <div class="text-end">
            <button class="btn btn-primary mr-2" type="submit"
                    id="btn_save_contact_information"> {{ trans('global.save') }}</button>
        </div>
    </form>
</div>

