<article id="post-<?php the_ID(); ?>" <?php post_class('post-small small-item'); ?>><div class="small-inner">
    
    <?php wi_display_thumbnail('thumbnail-medium','small-thumbnail',true,true); ?>
        
    <section class="small-body">
            
        <header class="small-header">

            <div class="small-meta">

                <span class="small-date">
                    <time datetime="<?php echo get_the_date('c');?>" title="<?php echo esc_attr(get_the_date(get_option('date_format')));?>"><?php echo get_the_date(get_option('date_format'));?></time>
                </span>

            </div><!-- .small-meta -->

            <h3 class="small-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>

        </header><!-- .small-header -->

        <div class="small-excerpt">
            <?php echo wi_subword(get_the_excerpt(), 0, 12);?>
        </div>

        <div class="clearfix"></div>
        
    </section><!-- .small-body -->
    
    <div class="clearfix"></div>
    
    </div></article><!-- .post-small -->
