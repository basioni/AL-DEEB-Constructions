<?php
/**
 * Shortcode container.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_container_shortcode' ) ) {
	function k2t_container_shortcode( $atts, $content ) {
		return '<div class="container">'.do_shortcode( $content ).'</div>';
	}
}
