<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\Auth;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;

class LottagController extends Controller
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
        $data = DB::table('lkup_lot_tag')
                ->leftJoin('lkup_model','lkup_lot_tag.model_id','=','lkup_model.id')
                ->leftJoin('qbar_code','lkup_lot_tag.barcode_id','=','qbar_code.id')
                ->select('lkup_lot_tag.*','qbar_code.filebase64 as barcode_id','lkup_model.name as model_name')
                ->whereNULL('lkup_lot_tag.deleted_at')
                ->paginate(8);
                
                if(count($data->items())>0){
                    foreach($data->items() as $d){
                        $d->updated_at = $d->updated_at ? $d->updated_at : '-';
                        $d->is_enable = $this->is_enable_name[$d->is_enable];
                    }
                }

        return view('pages.lottag.index',[
            'data' => $data
        ]);
    }

    public function add()
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

        $dataMaterial = DB::table('lkup_material')
                ->whereNULL('deleted_at')
                ->where('is_enable','Y')
                ->get();
        $materialOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $materialOption[] = $i; 
        if(count($dataMaterial)>0){
            foreach($dataMaterial as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->name;
                $materialOption[] = $i; 
            }
        }

        $dataType = DB::table('lkup_type')
                ->whereNULL('deleted_at')
                ->where('is_enable','Y')
                ->get();
        $typeOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $typeOption[] = $i; 
        if(count($dataType)>0){
            foreach($dataType as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->name;
                $typeOption[] = $i; 
            }
        }
        
        return view('pages.lottag.add',[
            'modelOption' => $modelOption,
            'materialOption' => $materialOption,
            'typeOption' => $typeOption
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
                return redirect('lottag/add')
                ->withErrors($validator)
                ->withInput();
            }else{
                $d = new DNS1D();
                $d->setStorPath(__DIR__."/cache/");
                $bar_code = 'data:image/png;base64,'.$d->getBarcodePNG(str_replace('-','',$request->part_number), "C128");
                $id_barcode = DB::table('qbar_code')->insertGetId([
                    'filebase64' => $bar_code,
                    'created_by' => Auth::user()->getAttributes()['id'],
                    'created_at' => date('Y-m-d h:i:s')
                    ]);
                    $id_lot = DB::table('lkup_lot_tag')->insertGetId([
                        'part_no' => $request->part_number,
                        'part_name' => $request->part_name,
                        'model_id' => $request->model,
                        'type_id' => $request->type,
                        'material_id' => $request->material,
                        'material_t' => $request->t_value,
                        'material_rod' => $request->rod_value,
                        'refer' => $request->refer,
                        'rev' => $request->rev,
                        'rev_date' => $request->rev_date,
                        'barcode_id' => $id_barcode,
                        'is_enable' => $request->isEnable,
                        'created_by' => Auth::user()->getAttributes()['id'],
                        'created_at' => date('Y-m-d h:i:s')
                    ]);
                        
                    for( $i = 1; $i <= 15; $i++ ){
                        if($request->hasFile('img_'.$i)){
                            $id_img = DB::table('file')->insertGetId([
                                'originalName' => $request->file('img_'.$i)->getClientOriginalName(),
                                'mimeType' => $request->file('img_'.$i)->getClientMimeType(),
                                'size' => $request->file('img_'.$i)->getClientSize(),
                                'filebase64' => 'data:'.$request->file('img_'.$i)->getClientMimeType().';base64,'.base64_encode(file_get_contents($request->file('img_'.$i))),
                                'created_by' => Auth::user()->getAttributes()['id'],
                                'created_at' => date('Y-m-d h:i:s')
                            ]);
                          
                            $process = DB::table('lkup_process')
                                ->select('id')
                                ->where('name', $request->{'process_'.$i})
                                ->get();
                                foreach($process as $item){
                                    $process_id = $item->id;
                                }
                               
                            $lot_tag_process_file_id = DB::table('lot_tag_process_file')->insertGetId([
                                'file_id' => $id_img,
                                'lot_tag_id' => $id_lot,
                                'process_id' => $process_id,
                                'created_by' => Auth::user()->getAttributes()['id'],
                                'created_at' => date('Y-m-d h:i:s')
                            ]);
                        }
                    }
                return redirect()->route('pages.lottag.index');
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

        $dataMaterial = DB::table('lkup_material')
                ->whereNULL('deleted_at')
                ->where('is_enable','Y')
                ->get();
        $materialOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $materialOption[] = $i; 
        if(count($dataMaterial)>0){
            foreach($dataMaterial as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->name;
                $materialOption[] = $i; 
            }
        }

        $dataType = DB::table('lkup_type')
                ->whereNULL('deleted_at')
                ->where('is_enable','Y')
                ->get();
        $typeOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $typeOption[] = $i; 
        if(count($dataType)>0){
            foreach($dataType as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->name;
                $typeOption[] = $i; 
            }
        }
        $item = DB::table('lkup_lot_tag')
            // ->leftJoin('file','lkup_lot_tag','=','file.id')
            // ->select('lkup_lot_tag.*','file.id as file_id','file.originalName','file.filebase64')
            ->where('id',$id)
            ->first();
        $item_file = DB::table('lot_tag_process_file')
            ->leftJoin('lkup_process','lot_tag_process_file.process_id','=','lkup_process.id')
            ->select(
                'lot_tag_process_file.id',
                'lot_tag_process_file.process_id',
                'lot_tag_process_file.file_id',
                'lkup_process.name as process_name'
                )
            ->where('lot_tag_process_file.lot_tag_id',$id)
            ->get();
            
            $files = array();
            if(count($item_file)>0){
                foreach($item_file as $file){
                    $item_img = DB::table('file')
                    ->select('id','mimeType','originalName as name','hashName as url')
                    ->where('id',$file->file_id)
                    ->first();
                    if($item_img){
                        $item_img->url = url('/images/'.($item_img->url ? $item_img->url.'.'.MimeType::search($item_img->mimeType) : $item_img->name));
                    }
                    $file->img = $item_img;
                    $files[] = $file; 
                }
            }
            // echo '<pre>';print_r($files);'</pre>';exit;
            $item->file_process = $files;
            $item->file_total = count($files);
            // echo '<pre>';print_r($item);'</pre>';exit;
        return view('pages.lottag.edit',[
            'item' => $item,
            'modelOption' => $modelOption,
            'materialOption' => $materialOption,
            'typeOption' => $typeOption
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
                return redirect('lottag/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
            }else{
                $process = array();
                $img_id = array();
                $img_change_id = array();
                for( $i = 1; $i <= 15; $i++ ){
                    if($request->has('process_'.$i)){
                        $process[] = $request->{'process_'.$i};
                    }
                    if($request->has('id_img_'.$i) && !$request->has('img_'.$i)){
                        $img_id[] = $request->{'id_img_'.$i};
                    }
                }
                $item_not_img = DB::table('lot_tag_process_file')
                ->leftJoin('file','lot_tag_process_file.file_id','=','file.id')
                ->select('file.id')
                ->where('lot_tag_process_file.lot_tag_id',$id)
                ->whereNotIn('file.id',$img_id)
                ->get();

                $delete_img_id = array();
                if(count($item_not_img)>0){
                    foreach($item_not_img as $not_img){
                        $delete_img_id[] = $not_img->id;
                    }
                    if(count($delete_img_id)>0){
                        $delete_table_file_result = DB::table('file')->whereIn('id',$delete_img_id)->delete();
                        $delete_table_lot_tag_process_file_result = DB::table('lot_tag_process_file')->whereIn('file_id',$delete_img_id)->delete();
                    }
                }

                $check = DB::table('lkup_lot_tag')
                                ->where('id',$id)
                                ->first();
        
                if($check->barcode_id){
                    DB::table('qbar_code')->where('id',$check->barcode_id)->delete();
                }
                $d = new DNS1D();
                $d->setStorPath(__DIR__."/cache/");
                $bar_code = 'data:image/png;base64,'.$d->getBarcodePNG(str_replace('-','',$request->part_number), "C128");
                $id_barcode = DB::table('qbar_code')->insertGetId([
                    'filebase64' => $bar_code,
                    'created_by' => Auth::user()->getAttributes()['id'],
                    'created_at' => date('Y-m-d h:i:s')
                ]);
                DB::table('lkup_lot_tag')->where('id',$id)
                ->update([
                    'part_no' => $request->part_number,
                    'part_name' => $request->part_name,
                    'model_id' => $request->model,
                    'type_id' => $request->type,
                    'material_id' => $request->material,
                    'material_t' => $request->t_value,
                    'material_rod' => $request->rod_value,
                    'refer' => $request->refer,
                    'rev' => $request->rev,
                    'rev_date' => $request->rev_date,
                    'barcode_id' => $id_barcode,
                    'is_enable' => $request->isEnable,
                    'updated_by' => Auth::user()->getAttributes()['id'],
                    'updated_at' => date('Y-m-d h:i:s')
                ]);
                $public_path_img = public_path().'/images/';
                $tm_result = array();
                for( $i = 1; $i <= 15; $i++ ){
                    if($request->hasFile('img_'.$i)){
                        $fileName = md5($request->file('img_'.$i)->getClientOriginalName().time());
                        Image::configure(array('driver' => 'gd'));
                        $img = Image::make($request->file('img_'.$i)->getPathName());
                        $img->backup();
                        $img->encode($request->file('img_'.$i)->getClientMimeType(),100)->save($public_path_img.$fileName.'.'.MimeType::search($request->file('img_'.$i)->getClientMimeType()),75)->reset();
                        $id_img = DB::table('file')->insertGetId([
                            'originalName' => $request->file('img_'.$i)->getClientOriginalName(),
                            'mimeType' => $request->file('img_'.$i)->getClientMimeType(),
                            'size' => $request->file('img_'.$i)->getClientSize(),
                            'hashName' => $fileName,
                            'created_by' => Auth::user()->getAttributes()['id'],
                            'created_at' => date('Y-m-d h:i:s')
                        ]);
                        
                        $process = DB::table('lkup_process')
                            ->select('id')
                            ->where('name', $request->{'process_'.$i})
                            ->get();
                            foreach($process as $item){
                                $process_id = $item->id;
                            }
                           
                        $lot_tag_process_file_id = DB::table('lot_tag_process_file')->insertGetId([
                            'file_id' => $id_img,
                            'lot_tag_id' => $id,
                            'process_id' => $process_id,
                            'created_by' => Auth::user()->getAttributes()['id'],
                            'created_at' => date('Y-m-d h:i:s')
                        ]);
                        $tm_result[] = $lot_tag_process_file_id;
                    }
                }
                // echo '<pre>';print_r($tm_result);'</pre>';exit;
                if(count($tm_result)){
                    $result = true;
                    $message = 'บันทึกรายการสำเร็จ';
                }else{
                    $result = false;
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
            DB::table('lkup_lot_tag')->where('id',$id)
            ->update([
                'updated_by' => Auth::user()->getAttributes()['id'],
                'deleted_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->route('pages.lottag.index');
        } else {
            return redirect('home');
        }
    }

    public function rules()
    {
        //
        $rules = [
            'model' => 'required',
            'part_number' => 'required',
            'part_name' => 'required',
            'material' => 'required',
            'type' => 'required',
            't_value' => 'required',
            'refer' => 'required',
            'rev' => 'required'
        ];
        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'model.required' => 'กรุณาเลือก Model',
            'part_number.required' => 'กรุณากรอก PART Number',
            'part_name.required' => 'กรุณากรอก PART Number',
            'material.required' => 'กรุณาเลือก Material',
            'type.required' => 'กรุณาเลือก Type',
            't_value.required' => 'กรุณากรอก ค่า T.',
            'refer.required' => 'กรุณาระบุเอกสารอ้างอิง',
            'rev.required' => 'กรุณาระบุ REV.'
        ];
        return $messages;
    }

    public function deleteimg(Request $request)
    {
        //
        $result = new \stdClass();
        $result->message = '';
        $result->result = false;
        $public_path = public_path().'/images';
        $result_step1 = DB::table('lot_tag_process_file')
                        ->where('id', $request['id'])->first();
        $result_step2 = DB::table('file')
                        ->where('id', $result_step1->file_id)->first();
        $result_step3 = DB::table('lot_tag_process_file')
                        ->where('id', $request['id'])->delete();
        
        if($result_step2){
            $result_step4 = DB::table('file')
                            ->where('id', $result_step2->id)->delete();
            $url_remove = $public_path.'/'.($result_step2->hashName ? $result_step2->hashName.'.'.MimeType::search($result_step2->mimeType) : $result_step2->originalName);
            $result->remove = unlink($url_remove);

        }

        if($result_step3){
            $result->message = 'ลบสำเร็จ';
            $result->result = true;
        } else {
            $result->message = 'ลบไม่สำเร็จ';
            $result->result = false; 
        }

        return response()->json($result);
    }
}
