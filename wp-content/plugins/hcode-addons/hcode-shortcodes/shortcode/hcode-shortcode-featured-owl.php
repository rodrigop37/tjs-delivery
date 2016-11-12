<?php
/**
 * Shortcode For Featured OWL Slider
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Featured OWL Slider */
/*-----------------------------------------------------------------------------------*/

$hcode_slider_parent_type='';
if ( ! function_exists( 'hcode_feature_slider_shortcode' ) ) {
    function hcode_feature_slider_shortcode( $atts, $content = null ) {
    		extract( shortcode_atts( array(
                    'show_pagination' => '',
                    'show_pagination_style' => '',
                    'show_navigation' => '',
                    'show_navigation_style' => '',
                    'show_pagination_color_style' => '',
                    'show_cursor_color_style' => '',
                    'hcode_image_carousel_itemsdesktop' => '3',
                    'hcode_image_carousel_itemstablet' => '3',
                    'hcode_image_carousel_itemsmobile' => '1',
                    'hcode_image_carousel_autoplay' => '',
                    'hcode_slider_id' => '',
                    'hcode_slider_class' => '',
                    'stoponhover' => '',
                    'slidespeed' => '3000',
            ), $atts ) );

            $output = $slider_config = '';
            $pagination = hcode_owl_pagination_slider_classes($show_pagination_style);
            $pagination_style = hcode_owl_pagination_color_classes($show_pagination_color_style);
            $navigation = ( $show_navigation_style ) ? hcode_owl_navigation_slider_classes( $show_navigation_style) : hcode_owl_navigation_slider_classes('default') ;
            $hcode_slider_id = ( $hcode_slider_id ) ? $hcode_slider_id : 'image-owl-slider';
            $hcode_slider_class  = ( $hcode_slider_class ) ? ' '.$hcode_slider_class : '';
            $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' cursor-black';

            $output .= '<div class="feature-owl position-relative">';
                $output .= '<div class="container">';
                    $output .= '<div class="row">';
                        $output .= '<div id="'.$hcode_slider_id.'" class="owl-carousel owl-theme bottom-pagination'.$show_cursor_color_style.$pagination.$navigation.$pagination_style.$hcode_slider_class.'">';
                            $output .= do_shortcode($content);
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
                if( $show_navigation == 1 ):
                    if($show_navigation_style == 1):
                        $output .= '<div class="feature_nav">';
                            $output .= '<a class="prev left carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre.png" width="96" height="96" ></a>';
                            $output .= '<a class="next right carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next.png" width="96" height="96" ></a>';
                        $output .= '</div>';
                    else:
                        $output .= '<div class="feature_nav">';
                            $output .= '<a class="prev left carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-white-bg.png" width="96" height="96" ></a>';
                            $output .= '<a class="next right carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-white-bg.png" width="96" height="96" ></a>';
                        $output .= '</div>';
                    endif;
                endif;
            $output .= '</div>';
            $slidespeed = ( $slidespeed ) ? $slidespeed : '3000'; 
            ( $show_pagination == 1 ) ? $slider_config .= 'pagination: true,' : $slider_config .= 'pagination: false,';
            ( $hcode_image_carousel_autoplay == 1 ) ? $slider_config .= 'autoPlay: '.$slidespeed.',' : $slider_config .= 'autoPlay: false,';
            ( $stoponhover == 1) ? $slider_config .= 'stopOnHover: true, ' : $slider_config .= 'stopOnHover: false, ';
            ( $hcode_image_carousel_itemsdesktop ) ? $slider_config .= 'items: '.$hcode_image_carousel_itemsdesktop.',' : $slider_config .= 'items: 3,';
            ( $hcode_image_carousel_itemsdesktop ) ? $slider_config .= 'itemsDesktop: [1200,'.$hcode_image_carousel_itemsdesktop.'],' : $slider_config .= 'itemsDesktop: [1200, 3],';
            ( $hcode_image_carousel_itemstablet ) ? $slider_config .= 'itemsTablet: [991,'.$hcode_image_carousel_itemstablet.'],' : $slider_config .= 'itemsTablet: [991, 2],';
            ( $hcode_image_carousel_itemsmobile ) ? $slider_config .= 'itemsMobile: [700,'.$hcode_image_carousel_itemsmobile.'],' : $slider_config .= 'itemsMobile: [700, 1],';

    	ob_start();?>
        <script type="text/javascript">jQuery(document).ready(function () { jQuery("<?php echo '#'.$hcode_slider_id;?>").owlCarousel({ <?php echo $slider_config;?> }); });</script>
    	<?php 
    	$script = ob_get_contents();
    	ob_end_clean();
    	$output .= $script;
    	/* Add custom script End*/
        return $output;
    }
}
add_shortcode( 'hcode_feature_slider', 'hcode_feature_slider_shortcode' );
 

