<?php
/**
* Social Icons
*/
add_action('widgets_init', 'wi_social_load_widgets');

function wi_social_load_widgets()
{
	register_widget('WI_Widget_Social');
}

class WI_Widget_Social extends WP_Widget {
	
	function __construct() {
		$widget_ops = array('classname' => 'widget_social', 'description' => __('Display social media icons from options.','wi'));
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct('social', __('Wi:Social','wi'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance) {
		extract($args);

		echo ent2ncr($before_widget);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( !empty( $title ) ) {	
			echo ent2ncr($before_title . $title . $after_title);
		}
		
        echo '<div class="widget-social"><ul>';
        
			wi_social_list();
		
        echo '</ul><div class="clearfix"></div></div>';
        
		echo ent2ncr($after_widget);
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;		
		return $new_instance;
	}

	function form( $instance ) {
	
		$title = isset ( $instance['title'] ) ? $instance['title'] : '';		
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>" style="display:inline-block;width:50px"><?php _e('Title:','wi'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<?php	
	}
}
?>