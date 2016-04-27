<?php if($portfolio_sidebar_content == 'show'):?>
	<div class="container">
    
        <div id="primary" class="site-content" role="main">
<?php else:?>
	<div id="primary" class="site-content" role="main">
    
    	<div class="container">
<?php endif;?>
        	<?php 
			switch($post_format){
				case 'gallery':
					$gallery_html = '';
					if(count($portfolio_gallery) > 0){
						foreach ( $portfolio_gallery as $slide ){
                            if(is_array($slide) && !empty($slide['ID'])){
								$image = wp_get_attachment_image($slide['ID'], 'thumb_1100x400');
                                $gallery_html .= '
									<div class="swiper-slide"> 
										'.$image.'
									</div><!-- .swiper-slide -->
								';
							}elseif(!empty($slide)){
								$image = wp_get_attachment_image($slide, 'thumb_1100x400');
                                $gallery_html .= '
									<div class="swiper-slide"> 
										'.$image.'
									</div><!-- .swiper-slide -->
								';
							}
						}
						echo '
							<div class="project-thumbnail post-thumbnail thumbnail-gallery">				
								<div class="k2t-swiper-slider" data-auto="false" data-auto-time="5000" data-speed="300" data-pager="true" data-navi="true" data-touch="true" data-mousewheel="false"  data-loop="true" data-keyboard="false" data-perview="1" data-pagination-selector="#gallery-format-pagination">
									<div class="k2t-swiper-slider-inner">
										<div class="k2t-swiper-slider-inner-deeper">
											<div class="k2t-swiper-container" data-settings="">
												<div class="swiper-wrapper">
													'.$gallery_html.'
												</div><!-- .swiper-wrapper -->
											</div><!-- .swiper-container -->
											
											<div class="k2t-swiper-navi">
												<ul>
													<li><a class="prev"><i class="fa fa-chevron-left"></i></a></li>
													<li><a class="next"><i class="fa fa-chevron-right"></i></a></li>
												</ul>	
											</div><!-- .k2t-swiper-navi -->
										
										</div><!-- .k2t-swiper-slider-inner-deeper -->
										
										<div class="pagination" id="gallery-format-pagination"></div>
									
									</div><!-- .k2t-swiper-slider-inner -->
									
								</div><!-- .k2t-swiper-slider -->
								
							</div><!-- .project-thumbnail -->
						';
					}
					break;
				case 'audio':
					$audio_html = '';
					if(count($portfolio_media_file) > 0 && is_array($portfolio_media_file)){
						$audio_html = do_shortcode('[audio src="'.$portfolio_media_file['url'].'"/]');
					}elseif(count($portfolio_media_file) > 0 && !is_array($portfolio_media_file)){
						$audio_html = do_shortcode('[audio src="'.wp_get_attachment_url($portfolio_media_file).'"/]');
					}else{
						$audio_html = $wp_embed->run_shortcode('[embed]' . $portfolio_audio_format_url . '[/embed]');
					}
					echo '
						<div class="project-thumbnail post-thumbnail thumbnail-audio">
							<div class="media-container">
								'.$audio_html.'
							</div><!-- .media-container -->
						</div><!-- .post-thumbnail -->
					';
					break;
				case 'video':
					$video_html = '';
					if(!empty($portfolio_video_code)){
						$video_html = $portfolio_video_code;
					}elseif(!empty($portfolio_video_format_url)){
						$video_html = $wp_embed->run_shortcode('[embed]' . $portfolio_video_format_url . '[/embed]');
					}elseif(count($portfolio_media_file) > 0 && is_array($portfolio_media_file)){
						$video_html = do_shortcode('[video src="'.$portfolio_media_file['url'].'"/]');
					}elseif(count($portfolio_media_file) > 0 && !is_array($portfolio_media_file)){
						$video_html = do_shortcode('[video src="'.wp_get_attachment_url($portfolio_media_file).'"/]');
					}
					echo '
						<div class="project-thumbnail post-thumbnail thumbnail-video thumbnail-vimeo">
							<div class="media-container">
								'.$video_html.'
							</div><!-- .media-container -->
						</div><!-- .post-thumbnail -->
					';
					break;
				default:
					if(has_post_thumbnail(get_the_ID())):
						$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
						echo '<div class="project-thumbnail post-thumbnail">
							<a href="'.esc_url ( $thumb_src[0] ).'" class="k2t-popup-link">'.get_the_post_thumbnail(get_the_ID(), 'full', array('alt'   => get_the_title())).'</a>
						</div><!-- .project-thumbnail -->';
            		endif;
					break;
			}
			?>
            
            <div class="project-text">
		
        		<?php if($single_display_meta == 'show' && $portfolio_sidebar_content != 'show'):?>
                <div class="project-fields">
                    <div class="project-fields-inner">
                    
                        <?php ob_start();?>
				        	<?php if(!empty($portfolio_client)):?>
				            <li><span class="key"><?php _e('Client', 'k2t');?> :</span><span class="value"><?php echo $portfolio_client;?></span></li>
							<?php endif;?>
				            <?php if(!empty($portfolio_location)):?>
				            <li><span class="key"><?php _e('Location', 'k2t');?> :</span><span class="value"><?php echo $portfolio_location;?></span></li>
							<?php endif;?>
				            <?php if(!empty($portfolio_period)):?>
				            <li><span class="key"><?php _e('Period', 'k2t');?> :</span><span class="value"><?php echo $portfolio_period;?></span></li>
							<?php endif;?>
				            <?php if(!empty($portfolio_custom_name) && !empty($portfolio_custom_value)):?>
				            <li><span class="key"><?php echo $portfolio_custom_name;?> :</span><span class="value"><?php echo $portfolio_custom_value;?></span></li>
							<?php endif;?>
				        <?php $portfolio_metadata =  ob_get_clean();?>	
				        
				        <?php $portfolio_metadata = trim($portfolio_metadata); if ( !empty( $portfolio_metadata ) ) : ?>
				        <div class="project-fields-list">
				            <ul>
				            	<?php echo $portfolio_metadata;?>
				            </ul>
				        </div><!-- .project-fields-list -->
				        <?php endif;?>	
                        
                        <?php if(!empty($portfolio_link)):?>
                        <div class="k2t-project-launch">
                            <a href="<?php echo esc_url ( $portfolio_link );?>" target="_blank" class="k2t-btn">
                                <?php echo !empty($portfolio_text_link) ? $portfolio_text_link : __('Launch Project', 'k2t'); ?> &rarr;
                            </a>
                        </div><!-- .k2t-project-launch -->
                        <?php endif;?>
                        
                    </div><!-- .project-fields-inner -->
                </div><!-- .project-fields -->
                <?php endif;?>
            
                <div class="project-content">
                    <?php the_content();?>
                </div><!-- .project-content -->

                <?php 
                	ob_start();
                	k2t_social_share();
                	$html_social_share = ob_get_clean();
                	if ( !empty( $html_social_share ) ) :
                ?>
	                <div class="k2t-portfolio-share">
	                	<div class="previous-link"><?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i>', TRUE, array(), 'portfolio-category' ); ?></div>
	                	<?php echo $html_social_share; ?>
	                	<div class="next-link"><?php next_post_link( '%link', '<i class="fa fa-angle-right"></i>', TRUE, array(), 'portfolio-category' ); ?></div>
	                </div>
	            <?php else:?>
	            	 <div class="k2t-portfolio-share">
	                	<div class="previous-link"><?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i>', TRUE, array(), 'portfolio-category' ); ?></div>
	                	<div class="next-link"><?php next_post_link( '%link', '<i class="fa fa-angle-right"></i>', TRUE, array(), 'portfolio-category' ); ?></div>
	                </div>
            	<?php endif;?>
                
            </div><!-- .project-text -->
            
			
            <?php if( $portfolio_display_related_post == '1' && $portfolio_sidebar_content != 'show') include ( 'portfolio-factor.php' ); ?>

            <?php 
            	if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
            ?>
		
			<div class="clearfix"></div>

