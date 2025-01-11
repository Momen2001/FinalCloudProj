<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/axios.min.js')}}"></script>
</head>
<body>
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-column-fluid">
        <div class="d-flex flex-center flex-column flex-column-fluid">
            <div class="w-lg-600px p-10 p-lg-15 mx-auto">
                <form id="formSave" class="form" action="#" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Patient Registration</h3>
                        </div>
                        <div class="card-body">
                            <!-- First Name -->
                            <div class="mb-10">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" required />
                                <span class="text-danger errors"
                                      id="first_name_error"> </span>
                            </div>

                            <!-- Last Name -->
                            <div class="mb-10">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" required />
                                <span class="text-danger errors"
                                      id="last_name_error"> </span>
                            </div>

                            <!-- Birth Date -->
                            <div class="mb-10">
                                <label class="form-label">Birth Date</label>
                                <input type="date" name="birth_date" class="form-control" required />
                                <span class="text-danger errors"
                                      id="birth_date_error"> </span>
                            </div>

                            <div class="mb-10">
                                <label class="form-label">Country</label>
                                <select name="country_id" class="form-select" required>
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->title }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger errors"
                                      id="country_id_error"> </span>
                            </div>

                            <div class="mb-10">
                                <label class="form-label">Phone Code</label>
                                <select name="intro" class="form-select" required>
                                    <option value="">Select Phone Code</option>
                                    @foreach($intros as $intro)
                                        <option value="{{ $intro }}">{{ $intro }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger errors"
                                      id="intro_error"> </span>
                            </div>

                            <!-- Phone -->
                            <div class="mb-10">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" required />
                                <span class="text-danger errors"
                                      id="phone_error"> </span>
                            </div>
                            <div class="mb-10">
                                <label class="form-label">Passport Id</label>
                                <input type="text" name="passport_id" class="form-control" required />
                                <span class="text-danger errors"
                                      id="passport_id_error"> </span>
                            </div>

                            <!-- Email -->
                            <div class="mb-10">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required />
                                <span class="text-danger errors"
                                      id="email_error"> </span>
                            </div>

                            <!-- Password -->
                            <div class="mb-10">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required />
                                <span class="text-danger errors"
                                      id="password_error"> </span>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-10">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required />
                                <span class="text-danger errors"
                                      id="password_confirmation_error"> </span>
                            </div>

                            <!-- Gender -->
                            <div class="mb-10">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span class="text-danger errors"
                                      id="gender_error"> </span>
                            </div>

                            <!-- Confirm Condition -->
                            <div class="mb-10">
                                <label class="form-label">Confirm Terms</label>
                                <input type="checkbox" name="confirm_condition" value="1" required />
                                I agree to the terms and conditions.
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary mr-2" type="button"
                                    id="btn_save"> {{ trans('global.save') }}</button>                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '#btn_save', function (e) {
        $('#btn_save').html('{{trans('global.save')}} <i class="fa fa-spinner fa-spin"></i>');
        e.preventDefault();
        $('.errors').text('');
        var formData = new FormData($('#formSave')[0]); //get all data in form
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ route("patient_register") }}",
            data: formData, // send this data to controller
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                $('#btn_save').html('save');
                if (data.status == true) {

                    document.getElementById("formSave").reset();
                    setTimeout(function () {
                        var url = "{{ route('get_login') }}"; //the url I want to redirect to
                        $(location).attr('href', url);
                    }, 0);

                } else {
                    Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                }
            }, error: function (reject) {
                $('#btn_save').html("save");

                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function (key, val) {
                    // for loop to all validation and show all validate
                    $("#" + key + "_error").text(val[0]);
                });
            }
        });
    });


</script>

</body>
</html>
