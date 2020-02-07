<?php get_header(); ?>

<?php 
get_template_part('inc/headline');
?>

<?php 
/* SOME PHP STUFFS */
global $wp_query;
$count = 0; $has_sticky = false; $loop = '';

$layout = wi_layout();

    /* loop */
$explode = explode('-',$layout);
$loop = $explode[0];
?>
<div class="container">
    
    <div class="content">
    
        <div class="notfound-text">
            <p><?php printf(__('It seems we can’t find what you’re looking for. Perhaps searching can help or go back to <a href="%s">Homepage</a>.','wi'), esc_url(home_url('/')) );?></p>
        </div><!-- .notfound-text -->
    
    </div><!-- .content -->
        
</div><!-- .container -->

<?php get_footer(); ?>
