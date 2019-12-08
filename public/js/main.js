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
      //  $('#nav'+lok).addClass('active');
    }

}
);

$('.slideHeader').slick({   
    dots: false,
    infinite: true,
    slidesToShow: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows : false ,
    adaptiveHeight: true
  });
          

$('.multiple-items').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    arrows : false 
  });

      $('.multiple-items-media').slick({
          infinite: true,
          slidesToShow: 6,
          slidesToScroll: 6,
          responsive: [
              {
                  breakpoint: 1024,
                  settings: {
                      slidesToShow: 6,
                      slidesToScroll: 6,
                      infinite: true,
                      dots: true,
                      arrows : false
                      }
               },
              {
                  breakpoint: 600,
                  settings: {
                      slidesToShow: 4,
                      slidesToScroll: 4,
                      arrows : false
                  }
              },
              {
                  breakpoint: 480,
                  settings: {
                      slidesToShow: 3,
                      slidesToScroll: 3,
                      arrows : false
                  }
              }
          ]
      });


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
        s = '&&p='+s
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