@extends('layouts.app')
@section('title', 'Page Title')
@section('breadcrumbs')
{{ Breadcrumbs::render('edit_settinguser', $result['data']->personal_code) }}
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
                <h1 class="page-header"><i class="fas fa-edit"></i> แก้ไขข้อมูลสมาชิก</h1>
            </div>
        </div>
    </div>
    {{ Form::open(['route' => ['pages.settinguser.update', 'id' => $result['data']->personal_code], 'method' => 'PATCH', 'id' => 'my_form', 'enctype' => 'multipart/form-data']) }}
        <div class="row">
            <div class="col-md-2 col-lg-2">
                <div class="col-md-1 offset-md-1 col-lg-1 offset-lg-1">
                    <div style="width: 125px; height: 130px; background: gray; padding-left: 2px; padding-top: 2px;margin-left:30px;">
                        <span class="profile-picture">
                            <img src="" id="img_logo">
                        </span>
                    </div>
                    <div style="padding-left: 10px; padding-top: 5px;">
                        <div class="upload-file">
                            {{ Form::button('<i class="fa fa-camera"></i> อัพโหลดรูปสมาชิก', ['class' => 'btn btn-warning btn-xs']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-lg-10">
                <div class="form-group row">
                    <div class="col-md-2 col-lg-2">
                        {{ Form::label('personal_title_name', 'คำนำหน้าชื่อ', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_title_name', !empty($result['data']->personal_title_name) ? $result['data']->personal_title_name : old('personal_title_name'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                    </div>
            
                    <div class="col-md-4 col-lg-4">
                        {{ Form::label('personal_first_name', 'ชื่อ', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_first_name', !empty($result['data']->personal_first_name) ? $result['data']->personal_first_name : old('personal_first_name'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                    </div>
                    
                    <div class="col-md-4 col-lg-4">
                        {{ Form::label('personal_last_name', 'นามสกุล', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_last_name', !empty($result['data']->personal_last_name) ? $result['data']->personal_last_name : old('personal_last_name'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                    </div>
                </div>
                @if ($errors->has('personal_title_name') || $errors->has('personal_first_name') || $errors->has('personal_last_name'))
                    <div class="form-group row">
                        <div class="col-md-2 col-lg-2 validate-danger">
                            {{ $errors->first('personal_title_name') }}
                        </div>
                        <div class="col-md-4 col-lg-4 validate-danger">
                            {{ $errors->first('personal_first_name') }}
                        </div>
                        <div class="col-md-4 col-lg-4 validate-danger">
                            {{ $errors->first('personal_last_name') }}
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <div class="col-md-6 col-lg-6">
                        {{ Form::label('personal_citizen_id', 'เลขบัตรประชาชน', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_citizen_id', !empty($result['data']->personal_citizen_id) ? $result['data']->personal_citizen_id : old('personal_citizen_id'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", 'readonly'=> 'true']) }}
                    </div>

                    <div class="col-md-4 col-lg-4">
                        {{ Form::label('personal_tel_id', 'เบอร์โทรศัพท์', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_tel_id', !empty($result['data']->contact['personal_tel_id']) ? $result['data']->contact['personal_tel_id'] : old('personal_tel_id'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                    </div>
                </div>
                @if ($errors->has('personal_citizen_id'))
                    <div class="form-group row">
                        <div class="col-md-6 col-lg-6 validate-danger">
                            {{ $errors->first('personal_citizen_id') }}
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <div class="col-md-2 col-lg-2">
                        {{ Form::label('personal_adr', 'บ้านเลขที่', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_adr', !empty($result['data']->address['personal_adr']) ? $result['data']->address['personal_adr'] : old('personal_adr'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                    </div>
                    
                    <div class="col-md-3 col-lg-3">
                        {{ Form::label('personal_moo', 'หมู่ที่', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_moo', !empty($result['data']->address['personal_moo']) ? $result['data']->address['personal_moo'] : old('personal_moo'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                    </div>

                    <div class="col-md-2 col-lg-2">
                        {{ Form::label('personal_soi', 'ตรอก/ซอย', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_soi', !empty($result['data']->address['personal_soi']) ? $result['data']->address['personal_soi'] : old('personal_soi'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                    </div>

                    <div class="col-md-3 col-lg-3">
                        {{ Form::label('personal_road', 'ถนน', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_road', !empty($result['data']->address['personal_road']) ? $result['data']->address['personal_road'] : old('personal_road'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="border-bottom: 1px solid #F44336;padding-bottom: 9px;"></div>
                </div>
            </div>
            <div class="row">
                <div class="offset-md-9 offset-lg-8">
                    {{ Form::button('<i class="fas fa-hand-point-left"></i> ย้อนกลับ', ['class' => 'btn btn-lg btn-info', 'style' => 'margin-top:10px;', 'onclick' => "location='".route('pages.settinguser.index')."'"]) }}
                    {{ Form::button('<i class="fas fa-save"></i> บันทึกข้อมูล', ['class' => 'btn btn-lg btn-success', 'style' => 'margin-top:10px;', 'type' => 'submit']) }}
                </div>
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