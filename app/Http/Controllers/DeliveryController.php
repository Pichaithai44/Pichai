<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Validator;

class DeliveryController extends Controller
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
        $data = DB::table('delivery')
                ->leftJoin('lkup_lot_tag','delivery.lot_tag_id','=','lkup_lot_tag.id')
                ->leftJoin('lkup_model','lkup_lot_tag.model_id','=','lkup_model.id')
                ->leftJoin('customer','delivery.customer_id','=','customer.id')
                ->leftJoin('qbar_code','delivery.barcode_id','=','qbar_code.id')
                ->select(
                    'delivery.*',
                    'qbar_code.filebase64 as barcode_id',
                    'lkup_lot_tag.part_no',
                    'lkup_lot_tag.part_name',
                    'customer.customer_name',
                    'lkup_model.name as model_name'
                    )
                ->whereNULL('delivery.deleted_at')
                ->paginate(8);
        if(count($data->items())>0){
            foreach($data->items() as $d){
                $d->updated_at = $d->updated_at ? $d->updated_at : '-';
                $d->is_enable = $this->is_enable_name[$d->is_enable];
            }
        }
        return view('pages.delivery.index',[
            'data' => $data
        ]);
    }

    public function add()
    {
        //
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
        
        return view('pages.delivery.add',[
            'customerOption' => $customerOption
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
                return redirect('delivery/add')
                ->withErrors($validator)
                ->withInput();
            }else{
                $d = new DNS1D();
                $d->setStorPath(__DIR__."/cache/");
                $bar_code = 'data:image/png;base64,'.$d->getBarcodePNG(str_replace('-','',$request->part_number).'D'.date('ymdhis'), "C128");
                $id_barcode = DB::table('qbar_code')->insertGetId([
                    'filebase64' => $bar_code,
                    'created_by' => Auth::user()->getAttributes()['id'],
                    'created_at' => date('Y-m-d h:i:s')
                ]);
                DB::table('delivery')->insert([
                    'lot_tag_id' => $request->lottag_id,
                    'customer_id' => $request->customer,
                    'quantity' => $request->quantity,
                    'barcode_id' => $id_barcode,
                    'is_enable' => $request->isEnable,
                    'created_by' => Auth::user()->getAttributes()['id'],
                    'created_at' => date('Y-m-d h:i:s')
                ]);
                return redirect()->route('pages.delivery.index');
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
        return view('pages.delivery.edit',[
            'item' => DB::table('delivery')
            ->leftJoin('lkup_lot_tag','delivery.lot_tag_id','=','lkup_lot_tag.id')
            ->leftJoin('file','lkup_lot_tag.intro_img_id','=','file.id')
            ->leftJoin('lkup_model','lkup_lot_tag.model_id','=','lkup_model.id')
            ->leftJoin('lkup_type','lkup_lot_tag.type_id','=','lkup_type.id')
            ->leftJoin('lkup_material','lkup_lot_tag.material_id','=','lkup_material.id')
            ->select(
                'delivery.*',
                'file.id as file_id',
                'file.filebase64',
                'lkup_lot_tag.part_no',
                'lkup_lot_tag.part_name',
                'lkup_lot_tag.material_t',
                'lkup_model.name as model_name',
                'lkup_lot_tag.model_id',
                'lkup_type.name as type_name',
                'lkup_material.name as material_name'
                )
            ->where('delivery.id',$id)
            ->first(),
                'customerOption' => $customerOption
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
                return redirect('delivery/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
            }else{
                $check = DB::table('lkup_lot_tag')
                                ->where('id',$id)
                                ->first();
        
                if($check->barcode_id){
                    DB::table('qbar_code')->where('id',$check->barcode_id)->delete();
                }
                $d = new DNS1D();
                $d->setStorPath(__DIR__."/cache/");
                $bar_code = 'data:image/png;base64,'.$d->getBarcodePNG(str_replace('-','',$request->part_number).'D'.date('ymdhis'), "C128");
                $id_barcode = DB::table('qbar_code')->insertGetId([
                    'filebase64' => $bar_code,
                    'created_by' => Auth::user()->getAttributes()['id'],
                    'created_at' => date('Y-m-d h:i:s')
                ]);
                DB::table('delivery')->where('id',$id)
                ->update([
                    'lot_tag_id' => $request->lottag_id,
                    'customer_id' => $request->customer,
                    'quantity' => $request->quantity,
                    'barcode_id' => $id_barcode,
                    'is_enable' => $request->isEnable,
                    'updated_by' => Auth::user()->getAttributes()['id'],
                    'updated_at' => date('Y-m-d h:i:s')
                ]);
                
                return redirect()->route('pages.delivery.edit',[
                    'id' => $id
                ]);
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
            DB::table('delivery')->where('id',$id)
            ->update([
                'updated_by' => Auth::user()->getAttributes()['id'],
                'deleted_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->route('pages.delivery.index');
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
            ->leftJoin('file','lkup_lot_tag.intro_img_id','=','file.id')
            ->select(
                'lkup_lot_tag.id as lottag_id',
                'lkup_lot_tag.part_no',
                'lkup_lot_tag.part_name',
                'lkup_model.name as model_name',
                'lkup_material.name as material_name',
                'lkup_type.name as type_name',
                'lkup_lot_tag.material_t',
                'file.filebase64 as img'
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
                'material_name' => $query->material_name,
                'type_name' => $query->type_name,
                'material_t' => $query->material_t,
                'img' => $query->img
            ];
        }
    return Response::json($results);
    }

    public function rules()
    {
        //
        $rules = [
            'part_no' => 'required',
            'part_name' => 'required',
            'model_name' => 'required',
            'material' => 'required',
            'type' => 'required',
            't_value' => 'required',
            'customer' => 'required',
            'quantity' => 'required'
        ];
        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'part_no.required' => 'กรุณากรอก PART Number',
            'part_name.required' => 'กรุณากรอก PART Number',
            'model_name.required' => 'กรุณากรอก PART Number',
            'material.required' => 'กรุณากรอก PART Number',
            'type.required' => 'กรุณากรอก PART Number',
            't_value.required' => 'กรุณากรอก PART Number',
            'customer.required' => 'กรุณาระบุลูกค้า',
            'quantity.required' => 'กรุณาระบุจำนวน'
        ];
        return $messages;
    }
}
