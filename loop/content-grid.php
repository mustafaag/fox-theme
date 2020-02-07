<article id="post-<?php the_ID(); ?>" <?php post_class('post-grid'); ?>><div class="grid-inner">
    
    <?php wi_display_thumbnail('thumbnail-medium','grid-thumbnail',true,true); ?>
        
    <section class="grid-body">
        
        <div class="post-content">
            
            <header class="grid-header">

                <div class="grid-meta">
                    
                    <?php if (!get_theme_mod('wi_disable_blog_date')):?>
                    <span class="grid-date">
                        <time datetime="<?php echo get_the_date('c');?>" title="<?php echo esc_attr(get_the_date(get_option('date_format')));?>"><?php echo get_the_date(get_option('date_format'));?></time>
                    </span>
                    <?php endif; ?>
                    
                    <?php if (!get_theme_mod('wi_disable_blog_categories')):?>
                        <?php if ( get_the_category_list(__( '<span class="sep">/</span>', 'wi' )) ):?>
                        <span class="grid-cats">
                            <?php echo get_the_category_list(__( '<span class="sep">/</span>', 'wi' )); ?>
                        </span><!-- .grid-cats -->
                        <?php endif; ?>
                    <?php endif; ?>
                
                </div><!-- .grid-meta -->
                
                <h2 class="grid-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
        
            </header><!-- .grid-header -->
            
            <?php $grid_excerpt_length = get_theme_mod('wi_grid_excerpt_length') ? absint(get_theme_mod('wi_grid_excerpt_length')) : 22; 
            if ($grid_excerpt_length < 1) $grid_excerpt_length = 22;
            ?>
            <div class="grid-content">
                <p> 
                    <?php echo wi_subword(get_the_excerpt(),0,$grid_excerpt_length); ?> &hellip;
                    
                    <?php if (!get_theme_mod('wi_disable_blog_readmore')):?>
                    <a href="<?php the_permalink();?>" class="readmore"><?php _e('Keep Reading','wi');?></a>
                    <?php endif; ?>
                </p>
            </div><!-- .grid-content -->

            <div class="clearfix"></div>
        
        </div><!-- .post-content -->
        
    </section><!-- .grid-body -->
    
    <div class="clearfix"></div>
    
    </div></article><!-- .post-grid -->
