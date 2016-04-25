(function ($) {
  jQuery(document).ready(function ($) {
    scroll();
    navScroll();
    hamburger();
    $(window).resize(function(e) {
      resizeFix();
    });
  });
})(jQuery);

var scroll = function () {
  $(".scroll").click(function (event) { // When a link with the .scroll class is clicked
    event.preventDefault(); // Prevent the default action from occurring
    $('html,body').animate({
      scrollTop: $(this.hash).offset().top
    }, 500); // Animate the scroll to this link's href value
  });
};

var hamburger = function() {
  $('.hamburger-menu').on('click', function() {
    $('.bar').toggleClass('animate');
    $('nav .navbar').slideToggle('slow');
  });
};

var resizeFix = function() {
  if ($(window).width() > 720) {
    $('nav .navbar').css({'display': 'flex'});
  } else {
    $('nav .navbar').css({'display': 'none'});
  }
};

var navScroll = function() {
  $(window).on('scroll', function() {
    var vscroll = document.body.scrollTop;
    if (vscroll > 100) {
      $('nav').addClass('sticky-nav');
    } else {
      $('nav').removeClass('sticky-nav');
    }
  });
};
