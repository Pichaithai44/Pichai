@extends('layouts.app')
@section('title', 'Auth')
@section('list', 'รายการข้อมูล ผู้ใช้')
@section('content')
    <div class="container">
        <div class="form-group row">
            <div class="col">
                <button class="btn btn-success btn-ymt-create" onclick="location='{{ route('pages.auth.add') }}'" id="create">เพิ่ม</button>
            </div>
        </div>
        <table class="tablesorter">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อ</th>
                    <th>อิเมล</th>
                    <th>สิทธิการใช้งาน</th>
                    <th>วันที่สร้าง</th>
                    <th>วันที่แก้ไข</th>
                    <th>สถานะ</th>
                </tr>
            <thead>
            <tbody>
                @foreach($data->items() as $key => $i)
                <tr>
                    <td><a href="{{ route('pages.auth.edit',['id'=> $i->id ]) }}">{{ $data->firstItem() + $key }}</a></td>
                    <td><a href="{{ route('pages.auth.edit',['id'=> $i->id ]) }}">{{ $i->user_name }}</a></td>
                    <td><a href="{{ route('pages.auth.edit',['id'=> $i->id ]) }}">{{ $i->email }}</a></td>
                    <td><a href="{{ route('pages.auth.edit',['id'=> $i->id ]) }}">{{ $i->role_name }}</a></td>
                    <td><a href="{{ route('pages.auth.edit',['id'=> $i->id ]) }}">{{ $i->created_at }}</a></td>
                    <td><a href="{{ route('pages.auth.edit',['id'=> $i->id ]) }}">{{ $i->updated_at }}</a></td>
                    <td><a href="{{ route('pages.auth.edit',['id'=> $i->id ]) }}">{{ $i->is_enable }}</a></td>
                </tr>
                @endforeach
            <tbody>
        </table>
        <nav aria-label="auth navigation page">
            <ul class="pagination justify-content-end">
                <li class="page-item"><a class="page-link" href="{{ $data->previousPageUrl() }}">Previous</a></li>
                @for($i = 1;$i <= $data->lastPage();$i++)
                <li class="page-item {{ $data->currentPage() == $i ? 'active' : null }}"><a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a></li>
                @endfor
                <li class="page-item"><a class="page-link" href="{{ $data->nextPageUrl() }}">Next</a></li>
            </ul>
        </nav>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() { 
            $("table").tablesorter( {sortList: [false]} ); 
        });
        $(function() {
            $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true
            });
        });
    </script>
@endsection   

