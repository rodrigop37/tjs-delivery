<?php
/**
 * Shortcode For Icon
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Icons */
/*-----------------------------------------------------------------------------------*/
add_shortcode('hcode_font_icons','hcode_font_icons_shortcode');
if ( ! function_exists( 'hcode_font_icons_shortcode' ) ) {
    function hcode_font_icons_shortcode( $atts, $content = null ) {
    	extract( shortcode_atts( array(
            	'id' => '',
            	'class' => '',
            	'hcode_font_icon_type' => '',
                'hcode_et_icon_premade_style' => '',
                'hcode_font_icon_premade_style' => '',
            	'hcode_font_awesome_icon_list' => '',
            	'hcode_et_line_icon_list' => '',
            	'hcode_font_icon_size' => '',
            	'show_border' => '',
            	'show_border_rounded' => '',
            	'hcode_icon_box_size' => '',
            	'hcode_icon_box_decoration' => '',
            	'hcode_icon_box_background_color' => '',
            	// et icons
            	'hcode_et_icon_box_size' => '',
            	'et_show_border' => '',
            	'show_et_border_rounded' => '',
            	'et_plain' => '',
            	'circled' => '',
            	'hcode_et_icon_box_decoration' => '',
            	'hcode_et_icon_box_background_color' => '',
            ), $atts ) );
    	$output = $icon_common_class = '';

    	$id = ( $id ) ? ' id="'.$id.'"' : '';
    	$class = ( $class ) ? ' '.$class : '';
    	$hcode_font_icon_type = ( $hcode_font_icon_type ) ? $hcode_font_icon_type : '';
    	$hcode_font_awesome_icon_list = ( $hcode_font_awesome_icon_list ) ? $hcode_font_awesome_icon_list : '';
    	$hcode_font_icon_size = ( $hcode_font_icon_size ) ? ' '.$hcode_font_icon_size : '';
    	$show_border = ( $show_border ) ? ' i-bordered' : '';
    	$show_border_rounded = ( $show_border_rounded ) ? ' i-rounded' : '';
    	$hcode_icon_box_size = ( $hcode_icon_box_size ) ? ' '.$hcode_icon_box_size : '';
    	$hcode_icon_box_decoration = ( $hcode_icon_box_decoration ) ? ' '.$hcode_icon_box_decoration : '';
    	$hcode_icon_box_background = ( $hcode_icon_box_background_color ) ? ' '.$hcode_icon_box_background_color : '';
    	// Et Line icons
    	$hcode_et_line_icon_list = ( $hcode_et_line_icon_list ) ? $hcode_et_line_icon_list : '';
    	$hcode_et_icon_box_size = ( $hcode_et_icon_box_size ) ? ' '.$hcode_et_icon_box_size : '';
    	$et_show_border = ( $et_show_border ) ? ' i-bordered' : '';
    	$show_et_border_rounded = ( $show_et_border_rounded ) ? ' i-rounded' : '';
    	$et_plain = ( $et_plain ) ? ' i-plain' : '';
    	$circled = ( $circled ) ? ' i-circled' : '';
    	$hcode_et_icon_box_decoration = ( $hcode_et_icon_box_decoration ) ? ' '.$hcode_et_icon_box_decoration : '';
    	$hcode_et_icon_box_background_color = ( $hcode_et_icon_box_background_color ) ? ' '.$hcode_et_icon_box_background_color : '';
        // ET-Line
        switch ($hcode_et_icon_premade_style){
            case 'et-line-icons-1':
            case 'et-line-icons-2':
            case 'et-line-icons-3':
            case 'et-line-icons-4':
            case 'et-line-icons-5':
                $icon_common_class = '';
            break;
            case 'et-line-icons-6':
                $icon_common_class = 'i-background-box ';
            break;
            case 'et-line-icons-7':
            case 'et-line-icons-8':
            case 'et-line-icons-9':
            case 'et-line-icons-10':
            case 'et-line-icons-11':
                $icon_common_class = '';
            break;
            case 'et-line-icons-12':
                $icon_common_class = 'i-background-box ';
            break;
        }
        // Font-Awesome
        switch ($hcode_font_icon_premade_style){
            case 'font-awesome-icons-1':
            case 'font-awesome-icons-2':
            case 'font-awesome-icons-3':
            case 'font-awesome-icons-4':
                $icon_common_class = '';
            break;
            case 'font-awesome-icons-5':
                $icon_common_class = 'i-background-box ';
            break;
        }
        // Check For Font Type
    	switch ($hcode_font_icon_type) {
    		case 'hcode_font_awesome_icons':
                $output .= '<i class="'.$icon_common_class.$hcode_font_awesome_icon_list.$hcode_font_icon_size.$show_border.$hcode_icon_box_size.$show_border_rounded.$hcode_icon_box_decoration.$hcode_icon_box_background.'"></i>';
    		break;
    		case 'hcode_et_line_icons':
                $output .= '<i class="'.$icon_common_class.$hcode_et_line_icon_list.$hcode_et_icon_box_size.$et_show_border.$show_et_border_rounded.$et_plain.$circled.$hcode_et_icon_box_decoration.$hcode_et_icon_box_background_color.'"></i>';
    		break;
    	}
        return $output;
    }
}
?>