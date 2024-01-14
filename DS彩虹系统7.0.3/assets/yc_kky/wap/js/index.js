$('.swiper-slide a').click(function () {
  $(".product-swiper .swiper-slide ").each(function () {
    $(".product-swiper .swiper-slide .active").removeClass('active')
  });
  $(this).addClass('active')
})

$('.product a').click(function () {
  var navto = $(this).attr('navto');
  if (navto != "#") {
    var $div = $('#' + navto);
    var top = $div.offset().top || 0;
    $('html,body').animate({
      'scroll-top': top - 50
    }, 500);
  } else {
    $('html,body').animate({
      'scroll-top': 0
    }, 500);
  }
});

$(document).ready(function () {
  $('.to_top').click(function () {
    $('html,body').animate({ scrollTop: 0 }, 'slow');
  });
});
