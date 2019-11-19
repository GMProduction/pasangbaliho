@extends('advertiser.advertiser')

@section('content')

<section id="contact-page" style="padding-top: 0px">
    <div class="">
        <div class="section-heading text-center">
            <h2><span>Add Product</span></h2>
        </div>
        <div class="row contact-wrap">
            <div class="status alert alert-success" style="display: none"></div>
            <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Jenis Media *</label>
                        <input type="text" name="name" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label>Orientasi *</label>
                        <input type="text" name="email" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label>Ukuran</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Lighting *</label>
                        <input type="text" name="subject" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label>Venue *</label>
                        <textarea name="message" id="message" required="required" class="form-control"
                            rows="8"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-default submit-button">Submit Message <i
                                class="fa fa-caret-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection