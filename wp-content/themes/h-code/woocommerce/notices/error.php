<?php
/**
 * Show error messages
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
<div class="woocommerce-error">
<?php foreach ( $messages as $message ) : ?>
	<div class="col-md-12 col-sm-12 col-xs-12 alert-remove woocommerce-error-message xs-margin-bottom-10px">
		<div class="alert alert-danger fade in" role="alert"><i class="fa fa-warning alert-danger"></i> <span><?php echo wp_kses_post( $message ); ?></span><button aria-hidden="true" data-dismiss="alert" class="close checkout-alert-remove" type="button">×</button></div>
	</div>
<?php endforeach; ?>
</div>