<?php

//Exit if accessed directly
if ( ! defined ('ABSPATH') ) {
    exit;
}

function newsletter_cpt() {
$labels = array(
    'name'                      => _x( 'Newsletters', 'post type general name', 'history' ),
    'singular_name'             => _x( 'Newsletter', 'post type singular name', 'history' ),
    'add_new'                   => _x( 'Add New Newsletter', 'Note item', 'history' ),
    'add_new_item'              => __( 'Add New Newsletter', 'history' ),
    'edit_item'                 => __( 'Edit Newsletter', 'history' ),
    'new_item'                  => __( 'New Newsletter', 'history' ),
    'view_item'                 => __( 'View Newsletter', 'history' ),
    'view_items'                => __( 'View Newsletters', 'history' ),
    'search_items'              => __( 'Search Newsletters', 'history' ),
    'not_found'                 => __( 'No Newsletters found.', 'history' ),
    'not_found_in_trash'        => __( 'No Newsletters found in Trash.', 'history' ),
    'parent_item_colon'         => __( 'Parent Newsletter:', 'history' ),
    'all_items'                 => __( 'All Newsletters', 'history' ),
    'archives'                  => __( 'Newsletter Archive', 'history' ),
    'attributes'                => __( 'Newsletter Attributes', 'history' ),
    'insert_into_item'          => __( 'Insert into Newsletter', 'history' ),
    'uploaded_to_this_item'     => __( 'Uploaded to this Newsletter', 'history' ),
    'featured_image'            => __( 'Newsletter image', 'history' ),
    'set_featured_image'        => __( 'Set Newsletter image', 'history' ),
    'remove_featured_image'     => __( 'Remove Newsletter image', 'history' ),
    'use_featured_image'        => __( 'Use Note image', 'history' ),
    'menu_name'                 => _x( 'Newsletters', 'admin menu', 'history' ),
    'filter_items_list'         => __( 'Filter Newsletters list', 'history' ),
    'items_list_navigation'     => __( 'Newsletters list navigation', 'history' ),
    'items_list'                => __( 'Newsletters list', 'history' ),
    'item_published'            => __( 'Newsletter published', 'history' ),
    'item_published_privately'  =>__( 'Newsletter published privately', 'history' ),
    'item_reverted_to_draft'    =>__( 'Newsletter reveted to draft', 'history' ),
    'item_scheduled'            =>__( 'Newsletter scheduled', 'history' ),
    'item_updated'              =>__( 'Newsletter updated', 'history' ),
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

  register_post_type( 'newsletter', $args );
}
