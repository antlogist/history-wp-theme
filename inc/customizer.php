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

  //Header section
  $wp_customize->add_section('header_section',array(
      'title'=>'Header',
      'priority'=>10,
      'panel'=>'history_customize_panel',
  ));

  //Header img setting
  $wp_customize ->add_setting('header_img', array(
      'default' => '',
      'transport' => 'postMessage'
  ));

  //Header img control
  $wp_customize ->add_control(new WP_Customize_Image_Control($wp_customize,'header_img_control', array(
      'label'=>'Header Image',
      'mime_type' => 'image',
      'section'=>'header_section',
      'settings' => 'header_img',
  ) ));

}