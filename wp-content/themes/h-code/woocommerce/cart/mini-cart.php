<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>
<div class="top-cart">
    <!-- nav shopping bag -->
    <a href="<?php echo WC()->cart->get_cart_url(); ?>" class="shopping-cart">
        <i class="fa fa-shopping-cart"></i>
        <div class="subtitle">
        	<?php 
				if(WC()->cart->cart_contents_count == 0){
					echo esc_html_e( '(0) item', 'H-Code' );
				}else{
					echo sprintf(_n('(%d) item', '(%d) items', WC()->cart->cart_contents_count, 'woothemes'), WC()->cart->cart_contents_count);
				}
			?>
		</div>
		<div class="subtitle-mobile">
        	<?php 
				if(WC()->cart->cart_contents_count == 0){
					echo esc_html_e( '0', 'H-Code' );
				}else{
					echo sprintf(_n('%d', '%d', WC()->cart->cart_contents_count, 'woothemes'), WC()->cart->cart_contents_count);
				}
			?>
		</div>
    </a>
    <!-- end nav shopping bag -->
    <!-- shopping bag content -->
	<div class="cart-content">
		<ul class="cart-list product_list_widget">

			<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

				<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

							$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
								<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
									esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
									esc_html__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
								?>
								<?php if ( ! $_product->is_visible() ) : ?>
									<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail )?>
								<?php else : ?>
									<a href="<?php echo esc_url( $product_permalink ); ?>">
										<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) ?>
									</a>
								<?php endif; ?>
								<div class="mini-cart-product-box">
									<?php if ( ! $_product->is_visible() ) : ?>
										<?php echo $product_name; ?>
									<?php else : ?>
										<a href="<?php echo esc_url( $product_permalink ); ?>">
											<?php echo $product_name; ?>
										</a>
									<?php endif; ?>
									<?php echo WC()->cart->get_item_data( $cart_item ); ?>

									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
									<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>"><?php  esc_html_e( 'Edit', 'H-Code' ); ?></a>
								</div>
							</li>
							<?php
						}
					}
				?>

			<?php else : ?>

				<li class="empty"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></li>

			<?php endif; ?>

		</ul><!-- end product list -->
	
	<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

		<p class="total"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>: <?php echo WC()->cart->get_cart_subtotal(); ?></p>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<p class="buttons">
			<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="btn btn-very-small-white no-margin-bottom margin-seven pull-left no-margin-lr"><?php esc_html_e( 'View Cart', 'woocommerce' ); ?></a>
			<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="btn btn-very-small-white no-margin-bottom margin-seven no-margin-right pull-right checkout"><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></a>
		</p>

	<?php endif; ?>
	</div>
	<!-- end shopping bag content -->
</div>
<?php do_action( 'woocommerce_after_mini_cart' ); ?>
