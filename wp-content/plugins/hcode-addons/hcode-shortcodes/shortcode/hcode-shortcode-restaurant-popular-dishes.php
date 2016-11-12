<?php
/**
 * Shortcode For Popular Dishes Slider
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Popular Dishes Slider */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_restaurant_popular_dish_slider_shortcode' ) ) {
    function hcode_restaurant_popular_dish_slider_shortcode( $atts, $content = null ) {

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
                    'stoponhover' => '',
                    'slidespeed' => '3000',
                    'hcode_slider_id' => '',
                    'hcode_slider_class' => '',
                ), $atts ) );
            $output = $slider_config = '';
            $navigation = ( $show_navigation_style ) ? hcode_owl_navigation_slider_classes( $show_navigation_style) : hcode_owl_navigation_slider_classes('default') ;
            $pagination = hcode_owl_pagination_slider_classes($show_pagination_style);
            $pagination_style = hcode_owl_pagination_color_classes($show_pagination_color_style);
            $hcode_slider_id = ( $hcode_slider_id ) ? $hcode_slider_id : 'restaurant-popular-dish';
            $hcode_slider_class  = ( $hcode_slider_class ) ? ' '.$hcode_slider_class : '';
            $output .= '<div class="restaurant-popular-dish-owl position-relative">';
                $output .= '<div class="container">';
                    $output .= '<div class="row">';   
                        $output .= '<div id="'.$hcode_slider_id.'" class="owl-pagination-bottom owl-carousel owl-theme'.$pagination.$navigation.$pagination_style.$navigation.$hcode_slider_class.'">';
                            $output .= do_shortcode($content);
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
                if( $show_navigation == 1 ):
                    if($show_navigation_style == 1):
                        $output .= '<div class="feature_nav">';
                            $output .= '<a class="prev left carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre.png" width="96" height="96"></a>';
                            $output .= '<a class="next right carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next.png" width="96" height="96" ></a>';
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
add_shortcode( 'hcode_restaurant_popular_dish_slider', 'hcode_restaurant_popular_dish_slider_shortcode' );

if ( ! function_exists( 'hcode_restaurant_popular_dish_slide_content_shortcode' ) ) {
    function hcode_restaurant_popular_dish_slide_content_shortcode( $atts, $content = null) {
    	global $hcode_slider_parent_type;
    	
        extract( shortcode_atts( array(
                    'id' => '',
                    'class' => '',
                    'slide_image' => '',
                    'title' => '',
                    'price_text' => '',
                    'hcode_show_separator' => '',
                    'hcode_title_color' => '',
                    'hcode_content_color' => '',
                ), $atts ) );
        $output = '';
        ob_start();
        $title        = ( $title ) ? $title : '';
        $price_text =( $price_text ) ? $price_text : '';
        $slide_image = ( $slide_image ) ? $slide_image : '';
        $hcode_title_color = ( $hcode_title_color ) ? 'style="color:'.$hcode_title_color.';"' : '';
        $hcode_content_color = ( $hcode_content_color ) ? 'style="color:'.$hcode_content_color.';"' : '';
        $id        = ( $id ) ? $id : '';
    	$class     = ( $class ) ? ' '.$class : '';

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($slide_image);
        $img_title = hcode_option_image_title($slide_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';
        
        $thumb = wp_get_attachment_image_src($slide_image, 'full');

        $output .='<div class="col-md-12 col-sm-12 special-dishes xs-margin-bottom-ten">';
            $output .='<div class="position-relative">';
                if($thumb[0]):
                    $output .='<img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'>';
                endif;
                if($price_text):
                    $output .='<span class="special-dishes-price bg-light-yellow red-text alt-font">'.$price_text.'</span>';
                endif;
            $output .='</div>';
            if($hcode_title_color || $title):
                $output .='<p class="text-uppercase letter-spacing-2 font-weight-600 margin-ten no-margin-bottom" '.$hcode_title_color.'>'.$title.'</p>';
            endif;
            if($hcode_content_color || $content):
                $output .='<p class="margin-two text-med width-90" '.$hcode_content_color.'>'.do_shortcode( $content ).'</p>';
            endif;
            if($hcode_show_separator == 1):
                $output .='<div class="thin-separator-line bg-dark-gray no-margin-lr"></div>';
            endif;
        $output .='</div>';
        return $output;
    }
}
add_shortcode( 'hcode_restaurant_popular_dish_slide_content', 'hcode_restaurant_popular_dish_slide_content_shortcode' );
?>