<?php if (has_post_thumbnail()):?>
<figure class="post-thumbnail">
    <?php if (!is_single()):?><a href="<?php the_permalink();?>">
        <?php the_post_thumbnail('full');?>
    </a>
    <?php else: ?>
        <?php the_post_thumbnail('full');?>
    <?php endif; ?>
</figure><!-- .post-thumbnail -->

<?php else: ?>

<div class="no-thumbnail-line"></div>

<?php endif; ?>