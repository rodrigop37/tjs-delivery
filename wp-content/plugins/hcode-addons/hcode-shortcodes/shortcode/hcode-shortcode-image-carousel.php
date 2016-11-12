<?php
/**
 * Shortcode For OWL Slider
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* OWL Slider */
/*-----------------------------------------------------------------------------------*/

$hcode_slider_parent_type='';
if ( ! function_exists( 'hcode_image_carousel_shortcode' ) ) {
    function hcode_image_carousel_shortcode( $atts, $content = null ) {
    		extract( shortcode_atts( array(
                    'show_pagination' => '',
                    'show_pagination_style' => '',
                    'show_navigation' => '',
                    'show_navigation_style' => '',
                    'show_pagination_color_style' => '',
                    'hcode_image_carousel_itemsdesktop' => '3',
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
    		$pagination = hcode_owl_pagination_slider_classes($show_pagination_style);
            $pagination_style = hcode_owl_pagination_color_classes($show_pagination_color_style);
    	    $navigation = ( $show_navigation_style ) ? hcode_owl_navigation_slider_classes( $show_navigation_style) : hcode_owl_navigation_slider_classes('default') ;
    	    $hcode_slider_id = ( $hcode_slider_id ) ? $hcode_slider_id : 'image-owl-slider';
            $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' cursor-black';
    		$hcode_slider_class  = ( $hcode_slider_class ) ? ' '.$hcode_slider_class : '';
            $output .= '<div class="blog-slider">';
                $output .= '<div id="'.$hcode_slider_id.'" class="owl-pagination-bottom owl-carousel owl-theme'.$pagination.$pagination_style.$navigation.$hcode_slider_class.$show_cursor_color_style.'">';
                    $output .= do_shortcode($content);
                $output .= '</div>';
            $output .= '</div>';
            	
            /* Add custom script Start*/
            $slidespeed = ( $slidespeed ) ? $slidespeed : '3000'; 
            ( $show_navigation == 1 ) ? $slider_config .= 'navigation: true,' : $slider_config .= 'navigation: false,';
        	( $show_pagination == 1 ) ? $slider_config .= 'pagination: true,' : $slider_config .= 'pagination: false,';
        	( $hcode_image_carousel_autoplay == 1 ) ? $slider_config .= 'autoPlay: '.$slidespeed.',' : $slider_config .= 'autoPlay: false,';
            ( $stoponhover == 1) ? $slider_config .= 'stopOnHover: true, ' : $slider_config .= 'stopOnHover: false, ';
            ( $hcode_image_carousel_itemsdesktop ) ? $slider_config .= 'items: '.$hcode_image_carousel_itemsdesktop.',' : $slider_config .= 'items: 3,';
            ( $hcode_image_carousel_itemsdesktop ) ? $slider_config .= 'itemsDesktop: [1200,'.$hcode_image_carousel_itemsdesktop.'],' : $slider_config .= 'itemsDesktop: [1200, 3],';
            ( $hcode_image_carousel_itemstablet ) ? $slider_config .= 'itemsTablet: [991,'.$hcode_image_carousel_itemstablet.'],' : $slider_config .= 'itemsTablet: [991, 2],';
            ( $hcode_image_carousel_itemsmobile ) ? $slider_config .= 'itemsMobile: [700,'.$hcode_image_carousel_itemsmobile.'],' : $slider_config .= 'itemsMobile: [700, 1],';
        	$slider_config .= 'navigationText: ["<i class=\'fa fa-angle-left\'></i>", "<i class=\'fa fa-angle-right\'></i>"]';

        	ob_start();?>
        	<script type="text/javascript"> jQuery(document).ready(function () { jQuery("<?php echo '#'.$hcode_slider_id;?>").owlCarousel({	<?php echo $slider_config;?> }); }); </script>
        	<?php 
        	$script = ob_get_contents();
        	ob_end_clean();
        	$output .= $script;
        	/* Add custom script End*/
            return $output;
    }
}
add_shortcode( 'hcode_image_carousel', 'hcode_image_carousel_shortcode' );

if ( ! function_exists( 'hcode_image_carousel_content_shortcode' ) ) {
    function hcode_image_carousel_content_shortcode( $atts, $content = null) {
    	global $hcode_slider_parent_type;
        extract( shortcode_atts( array(
                    'id' => '',
                    'class' => '',
                    'hcode_image_carousel_content_image' => '',
                    'hcode_image_carousel_content_image_url' => '#',
                    'hcode_image_carousel_content_image_url_target_blank' => '',
                ), $atts ) );
        $output = '';
        ob_start();
        $id = ( $id ) ? ' id="'.$id.'"' : '';
    	$class = ( $class ) ? ' '.$class : '';
        $hcode_image_carousel_content_image = ( $hcode_image_carousel_content_image ) ? $hcode_image_carousel_content_image : '';
        $thumb = wp_get_attachment_image_src($hcode_image_carousel_content_image, 'full');
        $hcode_image_carousel_content_image_url = ( $hcode_image_carousel_content_image_url ) ? $hcode_image_carousel_content_image_url : '';
        $hcode_image_carousel_content_image_url_target_blank = ( $hcode_image_carousel_content_image_url_target_blank == 1 ) ? ' target="_blank"' : ' target="_self"';

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($hcode_image_carousel_content_image);
        $img_title = hcode_option_image_title($hcode_image_carousel_content_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';
        
        if( $thumb[0] ):
            $output .='<div class="item">';
            if( $hcode_image_carousel_content_image_url ) {
                $output .='<a href="'.$hcode_image_carousel_content_image_url.'"'.$hcode_image_carousel_content_image_url_target_blank.'>';
            }
            $output .='<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'" >';
            if( $hcode_image_carousel_content_image_url ) {
                $output .='</a>';
            }
            $output .='</div>';
        endif;
        	
        return $output;
    }
}
add_shortcode( 'hcode_image_carousel_content', 'hcode_image_carousel_content_shortcode' );
?>