<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class AuthController extends Controller
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
        if(Auth::user()->getAttributes()['role_id'] != 1){
            return redirect('home');
        }

        $data = DB::table('users')
            ->leftJoin('role','users.role_id','=','role.id')
            ->select('users.id',DB::raw("CONCAT(users.first_name,' ',users.last_name) as user_name"),'users.email','role.name as role_name','users.is_enable','users.created_at','users.updated_at')
            ->whereNULL('users.deleted_at')
            ->paginate(8);

        if(count($data->items())>0){
            foreach($data->items() as $d){
                $d->updated_at = $d->updated_at ? $d->updated_at : '-';
                $d->is_enable = $this->is_enable_name[$d->is_enable];
            }
        }
        return view('pages.auth.index',[
            'data' => $data
        ]);
    }

    public function add()
    {
        //
        if(Auth::user()->getAttributes()['role_id'] != 1){
            return redirect('home');
        }
       
        $dataRole = DB::table('role')
                ->whereNULL('deleted_at')
                ->where('is_enable','Y')
                ->get();
        $roleOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $roleOption[] = $i; 
        if(count($dataRole)>0){
            foreach($dataRole as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->name;
                $roleOption[] = $i; 
            }
        }

        $dataDepartment = DB::table('department')
                ->whereNULL('deleted_at')
                ->where('is_enable','Y')
                ->get();
        $departmentOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $departmentOption[] = $i; 
        if(count($dataDepartment)>0){
            foreach($dataDepartment as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->name;
                $departmentOption[] = $i; 
            }
        }

        $dataJobposition = DB::table('job_position')
                ->whereNULL('deleted_at')
                ->where('is_enable','Y')
                ->get();
        $jobpositionOption = array();
        $i['id'] = null;
        $i['name'] = '-- กรุณาเลือก --';
        $jobpositionOption[] = $i; 
        if(count($dataJobposition)>0){
            foreach($dataJobposition as $m){
                $i['id'] = $m->id;
                $i['name'] = $m->name;
                $jobpositionOption[] = $i; 
            }
        }
        
        return view('pages.auth.add',[
            'roleOption' => $roleOption,
            'departmentOption' => $departmentOption,
            'jobpositionOption' => $jobpositionOption
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
        if(Auth::user()->getAttributes()['role_id'] != 1){
            return redirect('home');
        }
        $validator = Validator::make($request->all(),$this->rules(),$this->messages());
        if($validator->fails()){
            return redirect('auth/add')
            ->withErrors($validator)
            ->withInput();
        }else{
            DB::table('users')->insert([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role,
                'department_id' => $request->department,
                'job_position_id' => $request->jobposition,
                'is_enable' => $request->isEnable,
                'created_at' => date('Y-m-d h:i:s')
            ]);
            return redirect()->route('pages.auth.index');
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
        if(Auth::user()->getAttributes()['role_id'] != 1){
            return redirect('home');
        }

        $data = DB::table('users')
            ->where('id',$id)
            ->select('id','first_name','last_name','email','role_id','department_id','job_position_id','is_enable')
            ->first();

        $dataRole = DB::table('role')
            ->whereNULL('deleted_at')
            ->where('is_enable','Y')
            ->get();
            $roleOption = array();
            $i['id'] = null;
            $i['name'] = '-- กรุณาเลือก --';
            $roleOption[] = $i; 
            if(count($dataRole)>0){
                foreach($dataRole as $m){
                    $i['id'] = $m->id;
                    $i['name'] = $m->name;
                    $roleOption[] = $i; 
                }
            }
            $dataDepartment = DB::table('department')
                    ->whereNULL('deleted_at')
                    ->where('is_enable','Y')
                    ->get();
            $departmentOption = array();
            $i['id'] = null;
            $i['name'] = '-- กรุณาเลือก --';
            $departmentOption[] = $i; 
            if(count($dataDepartment)>0){
                foreach($dataDepartment as $m){
                    $i['id'] = $m->id;
                    $i['name'] = $m->name;
                    $departmentOption[] = $i; 
                }
            }

            $dataJobposition = DB::table('job_position')
                    ->whereNULL('deleted_at')
                    ->where('is_enable','Y')
                    ->get();
            $jobpositionOption = array();
            $i['id'] = null;
            $i['name'] = '-- กรุณาเลือก --';
            $jobpositionOption[] = $i; 
            if(count($dataJobposition)>0){
                foreach($dataJobposition as $m){
                    $i['id'] = $m->id;
                    $i['name'] = $m->name;
                    $jobpositionOption[] = $i; 
                }
            }
            // echo '<pre>';print_r($data);'</pre>';exit;
        return view('pages.auth.edit',[
            'item' => $data,
            'roleOption' => $roleOption,
            'departmentOption' => $departmentOption,
            'jobpositionOption' => $jobpositionOption
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
        if(Auth::user()->getAttributes()['role_id'] != 1){
            return redirect('home');
        }

        $rules = [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'role' => 'required',
        ];
        if(Auth::user()->getAttributes()['id']){
            $validator = Validator::make($request->all(),$rules,$this->messages());
            if($validator->fails()){
                return redirect('auth/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
            }else{
                $result = DB::table('users')->where('id',$id)
                ->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'role_id' => $request->role,
                    'department_id' => $request->department,
                    'job_position_id' => $request->jobposition,
                    'is_enable' => $request->isEnable,
                    'updated_by' => Auth::user()->getAttributes()['id'],
                    'updated_at' => date('Y-m-d h:i:s')
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
        if(Auth::user()->getAttributes()['role_id'] != 1){
            return redirect('home');
        }
        if(Auth::user()->getAttributes()['id']){
            DB::table('users')->where('id',$id)
            ->update([
                'deleted_at' => date('Y-m-d h:i:s'),
                'deleted_by' => Auth::user()->getAttributes()['id']
            ]);
            return redirect()->route('pages.auth.index');
        } else {
            return redirect('home');
        }
    }

    public function getsignout() {

        Auth::logout();
        return redirect()->route('home');
        
    }

    public function rules()
    {
        //
        $rules = [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email',
            'role' => 'required',
            'department' => 'required',
            'jobposition' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ];
        return $rules;
    }

    public function messages()
    {
        //
        $messages = [
            'first_name.required' => 'กรุณากรอกชื่อ',
            'first_name.max' => 'นามสกุลความยาวไม่เกิน 20 ตัวอักขระ',
            'last_name.required' => 'กรุณากรอกนามสกุล',
            'last_name.max' => 'นามสกุลความยาวไม่เกิน 20 ตัวอักขระ',
            'email.required' => 'กรุณากรอกอิเมล',
            'email.email' => 'กรุณากรอกที่อยู่อิเมลให้ถูกต้อง',
            'role.required' => 'กรุณาเลือกสิทธิการใช้งาน',
            'department.required' => 'กรุณาเลือกแผนก',
            'jobposition.required' => 'กรุณาเลือกตำแหน่งงาน',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
            'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักขระ',
            'confirm_password.required' => 'กรุณากรอกยืนยันรหัสผ่าน',
            'confirm_password.min' => 'ยืนยันรหัสผ่านต้องมีอย่างน้อย 8 ตัวอักขระ',
            'confirm_password.same' => 'รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน',
        ];
        return $messages;
    }
}
