<?php
/**
 * Represents the mr isotope loader post shortcodes that is rendering the main post.
 *
 * @link            http://.mahafuzurrahman.me/wp-plugins/wp-isotope-
 * @since           0.1.0
 *
 * @package         MR_Isotope_Loader
 * @subpackage      MR_Isotope_Loader/admin
 */

/**
 * Represents the mr isotope loader post shortcodes that is rendering the main post.
 *
 * @package    MR_Isotope_Loader
 * @subpackage MR_Isotope_Loader/admin
 * @author     Mahfuz Rahman <asrmahfuz8@gmail.com>
 */

class MR_Loader_Post_Shortcode {

    /**
     * Initialize shortcode function
     * 
     * @since   0.1.0
     */
    public function __construct() {
        add_shortcode( 'loader_posts_display', array( $this, 'add_loader_post_shortcode' ) );

        add_action( 'wp_ajax_mr_load_more_post', array( $this, 'mr_load_more_post_func' ) );
        add_action( 'wp_ajax_nopriv_mr_load_more_post', array( $this, 'mr_load_more_post_func' ) );
    }

    public function mr_load_more_post_func() {

        // Verifying nonce here
        if( ! wp_verify_nonce( $_REQUEST['nonce'], "load_more_projects_nonce" ) ) {
            exit( "No naughty business please!" );
        }

        $offset = isset( $_REQUEST['offset'] ) ? intval( $_REQUEST['offset'] ) : 0;
        $posts_per_page = isset( $_REQUEST['posts_per_page'] ) ? intval( $_REQUEST['posts_per_page'] ) : 10;
        $post_type = isset( $_REQUEST['post_type'] ) ? $_REQUEST['post_type'] : 'loader-posts';

        ob_start();

        $args = array(
            'post_type'         => $post_type,
            'posts_per_page'    => $posts_per_page,
            'offset'            => $offset,
            'orderby'           => 'date',
            'order'             => 'DSC'
        );
        $query = new WP_Query( $args );

        if( $query->have_posts() ) {

            $result['have_posts'] = true;
            while( $query->have_posts() ) : $query->the_post();

                // Find out assigned category names in this post
                $project_assigned_catname = get_the_terms( get_the_ID(), 'projects_cat' );

                if( ! empty( $project_assigned_catname ) && ! is_wp_error( $project_assigned_catname ) ) {
                    $project_assigned_cats_array = array();

                    foreach( $project_assigned_catname as $cat ) {
                        $project_assigned_cats_array[] = $cat->slug;
                    }

                    $project_assigned_cat_list = join( " ", $project_assigned_cats_array );
                }else {
                    $project_assigned_cat_list = '';
                }
            ?>
            <div class="single-kites-project-wrap col-md-4 col-sm-6 <?php echo strip_tags(esc_attr($project_assigned_cat_list)); ?>">

                <div class="single-kites-project kite-project-1" style="">
                    <a href="single-portfolio-1.html" class="portfolio-hover-1">
                        <div class="project-bio">
                            <div class="plus-icon">
                                <div class="shape1"></div>
                                <div class="shape2"></div>
                            </div>
                            <h4>White Light<br>Photography</h4>
                        </div>
                    </a>
                </div>

            </div><!-- /.single-kites-project-wrap -->
            <?php
            endwhile;
            $result['html'] = ob_get_clean();
            
        }else {
            $result['have_posts'] = false;
        }

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $result = json_encode($result);
            echo $result; 
        }
        else { 
            header("Location: ".$_SERVER["HTTP_REFERER"]);
        }
        die();

    }

    /**
     * Post shortcode function
     * 
     * @since   0.1.0
     */
    public function add_loader_post_shortcode( $content, $atts = null ){

        extract(shortcode_atts( array(
            ''  => ''
        ), $atts ));

        // Post query arguments
        $q = new WP_Query(array(
            'post_type'         => 'loader-posts',
            'posts_per_page'    => '9'
        ));

        ob_start();
        ?>
        <div class="projects">

            <?php

                // Get project categories
                $project_categories = get_terms( 'projects_cat' );

                if( ! empty( $project_categories ) && ! is_wp_error( $project_categories) ) :
            ?>
            <div class="container">
                <div class="row">

                <script>
                    jQuery(document).ready(function($){
                        $(".projects-filter li").click(function(){

                        $(".projects-filter li").removeClass("active");
                        $(this).addClass("active");

                            var selector = $(this).attr("data-filter");
                            $("#mr-all-projects-wrap").isotope({
                                filter: selector,
                                animationOptions: {
                                    duration: 750,
                                    easing: "linear",
                                    queue: false,
                                }
                            });

                            $(".load-more-projects-wrap").hide();
                        });
                        $("#mr-all-projects-filter").click(function(){
                            $(".load-more-projects-wrap").show();
                        });


                    });

                    jQuery(window).load(function(){
                        jQuery("#mr-all-projects-wrap").isotope({
                            itemSelector: ".single-kites-project-wrap",
                            layoutMode: "masonry",
                        });
                    });
                </script><!-- /. Isotpe Active primary js activation -->

                <div class="col-md-12">
                    <ul class="projects-filter">

                        <li id="mr-all-projects-filter" data-filter="*" class="active">All</li>

                        <?php foreach( $project_categories as $project_category ) : ?>
                            <li data-filter=".<?php echo esc_attr($project_category->slug); ?>"><?php echo esc_attr($project_category->name); ?></li>
                        <?php endforeach; ?>

                    </ul><!-- /.projects-filter -->
                </div>

                </div><!-- /.row -->
            </div><!-- /.container -->

            <?php endif; // end of if( ! empty( $project_categories ) && ! is_wp_error( $project_categories) ) ?>


            <?php if( $q->have_posts() ) : ?>
            <div id="mr-all-projects-wrap" class="mr-projects-style">

                <?php 
                    // Loop
                    while( $q->have_posts() ) : $q->the_post();

                    // Find out assigned category names in this post
                    $project_assigned_catname = get_the_terms( get_the_ID(), 'projects_cat' );

                    if( ! empty( $project_assigned_catname ) && ! is_wp_error( $project_assigned_catname ) ) {
                        $project_assigned_cats_array = array();

                        foreach( $project_assigned_catname as $cat ) {
                            $project_assigned_cats_array[] = $cat->slug;
                        }

                        $project_assigned_cat_list = join( " ", $project_assigned_cats_array );
                    }else {
                        $project_assigned_cat_list = '';
                    }
                    
                ?>
                    <div class="single-kites-project-wrap col-md-4 col-sm-6 <?php echo strip_tags(esc_attr($project_assigned_cat_list)); ?>">

                        <div class="single-kites-project kite-project-1" style="">
                            <a href="single-portfolio-1.html" class="portfolio-hover-1">
                                <div class="project-bio">
                                    <div class="plus-icon">
                                        <div class="shape1"></div>
                                        <div class="shape2"></div>
                                    </div>
                                    <h4>White Light<br>Photography</h4>
                                </div>
                            </a>
                        </div>

                    </div><!-- /.single-kites-project-wrap -->
                <?php endwhile; // end of while have posts ?>
                

            </div><!-- #mr-all-projects-wrap -->


            <div id="load-next-projects-message" class="text-center"></div>
            <p class="load-more-projects-wrap text-center">
                <span data-nonce="<?php echo wp_create_nonce('load_more_projects_nonce'); ?>" class="loadmore-project-btn">Load more</span>
            </p>

            <script>

            jQuery(document).ready(function( $ ){

                $('.loadmore-project-btn').on('click',function(e){

                    e.preventDefault();

                    var $load_more_btn = $(this);
                    var post_type = 'loader-posts'; // this is optional and can be set from anywhere, stored in mockup etc...
                    var offset = $('#mr-all-projects-wrap .single-kites-project-wrap').length;
                    var nonce = $load_more_btn.attr('data-nonce');
                    $.ajax({
                        type : "POST",
                        context: this,
                        dataType : "json",
                        url: "<?php echo esc_url(site_url()); ?>/wp-admin/admin-ajax.php",
                        data : {
                            action: "mr_load_more_post",
                            offset:offset,
                            nonce:nonce, 
                            post_type:post_type
                            // posts_per_page:
                        },
                        beforeSend: function(data) {
                            // here u can do some loading animation...
                            $load_more_btn.addClass('loading').html('Loading...');// good for styling and also to prevent ajax calls before content is loaded by adding loading class
                        },
                        success: function(response) {
                            if (response['have_posts'] == 1){//if have posts:
                                $load_more_btn.removeClass('loading').html('Load More');
                                var $newElems = $(response['html'].replace(/(\r\n|\n|\r)/gm, ''));// here removing extra breaklines and spaces
                                console.log($newElems);
                                $('#mr-all-projects-wrap').append($newElems);
                                $("#mr-all-projects-wrap").isotope( 'reloadItems' ).isotope();
                            } else {
                                //end of posts (no posts found)
                                $load_more_btn.removeClass('loading').addClass('end_of_posts').html('<span>End of posts</span>'); // change buttom styles if no more posts
                            }
                        }
                    });
                });

            });

            </script>

            <?php endif; // end of if have posts ?>



        </div><!-- /.projects -->

        <?php
        return ob_get_clean();
    }

}