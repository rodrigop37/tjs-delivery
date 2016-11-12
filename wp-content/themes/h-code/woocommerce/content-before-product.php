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
		echo '<div class="col-md-9 col-sm-8 col-xs-12 xs-margin-bottom-30px no-padding pull-right">';
		break;
	
	case '3':
		echo '<div class="col-md-9 col-sm-8 col-xs-12 xs-margin-bottom-30px no-padding">';
		break;

	case '4':
		echo '<div class="col-md-3 col-xs-12">';
		if($hcode_product_left_sidebar){
			dynamic_sidebar($hcode_product_left_sidebar);
		}
		echo '</div>';
		echo '<div class="col-md-6 col-xs-12 no-padding">';
		break;

	case '1':
	default:
		
		break;
}
$output = ob_get_contents();
ob_end_clean();

echo $output;
?>