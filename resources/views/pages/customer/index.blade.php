@extends('layouts.app')
@section('title', 'Customer')
@section('list', 'รายการข้อมูล รายชื่อลูกค้า')
@section('content')
    <div class="container">
        <div class="form-group row">
            <form class="form-inline">
                <div class="col-4">
                    <input class="form-control" type="text" name="search" placeholder="ค้นหาจากรายชื่อ..." value="{{ old('search') }}">
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">วันที่ :</label>
                        <div class="col-8">
                            <div id="datepicker">
                                <div class="form-group row">
                                    <div class="col-6">
                                        <input type="text" name="date_start" class="actual_range form-control">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="date_end" class="actual_range form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-success m-2" type="submit">ค้นหา</button>      
                        </div>
                    </div>
                </div>
            </form>
            <div class="col-2">
                <button class="btn btn-success btn-ymt-create" onclick="location='{{ route('pages.customer.create') }}'" id="create">เพิ่ม</button>
            </div>
        </div>
        <table class="tablesorter">
            <thead>
                <tr>
                    <th>ลำดับ{{ print_r(session('data')) }}</th>
                    <th>รายชื่อลูกค้า</th>
                    <th>วันที่สร้าง</th>
                    <th>วันที่แก้ไข</th>
                    <th>สถานะ</th>
                </tr>
            <thead>
            <tbody>
                @foreach($data->items() as $key => $i)
                <tr>
                    <td><a href="{{ route('pages.customer.edit',['id'=> $i->id ]) }}">{{ $data->firstItem() + $key }}</a></td>
                    <td><a href="{{ route('pages.customer.edit',['id'=> $i->id ]) }}">{{ $i->customer_name }}</a></td>
                    <td><a href="{{ route('pages.customer.edit',['id'=> $i->id ]) }}">{{ $i->created_at }}</a></td>
                    <td><a href="{{ route('pages.customer.edit',['id'=> $i->id ]) }}">{{ $i->updated_at }}</a></td>
                    <td><a href="{{ route('pages.customer.edit',['id'=> $i->id ]) }}">{{ $i->is_enable }}</a></td>
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
        $(function() {
            $('#datepicker').datepicker({
                inputs: $('.actual_range')
            });
        });
    </script>
@endsection   

