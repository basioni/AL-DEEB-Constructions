<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme options
global $smof_data;

$single_custom_sidebar    = isset( $smof_data['single-custom-sidebar'] ) ? $smof_data['single-custom-sidebar'] : '';
$single_custom_sidebar    = trim( $single_custom_sidebar );
$single_custom_sidebar_id = ( function_exists( 'get_field' ) ) ? get_field( 'single_custom_sidebar', get_the_ID() ) : ''; 
$single_custom_sidebar    = empty( $single_custom_sidebar_id ) ? $single_custom_sidebar : $single_custom_sidebar_id;
?>

<div class="k2t-sidebar" role="complementary">
	<?php
		if ( empty( $single_custom_sidebar ) ) {
			dynamic_sidebar( 'primary_sidebar' );
		} else {
			dynamic_sidebar( $single_custom_sidebar );
		}
	?>
</div><!-- .k2t-sidebar -->