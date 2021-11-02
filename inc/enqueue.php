<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

function history_styles_and_scripts() {
  //libs CSS
  wp_enqueue_style('history-lib-css', get_theme_file_uri('dist/css/libs.min.css'));

  //custom CSS
  wp_enqueue_style('history-app-css', get_theme_file_uri('dist/css/all.css'), NULL, microtime());

  //pdf js
  wp_enqueue_script('pdf-app-js', get_theme_file_uri('dist/js/pdf.js'), null, microtime(), false);

  //pdf js
  wp_enqueue_script('masonry-js', 'https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js', null, '' , false);

  //custom js
  wp_enqueue_script('history-app-js', get_theme_file_uri('dist/js/all.js'), null, microtime(), true);
}

function history_customizer_script() {
  //custom js
  wp_enqueue_script('history-customizer-js', get_theme_file_uri('dist/js/theme-customize.js'), array( 'jquery','customize-preview' ), microtime(), true);
}
