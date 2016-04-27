<?php
$output = $font_color = $el_class = $width = $offset = '';
$output = $script = $css_class = $el_class = $el_id = $random_class = $data = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $no_wrap = $full_screen = $parallax = $inline_attr = $bg_video = $youtube_link = $autoplay = $mute = $control = '';
extract(shortcode_atts(array(
	'background_setting'        			=> 'bg_color',
	'dark_background_style'					=> '',
	'background_img'              			=> '',
	'background_img_position'        		=> '',
	'background_img_repeat'        			=> 'no-repeat',
	'background_img_size'					=> '',
	'background_img_animation' 				=> '',
	'background_video_link'         		=> '',
	'background_video_opacity'   			=> '',
	'background_video_start_time'        	=> '',
	'background_video_quality'             	=> 'auto',
	'background_video_mute'         		=> '',
	'background_slider_images'	  			=> '',
	'background_slider_effect'        		=> 'face',
	'background_gen_auto_play'    			=> '',
	'background_gen_parallax'        		=> '',
	'background_gen_color'            		=> '',
	'background_gen_mask_layer_image'       => '',
	'background_gen_mask_layer_repeat'      => 'no-repeat',
	'background_gen_mask_layer_opacity'     => '',
	'background_gen_mask_layer_color'       => '',
	'id'         							=> '',
	'class'         						=> '',
	'font_color'      => '',
    'el_class' => '',
    'width' => '1/1',
    'css' => '',
	'offset' => ''
), $atts));

// Generate random id
$length        = 10;
$random_id = substr( str_shuffle( "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ), 0, $length );
$random_id = !empty( $id ) ? $id : $random_id ;
$bg_image = wp_get_attachment_url( $background_img );
$bg_image_repeat = $background_img_repeat;

// Inline Css 
$inline_css = array();
$inline_css[] = 'position: relative;';

if ( !empty( $background_gen_color ) ){
	$inline_css[] = 'background-color: '. $background_gen_color .';';
}

// Handling Background Image
if ( $background_setting == 'bg_image' ){
	if ( !empty( $background_img_animation ) ){
		$class .= ' ' . $background_img_animation;
	}
	if ( $bg_image ){
		$inline_css[] = 'background-image: url('. esc_url( $bg_image ) .');';
	}
	if ( !empty( $background_img_size ) ){
		$inline_css[] = 'background-size: '. $background_img_size .';';
	}
	if ( $bg_image_repeat ){
		$inline_css[] = 'background-repeat: '. $bg_image_repeat .';';
	}
	if ( $background_gen_parallax ) {
		$script .= '
			<scr' . 'ipt>
				(function($) {
					"use strict";

					$(document).ready(function() {
						$.stellar({
							horizontalScrolling: false,
							verticalOffset: 40
						});
					});

				})(jQuery);
			</scr' . 'ipt>
		';
		$inline_attr = 'data-stellar-background-ratio="0.5"';
	}else{
		if ( !empty( $background_img_position ) ){
			$inline_css[] = 'background-position:'. $background_img_position .';';
		}
	}
}

// Handling Background Video
if ( $background_setting == 'bg_video' ){
	if ( function_exists( 'k2t_pre_process_shortcode' ) ) {
		wp_enqueue_script( 'k2t-tubular' );
	}

	$background_video_play_id_html 		=  !empty( $background_video_play_id ) ? 'playButtonClass: "'. $background_video_play_id .'", ' : '';
	$background_video_mute_html		 	=  !empty( $background_video_mute ) ? 'mute: true' : 'mute: false ';

	$script .= '<scr' . 'ipt>
		(function($) {
			"use strict";
			$("document").ready(function() {
				var options = { videoId: "'. $background_video_link .'", start: 3, obj: "#'. $random_id .'", width: $("#'. $random_id .'").width(), '. $background_video_play_id_html . $background_video_mute_html .' };
				$("#'. $random_id .'").tubular(options);
			});
		})(jQuery);
	</scr' . 'ipt>';
}

if ( $background_setting == 'bg_slider' ){
	$inline_css[] = 'overflow: hidden;';
}

$inline_css = implode ( ' ', $inline_css );

$el_class = $this->getExtraClass($class . $el_class);
$width = wpb_translateColumnWidthToSpan($width);
$width = vc_column_offset_class_merge($offset, $width);
$el_class .= ' wpb_column vc_column_container';



// Add Class background-dark in Row 
if ( $dark_background_style == 'true' ){
	$el_class .= ' background-dark';
}

$style = $this->buildStyle( $font_color );
$inline_style = str_replace(' style="', ' style="' . $inline_css, $style);
if ( $style == $inline_style){
	$inline_style = ' style="'. $inline_css .'"';
}
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$output .= "\n\t".'<div id="' . esc_attr( $random_id ) . '" class="' . $css_class . '"' . $inline_style . $data . $inline_attr . '>';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');

// Background Slider
if ( $background_setting == 'bg_slider' ){
	// Load js
	wp_enqueue_script( 'jquery-cbpBGSlideshow' );

	$background_slider_images = explode( ',', $background_slider_images );
	$output .= '<ul id="cbp-bislideshow'. esc_attr( $random_id ) .'" class="cbp-bislideshow">';
	if ( count( $background_slider_images ) > 0 ){
		for ( $i = 0; $i < count( $background_slider_images ); $i++ ) {
			$img_id = $background_slider_images[$i];
			$output .= '<li>'. wp_get_attachment_image( $img_id, 'full' ).'</li>';
		}
	}
	$output .= '</ul>';
	$output .= '
		<script>
			"use strict";
			jQuery(document).ready(function() {
				var config = cbpBGSlideshow;
				config.$slideshow = jQuery( "#cbp-bislideshow'. $random_id .'" );
				config.isSlideshowActive = '. ( ( $background_gen_auto_play ) ? 'true' : 'false' ) .';
				cbpBGSlideshow.init(config);
			});
		</script>
	';
}

// Mask layer setting
if ( !empty( $background_gen_mask_layer_image ) || !empty( $background_gen_mask_layer_color ) ){
	$mask_layer_image_css = !empty( $background_gen_mask_layer_image ) ? 'background-image:url('. esc_url( wp_get_attachment_url( $background_gen_mask_layer_image ) ) .');' : '';
	$mask_layer_repeat_css = !empty( $background_gen_mask_layer_repeat ) ? 'background-repeat:'. $background_gen_mask_layer_repeat .';' : '';
	$mask_layer_color_css = !empty( $background_gen_mask_layer_color ) ? 'background-color:'. $background_gen_mask_layer_color .';' : '';
	$mask_layer_opacity_css = !empty( $background_gen_mask_layer_opacity ) ? 'opacity:'. $background_gen_mask_layer_opacity .';' : '';
	$output .= '<div style="left: 0;position: absolute;top: 0;width: 100%;height:100%;z-index: 5;'. $mask_layer_image_css . $mask_layer_repeat_css . $mask_layer_color_css . $mask_layer_opacity_css .'"><!----></div>';
}
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output . $script;