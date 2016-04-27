<?php
/**
 * The template for displaying search results pages.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

get_header(); ?>

	<section class="k2t-content">
		<div class="k2t-wrap">
			<main class="k2t-main" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'contractor' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'content', 'search' );
				endwhile;
				else :
					get_template_part( 'content', 'none' );
				endif;

				include_once CONTRACTOR_TEMPLATE_TMPL . '/navigation.php';
			?>

			</main><!-- #main -->

			<?php get_sidebar(); ?>
		</div><!-- .k2t-wrap -->
	</section><!-- .k2t-content -->

<?php get_footer(); ?>
