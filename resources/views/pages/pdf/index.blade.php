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
                            <h3>
                                รายการข้อมูล รายชื่อลูกค้า
                            </h3>
                        </h1>
                    </section>
                            <section class="content">
                                    <div class="container">
                                        <div class="form-group row">
                                            <div class="col">
                                                <button class="btn btn-success btn-ymt-create" onclick="location='{{ route('pages.customer.create') }}'" id="create">เพิ่ม</button>
                                            </div>
                                        </div>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>รายชื่อลูกค้า</th>
                                                    <th>วันที่สร้าง</th>
                                                    <th>วันที่แก้ไข</th>
                                                    <th>สถานะ</th>
                                                </tr>
                                            <thead>
                                            <tbody>
                                                @foreach($item as $i)
                                                <tr>
                                                    <td><a href="{{ route('pages.customer.edit',['id'=> $i['id']]) }}">{{ $i['id'] }}</a></td>
                                                    <td><a href="{{ route('pages.customer.edit',['id'=> $i['id']]) }}">{{ $i['customer_name'] }}</a></td>
                                                    <td><a href="{{ route('pages.customer.edit',['id'=> $i['id']]) }}">{{ $i['created_at'] }}</a></td>
                                                    <td><a href="{{ route('pages.customer.edit',['id'=> $i['id']]) }}">{{ $i['updated_at'] }}</a></td>
                                                    <td><a href="{{ route('pages.customer.edit',['id'=> $i['id']]) }}">{{ $i['is_enable'] }}</a></td>
                                                </tr>
                                                @endforeach
                                            <tbody>
                                        </table>
                                    </div>
                    </section>
                </div>
            @include('layouts.footer')
        </div>
    </body>
</html>
