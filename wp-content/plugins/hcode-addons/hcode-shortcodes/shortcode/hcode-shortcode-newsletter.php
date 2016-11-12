<?php
/**
 * Shortcode For Newsletter
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Newsletter */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_newsletter_shortcode' ) ) {
    function hcode_newsletter_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'hcode_newsletter_premade_style' => '',
            'hcode_newsletter_icon' => '',
            'hcode_newsletter_title' => '',
            'hcode_newsletter_subtitle' => '',
            'hcode_newsletter_placeholder' => '',
            'hcode_newsletter_button_text' => '',
            'hcode_coming_soon_custom_newsletter' => '',
            'hcode_custom_newsletter' => '',
            'hcode_newsletter_icon_size' => '',
            'hcode_newsletter_icon_color' => '',
            'hcode_newsletter_title_color' => '',
            'hcode_newsletter_subtitle_color' => '',
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
        $id = ($id) ? ' id='.$id : '';
        $class = ($class) ? ' '.$class : ''; 
        $hcode_newsletter_icon = ( $hcode_newsletter_icon ) ? $hcode_newsletter_icon : 'medium-icon';
        $hcode_newsletter_title = ( $hcode_newsletter_title ) ? $hcode_newsletter_title : '';
        $hcode_newsletter_subtitle = ( $hcode_newsletter_subtitle ) ? $hcode_newsletter_subtitle : '';
        $hcode_newsletter_placeholder = ( $hcode_newsletter_placeholder ) ? $hcode_newsletter_placeholder : __('ENTER YOUR EMAIL','hcode-addons');
        $hcode_newsletter_button_text = ( $hcode_newsletter_button_text ) ? $hcode_newsletter_button_text : __('Subscribe Now!','hcode-addons');

        /* add Custom newsletter shortcode from v1.6 */
        $hcode_custom_newsletter = ( $hcode_custom_newsletter ) ? str_replace('`{`', '[',$hcode_custom_newsletter) : '';
        $hcode_custom_newsletter = ( $hcode_custom_newsletter ) ? str_replace('`}`', ']',$hcode_custom_newsletter) : '';
        $hcode_custom_newsletter = ( $hcode_custom_newsletter ) ? str_replace('``', '"',$hcode_custom_newsletter) : '';

        
        $hcode_newsletter_icon_size = ( $hcode_newsletter_icon_size ) ? ' '.$hcode_newsletter_icon_size : '';
        $hcode_newsletter_icon_color = ( $hcode_newsletter_icon_color ) ? ' style="color:'.$hcode_newsletter_icon_color.'"' : '';
        $hcode_newsletter_title_color = ( $hcode_newsletter_title_color ) ? ' style="color:'.$hcode_newsletter_title_color.'"' : '';
        $hcode_newsletter_subtitle_color = ( $hcode_newsletter_subtitle_color ) ? ' style="color:'.$hcode_newsletter_subtitle_color.'"' : '';
        
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
        
        if($style_attr){
            $style .= ' style="'.$style_attr.'"';
        }
           
        switch ( $hcode_newsletter_premade_style ){
            case 'hcode-newsletter-block1':
                $output .= '<div class="shop-newsletter-main'.$class.$padding.$margin.'"'.$style.$id.'>';
                    $output .= '<div class="shop-newsletter">';
                        if($hcode_newsletter_icon):
                            $output .= '<i class="'.$hcode_newsletter_icon.$hcode_newsletter_icon_size.' margin-five no-margin-top"'.$hcode_newsletter_icon_color.'></i>';
                        endif;
                        if($hcode_newsletter_title):
                            $output .= '<p class="text-med text-uppercase letter-spacing-2 no-margin lg-display-block lg-margin-bottom-three"'.$hcode_newsletter_title_color.'>'.$hcode_newsletter_title.'</p>';
                        endif;
                        if($hcode_newsletter_subtitle):
                            $output .= '<p class="title-large font-weight-700 text-uppercase letter-spacing-2 lg-display-none"'.$hcode_newsletter_subtitle_color.'>'.$hcode_newsletter_subtitle.'</p>';
                        endif;
                        if( $hcode_coming_soon_custom_newsletter == 1 ):
                            $output .= do_shortcode($hcode_custom_newsletter);
                        else:
                            $output .= '<form method="POST" name="subscription" action="'.home_url().'/index.php?wp_nlm=subscription">';
                                $output .= '<input class="no-margin xyz_em_email text-field" placeholder="'.$hcode_newsletter_placeholder.'" name="xyz_em_email" type="text" />';
                                $output .= '<input name="submit" id="submit_newsletter" class="btn submit-small-button margin-five no-margin-right no-margin-bottom submit_newsletter" type="submit" value="'.$hcode_newsletter_button_text.'" />';
                            $output .= '</form>';                   
                        endif;
                    $output .= '</div>';
                $output .= '</div>';
            break;
            case 'hcode-newsletter-block2':
                if( $hcode_coming_soon_custom_newsletter == 1 ):
                    $output .= do_shortcode($hcode_custom_newsletter);
                else:
                    $output .= '<form '.$id.' class="'.$class.$padding.$margin.'" '.$style.' method="POST" name="subscription" action="'.home_url().'/index.php?wp_nlm=subscription">
                        <div class="col-lg-8 col-md-7 col-sm-8 no-padding-left xs-no-padding xs-margin-bottom-four"><input type="text" id="email" name="xyz_em_email" class="big-input landing-subscribe-input no-margin-bottom xyz_em_email" placeholder="'.$hcode_newsletter_placeholder.'"></div>
                        <div class="col-lg-4 col-md-5 col-sm-4 no-padding"><input type="submit" class="landing-subscribe-button no-margin-bottom submit_newsletter" value="'.$hcode_newsletter_button_text.'" id="notifyme-button" name="notifyme-button"></div>
                    </form>';
                endif;
            break;
        }
        return $output;
    }
}
add_shortcode( 'hcode_newsletter', 'hcode_newsletter_shortcode' );
?>