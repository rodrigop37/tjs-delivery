<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$output = '';
ob_start();
$product_category_sidebar_position = hcode_option('product_category_sidebar_position');
$hcode_product_category_left_sidebar = ( hcode_option('hcode_product_category_left_sidebar')) ? hcode_option('hcode_product_category_left_sidebar') : '';
$hcode_product_category_right_sidebar = ( hcode_option('hcode_product_category_right_sidebar')) ? hcode_option('hcode_product_category_right_sidebar') : '';
switch ($product_category_sidebar_position) {
	case '2':
		echo '</div>';
		echo '<div class="col-md-2 col-sm-4 col-xs-12 sidebar pull-left">';
		if($hcode_product_category_left_sidebar){
			dynamic_sidebar($hcode_product_category_left_sidebar);
		}
		echo '</div>';
		break;
	
	case '3':
		echo '</div>';
		echo '<div class="col-md-2 col-sm-4 sidebar col-md-offset-1">';
		if($hcode_product_category_right_sidebar){
			dynamic_sidebar($hcode_product_category_right_sidebar);
		}
		echo '</div>';
		break;

	case '4':
		echo '</div>';
		break;

	case '1':
	default:
		echo '</div>';
		break;
}
$output = ob_get_contents();
ob_end_clean();
echo $output
?>