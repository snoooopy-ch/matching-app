<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | {{ __('dashboard') }}</title>
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="{{ asset('admin-assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->
    @yield('page_css')
    <!--begin: Custom Styles-->
    <link href="{{asset('admin-assets/custom/css/main.css')}}" rel="stylesheet" type="text/css" />
    <!--end: Custom Styles-->
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('admin-assets/custom/img/favicon-96x96.png') }}">
</head>
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <!-- BEGIN: Header -->
        @include('layouts.header')
        <!-- END: Header -->
        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            <!-- BEGIN: Left Aside -->
            @include('layouts.sidebar')
            <!-- END: Left Aside -->
            @yield('content')
        </div>
        <!-- END: Body -->
        <!-- begin::Footer -->
        @include('layouts.footer')
        <!-- end::Footer -->
    </div>
    <!-- end:: page -->
    <!-- begin::Scroll Top -->
    <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->

    <!--begin::Global Theme Bundle -->
    <script src="{{asset('admin-assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/vendors/base/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('admin-assets/custom/js/summernote-ja-JP.js') }}" type="text/javascript"></script>
    <!--end::Global Theme Bundle -->
    @include('admin.global-js')
    <!--begin::Page Snippets -->
    @yield('page_js')
    <!--end::Page Snippets -->
</body>
</html>
