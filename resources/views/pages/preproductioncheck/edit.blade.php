@extends('layouts.app')
@section('title', 'Page Title')
@section('list', 'แก้ไขข้อมูลค่าเริ่มต้น Sub Model')
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
        <form action="{{ route('pages.preproductioncheck.update',['id'=> $item->id]) }}" id="my_form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <input type="hidden" name="lottag_id" id="lottag_id" value="{{ old('lottag_id') ? old('lottag_id') : $item->lot_tag_id }}"/>
            <input type="hidden" name="q_point_id" id="q_point_id" value="{{ old('q_point_id') ? old('q_point_id') : $item->q_point_sheet_id }}"/>
            <div class="form-group row">
                <label class="col-4 col-form-label">ลูกค้า</label>
                <div class="col-8">
                    <select class="form-control" name="customer">
                        @foreach($customerOption as $m)
                        <option value="{{ $m['id'] }}" {{ old('customer') ? (old('customer') == $m['id']) : ($item->customer_id == $m['id']) ? 'selected' : null }}>{{ $m['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if ($errors->has('customer'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('customer') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">Part Number</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="part_no" id="part_no" value="{{ old('part_no') ? old('part_no') : $item->part_no }}"/>
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
                    <input class="form-control text-left" type="text" name="part_name" id="part_name" value="{{ old('part_name') ? old('part_name') : $item->part_name }}"/>
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
                    <input class="form-control text-left" type="text" name="model" id="model" value="{{ old('model') ? old('model') : $item->model_name }}"/>
                </div>
            </div>
            @if ($errors->has('model'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('model') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">Q-Point Sheet</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="q_point" value="{{ old('q_point') ? old('q_point') : $item->sheet_name }}"/>
                </div>
            </div>
            @if ($errors->has('q_point'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('q_point') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">ไลน์การผลิต</label>
                <div class="col-8">
                    <select class="form-control" name="production_line">
                        @foreach($proDuctionLineOption as $m)
                        <option value="{{ $m['id'] }}" {{ old('production_line') ? (old('production_line') == $m['id']) : ($item->production_line_id == $m['id']) ? 'selected' : null }}>{{ $m['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if ($errors->has('production_line'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('production_line') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">จำนวนที่ผลิต</label>
                    <div class="col-8">
                        <input class="form-control text-left" type="text" name="product_order" id="product_order" value="{{ old('product_order') ? old('product_order') : $item->product_order }}"/>
                    </div>
            </div>
            @if ($errors->has('product_order'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('product_order') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">สถานะ</label>
                <div class="col-8">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="enable_1">
                            <input class="form-check-input" type="radio" name="isEnable" id="enable_1" value="Y" {{ $item->is_enable == 'Y' ? 'checked' : null }}>
                                เผยแพร่
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="enable_2">
                            <input class="form-check-input" type="radio" name="isEnable" id="enable_2" value="N" {{ $item->is_enable == 'N' ? 'checked' : null }}>
                                ไม่เผยแพร่
                        </label>
                    </div>
                </div>
            </div>

        </form>
        <div class="row">
            <div class="offset-4 col-8">
                <button class="btn btn-danger btn-ymt" onclick="location='{{ route('pages.preproductioncheck.delete',['id'=> $item->id]) }}'" id="delete">ลบ</button>
                <button type="submit" class="btn btn-primary btn-ymt" onclick="submit()" id="save">บันทึก</button>
                <button class="btn btn-ymt" onclick="location='{{ route('pages.preproductioncheck.index') }}'">กลับ</button>
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
        $(function()
        {
            $( "#part_no" ).autocomplete({
                source: "{{ route('pages.preproductioncheck.autocomplete') }}",
                minlenght:1,
                autoFocus:true,
                select: function(event, ui) {
                    $('#part_no').val(ui.item.value);
                    $('#part_name').val(ui.item.part_name);
                    $('#lottag_id').val(ui.item.lottag_id);
                }
            });
        });
    </script>
@endsection