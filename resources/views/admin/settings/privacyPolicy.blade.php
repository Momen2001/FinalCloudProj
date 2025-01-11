<div class="tab-pane fade" id="privacyPolicy" role="tabpanel">
    <form id="privacyPolicyForm" method="post" action="{{route('admin.settings.saveSetting')}}" class="form">
        @csrf
            <!--begin::Input group-->
            <input type="hidden" name="local" value="{{$lang}}">


            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.patient_home_note') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="patient_home_note" rows="6" class="form-control form-control-solid" placeholder="{{ trans('cruds.setting.fields.patient_home_note') }}" id="patient_home_note">{{editContent('patient_home_note',$lang)}}</textarea>
                        <span class="text-danger errors"
                              id="patient_home_note_error"> </span>
                    </div>
                </div>
            </div>




            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.policy') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="policy" id="privacy_policy_description">{{editContent('policy',$lang)}}</textarea>
                        <span class="text-danger errors"
                              id="policy_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.terms') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="terms" id="terms">{{editContent('terms',$lang)}}</textarea>
                        <span class="text-danger errors"
                              id="terms_error"> </span>
                    </div>
                </div>
            </div>

            <div class="row g-9 mb-8">
                <div class="col-md-12 fv-row">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">{{ trans('cruds.setting.fields.payment_and_refund_policy') }}</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                               title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <textarea name="payment_and_refund_policy" id="payment_and_refund_policy">{{editContent('payment_and_refund_policy',$lang)}}</textarea>
                        <span class="text-danger errors"
                              id="payment_and_refund_policy_error"> </span>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-primary mr-2" type="submit"
                        id="btn_save_privacy_policy"> {{ trans('global.save') }}</button>
            </div>
    </form>
</div>

