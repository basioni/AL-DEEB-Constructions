<?php
/**
 * The main template file.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme options
global $smof_data;

$classes = array();

// Get blog layout
$blog_layout = $smof_data['blog-sidebar-position'];

// Get blog style
$blog_style = $smof_data['blog-style'];

if ( 'right_sidebar' == $blog_layout ) {
	$classes[] = 'right-sidebar';
} elseif ( 'left_sidebar' == $blog_layout ) {
	$classes[] = 'left-sidebar';
} else {
	$classes[] = 'no-sidebar';
}

if ( $blog_style ) {
	$classes[] = 'b-' . $blog_style;
}

// Get columns of blog masonry
$columns = $smof_data['blog-masonry-column'];

// Blog masonry full width
$fullwidth = ( isset ( $smof_data['blog-masonry-full-width'] ) && $smof_data['blog-masonry-full-width'] ) ? ' fullwidth' : '';

get_header(); ?>

	<div class="k2t-content <?php echo esc_attr( implode( ' ', $classes ) . $fullwidth ); ?>">

		<div class="k2t-wrap">

			<main class="k2t-blog" role="main">
				
				<?php
					if ( 'masonry' == $blog_style ) {
						echo '<div class="masonry-layout ' . esc_attr( $columns ) . '">';
						echo '<div class="grid-sizer"></div>';
					}

					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							
							if ( 'classic' == $blog_style ) {
								include CONTRACTOR_TEMPLATE_TMPL . '/blog/content-classic.php';
							} elseif ( 'masonry' == $blog_style ) {
								include CONTRACTOR_TEMPLATE_TMPL . '/blog/content-masonry.php';
							}
						
						endwhile;
					else :
						get_template_part( 'content', 'none' );
					endif;

					include_once CONTRACTOR_TEMPLATE_TMPL . '/navigation.php';
				?>

			</main><!-- .k2t-main -->

			<?php
				if ( 'no_sidebar' != $blog_layout ) {
					get_sidebar();
				}
			?>

		</div><!-- .k2t-wrap -->
	</div><!-- .k2t-content -->

<?php get_footer(); ?>
