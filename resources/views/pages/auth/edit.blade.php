@extends('layouts.app')
@section('title', 'Page Title')
@section('list', 'แก้ไขข้อมูล ผู้ใช้')
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
        <form action="{{ route('pages.auth.update',['id'=> $item->id]) }}" id="my_form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group row">
                <label class="col-4 col-form-label">ชื่อ</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="first_name" id="first_name" value="{{ old('first_name') ? old('first_name') : $item->first_name }}">
                </div>
            </div>
            @if ($errors->has('first_name'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('first_name') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">นามสกุล</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="last_name" id="last_name" value="{{ old('last_name') ? old('last_name') : $item->last_name }}">
                </div>
            </div>
            @if ($errors->has('last_name'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('last_name') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">อีเมล</label>
                <div class="col-8">
                    <span>{{ $item->email }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label">สิทธิการใช้งาน</label>
                <div class="col-8">
                    <select class="form-control" name="role">
                        @foreach($roleOption as $m)
                        <option value="{{ $m['id'] }}" {{ old('role') ?  ($m['id'] == old('role') ? 'selected' : null) : ($m['id'] == $item->role_id ? 'selected' : null) }}>{{ $m['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if ($errors->has('role'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('role') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">แผนก</label>
                <div class="col-8">
                    <select class="form-control" name="department">
                        @foreach($departmentOption as $m)
                        <option value="{{ $m['id'] }}" {{ old('department') ?  ($m['id'] == old('department') ? 'selected' : null) : ($m['id'] == $item->department_id ? 'selected' : null) }}>{{ $m['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if ($errors->has('department'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('department') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">ตำแหน่งงาน</label>
                <div class="col-8">
                    <select class="form-control" name="jobposition">
                        @foreach($jobpositionOption as $m)
                        <option value="{{ $m['id'] }}" {{ old('jobposition') ?  ($m['id'] == old('jobposition') ? 'selected' : null) : ($m['id'] == $item->job_position_id ? 'selected' : null) }}>{{ $m['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if ($errors->has('jobposition'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('jobposition') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">สถานะ</label>
                <div class="col-8">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="enable_1">
                            <input class="form-check-input" type="radio" name="isEnable" id="enable_1" value="Y" checked>
                                เผยแพร่
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="enable_2">
                            <input class="form-check-input" type="radio" name="isEnable" id="enable_2" value="N">
                                ไม่เผยแพร่
                        </label>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="offset-4 col-8">
                <button class="btn btn-danger btn-ymt" onclick="location='{{ route('pages.auth.delete',['id'=> $item->id]) }}'" id="delete">ลบ</button>
                <button type="submit" class="btn btn-primary btn-ymt" onclick="submit()" id="save">บันทึก</button>
                <button class="btn btn-ymt" onclick="location='{{ route('pages.auth.index') }}'">กลับ</button>
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
    </script>
@endsection