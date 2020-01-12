var first = window.location.pathname.split('/');
var lok = first[2];
// var lok = window.location.pathname.replace('/', '');
$(document).ready(function() {
    if(lok === ''){
        $('.navdashboard').addClass('active');
    }else if(lok === 'profile' ){
        $('.navprofile').addClass('active');
    }else if(lok === 'berlangsung'){
        $('.navberlangsung').addClass('active');
    }else if(lok == 'berjalan'){
        $('.navberjalan').addClass('active');
    }else if(lok == 'history'){
        $('.navhistory').addClass('active');
    }else if(lok == 'notifikasi'){
        $('.navnotifikasi').addClass('active');
    }
    else{
        $('.navdashboard').addClass('active');
    }

});