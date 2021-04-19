<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hệ thống quản trị website</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- BaseUrl --}}
        <script>
            var baseUrl = "{{ url('/') }}"
            var akey = "fyTPoiljmLj2ZgJouUR1lSWNQu58Fnhekzu9IJ2K9g"
            var assetUrl = "{{ asset('/') }}"
            var current_lang = "{{ config('app.locale') }}"
        </script>


        <link rel="stylesheet" href="{{ asset('css/app.css') }}">`
        <script src="{{ asset('admin_source/vendor/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap CSS-->
        {{-- <link rel="stylesheet" href="{{ asset('admin_source/vendor/bootstrap/css/bootstrap.min.css') }}"> --}}
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="{{ asset('admin_source/vendor/font-awesome/css/font-awesome.min.css') }}">
        <!-- Fontastic Custom icon font-->
        {{-- <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{ asset('admin_source/css/fontastic.css') }}">
        <!-- Google fonts - Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
        <!-- jQuery Circle-->
        <link rel="stylesheet" href="{{ asset('admin_source/css/grasp_mobile_progress_circle-1.0.0.min.css') }}">
        <!-- Custom Scrollbar-->
        <link rel="stylesheet" href="{{ asset('admin_source/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="{{ asset('admin_source/css/style.sea.css') }}" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="{{ asset('admin_source/css/custom.css') }}">
        <!-- Favicon-->
        {{-- <link rel="shortcut icon" href="{{ asset('admin_source/img/favicon.ico') }}"> --}}

        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
        @yield('css-admin')

        <style>
            body::-webkit-scrollbar{
                display: none
            }
        </style>
    </head>
<body>
    @include('partials.admin.menu')
    <div class="page">
        @include('partials.admin.header')
        @yield('content')
    </div>

    <!-- JavaScript files-->

    {{-- <script src="{{ asset('admin_source/vendor/popper.js/umd/popper.min.js') }}"> </script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('admin_source/js/adminCustom.js') }}"></script>
    {{-- <script src="{{ asset('admin_source/vendor/bootstrap/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('admin_source/js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
    <script src="{{ asset('admin_source/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('admin_source/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin_source/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin_source/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    {{-- <script src="{{ asset('admin_source/js/charts-home.js') }}"></script> --}}
    <!-- Main File-->
    <script src="{{ asset('admin_source/js/front.js') }}"></script>
    <script src="{{ asset('tinymce/tinymce.js') }}"></script>
    <script src="{{ asset('tinymce/config.js') }}"></script>
    @yield('script')
    @if (Session::has('success'))
        <script>
            toastr.success('{{ Session::get('success') }}');
        </script>
    @endif
</body>
</html>
