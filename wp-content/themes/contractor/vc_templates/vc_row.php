<?php
$output = $script = $css_class = $el_class = $el_id = $random_class = $data = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $no_wrap = $full_screen = $parallax = $bg_video = $youtube_link = $autoplay = $mute = $control = $inline_attr = '';
extract(shortcode_atts(array(
	'session_layout'						=> '',
	'no_wrap'								=> '',
	'background_img_full_screen' 			=> '',
	'dark_background_style'					=> '',
	'background_setting'        			=> 'bg_color',
	'background_img'              			=> '',
	'background_img_position'        		=> '',
	'background_img_repeat'        			=> 'no-repeat',
	'background_img_size'					=> '',
	'background_img_animation' 				=> '',
	'background_video_link'         		=> '',
	'background_video_play_id'   			=> '',
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
	'el_class'        						=> '',
    'bg_image'        						=> '',
    'bg_color'        						=> '',
    'bg_image_repeat' 						=> '',
    'font_color'      						=> '',
    'padding'         						=> '',
    'margin_bottom'   						=> '',
    'css' 									=> ''
), $atts));

wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_script( 'k2t-parallax' );

// Generate random id
$length        = 10;
$random_id = substr( str_shuffle( "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ), 0, $length );
$random_id = !empty( $id ) ? $id : $random_id ;

// Reset param default of VC
$bg_image = wp_get_attachment_url( $background_img );
$bg_image_repeat = $background_img_repeat;
$bg_color = $background_gen_color;

// Inline Css 
$inline_css = array();
$inline_css[] = 'position: relative;';

if ( $session_layout == 'fullscreen' || $background_img_full_screen ) {
	$css_class .= ' fullsc ';
	$script .= '
		<scr' . 'ipt>
			(function($) {
				"use strict";

				$(document).ready(function() {
					var row_h = $(window).height();
					$(".fullsc").height(row_h);
				});

			})(jQuery);
		</scr' . 'ipt>
	';
}

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

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
		$inline_attr = ' data-center="background-position: 50% 0px;" data-bottom-top="background-position: 50% 150px;" data-top-bottom="background-position: 50% -150px;" data-anchor-target="#'. $random_id .'" data-stellar-background-ratio="0.5"';
	} else {
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
	$background_video_mute_html		 	=  !empty( $background_video_mute ) ? 'mute: true, ' : 'mute: false, ';
	$background_gen_auto_play_html		=  !empty( $background_gen_auto_play ) ? 'autoplay: true' : 'autoplay: false';

	$script .= '<scr' . 'ipt>
		(function($) {
			"use strict";
			$("document").ready(function() {
				var options = { videoId: "'. esc_js( $background_video_link ) .'", start: 3, obj: "#'. esc_js( $random_id ) .'", width: $("#'. esc_js( $random_id ) .'").width(), '. esc_js( $background_video_play_id_html . $background_video_mute_html . $background_gen_auto_play_html ) .' };
				$("#'. esc_js( $random_id ) .'").tubular(options);

			});
		})(jQuery);
	</scr' . 'ipt>';
}

$inline_css = implode ( ' ', $inline_css );

// Add space with customer add custom class 
$class .= ' ';

// Do func of VC
$el_class = $this->getExtraClass($class.$el_class);

// Replace "style" in inline css
$inline_style = str_replace('style="', 'style="' . $inline_css, $style);
if ( $style == $inline_style){
	$inline_style = 'style="'. $inline_css .'"';
}

// Add Class background-dark in Row 
if ( $dark_background_style == 'true' ){
	$el_class .= ' background-dark';
}

$css_class .= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
if ( $session_layout == 'no_wrap' ){
	$css_class .= ' row-fullwidth';
}

// Render HTML
$output .= '<div id="' . esc_attr( $random_id ) . '" class="' . esc_attr( $css_class ) . '" ' . $inline_style . $data . $inline_attr . '>';
if ( $session_layout != 'no_wrap' && ! $no_wrap ) {
	$output .= '<div class="container">';
}
$output .= '<div style="z-index: 10; position: relative;">'. wpb_js_remove_wpautop($content) .'</div>';

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
				config.$slideshow = jQuery( "#cbp-bislideshow'. esc_js( $random_id ) .'" );
				config.isSlideshowActive = '. ( ( $background_gen_auto_play ) ? 'true' : 'false' ) .';
				config.interval = 5000;
				cbpBGSlideshow.init(config);
			});
		</script>
	';
}

if ( $session_layout != 'no_wrap' && ! $no_wrap ) {
	$output .= '</div>';
}

// Mask layer setting
if ( !empty( $background_gen_mask_layer_image ) || !empty( $background_gen_mask_layer_color ) ){
	$mask_layer_image_css = !empty( $background_gen_mask_layer_image ) ? 'background-image:url('. esc_url( wp_get_attachment_url( $background_gen_mask_layer_image ) ) .');' : '';
	$mask_layer_repeat_css = !empty( $background_gen_mask_layer_repeat ) ? 'background-repeat:'. $background_gen_mask_layer_repeat .';' : '';
	$mask_layer_color_css = !empty( $background_gen_mask_layer_color ) ? 'background-color:'. $background_gen_mask_layer_color .';' : '';
	$mask_layer_opacity_css = !empty( $background_gen_mask_layer_opacity ) ? 'opacity:'. $background_gen_mask_layer_opacity .';' : '';
	$output .= '<div style="left: 0;position: absolute;top: 0;width: 100%;height:100%;z-index: 5;'. $mask_layer_image_css . $mask_layer_repeat_css . $mask_layer_color_css . $mask_layer_opacity_css .'"><!----></div>';
}

$output .= '</div>'.$this->endBlockComment('row');

echo $output . $script;