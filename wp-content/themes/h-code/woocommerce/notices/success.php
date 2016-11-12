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
	<div class="col-sm-12 col-xs-12 woocommerce-message alert-remove xs-margin-bottom-10px"><div class="woocommerce-success-message alert alert-success fade in"><i class="fa fa-thumbs-up alert-success"></i><?php echo wp_kses_post( $message ); ?><button class="close checkout-alert-remove" type="button" data-dismiss="alert" aria-hidden="true">×</button></div></div>
<?php endforeach; ?>
