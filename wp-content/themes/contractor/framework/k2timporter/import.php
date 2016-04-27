<?php 
/*

RESET DEFAULT DATA WORDPRESS

*/
include('dbimexport.php');
/* Clear All Cache After Import Data */
add_action('wp_ajax_k2t_clear_cache', 'k2t_clear_cache');
add_action( 'wp_ajax_nopriv_k2t_clear_cache', 'k2t_clear_cache' );

function k2t_clear_cache(){
	$wp_upload_dir = wp_upload_dir();
	$tmpcache = $wp_upload_dir ["basedir"]. '/contractor_data';
	$filescache = glob( $tmpcache . '/*' ); // get all file names
	foreach($filescache as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}


}

add_action('wp_ajax_k2t_backup_tables', 'k2t_backup_tables');
add_action( 'wp_ajax_nopriv_k2t_backup_tables', 'k2t_backup_tables' );

function k2t_backup_tables() {
	$wp_upload_dir = wp_upload_dir();
	global $wpdb;
	
	/* BACKUP DATA DONE */
	/* Start Reset Default WP Data */
	if(isset($_POST[enable_drop_old_data]) && $_POST[enable_drop_old_data] == 1){
		/* Reset Default WP Data Done */
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'commentmeta` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'comments` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'links` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'newsletter` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'newsletter_emails` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'newsletter_stats` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'postmeta` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'posts` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'revslider_css` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'revslider_layer_animations` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'revslider_settings` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'revslider_sliders` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'revslider_slides` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'revslider_static_slides` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'term_relationships` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'term_taxonomy` WHERE 1');
		$wpdb->query('DELETE FROM `' . $wpdb->base_prefix . 'terms` WHERE 1');
	}
	die();
}
/* 
II -  Active Plugin Function 
*/
add_action('wp_ajax_k2t_active_plugin', 'k2t_active_plugin');
add_action( 'wp_ajax_nopriv_k2t_active_plugin', 'k2t_active_plugin' );

function k2t_active_plugin(){
	$wp_upload_dir = wp_upload_dir();	
	$activate_nonce = wp_create_nonce( 'tgmpa-activate' );

	$install_nonce = wp_create_nonce( 'tgmpa-install' );

	$plugins = array(
		array(
			'name'               => 'K2T Contractor Shortcodes',
			'slug'               => 'k2t-contractor-shortcodes',
			'source'             => CONTRACTOR_TEMPLATE_PATH . '/framework/contractor/plugins/k2t-contractor-shortcodes.zip',
			'required'           => true,
			'force_activation'   => true,
			'force_deactivation' => false,
			'file'	             => 'init.php',
			'activate_nonce'     => $activate_nonce,
			'install_nonce'      => $install_nonce,
		),
		array(
			'name'           => 'Contact Form 7', // The plugin name
			'slug'           => 'contact-form-7', // The plugin slug (typically the folder name)
			'required'       => false, // If false, the plugin is only 'recommended' instead of required
			'file'           => 'wp-contact-form-7.php',
			'activate_nonce' => $activate_nonce,
			'install_nonce'  => $install_nonce,
			'source'         => ''

		),
		array(
			'name'           => 'WooCommerce',
			'slug'           => 'woocommerce',
			'required'       => false,
			'file'	         => 'woocommerce.php',
			'activate_nonce' => $activate_nonce,
			'install_nonce'  => $install_nonce,
			'source'         => ''
		), 
		array(
			'name'           => 'Visual composer',
			'slug'           => 'js_composer',
			'source'         => CONTRACTOR_TEMPLATE_PATH . '/framework/contractor/plugins/js_composer.zip',
			'required'       => true,
			'file'	         => 'js_composer.php',
			'activate_nonce' => $activate_nonce,
			'install_nonce'  => $install_nonce,
		),
		array(
			'name'           => 'K2T Contractor Portfolio',
			'slug'           => 'k2t-contractor-portfolio',
			'source'         => CONTRACTOR_TEMPLATE_PATH . '/framework/contractor/plugins/k2t-contractor-portfolio.zip',
			'required'       => false,
			'file'	         => 'init.php',
			'activate_nonce' => $activate_nonce,
			'install_nonce'  => $install_nonce,
		),
		array(
			'name'           => 'Advanced Custom Fields Pro',
			'slug'           => 'advanced-custom-fields-pro',
			'source'         => CONTRACTOR_TEMPLATE_PATH . '/framework/contractor/plugins/advanced-custom-fields-pro.zip',
			'required'       => true,
			'file'	         => 'acf.php',
			'activate_nonce' => $activate_nonce,
			'install_nonce'  => $install_nonce,
		),
		array(
			'name'           => 'Revolution Slider',
			'slug'           => 'revslider',
			'source'         => CONTRACTOR_TEMPLATE_PATH . '/framework/contractor/plugins/revslider.zip',
			'required'       => false,
			'file'	         => 'revslider.php',
			'activate_nonce' => $activate_nonce,
			'install_nonce'  => $install_nonce,
		),
	);
	
	/**
	 * Detect plugin. For use on Front End only.
	 */
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	$out = array();
	/* Install Plugin */
	$i = 0;
	foreach($plugins as $pl){
		// check for plugin using plugin name
		if ( ! is_plugin_active( $pl["slug"].'/'.$pl["file"] ) ) {
		   $out[$i]  = $pl;
		   $i++;

		}
	}
	echo  json_encode($out);
	die();
}


