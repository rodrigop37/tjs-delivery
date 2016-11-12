<?php
/**
 * displaying footer wrapper section
 *
 * @package H-Code
 */
?>
<?php
$hcode_options = get_option( 'hcode_theme_setting' );
$enable_footer_wrapper = hcode_option('hcode_enable_footer_wrapper');
$enable_footer_wrapper = hcode_option('hcode_enable_footer_wrapper');

$phone_icon = ( isset($hcode_options['hcode_footer_wrapper_phone_icon'])) ? $hcode_options['hcode_footer_wrapper_phone_icon'] : '';
$phone_text = (isset($hcode_options['hcode_footer_wrapper_phone_text'])) ? $hcode_options['hcode_footer_wrapper_phone_text'] : '';
$map_icon = (isset($hcode_options['hcode_footer_map_icon'])) ? $hcode_options['hcode_footer_map_icon'] : '';
$map_text = (isset($hcode_options['hcode_footer_wrapper_map_text'])) ? $hcode_options['hcode_footer_wrapper_map_text'] : '';
$email_icon = (isset($hcode_options['hcode_footer_wrapper_email_icon'])) ? $hcode_options['hcode_footer_wrapper_email_icon'] : '';
$email_id = (isset($hcode_options['hcode_footer_wrapper_email_id'])) ? $hcode_options['hcode_footer_wrapper_email_id'] : '';

$output='';
if($enable_footer_wrapper == 1){
	$output .='<div class=" bg-white footer-top">';
		$output .='<div class="container">';
		    $output .='<div class="row margin-four">';
		    	if(!empty($phone_icon) || !empty($phone_text)){
			        $output .='<div class="col-md-4 col-sm-4 text-center">';
				        $output .='<i class="'.$phone_icon.' small-icon black-text"></i>';
				        $output .='<h6 class="black-text margin-two no-margin-bottom">'.$phone_text.'</h6>';
			        $output .='</div>';
		    	}
		    	if(!empty($map_icon) || !empty($map_text)){
			        $output .='<div class="col-md-4 col-sm-4 text-center">';
				        $output .='<i class="'.$map_icon.' small-icon black-text"></i>';
				        $output .='<h6 class="black-text margin-two no-margin-bottom">'.$map_text.'</h6>';
			        $output .='</div>';
		    	}
		    	if(!empty($email_icon) || !empty($email_id)){
			        $output .='<div class="col-md-4 col-sm-4 text-center">';
				        $output .='<i class="'.$email_icon.' small-icon black-text"></i>';
				        $output .='<h6 class="margin-two no-margin-bottom">';
				       		 $output .='<a href="mailto:'.$email_id.'" class="black-text">'.$email_id.'</a>';
				        $output .='</h6>';
			        $output .='</div>';
		    	}
		    $output .='</div>';
		$output .='</div>';
	$output .='</div>';

	echo $output;
}
?>