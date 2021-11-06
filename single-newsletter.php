<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}
get_header();

  $pdfUrl = get_post_meta($post->ID, "custom_pdf", true);

?>
<script>
  const currentPdf = '<?php echo $pdfUrl; ?>';
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

<!--Content-->
<div class="container py-5 text-center">

  <?php if ( wp_is_mobile() ) {?>
    <section id="pdfSection">
      <div class="pdf-pagination mb-2">
        <button class="prev-pdf"><<</button>
        <button class="next-pdf">>></button>
      </div>
      <div>
        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
      </div>

      <canvas id="pdf-canvas"></canvas>

      <div class="pdf-pagination mt-4">
        <button class="prev-pdf"><<</button>
        <button class="next-pdf">>></button>
      </div>

      <div class="buttons-wrapper mt-4">
        <a href="<?php echo get_post_meta($post->ID, "custom_pdf", true); ?>" class="btn" target="_blank">Open PDF file</a>
      </div>
    </section>

  <?php } else { ?>

  <div class="content-wrapper">
    <div class="row g-0">
      <div class="col-md-12">
        <div class="post-wrapper">
          <object data="<?php echo get_post_meta($post->ID, "custom_pdf", true); ?>" type="application/pdf" width="100%" height="1024px"></object>
        </div>
        <div class="buttons-wrapper mt-4 text-center">
          <a href="<?php echo get_post_meta($post->ID, "custom_pdf", true); ?>" class="btn" target="_blank">Open PDF file</a>
        </div>
      </div>
    </div>
  </div>


  <?php } ?>


</div>
<!--/Content-->

<?php get_footer(); ?>