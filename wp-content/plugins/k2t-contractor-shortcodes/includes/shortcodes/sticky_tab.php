<?php
/**
 * Shortcode sticky tab.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_sticky_tab_shortcode' ) ) {
	function k2t_sticky_tab_shortcode( $atts, $content ) {
		$background_color = $padding_top = $padding_bottom = $title = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = '';
		extract( shortcode_atts( array(
			'background_color' => '',
			'padding_top'      => '40',
			'padding_bottom'   => '40',
			'title'            => '',
			'anm'              => '',
			'anm_name'         => '',
			'anm_delay'        => '',
			'id'               => '',
			'class'            => '',
			'content_tab'      => '',
		), $atts ) );

		// Global class
		$cl    = array( 'k2t-tab-sticky' );
		$style = array();
		$id    = rand();

		if ( $anm ) {
			$anm        = ' animated';
			$data_name  = ' data-animation="' . $anm_name . '"';
			$data_delay = ' data-animation-delay="' . $anm_delay . '"';
		}

		// Extra classes
		$class = ( $class != '' ) ? ' ' . $class . '' : '';

		// Backgound color
		if ( trim( $background_color ) != '' ) { $style[] = 'background-color: ' . trim( $background_color ); }

		// Padding top
		if ( is_numeric( trim( $padding_top ) ) ) { $style[] = 'padding-top: ' . trim( $padding_top ) . 'px'; }

		// Padding bottom
		if ( is_numeric( trim( $padding_bottom ) ) ) { $style[] = 'padding-bottom: ' . trim( $padding_bottom ) . 'px'; }

		if ( ! preg_match_all( "/(.?)\[(tab)\b(.*?)(?:(\/))?\]/s", $content, $matches ) ) :
			return do_shortcode( $content );
		else :
			wp_enqueue_script( 'k2t-stickyMojo' );

			// Apply filters to cl
			$cl = apply_filters( 'k2t_sticky_tab_classes', $cl );

			// Join cl class
			$cl = join( ' ', $cl );

			// Join $style
			if ( ! empty( $style ) ) {
				$style = ' style="' . esc_attr( trim( join( '; ', $style ) ) ) . '"';
			} else {
				$style = '';
			}

			$html = '<div ' . $data_name . $data_delay . ' class="' . esc_attr( trim( $cl ) ). $anm . $class . '" id="k2t-tab-sticky-' . esc_attr( $id ) . '" data-id="' . $id . '">';
			$html .= do_action( 'k2t_sticky_tab_open' );

			// Sticky tab
			$html .= '<nav class="tabsticky-nav" id="k2t-tabsticky-nav-' . esc_attr( $id ) . '"><ul>';

			for ( $i = 0; $i < count( $matches[0] ); $i++ ):
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );

				$title = isset( $matches[3][$i]['title'] ) ? trim( $matches[3][$i]['title'] ) : '';
				if ( $title == '' ) {$title = 'Sticky title ' . ( $i+1 ); }

				$html .= '<li><a ' . ( ( $i == 0 ) ? 'class="active"' : '' ) . ' href="#tab-' . ( $i+1 ) . '">' . $title . '</a></li>';

			endfor;

			$html .= '</ul></nav>';  /*-----End tabsticky-nav----*/

			// Sticky content
			$html .= '<div class="tabsticky-content" id="k2t-tabsticky-content-' . esc_attr( $id ) . '"' . $style . '>';

			for ( $i = 0; $i < count( $matches[0] ); $i++ ):

				$title = isset( $matches[3][$i]['title'] ) ? trim( $matches[3][$i]['title'] ) : '';
				if ( $title == '' ) { $title = 'Sticky title ' . ( $i+1 ); }

				$html .= '<section class="k2t-section ' . ( ( $i == 0 ) ? 'active' : '' ) . '" id="tab-' . ( $i+1 ) . '">' . do_shortcode( $matches[3][$i]['content_tab'] ) . '</section>';

			endfor;

			$html .= '</div>'; /*-----End tabsticky-content----*/
			$html .= do_action( 'k2t_sticky_tab_close' );
			$html .= '<div class="clearfix"></div><div id="k2t-tabsticky-footer-' . esc_attr( $id ) . '" class="k2t-tab-sticky-footer"></div></div>';

			$html .= '
				<scr' . 'ipt>
				(function($) {
					"use strict";
					$(document).ready(function() {
						var tab = $("#k2t-tabsticky-nav-' . $id . '");
						tab.find( "li a" ).on("click", function() {
							var parent = $(this).parent().parent().parent().parent();
							tab.find( "li a" ).each(function(){
								$(this).removeClass( "active" );
							});
							$(this).addClass( "active" );
							var active_content = $(this).attr( "href" );
							active_content = active_content.replace( "#", "" );
							var content = $("#k2t-tabsticky-content-' . $id . '", parent);
							content.find( "section" ).each(function(){
								$(this).removeClass( "active" );
							});
							content.find( "section#" + active_content ).addClass( "active" );
						});
					});
				})(jQuery);
				</scr' . 'ipt>
			';

			// Apply filters return
			return apply_filters( 'k2t_sticky_tab_return', $html );

		endif;
	}
}
