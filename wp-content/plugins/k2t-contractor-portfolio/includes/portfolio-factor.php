<?php global $smof_data, $single_layout_class;?>		

<?php $display_related_post = (function_exists('get_field')) ? get_field('display_related_post', get_the_ID()) : ''; $display_related_post = empty($display_related_post) ? 'default' : $display_related_post;?>
<?php if(($display_related_post == 1) || ($display_related_post == 'default' && $smof_data['portfolio-related-post'] == 1)):?>
<?php
    $related = get_related_tag_posts_ids( get_the_ID(), -1, 'portfolio-category', 'post-portfolio');
    if( $related) :
?>
<div class="k2t-related-posts post-factor project-factor">
     <?php 
        $related_post_title = $smof_data['single-related-post-title'];
        $related_post_sub_title = $smof_data['single-related-post-sub-title'];
    ?>
    <h3 id="related-posts-title"><?php echo $related_post_title;?></h3>
    <div class="related-posts-sub-title">
        <?php if ( !empty( $related_post_sub_title ) ) : ?>
        <span class="k2t-subtitle-line"></span>
        <span><?php echo $related_post_sub_title;?></span>
        <span class="k2t-subtitle-line"></span>
        <?php endif;?>
    </div>
    <?php $related_columns = ($single_layout_class == 'fullwidth') ? '4' : '3'?>
    <div class="k2t-swiper-slider k2t-related-slider" data-auto="false" data-auto-time="5000" data-speed="300" data-pager="false" data-navi="true" data-touch="true" data-mousewheel="false" data-loop="true" data-keyboard="false" data-perview="<?php echo $related_columns;?>">
        <div class="k2t-swiper-slider-inner">
            <div class="k2t-swiper-slider-inner-deeper">
                <div class="k2t-swiper-container" data-settings="">
                    <div class="swiper-wrapper">
                    <?php
                            $args = array(
                                'post__in'      => $related,
                                'orderby'       => 'post__in',
                                'no_found_rows' => true, // no need for pagination
								'post_type'		=> 'post-portfolio'
                            );
                            $related_posts = get_posts( $args );
                            if(count($related_posts) > 0)
                            foreach ( $related_posts as $post ): setup_postdata($post);
                                $thumb_html = '';
                                if(has_post_thumbnail(get_the_ID())){
                                    $thumb_html = get_the_post_thumbnail(get_the_ID(), 'thumb_400x256', array('alt' => trim(get_the_title())));
                                }else{
                                    $thumb_html = '<img src="' . plugin_dir_url( __FILE__ ) . 'images/thumb-400x256.png" alt="'.trim(get_the_title()).'" />';
                                }
                                $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post' );
                    ?>
                        <div class="swiper-slide">
                            <article class="related-post">
                                <div class="related-inner">
                                    <div class="related-thumb">
                                        <a class="image-link k2t-popup-link" href="<?php echo esc_url ( $thumb_url[0] );?>"><?php echo $thumb_html;?></a>
                                    </div>
                                    <div class="related-text">
                                        <h4 class="related-title"><a href="<?php esc_url ( the_permalink( get_the_ID() ) )?>" title="<?php the_title()?>"><?php the_title();?></a></h4>
                                        <div class="related-meta">
                                            <?php
                                                $categories = get_the_terms( get_the_ID(), 'portfolio-category' );
                                                if ( count( $categories ) > 0 && is_array( $categories ) ) {
                                                    $i = 0;
                                                    foreach ( $categories as $key => $category ) {
                                                        $term_link = get_term_link( $category->term_id, 'portfolio-category' );
                                                        if ( !is_wp_error( $term_link ) ){
                                                            if ( $i == ( count( $categories ) - 1 ) ) {
                                                                echo '<a href="' . esc_url( $term_link ) . '" title="' . esc_attr( $category->name ) . '">' . $category->name . '</a>';
                                                            } else {
                                                                echo '<a href="' . esc_url( $term_link ) . '" title="' . esc_attr( $category->name ) . '">' . $category->name . '</a>, ';
                                                            }
                                                        }
                                                        $i++;
                                                    }
                                                }
                                            ?>
                                        </div><!-- .related-meta -->
                                    </div><!-- .related-text -->	
                                </div><!-- .related-inner -->		
                            </article><!-- .related-post -->
                        </div><!-- .swiper-slide -->
                    <?php 	
                            endforeach;
                        wp_reset_postdata();
                    ?>
                    </div><!-- .swiper-wrapper -->
                </div><!-- .swiper-container -->
                
                <div class="k2t-swiper-navi">
                    <ul>
                        <li><a class="prev"><i class="fa fa-chevron-left"></i></a></li>
                        <li><a class="next"><i class="fa fa-chevron-right"></i></a></li>
                    </ul>	
                </div><!-- .k2t-swiper-navi -->
                
            
            </div><!-- .k2t-swiper-slider-inner-deeper -->
        
        </div><!-- .k2t-swiper-slider-inner -->
        
    </div><!-- .k2t-swiper-slider -->
    
</div><!-- .k2t-related-posts -->
<?php endif;?>
<?php endif;?>


<?php $display_comment_form = (function_exists('get_field')) ? get_field('display_comment_form', get_the_ID()) : ''; $display_comment_form = empty($display_comment_form) ? 'default' : $display_comment_form;?>
<?php if(($display_comment_form == 1)):?>
<?php comments_template( '', true ); ?>
<?php endif;?>