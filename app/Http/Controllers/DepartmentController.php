<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class DepartmentController extends Controller
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
        $data = DB::table('department')
            ->whereNULL('deleted_at')
            ->paginate(8);

        if(count($data->items())>0){
            foreach($data->items() as $d){
                $d->updated_at = $d->updated_at ? $d->updated_at : '-';
                $d->is_enable = $this->is_enable_name[$d->is_enable];
            }
        }
        return view('pages.department.index',[
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
                return redirect('department/add')
                ->withErrors($validator)
                ->withInput();
            }else{
                DB::table('department')->insert([
                    'name' => $request->name,
                    'is_enable' => $request->isEnable,
                    'created_at' => date('Y-m-d h:i:s'),
                    'created_by' => Auth::user()->getAttributes()['id']
                ]);
                return redirect()->route('pages.department.index');
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
        $data = DB::table('department')
            ->where('id',$id)
            ->first();
        return view('pages.department.edit',[
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
                return redirect('department/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
            }else{
                DB::table('department')->where('id',$id)
                ->update([
                    'name' => $request->name,
                    'is_enable' => $request->isEnable,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'updated_by' => Auth::user()->getAttributes()['id']
                ]);
                return redirect()->route('pages.department.edit',[
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
            DB::table('department')->where('id',$id)
            ->update([
                'deleted_at' => date('Y-m-d h:i:s'),
                'deleted_by' => Auth::user()->getAttributes()['id']
            ]);
            return redirect()->route('pages.department.index');
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
