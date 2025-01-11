<head>
    <base href="../../">
    <meta charset="utf-8"/>
    <title> @yield('title') </title>
    <meta name="description"
          content="Craft admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets."/>
    <meta name="keywords"
          content="Craft, bootstrap, Angular 10, Vue, React, Laravel, admin themes, free admin themes, bootstrap admin, bootstrap dashboard"/>
    <link rel="canonical" href="Https://preview.keenthemes.com/start"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-ar.css')}}">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/jquery-3.5.1.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js">

    <!--end::Global Stylesheets Bundle-->
    <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
    <link rel="canonical" href="Https://preview.keenthemes.com/start"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="{{asset('assets/logo.png')}}"/>
    <!--begin::Fonts-->
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->

    <meta name="description"
          content="Craft admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets."/>
    <meta name="keywords"
          content="Craft, bootstrap, Angular 10, Vue, React, Laravel, admin themes, free admin themes, bootstrap admin, bootstrap dashboard"/>
    <link rel="canonical" href="Https://preview.keenthemes.com/start"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>

    @if(session('locale') == 'en')
        <link href="{{asset('assets/css/styleEn.bundle.css')}}" rel="stylesheet" type="text/css"/>
    @else
        <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    @endif
    {{--     <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>--}}
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <link href="{{asset('assets/css/myStyle.css')}}" rel="stylesheet" type="text/css"/>
    <!-- /core JS files -->
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            font-style: normal;
            font-size: 16px !important;
        }
        .menu-title {
            font-weight: bold !important;
        }
        .base_icon {
            color: #0a67ad;
            font-size: 20px;
            font-weight: bolder;
        }
    </style>

    @yield('style')

</head>
<!--end::Head-->
