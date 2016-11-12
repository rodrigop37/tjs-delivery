<?php
/**
 * Shortcode For Photography Services
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Photography Services */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'hcode_photography_services_shortcode' ) ) {
    function hcode_photography_services_shortcode( $atts, $content = null ) {
    	extract( shortcode_atts( array(
        			'id' => '',
                    'class' => '',
                ), $atts ) );
        $output = '';

    	$id = ( $id ) ? ' id="'.$id.'"' : '';
    	$class = ( $class ) ? $class : '';
       $output .= '<div '.$id.' class="work-5col masonry wide photography-grid photography-services '.$class.'">';
    		$output .= '<div class="tab-content">';
                $output .='<ul class="grid masonry-block-items">';
                	$output .= do_shortcode($content);
                $output .= '</ul>';
            $output .= '</div>';
        $output .= '</div>';
        return $output;
    }
}
add_shortcode( 'hcode_photography_services', 'hcode_photography_services_shortcode' );

if ( ! function_exists( 'hcode_photography_services_content_shortcode' ) ) {
    function hcode_photography_services_content_shortcode( $atts, $content = null) {
        extract( shortcode_atts( array(
        			'show_content' => '',
                    'hcode_image' => '',
                    'hcode_title' => '',
                    'hcode_title_color' => '',
                    'button_config' => '',
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
                    'class' => '',
                    'id' => '',
                ), $atts ) );
        $output = $classes = $padding = $margin = $padding_style = $margin_style = $style_attr = $style = '';
        
        $hcode_title_color = ( $hcode_title_color ) ? 'style="color:'.$hcode_title_color.' !important;"' : '';
        $class = ($class) ? $class : '';
        $id = ($id) ? 'id="'.$id.'"' : '';

        if (function_exists('vc_parse_multi_attribute')) {
            //Button
            $button_parse_args = vc_parse_multi_attribute($button_config);
            $button_link     = ( isset($button_parse_args['url']) ) ? $button_parse_args['url'] : '#';
            $button_title    = ( isset($button_parse_args['title']) ) ? $button_parse_args['title'] : '';
            $button_target   = ( isset($button_parse_args['target']) ) ? trim($button_parse_args['target']) : '_self';
        }

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
        if($padding || $margin || $class):
            $classes .= 'class="'.$class.$padding.$margin.'"';
        endif;
        if($style_attr){
            $style .= ' style="'.$style_attr.'"';
        }

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($hcode_image);
        $img_title = hcode_option_image_title($hcode_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';
        
        $thumb = wp_get_attachment_image_src($hcode_image, 'full');
        $output .='<li '.$id.' class="overflow-hidden '.$classes.'" '.$style.'>';
            $output .='<div class="opacity-light bg-dark-gray"></div>';
                if($thumb[0]):
                    $output .='<img src="'.$thumb[0].'" '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'">';
                endif;
            $output .='<div class="img-border-small img-border-small-gray border-transperent-light"></div>';
            $output .='<figure>';
                $output .='<figcaption>';
                    if($hcode_title):
                        $output .='<div class="photography-grid-details">';
                            $output .='<span class="text-large letter-spacing-9 font-weight-600 white-text"><a href="#" '.$hcode_title_color.'>'.$hcode_title.'</a></span>';
                        $output .='</div>';
                    endif;
                    if($button_title):
                        $output .='<a class="btn-small-white btn btn-small no-margin-right" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                    endif;
                $output .='</figcaption>';
            $output .='</figure>';
        $output .='</li>';
        
        return $output;
    }
}
add_shortcode( 'hcode_photography_services_content', 'hcode_photography_services_content_shortcode' );
?>