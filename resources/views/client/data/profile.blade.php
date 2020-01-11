@extends('client.client')
@section('content')



<style>
   
</style>
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
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                        aria-controls="contact" aria-selected="false">Contact</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <form id="formProfil">
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
                                    <form action="">
                                        <div class="form-group">
                                            <label for="ktp">No. Ktp</label>
                                            <input type="text" class="form-control" readonly id="ktp" name="ktp"
                                                placeholder="ktp" value="{{$p->no_ktp}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nib">NIB</label>
                                            <input type="text" class="form-control" readonly id="nib" name="nib"
                                                placeholder="nib" value="{{$p->nib}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="npwp">NPWP</label>
                                            <input type="text" class="form-control" readonly id="npwp" name="npwp"
                                                placeholder="npwp" value="{{$p->npwp}}">
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    ...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>


@endsection