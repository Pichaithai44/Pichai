@extends('layouts.app')
@section('title', 'Set up the system')
@section('breadcrumbs')
{{ Breadcrumbs::render('settingsystem') }}
@endsection
@section('content')
@if (session('status'))
    <div class="alert {{ session('result') ? 'alert-success' : 'alert-danger' }}" role="alert">
        <strong>{{ session('status') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <h1 class="page-header"><i class="fas fa-cogs"></i> ตั้งค่าระบบ</h1>
                </div>
            </div>
        </div>
        {{ Form::open(['route' => 'pages.settingsystem.store', 'method' => 'PATCH', 'id' => 'my_form', 'enctype' => 'multipart/form-data']) }}
            <div class="row">
                <div class="col-md-10 offset-md-2 col-lg-10 offset-lg-2">
                    <div class="form-group row">
                        <div class="col-md-4 col-lg-4">
                            {{ Form::label('pawn_name', 'ชื่อโรงรับจำนำ', ['class' => 'col-form-label-lg']) }}
                            {{ Form::text('pawn_name', !empty($result['data']['pawn_name']) ? $result['data']['pawn_name'] : old('pawn_name'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-lg-3">
                            {{ Form::label('adr', 'บ้านเลขที่', ['class' => 'col-form-label-lg']) }}
                            {{ Form::text('adr', !empty($result['data']['info']['adr']) ? $result['data']['info']['adr'] : old('adr'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                        </div>
                
                        <div class="col-md-3 col-lg-3">
                            {{ Form::label('moo', 'หมู่ที่', ['class' => 'col-form-label-lg']) }}
                            {{ Form::text('moo', !empty($result['data']['info']['moo']) ? $result['data']['info']['moo'] : old('moo'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                        </div>
                        
                        <div class="col-md-3 col-lg-3">
                            {{ Form::label('soi', 'ตรอก/ซอย', ['class' => 'col-form-label-lg']) }}
                            {{ Form::text('soi', !empty($result['data']['info']['soi']) ? $result['data']['info']['soi'] : old('soi'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                        </div>

                        <div class="col-md-3 col-lg-3">
                            {{ Form::label('road', 'ถนน', ['class' => 'col-form-label-lg']) }}
                            {{ Form::text('road', !empty($result['data']['info']['road']) ? $result['data']['info']['road'] : old('road'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-lg-3">
                            {{ Form::label('sub_district', 'แขวง/ตำบล', ['class' => 'col-form-label-lg']) }}
                            {{ Form::text('sub_district', !empty($result['data']['info']['sub_district']) ? $result['data']['info']['sub_district'] : old('sub_district'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                        </div>

                        <div class="col-md-3 col-lg-3">
                            {{ Form::label('district', 'อำเภอ/เขต', ['class' => 'col-form-label-lg']) }}
                            {{ Form::text('district', !empty($result['data']['info']['district']) ? $result['data']['info']['district'] : old('district'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                        </div>

                        <div class="col-md-3 col-lg-3">
                        {{ Form::label('province', 'จังหวัด', ['class' => 'col-form-label-lg']) }}
                            {{ Form::text('province', !empty($result['data']['info']['province']) ? $result['data']['info']['province'] : old('province'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                        </div>

                        <div class="col-md-3 col-lg-3">
                            {{ Form::label('postal_code', 'รหัสไปราณีย์', ['class' => 'col-form-label-lg']) }}
                            {{ Form::text('postal_code', !empty($result['data']['info']['postal_code']) ? $result['data']['info']['postal_code'] : old('postal_code'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-3 col-lg-3">
                            {{ Form::label('tel', 'เบอร์โทรศัพท์', ['class' => 'col-form-label-lg']) }}
                            {{ Form::text('tel', !empty($result['data']['contact']['tel']) ? $result['data']['contact']['tel'] : old('tel'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div style="border-bottom: 1px solid #F44336;padding-bottom: 9px;"></div>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-10 offset-lg-10">
                    {{ Form::button('<i class="fas fa-save"></i> บันทึกข้อมูล', ['class' => 'btn btn-lg btn-success', 'style' => 'margin-top:10px;', 'type' => 'submit']) }}
                </div>
            </div>
        {{ Form::close() }}
    </div>
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