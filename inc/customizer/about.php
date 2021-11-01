<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

function history_about_customize_register( $wp_customize ) {
  //About section
  $wp_customize->add_section('about_section',array(
    'title'=>'About',
    'priority'=>10,
    'panel'=>'history_customize_panel',
  ));

  //About image setting
  $wp_customize ->add_setting('about_img', array(
    'default' => '',
    'transport' => 'postMessage'
  ));

  //About image control
  $wp_customize ->add_control(new WP_Customize_Image_Control($wp_customize,'about_img_control', array(
    'label'=>'About Image',
    'mime_type' => 'image',
    'section'=>'about_section',
    'settings' => 'about_img',
  ) ));

  //About title setting
  $wp_customize->add_setting('about_title',array(
    'default'=>'About Us',
    'sanitize_callback' => 'wp_kses_post',
    'transport' => 'postMessage'
  ));

  //About title control
  $wp_customize->add_control('about_title_control',array(
    'label'=>'Title',
    'type'=>'text',
    'section'=>'about_section',
    'settings'=>'about_title',
  ));

  //About text setting
  $wp_customize->add_setting('about_text',array(
    'default'=>'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et sapiente praesentium in molestias laborum tempore eius eos reprehenderit tempora quis corporis, est repellat, saepe numquam nulla sequi amet repellendus voluptatem?',
    'sanitize_callback' => 'wp_kses_post',
    'transport' => 'postMessage'
  ));

  //About text control
  $wp_customize->add_control('about_text_control',array(
    'label'=>'Textarea',
    'type'=>'textarea',
    'section'=>'about_section',
    'settings'=>'about_text',
  ));

  //About link setting
  $wp_customize->add_setting('about_id',array(
    'default'=>'',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'refresh'
  ));

  //About link control
  $wp_customize->add_control('about_id_control',array(
    'label'=>'About Page',
    'type'=>'dropdown-pages',
    'section'=>'about_section',
    'settings'=>'about_id',
  ));

}
