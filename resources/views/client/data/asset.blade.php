@extends('client.client')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Basic Examples -->
<div class=" contact-page ">

    <div class=" backgroundGreen pb-1" style="">
        <h4 class="text-center pt-1 text-white">Asset Media</h4>
    </div>
    <div class="backgroundGray">
        <div class="body table-responsive">
            <table class="table table-sm">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center" style="width: 50px">Gambar</th>
                    <th class="text-center">Jenis Media / Alamat</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Terlihat</th>
                    <th class="text-center" colspan="3">Aksi</th>
                </tr>
                @foreach ($product as $key => $d)
                {{ csrf_field() }}
                <tbody>
                    <tr>
                        <td class="text-center" rowspan="2" style=" vertical-align: middle">
                            {{$product->firstItem() + $key}}</td>
                        <td class="text-center" rowspan="2"> @if ($d->url_foto == null)
                            <img alt="" src="{{asset('assets/noimage.jpg')}}" height="60">
                            @else
                            <img alt="" src="{{asset('assets/thumbnails/'.$d->url_foto)}}" height="60">
                            @endif</td>
                        <td class="border-bottom-0" style="padding-bottom: 0">{{$d->nama_baliho}}
                        </td>
                        <td class="text-center" rowspan="2" style=" vertical-align: middle"> {{$d->status}}
                        </td>
                        <td class="text-center" rowspan="2" style=" vertical-align: middle">
                            {{$d->status}}</td>
                        <td class="text-center" rowspan="2" style=" vertical-align: middle; width: 50px">
                            <a href=""><i class="fas fa-edit    "></i></a></td>
                        <td class="text-center" rowspan="2" style=" vertical-align: middle; width: 50px">
                            <a href="#!" onclick="editVisible({{$product->firstItem() + $key}}, {{$d->id_baliho}})"><i @if ($d->status ==
                                    'pending')
                                    class="fa fa-eye-slash"
                                    @else
                                    class="fa fa-eye"
                                    @endif
                                    id="iconVisible{{$product->firstItem() + $key}}" aria-hidden="true"></i></a></td>
                        <td class="text-center" rowspan="2" style=" vertical-align: middle; width: 50px">
                            <a href="" id=""><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>
                    <tr>
                        <td class="border-top-0" style="">{{$d->alamat}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            {{$product->links()}}
        </div>

    </div>

</div>
<!-- #END# Basic Examples -->
<script>
    function editVisible(a,b) {
        
        var icon = this.document.getElementById('iconVisible'+a).className;
        // alert(icon);
        if(icon === 'fa fa-eye'){
            $('#iconVisible'+a).removeClass('fa-eye');
            $('#iconVisible'+a).addClass('fa-eye-slash');
            swal.fire({
                icon: 'info',
                title: 'Perlihatkan aseet ?',
                    text: 'Jika Asset diperlihatkan, maka advertiser dapat melihat asset yang anda miliki',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Tampilkan',
                    cancelButtonText: 'Cancel'
            }).then((result) => {
                if(result.value){
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: 'updateVisible',
                        data: {
                            status: 'terlihat',
                            id: b
                        },
                        success: function name(params) {
                            
                        }
                    })
                }
            })
        }else{
            $('#iconVisible'+a).removeClass('fa-eye-slash');
            $('#iconVisible'+a).addClass('fa-eye');
        }
    }
</script>

@endsection