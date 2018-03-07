<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Self Check Production</title>
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
                                    ประวัติรายการ Self Check Production
                                </h3>
                            </h1>
                        </section>
                                <section class="content">
                                        <div class="container">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>ลำดับ</th>
                                                        <th>รายการ</th>
                                                        <th>ลูกค้า</th>
                                                        <th>ไลน์การผลิต</th>
                                                        <th>เอกสารตรวจสอบ</th>
                                                        <th>จำนวน</th>
                                                        <th>Lot No</th>
                                                        <th>วันที่ผลิต</th>
                                                        <th>วันที่สร้าง</th>
                                                        <th>วันที่แก้ไข</th>
                                                        <th>สถานะ</th>
                                                    </tr>
                                                <thead>
                                                <tbody>
                                                    @foreach($item as $i)
                                                    <tr>
                                                        <td><a>{{ $i['id'] }}</a></td>
                                                        <td><a>{{ $i['submodel_id'] }}</a></td>
                                                        <td><a>{{ $i['customer_id'] }}</a></td>
                                                        <td><a>{{ $i['production_line_id'] }}</a></td>
                                                        <td><a>{{ $i['q_point_sheet_id'] }}</a></td>
                                                        <td><a>{{ $i['production_order'] }}</a></td>
                                                        <td><a>{{ $i['lot_no'] }}</a></td>
                                                        <td><a>{{ $i['production_date'] }}</a></td>
                                                        <td><a>{{ $i['created_at'] }}</a></td>
                                                        <td><a>{{ $i['updated_at'] }}</a></td>
                                                        <td><a>{{ $i['is_enable'] }}</a></td>
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
    <script>
        function text(event) {
            document.location.href = event.target.value;
        }
        function producton_order(){
            var order = document.getElementById('ProductionOrder').value;
            document.getElementById('ProductionOrder_pqa').value = order
        }
        function my_print(){
            window.print();
        }
        function submit(){
            document.getElementById('my_form').submit();
        }
    </script>
</html>
