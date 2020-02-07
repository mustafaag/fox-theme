<article id="post-<?php the_ID(); ?>" <?php post_class('post-grid'); ?>><div class="grid-inner">
    
    <?php wi_display_thumbnail('thumbnail-medium','grid-thumbnail',true,true); ?>
        
    <section class="grid-body">
        
        <div class="post-content">
            
            <header class="grid-header">

                <div class="grid-meta">
                    
                    <span class="grid-date">
                        <time datetime="<?php echo get_the_date('c');?>" title="<?php echo esc_attr(get_the_date(get_option('date_format')));?>"><?php echo get_the_date(get_option('date_format'));?></time>
                    </span>
                
                </div><!-- .grid-meta -->
                
                <h3 class="grid-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        
            </header><!-- .grid-header -->
            
            <div class="grid-content">
                <p> 
                    <?php echo wi_subword(get_the_excerpt(),0,16); ?>
                </p>
            </div><!-- .grid-content -->

            <div class="clearfix"></div>
        
        </div><!-- .post-content -->
        
    </section><!-- .grid-body -->
    
    <div class="clearfix"></div>
    
    </div></article><!-- .post-grid -->
