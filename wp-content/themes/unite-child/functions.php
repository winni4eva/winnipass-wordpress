<?php
/**
 * _s functions and definitions
 *
 * @package unite child
 */

/**
 * Register our parent and chile theme styles.
 * 
 * @return null
 */
function my_theme_enqueue_styles() {

    $parent_style = 'unite-style';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'child-style', 
        get_template_directory_uri() . '/style.css', 
        array( $parent_style ), 
        wp_get_theme()->get('Version')
    );
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

/**
 * Register our custom post type Films.
 * 
 * @return null
 */
function create_films_posttype() {
    $labels = array(
        'name' => _x('Films', 'film general name'),
        'singular_name' => _x('Film', 'film singular name'),
        'add_new' => _x('Add New', 'Film'),
        'add_new_item' => __('Add New Film'),
        'edit_item' => __('Edit Film'),
        'new_item' => __('New Film'),
        'all_items' => __('All Films'),
        'view_items' => __('View Film'),
        'search_item' => __('Search Films'),
        'not_found' => __('No films found'),
        'not_found_in_trash' => __('No films found in trash'),
        'parent_item_colon' => ''
    );

    $supports = array(
        'editor',
        'author',
        'custom-fields',
        'post-formats'
    );

    $details = array(
        'labels' => $labels,
        'description' => 'Everyhting you want to know about films',
        'public' => true,
        'menu_position' => 5,
        'supports' => $supports,
        'has_archive' => true,
    );

    register_post_type('film', $details);
}
add_action('init', 'create_films_posttype', 0);


/**
 * Register our genre taxonomy for our Films.
 * 
 * @return null
 */
function create_film_genre_taxonomy() {
 
    $labels = array(
      'name' => _x('Genres', 'film genre'),
      'singular_name' => _x('Genre', 'taxonomy singular name'),
      'search_items' =>  __('Search Genres'),
      'all_items' => __('All Genres'),
      'parent_item' => '',
      'parent_item_colon' => '',
      'edit_item' => __('Edit Genre'), 
      'update_item' => __('Update Genre'),
      'add_new_item' => __('Add New Genre'),
      'new_item_name' => __('New Genre Name'),
      'menu_name' => __('Genres'),
    );
    
    $args =  array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );

    register_taxonomy('genre', array('film'), $args);
}

add_action('init', 'create_film_genre_taxonomy', 0);
