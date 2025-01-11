<div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="currentColor"/>
									<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)" fill="currentColor"/>
								</svg>
							</span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form id="formSaveAddress" class="form" action="#" method="post"
                      enctype="multipart/form-data">
                @csrf
                <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">{{ trans('global.create') }} {{ trans('cruds.address.title') }}</h1>
                    </div>
                    <div class="row g-9 mb-8">

                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.address.fields.title_en'),'placeholder'=>trans('cruds.address.fields.title_en'),'id'=>'title_en','name'=>'title_en','span'=>'title_en','value'=>null ])
                            </div>
                        </div>


                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.address.fields.title_ar'),'placeholder'=>trans('cruds.address.fields.title_ar'),'id'=>'title_ar','name'=>'title_ar','span'=>'title_ar','value'=>null ])
                            </div>
                        </div>

                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.address.fields.description_ar'),'placeholder'=>trans('cruds.address.fields.description_ar'),'id'=>'title_ar','name'=>'description_ar','span'=>'description_ar','value'=>null ])
                            </div>
                        </div>

                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.address.fields.description_en'),'placeholder'=>trans('cruds.address.fields.description_en'),'id'=>'description_en','name'=>'description_en','span'=>'description_en','value'=>null ])
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.address.fields.latitude'),'placeholder'=>trans('cruds.address.fields.latitude'),'id'=>'latitude','name'=>'latitude','span'=>'latitude','value'=>null ])
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.address.fields.longitude'),'placeholder'=>trans('cruds.address.fields.longitude'),'id'=>'longitude','name'=>'longitude','span'=>'longitude','value'=>null ])
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 fv-row">
                        <label
                            class="required fs-6 fw-semibold mb-2">{{ trans('cruds.cities.fields.status') }}</label>
                        <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true"
                                data-placeholder="{{trans('cruds.cities.fields.status')}}"
                                name="status" id="status">
                            <option value=""
                                    disabled>{{trans('cruds.select')}}{{trans('cruds.cities.fields.status')}}</option>
                            <option value="1">{{trans('cruds.show')}}</option>
                            <option value="0">{{trans('cruds.hidden')}}</option>
                        </select>
                        <span class="text-danger errors"
                              id="status_error"> </span>
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary mr-2" type="button"
                                id="btn_save_address"> {{ trans('global.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
