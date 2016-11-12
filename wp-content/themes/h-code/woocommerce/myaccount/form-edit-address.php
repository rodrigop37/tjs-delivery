<?php
/**
 * Edit address form
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $current_user;

$page_title = ( $load_address === 'billing' ) ? esc_html__( 'Billing Address', 'woocommerce' ) : esc_html__( 'Shipping Address', 'woocommerce' );

?>
	<?php wc_print_notices(); ?>
	
	<div class="col-md-12 col-sm-12 col-xs-12 billing-shipping-address no-padding">

		<?php do_action( 'woocommerce_before_edit_account_address_form' ); ?>

		<?php if ( ! $load_address ) : ?>

			<?php wc_get_template( 'myaccount/my-address.php' ); ?>

		<?php else : ?>

			<form method="post">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h3 class="black-text font-weight-600 text-uppercase text-large margin-bottom-10px"><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h3>
				</div>

				<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

				<?php foreach ( $address as $key => $field ) : ?>

					<?php woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] ); ?>

				<?php endforeach; ?>

				<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

				<div class="col-md-12 col-xs-12 margin-top-10px">
					<input type="submit" class="highlight-button btn-small xs-margin-five-bottom button btn" name="save_address" value="<?php esc_attr_e( 'Save Address', 'woocommerce' ); ?>" />
					<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
					<input type="hidden" name="action" value="edit_address" />
				</div>

			</form>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>

	</div>
