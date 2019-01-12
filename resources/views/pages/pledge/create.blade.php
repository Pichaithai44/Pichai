@extends('layouts.app')
@section('title', 'Page Title')
@section('list', 'นำของเข้าระบบ')
@section('breadcrumbs')
{{ Breadcrumbs::render('create_pledge') }}
@endsection
@section('content')
<div class="container form-control">
    <form action="{{ route('pages.pledge.store') }}" id="my_form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <input type="hidden" name="personal_code" id="personal_code">
        <div class="form-group row">
            <label class="col-2 col-form-label col-form-label-sm">ชื่อ-นามสกุล</label>
            <div class="col-3">
                <input class="form-control form-control-sm text-left" type="text" name="pledge" id="pledge" value="{{ old('pledge') }}">
            </div>
            <label class="col-3 col-form-label col-form-label-sm">เลขบัตรประจำตัวประชาชน</label>
            <div class="col-4">
                <input class="form-control form-control-sm text-left" type="text" name="personal_citizen_id" id="personal_citizen_id" value="{{ old('personal_citizen_id') }}" readonly>
            </div>
        </div>
        @if ($errors->has('pledge'))
            <div class="form-group row">
                <div class=" offset-2 col-3 validate-danger">
                    {{ $errors->first('pledge') }}
                </div>
            </div>
        @endif
        @if ($errors->has('personal_citizen_id'))
            <div class="form-group row">
                <div class=" offset-2 col-3 validate-danger">
                    {{ $errors->first('personal_citizen_id') }}
                </div>
            </div>
        @endif
        @if ($errors->has('personal_code'))
            <div class="form-group row">
                <div class=" offset-2 col-3 validate-danger">
                    {{ $errors->first('personal_code') }}
                </div>
            </div>
        @endif
        <div class="form-group row">
            <label class="col-2 col-form-label col-form-label-sm">product_num</label>
            <div class="col-2">
                <input class="form-control form-control-sm text-left" type="text" name="product_num" id="product_num" value="{{ old('product_num') }}">
            </div>
            <label class="col-2 col-form-label col-form-label-sm">date_payment</label>
            <div class="col-2">
                <input class="form-control form-control-sm text-left" type="text" name="date_payment" id="date_payment" value="{{ old('date_payment') }}">
            </div>
            <label class="col-2 col-form-label col-form-label-sm">slip_no</label>
            <div class="col-2">
                <input class="form-control form-control-sm text-left" type="text" name="slip_no" id="slip_no" value="{{ old('slip_no') }}">
            </div>
        </div>
        @if ($errors->has('product_num') || $errors->has('date_payment') || $errors->has('slip_no'))
            <div class="form-group row">
                <div class=" offset-3 col-2 validate-danger">
                    {{ $errors->first('product_num') }}
                </div>
                <div class=" offset-1 col-2 validate-danger">
                    {{ $errors->first('date_payment') }}
                </div>
                <div class=" offset-1 col-2 validate-danger">
                    {{ $errors->first('slip_no') }}
                </div>
            </div>
        @endif
        
        <div class="form-group row">
            <label class="col-2 col-form-label col-form-label-sm">capital</label>
            <div class="col-3">
                <input class="form-control form-control-sm text-left" type="text" name="capital" id="capital" value="{{ old('capital') }}">
            </div>
            <label class="col-1 col-form-label col-form-label-sm">interest</label>
            <div class="col-2">
                <input class="form-control form-control-sm text-left" type="text" name="interest" id="interest" value="{{ old('interest') }}">
            </div>
        </div>
        @if ($errors->has('interest'))
            <div class="form-group row">
                <div class=" offset-2 col-3 validate-danger">
                    {{ $errors->first('interest') }}
                </div>
                <div class=" offset-1 col-2 validate-danger">
                    {{ $errors->first('interest') }}
                </div>
            </div>
        @endif
        <div class="form-group row">
            <div class="offset-2 col-3 checkbox">
                <label class="col-form-label col-form-label-sm">
                    <input type="hidden" name="is_active" value="0"/>
                    <input type="checkbox" name="is_active" value="1" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="55" data-height="25" {{ old('interest') ? "checked" : "" }} />
                    สถานะ
                </label>
            </div>
        </div>
      
    </form>
    <div class="row">
        <div class="offset-2 col-10">
            <div class="btn-group" role="group" aria-label="btn-group">
                <button class="btn btn-sm" onclick="location='{{ route('welcome') }}'">กลับ</button>
                <button type="submit" class="btn btn-sm btn-primary" onclick="submit()" id="save">บันทึก</button>
            </div>
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
            $( "#pledge" ).autocomplete({
                source: "{{ route('pages.pledge.autocomplete') }}",
                minlenght:1,
                autoFocus:true,
                select: function(event, ui) {
                    $('#personal_code').val(ui.item.personal_code);
                    $('#personal_citizen_id').val(ui.item.personal_citizen_id);
                }
            });
        });
    </script>
@endsection

