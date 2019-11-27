@extends('client.clietn')
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
    
</style>
<link rel="stylesheet" href="{{asset('css/profile.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/main.css')}}"> --}}
<section id="contact-page" style="">
    <div class=" backgroundGreen pb-1" style="">
        <h4 class="text-center pt-1 text-white">Profile</h4>
    </div>


    <div class="backgroundGray" style="">
        <div class="">
            <div class="row p-3" style="">
                <div class="col-md-4 ">
                    <div class="portlet light profile-sidebar-portlet bordered">

                        <div class="profile-userpic">
                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-responsive" alt="">
                        </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">  </div>
                            <div class="profile-usertitle-job"> Advertiser </div>
                        </div>
                        <div class="profile-userbuttons pb-4">
                            <input type="file" class="small">
                            <button type="submit" class="btn btn-sm btn-info">Save</button>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="portlet light bordered">
                       
                        <div class="portlet-body">
                            <div>
                                <h6 class="text-right m-0 p-0"><a href=""><i class="fas fa-edit    "></i></a></h6>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#profile" aria-controls="profile"
                                            role="tab" data-toggle="tab">Profile</a></li>
                                  
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="profile">
                                        <form>
                                            <div class="form-group">
                                                <label for="inputName">Name</label>
                                                <input type="text" class="form-control" readonly id="inputName"
                                                    placeholder="Name" value="">
                                            </div>
                                           
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control"readonly id="exampleInputEmail1"
                                                    placeholder="Email" value="">
                                            </div>
                                            <div class="form-group">
                                                    <label for="inputLastName">Address</label>
                                                    <textarea name="" class="form-control" readonly id="" cols="30" rows="4" placeholder="Address"></textarea>
                                                </div>
                                            
                                            <button type="submit" class="btn btn-default">Submit</button>
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
</section>

@endsection