<!DOCTYPE html>
<head lang="{{ app()->getLocale() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

   <!-- css -->
   <link rel="stylesheet" href="{{ asset('css/bootstrap-4.0.0-dist/bootstrap.min.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('css/bootstrap-4.0.0-dist/bootstrap-grid.min.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('css/bootstrap-4.0.0-dist/bootstrap-reboot.min.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('css/bootstrap-4.0.0-dist/bootstrap-reboot.min.css') }}" type="text/css">
   <script type="text/javascript" src="{{ asset('js/bootstrap-4.0.0-dist/bootstrap.min.js') }}"></script>
  

</head>
<body>
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div id="app">
                    @yield('content')
                </div>
            </section>
        </div>
    </div>
    <!-- Scripts -->
    @yield('script')

    <script type="text/javascript" defer src="{{ asset('../web/public/js/jquery-3.3.1/jquery-3.3.1.slim.min.js') }}"></script>
    <script type="text/javascript" defer src="{{ asset('../web/public/js/tether.min.js') }}"></script>
    <script type="text/javascript" defer src="{{ asset('../web/public/js/bootstrap-4.0.0-alpha.6-dist/bootstrap.min.js') }}"></script>
    <script type="text/javascript" defer src="{{ asset('../web/public/fonts/fontawesome-free-5.0.6/svg-with-js/js/fontawesome-all.js') }}"></script>
    <script type="text/javascript" defer src="{{ asset('../web/public/js/app.js') }}"></script>
</body>
</html>
