<?php
/**
 * The template for displaying single post content.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme options
global $smof_data;

// Get post format
$post_format = get_post_format();
$link        = ( function_exists( 'get_field' ) ) ? get_field( 'link_format_url', get_the_ID() ) : '';

// Display categories
$display_categories = ( function_exists( 'get_field' ) ) ? get_field( 'display_categories', get_the_ID() ) : '';

// Display post time
$display_post_date = ( function_exists( 'get_field' ) ) ? get_field( 'display_post_date', get_the_ID() ) : '';

// Display tags
$display_tags = ( function_exists( 'get_field' ) ) ? get_field( 'display_tags', get_the_ID() ) : '';

// Display author post bio
$display_authorbox = ( function_exists( 'get_field' ) ) ? get_field( 'display_authorbox', get_the_ID() ) : '';

// Display related post
$display_related_post = ( function_exists( 'get_field' ) ) ? get_field( 'display_related_post', get_the_ID() ) : '';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="k2t-meta">
		<div class="post-author">
			<?php echo sprintf( __( 'Posted By <span>%s</span>', 'contractor' ), get_the_author_link() );?>
		</div>
		<?php if ( '1' == $display_post_date || 'default' == $display_post_date && $smof_data['single-post-date'] ) {  ?>
			<div class="posted-on">
				<i class="fa fa-clock-o"></i><?php the_time( 'j M Y' ); ?>
			</div>
		<?php }

			if ( '1' == $display_categories || 'default' == $display_categories && $smof_data['single-categories'] ) {
				// Used between list items, there is a space after the comma
				$categories_list = get_the_category_list( __( ' - ', 'contractor' ) );
				if ( $categories_list ) :
					echo '<div class="post-cat">';
						printf( __( '<i class="fa fa-folder-open-o"></i>%1$s', 'contractor' ), $categories_list );
					echo '</div>';
				endif;
			}
		
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
			<div class="post-comment">
				<a href="<?php esc_url ( comments_link() ); ?>"><i class="fa fa-comments"></i><?php comments_number( '0 Comment', '1 Comment', '% Comments' ); ?></a>
			</div>
		<?php endif; ?>
	</div><!-- .k2t-meta -->

	<?php include get_template_directory() . '/framework/contractor/tmpl/blog/post-format.php'; ?>

	<div class="post-entry">
		<?php the_content(); ?>
	</div><!-- .post-entry -->
	<div class="k2t-row k2t-post-share">
		<div class="col-6">
			<?php
			if ( '1' == $display_tags || 'default' == $display_tags && $smof_data['single-tags'] ) {
				// Used between list items, there is a space after the comma
				$tags_list = get_the_tag_list( '', __( '', 'contractor' ) );

				if ( $tags_list ) :
				?>
					<div class="tags-links">
						<?php printf( __( '<i class="fa fa-tags"></i>%1$s', 'contractor' ), $tags_list ); ?>
					</div>
				<?php endif;
			}
			?>
		</div><!-- .col-6 -->
		<div class="col-6">
			<?php
				if ( $smof_data['single-social'] ) {
					k2t_social_share();
				}
			?>
		</div><!-- .col-6 -->
	</div><!-- .k2t-row -->

	<?php
		if ( '1' == $display_authorbox || 'default' == $display_authorbox && $smof_data['single-authorbox'] ) {
			// Filter HTML code for author information
			$author_info = apply_filters( 'k2t_author_info', '<div class="author-info">%1$s<div class="author-bio"><h3>' . __( 'Written by ', 'contractor' ) . '&nbsp;%2$s</h3><p>%3$s</p></div></div>' );
			printf( $author_info, get_avatar( get_the_author_meta( 'user_email' ), '60', '' ), get_the_author_link(), get_the_author_meta( 'description' ) ); ?>
			
			<div class="author-social">
				<?php

					$channels = array( 'facebook', 'twitter', 'google-plus', 'pinterest', 'youtube', 'vimeo', 'linkedin', 'tumblr', 'flickr', 'behance', 'dribbble', 'skype' );

					$list = array();
					foreach ( $channels as $value ) {
						$acc = get_the_author_meta( $value );

						if ( $acc ) {
							$list[] = sprintf( '<li><a href="%s" title="%s" target="_blank"><i class="fa fa-%s"></i></a></li>', esc_url ( $acc ), ucfirst( $value ), $value );
						}
					}
					if ( $list ) :
						echo '<ul>' . implode( '', $list ) . '</ul>';
					endif;
				?>
			</div>

		<?php }

		if ( $smof_data['single-nav'] ) { ?>
			<div class="single-nav">
				<?php previous_post_link( '<span class="prev">Previous %link</span>' ); ?>
				<?php next_post_link( '<span class="next">Next %link</span>' ); ?>
			</div><!-- .single-nav -->
	<?php } ?>

</article><!-- #post-## -->
