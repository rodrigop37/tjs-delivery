<?php
/**
 * Cart Page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php
$hcode_layout_settings_single = hcode_option('hcode_layout_settings');

$hcode_cart_section_classes = $hcode_cart_coupon_classes = $hcode_cart_total_classes = $table_start_div = $table_end_div = '';
switch ($hcode_layout_settings_single) {
	case 'default':
	case 'hcode_layout_left_sidebar':
	case 'hcode_layout_right_sidebar':
		$hcode_cart_section_classes .= ' class="no-padding"';
		$hcode_cart_coupon_classes .= 'col-md-5 col-sm-12 calculate no-padding-left xs-margin-bottom-ten xs-no-padding no-padding';
		$hcode_cart_total_classes .= 'col-md-6 col-sm-12 col-md-offset-1 col-sm-offset-0 no-padding-right xs-no-padding no-padding';
		$table_start_div .= '<div class="shopping-cart-scroll">';
		$table_end_div .= '</div>';
	break;
	case 'hcode_layout_both_sidebar':
		$hcode_cart_section_classes .= ' class="no-padding"';
		$table_start_div .= '<div class="shopping-cart-scroll shopping-cart-both-col-scroll">';
		$table_end_div .= '</div>';
	break;
	case 'hcode_layout_full_screen':
		$hcode_cart_section_classes .= '';
		$hcode_cart_coupon_classes .= 'col-md-5 col-sm-5 calculate no-padding-left xs-margin-bottom-ten xs-no-padding';
		$hcode_cart_total_classes .= 'col-md-6 col-sm-7 col-md-offset-1 no-padding-right xs-no-padding';
		$table_start_div .= '<div class="shopping-cart-scroll shopping-cart-full-screen-scroll">';
		$table_end_div .= '</div>';
	break;
	
	default:
		# code...
		break;
}
?>
<section <?php echo $hcode_cart_section_classes; ?>>
<div class="container">
<div class="row">
	<?php
	$print_output = '';
	ob_start();
		wc_print_notices();
	$print_output .= ob_get_contents();
	ob_end_clean();
	echo $print_output;
	

	do_action( 'woocommerce_before_cart' ); ?>

	<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
	<div class="col-sm-12 shop-cart-table">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<?php echo $table_start_div;?>

	<table class="table shop-cart shop_table shop_table_responsive cart text-center">

		<thead>
			<tr>
				
				<th class="product-thumbnail first">&nbsp;</th>
				<th class="product-name text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-price text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="product-quantity text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text"><?php esc_html_e( 'Sub Total', 'woocommerce' ); ?></th>
				<th class="product-remove">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-thumbnail text-left">
							<?php
								/* Image Alt, Title, Caption */
								$img_alt = hcode_option_image_alt(get_post_thumbnail_id( $product_id ));
								$img_title = hcode_option_image_title(get_post_thumbnail_id( $product_id ));
								$image_alt = ( isset($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
								$image_title = ( isset($img_title['title']) ) ? $img_title['title'] : '';

								$img_attr = array(
								    'title' => $image_title,
								    'alt' => $image_alt,
								);
								
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'shop_thumbnail', $img_attr ), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
									echo $thumbnail;
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
								}
							?>
						</td>

						<td class="product-name text-left" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
							<?php
								if ( ! $product_permalink ) {
									echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
								} else {
									echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a class="margin-two-bottom" href="%s">%s </a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
								}

								//sku
								if ( wc_product_sku_enabled() && ( $_product->get_sku() || $_product->is_type( 'variable' ) ) ) : 
									echo '<span class="text-uppercase display-block text-small margin-two no-margin-top light-gray-text2">';
									esc_html_e( 'SKU:', 'woocommerce' );
									echo ( $sku = $_product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' );
									echo '</span>';
								endif;

								// Meta data
								echo WC()->cart->get_item_data( $cart_item );

								// Backorder notification
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
									echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
								}
								
	                            echo '<a class="text-small" href="'.esc_url( $product_permalink ).'"><i class="fa fa-edit black-text"></i> '.esc_html__('Edit', 'woocommerce').'</a>';
							?>
						</td>

						<td class="product-price text-left" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>

						<td class="product-quantity" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input( array(
										'input_name'  => "cart[{$cart_item_key}][qty]",
										'input_value' => $cart_item['quantity'],
										'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
										'min_value'   => '0'
									), $_product, false );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
							?>
						</td>

						<td class="product-subtotal text-left" data-title="<?php _e( 'Total', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</td>

						<td class="product-remove text-center">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="pro-remove remove" title="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-times"></i></a>',
									esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
									esc_html__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
							?>
						</td>
					</tr>
					<?php
				}
			}

			do_action( 'woocommerce_cart_contents' );
			?>		

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php echo $table_end_div;?>
	</div>
	<div class="col-sm-12">
		<div class="cupon padding-five border-top border-bottom">
			<?php global $woocommerce;?>
			<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>?empty-cart" class="highlight-button btn btn-very-small no-margin pull-left"><?php esc_html_e('Empty Cart', 'woocommerce');?></a>
			<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) );?>" class="highlight-button btn btn-very-small no-margin pull-right continue-shopping"><?php esc_html_e( 'Continue Shopping', 'woocommerce' ); ?></a>
			<input type="submit" class="highlight-button btn btn-very-small no-margin pull-right" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />

			<?php do_action( 'woocommerce_cart_actions' ); ?>

			<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		</div>
	</div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>

	</form>

	<div class="col-sm-12 col-xs-12 padding-five no-padding-bottom">
		<div class="<?php echo $hcode_cart_coupon_classes;?>">
			<?php if ( WC()->cart->coupons_enabled() ) { ?>
			<div class="panel panel-default border margin-five no-margin-top">
		        <div role="tablist" id="headingOne" class="panel-heading no-padding">
		            <a class="collapsed" data-toggle="collapse" data-parent="#collapse-two" href="#collapse-two-link1">
		                <h4 class="panel-title no-border black-text font-weight-600 letter-spacing-2">Coupon Code <span class="pull-right"><i class="fa fa-plus"></i></span></h4>
		            </a>
		        </div>
		        <div id="collapse-two-link1" class="panel-collapse collapse">
		            <div class="panel-body">
		                <form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
							<div class="coupon">
								<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
								<input type="submit" class="highlight-button btn btn-very-small no-margin pull-left" name="apply_coupon" value="<?php esc_attr_e( 'Apply Code', 'woocommerce' ); ?>" />
								<?php do_action( 'woocommerce_cart_coupon' ); ?>
							</div>
						</form>
		            </div>
		        </div>
		    </div>
			<?php } ?>	
		</div>
		<div class="<?php echo $hcode_cart_total_classes;?>">
			<?php woocommerce_cart_totals(); ?>
		</div>

	</div>

	<?php do_action( 'woocommerce_after_cart' ); ?>
</div>
</div>
</section>