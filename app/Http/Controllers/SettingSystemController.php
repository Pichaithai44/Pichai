<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\ArrayToXml\ArrayToXml;
use Vyuldashev\XmlToArray\XmlToArray;
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

        $systems_result = DB::table('systems')->first();
        if(!empty($systems_result->xml_info)) {

            $xml_info = XmlToArray::convert($systems_result->xml_info);
            $result['data'] = $xml_info['system_local'];
        }
        
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
    
            $xml = [
                'pawn_name' => $request->pawn_name,
                'info'   => [
                    'adr'            => $request->adr
                    ,'moo'           => $request->moo
                    ,'soi'           => $request->soi
                    ,'road'          => $request->road
                    ,'sub_district'  => $request->sub_district
                    ,'district'      => $request->district
                    ,'province'      => $request->province
                    ,'postal_code'   => $request->postal_code
                ],
                'contact'   => [
                    'tel'       => $request->tel
                ]
            ];

            $xml_result = ArrayToXml::convert($xml, [
                'rootElementName' => 'system_local',
                '_attributes' => [
                    'xmlns' => 'localhost://pawn.test',
                ],
            ], true, 'UTF-8');

            $params = [
                'id'             => 1
                ,'xml_info'      => $xml_result
                ,'created_at'    => date('Y-m-d h:i:s')
                ,'updated_at'    => date('Y-m-d h:i:s')
            ];
       
            DB::beginTransaction();

            if($systems_rs) {
            
                try {
        
                    $result = DB::table('systems')->where('id', $systems_rs->id)->update($params);
                    
                } catch(ValidationException $e) {
                  
                    DB::rollback();

                    return redirect('settingsystem')
                        ->withErrors($e->getErrors())
                        ->withInput();

                } catch (\Exception $e) {

                    DB::rollback();
                    throw $e;
                }
                
            } else {

                try {
        
                $result = DB::table('systems')->insert($params);
                    
                } catch(ValidationException $e) {
                  
                    DB::rollback();

                    return redirect('settingsystem')
                        ->withErrors($e->getErrors())
                        ->withInput();

                } catch (\Exception $e) {

                    DB::rollback();
                    throw $e;
                }
            }

            DB::commit();
       
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
        ];
        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'pawn_name.required'        => 'กรุณากรอกชื่อโรงรับจำนำ',
        ];
        return $messages;
    }
}
