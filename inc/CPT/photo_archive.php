<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
    exit;
}

function photoarchive_cpt() {
$labels = array(
    'name'                      => _x( 'Photo Archives', 'post type general name', 'history' ),
    'singular_name'             => _x( 'Photo Archive', 'post type singular name', 'history' ),
    'add_new'                   => _x( 'Add New Photo Archive', 'Note item', 'history' ),
    'add_new_item'              => __( 'Add New Photo Archive', 'history' ),
    'edit_item'                 => __( 'Edit Photo Archive', 'history' ),
    'new_item'                  => __( 'New Photo Archive', 'history' ),
    'view_item'                 => __( 'View Photo Archive', 'history' ),
    'view_items'                => __( 'View Photo Archives', 'history' ),
    'search_items'              => __( 'Search Photo Archives', 'history' ),
    'not_found'                 => __( 'No Photo Archives found.', 'history' ),
    'not_found_in_trash'        => __( 'No Photo Archives found in Trash.', 'history' ),
    'parent_item_colon'         => __( 'Parent Photo Archive:', 'history' ),
    'all_items'                 => __( 'All Photo Archives', 'history' ),
    'archives'                  => __( 'Photo Archive Archive', 'history' ),
    'attributes'                => __( 'Photo Archive Attributes', 'history' ),
    'insert_into_item'          => __( 'Insert into Photo Archive', 'history' ),
    'uploaded_to_this_item'     => __( 'Uploaded to this Photo Archive', 'history' ),
    'featured_image'            => __( 'Photo Archive image', 'history' ),
    'set_featured_image'        => __( 'Set Photo Archive image', 'history' ),
    'remove_featured_image'     => __( 'Remove Photo Archive image', 'history' ),
    'use_featured_image'        => __( 'Use Note image', 'history' ),
    'menu_name'                 => _x( 'Photo Archives', 'admin menu', 'history' ),
    'filter_items_list'         => __( 'Filter Photo Archives list', 'history' ),
    'items_list_navigation'     => __( 'Photo Archives list navigation', 'history' ),
    'items_list'                => __( 'Photo Archives list', 'history' ),
    'item_published'            => __( 'Photo Archive published', 'history' ),
    'item_published_privately'  =>__( 'Photo Archive published privately', 'history' ),
    'item_reverted_to_draft'    =>__( 'Photo Archive reveted to draft', 'history' ),
    'item_scheduled'            =>__( 'Photo Archive scheduled', 'history' ),
    'item_updated'              =>__( 'Photo Archive updated', 'history' ),
  );

  $args = array(
    'labels'                    => $labels,
    'public'                    => true,
    'menu_position'             => 11,
    'menu_icon'                 => 'dashicons-camera-alt',
    'supports'                  => array( 'title', 'thumbnail'),
    'has_archive'               => true
    // 'show_in_rest'              => true,
  );

  register_post_type( 'photo-archive', $args );
}
