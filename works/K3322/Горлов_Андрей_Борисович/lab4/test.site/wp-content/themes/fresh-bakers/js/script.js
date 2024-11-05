/* ===============================================
	OWL CAROUSEL SLIDER
=============================================== */

jQuery('document').ready(function(){
  var owl = jQuery('.slider .owl-carousel');
    owl.owlCarousel({
    margin:20,
    nav: true,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 3000,
    loop: false,
    dots:false,
    navText : ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i> '],
    responsive: {
      0: {
        items: 1,
        nav: false
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    },
    autoplayHoverPause : true,
    mouseDrag: true
  });
});

/* ===============================================
  OWL CAROUSEL BLOG SECTION
=============================================== */

jQuery('document').ready(function(){
  var owl = jQuery('#trending .owl-carousel');
    owl.owlCarousel({
    margin:30,
    nav: false,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 3000,
    loop: false,
    dots: true,
    navText : ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i> '],
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1000: {
        items: 4
      }
    },
    autoplayHoverPause : true,
    mouseDrag: true
  });
});


/* ===============================================
  OPEN CLOSE MENU
============================================= */

function fresh_bakers_open_menu() {
  jQuery('button.toggle-menu').addClass('close-panal');
  setTimeout(function(){
    jQuery('.main-menu').show();
  }, 100);

  return false;
}

jQuery( "button.toggle-menu").on("click", fresh_bakers_open_menu);

function fresh_bakers_close_menu() {
  jQuery('button.close-menu').removeClass('close-panal');
  jQuery('.main-menu').hide();
}

jQuery( "button.close-menu").on("click", fresh_bakers_close_menu);

/* ===============================================
  TRAP TAB FOCUS ON MODAL MENU
============================================= */

jQuery('button.close-menu').on('keydown', function (e) {
  if (jQuery("this:focus") && (e.which === 9)) {
    e.preventDefault();
    jQuery(this).blur();
    jQuery('button.toggle-menu').focus();
  }
});

/* ===============================================
  SCROLL TOP
============================================= */

jQuery(window).scroll(function () {
  if (jQuery(this).scrollTop() > 100) {
    jQuery('.scroll-up').fadeIn();
  } else {
    jQuery('.scroll-up').fadeOut();
  }
});

jQuery('a[href="#tobottom"]').click(function () {
  jQuery('html, body').animate({scrollTop: 0}, 'slow');
  return false;
});

/*===============================================
 PRELOADER
=============================================== */

jQuery('document').ready(function($){
  setTimeout(function () {
    jQuery(".cssloader").fadeOut("slow");
  },1000);
});

/* ===============================================
  STICKY-HEADER
============================================= */

jQuery(window).scroll(function () {
  var sticky = jQuery('.sticky-header'),
  scroll = jQuery(window).scrollTop();

  if (scroll >= 100) sticky.addClass('fixed-header');
  else sticky.removeClass('fixed-header');
});