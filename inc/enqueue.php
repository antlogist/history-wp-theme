<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

function history_styles_and_scripts() {
  //libs CSS
  wp_enqueue_style('history-lib-css', get_theme_file_uri('dist/css/libs.min.css'));

  //custom CSS
  wp_enqueue_style('history-app-css', get_theme_file_uri('dist/css/all.min.css'), null, microtime());

  //pdf js
  if(is_front_page() || 'newsletter' === get_post_type()) {
    // wp_enqueue_script('pdf-app-js', get_theme_file_uri('dist/js/pdf/pdf.min.js'), null, microtime(), false);
    wp_enqueue_script('pdf-app-js', get_theme_file_uri('dist/js/pdf-legacy/pdf.min.js'), null, microtime(), false);
  }

  //custom js
  wp_enqueue_script('history-app-js', get_theme_file_uri('dist/js/all.js'), array( 'jquery' ), microtime(), true);

  //masonry js
  wp_enqueue_script('masonry-js', get_theme_file_uri('dist/js/masonry.pkgd.min.js'), null , '' , true);

  //VUE for CPT
  // if ('newsletter' === get_post_type()) {
  //   if (wp_script_is(get_theme_file_uri('dist/js/vue/vue.js'), 'enqueued')) {
  //     return;
  //   } else {
  //     wp_enqueue_script('vue-js', get_theme_file_uri('dist/js/vue/vue.js'), null , '' , false);
  //   }
  // }

}

function history_customizer_script() {
  //custom js
  wp_enqueue_script('history-customizer-js', get_theme_file_uri('dist/js/theme-customize.min.js'), array( 'jquery','customize-preview' ), microtime(), true);
}

function history_admin_scripts() {
  if (!did_action('wp_enqueue_media')) {
    wp_enqueue_media();
  }

  //metaboxes JS
  wp_enqueue_script('history-pdf-metabox', get_theme_file_uri('dist/admin/js/pdf/pdfMetabox.js'), array('jquery'), microtime(), false);
  wp_enqueue_script('history-gallery-metabox', get_theme_file_uri('dist/admin/js/gallery/galleryMetabox.js'), array('jquery'), microtime(), false);

  //admin styles
  wp_enqueue_style('history-app-css', get_theme_file_uri('dist/admin/css/app.min.css'), null, microtime());

}
