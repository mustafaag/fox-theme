<?php if (get_post_format()!='gallery') return; ?>
<?php $effect = get_post_meta( get_the_ID(), '_format_gallery_effect', true);
if ($effect!='carousel') return;
// attachments
$attachments = get_post_meta( get_the_ID() , '_format_gallery_images', true );

if (  count($attachments) == 0 )	// nothing at all
		return;
?>

<div class="wi-carousel">
    <div class="wi-slick">
        
        <?php
        foreach ( $attachments as $attachment):
            $attachment_src = wp_get_attachment_image_src( $attachment, 'thumbnail-vertical' );
            $full_src = wp_get_attachment_image_src( $attachment, 'full' );
            $attachment_post = get_post($attachment);
            ?>
                <figure class="slick-item slide">
                    <a href="<?php echo esc_url($full_src[0]);?>" class="wi-colorbox" rel="carouselPhotos">
                        <img src="<?php echo esc_url ( $attachment_src[0] );?>" width="<?php echo esc_attr($attachment_src[1]);?>" height="<?php echo esc_attr($attachment_src[2]);?>" alt="<?php echo basename( $attachment_src[0] );?>" />
                    
                        <?php if ($caption = $attachment_post->post_excerpt){?>
                        <span class="slide-caption"><?php echo wp_kses($caption,'');?></span>
                        <?php } ?>
                    </a><!-- .wi-colorbox -->
                </figure>
                
        <?php
        endforeach;
        ?>
    
    </div><!-- .wi-slick -->
</div><!-- .wi-carousel -->

<?php return; ?>