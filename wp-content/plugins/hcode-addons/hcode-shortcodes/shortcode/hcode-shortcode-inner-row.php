<?php
/**
 * Shortcode For Row
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Row */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_row_inner' ) ) {
	function hcode_row_inner( $atts, $content = null ){
		extract( shortcode_atts( array(
			'equal_height' => '',
			'content_placement' => '',
	        'hcode_row_style' => '',
	        'hcode_row_bg_color' =>'',
	        'hcode_row_bg_image' => '',
	        'show_container_fluid' => '',
	        'column_without_row' => '',
	        'show_full_width' => '',
	        'hcode_row_image_type' => '',
	        'hcode_bg_image_type' => '',
	        'hcode_parallax_image_type' => '',
	        'fullscreen' => '',
	        'show_overlay' => '',
	        'hcode_overlay_opacity' => '',
	        'hcode_row_overlay_color' => '',
	        'hcode_z_index' => '',
	        'show_navigation' => '',
	        'hcode_row_border_position' => '',
	        'hcode_row_border_color' => '',
	        'hcode_border_size' => '',
	        'hcode_border_type' => '',
	        'hcode_row_padding' => '',
	        'hcode_padding_top' => '',
	        'hcode_padding_bottom' => '',
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
	        'hcode_row_animation_style' => '',
	        'hcode_row_mobile_padding' => '',
	        'hcode_row_ipad_padding' => '',
	        'id' => '',
	        'class' => '',
	        'position_relative' => '',
	        'overflow_hidden' => '',
	        'hcode_relative_projects' => '',
	        'scroll_to_down' => '',
	        'hide_background' => '',
	        'scroll_to_down_color' => '',
	        'scroll_to_down_id' => '',
	        'hcode_min_height' => '',
	    ), $atts ) );
		$output = $padding = $padding_style = $margin = $margin_style = $style_attr = $extra_class_inner_row = '';

		$id = ($id) ? ' id="'.$id.'"' : '';
		( $class ) ? $class : '';

		$extra_class_inner_row = ' hcode-inner-row';
		$equal_height = '';
		$content_placement = '';
		$column_without_row = ( $column_without_row ) ? $column_without_row : '';
		$position_relative = ($position_relative == 1) ? ' position-relative' : '';
		$overflow_hidden = ($overflow_hidden == 1) ? ' overflow-hidden' : '';
		$fullscreen = ($fullscreen) ? " full-screen" : '';
		$hcode_relative_projects = ($hcode_relative_projects) ? ' related-projects' : '';
		$show_container_fluid_att = ($show_container_fluid == 1) ? 'container-fluid' : 'container';
		$hide_background = ($hide_background == 1) ? ' xs-no-background' : '';
		$hcode_row_mobile_padding = ( $hcode_row_mobile_padding ) ? $hcode_row_mobile_padding : '';
		$hcode_row_ipad_padding = ($hcode_row_ipad_padding) ? $hcode_row_ipad_padding : '';
		$hcode_min_height = ( $hcode_min_height ) ? ' min-height:'.$hcode_min_height : '';

		// For Border
		$hcode_row_border_pos = ($hcode_row_border_position) ? $hcode_row_border_position.': ' : '';
		if($hcode_row_border_pos){
			$hcode_row_border_pos .= ($hcode_border_size) ? $hcode_border_size : '';
			$hcode_row_border_pos .= ($hcode_border_type) ? ' '.$hcode_border_type : '';
			$hcode_row_border_pos .= ($hcode_row_border_color) ? ' '.$hcode_row_border_color : '';
			$hcode_row_border_pos .= ';';
		}

		// For padding

		$hcode_row_padding_att = ($hcode_row_padding) ? $hcode_row_padding : '';
		$hcode_row_padding_val = $hcode_row_padding_class = '';
		if($hcode_row_padding_att == 'custom-padding'){
			$hcode_row_padding_val .= ($hcode_padding_top) ? ' padding-top:'.$hcode_padding_top.';' : '';
			$hcode_row_padding_val .= ($hcode_padding_bottom) ? ' padding-bottom:'.$hcode_padding_bottom.';' : '';
		}elseif($hcode_row_padding_att){
			$hcode_row_padding_class .= ' '.$hcode_row_padding_att;
		}else{
			$hcode_row_padding_class .= '';
		}

	    // Column Padding Settings
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

		// Column Margin Settings
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

		/* For Animation*/
		$hcode_row_animation_style_att = ($hcode_row_animation_style) ? ' wow '.$hcode_row_animation_style.'' : '';
	        
	    /* For scroll_to_down */
	    $scroll_to_down_onclick = $scroll_to_down_class = '';
	    if( $scroll_to_down == 1 ){
	        $scroll_to_down = ' '.$scroll_to_down_color;
	        $scroll_to_down_class = ' scrollToDownSection';
	        $scroll_to_down_onclick = ' data-section-id="'.$scroll_to_down_id.'"';
	    }
	        
		$hcode_row_section_style = $hcode_row_section_class  = $hcode_row_section_class_att = $hcode_row_section_id = '';

		$style = $hcode_row_border_pos.$hcode_row_padding_val;

		if(empty($hcode_row_style)){
			if(!empty($style) || !empty($style_attr) || !empty($hcode_min_height)){
				$hcode_row_section_style .= ' style="'.$style.$style_attr.$hcode_min_height.'"';
			}
			$hcode_row_section_class = $class.$hcode_row_ipad_padding.$hcode_row_mobile_padding.$hcode_row_padding_class.$hcode_row_animation_style_att.$margin;
			if(!empty($hcode_row_section_class) || !empty($position_relative) || !empty($overflow_hidden) || !empty($hcode_relative_projects) || !empty($padding) || !empty($fullscreen) || !empty($equal_height) || !empty($content_placement) || !empty($extra_class_inner_row) ){
				$hcode_row_section_class_att  .= 'class="'.$hcode_row_section_class.$equal_height.$content_placement.$fullscreen.$position_relative.$overflow_hidden.$hcode_relative_projects.$scroll_to_down.$scroll_to_down_class.$padding.$extra_class_inner_row.'"';
			}
			$output .= '<div'.$id.' '.$hcode_row_section_class_att.' '.$hcode_row_section_style.$scroll_to_down_onclick.'>';
				$output .=  do_shortcode($content);
		    $output .= '</div>';
		}else{
			switch ($hcode_row_style) {
				case 'color':
					$hcode_row_bg = ($hcode_row_bg_color) ? 'background-color:'.$hcode_row_bg_color.';' : '';
					$hcode_row_section_style .= ' style="'.$style.$style_attr.' '.$hcode_row_bg.' '.$hcode_min_height.'"';
					$output .= '<div'.$id.' class="'.$class.$equal_height.$content_placement.$fullscreen.$hcode_row_padding_class.$hcode_row_mobile_padding.$hcode_row_animation_style_att.$position_relative.$overflow_hidden.$scroll_to_down.$scroll_to_down_class.$margin.$padding.$extra_class_inner_row.'" '.$hcode_row_section_style.$scroll_to_down_onclick.'>';
						
						$output .=  do_shortcode($content);

	                $output .= '</div>';
	            break;
				case 'image':
					$image_url = wp_get_attachment_url( $hcode_row_bg_image );
					$image_url_att = ($image_url) ? 'background-image: url('.$image_url.');' : '';

					$hcode_row_image_type_att = ($hcode_row_image_type=='parallax') ? ' parallax-fix' : '';
					$hcode_bg_image_type_att = ($hcode_bg_image_type) ? ' '.$hcode_bg_image_type : '';
					$hcode_parallax_image_type_att = ($hcode_parallax_image_type) ? ' '.$hcode_parallax_image_type : '';

					$hcode_overlay_opacity_att = ($hcode_overlay_opacity) ? ' opacity:'.$hcode_overlay_opacity.';' : '';
					$hcode_row_overlay_color_att = ($hcode_row_overlay_color) ? ' background-color:'.$hcode_row_overlay_color.';' : '';
					$hcode_z_index = ($hcode_z_index) ? ' z-index:'.$hcode_z_index.';' : '';


					$hcode_row_section_style .= ' style="'.$style.' '.$image_url_att.' '.$hcode_min_height.$style_attr.'"';

					$output .= '<div '.$id.' class="'.$class.$equal_height.$content_placement.$hcode_row_padding_class.$hcode_row_mobile_padding.$hcode_row_image_type_att.$hcode_parallax_image_type_att.$hcode_bg_image_type_att.$hcode_row_animation_style_att.$fullscreen.$position_relative.$overflow_hidden.$scroll_to_down.$hide_background.$scroll_to_down_class.$margin.$padding.$extra_class_inner_row.'" '.$hcode_row_section_style.$scroll_to_down_onclick.'>';

						if($show_overlay=='1'){
							$output .= '<div class="selection-overlay" style="'.$hcode_overlay_opacity_att.$hcode_row_overlay_color_att.$hcode_z_index.'"></div>';
						}
	             
						$output .=  do_shortcode($content);
		                
	                $output .= '</div>';
			    break;
			}
		}
		return $output;
	}
}
add_shortcode( 'vc_row_inner', 'hcode_row_inner' );
?>