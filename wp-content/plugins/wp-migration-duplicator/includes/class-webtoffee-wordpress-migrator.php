<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}


class Webtoffee_Wordpress_Migrator
{


    protected $loader;
    protected $plugin_name;
    protected $version;

    public function __construct()
    {
        if (defined('WEBTOFFEE_MIGRATOR_VERSION')) {
            $this->version = WEBTOFFEE_MIGRATOR_VERSION;
        } else {
            $this->version = '1.0.8';
        }
        $this->plugin_name = 'webtoffee-wordpress-migrator';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

    }

    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-webtoffee-wordpress-migrator-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-webtoffee-wordpress-migrator-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-webtoffee-wordpress-migrator-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-webtoffee-wordpress-migrator-public.php';

        $this->loader = new Webtoffee_Wordpress_Migrator_Loader();

    }


    private function set_locale()
    {

        $plugin_i18n = new Webtoffee_Wordpress_Migrator_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }


    private function define_admin_hooks()
    {

        $plugin_admin = new Webtoffee_Wordpress_Migrator_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

        // Add menu item
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_plugin_admin_menu');

        // Add Settings link to the plugin
        $plugin_basename = plugin_basename(plugin_dir_path(__DIR__) . $this->plugin_name . '.php');
        $this->loader->add_filter('plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links');


        $this->loader->add_action('wp_ajax_export_migration',  $plugin_admin,'process_export_data' );
        $this->loader->add_action('wp_ajax_import_migration',  $plugin_admin,'process_import_data' );
        $this->loader->add_action('wp_ajax_delete_migration',  $plugin_admin,'process_delete_data' );



        //$this->loader->add_action('admin_init', $plugin_admin, 'options_update');

    }

    private function define_public_hooks()
    {

        $plugin_public = new Webtoffee_Wordpress_Migrator_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    public function get_loader()
    {
        return $this->loader;
    }

    public function get_version()
    {
        return $this->version;
    }

}