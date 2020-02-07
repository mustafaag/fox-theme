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

                <div class="entry-content">
                    <?php
                        the_content();
                        wp_link_pages( array( 'before' => '<div class="page-links-container"><div class="page-links"><div class="page-links-label">' . __( 'Pages:', 'wi' ) . '</div>', 'after' => '</div></div>', 'pagelink' => '<span>%</span>' ) );
                    ?>
                    <div class="clearfix"></div>

                </div><!-- .entry-content -->
                
                <?php if( !get_theme_mod('wi_disable_page_share')): ?>
                <div class="post-share share-4 single-share page-share">
                    <?php wi_share();?>
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
        
        <?php get_sidebar('page'); ?>

        <div class="clearfix"></div>
    </div><!-- .content -->
</div><!-- .container -->
    
<?php
// End the loop.
endwhile;
?>

<?php get_footer(); ?>