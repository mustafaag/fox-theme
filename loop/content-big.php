<?php $thumbnail_class = ( has_post_thumbnail() && !get_post_format() ) ? ' has-thumbnail' : ''; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-big' . $thumbnail_class); ?>>
    
    <?php get_template_part('inc/thumbnail/thumbnail',get_post_format()); ?>
    
    <section class="big-body">
            
            <header class="big-header">
                
                <div class="big-meta">
                    
                    <?php if ( get_the_category_list(__( '<span class="sep">/</span>', 'wi' )) ):?>
                    <span class="big-cats">
                        <?php echo get_the_category_list(__( '<span class="sep">/</span>', 'wi' )); ?>
                    </span><!-- .big-cats -->
                    <?php endif; ?>
                    <span class="big-date">
                        <time datetime="<?php echo get_the_date('c');?>"><?php echo get_the_date('d.m.Y');?></time>
                    </span><!-- .big-date -->

                </div><!-- .big-meta -->
                
                <h2 class="big-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                
                <div class="big-content"><?php the_content('<span class="big-more">'.__('Keep Reading','wi').'</span>');?></div>
        
            </header><!-- .post-header -->

    </section><!-- .big-body -->
    
    <div class="clearfix"></div>
    
</article><!-- .post-big -->