/* Upload Asset */
add_action('wp_ajax_k2t_import_asset', 'k2t_import_asset');
add_action( 'wp_ajax_nopriv_k2t_import_asset', 'k2t_import_asset' );
function k2t_import_asset(){
	$wp_upload_dir = wp_upload_dir();
	$options = '';
	if(isset($_POST["type_name"])){
		$versionsUrl =  'http://install.k2theme.com/contractor_data';
		$type = $_POST["type_name"];
		$ver = $_POST["ver"];
		$folder = $versionsUrl . "/" . $type . "/" . $ver;
		$options = $folder.'/'.$ver.'_options.txt';
	}else{
		$versionsUrl = 'http://install.k2theme.com/contractor_data';
		$folder = $versionsUrl;
		$options = $folder.'/options.txt';
	}
	$file_headers = @get_headers($options);
	
	if($file_headers[0] == 'HTTP/1.1 200 OK') {
		$tmpZip = $wp_upload_dir["basedir"] . '/contractor_data/options.txt';
		file_put_contents($tmpZip, file_get_contents($options));
		$data = unserialize(base64_decode(file_get_contents($tmpZip)));
		of_save_options($data);							
	}else{
		echo ("Import Theme Options False");
	}


	$widgets_json = '';
	if(isset($_POST["type_name"])){
		$versionsUrl =  'http://install.k2theme.com/contractor_data';
		$type = $_POST["type_name"];
		$ver = $_POST["ver"];
		$folder = $versionsUrl . "/" . $type . "/" . $ver;
		$widgets_json = $folder.'/'.$ver.'_widget.txt';
	}else{
		$versionsUrl = 'http://install.k2theme.com/contractor_data';
		$folder = $versionsUrl;
		$widgets_json = $folder.'/widget.txt';
	}
	
	$file_headers = @get_headers($widgets_json);
	
	if($file_headers[0] == 'HTTP/1.1 200 OK') {
		$tmpZip = $wp_upload_dir["basedir"] . '/contractor_data/widget.txt';
		file_put_contents($tmpZip, file_get_contents($widgets_json));
		$data = unserialize( base64_decode(file_get_contents($tmpZip)) );
		foreach($data as $key=>$value){
			k2t_options($key,(array)$value);
		}
	}else{
		echo "Widget False";
	}		


	//add_missing_slider_database();
	// Import Widget 				
	$versionsUrl = 'http://install.k2theme.com/contractor_data/uploads_data.zip';
	$folder = $versionsUrl;

	if(isset($_POST["ver"]) && $_POST["ver"] <> "NONE"){
		$versionsUrl =  'http://install.k2theme.com/contractor_data';
		$type = $_POST["type_name"];
		$ver = $_POST["ver"];
		$versionsUrl = $versionsUrl . "/" . $type . "/" . $ver . "/" . $ver . "_uploads_data.zip";
		//$upload_data = $versionsUrl . "/" . $type . "/" . $ver . "/" . $ver . "_filter.data";
		//echo $folder;
	};

	$file_headers = @get_headers($versionsUrl);	
	if($file_headers[0] == 'HTTP/1.1 200 OK'){
		$tmpZip = $wp_upload_dir["basedir"] . '/contractor_data/uploads_data.zip';
		file_put_contents($tmpZip, file_get_contents($versionsUrl));
		WP_Filesystem();
		$destination = wp_upload_dir();
		$destination_path = $destination['basedir'];
		$unzipfile = unzip_file( $tmpZip, $destination_path);
	   if ( $unzipfile ) {
		  echo 'Successfully unzipped the file!';       
	   } else {
		  echo 'There was an error unzipping the file.';       
	   }
	}else{
		echo 'File Not Found!';  
	}				
}
/* End Upload Asset */

