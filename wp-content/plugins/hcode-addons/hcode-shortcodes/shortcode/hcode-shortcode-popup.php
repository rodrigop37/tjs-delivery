<?php
/**
 * Shortcode For Popup
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Popup */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_popup_shortcode' ) ) {
    function hcode_popup_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            	'popup_type' => '',
            	'popup_title' => '',
                'inside_popup_title' => '',
            	'popup_button_config' => '',
                'popup_button_config_youtube' => '',
                'popup_form_id' => '',
                'contact_forms_shortcode' => '',
                'hcode_et_line_icon_list' => '',
                'popup_external_url' => '',
                'popup_external_url_youtube' => '',
                'hcode_title_color' => '',
                'hcode_icon_color' => '',
                'offset' => '',
                'width' => '',
            ), $atts ) );
        $output = $popup_form_class = '';
        $hcode_et_line_icon_list = ($hcode_et_line_icon_list) ? $hcode_et_line_icon_list : '';
        $popup_external_url = ($popup_external_url) ? $popup_external_url : '';
        $popup_external_url_youtube = ($popup_external_url_youtube) ? $popup_external_url_youtube : '';
        $inside_popup_title = ( $inside_popup_title ) ? $inside_popup_title : '';
        $hcode_title_color = ( $hcode_title_color ) ? ' style="color:'.$hcode_title_color.' !important;"' : '';
        $hcode_icon_color = ( $hcode_icon_color ) ? ' style="color:'.$hcode_icon_color.' !important;"' : '';
        $first_button_parse_args = vc_parse_multi_attribute($popup_button_config);
        $first_button_link     = ( isset($first_button_parse_args['url']) ) ? $first_button_parse_args['url'] : '#';
        $first_button_title    = ( isset($first_button_parse_args['title']) ) ? $first_button_parse_args['title'] : 'sample button';
        $first_button_target   = ( isset($first_button_parse_args['target']) ) ? trim($first_button_parse_args['target']) : '_self';

        $youtube_button = vc_parse_multi_attribute($popup_button_config_youtube);
        $youtube_button_link     = ( isset($youtube_button['url']) ) ? $youtube_button['url'] : '#';
        $youtube_button_title    = ( isset($youtube_button['title']) ) ? $youtube_button['title'] : 'sample button';
        $youtube_button_target   = ( isset($youtube_button['target']) ) ? trim($youtube_button['target']) : '_self';

        // Column Offset and sm width
        $offset = ( $offset ) ? ' '. str_replace( 'vc_', '', $offset ) : '';
        if(strchr($offset,'col-xs')):
            $offset = $offset;
        else:
            $offset = $offset." col-xs-mobile-fullwidth";
        endif;
        
        if($width != ''){
            $width = explode('/', $width);
            $width = ( $width[0] != '1' ) ? ' col-sm-'.$width[0] * floor(12 / $width[1]) : ' col-sm-'.floor(12 / $width[1]);
        }

        switch ($popup_type){
            case 'popup-form-1':
                $contact_form = do_shortcode('[contact-form-7 id='.$contact_forms_shortcode.']');
                $output .='<div class="slider-text-middle2 animated fadeInUp position-relative text-center">';
                    if($content):
                        $output .='<span class="slider-subtitle5 black-text">'.do_shortcode( $content ).'</span>';
                    endif;
                    if($first_button_title):
                        $output .= '<a class="btn button-reveal button-reveal-black button popup-with-form no-margin" href="#popup-form-'.$popup_form_id.'" target="'.$first_button_target.'"><i class="fa fa-plus"></i><span>'.$first_button_title.'</span></a>';
                    endif;
                    
                    $output .= '<div id="popup-form-'.$popup_form_id.'" class="mfp-hide">';
                        $output .= '<div class="'.$offset.$width.' center-col text-center">';
                            if($content):
                                $output .= '<span class="slider-subtitle5 black-text">'.do_shortcode($content).'</span>';
                            endif;
                            $output .= $contact_form;
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
                break;
            
            case 'popup-form-2':
                $contact_form = do_shortcode('[contact-form-7 id='.$contact_forms_shortcode.']');
                $output .='<div class="slider-text-middle2 animated fadeInUp position-relative text-center">';
                    if($content):
                        $output .='<span class="slider-subtitle5 white-text">'.do_shortcode($content).'</span>';
                    endif;
                    if($first_button_title):
                        $output .= '<a class="btn-small-white-dark btn btn-medium button xs-margin-bottom-five popup-with-form no-margin" href="#popup-form-'.$popup_form_id.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                    endif;
                    $output .= '<div id="popup-form-'.$popup_form_id.'" class="mfp-hide">';
                        $output .= '<div class="'.$offset.$width.' center-col text-center">';
                            if($content):
                                $output .= '<span class="slider-subtitle5 black-text">'.do_shortcode($content).'</span>';
                            endif;
                            $output .= $contact_form;
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
                break;
            
            case 'modal-popup':
                if($popup_title):
                    $output .= '<p class="text-med" '.$hcode_title_color.'>'.$popup_title.'</p>';
                endif;
                if($first_button_title):
                    $output .= '<a class="highlight-button btn btn-small no-margin-right '.$popup_type.' no-margin-bottom" href="#modal-popup-'.$popup_form_id.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                endif;
                $output .= '<div id="modal-popup-'.$popup_form_id.'" class="white-popup-block mfp-hide '.$offset.$width.' center-col bg-white text-center modal-popup-main">';
                    if($inside_popup_title):
                        $output .= '<span class="slider-subtitle5 black-text no-margin-bottom">'.$inside_popup_title.'</span>';
                    endif;
                    if($content):
                        $output .= '<p class="margin-four">'.do_shortcode($content).'</p>';
                    endif;
                    $output .= '<a class="highlight-button btn btn-very-small button popup-modal-dismiss no-margin" href="#">Dismiss</a>';
                $output .= '</div>';
                break;

            case 'popup-with-zoom-anim':
                if($popup_title):
                    $output .= '<p class="text-med" '.$hcode_title_color.'>'.$popup_title.'</p>';
                endif;
                if($first_button_title):
                    $output .= '<a class="highlight-button btn btn-small no-margin-right '.$popup_type.' no-margin-bottom" href="#modal-popup-'.$popup_form_id.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                endif;
                $output .= '<div id="modal-popup-'.$popup_form_id.'" class="zoom-anim-dialog mfp-hide '.$offset.$width.' center-col bg-white text-center modal-popup-main">';
                    if($inside_popup_title):
                        $output .= '<span class="slider-subtitle5 black-text no-margin-bottom">'.$inside_popup_title.'</span>';
                    endif;
                    if($content):
                        $output .= '<p class="margin-four">'.do_shortcode($content).'</p>';
                    endif;
                    $output .= '<a class="highlight-button btn btn-very-small button popup-modal-dismiss no-margin" href="#">Dismiss</a>';
                $output .= '</div>';
                break;
            
            case 'popup-with-move-anim':
                if($popup_title):
                    $output .= '<p class="text-med" '.$hcode_title_color.'>'.$popup_title.'</p>';
                endif;
                if($first_button_title):
                    $output .= '<a class="highlight-button btn btn-small no-margin-right '.$popup_type.' no-margin-bottom" href="#modal-popup-'.$popup_form_id.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                endif;
                $output .= '<div id="modal-popup-'.$popup_form_id.'" class="zoom-anim-dialog mfp-hide '.$offset.$width.' center-col bg-white text-center modal-popup-main">';
                    if($inside_popup_title):
                        $output .= '<span class="slider-subtitle5 black-text no-margin-bottom">'.$inside_popup_title.'</span>';
                    endif;
                    if($content):
                        $output .= '<p class="margin-four">'.do_shortcode($content).'</p>';
                    endif;
                    $output .= '<a class="highlight-button btn btn-very-small button popup-modal-dismiss no-margin" href="#">Dismiss</a>';
                $output .= '</div>';
                break;
            
            case 'simple-ajax-popup-align-top':
                if($popup_title):
                    $output .= '<p class="text-med" '.$hcode_title_color.'>'.$popup_title.'</p>';
                endif;
                if($first_button_title):
                    $output .= '<a class="highlight-button btn btn-small no-margin-right '.$popup_type.' no-margin-bottom" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                endif;
                break;

            case 'youtube-video-1':
                if($content):
                    $output .='<p class="text-med">'.do_shortcode($content).'</p>';
                endif;
                if($youtube_button_title):
                    $output .='<a class="highlight-button btn btn-small no-margin-right popup-youtube" href="'.$youtube_button_link.'" target="'.$youtube_button_target.'">'.$youtube_button_title.'</a>';
                endif;
                break;
            
            case 'youtube-video-2':
                if($hcode_et_line_icon_list):
                    $output .='<a class="popup-youtube" href="'.$popup_external_url_youtube.'" target="'.$first_button_target.'"><i class="'.$hcode_et_line_icon_list.' white-text large-icon margin-ten no-margin-top" '.$hcode_icon_color.'></i></a>';
                endif;
                if($popup_title):
                    $output .='<h1 class="white-text video-title" '.$hcode_title_color.'>'.$popup_title.'</h1>';
                endif;
                $output .= do_shortcode( hcode_remove_wpautop($content) );
                break;
            
            case 'vimeo-video-1':
                if($content):
                    $output .='<p class="text-med">'.do_shortcode($content).'</p>';
                endif;
                if($first_button_title):
                    $output .='<a class="highlight-button btn btn-small no-margin-right popup-vimeo no-margin-bottom" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                endif;
                break;

            case 'vimeo-video-2':
                if($hcode_et_line_icon_list):
                    $output .='<a class="popup-vimeo" href="'.$popup_external_url.'"><i class="'.$hcode_et_line_icon_list.' white-text large-icon margin-ten no-margin-top" '.$hcode_icon_color.'></i></a>';
                endif;
                if($popup_title):
                    $output .='<h1 class="white-text video-title" '.$hcode_title_color.'>'.$popup_title.'</h1>';    
                endif;
                $output .= do_shortcode( hcode_remove_wpautop($content) );
                break;
            
            case 'google-map-1':
                if($content):
                    $output .='<p class="text-med">'.do_shortcode($content).'</p>';
                endif;
                if($first_button_title):
                    $output .='<a class="highlight-button btn btn-small no-margin-right popup-gmaps no-margin-bottom" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                endif;
                break;

            case 'google-map-2':
                if($hcode_et_line_icon_list):
                    $output .='<a class="popup-gmaps" href="'.$popup_external_url.'"><i class="'.$hcode_et_line_icon_list.' white-text large-icon margin-ten no-margin-top" '.$hcode_icon_color.'></i></a>';
                endif;
                if($popup_title):
                    $output .='<h1 class="white-text video-title" '.$hcode_title_color.'>'.$popup_title.'</h1>';
                endif;
                $output .= do_shortcode( hcode_remove_wpautop($content) );
                break;
        }
        return $output;
    }
}
add_shortcode( 'hcode_popup', 'hcode_popup_shortcode' );
?>