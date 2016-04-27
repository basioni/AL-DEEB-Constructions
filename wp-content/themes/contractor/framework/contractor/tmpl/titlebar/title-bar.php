<?php
/**
 * The template for displaying title and breadcrumb.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme options
global $smof_data, $post;

// Get post or page id
if ( is_home() ) {
	$id = get_option( 'page_for_posts' );
} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
	$id = get_option( 'woocommerce_shop_page_id' );
} else {
	$id = get_the_ID();
}
$classes = $css = $html = array();

// Show or hidden title bar
if ( is_single() || is_category() || function_exists( 'is_product_category' ) && is_product_category() || function_exists( 'is_account_page' ) && is_account_page() || function_exists( 'is_cart' ) && is_cart() || function_exists( 'is_checkout' ) && is_checkout() ) {
	$titlebar_show_hidden = 'show';
} else {
	$titlebar_show_hidden = ( function_exists( 'get_field' ) ) ? get_field( 'display_titlebar', $id ) : '';
}

// Title bar layout 'layout-1 = Justify' or 'layout-2 = Center'
$titlebar_layout        = ( function_exists( 'get_field' ) ) ? get_field( 'titlebar_layout', $id ) : '';
$single_titlebar_layout = $smof_data['single-titlebar-layout'];
if ( is_single() ) {
	$classes[] = $smof_data['single-titlebar-layout'];
} elseif ( $titlebar_layout ) {
	$classes[] = empty( $titlebar_layout ) ? 'justify' : $titlebar_layout;
} else {
	$classes[] = empty( $smof_data['titlebar-layout'] ) ? 'justify' : $smof_data['titlebar-layout'];
}

// Title bar font size
$titlebar_font_size = ( function_exists( 'get_field' ) ) ? get_field( 'page_titlebar_font_size', $id ) : '';
if ( $titlebar_font_size ) {
	$titlebar_font_size = ! empty( $titlebar_font_size ) ? 'font-size:' . $titlebar_font_size . ';' : '';
} else {
	$titlebar_font_size = ! empty( $smof_data['titlebar-title-size'] ) ? 'font-size:' . $smof_data['titlebar-title-size'] . 'px;' : '';
}

// Title bar color
$titlebar_font_color = ( function_exists( 'get_field' ) ) ? get_field( 'page_titlebar_color', $id ) : '';
if ( $titlebar_font_color ) {
	$titlebar_font_color = ! empty( $titlebar_font_color ) ? 'color:' . $titlebar_font_color . ';' : '';
} else {
	$titlebar_font_color = ! empty( $smof_data['titlebar-title-color'] ) ? 'color:' . $smof_data['titlebar-title-color'] . ';' : '';
}

// Background zoom effect
$titlebar_bg_zoom        = ( function_exists( 'get_field' ) ) ? get_field( 'background_zoom', $id ) : '';
$titlebar_bg_zoom_height = ( function_exists( 'get_field' ) ) ? get_field( 'background_zoom_height', $id ) : '';
if ( $titlebar_bg_zoom ) {
	$classes[] = empty( $titlebar_bg_zoom ) ? '' : 'zoom-effect';
	$css[]     = ! empty( $titlebar_bg_zoom_height ) ? 'height: ' . $titlebar_bg_zoom_height . ';' : '';

	function k2t_bg_zoom_trigger_script() {
		$titlebar_bg_zoom_height = ( function_exists( 'get_field' ) ) ? get_field( 'background_zoom_height', get_the_ID() ) : '';
		$height = str_replace( 'px', '', $titlebar_bg_zoom_height );

		echo '
		<scr' . 'ipt>
			(function($) {
				"use strict";

				$(document).ready(function() {
					var titleBar   = $( ".k2t-title-bar" ),
						titleBarH  = $( ".k2t-title-bar" ).height(),
						adminBar   = $( "#wpadminbar" ).height(),
						content    = $( "k2t-content" ),
						headerH    = $(".k2t-header").height(),
						zoomOffset = headerH + adminBar,
						contentOffset = ' . $height . ' - zoomOffset;
					if ( titleBar.hasClass( "zoom-effect" ) ) {
						titleBar.css( "top", - zoomOffset + "px" );
						titleBar.find( ".k2t-wrap" ).css( "margin-top", zoomOffset + "px" );
						titleBar.next().css( "margin-top", contentOffset + "px" );
						titleBar.next().css( "background-color", "#fff" );
						titleBar.next().css( "z-index", "1" );
						$( ".k2t-header" ).css( "position", "relative" );
						$( ".k2t-header" ).css( "z-index", "2" );
					}
				});
			})(jQuery);
		</scr' . 'ipt>';
	}
	add_action( 'wp_footer', 'k2t_bg_zoom_trigger_script' );
}

// Padding for title bar
$titlebar_padding_top    = ( function_exists( 'get_field' ) ) ? get_field( 'pading_top', $id ) : '';
$titlebar_padding_bottom = ( function_exists( 'get_field' ) ) ? get_field( 'padding_bottom', $id ) : '';
$single_padding_top      = $smof_data['single-pading-top'];
$single_padding_bottom   = $smof_data['single-pading-bottom'];
if ( is_single() ) {
	$css[] = ! empty( $single_padding_top ) ? 'padding-top:' . $single_padding_top . ';' : '';
	$css[] = ! empty( $single_padding_bottom ) ? 'padding-bottom:' . $single_padding_bottom . ';' : '';
} elseif ( empty( $titlebar_bg_zoom ) && ( $titlebar_padding_top || $titlebar_padding_bottom ) ) {
	$css[] = ! empty( $titlebar_padding_top ) ? 'padding-top:' . $titlebar_padding_top . ';' : '';
	$css[] = ! empty( $titlebar_padding_bottom ) ? 'padding-bottom:' . $titlebar_padding_bottom . ';' : '';
} else {
	$css[] = ! empty( $smof_data['pading-top'] ) ? 'padding-top:' . $smof_data['pading-top'] . ';' : '';
	$css[] = ! empty( $smof_data['pading-bottom'] ) ? 'padding-bottom:' . $smof_data['pading-top'] . ';' : '';
}

// Background image
$titlebar_bg_image    = ( function_exists( 'get_field' ) ) ? get_field( 'background_image', $id ) : '';
$titlebar_bg_position = ( function_exists( 'get_field' ) ) ? get_field( 'background_position', $id ) : '';
$titlebar_bg_size     = ( function_exists( 'get_field' ) ) ? get_field( 'background_size', $id ) : '';
$titlebar_bg_repeat   = ( function_exists( 'get_field' ) ) ? get_field( 'background_repeat', $id ) : '';
$single_bg_image      = $smof_data['single-background-image'];
$single_bg_repeat     = $smof_data['single-background-repeat'];
$single_bg_position   = $smof_data['single-background-position'];
if ( is_single() ) {
	$css[] = ! empty( $single_bg_image ) ? 'background-image: url(' . esc_url( $single_bg_image ) . ');' : '';
	$css[] = ! empty( $single_bg_repeat ) ? 'background-repeat: ' . $single_bg_repeat . ';' : '';
	$css[] = ! empty( $single_bg_position ) ? 'background-position: ' . $single_bg_position . ';' : '';
} elseif ( empty( $titlebar_bg_zoom ) && ( $titlebar_bg_image || $titlebar_bg_position || $titlebar_bg_repeat ) ) {
	$css[] = ! empty( $titlebar_bg_image ) ? 'background-image: url(' . esc_url( $titlebar_bg_image['url'] ) . ');' : '';
	$css[] = ! empty( $titlebar_bg_position ) ? 'background-position: ' . $titlebar_bg_position . ';' : '';
	$css[] = ! empty( $titlebar_bg_repeat ) ? 'background-repeat: ' . $titlebar_bg_repeat . ';' : '';
	if ( 'full' == $titlebar_bg_size ) {
		$css[] = ! empty( $titlebar_bg_size ) ? 'background-size: 100%;' : '';
	}
	$css[] = ! empty( $titlebar_bg_size ) ? 'background-size: ' . $titlebar_bg_size . ';' : '';
} else {
	$css[] = ! empty( $smof_data['background-image'] ) ? 'background-image: url(' . esc_url( $smof_data['background-image'] ) . ');' : '';
	$css[] = ! empty( $smof_data['background-position'] ) ? 'background-position: ' . $smof_data['background-position'] . ';' : '';
	$css[] = ! empty( $smof_data['background-repeat'] ) ? 'background-repeat: ' . $smof_data['background-repeat'] . ';' : '';
}

// Background color
$titlebar_bg_color = ( function_exists( 'get_field' ) ) ? get_field( 'background_color', $id ) : '';
$single_bg_color   = $smof_data['single-background-color'];
if ( is_single() ) {
	$css[] = ! empty( $single_bg_color ) ? 'background-color: ' . $single_bg_color . ';' : '';
} elseif ( $titlebar_bg_color ) {
	$css[] = ! empty( $titlebar_bg_color ) ? 'background-color: ' . $titlebar_bg_color . ';' : '';
} else {
	$css[] = ! empty( $smof_data['background-color'] ) ? 'background-color: ' . $smof_data['background-color'] . ';' : '';
}

// Background parallax
$titlebar_bg_parallax = ( function_exists( 'get_field' ) ) ? get_field( 'background_parallax', $id ) : '';
$single_bg_parallax   = $smof_data['single-background-parallax'];
if ( is_single() ) {
	$classes[] = empty( $single_bg_parallax ) ? '' : 'parallax';
} elseif ( $titlebar_bg_parallax ) {
	$classes[] = empty( $titlebar_bg_parallax ) ? '' : 'parallax';
} else {
	$classes[] = empty( $smof_data['background-parallax'] ) ? '' : 'parallax';
}
$inline_attr = '';
if ( $titlebar_bg_parallax || $smof_data['single-background-parallax'] || $smof_data['background-parallax'] ) {
	function k2t_parallax_trigger_script() {
		echo '
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
		</scr' . 'ipt>';
	}
	add_action( 'wp_footer', 'k2t_parallax_trigger_script' );
	$inline_attr = 'data-stellar-background-ratio="0.5"';
}

// Title bar shadow
$titlebar_shadow = ( function_exists( 'get_field' ) ) ? get_field( 'titlebar_shadow_opacity', $id ) : '';
$single_shadow   = $smof_data['single-titlebar-shadow-opacity'];
if ( is_single() ) {
	$classes[] = empty( $single_shadow ) ? '' : 'shadow';
} elseif ( $titlebar_bg_color ) {
	$classes[] = empty( $titlebar_shadow ) ? '' : 'shadow';
} else {
	$classes[] = empty( $smof_data['titlebar-shadow-opacity'] ) ? '' : 'shadow';
}

// Title bar mask color & background
$titlebar_mask_color   = ( function_exists( 'get_field' ) ) ? get_field( 'titlebar_overlay_opacity', $id ) : '';
$titlebar_mask_pattern = ( function_exists( 'get_field' ) ) ? get_field( 'titlebar_clipmask_opacity', $id ) : '';
$single_mask_color     = $smof_data['single-titlebar-overlay-opacity'];
$single_mask_pattern   = $smof_data['single-titlebar-clipmask-opacity'];
if ( is_single() ) {
	$html[] = empty( $single_mask_color ) ? '' : '<div class="mask colors"></div>';
	$html[] = empty( $single_mask_pattern ) ? '' : '<div class="mask pattern"></div>';
} elseif ( $titlebar_mask_color || $titlebar_mask_pattern ) {
	$html[] = empty( $titlebar_mask_color ) ? '' : '<div class="mask colors"></div>';
	$html[] = empty( $titlebar_mask_pattern ) ? '' : '<div class="mask pattern"></div>';
} else {
	$html[] = empty( $smof_data['titlebar-overlay-opacity'] ) ? '' : '<div class="mask colors"></div>';
	$html[] = empty( $smof_data['titlebar-clipmask-opacity'] ) ? '' : '<div class="mask pattern"></div>';
}

// Title custom content
$titlebar_custom_content = ( function_exists( 'get_field' ) ) ? get_field( 'titlebar_custom_content', $id ) : '';
if ( $titlebar_custom_content ) {
	$titlebar_custom_content = ( function_exists( 'get_field' ) ) ? get_field( 'titlebar_custom_content', $id ) : '';
} else {
	$titlebar_custom_content = $smof_data['titlebar-custom-content'];
}
if ( 'show' == $titlebar_show_hidden || ( isset( $titlebar_show_hidden ) && empty( $titlebar_show_hidden )) ) :
?>

	<div class="k2t-title-bar <?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="<?php echo esc_attr( implode( '', $css ) ); ?>" <?php echo esc_attr( $inline_attr ); ?>>
		<?php if ( $titlebar_bg_zoom ) : ?>
			<div class="zoom" style="background-size: cover;background-image: url('<?php echo esc_url( $titlebar_bg_image['url'] ) ?>');background-repeat: <?php echo $titlebar_bg_repeat; ?>;height: 100%;width: 100%;"></div>
		<?php endif; ?>
		<?php echo implode( ' ', $html ); ?>
		<div class="k2t-wrap">
			<h1 class="main-title" style="<?php echo esc_attr( $titlebar_font_size . $titlebar_font_color ); ?>">
				<?php
					if ( is_tag() ) {

						printf( single_tag_title() );

					} elseif ( is_day() ) {

						printf( the_time( 'F j, Y' ) );

					} elseif ( is_month() ) {

						printf( the_time( 'F, Y' ) );

					} elseif ( is_year() ) {

						printf( the_time( 'Y' ) );

					} elseif ( is_search() ) {

						printf( __( 'Search for ', 'contractor' ) . get_search_query() );

					} elseif ( is_front_page() ) {

						printf( bloginfo( 'name' ) );

					} elseif ( is_single() ) {

						printf( single_post_title() );

					} elseif ( is_category() ) {

						printf( single_cat_title() );

					} elseif ( is_author() ) {

						global $wp_query;

						$curauth = $wp_query->get_queried_object();

						printf( $curauth->nickname );

					} elseif ( is_page() ) {

						the_title();

					} elseif ( is_home() ) {

						printf( __( 'Blog', 'contractor' ) );

					} elseif ( is_404() ) {

						printf( __( 'Error 404', 'contractor' ) );
						
					} elseif (  function_exists( 'is_product_category' ) && is_product_category() ) {

						$id          = get_the_ID();
						$product_cat = wp_get_post_terms( $id, 'product_cat' );
						$title = $slug = array();
						if ( $product_cat ) {
							foreach ( $product_cat as $category ) {
								$title[] = "{$category->name}";
							}
						}

						printf( $title[0] );

					} elseif ( is_post_type_archive( 'product' ) ) {

						printf( __( 'Shop', 'contractor' ) );

					} elseif ( is_post_type_archive() ) {

						printf( post_type_archive_title() );
						
					} elseif (
						( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ||
						( function_exists( 'is_cart' ) && is_cart() ) ||
						( function_exists( 'is_checkout' ) && is_checkout() )
					) {
						$product_cat = wp_get_post_terms( $id, 'product_cat' );
						$title = array();
						if ( $product_cat ) {
							foreach ( $product_cat as $category ) {
								$title[] = "{$category->name}";
							}
						}
						echo $title[0];
					}
				?>
			</h1>
			<span class="main-excerpt">
				<?php
					if ( is_single() ) {
						if ( $smof_data['single-titlebar-custom-content'] ) {
							echo $smof_data['single-titlebar-custom-content'];
						} else {
							the_excerpt();
						}
					} elseif ( is_category() ) {
						// Show an optional term description.
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;
					} else {
						echo do_shortcode( $titlebar_custom_content );
					}
				?>
			</span><!-- .main-excerpt -->
			<?php
			if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
				if ( $smof_data['shop-breadcrumb'] ) {
					k2t_breadcrumbs();
				}
			} else {
				if ( $smof_data['breadcrumb'] ) {
					k2t_breadcrumbs();
				}
			}
			?>
		</div><!-- k2t-wrap -->
	</div><!-- .k2t-title-bar -->

<?php endif;