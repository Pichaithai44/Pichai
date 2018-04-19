<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Validator;

class PreProductionCheckController extends Controller
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
        $data = DB::table('pre_production_check')
                ->leftJoin('lkup_lot_tag','lkup_lot_tag.id','=','pre_production_check.lot_tag_id')
                ->leftJoin('lkup_model','lkup_model.id','=','lkup_lot_tag.model_id')
                ->leftJoin('customer','customer.id','=','pre_production_check.customer_id')
                ->leftJoin('lkup_production_line','lkup_production_line.id','=','pre_production_check.production_line_id')
                ->leftJoin('lkup_q_point','lkup_lot_tag.id','=','lkup_q_point.lot_tag_id')
                ->select(
                    'pre_production_check.id',
                    'lkup_lot_tag.part_no',
                    'lkup_lot_tag.part_name',
                    'lkup_model.name as model_name',
                    'customer.customer_name',
                    'lkup_production_line.line_name',
                    'pre_production_check.created_at',
                    'pre_production_check.updated_at',
                    'pre_production_check.is_enable'
                    )
                ->whereNULL('pre_production_check.deleted_at')
                ->paginate(8);
        if(count($data->items())>0){
            $items = array();
            foreach($data->items() as $d){
                // echo '<pre>';print_r($data->items());'</pre>';exit;
                $check = DB::table('self_check_production')
                ->select('production_quality_result','pqa_quality_result','lot_no_fix','lot_no','total_check_result')
                ->whereNULL('deleted_at')
                ->where('pre_production_check_id',$d->id)
                ->get();
                $d->lot = $check;
                if(count($d->lot)>0){
                    foreach($d->lot as $lot){
                        $lot->production_quality_result = json_decode($lot->production_quality_result);
                        $lot->pqa_quality_result = json_decode($lot->pqa_quality_result);

                        if(count($lot->production_quality_result)>0){
                            $cpd = array();
                            foreach($lot->production_quality_result as $pd){
                               $cpd[] = $pd; 
                            }
                        }
                        if(count($lot->pqa_quality_result)>0){
                            $cpqa = array();
                            foreach($lot->pqa_quality_result as $pqa){
                                $cpd[] = $pqa[0];
                            }
                        }
                        $is_ng = false;
                        if(count($cpd)>0){
                            foreach($cpd as $p){
                                if($p == 'F' && !$is_ng){
                                    $is_ng = true;
                                } 
                            }
                        }
                        if($is_ng){
                            $item['lot'] = $lot->lot_no_fix.''.$lot->lot_no;
                            $item['status'] = 'NG';
                            $item['total'] = $lot->total_check_result ? $lot->total_check_result : 0;
                        }else{
                            $is_w = false;
                            foreach($cpd as $p){
                                if($p == 'W' && !$is_w){
                                    $is_w = true;
                                } 
                            }
                            if($is_w){
                                $item['lot'] = $lot->lot_no_fix.''.$lot->lot_no;
                                $item['status'] = 'WAIT';
                                $item['total'] = $lot->total_check_result ? $lot->total_check_result : 0;
                            } else{
                                $item['lot'] = $lot->lot_no_fix.''.$lot->lot_no;
                                $item['status'] = 'OK';
                                $item['total'] = $lot->total_check_result ? $lot->total_check_result : 0;
                            }
                        }
                        $items[] = $item;
                    }
                    $d->lot = $items;
                }
                $d->is_enable = $this->is_enable_name[$d->is_enable];
            }
        }
        // echo '<pre>';print_r($data->items());exit;
        return view('pages.preproductioncheck.index',[
            'data' => $data
        ]);
    }

    public function add()
    {
        //
        $dataProductionLine = DB::table('lkup_production_line')
                ->get();
        $proDuctionLineOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $proDuctionLineOption[] = $i; 
        if(count($dataProductionLine)>0){
            foreach($dataProductionLine as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->line_name;
                $proDuctionLineOption[] = $i; 
            }
        }

        $dataCustomer = DB::table('customer')
                ->get();
        $customerOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $customerOption[] = $i; 
        if(count($dataCustomer)>0){
            foreach($dataCustomer as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->customer_name;
                $customerOption[] = $i; 
            }
        }

        return view('pages.preproductioncheck.add',[
            'customerOption' => $customerOption,
            'proDuctionLineOption' => $proDuctionLineOption
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //        
        if(Auth::user()->getAttributes()['id']){
            $validator = Validator::make($request->all(),$this->rules(),$this->messages());
            if($validator->fails()){
                return redirect('preproductioncheck/add')
                ->withErrors($validator)
                ->withInput();
            }else{
                DB::table('pre_production_check')->insert([
                    'lot_tag_id' => $request->lottag_id,
                    'customer_id' => $request->customer,
                    'product_order' => $request->product_order,
                    'production_line_id' => $request->production_line,
                    'is_enable' => $request->isEnable,
                    'created_by' => Auth::user()->getAttributes()['id'],
                    'created_at' => date('Y-m-d h:i:s')
                ]);
                return redirect()->route('pages.preproductioncheck.index');
            }
        } else {
            return redirect('home');
        }

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
        $dataProductionLine = DB::table('lkup_production_line')
                ->get();
        $proDuctionLineOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $proDuctionLineOption[] = $i; 
        if(count($dataProductionLine)>0){
            foreach($dataProductionLine as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->line_name;
                $proDuctionLineOption[] = $i; 
            }
        }

        $dataCustomer = DB::table('customer')
                ->get();
        $customerOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $customerOption[] = $i; 
        if(count($dataCustomer)>0){
            foreach($dataCustomer as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->customer_name;
                $customerOption[] = $i; 
            }
        }

        $data = DB::table('pre_production_check')
            ->leftJoin('lkup_lot_tag','pre_production_check.lot_tag_id','=','lkup_lot_tag.id')
            ->leftJoin('lkup_q_point','pre_production_check.q_point_sheet_id','=','lkup_q_point.id')
            ->leftJoin('lkup_model','lkup_lot_tag.model_id','=','lkup_model.id')
            ->select(
                'pre_production_check.*',
                'lkup_lot_tag.part_no',
                'lkup_lot_tag.part_name',
                'lkup_model.name as model_name',
                'lkup_lot_tag.model_id',
                'lkup_q_point.sheet_name'
                )
            ->where('pre_production_check.id',$id)
            ->first();
            
        return view('pages.preproductioncheck.edit',[
            'item' => $data,
            'customerOption' => $customerOption,
            'proDuctionLineOption' => $proDuctionLineOption
        ]);
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
        if(Auth::user()->getAttributes()['id']){
            $validator = Validator::make($request->all(),$this->rules(),$this->messages());
            if($validator->fails()){
                return redirect('preproductioncheck/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
            }else{
                $result = DB::table('pre_production_check')->where('id',$id)
                    ->update([
                    'lot_tag_id' => $request->lottag_id,
                    'customer_id' => $request->customer,
                    'production_line_id' => $request->production_line,
                    'q_point_sheet_id' => $request->q_point,
                    'is_enable' => $request->isEnable,
                    'updated_by' => Auth::user()->getAttributes()['id'],
                    'updated_at' => date('Y-m-d h:i:s')
                ]);
        
                if($result){
                    $message = 'บันทึกรายการสำเร็จ';
                }else{
                    $message = 'บันทึกรายการไม่สำเร็จ';
                }
                return redirect()->back()->withStatus($message)->withResult($result);
            }
        } else {
            return redirect('home');
        }
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
        if(Auth::user()->getAttributes()['id']){
            DB::table('pre_production_check')->where('id',$id)
            ->update([
                'updated_by' => Auth::user()->getAttributes()['id'],
                'deleted_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->route('pages.preproductioncheck.index');
        } else {
            return redirect('home');
        }
    }

    public function autocomplete(){
        $term = Input::get('term');
        $results = array();
        
        $queries = DB::table('lkup_lot_tag')
            ->leftJoin('lkup_q_point','lkup_lot_tag.id','=','lkup_q_point.lot_tag_id')
            ->leftJoin('lkup_model','lkup_lot_tag.model_id','=','lkup_model.id')
            ->select(
                'lkup_lot_tag.id as lottag_id',
                'lkup_lot_tag.part_no',
                'lkup_lot_tag.part_name',
                'lkup_q_point.sheet_name',
                'lkup_q_point.id as q_point_id',
                'lkup_model.name as model_name'
                )
            ->where('lkup_lot_tag.part_no', 'LIKE', '%'.$term.'%')
            ->take(10)->get();
        foreach ($queries as $query)
        {
            $results[] = [
                'value' => $query->part_no,
                'lottag_id' => $query->lottag_id,
                'part_name' => $query->part_name,
                'model_name' => $query->model_name,
                'q_point_id' => $query->q_point_id,
                'sheet_name' => $query->sheet_name
            ];
        }
    return Response::json($results);
    }

    public function rules()
    {
        //
        $rules = [
            'customer' => 'required',
            'part_no' => 'required',
            'part_name' => 'required',
            'model' => 'required',
            'q_point' => 'required',
            'production_line' => 'required',
            'product_order' => 'required'
        ];
        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'customer.required' => 'กรุณาระบุลูกค้า',
            'part_no.required' => 'กรุณากรอก PART Number',
            'part_name.required' => 'กรุณากรอก PART Number',
            'model.required' => 'กรุณากรอก PART Number',
            'q_point.required' => 'กรุณากรอก PART Number',
            'production_line.required' => 'กรุณาเลือก ไลน์การผลิต',
            'product_order.required' => 'กรุณาระบุจำนวนที่ผลิต',
        ];
        return $messages;
    }
}
