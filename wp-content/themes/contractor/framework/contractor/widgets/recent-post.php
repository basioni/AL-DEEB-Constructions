<?php
/**
 * Recent post widget.
 *
 * @package Contractor
 * @author  KingKongThemes
 * @link http://www.kingkongthemes.com
 */

add_action( 'widgets_init', 'k2t_recent_post_load_widgets' );
function k2t_recent_post_load_widgets() {
	register_widget( 'k2t_Widget_Recent_Post' );
}
class k2t_Widget_Recent_Post extends WP_Widget {

	function __construct() {
		$widget_ops  = array( 'classname' => 'k2t_widget_latest_posts', 'description' => '' );
		$control_ops = array( 'width' => 250, 'height' => 350 );
		parent::__construct( 'k2t_recent_post', __( 'Contractor - Recent Post', 'contractor' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		global $post;
		echo $before_widget;
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( ! empty( $title ) ) {
			echo $before_title;
			echo $title ;
			echo $after_title;
		}

		// Load parameter
		$limit         = isset( $instance['limit'] ) ? $instance['limit'] : '';
		$order         = isset( $instance['order'] ) ? $instance['order'] : '';
		$orderby       = isset( $instance['orderby'] ) ? $instance['orderby'] : '';
		$display_thumb = isset( $instance['display_thumb'] ) ? $instance['display_thumb'] : '';
		$display_date  = isset( $instance['display_date'] ) ? $instance['display_date'] : '';

		// Load data
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
		);
		if ( ! empty( $limit ) ) $args['posts_per_page'] = $limit;
		if ( ! empty( $order ) ) $args['order'] = $order;
		if ( ! empty( $orderby ) ) $args['orderby'] = $orderby;

		$recent_posts = get_posts( $args );
		$html = '';
		if ( count( $recent_posts ) > 0 ) {
			$html .= '<div class="posts-list">';
			foreach ( $recent_posts as $post ) {
				setup_postdata( $post );
				$thumbnail_link = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
				$image = aq_resize( $thumbnail_link, 80, 80, true );

				if ( has_post_thumbnail( get_the_ID() ) ) {
					$thumb = '<img src="' . esc_url( $image ) . '" width="80" height="80" alt="' . trim( get_the_title() ) . '" />';
				} else {
					$thumb = '<img src="' . get_template_directory_uri() . '/assets/img/placeholder/80x80.png" alt="' . trim( get_the_title() ) . '" />';
				}
				$thumb_html = '';
				if ( $display_thumb == 'show' ) {
					$thumb_html = '
						<div class="post-thumb">
							<a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" title="' . get_the_title() . '">' . $thumb . '</a>
						</div>
					';
				}
				if ( $display_date == 'show' ) {
					$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
					if ( $num_comments == 0 ) {
						$comments = __( 'No Comments', 'contractor' );
					} elseif ( $num_comments > 1 ) {
						$comments = $num_comments . __(' Comments', 'contractor' );
					} else {
						$comments = __( '1 Comment', 'contractor' );
					}
					$date_html = '
						<div class="post-meta">
							<time datetime="' . get_the_date( 'c' ) . '">' . get_the_date( 'j M Y' ) . '</time>
							<span class="post-cm">' . $comments . '</span>
						</div>
					';
				}
				$html .= '
					<article class="post-item">
						' . $thumb_html . '
						<div class="post-text">
							<h4><a href="' . esc_url( get_permalink( get_the_ID() ) ) . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h4>
							' . $date_html . '
						</div>
					</article>
				';
			}
			$html .= '</div>';
		}
		echo $html;
		echo $after_widget;
		wp_reset_postdata();
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		return $new_instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __( 'Recent Post', 'contractor' ), 'limit' => 5, 'order' => 'desc', 'orderby' => 'title', 'display_thumb' => 'show', 'display_date' => 'show' );
		$instance = wp_parse_args( (array) $instance, $defaults );?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'contractor' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php _e( 'Limit:', 'contractor' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['limit'] ); ?>" />
		</p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php _e( 'Order:', 'contractor' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
                <option <?php echo ( $instance['order'] == 'desc' ) ? 'selected="selected"' : '';?> value="desc"><?php _e( 'DESC', 'contractor' );?></option>
                <option <?php echo ( $instance['order'] == 'asc' ) ? 'selected="selected"' : '';?> value="asc"><?php _e( 'ASC', 'contractor' );?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php _e( 'Orderby:', 'contractor' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
                <option <?php echo ( $instance['orderby'] == 'title' ) ? 'selected="selected"' : '';?> value="title"><?php _e( 'Title', 'contractor' );?></option>
                <option <?php echo ( $instance['orderby'] == 'post_date' ) ? 'selected="selected"' : '';?> value="post_date"><?php _e( 'Date', 'contractor' );?></option>
                <option <?php echo ( $instance['orderby'] == 'rand' ) ? 'selected="selected"' : '';?> value="rand"><?php _e( 'Random', 'contractor' );?></option>
            </select>
        </p>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'display_thumb' ) ); ?>"><?php _e( 'Display Thumbnail:', 'contractor' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'display_thumb' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_thumb' ) ); ?>">
                <option <?php echo ( $instance['display_thumb'] == 'show' ) ? 'selected="selected"' : '';?> value="show"><?php _e( 'Show', 'contractor' );?></option>
                <option <?php echo ( $instance['display_thumb'] == 'hided' ) ? 'selected="selected"' : '';?> value="hided"><?php _e( 'Hide', 'contractor' );?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'display_date' ) ); ?>"><?php _e( 'Display Date and Comments static:', 'contractor' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'display_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_date' ) ); ?>">
                <option <?php echo ( $instance['display_date'] == 'show' ) ? 'selected="selected"' : '';?> value="show"><?php _e( 'Show', 'contractor' );?></option>
                <option <?php echo ( $instance['display_date'] == 'hided' ) ? 'selected="selected"' : '';?> value="hided"><?php _e( 'Hide', 'contractor' );?></option>
            </select>
        </p>
		<?php
	}
}
?>
