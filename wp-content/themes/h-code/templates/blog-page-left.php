<?php
/**
 * displaying left sidebar for pages
 *
 * @package H-Code
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$layout_left_sidebar = $output = $layout_right_sidebar = $layout_settings = '';

ob_start();

$hcode_options = get_option( 'hcode_theme_setting' );
$layout_settings = hcode_option('hcode_blog_page_settings');
$layout_left_sidebar = hcode_option('hcode_blog_page_left_sidebar');
$layout_right_sidebar = hcode_option('hcode_blog_page_right_sidebar');

switch ($layout_settings) {
	case 'hcode_blog_page_left_sidebar':
        if( class_exists( 'WooCommerce' ) && is_cart() ){
            echo '<div class="col-md-9 col-sm-8 col-xs-12 shopping-cart-content xs-margin-ten-bottom pull-right xs-pull-none no-padding">';
        }else{
            echo '<div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1 xs-margin-bottom-seven pull-right xs-pull-none">';
        }
	break;

	case 'hcode_blog_page_right_sidebar':
        if( class_exists( 'WooCommerce' ) && is_cart() ){
            echo '<div class="col-md-9 col-sm-8 col-xs-12 shopping-cart-content xs-margin-ten-bottom no-padding">';
        }else{
		    echo '<div class="col-md-8 col-sm-8 col-xs-12">';
        }
		
	break;

	case 'hcode_blog_page_both_sidebar':
		echo '<div class="col-md-3 col-sm-6 col-xs-12 sidebar pull-left">';
			dynamic_sidebar($layout_left_sidebar);
		echo '</div>';
            echo '<div class="col-md-3 col-sm-6 col-xs-12 sidebar pull-right xs-margin-top-seven">';
			dynamic_sidebar($layout_right_sidebar);
		echo '</div>';
        if( class_exists( 'WooCommerce' ) && is_cart() ){
		    echo '<div class="col-md-6 col-sm-12 col-xs-12 shopping-cart-content pull-left sm-margin-top-seven sm-no-padding">';
        }else{
            echo '<div class="col-md-6 col-sm-12 col-xs-12 pull-left sm-margin-top-seven">';
        }
	break;

	case 'hcode_blog_page_full_screen':
    break;
}
$output = ob_get_contents();
		  ob_end_clean();
echo $output;
?>