<?php
$output = $title = $interval = $el_class = '';
extract( shortcode_atts( array(
	'title'			 => '',
	'interval'		 => 0,
	'el_class'		 => '',
	'align'	         => 'left',
	'style'			 => 'outline',
	'class'          => '',
	'icon_font_size' => '',
	'icon_pos'       => ''
), $atts ) );

wp_enqueue_script( 'jquery-ui-tabs' );

$el_class = $this->getExtraClass( $el_class );

$el_class .= ' ' . $align . ' ' . $style;

$element = 'wpb_tabs';
if ( 'vc_tour' == $this->shortcode ) $element = 'wpb_tour';

// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}

// Custom icon inline css
$icon_inline_css = $a_inline_css = '';
if ( !empty( $icon_font_size ) ){
	if ( is_numeric( $icon_font_size ) ){
		$icon_inline_css .= 'font-size: '. $icon_font_size .'px';
		$a_inline_css .= 'line-height: '. $icon_font_size .'px';
	}else{
		$icon_inline_css .= 'font-size: '. $icon_font_size;
		$a_inline_css .= 'line-height: '. $icon_font_size;
	}
}

$tabs_nav = '';
$tabs_nav .= '<ul class="wpb_tabs_nav ui-tabs-nav vc_clearfix">';
foreach ( $tab_titles as $tab ) {
	$tab_atts = shortcode_parse_atts($tab[0]);
	if(isset($tab_atts['title']) && isset( $tab_atts['icon'] )) {
		$tabs_nav .= '<li class="'. ( isset( $tab_atts['icon_pos'] ) ? $tab_atts['icon_pos'] : '' ) .'"><a style="'. esc_attr( $a_inline_css ) .'" href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '"><i style="'. esc_attr( $icon_inline_css ) .'" class="'. ( str_replace( 'awesome', '', $tab_atts['icon'] ) ) .'"></i><span>' . $tab_atts['title'] . '</span></a></li>';
	}elseif(isset($tab_atts['title'])) {
		$tabs_nav .= '<li class="'. ( isset( $tab_atts['icon_pos'] ) ? $tab_atts['icon_pos'] : '' ) .'"><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '"><span>' . $tab_atts['title'] . '</span></a></li>';
	}elseif(isset($tab_atts['icon'])) {
		$tabs_nav .= '<li class="'. ( isset( $tab_atts['icon_pos'] ) ? $tab_atts['icon_pos'] : '' ) .'"><a style="'. esc_attr( $a_inline_css ) .'" href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '"><i style="'. esc_attr( $icon_inline_css ) .'" class="'. ( str_replace( 'awesome', '', $tab_atts['icon'] ) ) .'"></i></a></li>';
	}
}
$tabs_nav .= '</ul>' . "\n";

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class . ' ' . $class ), $this->settings['base'], $atts );

$output .= "\n\t" . '<div class="' . esc_attr( $css_class ) . '" data-interval="' . esc_attr( $interval ) . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix">';
$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => $element . '_heading' ) );
$output .= "\n\t\t\t" . $tabs_nav;
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
if ( 'vc_tour' == $this->shortcode ) {
	$output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav vc_clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="' . __( 'Previous tab', 'js_composer' ) . '">' . __( 'Previous tab', 'js_composer' ) . '</a></span> <span class="wpb_next_slide"><a href="#next" title="' . __( 'Next tab', 'js_composer' ) . '">' . __( 'Next tab', 'js_composer' ) . '</a></span></div>';
}
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( $element );

echo $output;