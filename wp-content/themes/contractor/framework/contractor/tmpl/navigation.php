<?php
/**
 * The template display blog navigation.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

global $wp_query, $wp_rewrite, $smof_data;

$nav_query = $nav = '';

// Prepare variables
$query        = $nav_query ? $nav_query : $wp_query;
$max          = $query->max_num_pages;
$current_page = max( 1, get_query_var( 'paged' ) );
$big          = 99999;

// Get type of page navigation if necessary
if ( ! $nav ) {
	$nav = $smof_data['pagination-type'];
}
if ( $max > 1 ) :

	if ( 'pagination_ajax' == $nav ) :

		if ( ! is_singular() ) {
			wp_enqueue_script( 'infinitescroll-script' );
			wp_enqueue_script( 'jquery-imageloaded-script' );
			echo '<scr' . 'ipt>'; ?>
				
				(function($) {
					"use strict";

					$(document).ready(function() {

						function timeline_indicator() {
							var post = $( ".b-timeline" ).find( ".hentry" );
							$.each( post, function( i,obj ) {           
								var posLeft = $( obj ).css( "left" );
								if( posLeft == "0px" ) {
									$(obj).addClass( "post-left" );
								} else {
									$(obj).addClass( "post-right" );
								}
							});
						}

						var $container = $( '.k2t-blog' );
						if ( $container.find('.k2t-blog-timeline') ) {
							var $container = $( ".k2t-blog-timeline" );
						}
						
						$container.imagesLoaded(function(){
							$container.masonry({
								itemSelector: '.hentry'
							});
						});
						$container.infinitescroll(
							{
								navSelector: '.nav-seemore', // selector for the paged navigation
								nextSelector: '.nav-seemore a', // selector for the NEXT link (to page 2)
								itemSelector: '.hentry', // selector for all items you'll retrieve
								loading: {
									finishedMsg: 'No more pages to load.',
									img: 'http://i.imgur.com/qkKy8.gif'
								}
							},
							function( newElements ) {
								// hide new items while they are loading
								var $newElems = $( newElements ).css({ opacity: 0 });
								// ensure that images load before adding to masonry layout
								$newElems.imagesLoaded(function(){
									// show elems now they're ready
									$newElems.animate({ opacity: 1 });
									$container.masonry( 'appended', $newElems, true );


									timeline_indicator();
								}); 
							}
						);
					});
				})(jQuery);

			<?php
			echo '</scr' . 'ipt>';
		}
		?>
		<div class="nav-seemore">
			<div class="nav-seemore-inner">
				<?php echo next_posts_link( __( 'Load More', 'contractor' ) ); ?>
			</div>
		</div>
	<?php else : ?>
		<div class="k2t-navigation">
			<?php
			echo '' . paginate_links(
				array(
					'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'    => '?paged=%#%',
					'current'   => $current_page,
					'total'     => $max,
					'type'      => 'list',
					'prev_text' => __( 'Prev', 'contractor' ),
					'next_text' => __( 'Next', 'contractor' )
				)
			) . ' ';
			?>
		</div>
	<?php
	endif;

endif;
