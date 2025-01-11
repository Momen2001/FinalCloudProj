<div class="tab-pane fade show active"  id="financial" role="tabpanel">
    <form id="financialForm" method="post" action="{{route('admin.settings.saveSetting')}}" class="form">
        @csrf
            <!--begin::Input group-->
            <input type="hidden" name="local" value="{{$lang}}">
            <div class="row g-9 mb-8">
                <div class="col-md-6 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.vat') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="number" name="vat" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.vat') }}" id="vat" value="{{editContent('vat',$lang)}}">
                        <span class="text-danger errors"
                              id="vat_error"> </span>
                    </div>
                </div>


                <div class="col-md-6 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.before_24_h') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="number" name="before_24_h" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.before_24_h') }}" id="before_24_h" value="{{editContent('before_24_h',$lang)}}">
                        <span class="text-danger errors"
                              id="before_24_h_error"> </span>
                    </div>
                </div>

                <div class="col-md-6 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.before_12_h') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="number" name="before_12_h" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.before_12_h') }}" id="before_24_h" value="{{editContent('before_12_h',$lang)}}">
                        <span class="text-danger errors"
                              id="before_12_h_error"> </span>
                    </div>
                </div>
                <div class="col-md-6 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.before_6_h') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="number" name="before_6_h" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.before_6_h') }}" id="before_24_h" value="{{editContent('before_6_h',$lang)}}">
                        <span class="text-danger errors"
                              id="before_6_h"> </span>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-primary mr-2" type="submit"
                        id="btn_save_about_us"> {{ trans('global.save') }}</button>
            </div>
    </form>
</div>

