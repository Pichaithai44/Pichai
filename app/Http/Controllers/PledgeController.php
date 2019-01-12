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

class PledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = [];

        $products_result = DB::table('products')
        ->leftJoin('personals','products.personal_code','=','personals.personal_code')
        ->select(
            'personals.personal_code',
            DB::raw('CONCAT(personals.personal_title_name, personals.personal_first_name, " ", personals.personal_last_name) AS pledge'),
            'personals.personal_citizen_id',
            'products.*'
        )->paginate(10);
      
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

            $params = [];
            $pledge_code = $this->uniqidReal();
            
            $params = [
                'product_code'  => $pledge_code,
                'personal_code'=> Crypt::decryptString($request->personal_code),
                'product_num'  => $request->product_num,
                'date_payment' => $request->date_payment,
                'slip_no'      => $request->slip_no,
                'capital'      => $request->capital,
                'interest'     => $request->interest,
                'is_active'    => $request->is_active,
                'created_at'   => date('Y-m-d h:i:s'),
                'created_by'   => 'SYSTEM',
                'updated_by'   => 'SYSTEM',
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
        $result = [];

        return view('pages.pledge.update',[
            'result' => $result
        ]);
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

            try {
        
                $result = DB::table('products')->where('product_code', $id)->delete();
                
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
            'pledge'                => 'required',
            'product_num'           => 'required',
            'personal_citizen_id'   => 'required',
            'personal_code'         => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'pledge.required'               => 'กรุณากรอก ชื่อ-นามสกุล',
            'product_num.required'          => 'กรุณากรอก product_num',
            'personal_citizen_id.required'  => 'กรุณากรอก ชื่อ-นามสกุล ใหม่',
            'personal_code.required'        => 'ข้อมูลไม่ถูกต้อง กรุณากรอก ชื่อ-นามสกุล ใหม่',
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
                DB::raw('CONCAT(personal_title_name, personal_first_name, " ", personal_last_name) AS pledge'),
                'personal_citizen_id'
                )
            ->where('personal_title_name', 'LIKE', '%'.$term.'%')
            ->orWhere('personal_first_name', 'LIKE', '%'.$term.'%')
            ->orWhere('personal_last_name', 'LIKE', '%'.$term.'%')
            ->take(10)->get();
           
        foreach ($queries as $query)
        {
            $results[] = [
                'personal_code'         => Crypt::encryptString($query->personal_code),
                'value'                 => $query->pledge,
                'personal_citizen_id'   => $query->personal_citizen_id,
            ];
        }
      
        return Response::json($results);
    }
}
