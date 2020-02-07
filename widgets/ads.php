<?php
/**
* Advertisement
*/
add_action('widgets_init', 'wi_ads_load_widgets');

function wi_ads_load_widgets()
{
	register_widget('WI_Widget_Ads');
}

class WI_Widget_Ads extends WP_Widget {
	
	function __construct() {
		$widget_ops = array('classname' => 'widget_ads', 'description' => __('Banner or Advertisemnet','wi'));
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct('ads', __('Wi:Banner','wi'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance) {
		extract($args);

		echo ent2ncr($before_widget);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( !empty( $title ) ) {	
			echo ent2ncr($before_title . $title . $after_title);
		}
		
		echo '<div class="ad-container">';
			
			$url = isset($instance['url']) ? $instance['url'] : '';
			$image = isset($instance['image']) ? $instance['image'] : '';
			$code = isset($instance['code']) ? $instance['code'] : '';
			
			if (trim($code)) : 
                echo trim($code);
            else:
                
                if (trim($url)) echo '<a href="'.esc_url(trim($url)).'" target="_blank">';
                if ($image) echo '<img src="'.esc_url($image).'" alt="'.basename($image).'" />';
                if (trim($url)) echo '</a>';
        
            endif; // ad code
        
		echo '<div class="clearfix"></div></div>';	// ad-container
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
			$url = isset($instance['url']) ? $instance['url'] : '';
			$image = isset($instance['image']) ? $instance['image'] : '';
			$code = isset($instance['code']) ? $instance['code'] : '';
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php _e('Banner URL','wi') ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php _e('Image URL','wi') ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('code')); ?>"><?php _e('Custom Code','wi') ?></label>
				<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('code')); ?>" name="<?php echo esc_attr($this->get_field_name('code')); ?>"><?php echo esc_textarea($code); ?></textarea>
                <small><?php _e('Use the code if your ad is something like adsense or requires a code snippet.','wi');?></small>
			</p>
			
		<?php			
	}
}
?>