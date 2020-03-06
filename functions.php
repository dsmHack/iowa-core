<?php

if (function_exists('add_theme_support')) {
  add_theme_support('menus');
  add_theme_support('post-thumbnails');
  add_image_size('large', 700, '', true);
  add_image_size('medium', 250, '', true);
  add_image_size('small', 120, '', true);
  add_image_size('custom-size', 700, 200, true);
}

function register_scripts() {
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
      wp_enqueue_script('conditionizr'); // Enqueue it!

      wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
      wp_enqueue_script('modernizr'); // Enqueue it!

      wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
      wp_enqueue_script('html5blankscripts'); // Enqueue it!
  }
}
add_action( 'wp_enqueue_scripts', 'register_scripts' );


function register_styles() {
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!
}

add_action( 'wp_enqueue_scripts', 'register_styles' );

require_once('functions-story.php');

