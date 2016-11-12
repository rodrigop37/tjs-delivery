<?php
/**
 * The template for displaying the footer
 *
 * @package H-Code
 */
?>
<?php // Start Footer. ?>
<footer class="bg-light-gray2">
	<?php get_template_part('templates/footer-wrapper'); ?>
	<?php get_template_part('templates/footer'); ?>
</footer>
<?php // End Footer. ?>
<?php
	// Close Div For Ajax Popup
    hcode_add_ajax_page_div_footer( get_the_ID() );
 ?>
<?php 
	// Set Footer for Ajax Popup.
	hcode_set_footer( get_the_ID() );
	wp_footer();
?>
<?php
if (hcode_option('space_before_body')):
    echo hcode_option('space_before_body');
endif;
?>
</body>
</html>