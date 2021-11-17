<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

function history_customize_register( $wp_customize ) {

  $wp_customize->add_panel('history_customize_panel',array(
      'title'=>'Theme Settings',
      'description'=> 'Theme Settings',
      'priority'=> 10,
  ));


  history_header_customize_register($wp_customize);
  history_about_customize_register($wp_customize);
  history_newsletter_customize_register($wp_customize);
  history_historypages_customize_register($wp_customize);
  history_talks_customize_register($wp_customize);
}