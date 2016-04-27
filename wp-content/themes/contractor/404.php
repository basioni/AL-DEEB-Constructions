<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme option
global $smof_data;

get_header(); ?>

	<section class="k2t-not-found">
		<main class="k2t-wrap" role="main">

			<div class="k2t-error-404">
				<header class="page-header">
					<h1><?php echo esc_html( $smof_data['404-title'] ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php echo $smof_data['404-text']; ?></p>
					<?php get_search_form(); ?>
					<span><?php _e( 'Or', 'contractor' ); ?></span>
					<p><?php _e( '<a href="' . esc_url ( home_url() ) . '" rel="home">Back to Home page</a>', 'contractor' ); ?></p>
				</div><!-- .page-content -->
			</div><!-- .k2t-error-404 -->

		</main><!-- .k2t-wrap -->
	</section><!-- .k2t-not-found -->

<?php get_footer(); ?>
