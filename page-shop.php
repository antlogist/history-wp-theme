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
  <div class="custom-token" data-token="<?php echo Session::get("token"); ?>"></div>

  <div id="shop">

    <div v-if="isLoading" class="loader">
      <div class="row">
        <div class="col-sm-6 col-md-4 mb-3" v-for="item in 6" v-cloak>
          <div class="card">
            <div class="color" style="width: 100%; height: 15rem; background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png')"></div>
            <div class="card-body" style="min-height: 150px;">
              <div class="mb-4 color" style="width: 100%; height: 2rem; background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png')"></div>
              <div class="buttons-wrapper text-center">
                <button class="btn color" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png');" disabled><span class="dashicons dashicons-cart"></span></button>
                <button class="btn color" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png');" disabled><span class="dashicons dashicons-search"></span></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div v-else class="row">
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
              <a href="#" class="btn" style="text-indent: 0;" @click.prevent="addToCart(product.id, product.title, 1, product.price, product.vat_price, product.vat_percent)">
                <span class="dashicons dashicons-cart"><span class="dashicons dashicons-arrow-down-alt adding-in-cart" :class="{active: inCart == product.id }"></span></span>
              </a>
              <a href="#" class="btn" style="text-indent: 0;"><span class="dashicons dashicons-search"></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php get_footer(); ?>