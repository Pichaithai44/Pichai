<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class CustomerController extends Controller
{
    protected $is_enable_name = array('Y'=>'เผยแพร่','N'=>'ไม่เผยแพร่');
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = DB::table('customer')
            ->whereNULL('deleted_at')
            ->paginate(8);

        if(!empty($request->has('search'))){
            $data = DB::table('customer')
            ->whereNULL('deleted_at')
            ->where('customer_name','like','%'.$request->search.'%')
            ->paginate(8);
        }

        if(!empty($request->has('date_start')) || !empty($request->has('date_end'))){
            $date_start = date_format(date_create($request->date_start),'Y-m-d H:i:s');
            $date_end = date_format(date_create($request->date_end),'Y-m-d H:i:s');
            $data = DB::table('customer')
            ->whereNULL('deleted_at')
            ->whereBetween('created_at',[$date_start,$date_end])
            ->paginate(8);
        }
        // if(!empty($request->has('search')) || !empty($request->has('date_start')) || !empty($request->has('date_end'))){
        //     // return redirect()->route('pages.customer.index')->withInput();
        //     return redirect()->route('pages.customer.index')->withInput()->with('data',$data);
        // }
        

        if(count($data->items())>0){
            foreach($data->items() as $d){
                $d->updated_at = $d->updated_at ? $d->updated_at : '-';
                $d->is_enable = $this->is_enable_name[$d->is_enable];
            }
        }
        return view('pages.customer.index',[
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
                return redirect('customer/add')
                ->withErrors($validator)
                ->withInput();
            }else{
                DB::table('customer')->insert([
                    'customer_name' => $request->name,
                    'is_enable' => $request->isEnable,
                    'created_at' => date('Y-m-d h:i:s'),
                    'created_by' => Auth::user()->getAttributes()['id']
                ]);
                return redirect()->route('pages.customer.index');
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
        $data = DB::table('customer')
            ->where('id',$id)
            ->first();
        return view('pages.customer.edit',[
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
                return redirect('customer/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
            }else{
                $result = DB::table('customer')->where('id',$id)
                ->update([
                    'customer_name' => $request->name,
                    'is_enable' => $request->isEnable,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'updated_by' => Auth::user()->getAttributes()['id']
                ]);
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
        //
        if(Auth::user()->getAttributes()['id']){
            DB::table('customer')->where('id',$id)
            ->update([
                'deleted_at' => date('Y-m-d h:i:s'),
                'deleted_by' => Auth::user()->getAttributes()['id']
            ]);
            return redirect()->route('pages.customer.index');
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
