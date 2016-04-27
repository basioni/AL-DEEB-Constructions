<?php
/**
 * Shortcode k2t slider.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_k2t_slider_shortcode' ) ) {
	function k2t_k2t_slider_shortcode( $atts, $content ) {
		$html = $items = $script = $items_desktop = $items_tablet = $items_mobile = $single_item = $slide_speed = $auto_play = $stop_on_hover = $navigation = $pagination = $lazyLoad = $class = '';
		extract( shortcode_atts( array(
			'style'			=> 'style_1',
			'items'	        => '4',
			'items_desktop' => '4',
			'items_tablet'  => '2',
			'items_mobile'  => '1',
			'single_item'   => '',
			'slide_speed'   => '1000',
			'auto_play'	    => '',
			'stop_on_hover' => '',
			'navigation'    => '',
			'pagination'    => '',
			'pagi_pos'      => 'bottom',
			'pagi_style'    => '1',
			'lazyLoad'      => '',
			'id'		    => '',
			'class'         => '',
		), $atts));

	wp_enqueue_script( 'k2t-owlcarousel' );

	// Generate random id
	$length = 10;
	$id     = substr( str_shuffle( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ), 0, $length );
	$class  = ( $class != '' ) ? ' ' . $class . '' : '';
	$class .= ( $pagination ) ? ' pagi-' . $pagi_pos : '';
	$class .= ( $pagi_style != '1' && $pagination ) ? ' pagi-style-2' : '';
	$class .= ' ' . $style;

	if ( $style == 'style_2' ){

		$html .= '<div id="' . esc_attr( $id ) . '" class="k2t-carousel ' . $class . '">';
		$html .= '<div class="sync1 owl-carousel">';
		$html .= do_shortcode( $content );
		$html .= '</div>';
		$html .= '<div class="sync2 owl-carousel">';
		$html .= do_shortcode( $content );
		$html .= '</div>';
		$html .= '</div>';

		$script .= '<scr' . 'ipt>
			(function($) {
				"use strict";
				$(document).ready(function() {
					var parent = $("#' . $id . '");
					var sync1 = $(".sync1", parent);
					var sync2 = $(".sync2", parent);
					sync1.owlCarousel({
						singleItem 				: true,
						slideSpeed 				: ' . $slide_speed . ',
						navigation 				: true,
						pagination				:false,
						afterAction 			: syncPosition,
						responsiveRefreshRate 	: 200,
						navigationText	  		: ["<i class=\"fa fa-chevron-left\"></i>", "<i class=\"fa fa-chevron-right\"></i>"],
					});
					sync2.owlCarousel({
						items 			  		: ' . $items . ',
						itemsDesktop      		: [1199,' . $items_desktop . '],
						itemsDesktopSmall		: [979,' . $items_desktop . '],
						itemsTablet       		: [768,' . $items_tablet . '],
						itemsMobile       		: [479,' . $items_mobile . '],
						navigationText	  		: ["<i class=\"fa fa-chevron-left\"></i>", "<i class=\"fa fa-chevron-right\"></i>"],
						pagination		  		:false,
						navigation 	  			: true,
						responsiveRefreshRate 	: 100,
						afterInit 				: function(el){
							el.find(".owl-item").eq(0).addClass("synced");
						}
					});
					function syncPosition(el){
						var current = this.currentItem;
						sync2.find(".owl-item").removeClass("synced").eq(current).addClass("synced");
						if(sync2.data("owlCarousel") !== undefined){
							center(current)
						}
					}
					sync2.on("click", ".owl-item", function(e){
						e.preventDefault();
						var number = $(this).data("owlItem");
						sync1.trigger("owl.goTo",number);
					});
					function center(number){
						var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
						var num = number;
						var found = false;
						for(var i in sync2visible){
							if(num === sync2visible[i]){
								var found = true;
							}
						}
						if(found===false){
							if(num>sync2visible[sync2visible.length-1]){
								sync2.trigger("owl.goTo", num - sync2visible.length+2)
							}else{
								if(num - 1 === -1){
									num = 0;
								}
								sync2.trigger("owl.goTo", num);
							}
						} else if(num === sync2visible[sync2visible.length-1]){
							sync2.trigger("owl.goTo", sync2visible[1])
						} else if(num === sync2visible[0]){
							sync2.trigger("owl.goTo", num-1)
						}
					}
				});
			})(jQuery);
		</scr' . 'ipt>';

	}else{
		$html .= '<div id="' . esc_attr( $id ) . '" class="k2t-carousel owl-carousel ' . $class . '">';
		$html .= do_shortcode( $content );
		$html .= '</div>';

		// Set param for carousel
		$single_item = ( $single_item ) ? 'singleItem: true,' : '';
		$auto_play = ( $auto_play ) ? 'autoPlay: true,' : '';
		$stop_on_hover = ( $stop_on_hover ) ? 'stopOnHover: true,' : '';
		$navigation = ( $navigation ) ? 'navigation: true,' : 'navigation: false,';
		$pagination = ( $pagination ) ? 'pagination: true,' : 'pagination: false,';
		$lazyLoad = ( $lazyLoad ) ? 'lazyLoad: true,' : '';
		$script .= '<scr' . 'ipt>
			(function($) {
				"use strict";
				$(document).ready(function() {				
					$("#' . $id . '").owlCarousel({
						items 					: ' . $items . ',
						itemsDesktop      		: [1199,' . $items_desktop . '],
						itemsDesktopSmall		: [979,' . $items_desktop . '],
						itemsTablet       		: [768,' . $items_tablet . '],
						itemsMobile       		: [479,' . $items_mobile . '],
						navigationText 			: ["<i class=\"fa fa-chevron-left\"></i>", "<i class=\"fa fa-chevron-right\"></i>"],
						slideSpeed 				: ' . $slide_speed . ', '. $single_item . $auto_play . $stop_on_hover . $navigation . $pagination . $lazyLoad .'
					});
				});
			})(jQuery);
		</scr' . 'ipt>';
	}
	
	//Apply filters return
	$html = apply_filters( 'k2t_k2t_slider_return', $html . $script );


	return $html;
	}
}