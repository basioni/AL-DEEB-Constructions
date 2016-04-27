<?php
/**
 * Shortcode clear.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_clear_shortcode' ) ) {
	function k2t_clear_shortcode( $atts, $content = null ) {

		$cl = array( 'clearfix' );

		//Apply filters to cl
		$cl = apply_filters( 'k2t_clear_classes', $cl );

		//Join cl class
		$cl = join( ' ', $cl );

		$html = '<div class="'.esc_attr( trim( $cl ) ).'">';
		$html .= do_action( 'k2t_clear_open' );
		$html .= do_action( 'k2t_clear_close' );
		$html .= '</div>';

		//Apply filters return
		$html = apply_filters( 'k2t_clear_return', $html );

		return $html;
	}
}
