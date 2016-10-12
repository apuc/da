$(function() {
  $(".mnu-link").click(function(e) {
    e.preventDefault();
    $(".mnu-link").removeClass('active');
    $(this).addClass('active');
  })
});
$(function() {
  $(".menu-link").click(function(e) {
    e.preventDefault();
    $(".menu-link").removeClass('active');
    $(this).addClass('active');
  })
});

$('.more-categories').click(function(event) {
  event.preventDefault();
  $('.category-list-hide').slideToggle();
});
$('.more-categories').click(function(event) {
  event.preventDefault();
  $('.category-list-hide-mob').slideToggle();
});
$(document).ready(function () {
  $('.delivery_list').click(function(){
  $(".cities_list").slideToggle('fast');
  });
  $('ul.cities_list li').click(function(){
  var tx = $(this).html();
  var tv = $(this).attr('alt');
  $(".cities_list").slideUp('fast');
  $(".delivery_list span").html(tx);
  $(".delivery_text").html(tv);
  });

});


var windowWidth = $(window).width();

  $(".toggle_mnu").click(function () {
      $(".sandwich").toggleClass("active");
  });

  if (windowWidth < 769) {
      $(".header__menu_mnu ul a").click(function () {
          $(".header__menu_mnu").fadeOut(600);
          $(".sandwich").toggleClass("active").append("<span>");
      });

      $(".toggle_mnu").click(function () {
          if ($(".header__menu_mnu").is(":visible")) {
              $(".header__menu_mnu").fadeOut(600);
              $(".header__menu_mnu li a").removeClass("fadeInUp animated");
          } else {
              $(".header__menu_mnu").fadeIn(600);
              $(".header__menu_mnu li a").addClass("fadeInUp animated");
          }
      });
  }


