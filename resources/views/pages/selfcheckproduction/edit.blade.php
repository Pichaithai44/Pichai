@extends('layouts.app')
@section('title', 'Page Title')
@can('user')
    @if(Auth::user()->getAttributes()['department_id'] == 1)
        @section('list', 'เอกสารยืนยันการตรวจสอบชิ้นงานก่อนการผลิต (Self Check Production)')
    @endif
    @if(Auth::user()->getAttributes()['department_id'] == 2)
        @section('list', 'เอกสารตรวจสอบขนาดชิ้นงาน (Data Parts Confirmation By PQA)')
    @endif
@endcan
@can('editor')
    @if(Auth::user()->getAttributes()['department_id'] == 1)
        @section('list', 'เอกสารยืนยันการตรวจสอบชิ้นงานก่อนการผลิต (Self Check Production)')
    @endif
    @if(Auth::user()->getAttributes()['department_id'] == 2)
        @section('list', 'เอกสารตรวจสอบขนาดชิ้นงาน (Data Parts Confirmation By PQA)')
    @endif
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
    <ul class="nav nav-tabs justify-content-end">
        <a class="nav-link"><div class="text-truncate float-left" style="max-width:25rem;">ประเภทชิ้นงาน : <span class="text-primary">{{ $item->job_type ? ($delivery_check[$item->job_type == 'SP' ? 1 : ($item->job_type == 'A' ? 2 : ($item->job_type == 'S' ? 3 : ($item->job_type == 'SCR' ? 4 : null)))]) : 'ยังไม่ได้ถูกเลือก'}}</span></div></a>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('selfcheckproduction/edit/*/0') ? 'active' : null }}" href="{{ route('pages.selfcheckproduction.edit',['id'=> $item->id,'page'=> 0]) }}"> เริ่มต้นล๊อตการผลิต (A)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('selfcheckproduction/edit/*/1') ? 'active' : null }}" href="{{ route('pages.selfcheckproduction.edit',['id'=> $item->id,'page'=> 1]) }}"> กลางล๊อตการผลิต (M)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('selfcheckproduction/edit/*/2') ? 'active' : null }}" href="{{ route('pages.selfcheckproduction.edit',['id'=> $item->id,'page'=> 2]) }}"> ท้ายล๊อตการผลิต (Z)</a>
        </li>
    </ul>
    <br>
@can('admin')
    <div>
@endcan
@can('editor')
    @if(Auth::user()->getAttributes()['department_id'] == 1)
        <div>
    @endif
    @if(Auth::user()->getAttributes()['department_id'] == 2)
        <div style="display: none;">
    @endif
@endcan
@can('user')
    @if(Auth::user()->getAttributes()['department_id'] == 1)
        <div>
    @endif
    @if(Auth::user()->getAttributes()['department_id'] == 2)
        <div style="display: none;">
    @endif
