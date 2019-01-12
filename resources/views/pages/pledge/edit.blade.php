@extends('layouts.app')
@section('title', 'Page Title')
@section('list', 'ชำระค่างวด')
@section('content')

@endsection
@section('script')
    <script>
        function submit(){
            document.getElementById('my_form').submit();
        }
        $(document).ready(function() {
            $( "div.alert-success" ).slideUp(600);
        });
    </script>
@endsection