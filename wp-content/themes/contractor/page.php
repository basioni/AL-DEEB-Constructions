<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme options
global $smof_data, $post;

$classes = array();

// Get post or page id
if ( is_home() ) {
	$id = get_option( 'page_for_posts' );
} else {
	$id = get_the_ID();
}

// Get page layout
$page_layout        = ( function_exists( 'get_field' ) ) ? get_field( 'page_layout', $id ) : '';
$page_sidebar_width = ( function_exists( 'get_field' ) ) ? get_field( 'page_sidebar_width', $id ) : '';

if ( 'right_sidebar' == $page_layout ) {
	$classes[] = 'right-sidebar';
} elseif ( 'left_sidebar' == $page_layout ) {
	$classes[] = 'left-sidebar';
} elseif ( 'no_sidebar' == $page_layout || 'full_width' == $page_layout ) {
	$classes[] = 'no-sidebar';
}else{
	$classes[] = 'right-sidebar';
}

get_header(); ?>

	<div class="k2t-content <?php echo esc_attr( implode( ' ', $classes ) ); ?>">

		<?php
			if ( 'full_width' != $page_layout ) {
				echo '<div class="k2t-wrap">';
			}
		?>

		<main class="k2t-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->

		<?php
			if ( 'default' == $page_layout || 'right_sidebar' == $page_layout || 'left_sidebar' == $page_layout ) {
				get_sidebar();
			}

			if ( ! isset( $page_layout) || empty( $page_layout ) ) {
				get_sidebar();
			}

			if ( 'full_width' != $page_layout ) {
				echo '</div>';
			}
		?>
		
	</div><!-- .k2t-content -->

<?php get_footer(); ?>
