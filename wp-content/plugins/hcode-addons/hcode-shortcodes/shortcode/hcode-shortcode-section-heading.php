<?php
/**
 * Shortcode For Section Heading
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Section Heading */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_section_heading' ) ) {
	function hcode_section_heading( $atts, $content = null ) {

		extract( shortcode_atts( array(
	            'hcode_heading_type' => '',
	            'hcode_et_line_icon_list' => '',
	        	'hcode_heading' => '',
	        	'hcode_heading_number' => '',
	        	'hcode_seperator' => '',
	        	'hcode_double_line' => '',
	        	'hcode_text_color' => '',
	        	'hcode_heading_tag' => '',
	        	'hcode_heading_text_color' => '',
	        	'hcode_heading_number_text_color' => '',
	        	'margin_setting' => '',
		        'desktop_margin' => '',
		        'custom_desktop_margin' => '',
		        'ipad_margin' => '',
		        'mobile_margin' => '',
		        'padding_setting' => '',
	        	'desktop_padding' => '',
	        	'ipad_padding' => '',
	        	'mobile_padding' => '',
	        	'custom_desktop_padding' => '',
	        	'font_size' => '',
	        	'line_height' => '',
	        	'font_weight' => '',
	            'hcode_heading_icon_color' => '',
	            'hcode_heading_sep_color' => '',
		        'id' => '',
		        'class' => '',
		        'icon_size' => '',
		        'hcode_heading_text_bg_color' => '',
	            'subtitle' => '',
	        ), $atts ) );
		$class_inner = $class_style = $output = $style = $margin_style = $margin = $style_attr = $padding = $padding_style = $heading_class = '';

		switch ($hcode_text_color) {
			case 'black-text':
					$class_inner .= ' black-text';
				break;

			case 'white-text':
					$class_inner .= ' white-text';
				break;

			case 'custom':
	                $class_inner .= '';
					$class_style .= 'color:'.$hcode_heading_text_color.';';
				break;
			
			default:
				break;
		}

		$id = ( $id ) ? ' id="'.$id.'"' : '';
		$class = ( $class ) ? ' '.$class : '';
		$hcode_heading_sep_color = ($hcode_heading_sep_color) ? ' style = "background-color: '.$hcode_heading_sep_color.';"' : ' style = "background-color: #e6af2a;"';
		$hcode_heading_tag = ( $hcode_heading_tag ) ? $hcode_heading_tag : 'h1';
		$hcode_et_line_icon_list = ( $hcode_et_line_icon_list ) ? $hcode_et_line_icon_list : '';
		$hcode_seperator = ( $hcode_seperator ) ? $hcode_seperator = '<div class="separator-line margin-five" '.$hcode_heading_sep_color.'></div>' : '';
		$hcode_double_line = ( $hcode_double_line ) ? $hcode_double_line = 'dividers-header double-line' : '';
		$font_weight = ($font_weight) ? 'font-weight:'.$font_weight.' !important;;' : '';
		$font_size = ($font_size) ? 'font-size:'.$font_size.' !important;' : '';
		$line_height = ($line_height) ? 'line-height:'.$line_height.' !important;' : '';
		$icon_size = ($icon_size) ? ' '.$icon_size : ' medium-icon';
	    $hcode_heading_icon_color = ( $hcode_heading_icon_color ) ? ' style = "color: '.$hcode_heading_icon_color.';"' : '';
	    $hcode_heading_number = ( $hcode_heading_number ) ? $hcode_heading_number : '';
	    $hcode_heading_number_text_color = ( $hcode_heading_number_text_color ) ? ' style = "color: '.$hcode_heading_number_text_color.';"' : '';
	    $hcode_heading_text_bg_color = ( $hcode_heading_text_bg_color ) ? ' style = "background-color: '.$hcode_heading_text_bg_color.';"' : 'style = "background-color: #fff;"';
	        
	    /* Replace || to br in title */
	    $hcode_heading = ( $hcode_heading ) ? str_replace('||', '<br />',$hcode_heading) : '';

		// Column Margin settings
		$margin_setting = ( $margin_setting ) ? $margin_setting : '';
		$desktop_margin = ( $desktop_margin ) ? ' '.$desktop_margin : '';
		$ipad_margin = ( $ipad_margin ) ? ' '.$ipad_margin : '';
		$mobile_margin = ( $mobile_margin ) ? ' '.$mobile_margin : '';
		$custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
		if($desktop_margin == ' custom-desktop-margin' && $custom_desktop_margin){
			$margin_style .= " margin: ".$custom_desktop_margin.";";
		}else{
	            if( $desktop_margin ){
			$margin .= $desktop_margin;
	            }else{
	                $margin .= '';
	            }
		}
		$margin .= $ipad_margin.$mobile_margin;
		if($margin_style){
			$style_attr .= $margin_style;
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
	            if ( $desktop_padding ){
			$padding .= $desktop_padding;
	            }else{
	                $padding .= '';
	            }
		}
		if($padding_style){
			$style_attr .= $padding_style;
		}

		$padding .= $ipad_padding.$mobile_padding;
		if($style_attr || $class_style || $font_size || $font_weight ){
	                $style .= 'style="'.$style_attr.$class_style.$font_size.$font_weight.$line_height.'"';
		}
		if($hcode_double_line || $class):
			$heading_class .= 'class="'.$hcode_double_line.$class.'"';
		endif;
		
		switch ($hcode_heading_type) {
			case 'heading-style1':
				$output .='<'.$hcode_heading_tag.$id.' class="section-title '.$margin.$class.$class_inner.$padding.'" '.$style.'>';
					$output .= $hcode_heading;
	            $output .='</'.$hcode_heading_tag.'>';
	            $output .= $hcode_seperator;
			break;

			case 'heading-style2':
				$output .='<div '.$heading_class.' '.$id.'>';
					$output .='<div class="subheader" '.$hcode_heading_text_bg_color.'>';
						if($hcode_et_line_icon_list):
		                	$output .='<i class="'.$hcode_et_line_icon_list.$icon_size.'"'.$hcode_heading_icon_color.'></i>';
		            	endif;
		                $output .='<'.$hcode_heading_tag.' class="section-title '.$margin.$padding.'" '.$style.'>';
						 	$output .= $hcode_heading;
						$output .='</'.$hcode_heading_tag.'>';
						if( $subtitle ):
							$output .='<h6>'.$subtitle.'</h6>';
						endif;
	    			$output .='</div>';
	    		$output .='</div>';
			break;

			case 'heading-style3':
				$output .='<div '.$heading_class.' '.$id.'>';
		    		$output .='<div class="subheader subheader-double-line bg-white">';
	                    $output .='<'.$hcode_heading_tag.' class="section-title '.$margin.$padding.'" '.$style.'>'.$hcode_heading.'</'.$hcode_heading_tag.'>';
	                $output .='</div>';
	            $output .='</div>';
			break;
	                
	        case 'heading-style4':
	            $output .='<'.$hcode_heading_tag.$id.' class="text-large letter-spacing-2 text-uppercase agency-title '.$margin.$class.$class_inner.$padding.'" '.$style.'>';
	                $output .= $hcode_heading;
	            $output .= '</'.$hcode_heading_tag.'>';
			break;

	        case 'heading-style5':
	           $output .='<div '.$id.' class="heading-style-five '.$margin.$padding.$class.'">';
	           $output .='<'.$hcode_heading_tag.' '.$style.'>';
	           		if($hcode_et_line_icon_list):
	           			$output .='<i class="'.$hcode_et_line_icon_list.$icon_size.' vertical-align-middle"'.$hcode_heading_icon_color.'></i> ';
	           		endif;
	           		$output .= $hcode_heading;
	           $output .='</'.$hcode_heading_tag.'>';
	           $output .='</div>';
	        break;

	        case 'heading-style6':
	    		if( $hcode_heading_number ):
	        		$output .= '<span class="title-number"'.$hcode_heading_number_text_color.'>'.$hcode_heading_number.'</span>';
	        	endif;
				$output .='<'.$hcode_heading_tag.$id.' class="section-title '.$margin.$class.$class_inner.$padding.'" '.$style.'>';
					$output .= $hcode_heading;
	            $output .='</'.$hcode_heading_tag.'>';
	            $output .= $hcode_seperator;
			break;

			default:
				break;
		}
	    return $output;
	}
}
add_shortcode("hcode_section_heading","hcode_section_heading");
?>