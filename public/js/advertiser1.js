var first = window.location.pathname.split('/');
var lok = first[2];
var lok1 = first[1];
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
    }else if(lok1 == 'payment'){
        $('.navberlangsung').addClass('active');
    }
    else{
        $('.navdashboard').addClass('active');
    }

});

function showImgBukti(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imgButi')
                    .attr('src', e.target.result);
            // .width(200)
            // .height(200);
        };
        reader.readAsDataURL(input.files[0]);
        showSave();
    }

    function showSave() {
        if($('#poto').val !== null){
            $('#btnSaveFoto').removeAttr('hidden');
        }else{
            $('#btnSaveFoto').attr('hidden','');
        }
    }

}
