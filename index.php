<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}
get_header();

?>
<!--Content-->
<div class="container">
  <div class="content-wrapper">
    <div class="row g-0">
      <div class="col-md-9">
        <div class="post-wrapper">
          <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array( 'post_type' => 'post', 'posts_per_page' => 10, 'paged' => $paged );
            $wp_query = new WP_Query($args);
            while ( have_posts() ) : the_post(); ?>
              <h5><a href="<?php echo esc_url(get_the_permalink());?>"><?php the_title() ?></a></h5>
            <?php endwhile; ?>

          <!-- then the pagination links -->
          <div class="mt-5">
            <?php next_posts_link( 'Older posts &rarr;', $wp_query ->max_num_pages); ?>
            <?php previous_posts_link( '&larr; Newer posts' ); ?>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!--/Content-->

<?php get_footer(); ?>