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

  wp.customize('header_logo', function (value) {
    value.bind(function (newval) {
      $('#headerLogo').attr("src", newval);
    });
  });

  wp.customize('about_img', function (value) {
    value.bind(function (newval) {
      $('#aboutImg').attr("src", newval);
    });
  });

  wp.customize('about_text', function (value) {
    value.bind(function (newval) {
      $('#aboutText').html(newval);
    });
  });

  wp.customize('about_title', function (value) {
    value.bind(function (newval) {
      $('#aboutTitle').html(newval);
    });
  });

  wp.customize('newsletter_title', function (value) {
    value.bind(function (newval) {
      $('#newsletterTitle').html(newval);
    });
  });

  wp.customize('historypages_title', function (value) {
    value.bind(function (newval) {
      $('#historypagesTitle').html(newval);
    });
  });

  wp.customize('talks_tagline', function (value) {
    value.bind(function (newval) {
      $('#talksTagline').html(newval);
    });
  });

})(jQuery);