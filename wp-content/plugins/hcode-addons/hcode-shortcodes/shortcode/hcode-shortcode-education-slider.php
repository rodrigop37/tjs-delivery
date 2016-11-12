<?php
/**
 * Shortcode For Education Slider
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Education Slider */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_education_slider_shortcode' ) ) {
    function hcode_education_slider_shortcode( $atts, $content = null ) {
    		extract( shortcode_atts( array(
                    'show_pagination' => '',
                    'show_pagination_style' => '',
                    'show_navigation' => '',
                    'show_navigation_style' => '',
                    'show_pagination_color_style' => '',
                    'hcode_image_carousel_itemsdesktop' => '4',
                    'hcode_image_carousel_itemstablet' => '3',
                    'hcode_image_carousel_itemsmobile' => '1',
                    'hcode_image_carousel_autoplay' => '',
                    'hcode_slider_id' => '',
                    'hcode_slider_class' => '',
                    'show_cursor_color_style' => '',
                    'stoponhover' => '',
                    'slidespeed' => '3000',
            ), $atts ) );

            $output = $slider_config = '';
            $navigation = ( $show_navigation_style ) ? hcode_owl_navigation_slider_classes( $show_navigation_style) : hcode_owl_navigation_slider_classes('default') ;
            $pagination = hcode_owl_pagination_slider_classes($show_pagination_style);
            $pagination_style = hcode_owl_pagination_color_classes($show_pagination_color_style);
            $hcode_slider_id = ( $hcode_slider_id ) ? $hcode_slider_id : 'education-owl-slider';
            $hcode_slider_class  = ( $hcode_slider_class ) ? ' '.$hcode_slider_class : '';
            $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' cursor-black';

                $output .= '<div class="feature-owl position-relative">';
                    $output .= '<div class="container">';
                        $output .= '<div class="row">';
                            $output .= '<div id="'.$hcode_slider_id.'" class="owl-pagination-bottom owl-carousel owl-theme'.$show_cursor_color_style.$pagination.$navigation.$pagination_style.$navigation.$hcode_slider_class.'">';
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
            
        /* Add custom script Start*/
        $slidespeed = ( $slidespeed ) ? $slidespeed : '3000'; 
        ( $show_pagination == 1 ) ? $slider_config .= 'pagination: true,' : $slider_config .= 'pagination: false,';
        ( $hcode_image_carousel_autoplay == 1 ) ? $slider_config .= 'autoPlay: '.$slidespeed.',' : $slider_config .= 'autoPlay: false,';
        ( $stoponhover == 1) ? $slider_config .= 'stopOnHover: true, ' : $slider_config .= 'stopOnHover: false, ';
        ( $hcode_image_carousel_itemsdesktop ) ? $slider_config .= 'items: '.$hcode_image_carousel_itemsdesktop.',' : $slider_config .= 'items: 4,';
        ( $hcode_image_carousel_itemsdesktop ) ? $slider_config .= 'itemsDesktop: [1200,'.$hcode_image_carousel_itemsdesktop.'],' : $slider_config .= 'itemsDesktop: [1200, 3],';
        ( $hcode_image_carousel_itemstablet ) ? $slider_config .= 'itemsTablet: [991,'.$hcode_image_carousel_itemstablet.'],' : $slider_config .= 'itemsTablet: [991, 2],';
        ( $hcode_image_carousel_itemsmobile ) ? $slider_config .= 'itemsMobile: [700,'.$hcode_image_carousel_itemsmobile.'],' : $slider_config .= 'itemsMobile: [700, 1],';

    	ob_start();?>
    	<script type="text/javascript"> jQuery(document).ready(function () { jQuery("<?php echo '#'.$hcode_slider_id;?>").owlCarousel({ <?php echo $slider_config;?> }); }); </script>
    	<?php 
    	$script = ob_get_contents();
    	ob_end_clean();
    	$output .= $script;
    	/* Add custom script End*/
        return $output;
    }
}
add_shortcode( 'hcode_education_slider', 'hcode_education_slider_shortcode' );

if ( ! function_exists( 'hcode_education_slide_content_shortcode' ) ) { 
    function hcode_education_slide_content_shortcode( $atts, $content = null) {
    	global $hcode_slider_parent_type;
        extract( shortcode_atts( array(
                    'id' => '',
                    'class' => '',
                    'hcode_et_line_icon_list' => '',
                    'year' => '',
                    'title' => '',
                    'hcode_show_separator' => '',
                    'education_name' => '',
                    'grade_button' => '',
                    'hcode_icon_color' => '',
                    'year_color' => '',
                    'hcode_title_color' => '',
                    'education_name_color' => '',
                    'hcode_content_color' => '',
                ), $atts ) );
        $output = '';
        ob_start();
        $title        = ( $title ) ? $title : '';
        $year = ( $year ) ? $year : '';
        $hcode_et_line_icon_list = ($hcode_et_line_icon_list) ? $hcode_et_line_icon_list : '';
        $hcode_icon_color = ( $hcode_icon_color ) ? 'style="color:'.$hcode_icon_color.';"' : '';
        $year_color = ( $year_color ) ? 'style="color:'.$year_color.';"' : '';
        $hcode_title_color = ( $hcode_title_color ) ? 'style="color:'.$hcode_title_color.';"' : '';
        $education_name_color = ( $education_name_color ) ? 'style="color:'.$education_name_color.';"' : '';
        $hcode_content_color = ( $hcode_content_color ) ? 'style="color:'.$hcode_content_color.';"' : '';
        $button_title = ( $grade_button ) ? $grade_button : '';

        $id        = ( $id ) ? $id : '';
    	$class     = ( $class ) ? ' '.$class : '';
        $education_name = ( $education_name ) ? $education_name : '';
        
        $output .='<div class="education-box-main text-center'.$class.'"'.$id.'>';
            $output .='<div class="education-box">';
                if( $hcode_et_line_icon_list || $hcode_icon_color ):
                    $output .='<i class="'.$hcode_et_line_icon_list.'" '.$hcode_icon_color.'></i>';
                endif;
                if( $year ):
                    $output .='<span class="year text-large display-block margin-five" '.$year_color.'>'.$year.'</span>';
                endif;
                if( $title ):
                    $output .='<span class="university text-uppercase display-block letter-spacing-2 font-weight-600" '.$hcode_title_color.'>'.$title.'</span>';
                endif;
                if( $hcode_show_separator == 1 ):
                    $output .='<div class="separator-line bg-black margin-ten"></div>';
                endif;
            $output .='</div>';
            $output .='<div class="namerol">';
                if( $education_name ):
                    $output .='<span class="text-uppercase display-block letter-spacing-2 margin-five no-margin-top" '.$education_name_color.'>'.$education_name.'</span>';
                endif;
                if( $content ):
                    $output .='<p '.$hcode_content_color.'>'.do_shortcode( $content ).'</p>';
                endif;
                if($button_title):
                    $output .='<span class="result text-uppercase white-text font-weight-600 letter-spacing-1 bg-black text-white">'.$button_title.'</span>';
                endif;
            $output .='</div>';
        $output .='</div>';
        return $output;
    }
}
add_shortcode( 'hcode_education_slide_content', 'hcode_education_slide_content_shortcode' );
?>