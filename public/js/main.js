var first = window.location.pathname.split('/');
var lok = first[1];
// var lok = window.location.pathname.replace('/', '');
$(document).ready(function() {
    if(lok === ''){
        $('#navhome').addClass('active');
    }else if(lok === 'registration-client' || lok === 'registration-advertiser' || lok == 'registration'){
        $('#navregistration').addClass('active');
    }else if(lok === 'm' || lok == 'product'){
        $('#navproduct').addClass('active');
    }else if(lok == 'news'){
        $('#navnews').addClass('active');
    }else if(lok == 'login'){
        $('#navlogin').addClass('active');
    }
    else{
      //  $('#nav'+lok).addClass('active');
    }

}
);



function cariProduk() {
    var k = $('#kategori').val();
    var ko = $('#kota').val();
    var s = $('#sort').val();
    var t = $('#txtCari').val();
    var kota = "";
    var kate = "";
    

   

    if(ko !== ""){
        ko = '&&c='+ko;
    }
    if(k !== ''){
        k = 'k='+k;
    }
    if(t !== ''){
        t = '&&t='+t;
    }
    if(s !== ''){
        s = '&&s='+s
    }
    
    var data = k+s+ko+t;
    if(data == ''){
        data = 'd=all'
    }

        document.location = '/product/search?'+data;
   
    // alert(s)
   
}

function cariProdukIndex() {
    var k = $('#kategori').val();
    var ko = $('#kota').val();
    var kota = "";
    var kate = "";
    
    
    if(ko == '' && k == ''){
    }

      

    if(ko !== ""){
        ko = '&&c='+ko;
    }
    if(k !== ''){
        k = 'k='+k;
    }
   
    var data = k+ko;
   
    if(data == ''){
        data = 'd=all'
    }

        document.location = '/product/search?'+data;
 
   
}