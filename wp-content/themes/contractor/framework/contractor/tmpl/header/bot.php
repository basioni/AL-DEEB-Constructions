<?php
/**
 * The bottom header for theme.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

if ( $smof_data['header_section_3'] != '' ) :
	// Get all data of top header
	$data = json_decode ( $smof_data[ 'header_section_3' ], true );

	// Get number of column display
	$col = $data['columns_num'];
	
	// Get section properties
	$style    = array();
	$hex      = base64_decode($data['setting']['bg_color']);
	$bg_image = base64_decode($data['setting']['bg_image']);
	$opacity  = base64_decode($data['setting']['opacity']);
	$css      = base64_decode($data['setting']['custom_css']);
	$rgb      = k2t_hex2rgb( $hex );

	if ( $opacity ) {
		$a = ',' . $opacity;
	}

	if ( $hex ) {
		$style[] = 'background-color: rgba(' . $rgb['0'] . ',' . $rgb['1'] . ',' . $rgb['2'] . $a .');';
	}
	if ( $bg_image ) {
		$style[] = 'background-image: url( ' . esc_url( $bg_image ) . ' );';
		if ( $hex == '' &&  $opacity != '' ) {
			$style[] = 'opacity: ' . $opacity . ';';
		}
	}
	
	if ( ! empty( $css ) ) {
		echo '<style id="s-header-bot">' . $css . '</style>';
	}

	/**
	 * Bottom header output.
	 *
	 * @since  1.0
	 */
	function k2t_bot_header_value( $data, $id, $section ) {
		$values = $data['columns'][$id]['value'];
		$i = 0;
		foreach ( $values as $val ) {
			if ( function_exists( 'k2t_data' ) ) {
				k2t_data( $id, $i, $section );
			}
			$i++;
		}
	}
	?>
	<div class="k2t-header-bot" style="<?php echo esc_attr( implode( ' ', $style ) ); ?>">
		<div class="k2t-wrap">
			<div class="k2t-row">
				<?php
					$section = 'header_section_3';
					for ( $i = 0; $i < $col; $i++ ) {
					echo '<div class="col-' . $data['columns'][$i]['percent'] . '">';
						k2t_bot_header_value( $data, $i, $section );
					echo '</div>';
					}
				?>
			</div><!-- .row -->
		</div><!-- .k2t-wrap -->
	</div><!-- .k2t-header-bot -->
<?php endif; ?>