@endcan
    <p>เอกสาร ตอนที่ 1 สถานะ : <span class="{{ $item->production_status == 'C' ? 'text-success' : 'text-warning' }}">{{ $status_name[$item->production_status] }}</span> ผลการตรวจสอบ : <span class="{{$item->production_quality_result == 'T' ? 'text-success' : ($item->production_quality_result == 'F' ? 'text-danger' : 'text-warning')}}">{{ $quality_result_name[$item->production_quality_result] }}</span></p>
        <form action="{{ route('pages.selfcheckproduction.update',['id'=> $item->id,'page'=> $item->page]) }}" method="POST" id="my_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            {{--  data hidden  --}}
            <input type="hidden" name="pre_production_check_id" id="pre_production_check_id" value="{{ $item->pre_production_check_id }}">
            <input type="hidden" name="lottag_id" id="lottag_id" value="{{ old('lottag_id') }}">
            <input type="hidden" name="job_type" id="job_type" value="{{ $item->job_type }}">
            <input type="hidden" name="job_check" id="job_check" value="{{ old('job_check') }}">
            <input type="hidden" name="total_check_result" id="total_check_result" value="{{ old('total_check_result') }}">
    
            <div class="form-group row">
                <label class="col-2 col-form-label">วันที่ผลิต (Production Data)</label>
                <div class="col-2">
                    <input class="form-control text-left @can('user') input-disable-event @endcan" type="text" name="production_date" id="production_date" value="{{ old('production_date') ? old('production_date') : $item->production_date }}" data-date-format="dd/mm/yyyy" />
                </div>
    
                <label class="col-3 col-form-label">จำนวนที่ผลิต (Production Order)</label>
                <div class="col-1">
                <input class="form-control text-left @can('user') input-disable-event @endcan" type="text" name="production_order" id="production_order" value="{{ old('production_order') ? old('production_order') : $item->production_order}}"/>
                </div>
    
                <label class="col-2 col-form-label">เลขที่ล็อต (Lot No.)</label>
                <div class="col-1">
                <input class="form-control text-left @can('user') input-disable-event @endcan" type="text" name="lot_no_fix" id="lot_no_fix" value="{{ $item->lot_no_fix }}" data-date-format="yymmdd"/>
                </div>
                <div class="col-1">
                <input class="form-control text-left {{$errors->has('lot_no') ? 'errors-has-danger' : null}} @can('user') input-disable-event @endcan" type="text" maxlength="2" placeholder="xx" name="lot_no" value="{{ old('lot_no') ? old('lot_no') : '0'.(intval($item->lot_no[0])+$item->page) }}"/>
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
                <div class="col-6">
                    <input class="form-control text-left {{$errors->has('part_no') ? 'errors-has-danger' : null}} @can('user') input-disable-event @endcan" type="text" name="part_no" value="{{ old('part_no') ? old('part_no') : $item->part_no }}" id="part_no"/>
                </div>
                <div class="col-2">
                    <select class="form-control" name="process" id="process">
                        @foreach($item->processOption as $m)
                        <option value="{{ $m['id'] }}" {{ old('process') ? (old('process') == $m['id'] ? 'selected' : null) : ($item->process_id == $m['id'] ? 'selected' : null) }}>{{ $m['name'] }}</option>
                        @endforeach
                    </select>
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

                    @can('admin') 
                    <select class="form-control" name="customer" id="customer">
                        @foreach($customerOption as $m)
                        <option value="{{ $m['id'] }}" {{ old('customer') ? (old('customer') == $m['name'] ? 'selected' : null): ($item->customer_name == $m['name']) ? 'selected' : null }}>{{ $m['name'] }}</option>
                        @endforeach
                    </select>
                    @endcan

                    @can('editor') 
                    <select class="form-control" name="customer" id="customer">
                        @foreach($customerOption as $m)
                        <option value="{{ $m['id'] }}" {{ old('customer') ? (old('customer') == $m['name']): ($item->customer_name == $m['name']) ? 'selected' : null }}>{{ $m['name'] }}</option>
                        @endforeach
                    </select>
                    @endcan

                    @can('user') 
                    <input class="form-control text-left input-disable-event" type="text" name="customer" id="customer" value="{{ old('customer') ? old('customer') : $item->customer_name }}"/>
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
                @can('user') 
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
                            <input type="radio" name="at_shlft" id="01" value="01" {{ $item->at_shlft == '01' ? 'checked' : null }} class="form-check-input @can('user') input-disable-event @endcan">
                            <label for="01" class="form-check-label @can('user') input-disable-event @endcan">01</label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" name="at_shlft" id="02" value="02" {{ $item->at_shlft == '02' ? 'checked' : null }} class="form-check-input @can('user') input-disable-event @endcan">
                            <label for="02" class="form-check-label @can('user') input-disable-event @endcan">02</label>
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
                    <input class="form-control text-left @can('user') input-disable-event @endcan" type="text" id="quality_important" name="quality_important"/>
               </div>
            </div>
    
            <div class="form-group row">
                    <div class="col-3">
                        <input type="checkbox" class="@can('user') input-disable-event @endcan" name="is_rm_type_thickness" id="is_rm_type_thickness" {{ $item->type_name  || $item->material_t ? 'checked' : null }}>
                        <label class="col-form-label @can('user') input-disable-event @endcan" for="rm_type">วัตถุดิบที่กำหนด (R/M Type):</label>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control @can('user') input-disable-event @endcan" id="rm_type" name="rm_type" {{ $item->type_name ? null : 'disabled'  }} value="{{ $item->type_name }}">
                    </div>
                    <div class="col-3">
                        <label class="col-form-label @can('user') input-disable-event @endcan" for="rm_thickness">ความหนาวัตถุดิบ (R/M Thickness):</label>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control @can('user') input-disable-event @endcan" id="rm_thickness" name="rm_thickness" {{ $item->material_t ? null : 'disabled'  }} value="{{ $item->material_t }}">
                    </div>
                    <div class="col-1">
                        <label class="col-form-label @can('user') input-disable-event @endcan">mm</label>
                    </div>                    
            </div>
    
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="checkbox" class="@can('user') input-disable-event @endcan" id="is_neck_broken" name="is_neck_broken" {{ $item->neck_broken ? 'checked' : null  }}>
                    <label for="is_neck_broken" class="col-form-label @can('user') input-disable-event @endcan">การยืดตัวและฉีกขาดของชิ้นงาน (Neck & Broken)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" id="neck_broken_y" name="neck_broken" value="Y" class="@can('user') input-disable-event @endcan" {{ $item->neck_broken ? ($item->neck_broken == 'Y' ? 'checked' : null) : 'disabled'  }}>
                    <label for="neck_broken_y" class="col-form-label @can('user') input-disable-event @endcan">คุณภาพผ่าน</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" id="neck_broken_n" name="neck_broken" value="N" class="@can('user') input-disable-event @endcan" {{ $item->neck_broken ? ($item->neck_broken == 'N' ? 'checked' : null) : 'disabled'  }}>
                    <label for="neck_broken_n" class="col-form-label @can('user') input-disable-event @endcan">คุณภาพไม่ผ่าน</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="checkbox" class="@can('user') input-disable-event @endcan" id="is_burr" name="is_burr" {{ $item->burr ? 'checked' : null  }}>
                    <label for="is_burr" class="col-form-label @can('user') input-disable-event @endcan">ชิ้นงานมีครีบคมตัดเฉื่อน (ฺBurr)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" id="burr_y" name="burr" value="Y" class="@can('user') input-disable-event @endcan" {{ $item->burr ? ($item->burr == 'Y' ? 'checked' : null) : 'disabled' }}>
                    <label for="burr_y" class="col-form-label @can('user') input-disable-event @endcan">คุณภาพผ่าน</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" id="burr_n" name="burr" value="N" class="@can('user') input-disable-event @endcan" {{ $item->burr ? ($item->burr == 'N' ? 'checked' : null) : 'disabled' }}>
                    <label for="burr_n" class="col-form-label @can('user') input-disable-event @endcan">คุณภาพไม่ผ่าน</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="checkbox" class="@can('user') input-disable-event @endcan" id="is_work_example" name="is_work_example" {{ $item->work_example ? 'checked' : null }}>
                    <label for="is_work_example" class="col-form-label @can('user') input-disable-event @endcan">ความแตกต่างระหว่างชิ้นงานจริงกับชิ้นงานตัวอย่าง</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" id="work_example_y" name="work_example" value="Y" class="@can('user') input-disable-event @endcan" {{ $item->work_example ? ($item->work_example == 'Y' ? 'checked' : null) : 'disabled' }}>
                    <label for="work_example_y" class="col-form-label @can('user') input-disable-event @endcan">คุณภาพผ่าน</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" id="work_example_n" name="work_example" value="N" class="@can('user') input-disable-event @endcan" {{ $item->work_example ? ($item->work_example == 'N' ? 'checked' : null) : 'disabled' }}>
                    <label for="work_example_n" class="col-form-label @can('user') input-disable-event @endcan">คุณภาพไม่ผ่าน</label>
                </div>
            </div>
        
            <div class="form-group row">
                <div class="col-md-3 offset-md-1">
                    <input type="checkbox" class="@can('user') input-disable-event @endcan" id="is_issue" name="is_issue" {{ old('issue_detail') ? (old('issue_detail')  ? 'checked' : null) : ($item->issue_detail ? 'checked' : null) }}>
                    <label for="is_issue" class="col-form-label @can('user') input-disable-event @endcan">ปัญหาอะไร ?</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="issue_detail" name="issue_detail" class="form-control @can('user') input-disable-event @endcan" style="width:100%;" value="{{ $item->issue_detail }}" {{ old('issue_detail') ? (old('issue_detail') ? null : 'disabled') : ($item->issue_detail ? null : 'disabled') }}>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-3 offset-md-1">
                    <input type="checkbox" class="@can('user') input-disable-event @endcan" id="is_issue_more" name="is_issue_more" {{ old('issue_more_detail') ? (old('issue_more_detail') ? 'checked' : null) : ($item->issue_more_detail ? 'checked' : null) }}>
                    <label for="is_issue_more" class="col-form-label @can('user') input-disable-event @endcan">เป็นปัญหาอีกหรือไม่</label>
                </div>
                <div class="col-md-8">
                    <input type="text" id="issue_more_detail" name="issue_more_detail" class="form-control @can('user') input-disable-event @endcan" style="width:100%;" value="{{ $item->issue_more_detail }}" {{ old('issue_more_detail') ? (old('issue_more_detail') ? null : 'disabled') : ($item->issue_more_detail ? null : 'disabled') }}>
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
                                        <input type="radio" class="@can('user') input-disable-event @endcan" value="T" name="production_quality_result" id="quality_result_t" {{ $item->production_status == 'C' ? ($item->production_quality_result == 'T' ? 'checked' : null) : null }}>
                                        <label for="quality_result_t" class="col-form-label @can('user') input-disable-event @endcan">ผ่านตามข้อกำหนดคุณภาพเบื้องต้น (Quick Qualily Check)</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="radio" class="@can('user') input-disable-event @endcan" value="F" name="production_quality_result" id="quality_result_f" {{ $item->production_status == 'C' ? ($item->production_quality_result == 'F' ? 'checked' : null) : null }}>
                                        <label for="quality_result_f" class="col-form-label @can('user') input-disable-event @endcan">ไม่ผ่านตามข้อกำหนดคุณภาพเบื้องต้น (Quick Qualily Check)</label>
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
                                <input type="text"class="form-control @can('user') input-disable-event @endcan" id="supervisor_pd" name="supervisor_pd" value="{{ old('supervisor_pd') ? old('supervisor_pd') : $item->supervisor_pd_name }}">
                            </div>
                            <div class="col-md-2">
                                <input type="text"class="form-control @can('user') input-disable-event @endcan" id="supervisor_pd_id" name="supervisor_pd_id" value="{{ old('supervisor_pd_id') ? old('supervisor_pd_id') : $item->supervisor_pd }}">
                            </div>
                        </div>
                    </div>
            </div>
        {{--  </form>  --}}
        {{--  end-Production  --}}
