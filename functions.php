<?php

if (function_exists('add_theme_support')) {
  add_theme_support('menus');
//  add_theme_support('post-thumbnails');
  add_image_size('large', 700, '', true);
  add_image_size('medium', 250, '', true);
  add_image_size('small', 120, '', true);
  add_image_size('custom-size', 700, 200, true);
}

function register_scripts() {
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
    wp_enqueue_script('conditionizr'); // Enqueue it!

    wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1');
    wp_enqueue_script('modernizr');

    wp_register_script('masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array('jquery'), '1.0.0');
    wp_enqueue_script('masonry');

    wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0');
    wp_enqueue_script('scripts');
  }
}
add_action( 'wp_enqueue_scripts', 'register_scripts' );


function register_styles() {
    wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.min.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize');

    wp_register_style('map', get_template_directory_uri() . '/css/map.css', array(), '1.0', 'all');
    wp_enqueue_style('map');

    wp_register_style('story', get_template_directory_uri() . '/css/story.css', array(), '1.0', 'all');
    wp_enqueue_style('story');

    wp_register_style('community', get_template_directory_uri() . '/css/community.css', array(), '1.0', 'all');
    wp_enqueue_style('community');

    wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', array(), '4.4.1', 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('styles', get_template_directory_uri() . '/css/style.css', array(), '1.0', 'all');
    wp_enqueue_style('styles');
}

add_action( 'wp_enqueue_scripts', 'register_styles' );

require_once('functions-story.php');
require_once('functions-community.php');

///* Load Script */
//add_action( 'wp_enqueue_scripts', function(){
//    $url = trailingslashit( plugin_dir_url( __FILE__ ) );
//    wp_register_script( 'my_ajax_script', $url . 'script.js', array( 'jquery' ), '0.1.0', true );
//    wp_localize_script( 'my_ajax_script', 'my_ajax_url', admin_url( 'admin-ajax.php' ) );
//} );
//
///* AJAX Callback */
//add_action( 'wp_ajax_my_ajax_action', function(){
//    $first_name = isset( $_POST['first_name'] ) ? $_POST['first_name'] : 'N/A';
//    $last_name = isset( $_POST['last_name'] ) ? $_POST['last_name'] : 'N/A';
//    echo "Your name is {$first_name} {$last_name}";
//    wp_die();
//} );

function remove_default_post_type() {
    remove_menu_page('edit.php');
}
add_action('admin_menu','remove_default_post_type');

function remove_default_post_type_menu_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'new-post' );
}
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

function remove_draft_widget(){
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}
add_action( 'wp_dashboard_setup', 'remove_draft_widget', 999 );

function custom_new_menu() {
  register_nav_menus(
    array(
      'my-custom-menu' => __( 'My Custom Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'custom_new_menu' );
