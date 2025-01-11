<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
    <span class="required">{{ $label }}</span>
    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
       title="Specify a target name for future usage and reference"></i>
</label>
<!--end::Label-->
<input  type="{{$type}}" class="form-control form-control-solid" value="{{$value}}"
       placeholder="{{$placeholder}}"
       name="{{$name}}" id="{{$id}}" max="{{isset($max) ?$max :null}}" min="{{isset($min) ?$min :null}}" @isset($mulltible) @if($mulltible == true) multiple @endif @endisset/>
<span class="text-danger errors"
      id="{{$span}}_error"> </span>
