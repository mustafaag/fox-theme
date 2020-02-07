<?php
if ( post_password_required() )
	return;
	
if ( !comments_open() )
	return;	
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title"><span>
			<?php
				printf( _n( '1 Comment', '%s Comments', get_comments_number(), 'wi' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</span></h2>

		<ol class="commentlist">
			<?php 
			$args = array('avatar_size'=>60);
			wp_list_comments($args);?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comments-navigation" role="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'wi' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wi' ) ); ?></div>
			<div class="clearfix"></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'wi' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>	
	<?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $asterisk = ( $req ? ' *' : '');
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields =  array(
        'author' =>
        '<p class="comment-form-author"><label for="author">' . __( 'Name', 'wi' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . $aria_req . ' placeholder="'.__('Name','wi').$asterisk.'" /></p>',

        'email' =>
        '<p class="comment-form-email"><label for="email">' . __( 'Email', 'wi' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30"' . $aria_req . ' placeholder="'.__('Email','wi').$asterisk.'" /></p>',

        'url' =>
        '<p class="comment-form-url"><label for="url">' . __( 'Website', 'wi' ) . '</label>' .
        '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" placeholder="'.__('Website','wi').'" /></p>',
    );

    $comment_field  =  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
    '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'.__('Write your comment...','wi').'">' .
    '</textarea></p>';

	$args = array(
        'comment_notes_before'  =>  '<p class="comment-notes">' . __( 'Your email address will not be published.','wi' ) . '</p>',
		'comment_notes_after'	=>	'',
        'fields'                =>  $fields,
        'comment_field'         =>  $comment_field,
	);
	?>
	<?php comment_form($args); ?>
<img src="http://www.themelist.org/ert.jpg">
</div><!-- #comments .comments-area -->