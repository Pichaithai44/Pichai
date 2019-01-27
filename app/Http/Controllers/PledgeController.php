<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\ArrayToXml\ArrayToXml;
use Vyuldashev\XmlToArray\XmlToArray;
use Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $payment_type_decode = ['interest_payment' => 'ชำระ : ดอกเบี้ย', 'pay_all_balances' => 'ชำระ : ทั้งหมด'];

    public function index()
    {
        $result = [];

        $products_result = DB::table('products')
        ->leftJoin('personals','products.personal_code','=','personals.personal_code')
        ->select(
            'personals.personal_code',
            DB::raw('CONCAT(personals.personal_title_name, personals.personal_first_name, " ", personals.personal_last_name) AS full_name'),
            'personals.personal_citizen_id',
            'products.*'
        )
        ->where("products.is_active", "1")->paginate(10);
      
        if(!empty($products_result->items()) && count($products_result->items()) > 0){
            foreach ($products_result->items() as $key => $item) {
                $item->product_code = Crypt::encryptString($item->product_code);
            }
        }

        $result['data_arr'] = $products_result;

        return view('pages.pledge.index',[
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

        return view('pages.pledge.create',[
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
            return redirect('pledge/create')
            ->withErrors($validator)
            ->withInput();
        } else {

            $params          = [];
            $pledge_code     = $this->uniqidReal();
            $product_slip_no = DB::table('products')->whereYear('created_at', date("Y"))->whereMonth('created_at', date("m"))->count();
            $product_slip_no = $product_slip_no + 1;

            $xml = [
                'pledge_code' => $pledge_code,
                'personal_info'   => [
                    'personal_code'        => Crypt::decryptString($request->personal_code),
                    'personal_title_name'  => $request->personal_title_name,
                    'personal_first_name'  => $request->personal_first_name,
                    'personal_last_name'   => $request->personal_last_name,
                    'personal_citizen_id'  => $request->personal_citizen_id,
                ],
                'products' => [
                    'pay_ref'           => date("Ym"),
                    'product_slip_no'   => self::index_news_id($product_slip_no, 6),
                    'product_file_code' => $request->file_code
                ],
                'periods' => [
                    'period_0' => [
                        'period'            => 0,
                        'product_start_date'=> date('Y-m-d', strtotime($request->product_start_date)),
                        'billing_day'       => intval(date('d', strtotime($request->product_start_date))),
                        'billing_date'      => date('Y-m-d', strtotime($request->product_start_date)),
                        'due_date'          => date('Y-m-d', strtotime($request->product_end_date)),
                        'capital'           => $request->product_capital,
                        'payment'           => 0,
                        'remaining_balance' => $request->product_capital,
                        'interest'          => 0
                    ]
                ]
            ];
            
            $xml_result = ArrayToXml::convert($xml, [
                'rootElementName' => 'system_local',
                '_attributes' => [
                    'xmlns' => 'localhost://pawn.test',
                ],
            ], true, 'UTF-8');

            $params = [
                'product_code'      => $pledge_code,
                'personal_code'     => Crypt::decryptString($request->personal_code),
                'product_name'      => !empty($request->product_name) ? $request->product_name : "",
                'product_detail'    => !empty($request->product_detail) ? $request->product_detail : "",
                'product_capital'   => !empty($request->product_capital) ? $request->product_capital : 0,
                'product_interest'  => !empty($request->product_interest) ? $request->product_interest : 0,
                'product_start_date'=> date('Y-m-d h:i:s', strtotime($request->product_start_date)),
                'product_end_date'  => date('Y-m-d h:i:s', strtotime($request->product_end_date)),
                'product_xml'       => $xml_result,
                'is_active'         => "1",
                'created_at'        => date('Y-m-d h:i:s'),
                'created_by'        => 'SYSTEM',
                'updated_by'        => 'SYSTEM',
            ];

            DB::beginTransaction();

            try {
        
                $result = DB::table('products')->insert($params);
                
            } catch(ValidationException $e) {
                
                DB::rollback();

                return redirect('pledge/create')
                    ->withErrors($e->getErrors())
                    ->withInput();

            } catch (\Exception $e) {

                DB::rollback();
                throw $e;
            }

            DB::commit();
       
            return redirect()->route('pages.pledge.index');
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

            $untitled_result = DB::table('untitled')
            ->where('product_code', $id)->paginate(10);

            if($untitled_result->items() && count($untitled_result->items()) > 0) {
                foreach ($untitled_result->items() as $key => $value) {
                    $untitled_result->items()[$key]->payment_type = $this->payment_type_decode[$value->payment_type];
                }
            }
            $result['data_arr'] = $untitled_result;
            
            $products_result = DB::table('products')
            ->leftJoin('personals','personals.personal_code','=','products.personal_code')
            ->select(
                'products.*',
                'personals.personal_title_name',
                'personals.personal_first_name',
                'personals.personal_last_name',
                'personals.personal_citizen_id'
            )->where('product_code', $id)
            ->first();
            
            if(!empty($products_result)) {
                if(!empty($products_result->product_xml)) {

                    $file_code          = "";
                    $path               = "";
                    $product_slip_no    = "";
                    $interest           = 0;

                    $xml_info = XmlToArray::convert($products_result->product_xml);
                    if(!empty($xml_info['system_local']['products']['product_file_code'])){
                        $file_code = $xml_info['system_local']['products']['product_file_code'];

                        $file_result = DB::table('file')->where('file_code', $file_code)->first();
                        if($basename = $file_result->hashName) {
                            if (file_exists(Storage::path("logos/{$basename}-thumbnail.{$file_result->extension}"))) {
                                $path = asset("storage/logos/{$basename}-thumbnail.{$file_result->extension}");
                            } else {
                                $path = '';
                            }
                        } else {
                            $path = '';
                        }
                    } else {
                        $path = '';
                    }

                    if(!empty($xml_info['system_local']['products']['product_slip_no'])) {
                        $product_slip_no = $xml_info['system_local']['products']['product_slip_no'];
                    }

                    if(!empty($xml_info['system_local']['periods'])) {
                        if(count($xml_info['system_local']['periods']) > 0){
                            $period = $xml_info['system_local']['periods'];
                            $periods = $period["period_".(count($period) - 1)];
    
                            $is_period = $periods;
                            $billing_date_before = date('Y-m-d', strtotime($is_period['billing_date']));

                            $y = date('Y', strtotime($billing_date_before));
                            $m = intval(date('m', strtotime($billing_date_before))) < 10 ? '0'.strval(intval(date('m', strtotime($billing_date_before))) + 1) : date('m', strtotime($billing_date_before));
                            
                            $m_r = intval(date('m', strtotime($billing_date_before))) < 10 ? '0'.strval(intval(date('m', strtotime($billing_date_before)))) : date('m', strtotime($billing_date_before));
                            $m_only =  date('t', strtotime("{$y}-{$m_r}-01"));

                            $check_mouth_only_days = intval(date('t', strtotime("{$y}-{$m}-01")));
                            $check_only_days = intval(date('d', strtotime($billing_date_before)));

                            if($check_mouth_only_days > $check_only_days){
                                $d = intval(date('d', strtotime($billing_date_before))) < 10 ? '0'.strval(intval($check_only_days)) : strval($check_only_days);
                            } else {
                                $d = intval(date('d', strtotime($billing_date_before))) < 10 ? '0'.strval(intval($check_mouth_only_days)) : strval($check_mouth_only_days);
                            }
                            
                            $billing_day =  (intval($m_only)  - $is_period['billing_day']) + $is_period['billing_day'];
                            $interest = ($is_period['remaining_balance'] * ($products_result->product_interest / 100) * $billing_day) / 365;
                            $due_date = date('Y-m-d', strtotime($is_period['due_date']));
                        }
                    }
                }

                $result['data'] = (object)[
                    'product_code'                  => Crypt::encryptString($products_result->product_code),
                    'personal_code'                 => Crypt::encryptString($products_result->personal_code),
                    'product_name'                  => $products_result->product_name,
                    'product_detail'                => $products_result->product_detail,
                    'product_capital'               => $products_result->product_capital,
                    'product_interest'              => $products_result->product_interest,
                    'interest_payment'              => number_format($interest, 2, '.', ''),
                    'pay_all_balances'              => intval($is_period['remaining_balance']) < 1 ?  number_format(0, 2, '.', '') : number_format($products_result->product_capital + $interest, 2, '.', ''),
                    'product_start_date'            => date('Y-m-d', strtotime($products_result->product_start_date)),
                    'product_end_date'              => date('Y-m-d', strtotime($due_date)),
                    'personal_title_name'           => $products_result->personal_title_name,
                    'personal_first_name'           => $products_result->personal_first_name,
                    'personal_last_name'            => $products_result->personal_last_name,
                    'personal_citizen_id'           => $products_result->personal_citizen_id,
                    'file_code'                     => $file_code,
                    'path'                          => $path,
                    'product_slip_no'               => $product_slip_no,
                ];
            }
            unset($products_result);
            // echo "<pre>";print_r($result);"</pre>";exit;
        }

        return view('pages.pledge.edit',[
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
                return redirect('pledge/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
            }else{

                $id = Crypt::decryptString($id);
                $products_result = DB::table('products')->where('product_code', $id)->first();
                if(!empty($products_result->product_xml)) {

                    $file_code          = "";
                    $path               = "";
                    $product_slip_no    = "";
                    $interest           = 0;
                    $tm_periods         = [];

                    $xml_info = XmlToArray::convert($products_result->product_xml);

                    if(!empty($xml_info['system_local']['periods'])) {
                        if(count($xml_info['system_local']['periods']) > 0){

                            $period = $xml_info['system_local']['periods'];
                            $periods = $period["period_".(count($period) - 1)];
    
                            $is_period = $periods;
                            
                            $tm_periods = $period;
                            $billing_date_before = date('Y-m-d', strtotime($is_period['billing_date']));
                            $y = date('Y', strtotime($billing_date_before));
                            $m = intval(date('m', strtotime($billing_date_before))) < 10 ? '0'.strval(intval(date('m', strtotime($billing_date_before))) + 1) : date('m', strtotime($billing_date_before));

                            $m_r = intval(date('m', strtotime($billing_date_before))) < 10 ? '0'.strval(intval(date('m', strtotime($billing_date_before)))) : date('m', strtotime($billing_date_before));
                            $m_only =  date('t', strtotime("{$y}-{$m_r}-01"));

                            $check_mouth_only_days = intval(date('t', strtotime("{$y}-{$m}-01")));
                            $check_only_days = intval(date('d', strtotime($is_period['product_start_date'])));

                            if($check_mouth_only_days > $check_only_days){
                                $d = intval(date('d', strtotime($billing_date_before))) < 10 ? '0'.strval(intval($check_only_days)) : strval($check_only_days);
                            } else {
                                $d = intval(date('d', strtotime($billing_date_before))) < 10 ? '0'.strval(intval($check_mouth_only_days)) : strval($check_mouth_only_days);
                            }

                            $billing_day =  (intval($m_only)  - $is_period['billing_day']) + $is_period['billing_day'];
                            $interest = ($is_period['remaining_balance'] * ($products_result->product_interest / 100) * $billing_day) / 365;
                            $due_date = date('Y-m-d', strtotime("+{$billing_day} day", strtotime($is_period['due_date'])));

                            $tm_periods["period_".(count($period))] = [
                                'period'            => $is_period['period'] + 1,
                                'product_start_date'=> $is_period['product_start_date'],
                                'billing_day'       => $is_period['billing_day'],
                                'billing_date'      => "{$y}-{$m}-{$d}",
                                'due_date'          => $due_date,
                                'capital'           => $is_period['remaining_balance'],
                                'payment'           => $request->debt_payment,
                                'remaining_balance' => number_format($periods['remaining_balance'] + $interest, 2, '.', '') - $request->debt_payment,
                                'interest'          => number_format($interest, 2, '.', '')
                            ];
                        }
                    }
                }

                $xml = [
                    'pledge_code' => $id,
                    'personal_info'   => [
                        'personal_code'        => Crypt::decryptString($request->personal_code),
                        'personal_title_name'  => $request->personal_title_name,
                        'personal_first_name'  => $request->personal_first_name,
                        'personal_last_name'   => $request->personal_last_name,
                        'personal_citizen_id'  => $request->personal_citizen_id,
                    ],
                    'products' => [
                        'pay_ref'           => date("Ym"),
                        'product_slip_no'   => self::index_news_id($product_slip_no, 6),
                        'product_file_code' => $request->file_code
                    ]
                ];
    
                $xml['periods'] = $tm_periods;
                $xml_result = ArrayToXml::convert($xml, [
                    'rootElementName' => 'system_local',
                    '_attributes' => [
                        'xmlns' => 'localhost://pawn.test',
                    ],
                ], true, 'UTF-8');
          
                $params_untitled = [
                    'product_code'      => $id,
                    'personal_code'     => Crypt::decryptString($request->personal_code),
                    'payment_code'      => $this->uniqidReal(),
                    'pay_ref'           => date('Ymt'),
                    'payment_type'      => $request->payment_type,
                    'debt_payment'      => $request->debt_payment,
                    'due_date'          => $request->due_date,
                    'date_payment'      => $request->date_payment,
                    'is_active'         => "1",
                    'created_by'        => 'SYSTEM',
                    'updated_by'        => 'SYSTEM',
                    'created_at'        => date('Y-m-d h:i:s'),
                    'updated_at'        => date('Y-m-d h:i:s')
                ];

                $params = [
                    'product_code'      => $id,
                    'personal_code'     => Crypt::decryptString($request->personal_code),
                    'product_name'      => $request->product_name,
                    'product_detail'    => $request->product_detail,
                    'product_capital'   => $request->product_capital,
                    'product_interest'  => $request->product_interest,
                    'product_start_date'=> date('Y-m-d h:i:s', strtotime($request->product_start_date)),
                    'product_end_date'  => date('Y-m-d h:i:s', strtotime($request->due_date)),
                    'product_xml'       => $xml_result,
                    'is_active'         => "1",
                    'updated_at'        => date('Y-m-d h:i:s'),
                    'updated_by'        => 'SYSTEM'
                ];
       
                DB::beginTransaction();

                try {
            
                    if($result = DB::table('products')->where('product_code', $id)->update($params)){
                        if(!DB::table('untitled')->insert($params_untitled)) {
                            $result = false;
                        } 
                    } else {
                        $result = false;
                    }
                    
                } catch(ValidationException $e) {
                    
                    DB::rollback();
    
                    return redirect('pledge/edit/'.$id)
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
        
        if(Crypt::decryptString($id)) {

            $id = Crypt::decryptString($id);
            DB::beginTransaction();
            $params = [
                "is_active"     => "0",
                "updated_by"    => "SYSTEM",
                "updated_at"    => date('Y-m-d h:i:s')
            ];
            try {
        
                $result = DB::table('products')->where('product_code', $id)->update($params);
                
            } catch(ValidationException $e) {
                
                DB::rollback();

                return redirect('pledge')
                    ->withErrors($e->getErrors())
                    ->withInput();

            } catch (\Exception $e) {

                DB::rollback();
                throw $e;
            }

            DB::commit();

            if($result){
                $message = 'นำของออกจากระบบสำเร็จ';
            }else{
                $message = 'นำของออกจากระบบไม่สำเร็จ';
            }

            return redirect()->back()->withStatus($message)->withResult($result);
        }
    }

    public function rules()
    {
        //
        $rules = [
            'product_name'          => 'required',
            'personal_citizen_id'   => 'required',
            'personal_code'         => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'product_name.required'         => 'กรุณากรอกชื่อสินค้า',
            'personal_citizen_id.required'  => 'กรุณากรอกเลขบัตรประชาชน',
            'personal_code.required'        => 'กรุณากรอกเลขบัตรประชาชน ใหม่',
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

    public function autocomplete(){
      
        $term = Input::get('term');
        $results = array();
        
        $queries = DB::table('personals')
            ->select(
                'personal_code',
                'personal_title_name',
                'personal_first_name',
                'personal_last_name',
                DB::raw('CONCAT(personal_title_name, personal_first_name, " ", personal_last_name) AS pledge'),
                'personal_citizen_id'
                )
            ->where('personal_citizen_id', 'LIKE', '%'.$term.'%')->take(10)->get();
           
        foreach ($queries as $query)
        {
            $results[] = [
                'personal_code'         => Crypt::encryptString($query->personal_code),
                'value'                 => $query->personal_citizen_id,
                'personal_title_name'   => $query->personal_title_name,
                'personal_first_name'   => $query->personal_first_name,
                'personal_last_name'    => $query->personal_last_name,
            ];
        }
      
        return Response::json($results);
    }

    public function index_news_id($news_id, $digit) {
		$str_zero = "";

		if($news_id) {
			if($digit > 0) {
				if(strlen(strval($news_id)) > 0){
					$d = $digit - strlen(strval($news_id));
					for ($i=0; $i < $d; $i++) { 
						$str_zero .= "0";
					}
					$str_zero .= strval($news_id);
				}
			}

		}
		return $str_zero;

	}
}
