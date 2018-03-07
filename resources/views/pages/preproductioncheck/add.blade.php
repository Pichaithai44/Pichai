@extends('layouts.app')
@section('title', 'Page Title')
@section('list', 'เพิ่มข้อมูลตรวจสอบชิ้นงานก่อนการผลิต')
@section('content')
    <div class="container form-control">
        <form action="{{ route('pages.preproductioncheck.create') }}" id="my_form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <input type="hidden" name="lottag_id" id="lottag_id" value="{{ old('lottag_id') }}"/>
            <input type="hidden" name="q_point_id" id="q_point_id" value="{{ old('q_point_id') }}"/>
            <div class="form-group row">
                <label class="col-4 col-form-label">ลูกค้า</label>
                <div class="col-8">
                    <select class="form-control" name="customer">
                        @foreach($customerOption as $m)
                        <option value="{{ $m['id'] }}" {{ $m['id'] == old('customer') ? 'selected' : null }}>{{ $m['name'] }}</option>
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
                    <input class="form-control text-left" type="text" name="model" id="model" value="{{ old('model') }}"/>
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
                    <input class="form-control text-left" type="text" name="q_point" id="q_point"  value="{{ old('q_point') }}"/>
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
                        <option value="{{ $m['id'] }}" {{ $m['id'] == old('production_line') ? 'selected' : null }}>{{ $m['name'] }}</option>
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
                        <input class="form-control text-left" type="text" name="product_order" id="product_order" value="{{ old('product_order') }}"/>
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
        $(function()
        {
            $( "#part_no" ).autocomplete({
            source: "{{ route('pages.preproductioncheck.autocomplete') }}",
            minlenght:1,
            autoFocus:true,
            select: function(event, ui) {
                $('#part_no').val(ui.item.value);
                $('#part_name').val(ui.item.part_name);
                $('#model').val(ui.item.model_name);
                $('#q_point_id').val(ui.item.q_point_id);
                $('#q_point').val(ui.item.sheet_name);
                $('#lottag_id').val(ui.item.lottag_id);
            }
            });
        });
    </script>
@endsection