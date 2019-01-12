@extends('layouts.app')
@section('title', 'Page Title')
@section('list', 'รายการเพิ่มข้อมูลลูกค้า')
@section('breadcrumbs')
{{ Breadcrumbs::render('create_user') }}
@endsection
@section('content')
<div class="container form-control">
    <form action="{{ route('pages.settinguser.store') }}" id="my_form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group row">
            <label class="col-3 col-form-label col-form-label-sm">คำนำหน้า</label>
            <div class="col-2">
                <input class="form-control form-control-sm text-left" type="text" name="personal_title_name" id="personal_title_name" value="{{ old('personal_title_name') }}">
            </div>
            <label class="col-1 col-form-label col-form-label-sm">ชื่อ</label>
            <div class="col-2">
                <input class="form-control form-control-sm text-left" type="text" name="personal_first_name" id="personal_first_name" value="{{ old('personal_first_name') }}">
            </div>
            <label class="col-1 col-form-label col-form-label-sm">นามสกุล</label>
            <div class="col-2">
                <input class="form-control form-control-sm text-left" type="text" name="personal_last_name" id="personal_last_name" value="{{ old('personal_last_name') }}">
            </div>
        </div>
        @if ($errors->has('personal_title_name') || $errors->has('personal_first_name') || $errors->has('personal_last_name'))
            <div class="form-group row">
                <div class=" offset-3 col-2 validate-danger">
                    {{ $errors->first('personal_title_name') }}
                </div>
                <div class=" offset-1 col-2 validate-danger">
                    {{ $errors->first('personal_first_name') }}
                </div>
                <div class=" offset-1 col-2 validate-danger">
                    {{ $errors->first('personal_last_name') }}
                </div>
            </div>
        @endif
        
        <div class="form-group row">
            <label class="col-2 col-form-label col-form-label-sm">เลขที่บัตรประจำตัวประชาขน</label>
            <div class="col-3">
                <input class="form-control form-control-sm text-left" type="text" name="personal_citizen_id" id="personal_citizen_id" value="{{ old('personal_citizen_id') }}">
            </div>
        </div>
        @if ($errors->has('personal_citizen_id'))
            <div class="form-group row">
                <div class=" offset-2 col-3 validate-danger">
                    {{ $errors->first('personal_citizen_id') }}
                </div>
            </div>
        @endif
        <div class="form-group row">
            <div class="offset-2 col-3 checkbox">
                <label class="col-form-label col-form-label-sm">
                    <input type="hidden" name="is_active" value="0"/>
                    <input type="checkbox" name="is_active" value="1" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="55" data-height="25"/>
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
    </script>
@endsection
