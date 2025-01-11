<div class="modal fade" id="kt_modal_assign_doctor" tabindex="-1" aria-hidden="true">
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
                <form id="formAssignDoctor" class="form" action="#" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">  {{ trans('cruds.orders.suggest_doctor') }}</h1>
                    </div>
                    <div class="row g-9 mb-8">
                        <input type="hidden" name="order_id" value="{{$order->id}}">

                        <div class="col-md-12 fv-row">
                            <label
                                class="required fs-6 fw-semibold mb-2">{{ trans('cruds.educations.fields.doctor_id') }}</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true"
                                    data-placeholder="{{trans('cruds.educations.fields.doctor_id')}}"
                                    name="doctor_id" id="doctor_id">
                                <option
                                    value="">{{trans('cruds.select')}}{{trans('cruds.educations.fields.doctor_id')}}</option>
                                @foreach($doctors as $id => $doctor)
                                    <option
                                        value="{{$doctor->id}}"
                                        @if($order->doctor_id == $doctor->id)
                                        selected
                                        @endif>{{$doctor->first_name .' '.$doctor->last_name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger errors"
                                  id="doctor_id_error"> </span>
                        </div>

                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary mr-2" type="button"
                                id="btn_save_assign_doctor"> {{ trans('global.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

