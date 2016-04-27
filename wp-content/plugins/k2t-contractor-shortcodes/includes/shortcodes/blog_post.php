<?php
/**
 * Shortcode k2t slider.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_blog_post_shortcode' ) ) {
	function k2t_blog_post_shortcode( $atts, $content ) {
		$html = $i = $style = $cat = $script = $limit = $slider_open = $slider_close = $items = $items_desktop = $items_tablet = $items_mobile = $navigation = $pagination = $p_class = $anm = $anm_name = $anm_delay = $id = $class = '';
		extract( shortcode_atts( array(
			'style'         => '4',
			'thumb_align'	=> 'top',
			'limit'	        => '-1',
			'cat'           => '',
			'slider'        => '',
			'items'         => '',
			'items_desktop' => '',
			'items_tablet'  => '',
			'items_mobile'  => '',
			'navigation'    => '',
			'pagination'    => '',
			'auto_play'     => '',
			'anm'           => '',
			'anm_name'      => '',
			'anm_delay'     => '',
			'id'            => '',
			'class'         => '',
		), $atts));

	$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
	$class = ( $class != '' ) ? ' ' . $class . '' : '';

	wp_enqueue_script( 'k2t-owlcarousel' );

	// Global variables
	global $post;

	// Filter post type
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $limit,
		'cat'            => $cat,
	);

	// The query
	$blog = new WP_query( $args );

	if ( $slider && ( '2' == $style || '4' == $style) ) {
		// Generate random id
		$length = 10;
		$ids     = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ), 0, $length );
		if ( $pagination ) { $p_class = 'pagi-bottm'; } else { $p_class = ''; }
		$slider_open = '<div id="' . esc_attr( $ids ) . '" class="post-slider ' . $p_class .'">';
		$slider_close = '</div>';
		
		// Set param for carousel
		$auto_play = ( $auto_play ) ? 'autoPlay: true,' : '';
		$navigation = ( $navigation ) ? 'navigation: true,' : 'navigation: false,';
		$pagination = ( $pagination ) ? 'pagination: false,' : 'pagination: false,';
		$script .= '<scr' . 'ipt>
			(function($) {
				"use strict";
				$(document).ready(function() {				
					$("#' . $ids . '").owlCarousel({
						items 					: ' . $items . ',
						itemsDesktop      		: [1199,' . $items_desktop . '],
						itemsDesktopSmall		: [979,' . $items_desktop . '],
						itemsTablet       		: [768,' . $items_tablet . '],
						itemsMobile       		: [479,' . $items_mobile . '],
						navigationText 			: ["<i class=\"fa fa-chevron-left\"></i>", "<i class=\"fa fa-chevron-right\"></i>"],'
						. $auto_play . $navigation . $pagination .'
					});
				});
			})(jQuery);
		</scr' . 'ipt>';
	}
	$html .= $slider_open;
	
	$i = 0;
	while ( $blog->have_posts() ) :
		$blog->the_post();

		$url             = get_permalink();
		$title           = get_the_title();
		$thumb_link      = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
		$thumb           = aq_resize( $thumb_link, 570, 310, true );
		$content         = get_the_content();
		$trimmed_content = wp_trim_words( strip_shortcodes( $content ), 17, '<a class="more-link" href="' . esc_url ( $url ) . '">Read More</a>' );

		$html .= '<article ' . $id . ' class="article isotope-selector ' . implode( ' ', get_post_class( 'k2t-blog-post k2t-blog-post-' . $style ) ) . $class . ( $blog->current_post%2 == 0 ? ' odd' : ' even' ) . '">';
		$html .= '<div class="article-inner">';
		$html .= '<div class="post-thumb">';
			if ( has_post_thumbnail() ) {
				$html .= '<div class="post-thumbnail thumbnail-image">';
				$html .= '<a href="'. esc_url ( $url ) .'"><img width="570" height="310" src="' . esc_url ( $thumb ) . '" alt="' . esc_attr( $title ) . '" /></a>';
				$html .= '<div class="k2t-time"><time datetime="'. get_the_date( 'c' ) .'">' . get_the_time( 'j M Y' ) . '</time></div>';
            	$html .= '</div>';
			}
		$html .= '</div>';
		$html .= '<div class="post-content">';
		$html .= '<h3><a href="' . esc_url ( $url ) . '">' . $title . '</a></h3>';
		$html .= '<p>' . $trimmed_content . '</p>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</article>';

		$i++;

	endwhile;

	// Restore original Post Data
	wp_reset_postdata();
	
	$html .= $slider_close;

	// Apply filters return
	$html = apply_filters( 'k2t_blog_post_return', $html );
	return $html . $script;
	}
}