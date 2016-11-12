<?php
/**
 * Shortcode For Spa Package Slider
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Spa Package Slider */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_spa_packages_slider_shortcode' ) ) {
    function hcode_spa_packages_slider_shortcode( $atts, $content = null ) {
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
            $hcode_slider_id = ( $hcode_slider_id ) ? $hcode_slider_id : 'spa-package-owl-slider';
            $hcode_slider_class  = ( $hcode_slider_class ) ? ' '.$hcode_slider_class : '';
            $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' cursor-black';
            $output .= '<div class="spa-our-packages-owl position-relative">';
                $output .= '<div class="container">';
                    $output .= '<div class="row">';
                        $output .= '<div id="'.$hcode_slider_id.'" class="owl-pagination-bottom owl-carousel spa-our-packages owl-theme'.$show_cursor_color_style.$pagination.$navigation.$pagination_style.$navigation.$hcode_slider_class.'">';
                            $output .= do_shortcode($content);
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
                if( $show_navigation == 1 ):
                    if($show_navigation_style == 1):
                        $output .= '<div class="feature_nav">';
                            $output .= '<a class="prev left carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre.png" width="96" height="96"></a>';
                            $output .= '<a class="next right carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next.png" width="96" height="96"></a>';
                        $output .= '</div>';
                    else:
                        $output .= '<div class="feature_nav">';
                            $output .= '<a class="prev left carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-white-bg.png" width="96" height="96"></a>';
                            $output .= '<a class="next right carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-white-bg.png" width="96" height="96"></a>';
                        $output .= '</div>';
                    endif;
                endif;
            $output .= '</div>';
            	
        /* Add custom script Start*/
        //( $show_navigation == 1 ) ? $slider_config .= 'navigation: true,' : $slider_config .= 'navigation: false,';
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
add_shortcode( 'hcode_spa_packages_slider', 'hcode_spa_packages_slider_shortcode' );

if ( ! function_exists( 'hcode_spa_slide_content_shortcode' ) ) {
    function hcode_spa_slide_content_shortcode( $atts, $content = null) {
    	global $hcode_slider_parent_type;
    	
        extract( shortcode_atts( array(
                    'id' => '',
                    'class' => '',
                    'slide_image' => '',
                    'title' => '',
                    'price_text' => '',
                    'hcode_show_separator' => '',
                    'grade_button' => '',
                    'hcode_title_color' => '',
                ), $atts ) );
        $output = '';
        ob_start();
        $title = ( $title ) ? $title : '';
        $price_text =( $price_text ) ? $price_text : '';
        $slide_image = ( $slide_image ) ? $slide_image : '';
        $hcode_title_color = ( $hcode_title_color ) ? 'style="color:'.$hcode_title_color.' !important;"' : '';
        $id = ( $id ) ? 'id='.$id.'' : '';
    	$class = ( $class ) ? ' '.$class : '';
        if (function_exists('vc_parse_multi_attribute')) {
            // For Button
            $button_parse_args = vc_parse_multi_attribute($grade_button);
            $button_link     = ( isset($button_parse_args['url']) ) ? $button_parse_args['url'] : '#';
            $button_title    = ( isset($button_parse_args['title']) ) ? $button_parse_args['title'] : '';
            $button_target   = ( isset($button_parse_args['target']) ) ? trim($button_parse_args['target']) : '_self'; 
        }

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($slide_image);
        $img_title = hcode_option_image_title($slide_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';
        
        $thumb = wp_get_attachment_image_src($slide_image, 'full');
        $output .='<div class="item">';
            $output .='<div '.$id.' class="col-md-12 sm-margin-bottom-ten '.$class.'">';
                if($thumb[0]):
                    $output .='<img src="'.$thumb[0].'" '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'">';
                endif;
                $output .='<div class="content-box bg-white">';
                    if($title):
                        $output .='<p class="black-text margin-ten no-margin text-med text-uppercase letter-spacing-2 font-weight-600 no-margin" '.$hcode_title_color.'>'.$title.'</p>';
                    endif;
                    if($price_text):
                        $output .='<p class="text-med text-uppercase letter-spacing-1 no-margin">'.$price_text.'</p>';
                    endif;
                    if($hcode_show_separator == 1):
                        $output .='<div class="thin-separator-line bg-black no-margin-lr"></div>';
                    endif;
                    if($content):
                        $output .='<p>'.do_shortcode( $content ).'</p>';
                    endif;
                    if($button_title || $button_link || $button_target):
                        $output .='<a class="btn inner-link btn-black btn-small no-margin" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                    endif;
                $output .='</div>';
            $output .='</div>';
        $output .='</div>';
        return $output;
    }
}
add_shortcode( 'hcode_spa_slide_content', 'hcode_spa_slide_content_shortcode' );
?>