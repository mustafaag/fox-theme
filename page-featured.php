<?php
/*
Template Name: Featured Posts List
*/
?>
<?php get_header(); ?>

<div class="container">
    
    <header class="single-header page-header">

        <h1 class="single-title page-title"><span><?php the_title();?></span></h1>
        
        <?php
            // Start the loop.
            while ( have_posts() ) : the_post();
        ?>
        
        <div class="all-featured-content"><?php the_content();?></div>
        
        <?php
        // End the loop.
        endwhile;
        ?>

    </header><!-- .single-header -->
    
    <div class="content">
        
            <?php
            $args = array(
                'ignore_sticky_posts'   =>	true,
                'featured'              =>  true,
                'paged'                 =>  is_front_page() ? get_query_var('page') : get_query_var('paged'),
            );

            $featured = new WP_Query($args);

            if ($featured->have_posts()): 
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
            <main class="content-area" id="primary" role="main">

            <?php if ( $featured->have_posts() ) : ?>

            <div class="<?php echo esc_attr($blog_container_class);?>">

                <div class="<?php echo esc_attr($blog_class);?>">

                    <?php while ( $featured->have_posts()): $featured->the_post();
                        get_template_part('loop/content', $loop );
                        endwhile
                    ?>
                    <div class="clearfix"></div>
                    <div class="grid-sizer"></div>
                </div><!-- .wi-blog -->

                <?php echo wi_pagination($featured); ?>

            </div><!-- .wi-blog-container -->

            <?php endif; // have_posts ?>

            <?php endif; wp_reset_query();?>

        </main><!-- .content-area --> 

        <?php get_sidebar(); ?>

        <div class="clearfix"></div>
    </div><!-- .content -->
</div><!-- .container -->
    
<?php get_footer(); ?>