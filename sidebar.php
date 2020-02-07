<?php 
if ( wi_sidebar_state() == 'no-sidebar') return;
?>
<div id="secondary" class="secondary">

    <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
        <div id="widget-area" class="widget-area" role="complementary">
            <?php if (is_page()):?>
            <?php dynamic_sidebar( 'page-sidebar' ); ?>
            <?php else: ?>
            <?php dynamic_sidebar( 'sidebar' ); ?>
            <?php endif; ?>
            <div class="gutter-sidebar"></div>
        </div><!-- .widget-area -->
    <?php endif; ?>

</div><!-- #secondary -->