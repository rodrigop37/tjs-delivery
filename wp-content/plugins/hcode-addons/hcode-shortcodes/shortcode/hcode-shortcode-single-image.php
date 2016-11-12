<?php
/**
 * Shortcode For Single Image
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Single Image */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_single_image_shortcode' ) ) {
    function hcode_single_image_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'hcode_single_image_premade_style' => '',
            'single_image_bg_image' => '',
            'single_image_bg_image_spa' => '',
            'single_image_title' => '',
            'single_image_title1' => '',
            'single_image_title2' => '',
            'single_image_title3' => '',
            'single_image_subtitle' =>'',
            'single_image_slide_number' => '',
            'single_image_mp4_video' => '',
            'single_image_ogg_video' => '',
            'single_image_webm_video' => '',
            'scroll_to_section' => '',
            'single_image_scroll_to_sectionid' => '',
            'hcode_text_color' => '',
            'first_button_config' => '',
            'second_button_config' => '',
            'fullscreen' => '',
            'hcode_sep_color' => '',
            'extra_content' => '',
            'position_relative' =>'',
            'hcode_container' => '',
            'youtube_video_url' => '',
            'video_type' => '',
            'external_video_url' => '',
            'video_fullscreen' => '',
            'enable_mute' => '',
            'enable_loop' => '1',
            'enable_autoplay' => '1',
            'enable_controls' => '1',
            'hcode_coming_soon_custom_newsletter' => '',
            'hcode_custom_newsletter' => '',
            'hcode_newsletter_placeholder' => '',
            'hcode_newsletter_button_text' => '',
        ), $atts ) );

        $fullscreen = ($fullscreen) ? " full-screen" : '';
        $id = ( $id ) ? ' id="'.$id.'"' : '';
        $class = ( $class ) ? ' '.$class : '';

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($single_image_bg_image);
        $img_title = hcode_option_image_title($single_image_bg_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';

        $img_alt_spa = hcode_option_image_alt($single_image_bg_image_spa);
        $img_title_spa = hcode_option_image_title($single_image_bg_image_spa);
        $image_alt_spa = ( isset($img_alt_spa['alt']) && !empty($img_alt_spa['alt']) ) ? 'alt="'.$img_alt_spa['alt'].'"' : 'alt=""' ; 
        $image_title_spa = ( isset($img_title_spa['title']) && !empty($img_title_spa['title']) ) ? 'title="'.$img_title_spa['title'].'"' : '';

        $image_url = wp_get_attachment_image_src($single_image_bg_image, 'full');
        $image_url_spa = wp_get_attachment_url( $single_image_bg_image_spa );
        $enable_mute = ( $enable_mute == 1 ) ? 'muted ' : '';
        $enable_loop = ( $enable_loop == 1 ) ? 'loop ' : '';
        $enable_autoplay = ( $enable_autoplay == 1 ) ? 'autoplay ' : '';
        $enable_controls = ( $enable_controls == 1 ) ? 'controls ' : '';
        $single_image_title = ( $single_image_title ) ? str_replace('||', '<br />',$single_image_title) : '';

        /* add Custom newsletter shortcode from v1.6 */
        $hcode_newsletter_placeholder = ( $hcode_newsletter_placeholder ) ? $hcode_newsletter_placeholder : __('ENTER YOUR EMAIL...','hcode-addons');
        $hcode_newsletter_button_text = ( $hcode_newsletter_button_text ) ? $hcode_newsletter_button_text : __('START YOUR TRIAL','hcode-addons');
        $hcode_custom_newsletter = ( $hcode_custom_newsletter ) ? str_replace('`{`', '[',$hcode_custom_newsletter) : '';
        $hcode_custom_newsletter = ( $hcode_custom_newsletter ) ? str_replace('`}`', ']',$hcode_custom_newsletter) : '';
        $hcode_custom_newsletter = ( $hcode_custom_newsletter ) ? str_replace('``', '"',$hcode_custom_newsletter) : '';

        // For Button
        if (function_exists('vc_parse_multi_attribute')) {

            $first_button_parse_args = vc_parse_multi_attribute($first_button_config);
            $first_button_link     = ( isset($first_button_parse_args['url']) ) ? $first_button_parse_args['url'] : '#';
            $first_button_title    = ( isset($first_button_parse_args['title']) ) ? $first_button_parse_args['title'] : '';

            /* second Button*/
            $second_button_parse_args = vc_parse_multi_attribute($second_button_config);  
            $second_button_link     = ( isset($second_button_parse_args['url']) ) ? $second_button_parse_args['url'] : '#';
            $second_button_title    = ( isset($second_button_parse_args['title']) ) ? $second_button_parse_args['title'] : '';
        }
        $hcode_text_color = ($hcode_text_color) ? 'style="color:'.$hcode_text_color.';border-color:'.$hcode_text_color.'"' : '';
        $hcode_sep_color = ($hcode_sep_color) ? 'style="background-color:'.$hcode_sep_color.';"' : '';
        $position_relative = ($position_relative == 1) ? ' position-relative' : '';
        $hcode_container = ($hcode_container == 1) ? ' container' : '';
        $youtube_video_url = ( $youtube_video_url ) ? $youtube_video_url : ''; 
        $external_video_url = ( $external_video_url ) ? $external_video_url : '';
        $video_fullscreen = ($video_fullscreen) ? ' class="full-screen"' : '';
        $output = '';
        switch ($hcode_single_image_premade_style) {
            case 'single-image-style1':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    if($single_image_title):
                        $output .= '<div class="slider-typography">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-middle text-center slider-text-middle1 center-col wow fadeIn">';
                                    $output .= '<span class="fashion-subtitle text-uppercase font-weight-700 text-center " '.$hcode_text_color.'>'.$single_image_title.'</span>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    endif;
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
                if($scroll_to_section == 1){
                    $output .= '<div class="scroll-down">';
                        $output .= '<a href="#'.$single_image_scroll_to_sectionid.'" class="inner-link">';
                            $output .= '<i class="fa fa-angle-down bg-black white-text"></i>';
                        $output .= '</a>';
                    $output .= '</div>';
                }
            break;

            case 'single-image-style2':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography spa-slider">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-middle">';
                                if($image_url[0]){
                                    $output .= '<img src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'" '.$image_alt.$image_title.'/><br><br>';
                                }
                                if($single_image_title):
                                    $output .= '<p class="text-large font-weight-500 text-uppercase light-gray-text letter-spacing-3 margin-two" '.$hcode_text_color.'>'.$single_image_title.'</p>';
                                endif;
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
                if($scroll_to_section == 1){
                    $output .= '<div class="scroll-down">';
                        $output .= '<a href="#'.$single_image_scroll_to_sectionid.'" class="inner-link">';
                            $output .= '<i class="fa fa-angle-down bg-black white-text"></i>';
                        $output .= '</a>';
                    $output .= '</div>';
                }
            break;

            case 'single-image-style3':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography'.$class.'"'.$id.'>';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-bottom agency-header">';
                                if($image_url[0]){
                                    $output .= '<img src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'" '.$image_alt.$image_title.'/>';
                                }
                                if($single_image_title):
                                    $output .= '<h1 '.$hcode_text_color.'>'.$single_image_title.'</h1>';
                                endif;
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
                if($scroll_to_section == 1){
                    $output .= '<div class="scroll-down">';
                        $output .= '<a href="#'.$single_image_scroll_to_sectionid.'" class="inner-link">';
                            $output .= '<i class="fa fa-angle-down bg-black white-text"></i>';
                        $output .= '</a>';
                    $output .= '</div>';
                }
            break;
            
            case 'single-image-style4':
                $output .= '<div class="video-background fit-videos'.$class.'"'.$id.'>';
                    if($hcode_container || $position_relative || $fullscreen):
                        $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.'">';
                    endif;
                        $output .= '<div class="slider-typography">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-bottom slider-text-middle3">';
                                if($single_image_title || $content):
                                    $output .= '<h1 class="cd-headline letters type xs-margin-bottom-thirtyfive">';
                                        if($single_image_title):
                                            $output .= '<span class="rotation-highlight" '.$hcode_text_color.'>'.$single_image_title.'</span><br>';
                                        endif;
                                        if($content):
                                            $output .= '<span class="cd-words-wrapper waiting">';
                                                $output .= do_shortcode( $content );
                                            $output .= '</span>';
                                        endif;
                                    $output .= '</h1>';
                                endif;
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    if($hcode_container || $position_relative || $fullscreen || $class || $id):
                        $output .= '</div>';
                    endif;
                    if($scroll_to_section == 1){
                        $output .= '<div class="scroll-down"><a href="#'.$single_image_scroll_to_sectionid.'" class="inner-link"><i class="fa fa-angle-down bg-white black-text"></i></a></div>';
                    }
                $output .= '</div>';
                if($video_type == 'self'):
                    $output .= '<div class="video-wrapper full-screen-width z-index-0">';
                        $output .= '<video '.$enable_mute.$enable_loop.$enable_autoplay.$enable_controls.' class="html-video" poster="'.$image_url[0].'">';
                            if($single_image_mp4_video){
                                $output .= '<source type="video/mp4" src="'.$single_image_mp4_video.'">';
                            }
                            if($single_image_ogg_video){
                                $output .= '<source type="video/ogg" src="'.$single_image_ogg_video.'">';
                            }
                            if($single_image_webm_video){
                                $output .= '<source type="video/webm" src="'.$single_image_webm_video.'">';
                            }
                        $output .= '</video>';
                    $output .= '</div>';
                else:
                    $output .= '<div class="video-wrapper fit-videos z-index-0">';
                        if($external_video_url):
                            $output .= '<iframe '.$video_fullscreen.' src="'.$external_video_url.'" width="500" height="284" allowfullscreen></iframe>';
                        endif;
                    $output .= '</div>';
                endif;
            break;

            case 'single-image-style5':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-middle slider-text-middle2">';
                                if($content):
                                    $output .= '<div class="separator-line xs-margin-bottom-five" '.$hcode_sep_color.'></div>';
                                    $output .= '<span class="cd-headline slide animation2 text-uppercase" '.$hcode_text_color.'>';
                                        $output .= '<span class="cd-words-wrapper text-center ">';
                                            $output .= do_shortcode( $content );
                                        $output .= '</span>';
                                    $output .= '</span><br>';
                                endif;
                                if(!empty($first_button_title)):
                                    $output .= '<a class="btn-small-white btn margin-lr-10px margin-five-top no-margin-bottom inner-link" href="'.$first_button_link.'">'.$first_button_title.'</a>';
                                endif;
                                if(!empty($second_button_title)):
                                    $output .= '<a class="btn-small-white btn margin-lr-10px margin-five-top no-margin-bottom inner-link" href="'.$second_button_link.'">'.$second_button_title.'</a>';
                                endif;
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
                if($scroll_to_section == 1):
                    $output .='<div class="scroll-down"><a href="#'.$single_image_scroll_to_sectionid.'" class="inner-link"><i class="fa fa-angle-down bg-white black-text"></i></a></div>';
                endif;
            break;

            case 'single-image-style6':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography text-center">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-bottom padding-left-right-px animated fadeInUp">';
                                    if($single_image_title):
                                        $output .= '<span class="owl-subtitle" '.$hcode_text_color.'>'.$single_image_title.'</span>';
                                        $output .= '<div class="separator-line-thick margin-three" '.$hcode_sep_color.'></div>';
                                    endif;
                                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                $output .= '</div>';
                            $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
            break;

            case 'single-image-style7':
                $output .= '<div class="opacity-light gradient-overlay-light"></div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-middle slider-text-middle2 animated fadeInUp">';
                                if($single_image_title):
                                    $output .= '<div class="separator-line bg-white" '.$hcode_sep_color.'></div>';
                                    $output .= '<span class="slider-subtitle2 alt-font" '.$hcode_text_color.'>'.$single_image_title.'</span>';
                                endif;
                                if($first_button_title):
                                    $output .= '<a class="btn-small-white btn margin-lr-10px margin-five-top no-margin-bottom inner-link" href="'.$first_button_link.'">'.$first_button_title.'</a>';
                                endif;
                                if($second_button_title):
                                    $output .= '<a class="btn-small-white btn margin-lr-10px margin-five-top no-margin-bottom inner-link" href="'.$second_button_link.'">'.$second_button_title.'</a>';
                                endif;
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
                if($scroll_to_section == 1):
                    $output .='<div class="scroll-down"><a href="#'.$single_image_scroll_to_sectionid.'" class="inner-link"><i class="fa fa-angle-down bg-white black-text"></i></a></div>';
                endif;
            break;

            case 'single-image-style8':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                 $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-middle text-left slider-text-middle1 animated fadeInUp">';
                                if($single_image_title):
                                    $output .= '<span class="slider-subtitle1 alt-font white-text bg-black" '.$hcode_text_color.'>'.$single_image_title.'</span>';
                                endif;
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                $output .= '<div class="separator-line no-margin-lr" '.$hcode_sep_color.'></div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
            break;

            case 'single-image-style9':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-middle slider-text-middle3 animated fadeInUp">';
                                if($single_image_title):
                                    $output .= '<span class="slider-subtitle3 black-text" '.$hcode_text_color.'>'.$single_image_title.'</span><br>';
                                endif;
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                if($first_button_title):
                                    $output .= '<br><a href="'.$first_button_link.'" class="btn-small-black-border-light btn margin-right-20px margin-five-top no-margin-bottom inner-link">'.$first_button_title.'</a>';
                                endif;
                                if($second_button_title):
                                    $output .= '<a href="'.$second_button_link.'" class="btn-small-black-border-light btn margin-right-20px margin-five-top no-margin-bottom inner-link">'.$second_button_title.'</a>';
                                endif;
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
                if($scroll_to_section == 1):
                    $output .= '<div class="scroll-down">';
                        $output .= '<a href="#'.$single_image_scroll_to_sectionid.'" class="inner-link">';
                            $output .= '<i class="fa fa-angle-down bg-white black-text"></i>';
                        $output .= '</a>';
                    $output .= '</div>';
                endif;
            break;

            case 'single-image-style10':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-bottom slider-text-middle4 text-left animated fadeInUp">';
                                if($single_image_title):
                                    $output .= '<span class="slider-title-big4 alt-font" '.$hcode_text_color.'>'.$single_image_title.'</span>';
                                endif;
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                $output .= '<p class="no-margin text"><br class="no-margin text"></p><div class="separator-line no-margin-lr no-margin-top xs-margin-bottom-ten" '.$hcode_sep_color.'></div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
            break;

            case 'single-image-style11':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-bottom slider-text-middle5 text-left animated fadeInUp">';
                                if($single_image_slide_number):
                                    $output .= '<span class="slider-number alt-font white-text" '.$hcode_text_color.'>'.$single_image_slide_number.'</span>';
                                endif;
                                if($single_image_title):
                                    $output .= '<span class="slider-title-big5 alt-font" '.$hcode_text_color.'>'.$single_image_title.'</span>';
                                endif;
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                $output .= '<p class="no-margin text"><br class="no-margin text"></p><div class="separator-line no-margin-lr no-margin-top sm-margin-bottom-eleven" '.$hcode_sep_color.'></div>';
                                if($extra_content):
                                    $output .= '<p class="text-uppercase no-margin-bottom" '.$hcode_text_color.'>'.$extra_content.'</p>';
                                endif;
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
                if($scroll_to_section == 1):
                    $output .='<div class="scroll-down"><a href="#'.$single_image_scroll_to_sectionid.'" class="inner-link"><i class="fa fa-angle-down bg-white black-text"></i></a></div>';
                endif;
            break;

            case 'single-image-style12':
                $output .= '<div class="spa-sider"><div class="slider-content position-relative'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                    $output .= '<img class="spa-slider-bg" src="'.$image_url_spa.'" '.$image_alt_spa.$image_title_spa.'>';
                    $output .= '<div class="slider-typography padding-seven">';
                            $output .= '<div class="slider-text-middle-main padding-six-lr sm-no-padding">';
                                $output .= '<div class="slider-text-middle slider-text-middle2 text-left xs-no-padding">';
                                    if($image_url[0]){
                                        $output .= '<img '.$image_alt.$image_title.' class="get-bg xs-display-none" src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'" />';
                                    }
                                    $output .= '<div class="separator-line no-margin-lr no-margin-top sm-margin-bottom-ten" '.$hcode_sep_color.'></div>';
                                    if($single_image_title):
                                        $output .= '<span class="owl-title single-image-title-box white-text margin-four-bottom sm-margin-bottom-ten" '.$hcode_text_color.'>'.$single_image_title.'</span>';
                                    endif;
                                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                    if($first_button_title):
                                        $output .= '<a class="btn-small-white btn inner-link no-margin-top" href="'.$first_button_link.'">'.$first_button_title.'</a>';
                                    endif;
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'single-image-style13':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography'.$class.'"'.$id.'>';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-bottom">';
                                if($youtube_video_url):
                                    $output .= '<a class="popup-youtube-landing" href="'.$youtube_video_url.'"><span class="play-icon"><i class="fa fa-play black-text"></i></span></a>';
                                endif;
                                if($single_image_title):
                                    $output .= '<h1 class="letter-spacing-2 white-text margin-three no-margin-bottom landing-title" '.$hcode_text_color.'>'.$single_image_title.'</h1>';
                                endif;
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                $output .= '<div class="margin-five margin-ten-bottom">';
                                    $output .= '<div class="col-lg-6 col-md-7 col-sm-10 col-xs-11 clearfix landing-subscribe center-col">';
                                    if( $hcode_coming_soon_custom_newsletter == 1 ):
                                        $output .= do_shortcode($hcode_custom_newsletter);
                                    else:
                                        $output .= do_shortcode( '[hcode_newsletter hcode_newsletter_premade_style="hcode-newsletter-block2" hcode_newsletter_placeholder="'.$hcode_newsletter_placeholder.'" hcode_newsletter_button_text="'.$hcode_newsletter_button_text.'"]' );
                                    endif;
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
            break;

            case 'single-image-style14':
                $output .= '<div class="full-width-image owl-half-slider'.$class.'"'.$id.'>';
                    $output .= '<div class="slider-typography text-left">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-middle padding-left-right-px">';
                                if($single_image_title):
                                    $output .= '<span class="owl-subtitle black-text" '.$hcode_text_color.'>'.$single_image_title.'</span>';
                                endif;
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'single-image-style15':
                
                if($video_type == 'self'):
                    $output .= '<div class="video-wrapper full-screen-width z-index-0 position-top'.$class.'"'.$id.'>';
                        $output .= '<video '.$enable_mute.$enable_loop.$enable_autoplay.$enable_controls.' class="html-video" poster="'.$image_url[0].'">';
                            if($single_image_mp4_video){
                                $output .= '<source type="video/mp4" src="'.$single_image_mp4_video.'">';
                            }
                            if($single_image_ogg_video){
                                $output .= '<source type="video/ogg" src="'.$single_image_ogg_video.'">';
                            }
                            if($single_image_webm_video){
                                $output .= '<source type="video/webm" src="'.$single_image_webm_video.'">';
                            }
                        $output .= '</video>';
                    $output .= '</div>';
                else:
                    if($external_video_url):
                        $output .= '<div class="video-wrapper fit-videos z-index-0 position-top'.$class.'"'.$id.'>';
                            $output .= '<iframe '.$video_fullscreen.' src="'.$external_video_url.'" width="500" height="284" allowfullscreen></iframe>';
                        $output .= '</div>';
                    endif;
                endif;
                
                $output .= '<div class="slider-text-middle2 animated fadeInUp position-relative text-center margin-ten">';
                    if($single_image_title):
                        $output .= '<span class="slider-subtitle2 alt-font white-text" '.$hcode_text_color.'>'.$single_image_title.'</span>';
                    endif;
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                $output .= '</div>';
            break;

            case 'single-image-style16':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-middle slider-text-middle2 animated fadeInUp">';
                                if($single_image_title):
                                    $output .= '<div class="separator-line margin-five sm-margin-bottom-seven" '.$hcode_sep_color.'></div>';
                                    $output .= '<span class="slider-subtitle2 alt-font black-text" '.$hcode_text_color.'>'.$single_image_title.'</span>';
                                endif;
                                if($first_button_title):
                                    $output .= '<a class="btn-black btn margin-four-top margin-lr-10px inner-link no-margin-bottom" href="'.$first_button_link.'">'.$first_button_title.'</a>';
                                endif;
                                if($second_button_title):
                                    $output .= '<a class="btn-black btn margin-four-top margin-lr-10px inner-link" href="'.$second_button_link.'">'.$second_button_title.'</a>';
                                endif;
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
                if($scroll_to_section == 1):
                    $output .='<div class="scroll-down"><a href="#'.$single_image_scroll_to_sectionid.'" class="inner-link"><i class="fa fa-angle-down bg-black white-text"></i></a></div>';
                endif;
            break;

            case 'single-image-style17':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                if($content):
                    $output .= '<div class="slider-typography">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-bottom slider-text-middle2">';
                                $output .= '<div class="separator-line xs-margin-bottom-five" '.$hcode_sep_color.'></div>';
                                $output .= '<span class="cd-headline slide animation3 text-uppercase" '.$hcode_text_color.'>';
                                    $output .= '<span class="cd-words-wrapper text-center margin-ten no-margin-top">';
                                        $output .= do_shortcode( $content );
                                    $output .= '</span>';
                                $output .= '</span>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                endif;
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
                if($scroll_to_section == 1):
                    $output .='<div class="scroll-down"><a href="#'.$single_image_scroll_to_sectionid.'" class="inner-link"><i class="fa fa-angle-down bg-white black-text"></i></a></div>';
                endif;
            break;

            case 'single-image-style18':
                $output .='<div class="half-project-small-img">';
                    $output .='<div class="container">';
                        $output .='<div class="project-header-text">';
                            if($single_image_title):
                                $output .='<span class="project-subtitle alt-font white-text" '.$hcode_text_color.'>'.$single_image_title.'</span>';
                            endif;
                            $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                        $output .='</div>';
                    $output .='</div>';
                $output .='</div>';
            break;

            case 'single-image-style19':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-middle slider-text-middle2 personal-name animated fadeIn">';
                                if( $single_image_title ):
                                    $output .= '<h1 class="margin-two" '.$hcode_text_color.'>'.$single_image_title.'</h1>';
                                endif;
                                if( $single_image_title1 || $single_image_title2 || $single_image_title3 ):
                                    $output .= '<span class="cd-headline letters type text-uppercase">';
                                        $output .= '<span class="cd-words-wrapper waiting">';
                                            if( $single_image_title1 ):
                                                $output .= '<b class="is-visible main-font text-large font-weight-400">'.$single_image_title1.'</b>';
                                            endif;
                                            if( $single_image_title2 ):
                                                $output .= '<b class="main-font text-large font-weight-400">'.$single_image_title2.'</b>';
                                            endif;
                                            if( $single_image_title3 ):
                                                $output .= '<b class="main-font text-large font-weight-400">'.$single_image_title3.'</b>';
                                            endif;
                                        $output .= '</span>';
                                    $output .= '</span>';
                                endif;
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
            break;

            case 'single-image-style20':
                if($single_image_slide_number):
                    $output .= '<span class="parallax-number alt-font black-text" >'.$single_image_slide_number.'</span>';
                endif;
                if($single_image_title):
                    $output .= '<span class="parallax-title alt-font black-text" '.$hcode_text_color.'>'.$single_image_title.'</span>';
                endif;
                if($content):
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
                $output .= '<div class="separator-line bg-black no-margin-lr" '.$hcode_sep_color.'></div>';
                if($extra_content):
                    $output .= '<p class="black-text text-uppercase no-margin-bottom">'.$extra_content.'</p>';
                endif;
            break;

            case 'single-image-style21':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-middle slider-text-middle2">';
                                $output .='<div class="separator-line bg-white" '.$hcode_sep_color.'></div>';
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                if(!empty($first_button_title)):
                                    $output .= '<a class="btn-small-white btn margin-lr-10px margin-five-top no-margin-bottom inner-link" href="'.$first_button_link.'">'.$first_button_title.'</a>';
                                endif;
                                if(!empty($second_button_title)):
                                    $output .= '<a class="btn-small-white btn margin-lr-10px margin-five-top no-margin-bottom inner-link" href="'.$second_button_link.'">'.$second_button_title.'</a>';
                                endif;
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
                if($scroll_to_section == 1):
                    $output .='<div class="scroll-down"><a href="#'.$single_image_scroll_to_sectionid.'" class="inner-link"><i class="fa fa-angle-down bg-white black-text"></i></a></div>';
                endif;
            break;

            case 'single-image-style22':
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .='<div class="'.$hcode_container.$position_relative.$fullscreen.$class.'"'.$id.'>';
                endif;
                    $output .= '<div class="slider-typography">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-middle slider-text-middle3 animated fadeInUp">';
                                if($single_image_title):
                                    $output .= '<span class="slider-subtitle3 white-text" '.$hcode_text_color.'>'.$single_image_title.'</span><br>';
                                endif;
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                if($first_button_title):
                                    $output .= '<br><a href="'.$first_button_link.'" class="btn-small-white btn margin-right-20px margin-five-top no-margin-bottom inner-link">'.$first_button_title.'</a>';
                                endif;
                                if($second_button_title):
                                    $output .= '<a href="'.$second_button_link.'" class="btn-small-white btn margin-right-20px margin-five-top no-margin-bottom inner-link">'.$second_button_title.'</a>';
                                endif;
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                if($hcode_container || $position_relative || $fullscreen || $class || $id):
                    $output .= '</div>';
                endif;
                if($scroll_to_section == 1):
                    $output .= '<div class="scroll-down">';
                        $output .= '<a href="#'.$single_image_scroll_to_sectionid.'" class="inner-link">';
                            $output .= '<i class="fa fa-angle-down bg-white black-text"></i>';
                        $output .= '</a>';
                    $output .= '</div>';
                endif;
            break;
        }
        return $output;
    }
}
add_shortcode( 'hcode_single_image', 'hcode_single_image_shortcode' );
?>