/*

*/
add_action('wp_ajax_k2t_backup_database', 'k2t_backup_database');
add_action( 'wp_ajax_nopriv_k2t_backup_database', 'k2t_backup_database' );
function k2t_backup_database(){
	$wp_upload_dir = wp_upload_dir();	
	/* Upload File */
	$versionsUrl = 'http://install.k2theme.com/contractor_data';
	$folder = $versionsUrl;
	// Slider 4
	$upload_data = $folder.'/filter.data';
	global $wpdb;
	if(isset($_POST["ver"]) && $_POST["ver"] <> "NONE"){
		$versionsUrl =  'http://install.k2theme.com/contractor_data';
		$type = $_POST["type_name"];
		$ver = $_POST["ver"];
		$upload_data = $versionsUrl . "/" . $type . "/" . $ver . "/" . $ver . "_filter.data";
	};

	
	$file_headers = @get_headers($upload_data);				
	if( $file_headers[0] == 'HTTP/1.1 200 OK' ) {
		/* End Upload Data */
		/**/
		$tmpZip_upload_data = $wp_upload_dir["basedir"] . '/contractor_data/filter.data';
		file_put_contents($tmpZip_upload_data, file_get_contents($upload_data));
		global $wpdb;
		$templine = '';
		// Read in entire file
		$lines = file($tmpZip_upload_data);
		// Loop through each line
		/*
			BEFORE RESTORE DATABSE
		*/
			$blog_url = site_url();
			$blogname = get_option( "blogname" );
			$blogdescription = get_option( "blogdescription" );
			$admin_email = get_option( "admin_email" );
			$template = get_option( "template" );
			$stylesheet = get_option( "stylesheet" );
			$current_theme = get_option( "current_theme" );
			$current_active_plugin = serialize( get_option( "active_plugins" ) );
			$current_user = wp_get_current_user();
			$k2t_prefix  = $wpdb->base_prefix;
			$user_role = serialize( get_option( $k2t_prefix."user_roles" ) );
		/*
			END BEFORE
		*/
		$wpdb->query("SET GLOBAL max_allowed_packet=10737418240");
		foreach ($lines as $line)
		{
			if (substr($line, 0, 2) == "--" || $line == ""){
				continue;
			}
			$templine .= $line;
			if (substr(trim($line), -1, 1) == ';')
			{ 
				//$templine = str_replace("wp-content/themes/contractor/", "wp-content/themes/" . $template . "/", $templine);
				$templine = str_replace("__________YOURSITE__________", $blog_url, $templine);
				$templine = str_replace("__________BLOGNAME__________", $blogname, $templine);
				$templine = str_replace("__________BLOGDESCRIPT__________", $blogdescription, $templine);
				$templine = str_replace("__________ADMINEMAIL__________", $admin_email, $templine);
				$templine = str_replace("__________TEMPLATE__________", $template, $templine);
				$templine = str_replace("__________STYLESHEET__________", $stylesheet, $templine);
				$templine = str_replace("__________ACTIVE_PLUGIN__________", $current_active_plugin, $templine);
				//$templine = str_replace("___________THEMEMOD__________", $current_theme_mod, $templine);
				$templine = str_replace("___________PREFIX__________", "`" . $k2t_prefix, $templine);
				$templine = str_replace("__________USER_ROLE__________", $user_role , $templine);
				$templine = str_replace("__________ROLE_PREFIX__________", $k2t_prefix , $templine);
				
				$wpdb->query($templine);$templine = '';}}
	}else{
		echo ("Data Dump Not Found!!!");
	}
}
add_action('wp_ajax_k2t_import_data', 'k2t_import_data');
add_action( 'wp_ajax_nopriv_k2t_import_data', 'k2t_import_data' );

