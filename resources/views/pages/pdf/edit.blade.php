<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Production Line</title>
        @include('layouts.mater')
    </head>
    <body class="root hold-transition skin-blue sidebar-mini">
            <div class="wrapper">
                @include('layouts.header')
                @include('layouts.sidebar')
                    <div class="content-wrapper">
                        <section class="content-header">
                            <h1>
                                แก้ไขข้อมูลค่าเริ่มต้น ไลน์การผลิต
                                <small>Control panel</small>
                            </h1>
                        </section>
                        <section class="content">
                                <div class="container form-control">
                                        <form action="{{ route('pages.customer.update',['id'=> $item->id]) }}" id="my_form" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <div class="form-group row">
                                                <label class="col-4 col-form-label">ชื่อ</label>
                                                <div class="col-8">
                                                    <input class="form-control text-left" type="text" name="name" value="{{ $item->customer_name }}"/>
                                                </div>
                                            </div>
                            
                                            <div class="form-group row">
                                                <label class="col-4 col-form-label">สถานะ</label>
                                                <div class="col-8">
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label" for="enable_1">
                                                            <input class="form-check-input" type="radio" name="isEnable" id="enable_1" value="Y" {{ $item->is_enable == 'Y' ? 'checked' : null }}>
                                                                เผยแพร่
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label" for="enable_2">
                                                            <input class="form-check-input" type="radio" name="isEnable" id="enable_2" value="N" {{ $item->is_enable == 'N' ? 'checked' : null }}>
                                                                ไม่เผยแพร่
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                
                                        </form>
                                        <div class="row">
                                            <div class="offset-4 col-8">
                                                <button class="btn btn-danger btn-ymt" onclick="location='{{ route('pages.customer.delete',['id'=> $item->id]) }}'" id="delete">ลบ</button>
                                                <button type="submit" class="btn btn-primary btn-ymt" onclick="submit()" id="save">บันทึก</button>
                                                <button class="btn btn-ymt" onclick="location='{{ route('pages.customer.index') }}'">กลับ</button>
                                            </div>
                                        </div>
                                    </div>
                        </section>
                    </div>
                @include('layouts.footer')
            </div>
        </body>

    <script>
        function submit(){
            document.getElementById('my_form').submit();
        }
    </script>
</html>
