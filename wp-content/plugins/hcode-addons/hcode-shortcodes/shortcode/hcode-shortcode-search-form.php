<?php
/**
 * Shortcode For Search Form
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Search Form */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_search_form_shortcode' ) ) {
    function hcode_search_form_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'hcode_search_form_style' => '',
            'hcode_search_form_placeholder_text' => '',
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
        $hcode_search_form_style = ( $hcode_search_form_style ) ? $hcode_search_form_style : '';
        $hcode_search_form_placeholder_text = ( $hcode_search_form_placeholder_text ) ? $hcode_search_form_placeholder_text : '';

        // Column Padding settings
        $padding_setting = ( $padding_setting ) ? $padding_setting : '';
        $desktop_padding = ( $desktop_padding ) ? ' '.$desktop_padding : '';
        $ipad_padding = ( $ipad_padding ) ? ' '.$ipad_padding : '';
        $mobile_padding = ( $mobile_padding ) ? ' '.$mobile_padding : '';
        $custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
        if($desktop_padding == ' custom-desktop-padding' && $custom_desktop_padding){
                $padding_style .= " padding: ".$custom_desktop_padding.";";
        }else{
                if( $desktop_padding ){
                    $padding .= $desktop_padding; 
                }else{ 
                    $padding .= '' ;
                }
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
                if( $desktop_margin ){
                $margin .= $desktop_margin;
                }else{ 
                    $margin .= '' ;
                }
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
        
        switch ($hcode_search_form_style){
            case 'faq-search-form':
                $output .= '<div '.$id.' class="faq-search position-relative'.$class.$padding.$margin.'"'.$style.'>';
                    $output .= '<form id="faq-search" method="get" action="'.esc_url( home_url( '/' ) ).'" name="faq-search" class="faq-search-form">';
                        $output .= '<input type="text" placeholder="'.$hcode_search_form_placeholder_text.'" class="input-round big-input no-margin" name="s" value="' . get_search_query() . '" />';
                        $output .= '<button type="submit" class="fa fa-search faq-search-button"></button>';
                    $output .= '</form>';
                $output .= '</div>';
                break;
            
            case 'header-search-form':
                    if($id || $class || $padding || $margin):
                        $output .= '<div '.$id.' class="'.$class.$padding.$margin.'" '.$style.'>';
                    endif;
                        $output .= '<form id="search-header" method="get" action="'.esc_url( home_url( '/' ) ).'" name="search-header" class="mfp-hide search-form-result">';
                            $output .= '<div class="search-form position-relative">';
                                $output .= '<button type="submit" class="fa fa-search close-search search-button black-text"></button>';
                                $output .= '<input type="text" name="s" class="search-input" value="' . get_search_query() . '" placeholder="'.$hcode_search_form_placeholder_text.'" autocomplete="off">';
                            $output .= '</div>';
                        $output .= '</form>';
                    if($id || $class):
                        $output .= '</div>';
                    endif;
                break;    
        }       
        return $output;
    }
}
add_shortcode( 'hcode_search_form', 'hcode_search_form_shortcode' );
?>