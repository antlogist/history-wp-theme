(function ($) {

  wp.customize('header_img', function (value) {
    value.bind(function (newval) {
      $('#header').css("background-image", `url(${newval})`);
    });
  });

  wp.customize('header_title', function (value) {
    value.bind(function (newval) {
      $('#headerTitle').html(newval);
    });
  });

  wp.customize('header_logoo', function (value) {
    value.bind(function (newval) {
      $('#headerLogo').attr("src", newval);
    });
  });

})(jQuery);