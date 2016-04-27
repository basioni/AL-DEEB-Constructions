<?php
/**
 * The template for displaying post formats.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme options
global $smof_data, $post;

// Get blog style
$blog_style = $smof_data['blog-style'];

// Get post format
$post_format = get_post_format();

// Post format video
$video_source       = ( function_exists( 'get_field' ) ) ? get_field( 'video_format_source', get_the_ID() ) : '';
$video_source_link  = ( function_exists( 'get_field' ) ) ? get_field( 'video_url', get_the_ID() ) : '';
$video_source_embed = ( function_exists( 'get_field' ) ) ? get_field( 'video_code', get_the_ID() ) : '';
$video_source_local = ( function_exists( 'get_field' ) ) ? get_field( 'video_local', get_the_ID() ) : '';

// Post format audio
$audio_source       = ( function_exists( 'get_field' ) ) ? get_field( 'audio_format_source', get_the_ID() ) : '';
$audio_source_link  = ( function_exists( 'get_field' ) ) ? get_field( 'audio_url', get_the_ID() ) : '';
$audio_source_local = ( function_exists( 'get_field' ) ) ? get_field( 'audio_local', get_the_ID() ) : '';

// Post format gallery
$post_gallery = ( function_exists( 'get_field' ) ) ? get_field( 'post_gallery', get_the_ID() ) : array();
$auto_play    = ( function_exists( 'get_field' ) ) ? get_field( 'gallery_auto', get_the_ID() ) : '';
$duration     = ( function_exists( 'get_field' ) ) ? get_field( 'gallery_auto_time_wait', get_the_ID() ) : '';
$speed        = ( function_exists( 'get_field' ) ) ? get_field( 'gallery_speed', get_the_ID() ) : '';
$pagination   = ( function_exists( 'get_field' ) ) ? get_field( 'gallery_pagination', get_the_ID() ) : '';
$navigation   = ( function_exists( 'get_field' ) ) ? get_field( 'gallery_navigation', get_the_ID() ) : '';
$mouse        = ( function_exists( 'get_field' ) ) ? get_field( 'gallery_mousewheel', get_the_ID() ) : '';
if ( function_exists( 'k2t_pre_process_shortcode' ) ) {
	wp_enqueue_script( 'k2t-owlcarousel' );
	$script = '
		<scr' . 'ipt>
			(function($) {
				"use strict";
				$(document).ready(function() {
					$(".k2t-thumb-gallery").owlCarousel({
						singleItem: true,
						pagination: ' . esc_js( $pagination ) . ',
						navigation: ' . esc_js( $navigation ) . ',
						slideSpeed: ' . esc_js( $speed ) . ',
						rewindSpeed: ' . esc_js( $duration ) . ',
						navigationText: [
							"<i class=\"fa fa-angle-left\"></i>",
							"<i class=\"fa fa-angle-right\"></i>"
						],
						autoPlay: ' . esc_js( $auto_play ) . ',
					});
				});
			})(jQuery);
		</scr' . 'ipt>
	';
}

// Post format quote
$quote_author  = ( function_exists( 'get_field' ) ) ? get_field( 'quote_author', get_the_ID() ) : '';
$quote_link    = ( function_exists( 'get_field' ) ) ? get_field( 'author_quote_url', get_the_ID() ) : '';
$quote_content = ( function_exists( 'get_field' ) ) ? get_field( 'quote_content', get_the_ID() ) : '';
?>
<div class="k2t-thumb">
	<div class="k2t-meta">
		<?php if ( $smof_data['blog-date'] ) { ?>
			<div class="posted-on">
				<span class="d"><?php the_time( 'j' ); ?></span>
				<span class="my"><?php the_time( 'M' ); ?><span><?php the_time( 'Y' ); ?></span></span>
			</div>
		<?php } ?>
		
		<div class="posted-info">
			<?php if ( $smof_data['blog-author'] ) { ?>
				<div class="post-author">
					<?php echo sprintf( __( '<i class="fa fa-user"></i> Posted by %s', 'contractor' ), get_the_author_link() );?>
				</div>
			<?php } ?>

			<?php if ( $smof_data['blog-number-comment'] ) {
				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<div class="post-comment">
						<a href="<?php esc_url( comments_link() ); ?>"><i class="fa fa-comments-o"></i><?php comments_number( '0 Comment', '1 Comment', '% Comments' ); ?></a>
					</div>
				<?php
				endif;
			} ?>

			<?php
				if ( $smof_data['blog-categories-filter'] ) {
					$categories_list = get_the_category_list( __( ' - ', 'contractor' ) );
					if ( $categories_list ) :
						echo '<div class="post-cat">';
							printf( __( '<i class="fa fa-folder-open-o"></i>%1$s', 'contractor' ), $categories_list );
						echo '</div>';
					endif;
				}
			?>
		</div><!-- .posted-info -->
	</div><!-- .k2t-meta -->
	<?php
		switch ( $post_format ) :
			case 'video':
				if ( 'link' == $video_source ) :
					echo do_shortcode( '[vc_video link="' . esc_url( $video_source_link ) . '"/]' );
				elseif ( 'embed' == $video_source ) :
					echo $video_source_embed;
				elseif ( 'local' == $video_source ) :
					echo do_shortcode('[video src="' . esc_url( $video_source_local['url'] ) . '"/]');
				endif;
			break;

			case 'audio':
				if ( 'link' == $audio_source ) :
					global $wp_embed;
						$media_result = $wp_embed->run_shortcode( '[embed]' . esc_url( $audio_source_link ) . '[/embed]' );
					echo $media_result;
				elseif ( 'local' == $audio_source ) :
					echo do_shortcode('[audio src="' . esc_url( $audio_source_local['url'] ) . '"/]');
				endif;
			break;

			case 'gallery':
				if ( count( $post_gallery ) > 0 && is_array( $post_gallery ) ) :
					echo '<div class="k2t-thumb-gallery">';
						foreach ( $post_gallery as $slide ):

							if ( is_array( $slide ) && ! empty( $slide['ID'] ) ) : $image = wp_get_attachment_image( $slide['ID'], 'thumb_800x350' ); ?>
								<div class="item"> 
									<?php echo $image; ?>
								</div>

							<?php elseif ( ! empty( $slide ) ) : $image = wp_get_attachment_image( $slide, 'thumb_800x350' ); ?>
								<div class="item"> 
									<?php echo $image; ?>
								</div>
							<?php endif;

						endforeach;
					echo '</div>';
					echo $script;
				else :
					the_post_thumbnail( 'thumb_800x350' );
				endif;
			break;

			case 'quote': ?>
				<div class="k2t-thumb-quote">
					<div class="quote-content">
						<i class="fa fa-quote-left"></i>
						<?php echo $quote_content; ?>
					</div><!-- .quote-content -->
					<div class="quote-author">
						<a href="<?php echo esc_url( $quote_link ) ?>"><?php echo $quote_author ?></a>
					</div><!-- .quote-author -->
				</div><!-- .k2t-thumb-quote -->
			<?php
			break;

			break;
		default:
			if ( 'classic' == $blog_style ) {
				if ( has_post_thumbnail() ) :
					the_post_thumbnail( 'thumb_800x350' );
				else :
					echo '<img src="' . get_template_directory_uri() . '/assets/img/placeholder/800x350.png" alt="' . get_the_title() . '" />';
				endif;
			} else {
				if ( has_post_thumbnail() ) :
					the_post_thumbnail();
				endif;
			}		
		break;
	endswitch; ?>
</div><!-- .post-format -->