<?php
/**
 * The template for displaying Category pages
 */
get_header(); ?>

<?php global $smof_data;?>
<?php 
global $blog_arr; wp_enqueue_script('jquery-isotope');
// Get meta data of taxonomy portfolio category
$page_layout = $smof_data['portfolio-category-layout'];
$portfolio_display_titlebar = $smof_data['portfolio-display-titlebar'];


$portfolio_category_column = $smof_data['portfolio-category-column'];
$portfolio_category_style = $smof_data['portfolio-category-style'];
$portfolio_category_child_style = $smof_data['portfolio-category-child-style'];
$portfolio_category_number = $smof_data['portfolio-category-number'];
$portfolio_display_filter = $smof_data['portfolio-display-filter'];
$portfolio_category_pagination_type = $smof_data['portfolio-category-pagination-type'];

$paged = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);


if ( 'right_sidebar' == $page_layout ) {
	$classes[] = 'right-sidebar';
} elseif ( 'left_sidebar' == $page_layout ) {
	$classes[] = 'left-sidebar';
} elseif ( 'no_sidebar' == $page_layout || 'full_width' == $page_layout ) {
	$classes[] = 'no-sidebar';
}

get_header(); ?>

	<div class="k2t-content <?php echo implode( ' ', $classes ) ?>">

		<?php
			if ( 'full_width' != $page_layout ) {
				echo '<div class="k2t-wrap">';
			}
		?>

		<main class="k2t-main" role="main">

			<?php echo do_shortcode( '[portfolio number="5" column="' . $portfolio_category_column . '" style="' . $portfolio_category_style . '" child_style="' . $portfolio_category_child_style . '" filter="' . $portfolio_display_filter . '" filter_style="1" padding="true" /]' );?>

		</main><!-- #main -->

		<?php
			if ( 'default' == $page_layout || 'right_sidebar' == $page_layout || 'left_sidebar' == $page_layout ) {
				get_sidebar();
			}

			if ( 'full_width' != $page_layout ) {
				echo '</div>';
			}
		?>
		
	</div><!-- .k2t-content -->

<?php get_footer(); ?>