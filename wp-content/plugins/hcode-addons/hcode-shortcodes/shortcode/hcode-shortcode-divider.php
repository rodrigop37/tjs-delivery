<?php
/**
 * Shortcode For Divider
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Divider */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_divider_shortcode' ) ) {
	function hcode_divider_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
	            'hcode_row_border_position' => '',
	            'hcode_row_border_color' => '',
	            'hcode_border_size' => '',
	            'hcode_border_type' => '',
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

	    /* For Border */
		$hcode_row_border_pos = ($hcode_row_border_position) ? $hcode_row_border_position.': ' : '';
		if($hcode_row_border_pos){
			$hcode_row_border_pos .= ($hcode_border_size) ? $hcode_border_size : '';
			$hcode_row_border_pos .= ($hcode_border_type) ? ' '.$hcode_border_type : '';
			$hcode_row_border_pos .= ($hcode_row_border_color) ? ' '.$hcode_row_border_color : '';
			$hcode_row_border_pos .= ';';
		}
	        
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

		if($style_attr || $hcode_row_border_pos){
			$style .= ' style="'.$style_attr.$hcode_row_border_pos.'"';
		}
		$output .= '<div class="hcode-divider'.$margin.$padding.'" '.$style.'></div>';
		return $output;
	}
}
add_shortcode( 'hcode_divider', 'hcode_divider_shortcode' );
?>