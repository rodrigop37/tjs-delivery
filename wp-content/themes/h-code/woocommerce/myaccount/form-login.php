<?php
/**
 * Login Form
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

<div class="col-md-12">
	<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

	<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	<div class="col2-set" id="customer_login">

		<div class="col-1">

	<?php endif; ?>

			<h2 class="black-text font-weight-600 text-uppercase title-small margin-bottom-20px"><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

			<form method="post" class="login">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<div class="form-row form-row-wide col-sm-12 no-padding">
					<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?> <em class="required">*</em></label>
					<input type="text" class="input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
				</div>
				<div class="form-row form-row-wide col-sm-12 no-padding">
					<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <em class="required">*</em></label>
					<input class="input-text" type="password" name="password" id="password" />
				</div>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<div class="form-row">
					<?php wp_nonce_field( 'woocommerce-login' ); ?>
					<input type="submit" class="highlight-button btn-small button btn" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
					<div class="login-lost-password">
						<label for="rememberme" class="inline">
							<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'woocommerce' ); ?>
						</label>
						<p class="lost_password">
							<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
						</p>
					</div>
				</div>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>

	<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

		</div>

		<div class="col-2">

			<h2 class="black-text font-weight-600 text-uppercase title-small margin-bottom-20px"><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>

			<form method="post" class="register">

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<div class="form-row form-row-wide col-sm-12 no-padding">
						<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <em class="required">*</em></label>
						<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</div>

				<?php endif; ?>

				<div class="form-row form-row-wide col-sm-12 no-padding">
					<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <em class="required">*</em></label>
					<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
				</div>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<div class="form-row form-row-wide col-sm-12 no-padding">
						<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <em class="required">*</em></label>
						<input type="password" class="input-text" name="password" id="reg_password" />
					</div>

				<?php endif; ?>

				<!-- Spam Trap -->
				<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php esc_html_e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

				<?php do_action( 'woocommerce_register_form' ); ?>
				<?php do_action( 'register_form' ); ?>

				<div class="form-row col-md-12 no-padding">
					<?php wp_nonce_field( 'woocommerce-register' ); ?>
					<input type="submit" class="highlight-button btn-small button btn" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
				</div>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>

		</div>

	</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
</div>
