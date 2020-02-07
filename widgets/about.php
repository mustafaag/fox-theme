<?php
/**
* About me
*/
add_action('widgets_init', 'wi_about_load_widgets');

function wi_about_load_widgets()
{
	register_widget('WI_Widget_About');
}

class WI_Widget_About extends WP_Widget {
	
	function __construct() {
		$widget_ops = array('classname' => 'widget_about', 'description' => __('About','wi'));
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct('about', __('Wi:About','wi'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance) {
		extract($args);
        
        $image = isset($instance['image']) ? $instance['image'] : '';
		$desc = isset($instance['desc']) ? $instance['desc'] : '';

		echo ent2ncr ($before_widget);
        
        if ( $image ) {
			echo '<figure class="about-image"><img src="'.esc_url($image).'" alt="'.$name.'" /></figure>';		
		}
        
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( !empty( $title ) ) {	
			echo ent2ncr ($before_title . $title . $after_title);
		}
		
		echo '<div class="widget-about">';
		
		if ( $desc ) {
			echo '<div class="desc">' . do_shortcode($desc) . '</div>';
		}
		
		echo '</div><!-- .about-widget -->';
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
			$image = isset($instance['image']) ? $instance['image'] : '';
			$desc = isset($instance['desc']) ? $instance['desc'] : '';
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php _e('Image URL','wi') ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('desc')); ?>"><?php _e('Description (Use &lt;br /&gt; to insert new line)','wi') ?></label>
				<textarea class="widefat" rows="10" id="<?php echo esc_attr($this->get_field_id('desc')); ?>" name="<?php echo esc_attr($this->get_field_name('desc')); ?>"><?php echo esc_textarea($desc); ?></textarea>
			</p>
			
			
		<?php	
	}
}
?>