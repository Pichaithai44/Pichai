<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        @include('layouts.mater')
    </head>
    <body class="root hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
     
            @section('sidebar')
                @include('layouts.header')
                @include('layouts.sidebar')
            @show
            <div class="content-wrapper">
                @yield('breadcrumbs')
                <section class="content-header">
                    <h1>
                        <h3>
                            @yield('list')
                        </h3>
                    </h1>
                </section>

                <section class="content">
                    @yield('content')
                </section>
            </div>
            @include('layouts.footer')
        </div>
    </body>
    @yield('script_upload') 
    @yield('script')    
</html>