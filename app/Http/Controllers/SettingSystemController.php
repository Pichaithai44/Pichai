<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class SettingSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = [];

        $result["data"] = DB::table('systems')->first();

        return view('pages.settingsystem.index',[
            'result' => $result
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
        
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if($validator->fails()){
            return redirect('settingsystem')
            ->withErrors($validator)
            ->withInput();
        } else {

            $systems_rs = DB::table('systems')->first();
            $params = [];
    
            $params = [
                'pawn_name'      => $request->pawn_name
                ,'address'       => $request->address
                ,'moo'           => $request->moo
                ,'soi'           => $request->soi
                ,'road'          => $request->road
                ,'sub_district'  => $request->sub_district
                ,'district'      => $request->district
                ,'province'      => $request->province
                ,'postal_code'   => $request->postal_code
                ,'tel'           => $request->tel
                ,'interest_rate' => $request->interest_rate
                ,'owe'           => $request->owe
                ,'created_at'    => date('Y-m-d h:i:s')
                ,'updated_at'    => date('Y-m-d h:i:s')
            ];
            
            $result = DB::table('systems')->where('id', $systems_rs->id)->update($params);
            // if($systems_rs) {
            //     $result = DB::table('systems')->update($params);
            // } else {
            //     $result = DB::table('systems')->insert($params);
            // }
            // DB::beginTransaction();
            // try {
    
           
            
            //     DB::commit();
            //     // all good
            // } catch (\Exception $e) {
            //     DB::rollback();
            //     // something went wrong
            // }
    
            if($result) {

                $message = 'บันทึกรายการสำเร็จ';

            } else {

                $message = 'บันทึกรายการไม่สำเร็จ';
            }

            return redirect()->back()->withStatus($message)->withResult($result);
        }
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

    public function rules()
    {
        //
        $rules = [
            'pawn_name'     => 'required',
            'interest_rate' => 'required|numeric',
            'owe'           => 'required|numeric'
        ];
        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'pawn_name.required'        => 'กรุณากรอกชื่อโรงรับจำนำ',
            'interest_rate.required'    => 'กรุณากรอกอัตตราดอกเบี้ย',
            'interest_rate.numeric'     => 'กรุณากรอกตัวเลข',
            'owe.required'              => 'กรุณากรอกค้างชำระ',
            'owe.numeric'               => 'กรุณากรอกตัวเลข'
        ];
        return $messages;
    }
}
