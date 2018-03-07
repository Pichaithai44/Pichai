@extends('layouts.app')
@section('title', 'Page Title')
@section('list', 'เอกสารยืนยันการตรวจสอบชิ้นงานก่อนการผลิต (Self Check Production)')
@section('content')
<p>เอกสาร ตอนที่ 1 <span>สถานะ : ยังไม่ได้ยืนยันการตรวจสอบ</span></p></p>
    <form action="{{ route('pages.selfcheckproduction.create') }}" method="POST" id="my_form" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        {{--  data hidden  --}}
        <input type="hidden" name="pre_production_check_id" id="pre_production_check_id" value="{{ old('pre_production_check_id') }}">
        <div class="form-group row">
            <label class="col-2 col-form-label">วันที่ผลิต (Production Data)</label>
            <div class="col-2">
            <input class="form-control text-left input-disable-event" type="text" name="production_date" id="production_date" value="{{ $toDate }}"/>
            </div>

            <label class="col-3 col-form-label">จำนวนที่ผลิต (Production Order)</label>
            <div class="col-1">
            <input class="form-control text-left input-disable-event" type="text" name="production_order" id="production_order" value="{{ old('production_order') }}"/>
            </div>

            <label class="col-2 col-form-label">เลขที่ล็อต (Lot No.)</label>
            <div class="col-1">
            <input class="form-control text-left input-disable-event" type="text" name="lot_no_fix" id="lot_no_fix" value="{{ date('ymd') }}"/>
            </div>
            <div class="col-1">
            <input class="form-control text-left {{$errors->has('lot_no') ? 'errors-has-danger' : null}}" type="text" maxlength="2" placeholder="xx" name="lot_no" value="{{ old('lot_no') }}"/>
            </div>
        </div>
        @if ($errors->has('lot_no'))
            <div class="form-group row">
                <div class=" offset-4 col-8 validate-danger">
                    {{ $errors->first('lot_no') }}
                </div>
            </div>
        @endif

        <div class="form-group row">
            <label class="col-4 col-form-label">1. หมายเลขที่ผลิต (Part Number)</label>
            <div class="col-8">
            <input class="form-control text-left {{$errors->has('part_no') ? 'errors-has-danger' : null}}" type="text" name="part_no" value="{{ old('part_no') }}" id="part_no"/>
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
            <label class="col-4 col-form-label">2. ชื่อชิ้นงาน (Part Name)</label>
            <div class="col-8">
            <input class="form-control text-left input-disable-event" type="text" id="part_name" name="part_name"   value="{{ old('part_name') }}" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-4 col-form-label">3. ชื่อรุ่นชิ้นงาน / ลูกค้า (Model / Customer)</label>
            <div class="col-4">
            <input class="form-control text-left input-disable-event" type="text" name="model" id="model" value="{{ old('model') }}"/>
            </div>
            <div class="col-4">
            <input class="form-control text-left input-disable-event" type="text" name="customer" id="customer" value="{{ old('customer') }}"/>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-4 col-form-label">4. ไลน์การผลิต (At Production Line)</label>
            <div class="col-2">
            <input class="form-control text-left input-disable-event" type="text" name="at_production_line" id="at_production_line" value="{{ old('at_production_line') }}"/>
            </div>
            <label class="col-2 col-form-label">กะผลิต (At Shlft)</label>
            <div class="col-4">
                <div class="form-group row">
                    @foreach($atShlft as $key => $as)
                    <div class="col-md-6">
                        <input type="checkbox" name="at_shlft" id="{{ 'at_shlft'.$as['value'] }}" value="{{ $as['value'] }}" {{ $as['check'] ? 'checked' : null }} class="form-check-input input-disable-event">
                        <label class="form-check-label">{{ '0'.($key + 1)  }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-4 col-form-label">5. อ้างอิงหมายเลขเอกสารตรวจสอบ (Q-Point Sheet)</label>
            <div class="col-8">
                <input class="form-control text-left input-disable-event" type="text" name="q_point_sheet"   id="q_point_sheet" value="{{ old('q_point_sheet') }}"/>
           </div>
        </div>

        <div class="form-group row">
            <label class="col-5 col-form-label" for="quality_important">6. จุดสำคัญของการควบคุมคุณภาพชิ้นส่วน (Quality Important)</label>
            <div class="col-7">
                <input class="form-control text-left input-disable-event" type="text" id="quality_important" name="quality_important"/>
           </div>
        </div>

        <div class="form-group row">
            <div class="col-3">
                <input type="checkbox" class="input-disable-event" name="is_rm_type_thickness" id="is_rm_type_thickness">
                <label class="col-form-label input-disable-event" for="rm_type">วัตถุดิบที่กำหนด (R/M Type):</label>
            </div>
            <div class="col-2">
                <input type="text" class="form-control input-disable-event" id="rm_type" name="rm_type" disabled="true">
            </div>
            <div class="col-3">
                <label class="col-form-label input-disable-event" for="rm_thickness">ความหนาวัตถุดิบ (R/M Thickness):</label>
            </div>
            <div class="col-3">
                <input type="text" class="form-control input-disable-event" id="rm_thickness" name="rm_thickness" disabled="true">
            </div>
            <div class="col-1">
                <label class="col-form-label input-disable-event">mm</label>
            </div>                    
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <input type="checkbox" class="input-disable-event" id="is_neck_broken" name="is_neck_broken">
                <label for="is_neck_broken" class="col-form-label input-disable-event">การยืดตัวและฉีกขาดของชิ้นงาน (Neck & Broken)</label>
            </div>
            <div class="col-md-3">
                <input type="radio" id="neck_broken_y" name="neck_broken" value="Y" class="input-disable-event" disabled="true">
                <label for="neck_broken_y" class="col-form-label input-disable-event">คุณภาพผ่าน</label>
            </div>
            <div class="col-md-3">
                <input type="radio" id="neck_broken_n" name="neck_broken" value="N" class="input-disable-event" disabled="true">
                <label for="neck_broken_n" class="col-form-label input-disable-event">คุณภาพไม่ผ่าน</label>
            </div>
        </div>
    
        <div class="form-group row">
            <div class="col-md-6">
                <input type="checkbox" class="input-disable-event" id="is_burr" name="is_burr">
                <label for="is_burr" class="col-form-label input-disable-event">ชิ้นงานมีครีบคมตัดเฉื่อน (ฺBurr)</label>
            </div>
            <div class="col-md-3">
                <input type="radio" id="burr_y" name="burr" value="Y" class="input-disable-event" disabled="true">
                <label for="burr_y" class="col-form-label input-disable-event">คุณภาพผ่าน</label>
            </div>
            <div class="col-md-3">
                <input type="radio" id="burr_n" name="burr" value="N" class="input-disable-event" disabled="true">
                <label for="burr_n" class="col-form-label input-disable-event">คุณภาพไม่ผ่าน</label>
            </div>
        </div>
    
        <div class="form-group row">
            <div class="col-md-6">
                <input type="checkbox" class="input-disable-event" id="is_work_example" name="is_work_example">
                <label for="is_work_example" class="col-form-label input-disable-event">ความแตกต่างระหว่างชิ้นงานจริงกับชิ้นงานตัวอย่าง</label>
            </div>
            <div class="col-md-3">
                <input type="radio" id="work_example_y" name="work_example" value="Y" class="input-disable-event" disabled="true">
                <label for="work_example_y" class="col-form-label input-disable-event">คุณภาพผ่าน</label>
            </div>
            <div class="col-md-3">
                <input type="radio" id="work_example_n" name="work_example" value="N" class="input-disable-event" disabled="true">
                <label for="work_example_n" class="col-form-label input-disable-event">คุณภาพไม่ผ่าน</label>
            </div>
        </div>
    
        <div class="form-group row">
            <div class="col-md-3 offset-md-1">
                <input type="checkbox" class="input-disable-event" id="is_issue" name="is_issue">
                <label for="is_issue" class="col-form-label input-disable-event">ปัญหาอะไร ?</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="issue_detail" name="issue_detail" class="form-control input-disable-event" style="width:100%;" disabled="true">
            </div>
        </div>
    
        <div class="form-group row">
            <div class="col-md-3 offset-md-1">
                <input type="checkbox" class="input-disable-event" id="is_issue_more" name="is_issue_more">
                <label for="is_issue_more" class="col-form-label input-disable-event">เป็นปัญหาอีกหรือไม่</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="issue_more_detail" name="issue_more_detail" class="form-control input-disable-event" style="width:100%;" disabled="true">
            </div>
        </div>

        <div class="card">
                <div class="card-header">
                    ผลการตรวจสอบ (Quality Result)
                </div>
                <div class="card-block">
                    <div class="form-group row" style="margin: 0;">
                        <div class="col-md-4 box-solid box-null"></div>
                        <div class="col-md-8">
                            <div class="form-group row">
                                <div class="col">
                                    <input type="checkbox" class="input-disable-event">
                                    <label class="col-form-label">ผ่านตามข้อกำหนดคุณภาพเบื้องต้น (Quick Qualily Check)</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <input type="checkbox" class="input-disable-event">
                                    <label class="col-form-label">ไม่ผ่านตามข้อกำหนดคุณภาพเบื้องต้น (Quick Qualily Check)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="col-form-label">-กรณีไม่ผ่านแจ้งระดับหัวหน้าที่สูงขึ้น และ/หรือ ผู้จัดการทันที</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group row">
                        <label class="col-form-label">หัวหน้างาน (Supervisor): </label>
                        <div class="col-md-4">
                            <input type="text"class="form-control">
                        </div>
                    </div>
                </div>
        </div>
    </form>
    <div class="row">
        <div class="offset-4 col-8">
            <button class="btn" onclick="location='{{ route('pages.selfcheckproduction.index') }}'">กลับ</button>
            <button type="submit" class="btn btn-primary" onclick="submit()" id="save">บันทึกการยืนยัน</button>
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
                source: "{{ route('pages.selfcheckproduction.autocomplete') }}",
                minlenght:1,
                autoFocus:true,
                select: function(event, ui) {
                    $('#part_no').val(ui.item.value);
                    $('#part_name').val(ui.item.part_name);
                    $('#model').val(ui.item.model_name);
                    $('#customer').val(ui.item.customer_name);
                    $('#at_production_line').val(ui.item.production_line);
                    $('#pre_production_check_id').val(ui.item.pre_production_check_id);
                    $('#production_order').val(ui.item.product_order);
                    $('#q_point_sheet').val(ui.item.sheet_name);
                    document.getElementById("PartNumber_2").value = ui.item.value;
                    document.getElementById("PartName_2").value = ui.item.part_name;
                    document.getElementById("Model_2").value = ui.item.model_name;
                    document.getElementById("Customer_2").value = ui.item.customer_name;
                    document.getElementById("AtProductionLine_2").value = ui.item.production_line;
                }
            });
        });
    </script>
@endsection
