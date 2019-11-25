@extends('advertiser.advertiser')
@section('content')
<div class="body table-responsive" >
    <table class="table " style="width: 50%">
        <thead>
            <tr>
                <th>#</th>
                <th>Notifikasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notif as $n)
            
            <tr>
                <td rowspan="2" style="vertical-align: middle; width: 50px">{{$loop->iteration}}</td>
                <td class="border-bottom-0">{{$n->judul}}</td>
            </tr>
            <tr>
                <td class="border-top-0" style="">{{$n->isi}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$notif->links()}}
@endsection