<article id="post-<?php the_ID(); ?>" <?php post_class('post-list'); ?>>
    
    <?php wi_display_thumbnail('thumbnail-medium','list-thumbnail',true,true); ?>
        
    <section class="post-body">
        
        <div class="post-content">
            
            <header class="list-header">
                
                <div class="list-meta">
                    
                    <?php if (!get_theme_mod('wi_disable_blog_date')):?>
                    <span class="list-date">
                        <time datetime="<?php echo get_the_date('c');?>" title="<?php echo esc_attr(get_the_date(get_option('date_format')));?>"><?php echo get_the_date(get_option('date_format'));?></time>
                    </span>
                    <?php endif; ?>
                    
                    <?php if (!get_theme_mod('wi_disable_blog_categories')):?>
                        <?php if ( get_the_category_list(__( '<span class="sep">/</span>', 'wi' )) ):?>
                        <span class="list-cats">
                            <?php echo get_the_category_list(__( '<span class="sep">/</span>', 'wi' )); ?>
                        </span><!-- .list-cats -->
                        <?php endif; ?>
                    <?php endif; ?>
                    
                </div><!-- .list-meta -->

                <h2 class="list-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
        
            </header><!-- .list-header -->
            
            <div class="list-content">
                <p><?php echo get_the_excerpt(); ?><?php if (!get_theme_mod('wi_disable_blog_readmore')):?>
                    <a href="<?php the_permalink();?>" class="readmore"><?php _e('Keep Reading','wi');?></a>
                    <?php endif; ?>
                </p>
            </div><!-- .list-content -->
            
            <div class="clearfix"></div>

        </div><!-- .post-content -->
        
    </section><!-- .post-body -->
    
    <div class="clearfix"></div>
    
</article><!-- .post-list -->
