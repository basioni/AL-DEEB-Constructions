<?php
/**
 * Shortcode icon box list.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_iconbox_list_shortcode' ) ) {
	function k2t_iconbox_list_shortcode( $atts, $content ) {
		$html = $style = $icon = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = '';
		extract( shortcode_atts( array(
			'style'            => '',
			'align'            => 'left',
			'icon'             => 'false',
			'anm'              => '',
			'anm_name'         => '',
			'anm_delay'        => '',
			'id'               => '',
			'class'            => '',
			'content_icon_box' => '',
		), $atts ) );

		//Global $cl
		$cl = array( 'k2t-iconbox-list' );

		$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$class = ( $class != '' ) ? ' ' . $class . '' : '';

		/*-----------Style-------------*/
		if ( ! in_array( trim( $style ), array( '1', '2', '3' ) ) ) { $cl[] = 'style-1'; } else { $cl[] = 'style-' . trim( $style ); }

		/*-----------Align-------------*/
		$cl[] = 'align-' . $align;

		//Apply filters to cl
		$cl = apply_filters( 'k2t_iconbox_list_classes', $cl );

		//Join cl class
		$cl = join( ' ', $cl );

		if ( !preg_match_all( "/(.?)\[(li)\b(.*?)(?:(\/))?\]/s", $content, $matches ) ) {
			return do_shortcode( $content );
		} else {
			$html = '<div class="' . trim( $cl ) . $class . '">';
			$html .= do_action( 'k2t_iconbox_list_open' );
			$html .= '<ul>';
			for ( $i = 0; $i < count( $matches[0] ); $i++ ):
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			
				// Check isset value of [li] to set for a <li>
				$title     = isset( $matches[3][$i]['title'] ) ? trim( $matches[3][$i]['title'] ) : '';
				$icon      = isset( $matches[3][$i]['icon'] ) ? trim( $matches[3][$i]['icon'] ) : '';
				$anm       = isset( $matches[3][$i]['anm'] ) ? trim( $matches[3][$i]['anm'] ) : '';
				$anm_name  = isset( $matches[3][$i]['anm_name'] ) ? trim( $matches[3][$i]['anm_name'] ) : '';
				$anm_delay = isset( $matches[3][$i]['anm_delay'] ) ? trim( $matches[3][$i]['anm_delay'] ) : '';

				$title_html = ( empty( $title ) ) ? '' : '<h4 class="title">' . $title . '</h4>';
				$icon_html = ( empty( $icon ) ) ? '' : '<div class="iconbox-list-icon"><i class="' . esc_attr( $icon ) . '"></i></div>';

				if ( $anm ) {
					$anm        = ' animated';
					$data_name  = ' data-animation="' . $anm_name . '"';
					$data_delay = ' data-animation-delay="' . $anm_delay . '"';
				}
				$content_icon_box = !empty( $matches[3][$i]['content_icon_box'] ) ? do_shortcode( $matches[3][$i]['content_icon_box'] ) : '';
				$html .= '<li class="' . $anm . '" ' . $data_name . $data_delay . $id . '><div class="k2t-iconbox-list-inner">' . $icon_html . '<div class="iconbox-list-text">' . $title_html . '<div class="desc">' . $content_icon_box . '</div></div></div></li>';
			endfor;
			$html .= '</ul>';
			$html .= do_action( 'k2t_iconbox_list_close' );
			$html .= '</div>';

			//Apply filters return
			$html = apply_filters( 'k2t_iconbox_list_return', $html );

			return $html;
		}
	}
}
