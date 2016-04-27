<?php
/**
 * Themes functions config woocommerce.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link http://www.kingkongthemes.com
 */

// Don't duplicate me!
if ( ! class_exists( 'k2t_template_woo' ) ) {

	/**
	 * Class to apply woocommerce templates
	 *
	 * @since 4.0.0
	 */
	class k2t_template_woo {

		/**
		 * Constructor.
		 * @return  void
		 * @since   1.0
		 */
		function __construct() {
			global $smof_data;

			// Add action
			add_action( 'widgets_init', array( $this, 'k2t_woocommerce_widgets_init' ) );
			add_action( 'wp_enqueue_scripts',  array( $this, 'k2t_woocommerce_enqueue_style' ) );
			add_action( 'after_setup_theme', array( $this, 'k2t_woocommerce_image_dimensions' ), 1 );

			// Add filters
			add_filter( 'add_to_cart_fragments', array( $this, 'k2t_add_to_cart_fragment' ) );
			add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $smof_data['shop-products-per-page'] . ';' ), 20 );

			// Change the default with theme functions
			add_action( 'woocommerce_before_shop_loop_item', array( $this, 'k2t_woocommerce_before_shop_loop_item' ) );
			add_action( 'woocommerce_after_shop_loop_item',  array( $this, 'k2t_woocommerce_after_shop_loop_item' ) ); 
			add_action( 'woocommerce_before_shop_loop_item_title',  array( $this, 'k2t_woocommerce_before_shop_loop_item_title' ) );
			add_action( 'woocommerce_after_shop_loop_item_title',  array( $this, 'k2t_woocommerce_after_shop_loop_item_title' ) );
			add_action( 'woocommerce_single_product_summary',  array( $this, 'k2t_woocommerce_before_price' ), 5 );
			add_action( 'woocommerce_single_product_summary',  array( $this, 'k2t_woocommerce_after_rate' ), 10 );
			add_action( 'woocommerce_single_product_summary',  array( $this, 'k2t_woocommerce_before_product_meta' ), 35 );
			add_action( 'woocommerce_single_product_summary',  array( $this, 'k2t_woocommerce_after_product_meta' ), 45 );
			add_action( 'woocommerce_after_single_product_summary',  array( $this, 'k2t_woocommerce_show_or_hide_related_product' ) );

			// Action order product item
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 9 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 15 );

			/**
			 * Setting theme options for display results count
			 *
			 * @since 1.0
			 */
			if ( ! $smof_data['shop-display-result-count'] ) {
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			}
			/**
			 * Setting theme options for display ordering
			 *
			 * @since 1.0
			 */
			if ( ! $smof_data['shop-display-sorting'] ) {
				remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			}
		}
		/**
		 * Register widget.
		 *
		 * @since 1.0
		 */
		public static function k2t_woocommerce_widgets_init() {
			register_sidebar( array(
				'name'          => __( 'Shop Sidebar', 'contractor' ),
				'id'            => 'shop_sidebar',
				'description'   => __( 'This sidebar is used for WooCommerce Plugin, on shop pages.', 'contractor' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			) );
		}
		/**
		 * Enqueue style.
		 *
		 * @since 1.0
		 */
		public static function k2t_woocommerce_enqueue_style() {
			// Load woocommerce style.
			wp_enqueue_style( 'wcm-style', CONTRACTOR_TEMPLATE_URL . '/assets/css/woocommerce.css' );
		}

		/**
		 * Change html structure to before shop item
		 *
		 * @since 1.0
		 */
		public static function k2t_woocommerce_before_shop_loop_item() {
			echo '<div class="p-item"><div class="p-inner">';
		}

		/**
		 * Change html structure to after shop item
		 *
		 * @since 1.0
		 */
		public static function k2t_woocommerce_after_shop_loop_item() {
			global $product;
			echo '</div></div>';
			echo '<h3 class="p-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h3>';
		}

		/**
		 * Change html structure to before item action
		 *
		 * @since 1.0
		 */
		public static function k2t_woocommerce_before_shop_loop_item_title() {
			echo '<div class="p-mask"><div class="p-info">';
		}

		/**
		 * Change html structure to after item action
		 *
		 * @since 1.0
		 */
		public static function k2t_woocommerce_after_shop_loop_item_title() {
			$image = wp_get_attachment_url( get_post_thumbnail_id() );

			echo '<a class="p-quickview k2t-popup-link" href="' . esc_url( $image ) . '">' . __( '<i class="fa fa-search"></i> Quick view', 'contractor' ) . '</a>';
			if ( class_exists( 'YITH_WCWL_UI' ) ) :
				echo k2t_template_woo::k2t_wishlist_button();
			endif;
			echo '</div>';
			woocommerce_get_template( 'loop/rating.php' );
			echo '</div>';
		}

		/**
		 * Change html structure to price and rating on single product
		 *
		 * @since 1.0
		 */
		public static function k2t_woocommerce_before_price() {
			echo '<div class="p-rate-price">';
		}
		public static function k2t_woocommerce_after_rate() {
			echo '</div>';
		}
		public static function k2t_woocommerce_before_product_meta() {
			echo '<div class="p-meta-share">';
		}
		public static function k2t_woocommerce_after_product_meta() {
			global $smof_data;
			if ( $smof_data['shop-single-display-share-products'] ) :
				echo k2t_social_share();
			endif;

			echo '</div>';
		}

		/**
		 * Show or hide related product
		 *
		 * @since 1.0
		 */
		public static function k2t_woocommerce_show_or_hide_related_product() {
			global $smof_data;
			if ( $smof_data['shop-single-display-related-products'] ) :
				woocommerce_output_related_products();
			endif;
		}

		/**
		 * Wishlist Button
		 *
		 * @return  array
		 * @since 	1.0
		 */
		public static function k2t_wishlist_button() {
			if ( class_exists( 'YITH_WCWL_UI' ) )  {
				echo do_shortcode('[yith_wcwl_add_to_wishlist]');
			}
		}

		/**
		 * Add shopcart menu to header
		 *
		 * @return  array
		 */
		public static function k2t_add_to_cart_fragment( $fragments ) {
			global $woocommerce;
			ob_start();
		?>
			<a class="cart-control" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'contractor' ); ?>">
				<i class="fa fa-shopping-cart"></i>
				<span class="item-number"><?php echo $woocommerce->cart->get_cart_contents_count(); ?></span>
				<?php echo sprintf( __( '<div>%s</div>', 'contractor' ), $woocommerce->cart->get_cart_total() ); ?>
			</a>
		<?php
			$fragments['a.cart-control'] = ob_get_clean();
			return $fragments;
		}
		public static function k2t_shoping_cart() {
			global $woocommerce;

			$cart_total = apply_filters( 'add_to_cart_fragments' , array() );

			echo '<div class="shop-cart">';
			echo $cart_total['a.cart-control'];
			echo '<div class="shop-item">';
			echo '<div class="widget_shopping_cart_content"></div>';
			echo '</div>';
			echo '</div>';
		}

		/**
		 * Set WooCommerce image dimensions upon theme activation
		 * @since 1.0
		 */
		public static function k2t_woocommerce_image_dimensions() {

			global $pagenow;
			if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
				return;
			}

			$catalog = array(
				'width'  => '306', // px
				'height' => '306', // px
				'crop'	 => 1
			);
			 
			$single = array(
				'width'  => '427', // px
				'height' => '546', // px
				'crop'	 => 1
			);
			$thumbnail = array(
				'width' 	=> '90', // px
				'height'	=> '90', // px
				'crop'		=> 1
			);
			 
			// Image sizes
			update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
			update_option( 'shop_single_image_size', $single ); // Single product image
			update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
		}

	}

}
new k2t_template_woo();