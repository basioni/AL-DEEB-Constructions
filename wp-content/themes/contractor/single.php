<?php
/**
 * The template for displaying all single posts.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme options
global $smof_data;

$classes = array();

// Get single layout
$global_single_layout = $smof_data['single-layout'];
$single_layout        = ( function_exists( 'get_field' ) ) ? get_field( 'post_layout', get_the_ID(), true ) : '';

if ( 'right_sidebar' == $global_single_layout || 'right_sidebar' == $single_layout ) {
	$classes[] = 'right-sidebar';
} elseif ( 'left_sidebar' == $global_single_layout || 'left_sidebar' == $single_layout ) {
	$classes[] = 'left-sidebar';
} elseif ( 'no_sidebar' == $global_single_layout || 'no_sidebar' == $single_layout ) {
	$classes[] = 'no-sidebar';
}

get_header(); ?>

	<div  class="k2t-content <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="k2t-wrap">
			<main class="k2t-blog" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'content', 'single' );

					if ( $smof_data['single-commnet-form'] ) {
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					}
	
				endwhile;
				?>

			</main><!-- .k2t-blog -->

			<?php
				if ( 'right_sidebar' == $single_layout || 'left_sidebar' == $single_layout || 'right_sidebar' == $global_single_layout || 'left_sidebar' == $global_single_layout ) {
					get_sidebar();	
				}
			?>

		</div><!-- .k2t-wrap -->
	</div><!-- .k2t-content -->

<?php get_footer(); ?>
