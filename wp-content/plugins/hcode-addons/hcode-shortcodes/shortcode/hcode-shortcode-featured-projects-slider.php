<?php
/**
 * Shortcode For Feature Project Slider
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Feature Project Slider */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_architecture_featured_projects_slider_shortcode' ) ) {
    function hcode_architecture_featured_projects_slider_shortcode( $atts, $content = null ) {
    		extract( shortcode_atts( array(
                    'show_pagination' => '',
                    'show_pagination_style' => '',
                    'show_navigation' => '',
                    'show_navigation_style' => '',
                    'show_pagination_color_style' => '',
                    'show_cursor_color_style' => '',
                    'hcode_image_carousel_itemsdesktop' => '4',
                    'hcode_image_carousel_itemstablet' => '3',
                    'hcode_image_carousel_itemsmobile' => '1',
                    'hcode_image_carousel_autoplay' => '',
                    'hcode_slider_id' => '',
                    'hcode_slider_class' => '',
                    'stoponhover' => '',
                    'slidespeed' => '3000',
            ), $atts ) );

            $output = $slider_config = '';
            $navigation = ( $show_navigation_style ) ? hcode_owl_navigation_slider_classes( $show_navigation_style) : hcode_owl_navigation_slider_classes('default') ;
            $pagination = hcode_owl_pagination_slider_classes($show_pagination_style);
            $pagination_style = hcode_owl_pagination_color_classes($show_pagination_color_style);
            $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' black-cursor';
            $hcode_slider_id = ( $hcode_slider_id ) ? $hcode_slider_id : 'architecture-feature-project-slider';
            $hcode_slider_class  = ( $hcode_slider_class ) ? ' '.$hcode_slider_class : '';

            $output .= '<div class="architecture-feature-slider feature-project-slider position-relative">';
                $output .= '<div class="container">';
                    $output .= '<div class="row">';
                        $output .= '<div id="'.$hcode_slider_id.'" class="owl-pagination-bottom owl-carousel owl-theme'.$pagination.$navigation.$pagination_style.$navigation.$hcode_slider_class.$show_cursor_color_style.'">';
                            $output .= do_shortcode($content);
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
                // For Navigation
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
    <script type="text/javascript">jQuery(document).ready(function () { jQuery("<?php echo '#'.$hcode_slider_id;?>").owlCarousel({ <?php echo $slider_config;?> }); });</script> 
    <?php 
    $script = ob_get_contents();
    ob_end_clean();
    $output .= $script;
    /* Add custom script End*/

    return $output;
    }
}
add_shortcode( 'hcode_architecture_featured_projects_slider', 'hcode_architecture_featured_projects_slider_shortcode' );
 
if ( ! function_exists( 'hcode_architecture_featured_projects_slide_content_shortcode' ) ) {
    function hcode_architecture_featured_projects_slide_content_shortcode( $atts, $content = null) {
    	global $hcode_slider_parent_type;
    	
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'slide_image' => '',
            'title' => '',
            'hcode_title_color' => '',
            'img_url' => '',
        ), $atts ) );
        $output = '';
        ob_start();

        $title = ( $title ) ? $title : '';
        $slide_image = ( $slide_image ) ? $slide_image : '';
        $hcode_title_color = ( $hcode_title_color ) ? 'style="color:'.$hcode_title_color.';"' : '';
        $id = ( $id ) ? $id : '';
    	$class = ( $class ) ? ' '.$class : '';
        $img_url = ( $img_url ) ? $img_url : '';
        $thumb = wp_get_attachment_image_src($slide_image, 'full');

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($slide_image);
        $img_title = hcode_option_image_title($slide_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';

        if( $thumb[0] || $title ):
            $output .= '<div class="item'.$class.'"'.$id .'>';
                if( $thumb[0] ):
                    $output .='<a href="'.$img_url.'"><img src="'.$thumb[0].'" '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'"></a>';
                endif;
                if( $title ):
                    $output .='<h5 class="margin-ten no-margin-bottom xs-margin-top-five" '.$hcode_title_color.'>'.$title.'</h5>';
                endif;
            $output .= '</div>';
        endif;
        return $output;
    }
}
add_shortcode( 'hcode_architecture_featured_projects_slide_content', 'hcode_architecture_featured_projects_slide_content_shortcode' );
?>