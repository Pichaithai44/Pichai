@extends('layouts.app')
@section('title', 'Page Title')
@section('list', 'รายการข้อมูล Lot Tag')
@section('content')
    <div class="container">
        <div class="form-group row">
            <div class="col">
                <button class="btn btn-success btn-ymt-create" onclick="location='{{ route('pages.lottag.create') }}'" id="create">เพิ่ม</button>
            </div>
        </div>
        <table class="tablesorter">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>Barcode</th>
                    <th>Model</th>
                    <th>Part Number</th>
                    <th>Part Name</th>
                    <th>วันที่สร้าง</th>
                    <th>วันที่แก้ไข</th>
                    <th>สถานะ</th>
                    <th>pdf</th>
                </tr>
            <thead>
            <tbody>
                @foreach($data->items() as $key => $i)
                <tr>
                    <td><a href="{{ route('pages.lottag.edit',['id'=> $i->id]) }}">{{ $data->firstItem() + $key }}</a></td>
                    <td><a href="{{ route('pages.lottag.edit',['id'=> $i->id]) }}"><img src="{{ $i->barcode_id }}"></a></td>
                    <td><a href="{{ route('pages.lottag.edit',['id'=> $i->id]) }}">{{ $i->model_name }}</a></td>
                    <td><a href="{{ route('pages.lottag.edit',['id'=> $i->id]) }}">{{ $i->part_no }}</a></td>
                    <td><a href="{{ route('pages.lottag.edit',['id'=> $i->id]) }}">{{ $i->part_name }}</a></td>
                    <td><a href="{{ route('pages.lottag.edit',['id'=> $i->id]) }}">{{ $i->created_at }}</a></td>
                    <td><a href="{{ route('pages.lottag.edit',['id'=> $i->id]) }}">{{ $i->updated_at }}</a></td>
                    <td><a href="{{ route('pages.lottag.edit',['id'=> $i->id]) }}">{{ $i->is_enable }}</a></td>
                    <td><a href="{{ route('lottag.pdf',['id'=> $i->id]) }}" target="_blank">pdf</a></td>
                </tr>
                @endforeach
            <tbody>
        </table>
        <nav aria-label="customer navigation page">
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