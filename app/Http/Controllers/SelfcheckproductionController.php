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
    protected $quality_result_name = array('T'=>'ผ่าน','F'=>'ไม่ผ่าน');
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
                'self_check_production.pqa_status',
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
                $d->production_status = $this->status_name[$d->production_status];
                $d->pqa_status = $this->status_name[$d->pqa_status];
                $d->is_enable = $this->is_enable_name[$d->is_enable];
            }
        }
        // echo '<pre>';print_r($data->items());'</pre>';exit;
        return view('pages.selfcheckproduction.index',[
            'data' => $data
        ]);
    }

    public function add()
    {
        $itemData = new \stdClass();
        $lot = 'xx';
        $dataSelfCheckProduction = DB::table('pre_production_check')
                                ->leftJoin('lkup_lot_tag','pre_production_check.lot_tag_id','=','lkup_lot_tag.id')
                                ->select('lkup_lot_tag.part_no')
                                ->get();

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

        return view('pages.selfcheckproduction.add',[
            'lotNo' => date('ymd').$lot,
            'toDate' => date('d/m/Y'),
            'item' => $itemData,
            'atShlft' => $atShlft
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
                // echo '<pre>';print_r($request->all());'</pre>';exit;
                $data = DB::table('self_check_production')->insert([
                    'pre_production_check_id' => $request->pre_production_check_id,
                    'production_order' => $request->production_order,
                    'lot_no_fix' => date('ymd'),
                    'lot_no' => $request->lot_no,
                    'production_date' => $request->production_date,
                    'at_shlft' => $request->at_shlft,
                    'production_quality_result' => 'T',
                    'pqa_quality_result' => 'T',
                    'production_status' => 'W',
                    'pqa_status' => 'W',
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
    public function edit($id)
    {
        //
        // echo '<pre>';print_r(Auth::user()->getAttributes());'</pre>';exit;
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
                $item->lot_no  = str_split($item->lot_no, 6);
                if($item->production_status != 'C'){
                    $item->production_quality_result = '-';
                }
                $item->pqa_status = $this->status_name[$item->pqa_status];
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
    public function update(Request $request, $id)
    {
        //
        if(Auth::user()->getAttributes()['id']){
            $validator = Validator::make($request->all(),$this->rules(),$this->messages());
            if($validator->fails()){
                return redirect('selfcheckproduction/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
            }else{
                // echo '<pre>';print_r(Auth::user());'</pre>';exit;
                $result = DB::table('self_check_production')->where('id',$id)
                ->update([
                    'pre_production_check_id' => $request->pre_production_check_id,
                    'production_order' => $request->production_order,
                    'lot_no_fix' => $request->lot_no_fix,
                    'lot_no' => $request->lot_no,
                    'production_date' => $request->production_date,
                    'neck_broken' => $request->neck_broken ? 'Y' : 'N',
                    'burr' => $request->burr ? 'Y' : 'N',
                    'work_example' => $request->work_example ? 'Y' : 'N',
                    'issue_detail' => $request->issue_detail ? $request->issue_detail : null,
                    'issue_more_detail' => $request->issue_more_detail ? $request->issue_more_detail : null,
                    'at_shlft' => $request->at_shlft,
                    'production_status' => 'C',
                    'production_quality_result' => $request->production_quality_result,
                    'updated_by' => Auth::user()->getAttributes()['id'],
                    'updated_at' => date('Y-m-d h:i:s'),
                    'is_enable' => 'Y'
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
            // echo '<pre>';print_r($queries);'</pre>';exit;
        foreach ($queries as $query)
        {
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
                'sheet_name' => $query->sheet_name
            ];
        }
        return Response::json($results);
    }

    public function rules()
    {
        //
        $rules = [
            'lot_no' => 'required|numeric|min:2',
            'part_no' => 'required',
            // 'email' => 'required|email',
            // 'role' => 'required',
            // 'password' => 'required|min:8',
            // 'confirm_password' => 'required|min:8|same:password',
        ];
        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'lot_no.required' => 'กรุณากรอกเลขที่ล็อตให้ครบถ้วน',
            'lot_no.numeric' => 'กรุณากรอกเป็นตัวเลข 0-9',
            'lot_no.min' => 'กรุณากรอกเลขที่ล็อต 2 ตัวสุดท้ายให้ถูกต้อง',
            'part_no.required' => 'กรุณากรอก Part Number',
            // 'last_name.required' => 'กรุณากรอกนามสกุล',
            // 'last_name.max' => 'นามสกุลความยาวไม่เกิน 20 ตัวอักขระ',
            // 'email.required' => 'กรุณากรอกอิเมล',
            // 'email.email' => 'กรุณากรอกที่อยู่อิเมลให้ถูกต้อง',
            // 'role.required' => 'กรุณาระบุสิทธิการใช้งาน',
            // 'password.required' => 'กรุณากรอกรหัสผ่าน',
            // 'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักขระ',
            // 'confirm_password.required' => 'กรุณากรอกยืนยันรหัสผ่าน',
            // 'confirm_password.min' => 'ยืนยันรหัสผ่านต้องมีอย่างน้อย 8 ตัวอักขระ',
            // 'confirm_password.same' => 'รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน',
        ];
        return $messages;
    }

}
