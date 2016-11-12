<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( $order ) : ?>
	<section class="order-receive-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 margin-five-bottom">
				<?php if ( $order->has_status( 'failed' ) ) : ?>

					<?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?></h4>

					<p><?php
						if ( is_user_logged_in() )
							esc_html_e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );
						else
							esc_html_e( 'Please attempt your purchase again.', 'woocommerce' );
					?></p>

					<p>
						<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ) ?></a>
						<?php if ( is_user_logged_in() ) : ?>
						<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My Account', 'woocommerce' ); ?></a>
						<?php endif; ?>
					</p>

				<?php else : ?>

					<h4 class="margin-bottom-10px"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></h4>

					<ul class="order_details">
						<li class="order">
							<?php esc_html_e( 'Order Number:', 'woocommerce' ); ?>
							<strong><?php echo $order->get_order_number(); ?></strong>
						</li>
						<li class="date">
							<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
							<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
						</li>
						<li class="total">
							<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
							<strong><?php echo $order->get_formatted_order_total(); ?></strong>
						</li>
						<?php if ( $order->payment_method_title ) : ?>
						<li class="method">
							<?php esc_html_e( 'Payment Method:', 'woocommerce' ); ?>
							<strong><?php echo $order->payment_method_title; ?></strong>
						</li>
						<?php endif; ?>
					</ul>
					<div class="clear"></div>

				<?php endif; ?>
				<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
				</div>

			<?php do_action( 'woocommerce_thankyou', $order->id ); ?>
			<?php $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );?>
			<a href="<?php echo $shop_page_url;?>" class="highlight-button btn btn-small no-margin-bottom clear-both pull-left"><i class="fa fa-long-arrow-left extra-small-icon"></i><?php esc_html_e( 'Continue Shopping', 'woocommerce' ); ?></a>

			</div>
		</div>
	</section>

<?php else : ?>

	<p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

<?php endif; ?>