<?php if( $portfolio_sidebar_content == 'show' ):?>
		</div><!-- #primary -->
        
       	<div id="secondary">
            <div class="sidebar-inner">

            	<?php if(!empty($portfolio_sidebar_text)):?>
                <div class="sidebar-content">
                	<h3><?php _e( 'Description', 'k2t' );?></h3>
                    <?php echo $portfolio_sidebar_text;?>
                </div><!-- .sidebar-content -->	
                <?php endif;?>
                
                <div class="project-fields">
                    <div class="project-fields-inner">
                    
                        <?php ob_start();?>
				        	<?php if(!empty($portfolio_client)):?>
				            <li><span class="key"><?php _e('Client', 'k2t');?> :</span><span class="value"><?php echo $portfolio_client;?></span></li>
							<?php endif;?>
				            <?php if(!empty($portfolio_location)):?>
				            <li><span class="key"><?php _e('Location', 'k2t');?> :</span><span class="value"><?php echo $portfolio_location;?></span></li>
							<?php endif;?>
				            <?php if(!empty($portfolio_period)):?>
				            <li><span class="key"><?php _e('Period', 'k2t');?> :</span><span class="value"><?php echo $portfolio_period;?></span></li>
							<?php endif;?>
				            <?php if(!empty($portfolio_custom_name) && !empty($portfolio_custom_value)):?>
				            <li><span class="key"><?php echo $portfolio_custom_name;?> :</span><span class="value"><?php echo $portfolio_custom_value;?></span></li>
							<?php endif;?>
				        <?php $portfolio_metadata =  ob_get_clean();?>	
				        
				        <?php $portfolio_metadata = trim( $portfolio_metadata ); if ( !empty( $portfolio_metadata ) ) : ?>
				        <div class="project-fields-list">
				            <ul>
				            	<?php echo $portfolio_metadata;?>
				            </ul>
				        </div><!-- .project-fields-list -->
				        <?php endif;?>
                        
                        <?php if(!empty($portfolio_link)):?>
                        <div class="k2t-project-launch">
                            <a href="<?php echo esc_url ( $portfolio_link );?>" target="_blank" class="k2t-btn">
                                <?php echo !empty($portfolio_text_link) ? $portfolio_text_link : __('Launch Project', 'k2t'); ?> &rarr;
                            </a>
                        </div><!-- .k2t-project-launch -->
                        <?php endif;?>
                        
                    </div><!-- .project-fields-inner -->
                </div><!-- .project-fields -->
            
            </div><!-- .sidebar-inner -->
        </div><!-- #secondary -->

        <div id="k2t-end-sidebar-sticky"></div>
    
	</div><!-- .container -->
    
    <div class="container k2t-portfolio-factor" id="k2t_portfolio_factor">
    <?php if ( $portfolio_display_related_post == '1' ): ?>
		<?php include ( 'portfolio-factor.php' );?>
	<?php endif;?>
	</div><!-- .container -->
<?php else:?>
		</div><!-- .container -->
    
    </div><!-- #primary -->
<?php endif;?>