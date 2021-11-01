<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

function history_about_customize_register( $wp_customize ) {
  //Header section
  $wp_customize->add_section('about_section',array(
    'title'=>'About',
    'priority'=>10,
    'panel'=>'history_customize_panel',
  ));

  //Header shop link setting
  $wp_customize->add_setting('about_id',array(
    'default'=>'',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'refresh'
  ));

  //Header shop link control
  $wp_customize->add_control('shop_id_control',array(
    'label'=>'About Page',
    'type'=>'dropdown-pages',
    'section'=>'about_section',
    'settings'=>'about_id',
  ));


}
