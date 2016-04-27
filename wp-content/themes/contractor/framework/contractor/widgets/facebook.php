<?php
/**
 * Facebook widget.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link http://www.kingkongthemes.com
 */

add_action( 'widgets_init', 'k2t_facebook_load_widgets' );
function k2t_facebook_load_widgets() {
	register_widget( 'k2t_Widget_Facebook' );
}
class k2t_Widget_Facebook extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'facebook-likebox', 'description' => __( 'Facebook Likebox Widget', 'contractor' ) );
		$control_ops = array( 'width' => 250, 'height' => 350 );
		parent::__construct( 'k2t_facebook', __( 'Contractor - Facebook', 'contractor' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$url = isset ( $instance['url'] ) ? esc_url( $instance['url'] ) : '';
		$stream = ( isset ( $instance['stream'] )  && $instance['stream'] ) ? 'true' : 'false';
		$colorscheme = isset ( $instance['colorscheme'] ) ? $instance['colorscheme'] : 'dark';
		$border = isset ( $instance['border'] ) ? $instance['border'] : '#333333';
		$showfaces = ( isset ( $instance['showfaces'] ) && $instance['showfaces'] ) ? 'true' : 'false';
		$header = ( isset ( $instance['header'] ) && $instance['header'] ) ? 'true' : 'false';
		$width = isset ( $instance['width'] ) ? $instance['width'] : '253';

		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( !empty( $title ) ) {
			echo $before_title;
			echo '<span>' . $title . '</span>';
			echo $after_title;
		}

		wp_enqueue_script( 'srol-facebook' );

		$like_box_xfbml = "<fb:like-box href=\"esc_url( $url )\" width=\"$width\" show_faces=\"$showfaces\" colorscheme=\"$colorscheme\" border_color=\"$border\" stream=\"$stream\" header=\"$header\"></fb:like-box>";
		echo '<div class="fb-container">' . $like_box_xfbml . '</div>';
		echo $after_widget;
	}

	/**
	 * Saves the widgets settings.
	 *
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['url'] = $new_instance['url'];
		$instance['header'] = $new_instance['header'];
		$instance['stream'] = $new_instance['stream'];
		$instance['colorscheme'] = $new_instance['colorscheme'];
		$instance['border'] = $new_instance['border'];
		$instance['showfaces'] = $new_instance['showfaces'];
		$instance['width'] = $new_instance['width'];


		return $instance;
	}

	/**
	 * Creates the edit form for the widget.
	 *
	 */
	function form( $instance ) {
		$defaults = array(
			'title'   => '',
			'url'   => 'http://facebook.com/facebook',
			'showfaces'  => true,
			'colorscheme' => 'dark',
			'stream'  => true,
			'border'  => '#333333',
			'header'  => true,
			'width'  => '253',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		extract( $instance );
		$showfaces = (bool) $instance['showfaces'];
		$colorscheme = $instance['colorscheme'];
		$stream = (bool)$instance['stream'];
		$border = $instance['border'];
		$header = (bool)$instance['header'];
?>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" style="display:inline-block;width:50px"><?php _e( 'Title:', 'contractor' ); ?></label>
		<input class="widefat" style="width:150px" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php _e( 'Page URL:', 'contractor' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" /></p>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>"><?php _e( 'Width:', 'contractor' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'width' ) ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'showfaces' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showfaces' ) ); ?>"<?php checked( $showfaces ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'showfaces' ) ); ?>"><?php _e( 'Show Faces?', 'contractor' ); ?></label></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'colorscheme' ) ); ?>"><?php _e( 'Color Scheme:', 'contractor' ) ?></label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'colorscheme' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'colorscheme' ) ); ?>">
			<option value="light" <?php selected( $colorscheme, 'light' ) ?>><?php _e( 'Light', 'contractor' );?></option>
			<option value="dark" <?php selected( $colorscheme, 'dark' ) ?>><?php _e( 'Dark', 'contractor' );?></option>
		</select></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'stream' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'stream' ) ); ?>"<?php checked( $stream ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'stream' ) ); ?>"><?php _e( 'Show Stream?', 'contractor' ); ?></label></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'border' ) ); ?>"><?php _e( 'Border Color:', 'contractor' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'border' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'border' ) ); ?>" type="text" value="<?php echo esc_attr( $border ); ?>" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'header' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'header' ) ); ?>"<?php checked( $header ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'header' ) ); ?>"><?php _e( 'Show Header?', 'contractor' ); ?></label></p>
		<?php
	} //end of form

} // end class
