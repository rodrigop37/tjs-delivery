<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

$product_sidebar_position = hcode_option('product_sidebar_position');

$hcode_product_tab_review_main_wrapper = '';
switch ($product_sidebar_position) {
	case '1':
	case '2':
	case '3':
		$hcode_product_tab_review_main_wrapper .= '';
	break;

	case '4':
		$hcode_product_tab_review_main_wrapper .= 'review-tab-with-both-sidebar';
	break;

	default:
	break;
}

if ( ! empty( $tabs ) ) : ?>
	<div class="wpb_column vc_column_container col-md-12 col-sm-12 col-xs-12"><div class="wide-separator-line  margin-eight no-margin-lr"></div></div>
	<div class="product-deails-tab">	
		<div class="col-md-12 col-sm-12 no-padding <?php echo $hcode_product_tab_review_main_wrapper;?>">
			<div class="tab-style1">
				<div class="col-md-12 col-sm-12">
					<ul class="nav nav-tabs nav-tabs-light text-left">
						<?php 
						$i = 1;
						foreach ( $tabs as $key => $tab ) : ?>
							<li class="<?php echo esc_attr( $key ); ?>_tab <?php echo $active = ($i == 1) ? 'active': ''?>">
								<a data-toggle="tab" href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
							</li>
						<?php 
						$i++;
						endforeach;
						?>
					</ul>
				</div>
				<div class="tab-content">
				<?php 
				$i = 1;
				foreach ( $tabs as $key => $tab ) : 
				?>
				<div class="tab-pane fade in <?php echo $active = ($i == 1) ? 'active': ''?>" id="tab-<?php echo esc_attr( $key ); ?>">
					<?php call_user_func( $tab['callback'], $key, $tab ); ?>
				</div>
				<?php 
					$i++;
					endforeach;
				?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>