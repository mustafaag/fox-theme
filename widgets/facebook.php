<?php
add_action('widgets_init', 'wi_facebook_load_widgets');	
function wi_facebook_load_widgets() {
	register_widget('WI_Widget_Facebook');
}
class WI_Widget_Facebook extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'widget_facebook', 'description' => __('Facebook Likebox Widget','wi'));
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct('facebook', __('Wi:Facebook','wi'), $widget_ops, $control_ops);
	}

	function widget($args, $instance){
		extract($args);

		$url = isset ($instance['url']) ? $instance['url'] : '';
		$stream = ( isset ( $instance['stream'] )  && $instance['stream'] ) ? 'true' : 'false';
		$showfaces = ( isset ( $instance['showfaces'] ) && $instance['showfaces'] ) ? 'true' : 'false';
		$header = ( isset ($instance['header']) && $instance['header'] ) ? 'true' : 'false';
		
		echo ent2ncr($before_widget);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( !empty( $title ) ) {	
			echo ent2ncr($before_title . $title . $after_title);
		}
		
		wp_enqueue_script('wi-facebook');
		
		$like_box_xfbml = "<fb:like-box href=\"$url\" width=\"265\" show_faces=\"$showfaces\" colorscheme=\"light\" border_color=\"#000\" stream=\"$stream\" header=\"$header\"></fb:like-box>";
		echo '<div class="fb-container">' . $like_box_xfbml . '</div>';
		echo ent2ncr($after_widget);
	}
	
	/**
	* Saves the widgets settings.
	*
	*/
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['url'] = $new_instance['url'];
		$instance['header'] = $new_instance['header'];
		$instance['stream'] = $new_instance['stream'];
		$instance['showfaces'] = $new_instance['showfaces'];	
		
		return $instance;
	}
	
	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){
		$defaults = array(
			'title'			=>	'',
			'url'			=>	'http://facebook.com/facebook',
			'showfaces'		=>	true,
			'stream'		=>	true,
			'header'		=>	true,			
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		extract($instance);
		$showfaces = (bool) $instance['showfaces'];
		$stream = (bool)$instance['stream'];
		$header = (bool)$instance['header'];
?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>" style="display:inline-block;width:50px"><?php _e('Title:','wi'); ?></label>
			<input class="widefat" style="width:150px" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
				
		<p><label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php _e('Page URL:','wi'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_attr($url); ?>" /></p>
		
		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('showfaces')); ?>" name="<?php echo esc_attr($this->get_field_name('showfaces')); ?>"<?php checked( $showfaces ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('showfaces')); ?>"><?php _e( 'Show Faces?','wi' ); ?></label></p>
		
		
		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('stream')); ?>" name="<?php echo esc_attr($this->get_field_name('stream')); ?>"<?php checked( $stream ); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('stream')); ?>"><?php _e( 'Show Stream?','wi' ); ?></label></p>
		
		<p><input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('header')); ?>" name="<?php echo esc_attr($this->get_field_name('header')); ?>"<?php checked( $header); ?> />
		<label for="<?php echo esc_attr($this->get_field_id('header')); ?>"><?php _e( 'Show Header?','wi' ); ?></label></p>
		<?php 	
	} //end of form 

} // end class