<?php
/**
 * Main function for theme.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

if ( ! function_exists( 'k2t_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Contractor 1.0
	 */
	function k2t_setup() {
		global $smof_data, $content_width;
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on contractor, use a find and replace
		 * to change 'contractor' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'contractor', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );
		
		/**
		 * Add custom header default
		 */
		add_theme_support( 'custom-header' );		
		
		/**
		 * Add custom background default
		 */
		add_theme_support( "custom-background" );
	
		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array( 'video', 'audio', 'gallery', 'link', 'quote', 'image' ) );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		// Add images size
		add_image_size( 'thumb_500x333', 500, 333, true );
		add_image_size( 'thumb_500x9999', 500, 9999, false ); // for masony of blog and portolio
		add_image_size( 'thumb_800x350', 800, 350, true ); // Blog thumbnail large
		add_image_size( 'thumb_1100x400', 1100, 400, true );
		add_image_size( 'thumb_9999x600', 9999, 600, false );
		add_image_size( 'thumb_1100x9999', 1100, 9999, false );

		/**
		 * Add default woocommerce plugin.
		 */
		add_theme_support( 'woocommerce' );	

		/**
		 * Add support title-tag
		 */
		add_theme_support( 'title-tag' );		
		
		/**
		 * This theme uses wp_nav_menu() in one location.
		 *
		 * @link http://codex.wordpress.org/Post_Formats
		 */
		register_nav_menus(
			array(
				'mobile'      => __( 'Mobile Menu', 'contractor' ),
				'primary'     => __( 'Main Menu', 'contractor' ),
				'footer_menu' => __( 'Footer Menu', 'contractor' ),
			)
		);
		
		/**
		 * Tell the TinyMCE editor to use a custom stylesheet
		 */
		add_editor_style( 'assets/css/editor-style.css' );
		
		/**
		 * Set the content width based on the theme's design and stylesheet.
		 */
		if ( ! isset( $content_width ) ) {
			$content_width = isset( $smof_data['content-width'] ) ? $smof_data['content-width'] : 1100;
		}
		
	}
	add_action( 'after_setup_theme', 'k2t_setup' );
}

/**
 * Adds sticky menu classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'k2t_add_body_class' ) ) {
	function k2t_add_body_class( $classes ) {
		global $smof_data;
		if ( ! empty( $smof_data['vertical-menu'] ) ) {
			$classes[] = 'vertical';
		}

		if ( ! empty( $smof_data['boxed-layout'] ) ) {
			$classes[] = 'boxed';
		}

		return $classes;
	}
	add_filter( 'body_class', 'k2t_add_body_class' );
}

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	function k2t_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'contractor' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'k2t_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function k2t_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'k2t_render_title' );
endif;

/**
 * Register required plugins.
 *
 * @return  void
 */
if ( ! function_exists( 'k2t_register_theme_dependency' ) ) {
	function k2t_register_theme_dependency() {
		$plugins = array(
			array(
				'name'     => 'WooCommerce',
				'slug'     => 'woocommerce',
				'required' => false,
			),
			array(
				'name'     => 'Contact Form 7',
				'slug'     => 'contact-form-7',
				'required' => false,
			),
			array(
				'name'     => 'Visual composer',
				'slug'     => 'js_composer',
				'source'   => CONTRACTOR_TEMPLATE_PATH . '/framework/contractor/plugins/js_composer.zip',
				'required' => true,
			),
			array(
				'name'               => 'K2T Contractor Shortcodes',
				'slug'               => 'k2t-contractor-shortcodes',
				'source'             => CONTRACTOR_TEMPLATE_PATH . '/framework/contractor/plugins/k2t-contractor-shortcodes.zip',
				'required'           => true,
				'force_activation'   => true,
				'force_deactivation' => false,
			),
			array(
				'name'     => 'K2T Contractor Portfolio',
				'slug'     => 'k2t-contractor-portfolio',
				'source'   => CONTRACTOR_TEMPLATE_PATH . '/framework/contractor/plugins/k2t-contractor-portfolio.zip',
				'required' => false,
			),
			array(
				'name'     => 'Advanced Custom Fields Pro',
				'slug'     => 'advanced-custom-fields-pro',
				'source'   => CONTRACTOR_TEMPLATE_PATH . '/framework/contractor/plugins/advanced-custom-fields-pro.zip',
				'required' => true,
			),
			array(
				'name'     => 'Revolution Slider',
				'slug'     => 'revslider',
				'source'   => CONTRACTOR_TEMPLATE_PATH . '/framework/contractor/plugins/revslider.zip',
				'required' => false,
			),
			array(
				'name'     => 'Envato WordPress Toolkit',
				'slug'     => 'envato-wordpress-toolkit',
				'source'   => CONTRACTOR_TEMPLATE_PATH . '/framework/contractor/plugins/envato-wordpress-toolkit.zip',
				'required' => false,
			)
		);

		tgmpa( $plugins );
	}
	add_action( 'tgmpa_register', 'k2t_register_theme_dependency' );
}

/**
 * Print custom code at the end of head section.
 *
 * @package Contractor
 */
if ( ! function_exists( 'k2t_add_head_code' ) ) {
	function k2t_add_head_code() {
		global $smof_data;
		if ( isset ( $smof_data['header_code'] ) && $smof_data['header_code'] ) {
			echo $smof_data['header_code'];
		}
	}
	add_action( 'wp_head', 'k2t_add_head_code' );
}

/**
 * Change favicon option
 *
 * @package Contractor
 */
if ( ! function_exists( 'k2t_extra_icons' ) ) {
	function k2t_extra_icons() {
		global $smof_data;
		if ( isset ( $smof_data['favicon'] ) && $smof_data['favicon'] ) {
			echo '<link sizes="16x16" href="'. esc_url( $smof_data['favicon'] ) .'" rel="icon" />';
		}
		if ( isset ( $smof_data['apple-iphone-icon'] ) && $smof_data['apple-iphone-icon'] ) {
			echo '<link rel="apple-touch-icon" sizes="57x57" href="' . esc_url( $smof_data["apple-iphone-icon"] ) . '">';
		}
		if ( isset ( $smof_data['apple-iphone-retina-icon'] ) && $smof_data['apple-iphone-retina-icon'] ) {
			echo '<link rel="apple-touch-icon" sizes="114x114" href="' . esc_url( $smof_data["apple-iphone-retina-icon"] ) . '">';
		}
		if ( isset ( $smof_data['apple-ipad-icon'] ) && $smof_data['apple-ipad-icon'] ) {
			echo '<link rel="apple-touch-icon" sizes="72x72" href="' . esc_url( $smof_data["apple-ipad-icon"] ) . '">';
		}
		if ( isset ( $smof_data['apple-ipad-retina-icon'] ) && $smof_data['apple-ipad-retina-icon'] ) {
			echo '<link rel="apple-touch-icon" sizes="144x144" href="' . esc_url( $smof_data["apple-ipad-retina-icon"] ) . '">';
		}
	}
	add_action( 'wp_head', 'k2t_extra_icons', 1 );
}

