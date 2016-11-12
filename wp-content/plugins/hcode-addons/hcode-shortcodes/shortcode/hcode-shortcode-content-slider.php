<?php
/**
 * Shortcode For Content Slider
 *
 * @package H-Code
 */
?>
<?php 
/*-----------------------------------------------------------------------------------*/
/* Content Slider */
/*-----------------------------------------------------------------------------------*/

$hcode_slider_parent_type='';
if ( ! function_exists( 'hcode_content_slider_shortcode' ) ) {
    function hcode_content_slider_shortcode( $atts, $content = null ) {

        extract( shortcode_atts( array(
                'slider_content_premade_style' => '',
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
                'show_cursor_color_style' => '',
            ), $atts ) );
        $output  = $slider_config = $slider_id ='';
        $slider_content_premade_style       = ( $slider_content_premade_style ) ? $slider_content_premade_style : '';
        $transition_style           = ( $transition_style ) ? $transition_style : 'slide';
        $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' cursor-black';
        global $hcode_slider_parent_type;
    	$hcode_slider_parent_type = $slider_content_premade_style;

    	$pagination = ($show_pagination_style) ? hcode_owl_pagination_slider_classes($show_pagination_style) : hcode_owl_pagination_slider_classes('default');
    	$pagination_style = ($show_pagination_color_style) ? hcode_owl_pagination_color_classes($show_pagination_color_style) : hcode_owl_pagination_color_classes('default');

        $navigation = ( $show_navigation_style ) ? hcode_owl_navigation_slider_classes( $show_navigation_style) : hcode_owl_navigation_slider_classes('default') ;

        /* Check if slider id and class */
        $hcode_slider_id = ( $hcode_slider_id ) ? $slider_id = $hcode_slider_id : $slider_id = $slider_content_premade_style;
        $hcode_slider_class = ( $hcode_slider_class ) ? $hcode_slider_class : '';

        switch ($slider_content_premade_style) {

            case 'hcode-owl-content-slider1':
                	$output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$show_cursor_color_style.$hcode_slider_class.$pagination.$pagination_style.$navigation.' main-slider '.$hcode_slider_class.'">';
                    	$output .= do_shortcode($content);
                    $output .= '</div>';
                $slidespeed = ( $slidespeed ) ? $slidespeed : '3000';     
                ( $transition_style && $transition_style != 'slide') ? $slider_config .= 'transitionStyle: "'.$transition_style .'",' : '';
                ( $autoplay == 1 ) ? $slider_config .= 'autoPlay: '.$slidespeed.',' : $slider_config .= 'autoPlay: false,';
                ( $stoponhover == 1) ? $slider_config .= 'stopOnHover: true, ' : $slider_config .= 'stopOnHover: false, ';
                ( $addclassactive == 1) ? $slider_config .= 'addClassActive: true, ' : $slider_config .= 'addClassActive: false, ';
            break;

            case 'hcode-bootstrap-content-slider1':
                $output .= '<div id="'.$slider_id.'" class="carousel slide no-padding '.$pagination.$pagination_style.$navigation.' carousel-'.$transition_style.' '.$hcode_slider_class.'">';
                    if($show_pagination && $show_pagination == 1){
                        // Slider Indicators Start
                        ($show_pagination_style == 1) ? $pagination_class = ' arrow-style-line' : $pagination_class = '';
                        $output .= '<ol class="carousel-indicators'.$pagination_class.'">';
                        $output .= hcode_bootstrap_content_slider_pagination($content, $slider_id);
                        $output .= '</ol>';
                        // Slider Indicators End
                    }
                $output .= '<div class="carousel-inner">';
                $output .= do_shortcode($content);
                $output .= '</div>';

                if($show_navigation && $show_navigation == 1){
                    // Slider Next / Previous Start
                    if($show_navigation_style == 1){
                        $output .= '<a class="left carousel-control" href="#'.$slider_id.'" data-slide="prev"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-white-bg.png" alt="" width="96" height="96" /></a>';
                        $output .= '<a class="right carousel-control" href="#'.$slider_id.'" data-slide="next"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-white-bg.png" alt="" width="96" height="96" /></a>';
                    }else{
                        $output .= '<a class="left carousel-control" href="#'.$slider_id.'" data-slide="prev"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre.png" alt="" width="96" height="96" /></a>';
                        $output .= '<a class="right carousel-control" href="#'.$slider_id.'" data-slide="next"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-next.png" alt="" width="96" height="96" /></a>';                                      
                    }
                    // Slider Next / Previous End
                }
                $output .= '</div>';
            break;

            case 'hcode-bootstrap-content-slider2':
                $output .= '<div id="'.$slider_id.'" class="carousel slide spa-case-study carousel-'.$pagination.$pagination_style.$navigation.' '.$hcode_slider_class.'">';
                    if($show_pagination && $show_pagination == 1){
                        // Slider Indicators Start
                        ($show_pagination_style == 1) ? $pagination_class = ' arrow-style-line' : $pagination_class = '';
                        $output .= '<ol class="carousel-indicators'.$pagination_class.'">';
                        $output .= hcode_bootstrap_content_slider_pagination($content, $slider_id);
                        $output .= '</ol>';
                        // Slider Indicators Start
                    }
                $output .= '<div class="carousel-inner">';
                $output .= do_shortcode($content);
                $output .= '</div>';

                if($show_navigation && $show_navigation == 1){
                    // Slider Next / Previous Start
                    if($show_navigation_style == 1){
                        $output .= '<a class="left carousel-control" href="#'.$slider_id.'" data-slide="prev"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-white-bg.png" alt="" width="96" height="96" /></a>';
                        $output .= '<a class="right carousel-control" href="#'.$slider_id.'" data-slide="next"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-white-bg.png" alt="" width="96" height="96" /></a>';
                    }else{
                        $output .= '<a class="left carousel-control" href="#'.$slider_id.'" data-slide="prev"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre.png" alt="" width="96" height="96" /></a>';
                        $output .= '<a class="right carousel-control" href="#'.$slider_id.'" data-slide="next"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-next.png" alt="" width="96" height="96" /></a>';                                      
                    }
                    // Slider Next / Previous End
                }
                $output .= '</div>';
            break;
            
            case 'hcode-bootstrap-content-slider3':
                $output .= '<div id="'.$slider_id.'" class="carousel slide carousel-'.$pagination.$pagination_style.$navigation.' '.$hcode_slider_class.'">';
                    if($show_pagination && $show_pagination == 1){
                        // Slider Indicators Start
                        ($show_pagination_style == 1) ? $pagination_class = ' arrow-style-line' : $pagination_class = '';
                        $output .= '<ol class="carousel-indicators'.$pagination_class.'">';
                        $output .= hcode_bootstrap_content_slider_pagination($content, $slider_id);
                        $output .= '</ol>';
                        // Slider Indicators End
                    }

                $output .= '<div class="carousel-inner">';
                $output .= do_shortcode($content);
                $output .= '</div>';

                if($show_navigation && $show_navigation == 1){
                    // Slider Next / Previous Start
                    if($show_navigation_style == 1){
                        $output .= '<a class="left carousel-control" href="#'.$slider_id.'" data-slide="prev"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-white-bg.png" alt="" width="96" height="96" /></a>';
                        $output .= '<a class="right carousel-control" href="#'.$slider_id.'" data-slide="next"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-white-bg.png" alt="" width="96" height="96" /></a>';
                    }else{
                        $output .= '<a class="left carousel-control" href="#'.$slider_id.'" data-slide="prev"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre.png" alt="" width="96" height="96" /></a>';
                        $output .= '<a class="right carousel-control" href="#'.$slider_id.'" data-slide="next"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-next.png" alt="" width="96" height="96" /></a>';                                      
                    }
                    // Slider Next / Previous End
                }
                $output .= '</div>';
            break;

        }
        /* Add custom script Start*/
        ( $show_navigation == 1 ) ? $slider_config .= 'navigation: true,' : $slider_config .= 'navigation: false,';
    	( $show_pagination == 1 ) ? $slider_config .= 'pagination: true,' : $slider_config .= 'pagination: false,';
    	$slider_config .= 'singleItem: true,';
    	$slider_config .= 'paginationSpeed: 400,';
    	$slider_config .= 'navigationText: ["<i class=\'fa fa-angle-left\'></i>", "<i class=\'fa fa-angle-right\'></i>"]';

        ob_start();?>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery("<?php echo '#'.$slider_id;?>").owlCarousel({
                    <?php echo $slider_config;?>
                 });
            });
        </script>

        <?php 
        $script = ob_get_contents();
        ob_end_clean();

        // For Bootstrape Slider 
        $bootstrap_slider_config = '';
        $slidespeed = ( $slidespeed ) ? $slidespeed : '3000'; 
        ( $autoplay == 1 ) ? $bootstrap_slider_config .= 'interval: '.$slidespeed.', ' : $bootstrap_slider_config .= 'interval: false, ';
        ( $stoponhover == 1) ? $bootstrap_slider_config .= 'pause: "hover" ' : $bootstrap_slider_config .= 'pause: false, ';
        ob_start();?>
        <script type="text/javascript">jQuery(document).ready(function () { jQuery("<?php echo '#'.$slider_id;?>").carousel({ <?php echo $bootstrap_slider_config; ?> });});</script>
        <?php 
        $script_bootstrap = ob_get_contents();
        ob_end_clean();

    	
        if(in_array($hcode_slider_parent_type, array('hcode-owl-content-slider1'))){
    	   $output .= $script;
        }else{
            $output .= $script_bootstrap;
        }
    	/* Add custom script End*/

        return $output;
    }
}
add_shortcode( 'hcode_content_slider', 'hcode_content_slider_shortcode' );
 

