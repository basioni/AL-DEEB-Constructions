<?php
/* ------------------------------------------------------- */
/* Portfolio
/* ------------------------------------------------------- */
if (!function_exists('k2t_portfolio_shortcode')){
	function k2t_portfolio_shortcode($atts,$content){
		extract(shortcode_atts(array(
			'filter_align'  => 'center',
			'categories'	=>  '',
			'number'		=>	'-1',
			'column'		=> 	'3',
			'portfolio_type'=> 	'portfolio',
			'link_detail'	=> 	'link',
			'padding'		=>	'true',
			'filter'		=>	'false',
			'text_align'	=>	'center',
			'style'			=>	'text-grid',
			'child_style'	=>  'none',
		), $atts));

		$number = empty( $number ) ? -1 : $number;
		$filter_style = 1;
		$arr_term_id = $arr_term = array();
		if ( !empty( $categories ) ){
			$arr_categories = explode( ',', $categories );
			foreach ( $arr_categories as $category_id ){
				$category_id = trim( $category_id );
				if ( !empty( $category_id ) ){
					if ( is_numeric( $category_id ) ){
						$term = get_term_by( 'id', $category_id, 'portfolio-category' );
					}else{
						$term = get_term_by( 'slug', $category_id, 'portfolio-category' );
					}
					if ( $term ){
						$arr_term[] = $term;
						$arr_term_id[] = $term->term_id;
					}	
				}
			}
		}
		
		wp_enqueue_script('jquery-isotope');
		if ( !in_array( $column, array( '2','3','4','5' ) ) ) $column = 3;
		if ( !in_array( $style, array( 'text-grid', 'text-masonry', 'gallery-grid', 'gallery-masonry' ) ) ) $style = 'text-grid';
		$style2 = $style;
		$style = explode( '-', $style );
		if ( $filter_style != '2' ) $filter_style = 1;

		ob_start();
		$portfolio_class = '';
		if ($padding == 'false') {
			$portfolio_class .= ' isotope-no-padding';
		}

		?>
	<div class="k2t-portfolio-shortcode filter-style-<?php echo $filter_style;?>">
		<div class="portfolio-<?php echo $style[0];?> portfolio-<?php echo $style[1];?> isotope-fullwidth isotope-<?php echo $column;?>">
		
			<div class="k2t-isotope-wrapper <?php echo $portfolio_class; ?> isotope-<?php echo $column;?>-columns isotope-<?php echo $style[0];?> isotope-<?php echo $style[1];?>">
			
				<?php if ( $filter == 'true' ) include( 'portfolio-cat.php' );?>
			
				<div class="article-loop k2t-isotope-container">
				
					<div class="gutter-sizer"></div>
		
					<?php 
						$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );	
						$arr = array(
							'post_type' 		=> 'post-portfolio',
							'posts_per_page' 	=> (int)$number,
							'order'				=> 'DESC',
							'post_status'		=> 'publish',
							'paged'				=> $paged,
							'orderby'			=> 'date',
						);
						if ( count( $arr_term_id ) > 0 ){
							$arr['tax_query'] = array(
								array(
									'taxonomy' => 'portfolio-category',
									'field'    => 'id',
									'terms'    => $arr_term_id,
								)
							);
						}
						
						$query = new WP_Query( $arr );
						
						$i = $j = 0;
						if( count( $query->posts ) > 0 ):
							while( $query->have_posts() ) : $query->the_post();
								include( $style[0] . '-' . $style[1] .'.php' );
								if ( $column == 4 && $i == 2 ){
									$j++;
								}
								$i++;
							endwhile;
						endif;
					?>
					
					<div class="bubblingG">
						<span id="bubblingG_1"></span>
						<span id="bubblingG_2"></span>
						<span id="bubblingG_3"></span>
					</div>
		
				</div><!-- .article-loop -->
			
			</div><!-- .k2t-isotope-wrapper -->
		
		</div><!-- .portfolio-grid -->
	</div><!-- .k2t-portfolio-shortcode -->

	<?php //k2t_pagination( $query );?>
		
		<?php
		$return = ob_get_clean();
		wp_reset_query();
		$return = apply_filters( 'k2t_portfolio_return', $return );
		return $return;

	}
}
add_shortcode('portfolio','k2t_portfolio_shortcode');


