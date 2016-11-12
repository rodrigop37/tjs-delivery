<?php
/**
 * displaying left sidebar for archive pages
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
$layout_settings = (isset($hcode_options['hcode_general_settings'])) ? $hcode_options['hcode_general_settings'] : '';
$layout_left_sidebar = (isset($hcode_options['hcode_general_left_sidebar'])) ? $hcode_options['hcode_general_left_sidebar'] : '';
$layout_right_sidebar = (isset($hcode_options['hcode_general_right_sidebar'])) ? $hcode_options['hcode_general_right_sidebar'] : '';
	
switch ($layout_settings) {
	case 'hcode_general_left_sidebar':
		echo '<div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1 xs-margin-bottom-seven pull-right xs-pull-none">';
		break;

	case 'hcode_general_right_sidebar':
		echo '<div class="col-md-8 col-sm-8 col-xs-12">';
		break;

	case 'hcode_general_both_sidebar':
		echo '<div class="col-md-3 col-sm-6 col-xs-12 sidebar pull-left">';
			dynamic_sidebar($layout_left_sidebar);
		echo '</div>';
            echo '<div class="col-md-3 col-sm-6 col-xs-12 sidebar pull-right xs-margin-top-seven">';
			dynamic_sidebar($layout_right_sidebar);
		echo '</div>';
		echo '<div class="col-md-6 col-sm-12 col-xs-12 pull-left sm-margin-top-seven">';
		break;

	case 'hcode_general_full_screen':
        break;
}
$output = ob_get_contents();
		  ob_end_clean();
echo $output;
?>