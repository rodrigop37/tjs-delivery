<?php
/**
 * Review order table
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="woocommerce-checkout-review-order-table">
	<div class="row margin-five no-margin-bottom">
		<div class="col-sm-12 shop-cart-table">
			<div class="shopping-cart-scroll">
			<table class="shop_table_center table shop-cart text-center">
				<thead>
					<tr>
						<th class="product-thumbnail first">&nbsp;</th>
						<th class="product-name text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
						<th class="product-total text-right text-uppercase font-weight-600 letter-spacing-2 text-small black-text no-padding-right"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php
						do_action( 'woocommerce_review_order_before_cart_contents' );

						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								?>
								<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
									<td class="product-thumbnail text-left">
										<?php
											/* Image Alt, Title, Caption */
											$img_alt = hcode_option_image_alt(get_post_thumbnail_id( $cart_item['product_id'] ));
											$img_title = hcode_option_image_title(get_post_thumbnail_id( $cart_item['product_id'] ));
											$image_alt = ( isset($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
											$image_title = ( isset($img_title['title']) ) ? $img_title['title'] : '';

											$img_attr = array(
											    'title' => $image_title,
											    'alt' => $image_alt,
											);

											$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'shop_thumbnail', $img_attr ), $cart_item, $cart_item_key );

											if ( ! $_product->is_visible() ) {
												echo $thumbnail;
											} else {
												printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
											}
										?>
									</td>
									<td class="product-name text-left black-text" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
										<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
										<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
										<?php echo WC()->cart->get_item_data( $cart_item ); ?>
										<?php //sku
										if ( wc_product_sku_enabled() && ( $_product->get_sku() || $_product->is_type( 'variable' ) ) ) : 
											echo '<span class="text-uppercase display-block text-small margin-two gray-text">';
											esc_html_e( 'SKU:', 'woocommerce' );
											echo ( $sku = $_product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' );
											echo '</span>';
										endif;
										echo '<a class="text-small" href="'.esc_url( $_product->get_permalink( $cart_item ) ).'"><i class="fa fa-edit black-text"></i> '.esc_html__('Edit', 'woocommerce').'</a>';
										?>
									</td>
									<td class="product-total text-right no-padding-right" data-title="<?php _e( 'Total', 'woocommerce' ); ?>">
										<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
									</td>
								</tr>
								<?php
							}
						}

						do_action( 'woocommerce_review_order_after_cart_contents' );
					?>
				</tbody>
				<tfoot>

					<tr class="cart-subtotal">
						<td></td>
						<td class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></td>
						<td class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
					</tr>

					<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
						<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
							<td></td>
							<td class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php wc_cart_totals_coupon_label( $coupon ); ?></td>
							<td class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
						</tr>
					<?php endforeach; ?>

					<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

						<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

						<?php wc_cart_totals_shipping_html(); ?>

						<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

					<?php endif; ?>

					<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
						<tr class="fee">
							<td></td>
							<td class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php echo esc_html( $fee->name ); ?></td>
							<td class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php wc_cart_totals_fee_html( $fee ); ?></td>
						</tr>
					<?php endforeach; ?>

					<?php if ( wc_tax_enabled() && WC()->cart->tax_display_cart === 'excl' ) : ?>
						<?php if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>
							<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
								<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
									<td></td>
									<td class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php echo esc_html( $tax->label ); ?></td>
									<td class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
								</tr>
							<?php endforeach; ?>
						<?php else : ?>
							<tr class="tax-total">
								<td></td>
								<td class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></td>
								<td class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php wc_cart_totals_taxes_total_html(); ?></td>
							</tr>
						<?php endif; ?>
					<?php endif; ?>

					<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

					<tr class="order-total">
						<td></td>
						<td class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php esc_html_e( 'Total', 'woocommerce' ); ?></td>
						<td class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small" data-title="<?php esc_html_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
					</tr>

					<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

				</tfoot>
			</table>
			</div>
		</div>
	</div>
</div>