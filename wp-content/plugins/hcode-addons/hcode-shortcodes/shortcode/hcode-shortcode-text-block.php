<?php
/**
 * Shortcode For Text Block
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Text Block */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'vc_column_text' ) ) {
    function vc_column_text( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
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
        
        $output = $padding = $margin = $padding_style = $margin_style = $style_attr = $style = '';
        $id = ($id) ? 'id='.$id : '';
        $class = ($class) ? ' '.$class : ''; 

        // Column Padding settings
        $padding_setting = ( $padding_setting ) ? $padding_setting : '';
        $desktop_padding = ( $desktop_padding ) ? $desktop_padding : '';
        $ipad_padding = ( $ipad_padding ) ? ' '.$ipad_padding : '';
        $mobile_padding = ( $mobile_padding ) ? ' '.$mobile_padding : '';
        $custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
        if($desktop_padding == 'custom-desktop-padding' && $custom_desktop_padding){
                $padding_style .= " padding: ".$custom_desktop_padding.";";
        }else{
                $padding .= $desktop_padding;
        }
        $padding .= $ipad_padding.$mobile_padding;

        // Column Margin settings
        $margin_setting = ( $margin_setting ) ? $margin_setting : '';
        $desktop_margin = ( $desktop_margin ) ? $desktop_margin : '';
        $ipad_margin = ( $ipad_margin ) ? ' '.$ipad_margin : '';
        $mobile_margin = ( $mobile_margin ) ? ' '.$mobile_margin : '';
        $custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
        if($desktop_margin == 'custom-desktop-margin' && $custom_desktop_margin){
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
        if( $id || $class || $padding || $margin || $style){    
            $output .='<div '.$id.' class="'.$class.' '.$padding.' '.$margin.'" '.$style.'>';  
        }
        $output.= do_shortcode( hcode_remove_wpautop($content) );
            
        if( $id || $class || $padding || $margin || $style){
            $output .='</div>';
        }
        return $output;
    }
}
add_shortcode( 'vc_column_text', 'vc_column_text' );
?>