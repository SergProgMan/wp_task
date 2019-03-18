<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.webtoffee.com
 * @since      1.0.0
 *
 * @package    Webtoffee_Wordpress_Migrator
 * @subpackage Webtoffee_Wordpress_Migrator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Webtoffee_Wordpress_Migrator
 * @subpackage Webtoffee_Wordpress_Migrator/public
 * @author     WebToffee <info@webtoffee.com>
 */
class Webtoffee_Wordpress_Migrator_Public {

	private $plugin_name;

	private $version;
        
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/webtoffee-wordpress-migrator-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/webtoffee-wordpress-migrator-public.js', array( 'jquery' ), $this->version, false );

	}

}
