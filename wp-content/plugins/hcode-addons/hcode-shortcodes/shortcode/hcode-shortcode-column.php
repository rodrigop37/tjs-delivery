<?php
/**
 * Shortcode For Column
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Column */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'vc_column' ) ) {
	function vc_column( $atts, $content = '', $id = '' ) {
		extract( shortcode_atts( array(
			'id' => '',
			'class' => '',
	    	'centralized_div' => '',
	    	'min_height' => '',
	        'alignment_setting' => '',
	        'desktop_alignment' => '',
	        'ipad_alignment' => '',
	        'mobile_alignment' => '',
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
	        'display_setting' => '',
	        'desktop_display' => '',
	        'ipad_display' => '',
	        'mobile_display' => '',
	        'clear_both' => '',
	        'pull_right' => '',
	        'width' => '',
	        'offset' => '',
	        'hcode_column_bg_color' => '',
	        'hcode_column_animation_style' => '',
	        'hcode_column_animation_duration' => '',
	        'fullscreen' => '',
		), $atts ) );

		$output = $alignment = $padding = $padding_style = $margin = $margin_style = $style_attr = $style = $min_height_class = $display = '';
		$fullscreen = ($fullscreen) ? " full-screen" : '';
		$id = ( $id ) ? ' id="'.$id.'"' : '';
		$class = ( $class ) ? ' '.$class : '';
		$centralized_div = ( $centralized_div ) ? ' center-col' : '';
		$clear_both = ( $clear_both ) ? ' clear-both' : '';
	    $pull_right = ( $pull_right ) ? ' pull-right' : '';

		// Column Allignment settings
		$alignment_setting = ( $alignment_setting ) ? $alignment_setting : '';
		$desktop_alignment = ( $desktop_alignment ) ? ' '.$desktop_alignment : '';
		$ipad_alignment = ( $ipad_alignment ) ? ' '.$ipad_alignment : '';
		$mobile_alignment = ( $mobile_alignment ) ? ' '.$mobile_alignment : '';
		
		// Column Display setting
		$display_setting = ($display_setting) ? $display_setting : '';
	    $desktop_display = ($desktop_display) ? ' '.$desktop_display : '';
	    $ipad_display = ($ipad_display) ? ' '.$ipad_display : '';
	    $mobile_display = ($mobile_display) ? ' '.$mobile_display : '';

	    $display .= $desktop_display.$ipad_display.$mobile_display;

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

		// Set min-height
		$min_height = ( $min_height ) ? $min_height : '';
		if( $min_height ):
			$style_attr .= ' min-height:'.$min_height.';';
			$min_height_class .= ' column-min-height';
		endif;

	    // Column bg color
	    $hcode_column_bg_color = ( $hcode_column_bg_color ) ? $hcode_column_bg_color : '';
	    if( $hcode_column_bg_color ):
	        $style_attr .= " background:".$hcode_column_bg_color.";";
	    endif;
		if($style_attr){
			$style .= ' style="'.$style_attr.'"';
		}
		// Column Offset and sm width
		$offset = ( $offset ) ? ' '. str_replace( 'vc_', '', $offset ) : '';
		if(strchr($offset,'col-xs')):
			$offset = $offset;
		else:
			$offset = $offset." col-xs-mobile-fullwidth";
		endif;
		
		if($width != ''){
			$width = explode('/', $width);
	    	$width = ( $width[0] != '1' ) ? ' col-sm-'.$width[0] * floor(12 / $width[1]) : ' col-sm-'.floor(12 / $width[1]);
		}

	    // Column Animation 
	    $hcode_column_animation_style = ( $hcode_column_animation_style ) ? ' wow '.$hcode_column_animation_style : '';
	    $hcode_column_animation_duration = ( $hcode_column_animation_duration ) ? ' data-wow-duration= '.$hcode_column_animation_duration.'ms' : '';

		if($alignment_setting){
			$alignment .= $desktop_alignment;
			$alignment .= $ipad_alignment;
			$alignment .= $mobile_alignment;
		}

		$output .= '<div'.$id.' class="wpb_column vc_column_container'.$clear_both.$pull_right.$class.$min_height_class.$offset.$width.$alignment.$centralized_div.$padding.$margin.$display.$hcode_column_animation_style.$fullscreen.'"'.$style.$hcode_column_animation_duration.'>';
			$output .= '<div class="vc-column-innner-wrapper">';
				$output .= do_shortcode( $content );
			$output .= '</div>';
		$output .= '</div>';

		return $output;
	}
}
add_shortcode( 'vc_column', 'vc_column' );
add_shortcode( 'vc_column_inner', 'vc_column' );
?>