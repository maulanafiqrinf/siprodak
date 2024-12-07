(function ($) {
  "use strict";
  console.clear();
  var contis = {
    init() {
      contis.menuFix(),
        contis.counter(),
        contis.testimonialSlider(),
        contis.toggleMenu(),
        contis.magnificPopup(),
        contis.niceSelect();
    },
    menuFix() {
      if ($(".tf__main_menu").offset() != undefined) {
        $(window).scroll(function () {
          var scrolling = $(this).scrollTop();
          if (scrolling > 120) {
            $(".tf__main_menu").addClass("menu_fix");
          } else {
            $(".tf__main_menu").removeClass("menu_fix");
          }
        });
      }
    },
    counter() {
      $(".counter").countUp();
    },
    testimonialSlider() {
      $(".testi_slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        dots: false,
        arrows: true,
        nextArrow: '<i class="fa-solid fa-arrow-right"></i>',
        prevArrow: '<i class="fa-solid fa-arrow-right"></i>',
      });
    },
    toggleMenu() {
      $(".navbar-toggler").on("click", function () {
        $(".navbar-toggler").toggleClass("show");
      });
    },
    niceSelect() {
      $(".select_js").niceSelect();
    },
    magnificPopup() {
      $(".play_btn").each(function () {
        $(this).magnificPopup({
          type: "iframe",
          mainClass: "mfp-fade",
          preloader: false,
          fixedContentPos: true,
        });
      });
    },
  };
  $(document).ready(function () {
    contis.init();
  });
  document.onreadystatechange = function () {
    if (document.readyState === "complete") {
      // When the page is fully loaded, hide the preloader
      document.getElementById("preloader").style.display = "none";
    }
  };
})(jQuery);
