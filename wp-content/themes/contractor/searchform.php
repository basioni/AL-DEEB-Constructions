<?php
/**
 * Search form.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link	http://www.kingkongthemes.com
 */
?>
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" placeholder="<?php echo esc_attr_x( 'Search keywords...', 'contractor' ); ?>" />
		<button type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
	</div>
</form>