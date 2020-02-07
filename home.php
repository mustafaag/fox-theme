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
        
        <?php /* ==============================         BEFORE STREAM         ============================== */ ?>
        <div id="wi-bf">
<?php
for ($i=1; $i<=10; $i++):

$cat = get_theme_mod('bf_' . $i . '_cat'); if (!$cat) continue;

$orderby = get_theme_mod('bf_' . $i . '_orderby');
$number = get_theme_mod('bf_' . $i . '_number') ? get_theme_mod('bf_' . $i . '_number') : 4;
$this_layout = get_theme_mod('bf_' . $i . '_layout'); if (!$this_layout) $this_layout = 'slider';

// loop
$this_loop = $this_layout;
if (strpos($this_loop,'grid')!==false) $this_loop = 'grid';

// column
$this_column = 2;
if (strpos($this_layout,'2')!==false) $this_column = '2';
if (strpos($this_layout,'3')!==false) $this_column = '3';
if (strpos($this_layout,'4')!==false) $this_column = '4';

// meta info
global $timings, $time_shortcuts;
$date = ''; $time = 'all';
$date = $date != '' ? $date : date( $timings[$time] );
$date = $time == 'all' ? '' : '-' . $date;
$meta_key = apply_filters( 'baw_count_views_meta_key', '_count-views_' . $time . $date, $time, $date );

// query
$args = array(
    'posts_per_page'        =>  $number,
    'ignore_sticky_posts'   =>  true,
    'no_found_rows' => true, 
);
if ($cat == 'featured') $args['featured'] = true;
elseif ($cat=='sticky') {
    $sticky = get_option( 'sticky_posts' );
    if (!empty($sticky)) $args['post__in'] = $sticky;
    else $args['p'] = '-1';
}
elseif ($cat!='all') $args['cat'] = $cat;

if ($orderby == 'date') $args['orderby'] = 'date';
elseif ($orderby == 'comment') $args['orderby'] = 'comment_count';
elseif ($orderby == 'view') {
    $args['meta_key'] = $meta_key;
    $args['meta_value_num'] = '0';
    $args['meta_compare'] = '>';
    $args['orderby'] = 'meta_value_num';
}

$this_query = new WP_Query($args);
if ($this_query->have_posts()) :

$section_class = array('wi-section', 'section-'.$i);
$section_class = join(' ',$section_class);
?>
        
<div class="<?php echo esc_attr($section_class);?>">
    
    <?php if (get_theme_mod('bf_' . $i . '_heading')):?>
    <h3 class="section-heading">
        <span><?php echo esc_html(get_theme_mod('bf_' . $i . '_heading'));?></span>
        <?php if ($link = get_theme_mod('bf_' . $i . '_viewall_link')): ?>
        <a href="<?php echo esc_url($link);?>" class="viewall"><?php echo get_theme_mod(get_theme_mod('bf_' . $i . '_viewall_text')) ? esc_html(get_theme_mod(get_theme_mod('bf_' . $i . '_viewall_text'))) : __('View all','wi');?></a>
        <?php endif; ?>
    </h3>
    <?php endif; ?>
    
    <div class="seciton-list">
        
        <?php switch($this_loop):
            /* ==============================         SLIDER         ============================== */
            case 'slider':
        ?>
        <div class="wi-flexslider blog-slider">
            
            <div class="flexslider">
                <ul class="slides">
                    <?php while($this_query->have_posts()):$this_query->the_post();?>
                    <li>
                        <?php get_template_part('loop/content','slider');?>
                    </li>
                    <?php endwhile;?>
                </ul>
            </div><!-- .flexslider -->
            
        </div><!-- .wi-flexslider -->
        
        <?php break;
            /* ==============================         BIG POST         ============================== */
            case 'big-post':
        ?>
        
        <div class="wi-big">
            <?php while($this_query->have_posts()):$this_query->the_post();
                get_template_part('loop/content','big');
            endwhile; ?>
        </div><!-- .wi-big -->
        
        <?php break;
            /* ==============================         GRID         ============================== */
            case 'grid':
$this_blog_container_class = array('blog-container');
$this_blog_container_class = join(' ',$this_blog_container_class);

$this_blog_class = array('wi-blog','blog-'.$this_loop,'column-'.$this_column);
$this_blog_class = join(' ',$this_blog_class);
        ?>
        
        <div class="<?php echo esc_attr($this_blog_container_class);?>">

            <div class="<?php echo esc_attr($this_blog_class);?>">

                <?php while ( $this_query->have_posts()): $this_query->the_post();
                    get_template_part('loop/content', 'grid' );
                    endwhile
                ?>
                <div class="clearfix"></div>
                <div class="grid-sizer"></div>
            </div><!-- .wi-blog -->

        </div><!-- .wi-blog-container -->
        
        <?php break; default : ?>
        
        <?php endswitch; ?>
        
    </div><!-- .section-list -->
    
</div><!-- .wi-section -->
            
<?php endif; // have posts ?>
<?php wp_reset_query();?>
<?php
endfor; // for $i
?>
    <div class="clearfix"></div>
</div><!-- #wi-bf -->

        <?php /* ==============================         MAIN STREAM         ============================== */ ?>
        
        <?php if ( !get_theme_mod('wi_disable_main_stream') ): ?>
        
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
        
        <?php endif; // disable main stream ?>
    
    </div><!-- .content -->
        
</div><!-- .container -->

<?php get_footer(); ?>
