@extends('layouts.app')
@section('title', 'Page Title')
@section('breadcrumbs')
{{ Breadcrumbs::render('create_pledge') }}
@endsection
@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header"><i class="fas fa-plus"></i> เพิ่มสินค้า</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            @include('uploadfile')
        </div>
        <div class="col-md-9 col-lg-9">
            {{ Form::open(['route' => 'pages.pledge.store', 'method' => 'PATCH', 'id' => 'my_form', 'enctype' => 'multipart/form-data']) }}
                {{ Form::hidden('personal_code', old('personal_code') , []) }}
                {{ Form::hidden('path', old('path'), []) }}
                {{ Form::hidden('file_code', old('file_code'), []) }}
                <div class="form-group row">
                    <div class="col-md-6">
                        {{ Form::label('personal_citizen_id', 'เลขบัตรประชาชน', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_citizen_id', old('personal_citizen_id'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                    </div>
                </div>
                <div class="row form-group">
                    <small class="col-md-8 label-control"><i>- กรอกหมายเลขบัตรประชาชนและค้นหา</i></small>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        {{ Form::label('personal_title_name', 'คำนำหน้าชื่อ', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_title_name', old('personal_title_name'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>
            
                    <div class="col-md-4 offset-md-1">
                        {{ Form::label('personal_first_name', 'ชื่อ', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_first_name', old('personal_first_name'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>
                    
                    <div class="col-md-4">
                        {{ Form::label('personal_last_name', 'นามสกุล', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_last_name', old('personal_last_name'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{ Form::label('product_name', 'ชื่อสินค้า', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('product_name', old('product_name'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>

                    <div class="col-md-4">
                        {{ Form::label('product_detail', 'รายละเอียด', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('product_detail', old('product_detail'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>

                    <div class="col-md-4">
                        {{ Form::label('product_start_date', 'วันที่ทำสัญญา', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text(null, old('product_start_date'), ['class' => 'form-control form-control-lg daterangepicker', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true, 'def-date' => "product_start_date"]) }}
                        {{ Form::hidden('product_start_date', old('product_start_date'), []) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                    {{ Form::label('product_capital', 'จำนวนเงินสินค้า', ['class' => 'col-form-label-lg']) }}
                        <div class="input-group">
                            {{ Form::text('product_capital', old('product_capital'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                            <div class="input-group-prepend">
                                <div class="input-group-text">บาท</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        {{ Form::label('product_interest', 'ดอกเบี้ย', ['class' => 'col-form-label-lg']) }}
                        <div class="input-group">
                            {{ Form::text('product_interest', old('product_interest'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                            <div class="input-group-prepend">
                                <div class="input-group-text">%</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 offset-md-1">
                        {{ Form::label('product_end_date', 'วันที่ครบกำหนด', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text(null, old('product_end_date'), ['class' => 'form-control form-control-lg daterangepicker', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true, 'def-date' => "product_end_date"]) }}
                        {{ Form::hidden('product_end_date', old('product_end_date'), []) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div style="border-bottom: 1px solid #F44336;padding-bottom: 9px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-10">
                        {{ Form::button('<i class="fas fa-hand-point-left"></i> ย้อนกลับ', ['class' => 'btn btn-lg btn-info', 'style' => 'margin-top:10px;', 'onclick' => "location='".route('pages.pledge.index')."'"]) }}
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

        $(function()
        {
            $( "#personal_citizen_id" ).autocomplete({
                source: "{{ route('pages.pledge.autocomplete') }}",
                minlenght:1,
                autoFocus:true,
                select: function(event, ui) {
                    var form = $("#my_form");
                        form.find("input[name='personal_code']").val(ui.item.personal_code);
                        form.find("input[name='personal_title_name']").val(ui.item.personal_title_name);
                        form.find("input[name='personal_first_name']").val(ui.item.personal_first_name);
                        form.find("input[name='personal_last_name']").val(ui.item.personal_last_name);
                        form.find("input[name='personal_citizen_id']").val(ui.item.value);

                        form.find("input[name='product_name']").prop("readonly", false);
                        form.find("input[name='product_detail']").prop("readonly", false);
                        form.find("input[name='product_start_date']").prop("readonly", false);
                        form.find("input[name='product_capital']").prop("readonly", false);
                        form.find("input[name='product_interest']").prop("readonly", false);
                        form.find("input[name='product_end_date']").prop("readonly", false);
                }
            });

            $(".daterangepicker").daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "autoApply": true,
                "locale": {
                    "format": "YYYY-MM-DD",
                    "separator": " - ",
                    "applyLabel": "Apply",
                    "cancelLabel": "Cancel",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
                    "monthNames": ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
                    "firstDay": 1
                },
                "linkedCalendars": false,
                "showCustomRangeLabel": false,
                "startDate": new Date(),
            }, function(start, end, label) {}).change(function () {
                $(`input[name='${$(this).attr("def-date")}']`).val($(this).val());
            });
        });
    </script>
@endsection