if ( ! function_exists( 'hcode_special_slide_content_shortcode' ) ) {
    function hcode_special_slide_content_shortcode( $atts, $content = null) {
    	global $hcode_slider_parent_type;
    	
        extract( shortcode_atts( array(
        			'hcode_content_slider_image' => '',
                    'hcode_content_discount_image' => '',
                    'hcode_content_slider_number' => '',
                    'hcode_content_slider_title' => '',
                    'hcode_content_slider_subtitle' => '',
                    'button_config' => '',
                    'number_color' => '',
                    'title_color' => '',
                    'subtitle_color' => '',
                    'content_color' => '',
                ), $atts ) );
        $output = '';
        ob_start();
        
        $hcode_content_slider_image = ( $hcode_content_slider_image ) ? $hcode_content_slider_image : '';
        $hcode_content_discount_image = ( $hcode_content_discount_image ) ? $hcode_content_discount_image : '';
        $hcode_content_slider_number        = ( $hcode_content_slider_number ) ? $hcode_content_slider_number : '';
        $hcode_content_slider_title = ($hcode_content_slider_title) ? $hcode_content_slider_title : '';
        $hcode_content_slider_subtitle = ($hcode_content_slider_subtitle) ? $hcode_content_slider_subtitle : '';
        $thumb = wp_get_attachment_image_src($hcode_content_slider_image, 'full');
        $discount_image = wp_get_attachment_image_src($hcode_content_discount_image, 'full');
        $number_color = ($number_color) ? 'style="color:'.$number_color.' !important;"' : '';
        $title_color = ($title_color) ? 'style="color:'.$title_color.' !important;"' : '';
        $subtitle_color = ($subtitle_color) ? 'style="color:'.$subtitle_color.' !important;"' : '';
        $content_color = ($content_color) ? 'style="color:'.$content_color.' !important;"' : '';
        
        /* Slide button */
        if (function_exists('vc_parse_multi_attribute')) {
            // For Button
            $button_parse_args = vc_parse_multi_attribute($button_config);
            $button_link     = ( isset($button_parse_args['url']) ) ? $button_parse_args['url'] : '#';
            $button_title    = ( isset($button_parse_args['title']) ) ? $button_parse_args['title'] : 'sample button';
            $button_target   = ( isset($button_parse_args['target']) ) ? trim($button_parse_args['target']) : '_self';
        }

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($hcode_content_discount_image);
        $img_title = hcode_option_image_title($hcode_content_discount_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';

        switch($hcode_slider_parent_type){
        	case 'hcode-owl-content-slider1':
    			    $output .= '<div class="item">';
                        if( $thumb[0] ):
                            $output .= '<div class="col-lg-6 col-md-6 case-study-img cover-background" style="background-image:url('.$thumb[0].');"></div>';
                        endif;
    		            $output .= '<div class="col-lg-6 col-md-6 case-study-details">';
                            if( $hcode_content_slider_number || $number_color ):
                                $output .='<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">';
                                $output .= '<span class="about-number alt-font black-text font-weight-400 letter-spacing-2 xs-no-border xs-no-padding-left xs-display-none" '.$number_color.'>'.$hcode_content_slider_number.'</span>';
                                $output .= '</div>';
                            endif;
                            if( $hcode_content_slider_title || $hcode_content_slider_subtitle || content || $button_title ):
                            $output .= '<div class="col-lg-8 col-md-9 col-sm-9 col-xs-12 about-text position-relative xs-text-center">';
                                if( $hcode_content_slider_title ):
                                    $output .= '<p class="title-small text-uppercase letter-spacing-3 black-text font-weight-600 no-margin-bottom" '.$title_color.'>'.$hcode_content_slider_title.'</p>';
                                endif;
                                if( $hcode_content_slider_subtitle || $subtitle_color ):
                                    $output .= '<span class="case-study-work letter-spacing-3" '.$subtitle_color.'>'.$hcode_content_slider_subtitle.'</span>';
                                endif;
                                if( $content ):
                                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                endif;
                                if( $button_title ):
                                    $output .= '<a class="highlight-button-black-border btn btn-small no-margin-bottom sm-no-margin" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                                endif;
                            $output .= '</div>';
                            endif;
                        $output .= '</div>';
        			$output .= '</div>';
        	break;
            case 'hcode-bootstrap-content-slider1':
                $output .= '<div class="item">';    
                    // Set the background image using inline CSS below.
                    if( $thumb[0] ):
                        $output .= '<div style="background-image:url('.$thumb[0].');" class="fill sm-background-image-right"></div>';
                    endif;
                    $output .= '<div class="case-study-slider clearfix">';
                        $output .= '<div class="col-md-6 col-sm-10 col-sm-offset-1 pull-right sm-pull-none">';
                            if( $hcode_content_slider_number || $number_color ):
                                $output .= '<div class="col-md-3 col-sm-12 col-xs-12 xs-no-padding">';
                                    $output .= '<span class="case-study-number alt-font yellow-text font-weight-400 letter-spacing-2 sm-pull-left sm-no-border-right sm-no-padding-left" '.$number_color.'>'.$hcode_content_slider_number.'</span>';
                                $output .= '</div>';
                            endif;
                            $output .= '<div class="col-md-7 col-sm-12 col-xs-12 case-study-text position-relative sm-no-margin-left xs-no-padding">';
                                if( $hcode_content_slider_title ):
                                    $output .= '<p class="title-small text-uppercase letter-spacing-3 white-text no-margin-bottom">';
                                        $output .= '<a href="'.$button_link.'" class="white-text-link" '.$title_color.'>'.$hcode_content_slider_title.'</a>';
                                    $output .= '</p>';
                                endif;
                                if( $hcode_content_slider_subtitle ):
                                    $output .= '<span class="case-study-work light-gray-text letter-spacing-2" '.$subtitle_color.'>'.$hcode_content_slider_subtitle.'</span>';
                                endif;
                                if( $content ):
                                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                endif;
                                if( $button_title ):
                                    $output .= '<a class="btn btn-small-white-background margin-four no-margin-bottom" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                                endif;
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;
            case 'hcode-bootstrap-content-slider2':
                $output .= '<div class="item">';    
                    // Set the first background image using inline CSS below.
                    if( $thumb[0] ):
                        $output .= '<div style="background-image:url('.$thumb[0].');" class="fill"></div>';
                    endif;
                    $output .= '<div class="container case-study-slider">';
                        $output .= '<div class="row position-relative">';
                            $output .= '<div class="col-md-5 col-sm-6 col-xs-12 text-left no-margin-right animated fadeInUp f-right xs-padding-lr-30px">';
                                if( $hcode_content_slider_title || $title_color ):
                                    $output .= '<span class="case-study-title white-text" '.$title_color.'>'.$hcode_content_slider_title.'</span>';
                                endif;
                                if( $hcode_content_slider_subtitle || $subtitle_color ):
                                    $output .= '<span class="case-study-work alt-font white-text" '.$subtitle_color.'>'.$hcode_content_slider_subtitle.'</span>';
                                endif;
                                $output .= '<div class="separator-line bg-yellow no-margin-lr"></div>';
                                if( $content ):
                                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                endif;
                                if( $button_title ):
                                    $output .= '<a class="btn inner-link btn-small-white-background margin-four no-margin-bottom" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                                endif;
                            $output .= '</div>';
                            if( $discount_image[0] ):
                                $output .= '<img '.$image_alt.$image_title.' src="'.$discount_image[0].'" width="'.$discount_image[1].'" height="'.$discount_image[2].'">';
                            endif;
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;
            case 'hcode-bootstrap-content-slider3':
                $output .= '<div class="item"> ';
                    // Set the first background image using inline CSS below.
                    if( $thumb[0] ):
                        $output .= '<div style="background-image:url('.$thumb[0].');" class="fill xs-display-none"></div>';
                    endif;
                    $output .= '<div class="case-study-slider clearfix">';
                        $output .= '<div class="col-lg-7 col-md-9 col-sm-10 pull-right">';
                            if( $hcode_content_slider_number || $number_color ):
                                $output .= '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">';
                                    $output .= '<span class="about-number alt-font black-text font-weight-400 letter-spacing-2 xs-no-border xs-no-padding-left" '.$number_color.'>'.$hcode_content_slider_number.'</span>';
                                $output .= '</div>';
                            endif;
                            $output .= '<div class="col-lg-8 col-md-9 col-sm-9 col-xs-12 about-text position-relative">';
                                if( $hcode_content_slider_title || $title_color ):
                                    $output .= '<p class="title-small text-uppercase letter-spacing-3 black-text no-margin-bottom"><a class="inner-link" href="'.$button_link.'" '.$title_color.'>'.$hcode_content_slider_title.'</a></p>';
                                endif;
                                if( $hcode_content_slider_subtitle || $subtitle_color ):
                                    $output .= '<span class="case-study-work letter-spacing-2" '.$subtitle_color.'>'.$hcode_content_slider_subtitle.'</span>';
                                endif;
                                if( $content ):
                                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                endif;
                                if( $button_title ):
                                    $output .= '<a class="highlight-button-black-border btn btn-small no-margin-bottom inner-link" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                                endif;
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;
        }
        return $output;
    }
}
add_shortcode( 'hcode_special_slide_content', 'hcode_special_slide_content_shortcode' );
?>