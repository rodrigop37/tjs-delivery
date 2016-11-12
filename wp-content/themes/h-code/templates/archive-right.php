<?php
/**
 * displaying right sidebar for archive pages
 *
 * @package H-Code
 */
?>
<?php
ob_start();
$layout_left_sidebar = $output = $layout_right_sidebar = $layout_settings = '';
	
$hcode_options = get_option( 'hcode_theme_setting' );
$layout_settings = (isset($hcode_options['hcode_general_settings'])) ? $hcode_options['hcode_general_settings'] : '';
$layout_left_sidebar = (isset($hcode_options['hcode_general_left_sidebar'])) ? $hcode_options['hcode_general_left_sidebar'] : '';
$layout_right_sidebar = (isset($hcode_options['hcode_general_right_sidebar'])) ? $hcode_options['hcode_general_right_sidebar'] : '';
	   
switch ($layout_settings) {
	case 'hcode_general_left_sidebar':
		echo '</div>';
            echo '<div class="col-md-3 col-sm-4 col-xs-12 sidebar pull-left">';
			dynamic_sidebar($layout_left_sidebar);
		echo '</div>';
		break;

	case 'hcode_general_right_sidebar':
		echo '</div>';
		echo '<div class="col-md-3 col-sm-4 col-xs-12 col-md-offset-1 xs-margin-top-seven sidebar pull-right">';
			dynamic_sidebar($layout_right_sidebar);
		echo '</div>';
		
		break;

	case 'hcode_general_both_sidebar':
		echo '</div>';
		break;
        
    case 'hcode_general_full_screen':
        break;
}
$output = ob_get_contents();
		   ob_end_clean();
echo $output;
?>