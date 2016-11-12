<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_excerpt ) {
	return;
}

?>
<div class="short-description" itemprop="description">
	<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
	<?php
	$enable_readmore_woocommenrce = hcode_option('enable_readmore_woocommenrce');
	$hcode_readmore_button_text = hcode_option('hcode_readmore_button_text');
	
	if( $enable_readmore_woocommenrce == 1 && get_the_content() && is_singular('product')){
		echo '<a href="#tab-description" class="woo-inner-link" >'.$hcode_readmore_button_text.'</a>';
	}
	?>
</div>
