<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="page-entry">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'contractor' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .page-entry -->
	
</article><!-- #post-## -->
