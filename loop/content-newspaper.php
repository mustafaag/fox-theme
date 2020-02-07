<article id="post-<?php the_ID(); ?>" <?php post_class('post-newspaper'); ?>>
    
    <section class="post-body">
        
        <?php get_template_part('inc/thumbnail/thumbnail',get_post_format()); ?>
    
        <header class="newspaper-header">
            
            <h2 class="newspaper-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            
            <div class="newspaper-meta">

                <?php if (!get_theme_mod('wi_disable_blog_date')):?>
                <span class="meta-time">
                    <time datetime="<?php echo get_the_date('c');?>"><?php echo get_the_date(get_option('date_format'));?></time>
                </span><!-- .meta-date -->
                <?php endif; ?>
                
                <?php if (!get_theme_mod('wi_disable_blog_categories') && get_the_category_list() ):?>
                <span class="meta-category">
                    <?php echo get_the_category_list(__( '<span class="sep">/</span>', 'wi' )); ?>
                </span><!-- .meta-category -->
                <?php endif; ?>
                
                <?php if (!get_theme_mod('wi_disable_blog_author')):?>
                <span class="meta-author">
                    <?php printf(
                        __('by %s','wi'), 
                        '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'" rel="author">' . get_the_author() . '</a>'
                    );
                    ?>
                </span><!-- .meta-author -->
                <?php endif; ?>
                
            </div><!-- .newspaper-meta -->

        </header><!-- .newspaper-header -->
        
        <div class="post-content">
            
            <?php if (get_theme_mod('wi_blog_standard_display') == 'excerpt'): ?>
            
            <div class="newspaper-content newspaper-excerpt">
                <?php the_excerpt(); ?>
                
                <?php if (!get_theme_mod('wi_disable_blog_readmore')):?>
                <p class="p-readmore">
                    <a href="<?php the_permalink();?>" class="more-link"><span class="post-more"><?php _e('Keep Reading','wi');?></span></a>
                </p>
                <?php endif; ?>
                
            </div><!-- .entry-content -->
            
            <?php else: ?>
            
            <div class="newspaper-content">
                <?php the_content('<span class="post-more">' . __('Keep Reading','wi') . '</span>');?>
                
            </div><!-- .newspaper-content -->
            
            <?php endif; // display ?>

            <div class="clearfix"></div>
            
            <?php if (!get_theme_mod('wi_disable_blog_share')):?>
                <div class="post-share share-<?php echo get_theme_mod('wi_disable_blog_comment') ? 4 : 5; ?>">
                    <?php wi_share(true); ?>
                </div><!-- .post-share -->
            <?php endif; ?>
            
            <div class="clearfix"></div>
            
            <?php /*------------------------		RELATED		------------------------------- */ ?>
        <?php if( !get_theme_mod('wi_disable_blog_related')): ?>

            <?php
            $related = get_related_tag_posts_ids( get_the_ID(), 3 );
            if ( $related ) {
                $args = array(
                    'post__in'      => $related,
                    'orderby'       => 'post__in',
                    'no_found_rows' => true, // no need for pagination
                );
                $related_posts = get_posts( $args );
                if ( $related_posts ): $count = 0;?>
                <div class="related-area">

                    <h3 class="newspaper-related-heading"><span><?php _e('You might be interested in','wi');?></span></h3>

                    <div class="newspaper-related">
                        <?php foreach ( $related_posts as $post ): setup_postdata($post); $count++;?>

                            <?php get_template_part('loop/content', 'related-newspaper' ); ?>

                        <?php endforeach; ?>

                        <?php wp_reset_postdata(); ?>

                        <div class="clearfix"></div>

                    </div><!-- .blog-related -->
                </div><!-- #related-posts -->

                <?php	
                endif; // if realted posts
            }
            ?>

        <?php endif; // blog related ?>

        </div><!-- .post-content -->
        
    </section><!-- .post-body -->
    
    <div class="clearfix"></div>
    
</article><!-- .post-newspaper -->
