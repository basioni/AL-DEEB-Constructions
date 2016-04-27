<?php
$block = $block_data[0];
$settings = $block_data[1];
$link_setting = empty($settings[0]) ? '' : $settings[0];
?>
<?php if($block === 'title'): ?>
<h2 class="post-title">
    <?php echo empty($link_setting) || $link_setting!='no_link' ? $this->getLinked($post, $post->title, $link_setting, 'link_title') : $post->title ?>
</h2>
<?php elseif($block === 'image' && !empty($post->thumbnail)): ?>
<div class="post-thumb">
	<div class="post-thumbnail thumbnail-image">
		<?php if ( empty($link_setting) || $link_setting!='no_link' ) :?>
			<div class="layer-table">
				<div class="layer-cell">
					<div class="k2t-mask-icon">
						<a class="k2t-popup-link" href="<?php echo esc_url( $post->link ); ?>"><i class="fa fa-link"></i></a>
					</div>
				</div>
			</div>
		<?php endif;?>
		<div>
			<?php echo $post->thumbnail;?>
		</div>
		<div class="infobox"></div>
	</div>
    <?php //echo empty($link_setting) || $link_setting!='no_link' ? $this->getLinked($post, $post->thumbnail, $link_setting, 'link_image') : $post->thumbnail ?>
</div>
<?php elseif($block === 'text'): ?>
<div class="entry-content">
    <?php echo empty($link_setting) || $link_setting==='text' ?  $post->content : $post->excerpt; ?>
</div>
<?php elseif($block === 'link'): ?>
<div>
<a href="<?php echo esc_url( $post->link ) ?>" class="vc_read_more more-link"
   title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', "js_composer" ), $post->title_attribute ) ); ?>"<?php echo $this->link_target ?>><?php _e( 'Read more', "js_composer" ) ?></a>
</div>
<?php endif; ?>