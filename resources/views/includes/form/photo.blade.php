<div class="mb-8">
    <!--begin::Image input-->
    <div class="image-input image-input-outline image-input-changed" data-kt-image-input="true"
         style="background-image: url({{$value}})">
        <!--begin::Preview existing avatar-->
        <div class="image-input-wrapper w-125px h-125px"
             style="background-image: url({{$value}});"></div>
        <!--end::Preview existing avatar-->

        <!--begin::Label-->
        <label
            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
            data-kt-image-input-action="change" data-bs-toggle="tooltip"
            aria-label="Change avatar" data-bs-original-title="Change avatar"
            data-kt-initialized="1">
            <i class="bi bi-pencil-fill fs-7"></i>
            <!--begin::Inputs-->
            <input type="file" name="{{$name}}" >
            <input type="hidden" name="avatar_remove" value="1">
            <!--end::Inputs-->
        </label>
        <!--end::Label-->
        <!--begin::Cancel-->
        <span
            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
            aria-label="Cancel avatar" data-bs-original-title="Cancel avatar"
            data-kt-initialized="1">
                                <i class="bi bi-x fs-2"></i>
                            </span>
        <!--end::Cancel-->

        <!--begin::Remove-->
        <span
            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
            aria-label="Remove avatar" data-bs-original-title="Remove avatar"
            data-kt-initialized="1">
                                <i class="bi bi-x fs-2"></i>
                            </span>
        <!--end::Remove-->
    </div>
    <!--end::Image input-->

    <!--begin::Hint-->
    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
    <span class="text-danger errors"
          id="{{$name}}_error"> </span>
    <!--end::Hint-->
</div>
