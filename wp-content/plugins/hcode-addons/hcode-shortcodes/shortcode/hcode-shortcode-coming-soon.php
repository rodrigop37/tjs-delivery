<?php
/**
 * Shortcode For Coming soon
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Coming soon */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_coming_soon_shortcode' ) ) {
    function hcode_coming_soon_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'hcode_coming_soon_type' => '',
            'hcode_coming_soon_logo' => '',
            'hcode_coming_soon_mp4' => '',
            'hcode_coming_soon_ogg' => '',
            'hcode_coming_soon_webm' => '',
            'hcode_coming_soon_title' => '',
            'hcode_coming_soon_title_color' => '',
            'hcode_coming_soon_date' => '',
            'hcode_coming_soon_notify_me_title' => '',
            'hcode_coming_soon_notify_me_title_color' => '',
            'hcode_coming_soon_notify_me_bgcolor' => '',
            'hcode_coming_soon_notify_me_counter_color' => '',
            'hcode_coming_soon_notify_me_subtitle' => '',
            'hcode_coming_soon_notify_me_show_form' => '',
            'hcode_coming_soon_notify_me_button_text' => '',
            'hcode_coming_soon_notify_placeholder' => '',
            'hcode_coming_soon_custom_newsletter' => '',
            'hcode_custom_newsletter' => '',
            'hcode_coming_soon_notify_me_fb' => '',
            'hcode_coming_soon_notify_me_fb_url' => '',
            'hcode_coming_soon_notify_me_tw' => '',
            'hcode_coming_soon_notify_me_tw_url' => '',
            'hcode_coming_soon_notify_me_gp' => '',
            'hcode_coming_soon_notify_me_gp_url' => '',
            'hcode_coming_soon_notify_me_dr' => '',
            'hcode_coming_soon_notify_me_dr_url' => '',
            'hcode_coming_soon_notify_me_yt' => '',
            'hcode_coming_soon_notify_me_yt_url' => '',
            'hcode_coming_soon_notify_me_li' => '',
            'hcode_coming_soon_notify_me_li_url' => '',
            'hcode_coming_soon_notify_me_in' => '',
            'hcode_coming_soon_notify_me_in_url' => '',
            'hcode_coming_soon_notify_me_pi' => '',
            'hcode_coming_soon_notify_me_pi_url' => '',
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
            'hcode_coming_soon_bg' => '',
            'enable_mute' => '',
            'enable_loop' => '',
            'enable_autoplay' => '',
            'enable_controls' => '',
        ), $atts ) );
        
        $output = $padding = $margin = $padding_style = $margin_style = $style_attr = $style = '';
        $id = ($id) ? 'id='.$id : '';
        $class = ($class) ? ' '.$class : ''; 
        $hcode_coming_soon_logo = ( $hcode_coming_soon_logo ) ? $hcode_coming_soon_logo : '';
        $hcode_coming_soon_bg = ( $hcode_coming_soon_bg ) ? $hcode_coming_soon_bg : '';
        $hcode_coming_soon_mp4 = ( $hcode_coming_soon_mp4 ) ? $hcode_coming_soon_mp4 : '';
        $hcode_coming_soon_ogg = ( $hcode_coming_soon_ogg ) ? $hcode_coming_soon_ogg : '';
        $hcode_coming_soon_webm = ( $hcode_coming_soon_webm ) ? $hcode_coming_soon_webm : '';
        $hcode_coming_soon_title = ( $hcode_coming_soon_title ) ? $hcode_coming_soon_title : '';
        $hcode_coming_soon_date = ( $hcode_coming_soon_date ) ? $hcode_coming_soon_date : '';
        $hcode_coming_soon_notify_me_title = ( $hcode_coming_soon_notify_me_title ) ? $hcode_coming_soon_notify_me_title : '';
        $hcode_coming_soon_notify_me_subtitle = ( $hcode_coming_soon_notify_me_subtitle ) ? $hcode_coming_soon_notify_me_subtitle : '';
        $hcode_coming_soon_notify_me_show_form = ( $hcode_coming_soon_notify_me_show_form ) ? $hcode_coming_soon_notify_me_show_form : '';
        $hcode_coming_soon_notify_placeholder = ( $hcode_coming_soon_notify_placeholder ) ? $hcode_coming_soon_notify_placeholder : __('ENTER YOUR EMAIL ADDRESS','hcode-addons');
        $hcode_coming_soon_notify_me_button_text = ( $hcode_coming_soon_notify_me_button_text ) ? $hcode_coming_soon_notify_me_button_text : __('Get Notified','hcode-addons');

        /* add Custom newsletter shortcode from v1.6 */
        $hcode_custom_newsletter = ( $hcode_custom_newsletter ) ? str_replace('`{`', '[',$hcode_custom_newsletter) : '';
        $hcode_custom_newsletter = ( $hcode_custom_newsletter ) ? str_replace('`}`', ']',$hcode_custom_newsletter) : '';
        $hcode_custom_newsletter = ( $hcode_custom_newsletter ) ? str_replace('``', '"',$hcode_custom_newsletter) : '';

        $hcode_coming_soon_notify_me_fb_url = ( $hcode_coming_soon_notify_me_fb_url ) ? $hcode_coming_soon_notify_me_fb_url : '#';
        $hcode_coming_soon_notify_me_tw_url = ( $hcode_coming_soon_notify_me_tw_url ) ? $hcode_coming_soon_notify_me_tw_url : '#';
        $hcode_coming_soon_notify_me_gp_url = ( $hcode_coming_soon_notify_me_gp_url ) ? $hcode_coming_soon_notify_me_gp_url : '#';
        $hcode_coming_soon_notify_me_dr_url = ( $hcode_coming_soon_notify_me_dr_url ) ? $hcode_coming_soon_notify_me_dr_url : '#';
        $hcode_coming_soon_notify_me_yt_url = ( $hcode_coming_soon_notify_me_yt_url ) ? $hcode_coming_soon_notify_me_yt_url : '#';
        $hcode_coming_soon_notify_me_li_url = ( $hcode_coming_soon_notify_me_li_url ) ? $hcode_coming_soon_notify_me_li_url : '#';
        $hcode_coming_soon_notify_me_in_url = ( $hcode_coming_soon_notify_me_in_url ) ? $hcode_coming_soon_notify_me_in_url : '#';
        $hcode_coming_soon_notify_me_pi_url = ( $hcode_coming_soon_notify_me_pi_url ) ? $hcode_coming_soon_notify_me_pi_url : '#';

        $hcode_coming_soon_title_color = ( $hcode_coming_soon_title_color ) ? ' style="color:'.$hcode_coming_soon_title_color.' !important;"' : '';
        $hcode_coming_soon_notify_me_title_color = ( $hcode_coming_soon_notify_me_title_color ) ? ' style="color:'.$hcode_coming_soon_notify_me_title_color.' !important;"' : '';
        $hcode_coming_soon_notify_me_counter_color = ( $hcode_coming_soon_notify_me_counter_color ) ? ' style="color:'.$hcode_coming_soon_notify_me_counter_color.' !important;"' : '';
        $enable_mute = ($enable_mute == 1) ? 'muted ' : '';
        $enable_loop = ( $enable_loop == 1 ) ? 'loop ' : '';
        $enable_autoplay = ( $enable_autoplay == 1 ) ? 'autoplay ' : '';
        $enable_controls = ( $enable_controls == 1 ) ? 'controls ' : '';

        $hcode_coming_soon_notify_me_bgcolor = ( $hcode_coming_soon_notify_me_bgcolor ) ? ' style="background:'.$hcode_coming_soon_notify_me_bgcolor.'"' : '';
        $thumb = wp_get_attachment_image_src($hcode_coming_soon_logo, 'full');
        $thumb_bg = wp_get_attachment_image_src($hcode_coming_soon_bg, 'full');

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
                $margin .= $desktop_margin ;
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

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($hcode_coming_soon_logo);
        $img_title = hcode_option_image_title($hcode_coming_soon_logo);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';

        switch( $hcode_coming_soon_type ){
        
        case 'hcode-coming-soon-type1':
            $output .= '<div class="slider-typography xs-position-inherit'.$class.$padding.$margin.'"'.$style.'>';
                $output .= '<div class="slider-text-middle-main">';
                    $output .= '<div class="slider-text-top slider-text-middle2">';
                        if( $thumb[0] ):
                            $output .= '<!-- logo -->';
                            $output .= '<div class="coming-soon-logo"><img class="logo-style-2" src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'/></div>';
                            $output .= '<!-- end logo -->';
                        endif;
                        if( $hcode_coming_soon_title || $hcode_coming_soon_title_color ):
                            $output .= '<span class="coming-soon-title text-uppercase black-text"'.$hcode_coming_soon_title_color.'>'.$hcode_coming_soon_title.'</span>';
                        endif;
                        if( $content ) :
                            $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                        endif;
                        if( $hcode_coming_soon_date ):
                            $output .= '<!-- time -->';
                            $output .= '<div id="counter-underconstruction"'.$hcode_coming_soon_notify_me_counter_color.'></div>';
                            $output .= '<span class="hide counter-underconstruction-date counter-hidden">'.$hcode_coming_soon_date.'</span>';
                            $output .= '<!-- end time -->';
                        endif;
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
            if( $hcode_coming_soon_notify_me_title || $hcode_coming_soon_notify_me_subtitle || $hcode_coming_soon_notify_me_show_form == 1 || $hcode_coming_soon_notify_me_fb == 1 || $hcode_coming_soon_notify_me_tw == 1 || $hcode_coming_soon_notify_me_gp == 1 || $hcode_coming_soon_notify_me_dr == 1 || $hcode_coming_soon_notify_me_yt == 1 || $hcode_coming_soon_notify_me_li == 1 || $hcode_coming_soon_notify_me_in == 1 || $hcode_coming_soon_notify_me_pi == 1 ):
                $output .= '<div class="notify-me-main"'.$hcode_coming_soon_notify_me_bgcolor.'>';
                    $output .= '<div class="container">';
                        if( $hcode_coming_soon_notify_me_title || $hcode_coming_soon_notify_me_subtitle ):
                            $output .= '<div class="row">';
                                $output .= '<div class="col-md-12 col-sm-12 text-center">';
                                    $output .= '<span class="notify-me-text text-uppercase">';
                                    $output .= '<strong'.$hcode_coming_soon_notify_me_title_color.'>'.$hcode_coming_soon_notify_me_title.'</strong>';
                                    $output .= '<br>'.$hcode_coming_soon_notify_me_subtitle.'</span>';
                                $output .= '</div>';
                            $output .= '</div>';
                        endif;

                        if( $hcode_coming_soon_notify_me_show_form == 1 ):
                            $output .= '<div class="row">';
                                $output .= '<div class="col-md-6 col-sm-12 text-center center-col">';
                                if( $hcode_coming_soon_custom_newsletter == 1 ):
                                    $output .= do_shortcode($hcode_custom_newsletter);
                                else:
                                    $output .= '<form method="POST" name="subscription" action="'.esc_url( home_url() ).'/index.php?wp_nlm=subscription">';
                                        $output .= '<input class="form-control xyz_em_email" placeholder="'.$hcode_coming_soon_notify_placeholder.'" name="xyz_em_email" type="text" />';
                                        $output .= '<button name="submit" id="submit_newsletter" class="btn btn-black btn-small no-margin submit_newsletter" ><span>'.$hcode_coming_soon_notify_me_button_text.'</span></button>';
                                    $output .= '</form>';
                                endif;
                                $output .= '</div>';
                            $output .= '</div>';
                        endif;
                        if( $hcode_coming_soon_notify_me_fb == 1 || $hcode_coming_soon_notify_me_tw == 1 || $hcode_coming_soon_notify_me_gp == 1 || $hcode_coming_soon_notify_me_dr == 1 || $hcode_coming_soon_notify_me_yt == 1 || $hcode_coming_soon_notify_me_li == 1 || $hcode_coming_soon_notify_me_in == 1 || $hcode_coming_soon_notify_me_pi == 1 ):
                            $output .= '<div class="row coming-soon-footer">';
                                $output .= '<!-- social icon -->';
                                $output .= '<div class="col-md-12 text-center margin-five no-margin-bottom footer-social">';
                                    if( $hcode_coming_soon_notify_me_fb == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_fb_url.'" target="_blank" class="black-text-link"><i class="fa fa-facebook"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_tw == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_tw_url.'" target="_blank" class="black-text-link"><i class="fa fa-twitter"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_gp == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_gp_url.'" target="_blank" class="black-text-link"><i class="fa fa-google-plus"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_dr == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_dr_url.'" target="_blank" class="black-text-link"><i class="fa fa-dribbble"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_yt == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_yt_url.'" target="_blank" class="black-text-link"><i class="fa fa-youtube"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_li == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_li_url.'" target="_blank" class="black-text-link"><i class="fa fa-linkedin"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_in == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_in_url.'" target="_blank" class="black-text-link"><i class="fa fa-instagram"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_pi == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_pi_url.'" target="_blank" class="black-text-link"><i class="fa fa-pinterest-p"></i></a>';
                                    endif;
                                $output .= '</div>';
                                $output .= '<!-- end social icon -->';
                            $output .= '</div>';
                        endif;
                    $output .= '</div>';
                $output .= '</div>';
            endif;
        break;
        case 'hcode-coming-soon-type2':
            $output .= '<div class="opacity-light gradient-overlay"></div><div class="video-wrapper">
                            <video '.$enable_mute.$enable_loop.$enable_autoplay.$enable_controls.' class="html-video" poster="'.$thumb_bg[0].'">
                                <source type="video/mp4" src="'.$hcode_coming_soon_mp4.'">
                                <source type="video/ogg" src="'.$hcode_coming_soon_ogg.'">
                                <source type="video/webm" src="'.$hcode_coming_soon_webm.'">
                            </video>
                        </div>';
            $output .= '<div class="slider-typography '.$class.$padding.$margin.'"'.$style.'>';
                $output .= '<div class="slider-text-middle-main">';
                    $output .= '<div class="slider-text-top slider-text-middle2">';
                        if( $thumb[0] ):
                            $output .= '<!-- logo -->';
                            $output .= '<div class="coming-soon-logo"><img class="logo-style-3" src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'/></div>';
                            $output .= '<!-- end logo -->';
                        endif;
                        if( $hcode_coming_soon_title || $hcode_coming_soon_title_color ):
                            $output .= '<span class="coming-soon-title text-uppercase"'.$hcode_coming_soon_title_color.'>'.$hcode_coming_soon_title.'</span>';
                        endif;
                        if( $hcode_coming_soon_date ):
                            $output .= '<!-- time -->';
                            $output .= '<div id="counter-underconstruction" class="counter-underconstruction-video"'.$hcode_coming_soon_notify_me_counter_color.'></div>';
                            $output .= '<span class="hide counter-underconstruction-date counter-hidden">'.$hcode_coming_soon_date.'</span>';
                            $output .= '<!-- end time -->';
                        endif;
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
            if( $hcode_coming_soon_notify_me_title || $hcode_coming_soon_notify_me_subtitle || $hcode_coming_soon_notify_me_show_form == 1 || $hcode_coming_soon_notify_me_fb == 1 || $hcode_coming_soon_notify_me_tw == 1 || $hcode_coming_soon_notify_me_gp == 1 || $hcode_coming_soon_notify_me_dr == 1 || $hcode_coming_soon_notify_me_yt == 1 || $hcode_coming_soon_notify_me_li == 1 || $hcode_coming_soon_notify_me_in == 1 || $hcode_coming_soon_notify_me_pi == 1 ):
                $output .= '<div class="notify-me-main"'.$hcode_coming_soon_notify_me_bgcolor.'>';
                    $output .= '<div class="container">';
                        if( $hcode_coming_soon_notify_me_title || $hcode_coming_soon_notify_me_subtitle ):
                            $output .= '<div class="row">';
                                $output .= '<div class="col-md-12 col-sm-12 text-center">';
                                    $output .= '<span class="notify-me-text text-uppercase">';
                                    $output .= '<strong'.$hcode_coming_soon_notify_me_title_color.'>'.$hcode_coming_soon_notify_me_title.'</strong>';
                                    $output .= '<br>'.$hcode_coming_soon_notify_me_subtitle.'</span>';
                                $output .= '</div>';
                            $output .= '</div>';
                        endif;

                        if( $hcode_coming_soon_notify_me_show_form == 1 ):
                            $output .= '<div class="row">';
                                $output .= '<div class="col-md-6 col-sm-12 text-center center-col">';
                                if( $hcode_coming_soon_custom_newsletter == 1 ):
                                    $output .= do_shortcode($hcode_custom_newsletter);
                                else:
                                    $output .= '<form method="POST" name="subscription" action="'.esc_url( home_url() ).'/index.php?wp_nlm=subscription">';
                                        $output .= '<input class="form-control xyz_em_email" placeholder="'.$hcode_coming_soon_notify_placeholder.'" name="xyz_em_email" type="text" />';
                                        $output .= '<button name="submit" id="submit_newsletter" class="btn btn-black btn-small no-margin submit_newsletter" ><span>'.$hcode_coming_soon_notify_me_button_text.'</span></button>';
                                    $output .= '</form>';
                                endif;
                                $output .= '</div>';
                            $output .= '</div>';
                        endif;
                        if( $hcode_coming_soon_notify_me_fb == 1 || $hcode_coming_soon_notify_me_tw == 1 || $hcode_coming_soon_notify_me_gp == 1 || $hcode_coming_soon_notify_me_dr == 1 || $hcode_coming_soon_notify_me_yt == 1 || $hcode_coming_soon_notify_me_li == 1 || $hcode_coming_soon_notify_me_in == 1 || $hcode_coming_soon_notify_me_pi == 1 ):
                            $output .= '<div class="row coming-soon-footer">';
                                $output .= '<!-- social icon -->';
                                $output .= '<div class="col-md-12 text-center margin-two no-margin-bottom footer-social">';
                                    if( $hcode_coming_soon_notify_me_fb == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_fb_url.'" target="_blank" class="black-text-link"><i class="fa fa-facebook"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_tw == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_tw_url.'" target="_blank" class="black-text-link"><i class="fa fa-twitter"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_gp == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_gp_url.'" target="_blank" class="black-text-link"><i class="fa fa-google-plus"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_dr == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_dr_url.'" target="_blank" class="black-text-link"><i class="fa fa-dribbble"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_yt == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_yt_url.'" target="_blank" class="black-text-link"><i class="fa fa-youtube"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_li == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_li_url.'" target="_blank" class="black-text-link"><i class="fa fa-linkedin"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_in == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_in_url.'" target="_blank" class="black-text-link"><i class="fa fa-instagram"></i></a>';
                                    endif;
                                    if( $hcode_coming_soon_notify_me_pi == 1 ):
                                        $output .= '<a href="'.$hcode_coming_soon_notify_me_pi_url.'" target="_blank" class="black-text-link"><i class="fa fa-pinterest-p"></i></a>';
                                    endif;
                                $output .= '</div>';
                                $output .= '<!-- end social icon -->';
                            $output .= '</div>';
                        endif;
                    $output .= '</div>';
                $output .= '</div>';
            endif;
        break;
        }
        return $output;
    }
}
add_shortcode( 'hcode_coming_soon', 'hcode_coming_soon_shortcode' );
?>