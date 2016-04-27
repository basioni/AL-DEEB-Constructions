<?php
/**
 * Enqueue stylesheet.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link    http://www.kingkongthemes.com
 */

/*--------------------------------------------------------------
	Custom CSS
--------------------------------------------------------------*/
if ( ! function_exists( 'k2t_front_end_enqueue_inline_css' ) ) {
	function k2t_front_end_enqueue_inline_css() {
		global $smof_data, $content_width; ?>
		<style>
			
			<?php
			/* Content width
			------------------------------------------------- */
			if ( ! empty( $smof_data['boxed-layout'] ) ) {
				echo '
					.boxed .k2t-container { max-width: ' . $smof_data['use-content-width'] . 'px; }
				';
			} else {
				if ( isset ( $smof_data['use-content-width'] ) ) {
					echo '
						.k2t-wrap { max-width: ' . $smof_data['use-content-width'] . 'px; }
					';
				}
			}
			

			/* Sidebar width
			------------------------------------------------- */
			$sidebar_width = $smof_data['sidebar_width'];
			$page_sidebar_width = ( function_exists( 'get_field' ) ) ? get_field( 'page_sidebar_width', get_the_ID() ) : '';
			$page_sidebar_width = empty( $page_sidebar_width ) ? '' : $page_sidebar_width;
			if ( is_page() && ! empty( $page_sidebar_width ) ) {
				if ( ! empty( $page_sidebar_width ) ) {
					echo '
						.k2t-blog, .k2t-main { width:' . ( 100 - $page_sidebar_width ) . '% !important; }
					';
				}
			} else {
				if ( ! empty( $sidebar_width ) ) {
					echo '
						.k2t-blog, .k2t-main {width:' . ( 100 - $sidebar_width ) . '% !important; }
					';
				}
			}

			/* Logo margin
			------------------------------------------------- */
			if ( isset ( $smof_data['logo-margin-top'] ) || isset ( $smof_data['logo-margin-left'] ) || isset ( $smof_data['logo-margin-right'] ) || isset ( $smof_data['logo-margin-bottom'] ) ) {
				echo '
					.k2t-logo { margin-top: ' . $smof_data['logo-margin-top'] . 'px;margin-left: ' . $smof_data['logo-margin-left'] . 'px;margin-right: ' . $smof_data['logo-margin-right'] . 'px;margin-bottom: ' . $smof_data['logo-margin-bottom'] . 'px; }
				';
			}

			/* Global color scheme
			------------------------------------------------- */
			if ( $smof_data['heading-color'] || $smof_data['heading-font'] ) {
				echo '
					h1, h2, h3, h4, h5, h6 { color: ' . $smof_data['heading-color'] . '; font-family: ' . $smof_data['heading-font'] . '; }
					.k2t-page-topnav ul.menu > li > a { font-family: ' . $smof_data['heading-font'] . '; }
				';
			}
			if ( $smof_data['text-color'] ) {
				echo '
					body, button, input, select, textarea { color: ' . $smof_data['text-color'] . '; }
				';
			}
			if ( $smof_data['footer-bg-color'] || $smof_data['footer-color'] ) {
				echo '
					.k2t-footer { background-color: ' . $smof_data['footer-bg-color'] . ';color: ' . $smof_data['footer-color'] . '; }
					.k2t-footer .widget { color: ' . $smof_data['footer-color'] . '; }
				';
			}
			if ( $smof_data['footer-link-color'] ) {
				echo '
					.k2t-footer a { color: ' . $smof_data['footer-link-color'] . '; }
				';
			}

			if ( $smof_data['link-color'] ) {
				echo '
					a { color: ' . $smof_data['link-color'] . '; }
				';
			}
			if ( $smof_data['link-hover-color'] ) {
				echo '
					a:hover { color: ' . $smof_data['link-hover-color'] . '; }
				';
			}

			if ( $smof_data['main-menu-color'] ) {
				echo '
					.k2t-header-mid .k2t-menu li a { color: ' . $smof_data['main-menu-color'] . '; }
				';
			}
			if ( $smof_data['sub-menu-color'] ) {
				echo '
					.k2t-header-mid .k2t-menu ul li a { color: ' . $smof_data['sub-menu-color'] . '; }
				';
			}
			
			/* Typography
			------------------------------------------------- */
			if ( $smof_data['body-font'] || $smof_data['body-size'] ) {
				echo '
					body { font-family: ' . $smof_data['body-font'] . '; font-size: ' . $smof_data['body-size'] . 'px; }
				';
			}
			if ( $smof_data['mainnav-font'] || $smof_data['mainnav-size'] ) {
				echo '
					.k2t-header-mid .k2t-menu, .k2t-header .k2t-menu .mega-container ul { font-family: ' . $smof_data['mainnav-font'] . '; font-size: ' . $smof_data['mainnav-size'] . 'px; }
				';
			}
			if ( $smof_data['mainnav-text-transform'] ) {
				echo '
					.k2t-header-mid .k2t-menu > li > a { text-transform: ' . $smof_data['mainnav-text-transform'] . '; }
				';
			}
			if ( $smof_data['mainnav-font-weight'] ) {
				echo '
					.k2t-header-mid .k2t-menu > li > a { font-weight: ' . $smof_data['mainnav-font-weight'] . '; }
				';
			}
			if ( $smof_data['h1-size'] || $smof_data['h2-size'] || $smof_data['h3-size'] || $smof_data['h4-size'] || $smof_data['h5-size'] || $smof_data['h6-size'] ) {
				echo '
					h1 { font-size: ' . $smof_data['h1-size'] . 'px; }
					h2 { font-size: ' . $smof_data['h2-size'] . 'px; }
					h3 { font-size: ' . $smof_data['h3-size'] . 'px; }
					h4 { font-size: ' . $smof_data['h4-size'] . 'px; }
					h5 { font-size: ' . $smof_data['h5-size'] . 'px; }
					h6 { font-size: ' . $smof_data['h6-size'] . 'px; }
				';
			}
			if ( $smof_data['submenu-mainnav-size'] ) {
				echo '
					.k2t-header-mid .k2t-menu .sub-menu { font-size: ' . $smof_data['submenu-mainnav-size'] . 'px; }
				';
			}
			
			if ( function_exists( 'get_field' ) ) :
				/* Title bar style
				------------------------------------------------- */
				// Get post or page id
				if ( is_home() ) {
					$id = get_option( 'page_for_posts' );
				} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
					$id = get_option( 'woocommerce_shop_page_id' );
				} else {
					$id = get_the_ID();
				}
				if ( is_single() && $smof_data['single-titlebar-overlay-opacity'] ) {
					echo '
						.k2t-title-bar .mask.colors { opacity: ' . $smof_data['single-titlebar-overlay-opacity'] / 10 . '; }
					';
				} elseif ( get_field( 'titlebar_overlay_opacity', $id ) ) {
					echo '
						.k2t-title-bar .mask.colors { opacity: ' . get_field( 'titlebar_overlay_opacity', $id ) . '; }
					';
				}
				if ( is_single() && $smof_data['single-titlebar-shadow-opacity'] ) {
					echo '
						.k2t-title-bar.shadow:after { opacity: ' . $smof_data['single-titlebar-shadow-opacity'] / 10 . '; }
					';
					
				} elseif ( ! get_field( 'titlebar_shadow_opacity', $id ) ) {
					echo '
						.k2t-title-bar.shadow:after { opacity: ' . get_field( 'titlebar_shadow_opacity', $id ) . '; }
					';
				}
				if ( is_single() && $smof_data['single-titlebar-clipmask-opacity'] ) {
					echo '
						.k2t-title-bar .mask.pattern { opacity: ' . $smof_data['single-titlebar-clipmask-opacity'] / 10 . '; }
					';
					
				} elseif ( get_field( 'titlebar_clipmask_opacity', $id ) ) {
					echo '
						.k2t-title-bar .mask.pattern { opacity: ' . get_field( 'titlebar_clipmask_opacity', $id ) . '; }
					';
				}
				if ( get_field( 'background_parallax', $id ) ) {
					echo '
						.k2t-title-bar.parallax { background-size: cover; background-attachment: fixed; }
					';
				}

				/* Page layout
				------------------------------------------------- */
				if ( get_field( 'page_background_color', get_the_ID() ) ) {
					echo '
						body { background-color: ' . get_field( 'page_background_color', get_the_ID() ) . '; }
					';
				}
				if ( get_field( 'page_content_padding_top', get_the_ID() ) || get_field( 'page_content_padding_bottom', get_the_ID() ) ) {
					echo '
						.k2t-content { padding-top: ' . get_field( 'page_content_padding_top', get_the_ID() ) . '; padding-bottom: ' . get_field( 'page_content_padding_bottom', get_the_ID() ) . '; }
					';
				}
			endif;

			if ( $smof_data['404-image'] ) {
				echo '
					.k2t-error-404 { background: url(' . esc_url( $smof_data['404-image'] ) . ') no-repeat center top;}
				';
			}
		
			/* Custom CSS
			------------------------------------------------- */
			if ( isset ( $smof_data['custom_css'] ) ) {
				$custom_css = $smof_data['custom_css'];
				echo $custom_css;
			}

			/* Canvas sidebar
			------------------------------------------------- */
			$offcanvas_style = '';
			if ( $smof_data['offcanvas-turnon'] ) :

				$offcanvas_style .= '.offcanvas-sidebar {';
				if ( isset( $smof_data['offcanvas-sidebar-background-image'] ) && $smof_data['offcanvas-sidebar-background-image'] ) {
					$offcanvans_sidebar_background_image = $smof_data['offcanvas-sidebar-background-image'];
				}
				if ( ! empty( $offcanvans_sidebar_background_image ) ) {
					$offcanvas_style .= 'background-image: url(' . esc_url( $offcanvans_sidebar_background_image ) . ');';
				}

				if ( isset( $smof_data['offcanvas-sidebar-background-position'] ) && $smof_data['offcanvas-sidebar-background-position'] ) {
					$offcanvans_sidebar_background_position = $smof_data['offcanvas-sidebar-background-position'];
				}
				if ( ! empty( $offcanvans_sidebar_background_position ) ) {
					$offcanvas_style .= 'background-position: ' . $offcanvans_sidebar_background_position . ';';
				}

				if ( isset( $smof_data['offcanvas-sidebar-background-repeat'] ) && $smof_data['offcanvas-sidebar-background-repeat'] ) {
					$offcanvans_sidebar_background_repeat = $smof_data['offcanvas-sidebar-background-repeat'];
				}
				if ( ! empty( $offcanvans_sidebar_background_repeat ) ) {
					$offcanvas_style .= 'background-repeat: ' . $offcanvans_sidebar_background_repeat . ';';
				}

				if ( isset( $smof_data['offcanvas-sidebar-background-size'] ) && $smof_data['offcanvas-sidebar-background-size'] ) {
					$offcanvans_sidebar_background_size = $smof_data['offcanvas-sidebar-background-size'];
				}
				if ( ! empty( $offcanvans_sidebar_background_size ) ) {
					$offcanvas_style .= 'background-size: ' . $offcanvans_sidebar_background_size . ';';
				}

				if ( isset( $smof_data['offcanvas-sidebar-background-color'] ) && $smof_data['offcanvas-sidebar-background-color'] ) {
					$offcanvans_sidebar_background_color = $smof_data['offcanvas-sidebar-background-color'];
				}
				if ( ! empty( $offcanvans_sidebar_background_color ) ) {
					$offcanvas_style .= 'background-color: ' . $offcanvans_sidebar_background_color . ';';
				}
				$offcanvas_style .= '}';

				$offcanvans_sidebar_text_color = $smof_data['offcanvas-sidebar-text-color']; 
				if ( ! empty( $offcanvans_sidebar_text_color ) ) {
					$offcanvas_style .= '
					.offcanvas-sidebar * {
						color: ' . $offcanvans_sidebar_text_color . ' !important;
					}';
				}

				$offcanvas_sidebar_custom_css = $smof_data['offcanvas-sidebar-custom-css'];
				if ( ! empty( $offcanvas_sidebar_custom_css ) ) {
					$offcanvas_style .= $offcanvas_sidebar_custom_css;
				}
				echo $offcanvas_style;
				
			endif;

			?>

			/* Primary color
			------------------------------------------------- */
			a,
			.k2t-header-top a,
			.k2t-header-top .k2t-menu li a:hover,
			.k2t-header-mid .k2t-menu li > a:hover,
			.k2t-header-mid .k2t-menu li.active > a,
			.k2t-header-bot .k2t-menu li > a:hover,
			.k2t-header-bot .k2t-menu li.active > a,
			.k2t-header-mid .k2t-menu li > a.current,
			.k2t-header-mid .search-box:hover,
			.k2t-header-mid .social li a:hover,
			.k2t-breadcrumbs li.current,
			.posted-on,
			.post-comment a,
			.post-cat a,
			.more-link,
			.k2t-navigation ul li a:hover,
			.b-masonry .k2t-blog .hentry .entry-title a:hover,
			.author-social ul li a:hover,
			.tags-links a:hover,
			.single-nav a:hover,
			.k2t-error-404 h1,
			.k2t-error-404 .page-content p a,
			.widget a:hover,
			.widget ul li.current-cat a,
			.widget .posts-list .post-item h4 a:hover,
			.owl-theme .owl-controls .owl-buttons div:hover,
			.woocommerce .k2t-breadcrumbs li.current a:hover,
			.woocommerce-page .k2t-breadcrumbs li.current a:hover,
			.shop-cart .cart-control i,
			.shop-cart .shop-item ul.product_list_widget li a:hover,
			.woocommerce li.product .p-mask:hover .p-info > *:not(.clear):hover,
			.woocommerce-page li.product .p-mask:hover .p-info > *:not(.clear):hover,
			.woocommerce li.product .p-info .yith-wcwl-add-to-wishlist:hover > .show a,
			.woocommerce-page li.product .p-info .yith-wcwl-add-to-wishlist:hover > .show a,
			.woocommerce li.product .p-title a:hover,
			.woocommerce-page li.product .p-title a:hover,
			.woocommerce ul.products li.product .price,
			.woocommerce-page ul.products li.product .price,
			.woocommerce #content div.product p.price,
			.woocommerce #content div.product span.price,
			.woocommerce div.product p.price,
			.woocommerce div.product span.price,
			.woocommerce-page #content div.product p.price,
			.woocommerce-page #content div.product span.price,
			.woocommerce-page div.product p.price,
			.woocommerce-page div.product span.price,
			.summary .product_meta a:hover,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a,
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
			.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a,
			.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a {
				color: <?php echo $smof_data['primary-color'] ?>;
			}
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.k2t-header-mid .k2t-menu > li.children > a:hover:before,
			.k2t-header-mid .k2t-menu > li.children > a:hover:after,
			.k2t-header-bot .k2t-menu > li.children > a:hover:before,
			.k2t-header-bot .k2t-menu > li.children > a:hover:after,
			.k2t-header-bot .social li a:hover,
			.k2t-navigation ul li .current,
			.comments-area .comment-form .form-submit input:hover,
			.action-link a:hover,
			.k2t-btt:hover,
			.wpcf7 input[type="submit"]:hover,
			.open-sidebar:hover .inner:before,
			.open-sidebar:hover .inner:after,
			.m-trigger:hover span:before,
			.m-trigger:hover span:after,
			.shop-cart .shop-item .buttons .button:hover,
			.woocommerce .product .p-mask,
			.woocommerce-page .product .p-mask,
			.woocommerce #content nav.woocommerce-pagination ul li a:focus,
			.woocommerce #content nav.woocommerce-pagination ul li a:hover,
			.woocommerce #content nav.woocommerce-pagination ul li span.current,
			.woocommerce nav.woocommerce-pagination ul li a:focus,
			.woocommerce nav.woocommerce-pagination ul li a:hover,
			.woocommerce nav.woocommerce-pagination ul li span.current,
			.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
			.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
			.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
			.woocommerce-page nav.woocommerce-pagination ul li a:focus,
			.woocommerce-page nav.woocommerce-pagination ul li a:hover,
			.woocommerce-page nav.woocommerce-pagination ul li span.current,
			.woocommerce #content input.button:hover,
			.woocommerce #respond input#submit:hover,
			.woocommerce a.button:hover,
			.woocommerce button.button:hover,
			.woocommerce input.button:hover,
			.woocommerce-page #content input.button:hover,
			.woocommerce-page #respond input#submit:hover,
			.woocommerce-page a.button:hover,
			.woocommerce-page button.button:hover,
			.woocommerce-page input.button:hover,
			.woocommerce #content div.product form.cart .button:hover,
			.woocommerce div.product form.cart .button:hover,
			.woocommerce-page #content div.product form.cart .button:hover,
			.woocommerce-page div.product form.cart .button:hover,
			.woocommerce #content input.button.alt:hover,
			.woocommerce #respond input#submit.alt:hover,
			.woocommerce a.button.alt:hover,
			.woocommerce button.button.alt:hover,
			.woocommerce input.button.alt:hover,
			.woocommerce-page #content input.button.alt:hover,
			.woocommerce-page #respond input#submit.alt:hover,
			.woocommerce-page a.button.alt:hover,
			.woocommerce-page button.button.alt:hover,
			.woocommerce-page input.button.alt:hover,
			.woocommerce .widget_price_filter .price_slider_wrapper .ui-slider-range,
			.woocommerce .widget_price_filter .price_slider_wrapper .price_slider_amount .button:hover,
			.woocommerce .widget_layered_nav ul li.chosen a,
			.woocommerce-page .widget_layered_nav ul li.chosen a,
			.summary .yith-wcwl-add-to-wishlist .add_to_wishlist:hover,
			.product-tab.wpb_tabs .wpb_tabs_nav li.ui-state-active a {
				background: <?php echo $smof_data['primary-color'] ?>;
			}
			.k2t-navigation ul li .current,
			.owl-theme .owl-controls .owl-page.active span,
			.owl-theme .owl-controls.clickable .owl-page:hover span,
			.pagi-style-2.owl-theme .owl-controls .owl-page.active span,
			.pagi-style-2.owl-theme .owl-controls.clickable .owl-page:hover span,
			.woocommerce #content nav.woocommerce-pagination ul li a:focus,
			.woocommerce #content nav.woocommerce-pagination ul li a:hover,
			.woocommerce #content nav.woocommerce-pagination ul li span.current,
			.woocommerce nav.woocommerce-pagination ul li a:focus,
			.woocommerce nav.woocommerce-pagination ul li a:hover,
			.woocommerce nav.woocommerce-pagination ul li span.current,
			.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
			.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
			.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
			.woocommerce-page nav.woocommerce-pagination ul li a:focus,
			.woocommerce-page nav.woocommerce-pagination ul li a:hover,
			.woocommerce-page nav.woocommerce-pagination ul li span.current,
			.woocommerce .widget_price_filter .price_slider_wrapper .ui-state-default,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
			.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
			.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,
			.product-tab.wpb_tabs .wpb_tabs_nav li.ui-state-active a:after {
				border-color: <?php echo $smof_data['primary-color'] ?>
			}

		</style>	
	<?php }
	add_action( 'wp_head','k2t_front_end_enqueue_inline_css' );
}

