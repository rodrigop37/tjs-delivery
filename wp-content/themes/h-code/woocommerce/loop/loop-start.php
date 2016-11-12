<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>
<?php
$hcode_category_product_row = hcode_option( 'hcode_category_product_row_column' );
$hcode_category_product_row = ( $hcode_category_product_row ) ? $hcode_category_product_row : '3'
?>
<div class="products <?php echo 'product-'.$hcode_category_product_row;?> product-listing margin-three-top col-md-12 col-sm-12 no-padding<?php hcode_woocommerce_category_view()?>">