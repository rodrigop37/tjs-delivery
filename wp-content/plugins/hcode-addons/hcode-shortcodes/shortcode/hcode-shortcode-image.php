<?php
/**
 * Shortcode For Simple Image
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Simple Image */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_simple_image_shortcode' ) ) {
    function hcode_simple_image_shortcode( $atts, $content = null ) {
    	extract( shortcode_atts( array(
            	'id' => '',
            	'class' => '',
            	'hcode_image' => '',
                'hcode_mobile_full_image' => '',
                'hcode_image_with_border' => '',
                'alignment_setting' => '',
                'desktop_alignment' => '',
                'ipad_alignment' => '',
                'mobile_alignment' => '',
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
                'hcode_min_height' => '',
                'hcode_mobile_min_height' => '',
                'hcode_target_blank' => '',
                'hcode_url' => '',
                'hcode_show_image_caption' => '',
                'hcode_image_caption_position' => '',
                'hcode_image_caption_text_alignment' => '',
            ), $atts ) );

    	$output = $classes = $padding = $margin = $padding_style = $margin_style = $style_attr = $style = $alignment = '';

        $id = ( $id ) ? ' id="'.$id.'"' : '';
        $class = ( $class ) ? ' '.$class : '';
        $hcode_mobile_full_image = ($hcode_mobile_full_image==1) ? ' xs-img-full' : '';
        $hcode_min_height = ($hcode_min_height) ? 'min-height:'.$hcode_min_height.';' : '';
        $hcode_mobile_min_height = ( $hcode_mobile_min_height ) ? ' '.$hcode_mobile_min_height : '';
        $hcode_target_blank = ( $hcode_target_blank == 1 ) ? ' target="_blank"': '';
        $hcode_url = ( $hcode_url ) ? $hcode_url : '';

        /* Add image caption */
        $hcode_show_image_caption = ( $hcode_show_image_caption ) ? $hcode_show_image_caption : '';
        $hcode_image_caption_position = ( $hcode_image_caption_position ) ? $hcode_image_caption_position : 'image-caption-bottom';
        $hcode_image_caption_text_alignment = ( $hcode_image_caption_text_alignment ) ? ' '.$hcode_image_caption_text_alignment : ' text-left';
        
        // Column Allignment Settings
        $alignment_setting = ( $alignment_setting ) ? $alignment_setting : '';
        $desktop_alignment = ( $desktop_alignment ) ? ' '.$desktop_alignment : '';
        $ipad_alignment = ( $ipad_alignment ) ? ' '.$ipad_alignment : '';
        $mobile_alignment = ( $mobile_alignment ) ? ' '.$mobile_alignment : '';

        // Column Padding Settings
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

        // Column Margin Settings
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
        if($alignment_setting){
            $alignment .= $desktop_alignment;
            $alignment .= $ipad_alignment;
            $alignment .= $mobile_alignment;
        }
        if($class || $hcode_mobile_full_image || $padding || $margin || $style || $alignment):
            $classes .= 'class="'.$class.$hcode_mobile_full_image.$padding.$margin.$alignment.'"'.$style;
        endif;
        $hcode_image = ( $hcode_image ) ? $hcode_image : '';
        
        $thumb = wp_get_attachment_image_src($hcode_image, 'full');

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($hcode_image);
        $img_title = hcode_option_image_title($hcode_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';

        /* Added Image Caption V1.5 */
        $attachment = get_post( $hcode_image );
        $img_caption = array(
            'caption' => $attachment->post_excerpt,
        );
        $img_caption = ( isset($img_caption['caption']) && !empty($img_caption['caption']) ) ? $img_caption['caption'] : '' ;
        
        
        if ( $thumb[0] ):
            if( $hcode_show_image_caption == 1 ) :
                $output .= '<figure class="hcode-image-caption" id="attachment_'.$hcode_image.'">';
                if( $img_caption && $hcode_image_caption_position == 'image-caption-top' ) :
                    $output .= '<figcaption class="wp-caption-text'.$hcode_image_caption_text_alignment.'">'.$img_caption.'</figcaption>';
                endif;
            endif;
                if($hcode_image_with_border == 1){
                    if( $hcode_url ){
                        $output .= '<a href="'.$hcode_url.'"'.$hcode_target_blank.'>';
                    }
                        $output .= '<div '.$id.' class="cover-background '.$hcode_mobile_min_height.$class.$hcode_mobile_full_image.$padding.$margin.$alignment.'" style="background-image:url('.$thumb[0].');'.$hcode_min_height.$margin_style.$padding_style.'">';
                            $output .= '<div class="img-border"></div>';
                        $output .= '</div>';
                    if( $hcode_url ){
                        $output .= '</a>';
                    }
                }else{

                    if( $hcode_url ){
                        $output .= '<a href="'.$hcode_url.'"'.$hcode_target_blank.'>';
                    }
                        $output .= '<img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$classes.''.$id.' '.$image_alt.$image_title.'>';
                    if( $hcode_url ){
                        $output .= '</a>';
                    }
                }
            if( $hcode_show_image_caption == 1 ) :
                if( $img_caption && $hcode_image_caption_position == 'image-caption-bottom' ) :
                    $output .= '<figcaption class="hcode-image-caption'.$hcode_image_caption_text_alignment.'">'.$img_caption.'</figcaption>';
                endif;
                $output .= '</figure>';
            endif;

        endif;
        return $output;
    }
}
add_shortcode('hcode_simple_image','hcode_simple_image_shortcode');
?>