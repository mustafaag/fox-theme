<?php
/*
Template Name: Page one column
*/
?>
<?php get_header(); ?>

<?php
    // Start the loop.
    while ( have_posts() ) : the_post();
?>

<div class="container">
    
    <header class="single-header page-header">

        <h1 class="single-title page-title"><span><?php the_title();?></span></h1>

    </header><!-- .single-header -->
    
    <div class="content">
    
        <main id="primary" class="content-area" role="main">

            <div class="single-body">

                <div class="page-content">
                    <?php
                        the_content();
                        wp_link_pages( array( 'before' => '<div class="page-links-container"><div class="page-links"><div class="page-links-label">' . __( 'Pages:', 'wi' ) . '</div>', 'after' => '</div></div>', 'pagelink' => '<span>%</span>' ) );
                    ?>
                    <div class="clearfix"></div>
                    
                </div><!-- .page-content -->
                
                <?php if( !get_theme_mod('wi_disable_page_share')): ?>
                <div class="post-share share-4 single-share page-share">
                    <ul>
                        <li class="li-facebook"><a data-href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink());?>" title="<?php _e('Facebook','wi');?>" class="share"><span><?php _e('Facebook','wi');?></span></a></li>
                <li class="li-twitter"><a data-href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink());?>&amp;text=<?php echo urlencode(get_the_title());?>" title="<?php _e('Twitter','wi');?>" class="share"><span><?php _e('Twitter','wi');?></span></a></li>
                <li class="li-google-plus"><a data-href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink());?>" title="<?php _e('Google+','wi');?>" class="share"><span><?php _e('Google','wi');?></span></a></li>
                <li class="li-pinterest"><a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" title="<?php _e('Google+','wi');?>"><span><?php _e('Pinterest','wi');?></span></a></li>
                    </ul>
                </div><!-- .post-share -->
                <?php endif; ?>

            </div><!-- .single-body -->

            <div class="clearfix"></div>

            <?php if( !get_theme_mod('wi_disable_page_comment')): ?>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>

            <?php endif; ?>

        </main><!-- .content-area -->
        
        <div class="clearfix"></div>
    </div><!-- .content -->
</div><!-- .container -->
    
<?php
// End the loop.
endwhile;
?>

<?php get_footer(); ?>