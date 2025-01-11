<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
    <span class="#">{{ $label }}</span>
    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
       title="Specify a target name for future usage and reference"></i>
</label>
<!--end::Label-->
<textarea class="form-control form-control-solid"
          placeholder="{{$placeholder}}"
          name="{{$name}}" id="{{$id}}">{{$value}}</textarea>
<span class="text-danger errors"
      id="{{$span}}_error"> </span>
