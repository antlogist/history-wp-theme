<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
  exit;
}

function history_talks_customize_register( $wp_customize ) {
  //Talks section
  $wp_customize->add_section('talks_section',array(
    'title'=>'Talks',
    'priority'=>10,
    'panel'=>'history_customize_panel',
  ));

  //Talks text setting
  $wp_customize->add_setting('talks_tagline',array(
    'default'=>'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Et sapiente praesentium in molestias laborum tempore eius eos reprehenderit tempora quis corporis, est repellat, saepe numquam nulla sequi amet repellendus voluptatem?',
    'sanitize_callback' => 'wp_kses_post',
    'transport' => 'postMessage'
  ));

  //Talks text control
  $wp_customize->add_control('talks_tagline_control',array(
    'label'=>'Textarea',
    'type'=>'textarea',
    'section'=>'talks_section',
    'settings'=>'talks_tagline',
  ));

    //Talks link setting
    $wp_customize->add_setting('talks_id',array(
      'default'=>'',
      'sanitize_callback' => 'sanitize_text_field',
      'transport' => 'refresh'
    ));

    //Talks link control
    $wp_customize->add_control('talks_id_control',array(
      'label'=>'Talks Page',
      'type'=>'dropdown-pages',
      'section'=>'talks_section',
      'settings'=>'talks_id',
    ));

}