<div class="modal fade" id="kt_modal_insurance_comp" tabindex="-1" aria-hidden="true">
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
                <form id="formSaveInsuranceDiscount" class="form" action="#" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="mb-13 text-center">
                        <h1 class="mb-3">  {{ trans('cruds.orders.price_insurance',[],session('locale')) }}</h1>
                    </div>
                    <div class="row g-9 mb-8">
                        <input type="hidden" name="id" value="{{isset($education)?$education->id:null}}">


                        <input type="hidden" value="{{$order->id}}" name="order_id">
                         <div class="col-md-12 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'string','label'=> 'وصف','placeholder'=> 'وصف طبي','id'=>'description','name'=>'description','span'=>'description','value'=> null  ])
                            </div>
                        </div><div class="col-md-12 fv-row">
                            <div class="d-flex flex-column mb-8 fv-row">
                                @include('includes.form.input',['type'=>'string','label'=> 'تعليمات طبية','placeholder'=> 'تعليمات طبية','id'=>'instruction','name'=>'instruction','span'=>'instruction','value'=> null  ])
                            </div>
                        </div>

                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary mr-2" type="button"
                                id="btn_save_insurance_discount"> {{ trans('global.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

