<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset($display->favicon) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($display->favicon) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset($display->favicon) }}">

    <title>@yield('title')</title>
    <meta name="robots" content="index,follow">
    <meta name="description" content="@yield('meta_desc')">
    <meta name="keywords" content="@yield('meta_keyword')">

    <meta property="og:title" content="@yield('title')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $configGeneral->name }}">
    <meta property="og:description" content="@yield('meta_desc')">
    <meta property="og:type" content="website">
    <meta property="og:image" content="@yield('og_image', asset($display->favicon))">
    <meta property="og:image:url" content="@yield('og_image_url', asset($display->favicon))">
    <meta property="og:image:type" content="@yield('og_image_type', 'image/png')">

    <meta name="twitter:card" content="summary_large_image">
    
    <meta name="google-site-verification" content="_fMYTmAg2O0X00yJznvGMl2XY7NrKtF3lcWKMCUmdtM" />

    <link rel="canonical" href="{{ request()->getSchemeAndHttpHost() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_source/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/mmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/footer.css') }}">
    @livewireStyles
    @yield('css')
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <div id="page">

        @include('partials.frontend.header')
        @include('partials.frontend.menu')

        <div class="container-fluid">
            @yield('content')
        </div>

        @include('partials.frontend.footer')

    </div>
    @if (Session::has('success'))
        <script>
            toastr.success('{{ Session::get('success') }}');
        </script>
    @endif
    <script>

        document.addEventListener(
            "DOMContentLoaded", () => {
                const menu = new Mmenu( "#menu", {
                   "extensions": [
                      "pagedim-black",
                      "theme-dark"
                   ],
                   "counters": true
                }, {
                    offCanvas: {
                        clone: true,
                        page: {
                            selector: "#page"
                        }
                    }
                });
            }
        );
    </script>
    @livewireScripts
    @yield('js')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-186926835-1">
    </script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-186926835-1');
    </script>

</body>
</html>
