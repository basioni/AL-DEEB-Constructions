<?php
/**
 * Shortcode process.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_process_shortcode' ) ) {
	function k2t_process_shortcode( $atts, $content ) {
		$html = $image = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = '';
		extract( shortcode_atts( array(
			'image'     => $image,
			'anm'       => '',
			'anm_name'  => '',
			'anm_delay' => '',
			'id'        => '',
			'class'     => '',
			'process_style' => 'style-line',
		), $atts ) );

		//Global $cl
		$cl = array( 'k2t-process' );

		$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$class = ( $class != '' ) ? ' ' . $class . '' : '';

		if ( !preg_match_all( "/(.?)\[(step)\b(.*?)(?:(\/))?\]/s", $content, $matches ) ) {
			return do_shortcode( $content );
		} else {
			$number_step = count( $matches[0] );

			//Add class number process
			$cl[] = 'process-'.$number_step;

			//Add class style of process
			$cl[] = $process_style;

			//Apply filters to cl
			$cl = apply_filters( 'k2t_process_classes', $cl );

			//Join cl class
			$cl = join( ' ', $cl );

			$html = '<div ' . $id . ' class="' . trim( $cl ) . $class . '">';
			$html .= do_action( 'k2t_process_open' );
			$html .= '<div class="layer-table"><div class="layer-row">';
			for ( $i = 0; $i < count( $matches[0] ); $i++ ):
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );

				$icon = isset( $matches[3][$i]['icon'] ) ? trim( $matches[3][$i]['icon'] ) : '';

				//Get parameter of step to set
				/*-----------Title-------------*/
				$title = isset( $matches[3][$i]['title'] ) ? trim( $matches[3][$i]['title'] ) : '';
				if ( $title != '' ) {
					$step_count = $i + 1;
					if ( !empty( $icon ) ){
						$step_count = '<i class="'. $icon .'"></i>';
					}
					$title_html = '<div class="step-heading"><div class="step-count">'. $step_count .'</div><h4 class="h">'. $title .'</h4></div>';
				}else {
					$title_html = '';
				}
				
				/*-----------Image-------------*/
				$image = isset( $matches[3][$i]['image'] ) ? trim( $matches[3][$i]['image'] ) : '';
				$anm = isset( $matches[3][$i]['anm'] ) ? trim( $matches[3][$i]['anm'] ) : '';
				$anm_name = isset( $matches[3][$i]['anm_name'] ) ? trim( $matches[3][$i]['anm_name'] ) : '';
				$anm_delay = isset( $matches[3][$i]['anm_delay'] ) ? trim( $matches[3][$i]['anm_delay'] ) : '';
				$image_id = preg_replace( '/[^\d]/', '', $image );
				$img      = wpb_getImageBySize( array( 'attach_id' => $image_id, 'thumb_size' => '' ) );
				if ( $anm ) {
					$anm        = ' animated';
					$data_name  = ' data-animation="' . $anm_name . '"';
					$data_delay = ' data-animation-delay="' . $anm_delay . '"';
				}

				if ( $image != '' ) {
					$image_html = '<div class="step-image"><img src="'.esc_url( $img['p_img_large'][0] ).'" /></div>';
				}else {
					$image_html = '';
				}

				/*-----------Icon-------------*/
				$icon_html = '';
				if ( !empty( $icon ) && $process_style == 'style-box' ) {
					$icon_html = '<div class="step-icon"><i class="'. $icon .'"></i></div>';
				}

				/*-----------featured-------------*/
				$featured = isset( $matches[3][$i]['featured'] ) ? trim( $matches[3][$i]['featured'] ) : 'false';
				if ( $featured != 'true' ) {
					$feature_class = '';
				}else {
					$feature_class = ' featured';
				}

				/*-----------Process content-------------*/
				$process_content = !empty( $matches[3][$i]['step_content'] ) ? '<div class="step-content">'.do_shortcode( $matches[3][$i]['step_content'] ).'</div>' : '';
				
				//return
				$html .= '<div ' . $data_name . ' ' . $data_delay . ' class="k2t-step'.$feature_class . $anm .'"><div class="step-inner-parent"><div class="step-inner">'. $image_html . $icon_html . '<div class="step-text">' . $title_html . $process_content .'</div></div></div></div>';

			endfor;
			$html .= '</div></div>';
			$html .= do_action( 'k2t_process_close' );
			$html .= '</div>';

			//Apply filters return
			$html = apply_filters( 'k2t_process_return', $html );

			return $html;
		}
	}
}
