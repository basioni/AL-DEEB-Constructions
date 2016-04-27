<?php
/**
 * Shortcode countdown.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_countdown_shortcode' ) ) {
	function k2t_countdown_shortcode( $atts, $content = NULL ) {
		$html =  $time = $year = $month = $day = $hour = $minute = $second = $fontsize = $align = $background_color = $text_color = $id = $class = '';
		extract( shortcode_atts( array(
			'style'			   => 'square',
			'time'             => '2015-11-11-11-11-11',
			'year'             => __( 'Year(s)', 'k2t' ),
			'month'            => __( 'Month(s)', 'k2t' ),
			'day'              => __( 'Day(s)', 'k2t' ),
			'hour'             => __( 'Hour(s)', 'k2t' ),
			'minute'           => __( 'Minute(s)', 'k2t' ),
			'second'           => __( 'Second(s)', 'k2t' ),
			'fontsize'         => '',
			'align'            => 'left',
			'background_color' => '',
			'text_color'       => '',
			'id'               => '',
			'class'            => '',
		), $atts ) );

		//Enqueue countdown js
		wp_enqueue_script( 'k2t-countdown' );

		//Global $cl and $style
		$cl = array( 'k2t-countdown' );
		$cl[] = 'countdown-' . $style;
		$style = array();

		$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$class = ( $class != '' ) ? ' ' . $class . '' : '';

		/*--------------------Year--------------------*/
		if ( trim( $year ) != '' ) { $year = trim( $year ); } else { $year = 'Year(s)'; }

		/*--------------------Month--------------------*/
		if ( trim( $month ) != '' ) { $month = trim( $month ); } else { $month = 'Month(s)'; }

		/*--------------------Day--------------------*/
		if ( trim( $day ) != '' ) { $day = trim( $day ); } else { $day = 'Day(s)'; }

		/*--------------------Hour--------------------*/
		if ( trim( $hour ) != '' ) { $hour = trim( $hour ); } else { $hour = 'Hour(s)'; }

		/*--------------------Minute--------------------*/
		if ( trim( $minute ) != '' ) { $minute = trim( $minute ); } else { $minute = 'Minute(s)'; }

		/*--------------------Second--------------------*/
		if ( trim( $second ) != '' ) { $second = trim( $second ); } else { $second = 'Second(s)'; }

		/*-------------------Align--------------------*/
		if ( in_array( trim( $align ), array( 'left', 'right', 'center' ) ) ) { $cl[] = 'align-' . trim( $align ); } else { $cl[] = 'align-left'; }

		/*--------------------Fontsize---------------------*/
		if ( !is_numeric( trim( $fontsize ) ) ) {
			$num_style = '';
		} else {
			if ( trim( $fontsize ) < 25 ) {
				$cl[] = 'countdown-small-font';
				$padding = ( trim( $fontsize ) )*0.6;
				$padding_bottom = ( trim( $fontsize ) )*0.5;
				$num_style = ' style="font-size: ' . trim( $fontsize ) . 'px; padding-bottom: ' . $padding_bottom . 'px;"';
			} else {
				$num_style = '';
			}
		}

		/*--------------------Background Color--------------------*/
		if ( trim( $background_color ) != '' ) { $style[] = 'background-color: ' . trim( $background_color ); }

		/*--------------------Background Color--------------------*/
		if ( trim( $text_color ) != '' ) { $style[] = 'color: ' . trim( $text_color ); }

		//Apply filters to cl
		$cl = apply_filters( 'k2t_countdown_classes', $cl );

		//Join cl class
		$cl = join( ' ', $cl );

		//Join style
		if ( !empty( $style ) ) { $style = ' style="' . trim( join( '; ', $style ) ) . '"'; } else { $style = '';}

		$html = '<div ' . $id . ' class="' . esc_attr( trim( $cl ) ) . esc_attr( $class ) . '" data-time="' . $time . '">';
		$html .= do_action( 'k2t_countdown_open' );
		$html .= '<div class="inner">';
		$html .= '<div class="ele year"><span class="countdown-content"><span class="num"' . $num_style . $style . '>00</span><span class="unit">' . $year . '</span></span><span class="bulkhead">:</span></div>';
		$html .= '<div class="ele month"><span class="countdown-content"><span class="num"' . $num_style . $style . '>00</span><span class="unit">' . $month . '</span></span><span class="bulkhead">:</span></div>';
		$html .= '<div class="ele day"><span class="countdown-content"><span class="num"' . $num_style . $style . '>00</span><span class="unit">' . $day . '</span></span><span class="bulkhead">:</span></div>';
		$html .= '<div class="ele hour"><span class="countdown-content"><span class="num"' . $num_style . $style . '>00</span><span class="unit">' . $hour . '</span></span><span class="bulkhead">:</span></div>';
		$html .= '<div class="ele minute"><span class="countdown-content"><span class="num"' . $num_style . $style . '>00</span><span class="unit">' . $minute . '</span></span><span class="bulkhead">:</span></div>';
		$html .= '<div class="ele second"><span class="countdown-content"><span class="num"' . $num_style . $style . '>00</span><span class="unit">' . $second . '</span></span></div>';
		$html .= '</div>';
		$html .= do_action( 'k2t_countdown_close' );
		$html .= '</div>'; // count down

		//Apply filters return
		$html = apply_filters( 'k2t_countdown_return', $html );

		return $html;
	}
}
