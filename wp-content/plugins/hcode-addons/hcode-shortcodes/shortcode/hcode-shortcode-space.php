<?php
/**
 * Shortcode For Space
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Space */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_space_shortcode' ) ) {
	function hcode_space_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
	        'padding_setting' => '',
	        'desktop_padding' => '',
	        'custom_desktop_padding' => '',
	        'ipad_padding' => '',
	        'mobile_padding' => '',
	        'margin_setting' => '',
	        'desktop_margin' => '',
	        'custom_desktop_margin' => '',
	        'ipad_margin' => '',
	        'mobile_margin' => '',
	        ), $atts ) );
	    $output = $padding = $padding_style = $margin = $margin_style = $style_attr = $style = '';

	    // Column Padding settings
		$padding_setting = ( $padding_setting ) ? $padding_setting : '';
		$desktop_padding = ( $desktop_padding ) ? ' '.$desktop_padding : '';
		$ipad_padding = ( $ipad_padding ) ? ' '.$ipad_padding : '';
		$mobile_padding = ( $mobile_padding ) ? ' '.$mobile_padding : '';
		$custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
		if($desktop_padding == ' custom-desktop-padding' && $custom_desktop_padding){
			$padding_style .= " padding: ".$custom_desktop_padding.";";
		}else{
			$padding .= $desktop_padding;
		}
		$padding .= $ipad_padding.$mobile_padding;

		// Column Margin settings
		$margin_setting = ( $margin_setting ) ? $margin_setting : '';
		$desktop_margin = ( $desktop_margin ) ? ' '.$desktop_margin : '';
		$ipad_margin = ( $ipad_margin ) ? ' '.$ipad_margin : '';
		$mobile_margin = ( $mobile_margin ) ? ' '.$mobile_margin : '';
		$custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
		if($desktop_margin == ' custom-desktop-margin' && $custom_desktop_margin){
			$margin_style .= " margin: ".$custom_desktop_margin.";";
		}else{
			$margin .= $desktop_margin;
		}
		$margin .= $ipad_margin.$mobile_margin;

		// Padding and Margin Style Combine
		if($padding_style){
			$style_attr .= $padding_style;
		}
		if($margin_style){
			$style_attr .= $margin_style;
		}
		if($style_attr){
			$style .= ' style="'.$style_attr.'"';
		}
		$output .= '<div class="hcode-space'.$padding.$margin.'"'.$style.'></div>';
		return $output;
	}
}
add_shortcode( 'hcode_space', 'hcode_space_shortcode' );
?>