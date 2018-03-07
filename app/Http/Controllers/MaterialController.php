<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class MaterialController extends Controller
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
        $data = DB::table('lkup_material')
            ->whereNULL('deleted_at')
            ->paginate(8);
        if(count($data->items())>0){
            foreach($data->items() as $d){
                $d->updated_at = $d->updated_at ? $d->updated_at : '-';
                $d->is_enable = $this->is_enable_name[$d->is_enable];
            }
        }
        return view('pages.material.index',[
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
                return redirect('material/add')
                ->withErrors($validator)
                ->withInput();
            }else{
                DB::table('lkup_material')->insert([
                    'name' => $request->name,
                    'is_enable' => $request->isEnable,
                    'created_by' => Auth::user()->getAttributes()['id'],
                    'created_at' => date('Y-m-d h:i:s')
                ]);
                return redirect()->route('pages.material.index');
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
        return view('pages.material.edit',[
            'item' => DB::table('lkup_material')
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
                return redirect('material/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
            }else{
                DB::table('lkup_material')->where('id',$id)
                ->update([
                    'name' => $request->name,
                    'is_enable' => $request->isEnable,
                    'updated_by' => Auth::user()->getAttributes()['id'],
                    'updated_at' => date('Y-m-d h:i:s')
                ]);
                return redirect()->route('pages.material.edit',[
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
            DB::table('lkup_material')->where('id',$id)
            ->update([
                'updated_by' => Auth::user()->getAttributes()['id'],
                'deleted_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->route('pages.material.index');
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
            'name.required' => 'กรุณากรอกชื่อ'
        ];
        return $messages;
    }
}
