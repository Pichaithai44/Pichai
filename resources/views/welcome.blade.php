<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <title>YAMATO MANUFACTURING CO.,LTD.</title>
        @include('layouts.mater')
    </head>
        
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
                @include('layouts.header')
                @include('layouts.sidebar')
                  <!-- Content Wrapper. Contains page content -->
                    <div class="content-wrapper">
                            <!-- Content Header (Page header) -->
                            <section class="content-header">
                            <h1>
                                Dashboard
                                <small>Control panel</small>
                            </h1>
                            </section>
                        
                            <!-- Main content -->
                            <section class="content">

                            </section>
                            <!-- /.content -->
                        </div>
                @include('layouts.footer')
        </div>
    </body>
</html>
