/**
 * Custom script for Contractor.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link    http://www.kingkongthemes.com
 */
 
(function($) {
	"use strict";

	$(document).ready(function() {

		/*  [ Detecting Mobile Devices ]
		- - - - - - - - - - - - - - - - - - - - */
		var isMobile = {
			Android: function() {
				return navigator.userAgent.match(/Android/i);
			},
			BlackBerry: function() {
				return navigator.userAgent.match(/BlackBerry/i);
			},
			iOS: function() {
				return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			},
			Opera: function() {
				return navigator.userAgent.match(/Opera Mini/i);
			},
			Windows: function() {
				return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
			},
			Desktop: function() {
				return window.innerWidth <= 960;
			},
			any: function() {
				return ( isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows() || isMobile.Desktop() );
			}
		}

		if(top != self) {
		    window.open(self.location.href, '_top');
		}

		/*  [ Sticky menu trigger ]
		- - - - - - - - - - - - - - - - - - - - */
		if ( mainParams.sticky_menu == 'sticky_top' ) {
			var nav = $(".k2t-header-top");
			var waypoint_offset = 20;
		} else if ( mainParams.sticky_menu == 'sticky_mid' ) {
			var nav = $(".k2t-header-mid");
			var waypoint_offset = 50;
		} else if ( mainParams.sticky_menu == 'sticky_bot' ) {
			var nav = $(".k2t-header-bot");
			var waypoint_offset = 30;
		}
		if ( mainParams.sticky_menu == 'sticky_top' || mainParams.sticky_menu == 'sticky_mid' || mainParams.sticky_menu == 'sticky_bot' ) {
			var container = $( '.k2t-header' );
			var top_spacing = 0;
			container.waypoint({
				handler: function (event, direction) {
					if ( direction == 'down' ) {
						container.css({
							'height': nav.outerHeight()
						});
						nav.stop().addClass('sticky').css('top', - nav.outerHeight() ).animate({
							'top': top_spacing
						});
						$('body').addClass('header-sticky');
					} else {
						container.css({
							'height': 'auto'
						});
						nav.stop().removeClass('sticky').css('top', nav.outerHeight() + waypoint_offset).animate({
							'top': ''
						});
						$('body').removeClass('header-sticky');
					}
				},
				offset: function () {
					return - nav.outerHeight() - waypoint_offset;
				}
			});
		}

		/*  [ Vertical header ]
		- - - - - - - - - - - - - - - - - - - - */
		$('#showPushMenu').on('click', function() {
			if ( mainParams.vertical_menu == '1' ){
				$('body').toggleClass('vertical-close');
			}

			// Refresh isotope layout
			setTimeout (function() {
				if ( $().masonry && $().isotope && $().imagesLoaded ) {
			
					$('.k2t-isotope-wrapper').each(function(){
													 
						var $this = $(this);
						var $container = $this.find('.k2t-isotope-container');
						
						// initialize Isotope + Masonry after all images have loaded  
						$this.imagesLoaded( function() {

							$container.addClass('loaded').find('.isotope-selector').find('.article-inner');
							var isotope_args = {
								itemSelector: '.isotope-selector',
								transitionDuration  : '.55s',
								masonry: {
									gutter  : '.gutter-sizer',
									//columnWidth: 
								},
							};
							if ($this.hasClass('isotope-grid')) {
								isotope_args['layoutMode'] = 'fitRows';
							}
							if ($this.hasClass('isotope-no-padding')) {
								delete isotope_args.masonry.gutter; //true
							}
							if ($this.hasClass('isotope-free')) {
								isotope_args.masonry['columnWidth'] = '.width-1';
							}
							$container.isotope(isotope_args);
							
						}); // imagesLoaded
						
					}); // each .k2t-isotope-wrapper
				} // if isotope
			}, 400);
			return false;
		});

		/*  [ Custom RTL Menu ]
		- - - - - - - - - - - - - - - - - - - - */
		if ( ! isMobile.any() ) {
			$( '.sub-menu li' ).on( 'hover', function () {
				var sub_menu = $( this ).find( ' > .sub-menu' );
				if ( sub_menu.length ) {
					if ( sub_menu.outerWidth() > ( $( window ).outerWidth() - sub_menu.offset().left ) ) {
						$( this ).addClass( 'menu-rtl' );
					}
				}
			});
		}

		/*  [ Back to top ]
		- - - - - - - - - - - - - - - - - - - - */
		$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('.k2t-btt').fadeIn('slow');
			} else {
				$('.k2t-btt').fadeOut('slow');
			}
		});
		$( '.k2t-btt' ).click(function () {
			$("html, body").animate({
				scrollTop: 0
			}, 500);
			return false;
		});


		/*  [ Offcanvas Sidebar ]
		- - - - - - - - - - - - - - - - - - - - */
		$( '.open-sidebar' ).on( 'click', function() {
			if ( mainParams.offcanvas_turnon == '1' ){
				$( 'body' ).toggleClass( 'offcanvas-open' );
				$( '.offcanvas-sidebar' ).toggleClass( 'is-open' );
				$(this).toggleClass( 'close-sidebar' );
			}
			return false;
		});

		$( '.k2t-container' ).on( 'click', function(e) {
			if ($(e.target).hasClass( 'open-sidebar' ) || $(e.target).closest( '.open-sidebar' ).length > 0 ) {
				return;
			}
			$( 'body' ).removeClass( 'offcanvas-open' );
			$( '.offcanvas-sidebar' ).removeClass( 'is-open' );
			$( '.open-sidebar' ).removeClass( 'close-sidebar' );
		});

		/*  [ Search Box ]
		- - - - - - - - - - - - - - - - - - - - */
		$( '.search-box i' ).click(function(e) {
			e.stopPropagation();
			var search_form = $( '.k2t-searchbox-mobile' );
			search_form.addClass( 'active' );
			search_form.on('click',function(e) {
				if ( $(e.target).attr('id') == 'searchsubmit-mobile' || $(e.target).attr('id') == 's-mobile') {
					return;
				} else {
					search_form.removeClass( 'active' );
				}
			});
		});

		/*  [ VC Alert close ]
		- - - - - - - - - - - - - - - - - - - - */
		$( '.wpb_alert .close' ).click(function (){
			var parent = $(this).parent();
			parent.css({"opacity":"0", "height":"0", "padding":"0", "margin":"0"});
		});

		/*  [ Menu Responsive ]
		- - - - - - - - - - - - - - - - - - - - */
		jQuery('.mobile-menu-toggle').click(function(e) {
	        jQuery('body').toggleClass('enable-mobile-menu');
			jQuery('body').removeClass('scroll-mobile-menu');
	    });

		/*  [ Remove p empty tag of page builder ]
		- - - - - - - - - - - - - - - - - - - - */
		$('p').each(function() {
			var $this = $(this);
			if($this.html().replace(/\s|&nbsp;/g, '').length == 0) {
				$this.remove();
			}
		});

		/*  [ Performs a smooth page scroll to an anchor ]
		- - - - - - - - - - - - - - - - - - - - */
		$('.scroll').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash),
			   headerH = $('.k2t-header').outerHeight();

			   target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			   if (target.length) {
				   $('html,body').animate({
					  scrollTop: target.offset().top - 170 + "px"
				  }, 1200);
				   return false;
			   }
		   }
		});

		var $logoImg = $('.k2t-logo img');
		if ( $logoImg.css( 'min-height' ) == '1px' ) {
			$logoImg.attr( 'src', $logoImg.attr( 'src' ).replace( 'logo.png', 'logo@2x.png' ) );
		}
	});

	$(window).load(function() {

		/*  [ Page loader effect ]
		- - - - - - - - - - - - - - - - - - - - */
		var self_ = function() {
			$('.loader-item').delay(300).fadeOut('slow');
			$('#pageloader').fadeIn(500).delay(1200).fadeOut('slow');
		};
		self_();

		
		/*  [ Menu One Page ]
		- - - - - - - - - - - - - - - - - - - - */
		var headerH = $(".k2t-header-mid").height();
		var adminbar = $("#wpadminbar").height();
		if (!adminbar) adminbar = 0;
		function i() {
			var e = "";
			var t = "";
			$(".k2t-header .k2t-menu > li").each(function(e) {
				var n = $(this).find("a").attr("href");
				var r = $(this).find("a").attr("data-target");
				if ($(r).length > 0 && $(r).position().top - headerH <= $(document).scrollTop()) {
					t = r
				}
			});
		}
		function set_current_menu_for_scroll(){
			var menu_arr = [];
			var i =  0;
			$(".k2t-header .k2t-menu > li").each(function(e) {
				var n = $(this).find("a").attr("href");
				if (n.charAt(0) == "#" && n.length > 2) {
					menu_arr[i] = n.substr(1, n.length - 1);
					i++;
				}
			});
			if (menu_arr.length > 0){
				jQuery.each( menu_arr, function(){
					if ( $("#" + this).length ) {
						var offset = $("#" + this).offset();
						var posY = offset.top - $(window).scrollTop();
						var posX = offset.left - $(window).scrollLeft(); 
						if(posY > 0){
							var new_active = "#" + this;
							if( jQuery(".k2t-header .k2t-menu > li.active > a").attr("href") == new_active  )
							{}else{
								jQuery(".k2t-header .k2t-menu > li.active").removeClass("active");
								jQuery("[href=#" + this + "]").parent("li").addClass("active");
							}
							return false;
						}
					}
					
				});
			}
		}
		var n = 1e3;
		var r = "#" + $(".k2t-content").attr("id");
		$("body").on("click", ".k2t-header .k2t-menu > li > a", function() {
			var e = $(this).attr("href");
			var i = $(this).attr("data-target");

			$(".k2t-header .k2t-menu > li").each(function(){
				$(this).removeClass("active");
			});
			$(this).parent("li").addClass("active");
			if (e.charAt(0) == "#") {
				i = e
			}
			if ($(i).length > 0) {
				if (e == r) {
					$("html,body").animate({
						scrollTop: 0
					}, n, "easeInOutQuart")
				} else {
					$("html,body").animate({
						scrollTop: $(i).offset().top - headerH - adminbar
					}, n, "easeInOutQuart")
				}
				return false
			}
		});
		
		i();
		$(window).scroll(function() {
			i();
			set_current_menu_for_scroll();
		})
		
		/*  [ Blog masonry trigger ]
		- - - - - - - - - - - - - - - - - - - - */
		if ( mainParams.blog_style == 'masonry' ) {
			var container = document.querySelector('.b-masonry .masonry-layout');
			var msnry = new Masonry( container, {
				itemSelector: '.hentry',
				columnWidth: container.querySelector('.grid-sizer')
			});
		}
	});
})(jQuery);