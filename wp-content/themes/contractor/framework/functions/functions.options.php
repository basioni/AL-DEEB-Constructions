<?php
add_action( 'init', 'of_options' );

if ( ! function_exists( 'of_options' ) ) {
	function of_options() {

		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/

		// Set the Options Array
		global $of_options, $smof_data;
		$of_options = array();

		$patterns_path = get_stylesheet_directory() . '/assets/img/patterns/light/';
		$patterns_url  = get_template_directory_uri() . '/assets/img/patterns/light/';
		$light_pattern_arr = array( '' => __( 'None', 'contractor' ) );
		if ( is_dir( $patterns_path ) ) {
			if ( $patterns_dir = opendir( $patterns_path ) ) {
				while ( ( $patterns_file = readdir( $patterns_dir ) ) !== false ) {
					if ( ( stristr( $patterns_file, '.png' ) !== false || stristr( $patterns_file, '.jpg' ) !== false || stristr( $patterns_file, '.gif' ) !== false ) && stristr( $patterns_file , '2X' ) === false ) {
						$light_pattern_arr[ $patterns_url . $patterns_file ] = $patterns_file;
					}
				}
			}
		}
		asort( $light_pattern_arr );

		$patterns_path = get_stylesheet_directory() . '/assets/img/patterns/dark/';
		$patterns_url = get_template_directory_uri() . '/assets/img/patterns/dark/';
		$dark_pattern_arr = array( '' => __( 'None', 'contractor' ) );
		if ( is_dir( $patterns_path ) ) {
			if ( $patterns_dir = opendir( $patterns_path ) ) {
				while ( ( $patterns_file = readdir( $patterns_dir ) ) !== false ) {
					if ( ( stristr( $patterns_file, '.png' ) !== false || stristr( $patterns_file, '.jpg' ) !== false || stristr( $patterns_file, '.gif' ) !== false ) && stristr( $patterns_file , '2X' ) === false ) {
						$dark_pattern_arr[ $patterns_url . $patterns_file ] = $patterns_file;
					}
				}
			}
		}
		asort( $dark_pattern_arr );

		// Get all menu
		$total_menu = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		$total_menu_arr = array( '' => __( 'None', 'contractor' ) );
		if ( count( $total_menu ) > 0 ) {
			foreach ( $total_menu as $menu ) {
				$total_menu_arr[$menu->term_id] = $menu->name;
			}
		}

		// Get all sidebar
		$sidebars = array();
		if ( count( $GLOBALS['wp_registered_sidebars'] > 0 ) ){
			foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {

				$sidebars[$sidebar['id']] = $sidebar['name'];
			}
		}

		/*-----------------------------------------------------------------------------------*/
		/* General */
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( 'General', 'contractor' ),
			'type' => 'heading',
			'icon' => ADMIN_IMAGES . 'icon-settings.png'
		);

		$of_options[] = array(  'name' => __( 'General', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'General', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Show/Hide breadcrumb', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'breadcrumb',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide page loader', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'pageloader',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( 'Sidebar width', 'contractor' ),
			'type' => 'sliderui',
			'id'   => 'sidebar_width',
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
			'std'  => 30,
			'desc' => __( 'Unit: %', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Header Code', 'contractor' ),
			'type' => 'textarea',
			'std'  => '',
			'id'   => 'header_code',
			'desc' => __( 'You can load Google fonts here.', 'contractor' ),
			'is_js_editor' => '1'
		);

		$of_options[] = array(  'name' => __( 'Custom CSS', 'contractor' ),
			'type' => 'textarea',
			'std'  => '',
			'id'   => 'custom_css',
			'desc' => __( 'If you know a little about CSS, you can write your custom CSS here. Do not edit CSS files (it will be lost when you update this theme).', 'contractor' ),
			'is_css_editor' => '1'
		);

		/* Icons */
		$of_options[] = array(  'name' => __( 'Icons', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Icons', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Favicon', 'contractor' ),
			'type' => 'media',
			'id'   => 'favicon',
			'std'  => get_template_directory_uri() . '/assets/img/icons/favicon.png',
			'desc' => __( 'Favicon is a small icon image at the topbar of your browser. Should be 16x16px or 32x32px image (png, ico...)', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'IPhone icon (57x57px)', 'contractor' ),
			'type' => 'media',
			'id'   => 'apple-iphone-icon',
			'std'  => get_template_directory_uri() . '/assets/img/icons/iphone.png',
			'desc' => __( 'Similar to the Favicon, the <strong> iPhone icon</strong> is a file used for a web page icon on the  iPhone. When someone bookmarks your web page or adds your web page to their home screen, this icon is used. If this file is not found, these  products will use the screen shot of the web page, which often looks like no more than a white square.', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'IPhone retina icon (114x114px)', 'contractor' ),
			'type' => 'media',
			'id'   => 'apple-iphone-retina-icon',
			'std'  => get_template_directory_uri() . '/assets/img/icons/iphone@2x.png',
			'desc' => __( 'The same as  iPhone icon but for Retina iPhone.', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'IPad icon (72x72px)', 'contractor' ),
			'type' => 'media',
			'id'   => 'apple-ipad-icon',
			'std'  => get_template_directory_uri() . '/assets/img/icons/ipad.png',
			'desc' => __( 'The same as  iPhone icon but for iPad.', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'IPad Retina icon (144x144px)', 'contractor' ),
			'type' => 'media',
			'id'   => 'apple-ipad-retina-icon',
			'std'  => get_template_directory_uri() . '/assets/img/icons/ipad@2x.png',
			'desc' => __( 'The same as  iPhone icon but for Retina iPad.', 'contractor' ),
		);

		/*-----------------------------------------------------------------------------------*/
		/* Header
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( 'Header', 'contractor' ),
			'type' => 'heading',
			'icon' => ADMIN_IMAGES . 'header.png"'
		);
		/* Header */
		$of_options[] = array(  'name' => __( 'Header Backup Options', 'contractor' ),
			'type' => 'advance_importer',
			'std'  => __( 'Header Backup Options', 'contractor' ),
			'desc' => 'Import or Export Header layouts for all Header sections', // For Name Automatice Same
			'id' => 'header-advance-import',
			'advance_importer' => array( 'sticky-menu' , 'fixed-header' , 'full-header' , 'use-top-header' , 'header_section_1' , 'use-mid-header' , 'header_section_2' , 'use-bot-header' , 'header_section_3' )
		);
		/* Header */
		$of_options[] = array(  'name' => __( 'Header Settings', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Header Settings', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Enable menu appear on other header sections?', 'contractor' ),
			'type' => 'switch',
			'std'  => false,
			'id'   => 'enable_menu_header_section',
			'desc' => __( 'Enable this option can let the menu display on Top Header Secion or Section Header Section. By default "OFF", the menu only displays in Header Middle Section', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Sticky menu?', 'contractor' ),
			'type' => 'select',
			'options' => array(
				''        => __( 'None', 'contractor' ),
				'sticky_top' => __( 'Sticky menu on top header', 'contractor' ),
				'sticky_mid' => __( 'Sticky menu on middle header', 'contractor' ),
				'sticky_bot' => __( 'Sticky menu on bottom header', 'contractor' ),
			),
			'std'  => '',
			'id'   => 'sticky-menu',
			'desc' => __( 'Enable this setting so that the header section and menus inlcuded in the header are sticky', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Header Layouts', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Header Layouts', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Fixed header?', 'contractor' ),
			'type' => 'switch',
			'std'  => false,
			'id'   => 'fixed-header',
			'desc' => __( 'If the setting is enabled, the body section will be displayed under the header. If the setting is disabled, the body section will be displayed above the header. In the 2nd case, you can make the header transparent to create a very nice style', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Fullwidth header layout', 'contractor' ),
			'type' => 'switch',
			'std'  => false,
			'id'   => 'full-header',
			'desc' => __( 'Turn it ON if you want to set full width header.', 'contractor' ),
		);

		/* Visual Header */
		$of_options[] = array(  'name' => __( 'Top Header Section', 'contractor' ),
			'type' => 'switch',
			'std'  => false,
			'id'   => 'use-top-header',
			'desc' => __( 'Show or hide top header layout.', 'contractor' ),
			'k2t_logictic' => array(
				'0' => array( ),
				'1' => array( 'header_section_1' ),
			),			
		);

		$of_options[] = array(
			'type' => 'k2t_header_option',
			'std'  => '',
			'id'   => 'header_section_1',
			'desc' => '',
			
		);

		$of_options[] = array(  'name' => __( 'Middle Header Section', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'use-mid-header',
			'desc' => __( 'Show or hide middle header layout.', 'contractor' ),
			'k2t_logictic' => array(
				'0' => array( ),
				'1' => array( 'header_section_2' ),

			),		
		);

		$of_options[] = array(
			'type' => 'k2t_header_option',
			'std'  => '{"name":"header_section_2","setting":{"bg_image":"","bg_color":"","opacity":"","fixed_abs":"fixed","custom_css":""},"columns_num":2,"htmlData":"","columns":[{"id":1,"percent":"2","value":[{"id":"1425696862388","type":"logo","value":{"custom_class":"","custom_id":""}}]},{"id":2,"value":[{"id":"1427731147425","type":"custom_menu","value":{"menu_id":"TWFpbg==","custom_class":"","custom_id":""}}],"percent":"10"}]}',
			'id'   => 'header_section_2',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( 'Bottom Header Section', 'contractor' ),
			'type' => 'switch',
			'std'  => false,
			'id'   => 'use-bot-header',
			'desc' => __( 'Show or hide middle header layout.', 'contractor' ),
			'k2t_logictic' => array(
				'0' => array( ),
				'1' => array( 'header_section_3' ),
			),		
		);

		$of_options[] = array(
			'type' => 'k2t_header_option',
			'std'  => '',
			'id'   => 'header_section_3',
			'desc' => '',
		);

		/* Logo */
		$of_options[] = array(  'name' => __( 'Logo', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Logo', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Use text logo', 'contractor' ),
			'type' => 'switch',
			'std'  => false,
			'id'   => 'use-text-logo',
			'desc' => __( 'Turn it ON if you want to use text logo instead of image logo.', 'contractor' ),
			'logicstic' => true,
		);

		$of_options[] = array(  'name' => __( 'Text logo', 'contractor' ),
			'type' => 'text',
			'std'  => '',
			'id'   => 'text-logo',
			'desc' => '',
			'conditional_logic' => array(
				'field'    => 'use-text-logo',
				'value'    => 'switch-1',
			),
		);

		$of_options[] = array(  'name' => __( 'Logo', 'contractor' ),
			'type' => 'media',
			'id'   => 'logo',
			'std'  => get_template_directory_uri() . '/assets/img/logo.png',
			'desc' => __( 'The logo size in our demo is 194x48px. Please use jpg, jpeg, png or gif image for best performance', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Retina logo', 'contractor' ),
			'type' => 'media',
			'id'   => 'retina-logo',
			'std'  => get_template_directory_uri() . '/assets/img/logo@2x.png',
			'desc' => __( '2x times your logo dimension.', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Logo margin top (px)', 'contractor' ),
			'type' => 'sliderui',
			'id'   => 'logo-margin-top',
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
			'std'  => 19,
		);

		$of_options[] = array(  'name' => __( 'Logo margin right (px)', 'contractor' ),
			'type' => 'sliderui',
			'id'   => 'logo-margin-right',
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
			'std'  => 19,
		);

		$of_options[] = array(  'name' => __( 'Logo margin bottom (px)', 'contractor' ),
			'type' => 'sliderui',
			'id'   => 'logo-margin-bottom',
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
			'std'  => 19,
		);

		$of_options[] = array(  'name' => __( 'Logo margin left (px)', 'contractor' ),
			'type' => 'sliderui',
			'id'   => 'logo-margin-left',
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
			'std'  => 0,
		);

		/*-----------------------------------------------------------------------------------*/
		/* Footer
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( 'Footer', 'contractor' ),
			'type' => 'heading',
			'icon' => ADMIN_IMAGES . 'footer.png'
		);

		$of_options[] = array(  'name'   => __( 'Show/Hide "Go to top"', 'contractor' ),
			'id'   => 'footer-gototop',
			'type' => 'switch',
			'std'  => true,
		);

		/* Widget area */
		$of_options[] = array(  'name' => __( 'Widget area', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Main Footer', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Sidebars layout', 'contractor' ),
			'type' => 'select',
			'id'   => 'bottom-sidebars-layout',
			'options' => array(
				'layout-1' => __( '1/4 1/4 1/4 1/4', 'contractor' ),
				'layout-2' => __( '1/3 1/3 1/3', 'contractor' ),
				'layout-3' => __( '1/2 1/4 1/4', 'contractor' ),
				'layout-4' => __( '1/4 1/2 1/4', 'contractor' ),
				'layout-5' => __( '1/4 1/4 1/2', 'contractor' ),
				'layout-6' => __( '1/2 1/2', 'contractor' ),
				'layout-7' => __( '1', 'contractor' ),
			),
			'std'  => 'layout-1',
			'desc' => __( 'Select sidebars layout', 'contractor' ),
		);

		$of_options[] = array(  'name'   => __( 'Background color', 'contractor' ),
			'id'   => 'bottom-background-color',
			'type' => 'color',
			'std'  => '',
		);

		$of_options[] = array(  'name'   => __( 'Background image', 'contractor' ),
			'id'   => 'bottom-background-image',
			'type' => 'upload',
			'std'  => get_template_directory_uri() . '/assets/img/bicolors.png',
		);

		$of_options[] = array(  'name' => __( 'Background position?', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				''    => __( 'None', 'contractor' ),
				'left top'      => __( 'Left Top', 'contractor' ),
				'left center'   => __( 'Left Center', 'contractor' ),
				'left bottom'   => __( 'Left Bottom', 'contractor' ),
				'right top'     => __( 'Right Top', 'contractor' ),
				'right center'  => __( 'Right Center', 'contractor' ),
				'right bottom'  => __( 'Right Bottom', 'contractor' ),
				'center top'    => __( 'Center Top', 'contractor' ),
				'center center' => __( 'Center Center', 'contractor' ),
				'center bottom' => __( 'Center Bottom', 'contractor' ),
			),
			'std'  => 'center top',
			'id'   => 'bottom-background-position',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( 'Background repeat?', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				''    => __( 'None', 'contractor' ),
				'no-repeat' => __( 'No repeat', 'contractor' ),
				'repeat'    => __( 'Repeat', 'contractor' ),
				'repeat-x'  => __( 'Repeat X', 'contractor' ),
				'repeat-y'  => __( 'Repeat Y', 'contractor' ),
			),
			'std'  => 'repeat-y',
			'id'  => 'bottom-background-repeat',
			'desc'  => '',
		);

		$of_options[] = array(  'name' => __( 'Background size?', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				''        => __( 'None', 'contractor' ),
				'auto'    => __( 'Auto', 'contractor' ),
				'cover'   => __( 'Cover', 'contractor' ),
				'contain' => __( 'Contain', 'contractor' ),
			),
			'std'  => '',
			'id'   => 'bottom-background-size',
			'desc' => '',
		);

		/* Footer bottom */
		$of_options[] = array(  'name' => __( 'Footer', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Bottom Footer', 'contractor' ),
		);

		$of_options[] = array(  'name'   => __( 'Background color', 'contractor' ),
			'id'   => 'footer-background-color',
			'type' => 'color',
			'std'  => '#242424',
		);

		$of_options[] = array(  'name'   => __( 'Background image', 'contractor' ),
			'id'   => 'footer-background-image',
			'type' => 'upload',
			'std'  => '',
		);

		$of_options[] = array(  'name' => __( 'Background position?', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				''    => __( 'None', 'contractor' ),
				'left top'      => __( 'Left Top', 'contractor' ),
				'left center'   => __( 'Left Center', 'contractor' ),
				'left bottom'   => __( 'Left Bottom', 'contractor' ),
				'right top'     => __( 'Right Top', 'contractor' ),
				'right center'  => __( 'Right Center', 'contractor' ),
				'right bottom'  => __( 'Right Bottom', 'contractor' ),
				'center top'    => __( 'Center Top', 'contractor' ),
				'center center' => __( 'Center Center', 'contractor' ),
				'center bottom' => __( 'Center Bottom', 'contractor' ),
			),
			'std'  => '',
			'id'   => 'footer-background-position',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( 'Background repeat?', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				''    => __( 'None', 'contractor' ),
				'no-repeat' => __( 'No repeat', 'contractor' ),
				'repeat'    => __( 'Repeat', 'contractor' ),
				'repeat-x'  => __( 'Repeat X', 'contractor' ),
				'repeat-y'  => __( 'Repeat Y', 'contractor' ),
			),
			'std'  => '',
			'id'  => 'footer-background-repeat',
			'desc'  => '',
		);

		$of_options[] = array(  'name' => __( 'Background size?', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				''        => __( 'None', 'contractor' ),
				'auto'    => __( 'Auto', 'contractor' ),
				'cover'   => __( 'Cover', 'contractor' ),
				'contain' => __( 'Contain', 'contractor' ),
			),
			'std'  => '',
			'id'   => 'footer-background-size',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( 'Footer copyright text', 'contractor' ),
			'type' => 'textarea',
			'id'   => 'footer-copyright-text',
			'std'  => __( 'R-theme - Design copyright &#169; 2014 KingkongThemes&#174; All rights reserved.', 'contractor' ),
			'desc' => __( 'HTML and shortcodes are allowed.', 'contractor' ),
		);

		/*-----------------------------------------------------------------------------------*/
		/* Offcanvas sidebar
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( 'Offcanvas sidebar', 'contractor' ),
			'type' => 'heading',
			'icon' => ADMIN_IMAGES . 'footer.png'
		);

		$of_options[] = array(  'name'   => __( 'Show/Hide Offcanvas sidebar', 'contractor' ),
			'id'   => 'offcanvas-turnon',
			'type' => 'switch',
			'std'  => true,
		);

		$of_options[] = array(  'name'   => __( 'Body swipe', 'contractor' ),
			'id'   => 'offcanvas-swipe',
			'type' => 'switch',
			'std'  => true,
		);

		$of_options[] = array(  'name' => __( 'Offcanvas sidebar position', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				'right'    => __( 'Right', 'contractor' ),
				'left'      => __( 'Left', 'contractor' ),
			),
			'std'  => '',
			'id'   => 'offcanvas-sidebar-position',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( 'Shown sidebar?', 'contractor' ),
			'type' => 'select',
			'options' => $sidebars,
			'id' => 'offcanvas-sidebar',
		);

		$of_options[] = array(  'name' => __( 'Background setting', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Background setting', 'contractor' ),
		);

		$of_options[] = array(  'name'   => __( 'Offcanvas sidebar background image', 'contractor' ),
			'id'   => 'offcanvas-sidebar-background-image',
			'type' => 'upload',
			'std'  => '',
		);

		$of_options[] = array(  'name' => __( 'Offcanvas sidebar background position?', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				''    => __( 'None', 'contractor' ),
				'left top'      => __( 'Left Top', 'contractor' ),
				'left center'   => __( 'Left Center', 'contractor' ),
				'left bottom'   => __( 'Left Bottom', 'contractor' ),
				'right top'     => __( 'Right Top', 'contractor' ),
				'right center'  => __( 'Right Center', 'contractor' ),
				'right bottom'  => __( 'Right Bottom', 'contractor' ),
				'center top'    => __( 'Center Top', 'contractor' ),
				'center center' => __( 'Center Center', 'contractor' ),
				'center bottom' => __( 'Center Bottom', 'contractor' ),
			),
			'std'  => '',
			'id'   => 'offcanvas-sidebar-background-position',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( 'Offcanvas sidebar background repeat?', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				''    => __( 'None', 'contractor' ),
				'no-repeat' => __( 'No repeat', 'contractor' ),
				'repeat'    => __( 'Repeat', 'contractor' ),
				'repeat-x'  => __( 'Repeat X', 'contractor' ),
				'repeat-y'  => __( 'Repeat Y', 'contractor' ),
			),
			'std'  => '',
			'id'  => 'offcanvas-sidebar-background-repeat',
			'desc'  => '',
		);

		$of_options[] = array(  'name' => __( 'Offcanvas sidebar background size?', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				''        => __( 'None', 'contractor' ),
				'auto'    => __( 'Auto', 'contractor' ),
				'cover'   => __( 'Cover', 'contractor' ),
				'contain' => __( 'Contain', 'contractor' ),
			),
			'std'  => '',
			'id'   => 'offcanvas-sidebar-background-size',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( 'Offcanvas sidebar background color', 'contractor' ),
			'type' => 'color',
			'id' => 'offcanvas-sidebar-background-color',
		);

		$of_options[] = array(  'name' => __( 'Offcanvas sidebar text color', 'contractor' ),
			'type' => 'color',
			'id' => 'offcanvas-sidebar-text-color',
		);

		$of_options[] = array(  'name' => __( 'Offcanvas sidebar custom css', 'contractor' ),
			'type' => 'textarea',
			'std'  => '',
			'id'   => 'offcanvas-sidebar-custom-css',
		);

		/*-----------------------------------------------------------------------------------*/
		/* Layout
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( 'Layout', 'contractor' ),
			'type' => 'heading',
			'icon' => ADMIN_IMAGES . 'layout.png'
		);
		/* Layout */
		$of_options[] = array(  'name' => __( 'Layout', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Layout', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Enable Boxed Layout', 'contractor' ),
			'type' => 'switch',
			'std'  => false,
			'id'   => 'boxed-layout',
		);

		$of_options[] = array(  'name' => __( 'Content Width (px)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 1170,
			'min'  => 940,
			'max'  => 1200,
			'step' => 10,
			'id'   => 'use-content-width',
			'desc' => __( 'You can choose content width in the range from 940px to 1200px.', 'contractor' ),
		);

		/* Titlebar */
		$of_options[] = array(  'name' => __( 'Titlebar', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Titlebar', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Titlebar layout', 'contractor' ),
			'type' => 'select',
			'std'  => 'justify',
			'options' => array(
				'justify' => __( 'Justify', 'contractor' ),
				'center'  => __( 'Center', 'contractor' ),
			),
			'id' => 'titlebar-layout',
		);

		$of_options[] = array(  'name' => __( 'Top padding', 'contractor' ),
			'type' => 'text',
			'std'  => '',
			'id'   => 'pading-top',
			'desc' => __( 'Unit: px. Eg: 10px;', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Bottom padding', 'contractor' ),
			'type' => 'text',
			'std'  => '',
			'id'   => 'pading-bottom',
			'desc' => __( 'Unit: px. Eg: 10px;', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Background image', 'contractor' ),
			'type' => 'media',
			'std'  => '',
			'id'   => 'background-image',
		);

		$of_options[] = array(  'name' => __( 'Background color', 'contractor' ),
			'type' => 'color',
			'std'  => '',
			'id'   => 'background-color',
		);

		$of_options[] = array(  'name' => __( 'Background position', 'contractor' ),
			'type' => 'select',
			'std'  => 'left',
			'options' => array(
				'left top'      => __( 'Left Top', 'contractor' ),
				'left center'   => __( 'Left Center', 'contractor' ),
				'left bottom'   => __( 'Left Bottom', 'contractor' ),
				'right top'     => __( 'Right Top', 'contractor' ),
				'right center'  => __( 'Right Center', 'contractor' ),
				'right bottom'  => __( 'Right Bottom', 'contractor' ),
				'center top'    => __( 'Center Top', 'contractor' ),
				'center center' => __( 'Center Center', 'contractor' ),
				'center bottom' => __( 'Center Bottom', 'contractor' ),
			),
			'id' => 'background-position',
		);

		$of_options[] = array(  'name' => __( 'Background repeat', 'contractor' ),
			'type' => 'select',
			'std'  => 'repeat',
			'options' => array(
				'no-repeat' => __( 'No Repeat', 'contractor' ),
				'repeat'    => __( 'Repeat', 'contractor' ),
				'repeat-x'  => __( 'Repeat X', 'contractor' ),
				'repeat-y'  => __( 'Repeat Y', 'contractor' ),
			),
			'id' => 'background-repeat',
		);

		$of_options[] = array(  'name' => __( 'Background parallax', 'contractor' ),
			'type' => 'switch',
			'std'  => false,
			'id'   => 'background-parallax',
		);

		$of_options[] = array(  'name' => __( 'Titlebar color', 'contractor' ),
			'type' => 'color',
			'std'  => '',
			'id'   => 'titlebar-title-color',
		);

		$of_options[] = array(  'name' => __( 'Titlebar shadow opacity', 'contractor' ),
			'type' => 'sliderui',
			'min'  => 0,
			'max'  => 10,
			'std'  => 5,
			'step' => 1,
			'id'   => 'titlebar-shadow-opacity',
		);

		$of_options[] = array(  'name' => __( 'Titlebar overlay opacity', 'contractor' ),
			'type' => 'sliderui',
			'min'  => 0,
			'max'  => 10,
			'std'  => 0,
			'step' => 1,
			'id'   => 'titlebar-overlay-opacity',
		);

		$of_options[] = array(  'name' => __( 'Titlebar clipmask opacity', 'contractor' ),
			'type' => 'sliderui',
			'min'  => 0,
			'max'  => 10,
			'std'  => 0,
			'step' => 1,
			'id'   => 'titlebar-clipmask-opacity',
		);

		$of_options[] = array(  'name' => __( 'Titlebar custom content', 'contractor' ),
			'type' => 'textarea',
			'std'  => '',
			'id'   => 'titlebar-custom-content',
		);

		/*-----------------------------------------------------------------------------------*/
		/* Styling
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( 'Style', 'contractor' ),
			'type' => 'heading',
			'icon' => ADMIN_IMAGES . 'icon-paint.png'
		);


		$of_options[] = array(  'name' => __( 'Primary Color', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Primary Color', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Primary color', 'contractor' ),
			'type' => 'color',
			'std'  => '#ffbe2a',
			'id'   => 'primary-color',
			'desc' => __( 'Primary color is the main color of site.', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Heading color', 'contractor' ),
			'type' => 'color',
			'std'  => '#4f4f4f',
			'id'   => 'heading-color',
			'desc' => __( '', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Text color', 'contractor' ),
			'type' => 'color',
			'std'  => '',
			'id'   => 'text-color',
			'desc' => __( '', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Footer background color', 'contractor' ),
			'type' => 'color',
			'std'  => '',
			'id'   => 'footer-bg-color',
			'desc' => __( '', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Links', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Links', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Link color', 'contractor' ),
			'type' => 'color',
			'std'  => '#ffbe2a',
			'id'   => 'link-color',
		);

		$of_options[] = array(  'name' => __( 'Link hover color', 'contractor' ),
			'type' => 'color',
			'std'  => '',
			'id'   => 'link-hover-color',
		);

		$of_options[] = array(  'name' => __( 'Footer color', 'contractor' ),
			'type' => 'color',
			'std'  => '',
			'id'   => 'footer-color',
		);

		$of_options[] = array(  'name' => __( 'Footer link color', 'contractor' ),
			'type' => 'color',
			'std'  => '',
			'id'   => 'footer-link-color',
		);

		$of_options[] = array(  'name' => __( 'Menu colors', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Menu colors', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Main menu color', 'contractor' ),
			'type' => 'color',
			'std'  => '#767676',
			'id'   => 'main-menu-color',
		);

		$of_options[] = array(  'name' => __( 'Sub menu color', 'contractor' ),
			'type' => 'color',
			'std'  => '#767676',
			'id'   => 'sub-menu-color',
		);


		/*-----------------------------------------------------------------------------------*/
		/* Typography
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( 'Typography', 'contractor' ),
			'type' => 'heading',
			'icon' => ADMIN_IMAGES . 'mac-smz-icon.gif'
		);

		$of_options[] = array(  'name' => __( 'Font family', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Font family', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Body font', 'contractor' ),
			'desc' => __( 'You can choose a normal font or Google font.', 'contractor' ),
			'id'   => 'body-font',
			'std'  => 'Roboto',
			'type' => 'select_google_font',
			'preview'  => array(
				'text' => 'This is the preview!', //this is the text from preview box
				'size' => '30px' //this is the text size from preview box
			),
			'options' => k2t_fonts_array(),
		);

		$of_options[] = array(  'name' => __( 'Heading font', 'contractor' ),
			'desc' => __( 'You can choose a normal font or Google font', 'contractor' ),
			'id'   => 'heading-font',
			'std'  => 'Dosis',
			'type' => 'select_google_font',
			'preview' => array(
				'text' => 'This is the preview!', //this is the text from preview box
				'size' => '30px' //this is the text size from preview box
			),
			'options' => k2t_fonts_array(),
		);

		$of_options[] = array(  'name' => __( 'Navigation font', 'contractor' ),
			'desc' => __( 'You can choose a normal font or Google font', 'contractor' ),
			'id'   => 'mainnav-font',
			'std'  => 'Dosis',
			'type' => 'select_google_font',
			'preview' => array(
				'text' => 'This is the preview!', //this is the text from preview box
				'size' => '30px' //this is the text size from preview box
			),
			'options' => k2t_fonts_array(),
		);

		$of_options[] = array(  'name' => __( 'General font size', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'General font size', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Body font size (px)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 14,
			'min'  => 8,
			'max'  => 28,
			'step' => 1,
			'id'   => 'body-size',
		);

		$of_options[] = array(  'name' => __( 'Main navigation font size (px)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 12,
			'min'  => 9,
			'max'  => 24,
			'step' => 1,
			'id'   => 'mainnav-size',
		);

		$of_options[] = array(  'name' => __( 'Submenu of Main navigation font size (px)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 11,
			'min'  => 9,
			'max'  => 24,
			'step' => 1,
			'id'   => 'submenu-mainnav-size',
		);

		$of_options[] = array(  'name' => __( 'Titlebar title font size (px)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 20,
			'min'  => 14,
			'max'  => 120,
			'step' => 1,
			'id'   => 'titlebar-title-size',
		);

		$of_options[] = array(  'name' => __( 'Headings font size', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Headings font size', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'H1 font size (px)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 32,
			'min'  => 20,
			'max'  => 80,
			'step' => 1,
			'id'   => 'h1-size',
		);

		$of_options[] = array(  'name' => __( 'H2 font size (px)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 26,
			'min'  => 16,
			'max'  => 64,
			'step' => 1,
			'id'   => 'h2-size',
		);

		$of_options[] = array(  'name' => __( 'H3 font size (px)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 18,
			'min'  => 12,
			'max'  => 48,
			'step' => 1,
			'id'   => 'h3-size',
		);

		$of_options[] = array(  'name' => __( 'H4 font size (px)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 16,
			'min'  => 8,
			'max'  => 32,
			'step' => 1,
			'id'   => 'h4-size',
		);

		$of_options[] = array(  'name' => __( 'H5 font size (px)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 12,
			'min'  => 8,
			'max'  => 30,
			'step' => 1,
			'id'   => 'h5-size',
		);

		$of_options[] = array(  'name' => __( 'H6 font size (px)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 10,
			'min'  => 8,
			'max'  => 30,
			'step' => 1,
			'id'   => 'h6-size',
		);

		$of_options[] = array(  'name' => __( 'Font type', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Font type', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Navigation text transform', 'contractor' ),
			'desc' => __( 'Select navigation text transform.', 'contractor' ),
			'type' => 'select',
			'id'   => 'mainnav-text-transform',
			'std'  => 'uppercase',
			'options' => array (
				'none'       => __( 'None', 'contractor' ),
				'capitalize' => __( 'Capitalize', 'contractor' ),
				'uppercase'  => __( 'Uppercase', 'contractor' ),
				'lowercase'  => __( 'Lowercase', 'contractor' ),
				'inherit'    => __( 'Inherit', 'contractor' ),
			),
		);

		$of_options[] = array(  'name' => __( 'Navigation font weight', 'contractor' ),
			'desc' => __( 'Select navigation font weight.', 'contractor' ),
			'type' => 'select',
			'id'   => 'mainnav-font-weight',
			'std'  => '400',
			'options' => array (
				'100' => __( '100', 'contractor' ),
				'200' => __( '200', 'contractor' ),
				'300' => __( '300', 'contractor' ),
				'400' => __( '400', 'contractor' ),
				'500' => __( '500', 'contractor' ),
				'600' => __( '600', 'contractor' ),
				'700' => __( '700', 'contractor' ),
				'800' => __( '800', 'contractor' ),
				'900' => __( '900', 'contractor' ),
			),
		);

		/*-----------------------------------------------------------------------------------*/
		/* Blog
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( 'Blog', 'contractor' ),
			'type' => 'heading',
			'icon' => ADMIN_IMAGES . 'icon-docs.png'
		);

		$of_options[] = array(  'name' => __( 'Blog layout', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Blog layout', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Blog style', 'contractor' ),
			'type' => 'select',
			'id'   => 'blog-style',
			'options' => array (
				'classic' => __( 'Classic', 'contractor' ),
				'masonry' => __( 'Masonry', 'contractor' ),
			),
			'std'       => 'classic',
			'desc'      => __( 'Select blog style.', 'contractor' ),
			'logicstic' => true,
		);

		$of_options[] = array(  'name' => __( 'Columns', 'contractor' ),
			'type'    => 'select',
			'id'      => 'blog-masonry-column',
			'options' => array (
				'column-2' => __( '2 Columns', 'contractor' ),
				'column-3' => __( '3 Columns', 'contractor' ),
				'column-4' => __( '4 Columns', 'contractor' ),
				'column-5' => __( '5 Columns', 'contractor' )
			),
			'std'  => 'column-3',
			'desc' => __( 'Select column for layout masonry.', 'contractor' ),
			'conditional_logic' => array(
				'field'    => 'blog-style',
				'value'    => 'masonry',
			),
		);

		$of_options[] = array(  'name' => __( 'Full width', 'contractor' ),
			'type' => 'switch',
			'std'  => false,
			'id'   => 'blog-masonry-full-width',
			'desc' => __( 'Enable full width layout for masonry blog.', 'contractor' ),
			'conditional_logic' => array(
				'field'    => 'blog-style',
				'value'    => 'masonry',
			),
		);

		$of_options[] = array(  'name' => __( 'Blog sidebar position', 'contractor' ),
			'type'    => 'select',
			'id'      => 'blog-sidebar-position',
			'options' => array (
				'right_sidebar' => __( 'Right Sidebar', 'contractor' ),
				'left_sidebar'  => __( 'Left Sidebar', 'contractor' ),
				'no_sidebar'    => __( 'No Sidebar', 'contractor' )
			),
			'std'  => 'right_sidebar',
			'desc' => __( 'Select blog sidebar position.', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Blog Options', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Blog Options', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Content or excerpt', 'contractor' ),
			'type'    => 'select',
			'id'      => 'blog-display',
			'options' => array (
				'excerpts' => __( 'Excerpt', 'contractor' ),
				'contents' => __( 'Content', 'contractor' ) ),
			'std'  => 'excerpt',
			'desc' => __( 'Select display post content or excerpt on the blog.', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Excerpt length (words)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 40,
			'step' => 1,
			'min'  => 10,
			'max'  => 80,
			'id'   => 'excerpt-length',
		);

		$of_options[] = array(  'name' => __( 'Infinite Scroll', 'contractor' ),
			'type'    => 'select',
			'id'      => 'pagination-type',
			'options' => array (
				'pagination_number' => __( 'False', 'contractor' ),
				'pagination_ajax'   => __( 'True', 'contractor' )
			),
			'std' => 'pagination_number'
		);

		$of_options[] = array(  'name' => __( 'Show/Hide categories filter', 'contractor' ),
			'type' => 'switch',
			'id'   => 'blog-categories-filter',
			'std'  => true
		);

		$of_options[] = array(  'name' => __( 'Show/Hide title link?', 'contractor' ),
			'type' => 'switch',
			'id'   => 'blog-post-link',
			'std'  => true
		);

		$of_options[] = array(  'name' => __( 'Show/Hide post date', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-date',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide the number of comments', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-number-comment',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide categories', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-categories',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide author', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-author',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide excerpt', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-excerpt',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide "Reamore" link', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-readmore',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide tags', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-tags',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide social share', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-social-share',
		);

		/* Social Impact */
		$of_options[] = array(  'name' => __( 'Social', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Social', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Show/Hide social buttons', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-social',
			'desc' => __( 'Turn it OFF if you do not want to display social buttons', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Facebook?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-social-facebook',
		);

		$of_options[] = array(  'name' => __( 'Twitter?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-social-twitter',
		);

		$of_options[] = array(  'name' => __( 'Google+?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-social-google-plus',
		);

		$of_options[] = array(  'name' => __( 'Linkedin?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-social-linkedin',
		);

		$of_options[] = array(  'name' => __( 'Tumblr?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-social-tumblr',
		);

		$of_options[] = array(  'name' => __( 'Email?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'blog-social-email',
		);

		/*-----------------------------------------------------------------------------------*/
		/* Single
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( 'Single', 'contractor' ),
			'type' => 'heading',
			'icon' => ADMIN_IMAGES . 'icon-edit.png'
		);

		/* Featured Image */
		$of_options[] = array(  'name' => __( 'Single Post Layout', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Single Post Layout', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Single post layout', 'contractor' ),
			'type' => 'select',
			'id'   => 'single-layout',
			'options' => array (
				'right_sidebar' => __( 'Right Sidebar (default)', 'contractor' ),
				'left_sidebar'  => __( 'Left Sidebar', 'contractor' ),
				'no_sidebar'    => __( 'No Sidebar', 'contractor' ) ),
			'std'  => 'right_sidebar',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( 'Single custom sidebar', 'contractor' ),
			'type' => 'text',
			'std'  => '',
			'id'   => 'single-custom-sidebar',
			'desc'   => '',
		);

		/* Meta */
		$of_options[] = array(  'name' => __( 'Meta', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Meta', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Show/Hide Categories', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-categories',
			'desc' => __( 'Turn OFF if you don\'t want to display categories on single post', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Show/Hide post date', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-post-date',
			'desc' => __( 'Turn OFF if you don\'t want to display post date on single post', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Show/Hide Next / Previous links?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-nav',
			'desc' => __( 'Turn OFF if you don\'t want to display post navigation links on single post', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Show/Hide tags', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-tags',
			'desc' => __( 'Turn OFF if you don\'t want to display post tags on single post', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Show/Hide authorbox', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-authorbox',
			'desc' => __( 'Turn OFF if you don\'t want to display author box on single post', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Show/Hide related post', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-related-post',
			'desc' => __( 'Turn OFF if you don\'t want to display related post on single post', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Related post title', 'contractor' ),
			'type' => 'text',
			'std'  => 'Other projects',
			'id'   => 'single-related-post-title',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide comment form', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-commnet-form',
			'desc' => __( 'Turn OFF if you don\'t want to display comment form on single post', 'contractor' ),
		);

		/* Titlebar */
		$of_options[] = array(  'name' => __( 'Titlebar', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Titlebar', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Titlebar layout', 'contractor' ),
			'type' => 'select',
			'std'  => 'justify',
			'options' => array(
				'justify' => __( 'Justify', 'contractor' ),
				'center'  => __( 'Center', 'contractor' ),
			),
			'id' => 'single-titlebar-layout',
		);

		$of_options[] = array(  'name' => __( 'Top padding', 'contractor' ),
			'type' => 'text',
			'std'  => '',
			'id'   => 'single-pading-top',
			'desc' => __( 'Unit: px. Eg: 10px;', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Bottom padding', 'contractor' ),
			'type' => 'text',
			'std'  => '',
			'id'   => 'single-pading-bottom',
			'desc' => __( 'Unit: px. Eg: 10px;', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Background image', 'contractor' ),
			'type' => 'media',
			'std'  => '',
			'id'   => 'single-background-image',
		);

		$of_options[] = array(  'name' => __( 'Background color', 'contractor' ),
			'type' => 'color',
			'std'  => '',
			'id'   => 'single-background-color',
		);

		$of_options[] = array(  'name' => __( 'Background repeat', 'contractor' ),
			'type' => 'select',
			'std'  => 'no-repeat',
			'options' => array(
				'no-repeat' => __( 'No Repeat', 'contractor' ),
				'repeat'    => __( 'Repeat', 'contractor' ),
				'repeat-x'  => __( 'Repeat X (width)', 'contractor' ),
				'repeat-y'  => __( 'Repeat Y (height)', 'contractor' ),
			),
			'id' => 'single-background-repeat',
		);

		$of_options[] = array(  'name' => __( 'Background position', 'contractor' ),
			'type' => 'select',
			'std'  => 'left top',
			'options' => array(
				'left top'      => __( 'Left Top', 'contractor' ),
				'left center'   => __( 'Left Center', 'contractor' ),
				'left bottom'   => __( 'Left Bottom', 'contractor' ),
				'right top'     => __( 'Right Top', 'contractor' ),
				'right center'  => __( 'Right Center', 'contractor' ),
				'right bottom'  => __( 'Right Bottom', 'contractor' ),
				'center top'    => __( 'Center Top', 'contractor' ),
				'center center' => __( 'Center Center', 'contractor' ),
				'center bottom' => __( 'Center Bottom', 'contractor' ),
			),
			'id' => 'single-background-position',
		);

		$of_options[] = array(  'name' => __( 'Background parallax', 'contractor' ),
			'type' => 'switch',
			'std'  => false,
			'id'   => 'single-background-parallax',
		);

		$of_options[] = array(  'name' => __( 'Titlebar shadow opacity', 'contractor' ),
			'type' => 'sliderui',
			'min'  => 0,
			'max'  => 10,
			'std'  => 5,
			'step' => 1,
			'id'   => 'single-titlebar-shadow-opacity',
		);

		$of_options[] = array(  'name' => __( 'Titlebar overlay opacity', 'contractor' ),
			'type' => 'sliderui',
			'min'  => 0,
			'max'  => 10,
			'std'  => 0,
			'step' => 1,
			'id'   => 'single-titlebar-overlay-opacity',
		);

		$of_options[] = array(  'name' => __( 'Titlebar clipmask opacity', 'contractor' ),
			'type' => 'sliderui',
			'min'  => 0,
			'max'  => 10,
			'std'  => 0,
			'step' => 1,
			'id'   => 'single-titlebar-clipmask-opacity',
		);

		$of_options[] = array(  'name' => __( 'Titlebar custom content', 'contractor' ),
			'type' => 'textarea',
			'std'  => '',
			'id'   => 'single-titlebar-custom-content',
		);

		/* Social Impact */
		$of_options[] = array(  'name' => __( 'Social', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Social', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Show/Hide social buttons', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-social',
			'desc' => __( 'Turn it OFF if you do not want to display social buttons', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Facebook?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-social-facebook',
		);

		$of_options[] = array(  'name' => __( 'Twitter?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-social-twitter',
		);

		$of_options[] = array(  'name' => __( 'Google+?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-social-google-plus',
		);

		$of_options[] = array(  'name' => __( 'Linkedin?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-social-linkedin',
		);

		$of_options[] = array(  'name' => __( 'Tumblr?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-social-tumblr',
		);

		$of_options[] = array(  'name' => __( 'Email?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'single-social-email',
		);

		/*-----------------------------------------------------------------------------------*/
		/* Portfolio
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( 'Portfolio', 'contractor' ),
			'type' => 'heading',
			'icon' => ADMIN_IMAGES . 'work.png'
		);

		/* Portfolio Category */
		$of_options[] = array(  'name' => __( 'Portfolio Category', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Portfolio Category', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Portfolio category Slug', 'contractor' ),
			'type' => 'text',
			'std'  => '',
			'id'   => 'portfolio-category-slug',
		);

		$of_options[] = array(  'name' => __( 'Layout', 'contractor' ),
			'type' => 'select',
			'options' => array(
				'right_sidebar' => __( 'Right Sidebar', 'contractor' ),
				'left_sidebar'  => __( 'Left Sidebar', 'contractor' ),
				'no_sidebar'    => __( 'Fullwidth', 'contractor' ),
				'full_width'    => __( '100% Width', 'contractor' ),
			),
			'std' => 'right_sidebar',
			'id'  => 'portfolio-category-layout',
		);

		$of_options[] = array(  'name' => __( 'Sidebar name', 'contractor' ),
			'type' => 'text',
			'std'  => '',
			'id'   => 'portfolio-custom-sidebar',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide titlebar', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'portfolio-display-titlebar',
		);

		$of_options[] = array(  'name' => __( 'Style', 'contractor' ),
			'type' => 'select',
			'options' => array(
				'gallery_masonry' => __( 'Gallery Masonry', 'contractor' ),
				'gallery_grid'    => __( 'Gallery Grid', 'contractor' ),
				'text_masonry'    => __( 'Text Masonry', 'contractor' ),
				'text_grid'       => __( 'Text Grid', 'contractor' ),
			),
			'std' => 'gallery_masonry',
			'id'  => 'portfolio-category-style',
		);

		$of_options[] = array(  'name' => __( 'Child Style', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				'none'                       => __( 'None', 'contractor' ),
				'gallery_masonry_free_style' => __( 'Gallery masonry free style', 'contractor' ),
				'gallery_grid_no_padding'    => __( 'Gallery grid no padding', 'contractor' ),
			),
			'std' => 'none',
			'id'  => 'portfolio-category-child-style',
		);

		$of_options[] = array(  'name' => __( 'Column?', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				'2_columns'  => __( '2 columns', 'contractor' ),
				'3_columns'  => __( '3 columns', 'contractor' ),
				'4_columns'  => __( '4 columns', 'contractor' ),
				'5_columns'  => __( '5 columns', 'contractor' ),
			),
			'std' => '3_columns',
			'id'  => 'portfolio-category-column',
		);

		$of_options[] = array(  'name' => __( 'Number of projects per page', 'contractor' ),
			'type' => 'text',
			'std'  => 9,
			'id'   => 'portfolio-category-number',
			'desc' => __( 'Fill out -1 if you want to display ALL projects.', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Display Portfolio Filter?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'portfolio-display-filter',
		);

		$of_options[] = array(  'name' => __( 'Portfolio Infinite Scroll', 'contractor' ),
			'type'    => 'select',
			'options' => array(
				'pagination_number' => __( 'False', 'contractor' ),
				'pagination_ajax'   => __( 'True', 'contractor' ),
			),
			'std' => 'pagination_number',
			'id'  => 'portfolio-category-pagination-type',
		);

		/* Single Portfolio */
		$of_options[] = array(  'name' => __( 'Single Portfolio', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Single Portfolio', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Portfolio Slug', 'contractor' ),
			'type' => 'text',
			'std'  => '',
			'id'   => 'portfolio-slug',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide related portfolio', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'portfolio-related-post',
			'desc' => __( 'Turn OFF if you don\'t want to display related post on single portfolio', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Related portfolio title', 'contractor' ),
			'type' => 'text',
			'std'  => 'Related Projects',
			'id'   => 'portfolio-related-post-title',
			'desc' => '',
		);
		$of_options[] = array(  'name' => __( 'Related portfolio sub title', 'contractor' ),
			'type' => 'text',
			'std'  => '',
			'id'   => 'single-related-post-sub-title',
			'desc' => '',
		);

		/*-----------------------------------------------------------------------------------*/
		/* WooCommerce
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( 'WooCommerce', 'contractor' ),
			'type' => 'heading',
			'icon' => ADMIN_IMAGES . 'cart.png'
		);

		/* Menu */
		$of_options[] = array(  'name' => __( 'Cart menu icon', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Cart menu icon', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Should Empty Cart Link To?', 'contractor' ),
			'type' => 'select',
			'std'  => 'cart',
			'options' => array(
				'cart'   => __( 'Link to Cart page', 'contractor' ),
				'shop'   => __( 'Link to Shop page', 'contractor' ),
				'custom' => __( 'Link to a custom URL', 'contractor' ),
				'hide'   => __( 'Not display', 'contractor' ),
			),
			'id' => 'shop-cart-menu-empty',
		);

		$of_options[] = array(  'name' => __( 'Custom link when cart is empty', 'contractor' ),
			'type' => 'text',
			'std'  => '',
			'id'   => 'shop-cart-menu-empty-link',
			'desc' => __( 'If left blank, it\'ll link to the shop page. If the cart is not empty, it\'ll link to the Cart page.', 'contractor' ),
		);

		/* Shop Archive Page */
		$of_options[] = array(  'name' => __( 'Shop Archive', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Shop Archive', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Shop Archive Template', 'contractor' ),
			'type' => 'select',
			'std'  => 'right_sidebar',
			'options' => array(
				'right_sidebar' => __( 'Right Sidebar', 'contractor' ),
				'left_sidebar'  => __( 'Left Sidebar', 'contractor' ),
				'no_sidebar'    => __( 'No Sidebar', 'contractor' ),
			),
			'id' => 'shop-template',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide WooCommerce Breadcrumb', 'contractor' ),
			'type' => 'switch',
			'std'  => false,
			'id'   => 'shop-breadcrumb',
		);

		$of_options[] = array(  'name' => __( 'Show "sorting"?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'shop-display-sorting',
		);

		$of_options[] = array(  'name' => __( 'Show "result count"?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'shop-display-result-count',
		);

		$of_options[] = array(  'name' => __( 'Number of columns (default)', 'contractor' ),
			'type' => 'sliderui',
			'std'  => 3,
			'min'  => 3,
			'max'  => 4,
			'id'   => 'shop-products-column',
		);

		$of_options[] = array(  'name' => __( 'Number of products per page', 'contractor' ),
			'type' => 'text',
			'std'  => '',
			'id'   => 'shop-products-per-page',
			'desc' => __( 'Fill it -1 if you want to display all products.', 'contractor' ),
		);

		/* Single Product */
		$of_options[] = array(  'name' => __( 'Single Product', 'contractor' ),
			'type' => 'info',
			'std'  => __( 'Single Product', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Template', 'contractor' ),
			'type' => 'select',
			'std'  => 'right_sidebar',
			'options' => array(
				'right_sidebar' => __( 'Right Sidebar', 'contractor' ),
				'left_sidebar'  => __( 'Left Sidebar', 'contractor' ),
				'no_sidebar'    => __( 'No Sidebar', 'contractor' ),
			),
			'id' => 'shop-single-template',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide share your products?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'shop-single-display-share-products',
		);

		$of_options[] = array(  'name' => __( 'Show/Hide related products?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'shop-single-display-related-products',
			'logicstic' => true,
		);

		$of_options[] = array(  'name' => __( 'Number of related products to show on desktop', 'contractor' ),
			'type' => 'sliderui',
			'min'  => 2,
			'max'  => 5,
			'std'  => 4,
			'step' => 1,
			'id'   => 'shop-related-products-number',
			'conditional_logic' => array(
				'field' => 'shop-single-display-related-products',
				'value' => 'switch-1',
			),
		);

		$of_options[] = array(  'name' => __( 'Number of related products to show on tablets (<=768px)', 'contractor' ),
			'type' => 'sliderui',
			'min'  => 1,
			'max'  => 3,
			'std'  => 2,
			'step' => 1,
			'id'   => 'shop-related-products-number-tablet',
			'conditional_logic' => array(
				'field' => 'shop-single-display-related-products',
				'value' => 'switch-1',
			),
		);

		$of_options[] = array(  'name' => __( 'Number of related products to show on mobile (<=320px)', 'contractor' ),
			'type' => 'sliderui',
			'min'  => 1,
			'max'  => 3,
			'std'  => 1,
			'step' => 1,
			'id'   => 'shop-related-products-number-mobile',
			'conditional_logic' => array(
				'field' => 'shop-single-display-related-products',
				'value' => 'switch-1',
			),
		);

		/*-----------------------------------------------------------------------------------*/
		/* 404 Page
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( '404 Page', 'contractor' ),
			'type' => 'heading',
			'icon' => ADMIN_IMAGES . '404.png'
		);

		$of_options[] = array(  'name' => __( '404 page', 'contractor' ),
			'type' => 'info',
			'std'  => __( '404 page', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( '404 Title', 'contractor' ),
			'type' => 'text',
			'std'  => 'error',
			'id'   => '404-title',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( '404 Image', 'contractor' ),
			'type' => 'media',
			'std'  => get_template_directory_uri() . '/assets/img/bg_404.png',
			'id'   => '404-image',
			'desc' => '',
		);

		$of_options[] = array(  'name' => __( '404 Custom Text', 'contractor' ),
			'type' => 'textarea',
			'id'   => '404-text',
			'std'  => __( ' Sorry, this page could not be found. We couldn\'t find the page you\'re looking for. ', 'contractor' ),
			'desc' => __( 'The message you want to show when they got to 404 page. HTML is allowed.', 'contractor' ),
		);

		/*-----------------------------------------------------------------------------------*/
		/* Social Icons
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name' => __( 'Social', 'contractor' ),
			'type'  => 'heading',
			'icon'  => ADMIN_IMAGES . 'twitter.png'
		);

		$of_options[] = array(  'name' => __( 'Target', 'contractor' ),
			'type' => 'select',
			'std'  => '_blank',
			'options' => array(
				'_self'  => __( 'Same tab', 'contractor' ),
				'_blank' => __( 'New tab', 'contractor' ),
			),
			'id' => 'social-target',
		);

		$of_options[] = array(  'name' => __( 'Twitter username?', 'contractor' ),
			'type' => 'text',
			'std'  => 'themelead',
			'id'   => 'twitter-username',
			'desc' => __( 'Twitter username used for tweet share buttons.', 'contractor' ),
		);

		$of_options[] = array(  'name' => __( 'Icon title?', 'contractor' ),
			'type' => 'switch',
			'std'  => true,
			'id'   => 'social-title',
			'desc' => __( 'Turn it ON if you want to display social icon titles like Facebook, Google+, Twitter... when hover icons.', 'contractor' ),
		);


		foreach ( k2t_social_array() as $s => $c ):

			$of_options[] = array(  'name' => $c,
				'type' => 'text',
				'std'  => '',
				'id'   => 'social-' . $s,
			);

		endforeach;

		/*-----------------------------------------------------------------------------------*/
		/* Backup Options */
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name'   => __( 'Backup Options', 'contractor' ),
			'type'  => 'heading',
			'icon'  => ADMIN_IMAGES . 'icon-slider.png'
		);

		$of_options[] = array(  'name'   => __( 'Backup and Restore Options', 'contractor' ),
			'id'   => 'of_backup',
			'std'  => '',
			'type' => 'backup',
			'desc' => __( 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need back.', 'contractor' ),
		);

		$of_options[] = array(  'name'   => __( 'Transfer Theme Options Data', 'contractor' ),
			'id'   => 'of_transfer',
			'std'  => '',
			'type' => 'transfer',
			'desc' => __( 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another installation, replace the data in the text box with the one from another installation and click "Import Options".', 'contractor' ),
		);
		
		/*-----------------------------------------------------------------------------------*/
		/* One Click Install */
		/*-----------------------------------------------------------------------------------*/
		$of_options[] = array(  'name'   => __( 'One Click Install', 'contractor' ),
			'type'  => 'heading',
			'icon'  => ADMIN_IMAGES . 'icon-slider.png'
		);
		$of_options[] = array(  'name'   => __( 'Transfer Theme Options Data', 'contractor' ),
			'id'   => 'k2t_advance_backup',
			'std'  => '',
			'type' => 'k2t_advance_backup',
		);

	}//End function: of_options()
}//End chack if function exists: of_options()
?>
