<?php
/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

/**
 * Text domain definition
 */
defined('THEME_TD') ? THEME_TD : define('THEME_TD', 'nahl');

// Load modules

$theme_includes = [
    '/lib/helpers.php',
    '/lib/cleanup.php',                        // Clean up default theme includes
    '/lib/enqueue-scripts.php',                // Enqueue styles and scripts
    '/lib/protocol-relative-theme-assets.php', // Protocol (http/https) relative assets path
    '/lib/framework.php',                      // Css framework related stuff (content width, nav walker class, comments, pagination, etc.)
    '/lib/theme-support.php',                  // Theme support options
    '/lib/template-tags.php',                  // Custom template tags
    '/lib/menu-areas.php',                     // Menu areas
    '/lib/widget-areas.php',                   // Widget areas
    '/lib/customizer.php',                     // Theme customizer
    '/lib/vc_shortcodes.php',                  // Visual Composer shortcodes
    '/lib/jetpack.php',                        // Jetpack compatibility file
    '/lib/acf_field_groups_type.php',          // ACF Field Groups Organizer
];

foreach ($theme_includes as $file) {
    if (!$filepath = locate_template($file)) {
        continue;
        trigger_error(sprintf(__('Error locating %s for inclusion', THEME_TD), $file), E_USER_ERROR);
    }

    require_once $filepath;
}
unset($file, $filepath);


// Theme the TinyMCE editor (Copy post/page text styles in this file)

add_editor_style('assets/dist/css/custom-editor-style.css');


// Custom CSS for the login page

function loginCSS()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri(THEME_TD) . 'assets/dist/css/wp-login.css"/>';
}

add_action('login_head', 'loginCSS');


// Add body class for active sidebar
function wp_has_sidebar($classes)
{
    if (is_active_sidebar('sidebar')) {
        // add 'class-name' to the $classes array
        $classes[] = 'has_sidebar';
    }
    // return the $classes array
    return $classes;
}

add_filter('body_class', 'wp_has_sidebar');

// Remove the version number of WP
// Warning - this info is also available in the readme.html file in your root directory - delete this file!
remove_action('wp_head', 'wp_generator');


// Obscure login screen error messages
function wp_login_obscure()
{
    return '<strong>Error</strong>: wrong username or password';
}

add_filter('login_errors', 'wp_login_obscure');


// Disable the theme / plugin text editor in Admin
define('DISALLOW_FILE_EDIT', true);

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page('Theme Settings');

}
function wpb_list_child_pages() {

    global $post;


    if ( is_page() && $post->post_parent )
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' .$post->post_parent . '&echo=0' );
    else
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );

    if ( $childpages ) {
        $string = '<ul>' . $childpages . '</ul>';
    }

    return $string;
}

add_shortcode('wpb_childpages', 'wpb_list_child_pages');


add_action('do_meta_boxes', 'remove_thumbnail_box');

function remove_thumbnail_box() {
    remove_meta_box( 'postimagediv','post','side' );
}

function load_scripts_styles(){
    //scripts
    wp_enqueue_script( 'google-map', "https://maps.googleapis.com/maps/api/js", [], '20190307', false );
    wp_enqueue_script( 'google-map-helper', get_template_directory_uri() . '/assets/scripts/google-map-helper.js', [], '20190307', false );
    
    wp_enqueue_script( 'random-color', get_template_directory_uri() . '/assets/scripts/random-color.js', [], '20190309', false );

    //style
    wp_enqueue_style( 'my-style', get_template_directory_uri() . '/assets/styles/my-style.css'); 
}
add_action( 'wp_enqueue_scripts', 'load_scripts_styles' );





// Our custom post type function
function create_posttype() { 
    register_post_type( 'movies',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Movies' ),
                'singular_name' => __( 'Movie' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'movies'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

// Change the columns for the edit CPT screen
function change_columns( $cols ) {
    $cols = array(
      'cb'       => '<input type="checkbox" />',
      'url'      => __( 'URL',      'trans' ),
      'referrer' => __( 'Referrer', 'trans' ),
      'host'     => __( 'Host', 'trans' ),
    );
    return $cols;
}
add_filter( "manage_movies_posts_columns", "change_columns" );

  //fill new columns with some content from the custom post type
function custom_columns( $column, $post_id ) {
    switch ( $column ) {
        case "url":
            $url = get_post_meta( $post_id, 'url', true);
            $url = get_permalink( $post_id );
            var_dump(get_post_meta( $post_id, '', true));
            echo '<a href="' . $url . '">' . $url. '</a>';
        break;
        case "referrer":
            $refer = get_post_meta( $post_id, 'referrer', true);
            echo '<a href="' . $refer . '">' . $refer. '</a>';
        break;
        case "host":
            echo get_post_meta( $post_id, 'host', true);
        break;
    }
}   
add_action( "manage_posts_custom_column", "custom_columns", 10, 2 );
  
  // Make these columns sortable
function sortable_columns() {
    return array(
        'url'      => 'url',
        'referrer' => 'referrer',
        'host'     => 'host'
    );
}

add_filter( "manage_edit-movies_sortable_columns", "sortable_columns" );


//create endpoint
add_action('rest_api_init', function () {
    register_rest_route( 'nahl/v2', 'latest-posts/(?P<category_id>\d+)',array(
                  'methods'  => 'GET',
                  'callback' => 'get_latest_posts_by_category'
        ));
  });

function get_latest_posts_by_category($request) {

    $args = array(
            'category' => $request['category_id']
    );

    $posts = get_posts($args);
    if (empty($posts)) {
        return new WP_Error( 'empty_category', 'there is no post in this category', array('status' => 404) );
    }

    $response = new WP_REST_Response($posts);
    $response->set_status(200);

    return $response;
}