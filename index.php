<?php get_header(); ?>

<?php 
get_template_part('inc/headline');
?>

<?php
/* SOME PHP STUFFS */
global $wp_query;
$layout = wi_layout();
// loop
$loop = $layout;
if (strpos($loop,'grid')!==false) $loop = 'grid';
if (strpos($loop,'masonry')!==false) $loop = 'masonry';

// column
$column = 2;
if (strpos($layout,'2')!==false) $column = '2';
if (strpos($layout,'3')!==false) $column = '3';
if (strpos($layout,'4')!==false) $column = '4';

$blog_container_class = array('blog-container');
$blog_container_class = join(' ',$blog_container_class);

$blog_class = array('wi-blog','blog-'.$loop,'column-'.$column);
$blog_class = join(' ',$blog_class);
?>

<div class="container">
    
    <div class="content">

        <div class="main-stream" id="main-stream">
        
            <main class="content-area" id="primary" role="main">

    <?php if ( have_posts() ) : global $first; $first = true; ?>

                <div class="<?php echo esc_attr($blog_container_class);?>">

                    <div class="<?php echo esc_attr($blog_class);?>">

                        <?php while ( have_posts()): the_post();
                            get_template_part('loop/content', $loop );
                            endwhile
                        ?>
                        <div class="clearfix"></div>
                        <div class="grid-sizer"></div>
                    </div><!-- .wi-blog -->

                    <?php echo wi_pagination(); ?>

                </div><!-- .wi-blog-container -->

    <?php endif; // have_posts ?>

            </main><!-- .content-area -->
        
            <?php get_sidebar(); ?>

            <div class="clearfix"></div>
            
        </div><!-- #main-stream -->
    
    </div><!-- .content -->
        
</div><!-- .container -->

<?php get_footer(); ?>
