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
  const themeUrl = "<?php echo get_template_directory_uri(); ?>"

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
