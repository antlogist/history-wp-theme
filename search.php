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
            <h1 class="header-title" id="headerTitle">Search</h1>
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

        <div class="search-form-wrapper mb-5">
          <?php get_search_form(); ?>
        </div>

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

            $search_string = get_search_query();

            $query = new WP_Query( [
              's' => $search_string,
              'posts_per_page' => 5,
              'post_type' => ['post', 'page', 'history-page', 'newsletter'],
              'paged' => $paged
            ] );


            if ( have_posts() ) {
              while($query->have_posts()) {
                $query->the_post(); ?>

                  <div class="post-item mb-5 text-center">
                    <h2 class="newsletter-archive-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <a class="newsletter-archive-post-image-link" href="<?php the_permalink(); ?>"><img class="newsletter-archive-post-image" src="<?php echo get_the_post_thumbnail_url(); ?>" alt=""></a>
                  </div>

              <?php }
            } else {
              echo "<h2 class='text-center py-5'>Sorry, no posts were found.</h2>";
            } ?>

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