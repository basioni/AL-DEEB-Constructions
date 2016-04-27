<?php
/**
 * The header for theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */

// Get theme options
global $smof_data;

$classes = array();

// Fixed header
if ( ! empty( $smof_data['fixed-header'] ) ) {
	$classes[] = 'fixed';
}
// Full width header
if ( ! empty( $smof_data['full-header'] ) ) {
	$classes[] = 'full';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( ! empty( $smof_data['pageloader'] ) ) : ?>
	<div id="pageloader">
		<div class="loader-item">
			<img src="<?php echo CONTRACTOR_TEMPLATE_URL . '/assets/img/loader.gif' ?>" alt="loader"  width="48" height="48" />
		</div>
	</div><!-- #pageloader -->
<?php endif; ?>

<div class="k2t-container">

	<header class="k2t-header <?php echo esc_attr( implode( ' ', $classes ) ); ?>" role="banner">
		
		<?php
			// Include top header layout
			if ( ! empty( $smof_data['use-top-header'] ) ) {
				include_once CONTRACTOR_TEMPLATE_TMPL . '/header/top.php';
			}

			// Include middle header layout
			if ( ! empty( $smof_data['use-mid-header'] ) ) {
				include_once CONTRACTOR_TEMPLATE_TMPL . '/header/mid.php';
			}

			// Include bottom header layout
			if ( ! empty( $smof_data['use-bot-header'] ) ) {
				include_once CONTRACTOR_TEMPLATE_TMPL . '/header/bot.php';
			}

			include_once CONTRACTOR_TEMPLATE_TMPL . '/header/responsive.php';
		?>

	</header><!-- .k2t-header -->

	<div class="k2t-body">

		<?php include_once CONTRACTOR_TEMPLATE_TMPL . '/titlebar/title-bar.php'; ?>