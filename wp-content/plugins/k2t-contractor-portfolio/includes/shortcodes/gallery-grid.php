<?php
	global $wp_embed, $blog_arr;
	
	// Check post thumb
	$thumbnail = (has_post_thumbnail(get_the_ID())) ? true : false;
	
	// Get category of post
	$categories = get_the_terms(get_the_ID(), 'portfolio-category');
	
	// Get post format
	$format = get_post_format(get_the_ID()); $format = empty($format) ? 'standard' : $format;
	
	// Load metadata in portfolio
	$hover_link = (function_exists('get_field')) ? get_field('hover_link', get_the_ID()) : ''; $hover_link = empty($hover_link) ? '' : $hover_link;
	$portfolio_video_format_url = (function_exists('get_field')) ? get_field('portfolio_video_format_url', get_the_ID()) : ''; $portfolio_video_format_url = empty($portfolio_video_format_url) ? '' : $portfolio_video_format_url;
	$portfolio_video_code = (function_exists('get_field')) ? get_field('portfolio_video_code', get_the_ID()) : ''; $portfolio_video_code = empty($portfolio_video_code) ? '' : $portfolio_video_code;
	$portfolio_audio_format_url = (function_exists('get_field')) ? get_field('portfolio_audio_format_url', get_the_ID()) : ''; $portfolio_audio_format_url = empty($portfolio_audio_format_url) ? '' : $portfolio_audio_format_url;
	$portfolio_media_file = (function_exists('get_field')) ? get_field('portfolio_media_file', get_the_ID()) : array(); $portfolio_media_file = empty($portfolio_media_file) ? array() : $portfolio_media_file;
	$portfolio_gallery = (function_exists('get_field')) ? get_field('portfolio_gallery', get_the_ID()) : array(); $portfolio_gallery = empty($portfolio_gallery) ? array() : $portfolio_gallery;
	
	
	// Get HTML 
	$title = get_the_title();
	$post_link = get_permalink(get_the_ID());
	$date = get_the_date();
	$post_thumb_size = 'thumb_500x333';
	$post_thumb = get_the_post_thumbnail(get_the_ID(), $post_thumb_size, array('alt' => trim(get_the_title())));
	$post_thumb_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );

	$media_html = '';
    if ( $format == 'video' ) {
        if ( !empty( $portfolio_video_code ) ) {
            $media_html = $portfolio_video_code;
        }elseif ( !empty( $portfolio_video_format_url ) ) {
            $media_html = $wp_embed->run_shortcode( '[embed]' . $portfolio_video_format_url . '[/embed]' );
        }elseif ( count( $portfolio_media_file ) > 0 ) {
            $media_html = do_shortcode( '[video src="'.$portfolio_media_file['url'].'"/]' );
        }
    }elseif ( $format == 'audio' ) {
        if ( count( $portfolio_media_file ) > 0 ) {
            $media_html = do_shortcode( '[audio src="'.$portfolio_media_file['url'].'"/]' );
        }else {
            $media_html = $wp_embed->run_shortcode( '[embed]' . $portfolio_audio_format_url . '[/embed]' );
        }
    }
	
	
	// Post Class
	$post_classes = array('article','post','project','isotope-selector');
	$post_classes[] = 'format-'. $format;	
	if($thumbnail) $post_classes[] = 'has-post-thumbnail'; else $post_classes[] = 'no-post-thumbnail';
	$post_classes[] = 'has-hover';
	//
	if(count($categories) > 0 && is_array($categories)){
		foreach ($categories as $key => $category) {
			$post_classes[] = 'k2t-cat-'.$category->slug;
		}
	}
	$post_classes = implode(' ',$post_classes);
	
?>

