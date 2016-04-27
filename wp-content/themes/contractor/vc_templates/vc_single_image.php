<?php

$output = $el_class = $image = $img_size = $img_link = $img_link_target = $img_link_large = $title = $alignment = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = '';

extract( shortcode_atts( array(
	'title'           => '',
	'image'           => $image,
	'img_size'        => 'thumbnail',
	'img_link_large'  => false,
	'img_link'        => '',
	'link'            => '',
	'img_link_target' => '_self',
	'alignment'       => 'left',
	'el_class'        => '',
	'css_animation'   => '',
	'style'           => '',
	'border_color'    => '',
	'css'             => '',
	'anm'             => '',
	'anm_name'        => '',
	'anm_delay'       => '',
	'id'              => '',
	'class'           => '',
	'image_style'     => '',
	'image_hover_style'=> '',
	'image_located_on'=> '',
	'image_banner_hover'=> '',
), $atts ) );

if ( $anm ) {
	$anm        = ' animated';
	$data_name  = ' data-animation="' . $anm_name . '"';
	$data_delay = ' data-animation-delay="' . $anm_delay . '"';
}
$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
$style = ( $style != '' ) ? $style : '';
$border_color = ( $border_color != '' ) ? ' vc_box_border_' . $border_color : '';

$img_id = preg_replace( '/[^\d]/', '', $image );
$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size, 'class' => $style . $border_color ) );
if ( $img == NULL ) $img['thumbnail'] = '<img class="' . esc_attr( $style ) . esc_attr( $border_color ) . '" src="' . esc_url( vc_asset_url( 'vc/no_image.png' ) ) . '" />'; //' <small>'.__('This is image placeholder, edit your page to replace it.', 'js_composer').'</small>';

$el_class = $this->getExtraClass( $class );

$a_class = '';
if ( $el_class != '' ) {
	$tmp_class = explode( " ", strtolower( $el_class ) );
	$tmp_class = str_replace( ".", "", $tmp_class );
	if ( in_array( "prettyphoto", $tmp_class ) ) {
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );
		$a_class = ' class="prettyphoto"';
		$el_class = str_ireplace( " prettyphoto", "", $el_class );
	}
}

$link_class = 'k2t-popup-link';
$link_to = '';
if ( strlen($link) > 0 ) {
	$link_class = '';
	$link_to = $link;
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_single_image wpb_content_element' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$css_class .= $this->getCSSAnimation( $css_animation );

// Render Image
if ( !empty( $link_to ) ){
	$img_output = '<a class="image-link link-to" href="'. esc_url( $link_to ) .'">' . $img['thumbnail'] . '</a>';
}else{
	$img_output = '<a class="image-link">' . $img['thumbnail'] . '</a>';
}
// Render Image Hover
$image_string = '';
if ( $image_hover_style == 'banner' ){
	$image_string = '<div class="entry-image"><figure class="effect-layla">';
	$image_string .= $img_output;
	$image_string .= '<figcaption>';
	$image_string .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_singleimage_heading' ) );
	$image_string .= !empty( $image_banner_hover ) ? '<div class="image-content">' . $image_banner_hover . '</div><a target="_blank" href="'. esc_url( $link ) .'">View more</a>' : '<a target="_blank" href="'. esc_url( $link ) .'">View more</a>';
	$image_string .= '</figcaption>';
	$image_string .= '</figure></div>';
}elseif( $image_hover_style == 'dark' || $image_hover_style == 'light' ){
	$image_string .= '<a class="image-link k2t-popup-link" href="'. esc_url( $img['p_img_large'][0] ) .'">' . $img['thumbnail'] . '</a>';
}else{
	$image_string = '<div class="entry-image">'. $img_output .'</div>';
	$image_string .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_singleimage_heading' ) );
}

$css_class .= ' vc_align_' . $alignment;
$css_class .= ' ' . $image_style;
$css_class .= ' ' . $image_hover_style;

$output .= "\n\t" . '<div ' . $id . $data_name . $data_delay . ' class="article isotope-selector ' . esc_attr( $css_class ) . esc_attr( $anm ) .'">';
$output .= "\n\t\t" . '<div class="wpb_wrapper article-inner">';
$output .= "\n\t\t\t" . $image_string;
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_single_image' );

echo $output;