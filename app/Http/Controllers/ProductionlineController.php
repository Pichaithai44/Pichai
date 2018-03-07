<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProductionlineController extends Controller
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
        $data = DB::table('lkup_production_line')
            ->whereNULL('deleted_at')
            ->paginate(8);
        
        if(count($data->items())>0){
            foreach($data->items() as $d){
                $d->updated_at = $d->updated_at ? $d->updated_at : '-';
                $d->is_enable = $this->is_enable_name[$d->is_enable];
            }
        }
        return view('pages.productionline.index',[
            'data' => $data
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
                return redirect('productionline/add')
                            ->withErrors($validator)
                            ->withInput();
            }else{
                DB::table('lkup_production_line')->insert([
                    'line_name' => $request->name,
                    'is_enable' => $request->isEnable,
                    'created_by' => Auth::user()->getAttributes()['id'],
                    'created_at' => date('Y-m-d h:i:s')
                ]);
                return redirect()->route('pages.productionline.index');
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
        return view('pages.productionline.edit',[
            'item' => DB::table('lkup_production_line')
                        ->where('id',$id)
                        ->first()
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
                return redirect('productionline/edit/'.$id)
                            ->withErrors($validator)
                            ->withInput();
            }else{
                DB::table('lkup_production_line')->where('id',$id)
                ->update([
                    'line_name' => $request->name,
                    'is_enable' => $request->isEnable,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'updated_by' => Auth::user()->getAttributes()['id']
                ]);
                return redirect()->route('pages.productionline.edit',[
                    'id' => $id
                ]);
            }
        } else{
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
            DB::table('lkup_production_line')->where('id',$id)
            ->update([
                'deleted_at' => date('Y-m-d h:i:s'),
                'updated_by' => Auth::user()->getAttributes()['id']
            ]);
            return redirect()->route('pages.productionline.index');
        } else {
            return redirect('home');
        }
    }
    
    public function rules()
    {
        //
        $rules = [
            'name' => 'required'
        ];
        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'name.required' => 'กรุณากรอกชื่อ',
        ];
        return $messages;
    }
}
