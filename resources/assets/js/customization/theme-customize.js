(function ($) {

  wp.customize('header_img', function (value) {
    value.bind(function (newval) {
      $('#header').css("background-image", `url(${newval})`);
    });
  });

})(jQuery);