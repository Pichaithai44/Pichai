<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-4.0.0-dist/bootstrap.min.css') }}" type="text/css">
    <style>

        @font-face {
            font-family: 'THSarabunNew';
            src: url('/fonts/THSarabunNew-webfont.eot');
            src: url('/fonts/THSarabunNew-webfont.eot?#iefix') format('embedded-opentype'), url('/fonts/THSarabunNew-webfont.woff') format('woff'), url('/fonts/THSarabunNew-webfont.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'THSarabunNew';
            src: url('/fonts/THSarabunNew_bolditalic-webfont.eot');
            src: url('/fonts/THSarabunNew_bolditalic-webfont.eot?#iefix') format('embedded-opentype'), url('/fonts/THSarabunNew_bolditalic-webfont.woff') format('woff'), url('/fonts/THSarabunNew_bolditalic-webfont.ttf') format('truetype');
            font-weight: bold;
            font-style: italic;
        }

        @font-face {
            font-family: 'THSarabunNew';
            src: url('/fonts/THSarabunNew_italic-webfont.eot');
            src: url('/fonts/THSarabunNew_italic-webfont.eot?#iefix') format('embedded-opentype'), url('/fonts/THSarabunNew_italic-webfont.woff') format('woff'), url('/fonts/THSarabunNew_italic-webfont.ttf') format('truetype');
            font-weight: normal;
            font-style: italic;
        }

        @font-face {
            font-family: 'THSarabunNew';
            src: url('/fonts/THSarabunNew_bold-webfont.eot');
            src: url('/fonts/THSarabunNew_bold-webfont.eot?#iefix') format('embedded-opentype'), url('/fonts/THSarabunNew_bold-webfont.woff') format('woff'), url('/fonts/THSarabunNew_bold-webfont.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        body {
            font-family: 'THSarabunNew', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        @page {
            size: A4;
            margin: 1.27cm 1.27cm;
        }

        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
            }
        }
        table.table-bordered{
            border:1px solid #212121;
            margin-top:20px;
        }
        table.table-bordered > thead > tr > th{
            border:1px solid #212121;
        }
        table.table-bordered > tbody > tr > td{
            border:1px solid #212121;
        }
    </style>
	<title>รายงานไถ่สินค้าคืน</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="row" width="15%" class="table-primary">ลำดับ</th>
                                <th scope="row" width="15%" class="table-primary">ชื่อ-นามสกุล</th>
                                <th scope="row" width="15%" class="table-primary">ชื่อสินค้า</th>
                                <th scope="row" width="15%" class="table-primary">วันที่ไถ่สินค้า</th>
                                <th scope="row" width="15%" class="table-primary">วันที่ทำรายการ</th>
                                <th scope="row" width="15%" class="table-primary">ผู้ทำรายการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($result['data_arr']->items() as $key => $item)
                            <tr class="text-center">
                                <td scope="col">{{ $item->rownum }}</td>
                                <td scope="col">{{ $item->full_name }}</td>
                                <td scope="col">{{ $item->product_name }}</td>
                                <td scope="col">{{ date('y-m-d', strtotime($item->updated_at)) }}</td>
                                <td scope="col">{{ date('y-m-d', strtotime($item->updated_at)) }}</td>
                                <td scope="col">{{ $item->updated_by }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>