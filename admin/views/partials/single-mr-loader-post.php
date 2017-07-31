<?php
    $image_layout_arr = get_post_meta(get_the_ID(), '_mr_loader_post_meta_boxes', true );
    if( isset($image_layout_arr) && ! empty($image_layout_arr) ) {
        $mr_post_img_layout = $image_layout_arr['mr_post_img_layout'];

        if( $mr_post_img_layout == '1' ) {
            $class = 'long-height-project-item';
        }elseif( $mr_post_img_layout == '3' ) {
            $class = 'wide-width-project-item';
        }else {
            $class = '';
        }
    }

    
?>

<div class="single-kites-project-wrap col-md-4 col-sm-6 <?php echo strip_tags(esc_attr($project_assigned_cat_list)); ?>">

    <div class="single-kites-project kites-project-<?php echo esc_attr($project_no); ?>" style="background-image:url(<?php echo esc_url($post_feat_image[0]); ?>)">
        <a href="<?php the_permalink(); ?>" class="portfolio-hover-1">
            <div class="project-bio">
                <div class="plus-icon">
                    <div class="shape1"></div>
                    <div class="shape2"></div>
                </div>
                <h4>
                    <?php
                        // List of assigned post category
                        if( ! empty( $project_assigned_catname ) && ! is_wp_error( $project_assigned_catname ) ) {
                            foreach( $project_assigned_catname as $sin_cat ) {
                                echo "<span>".esc_attr($sin_cat->name)."</span>";
                            }
                        }
                    
                    ?>
                </h4>
                
            </div>
        </a>
    </div>

</div><!-- /.single-kites-project-wrap -->