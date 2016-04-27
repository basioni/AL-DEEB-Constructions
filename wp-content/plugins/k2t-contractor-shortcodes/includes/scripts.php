<?php
/**
 * Enqueue Script and Css.
 *
 * @since  1.0
 * @author K2T Team
 * @link   http://www.kingkongthemes.com
 */

if ( ! function_exists ( 'k2t_shortcodes_fontend_scripts' ) ) :
	function k2t_shortcodes_fontend_scripts() {
		if ( ! is_admin() ) {
			wp_register_script( 'k2t-google-map', 'http://maps.google.com/maps/api/js?sensor=false' );
			wp_register_script( 'k2t-swiper', plugin_dir_url( __FILE__ ) . 'assets/js/idangerous.swiper.js', array( 'jquery' ), '2.1', true );
			wp_register_script( 'k2t-swiper-slider', plugin_dir_url( __FILE__ ) . 'assets/js/swiper-slider.js', array(), '', true );
			wp_register_script( 'k2t-slider', plugin_dir_url( __FILE__ ) . 'assets/js/k2t-slider.js', array(), '', true );
			wp_register_script( 'jquery-flexslider', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.flexslider-min.js', array( 'jquery' ), '2.1', true );
			wp_register_script( 'k2t-tooltipster', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.tooltipster.min.js', array( 'jquery' ), '3.2.6', true );
			wp_register_script( 'k2t-easy-pie-chart', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.easy-pie-chart.js', array( 'jquery' ), '1.6.3', true );
			wp_register_script( 'k2t-collapse', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.collapse.js', array( 'jquery' ), '1.0', true );
			wp_register_script( 'k2t-tabslet', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.tabslet.min.js', array( 'jquery' ), '1.4.2', true );
			wp_register_script( 'k2t-countTo', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.countTo.js', array( 'jquery' ), '1.0', true );
			wp_register_script( 'k2t-inview', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.inview.min.js', array( 'jquery' ), '1.0', true );
			wp_register_script( 'k2t-countdown', plugin_dir_url( __FILE__ ) . 'assets/js/countdown.min.js', array( 'jquery' ), '1.0', true );
			wp_register_script( 'k2t-stickyMojo', plugin_dir_url( __FILE__ ) . 'assets/js/stickyMojo.js', array( 'jquery' ), '1.0', true );
			wp_register_script( 'k2t-fittext', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.fittext.js', array( 'jquery' ), '1.2', true);
			wp_register_script( 'k2t-parallax', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.parallax.min.js', array(), '', true);
			wp_register_script( 'k2t-tipsy', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.tipsy.min.js', array(), '', true);
			wp_register_script( 'k2t-tubular', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.tubular.1.0.js', array(), '', true);
			wp_register_script( 'k2t-owlcarousel', plugin_dir_url( __FILE__ ) . 'assets/js/owl.carousel.min.js', array(), '', true);
			wp_enqueue_script( 'magnific-popup', plugin_dir_url( __FILE__ ) . 'assets/js/magnific-popup.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'k2t-shortcodes', plugin_dir_url( __FILE__ ) . 'assets/js/shortcodes.js', array( 'jquery' ), '1.0', true );
			wp_register_style( 'k2t-swiper', plugin_dir_url( __FILE__ ) . 'assets/css/idangerous.swiper.css' );
			wp_register_style( 'flexslider', plugin_dir_url( __FILE__ ) . 'assets/css/flexslider.css' );
			wp_enqueue_style( 'k2t-fontawesome', plugin_dir_url( __FILE__ ) . 'assets/css/font-awesome.min.css' );
			wp_enqueue_style( 'k2t-animate', plugin_dir_url( __FILE__ ) . 'assets/css/animate.min.css' );
			wp_enqueue_style( 'magnific-popup', plugin_dir_url( __FILE__ ). 'assets/css/magnific-popup.css' );
			wp_enqueue_style( 'k2t-plugin-shortcodes', plugin_dir_url( __FILE__ ) . 'assets/css/shortcodes.css' ); //Include Shortcode CSS File
			wp_enqueue_style( 'k2t-plugin-shortcodes-responsive', plugin_dir_url( __FILE__ ) . 'assets/css/responsive.css' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'k2t_shortcodes_fontend_scripts' );
endif;

//Enqueue Script and Css in Backend
if ( ! function_exists ( 'k2t_shortcodes_backend_scripts' ) ) :
	function k2t_shortcodes_backend_scripts() {
		wp_enqueue_style( 'k2t-fontawesome-backend', plugin_dir_url( __FILE__ ) . 'assets/css/font-awesome.min.css' );
		wp_enqueue_style( 'k2t-shortcode-backend', plugin_dir_url( __FILE__ ) . 'assets/css/k2t-backend.css' );
	}
	add_action( 'admin_enqueue_scripts', 'k2t_shortcodes_backend_scripts' );
endif;