/*--------------------------------------------------------------
	Enqueue google fonts
--------------------------------------------------------------*/
if ( ! function_exists( 'k2t_enqueue_google_fonts' ) ) {
	function k2t_enqueue_google_fonts() {
		global $wp_styles, $smof_data;
		
		$protocol = is_ssl() ? 'https' : 'http';
		if ( isset ( $smof_data['body-font'] ) && in_array ( $smof_data['body-font'], k2t_google_fonts() ) ) {
			$body_font = $smof_data['body-font'];
			wp_enqueue_style( 'k2t-google-font-' . str_replace( ' ','-',$body_font ), "$protocol://fonts.googleapis.com/css?family=" . str_replace(' ','+', $body_font ) . ":100,200,300,400,500,600,700,800,900&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese" );
		}
		
		if ( isset ( $smof_data['heading-font'] ) && in_array ( $smof_data['heading-font'], k2t_google_fonts() ) ) {
			$heading_font = $smof_data['heading-font'];		
			wp_enqueue_style( 'k2t-google-font-' . str_replace( ' ','-',$heading_font ), "$protocol://fonts.googleapis.com/css?family=" . str_replace(' ','+', $heading_font ) . ":100,200,300,400,500,600,700,800,900&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese" );
		}
		
		if ( isset ( $smof_data['mainnav-font'] ) && in_array ( $smof_data['mainnav-font'], k2t_google_fonts() ) ) {
			$mainnav_font = $smof_data['mainnav-font'];		
			wp_enqueue_style( 'k2t-google-font-' . str_replace( ' ','-',$mainnav_font ), "$protocol://fonts.googleapis.com/css?family=" . str_replace(' ','+', $mainnav_font ) . ":100,200,300,400,500,600,700,800,900&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese" );
		}
	}
	add_action( 'wp_enqueue_scripts', 'k2t_enqueue_google_fonts' );
}