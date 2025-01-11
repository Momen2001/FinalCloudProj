<link href="https://fonts.googleapis.com/css?family=Quicksand:400,700" rel="stylesheet">
<link rel="shortcut icon" href="{{asset('assets/logo.png')}}"/>

<style>
    html {
        scroll-behavior: smooth;
    }

    #scrolltop {
        display: block;
        visibility: visible;
        opacity: 1;
        transition: visibility 0s, opacity 0.5s ease-in;
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.4);
        border-radius: 50%;
    }
    #login {
        display: block;
        visibility: visible;
        opacity: 1;
        transition: visibility 0s, opacity 0.5s ease-in;

        /*bottom: 20px;*/
        right: 20px;
        background: rgba(255, 255, 255, 0.4);
        /*border-radius: 50%;*/
    }

    .top-button {
        text-decoration: none;
        font-size: 21px;
        font-weight: 700;
        line-height: 1.5;
        cursor: pointer;
        padding: 12px;
        color: #222;
    }
    .login-button {
        text-decoration: none;
        font-size: 21px;
        font-weight: 700;
        line-height: 1.5;
        /*cursor: pointer;*/
        padding: 12px;
        color: #222;
    }

    body {
        background: linear-gradient(180deg, #640303 0%, #6c1125 100%);
        color: #fff;
        font-family: 'Quicksand', sans-serif;
        font-size: 24px;
        line-height: 1.4;
        text-align: center;
        padding: 40px;
    }

    .long-text {
        max-width: 700px;
        margin: 0 auto;
        padding: 40px;
        background: rgba(0, 0, 0, 0.2);
    }

</style>
<body id="top">
<br>
<br>
<br>

<h1>

</h1>

<div class="long-text">
    <p>WELCOME TO IUG HEALTHCARE</p>
    {{--    <p>Click the button to see smooth scroll to top.</p>--}}
    Login if you are one of the platform participants <br>
    (Admin - medical
    laboratory - Patient )
    <br>
    <br>

    @if(!Auth::check())
        <div id="login">
            <a class="login-button" href="{{route('login')}}">➡ ➡ ➡ Go ➡ ➡ ➡</a>
        </div>
    @elseif(auth()->user()->getType() == 'Hospital')
        <div id="login">
            <a class="login-button" href="{{route('hospital_home')}}">➡ ➡ ➡ Go ➡ ➡ ➡</a>
        </div>
    @elseif(auth()->user()->getType() == 'Lab')
        <div id="login">
            <a class="login-button" href="{{route('lab_home')}}">➡ ➡ ➡ Go ➡ ➡ ➡</a>
        </div>
    @elseif(auth()->user()->getType() == 'Admin')
        <div id="login">
            <a class="login-button" href="{{route('admin_home')}}">➡ ➡ ➡ Go ➡ ➡ ➡</a>
        </div>
    @endif



</div>
<div id="scrolltop">
    <a class="top-button" href="#top">&uarr;</a>
</div>

<script>
    const scrollTop = document.getElementById('scrolltop')
    window.onscroll = () => {
        if (window.scrollY > 0) {
            scrollTop.style.visibility = "visible";
            scrollTop.style.opacity = 1;
        } else {
            scrollTop.style.visibility = "hidden";
            scrollTop.style.opacity = 0;
        }
    };
    // get HTML templates at https://templateflip.com/
</script>
</body>
