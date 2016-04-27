<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $smof_data;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related(12);

if ( sizeof( $related ) == 0 ) return;

$number = $smof_data['shop-related-products-number'];
$number_tablet = $smof_data['shop-related-products-number-tablet'];
$number_mobile = $smof_data['shop-related-products-number-mobile'];

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => 12,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="product-related">
		<?php
		echo '<scr' . 'ipt>';
			echo '
			(function($) {
				"use strict";

				$(document).ready(function() {
					var owl = $(".relate-item");
					owl.owlCarousel({
						items: ' . esc_js( $number ) . ',
						itemsDesktop: [1366, ' . esc_js( $number ) . '],
						itemsDesktopSmall: [979, ' . esc_js( $number ) . '],
						itemsTablet: [768, ' . esc_js( $number_tablet ) . '],
						itemsMobile: [320, ' . esc_js( $number_mobile ) . '],
						navigation : false
					});
				});
			})(jQuery);' ?>
		<?php
		echo '</scr' . 'ipt>';
		woocommerce_product_loop_start();
		?>

		<div class="text-heading">
			<h2><?php _e( 'You may also like...', 'woocommerce' ); ?></h2>
			<?php echo $product->get_categories( ' - ', '<span class="related-cat">' . _n( '', '', '', 'contractor' ) . ' ', '</span>' ) ?>
		</div>
		
			<div class="owl-carousel relate-item">
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>
			</div>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
