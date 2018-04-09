<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Validator;

class QpointController extends Controller
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
        $data = DB::table('lkup_q_point')
                ->whereNULL('deleted_at')
                ->paginate(8);
                
        if(count($data->items())>0){
            foreach($data->items() as $d){
                $d->updated_at = $d->updated_at ? $d->updated_at : '-';
                $d->is_enable = $this->is_enable_name[$d->is_enable];
            }
        }
        return view('pages.qpoint.index',[
            'data' => $data
        ]);
    }

    public function add()
    {
        //
        return view('pages.qpoint.add');
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
                return redirect('qpoint/add')
                ->withErrors($validator)
                ->withInput();
            }else{
                DB::table('lkup_q_point')->insert([
                    'sheet_name' => $request->qpoint_name,
                    'lot_tag_id' => $request->lottag_id,
                    'is_enable' => $request->isEnable,
                    'created_by' => Auth::user()->getAttributes()['id'],
                    'created_at' => date('Y-m-d h:i:s')
                ]);
                return redirect()->route('pages.qpoint.index');
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
        $data = DB::table('lkup_q_point')
                    ->leftJoin('lkup_lot_tag','lkup_q_point.lot_tag_id','=','lkup_lot_tag.id')
                    ->leftJoin('lkup_model','lkup_lot_tag.model_id','=','lkup_model.id')
                    ->leftJoin('lkup_material','lkup_lot_tag.material_id','=','lkup_material.id')
                    ->leftJoin('lkup_type','lkup_lot_tag.type_id','=','lkup_type.id')
                    ->leftJoin('file','lkup_lot_tag.intro_img_id','=','file.id')
                    ->select(
                        'lkup_q_point.id',
                        'lkup_q_point.sheet_name',
                        'lkup_q_point.is_enable',
                        'lkup_lot_tag.id as lottag_id',
                        'lkup_lot_tag.part_no',
                        'lkup_lot_tag.part_name',
                        'lkup_model.name as model_name',
                        'lkup_material.name as material_name',
                        'lkup_type.name as type_name',
                        'lkup_lot_tag.material_t',
                        'file.filebase64 as img'
                        )
                        ->where('lkup_q_point.id',$id)
                        ->first();

        return view('pages.qpoint.edit',[
            'item' => $data
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
                return redirect('qpoint/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
            }else{
                $result = DB::table('lkup_q_point')->where('id',$id)
                ->update([
                    'sheet_name' => $request->qpoint_name,
                    'lot_tag_id' => $request->lottag_id,
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
            DB::table('lkup_q_point')->where('id',$id)
            ->update([
                'updated_by' => Auth::user()->getAttributes()['id'],
                'deleted_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->route('pages.qpoint.index');
        } else {
            return redirect('home');
        }
    }

    public function autocomplete(){
        $term = Input::get('term');
        $results = array();
        $queries = DB::table('lkup_lot_tag')
            ->leftJoin('lkup_model','lkup_lot_tag.model_id','=','lkup_model.id')
            ->leftJoin('lkup_material','lkup_lot_tag.material_id','=','lkup_material.id')
            ->leftJoin('lkup_type','lkup_lot_tag.type_id','=','lkup_type.id')
            ->select(
                'lkup_lot_tag.id as lottag_id',
                'lkup_lot_tag.part_no',
                'lkup_lot_tag.part_name',
                'lkup_model.name as model_name'
                )
            ->where('lkup_lot_tag.part_no', 'LIKE', '%'.$term.'%')
            ->take(10)->get();
            // echo '<pre>';print_r($queries);'</pre>';exit;
        foreach ($queries as $query)
        {
            $results[] = [
                'value' => $query->part_no,
                'lottag_id' => $query->lottag_id,
                'part_name' => $query->part_name,
                'model_name' => $query->model_name,
            ];
        }
        echo '<pre>';print_r($results);'</pre>';exit;
        return Response::json($results);
    }

    public function rules()
    {
        //
        $rules = [
            'qpoint_name' => 'required',
            'part_no' => 'required',
            'part_name' => 'required',
            'model_name' => 'required',
            'material' => 'required',
            'type' => 'required',
            't_value' => 'required'
        ];
        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'qpoint_name.required' => 'กรุณากรอกชื่อ Q-Point Sheet',
            'part_no.required' => 'กรุณากรอก PART Number',
            'part_name.required' => 'กรุณากรอก PART Number',
            'model_name.required' => 'กรุณากรอก PART Number',
            'material.required' => 'กรุณากรอก PART Number',
            'type.required' => 'กรุณากรอก PART Number',
            't_value.required' => 'กรุณากรอก PART Number'
        ];
        return $messages;
    }
}
