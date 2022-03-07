<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

function history_styles_and_scripts() {

  //Dashicons
  wp_enqueue_style('dashicons');

  //libs CSS
  wp_enqueue_style('history-lib-css', get_theme_file_uri('dist/css/libs.min.css'), null, null);

  //main CSS
  wp_enqueue_style('history-main-css', get_theme_file_uri('style.css'), null, microtime());

  //custom CSS
  wp_enqueue_style('history-app-css', get_theme_file_uri('dist/css/all.min.css'), null, microtime());

  if(is_front_page()) {
    //font
    wp_enqueue_style('abril-font', 'https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap', null, null);
  }

  if('newsletter' === get_post_type() || 'will' === get_post_type() || 'history-page' === get_post_type()) {
    //wp_enqueue_script('pdf-app-js', get_theme_file_uri('dist/js/pdf/pdf.min.js'), null, null, false);
    wp_enqueue_script('pdf-app-js', get_theme_file_uri('dist/js/pdf-legacy/pdf.min.js'), null, null, false);
  }

  //custom js
  wp_enqueue_script('history-app-js', get_theme_file_uri('dist/js/all.min.js'), array( 'jquery' ), microtime(), true);

  //masonry js
  wp_enqueue_script('masonry-js', get_theme_file_uri('dist/js/masonry.pkgd.min.js'), null , '' , true);

  //vue
  if (is_page('shop') || is_page('cart') || is_page('product') || is_page('checkout') || is_page('view-order') || is_page('membership')) {
    wp_enqueue_script('vue-js', get_theme_file_uri('dist/js/vue/vue.js'), null , '' , false);
  }

}

function history_customizer_script() {
  //custom js
  wp_enqueue_script('history-customizer-js', get_theme_file_uri('dist/js/theme-customize.min.js'), array( 'jquery','customize-preview' ), null, true);
}

function history_admin_scripts() {
  if (!did_action('wp_enqueue_media')) {
    wp_enqueue_media();
  }

  //metaboxes JS
  wp_enqueue_script('history-pdf-metabox', get_theme_file_uri('dist/admin/js/pdf/pdfMetabox.js'), array('jquery'), null, false);
  wp_enqueue_script('history-gallery-metabox', get_theme_file_uri('dist/admin/js/gallery/galleryMetabox.min.js'), array('jquery'), null, false);

  //admin styles
  wp_enqueue_style('history-app-css', get_theme_file_uri('dist/admin/css/app.min.css'), null, null);

}
