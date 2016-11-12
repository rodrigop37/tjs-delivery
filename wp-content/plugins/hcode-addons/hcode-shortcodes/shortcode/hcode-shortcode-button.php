<?php
/**
 * Shortcode For Button
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Button */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_button_shortcode' ) ) {
    function hcode_button_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'button_style' =>'',
            'button_type' => '',
            'button_version_type' => '',
            'button_icon' => '',
            'button_text' => '',
            'button_sub_text' => '',
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
            'extra_large' => '',
            'hcode_column_animation_style' => '',
            'class' => '',
            'id' => '',
                ), $atts ) );
        $output = $alignment = $padding = $padding_style = $margin = $margin_style = $style_attr = $style = '';
        $main_class = ($class) ? $class.' ' : '';
        $id = ($id) ? 'id="'.$id.'"' : '';
        $first_button_parse_args = vc_parse_multi_attribute($button_text);
        $first_button_link     = ( isset($first_button_parse_args['url']) ) ? $first_button_parse_args['url'] : '#';
        $first_button_title    = ( isset($first_button_parse_args['title']) ) ? $first_button_parse_args['title'] : 'sample button';
        $first_button_target   = ( isset($first_button_parse_args['target']) ) ? trim($first_button_parse_args['target']) : '_self';
        $extra_large = ($extra_large == 1) ? ' btn-extra-large' : '';
        $hcode_column_animation_style = ( $hcode_column_animation_style ) ? ' wow '.$hcode_column_animation_style : '';
        $class= $icon='';
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

    	// padding and margin style combin
    	if($padding_style){
    		$style_attr .= $padding_style;
    	}
    	if($margin_style){
    		$style_attr .= $margin_style;
    	}

    	if($style_attr){
    		$style .= ' style="'.$style_attr.'"';
    	}
        // For Button Style
        switch ($button_style) {
            case 'style1':
            	$icon = $first_button_title;
                $class .= "highlight-button";
            break;
            case 'style2':
            	$icon = $first_button_title;
                $class .= "highlight-button-dark";
            break;
            case 'style3':
            	$icon = $first_button_title;
                $class .= "btn-small-white-background";
            break;
            case 'style4':
            	$icon = $first_button_title;
                $class .= "highlight-button btn-round";
            break;
            case 'style5':
            	$icon = $first_button_title;
                $class .= "highlight-button-dark btn-round";
            break;
            case 'style6':
            	$icon = $first_button_title;
                $class .= "btn-small-white-background btn-round";
            break;
            case 'style7':
            	$icon = $first_button_title;
                $class .= "highlight-button-black-border";
            break;
            case 'style8':
            	$icon = $first_button_title;
                $class .= "btn-small-white";
            break;
            case 'style9':
            	$icon = $first_button_title;
                $class .= "btn-small-white-dark";
            break;
            case 'style10':
            	$icon = $first_button_title;
                $class .= "btn-small-white btn-round";
            break;
            case 'style11':
            	$icon = $first_button_title;
                $class .= "btn-small-white-dark btn-round";
            break;
            case 'style12':
            	$icon = $first_button_title;
                $class .= "btn-small-black-border-light";
            break;
            case 'style13':
            	$icon = $first_button_title;
                $class .= "btn-small-black-border-light btn-round";
            break;
            case 'style14':
            	$icon = $first_button_title;
                $class .= "btn-very-small-white";
            break;
            case 'style15':
            	$icon = $first_button_title;
                $class .= "btn-very-small-white btn-round";
            break;
            case 'style16':
            	$icon = '<i class="'.$button_icon.'"></i>'.$first_button_title;
                $class .= "highlight-button";
            break;
            case 'style17':
            	$icon = '<i class="'.$button_icon.'"></i>'.$first_button_title;
                $class .= "highlight-button-dark";
            break;
            case 'style18':
            	$icon = '<i class="'.$button_icon.'"></i>'.$first_button_title;
                $class .= "btn-small-white-background";
            break;
            case 'style19':
            	$icon = '<i class="'.$button_icon.'"></i>
                    <span>'.$first_button_title.'</span>';
                $class .= "button-reveal";
            break;
            case 'style20':
            	$icon = '<i class="'.$button_icon.'"></i>
                    <span>'.$first_button_title.'</span>';
                $class .= "button-reveal button-reveal-black";
            break;
            case 'style21':
            	$icon = $first_button_title;            
            break;
            case 'style22':
            	$icon = '<i class="'.$button_icon.' btn-round"></i>';
                $class .= "social-icon";
            break;
            case 'style23':
            	$icon = '<i class="'.$button_icon.'"></i>';
                $class .= "social-icon social-icon-large button";
            break;
            case 'style24':
            	$icon = $first_button_title.'<span>'.$button_sub_text.'</span>';
                $class .= "button-3d btn-large button-desc";
            break;
            case 'style25':
            	$icon = $first_button_title;
                $class .= "button-3d btn-round";
            break;
        }
        // For Button Type
        switch ($button_type) {
            case 'large':
                $class .= " btn-large";
            break;
            case 'medium':
                $class .= " btn-medium ";
            break;
            case 'small':
                $class .= " btn-small ";
            break;
            case 'vsmall':
                $class .= " btn-very-small ";
            break;
        }
        // For Button Version
        switch ($button_version_type) {
            case 'primary':
                $class .= " btn-primary btn-round ";
            break;
            case 'success':
                if($button_style=='style24'){
                    $class .= " btn-success btn-round ";
                }else{
                    $class .= " btn-success btn-round ";
                }
            break;
            case 'info':
                $class .= " btn-info btn-round ";
            break;
            case 'warning':
                $class .= " btn-warning btn-round ";
            break;
            case 'danger':
                $class .= " btn-danger btn-round ";
            break;
        }

        $output .= '<a '.$id.' href="'.$first_button_link.'" target="'.$first_button_target.'" class="inner-link '.$main_class.$class.$padding.$margin.$extra_large.$hcode_column_animation_style.' button btn" '.$style.'>'.$icon.'</a>';
        
        return $output;
    }
}
add_shortcode( 'hcode_button', 'hcode_button_shortcode' );
?>