<?php
/**
* Latest Posts Widget
*/
add_action('widgets_init', 'wi_display_posts_load_widgets');

function wi_display_posts_load_widgets()
{
	register_widget('WI_Widget_Latest_Posts');
}

class WI_Widget_Latest_Posts extends WP_Widget {
	
	function __construct() {
		$widget_ops = array('classname' => 'widget_display_posts', 'description' => __('Display latest posts','wi'));
		$control_ops = array('width' => 250, 'height' => 350);
		parent::__construct('latest-posts', __('Wi:Latest Posts','wi'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance) {
		extract($args);
		$title = isset ( $instance['title'] ) ? $instance['title'] : '';
		$number = isset ( $instance['number'] ) ? $instance['number'] : '4';
		$category = isset ( $instance['category'] ) ? $instance['category'] : '';
		$tag = isset ( $instance['tag'] ) ? $instance['tag'] : '';
		
		echo ent2ncr($before_widget);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( !empty( $title ) ) {	
			echo ent2ncr($before_title . $title . $after_title);
		}
		
		$args = array(
			'post_type'			=>	'post',
			'ignore_sticky_posts'=>	true,
			'posts_per_page'	=>	$number,
		);
		
		if ($category) $args['cat'] = $category;
		if ($tag) $args['tag_id'] = $tag;
		
		$latest = new WP_Query($args);?>
		<?php if ( $latest->have_posts() ):?>
		
			<div class="latest-posts">
                
                <ul class="latest-list">
			
			<?php while( $latest->have_posts() ) : $latest->the_post();?>		
		
				<li class="latest-article format-<?php echo get_post_format() ? get_post_format() : 'standard';?>">
                    
                    <?php if (has_post_thumbnail()):?>
                    <figure class="latest-thumb">
                        <a href="<?php the_permalink();?>">
                            <?php the_post_thumbnail('thumbnail-medium');?>
                        </a>
                    </figure><!-- .latest-thumb -->
                    <?php elseif (  $attachments = get_posts( array(
                        'post_type' => 'attachment',
                        'posts_per_page' => 1,
                        'post_parent' => get_the_ID(),
                    ) )
                                    ): // get all attachemnts ?>
                    
                    <figure class="latest-thumb">
                        <a href="<?php the_permalink();?>">
                            <?php $image = wp_get_attachment_image_src($attachments[0]->ID,'thumbnail-medium');?>
                            <img src="<?php echo esc_url($image[0]);?>" width="<?php echo esc_attr($image[1]);?>" height="<?php echo esc_attr($image[2]);?>" alt="<?php echo get_post_meta($attachments[0]->ID, '_wp_attachment_image_alt', true);?>" />
                            
                        </a>
                    </figure><!-- .latest-thumb -->
                    
                    <?php else: // no attachments ?>
                    <div class="latest-pseudo-thumb latest-thumb">
                        <span class="format-indicator"><i class="fa fa-<?php echo wi_format_icon(get_post_format());?>"></i></span>
                    </div><!-- .latest-thumb -->
                    <?php endif; ?>
                    <section class="latest-content">
                        <time class="latest-date" datetime="<?php echo get_the_date('c');?>"><?php echo get_the_date( get_option('date_format') );?></time>
                        <h3 class="latest-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    </section>
                    
                    <div class="clearfix"></div>
                    
				</li><!-- .post-item -->
		
			<?php endwhile; ?>
                    
                </ul>
			
				<div class="clearfix"></div>
                
			</div><!-- .latest--posts -->
		
		<?php wp_reset_query();?>
					
		<?php endif; // have posts ?>
		<?php echo ent2ncr($after_widget);
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;		
		$instance['title'] = $new_instance['title'];
		$instance['number'] = $new_instance['number'];
		$instance['category'] = $new_instance['category'];
		$instance['tag'] = $new_instance['tag'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'title'			=>	'',
			'number'		=>	4,
			'category'		=>	'',
			'tag'			=>	'',
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		extract($instance);
		?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>" style="display:inline-block;width:50px"><?php _e('Title:','wi'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>	
				
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('Number of posts to show','wi') ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number" value="<?php echo esc_attr($number); ?>" min="1" max="10" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php _e('Display posts from a category? - W/P/L/O/C/K/E/R/./C/O/M','wi') ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('category')); ?>" name="<?php echo esc_attr($this->get_field_name('category')); ?>">
				<option value="" <?php selected($category,'') ?>><?php _e('None','wi'); ?></option>
				<?php
					$args = array();
					$categories = get_categories( $args );
					foreach ($categories as $cate):?>
				<option value="<?php echo esc_attr($cate->term_id);?>" <?php selected($category,$cate->term_id) ?>><?php echo esc_html($cate->name); ?></option>
				<?php	
					endforeach;
				?>	
			</select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('tag')); ?>"><?php _e('Display posts from a tag?','wi') ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('tag')); ?>" name="<?php echo esc_attr($this->get_field_name('tag')); ?>">
				<option value="" <?php selected($tag,'') ?>><?php _e('None','wi'); ?></option>
				<?php
					$args = array('taxonomy'=>'post_tag');
					$categories = get_categories( $args );
					foreach ($categories as $cate):?>
				<option value="<?php echo esc_attr($cate->term_id);?>" <?php selected($tag,$cate->term_id) ?>><?php echo esc_html($cate->name); ?></option>
				<?php	
					endforeach;
				?>	
			</select>
		</p>
		
	<?php
	}
}
?>