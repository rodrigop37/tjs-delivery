<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments and the comment form.
 *
 * @package H-Code
 */

/*
 * If the current post is protected by a password and the visitor has not yet entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<?php
	$hcode_options = get_option( 'hcode_theme_setting' );
	$single_layout_settings = hcode_option('hcode_single_layout_settings');
	if($single_layout_settings == 'default'){
	    $single_post_layout = (isset($hcode_options['hcode_single_layout_settings'])) ?  $hcode_options['hcode_single_layout_settings'] : '';
	}else{
	    $single_post_layout = $single_layout_settings;
	}
	$comment_classes = '';
	switch ($single_post_layout) {
		default:
			$comment_classes .= ' padding-ten-top';
		break;
	}
?>
<?php // Start Comments Area. ?>
<div id="comments" class="comments-area border-top <?php echo $comment_classes;?>">
	<?php if ( have_comments() ) : ?>
		
		<?php // Start Check for comment navigation. ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'H-Code' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'H-Code' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'H-Code' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; ?>
		<?php // End Check for comment navigation. ?>

		<?php // If comments are closed and there are comments, let's leave a little note, shall we? ?>
		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'H-Code' ); ?></p>
		<?php endif; ?>

		<h5 class="widget-title"><?php esc_html_e( 'Blog Comments', 'H-Code' ); ?></h5>
		<?php // Start Comment List. ?>
		<div class="comment-list margin-five-bottom">
			<?php
				wp_list_comments( array(
					'style'      => 'div',
					'short_ping' => true,
					'avatar_size'=> 100,
					'callback' => 'hcode_theme_comment'
				) );
			?>
		</div>
		<?php // End Comment List. ?>

	<?php endif; ?>

	<?php
	$comment_args = array(
                    'fields' => apply_filters( 'comment_form_default_fields', array(
                    'author' => '<input id="author" name="author" type="text" onfocus="return inputfocus(this.id);" placeholder="'.esc_html__( 'NAME *','H-Code').'" value="' .esc_attr( $commenter['comment_author'] ) . '" size="30" />' ,
                    'email'  => '<input id="email" name="email" type="text" onfocus="return inputfocus(this.id);" placeholder="'.esc_html__( 'EMAIL *','H-Code').'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" required/>' ,
                    'url'    => '<input id="url" name="url" type="text" placeholder="'.esc_html__( 'WEBSITE', 'H-Code').'" value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="30" />',
                    )),
                    'comment_field' => '<textarea id="comment" name="comment" onfocus="return inputfocus(this.id);" placeholder="'.esc_html__( 'COMMENT *','H-Code').'" aria-required="true"></textarea>',
                    'comment_notes_after' => '<span class="required">'.esc_html__( '*Please complete all fields correctly','H-Code').'</span>',
                    'comment_notes_before' => '',
                    'id_form'           => 'commentform',
                    'id_submit'         => 'submit',
                    'class_submit'      => 'highlight-button-dark btn btn-small no-margin-bottom submit comment-button',
                    'title_reply'       => esc_html__( 'Add a comment', 'H-Code' ),
                    'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'H-Code' ),
                    'cancel_reply_link' => esc_html__( 'Cancel Reply', 'H-Code' ),
                    'label_submit'      => esc_html__( 'send message', 'H-Code' ),
                    );
	comment_form($comment_args); ?>

</div>
<?php // End Comments Area. ?>