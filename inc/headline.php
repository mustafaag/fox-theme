<?php
global $wp_query, $post;
$title = ''; $subtitle = ''; $lable = '';
if (is_home()) return;
?>
<div id="titlebar">
    <div class="container">
	
<?php 
if ( is_category() ) {
    $label = __('Category archive','wi');
    $this_cat = get_category(get_query_var('cat'), false);
    $title = single_cat_title('', false);
    $subtitle = do_shortcode( trim($this_cat->description) );
} elseif ( is_search() ) {
    $label = __('Search result','wi');
    $title  = get_search_query();
    $subtitle = sprintf(__('%s result(s) found.','wi'), $wp_query->found_posts);
} elseif ( is_day() ) {
    $label = __('Daily archive','wi');
    $title = get_the_time('F d, Y');
} elseif ( is_month() ) {
    $label = __('Monthly archive','wi');
    $title = get_the_time('F Y');
} elseif ( is_year() ) {
    $label = __('Yearly archive','wi');
    $title = get_the_time('Y');
} elseif ( is_tag() ) {
    $label = __('Tag archive','wi');
    $tag_id = intval(get_query_var('tag_id'));
    $this_tag = get_term($tag_id , 'post_tag');
    $title = sprintf(__('%s','wi'), single_tag_title('', false) );
    $subtitle = do_shortcode ( trim ($this_tag->description));
} elseif ( is_author() ) {
    $label = __('Author','wi');
    global $author;
    $userdata = get_userdata($author);
    $title = $userdata->display_name;
    $count = count_user_posts($userdata->ID);
    $subtitle = sprintf( __('<span>%1$s</span> has %2$s articles published.','wi'), $title, $count );
} elseif ( is_404() ) {
    $label = __('Not found','wi');
    $title = __('404','wi');
}

if ( get_query_var('paged') ) {			
    $page_text = sprintf(__(' - page %d','wi') , get_query_var('paged') );
}	else $page_text = '';

$title = $title . $page_text;
?>
        <div class="title-area">
            <?php if ($label) { ?>
            <span class="title-label"><span><?php echo esc_html($label);?></span></span>
            <?php } ?>
            <h1 class="archive-title"><span><?php echo wp_kses($title,'');?></span></h1>
            <?php if ( $subtitle ) {?>
            <h2 class="page-subtitle"><?php echo wp_kses($subtitle,'');?></h2>
            <?php } ?>
        </div><!-- .title-area -->
	
    </div><!-- .container -->
</div><!-- #headline -->