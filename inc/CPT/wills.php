<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
    exit;
}

function will_cpt() {
$labels = array(
    'name'                      => _x( 'Wills', 'post type general name', 'history' ),
    'singular_name'             => _x( 'Will', 'post type singular name', 'history' ),
    'add_new'                   => _x( 'Add New Will', 'Note item', 'history' ),
    'add_new_item'              => __( 'Add New Will', 'history' ),
    'edit_item'                 => __( 'Edit Will', 'history' ),
    'new_item'                  => __( 'New Will', 'history' ),
    'view_item'                 => __( 'View Will', 'history' ),
    'view_items'                => __( 'View Wills', 'history' ),
    'search_items'              => __( 'Search Wills', 'history' ),
    'not_found'                 => __( 'No Wills found.', 'history' ),
    'not_found_in_trash'        => __( 'No Wills found in Trash.', 'history' ),
    'parent_item_colon'         => __( 'Parent Will:', 'history' ),
    'all_items'                 => __( 'All Wills', 'history' ),
    'archives'                  => __( 'Will Archive', 'history' ),
    'attributes'                => __( 'Will Attributes', 'history' ),
    'insert_into_item'          => __( 'Insert into Will', 'history' ),
    'uploaded_to_this_item'     => __( 'Uploaded to this Will', 'history' ),
    'featured_image'            => __( 'Will image', 'history' ),
    'set_featured_image'        => __( 'Set Will image', 'history' ),
    'remove_featured_image'     => __( 'Remove Will image', 'history' ),
    'use_featured_image'        => __( 'Use Note image', 'history' ),
    'menu_name'                 => _x( 'Wills', 'admin menu', 'history' ),
    'filter_items_list'         => __( 'Filter Wills list', 'history' ),
    'items_list_navigation'     => __( 'Wills list navigation', 'history' ),
    'items_list'                => __( 'Wills list', 'history' ),
    'item_published'            => __( 'Will published', 'history' ),
    'item_published_privately'  =>__( 'Will published privately', 'history' ),
    'item_reverted_to_draft'    =>__( 'Will reveted to draft', 'history' ),
    'item_scheduled'            =>__( 'Will scheduled', 'history' ),
    'item_updated'              =>__( 'Will updated', 'history' ),
  );

  $args = array(
    'labels'                    => $labels,
    'public'                    => true,
    'menu_position'             => 11,
    'menu_icon'                 => 'dashicons-text-page',
    'supports'                  => array( 'title', 'thumbnail'),
    'has_archive'               => true
    // 'show_in_rest'              => true,
  );

  register_post_type( 'will', $args );
}
