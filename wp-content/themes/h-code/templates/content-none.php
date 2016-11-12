<?php
/**
 * displaying if not exist any posts
 *
 * @package H-Code
 */
?>
<div class="col-md-12 col-sm-12 col-xs-12 no-padding">
	<div class="alert alert-warning fade in" role="alert">
	    <i class="fa fa-question-circle alert-warning"></i>
		<?php if ( is_search() ) : ?>
			<strong><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'H-Code'); ?></strong>
		<?php else : ?>
			<strong><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'H-Code'); ?></strong>
		<?php endif; ?>
		
	</div>
</div>