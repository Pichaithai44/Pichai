@extends('layouts.app')
@section('title', 'Page Title')
@section('list', 'รายการข้อมูล ไลน์การผลิต')
@section('content')
    <div class="container">
        <div class="form-group row">
            <div class="col">
                <button class="btn btn-success btn-ymt-create" onclick="location='{{ route('pages.productionline.create') }}'" id="create">เพิ่ม</button>
            </div>
        </div>
        <table class="tablesorter">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>รายการ</th>
                    <th>วันที่สร้าง</th>
                    <th>วันที่แก้ไข</th>
                    <th>สถานะ</th>
                </tr>
            <thead>
            <tbody>
                @foreach($data->items() as $key => $i)
                <tr>
                    <td><a href="{{ route('pages.productionline.edit',['id'=> $i->id]) }}">{{ $data->firstItem() + $key }}</a></td>
                    <td><a href="{{ route('pages.productionline.edit',['id'=> $i->id]) }}">{{ $i->line_name }}</a></td>
                    <td><a href="{{ route('pages.productionline.edit',['id'=> $i->id]) }}">{{ $i->created_at }}</a></td>
                    <td><a href="{{ route('pages.productionline.edit',['id'=> $i->id]) }}">{{ $i->updated_at }}</a></td>
                    <td><a href="{{ route('pages.productionline.edit',['id'=> $i->id]) }}">{{ $i->is_enable }}</a></td>
                </tr>
                @endforeach
            <tbody>
        </table>
        <nav aria-label="productionline navigation page">
            <ul class="pagination justify-content-end">
                <li class="page-item {{ $data->currentPage() == 1 ? 'disabled' : null }}"><a class="page-link {{ $data->currentPage() == 1 ? 'bg-grey-300' : null }}" href="{{ $data->url(1) }}"><i class="fas fa-angle-double-left"></i></a></li>
                <li class="page-item {{ $data->currentPage() == 1 ? 'disabled' : null }}"><a class="page-link {{ $data->currentPage() == 1 ? 'bg-grey-300' : null }}" href="{{ $data->previousPageUrl() }}"><i class="fas fa-angle-left"></i></a></li>
                <?php 
                    $c = floor(($data->currentPage()/5));
                    $k = ($c*5 != 0) ? $c*5 : 1;
                    $n = ($c*5 != 0) ? 5+($c*5) : 5;
                ?>
                @for($i = $k;$i <= ($data->lastPage() >5 ? $n : $data->lastPage());$i++)
                    <li class="page-item {{ $data->currentPage() == $i ? 'active' : null }}"><a class="page-link" href="{{ $data->url($i) }}" style="font-size: 0.8rem;">{{ $i }}</a></li>
                @endfor
                <li class="page-item {{ $data->currentPage() == $data->lastPage() ? 'disabled' : null }}"><a class="page-link {{ $data->currentPage() == $data->lastPage() ? 'bg-grey-300' : null }}" href="{{ $data->nextPageUrl() }}"><i class="fas fa-angle-right"></i></a></li>
                <li class="page-item {{ $data->currentPage() == $data->lastPage() ? 'disabled' : null }}"><a class="page-link {{ $data->currentPage() == $data->lastPage() ? 'bg-grey-300' : null }}" href="{{ $data->url($data->lastPage()) }}"><i class="fas fa-angle-double-right"></i></a></li>
            </ul>
        </nav>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() { 
            $("table").tablesorter( {sortList: [false]} ); 
        });
    </script>
@endsection
