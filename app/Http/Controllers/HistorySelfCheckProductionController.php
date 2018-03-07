<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistorySelfCheckProductionController extends Controller
{
    protected $is_enable_name = array('Y'=>'เผยแพร่','N'=>'ไม่เผยแพร่');
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('self_check_production')
            ->whereNULL('deleted_at')
            ->get();
        $item = array();
        if(count($data)>0){
            foreach($data as $d){
                $i['id'] = $d->id;
                $i['submodel_id'] = $d->submodel_id;
                $i['customer_id'] = $d->customer_id;
                $i['production_line_id'] = $d->production_line_id;
                $i['q_point_sheet_id'] = $d->q_point_sheet_id;
                $i['production_order'] = $d->production_order;
                $i['lot_no'] = $d->lot_no;
                $i['production_date'] = $d->production_date;
                $i['created_at'] = $d->created_at;
                $i['updated_at'] = $d->updated_at ? $d->updated_at : '-';
                $i['is_enable'] = $this->is_enable_name[$d->is_enable];
                $item[] = $i; 
            }
        }
        // echo '<pre>';print_r($item);'</pre>';exit;
        return view('pages.historyselfcheckproduction.index',[
            'item' => $item
        ]);
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
