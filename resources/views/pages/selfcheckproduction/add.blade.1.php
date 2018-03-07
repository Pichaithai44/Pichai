<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Self Check Production</title>
        @include('layouts.mater')
    </head>
    <body class="root">
        <form action="{{ route('pages.selfcheckproduction.create') }}" method="POST" id="my_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            {{--  data hidden  --}}
            <input type="hidden" name="production_date" value="{{ $toDate }}">
            <input type="hidden" name="pre_production_check_id" id="pre_production_check_id">
            <input type="hidden" name="lottag_id" id="lottag_id">

            <div class="row">
                    <div class="col-12 left-show">
                    {{--  <div class="col-md-6 left-show">  --}}
                            <div class="container-fluid border-box">
                                    <div class="row margin-box">
                                        <div class="col-md-2 border-box border-box-print-left" style="padding: 0;">
                                            <img src="/img/logo.png" class="img-logo">
                                        </div>
                                        <div class="col-md-8 border-box text-center border-box-print-center text-h1">เอกสารยืนยันการตรวจสอบชิ้นงานก่อนการผลิต<br>(Self Check Production)</div>
                                        <div class="col-md-2 border-box text-center border-box-print-right text-h3">เอกสาร<br>ตอนที่ 1</div>
                                    </div>
                                    {{--  วันที่ผลิต/จำนวนที่ผลิต/เลขที่ล็อต  --}}
                                    <div class="row">
                    
                                        {{--  วันที่ผลิต  --}}
                                        <div class="col-form-label col-md-3">
                                            <label>วันที่ผลิต <span class="box-border-black">{{ $toDate }}</span>
                                                <br>
                                                <sub>(Production Data)</sub>
                                            </label>
                                            
                                        </div>
                    
                                        {{--  จำนวนที่ผลิต  --}}
                                        <div class="col-md-5">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4 page-4-to-6" for="ProductionOrder">จำนวนที่ผลิต</label>
                                                <div class="col-md-6 page-6-to-4 page-print">
                                                    <input type="text" name="Production_Order" style="padding: 0.1rem;" class="form-control-plaintext box-border-black input-disable-event" id="ProductionOrder">
                                                </div>
                                                <div class="col-form-label col-md-2 page-print">
                                                    <span>ชิ้น</span>
                                                </div>
                                                <sub>(Production Order)</sub>
                                            </div>
                                        </div>
                    
                                        {{--  เลขที่ล็อต  --}}
                                        <div class="col-form-label col-md-4 page-print">
                                            <label>เลขที่ล็อต
                                                <span class="box-border-black">{{ date('ymd') }}</span>
                                                <input type="text" class="box-border-black lotno" maxlength="2" placeholder="xx" name="lot_no">
                                                <br>
                                                <sub>(Lot No.)</sub>
                                            </label>
                                        </div>
                                    </div>
                    
                                    {{--  หมายเลขที่ผลิต  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 page-3-to-5" for="PartNumber">1. หมายเลขที่ผลิต<br><sub>(Part Number)</sub></label>
                                                <div class="col-md-6 page-print">
                                                    <input type="text" name="Part_Name" class="form-control-plaintext box-border-black" value="{{ @$item->part_name }}" id="PartNumber">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  ชื่อชิ้นงาน  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 page-3-to-5" for="PartName">2. ชื่อชิ้นงาน<br><sub>(Part Name)</sub></label>
                                                <div class="col-md-6 page-print">
                                                    <input type="text" name="Part_Name" class="form-control-plaintext box-border-black input-disable-event" value="{{ @$item->part_name }}" id="PartName">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  ชื่อรุ่นชิ้นงาน / ลูกค้า  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 page-3-to-5" for="Model">3. ชื่อรุ่นชิ้นงาน / ลูกค้า<br><sub>(Model / Customer)</sub></label>          
                                                <div class="col-md-3 page-print">
                                                    <input name="Model" class="form-control-plaintext box-border-black input-disable-event" id="Model" value="{{ @$item->model_name }}"/>
                                                </div>
                                                <span>/</span>
                                                <div class="col-md-3">
                                                    <input name="Customer" class="form-control-plaintext box-border-black input-disable-event" id="Customer" value="{{ @$item->customer_name }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  ไลน์การผลิต  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 page-3-to-5" for="AtProductionLine">4. ไลน์การผลิต<br><sub>(At Production Line)</sub></label>
                                                <div class="col-md-6 page-6-to-3 page-print">
                                                    <input name="At_Production_Line" class="form-control-plaintext box-border-black input-disable-event" id="AtProductionLine" value="{{ @$item->line_name }}"/>
                                                </div>
                                                <div class="col-md-3 page-3-to-4 page-print">
                                                    <div class="form-group row">
                                                        <div class="col-md-4 page-4-to-6 ">
                                                            <label class="col-form-label">กะผลิต<br><sub>(At Shlft)</sub></label>
                                                        </div>
                                                        @foreach($atShlft as $as)
                                                        <div class="col-md-4  page-4-to-3 no-padding">
                                                            <i class="far {{ $as['check'] ? 'fa-check-square' : 'fa-square' }} fa-2x"></i>
                                                            {{--  <input type="checkbox" name="At_Shlft" id="{{ 'AtShlf'.$as['value'] }}" value="{{ $as['value'] }}" {{ $as['check'] ? 'checked' : null }} class="input-disable-event">  --}}
                                                            <label class="col-form-label input-disable-event text-check-box" for="{{ 'AtShlf'.$as['value'] }}">{{ $as['value'] }}</label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  อ้างอิงหมายเลขเอกสารตรวจสอบ  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 page-3-to-5" for="QPointSheet">5. อ้างอิงหมายเลขเอกสารตรวจสอบ<br><sub>(Q-Point Sheet)</sub></label>
                                                <div class="col-md-6 page-print">
                                                    <input type="text" name="Q_Point_Sheet" class="form-control-plaintext box-border-black input-disable-event" id="QPointSheet" value="{{ @$item->sheet_id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  จุดสำคัญของการควบคุมคุณภาพชิ้นส่วน  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 page-3-to-5" for="QualityImportant">6. จุดสำคัญของการควบคุมคุณภาพชิ้นส่วน<br><sub>(Quality Important)</sub></label>
                                                <div class="col-md-6 page-print">
                                                    <input type="text" class="form-control-plaintext box-border-black input-disable-event" id="QualityImportant">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  การยืดตัวและฉีกขาดของชิ้นงาน  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <div class="col">
                                                    <i class="far fa-square fa-2x"></i>
                                                    {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                    <label class="col-form-label">วัตถุดิบที่กำหนด (R/M Type):</label>
                                                    <input type="text" class="box-border-black input-disable-event border-none-rl page-4-to-2">
                                                    <span class="col-form-label">ความหนาวัตถุดิบ (R/M Thickness):</span>
                                                    <input type="text" class="box-border-black input-disable-event border-none-rl page-4-to-2">
                                                    <span class="col-form-label">mm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  การยืดตัวและฉีกขาดของชิ้นงาน  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <i class="far fa-square fa-2x"></i>
                                                    {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                    <label class="col-form-label text-check-box">การยืดตัวและฉีกขาดของชิ้นงาน (Neck & Broken)</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="far fa-square fa-2x"></i>
                                                    {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                    <label class="col-form-label text-check-box">คุณภาพผ่าน</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="far fa-square fa-2x"></i>
                                                    {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                    <label class="col-form-label text-check-box">คุณภาพไม่ผ่าน</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  ชิ้นงานมีครีบคมตัดเฉื่อน  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <i class="far fa-square fa-2x"></i>
                                                    {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                    <label class="col-form-label text-check-box">ชิ้นงานมีครีบคมตัดเฉื่อน (ฺBurr)</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="far fa-square fa-2x"></i>
                                                    {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                    <label class="col-form-label text-check-box">คุณภาพผ่าน</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="far fa-square fa-2x"></i>
                                                    {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                    <label class="col-form-label text-check-box">คุณภาพไม่ผ่าน</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  ความแตกต่างระหว่างชิ้นงานจริงกับชิ้นงานตัวอย่าง  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <i class="far fa-square fa-2x"></i>
                                                    {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                    <label class="col-form-label text-check-box">ความแตกต่างระหว่างชิ้นงานจริงกับชิ้นงานตัวอย่าง</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="far fa-square fa-2x"></i>
                                                    {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                    <label class="col-form-label text-check-box">คุณภาพผ่าน</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <i class="far fa-square fa-2x"></i>
                                                    {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                    <label class="col-form-label text-check-box">คุณภาพไม่ผ่าน</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  ปัญหาอะไร ?  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <div class="col-md-3 offset-md-1">
                                                    <i class="far fa-square fa-2x"></i>
                                                    {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                    <label class="col-form-label text-check-box">ปัญหาอะไร ?</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class=" box-border-black input-disable-event border-none-rl" style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  เป็นปัญหาอีกหรือไม่  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <div class="col-md-3 offset-md-1">
                                                    <i class="far fa-square fa-2x"></i>
                                                    {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                    <label class="col-form-label text-check-box">เป็นปัญหาอีกหรือไม่</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class=" box-border-black input-disable-event border-none-rl" style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  ผลการตรวจสอบ  --}}
                                    <div class="container-fluid border-box border-box-padding">
                                        <div class="row" style="margin: 0;">
                                            <label>ผลการตรวจสอบ (Quality Result)</label>
                                        </div>
                                        <div class="row" style="margin: 0;">
                                            <div class="col-md-4 box-dotted box-null"></div>
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <i class="far fa-square fa-2x"></i>
                                                        {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                        <label class="col-form-label text-check-box">ผ่านตามข้อกำหนดคุณภาพเบื้องต้น (Quick Qualily Check)</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <i class="far fa-square fa-2x"></i>
                                                        {{--  <input type="checkbox" class="input-disable-event">  --}}
                                                        <label class="col-form-label text-check-box">ไม่ผ่านตามข้อกำหนดคุณภาพเบื้องต้น (Quick Qualily Check)</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="col-form-label">-กรณีไม่ผ่านแจ้งระดับหัวหน้าที่สูงขึ้น และ/หรือ ผู้จัดการทันที</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   
                                        {{--  หัวหน้างาน  --}}
                                        <div class="row" style="margin: 0;">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <label class="col-form-label">หัวหน้างาน (Supervisor): </label>
                                                    <div class="col-md-4">
                                                        <input type="text"class=" box-border-black border-none-rl" style="width:100%;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                </div>
                    </div>
                    
                    {{--  <div class="col-12">  --}}
                    <div class="col-md-6 right-show">
                            <div class="container-fluid border-box">
                                    <div class="row margin-box">
                                        <div class="col-md-2 border-box border-box-print-left" style="padding: 0;">
                                            <img src="/img/logo.png" class="img-logo">
                                        </div>
                                        <div class="col-md-8 border-box text-center border-box-print-center text-h1">เอกสารตรวจสอบขนาดชิ้นงาน<br>(Data Parts Confirmation By PQA)</div>
                                        <div class="col-md-2 border-box text-center border-box-print-right text-h3">เอกสาร<br>ตอนที่ 2</div>
                                    </div>
                                    {{--  วันที่ผลิต/จำนวนที่ผลิต/เลขที่ล็อต  --}}
                                    <div class="row">
                    
                                        {{--  วันที่ผลิต  --}}
                                        <div class="col-form-label col-md-5">
                                            <label>วันที่ผลิต (Production Data):<span class="box-border-black"> {{ date('d') }} / {{ date('m') }} / {{ date('Y') }}</span></label>
                                        </div>
                    
                                        {{--  ไลน์การผลิต  --}}
                                        <div class="col-md-6 ">
                                                <div class="form-group row">
                                                    <label class="col-form-label">กะผลิต (At Shlft)</label>
                                                    @foreach($atShlft as $as)
                                                    <div class="col-md-4">
                                                        <i class="far {{ $as['check'] ? 'fa-check-square' : 'fa-square' }} fa-2x"></i>
                                                        {{--  <input type="checkbox" name="At_Shlft" id="{{ 'AtShlf'.$as['value'] }}" value="{{ $as['value'] }}" {{ $as['check'] ? 'checked' : null }} class="input-disable-event">  --}}
                                                        <label class="col-form-label input-disable-event text-check-box-at" for="{{ 'AtShlf'.$as['value'] }}">{{ $as['value'] }}</label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                    </div>
                    
                                    {{--  หมายเลขที่ผลิต  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 page-3-to-5" for="PartNumber_2">1. หมายเลขที่ผลิต<br><sub>(Part Number)</sub></label>
                                                <div class="col-md-6 page-print">
                                                    <input name="Part_Number" class="form-control-plaintext box-border-black" id="PartNumber_2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                     {{--  ชื่อชิ้นงาน  --}}
                                     <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 page-3-to-5" for="PartName_2">2. ชื่อชิ้นงาน<br><sub>(Part Name)</sub></label>
                                                <div class="col-md-6 page-print">
                                                    <input type="text" name="Part_Name" class="form-control-plaintext box-border-black input-disable-event" id="PartName_2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  ชื่อรุ่นชิ้นงาน / ลูกค้า  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-3 page-3-to-5" for="Model_2">3. ชื่อรุ่นชิ้นงาน / ลูกค้า<br><sub>(Model / Customer)</sub></label>          
                                                <div class="col-md-3 page-print">
                                                    <input name="Model" class="form-control-plaintext box-border-black input-disable-event" id="Model_2"/>
                                                </div>
                                                <span>/</span>
                                                <div class="col-md-3">
                                                    <input name="Customer" class="form-control-plaintext box-border-black input-disable-event" id="Customer_2"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    {{--  ไลน์การผลิต  --}}
                                    <div class="row">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-3 page-3-to-5" for="AtProductionLine_2">4. ไลน์การผลิต<br><sub>(At Production Line)</sub></label>
                                                    <div class="col-md-6 page-6-to-3 page-print">
                                                        <input name="At_Production_Line" class="form-control-plaintext box-border-black input-disable-event" id="AtProductionLine_2"/>
                                                    </div>
                                                    <div class="col-md-3 page-3-to-4 page-print">
                                                        <div class="form-group row">
                                                            <div class="col-md-4 page-4-to-6 ">
                                                                <label class="col-form-label">กะผลิต<br><sub>(At Shlft)</sub></label>
                                                            </div>
                                                            @foreach($atShlft as $as)
                                                            <div class="col-md-4  page-4-to-3 no-padding">
                                                                <i class="far {{ $as['check'] ? 'fa-check-square' : 'fa-square' }} fa-2x"></i>
                                                                <label class="col-form-label input-disable-event text-check-box" for="{{ 'AtShlf'.$as['value'] }}">{{ $as['value'] }}</label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                    {{--  1.1  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <i class="far fa-square fa-2x"></i>
                                                    <label class="col-form-label text-check-box">ชิ้นงานระหว่างกระบวนการ (Semi Part)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  1  --}}
                                    <div class="row">
                                        <div class="col col-margin-tab">
                                            <div class="form-group row s2">
                                                <div class="col-md-3 no-padding">
                                                    <span>- </span>
                                                    <i class="far fa-square fa-2x"></i>
                                                    <label class="col-form-label text-check-box">เริ่มต้นล๊อตการผลิต (A)</label>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <i class="far fa-square fa-2x"></i>
                                                    <label class="col-form-label text-check-box">กลางล๊อตการผลิต (M)</label>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <i class="far fa-square fa-2x"></i>
                                                    <label class="col-form-label text-check-box">ท้ายล๊อตการผลิต (Z)</label>
                                                </div>
                                                <div class="col-md-2 no-padding">
                                                    <i class="far fa-square fa-2x"></i>
                                                    <label class="col-form-label text-check-box">อื่นๆ</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--  2.1  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <i class="far fa-square fa-2x"></i>
                                                    <label class="col-form-label text-check-box">ชิ้นงานสำเร็จรูปจากไลน์ประกอบ (F/G Assembly)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  2  --}}
                                    <div class="row">
                                            <div class="col col-margin-tab">
                                                <div class="form-group row s2">
                                                    <div class="col-md-3 no-padding">
                                                        <span>- </span>
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">เริ่มต้นล๊อตการผลิต (A)</label>
                                                    </div>
                                                    <div class="col-md-3 no-padding">
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">กลางล๊อตการผลิต (M)</label>
                                                    </div>
                                                    <div class="col-md-3 no-padding">
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">ท้ายล๊อตการผลิต (Z)</label>
                                                    </div>
                                                    <div class="col-md-2 no-padding">
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">อื่นๆ</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    {{--  3.1  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <i class="far fa-square fa-2x"></i>
                                                    <label class="col-form-label text-check-box">ชิ้นงานสำเร็จรูปจากไลน์ปั๊มชิ้นส่วน (F/G Stemping)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  3  --}}
                                    <div class="row">
                                            <div class="col col-margin-tab">
                                                <div class="form-group row s2">
                                                    <div class="col-md-3 no-padding">
                                                        <span>- </span>
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">เริ่มต้นล๊อตการผลิต (A)</label>
                                                    </div>
                                                    <div class="col-md-3 no-padding">
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">กลางล๊อตการผลิต (M)</label>
                                                    </div>
                                                    <div class="col-md-3 no-padding">
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">ท้ายล๊อตการผลิต (Z)</label>
                                                    </div>
                                                    <div class="col-md-2 no-padding">
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">อื่นๆ</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    {{--  4.1  --}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <i class="far fa-square fa-2x"></i>
                                                    <label class="col-form-label text-check-box">ตรวจสอบตามเงื่อนไขพิเศษ (Special Case as The Customer Requirement)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  4  --}}
                                    <div class="row">
                                            <div class="col col-margin-tab">
                                                <div class="form-group row s2">
                                                    <div class="col-md-3 no-padding">
                                                        <span>- </span>
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">เริ่มต้นล๊อตการผลิต (A)</label>
                                                    </div>
                                                    <div class="col-md-3 no-padding">
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">กลางล๊อตการผลิต (M)</label>
                                                    </div>
                                                    <div class="col-md-3 no-padding">
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">ท้ายล๊อตการผลิต (Z)</label>
                                                    </div>
                                                    <div class="col-md-2 no-padding">
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">อื่นๆ</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                    {{--  ผลการตรวจสอบ  --}}
                                    <div class="container-fluid border-box border-box-padding">
                                        <div class="row" style="margin: 0;">
                                            <label>ผลการตรวจสอบ (Quality Result)</label>
                                        </div>
                                        <div class="row" style="margin: 0;">
                                            <div class="col-md-4 box-dotted box-null"></div>
                                            <div class="col-md-8">
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">ผ่านตามข้อกำหนด (Passed Dimension)</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">ไม่ผ่านตามข้อกำหนด (Not Passed Dimension)</label>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <i class="far fa-square fa-2x"></i>
                                                        <label class="col-form-label text-check-box">อื่นๆ (Others).............................................</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   
                                        {{--  หัวหน้างาน  --}}
                                        <div class="row" style="margin: 0;">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <label class="col-form-label">หัวหน้างาน (Supervisor): </label>
                                                    <div class="col-md-4">
                                                        <input type="text"class=" box-border-black border-none-rl" style="width:100%;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="offset-4 col-8">
            <button type="submit" class="" onclick="submit()" id="save">บันทึก</button>
            <button class="" onclick="my_print()">พิมพ์</button>
        </div>
    </div>
    </body>
    <script>
        function my_print(){
            window.print();
        }
        function submit(){
            document.getElementById('my_form').submit();
        }
    $(function()
        {
            $( "#PartNumber" ).autocomplete({
                source: "{{ route('pages.selfcheckproduction.autocomplete') }}",
                minlenght:1,
                autoFocus:true,
                select: function(event, ui) {
                    $('#PartNumber').val(ui.item.value);
                    $('#PartName').val(ui.item.part_name);
                    $('#Model').val(ui.item.model_name);
                    $('#Customer').val(ui.item.customer_name);
                    $('#AtProductionLine').val(ui.item.production_line);
                    $('#lottag_id').val(ui.item.lottag_id);
                    $('#pre_production_check_id').val(ui.item.pre_production_check_id);
                    $('#ProductionOrder').val(ui.item.product_order);
                    $('#QPointSheet').val(ui.item.sheet_name);
                    document.getElementById("PartNumber_2").value = ui.item.value;
                    document.getElementById("PartName_2").value = ui.item.part_name;
                    document.getElementById("Model_2").value = ui.item.model_name;
                    document.getElementById("Customer_2").value = ui.item.customer_name;
                    document.getElementById("AtProductionLine_2").value = ui.item.production_line;
                    console.log(ui.item);
                }
            });
        });
    </script>
</html>
