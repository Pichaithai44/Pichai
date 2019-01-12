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
            <div class="col-md-12">
                <h1 class="page-header"><i class="fas fa-cogs"></i> ตั้งค่าระบบ</h1>
            </div>
        </div>
    </div>
    <form action="{{ route('pages.settingsystem.store') }}" id="my_form" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="row">
            <div class="col-md-9 offset-md-3">
                <div class="form-group row">
                    <div class="col-md-4">
                    <label for="pawn_name" class="col-form-label-lg">ชื่อโรงรับจำนำ</label>
                        <input class="form-control form-control-lg" type="text" name="pawn_name" id="pawn_name" placeholder="กรุณาระบุข้อมูล" autocomplete="off" value="{{ !empty($result['data']['pawn_name']) ? $result['data']['pawn_name'] : old('pawn_name') }}">
                    </div>
                </div>
                @if ($errors->has('pawn_name'))
                    <div class="form-group row">
                        <div class=" col-md-4 validate-danger">
                            {{ $errors->first('pawn_name') }}
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <div class="col-md-2">
                    <label for="address" class="col-form-label-lg">บ้านเลขที่</label> 
                        <input type="text" class="form-control form-control-lg" type="text" name="address" id="address" placeholder="กรุณาระบุข้อมูล" autocomplete="off" value="{{ !empty($result['data']['info']['address']) ? $result['data']['info']['address'] : old('address') }}">
                    </div>
            
                    <div class="col-md-2">
                    <label for="moo" class="col-form-label-lg">หมู่ที่</label> 
                        <input class="form-control form-control-lg" type="text" name="moo" id="moo" placeholder="กรุณาระบุข้อมูล" autocomplete="off" value="{{ !empty($result['data']['info']['moo']) ? $result['data']['info']['moo'] : old('moo') }}">
                    </div>
                    
                    <div class="col-md-2">
                    <label for="soi" class="col-form-label-lg">ตรอก/ซอย</label> 
                        <input class="form-control form-control-lg" type="text" name="soi" id="soi" placeholder="กรุณาระบุข้อมูล" autocomplete="off" value="{{ !empty($result['data']['info']['soi']) ? $result['data']['info']['soi'] : old('soi') }}">
                    </div>

                    <div class="col-md-2">
                    <label for="road" class="col-form-label-lg">ถนน</label> 
                        <input class="form-control form-control-lg" type="text" name="road" id="road" placeholder="กรุณาระบุข้อมูล" autocomplete="off" value="{{ !empty($result['data']['info']['road']) ? $result['data']['info']['road'] : old('road') }}">
                    </div>
                    
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                    <label for="sub_district" class="col-form-label-lg">แขวง/ตำบล</label>
                        <input class="form-control form-control-lg text-left" type="text" name="sub_district" id="sub_district" autocomplete="off" placeholder="กรุณาระบุข้อมูล" value="{{ !empty($result['data']['info']['sub_district']) ? $result['data']['info']['sub_district'] : old('sub_district') }}">
                    </div>
                    
                    <div class="col-md-2">
                    <label for="district" class="col-form-label-lg">แขวง/ตำบล</label>
                        <input class="form-control form-control-lg text-left" type="text" name="district" id="district" autocomplete="off" placeholder="กรุณาระบุข้อมูล" value="{{ !empty($result['data']['info']['district']) ? $result['data']['info']['district'] : old('district') }}">
                    </div>

                    <div class="col-md-2">
                    <label for="province" class="col-form-label-lg">จังหวัด</label>
                        <input class="form-control form-control-lg text-left" type="text" name="province" id="province" autocomplete="off" placeholder="กรุณาระบุข้อมูล" value="{{ !empty($result['data']['info']['province']) ? $result['data']['info']['province'] : old('province') }}">
                    </div>

                    <div class="col-md-2">
                    <label for="postal_code" class="col-form-label-lg">รหัสไปราณีย์</label>
                    <input class="form-control form-control-lg text-left" type="text" name="postal_code" id="postal_code" autocomplete="off" placeholder="กรุณาระบุข้อมูล" value="{{ !empty($result['data']['info']['postal_code']) ? $result['data']['info']['postal_code'] : old('postal_code') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                    <label for="sub_district" class="col-form-label-lg">เบอร์โทรศัพท์</label>
                        <input class="form-control form-control-lg text-left" type="text" name="tel" id="tel" placeholder="กรุณาระบุข้อมูล" autocomplete="off" value="{{ !empty($result['data']['contact']['tel']) ? $result['data']['contact']['tel'] : old('tel') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div style="border-bottom: 1px solid #F44336;padding-bottom: 9px;"></div>
            </div>
        </div>
        <div class="row">
            <div class="offset-md-11">
                <button type="submit" class="btn btn-success" style="margin-top:10px;"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
    <script>
        function submit(){
            document.getElementById('my_form').submit();
        }
    </script>
@endsection   