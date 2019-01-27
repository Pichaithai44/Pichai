@extends('layouts.app')
@section('title', 'PAWN')
@section('breadcrumbs')
{{ Breadcrumbs::render('edit_pledge', $result['data']->product_code) }}
@endsection
@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header"><i class="fas fa-list"></i> รายการชำระค่างวด</h1>
            </div>
        </div>
   
        <div class="row">
            <div class="col-md-3 col-lg-3">
                @include('uploadfile')
            </div>
        <div class="col-md-9 col-lg-9">
            {{ Form::open(['route' => ['pages.pledge.update', 'id' => $result['data']->product_code], 'method' => 'PATCH', 'id' => 'my_form', 'enctype' => 'multipart/form-data']) }}
                {{ Form::hidden('path', !empty($result['data']->path) ? $result['data']->path : old('path'), []) }}
                {{ Form::hidden('file_code', !empty($result['data']->file_code) ? $result['data']->file_code : old('file_code'), []) }}
                {{ Form::hidden('product_code', !empty($result['data']->product_code) ? $result['data']->product_code : old('product_code'), []) }}
                {{ Form::hidden('personal_code', !empty($result['data']->personal_code) ? $result['data']->personal_code : old('personal_code'), []) }}
                <div class="form-group row">
                    <div class="col-md-6">
                        {{ Form::label('personal_citizen_id', 'เลขบัตรประชาชน', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_citizen_id', !empty($result['data']->personal_citizen_id) ? $result['data']->personal_citizen_id : old('personal_citizen_id'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>

                    <div class="col-md-2 offset-md-2">
                        {{ Form::label('product_slip_no', 'เลขตั๋วจำนำ', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('product_slip_no', !empty($result['data']->product_slip_no) ? $result['data']->product_slip_no : old('product_slip_no'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        {{ Form::label('personal_title_name', 'คำนำหน้าชื่อ', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_title_name', !empty($result['data']->personal_title_name) ? $result['data']->personal_title_name : old('personal_title_name'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>
            
                    <div class="col-md-4 offset-md-1">
                        {{ Form::label('personal_first_name', 'ชื่อ', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_first_name', !empty($result['data']->personal_first_name) ? $result['data']->personal_first_name : old('personal_first_name'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>
                    
                    <div class="col-md-4">
                        {{ Form::label('personal_last_name', 'นามสกุล', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('personal_last_name', !empty($result['data']->personal_last_name) ? $result['data']->personal_last_name : old('personal_last_name'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{ Form::label('product_name', 'ชื่อสินค้า', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('product_name', !empty($result['data']->product_name) ? $result['data']->product_name : old('product_name'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>

                    <div class="col-md-4">
                        {{ Form::label('product_detail', 'รายละเอียด', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('product_detail', !empty($result['data']->product_detail) ? $result['data']->product_detail : old('product_detail'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>

                    <div class="col-md-4">
                        {{ Form::label('product_start_date', 'วันที่ทำสัญญา', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('product_start_date', !empty($result['data']->product_start_date) ? $result['data']->product_start_date : old('product_start_date'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                    {{ Form::label('product_capital', 'จำนวนเงินสินค้า', ['class' => 'col-form-label-lg']) }}
                        <div class="input-group">
                            {{ Form::text('product_capital', !empty($result['data']->product_capital) ? $result['data']->product_capital : old('product_capital'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                            <div class="input-group-prepend">
                                <div class="input-group-text">บาท</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                    {{ Form::label('product_interest', 'ดอกเบี้ย', ['class' => 'col-form-label-lg']) }}
                        <div class="input-group">
                            {{ Form::text('product_interest', !empty($result['data']->product_interest) ? $result['data']->product_interest : old('product_interest'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                            <div class="input-group-prepend">
                                <div class="input-group-text">%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3 ">
                        {{ Form::label('due_date', 'วันที่ครบกำหนด', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('due_date', !empty($result['data']->product_end_date) ? $result['data']->product_end_date : old('product_end_date'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                    </div>

                    <div class="col-md-3 offset-md-1">
                        {{ Form::label('date_payment', 'วันที่ชำระ', ['class' => 'col-form-label-lg']) }}
                        {{ Form::text('date_payment', old('date_payment'), ['class' => 'form-control form-control-lg daterangepicker', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off"]) }}
                    </div>

                    <div class="col-md-3 offset-md-1">
                    {{ Form::label('interest_payment', 'ดอกเบี้ยต่องวด', ['class' => 'col-form-label-lg']) }}
                        <div class="input-group">
                            {{ Form::text('interest_payment', !empty($result['data']->interest_payment) ? $result['data']->interest_payment : old('interest_payment'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                            <div class="input-group-prepend">
                                <div class="input-group-text">บาท</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        {{ Form::label('payment_type', 'ประเภทการจ่าย', ['class' => 'col-form-label-lg']) }}
                        {{ Form::select('payment_type', ['interest_payment' => 'ชำระ : ดอกเบี้ย', 'pay_all_balances' => 'ชำระ : ทั้งหมด'], 'interest_payment', ['class' => 'form-control form-control-lg']) }}
                    </div>

                    <div class="col-md-4 offset-md-1">
                    {{ Form::label('debt_payment', 'จำนวนเงินที่ชำระ', ['class' => 'col-form-label-lg']) }}
                        <div class="input-group">
                            {{ Form::text('debt_payment', !empty($result['data']->interest_payment) ? $result['data']->interest_payment : old('debt_payment'), ['class' => 'form-control form-control-lg', 'placeholder' => 'กรุณาระบุข้อมูล', 'autocomplete' => "off", "readonly" => true]) }}
                            <div class="input-group-prepend">
                                <div class="input-group-text">บาท</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-sm table-striped">
                            <thead>
                                <tr class="text-center table-tr-web">
                                    <th scope="row" width="15%">วันที่งวดสินค้า</th>
                                    <th scope="row" width="15%">วันที่จ่าย</th>
                                    <th scope="row" width="15%">ประเภทการจ่าย</th>
                                    <th scope="row" width="15%">จำนวนเงิน</th>
                                    <th scope="row" width="15%">วันที่ทำรายการ</th>
                                    <th scope="row" width="15%">ผู้ทำรายการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($result['data_arr']->items() as $key => $item)
                                <tr class="text-center">
                                    <td scope="col">{{ $key + 1 }}</td>
                                    <td scope="col">{{ date('y-m-d', strtotime($item->date_payment)) }}</td>
                                    <td scope="col">{{ $item->payment_type }}</td>
                                    <td scope="col">{{ $item->debt_payment }}</td>
                                    <td scope="col">{{ date('y-m-d', strtotime($item->created_at)) }}</td>
                                    <td scope="col">{{ $item->created_by }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="zoneone navigation page">
                            <ul class="pagination justify-content-end">
                                <li class="page-item {{ $result['data_arr']->currentPage() == 1 ? 'disabled' : null }}"><a class="page-link {{ $result['data_arr']->currentPage() == 1 ? 'bg-grey-300' : null }}" href="{{ $result['data_arr']->url(1) }}"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
                                <li class="page-item {{ $result['data_arr']->currentPage() == 1 ? 'disabled' : null }}"><a class="page-link {{ $result['data_arr']->currentPage() == 1 ? 'bg-grey-300' : null }}" href="{{ $result['data_arr']->previousPageUrl() }}"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                                <?php 
                                    $c = floor(($result['data_arr']->currentPage()/5));
                                    $k = ($c*5 != 0) ? $c*5 : 1;
                                    $n = ($c*5 != 0) ? 5+($c*5) : 5;
                                ?>
                                @for($i = $k;$i <= ($result['data_arr']->lastPage() >5 ? $n : $result['data_arr']->lastPage());$i++)
                                    <li class="page-item {{ $result['data_arr']->currentPage() == $i ? 'active' : null }}"><a class="page-link" href="{{ $result['data_arr']->url($i) }}" style="font-size: 0.8rem;">{{ $i }}</a></li>
                                @endfor
                                <li class="page-item {{ $result['data_arr']->currentPage() == $result['data_arr']->lastPage() ? 'disabled' : null }}"><a class="page-link {{ $result['data_arr']->currentPage() == $result['data_arr']->lastPage() ? 'bg-grey-300' : null }}" href="{{ $result['data_arr']->nextPageUrl() }}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                <li class="page-item {{ $result['data_arr']->currentPage() == $result['data_arr']->lastPage() ? 'disabled' : null }}"><a class="page-link {{ $result['data_arr']->currentPage() == $result['data_arr']->lastPage() ? 'bg-grey-300' : null }}" href="{{ $result['data_arr']->url($result['data_arr']->lastPage()) }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div style="border-bottom: 1px solid #F44336;padding-bottom: 9px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-lg-5 offset-md-9 offset-lg-7">
                        {{ Form::button('<i class="fas fa-hand-point-left"></i> ย้อนกลับ', ['class' => 'btn btn-lg btn-info', 'style' => 'margin-top:10px;', 'onclick' => "location='".route('pages.pledge.index')."'"]) }}
                        @if(intval($result['data']->pay_all_balances) > 0)
                        {{ Form::button('<i class="fas fa-save"></i> บันทึกข้อมูล', ['class' => 'btn btn-lg btn-success', 'style' => 'margin-top:10px;', 'type' => 'submit']) }}
                        @endif
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

        var interest_payment = "{{ !empty($result['data']->interest_payment) ? $result['data']->interest_payment : 0 }}";
        var pay_all_balances = "{{ !empty($result['data']->pay_all_balances) ? $result['data']->pay_all_balances : 0 }}";

        $("select[name='payment_type']").on('change', function () {

            if($(this).find(":selected").val() == "interest_payment") {
                $("input[name='debt_payment']").val(interest_payment);
            } else if($(this).find(":selected").val() == "pay_all_balances") {
                $("input[name='debt_payment']").val(pay_all_balances);
            }
        });

        $(function()
        {

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