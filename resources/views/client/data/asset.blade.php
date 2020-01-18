@extends('client.client')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Basic Examples -->


<div class=" contact-page ">
    <a href="asset/add" class="float">
        <i class="fa fa-plus my-float"></i>
    </a>
    <div class=" backgroundGreen pb-1 " style="">
        <h4 class="text-center pt-1 text-white">Asset Media</h4>
    </div>
    <div class="backgroundGray"  style="min-height: 500px">
        <div class="body table-responsive">
            <table class="table table-sm">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center" style="width: 50px">Gambar</th>
                    <th class="text-center">Jenis Media / Alamat</th>
                    <th class="text-center">Status</th>
                    <th class="text-center" colspan="2">Aksi</th>
                </tr>
                @forelse ($product as $key => $d)
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
                       

                        <td class="text-center" rowspan="2" style=" vertical-align: middle; width: 50px">
                            <a href="#!" class="btn btn-warning btn-circle btn-circle-sm"
                                onclick="editVisible({{$product->firstItem() + $key}}, {{$d->id_baliho}}, '{{$d->status}}')"><i
                                    @if ($d->status ==
                                    'publish')
                                    class="fa fa-eye"
                                    @else
                                    class="fa fa-eye-slash"
                                    @endif
                                    id="iconVisible{{$product->firstItem() + $key}}" aria-hidden="true"></i></a></td>
                        <td class="text-center" rowspan="2" style=" vertical-align: middle; width: 50px">
                        <a href="asset/info/{{$d->id_baliho}}" class="btn btn-info btn-circle btn-circle-sm"><i class="fas fa-info    "></i></a></td>
                    </tr>
                    <tr>
                        <td class="border-top-0" style="">{{$d->alamat}}</td>
                    </tr>
                </tbody>
                @empty
                <tbody>
                    <tr style="height: 400px">
                        <td colspan="8" class="text-center" style="padding: 20%">Anda belum mempunyai asset media iklan
                        </td>
                    </tr>
                </tbody>
                @endforelse
            </table>
            {{$product->links()}}
        </div>

    </div>

</div>
<!-- #END# Basic Examples -->
<script>
    function editVisible(a,b,stat) {
        var icon = this.document.getElementById('iconVisible'+a).className;
        if (stat === 'pending') {
            swal.fire({
                icon: 'warning',
                title: 'Pending',
                text: 'Silahkan tunggu asset anda di proses oleh admin'
            });
        } else {
            if(icon === 'fa fa-eye'){
            // $('#iconVisible'+a).removeClass('fa-eye');
            // $('#iconVisible'+a).addClass('fa-eye-slash');
            $title = 'Block aseet ?';
            $text = 'Jika Asset di blok, maka advertiser tidak dapat melihat asset yang anda miliki';
            alertVisible($title,$text, 'block',b);
           
           
        }else{
            // $('#iconVisible'+a).removeClass('fa-eye-slash');
            // $('#iconVisible'+a).addClass('fa-eye');
           
            $title = 'Perlihatkan aseet ?';
            $text = 'Jika Asset diperlihatkan, maka advertiser dapat melihat asset yang anda miliki';
            alertVisible($title,$text, 'publish',b);
        }
        }
        
        // alert(icon);
        
    }

    function alertVisible(a,b,c,d) {
        var z = ''
        if(c === 'publish'){
            z = 'Publish';
        }else {
            z = 'Block';
        }
        swal.fire({
                icon: 'info',
                title: a,
                text: b,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: z,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if(result.value){
                    $.ajax({
                        type: 'GET',
                        dataType: "json",
                        url: 'updateVisible',
                        data: {
                            status: c,
                            id: d
                        },
                        success: function (data) {
                           alert('sukses');
                        },
                        error: function (data) {
                            window.location.reload();
                        }
                    })
                }
            })
    }
</script>

@endsection