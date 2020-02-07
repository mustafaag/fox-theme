<article id="post-<?php the_ID(); ?>" <?php post_class('post-masonry'); ?>>
    
    <section class="post-body">
        
        <?php global $first; if ($first):
        
        wi_display_thumbnail('full','masonry-thumbnail', true, false);

        else:

        wi_display_thumbnail('thumbnail-medium-nocrop','masonry-thumbnail', true, false); 
        
        endif;

        $first = false;

        ?>
    
        <header class="masonry-header">
            
            <div class="masonry-meta">
                
                <?php if (!get_theme_mod('wi_disable_blog_date')):?>
                <span class="masonry-date">
                    <time datetime="<?php echo get_the_date('c');?>" title="<?php echo esc_attr(get_the_date(get_option('date_format')));?>"><?php echo get_the_date(get_option('date_format'));?></time>
                </span>
                <?php endif; ?>

                <?php if (!get_theme_mod('wi_disable_blog_categories')):?>
                    <?php if ( get_the_category_list() ):?>
                    <span class="masonry-cats">
                        <?php echo get_the_category_list('<span class="sep">/</span>'); ?>
                    </span><!-- .masonry-cats -->
                    <?php endif; ?>
                <?php endif; ?>
                
            </div><!-- .masonry-meta -->
            
            <h2 class="masonry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

        </header><!-- .masonry-header -->
        
        <div class="post-content">
            
            <div class="masonry-content">
                <p>
                    <?php echo get_the_excerpt(); ?>
                    
                    <?php if (!get_theme_mod('wi_disable_blog_readmore')):?>
                    <a href="<?php the_permalink();?>" class="readmore"><?php _e('Keep Reading','wi');?></a>
                    <?php endif; ?>
                    
                </p>
            </div><!-- .masonry-content -->

            <div class="clearfix"></div>

        </div><!-- .post-content -->
        
    </section><!-- .post-body -->
    
    <div class="clearfix"></div>
    
</article><!-- .post-masonry -->
