<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

get_header();

?>

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

<div class="container py-5">
  <div id="shop">
    <div class="row">
      <div class="col-sm-6 col-md-4 mb-3" v-for="product in products" v-cloak>
        <div class="card">
          <a href="#">
            <div :style="{ width: '100%', height: '15rem', backgroundImage: 'url(<?php echo api_url; ?>/uploads/gallerythumb/' + product.thumb.split(',')[0] + ')', backgroundRepeat: 'no-repeat', backgrountPosition:' center center', backgroundSize: 'cover'}"></div>
          </a>
          <div class="card-body text-center" style="min-height: 150px;">
            <a href="#">
              <h5 class="card-title mb-4">{{ product.title }}</h5>
            </a>
            <div class="buttons-wrapper">
              <a href="#" class="btn" style="text-indent: 0;"><span class="dashicons dashicons-cart"></span></a>
              <a href="#" class="btn" style="text-indent: 0;"><span class="dashicons dashicons-search"></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer();

Session::remove("error");
Session::remove("success"); ?>
