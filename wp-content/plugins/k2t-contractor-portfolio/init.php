<?php
/*
Plugin Name: K2T Contractor Portfolio
Plugin URI: http://www.kingkongthemes.com
Description: This is the plugin for setting up shortcodes on KingKongThemes's items
Version: 1.0
Author: KingKongThemes
Author URI: http://www.kingkongthemes.com
*/


add_action( 'wp_enqueue_scripts', 'k2t_enqueue_plugin' );
if ( !function_exists('k2t_enqueue_plugin') ) {
function k2t_enqueue_plugin(){

	/* Swiper
	---------------------- */
	wp_enqueue_style( 'idangerous-swiper', plugin_dir_url( __FILE__ ). 'includes/css/idangerous.swiper.css' );
	/* Magnific Popup
	---------------------- */
	wp_enqueue_style( 'magnific-popup', plugin_dir_url( __FILE__ ). 'includes/css/magnific-popup.css' );
	/* Expandable
	---------------------- */
	wp_enqueue_style( 'expandable', plugin_dir_url( __FILE__ ). 'includes/css/expandable.css' );
	/* Portfolio
	---------------------- */
	wp_enqueue_style( 'portfolio', plugin_dir_url( __FILE__ ) . 'includes/css/portfolio.css' );

	if( wp_script_is( 'jquery' ) ){
		wp_enqueue_script( 'jquery' );
	}

	/* Slider: swiper
	---------------------- */
	wp_enqueue_script( 'idangerous-swiper', plugin_dir_url( __FILE__ ). 'includes/js/idangerous.swiper.js', array( 'jquery' ), '1.0', true );
	//wp_enqueue_script( 'k2t-swiper-slider', plugin_dir_url( __FILE__ ) . 'includes/js/swiper-slider.js', array(), '', true );

	/* Jquery Library: Inview
	---------------------- */
	wp_enqueue_script( 'jquery-inview', plugin_dir_url( __FILE__ ). 'includes/js/jquery.inview.min.js', array( 'jquery' ), '1.0', true );
	/* Jquery Library: Isotope
	---------------------- */
	wp_enqueue_script( 'jquery-isotope', plugin_dir_url( __FILE__ ). 'includes/js/isotope.pkgd.min.js', array( 'jquery' ), '1.0', true );
	/* Jquery Library: Imagesloaded
	---------------------- */
	wp_enqueue_script( 'jquery-imagesloaded', plugin_dir_url( __FILE__ ). 'includes/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '3.1.6', true );
	/* Ajax load
	---------------------- */
	wp_enqueue_script( 'k2t-portfolio', plugin_dir_url( __FILE__ ). 'includes/js/portfolio.js', array( 'jquery' ), '1.0', true );
	/* StickyMojo Javascript
	---------------------- */
	wp_enqueue_script( 'stickyMojo', plugin_dir_url( __FILE__ ). 'includes/js/stickyMojo.js', array('jquery'), '1.0', true );
	/* Modernizr Javascript
	---------------------- */
	wp_enqueue_script( 'modernizr', plugin_dir_url( __FILE__ ). 'includes/js/modernizr.js', array('jquery'), '1.0', true );
	/* Expandable Javascript
	---------------------- */
	wp_enqueue_script( 'expandable', plugin_dir_url( __FILE__ ). 'includes/js/expandable.js', array('jquery'), '1.0', true );
	/* Ajax load
	---------------------- */
	wp_enqueue_script( 'k2t-ajax', plugin_dir_url( __FILE__ ). 'includes/js/ajax.js', array( 'jquery' ), '1.0', true );
	wp_localize_script('k2t-ajax', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
	/* Jquery Library: Inview
	---------------------- */
	wp_enqueue_script( 'magnific-popup', plugin_dir_url( __FILE__ ) . 'includes/js/magnific-popup.js', array( 'jquery' ), '1.0', true );
}
}

//Enqueue Script and Css in Backend
if ( ! function_exists ( 'k2t_portfolio_backend_scripts' ) ) :
	function k2t_portfolio_backend_scripts() {
		wp_enqueue_style( 'k2t-portfolio-backend', plugin_dir_url( __FILE__ ) . 'includes/admin/css/k2t-backend.css' );
	}
	add_action( 'admin_enqueue_scripts', 'k2t_portfolio_backend_scripts' );
endif;

add_action( 'init', 'k2t_add_new_image_size' );
function k2t_add_new_image_size() {
    add_image_size( 'thumb_350x350', 450, 450, true ); // Portfolio small
	add_image_size( 'thumb_350x700', 450, 900, true ); // Portfolio horizontal
	add_image_size( 'thumb_700x350', 900, 450, true ); // Portfolio vertical
	add_image_size( 'thumb_700x700', 900, 900, true ); // Portfolio big
	add_image_size( 'thumb_600x450', 600, 450, true ); // Portfolio big
	add_image_size( 'thumb_600x460', 600, 460, true ); // Portfolio big
	add_image_size( 'thumb_500x9999', 700, 9999, false ); //for masony of portfolio
	add_image_size( 'thumb_400x256', 400, 256, true ); // Portfolio related
}

//Include single and taxonomy to portfolio plugin
if ( !function_exists( 'k2t_include_single_template_portfolio' ) ) {
	function k2t_include_single_template_portfolio ( $single_template ) {
		global $post;
		if ( $post->post_type == 'post-portfolio' ) {
			$single_template = dirname(__FILE__) . '/includes/single-post-portfolio.php';
		}
		return $single_template;
	}
	add_filter( 'single_template', 'k2t_include_single_template_portfolio' );
}

//Taxonomy file
if(!function_exists('k2t_include_taxonomy_template_portfolio')){
	function k2t_include_taxonomy_template_portfolio( $template ){
		if( is_tax('portfolio-category') ){
			$template = dirname(__FILE__). '/includes/taxonomy-portfolio-category.php';
		}
		return $template;
	}
	add_filter('template_include', 'k2t_include_taxonomy_template_portfolio');
}

/* Include functions */
require_once( dirname(__FILE__) . '/includes/portfolio-post-type.php' ); // Register portfolio and category
require_once( dirname(__FILE__) . '/includes/func-portfolio.php' ); // Main function of plugin
require_once( dirname(__FILE__) . '/includes/admin/acf-content.php' ); // Portfolio option
require_once( dirname(__FILE__) . '/includes/mce/mce.php'); // Add mce buttons to post editor
require_once( dirname(__FILE__) . '/includes/shortcodes/portfolio.php'); // Add mce buttons to post editor
require_once( dirname(__FILE__) . '/includes/widget/recent-portfolio.php'); // Add widget






