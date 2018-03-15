<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Validator;

class SelfcheckproductionController extends Controller
{
    protected $is_enable_name = array('Y'=>'เผยแพร่','N'=>'ไม่เผยแพร่');
    protected $status_name = array('W'=>'รอตรวจสอบ','C'=>'ตรวจสอบแล้ว');
    protected $quality_result_name = array('W'=>'รอตรวจสอบ','T'=>'ผ่าน','F'=>'ไม่ผ่าน');
    protected $delivery_check = array(
        0 => '-- กรุณาเลือก --',
        1 => 'ชิ้นงานระหว่างกระบวนการ (Semi Part)',
        2 => 'ชิ้นงานสำเร็จรูปจากไลน์ประกอบ (F/G Assembly)',
        3 => 'ชิ้นงานสำเร็จรูปจากไลน์ปั๊มชิ้นส่วน (F/G Stemping)',
        4 => 'ตรวจสอบตามเงื่อนไขพิเศษ (Special Case as The Customer Requirement)'
    );
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('self_check_production')
        ->leftJoin('pre_production_check','self_check_production.pre_production_check_id','=','pre_production_check.id')
        ->leftJoin('lkup_lot_tag','pre_production_check.lot_tag_id','=','lkup_lot_tag.id')
            ->select(
                'self_check_production.id',
                'lkup_lot_tag.part_no',
                'lkup_lot_tag.part_name',
                'self_check_production.lot_no',
                'self_check_production.lot_no_fix',
                'self_check_production.production_status',
                'self_check_production.production_quality_result',
                'self_check_production.pqa_status',
                'self_check_production.pqa_quality_result',
                'self_check_production.production_date',
                'self_check_production.updated_at',
                'self_check_production.created_at',
                'self_check_production.is_enable'
                )
            ->whereNULL('self_check_production.deleted_at')
            ->paginate(8);
        if(count($data->items())>0){
            foreach($data->items() as $d){
                $d->updated_at = $d->updated_at ? $d->updated_at : '-';
                $d->production_status = json_decode($d->production_status);
                $d->production_quality_result = json_decode($d->production_quality_result);
                $d->pqa_status = json_decode($d->pqa_status);
                $d->pqa_quality_result = json_decode($d->pqa_quality_result);
                $d->is_enable = $this->is_enable_name[$d->is_enable];
            }
        }
        return view('pages.selfcheckproduction.index',[
            'data' => $data
        ]);
    }

    public function add(Request $request)
    {
        $process_id = null;
        $processOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $processOption[] = $i; 

        $atShlft = array();
        for($i = 1; $i <= 2; $i++){
            $item['value'] = '0'.$i;
            if((((float)date('H.i')) > 7.0) && (((float)date('H.i')) <= 19.0)){
                if($i == 1){
                    $item['check'] = true;
                } else if($i == 2){
                    $item['check'] = false;
                }
            }else{
                if($i == 1){
                    $item['check'] = false;
                } else if($i == 2){
                    $item['check'] = true;
                }
            }
            
            $atShlft[] = $item;
        }
        if(!empty($request->has('processOption'))){
            $processOption = $request->processOption;
        }
        if(!empty($request->has('process_id'))){
            $process_id = $request->process_id;
        }
// echo '<pre>';print_r($processOption);'</pre>';exit;
        return view('pages.selfcheckproduction.add',[
            'toDate' => date('d/m/Y'),
            'atShlft' => $atShlft,
            'processOption' => $processOption,
            'process_id' => $process_id
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
                return redirect('selfcheckproduction/add')
                ->withErrors($validator)
                ->withInput();
            }else{
                $check = DB::table('self_check_production')
                ->where('pre_production_check_id',$request->pre_production_check_id)->get();

                $dataProcesss = DB::table('pre_production_check')
                ->leftJoin('lkup_lot_tag','pre_production_check.lot_tag_id','=','lkup_lot_tag.id')
                ->leftJoin('lot_tag_process_file','lkup_lot_tag.id','=','lot_tag_process_file.lot_tag_id')
                ->leftJoin('lkup_process','lot_tag_process_file.process_id','=','lkup_process.id')
                ->select('lkup_process.id','lkup_process.name')
                ->where('pre_production_check.id',$request->pre_production_check_id)
                ->get();
                $processOption = array();
                $i['id'] = 0;
                $i['name'] = '-- กรุณาเลือก --';
                $processOption[] = $i; 
                if(count($dataProcesss)>0){
                    foreach($dataProcesss as $m){
                        $i['id'] = $m->id;
                        $i['name'] = $m->name;
                        $processOption[] = $i; 
                    }
                }
                if(count($check)>0){
                    foreach($check as $c){
                        if($c->lot_no_fix.''.$c->lot_no == $request->lot_no_fix.''.$request->lot_no && ($c->process_id == $request->process) || (!$c->process_id && $request->process == '-- กรุณาเลือก --')){
                            $message = 'หมายเลขท้ายล๊อต 2 ตัวท้าย ได้ใช้กับ Part Number นี้ไปแล้วในวันนี้';
                            return redirect()->route('pages.selfcheckproduction.add',[
                                'processOption'=>$processOption,
                                'process_id'=>$request->process
                            ])->withStatus($message)->withResult(false)->withInput();
                        }
                    }
                }
                // echo '<pre>';print_r($request->all());'</pre>';exit;
                $data = DB::table('self_check_production')->insert([
                    'pre_production_check_id' => $request->pre_production_check_id,
                    'production_order' => $request->production_order,
                    'lot_no_fix' => date('ymd'),
                    'lot_no' => $request->lot_no,
                    'production_date' => $request->production_date,
                    'at_shlft' => $request->at_shlft,
                    'production_quality_result' => json_encode(array('W','W','W')),
                    'pqa_quality_result' => json_encode(array(array('W',null),array('W',null),array('W',null))),
                    'production_status' => json_encode(array('W','W','W')),
                    'pqa_status' => json_encode(array('W','W','W')),
                    'neck_broken' => json_encode(array(null,null,null)),
                    'burr' => json_encode(array(null,null,null)),
                    'work_example' => json_encode(array(null,null,null)),
                    'issue_detail' => json_encode(array(null,null,null)),
                    'issue_more_detail' => json_encode(array(null,null,null)),
                    'supervisor_pd' => json_encode(array(null,null,null)),
                    'supervisor_pqa' => json_encode(array(null,null,null)),
                    'process_id' => $request->process != '-- กรุณาเลือก --' ? $request->process : null,
                    'created_by' => Auth::user()->getAttributes()['id'],
                    'created_at' => date('Y-m-d h:i:s'),
                    'is_enable' => 'Y'
                ]);
                return redirect()->route('pages.selfcheckproduction.index');
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
    public function edit($id,$page)
    {
        //
        $dataModel = DB::table('lkup_model')
                ->whereNULL('deleted_at')
                ->where('is_enable','Y')
                ->get();
        $modelOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $modelOption[] = $i; 
        if(count($dataModel)>0){
            foreach($dataModel as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->name;
                $modelOption[] = $i; 
            }
        }

        $dataProductionLine = DB::table('lkup_model')
                ->get();
        $proDuctionLineOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $proDuctionLineOption[] = $i; 
        if(count($dataProductionLine)>0){
            foreach($dataProductionLine as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->name;
                $proDuctionLineOption[] = $i; 
            }
        }

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
        ->whereNULL('deleted_at')
        ->where('is_enable','Y')
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

        $item = DB::table('self_check_production')
                ->leftJoin('pre_production_check','self_check_production.pre_production_check_id','=','pre_production_check.id')
                ->leftJoin('customer','pre_production_check.customer_id','=','customer.id')
                ->leftJoin('lkup_production_line','pre_production_check.production_line_id','=','lkup_production_line.id')
                ->leftJoin('lkup_lot_tag','pre_production_check.lot_tag_id','=','lkup_lot_tag.id')
                ->leftJoin('lkup_q_point','lkup_lot_tag.id','=','lkup_q_point.lot_tag_id')
                ->leftJoin('lkup_model','lkup_lot_tag.model_id','=','lkup_model.id')
                ->leftJoin('lkup_type','lkup_lot_tag.type_id','=','lkup_type.id')
                ->select(
                    'self_check_production.*',
                    'lkup_lot_tag.id as lottag_id',
                    'lkup_lot_tag.part_no',
                    'lkup_lot_tag.part_name',
                    'lkup_lot_tag.material_t',
                    'lkup_type.name as type_name',
                    'lkup_model.name as model_name',
                    'customer.customer_name',
                    'lkup_production_line.line_name',
                    'lkup_q_point.sheet_name'
                )
                ->where('self_check_production.id',$id)
                ->whereNULL('self_check_production.deleted_at')
                ->where('self_check_production.is_enable','Y')
                ->first();
                    $dataProcesss = DB::table('lot_tag_process_file')
                    ->leftJoin('lkup_process','lot_tag_process_file.process_id','=','lkup_process.id')
                    ->select('lkup_process.id','lkup_process.name')
                    ->where('lot_tag_process_file.lot_tag_id',$item->lottag_id)
                    ->get();
                    $processOption = array();
                    $item->processName = null;
                    $i['id'] = null;
                    $i['name'] = '-- กรุณาเลือก --';
                    $processOption[] = $i; 
                    if(count($dataProcesss)>0){
                        foreach($dataProcesss as $m){
                            $i['id'] = $m->id;
                            $i['name'] = $m->name;
                            $processOption[] = $i; 
                        }
                        if(count($processOption)>0){
                            foreach($processOption as $pc){
                                if($pc['id'] == $item->process_id){
                                    $item->processName = $pc['name'];
                                }
                            }
                        }
                    }
                    $supervisor_pd_name = null;
                    $supervisor_pqa_name = null;
                    if(json_decode($item->supervisor_pd)[$page]){
                        $supervisor_pd_name = DB::table('users')
                                            ->where('is_id',json_decode($item->supervisor_pd)[$page])
                                            ->first();
                    }
                    if(json_decode($item->supervisor_pqa)[$page]){
                        $supervisor_pqa_name = DB::table('users')
                                            ->where('is_id',json_decode($item->supervisor_pqa)[$page])
                                            ->first();
                    }
                    

                $item->processOption = $processOption;
                $item->production_status = json_decode($item->production_status)[$page];
                $item->pqa_status = json_decode($item->pqa_status)[$page];
                $item->production_quality_result = json_decode($item->production_quality_result)[$page];
                $item->pqa_quality_result = json_decode($item->pqa_quality_result)[$page];
                $item->neck_broken = json_decode($item->neck_broken)[$page];
                $item->burr = json_decode($item->burr)[$page];
                $item->work_example = json_decode($item->work_example)[$page];
                $item->issue_detail = json_decode($item->issue_detail)[$page];
                $item->issue_more_detail = json_decode($item->issue_more_detail)[$page];
                $item->supervisor_pd = json_decode($item->supervisor_pd)[$page];
                $item->supervisor_pd_name = $supervisor_pd_name ? $supervisor_pd_name->first_name.' '.$supervisor_pd_name->last_name : null;
                $item->supervisor_pqa = json_decode($item->supervisor_pqa)[$page];
                $item->supervisor_pqa_name = $supervisor_pqa_name ? $supervisor_pqa_name->first_name.' '.$supervisor_pqa_name->last_name : null;
                $item->page = $page;
                $item->lot_no  = str_split($item->lot_no, 6);
                // echo '<pre>';print_r($item);'</pre>';exit;
        return view('pages.selfcheckproduction.edit',[
            'item' => $item,
            'proDuctionLineOption' => $proDuctionLineOption,
            'modelOption' => $modelOption,
            'customerOption' => $customerOption,
            'status_name' => $this->status_name,
            'quality_result_name' => $this->quality_result_name,
            'delivery_check' => $this->delivery_check
           ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$page)
    {
        //
        if(Auth::user()->getAttributes()['id']){
            $validator = Validator::make($request->all(),$this->rules(),$this->messages());
            if($validator->fails()){
                return redirect('selfcheckproduction/edit/'.$id.'/'.$page)
                ->withErrors($validator)
                ->withInput();
            }else{
                $check = DB::table('self_check_production')->where('id',$id)
                ->first();
                
                $check->production_status = json_decode($check->production_status);
                $check->production_quality_result = json_decode($check->production_quality_result);
                $check->pqa_status = json_decode($check->pqa_status);
                $check->pqa_quality_result = json_decode($check->pqa_quality_result);
                $check->neck_broken = json_decode($check->neck_broken);
                $check->burr = json_decode($check->burr);
                $check->work_example = json_decode($check->work_example);
                $check->issue_detail = json_decode($check->issue_detail);
                $check->issue_more_detail = json_decode($check->issue_more_detail);
                $check->supervisor_pd = json_decode($check->supervisor_pd);
                $check->supervisor_pqa = json_decode($check->supervisor_pqa);
                if(Auth::user()->getAttributes()['role_id'] == (1 || 2)){
                    if(Auth::user()->getAttributes()['department_id'] == 1 || Auth::user()->getAttributes()['role_id'] == 1){
                        $check->production_status[$page] = 'C';
                        $check->production_quality_result[$page] = $request->production_quality_result;
                        $check->neck_broken[$page] = $request->neck_broken;
                        $check->burr[$page] = $request->burr;
                        $check->work_example[$page] = $request->work_example;
                        $check->issue_detail[$page] = $request->issue_detail;
                        $check->issue_more_detail[$page] = $request->issue_more_detail;
                        $check->supervisor_pd[$page] = $request->supervisor_pd_id;
                        $result = DB::table('self_check_production')->where('id',$id)
                        ->update([
                            'pre_production_check_id' => $request->pre_production_check_id,
                            'production_order' => $request->production_order,
                            'lot_no_fix' => $request->lot_no_fix,
                            'lot_no' => $request->lot_no,
                            'production_date' => $request->production_date,
                            'neck_broken' => json_encode($check->neck_broken),
                            'burr' => json_encode($check->burr),
                            'work_example' => json_encode($check->work_example),
                            'issue_detail' => json_encode($check->issue_detail),
                            'issue_more_detail' => json_encode($check->issue_more_detail),
                            'at_shlft' => $request->at_shlft,
                            'job_type' => $request->job_check == 1 ? 'SP' : ($request->job_check == 2 ? 'A' : ($request->job_check == 3 ? 'S' : 'SCR')),
                            'supervisor_pd' => json_encode($check->supervisor_pd),
                            'production_status' => json_encode($check->production_status),
                            'production_quality_result' => json_encode($check->production_quality_result),
                            'updated_pd_by' => Auth::user()->getAttributes()['id'],
                            'updated_at' => date('Y-m-d h:i:s'),
                            'is_enable' => 'Y'
                        ]);
                        if($page == 2){
                            $result_total = DB::table('self_check_production')->where('id',$id)
                            ->update([
                                'total_check_result' => $request->total_check_result
                            ]);
                        }

                    }else if(Auth::user()->getAttributes()['department_id'] == 2){
                        if($check->production_status[$page] == 'W'){
                            $message = 'production ยังไม่ได้ตรวจในล๊อตการผลิตนี้';
                            return redirect()->back()->withStatus($message)->withResult(false)->withInput();
                        }
                        $check->pqa_status[$page] = 'C';
                        $check->pqa_quality_result[$page] = array($request->pqa_quality_result,$request->other_comment);
                        $check->supervisor_pqa[$page] = $request->supervisor_pqa_id;
                        $result = DB::table('self_check_production')->where('id',$id)
                        ->update([
                            'pqa_status' => json_encode($check->pqa_status),
                            'pqa_quality_result' => json_encode($check->pqa_quality_result),
                            'supervisor_pqa' => json_encode($check->supervisor_pqa),
                            'updated_pqa_by' => Auth::user()->getAttributes()['id'],
                            'updated_at' => date('Y-m-d h:i:s'),
                            'is_enable' => 'Y'
                        ]);
                    }
                }

                $message = $result ? 'บันทึกรายการสำเร็จ' : 'บันทึกรายการไม่สำเร็จ';
                return redirect()->back()->withStatus($message)->withResult($result)->withInput();
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
    }
    public function autocomplete(){
        $term = Input::get('term');
        $results = array();
        
        $queries = DB::table('pre_production_check')
            ->leftJoin('lkup_lot_tag','pre_production_check.lot_tag_id','=','lkup_lot_tag.id')
            ->leftJoin('lkup_model','lkup_lot_tag.model_id','=','lkup_model.id')
            ->leftJoin('lkup_production_line','pre_production_check.production_line_id','=','lkup_production_line.id')
            ->leftJoin('customer','pre_production_check.customer_id','=','customer.id')
            ->leftJoin('lkup_q_point','lkup_lot_tag.id','=','lkup_q_point.lot_tag_id')
            ->select(
                'pre_production_check.id',
                'pre_production_check.customer_id',
                'pre_production_check.product_order',
                'pre_production_check.product_order',
                'lkup_lot_tag.id as lottag_id',
                'lkup_lot_tag.part_no',
                'lkup_lot_tag.part_name',
                'lkup_production_line.line_name',
                'customer.customer_name',
                'lkup_model.name as model_name',
                'lkup_q_point.sheet_name'
                )
            ->where('lkup_lot_tag.part_no', 'LIKE', '%'.$term.'%')
            ->take(10)->get();
        foreach ($queries as $query)
        {
            $processs = DB::table('lot_tag_process_file')
                ->leftJoin('lkup_process','lot_tag_process_file.process_id','=','lkup_process.id')
                ->select('lkup_process.id','lkup_process.name')
                ->where('lot_tag_process_file.lot_tag_id',$query->lottag_id)->get();

            $results[] = [
                'value' => $query->part_no,
                'pre_production_check_id' => $query->id,
                'lottag_id' => $query->lottag_id,
                'part_name' => $query->part_name,
                'customer_id' => $query->customer_id,
                'customer_name' => $query->customer_name,
                'production_line' => $query->line_name,
                'model_name' => $query->model_name,
                'product_order' => $query->product_order,
                'sheet_name' => $query->sheet_name,
                'process' => count($processs) > 0 ? $processs : null
            ];
        }
        return Response::json($results);
    }
    public function autocompletesupervisor(){
        $term = Input::get('term');
        $results = array();
       
        $queries = DB::table('users')
            ->select(
                'is_id',
                'first_name',
                'last_name'
                )
            ->where('role_id',3)
            ->where('department_id',Auth::user()->getAttributes()['department_id'])
            ->where('first_name', 'LIKE', '%'.$term.'%')
            ->orWhere('last_name', 'LIKE', '%'.$term.'%')
            ->take(10)->get();
        foreach ($queries as $query)
        {
            $results[] = [
                'value' => $query->first_name.' '.$query->last_name,
                'id' => $query->is_id
            ];
        }
        return Response::json($results);
    }
    public function autocompletesupervisorid(){
        $term = Input::get('term');
        $results = array();
       
        $queries = DB::table('users')
            ->select(
                'is_id',
                'first_name',
                'last_name'
                )
            ->where('role_id',3)
            ->where('department_id',Auth::user()->getAttributes()['department_id'])
            ->where('is_id', 'LIKE', '%'.$term.'%')
            ->take(10)->get();
        foreach ($queries as $query)
        {
            $results[] = [
                'name' => $query->first_name.' '.$query->last_name,
                'value' => $query->is_id
            ];
        }
        return Response::json($results);
    }

    public function rules()
    {
        //
        $rules = [
            'lot_no' => 'required|numeric|digits_between:00,99',
            'part_no' => 'required',
        ];
        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'lot_no.required' => 'กรุณากรอกเลขที่ล็อตให้ครบถ้วน',
            'lot_no.numeric' => 'กรุณากรอกเป็นตัวเลข 0-9',
            'lot_no.digits_between' => 'กรุณากรอกเลขที่ล็อต 2 ตัวสุดท้ายให้ถูกต้อง',
            'part_no.required' => 'กรุณากรอก Part Number'
        ];
        return $messages;
    }

}
