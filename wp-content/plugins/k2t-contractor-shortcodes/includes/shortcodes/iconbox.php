<?php
/**
 * Shortcode icon box.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_iconbox_shortcode' ) ) {
	function k2t_iconbox_shortcode( $atts, $content ) {
		$html = $layout = $title = $icon_html = $fontsize = $color = $text_transform = $subtitle = $icon_type = $graphic = $icon_bg = $icon_hover_class = $icon = $icon_background = $link = $link_text = $align = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = $padding_layout_3 = $image_link = '';
		extract( shortcode_atts( array(
			'layout'             => '1',
			'title'              => '',
			'fontsize'           => '',
			'color'              => '',
			'text_transform'     => 'inherit',
			'subtitle'           => '',
			'icon_type'          => '',
			'graphic'            => $graphic,
			'icon_hover'         => false,
			'icon'               => '',
			'icon_font_size'     => '',
			'icon_color'         => '',
			'icon_background'    => '',
			'icon_border_color'  => '',
			'icon_border_style'  => '',
			'icon_border_width'  => '',
			'icon_border_radius' => '',
			'link'               => '',
			'link_text'          => 'Learn more &rarr;',
			'align'              => '',
			'box_background_color'=> '',
			'box_border'	     => 'false',
			'box_border_color'   => '',
			'box_shadow'		 => 'false',
			'mgt'                => '',
			'mgr'                => '',
			'mgb'                => '',
			'mgl'                => '',
			'anm'                => '',
			'anm_name'           => '',
			'anm_delay'          => '',
			'id'                 => '',
			'class'              => '',
		), $atts ) );

		//Global $cl
		$cl = array( 'k2t-iconbox' );

		if ( $anm ) {
			$anm        = ' animated';
			$data_name  = ' data-animation="' . $anm_name . '"';
			$data_delay = ' data-animation-delay="' . $anm_delay . '"';
		}
		$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$class = ( $class != '' ) ? ' ' . $class . '' : '';
		$mgt   = ( $mgt != '' ) ? 'margin-top: ' . $mgt . 'px;' : '';
		$mgr   = ( $mgr != '' ) ? 'margin-right: ' . $mgr . 'px;' : '';
		$mgb   = ( $mgb != '' ) ? 'margin-bottom: ' . $mgb . 'px;' : '';
		$mgl   = ( $mgl != '' ) ? 'margin-left: ' . $mgl . 'px;' : '';

		// Get icon graphics
		$img = '';
		if ( !empty( $graphic ) ){
			if ( is_numeric( $graphic ) ){
				$img_id = preg_replace( '/[^\d]/', '', $graphic );
				$image    = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '' ) );
				$image_link  = $image['p_img_large'][0];
				$data 		= ( isset( $image_link ) && file_exists( $image_link ) ) ? getimagesize( $image_link ) : array('auto', 'auto');
				$width       = $data[0];
				$height      = $data[1];
				$img = '<img width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" src="'. esc_url ( $image['p_img_large'][0] ) .'" alt="'. esc_attr( $title ) .'" />';
			}else{
				$img = '<img width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" src="'. esc_url ( $graphic ) .'" alt="'. esc_attr( $title ) .'" />';
			}
		}

		// Layout
		if ( in_array( trim( $layout ), array( '1', '2', '3' ) ) ) { $cl[] = 'layout-' . trim( $layout ); } else { $cl[] = 'layout-1'; }

		// 
		if ( $layout == '1' ){
			if ( $box_shadow == 'true' ){
				$cl[] = 'has-shadow';
			}
		}

		// Box background
		$background_color = ( ! empty( $box_background_color ) ) ? 'background-color: ' . $box_background_color . ';' : '';
		if ( ! empty( $background_color ) ) $cl[] = 'box-background';

		// Box has border
		if ( $box_border == 'true' ) {
			$cl[] = ' has-border';
			$box_border_color = 'border-color:' . trim( $box_border_color ) . ';';
		}

		// Check layout 3
		if ( '3' == $layout ) {
			if ( ! $icon_font_size ) {
				$padding_layout_3 = 'padding-left: 10px;';	
			} else {
				$padding_layout_3 = 'padding-left:' . $icon_font_size / 2 . 'px;';
			}
		}

		// Select icon type
		if ( 'graphics' == $icon_type ) {
			$icon_html .= '<div class="iconbox-image">'. $img .'</div>';
		} else {
			$icon_css = array();

			// Icon hover effect
			if ( 'true' == $icon_hover ) {
				$icon_hover_class = ' hover';
			}

			// Icon font size
			$icon_font_size = ( $icon_font_size != '' ) ? 'font-size: ' . $icon_font_size . 'px;' : '';

			// Icon color
			if ( $icon_color ) {
				$icon_css[] = 'color: ' . trim( $icon_color );
			}

			// Icon background
			if ( $icon_background ) {
				$icon_css[] = 'background: ' . trim( $icon_background );
				$cl[]    = ' has-bg';
			}

			// Check icon has border
			if ( trim( $icon_border_width ) != '' ) {
				$cl[] = ' icon-border';
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

			// HTML output of icon
			$icon_html = '<div class="iconbox-icon ' . $icon_bg . '" style="' . implode( ';', $icon_css ) . '"><i style="'. $icon_font_size .'" class="' . trim( $icon ) . '"></i></div>';
		}
		
		// Text link
		if ( trim( $link_text ) == '' ) { $link_text = 'Learn more &rarr;'; } else { $link_text = trim( $link_text ); }

		if ( trim( $link ) == '' ) {
			$link_html = '';
		} else {
			$link_html = '<div class="learnmore"><a href="' . esc_url( trim( $link ) ) . '">' . $link_text . ' &rarr;</a></div>';
		}

		// Sub title
		$subtitle_html = '';
		if ( !empty( $subtitle ) ) $subtitle_html = '<h5>' . $subtitle . '</h5>';

		// Title
		$color           = ( $color != '' ) ? 'color: ' . $color . ';' : '';
		$fontsize        = ( $fontsize != '' ) ? 'font-size: ' . $fontsize . 'px;' : '';
		$text_transform  = ( $text_transform != '' ) ? 'text-transform: ' . $text_transform . ';' : '';
		if ( trim( $title ) == '' ) { $title_html = ''; } else { $title_html = '<div class="title"><h3 style="' . $color . $text_transform . $fontsize . $padding_layout_3 . '" class="h">' . trim( $title ) . '</h3>'. $subtitle_html .'</div>'; }

		// Icon alignment
		if ( in_array( trim( $align ), array( 'left', 'right', 'center' ) ) ) { $cl[] = 'align-' . trim( $align ); }

		// Apply filters to cl
		$cl = apply_filters( 'k2t_iconbox_classes', $cl );

		// Join cl class
		$cl = join( ' ', $cl );

		$html = '<div class="' . trim( $cl ). $anm . $class . $icon_hover_class . '" ' . $data_name . $data_delay . $id . ' style="' . $mgt . $mgr . $mgb . $mgl . $background_color . $box_border_color . '">';
		$html .= do_action( 'k2t_iconbox_open' );
		$html .= $icon_html . '<div class="iconbox-text">' . $title_html . '<div class="desc">' . do_shortcode( $content ) . '</div>' . $link_html . '</div>';
		$html .= do_action( 'k2t_iconbox_close' );
		$html .= '</div>';

		// Apply filters return
		$html = apply_filters( 'k2t_iconbox_return', $html );

		return $html;
	}
}
