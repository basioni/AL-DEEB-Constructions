<?php
$output = $color = $el_class = $anm = $anm_name = $anm_delay = $data_name = $data_delay = $id = $class = '';
extract(shortcode_atts(array(
    'color'     => 'alert-info',
    'el_class'  => '',
    'style'     => '',
    'anm'       => '',
	'anm_name'  => '',
	'anm_delay' => '',
	'id'        => '',
	'class'     => '',
	'icon'		=> '',
	'is_close'	=> '',
	'background_transparent' => '',
), $atts));
$el_class = $this->getExtraClass($class);
if ( $anm ) {
	$anm        = ' animated';
	$data_name  = 'data-animation="' . $anm_name . '"';
	$data_delay = 'data-animation-delay="' . $anm_delay . '"';
}
$id    = ( $id != '' ) ? ' id="' . esc_attr( $id ) . '"' : '';
$class = "";
$class .= ($style!='') ? ' vc_alert_'.$style : '';
$class .= ( $color != '' && $color != "alert-block") ? ' wpb_'.$color : '';
$class .= ( $background_transparent ) ? ' bg-transparent' : '';
$class .= ( $is_close ) ? ' has-close' : '';

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_alert wpb_content_element' . $class . $el_class, $this->settings['base'], $atts );

// Add Icon to message
$icon_html = !empty( $icon ) ? '<span><i class="'. esc_attr( $icon ) .'"></i></span>' : '';

// Is Close
$close_html = ( $is_close ) ? '<a class="close"><span aria-hidden="true">&times;</span></a>' : '';
?>
<div <?php echo $id . $data_delay . $data_name ?> class="<?php echo esc_attr( $css_class ) . esc_attr( $anm ); ?>">
	<div class="messagebox_text"><?php echo $icon_html;?><span><?php echo wpb_js_remove_wpautop( $content, true ); ?></span></div>
	<?php echo $close_html;?>
</div>
<?php echo $this->endBlockComment( 'alert box' )."\n";