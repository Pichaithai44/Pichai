<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /** Return view to upload file */
    public function uploadFile()
    {
        return view('uploadfile');
    }

     /** Example of File Upload */
     public function uploadFilePost(Request $request)
     {
        $result = [];
        $request->validate([
            'fileToUpload' => 'required|file|max:1024',
        ]);
        
        $basename = "pawn".time();
        $fileName = "{$basename}.".$request->file('fileToUpload')->getClientOriginalExtension();
        $path = $request->file('fileToUpload')->storeAs('logos', $fileName);
        
        Image::configure(array('driver' => 'gd'));
        $img    = Image::make(Storage::path($path));
        $width  = $img->width();
        $height = $img->height();

        // thumbnail
        $height_bg = 0;
        $width_bg = 0;
        $width_thumbnail  = $width;
        $height_thumbnail = $height;
        $MAX_WIDTH_thumbnail = 200;
        $MAX_HEIGHT_thumbnail = 200;
        $img->backup();

        if($width>$height) {

            if ($width > $MAX_WIDTH_thumbnail) {
                $height_thumbnail *= $MAX_WIDTH_thumbnail / $width;
                $width_thumbnail = $MAX_WIDTH_thumbnail;
            }

            $img->encode($request->file('fileToUpload')->getClientOriginalExtension(), 100)->resize(1024, 768)->save(Storage::path("logos/{$basename}-mater.".$request->file('fileToUpload')->getClientOriginalExtension()), 100)->reset();
            $img->encode($request->file('fileToUpload')->getClientOriginalExtension(), 100)->resize($width_thumbnail, $height_thumbnail)->resizeCanvas(null, $MAX_HEIGHT_thumbnail, 'center', false, '000000')->save(Storage::path("logos/{$basename}-thumbnail.".$request->file('fileToUpload')->getClientOriginalExtension()), 100)->reset();
        } else {

            if ($height > $MAX_HEIGHT_thumbnail) {
                $width_thumbnail *= $MAX_HEIGHT_thumbnail / $height;
                $height_thumbnail = $MAX_HEIGHT_thumbnail;
            }
      
            $img->encode($request->file('fileToUpload')->getClientOriginalExtension(), 100)->resize(768, 1024)->save(Storage::path("logos/{$basename}-mater.".$request->file('fileToUpload')->getClientOriginalExtension()), 100)->reset();
            $img->encode($request->file('fileToUpload')->getClientOriginalExtension(), 100)->resize($width_thumbnail, $height_thumbnail)->resizeCanvas($MAX_WIDTH_thumbnail, null, 'center', false, '000000')->save(Storage::path("logos/{$basename}-thumbnail.".$request->file('fileToUpload')->getClientOriginalExtension()), 100)->reset();
        }
        
        $pathinfo = pathinfo($path);

        $file_code = $this->uniqidReal();

        $params = [
            'file_code'     => $file_code,
            'originalName'  => $request->file('fileToUpload')->getClientOriginalName(),
            'mimeType'      => Storage::mimeType($path),
            'size'          => Storage::size($path),
            'extension'     => $request->file('fileToUpload')->getClientOriginalExtension(),
            'hashName'      => $basename,
            'dirname'       => $pathinfo['dirname'],
            'created_by'    => "SYSTEM",
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_by'    => "SYSTEM",
            'deleted_at'    => date('Y-m-d H:i:s', Storage::lastModified($path)),
        ];

        DB::beginTransaction();

        try {
    
            $result = DB::table('file')->insert($params);

            Storage::delete($path);

        } catch(ValidationException $e) {
            
            DB::rollback();

        } catch (\Exception $e) {

            DB::rollback();
            throw $e;
        }

        DB::commit();
        
        if($result) {

            $result = [];
            $result = [
                'result'    => true,
                'messages'  => "ดาวน์โหลดสำเร็จ",
                'path'      => asset("storage/logos/{$basename}-thumbnail.".$request->file('fileToUpload')->getClientOriginalExtension()),
                'file_code' => $file_code
            ];
        } else {
            
            $result = [
                'result'    => false,
                'messages'  => "ดาวน์โหลดไม่สำเร็จ",
                'path'      => null,
                'file_code' => null
            ];
        }
        return response()->json($result);
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