/**
 * Add a thumbnail column in edit.php
 * Source: http://wordpress.org/support/topic/adding-custum-post-type-thumbnail-to-the-edit-screen
 */
if ( ! function_exists( 'k2t_columns_filter' ) ) {
	function k2t_columns_filter( $columns ) {
		$column_thumbnail = array( 'thumbnail' => __( 'Thumbnail', 'contractor' ) );
		$columns = array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, NULL, true );
		return $columns;
	}
	add_filter( 'manage_edit-post_columns', 'k2t_columns_filter', 10, 1 );
}
if ( ! function_exists( 'k2t_add_thumbnail_value_editscreen' ) ) {
	function k2t_add_thumbnail_value_editscreen( $column_name, $post_id ) {

		$width  = (int) 50;
		$height = (int) 50;

		if ( 'thumbnail' == $column_name ) {
			// thumbnail of WP 2.9
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			// image from gallery
			$attachments = get_children( array( 'post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image' ) );
			if ( $thumbnail_id )
				$thumb = wp_get_attachment_image( $thumbnail_id, array( $width, $height ), true );
			elseif ( $attachments ) {
				foreach ( $attachments as $attachment_id => $attachment ) {
					$thumb = wp_get_attachment_image( $attachment_id, array( $width, $height ), true );
				}
			}
			if ( isset( $thumb ) && $thumb ) {
				echo $thumb;
			} else {
				echo '<em>' . __( 'None', 'contractor' ) . '</em>';
			}
		}
	}
	add_action( 'manage_posts_custom_column', 'k2t_add_thumbnail_value_editscreen', 10, 2 );
}

/**
 * Custom function to use to open and display each comment.
 *
 * @since 1.0
 */
if ( ! function_exists( 'k2t_comments' ) ) :
	function k2t_comments( $comment, $args, $depth ) {
	// Globalize comment object
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :

			case 'pingback'  :
			case 'trackback' :
				?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<p>
						<?php
						_e( 'Pingback:', 'contractor' );
						comment_author_link();
						edit_comment_link( __( 'Edit', 'contractor' ), '<span class="edit-link">', '</span>' );
						?>
					</p>
				<?php
			break;

			default :
				global $post;
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment-body">
						<?php
						echo get_avatar( $comment, 60 );
						
						if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'contractor' ); ?></p>
						<?php endif; ?>			

						<section class="comment-content comment">
							<header class="comment-meta">
								<?php
								printf(
									'<cite class="comment-author">%1$s</cite>',
									'<span>' . get_comment_author_link() . '</span>',
									( $comment->user_id == $post->post_author ) ? '<span class="author-post">' . __( 'Post author', 'contractor' ) . '</span>' : ''
								);

								printf(
									'<a href="%1$s"><i class="fa fa-clock-o"></i><time>%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									sprintf( __( '%1$s at %2$s', 'contractor' ), get_comment_date(), get_comment_time() )
								);

								?>
							</header>
							<?php comment_text(); ?>
							<footer>
								<div class="action-link">
									<?php
									edit_comment_link( __( '<span>Edit</span>', 'contractor' ) );
									comment_reply_link(
										array_merge(
											$args,
											array(
												'reply_text' => __( '<span>Reply</span>', 'contractor' ),
												'depth'      => $depth,
												'max_depth'  => $args['max_depth'],
											)
										)
									);
									?>
								</div><!-- .action-link -->
							</footer>
						</section><!-- .comment-content -->						
					</article><!-- #comment- -->
				<?php
			break;

		endswitch;
	}
endif;

/**
 * Add social network.
 *
 * @since 1.0
 */
if ( ! function_exists( 'k2t_social_array' ) ) {
	function k2t_social_array() {
		return array(
			'facebook'		=>	__( ' Facebook', 'contractor' ),
			'twitter'		=>	__( ' Twitter', 'contractor' ),
			'google-plus'	=>	__( ' Google+', 'contractor' ),
			'linkedin'	 	=>	__( ' LinkedIn', 'contractor' ),
			'tumblr'	 	=>	__( ' Tumblr', 'contractor' ),
			'pinterest'	 	=>	__( ' Pinterest', 'contractor' ),
			'youtube'	 	=>	__( ' YouTube', 'contractor' ),
			'skype'	 		=>	__( ' Skype', 'contractor' ),
			'instagram'	 	=>	__( ' Instagram', 'contractor' ),
			'delicious'	 	=>	__( ' Delicious', 'contractor' ),
			'reddit'		=>	__( ' Reddit', 'contractor' ),
			'stumbleupon'	=>	__( ' StumbleUpon', 'contractor' ),
			'wordpress'	 	=>	__( ' WordPress', 'contractor' ),
			'joomla'		=>	__( ' Joomla', 'contractor' ),
			'blogger'	 	=>	__( ' Blogger', 'contractor' ),
			'vimeo'	 		=>	__( ' Vimeo', 'contractor' ),
			'yahoo'	 		=>	__( ' Yahoo!', 'contractor' ),
			'flickr'	 	=>	__( ' Flickr', 'contractor' ),
			'picasa'	 	=>	__( ' Picasa', 'contractor' ),
			'deviantart'	=>	__( ' DeviantArt', 'contractor' ),
			'github'	 	=>	__( ' GitHub', 'contractor' ),
			'stackoverflow'	=>	__( ' StackOverFlow', 'contractor' ),
			'xing'	 		=>	__( ' Xing', 'contractor' ),
			'flattr'	 	=>	__( ' Flattr', 'contractor' ),
			'foursquare'	=>	__( ' Foursquare', 'contractor' ),
			'paypal'	 	=>	__( ' Paypal', 'contractor' ),
			'yelp'	 		=>	__( ' Yelp', 'contractor' ),
			'soundcloud'	=>	__( ' SoundCloud', 'contractor' ),
			'lastfm'	 	=>	__( ' Last.fm', 'contractor' ),
			'lanyrd'	 	=>	__( ' Lanyrd', 'contractor' ),
			'dribbble'	 	=>	__( ' Dribbble', 'contractor' ),
			'forrst'	 	=>	__( ' Forrst', 'contractor' ),
			'steam'	 		=>	__( ' Steam', 'contractor' ),
			'behance'		=>	__( ' Behance', 'contractor' ),
			'mixi'			=>	__( ' Mixi', 'contractor' ),
			'weibo'			=>	__( ' Weibo', 'contractor' ),
			'renren'		=>	__( ' Renren', 'contractor' ),
			'evernote'		=>	__( ' Evernote', 'contractor' ),
			'dropbox'		=>	__( ' Dropbox', 'contractor' ),
			'bitbucket'		=>	__( ' Bitbucket', 'contractor' ),
			'trello'		=>	__( ' Trello', 'contractor' ),
			'vk'			=>	__( ' VKontakte', 'contractor' ),
			'home'			=>	__( ' Homepage', 'contractor' ),
			'envelope-alt'	=>	__( ' Email', 'contractor' ),
			'rss'			=>	__( ' RSS', 'contractor' ),
		);
	}
}

