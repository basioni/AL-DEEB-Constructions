<?php
/**
 * Shortcode brands.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_brands_shortcode' ) ) {
	$html = $column = $padding = $grayscale = $title = $tooltip = $link = $target = $tooltip = $class_tip = $anm = $anm_name = $anm_delay = $id = $class = '';
	function k2t_brands_shortcode( $args, $content ) {
		extract( shortcode_atts( array(
			'column'    => '4',
			'padding'   => 'false',
			'grayscale' => 'false',
			'title'     => '',
			'tooltip'   => '',
			'link'      => '',
			'target'    => '',
			'tooltip'   => '',
			'anm'       => '',
			'anm_name'  => '',
			'anm_delay' => '',
			'id'        => '',
			'class'     => '',
		), $args ) );

		//Global $cl
		$cl = array( 'k2t-brands' );

		if ( ! preg_match_all( "/(.?)\[(brand)\b(.*?)(?:(\/ ) )?\]/s", $content, $matches ) ) :
			return do_shortcode( $content );
		else :
			//Numbers band element
			$number_band = count( $matches[0] );

		/*----------------Brands column-----------------*/
		if ( ! in_array( trim( $column ), array( '1', '2', '3', '4', '5', '6', '7', '8' ) ) ) { $columns = '4';} else { $columns = trim( $column );}

		$cl[] = 'brands-'.$columns.'-columns';

		/*----------------Padding-----------------*/
		if ( trim( $padding ) == 'true' ) { $cl[] = 'has-padding';}

		/*----------------Grayscale-----------------*/
		if ( trim( $grayscale ) == 'true' ) { $cl[] = 'enable-grayscale';}

		//Apply filters to cl
		$cl = apply_filters( 'k2t_brands_classes', $cl );

		//Join cl class
		$cl = join( ' ', $cl );
		$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$class = ( $class != '' ) ? ' ' . $class . '' : '';

		$html = '<div ' . $id . ' class="' . trim( $cl ) . $class . '">';
		$html .= do_action( 'k2t_brands_open' );
		$html .= '<div class="brand-table"><div class="brand-row">';

		for ( $i = 0; $i < count( $matches[0] ); $i++ ):

			$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );

			$title     = isset( $matches[3][$i]['title'] ) ? trim( $matches[3][$i]['title'] ) : '';
			$tooltip   = isset( $matches[3][$i]['tooltip'] ) ? trim( $matches[3][$i]['tooltip'] ) : 'false';
			$link      = isset( $matches[3][$i]['link'] ) ? trim( $matches[3][$i]['link'] ) : '';
			$target    = isset( $matches[3][$i]['target'] ) ? trim( $matches[3][$i]['target'] ) : '_self';
			$anm       = isset( $matches[3][$i]['anm'] ) ? trim( $matches[3][$i]['anm'] ) : '';
			$anm_name  = isset( $matches[3][$i]['anm_name'] ) ? trim( $matches[3][$i]['anm_name'] ) : '';
			$anm_delay = isset( $matches[3][$i]['anm_delay'] ) ? trim( $matches[3][$i]['anm_delay'] ) : '';
			if ( $anm ) {
				$anm        = ' animated';
				$data_name  = ' data-animation="' . $anm_name . '"';
				$data_delay = ' data-animation-delay="' . $anm_delay . '"';
			}

			/*-----------Title-------------*/
			if ( $title == '' ) {
				$title_html = 'Brand '.( $i+1 ).' title';
				$alt_html = 'Brand '.( $i+1 );
			} else {
				$title_html = trim( $title );
				$alt_html = trim( $title );
			}

			/*-----------Get image-------------*/
			$img = $class_tip = '';
			if ( ! empty( $link ) ) {
				$img_id     = preg_replace( '/[^\d]/', '', $link );
				$image      = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '' ) );
				$image_link = $image['p_img_large'][0];
				$data 		= ( isset( $image_link ) && file_exists( $image_link ) ) ? getimagesize( $image_link ) : array('auto', 'auto');
				$width      = $data[0];
				$height     = $data[1];
				$img = '<img width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" src="'. esc_url ( $image['p_img_large'][0] ) .'" alt="'. esc_attr( $title_html ) .'" '. $class_tip .' />';
			}

			/*-----------Tooltip-------------*/
			if ( $tooltip == 'true' ) { $class_tip = ' class="hastip tooltip-top"'; wp_enqueue_script( 'k2t-tipsy' ); } else { $class_tip = '';}

			$data_name = $data_delay = '';
			$html .= '<div class="brand-cell ' . $anm . '" ' . $data_name . ' ' . $data_delay . '>'. $img .'</div>';

			//Check to add brand-row
			if ( ( ( ( $i+1 ) % $columns ) == '0' ) && ( ( $i+1 ) < $number_band ) ) {
				$html .= '</div><div class="brand-row">';
			}

		endfor;

		$html .= '</div></div>';
		$html .= do_action( 'k2t_brands_close' );
		$html .= '</div>';

		//Apply filters return
		$html = apply_filters( 'k2t_brands_return', $html );

		return $html;

		endif;
	}
}
