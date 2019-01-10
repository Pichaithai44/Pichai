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
                    <th scope="row">ชื่อ-นามสกุล</th>
                    <th scope="row">วันที่สร้าง</th>
                    <th scope="row">วันที่แก้ไขล่าสุด</th>
                    <th scope="row">สถานะ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($result['data_arr']->items() as $item)
                <tr>
                    <td scope="col"><a href="{{ route('pages.settinguser.update',['id' => $item->id]) }}">{{ "{$item->personal_title_name}{$item->personal_first_name} {$item->personal_last_name}" }}</a></td>
                    <td scope="col"><a href="{{ route('pages.settinguser.update',['id' => $item->id]) }}">{{ $item->created_at }}</a></td>
                    <td scope="col"><a href="{{ route('pages.settinguser.update',['id' => $item->id]) }}">{{ $item->updated_at }}</a></td>
                    <td scope="col"><a href="{{ route('pages.settinguser.update',['id' => $item->id]) }}">{{ $item->is_active }}</a></td>
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
@endsection
@section('script')
    <script>
        $(document).ready(function() { 
            $("table").tablesorter( {sortzoneone: [false]} ); 
        });
    </script>
@endsection   

