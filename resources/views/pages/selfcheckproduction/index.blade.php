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
                    <th>การตรวจสอบ pd</th>
                    <th>ผลการตรวสอบ pd</th>
                    <th>การตรวจสอบ pqa</th>
                    <th>ผลการตรวสอบ pqa</th>
                    <th>PDF</th>
                </tr>
            <thead>
            <tbody>
                @foreach($data->items() as $key => $i)
                <tr>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id,'page'=> 0]) }}">{{ $data->firstItem() + $key }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id,'page'=> 0]) }}">{{ $i->part_no }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id,'page'=> 0]) }}">{{ $i->part_name }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id,'page'=> 0]) }}">{{ $i->lot_no_fix.$i->lot_no }}</a></td>
                    <td><a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id,'page'=> 0]) }}">{{ $i->production_date }}</a></td>
                    <td class="text-center">
                        <a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id,'page'=> 0]) }}">
                            @foreach($i->production_status as $pd)
                                <span class="{{ $pd == 'C' ? 'text-success border border-success' : 'text-warning border border-warning' }}">{{ $pd }}</span>
                            @endforeach
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id,'page'=> 0]) }}">
                            @foreach($i->production_quality_result as $pd_rs)
                                <span class="{{ $pd_rs == 'T' ? 'text-success border border-success' : ($pd_rs == 'F' ? 'text-danger border border-danger' : 'text-warning border border-warning') }}">{{ $pd_rs == 'T' ? 'O' :($pd_rs == 'F' ? 'X' : 'W') }}</span>
                            @endforeach
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id,'page'=> 0]) }}">
                            @foreach($i->pqa_status as $pqa)
                                <span class="{{ $pqa == 'C' ? 'text-success border border-success' : 'text-warning border border-warning' }}">{{ $pqa }}</span>
                            @endforeach
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('pages.selfcheckproduction.edit',['id'=> $i->id,'page'=> 0]) }}">
                            @foreach($i->pqa_quality_result as $pqa_rs)
                                <span class="{{ $pqa_rs[0] == 'T' ? 'text-success border border-success' : ($pqa_rs[0] == 'F' ? 'text-danger border border-danger' : 'text-warning border border-warning') }}">{{ $pqa_rs[0] == 'T' ? 'O' :($pqa_rs[0] == 'F' ? 'X' : 'W') }}</span>
                            @endforeach
                        </a>
                    </td>
                    <td><a href="{{ route('selfcheckproduction.pdf',['id'=> $i->id,'page'=> null]) }}" target="_blank">pdf</a></td>
                </tr>
                @endforeach
            <tbody>
        </table>
        <nav aria-label="model navigation page">
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