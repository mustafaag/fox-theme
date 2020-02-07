<article id="post-<?php the_ID(); ?>" <?php post_class('post-slider'); ?>>
    
    <?php wi_display_thumbnail('thumbnail-big','slider-thumbnail',false,false); ?>
    
    <section class="slider-body">
        
        <div class="slider-table"><div class="slider-cell">
        
            <div class="post-content">

                <header class="slider-header">

                    <h2 class="slider-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

                </header><!-- .slider-header -->
                
                <div class="slider-excerpt">
                    <p>
                        <span class="slider-meta">
                            <span class="slider-date">
                                <time datetime="<?php echo get_the_date('c');?>"><?php printf( __('Published on %s','wi'), get_the_date(get_option('date_format')) );?></time>
                            </span><!-- .slider-date -->
                        </span><!-- .slider-meta -->
                        
                        <?php echo wi_subword(get_the_excerpt(),0,20);?>&hellip;
                        
                        <a class="slider-more" href="<?php the_permalink();?>"><?php _e('Keep Reading','wi');?></a>
                    </p>
                
                </div>
                
                <div class="clearfix"></div>

            </div><!-- .post-content -->
            
        </div></div><!-- .slider-cell --><!-- .slider-table -->
        
    </section><!-- .slider-body -->
    
    <div class="clearfix"></div>
    
</article><!-- .post-slider -->
