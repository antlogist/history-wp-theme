
<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}
get_header();

?>
<section id="frontAbout">
  <div class="container">
    <div class="row">
      <div class="col-md-6 order-md-2">
        <div class="mt-4 mb-2">
          <img id="aboutImg" class="w-100" src="<?php if (!get_theme_mod('about_img')) { echo get_template_directory_uri() . "/images/logo.png"; } else { echo esc_url(get_theme_mod('about_img')); }; ?>" alt="">
        </div>
      </div>
      <div class="col-md-6 order-md-1 d-flex align-items-center">
        <div class="mt-2 mb-4">
          <h1 id="aboutTitle">
            <?php if (!get_theme_mod('about_title')) {
              echo "About Us";
            } else { echo get_theme_mod('about_title'); }; ?>
          </h1>
          <div id="aboutText" class="text-wrapper">
            <?php if (!get_theme_mod('about_text')) {
              echo "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et sapiente praesentium in molestias laborum tempore eius eos reprehenderit tempora quis corporis, est repellat, saepe numquam nulla sequi amet repellendus voluptatem?";
            } else { echo get_theme_mod('about_text'); }; ?>
          </div>
          <div class="buttons-wrapper mt-4">
            <a href="<?php if (!get_theme_mod('about_id')) { echo "./"; } else { echo esc_url( get_permalink(get_theme_mod('about_id')) ); } ?>" class="btn">Learn more</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php

get_footer();

?>
