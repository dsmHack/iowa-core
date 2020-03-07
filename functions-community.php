<?php function create_community_post_type() {
  register_post_type('community',
      array(
      'labels' => array(
          'name' => __('Community', ''),
          'singular_name' => __('community', ''),
          'add_new' => __('Add New', 'community'),
          'add_new_item' => __('Add New community', ''),
          'edit' => __('Edit', ''),
          'edit_item' => __('Edit community', ''),
          'new_item' => __('New community', ''),
          'view' => __('View community', ''),
          'view_item' => __('View community', ''),
          'search_items' => __('Search community', ''),
          'not_found' => __('No Communities found', ''),
          'not_found_in_trash' => __('No Communities found in Trash', '')
      ),
      'public' => true,
      'hierarchical' => true,
      'has_archive' => true,
      'supports' => array(
          'title',
          'editor',
          'excerpt',
          'thumbnail'
      ),
      'menu_position' => 5,
      'can_export' => true,
    ));
}

add_action( 'init', 'create_community_post_type', 0 );
