<?php
/**
 * Shortcode For Icon List
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Icon List */
/*-----------------------------------------------------------------------------------*/
add_shortcode('hcode_font_class_list','hcode_font_class_list_shortcode');
if ( ! function_exists( 'hcode_font_class_list_shortcode' ) ) {
	function hcode_font_class_list_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
	        	'id' => '',
	        	'class' => '',
	        	'hcode_font_icon_class_type' => '',
	    ), $atts ) );
		$output = '';

		$id = ( $id ) ? ' id="'.$id.'"' : '';
		$class = ( $class ) ? ' '.$class : '';

		switch ($hcode_font_icon_class_type) {
			case 'hcode_font_awesome_icons':
				$output .= '<div'.$id.' class="fa-examples'.$class.'">';
					$hcode_fa_icon = hcode_fa_icon();
					foreach ($hcode_fa_icon as $key => $icon) {
						$output .= '<div class="col-md-4 col-sm-6 col-lg-3">';
				        	$output .= '<i class="fa '.$icon.'"></i>';
				            $output .= $icon;
				        $output .= '</div>';	
					}
			    $output .= '</div>';
			break;
			case 'hcode_et_line_icons':
				$hcode_icons = hcode_icons();
				foreach ($hcode_icons as $key => $icon) {
					$output .= '<span class="box1">';
		                $output .= '<span class="'.$icon.'" aria-hidden="true"></span>';
		                $output .= '&nbsp;'.$icon;
	                $output .= '</span>';
	            }
			break;
		}
	    return $output;
	}
}
?>
