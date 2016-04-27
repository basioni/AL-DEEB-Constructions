<?php
/**
 * Shortcode event.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_event_shortcode' ) ) {
	function k2t_event_shortcode( $atts, $content ) {
		$html = $style = $date = $month = $event_title = $start_time = $end_time = $link = $target = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = $bg_color = '';
		extract( shortcode_atts( array(
			'background_color'    => '',
			'border_top_width'    => '',
			'border_top_color'    => '',
			'border_bottom_width' => '',
			'border_bottom_color' => '',
			'date'                => '',
			'month'	              => '',
			'event_title'         => '',
			'start_time'          => '',
			'end_time'            => '',
			'link'                => '',
			'target'              => '',
			'anm'                 => '',
			'anm_name'            => '',
			'anm_delay'           => '',
			'id'                  => '',
			'class'               => '',
		), $atts));

		$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$class = ( $class != '' ) ? ' ' . $class . '' : '';

		if ( $background_color ) {
			$bg_color .= 'background-color: ' . trim( $background_color ) . ';';
		}
		if ( $border_top_width ) {
			$style .= 'border-top-width: ' . $border_top_width . 'px;';
		}
		if ( $border_top_color ) {
			$style .= 'border-top-color: ' . trim( $border_top_color ) . ';';
		}
		if ( $border_bottom_width ) {
			$style .= 'border-bottom-width: ' . $border_bottom_width . 'px;';
		}
		if ( $border_bottom_color ) {
			$style .= 'border-bottom-color: ' . trim( $border_bottom_color ) . ';';
		}

		if ( $anm ) {
			$anm        = ' animated';
			$data_name  = ' data-animation="' . $anm_name . '"';
			$data_delay = ' data-animation-delay="' . $anm_delay . '"';
		}

		$html .= '<div class="k2t-event ' . $class . $anm . '" ' . $id . $data_name . $data_delay . ' style="' . $bg_color . ';">';
		$html .= '<div class="k2t-event-inner" style="' . $style . '">';
		$html .= '<div class="time">';
		$html .= '<div class="date">' . $date . '</div>';
		$html .= '<div class="month">' . $month . '</div>';
		$html .= '</div>';
		$html .= '<div class="event-info">';
		$html .= '<h5><a href="' . esc_url ( $link ) . '" target="' . $target . '">' . $event_title . '</a></h5>';
		$html .= '<div class="hour">' . $start_time . ' - ' . $end_time . '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

		// Apply filters return
		$html = apply_filters( 'k2t_event_return', $html );
		return $html;
	}
}