</div>
    
@can('admin')
    <div>
@endcan
@can('editor')
    @if(Auth::user()->getAttributes()['department_id'] == 1)
        <div style="display: none;">
    @endif
    @if(Auth::user()->getAttributes()['department_id'] == 2)
        <div>
    @endif
@endcan
@can('user')
    @if(Auth::user()->getAttributes()['department_id'] == 1)
        <div style="display: none;">
    @endif
    @if(Auth::user()->getAttributes()['department_id'] == 2)
        <div>
    @endif
@endcan

    
        {{--  ฝั่ง PQA  --}}
        <p>เอกสาร ตอนที่ 2 สถานะ : <span class="{{ $item->pqa_status == 'C' ? 'text-success' : 'text-warning' }}">{{ $status_name[$item->pqa_status] }}</span> ผลการตรวจสอบ : <span class="{{$item->pqa_quality_result[0] == 'T' ? 'text-success' : ($item->pqa_quality_result[0] == 'F' ? 'text-danger' : 'text-warning')}}">{{ $quality_result_name[$item->pqa_quality_result[0]] }}</span></p>
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            {{--  data hidden  --}}
            <input type="hidden" name="pre_production_check_id" id="pre_production_check_id" value="{{ $item->pre_production_check_id }}">
    
            <div class="form-group row">
                <label class="col-4 col-form-label">วันที่ผลิต (Production Data)</label>
                <div class="col-2">
                <input class="form-control text-left input-disable-event" type="text" name="production_date" id="production_date" value="{{ old('production_date') ? old('production_date') : $item->production_date }}"/>
                </div>
    
                <label class="col-2 col-form-label">กะผลิต (At Shlft)</label>
                <div class="col-4">
                    <div class="form-group row">
                      
                        <div class="col-md-6">
                            <input type="radio" name="at_shlft_one" id="01" value="01" {{ $item->at_shlft == '01' ? 'checked' : null }} class="form-check-input input-disable-event">
                            <label for="01" class="form-check-label input-disable-event">01</label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" name="at_shlft_one" id="02" value="02" {{ $item->at_shlft == '02' ? 'checked' : null }} class="form-check-input input-disable-event">
                            <label for="02" class="form-check-label input-disable-event">02</label>
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
                <input class="form-control text-left {{$errors->has('part_no') ? 'errors-has-danger' : null}} input-disable-event" type="text" name="part_no" value="{{ old('part_no') ? old('part_no') : $item->part_no.' ('.$item->processName.')' }}" id="part_no"/>
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
                            <input type="radio" name="at_shlft_two" id="01" value="01" {{ $item->at_shlft == '01' ? 'checked' : null }} class="form-check-input input-disable-event">
                            <label for="01" class="form-check-label input-disable-event">01</label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" name="at_shlft_two" id="02" value="02" {{ $item->at_shlft == '02' ? 'checked' : null }} class="form-check-input input-disable-event">
                            <label for="02" class="form-check-label input-disable-event">02</label>
                        </div>
                  
                    </div>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-12">
                    <input type="radio" class="input-disable-event" {{ $item->job_type == 'SP' ? 'checked' : null }}>
                    <label class="col-form-label">ชิ้นงานระหว่างกระบวนการ (Semi Part)</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event" {{ ($item->job_type == 'SP') && ($item->page == 0) ? 'checked' : null }}>
                    <label class="col-form-label">เริ่มต้นล๊อตการผลิต (A)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event" {{ ($item->job_type == 'SP') && ($item->page == 1) ? 'checked' : null }}>
                    <label class="col-form-label">กลางล๊อตการผลิต (M)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event" {{ ($item->job_type == 'SP') && ($item->page == 2) ? 'checked' : null }}>
                    <label class="col-form-label">ท้ายล๊อตการผลิต (Z)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event">
                    <label class="col-form-label">อื่นๆ</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-12">
                    <input type="radio" class="input-disable-event" {{ $item->job_type == 'A' ? 'checked' : null }}>
                    <label class="col-form-label">ชิ้นงานสำเร็จรูปจากไลน์ประกอบ (F/G Assembly)</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event" {{ ($item->job_type == 'A') && ($item->page == 0) ? 'checked' : null }}>
                    <label class="col-form-label">เริ่มต้นล๊อตการผลิต (A)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event" {{ ($item->job_type == 'A') && ($item->page == 1) ? 'checked' : null }}>
                    <label class="col-form-label">กลางล๊อตการผลิต (M)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event" {{ ($item->job_type == 'A') && ($item->page == 2) ? 'checked' : null }}>
                    <label class="col-form-label">ท้ายล๊อตการผลิต (Z)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event">
                    <label class="col-form-label">อื่นๆ</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-12">
                    <input type="radio" class="input-disable-event" {{ $item->job_type == 'S' ? 'checked' : null }}>
                    <label class="col-form-label">ชิ้นงานสำเร็จรูปจากไลน์ปั๊มชิ้นส่วน (F/G Stemping)</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event" {{ ($item->job_type == 'S') && ($item->page == 0) ? 'checked' : null }}>
                    <label class="col-form-label">เริ่มต้นล๊อตการผลิต (A)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event" {{ ($item->job_type == 'S') && ($item->page == 1) ? 'checked' : null }}>
                    <label class="col-form-label">กลางล๊อตการผลิต (M)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event" {{ ($item->job_type == 'S') && ($item->page == 2) ? 'checked' : null }}>
                    <label class="col-form-label">ท้ายล๊อตการผลิต (Z)</label>
                </div>
                <div class="col-md-3">
                   
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="radio" class="input-disable-event">
                            <label class="col-form-label">อื่นๆ</label>
                        </div>
                    </div> 
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-12">
                    <input type="radio" class="input-disable-event" {{ $item->job_type == 'SCR' ? 'checked' : null }}>
                    <label class="col-form-label">ตรวจสอบตามเงื่อนไขพิเศษ (Special Case as The Customer Requirement)</label>
                </div>
            </div>
    
            <div class="form-group row">
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event" {{ ($item->job_type == 'SCR') && ($item->page == 0) ? 'checked' : null }}>
                    <label class="col-form-label">เริ่มต้นล๊อตการผลิต (A)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event" {{ ($item->job_type == 'SCR') && ($item->page == 1) ? 'checked' : null }}>
                    <label class="col-form-label">กลางล๊อตการผลิต (M)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event" {{ ($item->job_type == 'SCR') && ($item->page == 2) ? 'checked' : null }}>
                    <label class="col-form-label">ท้ายล๊อตการผลิต (Z)</label>
                </div>
                <div class="col-md-3">
                    <input type="radio" class="input-disable-event">
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
                                        <input type="radio" class="@can('user') input-disable-event @endcan" value="T" id="pqa_quality_result_t" name="pqa_quality_result" {{ $item->pqa_status == 'C' ? ($item->pqa_quality_result[0] == 'T' ? 'checked' : null) : (old('pqa_quality_result') == 'T' ? 'checked' : null) }}>
                                        <label for="pqa_quality_result_t" class="col-form-label @can('user') input-disable-event @endcan">ผ่านตามข้อกำหนด (Passed Dimension)</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="radio" class="@can('user') input-disable-event @endcan" value="F" id="pqa_quality_result_f" name="pqa_quality_result" {{ $item->pqa_status == 'C' ? ($item->pqa_quality_result[0] == 'F' ? 'checked' : null) : (old('pqa_quality_result') == 'F' ? 'checked' : null) }}>
                                        <label for="pqa_quality_result_f" class="col-form-label @can('user') input-disable-event @endcan">ไม่ผ่านตามข้อกำหนด (Not Passed Dimension)</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <input type="checkbox" class="@can('user') input-disable-event @endcan" id="is_other_comment" name="is_other_comment" {{ old('other_comment') ? (old('other_comment') ? 'checked' : null) : ($item->pqa_quality_result[1] ? 'checked' : null) }}>
                                        <label class="col-form-label @can('user') input-disable-event @endcan" for="is_other_comment">อื่นๆ (Others)</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control @can('user') input-disable-event @endcan" id="other_comment" name="other_comment" value="{{ old('other_comment') ? old('other_comment') : $item->pqa_quality_result[1] }}" {{ old('other_comment') ? (old('other_comment') ? null : 'disabled') : ($item->pqa_quality_result[1] ? null : 'disabled') }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group row">
                            <label class="col-form-label">หัวหน้างาน (Supervisor): </label>
                            <div class="col-md-4">
                                <input type="text"class="form-control @can('user') input-disable-event @endcan" id="supervisor_pqa" name="supervisor_pqa" value="{{ old('supervisor_pqa') ? old('supervisor_pqa') : $item->supervisor_pqa_name }}">
                            </div>
                            <div class="col-md-2">
                                <input type="text"class="form-control @can('user') input-disable-event @endcan" id="supervisor_pqa_id" name="supervisor_pqa_id" value="{{ old('supervisor_pqa_id') ? old('supervisor_pqa_id') : $item->supervisor_pqa }}">
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
            @can('admin')
                <button class="btn btn-primary"  id="save">บันทึกการยืนยัน</button>
            @endcan
            @can('editor')
                <button class="btn btn-primary"  id="save">บันทึกการยืนยัน</button>
            @endcan
        </div>
    </div>
    <div id="dialog_total" title="แจ้งจำนวนที่ผลิตได้" style="display: none;">
        <div class="row">
            <div class="reload-status" id="reload_status_total">
                <i class="fas fa-spinner fa-pulse fa-3x"></i>
            </div>
            <label class="col-5 col-form-label">จำนวนที่ผลิตได้จริง</label>
            <input class="col-7 form-control" name="total_check" id="total_check">
        </div>
        <br>
        <sub class="text-danger" style="display: none;" id="validate_delivery_check_total"><i>-- กรุณากรอกจำนวนที่ผลิตได้จริง --</i></sub>
    </div>
    <div id="dialog" title="เลือกประเภทชิ้นงาน" style="display: none;">
        <div class="row">
            <div class="reload-status" id="reload_status">
                <i class="fas fa-spinner fa-pulse fa-3x"></i>
            </div>
            <label class="col-5 col-form-label">ประเภทชิ้นงาน</label>
            <select class="col-7 form-control" name="delivery_check" id="delivery_check">
                @foreach($delivery_check as $key => $m)
                    <option value="{{ $key }}">{{ $m }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <sub class="text-danger" style="display: none;" id="validate_delivery_check"><i>-- กรุณาเลือกประเภทงาน --</i></sub>
    </div>
@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $( "#reload_status" ).hide();
            $( "#reload_status_total" ).hide();
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
                    $('#process option').remove();
                    $('#process').append($('<option>', {
                            value: null,
                            text : '-- กรุณาเลือก --' 
                        }));
                    $.each(ui.item.process,function(i, item){
                        $('#process').append($('<option>', {
                            value: item.id,
                            text : item.name 
                        }));
                    });
                    document.getElementById("PartNumber_2").value = ui.item.value;
                    document.getElementById("PartName_2").value = ui.item.part_name;
                    document.getElementById("Model_2").value = ui.item.model_name;
                    document.getElementById("Customer_2").value = ui.item.customer_name;
                    document.getElementById("AtProductionLine_2").value = ui.item.production_line;
                }
            });
            $( "#supervisor_pd" ).autocomplete({
                source: "{{ route('pages.selfcheckproduction.autocompletesupervisor') }}",
                minlenght:1,
                autoFocus:true,
                select: function(event, ui) {
                    $('#supervisor_pd').val(ui.item.value);
                    $('#supervisor_pd_id').val(ui.item.id);
                }
            });
            $( "#supervisor_pd_id" ).autocomplete({
                source: "{{ route('pages.selfcheckproduction.autocompletesupervisorid') }}",
                minlenght:1,
                autoFocus:true,
                select: function(event, ui) {
                    $('#supervisor_pd_id').val(ui.item.value);
                    $('#supervisor_pd').val(ui.item.name);
                }
            });
            $( "#supervisor_pqa" ).autocomplete({
                source: "{{ route('pages.selfcheckproduction.autocompletesupervisor') }}",
                minlenght:1,
                autoFocus:true,
                select: function(event, ui) {
                    $('#supervisor_pqa').val(ui.item.value);
                    $('#supervisor_pqa_id').val(ui.item.id);
                }
            });
            $( "#supervisor_pqa_id" ).autocomplete({
                source: "{{ route('pages.selfcheckproduction.autocompletesupervisorid') }}",
                minlenght:1,
                autoFocus:true,
                select: function(event, ui) {
                    $('#supervisor_pqa_id').val(ui.item.value);
                    $('#supervisor_pqa').val(ui.item.name);
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

        $("#save").on( "click", function() {
            if(!$("#job_type").val() && "{{ Auth::user()->getAttributes()['department_id'] != 2 }}"){
            $( "#dialog" ).dialog({
                position: { my: "top", at: "top", of: window },
                dialogClass: "no-close",
                buttons: [
                    {
                        text: "บันทึก",
                        click: function() {
                            if($( "select#delivery_check option:checked" ).val() != '0'){
                                $( "#reload_status" ).show();
                                $( "#validate_delivery_check" ).hide();
                                document.getElementById('my_form').submit();
                                setTimeout(() => {
                                $( this ).dialog( "close" );
                                }, 5000);
                            }else{
                                $( "#validate_delivery_check" ).show(); 
                            }
                        }
                    },
                    {
                        text : "ปิด",
                        click: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                ]
            });
            } else if("{{$item->page == 2}}" && "{{ Auth::user()->getAttributes()['department_id'] != 2 }}"){
                $( "#dialog_total" ).dialog({
                position: { my: "top", at: "top", of: window },
                dialogClass: "no-close",
                buttons: [
                    {
                        text: "บันทึก",
                        click: function() {
                            if($("#total_check").val()){
                                $( "#reload_status_total" ).show();
                                $( "#validate_delivery_check_total" ).hide();
                                document.getElementById('my_form').submit();
                                setTimeout(() => {
                                $( this ).dialog( "close" );
                                }, 5000);
                            }else{
                                $( "#validate_delivery_check_total" ).show(); 
                            }
                        }
                    },
                    {
                        text : "ปิด",
                        click: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                ]
            });
            } else {
                document.getElementById('my_form').submit();
            }
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

        $("#is_other_comment").on( "click", function() {
            if($("#is_other_comment").is(':checked')){
                $("#other_comment").removeAttr("disabled"); 
            } else {
                $("#other_comment").attr("disabled", true);
                $("#other_comment").val(null);
            }
        });

        $( "#delivery_check" ).change(function(val) {
            $('#job_check').val(val.target.value);
        });
        $( "#total_check" ).keyup(function() {
            var value = $( this ).val();
            $( "#total_check_result" ).val( value );
        })
        .keyup();
    </script>
@endsection
