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
            <h1 class="header-title" id="headerTitle">404</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>


<!--Content-->
<div class="container py-5">
  <div class="content-wrapper">
    <div class="row g-0">
      <div class="col-md-12">
        <div class="post-wrapper">
          <h1 class="text-center">This page is under construction</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/Content-->

<?php get_footer(); ?>