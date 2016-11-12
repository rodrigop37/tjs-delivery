<?php
/**
 * Shortcode For Blockquote
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Blockquote */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_blockquote_shortcode' ) ) {
	function hcode_blockquote_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'id' => '',
	        	'class' => '',
	        	'hcode_blockquote_heading' => '',
	            'blockquote_icon' => '',
				'hcode_blockquote_bg_color' => '',
			    'hcode_blockquote_color' => '',
			    'hcode_border_position' => '',
				'hcode_border_color' => '',
			    'hcode_border_size' => '',
			    'hcode_border_type' => '',
			    'desktop_padding' => '',
			    'custom_desktop_padding' => '',
	            'desktop_margin' => '',
	            'custom_desktop_margin' => '',
			    'hcode_blockquote_font_size' => '',
			    'hcode_blockquote_line_height' => '',
	        ), $atts ) );

		$output = $border_attr = $style_footer_atrr = $style_atrr = '';

		$id = ( $id ) ? ' id="'.$id.'"' : '';
		$class = ( $class ) ? ' '.$class : '';
		$hcode_blockquote_heading = ( $hcode_blockquote_heading ) ? $hcode_blockquote_heading : '';
		$hcode_blockquote_bg_color = ( $hcode_blockquote_bg_color ) ? ' background: none repeat scroll 0 0 '.$hcode_blockquote_bg_color.';' : '';
		$hcode_blockquote_color = ( $hcode_blockquote_color ) ? 'color: '.$hcode_blockquote_color.';' : '';
		$hcode_border_position = ( $hcode_border_position ) ? ' '.$hcode_border_position : '';
		$hcode_border_color = ( $hcode_border_color ) ? $hcode_border_color.';' : '';
		$hcode_border_size = ( $hcode_border_size ) ? $hcode_border_size : '';
		$hcode_border_type = ( $hcode_border_type ) ? $hcode_border_type : '';
		$desktop_padding = ( $desktop_padding && $desktop_padding != 'custom-desktop-padding') ? $desktop_padding.' ' : '';
	    $desktop_margin = ( $desktop_margin && $desktop_margin != 'custom-desktop-margin') ? $desktop_margin.' ' : '';
		$custom_desktop_padding = ( $custom_desktop_padding ) ? ' padding:'.$custom_desktop_padding.';' : '';
	    $custom_desktop_margin = ( $custom_desktop_margin ) ? ' margin:'.$custom_desktop_margin.';' : '';
		$hcode_blockquote_font_size = ($hcode_blockquote_font_size) ? ' font-size:'.$hcode_blockquote_font_size.';' : '';
		$hcode_blockquote_line_height = ($hcode_blockquote_line_height) ? ' line-height:'.$hcode_blockquote_line_height.';' : '';
	    $blockquote_icon = ( $blockquote_icon == 1 ) ? ' blog-image' : '';
	        
		if($hcode_border_size || $hcode_border_color || $hcode_border_size):
			$border_attr = $hcode_border_position.': '.$hcode_border_size.' '.$hcode_border_type.' '.$hcode_border_color;
		endif;
		if($desktop_padding || $class || $blockquote_icon || $desktop_margin):
			$class_attr = ' class="'.$desktop_padding.$desktop_margin.$class.$blockquote_icon.'"';
	    else:
	        $class_attr = '';
		endif;
		if($border_attr || $custom_desktop_padding || $hcode_blockquote_bg_color || $hcode_blockquote_font_size || $hcode_blockquote_line_height || $custom_desktop_margin):
			$style_atrr = ' style="'.$border_attr.$custom_desktop_padding.$custom_desktop_margin.$hcode_blockquote_bg_color.$hcode_blockquote_color.$hcode_blockquote_font_size.$hcode_blockquote_line_height.'"';
		endif;
		if($hcode_blockquote_color):
			$style_footer_atrr = ' style="'.$hcode_blockquote_color.'"';
		endif;

		$output .= '<blockquote'.$id.$class_attr.$style_atrr.'>';
			if($content):
	    		$output .= '<p>'.do_shortcode( $content ).'</p>';
	    	endif;
	    	if($hcode_blockquote_heading):
	    		$output .= '<footer'.$style_footer_atrr.'>'.$hcode_blockquote_heading.'</footer>';
	    	endif;
	    $output .= '</blockquote>';
	    return $output;
	}
}
add_shortcode("hcode_blockquote","hcode_blockquote_shortcode");
?>