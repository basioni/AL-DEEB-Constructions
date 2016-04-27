<?php
/**
 * Shortcode testimonial.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_testimonial_shortcode' ) ) {
	function k2t_testimonial_shortcode( $atts, $content ) {
		$html = $style = $image = $name = $position = $align = $from = $link_name = $target = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = '';
		extract( shortcode_atts( array(
			'style'     => '',
			'image'     => $image,
			'align'     => 'left',
			'name'      => '',
			'position'  => '',
			'from'      => '',
			'link_name' => '',
			'target'    => '_blank',
			'anm'       => '',
			'anm_name'  => '',
			'anm_delay' => '',
			'id'        => '',
			'class'     => '',
		), $atts ) );

		$cl = array( 'k2t-testimonial style-' . $style );

		if ( $anm ) {
			$anm        = ' animated';
			$data_name  = ' data-animation="' . $anm_name . '"';
			$data_delay = ' data-animation-delay="' . $anm_delay . '"';
		}
		$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$class = ( $class != '' ) ? ' ' . $class . '' : '';
		$align = ( $align != '' ) ? ' ' . $align . '' : '';

		/*-------------Image------------*/
		$image_html = '';
		if ( !empty( $image ) ){
			if ( is_numeric( $image ) ){
				$img_id = preg_replace( '/[^\d]/', '', $image );
				$image    = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '' ) );
				$image_link = $image['p_img_large'][0];
				$data 		= ( isset( $image_link ) && file_exists( $image_link ) ) ? getimagesize( $image_link ) : array('auto', 'auto');
				$width      = $data[0];
				$height     = $data[1];
				$image_html = '<img width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" src="'. esc_url ( $image['p_img_large'][0] ) .'" alt="Avatar" />';
			}else{
				$image_html = '<img width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" src="'. esc_url ( $image ) .'" alt="Avatar" />';
			}
		}

		/*-------------Target------------*/
		if ( in_array( trim( $target ), array( '_blank', '_self' ) ) ) { $target = trim( $target ); } else { $target = '_blank'; }

		/*-------------Link Name------------*/
		if ( trim( $link_name ) != '' ) { $open_link = '<a href="' . esc_url ( trim( $link_name ) ) . '" target="' . $target . '">'; $close_link = '</a>'; } else { $open_link = ''; $close_link = ''; }

		/*-------------From------------*/
		if ( trim( $from ) != '' ) { $from_html = '<span class="testimonial-from">' . $open_link . trim( $from ) . $close_link . '</span>'; } else { $from_html = ''; }

		/*-------------Name------------*/
		if ( trim( $name ) != '' ) { $name_html = '<span class="testimonial-author">' . trim( $name ) . '</span>'; } else { $name_html = ''; }

		/*-------------Position------------*/
		if ( trim( $position ) != '' ) { $position_html = '<span class="testimonial-position">' . trim( $position ) . '</span>'; } else { $position_html = ''; }

		//Apply filters to cl
		$cl = apply_filters( 'k2t_testimonial_classes', $cl );

		//Join cl class
		$cl = join( ' ', $cl );

		if ( '1' == $style ) {
			$html = '<div class="' . trim( $cl ) . $anm . $class . '" ' . $data_name . $data_delay . $id . '>';
			$html .= do_action( 'k2t_testimonial_open' );
			$html .= '<div class="testimonial-inner ' . $align . '"><div class="testimonial-content"><div class="speech"><p>' . do_shortcode( $content ) . '</p></div></div><div class="testimonial-info">' . $image_html . '<div class="testimonial-meta">' . $name_html . $position_html . $from_html . '</div></div></div>';
			$html .= do_action( 'k2t_testimonial_close' );
			$html .= '</div>';
		} else if ( '3' == $style ) {
			$html = '<div class="' . trim( $cl ) . $anm . $class . '" ' . $data_name . $data_delay . $id . '>';
			$html .= do_action( 'k2t_testimonial_open' );
			$html .= '<div class="testimonial-inner ' . $align . '"><div class="testimonial-content"><div class="testimonial-avatar">' . $image_html . '</div><div class="speech"><p>' . do_shortcode( $content ) . '</p></div></div><div class="testimonial-info"><div class="testimonial-meta">' . $name_html . $position_html . $from_html . '</div></div></div>';
			$html .= do_action( 'k2t_testimonial_close' );
			$html .= '</div>';
		}else {
			$html = '<div class="' . trim( $cl ) . $anm . $class . '" ' . $data_name . $data_delay . $id . '>';
			$html .= do_action( 'k2t_testimonial_open' );
			$html .= '<div class="testimonial-inner ' . $align . '"><div class="testimonial-avatar">' . $image_html . '</div><div class="testimonial-content"><div class="speech"><p>' . do_shortcode( $content ) . '</p></div></div><div class="testimonial-info"><div class="testimonial-meta">' . $name_html . $position_html . $from_html . '</div></div></div>';
			$html .= do_action( 'k2t_testimonial_close' );
			$html .= '</div>';
		}
		

		//Apply filters return
		$html = apply_filters( 'k2t_testimonial_return', $html );

		return $html;
	}
}
