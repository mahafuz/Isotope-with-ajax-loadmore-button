<?php
/**
 * The dashboard-specific functionality of the plugin.
 * 
 * @link            http://.mahafuzurrahman.me/wp-plugins/wp-isotope-loader-posts
 * @since           0.1.0
 *
 * @package         MR_Isotope_Loader
 * @subpackage      MR_Isotope_Loader/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    MR_Isotope_Loader
 * @subpackage MR_Isotope_Loader/admin
 * @author     Mahfuz Rahman <asrmahfuz8@gmail.com>
 */

class MR_Isotope_Loader_Admin {

    /**
     * The ID of this plugin
     *
     * @since   0.1.0
     * @access  private
     * @var     string  $name   The ID of this plugin
     */
    private $name;

    /**
     * The version of this plugin
     *
     * @since   0.1.0
     * @access  private
     * @var     string  $version   The version of this plugin
     */
    private $version;

    /**
     * Custom post for this plugin
     *
     * @since   0.1.0
     * @access  private
     * @var     string  $custom_post   Custom post for this plugin
     */
    private $custom_post;

    /**
     * Custom post shortcode for this plugin
     *
     * @since   0.1.0
     * @access  private
     * @var     string  $mr_shortcodes   Custom post shortcode for this plugin
     */
    private $mr_shortcodes;

    /**
     * Custom post meta boxes for this plugin
     *
     * @since   0.1.0
     * @access  private
     * @var     string  $meta_boxes   Custom post meta boxes for this plugin
     */
    private $meta_boxes;

    /**
     * Initialize the class and set its properties
     * 
     * @since   0.1.0
     * @var     string      $name       The ID of this plugin
     * @var     string      $version    The version of this plugin
     */
    public function __construct( $name, $version ) {
        $this->name = $name;
        $this->version = $version;
        $this->custom_post = new MR_Isotope_Loadmore_Post();
        $this->mr_shortcodes = new MR_Loader_Post_Shortcode();
        $this->meta_boxes = new MR_Loader_Post_Meta_Box();

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_mr_loader_post_js' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_mr_loader_post_css' ) );
    }


    /**
     * Includes that JavaScript necessary to control the isotope masonry
     * posts.
     */
    public function enqueue_mr_loader_post_js() {

        wp_enqueue_script(
            'isotope',
            plugin_dir_url( __FILE__ ) . 'assets/js/isotope.pkgd.min.js',
            array( 'jquery' ),
            $this->version
        );

        wp_enqueue_script(
            'isotope-packery',
            plugin_dir_url( __FILE__ ) . 'assets/js/packery.pkgd.min.js',
            array( 'jquery' ),
            $this->version
        );

    }

    /**
     * Includes that CSS necessary to control the isotope masonry
     * posts.
     */
    public function enqueue_mr_loader_post_css() {

        wp_enqueue_style(
            $this->name . '-main',
            plugin_dir_url( __FILE__ ) . 'assets/css/mr-loader-post.css',
            $this->version
        );

    }


}