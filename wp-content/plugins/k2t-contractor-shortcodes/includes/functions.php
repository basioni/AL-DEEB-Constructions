<?php
/**
 * Shortcode functions.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

/* ------------------------------------------------------- */
/* Return list shortcode name
/* ------------------------------------------------------- */
if ( ! function_exists( 'k2t_return_list_shortcode' ) ) {
	function k2t_return_list_shortcode() {
		$shortcodes = 'animation, google_map, heading, dropcap, button, pre, tooltip, br, clear, spacer, countdown, iconlist, iconbox_list, imagebox, iconbox, process, hr, highlight, k2t_embed, k2t_slider, member, piechart, pricing, progress, toggle, accordion, tab, container, counter, content_slider, awesome_slider, brands, testimonial, circle_button, align, sticky_tab, section, blockquote, blog_post, event';
		return $shortcodes;
	}
}

/* ------------------------------------------------------- */
/* Remove automatics - wpautop
/* ------------------------------------------------------- */
add_filter( 'the_content', 'k2t_pre_process_shortcode', 7 );

// Allow Shortcodes in Widgets
add_filter( 'widget_text', 'k2t_pre_process_shortcode', 7 );
if ( ! function_exists( 'k2t_pre_process_shortcode' ) ) {
	function k2t_pre_process_shortcode( $content ) {
		$shortcodes = k2t_return_list_shortcode();
		$shortcodes = explode( ",", $shortcodes );
		$shortcodes = array_map( "trim", $shortcodes );

		global $shortcode_tags;

		// Backup current registered shortcodes and clear them all out
		$orig_shortcode_tags = $shortcode_tags;
		$shortcode_tags = array( );

		foreach ( $shortcodes as $shortcode ) {
			add_shortcode( $shortcode, 'k2t_' . $shortcode . '_shortcode' );
		}
		// Do the shortcode (only the one above is registered)
		$content = do_shortcode( $content );

		// Put the original shortcodes back
		$shortcode_tags = $orig_shortcode_tags;

		return $content;
	}
}

/* ------------------------------------------------------- */
/* Include Shortcode File - Add shortcodes to everywhere use*
/* ------------------------------------------------------- */
$shortcodes = k2t_return_list_shortcode();
$shortcodes = explode( ",", $shortcodes );
$shortcodes = array_map( "trim", $shortcodes );

foreach ( $shortcodes as $short_code ) {
	require_once dirname( __FILE__ ) . '/shortcodes/' . $short_code . '.php'; //Include google map shortcode
	add_shortcode( $short_code, 'k2t_' . $short_code . '_shortcode' );
}

/*-------------------------------------------------------------------
	Add param k2t icon.
--------------------------------------------------------------------*/
if ( class_exists( 'Vc_Manager' ) ) :
	function k2t_iconfont_settings_field( $settings, $value ) {
		$display = 'display:none;';
		$output  = '';
		if ( isset( $value ) && esc_attr( $value ) != "" ) {
			$display = 'display:block;';
			$output = '
				<div>
					<span class="edit-menu-icon-preview-' . esc_attr( $settings['param_name'] ) . '" rel-icon="icont_font_' . esc_attr( $settings['param_name'] ) . '" style="width:30px;height:30px;float:left;line-height:28px;font-size:22px;'. $display .';"><i class="' . esc_attr( $value ) . '"></i></span>
							'
						.'<input id="icont_font_' . esc_attr( $settings['param_name'] ) . '" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
						esc_attr( $settings['param_name'] ) . ' ' .
						esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" style = "width:283px" />' .
						'
					<a href="#" class="button" title="Add Icon" for="icont_font_' . esc_attr( $settings['param_name'] ) . '" id="k2ticon-generator-button-' . esc_attr( $settings['param_name'] ) . '">
						<span class="awesome-plus"></span>
					</a>
					<a href="#" class="button k2ticon-remove-button k2ticon-remove-button-' . esc_attr( $settings['param_name'] ) . '" title="Remove Icon" remove-for="icont_font_' . esc_attr( $settings['param_name'] ) . '" id="k2ticon-remove-button-' . esc_attr( $settings['param_name'] ) . '">
						<span class="awesome-minus"></span>
					</a>
				</div>
			';
		} else {

			$output = '
				<div>
					<span class="edit-menu-icon-preview-' . esc_attr( $settings['param_name'] ) . '" rel-icon="icont_font_' . esc_attr( $settings['param_name'] ) . '" style="width:30px;height:30px;float:left;line-height:28px;font-size:22px;display:none;"></span>
							'
						.'<input id="icont_font_' . esc_attr( $settings['param_name'] ) . '" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
						esc_attr( $settings['param_name'] ) . ' ' .
						esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" style = "width:352px" />' .
						'
					<a href="#" class="button" title="Add Icon" for="icont_font_' . esc_attr( $settings['param_name'] ) . '" id="k2ticon-generator-button-' . esc_attr( $settings['param_name'] ) . '">
						<span class="awesome-plus"></span>
					</a>
					<a href="#" class="button k2ticon-remove-button k2ticon-remove-button-' . esc_attr( $settings['param_name'] ) . '" title="Remove Icon" remove-for="icont_font_' . esc_attr( $settings['param_name'] ) . '" id="k2ticon-remove-button-' . esc_attr( $settings['param_name'] ) . '" style="display:none;">
						<span class="awesome-minus"></span>
					</a>
				</div>
			';
		}

		$output .='<scr' . 'ipt>
			// Trigger for select icon
			jQuery("#k2ticon-generator-button-' . esc_attr( $settings['param_name'] ) . '").on("click",function(){
				jQuery( "#k2ticon-generator-wrap, #k2ticon-generator-overlay" ).show();
				jQuery( "#k2ticon-generator-wrap, #k2ticon-generator-overlay" ).attr( "for",jQuery( this ).attr( "for" ) );
			});
			jQuery("#icont_font_' . esc_attr( $settings['param_name'] ) . '").on("click",function(){

				jQuery("#k2ticon-generator-button-' . esc_attr( $settings['param_name'] ) . '").trigger("click");
			});
			jQuery("#icont_font_' . esc_attr( $settings['param_name'] ) . '").on("change",function(){
				jQuery( "[rel-icon=\"" + jQuery(this).attr("id") + "\"]").html("<i class=\"" + jQuery(this).val() + "\"></i>");
			});

			// Remove Icon
			jQuery(".k2ticon-remove-button-' . esc_attr( $settings['param_name'] ) . '").on("click",function(){
				current_id = jQuery(this).attr("remove-for");
				jQuery("#" + current_id ).val("");
				jQuery("#" + current_id ).trigger("change");
				jQuery(this).css("display","none");
				jQuery("[rel-icon=\"" + current_id + "\"]").css("display","none");
				jQuery("#" + current_id ).css("width","352px");
				return false;
			});

		</scr' . 'ipt>'; // This is html markup that will be outputted in content elements edit form
		return $output;
	}
	add_shortcode_param( 'k2t_icon', 'k2t_iconfont_settings_field' );
endif;