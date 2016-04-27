<?php
/**
 * Theme functions for Contractor
 *
 * Do not edit the core files.
 * Add any modifications necessary under a child theme.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

/*--------------------------------------------------------------
	Define Paths
--------------------------------------------------------------*/
$framework_path = 'framework';
$theme_path     = 'framework/contractor';
$template_path  = $theme_path . '/tmpl';

/*--------------------------------------------------------------
	Define Constants
--------------------------------------------------------------*/
define( 'CONTRACTOR_TEMPLATE_PATH', get_template_directory() );
define( 'CONTRACTOR_TEMPLATE_URL', get_template_directory_uri() );
define( 'CONTRACTOR_TEMPLATE_TMPL', $template_path );

/*--------------------------------------------------------------
	Admin - Framework
--------------------------------------------------------------*/
require_once $framework_path . '/index.php';

/*--------------------------------------------------------------
	Contractor Theme
--------------------------------------------------------------*/
require_once $theme_path . '/function.php'; // Contractor theme extra functions
require_once $framework_path . '/k2timporter/import.php'; // Advance Importer
require_once $framework_path . '/k2ticon/k2ticon.php'; // add Icon Feature
require_once $theme_path . '/google-fonts.php'; // Adding google fonts
require_once $theme_path . '/widgets/widget-register.php'; // Adding widgets
require_once $theme_path . '/enqueue/styles.php'; // Contractor theme extra functions
require_once $theme_path . '/enqueue/scripts.php'; // Contractor theme extra functions

/*--------------------------------------------------------------
	3rd-plugins
--------------------------------------------------------------*/
require_once $theme_path . '/plugins/class-tgm-plugin-activation.php'; // Load TGM Plugin Activation library if not already loaded
require_once $theme_path . '/plugins/aq-resizer.php'; // Integration aq resizer script
require_once $theme_path . '/acf-json/acf-content.php'; // Adding advanced custom fields
//require_once $theme_path . '/mega-menu/mega-menu-framework.php'; // Adding k2t mega menu
//require_once $theme_path . '/mega-menu/mega-menus.php';
if ( class_exists( 'Woocommerce' ) ) {
	require_once $theme_path . '/func-woo.php'; // Integrated Woocommerce plugin
}
if ( class_exists( 'Vc_Manager' ) ) {
	require_once $theme_path . '/vc.php'; // Integrated VC
}

