<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

include_once(get_template_directory() . '/inc/app/Classes/Request.php');
if(!Request::all()->get->id) {
  Redirect::to(get_home_url());
  exit;
}
$productSlug = Request::all()->get->id;


get_header();

?>

<script>
  const productSlug = "<?php echo $productSlug; ?>";
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

<div class="container py-5">
  <div class="custom-token" data-token="<?php echo Session::get("token"); ?>"></div>
  <div id="product">

    <div v-if="isFirstLoading" class="loader">

      <div class="row">

        <div class="col-md-4">
          <div class="img-wrapper">
            <div class="color" style="width: 100%; height: 503px; background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png')"></div>
          </div>
        </div>

        <div class="col-md-8">
          <h2><div class="color" style="width: 100%; height: 38px; background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png')"></div></h2>
          <div class="color mb-4" style="width: 100%; height: 100px; background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png')"></div>
          <div class="buttons-wrapper my-3">
            <div class="color" style="width: 150px; height: 38px; background-image: url('<?php echo get_template_directory_uri(); ?>/images/fabric-plaid.png')"></div>
          </div>
        </div>

      </div>

    </div>

    <div v-else class="row">
      <div class="col-md-4">
        <div class="img-wrapper">
          <img v-if="product.thumb" style="width: 100%" :src="'<?php echo api_url; ?>/uploads/gallerythumb/' + product.thumb.split(',')[0]">
        </div>
      </div>
      <div class="col-md-8 mt-4 mt-md-0">
        <h2>{{ currency }}{{ product.price }}</h2>
        <div class="descr mb-4" v-html="product.description"></div>
        <div class="buttons-wrapper">
          <a href="#" class="btn" style="text-indent: 0;" @click.prevent="addToCart(product.id, product.title, 1, product.price, product.vat_price, product.vat_percent)">
            <span class="dashicons dashicons-cart"><span class="dashicons dashicons-arrow-down-alt adding-in-cart" :class="{active: inCart == product.id }"></span></span>
            <span style="line-height: 20px;">Add to cart</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">

  </div>

</div>

<?php get_footer(); ?>

