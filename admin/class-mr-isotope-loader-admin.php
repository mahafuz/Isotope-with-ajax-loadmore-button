<?php
/**
 * Represents the mr isotope loader plugin dashboard admin menu, posts, meta box
 *
 * @link            http://.mahafuzurrahman.me/wp-plugins/wp-isotope-
 * @since           0.1.0
 *
 * @package         MR_Isotope_Loader
 * @subpackage      MR_Isotope_Loader/admin
 */

/**
 * Represents the mr isotope loader plugin dashboard admin menu, posts, meta box
 *
 * @package    MR_Isotope_Loader
 * @subpackage MR_Isotope_Loader/admin
 * @author     Mahfuz Rahman <asrmahfuz8@gmail.com>
 */
class MR_Isotope_Loadmore_Post {

    /**
     * The function responsible for registering 'MR Isotope' post
     * on the dashboard.
     *
     * @since   0.1.0
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_mr_loader_post_type' ) );
        add_action( 'init', array( $this, 'add_mr_loader_post_taxonomy' ) );
    }

    /**
     * The function responsible for registering post type.
     *
     * @since    0.1.0
     */
    public function register_mr_loader_post_type() {

        $labels = array(
                'name'               => _x( 'MR Load More Posts', 'MR Load More Posts', 'mr-isotope-loader' ),
                'singular_name'      => _x( 'MR Load More Post', 'MR Load More Post', 'mr-isotope-loader' ),
                'menu_name'          => _x( 'MR Loader Post', 'MR Load More Post', 'mr-isotope-loader' ),
                'name_admin_bar'     => _x( 'MR Load More Posts', 'MR Load More Post', 'mr-isotope-loader' )
            );

        $args = array(
            'labels'             => $labels,
                    'description'        => __( 'Add MR Load More Posts from here..', 'mr-isotope-loader' ),
            'public'             => true,
            'rewrite'            => array( 'slug' => 'mr-load-more-post' ),
            'menu_icon'          => 'dashicons-image-rotate',
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
        );

	    register_post_type( 'loader-posts', $args );
    }


    /**
     * The function responsible for registered post types taxonomy.
     *
     * @since    0.1.0
     */
    public function add_mr_loader_post_taxonomy() {

        $labels = array(
                'name'              => _x( 'Loader Post Categories', 'loader post categories', 'mr-isotope-loader' ),
                'singular_name'     => _x( 'Loader Post Category', 'loader post category', 'mr-isotope-loader' ),
                'menu_name'         => __( 'Loader Post Category', 'mr-isotope-loader' )
            );
        
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true
        );

	    register_taxonomy( 'projects_cat', array( 'loader-posts' ), $args );

    }

}
