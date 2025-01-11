<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hakeem App</title>
    <link href="{{asset('assets/site/css/bootstrap/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/site/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/site/css/responsive.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://code.jquery.com/jquery-3.5.1.js">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<body>
<!-- signup steps  -->
<!-- login  -->
<div id="login" class="dark-background " STYLE="background-color: #69020c">
    <div class="login-container">
        <div class="login-profile">
            <h1>الصحة للرعاية الطبية </h1>
            <h2>
                هنا يتم الدخول للإدارة العمليات والمسلزمات الدورية الوارد من مستخدمين الصحة للرعاية الطبية <br/>
            </h2>
            <img class="cubble-img" src="{{asset('assets/site/images/doctor.png')}}" alt=""/>
            <img class="like-img" src="{{asset('assets/site/images/like.png')}}" alt=""/>
            <img class="love-img" src="{{asset('assets/site/images/love.png')}}" alt=""/>
        </div>
        <form id="formLoginUser" action="#" method="post"
              enctype="multipart/form-data">
            @csrf
            @if(  \Illuminate\Support\Facades\Request::is('landing*' ))
                <div class="signup-close">
                    <img src="{{asset('assets/site/images/close.png')}}" alt="" onclick="hideAlert('login')"/>
                </div>
            @endif
            <h1>تسجيل دخول</h1>
            <h2>البريد الإلكتروني او رقم الموبايل</h2>
            <input placeholder="أدخل البريد الإلكتروني أو رقم الموبايل" name="email"/>
            <h2>كلمة المرور</h2>
            <input placeholder="أدخل كلمة المرور" name="password" type="password"/>
            <h3> هل نسيت كلمة المرور</h3>
            <button type="button" id="btn_login_user">تسجيل دخول</button>
        </form>
    </div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#btn_login_user', function (e) {
        $('#btn_login_user').html('انتظر <i class="fa fa-spinner fa-spin"></i>').addClass('link-disabled');
        e.preventDefault();
        $('.errors').text('');
        var formData = new FormData($('#formLoginUser')[0]); //get all data in form
        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{ route("login") }}",
            data: formData, // send this data to controller
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                $('#btn_login_user').html('save').removeClass('link-disabled');
                if (data.status == true) {
                    document.getElementById("formLoginUser").reset();
                    setTimeout(function () {
                        //the url I want to redirect to
                        $(location).attr('href', data.redirect_url);
                    }, 0);
                } else {
                    Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_the_password_is_incorrect_or_the_email_address_is_incorrect')}}", "error");
                }
            }, error: function (reject) {
                $('#btn_login_user').html('تسجيل الدخول').removeClass('link-disabled');
                var response = $.parseJSON(reject.responseText);
                messages = "";
                $.each(response.errors, function (key, val) {
                    // for loop to all validation and show all validate
                    messages = val[0] + " " + messages;
                });
                Swal.fire("{{trans('global.sorry_some_error')}}", messages, "error");
            }
        });
    });


</script>
</body>
</html>
