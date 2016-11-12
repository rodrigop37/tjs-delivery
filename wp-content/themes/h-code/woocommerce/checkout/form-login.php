<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

$info_message  = apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer? Click here to login', 'woocommerce' ) );
//$info_message .= ' <a href="#" class="showlogin">' . esc_html__( 'Click here to login', 'woocommerce' ) . '</a>';
//wc_print_notice( $info_message, 'notice' );
?>
<div class="col-md-5 col-xs-12 alert-style4 pull-left">
	<div class="panel panel-default border margin-bottom-20px">
	    <div role="tablist" id="headingOne" class="panel-heading no-padding">
	        <a class="collapsed" data-toggle="collapse" data-parent="#collapse-two" href="#collapse-two-link1">
	            <h4 class="panel-title no-border black-text font-weight-600 letter-spacing-2"><?php echo $info_message;?><span class="panel-title-icon pull-right"><i class="fa fa-plus"></i></span></h4>
	        </a>
	    </div>
	    <div style="height: 0px;" id="collapse-two-link1" class="panel-collapse collapse">
	        <div class="panel-body">
                <div class="form-wrap">
                    <div class="form-group">
                        <?php
							woocommerce_login_form(
								array(
									'message'  => esc_html__( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
									'redirect' => wc_get_page_permalink( 'checkout' ),
									'hidden'   => true
								)
							);
						?>
                    </div>
                </div>
	        </div>
	    </div>
	</div>
</div>
