<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $fileName = "fileName".time().'.'.request()->fileToUpload->getClientOriginalExtension();

        $path = $request->file('fileToUpload')->storeAs('logos', $fileName);
        $pathinfo = pathinfo($path);
       
        $result = [
           'path'           => asset('storage/'.$path),
           'filename'       => $pathinfo['filename'],
           'basename'       => $pathinfo['basename'],
           'extension'      => $pathinfo['extension'],
           'size'           => Storage::size($path),
           'lastModified'   => Storage::lastModified($path),
           'dirname'        => $pathinfo['dirname']
        ];

        return back()->withSuccess('uplode สำเร็จ')->withResult($result);

    }
}
