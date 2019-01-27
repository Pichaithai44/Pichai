<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade as PDF;
use Spatie\ArrayToXml\ArrayToXml;
use Vyuldashev\XmlToArray\XmlToArray;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $payment_type_decode = ['interest_payment' => 'ชำระ : ดอกเบี้ย', 'pay_all_balances' => 'ชำระ : ทั้งหมด'];

    public function index()
    {
        //
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

    public function member_report_pdf()
    {

        DB::statement(DB::raw('set @rownum=0'));

        $personals_result = DB::table('personals')
        ->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            DB::raw('CONCAT(personal_title_name, personal_first_name," ", personal_last_name) AS full_name'),
            DB::raw("CONCAT('') AS personal_tel_id"),
            DB::raw("CONCAT('') AS address"),
            "personal_xml",
            "created_at",
            "created_by"
        ])->paginate();

        if($personals_result->items() && count($personals_result->items()) > 0) {
            foreach ($personals_result->items() as $key => $value) {

                if(!empty($value->personal_xml)) {

                    $xml_info = XmlToArray::convert($value->personal_xml);

                    if(!empty($xml_info['system_local']['address']['personal_adr']))
                    $personals_result->items()[$key]->address = "บ้านเลขที่ {$xml_info['system_local']['address']['personal_adr']} ";
                    if(!empty($xml_info['system_local']['address']['personal_moo']))
                    $personals_result->items()[$key]->address .= "หมู่ที่ {$xml_info['system_local']['address']['personal_moo']} ";
                    if(!empty($xml_info['system_local']['address']['personal_soi']))
                    $personals_result->items()[$key]->address .= "ตรอก/ซอย {$xml_info['system_local']['address']['personal_soi']} ";
                    if(!empty($xml_info['system_local']['address']['personal_road']))
                    $personals_result->items()[$key]->address .= "ถนน {$xml_info['system_local']['address']['personal_road']} ";

                    if(!empty($xml_info['system_local']['contact']['personal_tel_id']))
                    $personals_result->items()[$key]->personal_tel_id = $xml_info['system_local']['contact']['personal_tel_id'];
                }
                unset($personals_result->items()[$key]->personal_xml);
            }
        }

        $result['data_arr'] = $personals_result;
   
        $pdf = PDF::loadView('pages.pdf.member', ['result' => $result]);

        return @$pdf->stream();
    }

    public function product_report_pdf()
    {
        DB::statement(DB::raw('set @rownum=0'));

        $products_result = DB::table('products')
        ->leftJoin('personals', 'personals.personal_code', '=', 'products.personal_code')
        ->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            DB::raw('CONCAT(personals.personal_title_name, personals.personal_first_name," ", personals.personal_last_name) AS full_name'),
            "products.product_name",
            "products.product_capital",
            "products.product_xml",
            "products.created_at",
            "products.created_by"
        ])
        ->where("products.is_active", "1")->paginate();
            
        if($products_result->items() && count($products_result->items()) > 0) {
            foreach ($products_result->items() as $key => $value) {

                if(!empty($value->product_xml)) {

                    $xml_info = XmlToArray::convert($value->product_xml);

                    if(!empty($xml_info['system_local']['products']['pay_ref']))
                    $products_result->items()[$key]->pay_slip_no = $xml_info['system_local']['products']['pay_ref'];
                    if(!empty($xml_info['system_local']['products']['product_slip_no']))
                    $products_result->items()[$key]->pay_slip_no .= "-{$xml_info['system_local']['products']['product_slip_no']}";
                }
                unset($products_result->items()[$key]->product_xml);
            }
        }

        $result['data_arr'] = $products_result;

        $pdf = PDF::loadView('pages.pdf.product', ['result' => $result]);
        return @$pdf->stream();
    }

    public function payment_report_pdf()
    {
        DB::statement(DB::raw('set @rownum=0'));

        $untitled_result = DB::table('untitled')
        ->leftJoin('personals', 'personals.personal_code', '=', 'untitled.personal_code')
        ->leftJoin('products', 'products.personal_code', '=', 'personals.personal_code')
        ->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            DB::raw('CONCAT(personals.personal_title_name, personals.personal_first_name," ", personals.personal_last_name) AS full_name'),
            "products.product_name",
            "untitled.date_payment",
            "untitled.payment_type",
            "untitled.debt_payment",
            "untitled.created_at",
            "untitled.created_by",
        ])
        ->paginate();
         
        if($untitled_result->items() && count($untitled_result->items()) > 0) {
            foreach ($untitled_result->items() as $key => $value) {
                $untitled_result->items()[$key]->payment_type = $this->payment_type_decode[$value->payment_type];
            }
        }
        $result['data_arr'] = $untitled_result;

        $pdf = PDF::loadView('pages.pdf.payment', ['result' => $result]);
        $pdf->setPaper('A4', 'landscape');
        return @$pdf->stream();
    }

    // รายงานไถ่สินค้าคืน
    public function redemption_report_pdf()
    {
        $id = 'B064CCBC73732';

        DB::statement(DB::raw('set @rownum=0'));

        $products_result = DB::table('products')
        ->leftJoin('personals', 'personals.personal_code', '=', 'products.personal_code')
        ->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            DB::raw('CONCAT(personals.personal_title_name, personals.personal_first_name," ", personals.personal_last_name) AS full_name'),
            "products.product_name",
            "products.product_capital",
            "products.updated_at",
            "products.updated_by"
        ])
        ->where("products.is_active", "0")->paginate();

        $result['data_arr'] = $products_result;

        $pdf = PDF::loadView('pages.pdf.redemption', ['result' => $result]);
        return @$pdf->stream();
    }
}
