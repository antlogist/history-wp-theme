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
            if ( have_posts() ) {
            while ( have_posts() ) {
              the_post();

              the_content();

              } // end while
            } // end if
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/Content-->

<?php get_footer(); ?>