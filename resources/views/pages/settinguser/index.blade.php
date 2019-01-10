@extends('layouts.app')
@section('title', 'Set up the system')
@section('list', 'ตั้งค่าผู้ใช้งาน')
@section('content')
    <div class="container">
        <div class="form-group row">
            <div class="col">
                <button class="btn btn-success" onclick="location='{{ route('pages.zoneone.add') }}'" id="create">เพิ่ม</button>
            </div>
        </div>
        <table class="tablesorter">
            <thead>
                <tr>
                    <th scope="row">ลำดับ</th>
                    <th scope="row">ชื่อ</th>
                    <th scope="row">เนื้อหา</th>
                    <th scope="row">ราคา</th>
                    <th scope="row">วันที่สร้าง</th>
                    <th scope="row">วันที่อัปเดท</th>
                    <th scope="row">ผู้แก้ไขล่าสุด</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data->zoneone->items() as $item)
                <tr>
                    <td scope="col"><a href="{{ route('pages.zoneone.edit',['id' => $item->id]) }}">{{ $item->id }}</a></td>
                    <td scope="col"><a href="{{ route('pages.zoneone.edit',['id' => $item->id]) }}">{{ $item->name }}</a></td>
                    <td scope="col"><a href="{{ route('pages.zoneone.edit',['id' => $item->id]) }}"><?php echo $item->title; ?></a></td>
                    <td scope="col"><a href="{{ route('pages.zoneone.edit',['id' => $item->id]) }}">{{ $item->price }}</a></td>
                    <td scope="col"><a href="{{ route('pages.zoneone.edit',['id' => $item->id]) }}">{{ $item->created_at }}</a></td>
                    <td scope="col"><a href="{{ route('pages.zoneone.edit',['id' => $item->id]) }}">{{ $item->updated_at ? $item->updated_at : '-' }}</a></td>
                    <td scope="col"><a href="{{ route('pages.zoneone.edit',['id' => $item->id]) }}">admin</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="zoneone navigation page">
            <ul class="pagination justify-content-end">
                <li class="page-item {{ $data->zoneone->currentPage() == 1 ? 'disabled' : null }}"><a class="page-link {{ $data->zoneone->currentPage() == 1 ? 'bg-grey-300' : null }}" href="{{ $data->zoneone->url(1) }}"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
                <li class="page-item {{ $data->zoneone->currentPage() == 1 ? 'disabled' : null }}"><a class="page-link {{ $data->zoneone->currentPage() == 1 ? 'bg-grey-300' : null }}" href="{{ $data->zoneone->previousPageUrl() }}"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                <?php 
                    $c = floor(($data->zoneone->currentPage()/5));
                    $k = ($c*5 != 0) ? $c*5 : 1;
                    $n = ($c*5 != 0) ? 5+($c*5) : 5;
                ?>
                @for($i = $k;$i <= ($data->zoneone->lastPage() >5 ? $n : $data->zoneone->lastPage());$i++)
                    <li class="page-item {{ $data->zoneone->currentPage() == $i ? 'active' : null }}"><a class="page-link" href="{{ $data->zoneone->url($i) }}" style="font-size: 0.8rem;">{{ $i }}</a></li>
                @endfor
                <li class="page-item {{ $data->zoneone->currentPage() == $data->zoneone->lastPage() ? 'disabled' : null }}"><a class="page-link {{ $data->zoneone->currentPage() == $data->zoneone->lastPage() ? 'bg-grey-300' : null }}" href="{{ $data->zoneone->nextPageUrl() }}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                <li class="page-item {{ $data->zoneone->currentPage() == $data->zoneone->lastPage() ? 'disabled' : null }}"><a class="page-link {{ $data->zoneone->currentPage() == $data->zoneone->lastPage() ? 'bg-grey-300' : null }}" href="{{ $data->zoneone->url($data->zoneone->lastPage()) }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
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

