
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