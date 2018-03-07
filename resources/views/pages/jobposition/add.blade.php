@extends('layouts.app')
@section('title', 'Job Position')
@section('list', 'เพิ่มข้อมูลค่าเริ่มต้น ตำแหน่งงาน')
@section('content')
    <div class="container form-control">
        <form action="{{ route('pages.jobposition.create') }}" id="my_form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group row">
                <label class="col-4 col-form-label">ชื่อ</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="name" id="name" value="{{ old('name') }}">
                </div>
            </div>
            @if ($errors->has('name'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('name') }}
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
                <button type="submit" class="btn btn-primary btn-ymt" onclick="submit()" id="save">บันทึก</button>
                <button class="btn btn-ymt" onclick="location='{{ route('pages.jobposition.index') }}'">กลับ</button>
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
