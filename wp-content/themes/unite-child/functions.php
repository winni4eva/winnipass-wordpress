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
function my_theme_enqueue_styles() 
{

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
function create_films_posttype() 
{
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
        'title',
        'editor',
        'author',
        'custom-fields',
        'post-formats',
        'thumbnail'
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
function create_film_genre_taxonomy() 
{
 
    $labels = array(
      'name' => _x('Genre', 'film genre'),
      'singular_name' => _x('Genre', 'film singular name'),
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

/**
 * Register our film taxonomy for our Films.
 * 
 * @return null
 */
function create_film_country_taxonomy() 
{
 
    $labels = array(
      'name' => _x('Country', 'film country'),
      'singular_name' => _x('Country', 'country singular name'),
      'search_items' =>  __('Search Countries'),
      'all_items' => __('All Countries'),
      'parent_item' => '',
      'parent_item_colon' => '',
      'edit_item' => __('Edit Country'), 
      'update_item' => __('Update Country'),
      'add_new_item' => __('Add New Country'),
      'new_item_name' => __('New Country Name'),
      'menu_name' => __('Countries'),
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

    register_taxonomy('country', array('film'), $args);
}

add_action('init', 'create_film_country_taxonomy', 0);


/**
 * Register our year taxonomy for our Films.
 * 
 * @return null
 */
function create_film_year_taxonomy() 
{
 
    $labels = array(
      'name' => _x('Year', 'film year'),
      'singular_name' => _x('Year', 'year singular name'),
      'search_items' =>  __('Search Year'),
      'all_items' => __('All Years'),
      'parent_item' => '',
      'parent_item_colon' => '',
      'edit_item' => __('Edit Year'), 
      'update_item' => __('Update Year'),
      'add_new_item' => __('Add New Year'),
      'new_item_name' => __('New Year Name'),
      'menu_name' => __('Year'),
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

    register_taxonomy('year', array('film'), $args);
}

add_action('init', 'create_film_year_taxonomy', 0);

/**
 * Register our actor taxonomy for our Films.
 * 
 * @return null
 */
function create_film_actor_taxonomy() 
{
 
    $labels = array(
      'name' => _x('Actors', 'film actor'),
      'singular_name' => _x('Actor', 'actor singular name'),
      'search_items' =>  __('Search Actor'),
      'all_items' => __('All Actors'),
      'parent_item' => '',
      'parent_item_colon' => '',
      'edit_item' => __('Edit Actor'), 
      'update_item' => __('Update Actor'),
      'add_new_item' => __('Add New Actor'),
      'new_item_name' => __('New Actor Name'),
      'menu_name' => __('Actors'),
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

    register_taxonomy('actor', array('film'), $args);
}

add_action('init', 'create_film_actor_taxonomy', 0);

/**
 * Register our film ticket price custom meta box.
 * 
 * @return null
 */
function ticket_price_meta_box()
{
    add_meta_box( 
        'ticket_price_01', 
        'Ticket Price', 
        'ticket_price_meta_box_field', 
        'film', 
        'normal', 
        'high' 
    );
}

function ticket_price_meta_box_field()  
{  
    global $post;

    $data = get_post_custom($post->ID);
    $val = isset($data['ticket_price'])
                ? esc_attr($data['ticket_price'][0])
                : 'no value';

    echo '<input type="text" id="ticket_price" name="ticket_price" value="'.$val.'"/>';    
} 

add_action('add_meta_boxes', 'ticket_price_meta_box');

/**
 * Register our film release date custom meta box.
 * 
 * @return null
 */
function release_date_meta_box()
{
    add_meta_box( 
        'release_date_01', 
        'Release Date', 
        'release_date_meta_box_field', 
        'film', 
        'normal', 
        'high' 
    );
}

function release_date_meta_box_field()  
{  
    global $post;

    $data = get_post_custom($post->ID);
    $val = isset($data['release_date'])
                ? esc_attr($data['release_date'][0])
                : 'no value';

    echo '<input type="text" id="release_date" name="release_date" value="'.$val.'"/>';    
} 

add_action('add_meta_boxes', 'release_date_meta_box');


/**
 * Save custom field data in database.
 * 
 * @return null
 */
function save_detail() 
{
    global $post;
    if (define('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post->ID;
    }

    update_post_meta($post->ID, "release_date", $_POST['release_date']);
    update_post_meta($post->ID, "ticket_price", $_POST['ticket_price']);
}

add_action('save_post', 'save_detail');
