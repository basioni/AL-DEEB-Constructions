<?php
$output = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = $el_class = '';
extract(shortcode_atts(array(
	'anm'       => '',
	'anm_name'  => '',
	'anm_delay' => '',
	'id'        => '',
	'class'     => '',
	'css'       => '',
), $atts));

if ( $anm ) {
	$anm        = ' animated ';
	$data_name  = ' data-animation="' . $anm_name . '"';
	$data_delay = ' data-animation-delay="' . $anm_delay . '"';
}
$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
$class = ( $class != '' ) ? ' ' . $class : '';

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_text_column wpb_content_element ' . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$output .= "\n\t".'<div ' . $id . $data_name . $data_delay . ' class="' . esc_attr( $anm ) . esc_attr( $css_class ) . '">';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content, true);
$output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> ' . $this->endBlockComment('.wpb_text_column');

echo $output;