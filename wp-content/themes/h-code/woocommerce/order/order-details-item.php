<?php
/**
 * Order Item Details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
	<td class="product-name" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
		<?php
			$is_visible 		= $product && $product->is_visible();
			$product_permalink 	= apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

			echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item['name'] ) : $item['name'], $item, $is_visible );
			echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item );

			do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order );

			if ( constant("WOOCOMMERCE_VERSION") >= '2.4' ) {
			    $order->display_item_meta( $item );
				$order->display_item_downloads( $item );
			} else {
				$item_meta = new WC_Order_Item_Meta( $item['item_meta'], $product );
				$item_meta->display();
				if ( $product && $product->exists() && $product->is_downloadable() && $order->is_download_permitted() ) {

					$download_files = $order->get_item_downloads( $item );
					$i              = 0;
					$links          = array();

					foreach ( $download_files as $download_id => $file ) {
						$i++;

						$links[] = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . sprintf( esc_html__( 'Download file%s', 'woocommerce' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></small>';
					}

					echo '<br/>' . implode( '<br/>', $links );
				}
			}


			do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order );
		?>
	</td>
	<td class="product-total text-right" data-title="<?php _e( 'Total', 'woocommerce' ); ?>">
		<?php echo $order->get_formatted_line_subtotal( $item ); ?>
	</td>
</tr>
<?php if ( $show_purchase_note && $purchase_note ) : ?>
<tr class="product-purchase-note">
	<td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
</tr>
<?php endif; ?>
