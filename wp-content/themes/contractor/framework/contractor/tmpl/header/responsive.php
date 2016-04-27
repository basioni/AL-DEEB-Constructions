<?php
/**
 * The template for displaying menu responsive.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme options
global $smof_data;

// Get logo type
$logo = isset ( $smof_data['logo'] ) ? trim( $smof_data['logo'] ) : '';
?>
<div class="k2t-header-m">
	<div class="k2t-menu-m">
		<a class="m-trigger mobile-menu-toggle"><span></span></a>
		<div class="mobile-menu-wrap dark-div">
			<a href="#" class="mobile-menu-toggle"><i class="fa fa-times-circle"></i></a>
			<ul class="mobile-menu">
				<?php
					wp_nav_menu(array(
						'theme_location'  => 'mobile',
						'container' => false,
						'items_wrap' => '%3$s',
					)); 
				?>
			</ul>
		</div>
	</div>

	<div class="k2t-logo-m">
		<?php if ( $logo == '' || ( isset( $smof_data['text-logo'] ) && $smof_data['use-text-logo'] ) ) : ?>
			<h1 class="logo-text">
				<a class="k2t-logo" rel="home" href="<?php echo esc_url( home_url( "/" ) ); ?>">
					<?php
						if ( ! $smof_data['text-logo'] ) {
							echo bloginfo( 'name' );
						} else {
							echo $smof_data['text-logo'];
						}
					?>
				</a><!-- .k2t-logo -->
			</h1><!-- .logo-text -->
		<?php else : ?>
			<a class="k2t-logo" rel="home" href="<?php echo esc_url( home_url( "/" ) ); ?>">
				<img src="<?php echo esc_url( $logo );?>" alt="<?php bloginfo( 'name' );?>" />
			</a><!-- .k2t-logo -->
		<?php endif; ?>
	</div><!-- .k2t-logo-m -->

	<div class="k2t-right-m">
		<div class="search-box">
			<i class="fa fa-search"></i>
		</div><!-- .search-box -->
	</div><!-- .k2t-right-m -->
</div><!-- .k2t-header-m -->