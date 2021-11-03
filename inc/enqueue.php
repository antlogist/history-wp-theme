<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

function history_styles_and_scripts() {
  //libs CSS
  wp_enqueue_style('history-lib-css', get_theme_file_uri('dist/css/libs.min.css'));

  //custom CSS
  wp_enqueue_style('history-app-css', get_theme_file_uri('dist/css/all.min.css'), NULL, microtime());

  //pdf js
  // wp_enqueue_script('pdf-app-js', get_theme_file_uri('dist/js/pdf/pdf.min.js'), null, microtime(), false);
  wp_enqueue_script('pdf-app-js', get_theme_file_uri('dist/js/pdf-legacy/pdf.js'), null, microtime(), false);

  //custom js
  wp_enqueue_script('history-app-js', get_theme_file_uri('dist/js/all.min.js'), array( 'jquery' ), microtime(), true);

  //masonry js
  wp_enqueue_script('masonry-js', get_theme_file_uri('dist/js/masonry.pkgd.min.js'), null , '' , true);
}

function history_customizer_script() {
  //custom js
  wp_enqueue_script('history-customizer-js', get_theme_file_uri('dist/js/theme-customize.min.js'), array( 'jquery','customize-preview' ), microtime(), true);
}
