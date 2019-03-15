<?php
/**
 * _s functions and definitions
 *
 * @package unite child
 */

/**
 * Register widgetized area and update sidebar with default widgets.
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
