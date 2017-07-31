<?php
/**
 * The plugin bootstrap file
 *
 * This file is responsible for starting the plugin using the main plugin
 * class file.
 *
 * @link              http://.mahafuzurrahman.me/wp-plugins/mr-isotope-loader
 * @since             0.1.0
 * @package           MR_Isotope_Loader
 *
 * @wordpress-plugin
 * Plugin Name:       MR Isotope Loader
 * Plugin URI:        http://.mahafuzurrahman.me/wp-plugins/mr-isotope-loader
 * Description:       The description of this plugin.
 * Version:           0.1.0
 * Author:            Mahfuz Rahman
 * Author URI:        http://.mahafuzurrahman.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mr-isotope-loader
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * The core plugin class that is used to define the meta boxes, their tabs
 * the views, and the partials content for this plugin.
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/class-mr-isotope-loader.php';


/**
 * The core plugin post class that is used to define the admin menu.
 *
 * @since   0.1.0
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/class-mr-isotope-loader-admin.php';


/**
 * The core plugin post shortcodes class that is used to rendering the post.
 *
 * @since   0.1.0
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/class-mr-loader-post-shortcode.php';


/**
 * The core plugin post meta boxes class that is used to rendering the mr custom post
 * meta boxes.
 *
 * @since   0.1.0
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/meta-box/class-mr-loader-post-meta-box.php';


/**
 * Begins execution of the plugin.
 *
 * Everything for this particular plugin will be done so from within the
 * MR_Isotope_Loader/admin subpackage. This means that there is no reason to setup
 * any hooks until we're in the context of the MR_Isotope_Loader_Admin class.
 *
 * @since    0.1.0
 */
function run_mr_isotope_loader() {
    $wp_isotope_loader = new MR_Isotope_Loader_Admin( 'mr-isotope-loader', '0.1.0' );
}

run_mr_isotope_loader();
