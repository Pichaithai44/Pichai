@extends('layouts.app')
@section('title', 'Set up the system')
@section('breadcrumbs')
{{ Breadcrumbs::render('pledge') }}
@endsection
@section('content')
@if (session('status'))
    <div class="alert {{ session('result') ? 'alert-success' : 'alert-danger' }}" role="alert">
        <strong>{{ session('status') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header"><i class="fas fa-archive"></i> รายการสินค้า</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr class="text-center">
                            <th scope="row" width="30%"><button class="btn btn-lg btn-success" onclick="location='{{ route('pages.pledge.create') }}'" id="create"><i class="fas fa-plus-square"></i> เพิ่ม</button></th>
                            <th scope="row" width="25%">ชื่อสินค้า</th>
                            <th scope="row" width="25%">ชื่อ-นามสกุล</th>
                            <th scope="row" width="10%">ราคา</th>
                            <th scope="row" width="15%">วันที่สร้าง</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result['data_arr']->items() as $item)
                        <tr class="text-center">
                            <td scope="col">
                                <div class="text-center" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-lg btn-warning" onclick="location='{{ route('pages.pledge.edit',['id' => $item->product_code]) }}'" data-toggle="tooltip" data-placement="top" title="จ่ายดอกเบี้ย"><i class="fas fa-money-bill-alt"></i> ชำระค่างวด</button>
                                    <button type="button" class="btn btn-lg btn-danger" data-toggle="modal"  route="{{ route('pages.pledge.destroy',['id' => $item->product_code]) }}" onclick="deleteItem(this);"><i class="fas fa-undo-alt"></i> ไถ่ถอนสินค้า</button>
                                </div>
                            </td>
                            <td scope="col"><a>{{ $item->product_name }}</a></td>
                            <td scope="col" class="text-left"><a>{{ $item->full_name }}</a></td>
                            <td scope="col"><a>{{ $item->product_capital }}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <nav aria-label="zoneone navigation page">
                    <ul class="pagination justify-content-end">
                        <li class="page-item {{ $result['data_arr']->currentPage() == 1 ? 'disabled' : null }}"><a class="page-link {{ $result['data_arr']->currentPage() == 1 ? 'bg-grey-300' : null }}" href="{{ $result['data_arr']->url(1) }}"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
                        <li class="page-item {{ $result['data_arr']->currentPage() == 1 ? 'disabled' : null }}"><a class="page-link {{ $result['data_arr']->currentPage() == 1 ? 'bg-grey-300' : null }}" href="{{ $result['data_arr']->previousPageUrl() }}"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                        <?php 
                            $c = floor(($result['data_arr']->currentPage()/5));
                            $k = ($c*5 != 0) ? $c*5 : 1;
                            $n = ($c*5 != 0) ? 5+($c*5) : 5;
                        ?>
                        @for($i = $k;$i <= ($result['data_arr']->lastPage() >5 ? $n : $result['data_arr']->lastPage());$i++)
                            <li class="page-item {{ $result['data_arr']->currentPage() == $i ? 'active' : null }}"><a class="page-link" href="{{ $result['data_arr']->url($i) }}" style="font-size: 0.8rem;">{{ $i }}</a></li>
                        @endfor
                        <li class="page-item {{ $result['data_arr']->currentPage() == $result['data_arr']->lastPage() ? 'disabled' : null }}"><a class="page-link {{ $result['data_arr']->currentPage() == $result['data_arr']->lastPage() ? 'bg-grey-300' : null }}" href="{{ $result['data_arr']->nextPageUrl() }}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                        <li class="page-item {{ $result['data_arr']->currentPage() == $result['data_arr']->lastPage() ? 'disabled' : null }}"><a class="page-link {{ $result['data_arr']->currentPage() == $result['data_arr']->lastPage() ? 'bg-grey-300' : null }}" href="{{ $result['data_arr']->url($result['data_arr']->lastPage()) }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

<!-- Modal HTML -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แจ้งเตือน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>ต้องการนำของออกจากระบบ ใช่ หรือ ไม่ ?</p>
            </div>
            <div class="modal-footer">
                <form id="my_form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-danger">นำออก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')
    <script>

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(document).ready(function() { 
            $("table").tablesorter( {sortzoneone: [false]} ); 
        });

        function deleteItem(item) {
            $('#my_form').attr('action', $(item).attr("route"));
            $('#myModal').modal('show');
        }
    </script>
@endsection   



