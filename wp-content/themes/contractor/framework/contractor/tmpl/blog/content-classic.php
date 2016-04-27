<?php
/**
 * The template for displaying content large image thumbnail.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme options
global $smof_data, $post;

// Get post format
$post_format = get_post_format();
$link        = ( function_exists( 'get_field' ) ) ? get_field( 'link_format_url', get_the_ID() ) : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
		include get_template_directory() . '/framework/contractor/tmpl/blog/post-format.php';

		if ( 'quote' != $post_format ) :
	?>
		<div class="k2t-entry">
			<?php
				if ( 'link' == $post_format ) {
					the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( $link ) ), '</a></h2>' );
				} else {
					if ( $smof_data['blog-post-link'] ) {
						the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
					}
				}

				if ( 'excerpts' == $smof_data['blog-display'] ) {
					$content         = get_the_content();
					$trimmed_content = wp_trim_words( $content, $smof_data['excerpt-length'], '<a class="more-link" href="' . esc_url( get_permalink() ) . '"><i class="fa fa-files-o"></i> Read More</a>' );
					echo $trimmed_content;
				} else {
					if ( $smof_data['blog-readmore'] ) {
						the_content( sprintf( __( '<i class="fa fa-files-o"></i> Read more', 'contractor' ) ) );
					} else {
						the_content( sprintf( __( ' ', 'contractor' ) ) );
					}	
				}
			?>
		</div><!-- .k2t-entry -->

	<?php endif; ?>

</article><!-- #post-## -->