<article class="<?php echo $post_classes ;?>"><div class="article-inner">

	<?php if( ( $format == 'audio' ) && !empty( $media_html ) && count($portfolio_media_file) == 0 ):?>
		<?php $id = 'audio-' . rand(); ?>
    	<div id="<?php echo esc_attr( $id );?>" class="white-popup">
    		<?php echo $media_html;?>
    	</div>
    <?php elseif( ( $format == 'audio' || $format == 'video' ) && !empty( $media_html ) && count($portfolio_media_file) > 0 ):?>
		<?php $id = 'audio-' . rand(); ?>
    	<div id="<?php echo esc_attr( $id );?>" class="white-popup format-media-selfhost">
    		<?php echo $media_html;?>
    	</div>
	<?php endif;?>

    <?php if ( $format == 'gallery' && count( $portfolio_gallery ) > 0 && is_array( $portfolio_gallery ) ):?>

        <div class="post-thumbnail thumbnail-gallery">
            <div class="k2t-swiper-slider" data-auto="false" data-auto-time="5000" data-speed="300" data-pager="false" data-navi="true" data-touch="true" data-mousewheel="false"  data-loop="false" data-keyboard="false" data-perview="1">
                <div class="k2t-swiper-slider-inner">
                    <div class="k2t-swiper-slider-inner-deeper">
                        <div class="k2t-swiper-container" data-settings="">
                            <div class="swiper-wrapper k2t-popup-gallery">

                                <?php foreach ( $portfolio_gallery as $slide ): ?>
                                    <?php if ( is_array( $slide ) && !empty( $slide['ID'] ) ):?>
                                    <?php $image = wp_get_attachment_image( $slide['ID'], $post_thumb_size );?>
                                    <?php $image_url = wp_get_attachment_url( $slide['ID'] );?>
                                    <div class="swiper-slide">
                                        <?php if ( !empty( $hover_link ) ) { ?>
                                            <a href="<?php echo esc_url ( $hover_link ); ?>"><?php echo $image;?></a>
                                        <?php } else {?>
                                            <a href="<?php echo esc_url ( $image_url );?>"><?php echo $image;?></a>
                                        <?php } ?>
                                    </div><!-- .swiper-slide -->
                                    <?php elseif ( !empty( $slide ) ):?>
                                    <?php $image = wp_get_attachment_image( $slide, $post_thumb_size );?>
                                    <?php $image_url = wp_get_attachment_url( $slide );?>
                                    <div class="swiper-slide">
                                        <?php if ( !empty( $hover_link ) ) { ?>
                                            <a href="<?php echo esc_url ( $hover_link );?>"><?php echo $image;?></a>
                                        <?php } else {?>
                                            <a href="<?php echo esc_url ( $image_url );?>"><?php echo $image;?></a>
                                        <?php } ?>
                                    </div><!-- .swiper-slide -->
                                    <?php endif;?>
                                <?php endforeach; ?>

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
                <a class="gallery-icon" href="<?php echo $post_link;?>" title="<?php echo esc_attr( $title );?>"><i class="fa fa-link"><!----></i></a>    
            </div><!-- .k2t-swiper-slider -->
        </div><!-- .post-thumbnail -->

    <?php else :?>
        <div class="post-thumbnail thumbnail-image <?php if($format=='gallery') echo 'k2t-popup-gallery'?>">

            <div class="layer-table">
                <div class="layer-cell">
                	<h2 class="title fadeInDown"><span><?php echo $title;?></span></h2>
                    <div class="k2t-categories">
                    	<?php 
                            if ( count( $categories ) > 0 && is_array( $categories ) ) {
                                $i = 0;
                                echo '<span class="cat-icon"><i class="fa fa-folder-o"></i></span>';
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
                    </div>
                    <div class="k2t-mask-icon">
                        <?php if (!empty($hover_link)){?>
                            <a href="<?php echo esc_url ( $hover_link );?>" class="animated fadeInUp">
                        <?php } else {?>
                            <?php if($format=='video' && !empty($portfolio_video_format_url)):?>
                                <a href="<?php echo esc_url ( $portfolio_video_format_url );?>" class="k2t-video-popup-link">
                            <?php elseif( ( $format == 'audio' || $format == 'video' ) && !empty( $media_html ) ):?>
                                <a href="#<?php echo $id;?>" class="k2t-audio-popup-link">
                            <?php elseif($format=='gallery'):?>
                                <a href="<?php echo esc_url ( $post_thumb_url );?>" class="k2t-popup-gallery">
                            <?php else:?>
                                <a href="<?php echo esc_url ( $post_thumb_url );?>" class="k2t-popup-link">
                            <?php endif;?>  
                        <?php } ?>
                        	<?php 
                        	$icon_format = 'fa-search';
                        	switch ( $format ) {
                        		case 'audio':
                        			$icon_format = 'fa-volume-up';
                        			break;
                        		case 'video':
                        			$icon_format = 'fa-youtube-play';
                        			break;
                        	}?>
                            <i class="fa <?php echo $icon_format;?>"><!----></i>
                        </a>
                        <a href="<?php echo esc_url ( $post_link );?>" title="<?php echo esc_attr( $title );?>"><i class="fa fa-link"><!----></i></a>
                    </div>
                </div><!-- .layer-cell -->
            </div><!-- .layer-cell -->

            <?php if ( $thumbnail ): echo $post_thumb; else:?>
            <img src="<?php echo plugin_dir_url( __FILE__ );?>../images/thumb-500x333.png" alt="<?php the_title();?>" />
            <?php endif;?>
            <div class="infobox"><!----></div><!-- .infobox -->
                
            <?php if($format=='gallery'):?>
            <?php if(count($portfolio_gallery) > 0 && is_array($portfolio_gallery)):?>
                <?php foreach ( $portfolio_gallery as $image ): ?>
                        
                    <?php if(is_array($image) && !empty($image['ID'])):?>
                    <a href="<?php echo esc_url ( $image['url'] );?>" style="display:none;"></a>
                    <?php elseif(!empty($image)):?>
                    <?php $img = wp_get_attachment_url($image);?>
                    <a href="<?php echo esc_url ( $image );?>" style="display:none;"></a>
                    <?php endif;?>
                
                <?php endforeach; ?>
            <?php endif;?>
            <?php endif;?>
                
        </div><!-- .post-thumbnail -->

    <?php endif; ?>
    
</div></article><!-- .article -->