@extends('client.client')

@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<div class="row">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-3 bg-pink hover-zoom-effect">
            <div class="icon">
                <i class="fas fa-bell    "></i>
            </div>
            <div class="content">
                <div class="text">NOTIFICATION</div>
                <div class="number">3</div>
            </div>
        </div>

    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-3 bg-red hover-zoom-effect">
            <div class="icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div class="content">
                <div class="text">MEDIA IKLAN</div>
                @foreach ($media as $m)
                 <div class="number">{{$m->count}}</div>
                @endforeach
               
               
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box-3 bg-blue hover-zoom-effect">
            <div class="icon">
                <i class="fa fa-check-square" aria-hidden="true"></i>
            </div>
            <div class="content">
                <div class="text">ASSET DIGUNAKAN</div>
                <div class="number">s</div>
            </div>
        </div>
    </div>
  
</div>

<div class="portlet-body">
    <div>
    
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Update</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
        </ul>
    
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <form>
                  <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control" id="inputName" placeholder="Name">
                  </div>
                    <div class="form-group">
                    <label for="inputLastName">Last Name</label>
                    <input type="text" class="form-control" id="inputLastName" placeholder="Last Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" id="exampleInputFile">
                    <p class="help-block">Example block-level help text here.</p>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> Check me out
                    </label>
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">Profile</div>
            <div role="tabpanel" class="tab-pane" id="messages">Messages</div>
            <div role="tabpanel" class="tab-pane" id="settings">Settings</div>
        </div>
    
    </div>
</div>


@endsection