<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

$attachment_ids = array();

?>
<?php
if ( function_exists( 'k2t_pre_process_shortcode' ) ) {
	wp_enqueue_script( 'k2t-owlcarousel' );
	echo '<scr' . 'ipt>
		jQuery(document).ready(function (s) {
			var sync1 = s("#sync-preview");
			var sync2 = s("#sync-thumb");

			sync1.owlCarousel({
				singleItem: true,
				slideSpeed: 1000,
				navigation: false,
				pagination: false,
				afterAction: syncPosition,
				responsiveRefreshRate: 200,
			});

			sync2.owlCarousel({
				items: 4,
				itemsDesktop: [1199, 4],
				itemsDesktopSmall: [979, 4],
				itemsTablet: [768, 2],
				itemsMobile: [479, 2],
				pagination: false,
				navigation: true,
				navigationText: [
					"<i class=\"dashicons dashicons-arrow-left-alt2\"></i>",
					"<i class=\"dashicons dashicons-arrow-right-alt2\"></i>"
				],
				responsiveRefreshRate: 100,
				afterInit: function (el) {
					el.find(".owl-item").eq(0).addClass("synced");
				}
			});

			function syncPosition(el) {
				var current = this.currentItem;
				s("#sync-thumb")
					.find(".owl-item")
					.removeClass("synced")
					.eq(current)
					.addClass("synced")
				if (s("#sync-thumb").data("owlCarousel") !== undefined) {
					center(current)
				}
			}

			s("#sync-thumb").on("click", ".owl-item", function (e) {
				e.preventDefault();
				var number = s(this).data("owlItem");
				sync1.trigger("owl.goTo", number);
			});

			function center(number) {
				var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
				var num = number;
				var found = false;
				for (var i in sync2visible) {
					if (num === sync2visible[i]) {
						var found = true;
					}
				}

				if (found === false) {
					if (num > sync2visible[sync2visible.length - 1]) {
						sync2.trigger("owl.goTo", num - sync2visible.length + 2)
					} else {
						if (num - 1 === -1) {
							num = 0;
						}
						sync2.trigger("owl.goTo", num);
					}
				} else if (num === sync2visible[sync2visible.length - 1]) {
					sync2.trigger("owl.goTo", sync2visible[1])
				} else if (num === sync2visible[0]) {
					sync2.trigger("owl.goTo", num - 1)
				}
			}
		});
	</scr' . 'ipt>';
} ?>
<div class="images">
	<div class="p-gallery">
		<?php
			if ( $product->is_on_sale() ) {
				echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'woocommerce' ) . '</span>', $post, $product );		
			} else if ( ! $product->get_price() ) {
				echo '<span class="free-badge">' . __( 'Free', 'woocommerce' ) . '</span>';
			}
		?>
		
		<div id="sync-preview" class="owl-carousel">
			
				<?php
					if ( has_post_thumbnail() ) {

						$image_object = get_the_post_thumbnail( $post->ID, 'shop_single' );
						$image_title  = esc_attr( get_the_title( get_post_thumbnail_id() ) );
						$image_alt    = esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) );
						$image_link   = wp_get_attachment_url( get_post_thumbnail_id() );

						if ( $image_link ) {
							$image_html = $image_object;
							echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="item" itemprop="image"><a href="%2$s" itemprop="image" class="woocommerce-main-image zoom" title="%3$s" alt="%4$s">%1$s</a></div>', $image_html, esc_url( $image_link ), esc_attr( $image_title ), esc_attr( $image_alt ) ), $post->ID );
						}
						
					}
					$loop = 0;
					$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
					
					if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
						
						$attachment_ids = $product->get_gallery_attachment_ids();
						
						if ( $attachment_ids ) {
				
							foreach ( $attachment_ids as $attachment_id ) {
					
								$classes = array( 'zoom' );
					
								if ( $loop == 0 || $loop % $columns == 0 )
									$classes[] = 'first';
					
								if ( ( $loop + 1 ) % $columns == 0 )
									$classes[] = 'last';
					
								$image_link = wp_get_attachment_url( $attachment_id );
					
								if ( ! $image_link )
									continue;
								
								$image_class = esc_attr( implode( ' ', $classes ) );
								$image_title = esc_attr( get_the_title( $attachment_id ) );
								$image_alt   = esc_attr( get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) );
								$image       = aq_resize( $image_link, 427, 546, true );
								
								if ($image_link) {
								
									$image_html = '<img class="product-slider-image" data-zoom-image="' . esc_url( $image_link ) . '" src="' . esc_url( $image ) . '" alt="' . esc_attr( $image_alt ) . '" title="' . esc_attr( $image_title ) . '" />';
			
									echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item" itemprop="image"><a href="%2$s" itemprop="image" class="woocommerce-main-image zoom" title="%3$s" alt="%4$s">%1$s</a></div>', $image_html, esc_url( $image_link ), $image_class, esc_attr( $image_title ), esc_attr( $image_alt ) ), $attachment_id, $post->ID, $image_class );
								
								}
									
								$loop++;
							}
						
						}
						
					} else {
						
						$attachment_ids = get_posts( array(
							'post_type' 	=> 'attachment',
							'numberposts' 	=> -1,
							'post_status' 	=> null,
							'post_parent' 	=> $post->ID,
							'post__not_in'	=> array( get_post_thumbnail_id() ),
							'post_mime_type'=> 'image',
							'orderby'		=> 'menu_order',
							'order'			=> 'ASC'
						) );
												
						if ( $attachment_ids ) {
					
							$loop = 0;
							$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
					
							foreach ( $attachment_ids as $key => $attachment ) {
					
								if ( get_post_meta( $attachment->ID, '_woocommerce_exclude_image', true ) == 1 )
									continue;
					
								$classes = array( 'zoom' );
					
								if ( $loop == 0 || $loop % $columns == 0 )
									$classes[] = 'first';
					
								if ( ( $loop + 1 ) % $columns == 0 )
									$classes[] = 'last';
									
								$image_alt = esc_attr( get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) );
					
								printf( '<a href="%s" title="%s" alt="%s" rel="thumbnails" class="%s">%s</a>', esc_url( wp_get_attachment_url( $attachment->ID ) ), esc_attr( $attachment->post_title ), esc_attr( $image_alt ), implode(' ', $classes), wp_get_attachment_image( $attachment->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) ) );
					
								$loop++;
					
							}					
						}
					}
				?>
			
		</div>

		<?php if ( $attachment_ids ) { ?>
		<div class="p-thumb">
			<div id="sync-thumb" class="owl-carousel">
				
				<?php 	
					$image      = get_option( 'shop_thumbnail_image_size' );
					$image_link = wp_get_attachment_url( get_post_thumbnail_id() );
					$image_crop = aq_resize( $image_link, 100, 130, true, false );		
					
					if ( has_post_thumbnail() ) :
						echo '<div class="item"><img src="' . esc_url( $image_crop[0] ) . '" width="100" height="130" /></div>';
					endif;
					
					$loop = 0;
					$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
					
					foreach ( $attachment_ids as $attachment_id ) {

						$classes = array( 'zoom' );
			
						if ( $loop == 0 || $loop % $columns == 0 )
							$classes[] = 'selected';
			
						$image_link = wp_get_attachment_url( $attachment_id );
			
						if ( ! $image_link )
							continue;
			
						$image_class = esc_attr( implode( ' ', $classes ) );
						$image       = aq_resize( $image_link, 100, 130, true, false );
						$image_html  = '<img src="' . esc_url( $image[0] ) . '" width="100" height="130" />';
						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item">%s</div>', $image_html ), $attachment_id, $post->ID, $image_class );
						
						$loop++;
					}
				?>

			</div>
		</div>
		<?php } ?>
	</div>
</div>