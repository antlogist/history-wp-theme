<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}
get_header();

?>
<script>
  const pdfUrl = '<?php echo $pdfUrl; ?>';
</script>

<header id="header" style="background-image: url(<?php if (!get_theme_mod('header_img')) {echo get_template_directory_uri() . "/images/header.jpg";} else { echo esc_url(get_theme_mod('header_img'));} ?>)">
  <div class="container header-container">
    <div class="row">
      <div class="col-12">
        <div class="header-title-outer-wrapper">
          <div>
            <h1 class="header-title" id="headerTitle">Newsletters</h1>
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

          <?php

            while(have_posts()) {
              the_post(); ?>

                <div class="post-item mb-4 text-center">
                  <h2 class="newsletter-archive-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                  <a href="<?php the_permalink(); ?>"><img class="w-100 newsletter-archive-post-image" src="<?php echo get_the_post_thumbnail_url(); ?>" alt=""></a>
                </div>

          <?php } ?>



        </div>
      </div>
    </div>
  </div>
</div>
<!--/Content-->

<?php get_footer(); ?>