@extends('layouts.app')
@section('title', 'Set up the system')
@section('list', 'ตั้งค่าระบบ')
@section('content')
@if (session('status'))
    <div class="alert {{ session('result') ? 'alert-success' : 'alert-danger' }}" role="alert">
        <strong>{{ session('status') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <div class="container form-control">
        <form action="{{ route('pages.settingsystem.store') }}" id="my_form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group row">
                <label class="col-2 col-form-label col-form-label-sm">ชื่อโรงรับจำนำ</label>
                <div class="col-10">
                    <input class="form-control form-control-sm text-left" type="text" name="pawn_name" id="pawn_name" value="{{ !empty($result['data']->pawn_name) ? $result['data']->pawn_name : old('pawn_name') }}">
                </div>
            </div>
            @if ($errors->has('pawn_name'))
                <div class="form-group row">
                    <div class=" offset-2 col-10 validate-danger">
                        {{ $errors->first('pawn_name') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-2 col-form-label col-form-label-sm">ที่อยู่</label>
                <div class="col-10">
                    <textarea class="form-control form-control-sm text-left" name="address" id="address" value="{{ !empty($result['data']->address) ? $result['data']->address : old('address') }}"></textarea>
                </div>
            </div>
            @if ($errors->has('address'))
                <div class="form-group row">
                    <div class=" offset-2 col-10 validate-danger">
                        {{ $errors->first('address') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-2 col-form-label col-form-label-sm">หมู่</label>
                <div class="col-2">
                    <input class="form-control form-control-sm text-left" type="text" name="moo" id="moo" value="{{ !empty($result['data']->moo) ? $result['data']->moo : old('moo') }}">
                </div>
                <label class="col-2 col-form-label col-form-label-sm">ซอย</label>
                <div class="col-2">
                    <input class="form-control form-control-sm text-left" type="text" name="soi" id="soi" value="{{ !empty($result['data']->soi) ? $result['data']->soi : old('soi') }}">
                </div>
                <label class="col-2 col-form-label col-form-label-sm">ถนน</label>
                <div class="col-2">
                    <input class="form-control form-control-sm text-left" type="text" name="road" id="road" value="{{ !empty($result['data']->road) ? $result['data']->road : old('road') }}">
                </div>
            </div>
            @if ($errors->has('moo') || $errors->has('soi') || $errors->has('road'))
                <div class="form-group row">
                    <div class=" offset-2 col-2 validate-danger">
                        {{ $errors->first('moo') }}
                    </div>
                    <div class=" offset-2 col-2 validate-danger">
                        {{ $errors->first('soi') }}
                    </div>
                    <div class=" offset-2 col-2 validate-danger">
                        {{ $errors->first('road') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-2 col-form-label col-form-label-sm">ตำบล / แขวง</label>
                <div class="col-2">
                    <input class="form-control form-control-sm text-left" type="text" name="sub_district" id="sub_district" value="{{ !empty($result['data']->sub_district) ? $result['data']->sub_district : old('sub_district') }}">
                </div>
                <label class="col-2 col-form-label col-form-label-sm">อำเภอ / เขต</label>
                <div class="col-2">
                    <input class="form-control form-control-sm text-left" type="text" name="district" id="district" value="{{ !empty($result['data']->district) ? $result['data']->district : old('district') }}">
                </div>
                <label class="col-2 col-form-label col-form-label-sm">จังหวัด</label>
                <div class="col-2">
                    <input class="form-control form-control-sm text-left" type="text" name="province" id="province" value="{{ !empty($result['data']->province) ? $result['data']->province : old('province') }}">
                </div>
            </div>
            @if ($errors->has('sub_district') || $errors->has('district') || $errors->has('province'))
                <div class="form-group row">
                    <div class=" offset-2 col-2 validate-danger">
                        {{ $errors->first('sub_district') }}
                    </div>
                    <div class=" offset-2 col-2 validate-danger">
                        {{ $errors->first('district') }}
                    </div>
                    <div class=" offset-2 col-2 validate-danger">
                        {{ $errors->first('province') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-2 col-form-label col-form-label-sm">รหัสไปรษณีย์</label>
                <div class="col-3">
                    <input class="form-control form-control-sm text-left" type="text" name="postal_code" id="postal_code" value="{{ !empty($result['data']->postal_code) ? $result['data']->postal_code : old('postal_code') }}">
                </div>
                <label class="col-2 col-form-label col-form-label-sm">เบอร์โทร</label>
                <div class="col-3">
                    <input class="form-control form-control-sm text-left" type="text" name="tel" id="tel" value="{{ !empty($result['data']->tel) ? $result['data']->tel : old('tel') }}">
                </div>
            </div>
            @if ($errors->has('postal_code') || $errors->has('tel'))
                <div class="form-group row">
                    <div class=" offset-2 col-3 validate-danger">
                        {{ $errors->first('postal_code') }}
                    </div>
                    <div class=" offset-2 col-3 validate-danger">
                        {{ $errors->first('tel') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-2 col-form-label col-form-label-sm">อัตตราดอกเบี้ย</label>
                <div class="col-3">
                    <input class="form-control form-control-sm text-left" type="text" name="interest_rate" id="interest_rate" value="{{ !empty($result['data']->interest_rate) ? $result['data']->interest_rate : old('interest_rate') }}">
                </div>
                <label class="col-2 col-form-label col-form-label-sm">ค้างชำระ</label>
                <div class="col-3">
                    <input class="form-control form-control-sm text-left" type="text" name="owe" id="owe" value="{{ !empty($result['data']->owe) ? $result['data']->owe : old('owe') }}">
                </div>
            </div>
            @if ($errors->has('interest_rate') || $errors->has('owe'))
                <div class="form-group row">
                    <div class=" offset-2 col-3 validate-danger">
                        {{ $errors->first('interest_rate') }}
                    </div>
                    <div class=" offset-2 col-3 validate-danger">
                        {{ $errors->first('owe') }}
                    </div>
                </div>
            @endif
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

