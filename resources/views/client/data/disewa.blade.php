@extends('client.client')

@section('content')
<div class=" contact-page ">

    <div class=" backgroundGreen pb-1" style="">
        <h4 class="text-center pt-1 text-white">Asset Disewa</h4>
    </div>
    <div class="backgroundGray">
        <div class="body table-responsive"  style="min-height: 500px">
            <table class="table table-sm" >
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center" style="width: 50px">Gambar</th>
                    <th class="text-center">Jenis Media / Alamat</th>
                    <th class="text-center">Penyewa</th>
                    <th class="text-center">Mulai</th>
                    <th class="text-center">Selesai</th>
                </tr>
                @forelse ($disewa as $key => $d)
                {{ csrf_field() }}
                <tbody>
                    <tr>
                        <td class="text-center" rowspan="2" style=" vertical-align: middle">
                            {{$disewa->firstItem() + $key}}</td>
                        <td class="text-center" rowspan="2"> @if ($d->url_foto == null)
                            <img alt="" src="{{asset('assets/noimage.jpg')}}" height="60">
                            @else
                            <img alt="" src="{{asset('assets/thumbnails/'.$d->url_foto)}}" height="60">
                            @endif</td>
                        <td class="border-bottom-0" style="padding-bottom: 0">{{$d->nama_baliho}}
                        </td>
                        <td class="text-center" rowspan="2" style=" vertical-align: middle"> {{$d->nama_advertiser}}
                        </td>
                        <td class="text-center" rowspan="2" style=" vertical-align: middle"> {{$d->tanggal_awal}}
                        </td>
                        <td class="text-center" rowspan="2" style=" vertical-align: middle"> {{$d->tanggal_akhir}}
                        </td>
                     
                       
                        
                    </tr>
                    <tr>
                        <td class="border-top-0" style="">{{$d->alamat}}</td>
                    </tr>
                </tbody>
                @empty
                <tbody>
                    <tr style="height: 400px">
                        <td colspan="8" class="text-center" style="padding: 20%" >Anda belum mempunyai asset media iklan yang disewa</td>
                    </tr>
                </tbody>
                @endforelse
            </table>
            {{$disewa->links()}}
        </div>

    </div>

</div>
@endsection