@extends('layouts.app')

@section('content')
<div style="width: 125px; padding-left: 2px; padding-top: 2px;margin-left:30px;">
    @if ($message = Session::get('success'))

        <div class="alert alert-success alert-block">

            <button type="button" class="close" data-dismiss="alert">×</button>

            <strong>{{ $message }}</strong>

        </div>

    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>uplode ไม่สำเร็จ</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
<div style="width: 125px; height: 130px; background: gray; padding-left: 2px; padding-top: 2px;margin-left:30px;">
    <span class="profile-picture">
        @if ($result = Session::get('result'))
            <img src="{{ $result["path"] }}" id="img_logo">
        @endif
    </span>
</div>
<div style="padding-left: 10px; padding-top: 5px;">
    <form action="/uploadfile" method="post" enctype="multipart/form-data">
        @csrf
        <div class="btn-group upload-file" role="group">
            <label for="fileToUpload" class="btn btn-warning btn-sm"><i class="fa fa-camera"></i> เลือกรูปสมาชิก
                <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload" style="display:none;">
            </label>

            @if ($result = Session::get('result'))
                <input type="hidden" name="path" value="{{ $result["path"] }}">
                <input type="hidden" name="filename" value="{{ $result["filename"] }}">
                <input type="hidden" name="basename" value="{{ $result["basename"] }}">
                <input type="hidden" name="extension" value="{{ $result["extension"] }}">
                <input type="hidden" name="size" value="{{ $result["size"] }}">
                <input type="hidden" name="lastModified" value="{{ $result["lastModified"] }}">
                <input type="hidden" name="dirname" value="{{ $result["dirname"] }}">
            @endif
            <label for="submitFile" class="btn btn-dark btn-sm"><i class="fas fa-upload"></i>
                <input type="submit"  id="submitFile" style="display:none;" >
            </label>
        </div>
    </form>
</div>
@endsection