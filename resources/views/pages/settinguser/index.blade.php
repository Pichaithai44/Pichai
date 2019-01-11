@extends('layouts.app')
@section('title', 'Set up the system')
@section('list', 'ตั้งค่าผู้ใช้งาน')
@section('content')
    <div class="container">
        <div class="form-group row">
            <div class="col">
                <button class="btn btn-sm btn-success" onclick="location='{{ route('pages.settinguser.create') }}'" id="create">เพิ่ม</button>
            </div>
        </div>
        <table class="tablesorter">
            <thead>
                <tr>
                    <th scope="row"></th>
                    <th scope="row">ชื่อ-นามสกุล</th>
                    <th scope="row">วันที่สร้าง</th>
                    <th scope="row">วันที่แก้ไขล่าสุด</th>
                    <th scope="row">สถานะ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($result['data_arr']->items() as $item)
                <tr>
                    <td scope="col">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-sm btn-warning" onclick="location='{{ route('pages.settinguser.edit',['id' => $item->personal_code]) }}'" data-toggle="tooltip" data-placement="top" title="แก้ไข"><i class="far fa-edit"></i></button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"><i class="far fa-trash-alt"></i></button>
                        </div>
                    </td>
                    <td scope="col"><a>{{ "{$item->personal_title_name}{$item->personal_first_name} {$item->personal_last_name}" }}</a></td>
                    <td scope="col"><a>{{ $item->created_at }}</a></td>
                    <td scope="col"><a>{{ $item->updated_at }}</a></td>
                    <td scope="col"><a>{{ $item->is_active }}</a></td>
                    <td scope="col"></td>
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

    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>				
                    <h4 class="modal-title">Are you sure?</h4>	
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
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
    </script>
@endsection   

