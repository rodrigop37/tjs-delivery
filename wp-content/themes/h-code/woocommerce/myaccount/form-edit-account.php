<?php
/**
 * Edit account form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

	<?php wc_print_notices(); ?>

	<?php do_action( 'woocommerce_before_edit_account_form' ); ?>

	<form action="" method="post">

		<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
		<div class="col-md-12 col-sm-12 col-xs-12 margin-three-bottom no-padding">
			<div class="form-row form-row-first col-sm-6 col-xs-12">
				<label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?> <em class="required">*</em></label>
				<input type="text" class="input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
			</div>
			<div class="form-row form-row-last col-sm-6 col-xs-12">
				<label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?> <em class="required">*</em></label>
				<input type="text" class="input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
			</div>
			<div class="clear"></div>

			<div class="form-row form-row-wide col-sm-12 col-xs-12">
				<label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <em class="required">*</em></label>
				<input type="email" class="input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
			</div>
		</div>
		<div class="clear"></div>
		<fieldset>
			<div class="col-md-12">
				<h2 class="black-text font-weight-600 text-uppercase title-small margin-bottom-20px xs-margin-bottom-5px"><?php esc_html_e( 'Password Change', 'woocommerce' ); ?></h2>
			</div>
			<div class="form-row form-row-wide col-sm-6 col-xs-12">
				<label for="password_current"><?php esc_html_e( 'Current Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
				<input type="password" class="input-text" name="password_current" id="password_current" />
			</div>
			<div class="form-row form-row-wide col-sm-6 col-xs-12">
				<label for="password_1"><?php esc_html_e( 'New Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
				<input type="password" class="input-text" name="password_1" id="password_1" />
			</div>
			<div class="form-row form-row-wide col-sm-12 col-xs-12">
				<label for="password_2"><?php esc_html_e( 'Confirm New Password', 'woocommerce' ); ?></label>
				<input type="password" class="input-text" name="password_2" id="password_2" />
			</div>

		</fieldset>
		<div class="clear"></div>

		<?php do_action( 'woocommerce_edit_account_form' ); ?>

		<div class="col-md-12 col-xs-12">
			<?php wp_nonce_field( 'save_account_details' ); ?>
			<input type="submit" class="highlight-button btn-small margin-right-20px xs-margin-five-bottom button btn" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>" />
			<input type="hidden" name="action" value="save_account_details" />
		</div>

		<?php do_action( 'woocommerce_edit_account_form_end' ); ?>

	</form>

	<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
