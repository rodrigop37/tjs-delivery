<?php
/**
 * Order details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$order = wc_get_order( $order_id );

$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
?>
<div class="col-md-7 col-sm-12 col-xs-12">
	<h2 class="black-text font-weight-600 text-uppercase title-small margin-bottom-20px"><?php esc_html_e( 'Order Details', 'woocommerce' ); ?></h2>
	<table class="shop_table order_details review-order-details table">
		<thead>
			<tr>
				<th class="product-name text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-total text-right text-uppercase font-weight-600 letter-spacing-2 text-small black-text"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach( $order->get_items() as $item_id => $item ) {
					$product = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );

					wc_get_template( 'order/order-details-item.php', array(
						'order'   			=> $order,
						'item_id' 			=> $item_id,
						'item'    			=> $item,
						'show_purchase_note'=> $show_purchase_note,
						'purchase_note'	    => $product ? get_post_meta( $product->id, '_purchase_note', true ) : '',
						'product' 			=> $product
					) );
				}
			?>
			<?php do_action( 'woocommerce_order_items_table', $order ); ?>
		</tbody>
		<tfoot>
			<?php
				foreach ( $order->get_order_item_totals() as $key => $total ) {
					?>
					<tr>
						<td scope="row" class="text-uppercase font-weight-600 letter-spacing-2 black-text text-small"><?php echo $total['label']; ?></td>
						<td class="text-uppercase font-weight-600 black-text text-right" data-title="<?php echo str_replace(":","",$total['label']); ?>"><?php echo $total['value']; ?></td>
					</tr>
					<?php
				}
			?>
		</tfoot>
	</table>
	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</div>

<?php if ( $show_customer_details ) : ?>
	<?php wc_get_template( 'order/order-details-customer.php', array( 'order' =>  $order ) ); ?>
<?php endif; ?>
