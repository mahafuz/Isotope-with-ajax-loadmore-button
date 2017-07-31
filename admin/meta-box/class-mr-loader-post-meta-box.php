<?php

if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

/**
 * Represents the MR Loader Posts Meta Box.
 *
 * @link       http://.mahafuzurrahman.me/wp-plugins/wp-isotope-loader-posts
 * @since      0.2.0
 *
 * @package         MR_Isotope_Loader
 * @subpackage      MR_Isotope_Loader/admin
 */
 
/**
 * Represents the MR Loader Posts Meta Box.
 *
 * Registers the meta box with the CodeStar Framework, sets its properties, and renders the content
 * by including the markup from its associated view.
 *
 * @package         MR_Isotope_Loader
 * @subpackage      MR_Isotope_Loader/admin
 * @author     Mahfuz Rahman <asrmahfuz8@gmail.com>
 */
class MR_Loader_Post_Meta_Box {

    /**
     * Initialize meta box function
     * 
     * @since   0.1.0
     */
    public function __construct() {
        add_filter( 'cs_metabox_options', array( $this, 'add_mr_loader_post_meta_box' ) );
    }

    /**
     * Registering meta boxes for loader post
     */
    public function add_mr_loader_post_meta_box( $options ) {

        $options = array(); // remove old options

        $options[]    = array(
        'id'        =>'_mr_loader_post_meta_boxes',
        'title'     => esc_html__( 'MR Loader Post Settings', 'mr-isotope-loader' ),
        'post_type' => 'loader-posts',
        'context'   => 'side',
        'priority'  => 'default',
        'sections'  => array(

                // begin: a section
                array(
                    'name'      => 'select_post_layout',
                    'title'     => esc_html__( 'Select Post Image Layout', 'mr-isotope-loader' ),
                    'icon'      => 'fa fa-picture-o',

                    'fields' => array(

                        array(
                                'id'    => 'mr_post_img_layout',
                                'type'  => 'image_select',
                                'title' => esc_html__( 'Select a Layout', 'mr-isotope-loader' ),
                                'options'   => array(
                                '1'         => plugin_dir_url( __FILE__ ) . 'images/1.png',
                                '2'         => plugin_dir_url( __FILE__ ) . 'images/2.png',
                                '3'         => plugin_dir_url( __FILE__ ) . 'images/3.png'
                            ),
                            'default'   => '2'
                        )

                    )
                )

            ),
        );

        return $options;

    }

}

