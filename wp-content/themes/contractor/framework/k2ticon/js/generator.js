/**
 * Script for vc icon and menu icon.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

jQuery.noConflict();

jQuery(function() {

	/*  [ Insert Action ]
	- - - - - - - - - - - - - - - - - - - - */
	var insertIcons = jQuery( '#k2ticon-generator-insert' );
	var modalIcons  = jQuery( '#k2ticon-generator-wrap , #k2ticon-generator-overlay' );

	insertIcons.on( 'click',function() {
		jQuery( '#' + modalIcons.attr( 'for' ) ).val( insertIcons.attr( 'current-value' ) );

		modalIcons.hide();

		insertIcons.attr( 'current-value', '' );

		jQuery( '#' + modalIcons.attr( 'for' ) ).trigger( 'change' );

		jQuery( '#' + modalIcons.attr( 'for' ) ).css( 'width', '283px' );

		jQuery( '[remove-for="' + modalIcons.attr( 'for' ) + '"]' ).removeAttr( 'style' );

		jQuery( '[rel-icon="' + modalIcons.attr( 'for' ) + '"]' ).show();
	});

	/*  [ Select icon ]
	- - - - - - - - - - - - - - - - - - - - */
	jQuery( '.k2ticon-generator-icon-select ul li' ).on( 'click', function() {
		insertIcons.attr( 'current-value',jQuery( this ).children( 'label' ).attr( 'for' ) );
	});

	/*  [ Close modal ]
	- - - - - - - - - - - - - - - - - - - - */
	jQuery( '#k2ticon-generator-close' ).on( 'click', function() {
		modalIcons.hide();
	});

	/*  [ Icon pack select ]
	- - - - - - - - - - - - - - - - - - - - */
	jQuery( '#k2ticon-generator-select-pack' ).change( function() {
		var selectedIcons = jQuery(this).val();
		var listIcons     = jQuery( '.k2ticon-generator-icon-select ul' );
		
		if ( selectedIcons == 'fontawesome-icons-list' ) {
			listIcons.hide();
			jQuery( 'ul.fontawesome-icon-list' ).show();
		} 
		if ( selectedIcons == 'line-icons-list' ) {
			listIcons.hide();
			jQuery( 'ul.line-icon-list' ).show();
		}
	});

	jQuery( '#k2ticon-generator-close-html' ).on( 'click', function() {
		jQuery( '#k2ticon-shortcode-html' ).hide();
	});
});