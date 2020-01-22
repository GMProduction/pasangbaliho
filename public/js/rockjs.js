//GRAZFEED
$('#myTab a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  })
  
  //NAVBAR DROPDOWN
  $('ul.navbar-nav li.dropdown').click(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
  });
  
  //RESPONSIVE IMAGE
  $(document).ready( function() {
    $('img').addClass( 'img-fluid' );
  } );
  
  //DATA TABLES
  $(document).ready(function(){
  $("#dataTable").DataTable({
    "ordering" : false,
    "lengthChange": false,
    "language": {
              "decimal":        "",
          "emptyTable":     "Data Tidak Ditemukan",
          "info":           "_START_ - _END_ / _TOTAL_",
          "infoEmpty":      "",
          "infoFiltered":   "(filtered from _MAX_ total entries)",
          "infoPostFix":    "",
          "thousands":      ",",
          "lengthMenu":     "_MENU_",
          "loadingRecords": "Memuat...",
          "processing":     "Processing...",
          "search":         "Cari:",
          "zeroRecords":    "Data Tidak Ditemukan",
          "paginate": {
              "first":      "Awal",
              "last":       "Akhir",
              "next":       ">>",
              "previous":   "<<"
          },
          "aria": {
              "sortAscending":  ": activate to sort column ascending",
              "sortDescending": ": activate to sort column descending"
          }
          }
  
      });
  });
  //LOAD MORE
  $(document).ready(function(){
      $(document).on('click','.show_more',function(){
          var ID = $(this).attr('id');
          $('.loading').show();
          $('.show_more_main').hide();
          $.ajax({
              type:'POST',
              url :'asset/ajax/last-media.php',
              data:'id='+ID,
              success:function(html){
                  $('#show_more_main'+ID).remove();
                  $('.postList').append(html);
                  //$('.show_more_main').hide();
              }
          });
      });
  });
  //STICK SCROLL
  $(function() {
      var offset = $(".stick").offset();
      var topPadding = 15;
      $(window).scroll(function() {
          if ($(window).scrollTop() > offset.top) {
              $(".stick").stop().animate({
                  marginTop: $(window).scrollTop() - offset.top + topPadding
              });
          } else {
              $(".stick").stop().animate({
                  marginTop: 0
              });
          };
      });
  });
  
  //DISQUSS
  (function() { // DON'T EDIT BELOW THIS LINE
  var d = document, s = d.createElement('script');
  s.src = 'https://http-makro-id.disqus.com/embed.js';
  s.setAttribute('data-timestamp', +new Date());
  (d.head || d.body).appendChild(s);
  })();
  
  //REMOVE CLASS ON SCREEN
  jQuery(document).ready(function($) {
    var alterClass = function() {
      var ww = document.body.clientWidth;
      if (ww < 400) {
        $('.stick').removeClass('stick');
        $('.featcard').removeClass('pl-3');
        $('.featcard').removeClass('pr-1');
      } else if (ww >= 401) {
        $('.stick').addClass('stick');
      };
    };
    $(window).resize(function(){
      alterClass();
    });
    //Fire it when the page first loads:
    alterClass();
  });
  
  // SCROLL TO TOP//
  (function(){
      // Back to Top - by CodyHouse.co
        var backTop = document.getElementsByClassName('js-cd-top')[0],
          // browser window scroll (in pixels) after which the "back to top" link is shown
          offset = 300,
          //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
          offsetOpacity = 1200,
          scrollDuration = 700
          scrolling = false;
        if( backTop ) {
          //update back to top visibility on scrolling
          window.addEventListener("scroll", function(event) {
            if( !scrolling ) {
              scrolling = true;
              (!window.requestAnimationFrame) ? setTimeout(checkBackToTop, 250) : window.requestAnimationFrame(checkBackToTop);
            }
          });
          //smooth scroll to top
          backTop.addEventListener('click', function(event) {
            event.preventDefault();
            (!window.requestAnimationFrame) ? window.scrollTo(0, 0) : scrollTop(scrollDuration);
          });
        }
  
        function checkBackToTop() {
          var windowTop = window.scrollY || document.documentElement.scrollTop;
          ( windowTop > offset ) ? addClass(backTop, 'cd-top--show') : removeClass(backTop, 'cd-top--show', 'cd-top--fade-out');
          ( windowTop > offsetOpacity ) && addClass(backTop, 'cd-top--fade-out');
          scrolling = false;
        }
        
        function scrollTop(duration) {
            var start = window.scrollY || document.documentElement.scrollTop,
                currentTime = null;
                
            var animateScroll = function(timestamp){
              if (!currentTime) currentTime = timestamp;        
                var progress = timestamp - currentTime;
                var val = Math.max(Math.easeInOutQuad(progress, start, -start, duration), 0);
                window.scrollTo(0, val);
                if(progress < duration) {
                    window.requestAnimationFrame(animateScroll);
                }
            };
  
            window.requestAnimationFrame(animateScroll);
        }
  
        Math.easeInOutQuad = function (t, b, c, d) {
          t /= d/2;
          if (t < 1) return c/2*t*t + b;
          t--;
          return -c/2 * (t*(t-2) - 1) + b;
        };
  
        //class manipulations - needed if classList is not supported
        function hasClass(el, className) {
            if (el.classList) return el.classList.contains(className);
            else return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
        }
        function addClass(el, className) {
          var classList = className.split(' ');
          if (el.classList) el.classList.add(classList[0]);
          else if (!hasClass(el, classList[0])) el.className += " " + classList[0];
          if (classList.length > 1) addClass(el, classList.slice(1).join(' '));
        }
        function removeClass(el, className) {
          var classList = className.split(' ');
            if (el.classList) el.classList.remove(classList[0]);  
            else if(hasClass(el, classList[0])) {
              var reg = new RegExp('(\\s|^)' + classList[0] + '(\\s|$)');
              el.className=el.className.replace(reg, ' ');
            }
            if (classList.length > 1) removeClass(el, classList.slice(1).join(' '));
        }
      })();
  
  //MEDIA POST
  jQuery(document).ready(function($) {
    $('#media-post').carousel({
                  interval: false
          });
  //Handles the carousel thumbnails
          $('[id^=carousel-selector-]').click( function(){
            var id_selector = $(this).attr("id");
            var id = id_selector.substr(id_selector.length -1);
            var id = parseInt(id);
            $('#media-post').carousel(id);
    });
  });
  
  //FEATURED CAROUSEL
    jQuery(document).ready(function($) {
    $('#featured').carousel({
                  interval: 5000
          });
  });
  
  //FEATURED HOVER
  $(document).ready(function(){
        $(".linkfeat").hover(
          function () {
              $(".textfeat").show(500);
          },
          function () {
              $(".textfeat").hide(500);
          }
      );
  });
  
  //SOCIAL SHARER
  // Opens a pop-up with twitter sharing dialog
  function twitter() {
  var url  = window.location.href;
  var text = "";
  window.open('http://twitter.com/share?url='+encodeURIComponent(url)+'&text='+encodeURIComponent(text), '', 'left=0,top=0,width=550,height=450,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
  }
  function fb() {
  var url  = window.location.href;
  var text = "";
  window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(url)+'&text='+encodeURIComponent(text), '', 'left=0,top=0,width=550,height=450,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
  }
  function gplus() {
  var url  = window.location.href;
  var text = "";
  window.open('https://plus.google.com/share?url='+encodeURIComponent(url)+'&text='+encodeURIComponent(text), '', 'left=0,top=0,width=550,height=450,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
  }
  function whats() {
  var url  = window.location.href;
  var text = "";
  window.open('whatsapp://send?text='+encodeURIComponent(url)+'&text='+encodeURIComponent(text), '', 'left=0,top=0,width=550,height=450,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
  }