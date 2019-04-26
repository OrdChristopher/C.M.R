Holder.addTheme ( 'thumb', {
  bg: '#55595c',
  fg: '#eceeef',
  text: 'Thumbnail'
} );

(function ($) {
  "use strict";
  // Auto-scroll
  $('#carouselOfCards').carousel({
    interval: 5000
  });

  // Control buttons
  $('.carousel-control-next').click(function () {
    $('.carousel').carousel('next');
    return false;
  });
  $('.carousel-control-prev').click(function () {
    $('.carousel').carousel('prev');
    return false;
  });

  // On carousel scroll
  $("#carouselOfCards").on("slide.bs.carousel", function (e) {
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 3;
    var totalItems = $(".carousel-item").length;
    if (idx >= totalItems - (itemsPerSlide - 1)) {
      var it = itemsPerSlide -
          (totalItems - idx);
      for (var i = 0; i < it; i++) {
        // append slides to end 
        if (e.direction == "left") {
          $(".carousel-item").eq(i).appendTo(".carousel-inner");
        } else {
          $(".carousel-item").eq(0).appendTo(".carousel-inner");
        }
      }
    }
  });
})
(jQuery);