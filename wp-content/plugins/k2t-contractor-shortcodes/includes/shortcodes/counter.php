<?php
/**
 * Shortcode counter.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_counter_shortcode' ) ) {
	function k2t_counter_shortcode( $atts, $content ) {
		$html = $style_type = $border_color = $border_style = $border_width = $icon_type = $icon_font = $icon_size  = $icon_color  = $icon_background = $icon_border_color = $icon_border_style = $icon_border_width = $icon_graphic = $image_link = $number = $number_font_size = $number_color = $title = $title_font_size = $title_color = $speed = $delay = $anm = $anm_name = $anm_delay = $id = $class = $data_name = $data_delay = '';
		extract( shortcode_atts( array(
			'style_type'         => '',
			'border_color'       => '',
			'border_style'       => '',
			'border_width'       => '',
			'icon_type'          => '',
			'icon_font'          => '',
			'icon_size'          => '32px',
			'icon_color'         => '#ffbe2a',
			'icon_background'    => '',
			'icon_border_color'  => '',
			'icon_border_style'  => '',
			'icon_border_width'  => '',
			'icon_border_radius' => '',
			'icon_graphic'       => $icon_graphic,
			'number'             => '',
			'number_font_size'   => '50px',
			'number_color'       => '#4f4f4f',
			'title'              => '',
			'title_font_size'    => '16px',
			'title_color'        => '#949494',
			'speed'              => '1000',
			'delay'              => '0',
			'anm'                => '',
			'anm_name'           => '',
			'anm_delay'          => '',
			'id'                 => '',
			'class'              => '',
		), $atts ) );

		wp_enqueue_script( 'k2t-countTo' );
		wp_enqueue_script( 'k2t-inview' );

		//Global $cl $data
		if ( '1' == $style_type ) {
			$cl = array( 'k2t-counter icon-top' );
		} else {
			$cl = array( 'k2t-counter icon-left' );
		}
		$style = $icon_css = $number_css = $title_css = array();

		if ( $anm ) {
			$anm        = ' animated';
			$data_name  = ' data-animation="' . $anm_name . '"';
			$data_delay = ' data-animation-delay="' . $anm_delay . '"';
		}
		$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$class = ( $class != '' ) ? ' ' . $class . '' : '';

		// Get image
		$img = '';
		if ( ! empty( $icon_graphic ) ) {
			$img_id     = preg_replace( '/[^\d]/', '', $icon_graphic );
			$image      = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '' ) );
			$image_link = $image['p_img_large'][0];
			$data 		= ( isset( $image_link ) && file_exists( $image_link ) ) ? getimagesize( $image_link ) : array('auto', 'auto');
			$width      = $data[0];
			$height     = $data[1];
			$img = '<img width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" class="icon-graphic" src="' . esc_url ( $image['p_img_large'][0] ) . '" alt="' . esc_attr( $title ) . '" />';
		}

		// Icon parameter
		if ( trim( $icon_font ) != '' ) { $icon_html = '<i class="' . esc_attr( $icon_font ) . '"></i>'; } else { $icon_html =''; }

		if ( trim( $icon_size ) != '' ) {
			if ( is_numeric( $icon_size ) ) {
				$icon_css[] = 'font-size: ' . trim( $icon_size ) . 'px';
			} else {
				$icon_css[] = 'font-size: ' . trim( $icon_size );
			}
			
		}
		if ( trim( $icon_color ) != '' ) {
			$icon_css[] = 'color: ' . trim( $icon_color );
		}
		if ( trim( $icon_background ) != '' ) {
			$icon_css[] = 'background: ' . trim( $icon_background );
		}
		if ( trim( $icon_border_width ) != '' ) {
			if ( is_numeric( $icon_border_width ) ) {
				$icon_css[] = 'border-width: ' . trim( $icon_border_width ) . 'px';
			} else {
				$icon_css[] = 'border-width: ' . trim( $icon_border_width );
			}
			
			$icon_css[] = 'border-color: ' . trim( $icon_border_color );
			$icon_css[] = 'border-style: ' . trim( $icon_border_style );
		}
		if ( trim( $icon_border_radius ) != '' ) {
			if ( is_numeric( $icon_border_radius ) ) {
				$icon_css[] = 'border-radius: ' . trim( $icon_border_radius ) . 'px';
			} else {
				$icon_css[] = 'border-radius: ' . trim( $icon_border_radius );
			}
		}

		// Remove height of icon if border and background empty
		if ( empty( $icon_background ) && empty( $icon_border_width ) && '2' != $style_type ) {
			$icon_css[] = 'height: auto;line-height: inherit;';
		}

		// Number parameter
		if ( ! is_numeric( trim( $number ) ) ) { $number = '0'; } else { $number = trim( $number ); }

		if ( trim( $number_font_size ) != '' ) {
			$number_css[] = 'font-size: ' . trim( $number_font_size ) . 'px';
		}
		if ( trim( $number_color ) != '' ) {
			$number_css[] = 'color: ' . trim( $number_color );
		}

		// Title parameter
		if ( trim( $title_font_size ) != '' ) {
			if ( is_numeric( $title_font_size ) ) {
				$title_css[] = 'font-size: ' . trim( $title_font_size ) . 'px';
			} else {
				$title_css[] = 'font-size: ' . trim( $title_font_size );
			}
		}
		if ( trim( $title_color ) != '' ) {
			$title_css[] = 'color: ' . trim( $title_color );
		}
		if ( trim( $title ) != '' ) { $title_html = '<span style="' . implode( ';', $title_css ) . '" class="title">' . trim( $title ) . '</span>'; } else { $title_html = ''; }

		// Animation delay
		if ( ! is_numeric( trim( $delay ) ) ) { $delay = '0'; } else { $delay = trim( $delay ); }

		// Animation speed
		if ( ! is_numeric( trim( $speed ) ) ) { $speed = '1000'; } else { $speed = trim( $speed ); }

		// Apply filters to cl
		$cl = apply_filters( 'k2t_counter_classes', $cl );

		// Join cl class
		$cl = join( ' ', $cl );

		// Border outline
		if ( trim( $border_width ) != '' ) {
			if ( is_numeric( $border_width ) ) {
				$style[] = 'border-width: ' . trim( $border_width ) . 'px';
			} else {
				$style[] = 'border-width: ' . trim( $border_width );
			}
			
			$style[] = 'border-color: ' . trim( $border_color );
			$style[] = 'border-style: ' . trim( $border_style );
			$style[] = 'padding: 20px';
		}

		// Join Style
		if ( ! empty( $style ) ) { $style_html = ' style="' . trim( join( ';', $style ) ) . '"'; } else { $style_html = ''; }

		$html = '<div class="' . trim( $cl ). $anm . $class . '"' . $style_html . ' data-delay="' . $delay . '" ' . $data_name . $data_delay . $id . '>';
		$html .= do_action( 'k2t_counter_open' );
		$html .= '<div class="counter-inner" >';

		if ( 'icon_font' == $icon_type ) {
			$html .= '<div style="' . implode( ';', $icon_css ) . '" class="counter-icon">' . $icon_html . '</div>';	
		} else {
			$html .= $img;
		}
		
		$html .= '<div class="counter-number">';
		$html .= '<h2 style="' . implode( ';', $number_css ) . '" class="number" data-from="0" data-to="' . $number . '" data-speed="' . $speed . '" data-delayrefresh-interval="10">0</h2>';
		$html .= '</div>';
		$html .= '<div class="counter-text">' . $title_html . '<div class="desc">' . do_shortcode( $content ) . '</div></div>';
		$html .= '</div>';
		$html .= do_action( 'k2t_counter_close' );
		$html .= '</div>';

		//Apply filters return
		$html = apply_filters( 'k2t_counter_return', $html );

		return $html;
	}
}
