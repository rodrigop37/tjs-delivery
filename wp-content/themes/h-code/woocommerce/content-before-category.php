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
		echo '<div class="col-md-9 col-sm-8 col-xs-12 col-md-offset-1 xs-margin-bottom-40px product-main-wrapper pull-right">';
		break;
	
	case '3':
		echo '<div class="col-md-9 col-sm-8 product-main-wrapper xs-margin-bottom-40px">';
		break;

	case '4':
		echo '<div class="col-md-2 col-sm-4 sidebar sm-margin-bottom-40px">';
		if($hcode_product_category_left_sidebar){
			dynamic_sidebar($hcode_product_category_left_sidebar);
		}
		echo '</div>';
		echo '<div class="col-md-2 col-sm-4 col-xs-12 sidebar pull-right sm-margin-bottom-40px">';
		if($hcode_product_category_right_sidebar){
			dynamic_sidebar($hcode_product_category_right_sidebar);
		}
		echo '</div>';
		echo '<div class="col-md-8 col-sm-12 product-main-wrapper xs-margin-bottom-40px">';
		break;

	case '1':
	default:
		echo '<div class="col-md-12 col-sm-12 product-main-wrapper">';
		break;
}
$output = ob_get_contents();
ob_end_clean();

echo $output;
?>