/**
 * Pagination render.
 *
 * @since 1.0
 */
if ( ! function_exists( 'k2t_get_pagination' ) ) {
	function k2t_get_pagination( $custom_query = false ) {
		global $wp_query;

		if ( ! $custom_query ) $custom_query = $wp_query;

		$big = 999999999; // need an unlikely integer
		$pagination = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $custom_query->max_num_pages,
			'type'   => 'list',
			'prev_text'    => sprintf( __( '%s &larr; Previous', 'contractor' ), '<i class="icon-angle-left"></i>' ),
			'next_text'    => sprintf( __( 'Next &rarr; %s', 'contractor' ), '<i class="icon-angle-right"></i>' ),
		) );

		if ( $pagination ) {
			return '<div class="srol-pagination">'. $pagination . '<div class="clearfix"></div></div>';
		} else return;
	}
}

/**
 * Social share.
 *
 * @since 1.0
 */
if ( ! function_exists( 'k2t_social_share' ) ) {
	function k2t_social_share() {
		global $smof_data, $post;
		$twitter_username = isset ( $smof_data['twitter-username'] ) ? trim( $smof_data['twitter-username'] ) : '';

		// Get post thumbnail
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' ); ?>

		<div class="k2t-social-share">
			<ul class="social">
				<?php if ( isset ( $smof_data['single-social-facebook'] ) && $smof_data['single-social-facebook'] ):?>
					<li>
						<a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php esc_url( the_permalink() ); ?>" onclick="javascript:window.open( esc_js( this.href ), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
							<i class="fa fa-facebook"></i>
							<span><?php _e( 'Facebook', 'contractor' ); ?></span>
						</a>
					</li>
				<?php endif;?>

				<?php if ( isset ( $smof_data['single-social-twitter'] ) && $smof_data['single-social-twitter'] ):?>
					<li>
						<a class="twitter" href="https://twitter.com/share?url=<?php esc_url( the_permalink() ); ?>" onclick="javascript:window.open(esc_js( this.href ), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
							<i class="fa fa-twitter"></i>
							<span><?php _e( 'Twitter', 'contractor' ); ?></span>
						</a>
					</li>
				<?php endif;?>

				<?php if ( isset ( $smof_data['single-social-google-plus'] ) && $smof_data['single-social-google-plus'] ):?>
					<li>
						<a class="googleplus" href="https://plus.google.com/share?url=<?php esc_url( the_permalink() ); ?>" onclick="javascript:window.open(esc_js( this.href ), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
							<i class="fa fa-google-plus"></i>
							<span><?php _e( 'Google Plus', 'contractor' ); ?></span>
						</a>
					</li>
				<?php endif;?>

				<?php if ( isset ( $smof_data['single-social-linkedin'] ) && $smof_data['single-social-linkedin'] ):?>
					<li>
						<a class="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() );?>&title=<?php echo urlencode( get_the_title() );?>" title="<?php _e( 'LinkedIn', 'contractor' );?>">
							<i class="fa fa-linkedin"></i>
							<span><?php _e( 'Linkedin', 'contractor' ); ?></span>
						</a>
					</li>
				<?php endif;?>

				<?php if ( isset ( $smof_data['single-social-tumblr'] ) && $smof_data['single-social-tumblr'] ):?>
					<li>
						<a class="tumblr" href="https://www.tumblr.com/share/link?url=<?php echo urlencode( get_permalink() );?>&name=<?php echo urlencode( get_the_title() );?>" title="<?php _e( 'Tumblr', 'contractor' );?>">
							<i class="fa fa-tumblr"></i>
							<span><?php _e( 'Tumblr', 'contractor' ); ?></span>
						</a>
					</li>
				<?php endif;?>

				<?php if ( isset ( $smof_data['single-social-email'] ) && $smof_data['single-social-email'] ):?>
					<li>
						<a class="em" href="mailto:?subject=<?php the_title(); ?>&body=<?php echo strip_tags( apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ); ?> <?php esc_url( the_permalink() ); ?>">
							<i class="fa fa-envelope"></i>
							<span><?php _e( 'Email', 'contractor' ); ?></span>
						</a>
					</li>
				<?php endif;?>
			</ul><!-- .social -->
		</div><!-- .social-share -->
	<?php
	}
}

/**
 * Get related post
 *
 * @link http://wordpress.org/support/topic/custom-query-related-posts-by-common-tag-amount
 * @link http://pastebin.com/NnDzdSLd
 */
if ( ! function_exists( 'get_related_tag_posts_ids' ) ) {
	function get_related_tag_posts_ids( $post_id, $number = 5, $taxonomy = 'post_tag', $post_type = 'post' ) {

		$related_ids = false;

		$post_ids = array();
		// get tag ids belonging to $post_id
		$tag_ids = wp_get_post_terms( $post_id, $taxonomy, array( 'fields' => 'ids' ) );
		if ( $tag_ids ) {
			// get all posts that have the same tags
			$tag_posts = get_posts(
				array(
					'post_type'   => $post_type,
					'posts_per_page' => -1, // return all posts
					'no_found_rows'  => true, // no need for pagination
					'fields'         => 'ids', // only return ids
					'post__not_in'   => array( $post_id ), // exclude $post_id from results
					'tax_query'      => array(
						array(
							'taxonomy' => $taxonomy,
							'field'    => 'id',
							'terms'    => $tag_ids,
							'operator' => 'IN'
						)
					)
				)
			);

			// loop through posts with the same tags
			if ( $tag_posts ) {
				$score = array();
				$i = 0;
				foreach ( $tag_posts as $tag_post ) {
					// get tags for related post
					$terms = wp_get_post_terms( $tag_post, $taxonomy, array( 'fields' => 'ids' ) );
					$total_score = 0;

					foreach ( $terms as $term ) {
						if ( in_array( $term, $tag_ids ) ) {
							++$total_score;
						}
					}

					if ( $total_score > 0 ) {
						$score[$i]['ID'] = $tag_post;
						// add number $i for sorting
						$score[$i]['score'] = array( $total_score, $i );
					}
					++$i;
				}

				// sort the related posts from high score to low score
				uasort( $score, 'sort_tag_score' );
				// get sorted related post ids
				$related_ids = wp_list_pluck( $score, 'ID' );
				// limit ids
				$related_ids = array_slice( $related_ids, 0, (int) $number );
			}
		}
		return $related_ids;
	}
}
if ( ! function_exists( 'sort_tag_score' ) ) {
	function sort_tag_score( $item1, $item2 ) {
		if ( $item1['score'][0] != $item2['score'][0] ) {
			return $item1['score'][0] < $item2['score'][0] ? 1 : -1;
		} else {
			return $item1['score'][1] < $item2['score'][1] ? -1 : 1; // ASC
		}
	}
}

/**
 * Add field to custom user profile
 *
 * @since 1.0
 */
if ( ! function_exists( 'k2t_add_custom_user_profile' ) ) {
	function k2t_add_custom_user_profile( $user ) {
		?>
		<table class="form-table">
			<tr>
				<th><label for="facebook"><?php _e( 'Facebook Link', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="twitter"><?php _e( 'Twitter Link', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="google-plus"><?php _e( 'Google+ Link', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="google-plus" id="google-plus" value="<?php echo esc_attr( get_the_author_meta( 'google-plus', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="pinterest"><?php _e( 'Pinterest Link', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="youTube"><?php _e( 'YouTube Link', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="youTube" id="youTube" value="<?php echo esc_attr( get_the_author_meta( 'youTube', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="vimeo"><?php _e( 'Vimeo Link', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="vimeo" id="vimeo" value="<?php echo esc_attr( get_the_author_meta( 'vimeo', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="linkedin"><?php _e( 'Linkedin Link', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="tumblr"><?php _e( 'Tumblr Link', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="tumblr" id="tumblr" value="<?php echo esc_attr( get_the_author_meta( 'tumblr', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="custom_email"><?php _e( 'Email Link', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="custom_email" id="custom_email" value="<?php echo esc_attr( get_the_author_meta( 'custom_email', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="flickr"><?php _e( 'Flickr Link', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="flickr" id="flickr" value="<?php echo esc_attr( get_the_author_meta( 'flickr', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="behance"><?php _e( 'Behance Link', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="behance" id="behance" value="<?php echo esc_attr( get_the_author_meta( 'behance', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="dribbble"><?php _e( 'Dribbble Link', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="dribbble" id="dribbble" value="<?php echo esc_attr( get_the_author_meta( 'dribbble', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="skype"><?php _e( 'Skype ID', 'contractor' ); ?></label></th>
				<td>
					<input type="text" name="skype" id="skype" value="<?php echo esc_attr( get_the_author_meta( 'skype', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description"></span>
				</td>
			</tr>
		</table>
	<?php
	}
}

/**
 * Save custom user profile.
 *
 * @since 1.0
 */
if ( ! function_exists( 'k2t_save_custom_user_profile' ) ) {
	function k2t_save_custom_user_profile( $user_id ) {
		if ( ! current_user_can( 'edit_user', $user_id ) )
			return FALSE;
		update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
		update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
		update_user_meta( $user_id, 'google-plus', $_POST['google-plus'] );
		update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
		update_user_meta( $user_id, 'youTube', $_POST['youTube'] );
		update_user_meta( $user_id, 'vimeo', $_POST['vimeo'] );
		update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
		update_user_meta( $user_id, 'tumblr', $_POST['tumblr'] );
		update_user_meta( $user_id, 'flickr', $_POST['flickr'] );
		update_user_meta( $user_id, 'behance', $_POST['behance'] );
		update_user_meta( $user_id, 'dribbble', $_POST['dribbble'] );
		update_user_meta( $user_id, 'skype', $_POST['skype'] );
	}
}
add_action( 'show_user_profile', 'k2t_add_custom_user_profile' );
add_action( 'edit_user_profile', 'k2t_add_custom_user_profile' );
add_action( 'personal_options_update', 'k2t_save_custom_user_profile' );
add_action( 'edit_user_profile_update', 'k2t_save_custom_user_profile' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 * @since 1.0
 */
if ( ! function_exists( 'k2t_widgets_init' ) ) {
	function k2t_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Primary Sidebar', 'contractor' ),
			'id'            => 'primary_sidebar',
			'description'   => __( 'The primary sidebar of your site, appears on the right or left of post/page content.', 'contractor' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Secondary Sidebar', 'contractor' ),
			'id'            => 'secondary_sidebar',
			'description'   => __( 'The secondary sidebar of your site, appears on the right or left of post/page content.', 'contractor' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer 1', 'contractor' ),
			'id'            => 'footer-1',
			'description'   => __( 'Footer sidebar number 1, used in the footer area.', 'contractor' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer 2', 'contractor' ),
			'id'            => 'footer-2',
			'description'   => __( 'Footer sidebar number 2, used in the footer area.', 'contractor' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer 3', 'contractor' ),
			'id'            => 'footer-3',
			'description'   => __( 'Footer sidebar number 3, used in the footer area.', 'contractor' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer 4', 'contractor' ),
			'id'            => 'footer-4',
			'description'   => __( 'Footer sidebar number 4, used in the footer area.', 'contractor' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );

	}
	add_action( 'widgets_init', 'k2t_widgets_init' );
}

/**
 * Change default wordpress menu class.
 *
 * @since 1.0
 */
if ( ! function_exists( 'k2t_change_menu_class' ) ) {
	function k2t_change_menu_class( $classes, $item ) {
		if ( in_array( 'current-menu-item', $classes ) ) {
			$classes[] = 'active';
		}
		if ( in_array( 'menu-item-has-children', $classes ) ) {
			$classes[] = 'children';
		}
		return $classes;
	}
	add_filter( 'nav_menu_css_class' , 'k2t_change_menu_class' , 10 , 2);
}

/**
 * Add span tag to categories post count.
 *
 * @since 1.0
 */
if ( ! function_exists( 'k2t_cat_postcount' ) ) {
	function k2t_cat_postcount( $html ) {
		$html = str_replace('</a> (', '</a> <span class="count">(', $html );
		$html = str_replace(')', ')</span>', $html );

		return $html;
	}
	add_filter( 'wp_list_categories', 'k2t_cat_postcount' );
}
if ( ! function_exists( 'k2t_archive_postcount' ) ) {
	function k2t_archive_postcount( $html ) {
		$html = str_replace( '</a>&nbsp;(', '</a><span class="count">(', $html );
		$html = str_replace( ')', ')</span>', $html );
		
		return $html;
	}
	add_filter( 'get_archives_link', 'k2t_archive_postcount' );
}

/**
 * Custom breadcrumbs.
 *
 * @since 1.0
 */
if ( ! function_exists( 'k2t_breadcrumbs' ) ) {
	function k2t_breadcrumbs(){
		$text['home']     = __( 'Home', 'contractor' ); // text for the 'Home' link
		$text['blog']     = __( 'Blog', 'contractor' ); // text for the 'Blog' link
		$text['category'] = __( 'Archive by Category "%s"', 'contractor' ); // text for a category page
		$text['tax'] 	  = __( '%s', 'contractor' ); // text for a taxonomy page
		$text['search']   = __( 'Search Results for "%s"', 'contractor' ); // text for a search results page
		$text['tag']      = __( 'Posts Tagged "%s"', 'contractor' ); // text for a tag page
		$text['author']   = __( 'Articles Posted by %s', 'contractor' ); // text for an author page
		$text['404']      = __( 'Error 404', 'contractor' ); // text for the 404 page
		$text['shop']     = __( 'Contractor Store', 'contractor' ); // text for the 404 page

		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$delimiter   = ''; // delimiter between crumbs
		$before      = '<li class="current">'; // tag before the current crumb
		$after       = '</li>'; // tag after the current crumb

		global $post;
		$homeLink   = esc_url( home_url() );
		$linkBefore = '<li typeof="v:Breadcrumb">';
		$linkAfter  = '</li>';
		$linkAttr   = ' rel="v:url" property="v:title"';
		$link       = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

		if ( is_front_page() ) {
			echo '<ul class="k2t-breadcrumbs"><a href="' . esc_url( $homeLink ) . '">' . $text['home'] . '</a></ul>';
		} elseif ( is_home() ) {
			echo '<ul class="k2t-breadcrumbs"><a href="' . esc_url( $homeLink ) . '">' . $text['blog'] . '</a></ul>';
		} else {

			echo '<ul class="k2t-breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf( $link, esc_url( $homeLink ), $text['home'] ) . $delimiter;
			
			if ( is_category() ) {
				$thisCat = get_category( get_query_var( 'cat' ), false );
				if ( $thisCat->parent != 0 ) {
					$cats = get_category_parents( $thisCat->parent, TRUE, $delimiter );
					$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
					$cats = str_replace( '</a>', '</a>' . $linkAfter, $cats );
					echo $cats;
				}
				echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;

			} elseif ( is_tax() ) {
				$thisCat = get_category(get_query_var( 'cat' ), false );
				if ( $thisCat->parent != 0 ) {
					$cats = get_category_parents( $thisCat->parent, TRUE, $delimiter );
					$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
					$cats = str_replace( '</a>', '</a>' . $linkAfter, $cats);
					echo $cats;
				}
				echo $before . sprintf( $text['tax'], single_cat_title( '', false ) ) . $after;
			
			}elseif ( is_search() ) {
				echo $before . sprintf( $text['search'], get_search_query() ) . $after;
			} elseif ( is_day() ) {
				echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
				echo sprintf( $link, get_month_link( get_the_time( 'Y' ),get_the_time( 'm' ) ), get_the_time( 'F' ) ) . $delimiter;
				echo $before . get_the_time( 'd' ) . $after;
			} elseif ( is_month() ) {
				echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
				echo $before . get_the_time( 'F' ) . $after;
			} elseif ( is_year() ) {
				echo $before . get_the_time( 'Y' ) . $after;
			} elseif ( function_exists( 'is_product' ) && is_product() ) {
				$id = get_the_ID();
				$product_cat = wp_get_post_terms( $id, 'product_cat' );
				$title = $slug = array();
				if ( $product_cat ) {
					foreach ( $product_cat as $category ) {
						$title[] = "{$category->name}";
						$slug[]  = "{$category->slug}";
					}
				}
				echo '<li class="current"><a href="' . esc_url( get_term_link( $slug[0], 'product_cat' ) ) . '">' . $title[0] . '</a></li>';
			} elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
				echo '<li class="current">' . $text['shop'] . '</li>';
			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					printf( $link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name );
					if ( $showCurrent == 1 ) echo $delimiter . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents( $cat, TRUE, $delimiter );
					if ( $showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats );
					$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace( '</a>', '</a>' . $linkAfter, $cats);
					echo $cats;
					if ( $showCurrent == 1 ) echo $before . get_the_title() . $after;
				}

			} elseif ( ! is_single() && !is_page() && get_post_type() != 'post' && ! is_404() ) {
				$post_type = get_post_type_object(get_post_type() );
				echo $before . $post_type->labels->singular_name . $after;

			} elseif ( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				$cat = get_the_category( $parent->ID );
				$cat = $cat[0];
				$cats = get_category_parents( $cat, TRUE, $delimiter );
				$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
				$cats = str_replace( '</a>', '</a>' . $linkAfter, $cats );
				echo $cats;
				printf( $link, get_permalink( $parent ), $parent->post_title );
				if ( $showCurrent == 1 ) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_page() && !$post->post_parent ) {
				if ( $showCurrent == 1 ) echo $before . get_the_title() . $after;

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ( $parent_id) {
					$page = get_page( $parent_id );
					$breadcrumbs[] = sprintf( $link, esc_url( get_permalink( $page->ID ) ), get_the_title( $page->ID ) );
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse( $breadcrumbs );
				for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
					echo $breadcrumbs[$i];
					if ( $i != count( $breadcrumbs)-1) echo $delimiter;
				}
				if ( $showCurrent == 1 ) echo $delimiter . $before . get_the_title() . $after;

			} elseif ( is_tag() ) {
				echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				echo $before . sprintf( $text['author'], $userdata->display_name ) . $after;

			} elseif ( is_404() ) {
				echo $before . $text['404'] . $after;
			} elseif ( is_post_type_archive() ) {
				echo '' . $current_before;
					post_type_archive_title();
				echo '' . $current_after;
			}

			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '(';
				echo __( 'Page', 'contractor' ) . ' ' . get_query_var( 'paged' );
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			}

			echo '</ul>';

		}
	}
}

/**
 * Control excerpt length & more.
 *
 * @since 1.0
 */
function k2t_excerpt_length( $length ) {
	return 20;
}
function k2t_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_length', 'k2t_excerpt_length', 999 );
add_filter( 'excerpt_more', 'k2t_excerpt_more' );

/**
 * WP Editor.
 *
 * @since  1.0
 * @return void
 */
if ( ! function_exists( 'k2t_wp_editor' ) ) {
	function k2t_wp_editor( $id_col, $id_element, $section ) {
		global $smof_data;

		// Get all data of top header
		$data = json_decode ( $smof_data[ $section ], true );

		// Get content
		$content = base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['value'] );

		// Get custom class
		$custom_class = base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_class'] );

		// Get custom id
		$custom_id = base64_decode(  $data['columns'][$id_col]['value'][$id_element]['value']['custom_id'] );

		$custom_id    = ( $custom_id != '' ) ? ' id="' . esc_attr( $custom_id ) . '"' : '';

		// Output to frontend
		echo '<div class="h-element element-editor ' . $custom_class . '" ' . $custom_id . '>';
			echo do_shortcode( $content );
		echo '</div>';
	}
}

/**
 * Search box.
 *
 * @since  1.0
 * @return void
 */
if ( ! function_exists( 'k2t_search_box' ) ) {
	function k2t_search_box( $id_col, $id_element, $section ) {
		global $smof_data;

		// Get all data of top header
		$data = json_decode ( $smof_data[ $section ], true );

		// Get custom class
		$custom_class =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_class'] );

		// Get custom id
		$custom_id =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_id'] );
		$custom_id    = ( $custom_id != '' ) ? ' id="' . esc_attr( $custom_id ) . '"' : '';

		// Output to frontend
		echo '
		<div ' . $custom_id . ' class="h-element search-box ' . $custom_class . '">
			<div class="k2t-searchbox">
				<form class="searchform" role="search" method="get" action="' . esc_url( home_url( '/' ) ) . '" >
					<input type="text" value="' . esc_attr( get_search_query() ) . '" name="s" id="s" placeholder="Search..." />
					<button type="submit" value="" id="searchsubmit"><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>
		';
	}
}

/**
 * Social network.
 *
 * @since  1.0
 * @return void
 */
if ( ! function_exists( 'k2t_social' ) ) {
	function k2t_social( $id_col, $id_element, $section ) {
		global $smof_data;

		$html = $list = $link = '';

		// Get all data of top header
		$data = json_decode ( $smof_data[ $section ], true );

		// Get custom class
		$custom_class =  base64_decode(  $data['columns'][$id_col]['value'][$id_element]['value']['custom_class'] );

		// Get custom id
		$custom_id =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_id'] );
		$custom_id = ( $custom_id != '' ) ? ' id="' . esc_attr( $custom_id ) . '"' : '';

		// Get social list
		$social = $data['columns'][$id_col]['value'][$id_element]['value']['value'];

		// Link target
		$target = isset ( $smof_data['social-target'] ) ? $smof_data['social-target'] : '_blank';

		// Get social list
		foreach ( $social as $key => $value ) {
			$link =  $smof_data['social-' . $value ];
			$list .= '<li class="' . esc_attr( $value ) . '"><a target="' . $target . '" href="' . esc_url( $link ) . '"><i class="fa fa-' . $value . '"></i></a></li>';
		}
		
		if ( $list ) {
			$html .= '<ul ' . $custom_id . ' class="h-element social ' . $custom_class . '">';
			$html .= $list;
			$html .= '</ul>';
		}
		echo $html;
	}
}

/**
 * Custom menu.
 *
 * @since  1.0
 * @return void
 */
if ( ! function_exists( 'k2t_custom_menu' ) ) {
	function k2t_custom_menu( $id_col, $id_element, $section ) {
		global $smof_data;

		// Get all data of top header
		$data = json_decode ( $smof_data[ $section ], true );

		// Get menu name
		$menu =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['menu_id'] ) ;

		// Get custom class
		$custom_class =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_class'] );

		// Get custom id
		$custom_id =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_id'] );

		if ( $smof_data['enable_menu_header_section'] ) {
			wp_nav_menu(
				array(
					'menu'        => $menu,
					'container'   => false,
					'menu_id'     => $custom_id,
					'menu_class'  => 'h-element k2t-menu ' . $custom_class,
					'fallback_cb' => '',
					// 'walker'      => new K2TCoreFrontendWalker()
				)
			);
		} else {
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'   => false,
					'menu_id'     => $custom_id,
					'menu_class'  => 'h-element k2t-menu ' . $custom_class,
					'fallback_cb' => '',
					// 'walker'      => new K2TCoreFrontendWalker()
				)
			);
		}
	}
}

/**
 * Woocommerce cart.
 *
 * @since  1.0
 * @return void
 */
if ( ! function_exists( 'k2t_cart' ) ) {
	function k2t_cart( $id_col, $id_element, $section ) {
		global $smof_data;

		// Get all data of top header
		$data = json_decode ( $smof_data[ $section ], true );

		// Get custom class
		$custom_class =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_class'] );

		// Get custom id
		$custom_id =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_id'] );
		$custom_id = ( $custom_id != '' ) ? ' id="' . esc_attr( $custom_id ) . '"' : '';

		// Output to frontend
		echo '<div ' . $custom_id . ' class="h-element ' . $custom_class . '">';
		if ( class_exists( 'k2t_template_woo' ) ) :
			k2t_template_woo::k2t_shoping_cart();
		endif;
		echo '</div>';
	}
}

/**
 * Widgets in header.
 *
 * @since  1.0
 * @return void
 */
if ( ! function_exists( 'k2t_widget' ) ) {
	function k2t_widget( $id_col, $id_element, $section ) {
		global $smof_data;

		// Get all data of top header
		$data = json_decode ( $smof_data[ $section ], true );

		// Get sidebar id
		$sidebar =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['widget_id'] );

		// Get custom class
		$custom_class =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_class'] );

		// Get custom id
		$custom_id =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_id'] );
		$custom_id    = ( $custom_id != '' ) ? ' id="' . esc_attr( $custom_id ) . '"' : '';

		// Output to frontend
		echo '<div ' . $custom_id . ' class="h-element ' . $custom_class . '">';
		if ( is_active_sidebar( $sidebar ) ) :
			dynamic_sidebar( $sidebar );
		endif;
		echo '</div>';
	}
}

/**
 * Logo in header.
 *
 * @since  1.0
 * @return void
 */
if ( ! function_exists( 'k2t_logo' ) ) {
	function k2t_logo( $id_col, $id_element, $section ) {
		global $smof_data;

		// Get all data of top header
		$data = json_decode ( $smof_data[ $section ], true );

		// Get custom class
		$custom_class =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_class'] );

		// Get custom id
		$custom_id =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_id'] );
		$custom_id    = ( $custom_id != '' ) ? ' id="' . esc_attr( $custom_id ) . '"' : '';

		echo '<div ' . $custom_id . ' class="h-element ' . $custom_class . '">';
		?>
		<a class="k2t-logo" rel="home" href="<?php echo esc_url( home_url( "/" ) ); ?>">
			<?php
			$logo = isset ( $smof_data['logo'] ) ? trim( $smof_data['logo'] ) : '';
			if ( $logo == '' || ( isset( $smof_data['text-logo'] ) && $smof_data['use-text-logo'] ) ) :
				echo '<h1 class="logo-text">';
					if ( ! $smof_data['text-logo'] ) {
						echo bloginfo( 'name' );
					} else {
						echo $smof_data['text-logo'];
					}
				echo '</h1>';
			else: ?>
				<img src="<?php echo esc_url( $logo );?>" alt="<?php bloginfo( 'name' );?>" />
			<?php endif; ?>	
		</a>
		<?php
		echo '</div>';
	}
}

/**
 * Canvas sidebar.
 *
 * @since  1.0
 * @return void
 */
if ( ! function_exists( 'k2t_canvas_sidebar' ) ) {
	function k2t_canvas_sidebar_body_class( $classes ) {
		global $smof_data;

		// Get canvas sidebar class
		$classes[] = 'offcanvas-type-default';
		if ( $smof_data['offcanvas-sidebar-position'] ) {
			$classes[] = ' offcanvas-' . $smof_data['offcanvas-sidebar-position'];
		}else{
			$classes[] = ' offcanvas-left';
		}
		return $classes;
	}
	add_filter( 'body_class', 'k2t_canvas_sidebar_body_class' );

	function k2t_canvas_sidebar( $id_col, $id_element, $section ) {
		global $smof_data;

		// Get all data of top header
		$data = json_decode ( $smof_data[ $section ], true );

		// Get custom class
		$custom_class =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_class'] );

		// Get custom id
		$custom_id =  base64_decode( $data['columns'][$id_col]['value'][$id_element]['value']['custom_id'] );
		$custom_id    = ( $custom_id != '' ) ? ' id="' . esc_attr( $custom_id ) . '"' : '';

		// Output to frontend
		echo '<div ' . $custom_id . ' class="h-element ' . $custom_class . '">';
		echo '<a onclick="javascript:return false;" class="open-sidebar" href="#"><div class="inner"></div></a>';
		echo '</div>';
		return;
	}
}

/**
 * Header visual layout generate.
 *
 * @since  1.0
 * @return void
 */
function k2t_data( $id, $i, $section ) {
	global  $smof_data;

	// Get all data of section
	$data = json_decode ( $smof_data[ $section ], true );

	// Get element type
	$type = $data['columns'][$id]['value'][$i]['type'];
	switch ( $type ) {
		case 'wp_editor' :
			k2t_wp_editor( $id, $i, $section );
			break;
		case 'search_box' :
			k2t_search_box( $id, $i, $section );
			break;
		case 'social' :
			k2t_social( $id, $i, $section );
			break;
		case 'custom_menu' :
			k2t_custom_menu( $id, $i, $section );
			break;
		case 'widget' :
			k2t_widget( $id, $i, $section );
			break;
		case 'cart' :
			k2t_cart( $id, $i, $section );
			break;
		case 'logo' :
			k2t_logo( $id, $i, $section );
			break;
		case 'canvas_sidebar' :
			k2t_canvas_sidebar( $id, $i, $section );
			break;
	}
}

/**
 * Convert Hex Color to RGB
 *
 * @since  1.0
 * @return array
 */
function k2t_hex2rgb( $hex ) {
	$hex = str_replace( "#", "", $hex );

	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );
	
	// returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}

/**
 * Add advanced restore theme options.
 *
 * @since  1.0
 * @return void
 */
function k2t_add_advance_option() {
	$add_data = array();
	
	$backup_restore = get_option( 'contractor_theme_options_advance_backup_restore' );

	if ( isset( $backup_restore ) && $backup_restore == '' ) {
		/* Add Data Theme Options */
		$backup_id                  = $_POST['advance_id'];
		$add_data[0]['advance_id']  = $backup_id;
		$add_data[0]['backup_id']   = $backup_id . '_' . time();
		$backup_name                = $_POST['backup_name'];
		$add_data[0]['backup_name'] = $backup_name;
		$add_data[0]['time']        = date('D M j G:i Y');
		$backup_data                = $_POST['data'];
		$add_data[0]['data']        = $backup_data;
		add_option( 'contractor_theme_options_advance_backup_restore', json_encode( $add_data ) );
	} else {
		$current_backup_data     = array();
		$backup_id               = $_POST['advance_id'];
		$add_data['advance_id']  = $backup_id;
		$add_data['backup_id']   = $backup_id . '_' . time();
		$backup_name             = $_POST['backup_name'];
		$add_data['backup_name'] = $backup_name;
		$add_data['time']        = date('D M j G:i Y');
		$backup_data             = $_POST['data'];
		$add_data['data']        = $backup_data;
		$current_backup_data     = ( array )json_decode( $backup_restore ) ;
		array_push( $current_backup_data, $add_data );
		update_option( 'contractor_theme_options_advance_backup_restore', json_encode( $current_backup_data ) );
	}
	die();
}
add_action( 'wp_ajax_k2t_add_advance_option', 'k2t_add_advance_option' );
add_action( 'wp_ajax_nopriv_k2t_add_advance_option', 'k2t_add_advance_option' );

/**
 * Load advanced restore theme options.
 *
 * @since  1.0
 * @return void
 */
function k2t_load_advance_option() {
	$id                  = $_POST['advance_id'];
	$backup_restore      = get_option( 'contractor_theme_options_advance_backup_restore' );
	$current_backup_data = ( array )json_decode( $backup_restore );
	
	$output = '<div onload="">';
	foreach( $current_backup_data as $da ) {
		if( $da->advance_id == $id ) {
			$output .= '
			<li backup-id=' . $da->backup_id . ' for=' . $id . ' data="' . $da->data . '">
				<input for="' . esc_attr( $id ) . '" for-name="' . esc_attr( $da->backup_name ) . '" id="input_downloadify' . esc_attr( $da->backup_id ) . '" type="hidden" value="' . esc_attr( $id ) . '|' . esc_attr( $da->backup_id ) . '|' . esc_attr( $da->backup_name ) . '|' . esc_attr( $da->data ) . '" />
				<div id="download_backup" class="download_backup download_backup' . $da->backup_id . '">Open Text Field</div>
				<div class="dashicons_item dashicons dashicons-trash"></div>' . $da->backup_name . '
			</li>';
			
		}
		$output .= '
			<scr' . 'ipt>
				opensave.make({ 					
					width: 		20,
					height: 	20,
					filename: 	"Data.txt", 
					buttonDiv: 	"download_backup",
					dataID: 	"input_downloadify' . $da->backup_id . '",
					image_up:   "' . CONTRACTOR_TEMPLATE_URL . '/framework/assets/images/download.png",
					image_down: "' . CONTRACTOR_TEMPLATE_URL . '/framework/assets/images/download-hover.png",
					image_over: "' . CONTRACTOR_TEMPLATE_URL . '/framework/assets/images/download-hover.png",
					label:""
				});
			</scr' . 'ipt>';
	}
	$output .= '</div>';
	
	echo $output;
	die();
}
add_action( 'wp_ajax_k2t_load_advance_option', 'k2t_load_advance_option' );
add_action( 'wp_ajax_nopriv_k2t_load_advance_option', 'k2t_load_advance_option' );

/**
 * Backup advanced restore theme options.
 *
 * @since  1.0
 * @return void
 */
function k2t_backup_advance_option() {
	global $smof_data, $options_machine, $of_options;
	$id      = $_POST['advance_id'];
	$data    = $_POST['data'];
	$restore =  json_decode( base64_decode( $data ) );
	foreach( $restore as $rk=>$aid ) {
		foreach ( $smof_data as $k=>$v ) {
			if ( $k == $rk && $k != '0' ) {
				if ( $smof_data[$k] != $aid ) { 
					set_theme_mod( $k, $aid );
				} else if ( is_array( $v ) ) {
					foreach ( $aid as $key=>$val ) {
						if ( $key != $k && $v[$key] == $val ) {
							set_theme_mod( $k, $aid );
							break;
						}
					}
				}			
			}
		}
	}
	die();
}
add_action( 'wp_ajax_k2t_backup_advance_option', 'k2t_backup_advance_option' );
add_action( 'wp_ajax_nopriv_k2t_backup_advance_option', 'k2t_backup_advance_option' );

/**
 * Delete backup.
 *
 * @since  1.0
 * @return void
 */
function k2t_delete_advance_option() {
	global $smof_data, $options_machine, $of_options;
	$id                  = $_POST['advance_id'];
	$backup_id           = $_POST['backup_id'];
	$data                = $_POST['data'];
	$backup_restore      = get_option( 'contractor_theme_options_advance_backup_restore' );
	$current_backup_data = ( array )json_decode( $backup_restore );
	$output              = '';
	$i = 0;
	$template = array();
	foreach( $current_backup_data as $da ) {
		if ( $da->backup_id != $backup_id ) {
			$template[] = $da;
		}
		$i++;
	}
	update_option( 'contractor_theme_options_advance_backup_restore', json_encode( $template ) );
	die();
}
add_action( 'wp_ajax_k2t_delete_advance_option', 'k2t_delete_advance_option' );
add_action( 'wp_ajax_nopriv_k2t_delete_advance_option', 'k2t_delete_advance_option' );

/**
 * Upload backup.
 *
 * @since  1.0
 * @return void
 */
function k2t_backup_from_file() {
	global $smof_data, $options_machine, $of_options;

	$data_backup         = $_POST['data_backup'];
	$backup_type         = $_POST['backup_type'];
	$backup_restore      = get_option( 'contractor_theme_options_advance_backup_restore' );
	$current_backup_data = ( array ) json_decode( $backup_restore );
	$validate_data       = '0';
	$notice              = '';
	$backup_data         = explode( '|',$data_backup );
	$data_import         = array();
	// Validate Struct 
	if ( count( $backup_data ) != 4 ) {
		$validate_data = 0;
		$notice = __( 'Data Struct False', 'contractor' );
	} else {
		// Validate check exitst type
		foreach ( $of_options as $of ) {
			if ( isset( $of['id'] ) && $of['id'] == $backup_data[0] ) {
				$validate_data = '1';
			};
		}
		if ( $validate_data == '0' ) {
			$notice = __( 'Sorry, This Backup False! Not found name of advance on db', 'contractor' );
		} else {
			// Check isset in database
			foreach ( $current_backup_data as $da ) {
				if ( $da->backup_id == $backup_data[1] ) {
					$validate_data = '1';
					$notice        = __( 'This backup really exists!! It will move to top of list backup, and restore data for you!', 'contractor' );
				}
			}
		}
		
	}
	// Check jsonstring of DATA
	if ( $data_import = json_decode(  base64_decode( $backup_data[3], true ) ) ) {
		if ( $backup_type == 'save_to_back_up_list' ) {
			/* Save to backup list */
			$backup_id               = $backup_data[0];
			$add_data['advance_id']  = $backup_id;
			$add_data['backup_id']   = $backup_id . '_' . time();
			$backup_name             = $backup_data[2];
			$add_data['backup_name'] = $backup_name;
			$add_data['time']        = date('D M j G:i Y');
			$backup_data             = $backup_data[3];
			$add_data['data']        = $backup_data;
			array_push( $current_backup_data, $add_data );
			update_option( 'contractor_theme_options_advance_backup_restore', json_encode( $current_backup_data ) );
			$notice = __( 'Added To Backup List', 'contractor' );


		} else if ( $backup_type == 'restore' ) {
			/* Restore */
			global $smof_data, $options_machine, $of_options;
			$backup_id = $backup_data[0];
			$id        = $backup_data[1];
			$data      = $backup_data[3];
			$restore   =  json_decode( base64_decode( $data ) );
			foreach ( $restore as $rk=>$aid ) {
				foreach ( $smof_data as $k=>$v ) {
					if ( $k == $rk && $k != '0' ) {
						if ( $smof_data[$k] != $aid ) { 
							set_theme_mod( $k, $aid );
						} else if ( is_array( $v ) ) {
							foreach ( $aid as $key=>$val ) {
								if ( $key != $k && $v[$key] == $val ) {
									set_theme_mod( $k, $aid );
									break;
								}
							}
						}			
					}
				}
			}
			$notice = __( 'Restored!', 'contractor' );

		} else if ( $backup_type == 'restore_and_save_to_backup_list' ) {
			global $smof_data, $options_machine, $of_options;
			/* Restore And Save To Backup List */
			/* Save to backup list */
			$backup_id               = $backup_data[0];
			$add_data['advance_id']  = $backup_id;
			$add_data['backup_id']   = $backup_id . '_' . time();
			$backup_name             = $backup_data[2];
			$add_data['backup_name'] = $backup_name;
			$add_data['time']        = date( 'D M j G:i Y' );
			$backup_data             = $backup_data[3];
			$add_data['data']        = $backup_data;
			array_push( $current_backup_data, $add_data );
			update_option( 'contractor_theme_options_advance_backup_restore', json_encode( $current_backup_data ) );
			$notice = __( 'Added To Backup List!', 'contractor' );


			/* Restore */
			$backup_id = $backup_data[0];
			$id        = $backup_data[1];
			$data      = $backup_data[3];
			$restore   =  json_decode( base64_decode( $data ) );
			foreach ( $restore as $rk=>$aid ) {
				foreach ( $smof_data as $k=>$v ) {
					if( $k == $rk && $k != '0' ) {
						if ( $smof_data[$k] != $aid ) { 
							set_theme_mod( $k, $aid );
						} else if ( is_array( $v ) ) {
							foreach ( $aid as $key=>$val ) {
								if ( $key != $k && $v[$key] == $val ) {
									set_theme_mod( $k, $aid );
									break;
								}
							}
						}			
					}
				}
			}
			$notice = __( 'Restored!', 'contractor' );
		}
		
	} else {
		// not valid
		$notice = __( 'We can\'t Read Data backup. Have an other change for backup file!', 'contractor' );
	}
	
	print_r( $notice );

	die();
}
add_action( 'wp_ajax_k2t_backup_from_file', 'k2t_backup_from_file' );
add_action( 'wp_ajax_nopriv_k2t_backup_from_file', 'k2t_backup_from_file' );

/**
 * Save a backup.
 *
 * @since  1.0
 * @return void
 */
function k2t_save_advance_option(){
	header('Content-type: text/plain');
	header('Content-disposition: attachment; filename="data.txt"');
}
add_action( 'wp_ajax_k2t_save_advance_option', 'k2t_save_advance_option' );
add_action( 'wp_ajax_nopriv_k2t_save_advance_option', 'k2t_save_advance_option' );
