<?php function create_post_type_html5() {
  register_post_type('story',
      array(
      'labels' => array(
          'name' => __('Custom Post', ''),
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
      'can_export' => true,
      'taxonomies' => array(
          'community'
      )
    ));

    register_taxonomy_for_object_type('community', '');
}
