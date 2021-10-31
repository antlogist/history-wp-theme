<?php

//Exit if accessed directly
if ( ! defined ("ABSPATH") ) {
  exit;
}

?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<?php

wp_head(); ?>

<script>
  const baseUrl = "<?php echo get_site_url(); ?>";

</script>

<body <?php echo body_id(); body_class(); ?> >

  <!--Nav-->
  <nav id="navMain">
    <!--Nav toggle button-->
    <a href="#" id="navToggleButton">
      <span class="toggle-line toggle-line-1"></span>
      <span class="toggle-line toggle-line-2"></span>
      <span class="toggle-line toggle-line-3"></span>
    </a>
    <div id="navMainWrapper" class="nav-wrapper opacity-0 container">
    </div>
  </nav>

  <!--Header-->
  <header id="header" style="background-image: url(<?php if (!get_theme_mod('header_img')) {echo get_template_directory_uri() . "/images/header.jpg";} else { echo esc_url(get_theme_mod('header_img'));} ?>)">
    <div class="container header-container">
      <div class="row">
        <div class="col-12">
          <div class="header-title-outer-wrapper">
            <img class="header-logo" id="headerLogo" src="<?php if (!get_theme_mod('header_logo')) { echo get_template_directory_uri() . "/images/logo.png"; } else { echo esc_url(get_theme_mod('header_logo')); }; ?>" alt="">
            <h1 class="header-title" id="headerTitle"><?php if (!get_theme_mod("header_title")) {echo "Website title";} else {echo get_theme_mod("header_title");} ?></h1>
          </div>

        </div>
      </div>
    </div>
  </header>
  <!--/Header-->

