<?php
/**
 * Order Customer Details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
	<h2 class="black-text font-weight-600 text-uppercase title-small margin-bottom-20px"><?php esc_html_e( 'Customer Details', 'woocommerce' ); ?></h2>

	<table class="shop_table shop_table_responsive customer_details">
		<?php if ( $order->customer_note ) : ?>
			<tr>
				<td><?php esc_html_e( 'Note:', 'woocommerce' ); ?></td>
				<td  data-title="<?php _e( 'Note', 'woocommerce' ); ?>"><?php echo wptexturize( $order->customer_note ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $order->billing_email ) : ?>
			<tr>
				<td><?php esc_html_e( 'Email:', 'woocommerce' ); ?></td>
				<td data-title="<?php _e( 'Email', 'woocommerce' ); ?>"><?php echo esc_html( $order->billing_email ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $order->billing_phone ) : ?>
			<tr>
				<td><?php esc_html_e( 'Telephone:', 'woocommerce' ); ?></td>
				<td data-title="<?php _e( 'Telephone', 'woocommerce' ); ?>"><?php echo esc_html( $order->billing_phone ); ?></td>
			</tr>
		<?php endif; ?>

		<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
	</table>

	<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

	<div class="col2-set addresses row">
		<div class="col-1 col-md-6 col-sm-6 col-xs-12">

	<?php endif; ?>

	<header class="title">
		<h3 class="black-text font-weight-600 text-uppercase text-large margin-bottom-10px"><?php esc_html_e( 'Billing Address', 'woocommerce' ); ?></h3>
	</header>
	<address>
		<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : esc_html__( 'N/A', 'woocommerce' ); ?>
	</address>

	<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

		</div><!-- /.col-1 -->
		<div class="col-2 col-md-6 col-sm-6 col-xs-12">
			<header class="title">
				<h3 class="black-text font-weight-600 text-uppercase text-large margin-bottom-10px"><?php esc_html_e( 'Shipping Address', 'woocommerce' ); ?></h3>
			</header>
			<address>
				<?php echo ( $address = $order->get_formatted_shipping_address() ) ? $address : esc_html__( 'N/A', 'woocommerce' ); ?>
			</address>
		</div><!-- /.col-2 -->
	</div><!-- /.col2-set -->

	<?php endif; ?>
</div>