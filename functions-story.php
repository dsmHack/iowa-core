<?php function create_story_post_type() {
  register_post_type('story',
      array(
      'labels' => array(
          'name' => __('Story', ''),
          'singular_name' => __('Story', ''),
          'add_new' => __('Add New', 'story'),
          'add_new_item' => __('Add New Story', ''),
          'edit' => __('Edit', ''),
          'edit_item' => __('Edit Story', ''),
          'new_item' => __('New Story', ''),
          'view' => __('View Story', ''),
          'view_item' => __('View Story', ''),
          'search_items' => __('Search Story', ''),
          'not_found' => __('No Stories found', ''),
          'not_found_in_trash' => __('No Stories found in Trash', '')
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
      'taxonomies' => array(
          'community'
      )
    ));
}

add_action( 'init', 'create_story_post_type', 0 );

function add_story_taxonomy() {
  $labels = array(
      'name'              => _x( 'Communities', 'taxonomy general name', '' ),
      'singular_name'     => _x( 'Community', 'taxonomy singular name', '' ),
      'search_items'      => __( 'Search Communities', '' ),
      'all_items'         => __( 'All Communities', '' ),
      'parent_item'       => __( 'Parent Community', '' ),
      'parent_item_colon' => __( 'Parent Community:', '' ),
      'edit_item'         => __( 'Edit Community', '' ),
      'update_item'       => __( 'Update Community', '' ),
      'add_new_item'      => __( 'Add New Community', '' ),
      'new_item_name'     => __( 'New Community Name', '' ),
      'menu_name'         => __( 'Communities', '' ),
  );

  $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array('slug' => 'community'),
  );

  register_taxonomy('community', 'story', $args );
}

add_action( 'init', 'add_story_taxonomy', 0 );
