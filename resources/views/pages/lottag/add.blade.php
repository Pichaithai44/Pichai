@extends('layouts.app')
@section('title', 'Page Title')
@section('list', 'เพิ่มข้อมูลค่าเริ่มต้น Lot Tag')
@section('content')
    <div class="container form-control">
        <form action="{{ route('pages.lottag.create') }}" id="my_form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
    
            <div class="form-group row">
                <label class="col-4 col-form-label">Model</label>
                <div class="col-8">
                    <select class="form-control" name="model">
                        @foreach($modelOption as $m)
                        <option value="{{ $m['id'] }}" {{ $m['id'] == old('model') ? 'selected' : null }}>{{ $m['name'] }}</option>
                        @endforeach
                    </select>
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
                <label class="col-4 col-form-label">Part Number</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="part_number" value="{{ old('part_number') }}"/>
                </div>
            </div>
            @if ($errors->has('part_number'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('part_number') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">Part Name</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="part_name" value="{{ old('part_name') }}"/>
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
                <label class="col-4 col-form-label">Material</label>
                <div class="col-8">
                    <select class="form-control" name="material">
                        @foreach($materialOption as $m)
                        <option value="{{ $m['id'] }}" {{ $m['id'] == old('material') ? 'selected' : null }}>{{ $m['name'] }}</option>
                        @endforeach
                    </select>
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
                    <select class="form-control" name="type">
                        @foreach($typeOption as $m)
                        <option value="{{ $m['id'] }}" {{ $m['id'] == old('type') ? 'selected' : null }}>{{ $m['name'] }}</option>
                        @endforeach
                    </select>
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
                    <input class="form-control text-left" type="text" name="t_value" value="{{ old('t_value') }}"/>
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
                <label class="col-4 col-form-label">ROD.</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="rod_value" value="{{ old('rod_value') }}"/>
                </div>
            </div>
            @if ($errors->has('rod_value'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('rod_value') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">Process</label>
                <div class="col-8" >
                    <div class="form-group row">
                        <div class="col" id="btn_add"></div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
               <div class="col-12" id="add_input"></div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label">เลขที่เอกสารอ้างอิง</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="refer" value="{{ old('refer') }}"/>
                </div>
            </div>
            @if ($errors->has('refer'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('refer') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">REV.</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="rev" value="{{ old('rev') }}"/>
                </div>
            </div>
            @if ($errors->has('rev'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('rev') }}
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label class="col-4 col-form-label">REV Date.</label>
                <div class="col-8">
                    <input class="form-control text-left" type="text" name="rev_date" id="rev_date" value="{{ old('rev_date') }}" data-date-format="dd/mm/yyyy"/>
                </div>
            </div>
            @if ($errors->has('rev_date'))
                <div class="form-group row">
                    <div class=" offset-4 col-8 validate-danger">
                        {{ $errors->first('rev_date') }}
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
                <button class="btn btn-ymt" onclick="location='{{ route('pages.lottag.index') }}'">กลับ</button>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function submit(){
            document.getElementById('my_form').submit();
        }
 
        $( function() {
            $.fn.datepicker.dates['th'] = {
                days: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"],
                daysShort: ["อา.","จ.","อ.","พ.","พฤ.","ศ.","ส."],
                daysMin: ["อ","จ","อ","พ","พ","ศ","ส"],
                months: [ "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม" ],
                monthsShort: [ "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค." ],
                today: "Today",
                clear: "Clear",
                format: "dd/mm/yyyy",
                titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
                weekStart: 0,
                clearBtn: true
            };
            $("#rev_date").datepicker({
                language: 'th'
            });
        });

        $(document).ready(function() {
            var item = 1;
            $('#btn_add').append("<input id=\"add\" type=\"button\" class=\"btn btn-success\" value='เพิ่ม'>");
            $('#btn_add').on('click', '#add', function() {
                $( "#add_input" ).append( `
                    <div class='form-group row' id='box_${item}'>
                        <div class='col-4'>
                            <img id='preview_img_${item}' src="/img/no-img.png" class="preview-img"/>
                        </div>
                        <div class='col-4'>
                            <div class='form-group row'>
                                <label class="col-4 col-form-label">ชื่อ Process</label>
                                <div class="col-8">
                                    <input class="form-control" type="text" name='process_${item}' id='process_${item}' value="{{ old('process_${item}') }}"/>
                                </div>
                            </div>
                        </div>
                        <div class='col-4'>
                            <label class='btn btn-success' for='img_${item}'>เลือกรูป</label>
                            <span id='img_name_${item}' class='text-add-img-overflow'></span>
                            <button id='img_delete_${item}' onclick='deleteItem(${item})' class='btn-add-delete'><i class="fas fa-trash-alt"></i></button>
                            <input type='file'class='form-control' name='img_${item}' id='img_${item}' accept='image/*' onchange='loadPreViewTextImg(${item})' style='display:none;'>
                        </div>
                    </div>
                `);
                $( `#process_${item}` ).autocomplete({
                    source: "{{ route('pages.process.autocomplete') }}",
                    minlenght:3,
                    autoFocus:true,
                        select: function(event, ui) {
                            $( `#process_${item}` ).val(ui.item.value);
                        }
                });
                item++;
            });
        });
        function loadPreViewTextImg(number){
            var fileToLoad = document.getElementById(`img_${number ? number : null}`).files[0];
            var fileReader = new FileReader();
            fileReader.readAsDataURL(fileToLoad);
            fileReader.onload = function(fileLoadedEvent){
                document.getElementById(`preview_img_${number ? number : null}`).src = fileReader.result;
                document.getElementById(`img_name_${number ? number : null}`).innerHTML = fileToLoad.name;
            };
        }
        function deleteItem(number){
            $(`#box_${number}`).remove();
        }
    </script>
@endsection