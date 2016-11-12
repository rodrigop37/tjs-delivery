<?php
/**
 * Shortcode For Restaurant Menu Slider
 *
 * @package H-Code
 */
?>
<?php 
/*-----------------------------------------------------------------------------------*/
/* Restaurant Menu Slider */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'hcode_restaurant_menu_shortcode' ) ) {
    function hcode_restaurant_menu_shortcode( $atts, $content = null ) {

        extract( shortcode_atts( array(
                    'show_pagination' => '',
                    'show_pagination_style' => '',
                    'show_navigation' => '',
                    'show_navigation_style' => '',
                    'transition_style' => '',
                    'show_pagination_color_style' => '',
                    'autoplay' => '',
                    'stoponhover' => '',
                    'slidespeed' => '3000',
                    'addclassactive' => '',
                    'hcode_slider_id' => '',
                    'hcode_slider_class' => '',
                ), $atts ) );
        
        $output  = $slider_config = $slider_id ='';
        $transition_style           = ( $transition_style ) ? $transition_style : '';
        $pagination = ($show_pagination_style) ? hcode_owl_pagination_slider_classes($show_pagination_style) : hcode_owl_pagination_slider_classes('default');
        $pagination_style = ($show_pagination_color_style) ? hcode_owl_pagination_color_classes($show_pagination_color_style) : hcode_owl_pagination_color_classes('default');
        $navigation = ( $show_navigation_style ) ? hcode_owl_navigation_slider_classes( $show_navigation_style) : hcode_owl_navigation_slider_classes('default') ;

        /* Check if Slider Id and Class */
        $hcode_slider_id = ( $hcode_slider_id ) ? $slider_id = $hcode_slider_id : $slider_id = 'hcode-restaurent-menu';
        $hcode_slider_class = ( $hcode_slider_class ) ? $hcode_slider_class : '';

        $output .= '<div id="'.$slider_id.'" class="col-xs-12 no-padding bottom-pagination position-relative '.$hcode_slider_class.$pagination.$pagination_style.$navigation.'">';
                $output .= do_shortcode($content);
        $output .= '</div>';

        /* Add custom script Start*/
        $slidespeed = ( $slidespeed ) ? $slidespeed : '3000'; 
        ( $show_navigation == 1 ) ? $slider_config .= 'navigation: true,' : $slider_config .= 'navigation: false,';
    	( $show_pagination == 1 ) ? $slider_config .= 'pagination: true,' : $slider_config .= 'pagination: false,';
    	( $transition_style && $transition_style != 'slide') ? $slider_config .= 'transitionStyle: "'.$transition_style .'",' : '';
    	( $autoplay == 1 ) ? $slider_config .= 'autoPlay: '.$slidespeed.',' : $slider_config .= 'autoPlay: false,';
    	( $stoponhover == 1) ? $slider_config .= 'stopOnHover: true, ' : $slider_config .= 'stopOnHover: false, ';
    	( $addclassactive == 1) ? $slider_config .= 'addClassActive: true, ' : $slider_config .= 'addClassActive: false, ';
    	$slider_config .= 'singleItem: true,';
    	$slider_config .= 'paginationSpeed: 400,';
    	$slider_config .= 'navigationText: ["<i class=\'fa fa-angle-left\'></i>", "<i class=\'fa fa-angle-right\'></i>"]';
    	ob_start();?>
        <script type="text/javascript">jQuery(document).ready(function () { jQuery("<?php echo '#'.$slider_id;?>").owlCarousel({ <?php echo $slider_config;?> }); }); </script>
    	<?php 
    	$script = ob_get_contents();
    	ob_end_clean();
                
        $output .= $script;
    	/* Add custom script End*/
        return $output;
    }
}
add_shortcode( 'hcode_restaurant_menu', 'hcode_restaurant_menu_shortcode' );

if ( ! function_exists( 'hcode_restaurant_menu_slide_content_shortcode' ) ) {
    function hcode_restaurant_menu_slide_content_shortcode( $atts, $content = null) {
        global $hcode_testimonial_parent_type;
        
        extract( shortcode_atts( array(
                    'image' => '',
                    'title' => '',
                    'subtitle' => '',
                    'content_image' => '',
                ), $atts ) );
        $output = '';
        $title        = ( $title ) ? $title : '';   

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($content_image);
        $img_title = hcode_option_image_title($content_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';
        
        $thumb = wp_get_attachment_image_src($image, 'full');
        $content_image = wp_get_attachment_image_src($content_image, 'full');
        if( $thumb[0] || $content || $title || $content_image[0] || $subtitle):
        $output .='<div class="item">';
            $output .='<div class="col-md-6 restaurant-menu-img cover-background" style="background-image:url('.$thumb[0].');">';
            $output .='<div class="img-border"></div>';
            $output .='<div class="opacity-full bg-dark-gray"></div>';
                $output .='<div class="popular-dishes">';
                    if($content_image[0]):
                        $output .='<img src="'.$content_image[0].'" width="'.$content_image[1].'" height="'.$content_image[2].'" '.$image_alt.$image_title.'/><br>';
                    endif;
                    if($title):
                        $output .='<span class="title-small white-text text-uppercase letter-spacing-3">'.$title.'</span><br>';
                    endif;
                    if($subtitle):
                        $output .='<span class="food-time text-small white-text display-inline-block text-uppercase letter-spacing-2">'.$subtitle.'</span>';
                    endif;
                $output .='</div>';

            $output .='</div>';
            if($content):
                $output .='<div class="col-md-6 bg-white restaurant-menu-text-main margin-three no-margin-top">';
                    $output .='<div class="restaurant-menu-text">';
                        $output .= do_shortcode( hcode_remove_wpautop($content) );
                    $output .='</div>';
                $output .='</div>';
            endif;
        $output .='</div>';
        endif;
        return $output;
    }
}
add_shortcode( 'hcode_restaurant_menu_slide_content', 'hcode_restaurant_menu_slide_content_shortcode' );
?>