/*--------------------------------------------------------------
	Enqueue front-end script
--------------------------------------------------------------*/
if ( ! function_exists( 'k2t_front_end_enqueue_script' ) ) :
	function k2t_front_end_enqueue_script() {
		global $smof_data;

		// Load jquery easing.
		wp_enqueue_script( 'jquery-easing-script', CONTRACTOR_TEMPLATE_URL . '/assets/js/vendor/jquery-easing.js', array(), '', true );

		// Load parallax library.
		wp_enqueue_script( 'jquery-stellar-script', CONTRACTOR_TEMPLATE_URL . '/assets/js/vendor/jquery.stellar.min.js', array(), '', true );

		// Load infinite scroll library.
		wp_register_script( 'infinitescroll-script', CONTRACTOR_TEMPLATE_URL . '/assets/js/vendor/jquery.infinitescroll.min.js', array(), '', true );

		// Load infinite scroll library.
		wp_register_script( 'jquery-imageloaded-script', CONTRACTOR_TEMPLATE_URL . '/assets/js/vendor/jquery.imageloaded.min.js', array(), '', true );

		// Load zoom effect for title bar.
		if ( function_exists( 'get_field' ) && get_field( 'background_zoom', get_the_ID() ) ) {
			wp_enqueue_script( 'zoomeffects-script', CONTRACTOR_TEMPLATE_URL . '/assets/js/vendor/zoom-effect.js', array(), '', true );
		}

		// Register background slider
		wp_register_script( 'jquery-cbpBGSlideshow', CONTRACTOR_TEMPLATE_URL . '/assets/js/vendor/jquery.cbpBGSlideshow.js', array(), '', true );

		// Enqueue jquery waypoints
		wp_enqueue_script( 'jquery-waypoints', CONTRACTOR_TEMPLATE_URL . '/assets/js/vendor/jquery.waypoints.min.js', array(), '', true );

		// Enqueue jquery isotope
		wp_enqueue_script( 'jquery-isotope', CONTRACTOR_TEMPLATE_URL . '/assets/js/vendor/isotope.pkgd.min.js', array(), '', true );

		// Youtube background video
		wp_register_script( 'k2t-tubular', CONTRACTOR_TEMPLATE_URL . '/assets/js/vendor/jquery.tubular.js', array(), '', true);

		// Load our custom javascript.
		$mainParams = array();
		wp_enqueue_script( 'contractor-main-script', CONTRACTOR_TEMPLATE_URL . '/assets/js/main.js', array( 'jquery' ), '', true );
		if ( isset( $smof_data['offcanvas-swipe'] ) && $smof_data['offcanvas-swipe'] ) {
			$mainParams['offcanvas_turnon'] = $smof_data['offcanvas-turnon'];
		}
		if ( isset( $smof_data['sticky-menu'] ) ) {
			$mainParams['sticky_menu'] = $smof_data['sticky-menu'];
		}
		if ( 'masonry' == $smof_data['blog-style'] ) {
			$mainParams['blog_style'] = $smof_data['blog-style'];
		}
		wp_localize_script( 'contractor-main-script', 'mainParams', $mainParams );
		
		// Adds the comment-reply JavaScript to the single post pages
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
	add_action( 'wp_enqueue_scripts', 'k2t_front_end_enqueue_script' );
endif;

/*--------------------------------------------------------------
	Enqueue front-end style
--------------------------------------------------------------*/
if ( ! function_exists( 'k2t_front_end_enqueue_style' ) ) :
	function k2t_front_end_enqueue_style() {
		// Load background slider
		wp_enqueue_style( 'cbpBGSlideshow', CONTRACTOR_TEMPLATE_URL . '/assets/css/vendor/cbpBGSlideshow.css' );

		// Load font awesome for first active theme
		if ( ! function_exists( 'k2t_pre_process_shortcode' ) ) {
			wp_enqueue_style( 'font-awesome-style', CONTRACTOR_TEMPLATE_URL . '/assets/css/vendor/font-awesome.min.css' );	
		}

		// Register style for mega menu
		wp_enqueue_style( 'megamenu-style', CONTRACTOR_TEMPLATE_URL . '/assets/css/megamenu.css' );

		// Load popular stylesheet.
		wp_enqueue_style( 'contractor-owl-style', CONTRACTOR_TEMPLATE_URL . '/assets/css/popular.css' );

		// Load our main stylesheet.
		wp_enqueue_style( 'contractor-main-style', CONTRACTOR_TEMPLATE_URL . '/assets/css/main.css' );

		// Load responsive stylesheet.
		wp_enqueue_style( 'contractor-reponsive-style', CONTRACTOR_TEMPLATE_URL . '/assets/css/responsive.css' );

	}
	add_action( 'wp_enqueue_scripts', 'k2t_front_end_enqueue_style' );
endif;


/*
	Var for Script Backup
*/
function k2t_sample_import_add_admin_head() {
	echo '<scr' . 'ipt>';
	echo 'var home_url = "' . esc_url( site_url() ) . '";';
	echo 'var installing_proccess  = 0;';
	echo 'var cache_installing_url = "' . CONTRACTOR_TEMPLATE_URL . '/framework/k2timporter/tmp_backup/cache_proccess";';
	echo '</scr' . 'ipt>';
}
add_action( 'admin_head', 'k2t_sample_import_add_admin_head');

/*--------------------------------------------------------------
	Refine Get Options Of WP
--------------------------------------------------------------*/
function k2t_options( $option_name, $option_value = '' ) {
	if( get_option( $option_name ) != "" && get_option( $option_name ) != $option_value ) {
		update_option( $option_name, $option_value );
	} else {
		add_option( $option_name, $option_value );
	}
}

$upload_dir = wp_upload_dir();

// is_dir - tells whether the filename is a directory
if ( ! is_dir( $upload_dir["basedir"] . '/contractor_data' ) ) {
	//mkdir - tells that need to create a directory
	wp_mkdir_p( $upload_dir["basedir"] . '/contractor_data' );
}

/*--------------------------------------------------------------
	Deactive old plugins
--------------------------------------------------------------*/
function k2t_deactivate_plugin_conditional() {
	// Deactive old plugins
	if ( is_plugin_active( 'k2t-portfolio/init.php' ) ) {
		deactivate_plugins( 'k2t-portfolio/init.php' );
	}
	if ( is_plugin_active( 'k2t-shortcodes/init.php' ) ) {
		deactivate_plugins( 'k2t-shortcodes/init.php' );
	}

	// Deactive plugins of other theme in Kingkong
	if ( is_plugin_active( 'k2t-ruby-portfolio/init.php' ) ) {
		deactivate_plugins( 'k2t-ruby-portfolio/init.php' );
	}
	if ( is_plugin_active( 'k2t-ruby-shortcodes/init.php' ) ) {
		deactivate_plugins( 'k2t-ruby-shortcodes/init.php' );
	}
	if ( is_plugin_active( 'k2t-vaicalon-portfolio/init.php' ) ) {
		deactivate_plugins( 'k2t-vaicalon-portfolio/init.php' );
	}
	if ( is_plugin_active( 'k2t-vaicalon-shortcodes/init.php' ) ) {
		deactivate_plugins( 'k2t-vaicalon-shortcodes/init.php' );
	}
	if ( is_plugin_active( 'k2t-grid-portfolio/init.php' ) ) {
		deactivate_plugins( 'k2t-grid-portfolio/init.php' );
	}
	if ( is_plugin_active( 'k2t-grid-shortcodes/init.php' ) ) {
		deactivate_plugins( 'k2t-grid-shortcodes/init.php' );
	}
}
add_action( 'admin_init', 'k2t_deactivate_plugin_conditional' );