function k2t_import_data() {
	$wp_upload_dir = wp_upload_dir();
	// Load Importer API
	require_once ABSPATH . 'wp-admin/includes/import.php';
	$importerError = false;
	$demo_data_installed = get_option('demo_data_installed');
	
	if($demo_data_installed == 'yes') die();

	if ( !defined( 'WP_LOAD_IMPORTERS' ) ) define( 'WP_LOAD_IMPORTERS', true ); // we are loading importers  
	//check if wp_importer, the base importer class is available, otherwise include it
	if ( !class_exists( 'WP_Importer' ) ) {
		$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		if ( file_exists( $class_wp_importer ) ) 
			require_once($class_wp_importer);
		else 
			$importerError = true;
	}
	//check if wp_importer, the base importer class is available, otherwise include it
	if ( !class_exists( 'WP_Import' ) ) {
		$WP_Import =  get_template_directory() . '/framework/k2timporter/wordpress-importer.php';
		if ( file_exists( $WP_Import ) ) 
			require_once($WP_Import);
		else 
			$importerError = true;
	}	
	if($importerError !== false) {
		echo ("The Auto importing script could not be loaded. Please use the wordpress importer and import the XML file that is located in your themes folder manually.");
	} else {

		if(class_exists('WP_Importer')){
			try{
			
				//End Import Widget 				
				// Import Theme Options 
				$versionsUrl =  'http://install.k2theme.com/contractor_data';
				$folder = $versionsUrl;				
				$options = $folder.'/options.txt';
				$file_headers = @get_headers($options);
				
				if($file_headers[0] == 'HTTP/1.1 200 OK') {
					$tmpZip = $wp_upload_dir["basedir"] . '/contractor_data/options.txt';
					file_put_contents($tmpZip, file_get_contents($options));
					$data = unserialize(base64_decode(file_get_contents($tmpZip)));
					of_save_options($data);							
				}else{
					echo ("Import Theme Options False");
				}
				if ( class_exists( 'Woocommerce' ) ) {

					// Set pages
					$woopages = array(
						'woocommerce_shop_page_id' => 'Shop',
						'woocommerce_cart_page_id' => 'Cart',
						'woocommerce_checkout_page_id' => 'Checkout',
						'woocommerce_pay_page_id' => 'Checkout &#8594; Pay',
						'woocommerce_thanks_page_id' => 'Order Received',
						'woocommerce_myaccount_page_id' => 'My Account',
						'woocommerce_edit_address_page_id' => 'Edit My Address',
						'woocommerce_view_order_page_id' => 'View Order',
						'woocommerce_change_password_page_id' => 'Change Password',
						'woocommerce_logout_page_id' => 'Logout',
						'woocommerce_lost_password_page_id' => 'Lost Password'
					);
					if ( $woopages )
						foreach ( $woopages as $woo_page_name => $woo_page_title ) {
							$woopage = get_page_by_title( $woo_page_title );
							if ( $woopage->ID ) {
								update_option( $woo_page_name, $woopage->ID ); // Front Page
							}
						}
					// We no longer need to install pages
					delete_option( '_wc_needs_pages' );
					delete_transient( '_wc_activation_redirect' );

					// Flush rules after install
					flush_rewrite_rules();
				}
				k2t_update_options();
				
				// Import Simple Data     
				die('Success!');
			} catch (Exception $e) {
				echo ("Error while importing");
			}
		}
	}
	die();
}


