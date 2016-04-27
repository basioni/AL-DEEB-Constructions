<?php
$output = $title = $el_class = $open = $id = $class = '';
extract(shortcode_atts(array(
    'title'     => __("Click to toggle", "js_composer"),
    'el_class'  => '',
    'open'      => 'false',
	'id'        => '',
	'class'     => '',
), $atts));
$id       = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
$el_class = $this->getExtraClass($class);
$open     = ( $open == 'true' ) ? ' wpb_toggle_title_active' : '';
$el_class .= ( $open == ' wpb_toggle_title_active' ) ? ' wpb_toggle_open' : '';

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_toggle' . $open, $this->settings['base'], $atts );

$output   .= apply_filters( 'wpb_toggle_heading', '<h4 class="' . esc_attr( $css_class ) . '">' . $title . '</h4>', array( 'title' => $title, 'open' => $open ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_toggle_content' . $el_class, $this->settings['base'], $atts );
$output   .= '<div ' . $id . ' class="' . esc_attr( $css_class ) . '">' . wpb_js_remove_wpautop( $content, true ) . '</div>' . $this->endBlockComment( 'toggle' ) . "\n";

echo $output;