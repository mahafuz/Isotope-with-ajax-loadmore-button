
                    <script>
                        jQuery(document).ready(function($){
                            $(".loadmore-project-btn").click(function(){
                                $.ajax({
                                    type: 'POST',
                                    url: "'.site_url().'/wp-admin/admin-ajax.php",
                                    dataType: 'html',
                                    data: {
                                        count: $(this).attr("data-count"),
                                        columns: $(this).attr("data-columns"),
                                        style: $(this).attr("data-style"),
                                        filter: $(this).attr("data-filter"),
                                        static_count: $(this).attr("data-static-count"),
                                        total_loaded: $(this).attr("data-total-loaded"),
                                        action: 'load_more_projects',
                                        nonce: $(this).data('nonce')
                                    },
                                    beforeSend: function(data) {
                                        $("#load-next-projects-message").append("<span class=\'projectmore-loading-text\'><i class=\'icofont icofont-spinner-alt-4\'></i> Projects loading ...</span>");
                                        $(".loadmore-project-btn").hide();
                                    },
                                    success: function(data, result){
                                        if( result != 'error' ) {
                                            $(".ptheme-all-projects").append(data);


                                            $(".ptheme-all-projects-wrapper").isotope( \'reloadItems\' ).isotope();


                                            // var posts_per_page = '. esc_attr($count).';
                                            // var final_count = parseInt($(".loadmore-project-btn").attr("data-count")) + parseInt(posts_per_page);

                                            // var total_found_posts = parseInt('.esc_attr($total_found_posts).');
                                            // $(".loadmore-project-btn").removeAttr("data-count");
                                            // $(".loadmore-project-btn").attr("data-count", final_count);



                                            // var total_loaded_count = parseInt($(".loadmore-project-btn").attr("data-count")) - parseInt(posts_per_page);

                                            // $(".loadmore-project-btn").removeAttr("data-total-loaded");
                                            // $(".loadmore-project-btn").attr("data-total-loaded", total_loaded_count);
                                            // $("#load-next-projects-message").empty();
                                            // $(".loadmore-project-btn").show();

                                            // if ( parseInt($(".loadmore-project-btn").attr("data-total-loaded")) > total_found_posts) {
                                            //     $("#load-next-projects-message").append("No more projects available");
                                            //     $(".load-more-projects-wrap, #load-next-projects-message").fadeOut();
                                            //     $(".loadmore-project-btn").hide();
                                            // }
                                        }
                                    }
                                });
                            });
                        });
                        </script>