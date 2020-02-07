<?php get_header(); ?>

<?php
    // Start the loop.
    while ( have_posts() ) : the_post();
?>

<div class="container">
    
    <div class="content">
        
        <?php get_template_part('inc/thumbnail/thumbnail','gallery-carousel'); ?>
    
        <main id="primary" class="content-area" role="main">
            
            <?php if (!get_theme_mod('wi_disable_single_image')) get_template_part('inc/thumbnail/thumbnail',get_post_format()); ?>
            
            <header class="post-header">
            
                <h1 class="post-title single-title"><?php the_title();?></h1>

                <div class="post-header-meta">

                    <?php if (!get_theme_mod('wi_disable_blog_date')):?>
                    <span class="meta-time">
                        <time datetime="<?php echo get_the_date('c');?>"><?php printf( __('Published on %s','wi'), get_the_date(get_option('date_format')) );?></time>
                    </span><!-- .meta-date -->
                    <?php endif; ?>

                    <?php if (!get_theme_mod('wi_disable_blog_categories') && get_the_category_list() ):?>
                    <span class="meta-category">
                        <?php printf(__('in %s','wi'), get_the_category_list(__( '<span class="sep">/</span>', 'wi' ))); ?>
                    </span><!-- .meta-category -->
                    <?php endif; ?>

                    <?php if (!get_theme_mod('wi_disable_blog_author')):?>
                    <span class="meta-author">
                        <?php printf(
                            __('by %s','wi'), 
                            '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'" rel="author">' . get_the_author() . '</a>'
                        );
                        ?>
                    </span><!-- .meta-author -->
                    <?php endif; ?>

                </div><!-- .post-header-meta -->

            </header><!-- .post-header -->
            
            <div class="single-body">

                <div class="entry-content">
                    <?php
                        the_content();
                        wp_link_pages( array( 'before' => '<div class="page-links-container"><div class="page-links"><div class="page-links-label">' . __( 'Continue reading:', 'wi' ) . '</div>', 'after' => '</div></div>', 'pagelink' => '<span>%</span>' ) );
                    ?>
                    <div class="clearfix"></div>

                </div><!-- .entry-content -->

                <?php if( !get_theme_mod('wi_disable_single_share')): ?>
                    <div class="post-share share-4 single-share">
                        <ul>
                            <li class="li-facebook"><a data-href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink());?>&p[images][0]=<?php echo wp_get_attachment_url(get_post_thumbnail_id());?>" title="<?php _e('Facebook','wi');?>" class="share"><span><?php _e('Facebook','wi');?></span></a></li>
                    <li class="li-twitter"><a data-href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink());?>&amp;text=<?php echo urlencode(get_the_title());?>" title="<?php _e('Twitter','wi');?>" class="share"><span><?php _e('Twitter','wi');?></span></a></li>
                    <li class="li-google-plus"><a data-href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink());?>" title="<?php _e('Google+','wi');?>" class="share"><span><?php _e('Google','wi');?></span></a></li>
                    <li class="li-pinterest"><a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" title="<?php _e('Google+','wi');?>"><span><?php _e('Pinterest','wi');?></span></a></li>
                        </ul>
                    </div><!-- .post-share -->
                <?php endif; ?>
                    
            </div><!-- .single-body -->

            <div class="clearfix"></div>
            
            <?php /*------------------------		TAGS		------------------------------- */ ?>
            <?php if ( !get_theme_mod('wi_disable_single_tag') && get_the_tag_list()):?>
            <div class="single-tags">
                <span class="tag-label">Tags: </span>
                <?php echo get_the_tag_list();?>				
            </div><!-- .tags -->
            <?php endif; ?>
            

            <?php /*------------------------		RELATED		------------------------------- */ ?>
            <?php if( !get_theme_mod('wi_disable_single_related')): ?>

                <?php
                $related = get_related_tag_posts_ids( get_the_ID(), 3 );
                if ( $related ) {
                    $args = array(
                        'post__in'      => $related,
                        'orderby'       => 'post__in',
                        'no_found_rows' => true, // no need for pagination
                    );
                    $related_posts = get_posts( $args );
                    if ( $related_posts ): $count = 0;?>
                    <div class="related-posts" id="related-posts">
                        
                        <h3 class="related-heading"><span><?php _e('You might be interested in','wi');?></span></h3>
                        
                        <div class="related-list blog-grid column-3">
                            <?php foreach ( $related_posts as $post ): setup_postdata($post); $count++;?>
                                
                                <?php get_template_part('loop/content-related', 'single' ); ?>

                            <?php endforeach; ?>
                            
                            <?php wp_reset_postdata(); ?>
                            
                            <div class="clearfix"></div>
                            
                        </div><!-- .related-list -->
                    </div><!-- #related-posts -->

                    <?php	
                    endif; // if realted posts
                }
                ?>

            <?php endif; // single related ?>


            <?php if( !get_theme_mod('wi_disable_single_author')): ?>

                <div class="authorbox" id="authorbox"><div class="authorbox-inner">
                    <div class="author-avatar">
                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" rel="author">
                            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wi_author_bio_avatar_size', 120 ) ); ?>
                        </a>
                    </div>
                    <div class="authorbox-content">

                        <?php /* ------- NAV -------- */ ?>

                        <?php if( !get_theme_mod('wi_disable_single_author_posts')): ?>
                        <nav class="authorbox-nav">
                            <ul>
                                <li class="active"><a data-href="#authorbox-info"><?php echo get_the_author(); ?></a></li>
                                <li><a data-href="#same-author"><?php _e('Latest posts','wi');?></a></li>
                            </ul>
                        </nav><!-- .authorbox-nav -->
                        <?php endif; ?>

                        <?php /* ------- INFO -------- */ ?>

                        <div class="authorbox-info authorbox-tab active" id="authorbox-info">
                            
                            <div class="desc">
                                <p><?php the_author_meta( 'description' ); ?></p>
                            </div>
                            <div class="author-social social-list">
                                <ul>
                                    <?php $short_social_arr = 'twitter, facebook-square, google-plus, tumblr, instagram, pinterest-p, linkedin, youtube, vimeo, soundcloud, flickr';
                                    $short_social_arr = explode(',',$short_social_arr);
                                    $short_social_arr = array_map('trim',$short_social_arr);
                                    ?>
                                    <?php foreach ( $short_social_arr as $sc ): ?>
                                        <?php if ( $url = get_the_author_meta($sc) ): ?>
                                        <?php if ($sc == 'google-plus') $rel = 'publisher'; else $rel = 'alternate'; ?>
                                        <li><a href="<?php echo esc_url($url);?>" rel="<?php echo esc_attr($rel);?>" target="_blank"><i class="fa fa-<?php echo esc_attr($sc);?>"></i></a></li>

                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="clearfix"></div>
                            </div><!-- .author-social -->

                        </div><!-- .authorbox-info -->

                        <?php /* ------- SAME AUTHOR -------- */ ?>

                        <div class="authorbox-tab" id="same-author">

                            <?php
                            $args = array(
                                'posts_per_page'    => 4,
                                'author'            => get_the_author_meta( 'ID' ),
                                'no_found_rows'     => true, // no need for pagination
                            );
                            $same_author = get_posts( $args );
                            if ( $same_author ): $count = 0;?>
                                <div class="same-author-posts">

                                    <ul class="same-author-list">
                                        <?php foreach ( $same_author as $post ): setup_postdata($post);?>
                                        <li>
                                            <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                        </li>
                                        <?php endforeach; wp_reset_postdata(); ?>
                                    </ul><!-- .related-list -->
                                    <div class="clearfix"></div>
                                    
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" rel="author" class="viewall">
                                        <span><?php _e('View all','wi');?></span>
                                    </a>
                                    
                                </div><!-- .same-author-posts -->	
                                <?php	
                            endif; // if same author
                            ?>

                        </div><!-- #same-author -->
                    </div><!-- .authorbox-content -->
                    </div><!-- .authorbox-inner -->
                </div><!-- #authorbox -->

            <?php endif;	// single author box ?>

            <?php if( !get_theme_mod('wi_disable_single_comment')): ?>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>

            <?php endif; ?>

        </main><!-- .content-area -->
        
        <?php if ((strpos(wi_layout(),'nosidebar')===false)) get_sidebar(); ?>
        
        <div class="clearfix"></div>
        
    </div><!-- .content -->
