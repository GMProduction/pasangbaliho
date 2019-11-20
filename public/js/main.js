var lok = window.location.pathname.replace('/', '');
$(document).ready(function() {
    if(lok === ''){
        $('#navhome').addClass('active');
    }else if(lok === 'registration-client' || lok === 'registration-advertiser'){
        $('#navregistration').addClass('active');
    }else if(lok === 'detail'){
        $('#navproduct').addClass('active');
    }   
    else{
        $('#nav'+lok).addClass('active');
    }

}
);