<?php
/**
 * Alters the default functionality of the VC.
 *
 * @package Contractor
 * @author  K2T Team
 * @link	http://www.kingkongthemes.com
 */

/**
 * Removes tabs such as the "Design Options" from the Visual Composer Settings
 *
 * @package Contractor
 */
if ( class_exists( 'Vc_Manager' ) ) :
	vc_set_as_theme( true );
endif;

/*-------------------------------------------------------------------
	Map for Visual Composer Shortcode.
--------------------------------------------------------------------*/
if ( class_exists( 'Vc_Manager' ) ) :
	if ( ! function_exists( 'k2t_vc_map_shortcodes' ) ) :

		function k2t_vc_map_shortcodes() {

			$k2t_icon = array( '', 'fa fa-glass', 'fa fa-music', 'fa fa-search', 'fa fa-envelope-o', 'fa fa-heart', 'fa fa-star', 'fa fa-star-o', 'fa fa-user', 'fa fa-film', 'fa fa-th-large', 'fa fa-th', 'fa fa-th-list', 'fa fa-check', 'fa fa-remove', 'fa fa-close', 'fa fa-times', 'fa fa-search-plus', 'fa fa-search-minus', 'fa fa-power-off', 'fa fa-signal', 'fa fa-gear', 'fa fa-cog', 'fa fa-trash-o', 'fa fa-home', 'fa fa-file-o', 'fa fa-clock-o', 'fa fa-road', 'fa fa-download', 'fa fa-arrow-circle-o-down', 'fa fa-arrow-circle-o-up', 'fa fa-inbox', 'fa fa-play-circle-o', 'fa fa-rotate-right', 'fa fa-repeat', 'fa fa-refresh', 'fa fa-list-alt', 'fa fa-lock', 'fa fa-flag', 'fa fa-headphones', 'fa fa-volume-off', 'fa fa-volume-down', 'fa fa-volume-up', 'fa fa-qrcode', 'fa fa-barcode', 'fa fa-tag', 'fa fa-tags', 'fa fa-book', 'fa fa-bookmark', 'fa fa-print', 'fa fa-camera', 'fa fa-font', 'fa fa-bold', 'fa fa-italic', 'fa fa-text-height', 'fa fa-text-width', 'fa fa-align-left', 'fa fa-align-center', 'fa fa-align-right', 'fa fa-align-justify', 'fa fa-list', 'fa fa-dedent', 'fa fa-outdent', 'fa fa-indent', 'fa fa-video-camera', 'fa fa-photo', 'fa fa-image', 'fa fa-picture-o', 'fa fa-pencil', 'fa fa-map-marker', 'fa fa-adjust', 'fa fa-tint', 'fa fa-edit', 'fa fa-pencil-square-o', 'fa fa-share-square-o', 'fa fa-check-square-o', 'fa fa-arrows', 'fa fa-step-backward', 'fa fa-fast-backward', 'fa fa-backward', 'fa fa-play', 'fa fa-pause', 'fa fa-stop', 'fa fa-forward', 'fa fa-fast-forward', 'fa fa-step-forward', 'fa fa-eject', 'fa fa-chevron-left', 'fa fa-chevron-right', 'fa fa-plus-circle', 'fa fa-minus-circle', 'fa fa-times-circle', 'fa fa-check-circle', 'fa fa-question-circle', 'fa fa-info-circle', 'fa fa-crosshairs', 'fa fa-times-circle-o', 'fa fa-check-circle-o', 'fa fa-ban', 'fa fa-arrow-left', 'fa fa-arrow-right', 'fa fa-arrow-up', 'fa fa-arrow-down', 'fa fa-mail-forward', 'fa fa-share', 'fa fa-expand', 'fa fa-compress', 'fa fa-plus', 'fa fa-minus', 'fa fa-asterisk', 'fa fa-exclamation-circle', 'fa fa-gift', 'fa fa-leaf', 'fa fa-fire', 'fa fa-eye', 'fa fa-eye-slash', 'fa fa-warning', 'fa fa-exclamation-triangle', 'fa fa-plane', 'fa fa-calendar', 'fa fa-random', 'fa fa-comment', 'fa fa-magnet', 'fa fa-chevron-up', 'fa fa-chevron-down', 'fa fa-retweet', 'fa fa-shopping-cart', 'fa fa-folder', 'fa fa-folder-open', 'fa fa-arrows-v', 'fa fa-arrows-h', 'fa fa-bar-chart-o', 'fa fa-bar-chart', 'fa fa-twitter-square', 'fa fa-facebook-square', 'fa fa-camera-retro', 'fa fa-key', 'fa fa-gears', 'fa fa-cogs', 'fa fa-comments', 'fa fa-thumbs-o-up', 'fa fa-thumbs-o-down', 'fa fa-star-half', 'fa fa-heart-o', 'fa fa-sign-out', 'fa fa-linkedin-square', 'fa fa-thumb-tack', 'fa fa-external-link', 'fa fa-sign-in', 'fa fa-trophy', 'fa fa-github-square', 'fa fa-upload', 'fa fa-lemon-o', 'fa fa-phone', 'fa fa-square-o', 'fa fa-bookmark-o', 'fa fa-phone-square', 'fa fa-twitter', 'fa fa-facebook', 'fa fa-github', 'fa fa-unlock', 'fa fa-credit-card', 'fa fa-rss', 'fa fa-hdd-o', 'fa fa-bullhorn', 'fa fa-bell', 'fa fa-certificate', 'fa fa-hand-o-right', 'fa fa-hand-o-left', 'fa fa-hand-o-up', 'fa fa-hand-o-down', 'fa fa-arrow-circle-left', 'fa fa-arrow-circle-right', 'fa fa-arrow-circle-up', 'fa fa-arrow-circle-down', 'fa fa-globe', 'fa fa-wrench', 'fa fa-tasks', 'fa fa-filter', 'fa fa-briefcase', 'fa fa-arrows-alt', 'fa fa-group', 'fa fa-users', 'fa fa-chain', 'fa fa-link', 'fa fa-cloud', 'fa fa-flask', 'fa fa-cut', 'fa fa-scissors', 'fa fa-copy', 'fa fa-files-o', 'fa fa-paperclip', 'fa fa-save', 'fa fa-floppy-o', 'fa fa-square', 'fa fa-navicon', 'fa fa-reorder', 'fa fa-bars', 'fa fa-list-ul', 'fa fa-list-ol', 'fa fa-strikethrough', 'fa fa-underline', 'fa fa-table', 'fa fa-magic', 'fa fa-truck', 'fa fa-pinterest', 'fa fa-pinterest-square', 'fa fa-google-plus-square', 'fa fa-google-plus', 'fa fa-money', 'fa fa-caret-down', 'fa fa-caret-up', 'fa fa-caret-left', 'fa fa-caret-right', 'fa fa-columns', 'fa fa-unsorted', 'fa fa-sort', 'fa fa-sort-down', 'fa fa-sort-desc', 'fa fa-sort-up', 'fa fa-sort-asc', 'fa fa-envelope', 'fa fa-linkedin', 'fa fa-rotate-left', 'fa fa-undo', 'fa fa-legal', 'fa fa-gavel', 'fa fa-dashboard', 'fa fa-tachometer', 'fa fa-comment-o', 'fa fa-comments-o', 'fa fa-flash', 'fa fa-bolt', 'fa fa-sitemap', 'fa fa-umbrella', 'fa fa-paste', 'fa fa-clipboard', 'fa fa-lightbulb-o', 'fa fa-exchange', 'fa fa-cloud-download', 'fa fa-cloud-upload', 'fa fa-user-md', 'fa fa-stethoscope', 'fa fa-suitcase', 'fa fa-bell-o', 'fa fa-coffee', 'fa fa-cutlery', 'fa fa-file-text-o', 'fa fa-building-o', 'fa fa-hospital-o', 'fa fa-ambulance', 'fa fa-medkit', 'fa fa-fighter-jet', 'fa fa-beer', 'fa fa-h-square', 'fa fa-plus-square', 'fa fa-angle-double-left', 'fa fa-angle-double-right', 'fa fa-angle-double-up', 'fa fa-angle-double-down', 'fa fa-angle-left', 'fa fa-angle-right', 'fa fa-angle-up', 'fa fa-angle-down', 'fa fa-desktop', 'fa fa-laptop', 'fa fa-tablet', 'fa fa-mobile-phone', 'fa fa-mobile', 'fa fa-circle-o', 'fa fa-quote-left', 'fa fa-quote-right', 'fa fa-spinner', 'fa fa-circle', 'fa fa-mail-reply', 'fa fa-reply', 'fa fa-github-alt', 'fa fa-folder-o', 'fa fa-folder-open-o', 'fa fa-smile-o', 'fa fa-frown-o', 'fa fa-meh-o', 'fa fa-gamepad', 'fa fa-keyboard-o', 'fa fa-flag-o', 'fa fa-flag-checkered', 'fa fa-terminal', 'fa fa-code', 'fa fa-mail-reply-all', 'fa fa-reply-all', 'fa fa-star-half-empty', 'fa fa-star-half-full', 'fa fa-star-half-o', 'fa fa-location-arrow', 'fa fa-crop', 'fa fa-code-fork', 'fa fa-unlink', 'fa fa-chain-broken', 'fa fa-question', 'fa fa-info', 'fa fa-exclamation', 'fa fa-superscript', 'fa fa-subscript', 'fa fa-eraser', 'fa fa-puzzle-piece', 'fa fa-microphone', 'fa fa-microphone-slash', 'fa fa-shield', 'fa fa-calendar-o', 'fa fa-fire-extinguisher', 'fa fa-rocket', 'fa fa-maxcdn', 'fa fa-chevron-circle-left', 'fa fa-chevron-circle-right', 'fa fa-chevron-circle-up', 'fa fa-chevron-circle-down', 'fa fa-html5', 'fa fa-css3', 'fa fa-anchor', 'fa fa-unlock-alt', 'fa fa-bullseye', 'fa fa-ellipsis-h', 'fa fa-ellipsis-v', 'fa fa-rss-square', 'fa fa-play-circle', 'fa fa-ticket', 'fa fa-minus-square', 'fa fa-minus-square-o', 'fa fa-level-up', 'fa fa-level-down', 'fa fa-check-square', 'fa fa-pencil-square', 'fa fa-external-link-square', 'fa fa-share-square', 'fa fa-compass', 'fa fa-toggle-down', 'fa fa-caret-square-o-down', 'fa fa-toggle-up', 'fa fa-caret-square-o-up', 'fa fa-toggle-right', 'fa fa-caret-square-o-right', 'fa fa-euro', 'fa fa-eur', 'fa fa-gbp', 'fa fa-dollar', 'fa fa-usd', 'fa fa-rupee', 'fa fa-inr', 'fa fa-cny', 'fa fa-rmb', 'fa fa-yen', 'fa fa-jpy', 'fa fa-ruble', 'fa fa-rouble', 'fa fa-rub', 'fa fa-won', 'fa fa-krw', 'fa fa-bitcoin', 'fa fa-btc', 'fa fa-file', 'fa fa-file-text', 'fa fa-sort-alpha-asc', 'fa fa-sort-alpha-desc', 'fa fa-sort-amount-asc', 'fa fa-sort-amount-desc', 'fa fa-sort-numeric-asc', 'fa fa-sort-numeric-desc', 'fa fa-thumbs-up', 'fa fa-thumbs-down', 'fa fa-youtube-square', 'fa fa-youtube', 'fa fa-xing', 'fa fa-xing-square', 'fa fa-youtube-play', 'fa fa-dropbox', 'fa fa-stack-overflow', 'fa fa-instagram', 'fa fa-flickr', 'fa fa-adn', 'fa fa-bitbucket', 'fa fa-bitbucket-square', 'fa fa-tumblr', 'fa fa-tumblr-square', 'fa fa-long-arrow-down', 'fa fa-long-arrow-up', 'fa fa-long-arrow-left', 'fa fa-long-arrow-right', 'fa fa-apple', 'fa fa-windows', 'fa fa-android', 'fa fa-linux', 'fa fa-dribbble', 'fa fa-skype', 'fa fa-foursquare', 'fa fa-trello', 'fa fa-female', 'fa fa-male', 'fa fa-gittip', 'fa fa-sun-o', 'fa fa-moon-o', 'fa fa-archive', 'fa fa-bug', 'fa fa-vk', 'fa fa-weibo', 'fa fa-renren', 'fa fa-pagelines', 'fa fa-stack-exchange', 'fa fa-arrow-circle-o-right', 'fa fa-arrow-circle-o-left', 'fa fa-toggle-left', 'fa fa-caret-square-o-left', 'fa fa-dot-circle-o', 'fa fa-wheelchair', 'fa fa-vimeo-square', 'fa fa-turkish-lira', 'fa fa-try', 'fa fa-plus-square-o', 'fa fa-space-shuttle', 'fa fa-slack', 'fa fa-envelope-square', 'fa fa-wordpress', 'fa fa-openid', 'fa fa-institution', 'fa fa-bank', 'fa fa-university', 'fa fa-mortar-board', 'fa fa-graduation-cap', 'fa fa-yahoo', 'fa fa-google', 'fa fa-reddit', 'fa fa-reddit-square', 'fa fa-stumbleupon-circle', 'fa fa-stumbleupon', 'fa fa-delicious', 'fa fa-digg', 'fa fa-pied-piper', 'fa fa-pied-piper-alt', 'fa fa-drupal', 'fa fa-joomla', 'fa fa-language', 'fa fa-fax', 'fa fa-building', 'fa fa-child', 'fa fa-paw', 'fa fa-spoon', 'fa fa-cube', 'fa fa-cubes', 'fa fa-behance', 'fa fa-behance-square', 'fa fa-steam', 'fa fa-steam-square', 'fa fa-recycle', 'fa fa-automobile', 'fa fa-car', 'fa fa-cab', 'fa fa-taxi', 'fa fa-tree', 'fa fa-spotify', 'fa fa-deviantart', 'fa fa-soundcloud', 'fa fa-database', 'fa fa-file-pdf-o', 'fa fa-file-word-o', 'fa fa-file-excel-o', 'fa fa-file-powerpoint-o', 'fa fa-file-photo-o', 'fa fa-file-picture-o', 'fa fa-file-image-o', 'fa fa-file-zip-o', 'fa fa-file-archive-o', 'fa fa-file-sound-o', 'fa fa-file-audio-o', 'fa fa-file-movie-o', 'fa fa-file-video-o', 'fa fa-file-code-o', 'fa fa-vine', 'fa fa-codepen', 'fa fa-jsfiddle', 'fa fa-life-bouy', 'fa fa-life-buoy', 'fa fa-life-saver', 'fa fa-support', 'fa fa-life-ring', 'fa fa-circle-o-notch', 'fa fa-ra', 'fa fa-rebel', 'fa fa-ge', 'fa fa-empire', 'fa fa-git-square', 'fa fa-git', 'fa fa-hacker-news', 'fa fa-tencent-weibo', 'fa fa-qq', 'fa fa-wechat', 'fa fa-weixin', 'fa fa-send', 'fa fa-paper-plane', 'fa fa-send-o', 'fa fa-paper-plane-o', 'fa fa-history', 'fa fa-circle-thin', 'fa fa-header', 'fa fa-paragraph', 'fa fa-sliders', 'fa fa-share-alt', 'fa fa-share-alt-square', 'fa fa-bomb', 'fa fa-soccer-ball-o', 'fa fa-futbol-o', 'fa fa-tty', 'fa fa-binoculars', 'fa fa-plug', 'fa fa-slideshare', 'fa fa-twitch', 'fa fa-yelp', 'fa fa-newspaper-o', 'fa fa-wifi', 'fa fa-calculator', 'fa fa-paypal', 'fa fa-google-wallet', 'fa fa-cc-visa', 'fa fa-cc-mastercard', 'fa fa-cc-discover', 'fa fa-cc-amex', 'fa fa-cc-paypal', 'fa fa-cc-stripe', 'fa fa-bell-slash', 'fa fa-bell-slash-o', 'fa fa-trash', 'fa fa-copyright', 'fa fa-at', 'fa fa-eyedropper', 'fa fa-paint-brush', 'fa fa-birthday-cake', 'fa fa-area-chart', 'fa fa-pie-chart', 'fa fa-line-chart', 'fa fa-lastfm', 'fa fa-lastfm-square', 'fa fa-toggle-off', 'fa fa-toggle-on', 'fa fa-bicycle', 'fa fa-bus', 'fa fa-ioxhost', 'fa fa-angellist', 'fa fa-cc', 'fa fa-shekel', 'fa fa-sheqel', 'fa fa-ils', 'fa fa-meanpath' );
			sort( $k2t_icon );
			trim( join( 'fa ', $k2t_icon ) );

			$k2t_margin_top = array(
				'param_name'  => 'mgt',
				'heading'     => __( 'Margin Top', 'contractor' ),
				'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
				'type'        => 'textfield',
			);
			$k2t_margin_right = array(
				'param_name'  => 'mgr',
				'heading'     => __( 'Margin Right', 'contractor' ),
				'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
				'type'        => 'textfield',
			);
			$k2t_margin_bottom = array(
				'param_name'  => 'mgb',
				'heading'     => __( 'Margin Bottom', 'contractor' ),
				'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
				'type'        => 'textfield',
			);
			$k2t_margin_left = array(
				'param_name'  => 'mgl',
				'heading'     => __( 'Margin Left', 'contractor' ),
				'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
				'type'        => 'textfield',
			);
			$k2t_id = array(
				'param_name'  => 'id',
				'heading'     => __( 'ID', 'contractor' ),
				'description' => __( '(Optional) Enter a unique ID.', 'contractor' ),
				'type'        => 'textfield',
			);
			$k2t_class = array(
				'param_name'  => 'class',
				'heading'     => __( 'Class', 'contractor' ),
				'description' => __( '(Optional) Enter a unique class name.', 'contractor' ),
				'type'        => 'textfield',
			);
			$k2t_animation = array(
				'param_name' => 'anm',
				'heading' 	 => __( 'Enable Animation', 'contractor' ),
				'type' 		 => 'checkbox',
				'value'      => array(
					'' => true
				)
			);
			$k2t_animation_name = array(
				'param_name' => 'anm_name',
				'heading' 	 => __( 'Animation', 'contractor' ),
				'type' 		 => 'dropdown',
				'dependency' => array(
					'element' => 'anm',
					'value'   => array( '1' ),
					'not_empty' => false,
				),
				'value'      => array( 'bounce', 'flash', 'pulse', 'rubberBand', 'shake', 'swing', 'tada', 'wobble', 'bounceIn', 'bounceInDown', 'bounceInLeft', 'bounceInRight', 'bounceInUp', 'fadeIn', 'fadeInDown', 'fadeInDownBig', 'fadeInLeft', 'fadeInLeftBig', 'fadeInRight', 'fadeInRightBig', 'fadeInUp', 'fadeInUpBig', 'flip', 'flipInX', 'flipInY', 'lightSpeedIn', 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight', 'rollIn', 'zoomIn', 'zoomInDown', 'zoomInLeft', 'zoomInRight', 'zoomInUp' ),
			);
			$k2t_animation_delay = array(
				'param_name'  => 'anm_delay',
				'heading'     => __( 'Animation Delay', 'contractor' ),
				'description' => __( 'Numeric value only, 1000 = 1second.', 'contractor' ),
				'type'        => 'textfield',
				'std'		  => '2000',
				'dependency' => array(
					'element' => 'anm',
					'value'   => array( '1' ),
					'not_empty' => false,
				),
			);

			/*  [ Row ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_row', array(
					'name'        => __( 'Row', 'contractor' ),
					'icon'        => 'fa fa-tasks',
					'category'    => __( 'Structure', 'contractor' ),
					'description' => '',
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'session_layout',
					'heading'     => __( 'Session layout', 'contractor' ),
					'type'        => 'dropdown',
					'value'       => array(
						__( 'None', 'contractor' ) => '',
						__( 'Full Width', 'contractor' ) => 'no_wrap',
						__( 'Fullscreen', 'contractor' ) => 'fullscreen'
					)
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_setting',
					'heading'     => __( 'Background type', 'contractor' ),
					'type'        => 'dropdown',
					'value'       => array(
						__( 'Background Color', 'contractor' ) => 'bg_color',
						__( 'Background Image', 'contractor' ) => 'bg_image',
						__( 'Background Video', 'contractor' ) => 'bg_video',
						__( 'Background Slider', 'contractor' ) => 'bg_slider',
					)
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'dark_background_style',
					'heading'     => __( 'Background with dark style', 'contractor' ),
					'type'        => 'checkbox',
					'holder'      => 'div',
					'value'       => array(
						'' => 'true'
					)
				)
			);
			// Background Image
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_img',
					'heading'     => __( 'Background Image', 'contractor' ),
					'type'        => 'attach_image',
					'holder'      => 'div',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image' )
					),
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_img_position',
					'heading'     => __( 'Background Position', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image' )
					),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'None', 'contractor' )      => '',
						__( 'Left Top', 'contractor' )      => 'left top',
						__( 'Left Center', 'contractor' )   => 'left center',
						__( 'Left Bottom', 'contractor' )   => 'left bottom',
						__( 'Right Top', 'contractor' )     => 'right top',
						__( 'Right Center', 'contractor' )  => 'right center',
						__( 'Right Bottom', 'contractor' )  => 'right bottom',
						__( 'Center Top', 'contractor' )    => 'center top',
						__( 'Center Center', 'contractor' ) => 'center center',
						__( 'Center Bottom', 'contractor' ) => 'center bottom',
					),
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_img_repeat',
					'heading'     => __( 'Background Repeat', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image' )
					),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'No repeat', 'contractor' ) => 'no-repeat',
						__( 'Repeat', 'contractor' )    => 'repeat',
						__( 'Repeat X', 'contractor' )  => 'repeat-x',
						__( 'Repeat Y', 'contractor' )  => 'repeat-y',
					),
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_img_size',
					'heading'     => __( 'Background size', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image' )
					),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'None', 'contractor' ) => '',
						__( 'Auto', 'contractor' )    => 'auto',
						__( 'Length', 'contractor' )  => 'length',
						__( 'Percentage', 'contractor' )  => 'percentage',
						__( 'Cover', 'contractor' )  => 'cover',
						__( 'Contain', 'contractor' )  => 'contain',
						__( 'Initial', 'contractor' )  => 'initial',
					),
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_img_animation',
					'heading'     => __( 'Background Animation', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image' )
					),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'None', 'contractor' ) => '',
						__( 'Left to Right', 'contractor' ) => 'left_to_right',
						__( 'Right to Left', 'contractor' )    => 'right_to_left',
						__( 'Top to Bottom', 'contractor' )  => 'top_to_bottom',
						__( 'Bottom to Top', 'contractor' )  => 'bottom_to_top',
					),
				)
			);
			// Background Video
			vc_add_param(
				'vc_row', array(
					'param_name' => 'background_video_link',
					'heading'    => __( 'Background Video ID', 'contractor' ),
					'type'       => 'textfield',
					'description' => __( 'Only support youtube (eg: fDxFScMvoG8)', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_video' )
					),
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name' => 'background_video_play_id',
					'heading'    => __( 'Set background video ID', 'contractor' ),
					'description' => __( 'You can use this ID for your action ( ex: button, link, image...) to play background video', 'contractor' ),
					'type'       => 'textfield',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_video' )
					),
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_video_mute',
					'heading'     => __( 'Video Mute', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_video' )
					),
					'type'        => 'checkbox',
					'holder'      => 'div',
					'value'       => array(
						'' => 'false'
					)
				)
			);
			// Slider Background
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_slider_images',
					'heading'     => __( 'Background Slider Images', 'contractor' ),
					'type'        => 'attach_images',
					'holder'      => 'div',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_slider' )
					),
				)
			);
			// General Background
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_gen_auto_play',
					'heading'     => __( 'Auto Play', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_video', 'bg_slider' )
					),
					'type'        => 'checkbox',
					'holder'      => 'div',
					'value'       => array(
						'' => 'false'
					)
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_gen_parallax',
					'heading'     => __( 'Parallax Background', 'contractor' ),
					'description' => __( 'Parallax effect for background images', 'contractor' ),
					'type'        => 'checkbox',
					'value'       => array(
						'' => true,
					),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image', 'bg_slider' )
					),
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_gen_color',
					'heading'     => __( 'Background Color', 'contractor' ),
					'type'        => 'colorpicker',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_color', 'bg_image', 'bg_video', 'bg_slider' )
					),
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_gen_mask_layer_image',
					'heading'     => __( 'Mask Layer Image', 'contractor' ),
					'type'        => 'attach_image',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image', 'bg_video', 'bg_slider' )
					),
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_gen_mask_layer_repeat',
					'heading'     => __( 'Mask Layer Repeat', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image', 'bg_video', 'bg_slider' )
					),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'No repeat', 'contractor' ) => 'no-repeat',
						__( 'Repeat', 'contractor' )    => 'repeat',
						__( 'Repeat X', 'contractor' )  => 'repeat-x',
						__( 'Repeat Y', 'contractor' )  => 'repeat-y',
					),
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name' => 'background_gen_mask_layer_opacity',
					'heading'    => __( 'Mask Layer Opacity', 'contractor' ),
					'type'       => 'textfield',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image', 'bg_video', 'bg_slider' )
					),
				)
			);
			vc_add_param(
				'vc_row', array(
					'param_name'  => 'background_gen_mask_layer_color',
					'heading'     => __( 'Mask Layer Color', 'contractor' ),
					'type'        => 'colorpicker',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image', 'bg_video', 'bg_slider' )
					),
				)
			);
			vc_remove_param( 'vc_row', 'font_color' );
			vc_remove_param( 'vc_row', 'el_class' );
			vc_add_param( 'vc_row', $k2t_id );
			vc_add_param( 'vc_row', $k2t_class );

			/*  [ Column ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_column', array(
					'name'        => __( 'Row', 'contractor' ),
					'icon'        => 'fa fa-tasks',
					'category'    => __( 'Structure', 'contractor' ),
					'description' => '',
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_setting',
					'heading'     => __( 'Background type', 'contractor' ),
					'type'        => 'dropdown',
					'value'       => array(
						__( 'Background Color', 'contractor' ) => 'bg_color',
						__( 'Background Image', 'contractor' ) => 'bg_image',
						__( 'Background Video', 'contractor' ) => 'bg_video',
						__( 'Background Slider', 'contractor' ) => 'bg_slider',
					)
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'dark_background_style',
					'heading'     => __( 'Background with dark style', 'contractor' ),
					'type'        => 'checkbox',
					'holder'      => 'div',
					'value'       => array(
						'' => 'true'
					)
				)
			);
			// Background Image
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_img',
					'heading'     => __( 'Background Image', 'contractor' ),
					'type'        => 'attach_image',
					'holder'      => 'div',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image' )
					),
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_img_position',
					'heading'     => __( 'Background Position', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image' )
					),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'None', 'contractor' )      => '',
						__( 'Left Top', 'contractor' )      => 'left top',
						__( 'Left Center', 'contractor' )   => 'left center',
						__( 'Left Bottom', 'contractor' )   => 'left bottom',
						__( 'Right Top', 'contractor' )     => 'right top',
						__( 'Right Center', 'contractor' )  => 'right center',
						__( 'Right Bottom', 'contractor' )  => 'right bottom',
						__( 'Center Top', 'contractor' )    => 'center top',
						__( 'Center Center', 'contractor' ) => 'center center',
						__( 'Center Bottom', 'contractor' ) => 'center bottom',
					),
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_img_repeat',
					'heading'     => __( 'Background Repeat', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image' )
					),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'No repeat', 'contractor' ) => 'no-repeat',
						__( 'Repeat', 'contractor' )    => 'repeat',
						__( 'Repeat X', 'contractor' )  => 'repeat-x',
						__( 'Repeat Y', 'contractor' )  => 'repeat-y',
					),
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_img_size',
					'heading'     => __( 'Background size', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image' )
					),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'None', 'contractor' ) => '',
						__( 'Auto', 'contractor' )    => 'auto',
						__( 'Length', 'contractor' )  => 'length',
						__( 'Percentage', 'contractor' )  => 'percentage',
						__( 'Cover', 'contractor' )  => 'cover',
						__( 'Contain', 'contractor' )  => 'contain',
						__( 'Initial', 'contractor' )  => 'initial',
					),
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_img_animation',
					'heading'     => __( 'Background Animation', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image' )
					),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'None', 'contractor' ) => '',
						__( 'Left to Right', 'contractor' ) => 'left_to_right',
						__( 'Right to Left', 'contractor' )    => 'right_to_left',
						__( 'Top to Bottom', 'contractor' )  => 'top_to_bottom',
						__( 'Bottom to Top', 'contractor' )  => 'bottom_to_top',
					),
				)
			);
			// Background Video
			vc_add_param(
				'vc_column', array(
					'param_name' => 'background_video_link',
					'heading'    => __( 'Background Video ID', 'contractor' ),
					'type'       => 'textfield',
					'description' => __( 'Only support youtube (eg: fDxFScMvoG8)', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_video' )
					),
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name' => 'background_video_play_id',
					'heading'    => __( 'Set background video ID', 'contractor' ),
					'description' => __( 'You can use this ID for your action ( ex: button, link, image...) to play background video', 'contractor' ),
					'type'       => 'textfield',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_video' )
					),
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_video_mute',
					'heading'     => __( 'Video Mute', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_video' )
					),
					'type'        => 'checkbox',
					'holder'      => 'div',
					'value'       => array(
						'' => 'false'
					)
				)
			);
			// Slider Background
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_slider_images',
					'heading'     => __( 'Background Slider Images', 'contractor' ),
					'type'        => 'attach_images',
					'holder'      => 'div',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_slider' )
					),
				)
			);
			// General Background
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_gen_auto_play',
					'heading'     => __( 'Background Auto Play', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_video', 'bg_slider' )
					),
					'type'        => 'checkbox',
					'holder'      => 'div',
					'value'       => array(
						'' => 'false'
					)
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_gen_parallax',
					'heading'     => __( 'Parallax Background', 'contractor' ),
					'description' => __( 'Parallax effect for background images', 'contractor' ),
					'type'        => 'checkbox',
					'value'       => array(
						'' => true,
					),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image', 'bg_slider' )
					),
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_gen_color',
					'heading'     => __( 'Background Color', 'contractor' ),
					'type'        => 'colorpicker',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_color', 'bg_image', 'bg_video', 'bg_slider' )
					),
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_gen_mask_layer_image',
					'heading'     => __( 'Mask Layer Image', 'contractor' ),
					'type'        => 'attach_image',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image', 'bg_video', 'bg_slider' )
					),
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_gen_mask_layer_repeat',
					'heading'     => __( 'Mask Layer Repeat', 'contractor' ),
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image', 'bg_video', 'bg_slider' )
					),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'No repeat', 'contractor' ) => 'no-repeat',
						__( 'Repeat', 'contractor' )    => 'repeat',
						__( 'Repeat X', 'contractor' )  => 'repeat-x',
						__( 'Repeat Y', 'contractor' )  => 'repeat-y',
					),
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name' => 'background_gen_mask_layer_opacity',
					'heading'    => __( 'Mask Layer Opacity', 'contractor' ),
					'type'       => 'textfield',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image', 'bg_video', 'bg_slider' )
					),
				)
			);
			vc_add_param(
				'vc_column', array(
					'param_name'  => 'background_gen_mask_layer_color',
					'heading'     => __( 'Mask Layer Color', 'contractor' ),
					'type'        => 'colorpicker',
					'dependency' => array(
						'element' => 'background_setting',
						'value'   => array( 'bg_image', 'bg_video', 'bg_slider' )
					),
				)
			);
			vc_remove_param( 'vc_column', 'font_color' );
			vc_remove_param( 'vc_column', 'el_class' );
			vc_add_param( 'vc_column', $k2t_id );
			vc_add_param( 'vc_column', $k2t_class );

			/*  [ VC Tabs]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_tabs', array(
					'name'        => __( 'Tabs', 'contractor' ),
					'icon'        => 'fa fa-text-height',
					'category'    => __( 'Content', 'contractor' ),
					'description' => '',
				)
			);
			vc_add_param(
				'vc_tabs', array(
					'param_name' => 'align',
					'heading' 	 => __( 'Align', 'contractor' ),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'Left', 'contractor' ) 					=> 'left',
						__( 'Center', 'contractor' )    				=> 'center',
						__( 'Right', 'contractor' )    				=> 'right',
					),
				)
			);
			vc_add_param(
				'vc_tabs', array(
					'param_name' => 'style',
					'heading' 	 => __( 'Style', 'contractor' ),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'OutLine', 'contractor' ) 				=> 'outline',
						__( 'Fill', 'contractor' ) 					=> 'fill',
						__( 'Solid', 'contractor' )    				=> 'solid',
						__( 'Bottom Line', 'contractor' )    			=> 'bottom_line',
					),
				)
			);
			vc_add_param(
				'vc_tabs', array(
					'param_name'  => 'icon_font_size',
					'heading'     => __( 'Icon Font size', 'contractor' ),
					'type'        => 'textfield',
					'holder'      => 'div',
				)
			);
			vc_remove_param( 'vc_tabs', 'el_class' );
			vc_add_param( 'vc_tabs', $k2t_class );

			/*  [ VC Vertical tab ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_tour', array(
					'name'        => __( 'Vertical tabs', 'contractor' ),
					'icon'        => 'fa fa-list-ul',
					'category'    => __( 'Structure', 'contractor' ),
					'description' => '',
				)
			);
			vc_add_param(
				'vc_tour', array(
					'param_name' => 'style',
					'heading' 	 => __( 'Styles', 'contractor' ),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'OutLine', 'contractor' ) 				=> 'outline',
						__( 'Solid', 'contractor' )    				=> 'solid',
					),
				)
			);

			/*  [ VC Tab]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_tab', array(
					'name'        => __( 'Text Block', 'contractor' ),
					'icon'        => 'fa fa-text-height',
					'category'    => __( 'Content', 'contractor' ),
					'description' => '',
				)
			);
			vc_add_param(
				'vc_tab', array(
					'param_name' => 'icon',
					'heading' 	 => __( 'Icons', 'contractor' ),
					'type' 		 => 'k2t_icon',
					'value'      => '',
				)
			);
			vc_add_param(
				'vc_tab', array(
					'param_name'  => 'icon_pos',
					'heading'     => __( 'Icon Position', 'contractor' ),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'Left', 'contractor' ) => 'left',
						__( 'Top', 'contractor' )    => 'top',
					),
				)
			);

			/*  [ VC Column Text ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_column_text', array(
					'name'        => __( 'Text Block', 'contractor' ),
					'icon'        => 'fa fa-text-height',
					'category'    => __( 'Content', 'contractor' ),
					'description' => '',
				)
			);
			vc_remove_param( 'vc_column_text', 'css_animation' );
			vc_remove_param( 'vc_column_text', 'el_class' );
			vc_add_param( 'vc_column_text', $k2t_animation );
			vc_add_param( 'vc_column_text', $k2t_animation_name );
			vc_add_param( 'vc_column_text', $k2t_animation_delay );
			vc_add_param( 'vc_column_text', $k2t_id );
			vc_add_param( 'vc_column_text', $k2t_class );

			/*  [ VC Separator ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_separator', array(
					'name'        => __( 'Separator', 'contractor' ),
					'icon'        => 'fa fa-minus',
					'category'    => __( 'Structure', 'contractor' ),
					'description' => '',
				)
			);
			vc_add_param(
				'vc_separator', array(
					'param_name'  => 'style',
					'heading'     => __( 'Style', 'contractor' ),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'Border', 'contractor' ) => '',
						__( 'Dashed', 'contractor' )    => 'dashed',
						__( 'Dotted', 'contractor' )    => 'dotted',
						__( 'Double', 'contractor' )    => 'double',
						__( 'Shadow', 'contractor' )    => 'shadow',
					),
				)
			);

			/*  [ VC Separator With Text ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_text_separator', array(
					'name'        => __( 'Separator with text', 'contractor' ),
					'icon'        => 'fa fa-text-width',
					'category'    => __( 'Structure', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC Message Box ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_message', array(
					'name'        => __( 'Message box', 'contractor' ),
					'icon'        => 'fa fa-file-text-o',
					'category'    => __( 'Content', 'contractor' ),
					'description' => '',
				)
			);
			vc_add_param(
				'vc_message', array(
					'param_name' => 'icon',
					'heading' 	 => __( 'Icons', 'contractor' ),
					'type' 		 => 'k2t_icon',
					'value'      => '',
				)
			);
			vc_add_param(
				'vc_message', array(
					'param_name'  => 'background_transparent',
					'heading'     => __( 'Background Transparent', 'contractor' ),
					'type'        => 'checkbox',
					'holder'      => 'div',
					'value'       => array(
						'' => true
					)
				)
			);
			vc_add_param(
				'vc_message', array(
					'param_name'  => 'is_close',
					'heading'     => __( 'Is Close', 'contractor' ),
					'type'        => 'checkbox',
					'holder'      => 'div',
					'value'       => array(
						'' => true
					)
				)
			);
			vc_remove_param( 'vc_message', 'css_animation' );
			vc_remove_param( 'vc_message', 'el_class' );
			vc_remove_param( 'vc_message', 'icon_fontawesome' );
			vc_remove_param( 'vc_message', 'icon_type' );
			vc_add_param( 'vc_message', $k2t_animation );
			vc_add_param( 'vc_message', $k2t_animation_name );
			vc_add_param( 'vc_message', $k2t_animation_delay );
			vc_add_param( 'vc_message', $k2t_id );
			vc_add_param( 'vc_message', $k2t_class );

			/*  [ VC Facebook ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_facebook', array(
					'name'        => __( 'Facebook like', 'contractor' ),
					'icon'        => 'fa fa-facebook',
					'category'    => __( 'Socials', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC Tweetmeme ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_tweetmeme', array(
					'name'        => __( 'Tweetmeme', 'contractor' ),
					'icon'        => 'fa fa-twitter',
					'category'    => __( 'Socials', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC Google Plus ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_googleplus', array(
					'name'        => __( 'Google Plus', 'contractor' ),
					'icon'        => 'fa fa-google-plus',
					'category'    => __( 'Socials', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC Pinterest ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_pinterest', array(
					'name'        => __( 'Pinterest', 'contractor' ),
					'icon'        => 'fa fa-pinterest',
					'category'    => __( 'Socials', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC Single Image ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_single_image', array(
					'name'        => __( 'Single Image', 'contractor' ),
					'icon'        => 'fa fa-image',
					'category'    => __( 'Content', 'contractor' ),
					'description' => '',
				)
			);
			vc_add_param(
				'vc_single_image', array(
					'param_name'  => 'image_style',
					'heading'     => __( 'Image Style', 'contractor' ),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'None', 'contractor' ) => '',
						__( 'Rounded', 'contractor' )    => 'rounded',
						__( 'Border', 'contractor' )    => 'border',
						__( 'Outline', 'contractor' )    => 'outline',
						__( 'Shadow', 'contractor' )    => 'shadow',
					),
				)
			);
			vc_add_param(
				'vc_single_image', array(
					'param_name'  => 'image_hover_style',
					'heading'     => __( 'Image Hover Style', 'contractor' ),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'None', 'contractor' ) => '',
						__( 'Dark', 'contractor' )    => 'dark',
						__( 'Light', 'contractor' )    => 'light',
						__( 'Banner', 'contractor' )    => 'banner',
					),
				)
			);
			vc_add_param(
				'vc_single_image', array(
					'param_name' => 'image_banner_hover',
					'heading'    => __( 'Image Banner Content', 'contractor' ),
					'type'       => 'textarea',
					'dependency' => array(
						'element' => 'image_hover_style',
						'value'   => array( 'banner' )
					),
				)
			);
			vc_remove_param( 'vc_single_image', 'css_animation' );
			vc_remove_param( 'vc_single_image', 'el_class' );
			vc_remove_param( 'vc_single_image', 'style' );
			vc_remove_param( 'vc_single_image', 'border_color' );
			vc_remove_param( 'vc_single_image', 'img_link_large' );
			vc_remove_param( 'vc_single_image', 'img_link_target' );
			vc_add_param( 'vc_single_image', $k2t_animation );
			vc_add_param( 'vc_single_image', $k2t_animation_name );
			vc_add_param( 'vc_single_image', $k2t_animation_delay );
			vc_add_param( 'vc_single_image', $k2t_id );
			vc_add_param( 'vc_single_image', $k2t_class );

			/*  [ VC Gallery ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_gallery', array(
					'name'        => __( 'Gallery', 'contractor' ),
					'icon'        => 'fa fa-caret-square-o-right',
					'category'    => __( 'Media', 'contractor' ),
					'description' => '',
				)
			);
			vc_remove_param( 'vc_gallery', 'el_class' );
			vc_add_param( 'vc_gallery', $k2t_id );
			vc_add_param( 'vc_gallery', $k2t_class );

			/*  [ VC Carousel ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_images_carousel', array(
					'name'        => __( 'Carousel', 'contractor' ),
					'icon'        => 'fa fa-exchange',
					'category'    => __( 'Media', 'contractor' ),
					'description' => '',
				)
			);
			vc_remove_param( 'vc_images_carousel', 'el_class' );
			vc_add_param( 'vc_images_carousel', $k2t_id );
			vc_add_param( 'vc_images_carousel', $k2t_class );

			/*  [ VC Toggle ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_toggle', array(
					'name'        => __( 'Toggles', 'contractor' ),
					'icon'        => 'fa fa-indent',
					'category'    => __( 'Structure', 'contractor' ),
					'description' => '',
				)
			);
			vc_remove_param( 'vc_toggle', 'css_animation' );
			vc_remove_param( 'vc_toggle', 'el_class' );
			vc_add_param( 'vc_toggle', $k2t_animation );
			vc_add_param( 'vc_toggle', $k2t_animation_name );
			vc_add_param( 'vc_toggle', $k2t_animation_delay );
			vc_add_param( 'vc_toggle', $k2t_id );
			vc_add_param( 'vc_toggle', $k2t_class );

			/*  [ VC Video ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_video', array(
					'name'        => __( 'Video', 'contractor' ),
					'icon'        => 'fa fa-video-camera',
					'category'    => __( 'Media', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC Raw HTML ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_raw_html', array(
					'name'        => __( 'Raw HTML code', 'contractor' ),
					'icon'        => 'fa fa-code',
					'category'    => __( 'Structure', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC Raw JS ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_raw_js', array(
					'name'        => __( 'Raw JS code', 'contractor' ),
					'icon'        => 'fa fa-code',
					'category'    => __( 'Structure', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC Empty Space ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_empty_space', array(
					'name'        => __( 'Empty Space', 'contractor' ),
					'icon'        => 'fa fa-arrows-v',
					'category'    => __( 'Structure', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC Custom Heading ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_custom_heading', array(
					'name'        => __( 'Custom Heading', 'contractor' ),
					'icon'        => 'fa fa-header',
					'category'    => __( 'Typography', 'contractor' ),
					'description' => '',
				)
			);
			vc_add_param(
				'vc_custom_heading', array(
					'param_name' => 'text_transform',
					'heading' 	 => __( 'Text Transform', 'contractor' ),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'Inherit', 'contractor' )    => 'inherit',
						__( 'Uppercase', 'contractor' )  => 'uppercase',
						__( 'lowercase', 'contractor' )  => 'lowercase',
						__( 'initial', 'contractor' )    => 'initial',
						__( 'capitalize', 'contractor' ) => 'capitalize',
					),
				)
			);
			vc_remove_param( 'vc_custom_heading', 'el_class' );
			vc_add_param( 'vc_custom_heading', $k2t_animation );
			vc_add_param( 'vc_custom_heading', $k2t_animation_name );
			vc_add_param( 'vc_custom_heading', $k2t_animation_delay );
			vc_add_param( 'vc_custom_heading', $k2t_id );
			vc_add_param( 'vc_custom_heading', $k2t_class );

			/*  [ VC Posts Grid ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_posts_grid', array(
					'name'        => __( 'Post Grid', 'contractor' ),
					'icon'        => 'fa fa-th',
					'category'    => __( 'Content', 'contractor' ),
					'description' => ''
				)
			);
			vc_add_param(
				'vc_posts_grid', array(
					'param_name' => 'align',
					'heading' 	 => __( 'Align', 'contractor' ),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'Left', 'contractor' )    => 'left',
						__( 'Center', 'contractor' )  => 'center',
						__( 'Right', 'contractor' )  => 'right',
					),
				)
			);
			vc_add_param(
				'vc_posts_grid', array(
					'param_name' => 'style',
					'heading' 	 => __( 'Style', 'contractor' ),
					'type' 		 => 'dropdown',
					'value'      => array(
						__( 'Default', 'contractor' )    => 'default',
						__( 'Boxed', 'contractor' )  => 'boxed',
					),
				)
			);
			vc_remove_param( 'vc_posts_grid', 'filter' );

			/*  [ VC WP Search ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_wp_search', array(
					'name'        => __( 'WP Search', 'contractor' ),
					'icon'        => 'fa fa-wordpress',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC WP Meta ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_wp_meta', array(
					'name'        => __( 'WP Meta', 'contractor' ),
					'icon'        => 'fa fa-wordpress',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC WP recent comments ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_wp_recentcomments', array(
					'name'        => __( 'WP Recent Comments', 'contractor' ),
					'icon'        => 'fa fa-wordpress',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC WP calendar ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_wp_calendar', array(
					'name'        => __( 'WP Calendar', 'contractor' ),
					'icon'        => 'fa fa-wordpress',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC WP pages ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_wp_pages', array(
					'name'        => __( 'WP Pages', 'contractor' ),
					'icon'        => 'fa fa-wordpress',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC WP Tagcloud ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_wp_tagcloud', array(
					'name'        => __( 'WP Tagcloud', 'contractor' ),
					'icon'        => 'fa fa-wordpress',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC WP custom menu ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_wp_custommenu', array(
					'name'        => __( 'WP Custom Menu', 'contractor' ),
					'icon'        => 'fa fa-wordpress',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC WP text ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_wp_text', array(
					'name'        => __( 'WP Text', 'contractor' ),
					'icon'        => 'fa fa-wordpress',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC WP posts ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_wp_posts', array(
					'name'        => __( 'WP Posts', 'contractor' ),
					'icon'        => 'fa fa-wordpress',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC WP categories ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_wp_categories', array(
					'name'        => __( 'WP Categories', 'contractor' ),
					'icon'        => 'fa fa-wordpress',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC WP archives ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_wp_archives', array(
					'name'        => __( 'WP Archives', 'contractor' ),
					'icon'        => 'fa fa-wordpress',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ VC WP rss ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'vc_wp_rss', array(
					'name'        => __( 'WP RSS', 'contractor' ),
					'icon'        => 'fa fa-wordpress',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ Contact form 7 ]
			- - - - - - - - - - - - - - - - - - - */
			vc_map_update(
				'contact-form-7', array(
					'name'        => __( 'Contact Form 7', 'contractor' ),
					'icon'        => 'fa fa-list-alt',
					'category'    => __( 'WordPress', 'contractor' ),
					'description' => '',
				)
			);

			/*  [ Accordion ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_accordion = array(
				'base'            => 'accordion',
				'name'            => __( 'Accordion', 'contractor' ),
				'icon'            => 'fa fa-sort-amount-desc',
				'category'        => __( 'Structure', 'contractor' ),
				'as_parent'       => array( 'only' => 'toggle' ),
				'content_element' => true,
				'js_view'         => 'VcColumnView',
				'params'          => array(
					array(
						'param_name'  => 'style',
						'heading' 	  => __( 'Style', 'contractor' ),
						'description' => __( 'Select style for accordion', 'contractor'),
						'type' 		  => 'dropdown',
						'value'       => array( '1', '2', '3' ),
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_accordion );

			/*  [ Accordion Items ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_accordion_item = array(
				'base'            => 'toggle',
				'name'            => __( 'Accordion Item', 'contractor' ),
				'icon'            => 'fa fa-sort-amount-desc',
				'category'        => __( 'Structure', 'contractor' ),
				'as_child'        => array( 'only' => 'accordion' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'title',
						'heading'     => __( 'Title', 'contractor' ),
						'description' => __( 'Title for your accordion item.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'icon',
						'heading' 	 => __( 'Icons', 'contractor' ),
						'type' 		 => 'k2t_icon',
						'value'      => '',
					),
					array(
						'param_name'  => 'acc_content',
						'heading'     => __( 'Content', 'contractor' ),
						'description' => __( 'Enter your text.', 'contractor' ),
						'type'        => 'textarea',
						'holder'      => 'div',
						'value'       => ''
					),
					array(
						'param_name'  => 'open',
						'heading'     => __( 'Open', 'contractor' ),
						'description' => __( 'Select for your accordion item to be open by default.', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => 'true'
						)
					),
					$k2t_id, $k2t_class
				)
			);
			vc_map( $k2t_accordion_item );

			/*  [ Brands ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_brands = array(
				'base'            => 'brands',
				'name'            => __( 'Brands', 'contractor' ),
				'icon'            => 'fa fa-photo',
				'category'        => __( 'Content', 'contractor' ),
				'as_parent'       => array( 'only' => 'brand' ),
				'content_element' => true,
				'js_view'         => 'VcColumnView',
				'params'          => array(
					array(
						'param_name'  => 'column',
						'heading' 	  => __( 'Column', 'contractor' ),
						'description' => __( 'Select column display brand', 'contractor'),
						'type' 		  => 'dropdown',
						'value'       => array( '1', '2', '3', '4', '5', '6', '7', '8' ),
					),
					array(
						'param_name'  => 'padding',
						'heading'     => __( 'Padding', 'contractor' ),
						'description' => __( 'If you select true, it will be padding between item', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => 'true',
						)
					),
					array(
						'param_name'  => 'grayscale',
						'heading'     => __( 'Grayscale', 'contractor' ),
						'description' => __( 'Display grayscale.', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => 'true'
						)
					),
					$k2t_id, $k2t_class
				)
			);
			vc_map( $k2t_brands );

			/*  [ Brand Items ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_brands_item = array(
				'base'            => 'brand',
				'name'            => __( 'Brands Item', 'contractor' ),
				'icon'            => 'fa fa-photo',
				'category'        => __( 'Content', 'contractor' ),
				'as_child'        => array( 'only' => 'brands' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'title',
						'heading'     => __( 'Brand Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'tooltip',
						'heading'     => __( 'Tooltip', 'contractor' ),
						'description' => __( 'Enable tooltip.', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => 'true'
						)
					),
					array(
						'param_name'  => 'link',
						'heading'     => __( 'Upload Brand', 'contractor' ),
						'type'        => 'attach_image',
						'holder'      => 'div',
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
				)
			);
			vc_map( $k2t_brands_item );

			/*  [ Button ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_button = array(
				'base'            => 'button',
				'name'            => __( 'Button', 'contractor' ),
				'icon'            => 'fa fa-square',
				'category'        => __( 'Typography', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'title',
						'heading'     => __( 'Button Text', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'link',
						'heading'     => __( 'Link', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'target',
						'heading' 	 => __( 'Link Target', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Open in a new window', 'contractor' )                      => '_blank',
							__( 'Open in the same frame as it was clicked', 'contractor' )  => '_self'
						),
					),
					array(
						'param_name' => 'icon',
						'heading' 	 => __( 'Choose Icon', 'contractor' ),
						'type' 		 => 'k2t_icon',
						'value'      => '',
					),
					array(
						'param_name' => 'icon_position',
						'heading' 	 => __( 'Icon Position', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Right', 'contractor' ) 				=> 'right',
							__( 'Left', 'contractor' )  				=> 'left'
						),
					),
					array(
						'param_name' => 'size',
						'heading' 	 => __( 'Size', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Small', 'contractor' )  				=> 'small',
							__( 'Medium', 'contractor' ) 				=> 'medium',
							__( 'Large', 'contractor' )  				=> 'large'
						),
					),
					array(
						'param_name' => 'align',
						'heading' 	 => __( 'Align', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Left', 'contractor' )   				=> 'left',
							__( 'Center', 'contractor' ) 				=> 'center',
							__( 'Right', 'contractor' )  				=> 'right'
						),
					),
					array(
						'param_name' => 'button_style',
						'heading' 	 => __( 'Style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Dark Grey', 'contractor' )   		=> 'dark_grey',
							__( 'Orange', 'contractor' ) 				=> 'orange',
							__( 'Dark Blue', 'contractor' )  			=> 'dark_blue',
							__( 'Dark Red', 'contractor' )  			=> 'dark_red',
							__( 'Light Grey', 'contractor' )  		=> 'light_grey',
							__( 'Light Blue', 'contractor' )  		=> 'light_blue',
							__( 'Green', 'contractor' )  				=> 'green',
							__( 'Custom', 'contractor' )  			=> 'custom',
						),
					),
					array(
						'param_name'  => 'fullwidth',
						'heading'     => __( 'Button Full Width', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => 'true'
						)
					),
					array(
						'param_name'  => 'color',
						'heading'     => __( 'Button Background Color', 'contractor' ),
						'type'        => 'colorpicker',
						'dependency' => array(
							'element' => 'button_style',
							'value'   => array( 'custom' )
						),
					),
					array(
						'param_name'  => 'text_color',
						'heading'     => __( 'Button Text Color', 'contractor' ),
						'type'        => 'colorpicker',
						'dependency' => array(
							'element' => 'button_style',
							'value'   => array( 'custom' )
						),
					),
					array(
						'param_name'  => 'hover_bg_color',
						'heading'     => __( 'Background Hover Color', 'contractor' ),
						'type'        => 'colorpicker',
						'dependency' => array(
							'element' => 'button_style',
							'value'   => array( 'custom' )
						),
					),
					array(
						'param_name'  => 'hover_text_color',
						'heading'     => __( 'Text Hover Color', 'contractor' ),
						'type'        => 'colorpicker',
						'dependency' => array(
							'element' => 'button_style',
							'value'   => array( 'custom' )
						),
					),
					array(
						'param_name'  => 'border_color',
						'heading'     => __( 'Button border Color', 'contractor' ),
						'type'        => 'colorpicker',
						'dependency' => array(
							'element' => 'button_style',
							'value'   => array( 'custom' )
						),
					),
					array(
						'param_name'  => 'border_width',
						'heading'     => __( 'Button border width', 'contractor' ),
						'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
						'dependency' => array(
							'element' => 'button_style',
							'value'   => array( 'custom' )
						),
					),
					array(
						'param_name'  => 'hover_border_color',
						'heading'     => __( 'Border Hover Color', 'contractor' ),
						'type'        => 'colorpicker',
						'dependency' => array(
							'element' => 'button_style',
							'value'   => array( 'custom' )
						),
					),
					array(
						'param_name'  => 'radius',
						'heading'     => __( 'Button radius', 'contractor' ),
						'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'pill',
						'heading'     => __( 'Pill', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => 'true'
						)
					),
					array(
						'param_name'  => 'd3',
						'heading'     => __( '3D', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => 'true'
						)
					),
					$k2t_margin_top,
					$k2t_margin_right,
					$k2t_margin_bottom,
					$k2t_margin_left,
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_button );

			/*  [ Circle button ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_circle_button = array(
				'base'            => 'circle_button',
				'name'            => __( 'Circle Button', 'contractor' ),
				'icon'            => 'fa fa-circle',
				'category'        => __( 'Typography', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'name',
						'heading'     => __( 'Button Name', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'link',
						'heading'     => __( 'Link To', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'icon_hover',
						'heading' 	 => __( 'Icon Hover', 'contractor' ),
						'type' 		 => 'k2t_icon',
						'value'      => '',
					),
					array(
						'param_name'  => 'background_color',
						'heading'     => __( 'Button Background Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_circle_button );

			/*  [ Counter ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_counter = array(
				'base'            => 'counter',
				'name'            => __( 'Counter', 'contractor' ),
				'icon'            => 'fa fa-list-ol',
				'category'        => __( 'Content', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name' => 'style_type',
						'heading' 	 => __( 'Style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Icon Top', 'contractor' )  => '1',
							__( 'Icon Left', 'contractor' ) => '2',
						),
					),
					array(
						'param_name'  => 'border_width',
						'heading'     => __( 'Border Width', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
					),
					array(
						'param_name' => 'border_style',
						'heading'    => __( 'Border Style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Solid', 'contractor' )  => 'solid',
							__( 'Dashed', 'contractor' ) => 'dashed'
						),
					),
					array(
						'param_name'  => 'border_color',
						'heading'     => __( 'Border', 'contractor' ),
						'type'        => 'colorpicker'
					),
					array(
						'param_name' => 'icon_type',
						'heading'    => __( 'Icon Type', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Icon font', 'contractor' )    => 'icon_font',
							__( 'Icon Graphic', 'contractor' ) => 'icon_graphic'
						),
					),
					array(
						'param_name'  => 'icon_font',
						'heading'     => __( 'Choose Icon', 'contractor' ),
						'type' 		 => 'k2t_icon',
						'value'      => '',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_font' ),
						),
					),
					array(
						'param_name'  => 'icon_size',
						'heading'     => __( 'Icon size', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_font' ),
						),
					),
					array(
						'param_name'  => 'icon_color',
						'heading'     => __( 'Icon Color', 'contractor' ),
						'type'        => 'colorpicker',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_font' ),
						),
					),
					array(
						'param_name'  => 'icon_background',
						'heading'     => __( 'Icon Background', 'contractor' ),
						'type'        => 'colorpicker',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_font' ),
						),
					),
					array(
						'param_name'  => 'icon_border_color',
						'heading'     => __( 'Icon Border', 'contractor' ),
						'type'        => 'colorpicker',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_font' ),
						),
					),
					array(
						'param_name' => 'icon_border_style',
						'heading'    => __( 'Icon Border Style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Solid', 'contractor' )  => 'solid',
							__( 'Dashed', 'contractor' ) => 'dashed'
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_font' ),
						)
					),
					array(
						'param_name'  => 'icon_border_width',
						'heading'     => __( 'Icon Border Width', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_font' ),
						),
					),
					array(
						'param_name'  => 'icon_border_radius',
						'heading'     => __( 'Icon Border Radius', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_font' ),
						),
					),
					array(
						'param_name'  => 'icon_graphic',
						'heading'     => __( 'Upload icon graphic', 'contractor' ),
						'type'        => 'attach_image',
						'holder'      => 'div',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_graphic' ),
						),
					),
					array(
						'param_name'  => 'number',
						'heading'     => __( 'Counter to number', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'number_font_size',
						'heading'     => __( 'Number font size', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'number_color',
						'heading'     => __( 'Number Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'title',
						'heading'     => __( 'Counter Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'title_font_size',
						'heading'     => __( 'Title font size', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'title_color',
						'heading'     => __( 'Title Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'speed',
						'heading'     => __( 'Animation Speed', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'delay',
						'heading'     => __( 'Animation Delay', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_counter );

			/*  [ Google Map ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_google_map = array(
				'base'            => 'google_map',
				'name'            => __( 'Google Maps', 'contractor' ),
				'icon'            => 'fa fa-map-marker',
				'category'        => __( 'Marketing', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'z',
						'heading'     => __( 'Zoom Level', 'contractor' ),
						'description' => __( 'Between 0-20', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'lat',
						'heading'     => __( 'Latitude', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'lon',
						'heading'     => __( 'Longitude', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'w',
						'heading'     => __( 'Width', 'contractor' ),
						'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'h',
						'heading'     => __( 'Height', 'contractor' ),
						'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'address',
						'heading'     => __( 'Address', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'marker',
						'heading' 	 => __( 'Marker', 'contractor' ),
						'type' 		 => 'checkbox',
						'value'      => array(
							'' => 'true'
						),
						'dependency' => array(
							'element' => 'address',
							'not_empty'   => true,
						),
					),
					array(
						'param_name'  => 'markerimage',
						'heading'     => __( 'Marker Image', 'contractor' ),
						'description' => __( 'Change default Marker.', 'contractor' ),
						'type'        => 'attach_image',
						'holder'      => 'div',
						'dependency' => array(
							'element' => 'marker',
							'value'   => array( 'true' ),
						),
					),
					array(
						'param_name' => 'traffic',
						'heading' 	 => __( 'Show Traffic', 'contractor' ),
						'type' 		 => 'checkbox',
						'value'      => array(
							'' => 'true'
						)
					),
					array(
						'param_name' => 'draggable',
						'heading' 	 => __( 'Draggable', 'contractor' ),
						'type' 		 => 'checkbox',
						'value'      => array(
							'' => 'true'
						)
					),
					array(
						'param_name' => 'infowindowdefault',
						'heading' 	 => __( 'Show Info Map', 'contractor' ),
						'type' 		 => 'checkbox',
						'value'      => array(
							'' => 'true'
						)
					),
					array(
						'param_name'  => 'infowindow',
						'heading'     => __( 'Content Info Map', 'contractor' ),
						'description' => __( 'Strong, br are accepted.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'hidecontrols',
						'heading' 	 => __( 'Hide Control', 'contractor' ),
						'type' 		 => 'checkbox',
						'value'      => array(
							'' => 'true'
						)
					),
					array(
						'param_name' => 'scrollwheel',
						'heading' 	 => __( 'Scroll wheel zooming', 'contractor' ),
						'type' 		 => 'checkbox',
						'value'      => array(
							'' => 'true'
						)
					),
					array(
						'param_name' => 'maptype',
						'heading' 	 => __( 'Map Type', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'ROADMAP', 'contractor' )   => 'ROADMAP',
							__( 'SATELLITE', 'contractor' ) => 'SATELLITE',
							__( 'HYBRID', 'contractor' )    => 'HYBRID',
							__( 'TERRAIN', 'contractor' )   => 'TERRAIN'
						),
					),
					array(
						'param_name' => 'mapstype',
						'heading' 	 => __( 'Map style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'None', 'contractor' )   => '',
							__( 'Subtle Grayscale', 'contractor' )   => 'grayscale',
							__( 'Blue water', 'contractor' ) => 'blue_water',
							__( 'Pale Dawn', 'contractor' ) => 'pale_dawn',
							__( 'Shades of Grey', 'contractor' ) => 'shades_of_grey',
						),
					),
					array(
						'param_name'  => 'color',
						'heading'     => __( 'Background Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_google_map );

			/*  [ Heading ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_heading = array(
				'base'            => 'heading',
				'name'            => __( 'Heading', 'contractor' ),
				'icon'            => 'fa fa-header',
				'category'        => __( 'Typography', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'content',
						'heading'     => __( 'Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
						'value'       => ''
					),
					array(
						'param_name'  => 'subtitle',
						'heading'     => __( 'Sub Title', 'contractor' ),
						'type'        => 'textarea',
						'holder'      => 'div',
						'value'       => ''
					),
					array(
						'param_name' => 'h',
						'heading' 	 => __( 'Heading Tag', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array( 
							__( 'H1', 'contractor' ) => 'h1', 
							__( 'H2', 'contractor' ) => 'h2', 
							__( 'H3', 'contractor' ) => 'h3', 
							__( 'H4', 'contractor' ) => 'h4', 
							__( 'H5', 'contractor' ) => 'h5', 
							__( 'H6', 'contractor' ) => 'h6', 
							__( 'Custom', 'contractor' ) => 'custom' ),
					),
					array(
						'param_name'  => 'font_size',
						'heading'     => __( 'Custom Font Size', 'contractor' ),
						'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
						'dependency' => array(
							'element' => 'h',
							'value'   => array( 'custom' )
						),
					),
					array(
						'param_name' => 'align',
						'heading' 	 => __( 'Align', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Left', 'contractor' )   => 'left',
							__( 'Center', 'contractor' ) => 'center',
							__( 'Right', 'contractor' )  => 'right'
						),
					),
					array(
						'param_name'  => 'font',
						'heading'     => __( 'Font', 'contractor' ),
						'description' => __( 'Use Google Font', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'border',
						'heading' 	 => __( 'Has border', 'contractor' ),
						'type' 		 => 'checkbox',
						'value'      => array(
							'' => 'true'
						)
					),
					array(
						'param_name' => 'border_style',
						'heading' 	 => __( 'Border Style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Short Line', 'contractor' )   => 'short_line',
							__( 'Bottom Icon', 'contractor' ) => 'bottom_icon',
							__( 'Heading', 'contractor' )  => 'heading',
							__( 'Boxed Heading', 'contractor' )  => 'boxed_heading',
							__( 'Bottom Border', 'contractor' )  => 'bottom_border',
							__( 'Line Through', 'contractor' )  => 'line_through',
							__( 'Double Line', 'contractor' )  => 'double_line',
							__( 'Dotted Line', 'contractor' )  => 'three_dotted',
							__( 'Fat Line', 'contractor' )  => 'fat_line',
						),
						'dependency' => array(
							'element' => 'border',
							'value'   => array( 'true' )
						),
					),
					array(
						'param_name' => 'icon',
						'heading' 	 => __( 'Choose Icon', 'contractor' ),
						'type' 		 => 'k2t_icon',
						'value'      => '',
						'dependency' => array(
							'element' => 'border_style',
							'value'   => array( 'bottom_icon', 'boxed_heading' )
						),
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_heading );

			/*  [ Icon Box ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_icon_box = array(
				'base'            => 'iconbox',
				'name'            => __( 'Icon Box', 'contractor' ),
				'icon'            => 'fa fa-th',
				'category'        => __( 'Marketing', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name' => 'layout',
						'heading' 	 => __( 'Layout', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array( '1', '2', '3' ),
					),
					array(
						'param_name'  => 'title',
						'heading'     => __( 'Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'subtitle',
						'heading'     => __( 'Sub Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'fontsize',
						'heading'     => __( 'Title Font Size', 'contractor' ),
						'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'color',
						'heading'     => __( 'Title Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name' => 'text_transform',
						'heading' 	 => __( 'Text Transform', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Inherit', 'contractor' )    => 'inherit',
							__( 'Uppercase', 'contractor' )  => 'uppercase',
							__( 'Lowercase', 'contractor' )  => 'lowercase',
							__( 'Initial', 'contractor' )    => 'initial',
							__( 'Capitalize', 'contractor' ) => 'capitalize',
						),
					),
					array(
						'param_name' => 'icon_type',
						'heading' 	 => __( 'Icon Type', 'oneway' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							'Icon Fonts' => 'icon_fonts',
							'Graphics'   => 'graphics',
						)
					),
					array(
						'param_name' => 'graphic',
						'heading' 	 => __( 'Choose Images', 'oneway' ),
						'type' 		 => 'attach_image',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'graphics' )
						),
					),
					array(
						'param_name' => 'icon_hover',
						'heading' 	 => __( 'Enable hover effect', 'contractor' ),
						'type' 		 => 'checkbox',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_fonts' )
						),
						'value'      => array(
							'' => 'true'
						)
					),
					array(
						'param_name' => 'icon',
						'heading' 	 => __( 'Choose Icon', 'contractor' ),
						'type' 		 => 'k2t_icon',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_fonts' )
						),
						'value'      => '',
					),
					array(
						'param_name'  => 'icon_font_size',
						'heading'     => __( 'Icon size', 'contractor' ),
						'type'        => 'textfield',
						'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_fonts' )
						),
					),
					array(
						'param_name' => 'icon_color',
						'heading' 	 => __( 'Icon Color', 'oneway' ),
						'type' 		 => 'colorpicker',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_fonts' )
						),
					),
					array(
						'param_name' => 'icon_background',
						'heading' 	 => __( 'Icon Background', 'oneway' ),
						'type' 		 => 'colorpicker',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_fonts' )
						),
					),
					array(
						'param_name'  => 'icon_border_color',
						'heading'     => __( 'Icon Border Color', 'contractor' ),
						'type'        => 'colorpicker',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_fonts' ),
						),
					),
					array(
						'param_name' => 'icon_border_style',
						'heading'    => __( 'Icon Border Style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Solid', 'contractor' )  => 'solid',
							__( 'Dashed', 'contractor' ) => 'dashed'
						),
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_fonts' ),
						)
					),
					array(
						'param_name'  => 'icon_border_width',
						'heading'     => __( 'Icon Border Width', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_fonts' ),
						),
					),
					array(
						'param_name'  => 'icon_border_radius',
						'heading'     => __( 'Icon Border Radius', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
						'dependency' => array(
							'element' => 'icon_type',
							'value'   => array( 'icon_fonts' ),
						),
					),
					array(
						'param_name' => 'align',
						'heading' 	 => __( 'Icon Align', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Left', 'contractor' )   => 'left',
							__( 'Center', 'contractor' ) => 'center',
							__( 'Right', 'contractor' )  => 'right'
						),
					),
					array(
						'param_name'  => 'link',
						'heading'     => __( 'Link to', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'link_text',
						'heading'     => __( 'Link text', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'content',
						'heading'     => __( 'Content', 'contractor' ),
						'type'        => 'textarea_html',
						'holder'      => 'div',
						'value'       => ''
					),
					array(
						'param_name'  => 'box_background_color',
						'heading'     => __( 'Box background Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name' => 'box_border',
						'heading' 	 => __( 'Box Border', 'contractor' ),
						'type' 		 => 'checkbox',
						'value'      => array(
							'' => 'true'
						)
					),
					array(
						'param_name'  => 'box_border_color',
						'heading'     => __( 'Box Border Color', 'contractor' ),
						'type'        => 'colorpicker',
						'dependency' => array(
							'element' => 'box_border',
							'value'   => array( 'true' ),
						),
					),
					array(
						'param_name' => 'box_shadow',
						'heading' 	 => __( 'Box Shadow', 'contractor' ),
						'type' 		 => 'checkbox',
						'value'      => array(
							'' => 'true'
						),
						'dependency' => array(
							'element' => 'layout',
							'value'   => array( '1' ),
						),
					),
					$k2t_margin_top,
					$k2t_margin_right,
					$k2t_margin_bottom,
					$k2t_margin_left,
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_icon_box );

			/*  [ Icon List ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_icon_list = array(
				'base'            => 'iconlist',
				'name'            => __( 'Icon List', 'contractor' ),
				'icon'            => 'fa fa-list',
				'category'        => __( 'Typography', 'contractor' ),
				'as_parent'       => array( 'only' => 'li' ),
				'content_element' => true,
				'js_view'         => 'VcColumnView',
				'params'          => array(
					array(
						'param_name' => 'icon',
						'heading' 	 => __( 'Choose Icon', 'contractor' ),
						'type' 		 => 'k2t_icon',
						'value'      => '',
					),
					array(
						'param_name'  => 'color',
						'heading'     => __( 'Icon Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			$k2t_icon_list_item = array(
				'base'            => 'li',
				'name'            => __( 'Icon List', 'contractor' ),
				'icon'            => 'fa fa-ellipsis-v',
				'category'        => __( 'Typography', 'contractor' ),
				'as_child'        => array( 'only' => 'iconlist' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'title',
						'heading'     => __( 'Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'icon',
						'heading' 	 => __( 'Choose Icon', 'contractor' ),
						'type' 		 => 'k2t_icon',
						'value'      => '',
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
				)
			);
			vc_map( $k2t_icon_list );
			vc_map( $k2t_icon_list_item );
			
			/*  [ Icon Box List ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_icon_box_list = array(
				'base'            => 'iconbox_list',
				'name'            => __( 'Icon Box List', 'contractor' ),
				'icon'            => 'fa fa-file-text',
				'category'        => __( 'Marketing', 'contractor' ),
				'as_parent'       => array( 'only' => 'li' ),
				'content_element' => true,
				'js_view'         => 'VcColumnView',
				'params'          => array(
					array(
						'param_name' => 'style',
						'heading' 	 => __( 'Style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Style 1', 'contractor' ) => '1',
							__( 'Style 2', 'contractor' ) => '2',
							__( 'Style 3', 'contractor' ) => '3',
						)
					),
					array(
						'param_name' => 'align',
						'heading' 	 => __( 'Align', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Left', 'contractor' ) => 'left',
							__( 'Right', 'contractor' ) => 'right',
						),
						'dependency' => array(
							'element' => 'style',
							'value'   => array( '3' )
						),
					),
					$k2t_id,
					$k2t_class
				)
			);
			$k2t_icon_box_list_item = array(
				'base'            => 'li',
				'name'            => __( 'Icon List Item', 'contractor' ),
				'icon'            => 'fa fa-ellipsis-v',
				'category'        => __( 'Typography', 'contractor' ),
				'as_child'        => array( 'only' => 'iconbox_list' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'title',
						'heading'     => __( 'Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'icon',
						'heading' 	 => __( 'Choose Icon', 'contractor' ),
						'type' 		 => 'k2t_icon',
						'value'      => '',
					),
					array(
						'param_name'  => 'content_icon_box',
						'heading'     => __( 'Content', 'contractor' ),
						'type'        => 'textarea',
						'holder'      => 'div',
						'value'       => ''
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
				)
			);
			vc_map( $k2t_icon_box_list );
			vc_map( $k2t_icon_box_list_item );

			/*  [ Member ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_member = array(
				'base'            => 'member',
				'name'            => __( 'Member', 'contractor' ),
				'icon'            => 'fa fa-user',
				'category'        => __( 'Common', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name' => 'style',
						'heading' 	 => __( 'Style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Style 1', 'contractor' ) => '1',
							__( 'Style 2', 'contractor' ) => '2',
							__( 'Style 3', 'contractor' ) => '3',
							__( 'Style 4', 'contractor' ) => '4'
						),
					),
					array(
						'param_name'  => 'image',
						'heading'     => __( 'Member Avatar', 'contractor' ),
						'type'        => 'attach_image',
						'holder'      => 'div',
					),
					array(
						'param_name'  => 'name',
						'heading'     => __( 'Member Name', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'role',
						'heading'     => __( 'Role', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'facebook',
						'heading'     => __( 'Facebook URL', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'twitter',
						'heading'     => __( 'Twitter URL', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'skype',
						'heading'     => __( 'Skype', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'pinterest',
						'heading'     => __( 'Pinterest URL', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'instagram',
						'heading'     => __( 'Instagram', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'dribbble',
						'heading'     => __( 'Dribbble URL', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'google_plus',
						'heading'     => __( 'Google Plus URL', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'content',
						'heading'     => __( 'Member Info', 'contractor' ),
						'type'        => 'textarea_html',
						'holder'      => 'div',
						'value'       => ''
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_member );

			/*  [ Pie Chart ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_pie_chart = array(
				'base'            => 'piechart',
				'name'            => __( 'Pie Chart', 'contractor' ),
				'icon'            => 'fa fa-pie-chart',
				'category'        => __( 'Common', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'percent',
						'heading'     => __( 'Percent', 'contractor' ),
						'description' => __( 'Numeric value only, between 1-100.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'color',
						'heading'     => __( 'Outer Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'trackcolor',
						'heading'     => __( 'Track Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'textcolor',
						'heading'     => __( 'Text Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'textbackground',
						'heading'     => __( 'Text Background', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'title',
						'heading'     => __( 'Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'icon',
						'heading' 	 => __( 'Choose Icon', 'contractor' ),
						'type' 		 => 'k2t_icon',
						'value'      => '',
					),
					array(
						'param_name'  => 'text',
						'heading'     => __( 'Text', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'thickness',
						'heading'     => __( 'Thickness', 'contractor' ),
						'description' => __( 'Numeric value only.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'speed',
						'heading'     => __( 'Speed', 'contractor' ),
						'description' => __( 'Numeric value only, 1000 = 1second.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'delay',
						'heading'     => __( 'Delay', 'contractor' ),
						'description' => __( 'Numeric value only.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'size',
						'heading'     => __( 'Size', 'contractor' ),
						'description' => __( 'Numeric value only, size = width = height, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'linecap',
						'heading' 	 => __( 'Linecap', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Butt', 'contractor' )   => 'butt',
							__( 'Square', 'contractor' ) => 'square',
							__( 'Round', 'contractor' )  => 'round'
						),
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_pie_chart );

			/*  [ Pricing Table ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_pricing = array(
				'base'            => 'pricing',
				'name'            => __( 'Pricing Table', 'contractor' ),
				'icon'            => 'fa fa-table',
				'category'        => __( 'Marketing', 'contractor' ),
				'as_parent'       => array( 'only' => 'pricing_column' ),
				'content_element' => true,
				'js_view'         => 'VcColumnView',
				'params'          => array(
					array(
						'param_name' => 'separated',
						'heading' 	 => __( 'Separated', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'True', 'contractor' )  => 'true',
							__( 'False', 'contractor' ) => 'false',
						)
					),
					$k2t_id,
					$k2t_class
				)
			);
			$k2t_pricing_item = array(
				'base'            => 'pricing_column',
				'name'            => __( 'Pricing Columns', 'contractor' ),
				'icon'            => 'fa fa-table',
				'category'        => __( 'Marketing', 'contractor' ),
				'as_child'        => array( 'only' => 'pricing' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'title',
						'heading'     => __( 'Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'price',
						'heading'     => __( 'Price', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'old_price',
						'heading'     => __( 'Old Price', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'price_per',
						'heading'     => __( 'Price Per', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'unit',
						'heading'     => __( 'Unit', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'link',
						'heading'     => __( 'Link to', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'link_text',
						'heading'     => __( 'Link Text', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'target',
						'heading' 	 => __( 'Link Target', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Open in a new window', 'contractor' )                      => '_blank',
							__( 'Open in the same frame as it was clicked', 'contractor' )  => '_self'
						),
					),
					array(
						'param_name' => 'featured',
						'heading' 	 => __( 'Featured', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'False', 'contractor' ) => 'false',
							__( 'True', 'contractor' )  => 'true',
						)
					),
					array(
						'param_name' => 'featured_list',
						'heading' 	 => __( 'Featured List', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'False', 'contractor' ) => 'false',
							__( 'True', 'contractor' )  => 'true',	
						)
					),
					array(
						'param_name'  => 'color',
						'heading'     => __( 'Background Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'pricing_content',
						'heading'     => __( 'List Item', 'contractor' ),
						'description' => __( 'Using ul li tag.', 'contractor' ),
						'type'        => 'textarea_html',
						'holder'      => 'div',
						'value'       => ''
					),
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_pricing );
			vc_map( $k2t_pricing_item );

			/*  [ Process ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_process = array(
				'base'            => 'process',
				'name'            => __( 'Process', 'contractor' ),
				'icon'            => 'fa fa-arrows-h',
				'category'        => __( 'Common', 'contractor' ),
				'as_parent'       => array( 'only' => 'step' ),
				'content_element' => true,
				'js_view'         => 'VcColumnView',
				'params'          => array(
					array(
						'param_name'  => 'process_style',
						'heading' 	  => __( 'Process Style', 'contractor' ),
						'type' 		  => 'dropdown',
						'value'       => array(
							__( 'Line style', 'contractor' ) => 'style-line',
							__( 'Box style', 'contractor' ) => 'style-box',
						),
					),
					$k2t_id,
					$k2t_class
				)
			);
			$k2t_process_step = array(
				'base'            => 'step',
				'name'            => __( 'Step', 'contractor' ),
				'icon'            => 'fa fa-arrows-h',
				'category'        => __( 'Common', 'contractor' ),
				'as_child'        => array( 'only' => 'process' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'title',
						'heading'     => __( 'Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'icon',
						'heading' 	 => __( 'Choose Icon', 'contractor' ),
						'type' 		 => 'k2t_icon',
						'value'      => '',
					),
					array(
						'param_name'  => 'featured',
						'heading'     => __( 'Featured', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => 'true'
						)
					),
					array(
						'param_name'  => 'step_content',
						'heading'     => __( 'Text', 'contractor' ),
						'type'        => 'textarea',
						'holder'      => 'div',
						'value'       => ''
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_process );
			vc_map( $k2t_process_step );

			/*  [ Progress ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_progress = array(
				'base'            => 'progress',
				'name'            => __( 'Progress', 'contractor' ),
				'icon'            => 'fa fa-sliders',
				'category'        => __( 'Common', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'percent',
						'heading'     => __( 'Percent', 'contractor' ),
						'description' => __( 'Numeric value only, between 1-100.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'color',
						'heading'     => __( 'Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'background_color',
						'heading'     => __( 'Background Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'text_color',
						'heading'     => __( 'Text Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'title',
						'heading'     => __( 'Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'height',
						'heading'     => __( 'Height', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'striped',
						'heading'     => __( 'Striped', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => 'true'
						)
					),
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_progress );

			/*  [ Responsive Text ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_responsive_text = array(
				'base'            => 'responsive_text',
				'name'            => __( 'Responsive text', 'contractor' ),
				'icon'            => 'fa fa-arrows-alt',
				'category'        => __( 'Typography', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'compression',
						'heading'     => __( 'Compression', 'contractor' ),
						'description' => __( 'Numeric value only.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'min_size',
						'heading'     => __( 'Min Font Size', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'max_size',
						'heading'     => __( 'Max Font Size', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_responsive_text );

			/*  [ Sticky Tab ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_sticky_tab = array(
				'base'            => 'sticky_tab',
				'name'            => __( 'Sticky Tab', 'contractor' ),
				'icon'            => 'fa fa-bookmark',
				'category'        => __( 'Structure', 'contractor' ),
				'as_parent'       => array( 'only' => 'tab' ),
				'content_element' => true,
				'js_view'         => 'VcColumnView',
				'params'          => array(
					array(
						'param_name'  => 'background_color',
						'heading'     => __( 'Background Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'padding_top',
						'heading'     => __( 'Padding Top', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'padding_bottom',
						'heading'     => __( 'Padding Bottom', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_class
				)
			);
			/*  [ Tab ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_tab = array(
				'base'            => 'tab',
				'name'            => __( 'Tab item', 'contractor' ),
				'icon'            => 'fa fa-ellipsis-h',
				'category'        => __( 'Structure', 'contractor' ),
				'as_child'       => array( 'only' => 'sticky_tab' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'title',
						'heading'     => __( 'Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'content_tab',
						'heading'     => __( 'Content', 'contractor' ),
						'description' => __( 'Enter your content.', 'contractor' ),
						'type'        => 'textarea',
						'holder'      => 'div',
						'value'       => ''
					),
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_sticky_tab );
			vc_map( $k2t_tab );

			/*  [ Testimonial ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_textimonial = array(
				'base'            => 'testimonial',
				'name'            => __( 'Testimonial', 'contractor' ),
				'icon'            => 'fa fa-comments-o',
				'category'        => __( 'Marketing', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name' => 'style',
						'heading' 	 => __( 'Style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Style 1', 'contractor' ) => '1',
							__( 'Style 2', 'contractor' ) => '2',
							__( 'Style 3', 'contractor' ) => '3',
						)
					),
					array(
						'param_name'  => 'image',
						'heading'     => __( 'Avatar', 'contractor' ),
						'description' => __( 'Choose avatar for testimonial author.', 'contractor' ),
						'type'        => 'attach_image',
						'holder'      => 'div',
					),
					array(
						'param_name' => 'align',
						'heading' 	 => __( 'Avatar Position', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Left', 'contractor' )  => 'left',
							__( 'Right', 'contractor' ) => 'right',
						),
						'dependency' => array(
							'element' => 'style',
							'value'   => array( '1' )
						),
					),
					array(
						'param_name'  => 'name',
						'heading'     => __( 'Name', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'position',
						'heading'     => __( 'Position', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'link_name',
						'heading'     => __( 'Link to', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'target',
						'heading' 	 => __( 'Link Target', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Open in a new window', 'contractor' ) => '_blank',
							__( 'Open in the same frame as it was clicked', 'contractor' )  => '_self'
						),
					),
					array(
						'param_name'  => 'content',
						'heading'     => __( 'Text', 'contractor' ),
						'description' => __( 'Enter your testimonial.', 'contractor' ),
						'type'        => 'textarea_html',
						'holder'      => 'div',
						'value'       => ''
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_textimonial );

			/*  [ Blockquote ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_blockquote = array(
				'base'            => 'blockquote',
				'name'            => __( 'Blockquote', 'contractor' ),
				'icon'            => 'fa fa-quote-left',
				'category'        => __( 'Typography', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name' => 'style',
						'heading' 	 => __( 'Style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Style 1', 'contractor' )   => '1',
							__( 'Style 2', 'contractor' )   => '2',
						),
					),
					array(
						'param_name' => 'align',
						'heading' 	 => __( 'Align', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Left', 'contractor' )   => 'left',
							__( 'Center', 'contractor' ) => 'center',
							__( 'Right', 'contractor' )  => 'right'
						),
					),
					array(
						'param_name'  => 'author',
						'heading'     => __( 'Author', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'link_author',
						'heading'     => __( 'Link to', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'content',
						'heading'     => __( 'Content', 'contractor' ),
						'type'        => 'textarea_html',
						'holder'      => 'div',
						'value'       => ''
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_blockquote );

			/*  [ Countdown ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_countdown = array(
				'base'            => 'countdown',
				'name'            => __( 'Countdown', 'contractor' ),
				'icon'            => 'fa fa-sort-numeric-desc',
				'category'        => __( 'Common', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'style',
						'heading'     => __( 'Countdown Style', 'contractor' ),
						'type' 		  => 'dropdown',
						'value'       => array(
							__( 'Square', 'contractor' )   			=> 'square',
							__( 'Square Fill Color', 'contractor' )   => 'square-fill',
							__( 'Circle', 'contractor' )   			=> 'circle',
							__( 'Circle Fill Color', 'contractor' )   => 'circle-fill',
							__( 'Solid', 'contractor' )  				=> 'solid',
						),
					),
					array(
						'param_name'  => 'time',
						'heading'     => __( 'Time', 'contractor' ),
						'description' => __( 'The time in this format: YYYY-MM-DD-HH-MM-SS', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'year',
						'heading'     => __( 'The word "Year(s)" in your language', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'month',
						'heading'     => __( 'The word "Month(s)" in your language', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'day',
						'heading'     => __( 'The word "Day(s)" in your language', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'hour',
						'heading'     => __( 'The word "Hour(s)" in your language', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'minute',
						'heading'     => __( 'The word "Minute(s)" in your language', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'second',
						'heading'     => __( 'The word "Second(s)" in your language', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'fontsize',
						'heading'     => __( 'Font Size', 'contractor' ),
						'description' => __( 'Numeric value only, unit is pixel', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'align',
						'heading' 	 => __( 'Align', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Left', 'contractor' )   => 'left',
							__( 'Center', 'contractor' ) => 'center',
							__( 'Right', 'contractor' )  => 'right'
						),
					),
					array(
						'param_name'  => 'background_color',
						'heading'     => __( 'Background Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'text_color',
						'heading'     => __( 'Number Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_countdown );

			/*  [ Embed ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_embed = array(
				'base'            => 'k2t_embed',
				'name'            => __( 'Embed', 'contractor' ),
				'icon'            => 'fa fa-terminal',
				'category'        => __( 'Media', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'width',
						'heading'     => __( 'Width', 'contractor' ),
						'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'content',
						'heading'     => __( 'URL or embed code', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
						'value'       => ''
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_embed );

			/*  [ K2T Slider ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_slider = array(
				'base'            => 'k2t_slider',
				'name'            => __( 'K2T Carousel', 'contractor' ),
				'icon'            => 'fa fa-exchange',
				'category'        => __( 'Content', 'contractor' ),
				'as_parent'       => array( 'only' => 'testimonial, vc_single_image, vc_raw_html, event' ),
				'js_view'         => 'VcColumnView',
				'content_element' => true,
				'params'          => array(
					array(
						'param_name' => 'style',
						'heading' 	 => __( 'Style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Style 1', 'contractor' )    => 'style_1',
							__( 'Style 2', 'contractor' )    => 'style_2',
						),
					),
					array(
						'param_name'  => 'items',
						'heading'     => __( 'Slides per view', 'contractor' ),
						'description' => __( 'Numeric value only.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
					),
					array(
						'param_name'  => 'items_desktop',
						'heading'     => __( 'Slides per view on desktop', 'contractor' ),
						'description' => __( 'Item to display for desktop small (device width <= 1200px).', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
					),
					array(
						'param_name'  => 'items_tablet',
						'heading'     => __( 'Slides per view on tablet', 'contractor' ),
						'description' => __( 'Item to display for tablet (device width <= 768px).', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
					),
					array(
						'param_name'  => 'items_mobile',
						'heading'     => __( 'Slides per view on mobile', 'contractor' ),
						'description' => __( 'Item to display for mobile (device width <= 480px).', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
					),
					array(
						'param_name'  => 'single_item',
						'heading'     => __( 'Single Item', 'contractor' ),
						'description' => __( 'Display only one item.', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => true
						),
						'dependency' => array(
							'element' => 'style',
							'value'   => array( 'style_1' ),
						),
					),
					array(
						'param_name'  => 'slide_speed',
						'heading'     => __( 'Slide speed', 'contractor' ),
						'description' => __( 'Slide speed in milliseconds.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div',
						'dependency' => array(
							'element' => 'style',
							'value'   => array( 'style_1' ),
						),
					),
					array(
						'param_name'  => 'auto_play',
						'heading'     => __( 'Auto Play', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => true
						),
						'dependency' => array(
							'element' => 'style',
							'value'   => array( 'style_1' ),
						),
					),
					array(
						'param_name'  => 'stop_on_hover',
						'heading'     => __( 'Stop on hover', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => true
						),
						'dependency' => array(
							'element' => 'auto_play',
							'value'   => array( '1' ),
						),
					),
					array(
						'param_name'  => 'navigation',
						'heading'     => __( 'Navigation', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => true
						),
						'dependency' => array(
							'element' => 'style',
							'value'   => array( 'style_1' ),
						),
					),
					array(
						'param_name'  => 'pagination',
						'heading'     => __( 'Pagination', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => true
						),
						'dependency' => array(
							'element' => 'style',
							'value'   => array( 'style_1' ),
						),
					),
					array(
						'param_name' => 'pagi_pos',
						'heading' 	 => __( 'Pagination Position', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Top', 'contractor' )    => 'top',
							__( 'Bottom', 'contractor' ) => 'bottom',
							__( 'On Slider', 'contractor' ) => 'on_slider',
						),
						'dependency' => array(
							'element' => 'pagination',
							'value'   => array( '1' ),
						),
					),
					array(
						'param_name' => 'pagi_style',
						'heading' 	 => __( 'Pagination Style', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Style 1', 'contractor' ) => '1',
							__( 'Style 2', 'contractor' ) => '2',
						),
						'dependency' => array(
							'element' => 'pagination',
							'value'   => array( '1' ),
						),
					),
					array(
						'param_name'  => 'lazyLoad',
						'heading'     => __( 'LazyLoad', 'contractor' ),
						'description' => __( 'Delays loading of images. Images outside of viewport won\'t be loaded before user scrolls to them. Great for mobile devices to speed up page loadings.', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'value'       => array(
							'' => true
						)
					),
					$k2t_class
				)
			);
			vc_map( $k2t_slider );

			/*  [ Blog Post ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_blog_post = array(
				'base'            => 'blog_post',
				'name'            => __( 'Blog Post', 'contractor' ),
				'icon'            => 'fa fa-file-text',
				'category'        => __( 'Content', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'limit',
						'heading'     => __( 'Number of posts to show', 'contractor' ),
						'description' => __( 'Empty is show all posts.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'cat',
						'heading'     => __( 'Show posts associated with certain categories', 'contractor' ),
						'description' => __( 'Using category id, separate multiple categories with commas.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'slider',
						'heading' 	 => __( 'Enable Slider', 'contractor' ),
						'type' 		 => 'checkbox',
						'value'      => array(
							'' => true
						),
					),
					array(
						'param_name'  => 'items',
						'heading'     => __( 'Items', 'contractor' ),
						'description' => __( 'Numeric value only.', 'contractor' ),
						'type'        => 'textfield',
						'dependency' => array(
							'element' => 'slider',
							'value'   => array( '1' ),
						),
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'items_desktop',
						'heading'     => __( 'Items for Desktop small', 'contractor' ),
						'description' => __( 'Item to display for desktop small (device width <= 1366px).', 'contractor' ),
						'type'        => 'textfield',
						'dependency' => array(
							'element' => 'slider',
							'value'   => array( '1' ),
						),
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'items_tablet',
						'heading'     => __( 'Items for Tablet', 'contractor' ),
						'description' => __( 'Item to display for tablet (device width <= 768px).', 'contractor' ),
						'type'        => 'textfield',
						'dependency' => array(
							'element' => 'slider',
							'value'   => array( '1' ),
						),
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'items_mobile',
						'heading'     => __( 'Items for Mobile', 'contractor' ),
						'description' => __( 'Item to display for mobile (device width <= 480px).', 'contractor' ),
						'type'        => 'textfield',
						'dependency' => array(
							'element' => 'slider',
							'value'   => array( '1' ),
						),
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'navigation',
						'heading'     => __( 'Navigation', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'dependency' => array(
							'element' => 'slider',
							'value'   => array( '1' ),
						),
						'value'       => array(
							'' => 'true'
						)
					),
					array(
						'param_name'  => 'auto_play',
						'heading'     => __( 'Auto Play', 'contractor' ),
						'type'        => 'checkbox',
						'holder'      => 'div',
						'dependency' => array(
							'element' => 'slider',
							'value'   => array( '1' ),
						),
						'value'       => array(
							'' => 'true'
						)
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_blog_post );

			/*  [ Event ]
			- - - - - - - - - - - - - - - - - - - */
			$k2t_event = array(
				'base'            => 'event',
				'name'            => __( 'Events', 'contractor' ),
				'icon'            => 'fa fa-list-alt',
				'category'        => __( 'Content', 'contractor' ),
				'content_element' => true,
				'params'          => array(
					array(
						'param_name'  => 'event_title',
						'heading'     => __( 'Event Title', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'date',
						'heading'     => __( 'Event Date', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'month',
						'heading'     => __( 'Event Month', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'start_time',
						'heading'     => __( 'Start Time', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'end_time',
						'heading'     => __( 'End Time', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'location',
						'heading'     => __( 'Location', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'content',
						'heading'     => __( 'Content', 'contractor' ),
						'type'        => 'textarea_html',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'link',
						'heading'     => __( 'Link To', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name' => 'target',
						'heading' 	 => __( 'Link Target', 'contractor' ),
						'type' 		 => 'dropdown',
						'value'      => array(
							__( 'Open in a new window', 'contractor' )                      => '_blank',
							__( 'Open in the same frame as it was clicked', 'contractor' )  => '_self'
						),
					),
					array(
						'param_name'  => 'background_color',
						'heading'     => __( 'Event Background Color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'border_top_width',
						'heading'     => __( 'Border top width', 'contractor' ),
						'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'border_top_color',
						'heading'     => __( 'Border top color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					array(
						'param_name'  => 'border_bottom_width',
						'heading'     => __( 'Border bottom width', 'contractor' ),
						'description' => __( 'Numeric value only, Unit is Pixel.', 'contractor' ),
						'type'        => 'textfield',
						'holder'      => 'div'
					),
					array(
						'param_name'  => 'border_bottom_color',
						'heading'     => __( 'Border bottom color', 'contractor' ),
						'type'        => 'colorpicker',
					),
					$k2t_animation,
					$k2t_animation_name,
					$k2t_animation_delay,
					$k2t_id,
					$k2t_class
				)
			);
			vc_map( $k2t_event );
		}

		add_action( 'admin_init', 'k2t_vc_map_shortcodes' );

		/*  [ Extend container class (parents) ]
		- - - - - - - - - - - - - - - - - - - - - - - - - */
		class WPBakeryShortCode_Accordion extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_Brands extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_Iconlist extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_Iconbox_List extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_Pricing extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_Process extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_Sticky_Tab extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_K2t_Slider extends WPBakeryShortCodesContainer {}

		/*  [ Extend shortcode class (children) ]
		- - - - - - - - - - - - - - - - - - - - - - - - - */
		class WPBakeryShortCode_Toggle extends WPBakeryShortCode {}
		class WPBakeryShortCode_Brand extends WPBakeryShortCode {}
		class WPBakeryShortCode_Li extends WPBakeryShortCode {}
		class WPBakeryShortCode_Pricing_Column extends WPBakeryShortCode {}
		class WPBakeryShortCode_Step extends WPBakeryShortCode {}
		class WPBakeryShortCode_Tab extends WPBakeryShortCode {}

	endif;
endif;

/*-------------------------------------------------------------------
	Remove Default Visual Composer Shortcode.
--------------------------------------------------------------------*/
if ( class_exists( 'Vc_Manager' ) ) :
	if ( ! function_exists( 'k2t_remove_default_shortcodes' ) ) :

		function k2t_remove_default_shortcodes() {
			vc_remove_element( 'vc_accordion' );
			vc_remove_element( 'vc_pie' );
			vc_remove_element( 'vc_posts_slider' );
			vc_remove_element( 'vc_widget_sidebar' );
			vc_remove_element( 'vc_button' );
			vc_remove_element( 'vc_carousel' );
			vc_remove_element( 'vc_button2' );
			vc_remove_element( 'vc_cta_button' );
			vc_remove_element( 'vc_cta_button2' );
			vc_remove_element( 'vc_progress_bar' );
			vc_remove_element( 'vc_gmaps' );
			vc_remove_element( 'vc_flickr' );
		}
		add_action( 'admin_init', 'k2t_remove_default_shortcodes' );

	endif;
endif;

/*-------------------------------------------------------------------
	Remove Teaser Metabox.
--------------------------------------------------------------------*/
if ( class_exists( 'Vc_Manager' ) ) :
	if ( is_admin() ) :
		if ( ! function_exists( 'k2t_vc_remove_teaser_metabox' ) ) :

		function k2t_vc_remove_teaser_metabox() {
			$post_types = get_post_types( '', 'names' ); 
			foreach ( $post_types as $post_type ) {
				remove_meta_box( 'vc_teaser',  $post_type, 'side' );
			}
		}

		add_action( 'do_meta_boxes', 'k2t_vc_remove_teaser_metabox' );

		endif;
	endif;
endif;

/*-------------------------------------------------------------------
	Incremental ID Counter for Templates.
--------------------------------------------------------------------*/
if ( class_exists( 'Vc_Manager' ) ) :
	if ( ! function_exists( 'k2t_vc_templates_id_increment' ) ) :

		function k2t_vc_templates_id_increment() {
			static $count = 0; $count++;
			return $count;
		}

	endif;
endif;