add_action('wp_ajax_k2t_install_version', 'k2t_install_version');
add_action('wp_ajax_nopriv_k2t_install_version', 'k2t_install_version');

function k2t_install_version() {
	// Load Importer API
	require_once ABSPATH . 'wp-admin/includes/import.php';
	$importerError = false;
	$demo_data_installed = get_option('demo_data_installed');
	
	if($demo_data_installed == 'yes') die();

	if ( !defined( 'WP_LOAD_IMPORTERS' ) ) define( 'WP_LOAD_IMPORTERS', true ); // we are loading importers
		
	//check if wp_importer, the base importer class is available, otherwise include it
	if ( !class_exists( 'WP_Importer' ) ) {
		$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		if ( file_exists( $class_wp_importer ) ) 
			require_once($class_wp_importer);
		else 
			$importerError = true;
	}
	//check if wp_importer, the base importer class is available, otherwise include it
	if ( !class_exists( 'WP_Import' ) ) {
		$WP_Import =  get_template_directory() . '/framework/k2timporter/wordpress-importer.php';
		if ( file_exists( $WP_Import ) ) 
			require_once($WP_Import);
		else 
			$importerError = true;
	}
	
	if($importerError !== false) {
		echo ("The Auto importing script could not be loaded. Please use the wordpress importer and import the XML file that is located in your themes folder manually.");
	} else {
	
		//do_action('et_before_data_import');
		$wp_upload_dir = wp_upload_dir();
		$versionsUrl =  'http://install.k2theme.com/contractor_data';
		$type = $_POST["type_name"];
		$ver = $_POST["ver"];
		$folder = $versionsUrl . "/" . $type . "/" . $ver;
		if(class_exists('WP_Importer')){
			try{
				// Import Theme Options 
				$options = $folder.'/'.$ver.'_options.txt';
				$file_headers = @get_headers($options);
				
				if($file_headers[0] == 'HTTP/1.1 200 OK') {
					$tmpZip = $wp_upload_dir["basedir"] . '/contractor_data/options.txt';
					file_put_contents($tmpZip, file_get_contents($options));
					$data = unserialize(base64_decode(file_get_contents($tmpZip)));
					of_save_options($data);							
				}else{
					echo ("Import Theme Options False");
				}

				//End Import Theme Options

				

				if ( class_exists( 'Woocommerce' ) ) {

					// Set pages
					$woopages = array(
						'woocommerce_shop_page_id' => 'Shop',
						'woocommerce_cart_page_id' => 'Cart',
						'woocommerce_checkout_page_id' => 'Checkout',
						'woocommerce_pay_page_id' => 'Checkout &#8594; Pay',
						'woocommerce_thanks_page_id' => 'Order Received',
						'woocommerce_myaccount_page_id' => 'My Account',
						'woocommerce_edit_address_page_id' => 'Edit My Address',
						'woocommerce_view_order_page_id' => 'View Order',
						'woocommerce_change_password_page_id' => 'Change Password',
						'woocommerce_logout_page_id' => 'Logout',
						'woocommerce_lost_password_page_id' => 'Lost Password'
					);
					if ( $woopages )
						foreach ( $woopages as $woo_page_name => $woo_page_title ) {
							$woopage = get_page_by_title( $woo_page_title );
							if ( $woopage->ID ) {
								update_option( $woo_page_name, $woopage->ID ); // Front Page
							}
						}

					// We no longer need to install pages
					delete_option( '_wc_needs_pages' );
					delete_transient( '_wc_activation_redirect' );

					// Flush rules after install
					flush_rewrite_rules();
				}
				/* Update Theme Options */
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $_POST["home_id"]);
				update_option( 'page_for_posts', $_POST["home_id"] );

				//End Import Widget         

				die('Success!');
			} catch (Exception $e) {
				echo ("Error while importing");
			}
		}
	}
	die();
}

function k2t_update_options() {
	global $options_presets;
	/* Change To Home Page Name*/
	/* Change To Blog Page Name*/
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', '38' );
}

function k2t_update_menus(){}