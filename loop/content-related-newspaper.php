<article id="post-<?php the_ID(); ?>" <?php post_class('post-related'); ?>><div class="related-inner">
    
    <?php wi_display_thumbnail('thumbnail-medium','related-thumbnail',true, true);?>
        
    <section class="related-body">
        
        <div class="post-content">
            
            <header class="related-header">
                
                <h3 class="related-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        
            </header><!-- .related-header -->

            <div class="clearfix"></div>

        </div><!-- .post-content -->
        
    </section><!-- .related-body -->
    
    <div class="clearfix"></div>
    
    </div></article><!-- .post-related -->
