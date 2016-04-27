<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme option
global $smof_data;
?>
	</div><!-- .k2t-body -->

	<footer class="k2t-footer" role="contentinfo">

		<?php
			// Get bottom info
			$bottom_background_image    = $smof_data['bottom-background-image'];
			$bottom_background_color    = $smof_data['bottom-background-color'];
			$bottom_background_repeat   = $smof_data['bottom-background-repeat'];
			$bottom_background_size     = $smof_data['bottom-background-size'];
			$bottom_background_position = $smof_data['bottom-background-position'];
			$bottom_sidebars_layout     = $smof_data['bottom-sidebars-layout'];

			// Get footer info
			$footer_background_image    = $smof_data['footer-background-image'];
			$footer_background_color    = $smof_data['footer-background-color'];
			$footer_background_repeat   = $smof_data['footer-background-repeat'];
			$footer_background_size     = $smof_data['footer-background-size'];
			$footer_background_position = $smof_data['footer-background-position'];

			$bottom_class = $footer_class = array();

			if ( ! empty( $bottom_background_image ) ) {
				$bottom_class[] = 'background-image:url(' . esc_url( $bottom_background_image ) . ');';
			}
			if ( ! empty( $bottom_background_color ) ) {
				$bottom_class[] = 'background-color:' . $bottom_background_color . ';';
			}
			if ( ! empty( $bottom_background_repeat ) ) {
				$bottom_class[] = 'background-repeat:' . $bottom_background_repeat . ';';
			}
			if ( ! empty( $bottom_background_size ) ) {
				$bottom_class[] = 'background-size:' . $bottom_background_size . ';';
			}
			if ( ! empty( $bottom_background_position ) ) {
				$bottom_class[] = 'background-position:' . $bottom_background_position . ';';
			}

			if ( ! empty( $footer_background_image ) ) {
				$footer_class[] = 'background-image:url(' . esc_url( $footer_background_image ) . ');';
			}
			if ( ! empty( $footer_background_color ) ) {
				$footer_class[] = 'background-color:' . $footer_background_color . ';';
			}
			if ( ! empty( $footer_background_repeat ) ) {
				$footer_class[] = 'background-repeat:' . $footer_background_repeat . ';';
			}
			if ( ! empty( $footer_background_size ) ) {
				$footer_class[] = 'background-size:' . $footer_background_size . ';';
			}
			if ( ! empty( $footer_background_position ) ) {
				$footer_class[] = 'background-position:' . $footer_background_position . ';';
			}
		?>
		<div class="k2t-bottom" style="<?php echo esc_attr( implode( ' ', $bottom_class ) ); ?>">
			<div class="k2t-wrap">
				<div class="k2t-row">
				<?php 
					switch( $bottom_sidebars_layout ) {
						case 'layout-2':
							for ( $i = 1; $i <= 3; $i++ ) {
								echo '<div class="col-4">'; 
									dynamic_sidebar( 'footer-' . $i );
								echo '</div>';
							}
							break;
						case 'layout-3':
							for ( $i = 1; $i <= 3; $i++ ) {
								if ( $i == 1 ) {
									echo '<div class="col-6">';
								} else {
									echo '<div class="col-3">'; 
								}
									dynamic_sidebar( 'footer-' . $i );
								echo '</div>';
							}
							break;
						case 'layout-4':
							for ( $i = 1; $i <= 3; $i++ ) {
								if ( $i == 2 ) {
									echo '<div class="col-6">';
								} else {
									echo '<div class="col-3">'; 
								}
									dynamic_sidebar( 'footer-' . $i );
								echo '</div>';
							}
							break;
						case 'layout-5':
							for ( $i = 1; $i <= 3; $i++ ) {
								if ( $i == 3 ) {
									echo '<div class="col-6">';
								} else {
									echo '<div class="col-3">'; 
								}
									dynamic_sidebar( 'footer-' . $i );
								echo '</div>';
							}
							break;
						case 'layout-6':
							for ( $i = 1; $i <= 2; $i++ ) {
								echo '<div class="col-6">'; 
									dynamic_sidebar( 'footer-' . $i );
								echo '</div>';
							}
							break;
						case 'layout-7':
							for ( $i = 1; $i <= 1; $i++ ) {
								echo '<div class="col-12">'; 
									dynamic_sidebar( 'footer-' . $i );
								echo '</div>';
							}
							break;
						default:
							for ( $i = 1; $i <= 4; $i++ ) {
								echo '<div class="col-3">'; 
									dynamic_sidebar( 'footer-' . $i );
								echo '</div>';
							}
							break;
					}
				?>
				</div><!-- .k2t-row -->
			</div><!-- .k2t-wrap -->
		</div><!-- .k2t-bottom -->

		<div class="k2t-info" style="<?php echo esc_attr( implode( ' ', $footer_class ) ); ?>">
			<div class="k2t-wrap">
				<?php
					echo $smof_data['footer-copyright-text'];
					wp_nav_menu(
						array(
							'theme_location' => 'footer_menu',
							'container'   => false,
							'menu_id'     => 'footer-menu',
							'fallback_cb' => '',
						)
					);
				?>

			</div><!-- .k2t-wrap -->
		</div><!-- .k2t-info -->

	</footer><!-- .k2t-footer -->
</div><!-- .k2t-container -->

<!-- Show Offcanvas sidebar -->
<?php if ( $smof_data['offcanvas-turnon'] ) : ?>
	<div class="offcanvas-sidebar">
		<div class="k2t-sidebar">
			<?php dynamic_sidebar( $smof_data['offcanvas-sidebar'] ); ?>
		</div>
	</div>
<?php endif; ?>
<!-- End Show Offcanvas sidebar -->

<div class="k2t-searchbox-mobile">
	<form class="searchform" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
		<input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s-mobile" placeholder="<?php echo esc_attr_x( 'Search...', 'contractor' ); ?>" />
		<button type="submit" value="" id="searchsubmit-mobile"><i class="fa fa-search"></i></button>
	</form>
</div>

<?php
if ( $smof_data['footer-gototop'] ) :
	echo '<a href="#" class="k2t-btt"><i class="fa fa-angle-up"></i></a>';
endif;

wp_footer(); ?>
</body>
</html>
