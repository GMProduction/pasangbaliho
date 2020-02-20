@extends('client.client')
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
        width: 200px;
        height: 400px;
        object-fit: cover;
    }
</style>

<script>
    if('{{session("status")}}'){
            // alert('{{session("status")}}');
            swal.fire({
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
                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-responsive" alt="">
                        </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> </div>
                            <div class="profile-usertitle-job"> Klien </div>
                        </div>
                        <div class="profile-userbuttons pb-4">
                            <input type="file" class="small">
                            <button type="submit" class="btn btn-sm btn-info">Save</button>
                        </div>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class=" bordered" style="background-color: white">

                        <div class="p-2">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                        aria-controls="home" aria-selected="true">Umum</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                        aria-controls="profile" aria-selected="false">Khusus</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <form id="formProfil" role="form">
                                        {{ csrf_field() }}
                                        <h6 class="text-right m-0 p-0 pt-2"><a href="#!" onclick="edit()"
                                                class="btn btn-sm btn-info " id=""><i class="fas fa-edit" id="iconEdit"
                                                    class="text-center"></i> <label id="txtEdit"
                                                    class="text-center m-0 p-0" style="">Edit</label></a>
                                        </h6>
                                        <input type="hidden" name="id" value="{{$p->id_client}}">
                                        <div class="form-group">
                                            <label for="nama">Name</label>
                                            <input type="text" class="form-control" style="" readonly id="nama"
                                                name="nama" placeholder="Name" value="{{$p->nama}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="instansi">Nama Instansi</label>
                                            <input type="text" class="form-control" readonly id="instansi"
                                                name="instansi" placeholder="Instansi" value="{{$p->nama_instansi}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="telp">Telp</label>
                                            <input type="number" class="form-control" readonly id="telp" name="telp"
                                                placeholder="telp" value="{{$p->telp}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" readonly id="email" name="email"
                                                placeholder="Email" value="{{$p->email}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Address</label>
                                            <textarea name="alamat" class="form-control" readonly id="alamat" cols="30"
                                                rows="4" placeholder="Address">{{$p->alamat}}</textarea>
                                        </div>


                                    </form>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <form action="formKhusus" id="formKhusus" role="form">
                                        {{ csrf_field() }}
                                        <h6 class="text-right m-0 p-0 pt-2"><a href="#!" onclick="editKhusus()"
                                                class="btn btn-sm btn-info " id=""><i class="fas fa-edit" id="iconEdit2"
                                                    class="text-center"></i> <label id="txtEdit2"
                                                    class="text-center m-0 p-0" style="">Edit</label></a>
                                        </h6>
                                        <input type="hidden" name="id" value="{{$p->id_client}}">
                                        <div class="form-group">
                                            <label for="ktp">No. Ktp</label>
                                            <input type="number" class="form-control" readonly id="ktp" name="ktp"
                                                placeholder="Nomor KTP" value="{{$p->no_ktp}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nib">NIB</label>
                                            <input type="number" class="form-control" readonly id="nib" name="nib"
                                                placeholder="Nomor NIB" value="{{$p->nib}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="npwp">NPWP</label>
                                            <input type="number" class="form-control" readonly id="npwp" name="npwp"
                                                placeholder="Nomor NPWP" value="{{$p->npwp}}">
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

        function editKhusus() {
            if ($('#txtEdit2').html() === 'Edit') {
                $('#txtEdit2').html('Save');
                $('#iconEdit2').removeClass('fa-edit');
                $('#iconEdit2').addClass('fa-save');
                $('#formKhusus input').removeAttr('readonly');
                $('#formKhusus input').addClass('borderEdit');
               
            } else {
                $('#txtEdit2').html('Edit');
                $('#iconEdit2').removeClass('fa-save');
                $('#iconEdit2').addClass('fa-edit');
                $('#formKhusus input').attr('readonly','');
                $('#formKhusus input').removeClass('borderEdit');
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
                        document.getElementById('formKhusus').action = 'editProfilKhusus';
                        document.getElementById('formKhusus').method = 'POST';
                        document.getElementById('formKhusus').submit();
                    // })
                }
            })
            }
          
        }
    </script>
</section>


@endsection