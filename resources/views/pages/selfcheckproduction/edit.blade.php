@extends('layouts.app')
@section('title', 'Page Title')
@can('production')
@section('list', 'เอกสารยืนยันการตรวจสอบชิ้นงานก่อนการผลิต (Self Check Production)')
@endcan
@can('pqa')
@section('list', 'เอกสารตรวจสอบขนาดชิ้นงาน (Data Parts Confirmation By PQA)')
@endcan
@section('content')
@if (session('status'))
    <div class="alert {{ session('result') ? 'alert-success' : 'alert-danger' }}" role="alert">
        <strong>{{ session('status') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{--  ฝั่ง-Production  --}}

@can('admin')
<div>
@endcan
@can('pqa')
<div style="display: none;">
@endcan
    <p>เอกสาร ตอนที่ 1 <span>สถานะ : {{ $item->production_status }}</span> ผลการตรวจสอบ : {{ $item->production_quality_result }}</p>
        <form action="{{ route('pages.selfcheckproduction.update',['id'=> $item->id]) }}" method="POST" id="my_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            {{--  data hidden  --}}
            <input type="hidden" name="pre_production_check_id" id="pre_production_check_id" value="{{ $item->id }}">
            <input type="hidden" name="lottag_id" id="lottag_id" value="{{ old('lottag_id') }}">
    
            <div class="form-group row">
                <label class="col-2 col-form-label">วันที่ผลิต (Production Data)</label>
                <div class="col-2">
                    <input class="form-control text-left @can('production.staff') input-disable-event @endcan" type="text" name="production_date" id="production_date" value="{{ old('production_date') ? old('production_date') : $item->production_date }}" data-date-format="dd/mm/yyyy" />
                </div>
    
                <label class="col-3 col-form-label">จำนวนที่ผลิต (Production Order)</label>
                <div class="col-1">
                <input class="form-control text-left @can('production.staff') input-disable-event @endcan" type="text" name="production_order" id="production_order" value="{{ old('production_order') ? old('production_order') : $item->production_order}}"/>
                </div>
    
                <label class="col-2 col-form-label">เลขที่ล็อต (Lot No.)</label>
                <div class="col-1">
                <input class="form-control text-left @can('production.staff') input-disable-event @endcan" type="text" name="lot_no_fix" id="lot_no_fix" value="{{ $item->lot_no_fix }}" data-date-format="yymmdd"/>
                </div>
                <div class="col-1">
                <input class="form-control text-left {{$errors->has('lot_no') ? 'errors-has-danger' : null}} @can('production.staff') input-disable-event @endcan" type="text" maxlength="2" placeholder="xx" name="lot_no" value="{{ old('lot_no') ? old('lot_no') : $item->lot_no[0] }}"/>
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
                <input class="form-control text-left {{$errors->has('part_no') ? 'errors-has-danger' : null}} @can('production.staff') input-disable-event @endcan" type="text" name="part_no" value="{{ old('part_no') ? old('part_no') : $item->part_no }}" id="part_no"/>
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
                <input class="form-control text-left input-disable-event" type="text" id="part_name" name="part_name"   value="{{ old('part_name') ? old('part_name') : $item->part_name }}" />
                </div>
            </div>
    
            <div class="form-group row">
                <label class="col-4 col-form-label">3. ชื่อรุ่นชิ้นงาน / ลูกค้า (Model / Customer)</label>
                <div class="col-4">
                <input class="form-control text-left input-disable-event" type="text" name="model" id="model" value="{{ old('model') ? old('model') : $item->model_name }}"/>
                </div>
                <div class="col-4">
                @can('production.staff') 
                <input class="form-control text-left input-disable-event" type="text" name="customer" id="customer" value="{{ old('customer') ? old('customer') : $item->customer_name }}"/>
                @endcan

                @can('admin') 
                <select class="form-control" name="customer" id="customer">
                    @foreach($customerOption as $m)
                    <option value="{{ $m['id'] }}" {{ old('customer') ? (old('customer') == $m['name']): ($item->customer_name == $m['name']) ? 'selected' : null }}>{{ $m['name'] }}</option>
                    @endforeach
                </select>
                @endcan

                @can('production.supervisor') 
                <select class="form-control" name="customer" id="customer">
                    @foreach($customerOption as $m)
                    <option value="{{ $m['id'] }}" {{ old('customer') ? (old('customer') == $m['name']): ($item->customer_name == $m['name']) ? 'selected' : null }}>{{ $m['name'] }}</option>
                    @endforeach
                </select>
                @endcan

                </div>
                @can('production.supervisor') 
                <select class="form-control" name="at_production_line" id="at_production_line">
                    @foreach($proDuctionLineOption as $m)
                    <option value="{{ $m['id'] }}" {{ old('at_production_line') ? (old('at_production_line') == $m['name']): ($item->line_name == $m['name']) ? 'selected' : null }}>{{ $m['name'] }}</option>
                    @endforeach
                </select>
                @endcan
            </div>
    
            <div class="form-group row">
                <label class="col-4 col-form-label">4. ไลน์การผลิต (At Production Line)</label>
                <div class="col-2">
                @can('production.staff') 
                <input class="form-control text-left input-disable-event" type="text" name="at_production_line" id="at_production_line" value="{{ old('at_production_line') ? old('at_production_line') : $item->line_name}}"/>
                @endcan
                @can('admin') 
                <select class="form-control" name="at_production_line" id="at_production_line">
                    @foreach($proDuctionLineOption as $m)
                    <option value="{{ $m['id'] }}" {{ old('at_production_line') ? (old('at_production_line') == $m['name']): ($item->line_name == $m['name']) ? 'selected' : null }}>{{ $m['name'] }}</option>
                    @endforeach
                </select>
                @endcan
                @can('production.supervisor') 
                <select class="form-control" name="at_production_line" id="at_production_line">
                    @foreach($proDuctionLineOption as $m)
                    <option value="{{ $m['id'] }}" {{ old('at_production_line') ? (old('at_production_line') == $m['name']): ($item->line_name == $m['name']) ? 'selected' : null }}>{{ $m['name'] }}</option>
                    @endforeach
                </select>
                @endcan
                </div>
                <label class="col-2 col-form-label">กะผลิต (At Shlft)</label>
                <div class="col-4">
                    <div class="form-group row">
                      
                        <div class="col-md-6">
                            <input type="radio" name="at_shlft" id="01" value="01" {{ $item->at_shlft == '01' ? 'checked' : null }} class="form-check-input @can('production.staff') input-disable-event @endcan">
                            <label for="01" class="form-check-label @can('production.staff') input-disable-event @endcan">01</label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" name="at_shlft" id="02" value="02" {{ $item->at_shlft == '02' ? 'checked' : null }} class="form-check-input @can('production.staff') input-disable-event @endcan">
                            <label for="02" class="form-check-label @can('production.staff') input-disable-event @endcan">02</label>
                        </div>
                  
                    </div>
                </div>
            </div>
    
            <div class="form-group row">
                <label class="col-5 col-form-label">5. อ้างอิงหมายเลขเอกสารตรวจสอบ (Q-Point Sheet)</label>
                <div class="col-7">
                    <input class="form-control text-left input-disable-event" type="text" name="q_point_sheet"   id="q_point_sheet" value="{{ old('q_point_sheet') ? old('q_point_sheet') : $item->sheet_name }}"/>
               </div>
            </div>
    
            <div class="form-group row">
                <label class="col-5 col-form-label" for="quality_important">6. จุดสำคัญของการควบคุมคุณภาพชิ้นส่วน (Quality Important)</label>
                <div class="col-7">
                    <input class="form-control text-left @can('production.staff') input-disable-event @endcan" type="text" id="quality_important" name="quality_important"/>
               </div>
            </div>
    
            <div class="form-group row">
                    <div class="col-3">
                        <input type="checkbox" class="@can('production.staff') input-disable-event @endcan" name="is_rm_type_thickness" id="is_rm_type_thickness">
                        <label class="col-form-label @can('production.staff') input-disable-event @endcan" for="rm_type">วัตถุดิบที่กำหนด (R/M Type):</label>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control @can('production.staff') input-disable-event @endcan" id="rm_type" name="rm_type" disabled="true">
                    </div>
                    <div class="col-3">
                        <label class="col-form-label @can('production.staff') input-disable-event @endcan" for="rm_thickness">ความหนาวัตถุดิบ (R/M Thickness):</label>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control @can('production.staff') input-disable-event @endcan" id="rm_thickness" name="rm_thickness" disabled="true">
                    </div>
                    <div class="col-1">
                        <label class="col-form-label @can('production.staff') input-disable-event @endcan">mm</label>
                    </div>                    
            </div>
    
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="checkbox" class="@can('production.staff') input-disable-event @endcan" id="is_neck_broken" name="is_neck_broken">
                    <label for="is_neck_broken" class="col-form-label @can('production.staff') input-disable-event @endcan">การยืดตัวและฉีกขาดของชิ้นงาน (Neck & Broken)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" id="neck_broken_y" name="neck_broken" value="Y" class="@can('production.staff') input-disable-event @endcan" disabled="true">
                    <label for="neck_broken_y" class="col-form-label @can('production.staff') input-disable-event @endcan">คุณภาพผ่าน</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" id="neck_broken_n" name="neck_broken" value="N" class="@can('production.staff') input-disable-event @endcan" disabled="true">
                    <label for="neck_broken_n" class="col-form-label @can('production.staff') input-disable-event @endcan">คุณภาพไม่ผ่าน</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="checkbox" class="@can('production.staff') input-disable-event @endcan" id="is_burr" name="is_burr">
                    <label for="is_burr" class="col-form-label @can('production.staff') input-disable-event @endcan">ชิ้นงานมีครีบคมตัดเฉื่อน (ฺBurr)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" id="burr_y" name="burr" value="Y" class="@can('production.staff') input-disable-event @endcan" disabled="true">
                    <label for="burr_y" class="col-form-label @can('production.staff') input-disable-event @endcan">คุณภาพผ่าน</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" id="burr_n" name="burr" value="N" class="@can('production.staff') input-disable-event @endcan" disabled="true">
                    <label for="burr_n" class="col-form-label @can('production.staff') input-disable-event @endcan">คุณภาพไม่ผ่าน</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="checkbox" class="@can('production.staff') input-disable-event @endcan" id="is_work_example" name="is_work_example">
                    <label for="is_work_example" class="col-form-label @can('production.staff') input-disable-event @endcan">ความแตกต่างระหว่างชิ้นงานจริงกับชิ้นงานตัวอย่าง</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" id="work_example_y" name="work_example" value="Y" class="@can('production.staff') input-disable-event @endcan" disabled="true">
                    <label for="work_example_y" class="col-form-label @can('production.staff') input-disable-event @endcan">คุณภาพผ่าน</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" id="work_example_n" name="work_example" value="N" class="@can('production.staff') input-disable-event @endcan" disabled="true">
                    <label for="work_example_n" class="col-form-label @can('production.staff') input-disable-event @endcan">คุณภาพไม่ผ่าน</label>
                </div>
            </div>
        
            <div class="form-group row">
                <div class="col-md-3 offset-md-1">
                    <input type="checkbox" class="@can('production.staff') input-disable-event @endcan" id="is_issue" name="is_issue">
                    <label for="is_issue" class="col-form-label @can('production.staff') input-disable-event @endcan">ปัญหาอะไร ?</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="issue_detail" name="issue_detail" class="form-control @can('production.staff') input-disable-event @endcan" style="width:100%;" disabled="true">
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-3 offset-md-1">
                    <input type="checkbox" class="@can('production.staff') input-disable-event @endcan" id="is_issue_more" name="is_issue_more">
                    <label for="is_issue_more" class="col-form-label @can('production.staff') input-disable-event @endcan">เป็นปัญหาอีกหรือไม่</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="issue_more_detail" name="issue_more_detail" class="form-control @can('production.staff') input-disable-event @endcan" style="width:100%;" disabled="true">
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
                                        <input type="radio" class="@can('production.staff') input-disable-event @endcan" value="T" name="production_quality_result" id="quality_result_t">
                                        <label for="quality_result_t" class="col-form-label @can('production.staff') input-disable-event @endcan">ผ่านตามข้อกำหนดคุณภาพเบื้องต้น (Quick Qualily Check)</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="radio" class="@can('production.staff') input-disable-event @endcan" value="F" name="production_quality_result" id="quality_result_f">
                                        <label for="quality_result_f" class="col-form-label @can('production.staff') input-disable-event @endcan">ไม่ผ่านตามข้อกำหนดคุณภาพเบื้องต้น (Quick Qualily Check)</label>
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
                                <input type="text"class="form-control @can('production.staff') input-disable-event @endcan">
                            </div>
                        </div>
                    </div>
            </div>
        </form>
        {{--  end-Production  --}}
</div>
    
    @can('pqa')
    <div>
    @endcan

    @can('production')
    <div style="display: none;">
    @endcan
        {{--  ฝั่ง PQA  --}}
        <p>เอกสาร ตอนที่ 2 <span>สถานะ : {{ $item->pqa_status }}</span></p>
        <form action="{{ route('pages.selfcheckproduction.update',['id'=> $item->id]) }}" method="POST" id="my_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            {{--  data hidden  --}}
            <input type="hidden" name="pre_production_check_id" id="pre_production_check_id" value="{{ $item->id }}">
    
            <div class="form-group row">
                <label class="col-4 col-form-label">วันที่ผลิต (Production Data)</label>
                <div class="col-2">
                <input class="form-control text-left input-disable-event" type="text" name="production_date" id="production_date" value="{{ old('production_date') ? old('production_date') : $item->production_date }}"/>
                </div>
    
                <label class="col-2 col-form-label">กะผลิต (At Shlft)</label>
                <div class="col-4">
                    <div class="form-group row">
                      
                        <div class="col-md-6">
                            <input type="checkbox" name="at_shlft" id="01" value="01" {{ $item->at_shlft == '01' ? 'checked' : null }} class="form-check-input input-disable-event">
                            <label class="form-check-label">01</label>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" name="at_shlft" id="02" value="02" {{ $item->at_shlft == '02' ? 'checked' : null }} class="form-check-input input-disable-event">
                            <label class="form-check-label">02</label>
                        </div>
                  
                    </div>
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
                <input class="form-control text-left {{$errors->has('part_no') ? 'errors-has-danger' : null}} @can('pqa') input-disable-event @endcan" type="text" name="part_no" value="{{ old('part_no') ? old('part_no') : $item->part_no }}" id="part_no"/>
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
                <input class="form-control text-left input-disable-event" type="text" id="part_name" name="part_name"   value="{{ old('part_name') ? old('part_name') : $item->part_name }}" />
                </div>
            </div>
    
            <div class="form-group row">
                <label class="col-4 col-form-label">3. ชื่อรุ่นชิ้นงาน / ลูกค้า (Model / Customer)</label>
                <div class="col-4">
                <input class="form-control text-left input-disable-event" type="text" name="model" id="model" value="{{ old('model') ? old('model') : $item->model_name }}"/>
                </div>
                <div class="col-4">
                <input class="form-control text-left input-disable-event" type="text" name="customer" id="customer" value="{{ old('customer') ? old('customer') : $item->customer_name }}"/>
                </div>
            </div>
    
            <div class="form-group row">
                <label class="col-4 col-form-label">4. ไลน์การผลิต (At Production Line)</label>
                <div class="col-2">
                <input class="form-control text-left input-disable-event" type="text" name="at_production_line" id="at_production_line" value="{{ old('at_production_line') ? old('at_production_line') : $item->line_name}}"/>
                </div>
                <label class="col-2 col-form-label">กะผลิต (At Shlft)</label>
                <div class="col-4">
                    <div class="form-group row">
                      
                        <div class="col-md-6">
                            <input type="checkbox" name="at_shlft" id="01" value="01" {{ $item->at_shlft == '01' ? 'checked' : null }} class="form-check-input input-disable-event">
                            <label class="form-check-label">01</label>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" name="at_shlft" id="02" value="02" {{ $item->at_shlft == '02' ? 'checked' : null }} class="form-check-input input-disable-event">
                            <label class="form-check-label">02</label>
                        </div>
                  
                    </div>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-12">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">ชิ้นงานระหว่างกระบวนการ (Semi Part)</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">เริ่มต้นล๊อตการผลิต (A)</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">กลางล๊อตการผลิต (M)</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">ท้ายล๊อตการผลิต (Z)</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">อื่นๆ</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-12">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">ชิ้นงานสำเร็จรูปจากไลน์ประกอบ (F/G Assembly)</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">เริ่มต้นล๊อตการผลิต (A)</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">กลางล๊อตการผลิต (M)</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">ท้ายล๊อตการผลิต (Z)</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">อื่นๆ</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-12">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">ชิ้นงานสำเร็จรูปจากไลน์ปั๊มชิ้นส่วน (F/G Stemping)</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">เริ่มต้นล๊อตการผลิต (A)</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">กลางล๊อตการผลิต (M)</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">ท้ายล๊อตการผลิต (Z)</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">อื่นๆ</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-12">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">ตรวจสอบตามเงื่อนไขพิเศษ (Special Case as The Customer Requirement)</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">เริ่มต้นล๊อตการผลิต (A)</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">กลางล๊อตการผลิต (M)</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">ท้ายล๊อตการผลิต (Z)</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="input-disable-event">
                    <label class="col-form-label">อื่นๆ</label>
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
                                        <label class="col-form-label">ผ่านตามข้อกำหนด (Passed Dimension)</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="checkbox" class="input-disable-event">
                                        <label class="col-form-label">ไม่ผ่านตามข้อกำหนด (Not Passed Dimension)</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <input type="checkbox" class="input-disable-event">
                                        <label class="col-form-label">อื่นๆ (Others)</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-disable-event">
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
    </div>
    {{--  end-ฝั่ง PQA  --}}
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
        $(document).ready(function() {
            $( "div.alert-success" ).slideUp(600);
        });
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
                    $('#lottag_id').val(ui.item.lottag_id);
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
            $("#production_date").datepicker({
                language: 'th'
            });
            $("#lot_no_fix").datepicker({
                language: 'th'
            });
        });

        $("#is_neck_broken").on( "click", function() {
            if($("#is_neck_broken").is(':checked')){
                $("#neck_broken_y").removeAttr("disabled"); 
                $("#neck_broken_n").removeAttr("disabled"); 
            } else {
                $("#neck_broken_y").attr("disabled", true);
                $("#neck_broken_n").attr("disabled", true);
                $("#neck_broken_y").prop('checked', false);
                $("#neck_broken_n").prop('checked', false);
            }
        });

        $("#is_burr").on( "click", function() {
            if($("#is_burr").is(':checked')){
                $("#burr_y").removeAttr("disabled"); 
                $("#burr_n").removeAttr("disabled"); 
            } else {
                $("#burr_y").attr("disabled", true);
                $("#burr_n").attr("disabled", true);
                $("#burr_y").prop('checked', false);
                $("#burr_n").prop('checked', false);
            }
        });

        $("#is_work_example").on( "click", function() {
            if($("#is_work_example").is(':checked')){
                $("#work_example_y").removeAttr("disabled"); 
                $("#work_example_n").removeAttr("disabled"); 
            } else {
                $("#work_example_y").attr("disabled", true);
                $("#work_example_n").attr("disabled", true);
                $("#work_example_y").prop('checked', false);
                $("#work_example_n").prop('checked', false);
            }
        });

        $("#is_issue").on( "click", function() {
            if($("#is_issue").is(':checked')){
                $("#issue_detail").removeAttr("disabled"); 
            } else {
                $("#issue_detail").attr("disabled", true);
                $("#issue_detail").val(null);
            }
        });

        $("#is_issue_more").on( "click", function() {
            if($("#is_issue_more").is(':checked')){
                $("#issue_more_detail").removeAttr("disabled"); 
            } else {
                $("#issue_more_detail").attr("disabled", true);
                $("#issue_more_detail").val(null);
            }
        });

        $("#is_rm_type_thickness").on( "click", function() {
            if($("#is_rm_type_thickness").is(':checked')){
                $("#rm_type").removeAttr("disabled"); 
                $("#rm_thickness").removeAttr("disabled"); 
            } else {
                $("#rm_type").attr("disabled", true);
                $("#rm_type").val(null);
                $("#rm_thickness").attr("disabled", true);
                $("#rm_thickness").val(null);
            }
        });
    </script>
@endsection
