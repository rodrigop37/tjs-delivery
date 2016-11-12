<?php
/**
 * Shortcode For Separator
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Separator */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_separator_shortcode' ) ) {
	function hcode_separator_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
	        'id' =>'',
	        'class' => '',
	        'hcode_sep_style' => '',
	        'hcode_sep_bg_color' => '', 
	        'margin_lt_none' => '',
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
	        'hcode_height' => '',
	        ), $atts ) );

	    $output = $padding = $padding_style = $margin = $margin_style = $style_attr = $style = $classes = '';
	    
	    $id = ( $id ) ? ' id="'.$id.'"' : '';
	    $class = ( $class ) ? $class : '';
	    $margin_lt_none = ( $margin_lt_none == 1 ) ? ' no-margin-lr' : '';
	    $hcode_sep_bg_color = ($hcode_sep_bg_color) ? ' background:'.$hcode_sep_bg_color.';' : '';
	    $hcode_height = ($hcode_height) ? 'height:'.$hcode_height.';' : '';

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

		if($style_attr || $hcode_sep_bg_color || $hcode_height){
			$style .= ' style="'.$style_attr.$hcode_sep_bg_color.$hcode_height.'"';
		}
		switch ($hcode_sep_style) {
			case 'large':
				$classes .= 'wide-separator-line';
				break;
			
			case 'small':
				$classes .= 'separator-line';
				break;
		}
		$output .= '<div'.$id.' class="'.$classes.$padding.$margin.$class.$margin_lt_none.'"'.$style.'></div>';
		return $output;
	}
}
add_shortcode( 'hcode_separator', 'hcode_separator_shortcode' );
?>