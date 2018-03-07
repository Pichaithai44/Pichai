@extends('layouts.app')
@section('title', 'Page Title')
@section('list', 'เพิ่มข้อมูลค่าเริ่มต้น Q-Point Sheet')
@section('content')
    <div class="container form-control">
        <form action="{{ route('pages.qpoint.create') }}" id="my_form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <input type="hidden" name="lottag_id" id="lottag_id" value="{{ old('lottag_id') }}"/>
            <div class="form-group row">
                <label class="col-4 col-form-label">Q-Point Sheet</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="qpoint_name" value="{{ old('qpoint_name') }}"/>
                </div>
            </div>
            @if ($errors->has('qpoint_name'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('qpoint_name') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">Part Number</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="part_no" id="part_no" value="{{ old('part_no') }}"/>
                </div>
            </div>
            @if ($errors->has('part_no'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('part_no') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">Part Name</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="part_name" id="part_name" value="{{ old('part_name') }}"/>
                </div>
            </div>
            @if ($errors->has('part_name'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('part_name') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">Model</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="model_name" id="model_name" value="{{ old('model_name') }}"/>
                </div>
            </div>
            @if ($errors->has('model_name'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('model_name') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">Material</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="material" id="material" value="{{ old('material') }}"/>
                </div>
            </div>
            @if ($errors->has('material'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('material') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">type</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="type" id="type" value="{{ old('type') }}"/>
                </div>
            </div>
            @if ($errors->has('type'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('type') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">T.</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="t_value" id="t_value" value="{{ old('t_value') }}"/>
                </div>
            </div>
            @if ($errors->has('t_value'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('t_value') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-12 col-form-label">Image</label>
            </div>
            <div class="form-group row">
                <div class="col-4">
                    <img id="preview" src="/img/no-img.png" class="preview-img"/>
                </div>
            </div>
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
                <button class="btn btn-ymt" onclick="location='{{ route('pages.qpoint.index') }}'">กลับ</button>
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
            $( "#part_no" ).autocomplete({
            source: "{{ route('pages.qpoint.autocomplete') }}",
            minlenght:3,
            autoFocus:true,
            select: function(event, ui) {
                $('#part_no').val(ui.item.value);
                $('#part_name').val(ui.item.part_name);
                $('#model_name').val(ui.item.model_name);
                $('#material').val(ui.item.material_name);
                $('#type').val(ui.item.type_name);
                $('#t_value').val(ui.item.material_t);
                $('#lottag_id').val(ui.item.lottag_id);
                document.getElementById("preview").src = ui.item.img;
            }
            });
        });
    </script>
@endsection