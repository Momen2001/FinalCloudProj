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
                <form id="formSave" class="form" action="#" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">{{ trans('global.create') }} {{ trans('cruds.services.title') }}</h1>
                        <h3 class="mb-3"> {{ $msg }}</h3>
                    </div>

                    <span class="text-danger errors"
                          id="main_service_id_error"> </span>
                    <div class="col-md-12 fv-row">
                        <label
                            class="required fs-6 fw-semibold mb-2">{{ trans('cruds.services.title_singular') }}</label>
                        <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true"
                                data-placeholder="{{trans('cruds.services.title')}}"
                                name="service_id" id="service_id">
                            <option value=""
                                    >{{trans('cruds.select')}}{{trans('cruds.services.title')}}</option>
                            @foreach($services as $id => $service)
                                <option
                                    value="{{$service->id}}">{{$service->title}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger errors"
                              id="service_id_error"> </span>
                    </div>

                    @if($main_service_id == mainServiceById()['SupportiveService'])
                        <p class="required fs-6 fw-semibold mb-2 mt-4">ملاحظة سوف يتم تحديد السعر لكل جلسة طبية على حدى.</p>
                        <input name="price" value="0" type="hidden">
                    @else
                        <div class="col-md-12 fv-row mt-8">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'number','label'=>trans('global.price'),'placeholder'=>trans('global.price'),'id'=>'price','name'=>'price','span'=>'price','value'=>null  ])
                            </div>
                        </div>
                    @endif

                    <div class="col-md-12 fv-row">
                        <label
                            class=" fs-6 fw-semibold mb-2 mt-5">{{ trans('global.description') }}:</label>
                        <p class="text-info" id="service_description"></p>
                    </div>

                    <div class="text-center mt-6">
                        <button class="btn btn-primary mr-2" type="button"
                                id="btn_save"> {{ trans('global.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

