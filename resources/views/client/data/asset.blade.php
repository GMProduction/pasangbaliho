@extends('client.client')

@section('content')

<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 class="pb-2">
                    Asset Media Iklan
                </h2>
                <a href="add" class="btn btn-primary">Tambah Asset</a>

            </div>
            <div class="body">
                <div class="body table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center" style="width: 50px">Gambar</th>
                            <th class="text-center">Jenis Media / Alamat</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Terlihat</th>
                            <th class="text-center" colspan="2">Aksi</th>
                        </tr>
                        @foreach ($produk as $d)
                        <tbody>
                            <tr>
                                <td class="text-center" rowspan="2" style=" vertical-align: middle">1</td>
                                <td class="text-center" rowspan="2"><img
                                        src="{{asset('assets/thumbnails/'.$d->url_foto)}}" alt="" height="60"></td>
                                <td class="border-bottom-0" style="padding-bottom: 0">{{$d->nama_baliho}}
                                </td>
                                <td class="text-center" rowspan="2" style=" vertical-align: middle">sukses
                                </td>
                                <td class="text-center" rowspan="2" style=" vertical-align: middle">
                                    sukses</td>
                                <td class="text-center" rowspan="2" style=" vertical-align: middle; width: 50px">
                                    <a href=""><i class="fas fa-edit    "></i></a></td>
                                <td class="text-center" rowspan="2" style=" vertical-align: middle; width: 50px">
                                    <a href=""><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            </tr>
                            <tr>
                                <td class="border-top-0" style="">{{$d->alamat}}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Examples -->

@endsection