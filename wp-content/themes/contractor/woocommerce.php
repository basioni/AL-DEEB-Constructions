<?php
/**
 * The template for displaying woocommerce.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme options
global $smof_data;

$classes = array();

// Get shop layout
$shop_layout   = $smof_data['shop-template'];
$single_layout = $smof_data['shop-single-template'];
$shop_column   = $smof_data['shop-products-column'];

if ( ! is_product() ) :
	if ( 'right_sidebar' == $shop_layout ) {
		$classes[] = 'right-sidebar';
	} elseif ( 'left_sidebar' == $shop_layout ) {
		$classes[] = 'left-sidebar';
	} else {
		$classes[] = 'no-sidebar';
	}
else :
	if ( 'right_sidebar' == $single_layout ) {
		$classes[] = 'right-sidebar';
	} elseif ( 'left_sidebar' == $single_layout ) {
		$classes[] = 'left-sidebar';
	} else {
		$classes[] = 'no-sidebar';
	}
endif;

get_header(); ?>
	<div class="k2t-content <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<section class="container">
			<main id="main" class="k2t-shop <?php if ( ! is_product() ) : echo 'columns-' . esc_attr( $shop_column ) . ''; endif; ?>">

				<?php woocommerce_content(); ?>

			</main><!-- #main -->
			
			<?php
			if ( ! is_product() ) {
				if ( 'no_sidebar' != $shop_layout ) { ?>
					<div class="k2t-shop-sidebar" role="complementary">
						<?php
							if ( empty( $single_custom_sidebar ) ) {
								dynamic_sidebar( 'shop_sidebar' );
							} else {
								dynamic_sidebar( $single_custom_sidebar );
							}
						?>
					</div><!-- .k2t-sidebar -->
			<?php }
			} else {
				if ( 'no_sidebar' != $single_layout ) { ?>
					<div class="k2t-shop-sidebar" role="complementary">
						<?php
							if ( empty( $single_custom_sidebar ) ) {
								dynamic_sidebar( 'shop_sidebar' );
							} else {
								dynamic_sidebar( $single_custom_sidebar );
							}
						?>
					</div><!-- .k2t-sidebar -->
				<?php }
			}
			?>

		</section><!-- .container -->
	</div><!-- .k2t-content -->
<?php get_footer(); ?>