if ( ! function_exists( 'hcode_feature_slide_content_shortcode' ) ) {
    function hcode_feature_slide_content_shortcode( $atts, $content = null) {
    	global $hcode_slider_parent_type;
        extract( shortcode_atts( array(
                    'hcode_et_line_icon_list' => '',
                    'title' => '',
                    'margin_setting' => '',
                    'custom_desktop_margin' => '',
                    'desktop_margin' => '',
                    'ipad_margin' => '',
                    'mobile_margin' => '',
                    'id' => '',
                    'class' => '',
                    'icon_color_style' => '',
                    'hcode_icon_color' => '',
                    'title_color_style' => '',
                    'hcode_title_color' => '',
                    'hcode_content_color' => '',
                ), $atts ) );
        $output = $urltarget = $margin = $margin_style = $style_attr = $style = $icon_classes = $title_classes = $icon_style = $title_style = '';
        ob_start();
        $title = ( $title ) ? $title : '';
        switch ($icon_color_style){
            case 'white-text':
                $icon_classes .= 'white-text';
                $icon_style .= '';
            break;
            case 'black-text':
                $icon_classes .= 'black-text';
                $icon_style .= '';
            break;
            case 'custom':
                $icon_classes .= '';
                $icon_style .= 'style="color:'.$hcode_icon_color.';"';
            break;
        }

        switch ($title_color_style){
            case 'white-text':
                $title_classes .= 'white-text';
                $title_style .= '';
            break;
            case 'black-text':
                $title_classes .= 'black-text';
                $title_style .= '';
            break;
            case 'custom':
                $title_classes .= '';
                $title_style .= 'style="color:'.$hcode_title_color.';"';
            break;
        }

        $hcode_et_line_icon_list = ($hcode_et_line_icon_list) ? $hcode_et_line_icon_list : '';
        $hcode_icon_color = ( $hcode_icon_color ) ? 'style="color:'.$hcode_icon_color.';"' : '';
        $hcode_content_color = ( $hcode_content_color ) ? 'style="color:'.$hcode_content_color.';"' : '';
        $id = ( $id ) ? ' id="'.$id.'"' : '';
    	$class = ( $class ) ? ' '.$class : '';
       
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
    	
    	if($margin_style){
    		$style_attr .= $margin_style;
    	}

    	if($style_attr){
    		$style .= ' style="'.$style_attr.'"';
    	}

        $output .='<div'.$id.' class="item margin-ten no-margin-top'.$class.'">';
            $output .='<div class="text-center margin-four wow fadeIn '.$margin.'" '.$style.'>';
                if($hcode_et_line_icon_list):
    	           $output .='<i class="'.$hcode_et_line_icon_list.' medium-icon no-margin-bottom '.$icon_classes.'" '.$icon_style.'></i>';
                endif;
                if($title):
    	           $output .='<h5 class="'.$title_classes.' margin-ten no-margin-bottom xs-margin-top-five" '.$title_style.'>'.$title.'</h5>';
                endif;
                if($content):
    	           $output .='<span class="approach-details feature-owlslide-content light-gray-text2" '.$hcode_content_color.'>'.do_shortcode( $content ).'</span>';
                endif;
            $output .='</div>';
        $output .='</div>';
        return $output;
    }
}
add_shortcode( 'hcode_feature_slide_content', 'hcode_feature_slide_content_shortcode' );
?>