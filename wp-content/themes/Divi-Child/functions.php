<?php
function child_theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
    wp_enqueue_script('pause-carousel', get_template_directory_uri() . '/js/pause-carousel.js' );
}
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );

function custom_global_styles(){
    wp_enqueue_style( 'font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'custom_global_styles' );

function register_custom_nav_menus() {
    register_nav_menus( array(
        'contact_us_menu' => 'Contact Us Menu'
    ) );
}
add_action( 'after_setup_theme', 'register_custom_nav_menus' );

function filter_archive_posts_by_category($query) {
    $cat_id = filter_input( INPUT_GET, 'cat_id', FILTER_VALIDATE_INT );
    if (!is_admin() // Target only the front end
        && $query->is_main_query() // Target only the main query
        && $query->is_date() // Only target the date archive pages
        && $cat_id // Only run the condition if we have a valid ID
    ) {

        $query->set( 'cat', $cat_id );

    }
}

add_action( 'pre_get_posts', 'filter_archive_posts_by_category' );