@extends('layouts.app')
@section('title', 'PAWN')
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
    <div class="row">
        <div class="col-md-3 col-lg-3">
            @include('uploadfile')
        </div>
        <div class="col-md-9 col-lg-9">
            {{ Form::open(['route' => ['pages.settinguser.update', 'id' => $result['data']->personal_code], 'method' => 'PATCH', 'id' => 'my_form', 'enctype' => 'multipart/form-data']) }}
                {{ Form::hidden('path', !empty($result['data']->path) ? $result['data']->path : old('path'), []) }}
                {{ Form::hidden('file_code', !empty($result['data']->file_code) ? $result['data']->file_code : old('file_code'), []) }}
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
                        {{ Form::text('personal_citizen_id', !empty($result['data']->personal_citizen_id) ? $result['data']->personal_citizen_id : old('personal_citizen_id'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", 'readonly'=> 'true', 'maxlength' => 13]) }}
                    </div>

                    <div class="col-md-4 col-lg-4">
                        {{ Form::label('personal_tel_id', 'เบอร์โทรศัพท์', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_tel_id', !empty($result['data']->contact['personal_tel_id']) ? $result['data']->contact['personal_tel_id'] : old('personal_tel_id'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", 'maxlength' => 10]) }}
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
                    <div class="col-md-12 col-lg-12">
                        <div style="border-bottom: 1px solid #F44336;padding-bottom: 9px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-lg-5 offset-md-9 offset-lg-7">
                        {{ Form::button('<i class="fas fa-hand-point-left"></i> ย้อนกลับ', ['class' => 'btn btn-lg btn-info', 'style' => 'margin-top:10px;', 'onclick' => "location='".route('pages.settinguser.index')."'"]) }}
                        {{ Form::button('<i class="fas fa-save"></i> บันทึกข้อมูล', ['class' => 'btn btn-lg btn-success', 'style' => 'margin-top:10px;', 'type' => 'submit']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
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

        // Restricts input for the given textbox to the given inputFilter.
        function setInputFilter(textbox, inputFilter) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                if(textbox) {
                    textbox.addEventListener(event, function() {
                        if (inputFilter(this.value)) {
                            this.oldValue = this.value;
                            this.oldSelectionStart = this.selectionStart;
                            this.oldSelectionEnd = this.selectionEnd;
                        } else if (this.hasOwnProperty("oldValue")) {
                            this.value = this.oldValue;
                            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                        }
                    });
                }
            });
        }

        // Restrict input to digits and '.' by using a regular expression filter.

        // Integer values (both positive and negative):
        // /^-?\d*$/.test(value)
        // Integer values (positive only):
        // /^\d*$/.test(value)
        // Integer values (positive and up to a particular limit):
        // /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500)
        // Floating point values (allowing both . and , as decimal separator):
        // /^-?\d*[.,]?\d*$/.test(value)
        // Currency values (i.e. at most two decimal places):
        // /^-?\d*[.,]?\d{0,2}$/.test(value)
        // Hexadecimal values:
        // /^[0-9a-f]*$/i.test(value)
        // return /^\d*\.?\d*$/.test(value);

        setInputFilter(document.getElementById("personal_citizen_id"), function(value) {
            return /^\d*$/.test(value);
        });
        setInputFilter(document.getElementById("personal_tel_id"), function(value) {
            return /^\d*$/.test(value);
        });
    </script>
@endsection