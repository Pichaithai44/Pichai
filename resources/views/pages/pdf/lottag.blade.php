<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ ltrim(elixir('css/bootstrap-4.0.0-dist/bootstrap.min.css'), '/') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ ltrim(elixir('css/pdf-lottag.css'), '/') }}" />
        <title>Production Line</title>
        @include('layouts.mater')
    </head>

    <body>
    <div class="container-fluid">
        <div class="row form-group">
            <div class="col-4 pdf-lottag-border">
                <img src="img/logo.png" class="pdf-lottag-logo">
            </div>
            <div class="col-4 pdf-lottag-border">
                YAMATO MANUFACTURING CO.,LTD.
            </div>
            <div class="col-4 pdf-lottag-border">
                PHOTO / CHECK POINT
            </div>
        </div>
    </div>
    </body>
    <script>
        function submit(){
            document.getElementById('my_form').submit();
        }
    </script>
</html>
