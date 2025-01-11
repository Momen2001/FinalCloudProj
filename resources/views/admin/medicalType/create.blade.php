<div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="currentColor"/>
									<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)" fill="currentColor"/>
								</svg>
							</span>
                </div>
            </div>

            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form id="formSaveSpecialization" class="form" action="#" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="mb-13 text-center">
                        <h1 class="mb-3">{{ trans('global.create',[],session('locale')) }} {{ trans('cruds.medicalType.title',[],session('locale')) }}</h1>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.medicalType.fields.title_ar',[],session('locale')),'placeholder'=>trans('cruds.medicalType.fields.title_ar',[],session('locale')),'id'=>'title_ar','name'=>'title_ar','span'=>'title_ar','value'=>null ])
                            </div>
                        </div>

                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.medicalType.fields.title_en',[],session('locale')),'placeholder'=>trans('cruds.medicalType.fields.title_en',[],session('locale')),'id'=>'title_en','name'=>'title_en','span'=>'title_en','value'=>null ])
                            </div>
                        </div>


                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'file','label'=>trans('cruds.medicalType.fields.photo',[],session('locale')),'placeholder'=>trans('cruds.medicalType.fields.photo',[],session('locale')),'id'=>'photo','name'=>'photo','span'=>'photo','value'=>null ])
                            </div>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label
                                class="required fs-6 fw-semibold mb-2">{{ trans('cruds.medicalType.fields.status',[],session('locale')) }}</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true"
                                    data-placeholder="{{trans('cruds.medicalType.fields.status',[],session('locale'))}}"
                                    name="status" id="status">
                                <option value=""
                                        disabled>{{trans('cruds.select',[],session('locale'))}} {{trans('cruds.medicalType.fields.status',[],session('locale'))}}</option>
                                <option value="1">{{trans('cruds.active',[],session('locale'))}}</option>
                                <option value="0">{{trans('cruds.un_active',[],session('locale'))}}</option>
                            </select>
                            <span class="text-danger errors"
                                  id="status_error"> </span>
                        </div>


                        <div class="col-md-6 fv-row">
                            <label
                                class="required fs-6 fw-semibold mb-2">{{ trans('cruds.medicalType.fields.parent',[],session('locale')) }}</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true"
                                    data-placeholder="{{trans('cruds.medicalType.fields.parent',[],session('locale'))}}"
                                    name="parent" id="parent">

                                <option value="0">{{trans('cruds.medicalType.parent_not_follow',[],session('locale'))}}</option>
                                @foreach ($medicalType as $key =>  $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach

                            </select>
                            <span class="text-danger errors"
                                  id="parent_error"> </span>
                        </div>

                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary mr-2" type="button"
                                id="btn_save_specialization"> {{ trans('global.save',[],session('locale')) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

