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
                <form id="formSaveUser" class="form" action="#" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="mb-13 text-center">
                        <h1 class="mb-3">{{ trans('global.create',[],session('locale')) }} {{ trans('cruds.user.admin',[],session('locale')) }}</h1>
                    </div>
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.user.fields.first_name',[],session('locale')),'placeholder'=>trans('cruds.user.fields.name',[],session('locale')),'id'=>'first_name','name'=>'first_name','span'=>'first_name','value'=>null ])
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.user.fields.last_name',[],session('locale')),'placeholder'=>trans('cruds.user.fields.last_name',[],session('locale')),'id'=>'last_name','name'=>'last_name','span'=>'last_name','value'=>null ])
                            </div>
                        </div>

                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'email','label'=>trans('cruds.user.fields.email',[],session('locale')),'placeholder'=>trans('cruds.user.fields.email',[],session('locale')),'id'=>'email','name'=>'email','span'=>'email','value'=>null ])
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'password','label'=>trans('cruds.user.fields.password',[],session('locale')),'placeholder'=>trans('cruds.user.fields.password',[],session('locale')),'id'=>'password','name'=>'password','span'=>'password','value'=>null ])
                            </div>
                        </div>

                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'text','label'=>trans('cruds.user.fields.phone',[],session('locale')),'placeholder'=>trans('cruds.user.fields.phone',[],session('locale')),'id'=>'phone','name'=>'phone','span'=>'phone','value'=>null ])
                            </div>
                        </div>
                        <div class="col-md-6 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'file','label'=>trans('cruds.user.fields.photo',[],session('locale')),'placeholder'=>trans('cruds.user.fields.photo',[],session('locale')),'id'=>'photo','name'=>'photo','span'=>'photo','value'=>null ])
                            </div>
                        </div>





                        <div class="col-md-6 fv-row">
                            <label
                                class="required fs-6 fw-semibold mb-2">{{ trans('cruds.user.fields.intro',[],session('locale')) }}</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true" data-placeholder="{{trans('cruds.user.fields.intro',[],session('locale'))}}"
                                    name="intro" id="intro">
                                <option value="">{{trans('cruds.user.fields.intro',[],session('locale'))}}</option>
                                    @foreach($countries as $id => $country)
                                    <option value={{$country->phone_code}}>{{$country->phone_code}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger errors"
                                  id="intro_error"> </span>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label
                                class="required fs-6 fw-semibold mb-2">{{ trans('cruds.user.fields.country',[],session('locale')) }}</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true"
                                    data-placeholder="{{trans('cruds.user.fields.country',[],session('locale'))}}"
                                    name="country_id" id="country_id">
                                <option value="">{{trans('cruds.user.fields.country',[],session('locale'))}}</option>
                                @foreach($countries as $id => $country)
                                    <option value={{$country->id}}>{{$country->title}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger errors"
                                  id="country_id_error"> </span>
                        </div>

                        <div class="col-md-12 fv-row">
                            <label
                                class="required fs-6 fw-semibold mb-2">{{ trans('cruds.user.fields.city',[],session('locale')) }}</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true" data-placeholder="{{trans('cruds.user.fields.city',[],session('locale'))}}"
                                    name="city_id" id="city_id">
                                <option value="">{{trans('cruds.user.fields.city',[],session('locale'))}}</option>

                            </select>
                            <span class="text-danger errors"
                                  id="city_id_error"> </span>
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary mr-2" type="button"
                                id="btn_save_user"> {{ trans('global.save',[],session('locale')) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

