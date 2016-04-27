<?php
/**
 * The template for displaying news with masonry full width style.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 *
 * Template Name: Blog Masonry Right Sidebar
 */

// Get theme options
global $smof_data, $post;

// Get post format
$post_format = get_post_format();
$link        = ( function_exists( 'get_field' ) ) ? get_field( 'link_format_url', get_the_ID() ) : '';
$large       = ( function_exists( 'get_field' ) ) ? get_field( 'post_large', get_the_ID() ) : '';

get_header(); ?>

	<div class="k2t-content right-sidebar b-masonry" style="padding-top: 70px;">

		<div class="k2t-wrap">

			<main class="k2t-blog" role="main">
				
				<?php
					echo '<div class="masonry-layout column-3">';
					echo '<div class="grid-sizer"></div>';

					$args = array(
						'post_type'      => 'post',
						'posts_per_page' => get_option('posts_per_page '),
					);

					$the_query = new WP_query( $args );

					while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( $large ); ?>>
	
						<?php
							if ( has_post_thumbnail() ) :
								the_post_thumbnail();
							endif;

							if ( 'quote' != $post_format ) :
						?>
						
							<div class="k2t-text">

								<div class="k2t-meta">
									<?php
										if ( $smof_data['blog-categories-filter'] ) {
											$categories_list = get_the_category_list( __( ' - ', 'contractor' ) );
											if ( $categories_list ) :
												echo '<div class="post-cat">';
													printf( __( '%1$s', 'contractor' ), $categories_list );
												echo '</div>';
											endif;
										}
									?>
									<?php
										if ( 'link' == $post_format ) {
											the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( $link ) ), '</a></h2>' );
										} else {
											if ( $smof_data['blog-post-link'] ) {
												the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
											}
										}
									?>
									
									<?php
									if ( $smof_data['blog-date'] ) { ?>
										<div class="posted-on">
											<?php the_time( 'j M Y' ); ?>
										</div>
									<?php } ?>
								</div><!-- .k2t-meta -->

								<div class="k2t-entry">
									<?php
										$content         = get_the_content();
										$trimmed_content = wp_trim_words( $content, 10, '...' );
										echo $trimmed_content;
									?>
									<div class="k2t-post-info">
										<?php
										if ( $smof_data['blog-author'] ) { ?>
											<div class="post-author">
												<?php echo sprintf( __( '%2$s<span>%1$s</span>', 'contractor' ), get_the_author_link(), get_avatar( get_the_author_meta( 'user_email' ), '30', '' ) );?>
											</div>
										<?php } ?>
										<?php if ( $smof_data['blog-number-comment'] ) {
											if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
												<div class="post-comment">
													<a href="<?php esc_url ( comments_link() ); ?>"><i class="fa fa-comments-o"></i><?php comments_number( '0 Comment', '1 Comment', '% Comments' ); ?></a>
												</div>
											<?php
											endif;
										} ?>
									</div>
								</div><!-- .k2t-entry -->

							</div>

						<?php endif; ?>

					</article><!-- #post-## -->
						
					<?php
					endwhile;

					include get_template_directory() . '/framework/contractor/tmpl/navigation.php';

					echo '</div>'; // End .masonry-layout
				?>

			</main><!-- .k2t-main -->

			<?php get_sidebar(); ?>

		</div><!-- .k2t-wrap -->
	</div><!-- .k2t-content -->

<?php get_footer(); ?>
<script>
	(function($) {
		"use strict";

		$(window).load(function() {
			var container = document.querySelector(".b-masonry .masonry-layout");
			var msnry = new Masonry( container, {
				itemSelector: ".hentry",
				columnWidth: container.querySelector(".grid-sizer")
			});
		});
	})(jQuery);
</script>