/* ------------------------------------------------------- */
/* Portfolio Carousel
/* ------------------------------------------------------- */
if (!function_exists('k2t_portfolio_carousel_shortcode')){
	function k2t_portfolio_carousel_shortcode($atts,$content){
		extract(shortcode_atts(array(
			'categories'	=>  '',
			'number'		=>	'-1',
			'column'		=> 	'3',
			'portfolio_type'=> 	'portfolio',
			'link_detail'	=> 	'link',
			'effect_3d'		=>	'false',
			'padding'		=>	'false',
			'auto'			=>	'false',
			'auto_time'		=>	'5000',
			'speed'			=>	'300',
			'pager'			=>	'false',
			'navi'			=>	'true',
			'touch'			=>	'true',
			'mousewheel'	=>	'true',
			'loop'			=>	'true',
			'keyboard'		=>	'true',
			'belowtitle'	=>	'subtitle',
		), $atts));

		global $wp_embed, $blog_arr;
		$number = empty( $number ) ? -1 : $number;
		$arr_term_id = $arr_term = array();
		if ( !empty( $categories ) ){
			$arr_categories = explode( ',', $categories );
			foreach ( $arr_categories as $category_id ){
				$category_id = trim( $category_id );
				if ( !empty( $category_id ) ){
					if ( is_numeric( $category_id ) ){
						$term = get_term_by( 'id', $category_id, 'portfolio-category' );
					}else{
						$term = get_term_by( 'slug', $category_id, 'portfolio-category' );
					}
					if ( $term ){
						$arr_term[] = $term;
						$arr_term_id[] = $term->term_id;
					}	
				}
			}
		}
		
		//Global variable
		$cl = array('k2t-portfolio-shortcode');
		
		wp_enqueue_script('jquery-isotope');
		if ($effect_3d =='true') {
			wp_enqueue_script( 'idangerous-swiper-3dflow' );
		}
		if (!in_array($column,array('2','3','4','5'))) $column = '3';
		if (!in_array($belowtitle,array('subtitle','client','date','location'))) $belowtitle = 'subtitle';
		
		ob_start();
		$pagination_rand = rand(0,1000);

		$paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);	
		$arr = array(
			'post_type' 		=> 'post-portfolio',
			'posts_per_page' 	=> (int)$number,
			'order'				=> 'DESC',
			'post_status'		=> 'publish',
			'paged'				=> $paged,
			'orderby'			=> 'date'
		);
		if ( count( $arr_term_id ) > 0 ){
			$arr['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio-category',
					'field'    => 'id',
					'terms'    => $arr_term_id,
				)
			);
		}
		$query = new WP_Query($arr); 
		if($query->have_posts()):
		
		?>
		<div class="k2t-swiper-slider <?php if ($effect_3d=='true') echo 'k2t-3d-slider';?> k2t-project-carousel <?php if($padding=='true') echo ' has-padding';?>" 
			data-auto="<?php echo esc_attr($auto);?>" data-auto-time="<?php echo (int) $auto_time;?>" 
			data-speed="<?php echo ((int) $speed) ? ((int) $speed) : 300;?>" data-pager="<?php echo esc_attr($pager);?>" 
			data-navi="<?php echo esc_attr($navi);?>" data-touch="<?php echo esc_attr($touch);?>" 
			data-mousewheel="<?php echo esc_attr($mousewheel);?>" data-loop="true" 
			data-keyboard="<?php echo esc_attr($keyboard);?>" data-perview="<?php echo esc_attr($column);?>"
			>
			<div class="k2t-swiper-slider-inner">
				<div class="k2t-swiper-slider-inner-deeper">
					<div class="k2t-swiper-container" data-settings="">
						<div class="swiper-wrapper">
						
							<?php
								while($query->have_posts()): $query->the_post();
	
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
						
							<div class="swiper-slide">

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
								    
							        <div class="post-thumbnail thumbnail-image <?php if($format=='gallery') echo 'k2t-popup-gallery'?>">

							            <div class="layer-table">
							                <div class="layer-cell">
							                	<h2 class="title fadeInDown"><span><?php echo $title;?></span></h2>
							                	<div class="k2t-devices"><span><!----></span></div>
							                    <div class="k2t-mask-icon">
							                        <?php if (!empty($hover_link)){?>
							                            <a href="<?php echo esc_url ( $hover_link );?>" class="animated fadeInUp">
							                        <?php } else {?>
							                            <?php if($format=='video' && !empty($portfolio_video_format_url)):?>
							                                <a href="<?php echo esc_url ( $portfolio_video_format_url );?>" class="k2t-video-popup-link">
							                            <?php elseif( ( $format == 'audio' || $format == 'video' ) && !empty( $media_html ) ):?>
							                                <a href="#<?php echo $id;?>" class="k2t-audio-popup-link">
							                            <?php elseif($format=='gallery'):?>
							                                <a href="<?php echo esc_url ( $post_thumb_url );?>">
							                            <?php else:?>
							                                <a href="<?php echo esc_url ( $post_thumb_url );?>" class="k2t-popup-link">
							                            <?php endif;?>  
							                        <?php } ?>
							                        	<?php 
							                        	$icon_format = 'fa-expand';
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
							            
							            <!-- Popup Gallery with portfolio format = gallery -->    
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
								    
								</div></article><!-- .article -->

							</div>
							
							<?php endwhile; ?>
							
						</div><!-- .swiper-wrapper -->
					</div><!-- .swiper-container -->
					
					<?php if ($navi=='true'):?>
					<div class="k2t-swiper-navi">
						<ul>
							<li><a class="prev"><i class="fa fa-chevron-left"></i></a></li>
							<li><a class="next"><i class="fa fa-chevron-right"></i></a></li>
						</ul>	
					</div><!-- .k2t-swiper-navi -->
					<?php endif;?>
				
				</div><!-- .k2t-swiper-slider-inner-deeper -->
				
			</div><!-- .k2t-swiper-slider-inner -->
			
		</div>
		
		<?php endif; // have posts ?>
		
		<?php
		$return = ob_get_clean();
		wp_reset_query();
		$return = apply_filters('k2t_portfolio_return',$return);
		return $return;

	}
}
add_shortcode('portfolio_carousel','k2t_portfolio_carousel_shortcode');
?>