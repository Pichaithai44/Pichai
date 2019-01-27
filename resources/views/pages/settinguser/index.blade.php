@extends('layouts.app')
@section('title', 'PAWN')
@section('breadcrumbs')
{{ Breadcrumbs::render('settinguser') }}
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
                <div class="col-md-12 col-lg-12">
                    <h1 class="page-header"><i class="fas fa-user"></i> ข้อมูลสมาชิก</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-10 offset-lg-1">
                <table class="table table-bordered table-sm table-striped">
                    <thead>
                        <tr class="text-center table-tr-web">
                            <th scope="row"><button class="btn btn-block btn-success" onclick="location='{{ route('pages.settinguser.create') }}'" id="create"><i class="fas fa-plus-square"></i> เพิ่ม</button></th>
                            <th scope="row">ชื่อ-นามสกุล</th>
                            <th scope="row">เลขบัตรชาชน</th>
                            <th scope="row">วันที่สร้าง</th>
                            <th scope="row">วันที่แก้ไขล่าสุด</th>
                            <th scope="row">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result['data_arr']->items() as $item)
                        <tr>
                            <td scope="col" class="text-center">
                                <div class="btn-group" role="group" aria-label="btn-group">
                                    <button type="button" class="btn btn-lg btn-warning" onclick="location='{{ route('pages.settinguser.edit',['id' => $item->personal_code]) }}'" data-toggle="tooltip" data-placement="top" title="แก้ไข"><i class="far fa-edit"></i></button>
                                    <button type="button" class="btn btn-lg btn-danger" data-toggle="modal"  route="{{ route('pages.settinguser.destroy',['id' => $item->personal_code]) }}" onclick="deleteItem(this);"><i class="far fa-trash-alt"></i></button>
                                </div>
                            </td>
                            <td scope="col" class="text-left"><a>{{ "{$item->personal_title_name}{$item->personal_first_name} {$item->personal_last_name}" }}</a></td>
                            <td scope="col" class="text-center"><a>{{ $item->personal_citizen_id }}</a></td>
                            <td scope="col" class="text-center"><a>{{ $item->created_at }}</a></td>
                            <td scope="col" class="text-center"><a>{{ $item->updated_at }}</a></td>
                            <td scope="col" class="text-center"><a>{{ ($item->is_active = '1' ? 'ใช้งาน' : 'ไม่ใช้งาน') }}</a></td>
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
                <p>ต้องการลบรายการนี้ ใช่ หรือ ไม่ ?</p>
            </div>
            <div class="modal-footer">
                {{ Form::open(['method' => 'PATCH', 'id' => 'my_form', 'enctype' => 'multipart/form-data']) }}
                    <div class="btn-group" role="group" aria-label="Basic example">
                        {{ Form::button('ยกเลิก', ['class' => 'btn btn-lg btn-info', 'data-dismiss' => 'modal']) }}
                        {{ Form::submit('ลบ', ['class' => 'btn btn-lg btn-danger']) }}
                    </div>
                {{ Form::close() }}
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
        $(document).ready(function() {
            $( "div.alert-success" ).slideUp(600);
        });
    </script>
@endsection   

