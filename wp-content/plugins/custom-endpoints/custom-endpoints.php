<?php
/**
 * Plugin Name: Custom Endpoints
 * Description: extent your WP RSET api
 * Version: 1.0.0
 * Author: Me
 * Author URI: https://dont-go-to-this.url
 * License: GPL2+
 *
 * @package Custom_Endpoints
 */

/*
Plugin Name: Custom Endpoints
Plugin URI: https://github.com/
Description: Admin panel for creating custom endpoints in WordPress
Author: WebDevStudios
Version: 1.6.1
Author URI: https://webdevstudios.com/
Text Domain: custom-endpoints
Domain Path: /languages
License: GPL-2.0+
*/


function js_init() {
    wp_enqueue_script( 'js_init', plugins_url( '/assets/app.js', __FILE__ ));
    wp_enqueue_style( 'js_init', plugins_url( '/assets/main.css', __FILE__ ));
}
add_action('admin_enqueue_scripts','js_init');


function plugin_top_menu(){
    add_menu_page('My Plugin', 'My Plugin', 'manage_options', __FILE__, 'render_plugin_page', false);
}
add_action('admin_menu','plugin_top_menu');

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once( plugin_dir_path( __FILE__ ) . 'includes/endpoints.php' );

function render_plugin_page(){
    require_once( plugin_dir_path( __FILE__ ) . 'includes/plugin-page.php' );
}
