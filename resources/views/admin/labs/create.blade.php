<div class="modal fade" id="kt_modal_create_account" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-1000px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Title-->
                <h2 class="p-3">إضافة منشئة صحية جديدة</h2>
                <!--end::Title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
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
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y m-5">
                <!--begin::Stepper-->
                <div class="stepper stepper-links d-flex flex-column" id="kt_create_account_stepper">
                    <!--begin::Nav-->
                    <div class="stepper-nav py-5">
                        <!--begin::Step 1-->
                        <div class="stepper-item current" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">نوع المنشئة</h3>
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">البيانات العامة</h3>
                        </div>
                        <!--end::Step 2-->
                        <!--begin::Step 3-->
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">بيانات الوصول</h3>
                        </div>
                        <!--end::Step 3-->
                        <!--begin::Step 4-->
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">الخدمات الرئيسية</h3>
                        </div>
                        <!--end::Step 4-->
                        <!--begin::Step 5-->
                        <div class="stepper-item" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">إكمال</h3>
                        </div>
                        <!--end::Step 5-->
                    </div>
                    <!--end::Nav-->
                    <!--begin::Form-->

                    <form id="formSaveUser" class="form" action="#" method="post"
                          enctype="multipart/form-data">
                        <!--begin::Step 1-->
                        <div class="current" data-kt-stepper-element="content">
                            @csrf
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-10 pb-lg-15">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder d-flex align-items-center text-dark">اختر نوع الحساب
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Billing is issued based on your selected account type"></i></h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6">لدينا نوعين من المنشئات (مختبرات طبية -
                                        مستشفيات)
                                    </div>
                                    <!--end::Notice-->
                                </div>


                                @if(!$main_service)
                                    <div
                                        class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 mb-10">
                                        <!--begin::Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                        <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                                                              fill="currentColor"/>
														<rect x="11" y="14" width="7" height="2" rx="1"
                                                              transform="rotate(-90 11 14)" fill="currentColor"/>
														<rect x="11" y="17" width="2" height="2" rx="1"
                                                              transform="rotate(-90 11 17)" fill="currentColor"/>
													</svg>
												</span>
                                        <!--end::Svg Icon-->
                                        <!--end::Icon-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1">
                                            <!--begin::Content-->
                                            <div class="fw-bold">
                                                <h4 class="text-gray-900 fw-bolder"> {{trans('global.cant_add_new_lab_must_active_lab_service')}}
                                                    !</h4>

                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                @endif



                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="fv-row">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->

                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-lg-6 mb-5">
                                            <!--begin::Option-->
                                            <input type="radio" disabled class="btn-check" name="account_type"
                                                   value="{{\App\Models\User::USER_TYPE['Lab']}}"
                                                   checked="checked"
                                                   id="kt_create_account_form_account_type_corporate"/>
                                            <label
                                                class="btn btn-outline btn-outline-dashed btn-outline-default p-7 d-flex align-items-center"
                                                for="kt_create_account_form_account_type_corporate">
                                                <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                                <span class="svg-icon svg-icon-3x me-5">
															<svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3"
                                                                      d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                                                      fill="currentColor"/>
																<path
                                                                    d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                                                    fill="currentColor"/>
															</svg>
														</span>
                                                <!--end::Svg Icon-->
                                                <!--begin::Info-->
                                                <span class="d-block fw-bold text-start">
															<span class="text-dark fw-bolder d-block fs-4 mb-2">المختبرات الطبية</span>
															<span class="text-muted fw-bold fs-6">تشمل مختبرات التحاليل الطبية المتعارف عليها</span>
														</span>
                                                <!--end::Info-->
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Col-->

                                        <div id="map" style="height: 250px; width: 100%;"></div>
                                        <span id="latitude_error" class="text-danger errors"></span>
                                        <span id="longitude_error" class="text-danger errors"></span>

                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-10 pb-lg-15">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder text-dark">معلومات عامة عن المنشئة</h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6"> هنا يمكنك تعبئة البيانات العامة للمنشئة والتي
                                        سوف تظهر للعملاء
                                    </div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Input group-->
                                <div class="row">
                                    <div class="col-md-6 mb-10">
                                        @include('includes.form.input', ['type' => 'text', 'label' => trans('cruds.hospital.fields.first_name'), 'placeholder' => trans('cruds.lab.fields.name'), 'id' => 'first_name', 'name' => 'first_name', 'span' => 'first_name', 'value' => null])
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        @include('includes.form.input', ['type' => 'text', 'label' => trans('cruds.hospital.fields.last_name'), 'placeholder' => trans('cruds.lab.fields.last_name'), 'id' => 'last_name', 'name' => 'last_name', 'span' => 'last_name', 'value' => null])
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-10">
                                        @include('includes.form.input', ['type' => 'text', 'label' => trans('cruds.lab.fields.provider_name_ar'), 'placeholder' => trans('cruds.lab.fields.provider_name_ar'), 'id' => 'provider_name_ar', 'name' => 'provider_name_ar', 'span' => 'provider_name_ar', 'value' => null])
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        @include('includes.form.input', ['type' => 'text', 'label' => trans('cruds.lab.fields.provider_name_en'), 'placeholder' => trans('cruds.lab.fields.provider_name_en'), 'id' => 'provider_name_en', 'name' => 'provider_name_en', 'span' => 'provider_name_en', 'value' => null])
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-10">
                                        @include('includes.form.input', ['type' => 'file', 'label' => trans('cruds.hospital.fields.photo'), 'placeholder' => trans('cruds.hospital.fields.photo'), 'id' => 'photo', 'name' => 'photo', 'span' => 'photo', 'value' => null])
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        @include('includes.form.input', ['type' => 'text', 'label' => trans('cruds.hospital.fields.about_us_ar'), 'placeholder' => trans('cruds.hospital.fields.about_us_ar'), 'id' => 'about_us_ar', 'name' => 'about_us_ar', 'span' => 'about_us_ar', 'value' => null])
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-10">
                                        @include('includes.form.input', ['type' => 'text', 'label' => trans('cruds.hospital.fields.about_us_en'), 'placeholder' => trans('cruds.hospital.fields.about_us_en'), 'id' => 'about_us_en', 'name' => 'about_us_en', 'span' => 'about_us_en', 'value' => null])
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 2-->
                        <!--begin::Step 3-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-10 pb-lg-12">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder text-dark">بيانات التواصل</h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6">هنا يمكنك تعبئة بيانات التواصل مع المنشئة.
                                    </div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Input group-->
                                <div class="row">
                                    <div class="col-md-6 mb-10">
                                        @include('includes.form.input', ['type' => 'email', 'label' => trans('cruds.hospital.fields.email'), 'placeholder' => trans('cruds.hospital.fields.email'), 'id' => 'email', 'name' => 'email', 'span' => 'email', 'value' => null])
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        @include('includes.form.input', ['type' => 'password', 'label' => trans('cruds.hospital.fields.password'), 'placeholder' => trans('cruds.hospital.fields.password'), 'id' => 'password', 'name' => 'password', 'span' => 'password', 'value' => null])
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-10">
                                        @include('includes.form.input', ['type' => 'text', 'label' => trans('cruds.hospital.fields.phone'), 'placeholder' => trans('cruds.hospital.fields.phone'), 'id' => 'phone', 'name' => 'phone', 'span' => 'phone', 'value' => null])
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <input type="hidden" id="latitude" name="latitude">
                                        <input type="hidden" id="longitude" name="longitude">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-10">
                                        @include('includes.form.input', ['type' => 'text', 'label' => trans('cruds.hospital.fields.location_ar'), 'placeholder' => trans('cruds.hospital.fields.location_ar'), 'id' => 'location_ar', 'name' => 'location_ar', 'span' => 'location_ar', 'value' => null])
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        @include('includes.form.input', ['type' => 'text', 'label' => trans('cruds.hospital.fields.location_en'), 'placeholder' => trans('cruds.hospital.fields.location_en'), 'id' => 'location_en', 'name' => 'location_en', 'span' => 'location_en', 'value' => null])
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-10">
                                        <label
                                            class="required fs-6 fw-semibold mb-2">{{ trans('cruds.hospital.fields.country') }}</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                                data-hide-search="true"
                                                data-placeholder="{{trans('cruds.hospital.fields.country')}}"
                                                name="country_id" id="country_id">
                                            <option value="">{{trans('cruds.hospital.fields.country')}}</option>
                                            @foreach($countries as $id => $country)
                                                <option value={{$country->id}}>{{$country->title}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger errors" id="country_id_error"></span>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label
                                            class="required fs-6 fw-semibold mb-2">{{ trans('cruds.hospital.fields.city') }}</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                                data-hide-search="true"
                                                data-placeholder="{{trans('cruds.hospital.fields.city')}}"
                                                name="city_id" id="city_id">
                                            <option value="">{{trans('cruds.hospital.fields.city')}}</option>
                                        </select>
                                        <span class="text-danger errors" id="city_id_error"></span>
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 3-->
                        <!--begin::Step 4-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-10 pb-lg-15">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder text-dark">ضبط اعدادات الخدمات</h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6"> يمكنك ضبط الإعدادات العامة للخدمات الرئيسية
                                        التابعه للمنشئة الصحية
                                    </div>
                                    <!--end::Notice-->
                                </div>

                                @if($main_service !== null )
                                    <div class="d-flex flex-stack mb-10">
                                        <div class="col-md-12 fv-row  ">

                                            <div class="card-body p-0">
                                                <!--begin::Table wrapper-->
                                                <div class="table-responsive">
                                                    <!--begin::Table-->
                                                    <table
                                                        class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9"
                                                        id="kt_api_keys_table">
                                                        <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                                                        <tr>
                                                            <th class="w-150px min-w-150px ps-4">{{ trans('cruds.hospital.fields.name') }}</th>
                                                            <th class="w-120px min-w-120px ">{{ trans('cruds.main_service.fields.photo') }}</th>
                                                            <th class="w-120px min-w-120px">{{ trans('cruds.main_service.fields.commission') }}</th>
                                                            <th class="w-180px min-w-180px">{{ trans('cruds.main_service.fields.B2B') }}</th>
                                                            <th class="w-220px min-w-220px"> {{ trans('cruds.main_service.fields.payment_methods') }} </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="fs-6 fw-bold text-gray-600">
                                                        <tr data-main-service-id="{{ $main_service->id }}">

                                                            <input name="main_service_id"
                                                                   type="hidden" value="{{$main_service->id}}">

                                                            <span id="main_service_id_error"
                                                                  class="text-danger errors"></span>
                                                            <td>{{ $main_service->title ?? '' }}</td>

                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="symbol symbol-50px me-3">
                                                                        <img src="{{ $main_service->photo }}"/>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td class="ps- p-4">
                                                                <input type="number"
                                                                       class="form-control form-control-solid"
                                                                       style="width: 150px" value="0"
                                                                       placeholder="نسبة الربح"
                                                                       name="commission"
                                                                       id="commission" min="0"/>
                                                                <span id="commission_error"
                                                                      class="text-danger errors"></span>
                                                            </td>

                                                            <td class="ps-">
                                                                <div class="w-150px position-relative">
                                                                    <select class="form-select form-select-solid"
                                                                            data-control="select2"
                                                                            data-hide-search="true"
                                                                            data-placeholder="{{ trans('cruds.main_service.fields.B2B') }}"
                                                                            name="support_B2B">
                                                                        <option
                                                                            value="1"> {{trans('global.available')}} </option>
                                                                        <option
                                                                            value="0"> {{trans('global.not_available')}}</option>

                                                                    </select>
                                                                    <span id="support_B2B_error"
                                                                          class="text-danger errors"></span>
                                                                </div>
                                                            </td>


                                                            <td class="pe-9">
                                                                <div class="w-220px position-relative">
                                                                    <select class="form-select form-select-solid"
                                                                            data-control="select2" multiple
                                                                            data-hide-search="true"
                                                                            data-placeholder="{{ trans('cruds.main_service.fields.payment_methods') }}"
                                                                            name="payment_methods[]">
                                                                        <option value=""
                                                                                disabled>{{trans('cruds.select')}} {{ trans('cruds.main_service.fields.payment_methods') }}</option>
                                                                        @foreach($payment_methods as $id => $payment_method)
                                                                            <option
                                                                                value="{{$payment_method->id}}">{{$payment_method->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span
                                                                        id="payment_methods_{{ $main_service->id }}_error"
                                                                        class="text-danger errors"></span>

                                                                </div>
                                                            </td>

                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Table wrapper-->
                                            </div>

                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Wrapper-->
                        <!--end::Step 4-->
                        <!--begin::Step 5-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-8 pb-lg-10">
                                    <!--begin::Title-->
                                    <h2 class="fw-bolder text-dark">هل انتهيت من ضبط جميع الاعدادات الخاصة
                                        بالمنشئة!</h2>
                                    <!--end::Title-->
                                    <!--begin::Notice-->
                                    <div class="text-muted fw-bold fs-6">يجب ان تكن واثق من صحة البيانات المدخلة
                                    </div>
                                    <!--end::Notice-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Body-->
                                <div class="mb-0">
                                    <!--begin::Text-->
                                    <div class="fs-6 text-gray-600 mb-5"> سوف يتم الان إضافة المنشئة الصحية للمنصة
                                    </div>
                                    <!--end::Text-->
                                    <!--begin::Alert-->
                                    <!--begin::Notice-->
                                    <div
                                        class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                        <!--begin::Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                        <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
														<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                                                              fill="currentColor"/>
														<rect x="11" y="14" width="7" height="2" rx="1"
                                                              transform="rotate(-90 11 14)" fill="currentColor"/>
														<rect x="11" y="17" width="2" height="2" rx="1"
                                                              transform="rotate(-90 11 17)" fill="currentColor"/>
													</svg>
												</span>
                                        <!--end::Svg Icon-->
                                        <!--end::Icon-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1">
                                            <!--begin::Content-->
                                            <div class="fw-bold">
                                                <h4 class="text-gray-900 fw-bolder"> يرجى متابعه المنشئة الصحية الجديد
                                                    !</h4>
                                                <div class="fs-6 text-gray-700"> يمكنك عقد اجتماع مع مدير المنشئة
                                                    الجديدة للتعليم كيفية استخدام لوحة التحكم الخاصة بالمنشئة الصحية
                                                    وكيفية ضبط الاعدادات الخاصة به.
                                                </div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Notice-->
                                    <!--end::Alert-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 5-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-stack pt-15">
                            <!--begin::Wrapper-->
                            <div class="mr-2">
                                <button type="button" class="btn btn-lg btn-light-primary me-3"
                                        data-kt-stepper-action="previous">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr063.svg-->
                                    <i class="fa-fw nav-icon fas @if(session('locale') == 'en') fa-arrow-left   @else  fa-arrow-right @endif "> </i>
                                    <!--end::Svg Icon-->الخلف
                                </button>
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Wrapper-->
                            <div>
                                @if($main_service !== null )
                                <button class="btn btn-primary mr-2" type="button"
                                        id="btn_save_user"> {{ trans('global.save') }}</button>
                                @endif

                                <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                    التالي
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    <i class="fa-fw nav-icon fas @if(session('locale') == 'en') fa-arrow-right @else fa-arrow-left @endif "> </i>
                                    <!--end::Svg Icon--></button>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Stepper-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
