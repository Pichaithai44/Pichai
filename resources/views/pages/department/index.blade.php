@extends('layouts.app')
@section('title', 'Department')
@section('list', 'รายการข้อมูลค่าเริ่มต้น แผนก')
@section('content')
    <div class="container">
        <div class="form-group row">
            <div class="col">
                <button class="btn btn-success btn-ymt-create" onclick="location='{{ route('pages.department.create') }}'" id="create">เพิ่ม</button>
            </div>
        </div>
        <table class="tablesorter">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>รายชื่อแผนก</th>
                    <th>วันที่สร้าง</th>
                    <th>วันที่แก้ไข</th>
                    <th>สถานะ</th>
                </tr>
            <thead>
            <tbody>
                @foreach($data->items() as $key => $i)
                <tr>
                    <td><a href="{{ route('pages.department.edit',['id'=> $i->id ]) }}">{{ $data->firstItem() + $key }}</a></td>
                    <td><a href="{{ route('pages.department.edit',['id'=> $i->id ]) }}">{{ $i->name }}</a></td>
                    <td><a href="{{ route('pages.department.edit',['id'=> $i->id ]) }}">{{ $i->created_at }}</a></td>
                    <td><a href="{{ route('pages.department.edit',['id'=> $i->id ]) }}">{{ $i->updated_at }}</a></td>
                    <td><a href="{{ route('pages.department.edit',['id'=> $i->id ]) }}">{{ $i->is_enable }}</a></td>
                </tr>
                @endforeach
            <tbody>
        </table>
        <nav aria-label="department navigation page">
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

