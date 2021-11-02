<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
    exit;
}

function historypages_cpt() {
$labels = array(
    'name'                      => _x( 'History Pages', 'post type general name', 'history' ),
    'singular_name'             => _x( 'History Page', 'post type singular name', 'history' ),
    'add_new'                   => _x( 'Add New History Page', 'Note item', 'history' ),
    'add_new_item'              => __( 'Add New History Page', 'history' ),
    'edit_item'                 => __( 'Edit History Page', 'history' ),
    'new_item'                  => __( 'New History Page', 'history' ),
    'view_item'                 => __( 'View History Page', 'history' ),
    'view_items'                => __( 'View History Pages', 'history' ),
    'search_items'              => __( 'Search History Pages', 'history' ),
    'not_found'                 => __( 'No History Pages found.', 'history' ),
    'not_found_in_trash'        => __( 'No History Pages found in Trash.', 'history' ),
    'parent_item_colon'         => __( 'Parent History Page:', 'history' ),
    'all_items'                 => __( 'All History Pages', 'history' ),
    'archives'                  => __( 'History Page Archive', 'history' ),
    'attributes'                => __( 'History Page Attributes', 'history' ),
    'insert_into_item'          => __( 'Insert into History Page', 'history' ),
    'uploaded_to_this_item'     => __( 'Uploaded to this History Page', 'history' ),
    'featured_image'            => __( 'History Page image', 'history' ),
    'set_featured_image'        => __( 'Set History Page image', 'history' ),
    'remove_featured_image'     => __( 'Remove History Page image', 'history' ),
    'use_featured_image'        => __( 'Use Note image', 'history' ),
    'menu_name'                 => _x( 'History Pages', 'admin menu', 'history' ),
    'filter_items_list'         => __( 'Filter History Pages list', 'history' ),
    'items_list_navigation'     => __( 'History Pages list navigation', 'history' ),
    'items_list'                => __( 'History Pages list', 'history' ),
    'item_published'            => __( 'History Page published', 'history' ),
    'item_published_privately'  =>__( 'History Page published privately', 'history' ),
    'item_reverted_to_draft'    =>__( 'History Page reveted to draft', 'history' ),
    'item_scheduled'            =>__( 'History Page scheduled', 'history' ),
    'item_updated'              =>__( 'History Page updated', 'history' ),
  );

  $args = array(
    'labels'                    => $labels,
    'public'                    => true,
    'menu_position'             => 11,
    'menu_icon'                 => 'dashicons-archive',
    'supports'                  => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author'),
  );

  register_post_type( 'history-pages', $args );
}
