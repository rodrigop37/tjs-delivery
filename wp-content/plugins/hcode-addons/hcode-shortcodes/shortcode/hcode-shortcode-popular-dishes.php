<?php
/**
 * Shortcode For Popular Dishes
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Popular Dishes */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_popular_dishes_shortcode' ) ) {
    function hcode_popular_dishes_shortcode( $atts, $content = null ) {
    	extract( shortcode_atts( array(
        			'id' => '',
                    'class' => '',
                ), $atts ) );
        $output = '';

        	$id = ( $id ) ? ' id="'.$id.'"' : '';
        	$class = ( $class ) ? $class : '';
            
        	$output .= '<div '.$id.' class="work-4col gutter masonry grid-gallery '.$class.'">';
        			$output .= '<div class="tab-content">';
                        $output .='<ul class="grid masonry-items">';
                        	$output .= do_shortcode($content);
                        $output .= '</ul>';
                    $output .= '</div>';
                $output .= '</div>';
        return $output;
    }
}
add_shortcode( 'hcode_popular_dishes', 'hcode_popular_dishes_shortcode' );

if ( ! function_exists( 'hcode_popular_dishes_content_shortcode' ) ) {
    function hcode_popular_dishes_content_shortcode( $atts, $content = null) {
        extract( shortcode_atts( array(
        			'show_content' => '',
                    'hcode_image' => '',
                    'hcode_bg_image' => '',
                    'hcode_dishes_title' => '',
                    'hcode_dishes_url' => '',
                    'hcode_title_color' => '',
                    'hcode_subtitle_color' => '',
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
        $output = $classes = $padding = $margin = $padding_style = $margin_style = $style_attr = $style = '';

        
        $hcode_title_color = ( $hcode_title_color ) ? 'style="color:'.$hcode_title_color.';"' : '';
        $hcode_subtitle_color = ( $hcode_subtitle_color ) ? 'style="color:'.$hcode_subtitle_color.';"' : '';
        $hcode_dishes_url = ( $hcode_dishes_url ) ? $hcode_dishes_url : '';

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
        if($padding || $margin):
            $classes .= 'class="'.$padding.$margin.'"';
        endif;
        if($style_attr){
            $style .= ' style="'.$style_attr.'"';
        }
        
        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($hcode_image);
        $img_title = hcode_option_image_title($hcode_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';

        $img_alt_bg = hcode_option_image_alt($hcode_bg_image);
        $img_title_bg = hcode_option_image_title($hcode_bg_image);
        $image_alt_bg = ( isset($img_alt_bg['alt']) && !empty($img_alt_bg['alt']) ) ? 'alt="'.$img_alt_bg['alt'].'"' : 'alt=""' ; 
        $image_title_bg = ( isset($img_title_bg['title']) && !empty($img_title_bg['title']) ) ? 'title="'.$img_title_bg['title'].'"' : '';

        switch ($show_content) {
        	case 'image':
        		$thumb = wp_get_attachment_image_src($hcode_image, 'full');
            		if($thumb[0]):
        	    		$output .='<li '.$classes.' '.$style.'>';
        	                $output .='<a href="'.$hcode_dishes_url.'"><img src="'.$thumb[0].'" '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'"></a>';
        	            $output .='</li>';
                    endif;
        		break;

        	case 'content':
        		$thumb = wp_get_attachment_image_src($hcode_image, 'full');
        		$thumb_bg = wp_get_attachment_image_src($hcode_bg_image, 'full');
    	    		$output .='<li '.$classes.' '.$style.'>';
                        if($thumb_bg[0]):
    	                   $output .='<a href="'.$hcode_dishes_url.'"><img src="'.$thumb_bg[0].'" '.$image_alt_bg.$image_title_bg.' width="'.$thumb_bg[1].'" height="'.$thumb_bg[2].'"></a>';
                        endif;
    	                $output .='<div class="popular-dishes-border"></div>';
    	                $output .='<div class="popular-dishes">';
                            if($thumb[0]):
    	                       $output .='<img src="'.$thumb[0].'" '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'" />';
                            endif;
                            if($hcode_dishes_title):
    	                       $output .='<span class="text-uppercase letter-spacing-2 font-weight-600 display-block"><a href="'.$hcode_dishes_url.'" '.$hcode_title_color.'>'.$hcode_dishes_title.'</a></span>';
                            endif;
                            if($content):
    	                       $output .='<span class="text-small text-uppercase" '.$hcode_subtitle_color.'>'.do_shortcode( $content ).'</span>';
                            endif;
    	                $output .='</div>';
    	            $output .='</li>';
        		break;
        }
        return $output;
    }
}
add_shortcode( 'hcode_popular_dishes_content', 'hcode_popular_dishes_content_shortcode' );
?>