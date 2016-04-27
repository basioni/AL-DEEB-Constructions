<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

get_header(); ?>

	<section class="k2t-content b-classic">
		<div class="k2t-wrap">
			<main class="k2t-main" role="main">

				<?php
					if ( have_posts() ) :

						while ( have_posts() ) : the_post();
							include CONTRACTOR_TEMPLATE_TMPL . '/blog/content-classic.php';
						endwhile;

					else :
						get_template_part( 'content', 'none' );
					endif;
				?>

			</main><!-- #main -->

			<?php get_sidebar(); ?>

		</div><!-- .k2t-wrap -->
	</section><!-- .k2t-content -->

<?php get_footer(); ?>