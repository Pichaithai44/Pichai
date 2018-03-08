@extends('layouts.app')
@section('title', 'Self Check Product')
@section('list', 'รายการข้อมูล Self Check Product')
@section('content')
    <div class="container">
        <div class="form-group row">
            <div class="col">
                <button class="btn btn-success float-right" onclick="location='{{ route('pages.selfcheckproduction.create') }}'" id="create">ยืนยันการตรวจสอบชิ้นงานก่อนการผลิต</button>
            </div>
        </div>
        <table class="tablesorter">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>PART NO</th>
                    <th>PART Name</th>
                    <th>หมายเลขล็อต</th>
                    <th>วันที่ผลิต</th>
                    <th>อยู่ในขั้นตอน pd</th>
                    <th>อยู่ในขั้นตอน pqa</th>
                    <th>วันที่สร้าง</th>
                    <th>วันที่แก้ไข</th>
                    <th>สถานะ</th>
                    <th>PDF</th>
                </tr>
            <thead>
            <tbody>
                @foreach($data->items() as $key => $i)
                <tr>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id]) }}">{{ $data->firstItem() + $key }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id]) }}">{{ $i->part_no }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id]) }}">{{ $i->part_name }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id]) }}">{{ $i->lot_no_fix.$i->lot_no }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id]) }}">{{ $i->production_date }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id]) }}">{{ $i->production_status }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id]) }}">{{ $i->pqa_status }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id]) }}">{{ $i->created_at }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id]) }}">{{ $i->updated_at }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id]) }}">{{ $i->is_enable }}</a></td>
                    <td><a href="{{ route('selfcheckproduction.pdf',['id'=> $i->id]) }}" target="_blank">pdf</a></td>
                </tr>
                @endforeach
            <tbody>
        </table>
        <nav aria-label="model navigation page">
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
    </script>
@endsection