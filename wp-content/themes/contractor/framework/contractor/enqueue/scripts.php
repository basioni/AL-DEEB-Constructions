<?php
/**
 * Enqueue scripts.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link    http://www.kingkongthemes.com
 */

/*--------------------------------------------------------------
	Enqueue front-end inline script
--------------------------------------------------------------*/
if ( ! function_exists( 'k2t_front_end_enqueue_inline_script' ) ) :
	function k2t_front_end_enqueue_inline_script() {
		// Get theme options
		global $smof_data;

		if ( ! wp_script_is(' k2t-inline-scripts', 'scripts' ) ) {

			if ( isset( $smof_data['blog-style'] ) && 'timeline' == $smof_data['blog-style'] ) {
				echo '
				<scr' . 'ipt>
					jQuery(window).load(function($) {
						"use strict";
						var $ = jQuery;
						function timeline_indicator() {
							var post = $( ".b-timeline" ).find( ".hentry" );
							$.each( post, function( i,obj ) {           
								var posLeft = $( obj ).css( "left" );
								if( posLeft == "0px" ) {
									$(obj).addClass( "post-left" );
								} else {
									$(obj).addClass( "post-right" );
								}
							});
						}
						if ( $( ".k2t-content" ).hasClass( "b-timeline" ) ){
							var container = document.querySelector(".k2t-blog-timeline");
							var msnry = new Masonry( container, {
								itemSelector: ".hentry",
								columnWidth: container.querySelector(".hentry")
							});

							msnry.on( "layoutComplete", function() {
								timeline_indicator();
								if ( $().infinitescroll ){
									//timeline_pagination();
								}
							});
							// manually trigger initial layout
							msnry.layout();
						}
					});
				</scr' . 'ipt>';
			}

			global $wp_scripts;
			$wp_scripts->scripts[] = 'k2t-inline-scripts';
		}
	}
	add_action( 'wp_footer', 'k2t_front_end_enqueue_inline_script', 10000 );
endif;

