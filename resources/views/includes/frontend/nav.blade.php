<nav class="navbar navbar-expand-lg header-nav">
    <div class="navbar-header">
        <a id="mobile_btn" href="javascript:void(0);">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>
        <a href="{{ url('/') }}" class="navbar-brand logo">
            <img src="{{ asset('website/assets/img/logo.png') }}" class="img-fluid" alt="Logo">
        </a>
    </div>
    <div class="main-menu-wrapper">
        <div class="menu-header">
            <a href="{{ url('/') }}" class="menu-logo">
                <img src="{{ asset('website/assets/img/logo.png') }}" class="img-fluid" alt="Logo">
            </a>
            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                <i class="fas fa-times"></i>
            </a>
        </div>
        <ul class="main-nav">
            {{-- <li class="has-submenu megamenu active">
                <a href="javascript:void(0);">Home <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu mega-submenu">
                    <li>
                        <div class="megamenu-wrapper">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="single-demo active">
                                        <div class="demo-img">
                                            <a href="index.html" class="inner-demo-img"><img src="{{ asset('website/assets/img//logo.png') }}" class="img-fluid " alt="img"></a>
                                        </div>
                                        <div class="demo-info">
                                            <a href="index.html" class="inner-demo-img">General Home 1</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="single-demo">
                                        <div class="demo-img">
                                            <a href="index-2.html" class="inner-demo-img"><img src="{{ asset('website/assets/img/home/home-02.jpg') }}" class="img-fluid " alt="img"></a>
                                        </div>
                                        <div class="demo-info">
                                            <a href="index-2.html" class="inner-demo-img">General Home 2</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="single-demo">
                                        <div class="demo-img">
                                            <a href="index-3.html" class="inner-demo-img"><img src="{{ asset('website/assets/img/home/home-03.jpg') }}" class="img-fluid " alt="img"></a>
                                        </div>
                                        <div class="demo-info">
                                            <a href="index-3.html" class="inner-demo-img">General Home 3</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="single-demo">
                                        <div class="demo-img">
                                            <a href="index-5.html" class="inner-demo-img"><img src="{{ asset('website/assets/img/home/home-04.jpg') }}" class="img-fluid " alt="img"></a>
                                        </div>
                                        <div class="demo-info">
                                            <a href="index-5.html" class="inner-demo-img">Cardiology</a>
                                        </div>
                                    </div>
                                </div>
         
                                <div class="col-lg-2">
                                    <div class="single-demo">
                                        <div class="demo-img">
                                            <a href="index-14.html" class="inner-demo-img"><img src="{{ asset('website/assets/img/home/home-14.jpg') }}" class="img-fluid " alt="img"></a>
                                        </div>
                                        <div class="demo-info">
                                            <a href="index-14.html" class="inner-demo-img">Dentists</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="has-submenu">
                <a href="javascript:void(0);">Patients <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="patient-dashboard.html">Patient Dashboard</a></li>
                    <li><a href="checkout.html">Checkout</a></li>

                </ul>
            </li> --}}
            <li class="login-link"><a href="{{ url('/auth/login') }}">تسجيل الدخول / التسجيل</a></li>
        </ul>
    </div>
    <ul class="nav header-navbar-rht">
        <li class="register-btn">
            <a href="{{ url('download') }}" class="btn reg-btn"><i class="feather-user"></i>التسجيل</a>
        </li>
        <li class="register-btn">
            <a href="{{ url('download') }}" class="btn btn-primary log-btn"><i class="feather-lock"></i>تسجيل الدخول</a>
        </li>
    </ul>
</nav>