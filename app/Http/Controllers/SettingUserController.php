<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\ArrayToXml\ArrayToXml;
use Vyuldashev\XmlToArray\XmlToArray;
use Validator;
use Illuminate\Support\Facades\Crypt;

class SettingUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = [];

        $personals_result = DB::table('personals')->paginate(10);
        if(!empty($personals_result->items()) && count($personals_result->items()) > 0){
            foreach ($personals_result->items() as $key => $item) {
                $item->personal_code = Crypt::encryptString($item->personal_code);
            }
        }

        $result['data_arr'] = $personals_result;
     
        return view('pages.settinguser.index',[
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
        $result = [];

        return view('pages.settinguser.create',[
            'result' => $result
        ]);
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
            return redirect('settinguser/create')
            ->withErrors($validator)
            ->withInput();
        } else {

            $params = [];
            $personal_code = $this->uniqidReal();
            
            $xml = [
                'personal_code' => $personal_code,
                'info'   => [
                    'personal_title_name'  => $request->personal_title_name,
                    'personal_first_name'  => $request->personal_first_name,
                    'personal_last_name'   => $request->personal_last_name,
                    'personal_citizen_id'  => $request->personal_citizen_id,
                ],
                'is_active' => $request->is_active,
                'created_at' => $request->created_at,
                'created_by' => $request->created_by,
            ];

            $xml_result = ArrayToXml::convert($xml, [
                'rootElementName' => 'system_local',
                '_attributes' => [
                    'xmlns' => 'localhost://pawn.test',
                ],
            ], true, 'UTF-8');

            $params = [
                'personal_code'         => $personal_code
                ,'personal_title_name'  => $request->personal_title_name
                ,'personal_first_name'  => $request->personal_first_name
                ,'personal_last_name'   => $request->personal_last_name
                ,'personal_citizen_id'  => $request->personal_citizen_id
                ,'personal_xml'         => $xml_result
                ,'is_active'            => $request->is_active
                ,'created_at'           => date('Y-m-d h:i:s')
                ,'created_by'           => 'SYSTEM'
                ,'updated_by'           => 'SYSTEM'
            ];
      
            DB::beginTransaction();

            try {
        
                $result = DB::table('personals')->insert($params);
                
            } catch(ValidationException $e) {
                
                DB::rollback();

                return redirect('settinguser/create')
                    ->withErrors($e->getErrors())
                    ->withInput();

            } catch (\Exception $e) {

                DB::rollback();
                throw $e;
            }

            DB::commit();
       
            return redirect()->route('pages.settinguser.index');
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
        $result = [];
       
        if(Crypt::decryptString($id)) {
            $id = Crypt::decryptString($id);
            $personals_result = DB::table('personals')->where('personal_code', $id)->first();
            if(!empty($personals_result)) {
                $personals_result->personal_code = Crypt::encryptString($personals_result->personal_code);
                $result['data'] = $personals_result;
            }
            unset($personals_result);
        }

        return view('pages.settinguser.edit',[
            'result' => $result
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
        if(Crypt::decryptString($id)) {

            $validator = Validator::make($request->all(), $this->rules(), $this->messages());
            if($validator->fails()){
                return redirect('settinguser/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
            }else{

                $id = Crypt::decryptString($id);
                $xml = [
                    'personal_code' => $id,
                    'info'   => [
                        'personal_title_name'  => $request->personal_title_name,
                        'personal_first_name'  => $request->personal_first_name,
                        'personal_last_name'   => $request->personal_last_name,
                        'personal_citizen_id'  => $request->personal_citizen_id,
                    ],
                    'is_active' => $request->is_active,
                    'created_at' => $request->created_at,
                    'created_by' => $request->created_by,
                ];
    
                $xml_result = ArrayToXml::convert($xml, [
                    'rootElementName' => 'system_local',
                    '_attributes' => [
                        'xmlns' => 'localhost://pawn.test',
                    ],
                ], true, 'UTF-8');
    
                $params = [
                    'personal_title_name'  => $request->personal_title_name
                    ,'personal_first_name'  => $request->personal_first_name
                    ,'personal_last_name'   => $request->personal_last_name
                    ,'personal_citizen_id'  => $request->personal_citizen_id
                    ,'personal_xml'         => $xml_result
                    ,'is_active'            => $request->is_active
                    ,'updated_at'           => date('Y-m-d h:i:s')
                    ,'updated_by'           => 'SYSTEM'
                ];

                DB::beginTransaction();

                try {
            
                    $result = DB::table('personals')->where('personal_code', $id)->update($params);
                    
                } catch(ValidationException $e) {
                    
                    DB::rollback();
    
                    return redirect('settinguser/create')
                        ->withErrors($e->getErrors())
                        ->withInput();
    
                } catch (\Exception $e) {
    
                    DB::rollback();
                    throw $e;
                }
    
                DB::commit();

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
        $result = [];
        echo print_r($id);exit;
        if(Crypt::decryptString($id)) {

            $id = Crypt::decryptString($id);
            DB::beginTransaction();

            try {
        
                $result = DB::table('personals')->where('personal_code', $id)->delete();
                
            } catch(ValidationException $e) {
                
                DB::rollback();

                return redirect('settinguser')
                    ->withErrors($e->getErrors())
                    ->withInput();

            } catch (\Exception $e) {

                DB::rollback();
                throw $e;
            }

            DB::commit();

            if($result){
                $message = 'ลบรายการสำเร็จ';
            }else{
                $message = 'บันทึกรายการไม่สำเร็จ';
            }

            return redirect()->back()->withStatus($message)->withResult($result);
        }
    }

    public function rules()
    {
        //
        $rules = [
            'personal_title_name' => 'required|max:100',
            'personal_first_name' => 'required|max:100',
            'personal_last_name'  => 'required|max:150',
            'personal_citizen_id' => 'required|numeric'
        ];
        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'personal_title_name.required'   => 'กรุณากรอกคำนำหน้า',
            'personal_title_name.max'        => 'กรุณากรอกไม่เกิน 100 ตัวอักษร',
            'personal_first_name.required'   => 'กรุณากรอกชื่อ',
            'personal_first_name.max'        => 'กรุณากรอกไม่เกิน 100 ตัวอักษร',
            'personal_last_name.required'    => 'กรุณากรอกนามสกุล',
            'personal_last_name.max'         => 'กรุณากรอกไม่เกิน 150 ตัวอักษร',
            'personal_citizen_id.required'   => 'กรุณากรอกเลขบัตรประจำตัวประชาชน',
            'personal_citizen_id.numeric'    => 'กรุณากรอกตัวเลข',
        ];
        return $messages;
    }

    public function uniqidReal($lenght = 13) {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return strtoupper(substr(bin2hex($bytes), 0, $lenght));
    }
}
