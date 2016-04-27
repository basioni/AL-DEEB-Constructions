<?php

$output = $text = $google_fonts = $font_container = $el_class = $css = $google_fonts_data = $font_container_data = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = '';
extract(shortcode_atts(array(
	'text_transform' => 'inherit',
	'anm'            => '',
	'anm_name'       => '',
	'anm_delay'      => '',
	'id'             => '',
	'class'          => '',
	'css'            => '',
), $atts));
extract( $this->getAttributes( $atts ) );
extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );
$settings = get_option( 'wpb_js_google_fonts_subsets' );
$subsets  = '';
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
}
if ( $anm ) {
	$anm        = ' animated';
	$data_name  = ' data-animation="' . $anm_name . '"';
	$data_delay = ' data-animation-delay="' . $anm_delay . '"';
}
$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
$class = ( $class != '' ) ? ' ' . $class . '' : '';
$text_transform = ( $text_transform != '' ) ? 'text-transform: ' . $text_transform . ';' : '';

$protocol = is_ssl() ? 'https' : 'http';
wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), $protocol.'://fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets, array( 'property="stylesheet"' ) );
$output .= '<div class="' . esc_attr( $css_class ) . esc_attr( $class ) . esc_attr( $anm ) . '" ' . $id . $data_name . $data_delay . '>';
$output .= '<' . $font_container_data['values']['tag'] . ' style="' . $text_transform . implode( ';', $styles ) . '">';
$output .= $text;
$output .= '</' . $font_container_data['values']['tag'] . '>';
$output .= '</div>';

echo $output;