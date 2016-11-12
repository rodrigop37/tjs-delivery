<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! wc_coupons_enabled() ) {
	return;
}
?>
<div class="col-md-5 col-xs-12 alert-style4 pull-right">
<?php 
$info_message = apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon? Click here to enter your code', 'woocommerce' ) );
//wc_print_notice( $info_message, 'notice' );
?>
	<div class="panel panel-default border margin-bottom-20px">
	    <div role="tablist" id="headingOne" class="panel-heading no-padding">
	        <a class="collapsed" data-toggle="collapse" data-parent="#collapse-two" href="#collapse-two-link2">
	            <h4 class="panel-title no-border black-text font-weight-600 letter-spacing-2"><?php echo $info_message; ?> <span class="panel-title-icon pull-right"><i class="fa fa-plus"></i></span></h4>
	        </a>
	    </div>
	    <div style="height: 0px;" id="collapse-two-link2" class="panel-collapse collapse">
	        <div class="panel-body">
                <div class="form-wrap">
                    <div class="form-group">
                        <form class="checkout_coupon display-block" method="post">
                        	<ul>
							<li class="form-row form-row-first">
								<label><?php esc_html_e( 'Coupon code', 'woocommerce' ); ?></label>
								<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" />
							</li>
							<li class="form-row form-row-last">
								<input type="submit" class="button btn btn-black no-margin-bottom btn-small" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'woocommerce' ); ?>" />
							</li>
							</ul>
						</form>
                    </div>
                </div>
	        </div>
	    </div>
	</div>
</div>