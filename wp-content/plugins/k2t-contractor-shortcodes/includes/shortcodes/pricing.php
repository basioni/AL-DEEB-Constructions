<?php
/**
 * Shortcode pricing.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_pricing_shortcode' ) ) {
	function k2t_pricing_shortcode( $atts, $content ) {
		$html = $separated = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = '';
		extract( shortcode_atts( array(
			'separated' 		=> 'false',
			'anm'       		=> '',
			'anm_name'  		=> '',
			'anm_delay' 		=> '',
			'id'        		=> '',
			'class'     		=> '',
			'pricing_content' 	=> '',
		), $atts ) );

		//Global $cl
		$cl = array( 'k2t-pricing' );
		
		if ( $anm ) {
			$anm        = ' animated';
			$data_name  = ' data-animation="' . $anm_name . '"';
			$data_delay = ' data-animation-delay="' . $anm_delay . '"';
		}
		$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$class = ( $class != '' ) ? ' ' . $class . '' : '';

		if ( !preg_match_all( "/(.?)\[(pricing_column)\b(.*?)(?:(\/))?\]/s", $content, $matches ) ) {
			return do_shortcode( $content );
		} else {
			$number_pricing_column = count( $matches[0] );
			//Add class number process
			$cl[] = 'pricing-'.$number_pricing_column;

			//Check has-del
			$old_price_check = '';
			for ( $i = 0; $i < count( $matches[0] ); $i++ ):
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
				$price_get = isset( $matches[3][$i]['price'] ) ? trim( $matches[3][$i]['price'] ) : '';
				$old_price_get = isset( $matches[3][$i]['old_price'] ) ? trim( $matches[3][$i]['old_price'] ) : '';
				if ( $old_price_get != '' ) {
					$old_price_check .= $old_price_get;
				}else {
					$old_price_check .= '';
				}
				//Check isset price
				$price_check = '';
				if ( $price_get != '' ) {
					$price_check .= 'a';
				}else {
					$price_check .= '';
				}

			endfor;

			if ( trim( $old_price_check ) == '' ) { $cl[] = 'no-del';} else {$cl[] = 'has-del';}

			//Check separated true or false
			if ( trim( $separated ) == 'true' ) { $cl[] = 'separated';}

			//Apply filters to cl
			$cl = apply_filters( 'k2t_pricing_classes', $cl );

			//Join cl class
			$cl = join( ' ', $cl );


			$html = '<div class="'.trim( $cl ) .'">';
			$html .= do_action( 'k2t_pricing_open' );
			$html .= '<div class="layer-table"><div class="layer-row">';
			for ( $i = 0; $i < count( $matches[0] ); $i++ ):
				//Get parameter of pricing column to set
				$title = isset( $matches[3][$i]['title'] ) ? trim( $matches[3][$i]['title'] ) : '';
				$price = isset( $matches[3][$i]['price'] ) ? trim( $matches[3][$i]['price'] ) : '';
				$old_price = isset( $matches[3][$i]['old_price'] ) ? trim( $matches[3][$i]['old_price'] ) : '';
				$unit = isset( $matches[3][$i]['unit'] ) ? trim( $matches[3][$i]['unit'] ) : '$';
				$unit_position = isset( $matches[3][$i]['unit_position'] ) ? trim( $matches[3][$i]['unit_position'] ) : 'left';
				$link = isset( $matches[3][$i]['link'] ) ? esc_url( trim( $matches[3][$i]['link'] ) ) : '';
				$link_text = isset( $matches[3][$i]['link_text'] ) ? trim( $matches[3][$i]['link_text'] ) : 'SIGN UP NOW';
				$target = isset( $matches[3][$i]['target'] ) ? trim( $matches[3][$i]['target'] ) : '_self';
				$featured = isset( $matches[3][$i]['featured'] ) ? trim( $matches[3][$i]['featured'] ) : 'false';
				$features_list = isset( $matches[3][$i]['features_list'] ) ? trim( $matches[3][$i]['features_list'] ) : 'false';
				$color = isset( $matches[3][$i]['color'] ) ? trim( $matches[3][$i]['color'] ) : '';
				$price_per = isset( $matches[3][$i]['price_per'] ) ? trim( $matches[3][$i]['price_per'] ) : '';

				//Title
				if ( $title != '' ) {$title_html = '<div class="pricing-title"><h4 class="title">'.$title.'</h4></div>';}else {$title_html = '';}
				
				//Unit 
				$unit_left_html = !empty( $unit ) ? '<span class="unit">'.$unit.'</span>' : '';

				// Price Per
				$price_per_html = !empty( $price_per ) ? ' <span class="per-source">/</span><span class="per-name">'. $price_per .'</span>' : '';

				//Price and old price
				$price_html = '';
				$featured_list_class = ( $features_list == 'true' ) ? ' features' : '';
				if ( $price_check != '' ) {
					$price_html .= '<div class="pricing-price">';
					$price_html .= '<div><span class="price">'. $unit_left_html .''. $price .'</span>'. $price_per_html .'</div>';
					$price_html .= !empty( $old_price_check ) ? '<div><span class="del">'. $unit . $old_price .'</span></div>' : '';
					$price_html .= '</div>';
				}

				//Featured
				if ( $featured != 'true' ) { $featured_class = '';} else {$featured_class = ' featured';}
				//Link
				$link = str_replace( 'http://', '', $link);
				$link = !empty( $link ) ? 'http://' . $link : '';
				//Target
				if ( $target != '_blank' ) {$target = '_self';}else {$target = '_blank';}
				//Color
				if ( $color == '' ) {
					$style_pricing_column = '';
					$class_transparent = '';
				}else {
					$class_transparent = ' btn-transparent';
				}
				//Check has button or not
				$button_html = !empty( $link ) ? '<div class="pricing-bottom">'. do_shortcode( '[button target="'. $target .'" link="'. $link .'" icon_position="right" size="medium" align="center" anm_name="bounce" title="'. $link_text .'" color="#4f4f4f"]' ) .'</div>' : '';
				$button_class = !empty( $button_html ) ? ' has-button' : '';

				$html .= '<div ' . $data_name . $data_delay . $id . ' class="pricing-column' . 
					$featured_class . $featured_list_class. $anm . $class . $button_class . '"' . $style_pricing_column . '>' . 
					$title_html . '<div class="title-price">' . $price_html . '</div><div class="pricing-content">' . 
					do_shortcode( $matches[3][$i]['pricing_content'] ) . '</div>' . $button_html . '</div>';

			endfor;

			$html .= '</div></div>';
			$html .= do_action( 'k2t_pricing_close' );
			$html .= '</div>';

			//Apply filters return
			$html = apply_filters( 'k2t_pricing_return', $html );

			return $html;
		}
	}
}
