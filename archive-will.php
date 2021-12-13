<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}
get_header();

?>
<script>
  const currentPdf = false;
</script>

<header id="header" style="background-image: url(<?php if (!get_theme_mod('header_img')) {echo get_template_directory_uri() . "/images/header.jpg";} else { echo esc_url(get_theme_mod('header_img'));} ?>)">
  <div class="container header-container">
    <div class="row">
      <div class="col-12">
        <div class="header-title-outer-wrapper">
          <div>
            <h1 class="header-title" id="headerTitle">Wills</h1>
            <h4 style="color: white">To view any wills please register an account online and click to view</h4>
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

        <div class="archive-pagination-wrapper mb-4">
            <?php
              $paginationArgs = array(
                'prev_text'          => '«',
                'next_text'          => '»',
              );
              the_posts_pagination($paginationArgs);
            ?>
          </div>

          <?php

            $query = new WP_Query( [
              'posts_per_page' => 5,
              'post_type' => 'will',
              'paged' => $paged
            ] );

            while($query->have_posts()) {
              $query->the_post(); ?>

                <div class="post-item mb-5 text-center">
                  <h2 class="newsletter-archive-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                  <a class="newsletter-archive-post-image-link" href="<?php the_permalink(); ?>"><img class="newsletter-archive-post-image" src="<?php echo get_the_post_thumbnail_url(); ?>" alt=""></a>
                </div>

          <?php } ?>

          <div class="archive-pagination-wrapper mt-5">
            <?php
              the_posts_pagination($paginationArgs);
            ?>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!--/Content-->

<?php get_footer(); ?>