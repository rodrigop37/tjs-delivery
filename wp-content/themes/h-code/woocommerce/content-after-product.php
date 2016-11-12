<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$output = '';
ob_start();
$product_sidebar_position = hcode_option('product_sidebar_position');
$hcode_product_left_sidebar = ( hcode_option('hcode_product_left_sidebar')) ? hcode_option('hcode_product_left_sidebar') : '';
$hcode_product_right_sidebar = ( hcode_option('hcode_product_right_sidebar')) ? hcode_option('hcode_product_right_sidebar') : '';
switch ($product_sidebar_position) {
	case '2':
		echo '</div>';
		echo '<div class="col-md-3 col-sm-4 single-product-left-sidebar">';
		if($hcode_product_left_sidebar){
			dynamic_sidebar($hcode_product_left_sidebar);
		}
		echo '</div>';
		break;
	
	case '3':
		echo '</div>';
		echo '<div class="col-md-3 col-sm-4 single-product-left-sidebar">';
		if($hcode_product_right_sidebar){
			dynamic_sidebar($hcode_product_right_sidebar);
		}
		echo '</div>';
		break;

	case '4':
		echo '</div>';
		echo '<div class="col-md-3 col-xs-12 sm-margin-top-ten">';
		if($hcode_product_right_sidebar){
			dynamic_sidebar($hcode_product_right_sidebar);
		}
		echo '</div>';
		break;

	case '1':
	default:
		
		break;
}
$output = ob_get_contents();
ob_end_clean();
echo $output
?>