</div><!-- .container -->

<?php /* ==========================			POST NAVIGATION			========================== */?>
<?php if( !get_theme_mod('wi_disable_single_nav')): ?>
<nav class="post-nav">
	<div class="container">
		<?php
            // Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Story', 'wi' ) . '<i class="fa fa-caret-right"></i></span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'wi' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="fa fa-caret-left"></i>' . __( 'Previous Story', 'wi' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'wi' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
        ?>
	</div><!-- .container -->
</nav><!-- .post-nav -->
<?php endif; ?>

<?php /* ==========================			POSTS FROM CATEGORY			========================== */?>
<?php if( !get_theme_mod('wi_disable_single_same_category')): ?>

<?php
$categories = get_the_category();
$current_post_id = get_the_ID();
if ($categories):
    $cat = $categories[0]->term_id;
    $args = array(
        'posts_per_page'        =>  5,
        'ignore_sticky_posts'   =>	true,
        'cat'                   =>  $cat,
        'post__not_in'          =>  array($current_post_id),
    );
    $same = new WP_Query($args);
    if ($same->have_posts()): ?>

            <div id="posts-small-wrapper">
                <div class="container">
                    
                    <h3 id="posts-small-heading"><span><?php printf(__('Latest from %s','wi'), $categories[0]->name);?></span></h3>

                    <div id="posts-small">

                    <?php
                    while($same->have_posts()): $same->the_post();
                    ?>

                        <?php get_template_part('loop/content','small'); ?>

                        <?php
                    endwhile;
                    ?>

                    </div><!-- #posts-small -->
                </div><!-- .container -->
            </div><!-- #posts-small-wrapper -->

    <?php
    endif; // have posts
    wp_reset_query();
    ?>
    
<?php endif; // endif categories ?>

<?php endif; // if not disable same category module ?>

<?php
// End the loop.
endwhile;
?>

<?php get_footer(); ?>