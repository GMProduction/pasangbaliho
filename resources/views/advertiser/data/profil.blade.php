@extends('advertiser.advertiser')
@section('content')



<style>
    body #contact-page {
        background-color: #fff;
    }

    body #contact-page .submit-button {
        padding: 8px 20px;
        color: #fff;
        border: none;
        margin-top: 10px;
    }

    .borderEdit {
        border-bottom: 4px solid #26A69A;
    }
    img {
  width:200px;
  height:400px;
  object-fit:cover;
}
</style>

<script>
    if('{{session("status")}}'){
            // alert('{{session("status")}}');
            Swal.fire({
 title: '{{session("status")}}',
 text: '{{session("text")}}',
 icon: '{{session("icon")}}'
 
})
        }
</script>
<link rel="stylesheet" href="{{asset('css/profile.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/main.css')}}"> --}}
<section id="contact-page" style="">
    <div class=" backgroundGreen pb-1" style="">
        <h4 class="text-center pt-1 text-white">Profile</h4>
    </div>
    @foreach ($profile as $p)


    <div class="backgroundGray" style="">
        <div class="">
            <div class="row p-3" style="">
                <div class="col-md-4 ">
                    <div class="portlet light profile-sidebar-portlet bordered">

                        <div class="profile-userpic">
                            <img id="imgAccount" src="https://bootdey.com/img/Content/avatar/avatar6.png" height="200" width="200" class="img-responsive" alt="">
                        </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> {{$p->nama}} </div>
                            <div class="profile-usertitle-job"> Advertiser </div>
                        </div>
                        <form action="updateImg" method="POST"  enctype="multipart/form-data">
                        <div class="profile-userbuttons pb-4">
                        <input type="hidden" name="id" value="{{auth()->guard('advertiser')->user()->id}}">
                            <input type="file" name="foto" id="poto" class="small"  onchange="showImgAccount(this)">
                            <button type="submit" class="btn btn-sm btn-info">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="portlet light bordered">

                        <div class="portlet-body">
                            <div>
                                
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#profile" aria-controls="profile"
                                            role="tab" data-toggle="tab">Profile</a></li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="profile">
                                        <form id="formProfil" role="form">
                                            {{ csrf_field() }}
                                            <h6 class="text-right m-0 p-0"><a href="#!" onclick="edit()" class="btn btn-info btn-sm"
                                                id=""><i class="fas fa-edit" id="iconEdit" class="text-center"></i> <label
                                                    id="txtEdit" class="text-center" style="">Edit</label></a>
                                        </h6>
                                            <input type="hidden" name="id" value="{{$p->id}}">
                                            <div class="form-group">
                                                <label for="nama">Name</label>
                                                <input type="text" class="form-control" style="" readonly id="nama"
                                                    name="nama" placeholder="Name" value="{{$p->nama}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="instansi">Nama Instansi</label>
                                                <input type="text" class="form-control" readonly id="instansi"
                                                    name="instansi" placeholder="Instansi"
                                                    value="{{$p->nama_instansi}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="telp">Telp</label>
                                                <input type="number" class="form-control" readonly id="telp" name="telp"
                                                    placeholder="telp" value="{{$p->telp}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" class="form-control" readonly id="email"
                                                    name="email" placeholder="Email" value="{{$p->email}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Address</label>
                                                <textarea name="alamat" class="form-control" readonly id="alamat"
                                                    cols="30" rows="4" placeholder="Address">{{$p->alamat}}</textarea>
                                            </div>


                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        function edit() {
            if ($('#txtEdit').html() === 'Edit') {
                $('#txtEdit').html('Save');
                $('#iconEdit').removeClass('fa-edit');
                $('#iconEdit').addClass('fa-save');
                $('#formProfil input').removeAttr('readonly');
                $('#formProfil textarea').removeAttr('readonly');
                $('#formProfil input').addClass('borderEdit');
                $('#formProfil textarea').addClass('borderEdit');
               
            } else {
                $('#txtEdit').html('Edit');
                $('#iconEdit').removeClass('fa-save');
                $('#iconEdit').addClass('fa-edit');
                $('#formProfil input').attr('readonly','');
                $('#formProfil textarea').attr('readonly','');
                $('#formProfil input').removeClass('borderEdit');
                $('#formProfil textarea').removeClass('borderEdit');
                swal.fire({
                    icon: 'info',
                    text: 'Apakah anda yakin akan merubah data ?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
            }).then((result) => {
                if(result.value){
                    // swal.fire({
                    //     icon: 'success',
                    //     text: 'Data berhasil disimpan !'
                    // }).then((result) => {
                        document.getElementById('formProfil').action = 'editProfil';
                        document.getElementById('formProfil').method = 'POST';
                        document.getElementById('formProfil').submit();
                    // })
                }
            })
            }
          
        }
    </script>
</section>

@endsection