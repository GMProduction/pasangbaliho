
$(document).ready(function(){
  
    $(".Modern-Slider").slick({
      autoplay:true,
      autoplaySpeed:10000,
      speed:600,
      slidesToShow:1,
      slidesToScroll:1,
      pauseOnHover:false,
      dots:true,
      pauseOnDotsHover:true,
      cssEase:'linear',
     // fade:true,
      draggable:false,
      prevArrow:'<button class="PrevArrow"></button>',
      nextArrow:'<button class="NextArrow"></button>', 
    });
    



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

      $('.related-media').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 5,
        infinite: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: false,
                    dots: true,
                    arrows : false
                    }
             },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: false,
                    arrows : false
                    
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: false,
                    arrows : false
                }
            }
        ]
    });

    })