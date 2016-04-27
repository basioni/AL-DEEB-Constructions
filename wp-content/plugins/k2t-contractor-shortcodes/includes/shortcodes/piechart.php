<?php
/**
 * Shortcode pie chart.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_piechart_shortcode' ) ) {
	function k2t_piechart_shortcode( $atts, $content ) {
		$html = $percent = $color = $backgroundcolor_css = $trackcolor = $textcolor = $title = $text = $icon = $thickness = $speed = $delay = $size = $linecap = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = '';
		extract( shortcode_atts( array(
			'percent'    => '90',
			'color'      => '',
			'trackcolor' => '#eeeeee',
			'textcolor' => '',
			'textbackground'=> '',
			'title'      => '',
			'text'       => '',
			'icon'       => '',
			'thickness'  => '5',
			'speed'      => '600',
			'delay'      => '0',
			'size'       => '150',
			'linecap'    => 'butt',
			'anm'        => '',
			'anm_name'   => '',
			'anm_delay'  => '',
			'id'         => '',
			'class'      => '',
		), $atts ) );

		wp_enqueue_script( 'k2t-easy-pie-chart' );
		wp_enqueue_script( 'k2t-inview' );

		$length = 10;
		if ( empty( $id ) ) $id = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ), 0, $length );

		//Global $cl $data
		$cl = array( 'k2t-piechart' );
		$data = array();

		if ( $anm ) {
			$anm        = ' animated';
			$data_name  = ' data-animation="' . $anm_name . '"';
			$data_delay = ' data-animation-delay="' . $anm_delay . '"';
		}
		$class = ( $class != '' ) ? ' ' . $class . '' : '';

		/*-----------Percent-------------*/
		if ( ! is_numeric( trim( $percent ) ) ) {
			$percent = '90';
		} else {
			$percent = trim( $percent );
		}

		/*-----------Color-------------*/
		if ( trim( $color ) == '' ) {
			$color = '#ffbe2a';
			$color_css = ' style="color: #ffbe2a"';
			$data[] = 'data-color="#ffbe2a"';
		} else {
			$color = trim( $color );
			$color_css = ' style="color: ' . esc_attr( trim( $color ) ) . '"';
			$data[] = 'data-color="' . $color . '"';
		}
		//Apply filters piechart
		apply_filters( 'k2t_piechart_default_color', $color );

		/*-----------Trackcolor-------------*/
		if ( trim( $trackcolor ) == '' ) {
			$data[] = 'data-trackcolor="#fff"';
		} else {
			$data[] = 'data-trackcolor="' . esc_attr( trim( $trackcolor ) ) . '"';
		}

		/*-----------Size-------------*/
		if ( ! is_numeric( trim( $size ) ) ) {
			$size = '150';
			$data[] = 'data-size="150"';
			$number_font_size = '22';
			$percent_font_size = '15';
			$text_font_size = '22';
			$icon_font_size = $number_font_size;
		} else {
			$size = trim( $size );
			$data[] = 'data-size="' . trim( $size ) . '"';
			$number_font_size = $size*( 3/10 );
			$percent_font_size = $size*( 1/10 );
			$text_font_size = $size*( 2/10 );
			$icon_font_size = $size*( 16/100 );
		}

		/*-----------Thickness-------------*/
		if ( ! is_numeric( trim( $thickness ) ) ) {
			$thickness = '5';
			$data[] = 'data-thickness="5"';
		} else {
			$thickness = trim( $thickness );
			$data[] = 'data-thickness="' . trim( $thickness ) . '"';
		}

		/*-----------Speed-------------*/
		if ( ! is_numeric( trim( $speed ) ) ) {
			$speed = '600';
			$data[] = 'data-speed="600"';
		} else {
			$speed = trim( $speed );
			$data[] = 'data-speed="' . $speed . '"';
		}

		/*-----------Linecap-------------*/
		if ( ! in_array( trim( $linecap ), array( 'round', 'square', 'butt' ) ) ) {
			$linecap = '0';
			$data[] = 'data-linecap="butt"';
		} else {
			$linecap = trim( $linecap );
			$data[] = 'data-linecap="' . $linecap . '"';
		}

		/*-----------Delay-------------*/
		if ( ! is_numeric( trim( $delay ) ) ) {
			$delay = '0';
			$data[] = 'data-delay="0"';
		} else {
			$delay = trim( $delay );
			$data[] = 'data-delay="' . $delay . '"';
		}

		/*-----------Text color-------------*/
		if ( trim( $textcolor ) != '' ) {
			$color_css = ' style="color: ' . esc_attr( trim( $textcolor ) ) . '"';
		}

		/*-----------Text color-------------*/
		if ( !empty( $textbackground ) ) {
			$backgroundcolor_css = ' style="background-color: ' . esc_attr( trim( $textbackground ) ) . ';"';
		}

		/*-----------Title-------------*/
		if ( trim( $title ) == '' ) {
			$title_html = '';
		}else {
			$title_html = '<h3 class="title">' . trim( $title ) . '</h3>';
		}

		/*-----------Icon-------------*/
		if ( ( trim( $icon ) == '' ) && ( trim( $text ) == '' ) ) {
			// Generate random id
			$length = 10;
			$id     = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ), 0, $length );
			$type_icon = 'type-number';
			$html_icon = '<div class="chart-content"' . $color_css . '><div id="' . esc_attr( $id ) . '" class="chart-number" '. $backgroundcolor_css .'><span class="number">' . $percent . '</span><span class="percent" style="visibility: visible;">%</span></div></div>';
		} elseif ( trim( $text ) != '' ) {
			$type_icon = 'type-text';
			$html_icon = '<div class="chart-content"' . $color_css . '><span class="chart-text" style="font-size: ' . $text_font_size . 'px;">' . trim( $text ) . '</span></div>';
		} else {
			$type_icon = 'type-icon';
			$html_icon = '<div class="chart-content"' . $color_css . '><div id="' . esc_attr( $id ) . '" class="chart-number" '. $backgroundcolor_css .'><div class="chart-icon"><i class="' . trim( $icon ) . '" style="line-height:' . $icon_font_size . 'px; font-size: ' . $icon_font_size . 'px;"></i><span class="number">' . $percent . '</span><span class="percent" style="visibility: visible;">%</span></div></div></div>';
		}

		//Add class type-text to cl
		$cl[] = $type_icon;

		//Apply filters to cl
		$cl = apply_filters( 'k2t_piechart_classes', $cl );

		//Join cl class
		$cl = join( ' ', $cl );

		//Join data of piechart
		$data = join( ' ', $data );

		$html = '<div ' . $data_name . $data_delay . $id . ' class="' . trim( $cl ). $anm . $class . '" ' . trim( $data ) . '>';
		$html .= do_action( 'k2t_piechart_open' );
		$html .= '<div class="chart" data-percent="' . $percent . '" style="width: ' . $size . 'px; height: ' . $size . 'px; line-height: ' . $size . 'px;">' . $html_icon . '</div><div class="text">' . $title_html . '<div class="desc">' . do_shortcode( $content ) . '</div></div>';
		$html .= do_action( 'k2t_piechart_close' );
		$html .= '</div>';
		$css_style = '
			<style>
				.k2t-piechart .chart:hover .chart-content #' . $id . '.chart-number {
					background: ' . $color . ';
				}
			</style>
		';

		//Apply filters return
		$html = apply_filters( 'k2t_piechart_return', $html . $css_style );

		return $html;
	}
}
