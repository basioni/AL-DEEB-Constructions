<?php
/**
 * Shortcode member.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_member_shortcode' ) ) {
	function k2t_member_shortcode( $atts, $content ) {
		$html = $image = $name = $role = $style = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = $style2_before = $style2_after = $image_link = $data = $width = $height = '';
		extract( shortcode_atts( array(
			'image'       => $image,
			'name'        => '',
			'role'        => '',
			'style'       => '4',
			'facebook'    => '',
			'twitter'     => '',
			'skype'       => '',
			'pinterest'   => '',
			'instagram'   => '',
			'dribbble'    => '',
			'google_plus' => '',
			'anm'         => '',
			'anm_name'    => '',
			'anm_delay'   => '',
			'id'          => '',
			'class'       => '',
		), $atts ) );

		// Global $cl
		$cl = array( 'k2t-member' );

		// Animation
		if ( $anm ) {
			$anm        = ' animated';
			$data_name  = ' data-animation="' . $anm_name . '"';
			$data_delay = ' data-animation-delay="' . $anm_delay . '"';
		}
		$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$class = ( $class != '' ) ? ' ' . $class . '' : '';

		// Style ( 4 style )
		if ( trim( $style ) ) {
			$cl[] = 'style-' . $style;
		}

		// Get member avatar
		$image_html = '';
		if ( !empty( $image ) ){
			if ( is_numeric( $image ) ){
				$img_id = preg_replace( '/[^\d]/', '', $image );
				$image    = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '' ) );
				$image_link = $image['p_img_large'][0];
				$data 		= ( isset( $image_link ) && file_exists( $image_link ) ) ? getimagesize( $image_link ) : array('auto', 'auto');
				$width      = $data[0];
				$height     = $data[1];
				$image_html = '<div class="image"><img width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" src="'. esc_url ( $image['p_img_large'][0] ) .'" /></div>';
			}else{
				$image_html = '<div class="image"><img width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" src="'. esc_url ( $image ) .'" /></div>';
			}
		}

		// Get member name and role
		if ( ( trim( $name ) == '' ) && ( trim( $role ) == '' ) ) {
			$name_role_html = '';
		} else {
			// Name output
			$name_html = ( trim( $name ) == '' ) ? '' : '<h3 class="name">' . trim( $name ) . '</h3>';
			// Role output
			$role_html = ( trim( $role ) == '' ) ? '' : '<h4 class="role">' . trim( $role ) . '</h4>';
			// To output div name-role
			$name_role_html = '<div class="name-role">' . $name_html . $role_html . '</div>';
		}

		// Get social network
		if ( function_exists( 'k2t_social_array' ) ) {
			$social_array = k2t_social_array();
			$social_array['email']       = __( 'Email', 'k2t' );
			$social_array['googleplus']  = __( 'Google+', 'k2t' );
			$social_array['google_plus'] = __( 'Google+', 'k2t' );
		} else {
			$social_array = array();
		}
		$display_social = array();

		foreach ( $atts as $key => $val ) {
			if ( $key == 'email' ) $icon = 'envelope-alt';
			elseif ( $key == 'googleplus' || $key == 'google_plus' ) $icon = 'google-plus';
			else $icon = $key;

			if ( isset ( $social_array[$icon] ) && trim( $atts[$key] ) ) {
				$display_social[] = '<li><a href="' . esc_url( $atts[$key] ) . '" title="' . esc_attr( $social_array[$icon] ) . '"><i class="fa fa-' . $icon . '"></i></a></li>';
			}
		}

		// Join social media
		$html_social = '';
		if ( ! empty( $display_social ) ) {
			$html_social .= '<div class="social"><ul>';
			$html_social .= join( '', $display_social );
			$html_social .= '</ul></div>';
		} else {
			$html_social = '';
		}

		// Apply filters to cl
		$cl = apply_filters( 'k2t_member_classes', $cl );

		// Join cl class
		$cl = join( ' ', $cl );

		// Extra html for style 2
		if ( '2' == $style ) {
			$style2_before = '<div class="text-inner">';
			$style2_after  = '</div>';
		}

		// Output to frontend
		$html = '<div ' . $id . $data_name . $data_delay . ' class="' . trim( $cl ) . $class . '">';
		if ( '4' == $style ) {
			$html .= '<div class="member-inner">' . $image_html . '<div class="text"><div><div class="name-role">' . $name_html . $role_html . '</div><div class="desc">' . do_shortcode( $content ) . '</div>'. $html_social .'</div></div></div>';
		} else {
			$html .= '<div class="member-inner">' . $image_html . '<div class="text">' . $style2_before . $name_role_html . '<div class="desc">' . do_shortcode( $content ) . '</div>' . $html_social . $style2_after . '</div></div>';
		}
		$html .= '</div>';

		// Apply filters return
		return apply_filters( 'k2t_member_return', $html );
	}
}
