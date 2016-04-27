<?php global $smof_data, $wp_embed; ?>
<?php get_header();?>

<?php if ( have_posts() ): while( have_posts() ): the_post(); ?>

<?php
	$post_format = get_post_format(get_the_ID());
	// Load metadata in portfolio
	$portfolio_client = (function_exists('get_field')) ? get_field('portfolio_client', get_the_ID()) : ''; $portfolio_client = empty($portfolio_client) ? '' : $portfolio_client;
	$portfolio_location = (function_exists('get_field')) ? get_field('portfolio_location', get_the_ID()) : ''; $portfolio_location = empty($portfolio_location) ? '' : $portfolio_location;
	$portfolio_period = (function_exists('get_field')) ? get_field('portfolio_period', get_the_ID()) : ''; $portfolio_period = empty($portfolio_period) ? '' : $portfolio_period;
	$portfolio_custom_name = (function_exists('get_field')) ? get_field('portfolio_custom_name', get_the_ID()) : ''; $portfolio_custom_name = empty($portfolio_custom_name) ? '' : $portfolio_custom_name;
	$portfolio_custom_value = (function_exists('get_field')) ? get_field('portfolio_custom_value', get_the_ID()) : ''; $portfolio_custom_value = empty($portfolio_custom_value) ? '' : $portfolio_custom_value;
	$portfolio_text_link = (function_exists('get_field')) ? get_field('portfolio_text_link', get_the_ID()) : ''; $portfolio_text_link = empty($portfolio_text_link) ? '' : $portfolio_text_link;
	$portfolio_link = (function_exists('get_field')) ? get_field('portfolio_link', get_the_ID()) : ''; $portfolio_link = empty($portfolio_link) ? '' : $portfolio_link;
	
	$hover_link = (function_exists('get_field')) ? get_field('hover_link', get_the_ID()) : ''; $hover_link = empty($hover_link) ? '' : $hover_link;
	$portfolio_video_format_url = (function_exists('get_field')) ? get_field('portfolio_video_format_url', get_the_ID()) : ''; $portfolio_video_format_url = empty($portfolio_video_format_url) ? '' : $portfolio_video_format_url;
	$portfolio_video_code = (function_exists('get_field')) ? get_field('portfolio_video_code', get_the_ID()) : ''; $portfolio_video_code = empty($portfolio_video_code) ? '' : $portfolio_video_code;
	$portfolio_audio_format_url = (function_exists('get_field')) ? get_field('portfolio_audio_format_url', get_the_ID()) : ''; $portfolio_audio_format_url = empty($portfolio_audio_format_url) ? '' : $portfolio_audio_format_url;
	$portfolio_media_file = (function_exists('get_field')) ? get_field('portfolio_media_file', get_the_ID()) : array(); $portfolio_media_file = empty($portfolio_media_file) ? array() : $portfolio_media_file;
	$portfolio_gallery = (function_exists('get_field')) ? get_field('portfolio_gallery', get_the_ID()) : array(); $portfolio_gallery = empty($portfolio_gallery) ? array() : $portfolio_gallery;
	$portfolio_display_info = (function_exists('get_field')) ? get_field('portfolio_display_info', get_the_ID()) : ''; $portfolio_display_info = empty($portfolio_display_info) ? 'excerpt' : $portfolio_display_info;
	$single_display_meta = (function_exists('get_field')) ? get_field('single_display_meta', get_the_ID()) : ''; $single_display_meta = empty($single_display_meta) ? 'show' : $single_display_meta;
	
	
	$portfolio_sidebar_text = (function_exists('get_field')) ? get_field('portfolio_sidebar_text', get_the_ID()) : ''; $portfolio_sidebar_text = empty($portfolio_sidebar_text) ? '' : $portfolio_sidebar_text;
	$display_sticky_sidebar = (function_exists('get_field')) ? get_field('display_sticky_sidebar', get_the_ID(), true) : ''; $display_sticky_sidebar = empty($display_sticky_sidebar) ? 'show' : $display_sticky_sidebar;
	$portfolio_sidebar_content = (function_exists('get_field')) ? get_field('portfolio_sidebar_content', get_the_ID(), true) : ''; $portfolio_sidebar_content = empty($portfolio_sidebar_content) ? 'show' : $portfolio_sidebar_content;
	$portfolio_display_related_post = (function_exists('get_field')) ? get_field('portfolio_display_related_post', get_the_ID(), true) : ''; $portfolio_sidebar_content = empty($portfolio_sidebar_content) ? 'show' : $portfolio_sidebar_content;

?>

<?php
 	$single_layout_class = '';
	if($portfolio_sidebar_content != 'show'){
		$single_layout_class = 'sidebar-right fullwidth';
	}else{
		$single_layout_class = 'sidebar-right has-sidebar';
	}
	
	if($display_sticky_sidebar == 'show') $single_layout_class .= ' has-sticky-sidebar';
	
?>

<article <?php echo post_class('single-project '.$single_layout_class);?>>

<div id="k2t-content" class="k2t-content">

	<?php include ( 'single-portfolio-classic.php' );?>

</div><!-- #k2t-content -->

</article>

<?php endwhile; endif;?>

<?php get_footer();?>