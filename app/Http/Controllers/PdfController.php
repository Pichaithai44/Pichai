<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Fpdf;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lottag($id)
    {
        //
        $data = DB::table('lkup_lot_tag')
        ->leftJoin('lkup_model','lkup_lot_tag.model_id','=','lkup_model.id')
        ->leftJoin('qbar_code','lkup_lot_tag.barcode_id','=','qbar_code.id')
        ->leftJoin('lkup_material','lkup_lot_tag.material_id','=','lkup_material.id')
        ->leftJoin('lkup_type','lkup_lot_tag.type_id','=','lkup_type.id')
        ->leftJoin('file','lkup_lot_tag.intro_img_id','=','file.id')
        ->select('lkup_lot_tag.*','qbar_code.filebase64','lkup_model.name as model_name','lkup_material.name as material_name','lkup_type.name as type_name','file.filebase64 as img','file.mimeType')
        ->whereNULL('lkup_lot_tag.deleted_at')
        ->where('lkup_lot_tag.id',$id)
        ->first();

        define('FPDF_FONTPATH',storage_path('app/public/font'));
        
        $pdf = new Fpdf();

        $pdf::AddPage('L', [210,  297]);
        // $pdf::ln(-10);
		$pdf::SetMargins( 5,5,5,5 );
		$pdf::AddFont('THSarabun','','THSarabun.php');
		$pdf::AddFont('THSarabunPSK-Bold','','THSarabun Bold.php');
		$pdf::SetFont('THSarabunPSK-Bold','',14);
        $pdf::Ln(0);
        for($i = 0;$i<2;$i++){
            // กระดาษส่วนบน แถว 1
            $pdf::Cell(84.4,5,iconv( 'UTF-8','TIS-620','YAMATO MANUFACTURING CO.,LTD.'),'TLR',0,'R');
            $pdf::Cell(57.6,5,iconv( 'UTF-8','TIS-620',null),'TR',0,'C');
            $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(84.4,5,iconv( 'UTF-8','TIS-620','YAMATO MANUFACTURING CO.,LTD.'),'TLR',0,'R');
            $pdf::Cell(57.6,5,iconv( 'UTF-8','TIS-620',null),'TR',1,'C');
            // กระดาษส่วนบน แถว 2
            $pdf::SetFont('THSarabunPSK-Bold','',24);
            $pdf::Cell(40,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
            $pdf::Cell(44.4,17,iconv( 'UTF-8','TIS-620','LOT TAG'),'R',0,'L');
            $pdf::SetFont('THSarabunPSK-Bold','',14);
            $pdf::Cell(57.6,5,iconv( 'UTF-8','TIS-620','PHOTO / CHECK POINT'),'RB',0,'C');
            $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::SetFont('THSarabunPSK-Bold','',24);
            $pdf::Cell(40,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
            $pdf::Cell(44.4,17,iconv( 'UTF-8','TIS-620','LOT TAG'),'R',0,'L');
            $pdf::SetFont('THSarabunPSK-Bold','',14);
            $pdf::Cell(57.6,5,iconv( 'UTF-8','TIS-620','PHOTO / CHECK POINT'),'RB',1,'C');
            // กระดาษส่วนบน แถว 3
            $pdf::Cell(40,12,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
            $pdf::Cell(44.4,12,iconv( 'UTF-8','TIS-620',null),'R',0,'L');
            $pdf::Cell(57.6,12,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
            $pdf::Cell(3,12,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40,12,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
            $pdf::Cell(44.4,12,iconv( 'UTF-8','TIS-620',null),'R',0,'L');
            $pdf::Cell(57.6,12,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
            // กระดาษส่วนบน แถว 4
            $pdf::SetFont('THSarabun','',12);
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','PART NO.'),'TLR',0,'L');
            $pdf::Cell(40.4,9,iconv( 'UTF-8','TIS-620',$data->part_no),1,0,'C');
            $pdf::Cell(15,5,iconv( 'UTF-8','TIS-620','TYPE'),1,0,'C');
            $pdf::Cell(17,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','PART NO.'),'TLR',0,'L');
            $pdf::Cell(40.4,9,iconv( 'UTF-8','TIS-620',$data->part_no),1,0,'C');
            $pdf::Cell(15,5,iconv( 'UTF-8','TIS-620','TYPE'),1,0,'C');
            $pdf::Cell(17,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
            // กระดาษส่วนบน แถว 5
            $pdf::SetFont('THSarabun','',10);
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','หมายเลขที่ชิ้นงาน'),'LRB',0,'L');
            $pdf::Cell(40.4,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::SetFont('THSarabunPSK-Bold','',22);
            $pdf::Cell(15,13,iconv( 'UTF-8','TIS-620',$data->type_name),'R',0,'C');
            $pdf::SetFont('THSarabun','',10);
            $pdf::Cell(17,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,4,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','หมายเลขที่ชิ้นงาน'),'LRB',0,'L');
            $pdf::Cell(40.4,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::SetFont('THSarabunPSK-Bold','',22);
            $pdf::Cell(15,13,iconv( 'UTF-8','TIS-620',$data->type_name),'R',0,'C');
            $pdf::SetFont('THSarabun','',10);
            $pdf::Cell(17,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,4,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
            // กระดาษส่วนบน แถว 6
            $pdf::SetFont('THSarabunPSK-Bold','',12);
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','PART NMAE'),'TLR',0,'L');
            $pdf::Cell(40.4,9,iconv( 'UTF-8','TIS-620',$data->part_name),1,0,'C');
            $pdf::Cell(15,9,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
            $pdf::Cell(17,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','PART NMAE'),'TLR',0,'L');
            $pdf::Cell(40.4,9,iconv( 'UTF-8','TIS-620',$data->part_name),1,0,'C');
            $pdf::Cell(15,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
            $pdf::Cell(17,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
            // กระดาษส่วนบน แถว 7
            $pdf::SetFont('THSarabun','',10);
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','ชื่อชิ้นงาน'),'LRB',0,'L');
            $pdf::Cell(40.4,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(15,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(17,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,4,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','ชื่อชิ้นงาน'),'LRB',0,'L');
            $pdf::Cell(40.4,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(15,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(17,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,4,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
            // กระดาษส่วนบน แถว 6
            $pdf::SetFont('THSarabunPSK-Bold','',12);
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','Mode'),'TLR',0,'L');
            $pdf::Cell(17.7,9,iconv( 'UTF-8','TIS-620',$data->model_name),'TLR',0,'C');
            $pdf::Cell(17.7,5,iconv( 'UTF-8','TIS-620','Material'),0,0,'L');
            $pdf::Cell(20,9,iconv( 'UTF-8','TIS-620',$data->material_name),'TLR',0,'C');
            $pdf::Cell(17,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','Mode'),'TLR',0,'L');
            $pdf::Cell(17.7,9,iconv( 'UTF-8','TIS-620',$data->model_name),'LR',0,'C');
            $pdf::Cell(17.7,5,iconv( 'UTF-8','TIS-620','Material'),0,0,'L');
            $pdf::Cell(20,9,iconv( 'UTF-8','TIS-620',$data->material_name),'TLR',0,'C');
            $pdf::Cell(17,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        
            // กระดาษส่วนบน แถว 6
            $pdf::SetFont('THSarabun','',10);
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','รุ่น'),'L',0,'L');
            $pdf::Cell(17.7,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(17.7,4,iconv( 'UTF-8','TIS-620','วัตถุดิบ'),0,0,'L');
            $pdf::Cell(20,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(17,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,4,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','รุ่น'),'L',0,'L');
            $pdf::Cell(17.7,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(17.7,4,iconv( 'UTF-8','TIS-620','วัตถุดิบ'),0,0,'L');
            $pdf::Cell(20,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(17,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,4,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
            // กระดาษส่วนบน แถว 6
            $pdf::SetFont('THSarabunPSK-Bold','',12);
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','Mfg. Date'),'TLR',0,'L');
            $pdf::Cell(35.4,5,iconv( 'UTF-8','TIS-620',null),'TLR',0,'C');
            $pdf::Cell(20,5,iconv( 'UTF-8','TIS-620','QTY.(Pcs.)'),'TLR','R','C');
            $pdf::Cell(17,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','Mfg. Date'),'TLR',0,'L');
            $pdf::Cell(35.4,5,iconv( 'UTF-8','TIS-620',null),'TLR',0,'C');
            $pdf::Cell(20,5,iconv( 'UTF-8','TIS-620','QTY.(Pcs.)'),'TLR',0,'C');
            $pdf::Cell(17,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
            // กระดาษส่วนบน แถว 6
            $pdf::SetFont('THSarabun','',10);
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','วันที่ผลิต'),'LRB',0,'L');
            $pdf::Cell(35.4,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(20,4,iconv( 'UTF-8','TIS-620','จำนวน (ชิ้น)'),'LR',0,'C');
            $pdf::Cell(17,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,4,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','วันที่ผลิต'),'LRB',0,'L');
            $pdf::Cell(35.4,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(20,4,iconv( 'UTF-8','TIS-620','จำนวน (ชิ้น)'),'LR',0,'C');
            $pdf::Cell(17,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(40.6,4,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
            // กระดาษส่วนบน แถว 6
            $pdf::SetFont('THSarabunPSK-Bold','',12);
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','Lottag'),'TLR',0,'L');
            $pdf::Cell(35.4,5,iconv( 'UTF-8','TIS-620',null),'TLR',0,'C');
            $pdf::Cell(20,5,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620','T.= '.$data->material_t),'R',0,'L');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','Lot No.'),'TLR',0,'L');
            $pdf::Cell(35.4,5,iconv( 'UTF-8','TIS-620',null),'TLR',0,'C');
            $pdf::Cell(20,5,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620','T.= '.$data->material_t),'R',1,'L');
            // กระดาษส่วนบน แถว 6
            $pdf::SetFont('THSarabun','',10);
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','หมายเลขล๊อต'),'LRB',0,'L');
            $pdf::Cell(35.4,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(20,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','หมายเลขล๊อต'),'LRB',0,'L');
            $pdf::Cell(35.4,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(20,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
            // กระดาษส่วนบน แถว 7
            $pdf::SetFont('THSarabunPSK-Bold','',12);
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','Std.pack.'),'TLR',0,'L');
            $pdf::Cell(16.467,5,iconv( 'UTF-8','TIS-620',null),'TLR',0,'C');
            $pdf::Cell(25.467,5,iconv( 'UTF-8','TIS-620','M/C no.'),'TLR',0,'L');
            $pdf::Cell(13.467,5,iconv( 'UTF-8','TIS-620',null),'TLR',0,'C');
            $pdf::Cell(28.8,5,iconv( 'UTF-8','TIS-620','Oper No.'),'TLR',0,'L');
            $pdf::Cell(28.8,5,iconv( 'UTF-8','TIS-620','Shift(กะ)'),'TLR',0,'L');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','Std.pack.'),'TLR',0,'L');
            $pdf::Cell(16.467,5,iconv( 'UTF-8','TIS-620',null),'TLR',0,'C');
            $pdf::Cell(25.467,5,iconv( 'UTF-8','TIS-620','M/C no.'),'TLR',0,'L');
            $pdf::Cell(13.467,5,iconv( 'UTF-8','TIS-620',null),'TLR',0,'C');
            $pdf::Cell(28.8,5,iconv( 'UTF-8','TIS-620','Oper No.'),'TLR',0,'L');
            $pdf::Cell(28.8,5,iconv( 'UTF-8','TIS-620','Shift(กะ)'),'TLR',1,'L');
            // กระดาษส่วนบน แถว 8
            $pdf::SetFont('THSarabun','',10);
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','มาตรฐานบรรจุ'),'LRB',0,'L');
            $pdf::Cell(16.467,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(25.467,4,iconv( 'UTF-8','TIS-620','หมายเลขเครื่อง'),'LRB',0,'L');
            $pdf::Cell(13.467,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620','รหัสพนังงาน'),'LRB',0,'L');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','มาตรฐานบรรจุ'),'LRB',0,'L');
            $pdf::Cell(16.467,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(25.467,4,iconv( 'UTF-8','TIS-620','หมายเลขเครื่อง'),'LRB',0,'L');
            $pdf::Cell(13.467,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620','รหัสพนังงาน'),'LRB',0,'L');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620',null),'LRB',1,'C');
            // กระดาษส่วนบน แถว 8
            $pdf::SetFont('THSarabunPSK-Bold','',12);
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','from Line'),'TLR',0,'L');
            $pdf::Cell(16.467,5,iconv( 'UTF-8','TIS-620',null),'TLR',0,'C');
            $pdf::Cell(25.467,5,iconv( 'UTF-8','TIS-620','Next process'),'TLR',0,'L');
            $pdf::Cell(13.467,5,iconv( 'UTF-8','TIS-620',null),'TLR',0,'C');
            $pdf::Cell(28.8,5,iconv( 'UTF-8','TIS-620','หัวหน้างาน'),'TLR',0,'C');
            $pdf::Cell(28.8,5,iconv( 'UTF-8','TIS-620','QA ตรวจสอบ'),'TLR',0,'C');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,5,iconv( 'UTF-8','TIS-620','from Line'),'TLR',0,'L');
            $pdf::Cell(16.467,5,iconv( 'UTF-8','TIS-620',null),'TLR',0,'C');
            $pdf::Cell(25.467,5,iconv( 'UTF-8','TIS-620','Next process'),'TLR',0,'L');
            $pdf::Cell(13.467,5,iconv( 'UTF-8','TIS-620',null),'TLR',0,'C');
            $pdf::Cell(28.8,5,iconv( 'UTF-8','TIS-620','หัวหน้างาน'),'TLR',0,'C');
            $pdf::Cell(28.8,5,iconv( 'UTF-8','TIS-620','QA ตรวจสอบ'),'TLR',1,'C');
            // กระดาษส่วนบน แถว 9
            $pdf::SetFont('THSarabun','',10);
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','จากไลน์'),'LRB',0,'L');
            $pdf::Cell(16.467,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(25.467,4,iconv( 'UTF-8','TIS-620','ขั้นตอนต่อไป'),'LRB',0,'L');
            $pdf::Cell(13.467,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,4,iconv( 'UTF-8','TIS-620','จากไลน์'),'LRB',0,'L');
            $pdf::Cell(16.467,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(25.467,4,iconv( 'UTF-8','TIS-620','ขั้นตอนต่อไป'),'LRB',0,'L');
            $pdf::Cell(13.467,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(28.8,4,iconv( 'UTF-8','TIS-620',null),'LRB',1,'C');

            $pdf::SetFont('THSarabunPSK-Bold','',10);
            $pdf::Cell(29,3,iconv( 'UTF-8','TIS-620',$data->refer),0,0,'L');
            $pdf::Cell(16.467,3,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(25.467,3,iconv( 'UTF-8','TIS-620',null),0,0,'L');
            $pdf::Cell(13.467,3,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(28.8,3,iconv( 'UTF-8','TIS-620','REV.'.$data->rev),0,0,'R');
            $pdf::Cell(28.8,3,iconv( 'UTF-8','TIS-620',date('d/m/Y')),0,0,'R');
            $pdf::Cell(3,0,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(29,3,iconv( 'UTF-8','TIS-620',$data->refer),0,0,'L');
            $pdf::Cell(16.467,3,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(25.467,3,iconv( 'UTF-8','TIS-620',null),0,0,'L');
            $pdf::Cell(13.467,3,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(28.8,3,iconv( 'UTF-8','TIS-620','REV.'.$data->rev),0,0,'R');
            $pdf::Cell(28.8,3,iconv( 'UTF-8','TIS-620',date('d/m/Y')),0,1,'R');
            $pdf::Ln(5);
            $pdf::SetFont('THSarabunPSK-Bold','',14);
        }

		$pdf::Image(storage_path('app/public/img/logo.png'),6,15,null,null,'PNG');
		$pdf::Image(storage_path('app/public/img/logo.png'),151,15,null,null,'PNG');
		$pdf::Image(storage_path('app/public/img/logo.png'),6,107,null,null,'PNG');
        $pdf::Image(storage_path('app/public/img/logo.png'),151,107,null,null,'PNG');
        if($data->mimeType == 'image/png'){
            $type_file = 'PNG';
        }else{
            $type_file = 'JPEG';
        }
        if($data->img){
            $pdf::Image($data->img,96,22,45,45,$type_file);
            $pdf::Image($data->img,241,22,45,45,$type_file);
            $pdf::Image($data->img,96,114,45,45,$type_file);
            $pdf::Image($data->img,241,114,45,45,$type_file);
        }
        return response($pdf::Output('lottag.pdf' , 'I'))->header('Content-type', 'application/pdf');
       

    }

    public function delivery($id)
    {
        //
        $data = DB::table('delivery')
        ->leftJoin('lkup_lot_tag','delivery.lot_tag_id','=','lkup_lot_tag.id')
        ->leftJoin('lkup_model','lkup_lot_tag.model_id','=','lkup_model.id')
        ->leftJoin('lkup_type','lkup_lot_tag.type_id','=','lkup_type.id')
        ->leftJoin('file','lkup_lot_tag.intro_img_id','=','file.id')
        ->leftJoin('qbar_code','lkup_lot_tag.barcode_id','=','qbar_code.id')
        ->leftJoin('lkup_material','lkup_lot_tag.material_id','=','lkup_material.id')
        ->leftJoin('customer','delivery.customer_id','=','customer.id')
        ->select(
            'delivery.quantity',
            'lkup_lot_tag.part_no',
            'lkup_lot_tag.part_name',
            'qbar_code.filebase64',
            'lkup_model.name as model_name',
            'lkup_type.name as type_name',
            'lkup_material.name as material_name',
            'customer.customer_name',
            'lkup_lot_tag.material_t',
            'lkup_lot_tag.refer',
            'lkup_lot_tag.rev',
            'file.mimeType',
            'file.filebase64 as img'
            )
        ->whereNULL('lkup_lot_tag.deleted_at')
        ->where('delivery.id',$id)
        ->first();
        // echo '<pre>';print_r($data);'</pre>';exit;
        define('FPDF_FONTPATH',storage_path('app/public/font'));
        
        $pdf = new Fpdf();

        $pdf::AddPage('L', [210,  297]);
        // $pdf::ln(-10);
		$pdf::SetMargins( 5,2.5,2.5,2.5 );
		$pdf::AddFont('THSarabun','','THSarabun.php');
		$pdf::AddFont('THSarabunPSK-Bold','','THSarabun Bold.php');
        $pdf::SetFont('THSarabunPSK-Bold','',14);
        for($i = 1;$i <= 2;$i++){
            $pdf::Ln(0);
            // กระดาษส่วนบน แถว 1
            $pdf::Cell(30.4,10,iconv( 'UTF-8','TIS-620',null),'TLB',0,'C');
            $pdf::Cell(69,10,iconv( 'UTF-8','TIS-620','YAMATO MANUFACTURING CO.,LTD.'),'TRB',0,'C');
            $pdf::Cell(42.6,10,iconv( 'UTF-8','TIS-620','PHOTO / CHECK POINT'),1,0,'C');
            $pdf::Cell(3,10,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(30.4,10,iconv( 'UTF-8','TIS-620',null),'TLB',0,'C');
            $pdf::Cell(69,10,iconv( 'UTF-8','TIS-620','YAMATO MANUFACTURING CO.,LTD.'),'TRB',0,'C');
            $pdf::Cell(42.6,10,iconv( 'UTF-8','TIS-620','PHOTO / CHECK POINT'),1,1,'C');
            // กระดาษส่วนบน แถว 2
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(20,10,iconv( 'UTF-8','TIS-620','PART NO.'),1,0,'L');
            $pdf::SetFont('THSarabunPSK-Bold','',20);
            $pdf::Cell(79.4,10,iconv( 'UTF-8','TIS-620',$data->part_no),1,0,'C');
            $pdf::Cell(42.6,74,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(3,74,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(20,10,iconv( 'UTF-8','TIS-620','PART NO.'),1,0,'L');
            $pdf::SetFont('THSarabunPSK-Bold','',20);
            $pdf::Cell(79.4,10,iconv( 'UTF-8','TIS-620',$data->part_no),1,0,'C');
            $pdf::Cell(42.6,74,iconv( 'UTF-8','TIS-620',null),1,1,'C');
            $pdf::Ln(-64);
            // กระดาษส่วนบน แถว 3
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(20,10,iconv( 'UTF-8','TIS-620','PART NAME'),'LRB',0,'L');
            $pdf::SetFont('THSarabunPSK-Bold','',20);
            $pdf::Cell(79.4,10,iconv( 'UTF-8','TIS-620',$data->part_name),'LRB',0,'C');
            $pdf::Cell(5.2,-8,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(23.2,-8,iconv( 'UTF-8','TIS-620','T= '.$data->material_t),1,0,'C');
            $pdf::Cell(14.2,-8,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(3,10,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(20,10,iconv( 'UTF-8','TIS-620','PART NAME'),'LRB',0,'L');
            $pdf::SetFont('THSarabunPSK-Bold','',20);
            $pdf::Cell(79.4,10,iconv( 'UTF-8','TIS-620',$data->part_name),'LRB',0,'C');
            $pdf::Cell(5.2,-8,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(23.2,-8,iconv( 'UTF-8','TIS-620','T= '.$data->material_t),1,0,'C');
            $pdf::Cell(14.2,10,iconv( 'UTF-8','TIS-620',null),0,1,'C');
            // กระดาษส่วนบน แถว 4
            $pdf::SetFont('THSarabun','',12);
            $pdf::Cell(20,5,iconv( 'UTF-8','TIS-620','QUANTITY'),'LR',0,'C');
            $pdf::Cell(17.2,5,iconv( 'UTF-8','TIS-620','Kg.'),'LR',0,'C');
            $pdf::Cell(20.2,10,iconv( 'UTF-8','TIS-620','MODEL'),'LRB',0,'C');
            $pdf::SetFont('THSarabunPSK-Bold','',16);
            $pdf::Cell(17.15,10,iconv( 'UTF-8','TIS-620',$data->model_name),'LRB',0,'C');
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(12.424995,10,iconv( 'UTF-8','TIS-620','TYPE'),'LRB',0,'C');
            $pdf::SetFont('THSarabunPSK-Bold','',16);
            $pdf::Cell(12.424995,10,iconv( 'UTF-8','TIS-620',$data->type_name),'LRB',0,'C');
            $pdf::Cell(42.6,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(20,5,iconv( 'UTF-8','TIS-620','QUANTITY'),'LR',0,'C');
            $pdf::Cell(17.2,5,iconv( 'UTF-8','TIS-620','Kg.'),'LR',0,'C');
            $pdf::Cell(20.2,10,iconv( 'UTF-8','TIS-620','MODEL'),'LRB',0,'C');
            $pdf::SetFont('THSarabunPSK-Bold','',16);
            $pdf::Cell(17.15,10,iconv( 'UTF-8','TIS-620',$data->model_name),'LRB',0,'C');
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(12.424995,10,iconv( 'UTF-8','TIS-620','TYPE'),'LRB',0,'C');
            $pdf::SetFont('THSarabunPSK-Bold','',16);
            $pdf::Cell(12.424995,10,iconv( 'UTF-8','TIS-620',$data->type_name),'LRB',0,'C');
            $pdf::Cell(42.6,5,iconv( 'UTF-8','TIS-620',null),0,1,'C');
            // กระดาษส่วนบน แถว 5
            $pdf::SetFont('THSarabunPSK-Bold','',20);
            $pdf::Cell(20,5,iconv( 'UTF-8','TIS-620',number_format($data->quantity)),'LR',0,'C');
            $pdf::Cell(17.2,5,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(20.2,5,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(17.15,5,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(12.424995,5,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(12.424995,5,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(42.6,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(20,5,iconv( 'UTF-8','TIS-620',number_format($data->quantity)),'LR',0,'C');
            $pdf::Cell(17.2,5,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(20.2,5,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(17.15,5,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(12.424995,5,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(12.424995,5,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(42.6,5,iconv( 'UTF-8','TIS-620',null),0,1,'C');
            // กระดาษส่วนบน แถว 6
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(20,10,iconv( 'UTF-8','TIS-620','(Psc.)'),'LRB',0,'R');
            $pdf::Cell(46.26668,10,iconv( 'UTF-8','TIS-620','PRODUCTION DATE :'),'LRB',0,'L');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(42.6,10,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(3,10,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(20,10,iconv( 'UTF-8','TIS-620','(Psc.)'),'LRB',0,'L');
            $pdf::Cell(46.26668,10,iconv( 'UTF-8','TIS-620','PRODUCTION DATE :'),'LRB',0,'L');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,10,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(42.6,10,iconv( 'UTF-8','TIS-620',null),0,1,'C');
            // กระดาษส่วนบน แถว 7
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620','MATERIAL'),1,0,'C');
            $pdf::SetFont('THSarabunPSK-Bold','',16);
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620', $data->material_name),1,0,'C');
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620','CUSTOMER'),1,0,'C');
            $pdf::SetFont('THSarabunPSK-Bold','',16);
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620',$data->customer_name),'LRB',0,'C');
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(42.6,8,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(3,8,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620','MATERIAL'),'LRB',0,'C');
            $pdf::SetFont('THSarabunPSK-Bold','',16);
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620', $data->material_name),1,0,'C');
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620','CUSTOMER'),1,0,'C');
            $pdf::SetFont('THSarabunPSK-Bold','',16);
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620',$data->customer_name),'LRB',0,'C');
            $pdf::Cell(42.6,8,iconv( 'UTF-8','TIS-620',null),0,1,'C');
            // กระดาษส่วนบน แถว 8
            $pdf::SetFont('THSarabun','',14);
            $pdf::Cell(24.85,5,iconv( 'UTF-8','TIS-620','PRODUCTION'),1,0,'C');
            $pdf::Cell(24.85,5,iconv( 'UTF-8','TIS-620','QC FINAL'),1,0,'C');
            $pdf::Cell(24.85,5,iconv( 'UTF-8','TIS-620','QA COMFIRM'),1,0,'C');
            $pdf::Cell(24.85,5,iconv( 'UTF-8','TIS-620','DELIVERY BY'),'LRB',0,'C');
            $pdf::Cell(42.6,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(24.85,5,iconv( 'UTF-8','TIS-620','PRODUCTION'),'LRB',0,'C');
            $pdf::Cell(24.85,5,iconv( 'UTF-8','TIS-620','QC FINAL'),1,0,'C');
            $pdf::Cell(24.85,5,iconv( 'UTF-8','TIS-620','QA COMFIRM'),1,0,'C');
            $pdf::Cell(24.85,5,iconv( 'UTF-8','TIS-620','DELIVERY BY'),'LRB',0,'C');
            $pdf::Cell(42.6,5,iconv( 'UTF-8','TIS-620',null),0,1,'C');
            // กระดาษส่วนบน แถว 9
            $pdf::SetFont('THSarabun','',12);
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620',null),1,0,'R');
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(42.6,8,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(3,8,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620',null),'LRB',0,'L');
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(24.85,8,iconv( 'UTF-8','TIS-620',null),'LRB',0,'C');
            $pdf::Cell(42.6,8,iconv( 'UTF-8','TIS-620',null),0,1,'C');
            // กระดาษส่วนบน แถว 10
            $pdf::SetFont('THSarabunPSK-Bold','',8);
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','YEAR'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','MONTH'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','DAY'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','YEAR'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','MONTH'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','DAY'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','YEAR'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','MONTH'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','DAY'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','YEAR'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','MONTH'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','DAY'),1,0,'C');
            $pdf::Cell(42.6,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','YEAR'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','MONTH'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','DAY'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','YEAR'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','MONTH'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','DAY'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','YEAR'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','MONTH'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','DAY'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','YEAR'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','MONTH'),1,0,'C');
            $pdf::Cell(8.28333,5,iconv( 'UTF-8','TIS-620','DAY'),1,0,'C');
            $pdf::Cell(42.6,5,iconv( 'UTF-8','TIS-620',null),0,1,'C');
            // กระดาษส่วนบน แถว 11
            $pdf::SetFont('THSarabun','',12);
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(42.6,8,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(3,8,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(4.141665,8,iconv( 'UTF-8','TIS-620',null),1,0,'C');
            $pdf::Cell(42.6,8,iconv( 'UTF-8','TIS-620',null),0,1,'C');
            // กระดาษส่วนบน แถว 11
            $pdf::SetFont('THSarabunPSK-Bold','',10);
            $pdf::Cell(99.4,4,iconv( 'UTF-8','TIS-620',$data->refer),0,0,'L');
            $pdf::Cell(42.6,4,iconv( 'UTF-8','TIS-620','REV.'.$data->rev.' '.date('d/m/Y')),0,0,'R');
            $pdf::Cell(3,4,iconv( 'UTF-8','TIS-620',null),0,0,'C');
            $pdf::Cell(99.4,4,iconv( 'UTF-8','TIS-620',$data->refer),0,0,'L');
            $pdf::Cell(42.6,4,iconv( 'UTF-8','TIS-620','REV.'.$data->rev.' '.date('d/m/Y')),0,1,'R');
            $pdf::Ln(3.99);
            $pdf::SetFont('THSarabunPSK-Bold','',14);
        }
       
		$pdf::Image(storage_path('app/public/img/logo.png'),6,11,18.47272,8,'PNG');
		$pdf::Image(storage_path('app/public/img/logo.png'),151,11,18.47272,8,'PNG');
		$pdf::Image(storage_path('app/public/img/logo.png'),6,103,18.47272,8,'PNG');
        $pdf::Image(storage_path('app/public/img/logo.png'),151,103,18.47272,8,'PNG');
        if($data->mimeType == 'image/png'){
            $type_file = 'PNG';
        }else{
            $type_file = 'JPEG';
        }
		$pdf::Image($data->img,105.75,34,40,40,$type_file);
		$pdf::Image($data->img,250.75,34,40,40,$type_file);
		$pdf::Image($data->img,105.75,125,40,40,$type_file);
		$pdf::Image($data->img,250.75,125,40,40,$type_file);
        return response($pdf::Output('delivery.pdf' , 'I'))->header('Content-type', 'application/pdf');
    }
    
    public function selfcheckproduction($id)
    {
        //
        $data = DB::table('self_check_production')
        ->leftJoin('pre_production_check','self_check_production.pre_production_check_id','=','pre_production_check.id')
        ->leftJoin('lkup_lot_tag','pre_production_check.lot_tag_id','=','lkup_lot_tag.id')
        ->leftJoin('lkup_model','lkup_lot_tag.model_id','=','lkup_model.id')
        ->leftJoin('lkup_type','lkup_lot_tag.type_id','=','lkup_type.id')
        ->leftJoin('file','lkup_lot_tag.intro_img_id','=','file.id')
        ->leftJoin('qbar_code','lkup_lot_tag.barcode_id','=','qbar_code.id')
        ->leftJoin('lkup_material','lkup_lot_tag.material_id','=','lkup_material.id')
        ->leftJoin('customer','pre_production_check.customer_id','=','customer.id')
        ->leftJoin('lkup_production_line','pre_production_check.production_line_id','=','lkup_production_line.id')
        ->select(
            'lkup_lot_tag.part_no',
            'lkup_lot_tag.part_name',
            'qbar_code.filebase64',
            'lkup_model.name as model_name',
            'lkup_type.name as type_name',
            'lkup_material.name as material_name',
            'customer.customer_name',
            'lkup_lot_tag.material_t',
            'lkup_lot_tag.refer',
            'lkup_lot_tag.rev',
            'lkup_production_line.line_name',
            'pre_production_check.product_order',
            'self_check_production.lot_no_fix',
            'self_check_production.lot_no',
            'self_check_production.production_date',
            'file.mimeType',
            'file.filebase64 as img'
            )
        ->whereNULL('lkup_lot_tag.deleted_at')
        ->where('self_check_production.id',$id)
        ->first();
        // echo '<pre>';print_r($data);'</pre>';exit;
        define('FPDF_FONTPATH',storage_path('app/public/font'));
        $pdf = new Fpdf();

        $pdf::AddPage('L', [210,  297]);
        // $pdf::ln(-1);
        $pdf::SetMargins(5,5);
        $pdf::SetAutoPageBreak(false);
		$pdf::AddFont('THSarabun','','THSarabun.php');
		$pdf::AddFont('THSarabunPSK-Bold','','THSarabun Bold.php');
        $pdf::SetFont('THSarabunPSK-Bold','',14);
        $pdf::Ln(0);
        // กระดาษส่วนบน แถว 1
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'LT',0,'C');
        $pdf::Cell(30,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'T',0,'C');
        $pdf::Cell(77,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'T',0,'C');
        $pdf::Cell(25,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'TR',0,'C');
        $pdf::Cell(3,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'LT',0,'C');
        $pdf::Cell(30,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'T',0,'C');
        $pdf::Cell(77,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'T',0,'C');
        $pdf::Cell(25,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'TR',1,'C');
        // กระดาษส่วนบน แถว 2
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(30,10,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(77,10,iconv( 'UTF-8','TIS-620','เอกสารยืนยันการตรวจสอบชิ้นงานก่อนการผลิต'),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(25,10,iconv( 'UTF-8','TIS-620','เอกสาร'),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(3,10,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(30,10,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(77,10,iconv( 'UTF-8','TIS-620','เอกสารตรวจสอบขนาดชิ้นงาน'),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(25,10,iconv( 'UTF-8','TIS-620','เอกสาร'),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',1,'C');
        // กระดาษส่วนบน แถว 3
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(30,10,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(77,10,iconv( 'UTF-8','TIS-620','(Self Check Production)'),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(25,10,iconv( 'UTF-8','TIS-620','ตอนที่ 1'),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'RL',0,'C');
        $pdf::Cell(3,10,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(30,10,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(77,10,iconv( 'UTF-8','TIS-620','(Data Parts Confirmation By PQA)'),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'LR',0,'C');
        $pdf::Cell(25,10,iconv( 'UTF-8','TIS-620','ตอนที่ 2'),0,0,'C');
        $pdf::Cell(2.5,10,iconv( 'UTF-8','TIS-620',null),'RL',1,'C');
        // กระดาษส่วนบน แถว 4
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(30,2.5,iconv( 'UTF-8','TIS-620',null),'T',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(77,2.5,iconv( 'UTF-8','TIS-620',null),'T',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(25,2.5,iconv( 'UTF-8','TIS-620',null),'T',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(30,2.5,iconv( 'UTF-8','TIS-620',null),'T',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(77,2.5,iconv( 'UTF-8','TIS-620',null),'T',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(25,2.5,iconv( 'UTF-8','TIS-620',null),'T',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        $pdf::SetFont('THSarabun','',12);
        // เนื้อหา 1
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','วันที่ผลิต '.$data->production_date),0,0,'L');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','จำนวนที่ผลิต '.$data->product_order.' ชิ้น'),0,0,'L');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','ล็อตที่ผลิต '.$data->lot_no_fix.$data->lot_no),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(55.667,5,iconv( 'UTF-8','TIS-620','วันที่ผลิต (Production Date): '.$data->production_date),0,0,'L');
        $pdf::Cell(25,5,iconv( 'UTF-8','TIS-620','กะผลิต (AtShlft)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(17.8335,5,iconv( 'UTF-8','TIS-620','01'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(17.8335,5,iconv( 'UTF-8','TIS-620','02'),0,0,'L');
        $pdf::Cell(10.667,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 2
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Production Data)'),0,0,'L');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Production Order)'),0,0,'L');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Lot No.)'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 3
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(45.667,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(45.667,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(45.667,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(45.667,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 4
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','1. หมายเลขที่ผลิต'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(73.0672,5,iconv( 'UTF-8','TIS-620',$data->part_no),'B',0,'C');
        $pdf::SetDash();
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','1. หมายเลขที่ผลิต'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(73.0672,5,iconv( 'UTF-8','TIS-620',$data->part_no),'B',0,'C');
        $pdf::SetDash();
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 5
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Part Number)'),0,0,'L');
        $pdf::Cell(73.0672,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Part Number)'),0,0,'L');
        $pdf::Cell(73.0672,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 6
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','2. ชื่อชิ้นงาน'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(73.0672,5,iconv( 'UTF-8','TIS-620',$data->part_name),'B',0,'C');
        $pdf::SetDash();
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','2. ชื่อชิ้นงาน'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(73.0672,5,iconv( 'UTF-8','TIS-620',$data->part_name),'B',0,'C');
        $pdf::SetDash();
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 7
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Part Name)'),0,0,'L');
        $pdf::Cell(73.0672,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Part Name)'),0,0,'L');
        $pdf::Cell(73.0672,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 8
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','3. ชื่อรุ่นชิ้นงาน / ลูกค้า'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(35.2836,5,iconv( 'UTF-8','TIS-620',$data->model_name),'B',0,'C');
        $pdf::SetDash();
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620','/'),0,0,'C');
        $pdf::SetDash(1,1);
        $pdf::Cell(35.2836,5,iconv( 'UTF-8','TIS-620',$data->customer_name),'B',0,'C');
        $pdf::SetDash();
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','3. ชื่อรุ่นชิ้นงาน / ลูกค้า'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(35.2836,5,iconv( 'UTF-8','TIS-620',$data->model_name),'B',0,'C');
        $pdf::SetDash();
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620','/'),0,0,'C');
        $pdf::SetDash(1,1);
        $pdf::Cell(35.2836,5,iconv( 'UTF-8','TIS-620',$data->customer_name),'B',0,'C');
        $pdf::SetDash();
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 9
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Model / Customer)'),0,0,'L');
        $pdf::Cell(35.2836,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(35.2836,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Model / Customer)'),0,0,'L');
        $pdf::Cell(35.2836,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(35.2836,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 10
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','4. ไลน์การผลิต'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(35.2836,5,iconv( 'UTF-8','TIS-620',$data->line_name),'B',0,'C');
        $pdf::SetDash();
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(17.6418,5,iconv( 'UTF-8','TIS-620','กะผลิต'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(3.8209,5,iconv( 'UTF-8','TIS-620','01'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(3.8209,5,iconv( 'UTF-8','TIS-620','02'),0,0,'C');
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','4. ไลน์การผลิต'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(35.2836,5,iconv( 'UTF-8','TIS-620',$data->line_name),'B',0,'C');
        $pdf::SetDash();
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(17.6418,5,iconv( 'UTF-8','TIS-620','กะผลิต'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(3.8209,5,iconv( 'UTF-8','TIS-620','01'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(3.8209,5,iconv( 'UTF-8','TIS-620','02'),0,0,'C');
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 11
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Model / Customer)'),0,0,'L');
        $pdf::Cell(35.2836,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(17.6418,5,iconv( 'UTF-8','TIS-620','(AtShlft)'),0,0,'L');
        $pdf::Cell(17.6418,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Model / Customer)'),0,0,'L');
        $pdf::Cell(35.2836,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(17.6418,5,iconv( 'UTF-8','TIS-620','(AtShlft)'),0,0,'L');
        $pdf::Cell(17.6418,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','5. อ้างอิงหมายเลขเอกสารตรวจสอบ'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(73.0672,5,iconv( 'UTF-8','TIS-620',null),'B',0,'L');
        $pdf::SetDash();
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(132,5,iconv( 'UTF-8','TIS-620','ชิ้นงานระหว่างกระบวนการ (Semi Part)'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 13
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Q-Point Sheet)'),0,0,'L');
        $pdf::Cell(73.0672,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','เริ่มต้นล๊อตการผลิต (A)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','กลางล๊อตการผลิต (M)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','ท้ายล๊อตการผลิต (Z)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','อื่นๆ'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 14
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','6. จุดสำคัญของการควบคุมคุณภาพชิ้นส่วน'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(73.0672,5,iconv( 'UTF-8','TIS-620',null),'B',0,'L');
        $pdf::SetDash();
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(132,5,iconv( 'UTF-8','TIS-620','ชิ้นงานสำเร็จรูปจากไลน์ประกอบ (F/G Assembly)'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 15
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(45.667,5,iconv( 'UTF-8','TIS-620','(Quality Important)'),0,0,'L');
        $pdf::Cell(73.0672,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(18.2668,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','เริ่มต้นล๊อตการผลิต (A)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','กลางล๊อตการผลิต (M)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','ท้ายล๊อตการผลิต (Z)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','อื่นๆ'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 16
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(35.5,5,iconv( 'UTF-8','TIS-620','วัตถุดิบที่กําหนด (R/M Type):'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(28,5,iconv( 'UTF-8','TIS-620',null),'B',0,'L');
        $pdf::SetDash();
        $pdf::Cell(42.5,5,iconv( 'UTF-8','TIS-620','ความหนาวัตถุดิบ (R/M Thickness):'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(21,5,iconv( 'UTF-8','TIS-620',null),'B',0,'L');
        $pdf::SetDash();
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','mm'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(132,5,iconv( 'UTF-8','TIS-620','ชิ้นงานสำเร็จรูปจากไลน์ปั๊มชิ้นส่วน (F/G Stemping)'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 17
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(63.5,5,iconv( 'UTF-8','TIS-620','การยืดตัวและฉีกขาดของชิ้นงาน (Neck & Broken)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(29.25,5,iconv( 'UTF-8','TIS-620','คุณภาพผ่าน'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(29.25,5,iconv( 'UTF-8','TIS-620','คุณภาพไม่ผ่าน'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','เริ่มต้นล๊อตการผลิต (A)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','กลางล๊อตการผลิต (M)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','ท้ายล๊อตการผลิต (Z)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','อื่นๆ'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 18
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(63.5,5,iconv( 'UTF-8','TIS-620','ชิ้นงานมีครีบคมตัดเฉื่อน (Burr)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(29.25,5,iconv( 'UTF-8','TIS-620','คุณภาพผ่าน'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(29.25,5,iconv( 'UTF-8','TIS-620','คุณภาพไม่ผ่าน'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(132,5,iconv( 'UTF-8','TIS-620','ตรวจสอบตามเงื่อนไขพิเศษ (Special Case as The Customer Requirement)'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 19
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(63.5,5,iconv( 'UTF-8','TIS-620','ความแตกต่างระหว่างชิ้นงานจริงกับชิ้นงานตัวอย่าง'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(29.25,5,iconv( 'UTF-8','TIS-620','คุณภาพผ่าน'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(29.25,5,iconv( 'UTF-8','TIS-620','คุณภาพไม่ผ่าน'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','เริ่มต้นล๊อตการผลิต (A)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','กลางล๊อตการผลิต (M)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','ท้ายล๊อตการผลิต (Z)'),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620','-'),0,0,'C');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(24.25,5,iconv( 'UTF-8','TIS-620','อื่นๆ'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 19
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(10,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(30,5,iconv( 'UTF-8','TIS-620','ปัญหาอะไร ?'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(68.5,5,iconv( 'UTF-8','TIS-620',null),'B',0,'L');
        $pdf::SetDash();
        $pdf::Cell(23.5,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 12
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 20
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(10,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(30,5,iconv( 'UTF-8','TIS-620','เป็นปัญหาอีกหรือไม่'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(68.5,5,iconv( 'UTF-8','TIS-620',null),'B',0,'L');
        $pdf::SetDash();
        $pdf::Cell(23.5,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 21
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,5,iconv( 'UTF-8','TIS-620',null),'B',0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(137,5,iconv( 'UTF-8','TIS-620',null),'B',0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'R',1,'C');
        // เนื้อหา 22
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::Cell(43.167,2.5,iconv( 'UTF-8','TIS-620','ผลการตรวจสอบ (Quality Result)'),'T',0,'L');
        $pdf::Cell(91.333,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'RL',0,'C');
        $pdf::Cell(3,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::Cell(43.167,2.5,iconv( 'UTF-8','TIS-620','ผลการตรวจสอบ (Quality Result)'),'T',0,'L');
        $pdf::Cell(91.333,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'LR',1,'C');
        // เนื้อหา 23
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::Cell(43.167,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(91.333,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'RL',0,'C');
        $pdf::Cell(3,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::Cell(43.167,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(91.333,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'LR',1,'C');
        // เนื้อหา 24
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,5,iconv( 'UTF-8','TIS-620',null),'RTL',0,'L');
        $pdf::SetDash();
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(81.333,5,iconv( 'UTF-8','TIS-620','ผ่านตามข้อกำหนดคุณภาพเบื้องต้น (Quick Qualily Check)'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'RL',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,5,iconv( 'UTF-8','TIS-620',null),'RTL',0,'L');
        $pdf::SetDash();
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(81.333,5,iconv( 'UTF-8','TIS-620','ผ่านตามข้อกำหนด (Passed Dimension)'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'LR',1,'C');
        // เนื้อหา 24
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,1,iconv( 'UTF-8','TIS-620',null),'RL',0,'L');
        $pdf::SetDash();
        $pdf::Cell(10,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(81.333,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'RL',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,1,iconv( 'UTF-8','TIS-620',null),'RL',0,'L');
        $pdf::SetDash();
        $pdf::Cell(10,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(81.333,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'LR',1,'C');
        // เนื้อหา 25
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,5,iconv( 'UTF-8','TIS-620',null),'RL',0,'L');
        $pdf::SetDash();
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(81.333,5,iconv( 'UTF-8','TIS-620','ไม่ผ่านตามข้อกำหนดคุณภาพเบื้องต้น (Quick Qualily Check)'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'RL',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,5,iconv( 'UTF-8','TIS-620',null),'RL',0,'L');
        $pdf::SetDash();
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(81.333,5,iconv( 'UTF-8','TIS-620','ไม่ผ่านตามข้อกำหนด (Not Passed Dimension)'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'LR',1,'C');
        // เนื้อหา 24
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,1,iconv( 'UTF-8','TIS-620',null),'RL',0,'L');
        $pdf::SetDash();
        $pdf::Cell(10,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(81.333,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'RL',0,'C');
        $pdf::Cell(3,1,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,1,iconv( 'UTF-8','TIS-620',null),'RL',0,'L');
        $pdf::SetDash();
        $pdf::Cell(10,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(81.333,1,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,1,iconv( 'UTF-8','TIS-620',null),'LR',1,'C');
        // เนื้อหา 26
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,5,iconv( 'UTF-8','TIS-620',null),'RL',0,'L');
        $pdf::SetDash();
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(86.333,5,iconv( 'UTF-8','TIS-620','- กรณีไม่ผ่านแจ้งระดับหัวหน้าที่สูงขึ้น และ/หรือ ผู้จัดการทันที'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'RL',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,5,iconv( 'UTF-8','TIS-620',null),'RL',0,'L');
        $pdf::SetDash();
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(5,5,iconv( 'UTF-8','TIS-620',null),1,0,'L');
        $pdf::Cell(81.333,5,iconv( 'UTF-8','TIS-620','อื่นๆ (Others)'),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'LR',1,'C');
        // เนื้อหา 27
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,5,iconv( 'UTF-8','TIS-620',null),'RL',0,'L');
        $pdf::SetDash();
        $pdf::Cell(91.333,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'RL',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,5,iconv( 'UTF-8','TIS-620',null),'RL',0,'L');
        $pdf::SetDash();
        $pdf::Cell(91.333,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'RL',1,'C');
        // เนื้อหา 28
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,5,iconv( 'UTF-8','TIS-620',null),'RLB',0,'L');
        $pdf::SetDash();
        $pdf::Cell(91.333,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'RL',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(43.167,5,iconv( 'UTF-8','TIS-620',null),'RLB',0,'L');
        $pdf::SetDash();
        $pdf::Cell(91.333,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'RL',1,'C');
        // เนื้อหา 29
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(30.5,5,iconv( 'UTF-8','TIS-620','หัวหน้างาน (Supervisor):'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(30,5,iconv( 'UTF-8','TIS-620',null),'B',0,'L');
        $pdf::SetDash();
        $pdf::Cell(74,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'RL',0,'C');
        $pdf::Cell(3,5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(30.5,5,iconv( 'UTF-8','TIS-620','หัวหน้างาน (Supervisor):'),0,0,'L');
        $pdf::SetDash(1,1);
        $pdf::Cell(30,5,iconv( 'UTF-8','TIS-620',null),'B',0,'L');
        $pdf::SetDash();
        $pdf::Cell(74,5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,5,iconv( 'UTF-8','TIS-620',null),'RL',1,'C');
        // เนื้อหา 30
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(30.5,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(30,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(74,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'RL',0,'C');
        $pdf::Cell(3,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'L',0,'C');
        $pdf::Cell(30.5,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(30,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(74,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'L');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'RL',1,'C');
        // เนื้อหา 31
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'LB',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'C');
        $pdf::Cell(30.5,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'L');
        $pdf::Cell(30,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'L');
        $pdf::Cell(74,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'L');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'RB',0,'C');
        $pdf::Cell(3,2.5,iconv( 'UTF-8','TIS-620',null),0,0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'LB',0,'C');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'C');
        $pdf::Cell(30.5,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'L');
        $pdf::Cell(30,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'L');
        $pdf::Cell(74,2.5,iconv( 'UTF-8','TIS-620',null),'TB',0,'L');
        $pdf::Cell(2.5,2.5,iconv( 'UTF-8','TIS-620',null),'RB',1,'C');

        // $pdf::Image(storage_path('app/public/img/check-box-disable.png'),108.55,80,5,5,'PNG');
        // $pdf::Image(storage_path('app/public/img/check-box-enable.png'),108.55,80,5,5,'PNG');
        // $pdf::Image(storage_path('app/public/img/check-box-disable.png'),117.5,80,5,5,'PNG');
        // $pdf::Image(storage_path('app/public/img/check-box-enable.png'),117.5,80,5,5,'PNG');
        
        // $pdf::Image(storage_path('app/public/img/check-box-disable.png'),253.6,80,5,5,'PNG');
        // $pdf::Image(storage_path('app/public/img/check-box-enable.png'),253.6,80,5,5,'PNG');
        // $pdf::Image(storage_path('app/public/img/check-box-disable.png'),262.45,80,5,5,'PNG');
        // $pdf::Image(storage_path('app/public/img/check-box-enable.png'),262.45,80,5,5,'PNG');
		$pdf::Image(storage_path('app/public/img/logo.png'),9,16,27.70908,12,'PNG');
		$pdf::Image(storage_path('app/public/img/logo.png'),154,16,27.70908,12,'PNG');
		// $pdf::Image(storage_path('app/public/img/logo.png'),6,103,18.47272,8,'PNG');
        // $pdf::Image(storage_path('app/public/img/logo.png'),151,103,18.47272,8,'PNG');
        // if($data->mimeType == 'image/png'){
        //     $type_file = 'PNG';
        // }else{
        //     $type_file = 'JPEG';
        // }
		// $pdf::Image($data->img,105.75,34,40,40,$type_file);
		// $pdf::Image($data->img,250.75,34,40,40,$type_file);
		// $pdf::Image($data->img,105.75,125,40,40,$type_file);
		// $pdf::Image($data->img,250.75,125,40,40,$type_file);
        return response($pdf::Output('selfcheckproduction.pdf' , 'I'))->header('Content-type', 'application/pdf');
       

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
