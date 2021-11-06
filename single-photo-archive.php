<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}
get_header();

$gallery = get_post_meta($post->ID, "custom_gallery", true);

?>
<script>
  const singleGallery = true;
</script>

<header id="header" style="background-image: url(<?php if (!get_theme_mod('header_img')) {echo get_template_directory_uri() . "/images/header.jpg";} else { echo esc_url(get_theme_mod('header_img'));} ?>)">
  <div class="container header-container">
    <div class="row">
      <div class="col-12">
        <div class="header-title-outer-wrapper">
          <div>
            <h1 class="header-title" id="headerTitle"><?php echo get_the_title(); ?></h1>
          </div>
        </div>

      </div>
    </div>
  </div>
</header>

<div class="gallery-outer-wrapper">
  <!--Content-->
  <div class="container">
    <div class="content-wrapper">
      <div class="row g-0">
        <div class="col-md-12">
          <div class="post-wrapper">
            <div class="archive-gallery-wrapper text-center">
              <div class="row">
                <?php
                $images = json_decode($gallery);
                foreach(array_reverse($images) as $key => $image) { ?>
                  <div class="col-12 col-md-3 mb-2 d-flex align-items-center p-3">
                    <img data-url="<?php echo $image->url; ?>" class="archive-gallery-img w-100 p-2" src="<?php echo $image->mediumUrl; ?>" alt="">
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/Content-->

  <div class="archive-gallery-modal" style="background-image: url(<?php echo get_template_directory_uri() . '/images/black-linen.png'?>);">
    <div class="container py-5">
      <a href="#" class="close-modal-button">x</a>
      <div class="container archive-gallery-img-container d-flex align-items-center"></div>
    </div>

  </div>
</div>
<?php get_footer(); ?>