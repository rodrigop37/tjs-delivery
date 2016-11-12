<?php
/**
 * Shortcode For Testimonial
 *
 * @package H-Code
 */
?>
<?php 
/*-----------------------------------------------------------------------------------*/
/* Testimonial */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'hcode_testimonial_shortcode' ) ) {
    function hcode_testimonial_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
                    'show_blog_slider_style' => '',
                    'show_pagination' => '',
                    'show_pagination_style' => '',
                    'show_pagination_color_style' => '',
                    'show_cursor_color_style' => '',
                    'hcode_image_carousel_itemsdesktop' => '3',
                    'hcode_image_carousel_itemstablet' => '3',
                    'hcode_image_carousel_itemsmobile' => '1',
                    'hcode_image_carousel_autoplay' => '',
                    'hcode_slider_id' => '',
                    'hcode_slider_class' => '',
                    'hcode_image_carousel_singleitem' => '',
                    'stoponhover' => '',
                    'slidespeed' => '3000',
                ), $atts ) );

            $output = $slider_config = $blog_post = '';
            global $hcode_slider_parent_type;
            $hcode_slider_parent_type = $show_blog_slider_style;
            $pagination = hcode_owl_pagination_slider_classes($show_pagination_style);
            $pagination_style = hcode_owl_pagination_color_classes($show_pagination_color_style);
            $hcode_slider_id = ( $hcode_slider_id ) ? $hcode_slider_id : 'hcode-testimonial';
            $hcode_slider_class  = ( $hcode_slider_class ) ? ' '.$hcode_slider_class : '';
            $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' cursor-black';
            $output .= '<div class="testimonial-slider position-relative no-transition">';
                $output .= '<div id="'.$hcode_slider_id.'" class="owl-pagination-bottom position-relative '.$hcode_slider_class.$pagination.$pagination_style.$show_cursor_color_style.'">';
                                $output .= do_shortcode($content);
                $output .= '</div>';            
            $output .= '</div>';
                             
        /* Add custom script Start*/
        $slidespeed = ( $slidespeed ) ? $slidespeed : '3000'; 
        ( $show_pagination == 1 ) ? $slider_config .= 'pagination: true,' : $slider_config .= 'pagination: false,';
        ( $hcode_image_carousel_singleitem ) ? $slider_config .= 'singleItem: true,' : '';
        ( $hcode_image_carousel_autoplay == 1 ) ? $slider_config .= 'autoPlay: '.$slidespeed.',' : $slider_config .= 'autoPlay: false,';
        ( $stoponhover == 1) ? $slider_config .= 'stopOnHover: true, ' : $slider_config .= 'stopOnHover: false, ';
        ( $hcode_image_carousel_itemsdesktop ) ? $slider_config .= 'items: '.$hcode_image_carousel_itemsdesktop.',' : $slider_config .= 'items: 3,';
        ( $hcode_image_carousel_itemsdesktop ) ? $slider_config .= 'itemsDesktop: [1200,'.$hcode_image_carousel_itemsdesktop.'],' : $slider_config .= 'itemsDesktop: [1200, 3],';
        ( $hcode_image_carousel_itemstablet ) ? $slider_config .= 'itemsTablet: [800,'.$hcode_image_carousel_itemstablet.'],' : $slider_config .= 'itemsTablet: [800, 2],';
        ( $hcode_image_carousel_itemsmobile ) ? $slider_config .= 'itemsMobile: [700,'.$hcode_image_carousel_itemsmobile.'],' : $slider_config .= 'itemsMobile: [700, 1],';
        $slider_config .= 'navigationText: ["<i class=\'fa fa-angle-left\'></i>", "<i class=\'fa fa-angle-right\'></i>"]';

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
add_shortcode( 'hcode_testimonial', 'hcode_testimonial_shortcode' );

if ( ! function_exists( 'hcode_testimonial_slide_content_shortcode' ) ) {
    function hcode_testimonial_slide_content_shortcode( $atts, $content = null) {
    	global $hcode_testimonial_parent_type;
        extract( shortcode_atts( array(
                    'image' => '',
                    'title' => '',
                    'hcode_title_color' => '',
                    'hcode_icon_color' => '',
                    'hcode_icon' => '',
                    'hcode_icon_size' => '',
                ), $atts ) );
        $output = '';
        ob_start();
        $title        = ( $title ) ? $title : '';  
        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($image);
        $img_title = hcode_option_image_title($image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';
         
        $thumb = wp_get_attachment_image_src($image, 'full');
        $hcode_title_color = ($hcode_title_color) ? 'style="color:'.$hcode_title_color.'"' : '';
        $hcode_icon_color = ($hcode_icon_color) ? 'style="color:'.$hcode_icon_color.'"' : '';
        $hcode_icon_size = ( $hcode_icon_size ) ? $hcode_icon_size : '';
        if( $thumb[0] || $content || $title ):
                $output .= '<div class="col-md-12 col-sm-12 col-xs-12 testimonial-style2 center-col text-center margin-three no-margin-top">';
                if( $thumb[0] ):
                    $output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
                endif;
                if( $content ):
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
                if( $title ):
                    $output .= '<span class="name light-gray-text2" '.$hcode_title_color.'>'.$title.'</span>';
                endif;
                if($hcode_icon == 1):
                    $output .= '<i class="fa fa-quote-left '.$hcode_icon_size.' display-block margin-five no-margin-bottom" '.$hcode_icon_color.'></i>';
                endif;
            $output .= '</div>';
        endif;        
        return $output;
    }
}
add_shortcode( 'hcode_testimonial_slide_content', 'hcode_testimonial_slide_content_shortcode' );
?>