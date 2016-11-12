<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! $messages ){
	return;
}

?>

<?php foreach ( $messages as $message ) : ?>
	<div class="col-sm-12 col-xs-12 lert-remove woocommerce-notice-message xs-margin-bottom-10px"><div class="alert alert-info fade in" role="alert"><i class="fa fa-info-circle alert-info"></i> <span><?php echo wp_kses_post( $message ); ?></span><button aria-hidden="true" data-dismiss="alert" class="close checkout-alert-remove" type="button">×</button></div></div>	
<?php endforeach; ?>
