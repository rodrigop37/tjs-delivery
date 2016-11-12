<?php
/**
 * Shortcode For Slider
 *
 * @package H-Code
 */
?>
<?php 
/*-----------------------------------------------------------------------------------*/
/* Slider */
/*-----------------------------------------------------------------------------------*/

$hcode_slider_parent_type='';
if ( ! function_exists( 'hcode_slider_shortcode' ) ) {
    function hcode_slider_shortcode( $atts, $content = null ) {

        extract( shortcode_atts( array(
                    'slider_premade_style' => '',
                    'show_pagination' => '',
                    'show_pagination_style' => '',
                    'show_navigation' => '',
                    'show_navigation_style' => '',
                    'show_cursor_color_style' => '',
                    'transition_style' => '',
                    'show_pagination_color_style' => '',
                    'autoplay' => '',
                    'stoponhover' => '',
                    'slidespeed' => '3000',
                    'addclassactive' => '',
                    'background_slide_number' => '',
                    'background_slide_title' => '',
                    'background_slide_subtitle' => '',
                    'background_slide_subtitle_text' => '',
                    'modeling_image' => '',
                    'hcode_slider_id' => '',
                    'hcode_slider_class' => '',
                    'hcode_slider_content' => '',
                    'background_slide_title1' => '',
                    'background_slide_subtitle1' => '',
                    'background_slide_title2' => '',
                    'background_slide_subtitle2' => '',
                    'background_slide_title3' => '',
                    'background_slide_subtitle3' => '',
                    'background_slide_title_color' => '',
                    'background_slide_subtitle_color' => '',
                    'background_slide_bg_color' => '',
                ), $atts ) );
        $output  = $slider_config = $slider_id ='';
        $slider_premade_style       = ( $slider_premade_style ) ? $slider_premade_style : '';
        $transition_style           = ( $transition_style ) ? $transition_style : '';

        global $hcode_slider_parent_type;
    	$hcode_slider_parent_type = $slider_premade_style;

    	$pagination = ($show_pagination_style) ? hcode_owl_pagination_slider_classes($show_pagination_style) : hcode_owl_pagination_slider_classes('default');
    	$pagination_style = ($show_pagination_color_style) ? hcode_owl_pagination_color_classes($show_pagination_color_style) : hcode_owl_pagination_color_classes('default');

        $navigation = ( $show_navigation_style ) ? hcode_owl_navigation_slider_classes( $show_navigation_style) : hcode_owl_navigation_slider_classes('default') ;
        $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' cursor-black';

        /* For owl background slide number*/
        $background_slide_number = ( $background_slide_number ) ? $background_slide_number : '';
        $background_slide_title = ( $background_slide_title ) ? $background_slide_title : '';
        $background_slide_subtitle = ( $background_slide_subtitle ) ? $background_slide_subtitle : '';
        $background_slide_subtitle_text = ( $background_slide_subtitle_text ) ? $background_slide_subtitle_text : '';

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($modeling_image);
        $img_title = hcode_option_image_title($modeling_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';

        $modeling_image = wp_get_attachment_image_src($modeling_image, 'full');
        $background_slide_title_color = ($background_slide_title_color) ? 'style="color:'.$background_slide_title_color.' !important "' : '';
        $background_slide_subtitle_color = ($background_slide_subtitle_color) ? 'style="color:'.$background_slide_subtitle_color.' !important "' : '';
        $background_slide_bg_color = ($background_slide_bg_color) ? 'style="background:'.$background_slide_bg_color.' !important "' : '';

        /* Check if slider id and class */
        $hcode_slider_id = ( $hcode_slider_id ) ? $slider_id = $hcode_slider_id : $slider_id = $slider_premade_style;
        $hcode_slider_class = ( $hcode_slider_class ) ? $hcode_slider_class : '';
        switch ($slider_premade_style) {
            case 'hcode-owl-slider1':
            	$output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$hcode_slider_class.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' main-slider '.$hcode_slider_class.'">';
                	$output .= do_shortcode($content);
                $output .= '</div>';
            break;

            case 'hcode-owl-slider2':
                $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$hcode_slider_class.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                    $output .= do_shortcode($content);
                $output .= '</div>';
    		break;

    		case 'hcode-owl-slider3':
        		$output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' restaurant-header '.$hcode_slider_class.'">';
    				$output .= do_shortcode($content);
    			$output .= '</div>';
    		break;

    		case 'hcode-owl-slider4':
        		$output .= '<div id="slider" class="no-padding bg-black travel-slider overflow-hidden'.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
            		$output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme">';
            			$output .= do_shortcode($content);
            		$output .= '</div>';
        		$output .= '</div>';
            	$slider_config .= 'touchDrag: false, ';
            	$slider_config .= 'mouseDrag: false, ';
    		break;

    		case 'hcode-owl-slider5':
    	        $output .='<div id="'.$slider_id.'" class="owl-carousel owl-theme owl-half-slider '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' corporate-slider '.$hcode_slider_class.'">';
                    $output .= do_shortcode($content);
    	        $output .='</div>';
    		break;

            case 'hcode-owl-slider6':
                $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme owl-half-slider'.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                    $output .= do_shortcode($content);
                $output .= '</div>';
            break;

            case 'hcode-owl-slider7':
                $slider_config .= 'touchDrag: false, ';
                $slider_config .= 'mouseDrag: false, ';
                    
                $output .= '<div class="background-slider-text">';
                    $output .= '<div class="container full-screen position-relative">';
                        $output .= '<div class="slider-typography">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-bottom slider-text-middle5 text-left animated fadeInUp">';
                                    if($background_slide_number){
                                        $output .= '<span class="slider-number alt-font black-text border-color-black">'.$background_slide_number.'</span>';
                                    }
                                    if($background_slide_title){
                                        $output .= '<span class="slider-title-big5 alt-font black-text" '.$background_slide_title_color.'>'.$background_slide_title.'</span>';
                                    }
                                    if($background_slide_subtitle){
                                        $output .= '<span class="slider-subtitle5 black-text" '.$background_slide_subtitle_color.'>'.$background_slide_subtitle.'</span><br>';
                                    }
                                    $output .= '<div class="separator-line bg-black no-margin-lr no-margin-top sm-margin-bottom-eleven xs-margin-bottom-thirteen"></div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
                $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme'.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                    $output .= do_shortcode($content);
                $output .= '</div>';
            break;

            case 'hcode-owl-slider8':
                $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                    $output .= do_shortcode($content);
                $output .= '</div>';
            break;

            case 'hcode-owl-slider9':
                $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme owl-half-slider '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                    $output .= do_shortcode($content);
                $output .= '</div>';
            break;

            case 'hcode-owl-slider10':
                $output .='<div class="no-padding bg-white fashion-slider position-relative overflow-hidden">';
                    $output .='<div class="background-slider-text">';
                        $output .='<div class="container full-screen position-relative">';
                            $output .='<div class="slider-typography">';
                                $output .='<div class="slider-text-middle-main pull-right padding-six-lr" '.$background_slide_bg_color.'>';
                                    $output .='<div class="slider-text-bottom slider-text-middle5 text-left no-padding">';
                                        $output .='<span class="slider-title-big5 alt-font white-text margin-twentytwo" '.$background_slide_title_color.'>'.$background_slide_title.'</span>';
                                        $output .='<div class="separator-line bg-white no-margin-lr no-margin-top margin-twentytwo"></div>';
                                    $output .='</div>';
                                $output .='</div>';
                                $output .='<div class="pull-right xs-display-none"><img src="'.$modeling_image[0].'" width="'.$modeling_image[1].'" height="'.$modeling_image[2].'" '.$image_alt.$image_title.'></div>';
                            $output .='</div>';
                        $output .='</div>';
                    $output .='</div>';
                    $output .='<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                        $output .= do_shortcode($content);
                    $output .='</div>';
                $output .='</div>';
            break;

            case 'hcode-owl-slider11':
                $output .= '<div class="architecture-slider">';
                    $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                        $output .= do_shortcode($content);
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'hcode-owl-slider12':
                $output .= '<div class="travel-agency-slider">';
                    $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                        $output .= do_shortcode($content);
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'hcode-owl-slider13':
                $output .= '<div class="onepage-corporate-slider">';
                    $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme light-pagination '.$hcode_slider_class.$show_cursor_color_style.'">';
                        $output .= do_shortcode($content);
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'hcode-owl-slider14':
                    $output .= '<div class="background-slider-text">';
                        $output .= '<div class="container full-screen  position-relative">';
                            $output .= '<div class="slider-typography">';
                                $output .= '<div class="slider-text-middle-main">';
                                    $output .= '<div class="slider-text-middle slider-text-middle2 personal-name animated fadeIn">';
                                        $output .= '<div class="col-md-5 col-sm-8 col-xs-11 wedding-header center-col">';
                                            $output .= '<div class="wedding-header-sub bg-white">';
                                                if($background_slide_title){
                                                    $output .= '<span class="title-large text-uppercase letter-spacing-3 font-weight-700 pink-text display-block" '.$background_slide_title_color.'>'.$background_slide_title.'</span>';
                                                }
                                                $output .= '<span class="margin-five display-block"><i class="fa fa-heart yellow-text"></i><i class="fa fa-heart yellow-text"></i><i class="fa fa-heart yellow-text"></i></span>';
                                                if($background_slide_subtitle){
                                                    $output .= '<span class="text-large text-uppercase letter-spacing-3 display-block" '.$background_slide_subtitle_color.'>'.$background_slide_subtitle.'</span>';
                                                }
                                                if($background_slide_subtitle_text){
                                                    $output .= '<span class="text-large text-uppercase letter-spacing-3 font-weight-600">'.$background_slide_subtitle_text.'</span>';
                                                }
                                            $output .= '</div>';
                                        $output .= '</div>';
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                $output .= do_shortcode($content);
                $output .= '</div>';
            break;

            case 'hcode-owl-slider15':
                $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                    $output .= do_shortcode($content);
                $output .= '</div>';
            break;

            case 'hcode-owl-slider16':
                $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme owl-half-slider owl-small-slider'.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                    $output .= do_shortcode($content);
                $output .= '</div>';
            break;

            case 'hcode-owl-slider17':
                $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                    $output .= do_shortcode($content);
                $output .= '</div>';
            break;

            case 'hcode-owl-slider18':
                $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                    $output .= do_shortcode($content);
                $output .= '</div>';
            break;
            
            case 'hcode-owl-slider19':
                $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                    $output .= do_shortcode($content);
                $output .= '</div>';
            break;

            case 'hcode-owl-slider20':
            case 'hcode-owl-slider21':
                    $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                        $output .= do_shortcode($content);
                    $output .= '</div>';
            break;

            case 'hcode-owl-slider22':
                $slider_config .= 'touchDrag: false, ';
                $slider_config .= 'mouseDrag: false, ';

                     $output .= '<div id="'.$slider_id.'" class="owl-carousel owl-theme '.$hcode_slider_class.$pagination.$pagination_style.$navigation.$show_cursor_color_style.'">';
                        $output .= do_shortcode($content);
                    $output .= '</div>';
                    $output .= '<div class="work-background-slider-text" '.$background_slide_bg_color.'>';
                        $output .= '<div class="slider-text-bottom slider-text-middle5 text-left no-padding">';
                            if($background_slide_number){
                                $output .= '<span class="parallax-number alt-font black-text no-margin-top">'.$background_slide_number.'</span>';
                            }
                            if($background_slide_title){
                                $output .= '<h1 class="margin-two-bottom" '.$background_slide_title_color.'>'.$background_slide_title.'</h1>';
                            }
                            if($background_slide_subtitle_text){
                                $output .= '<span class="slider-title-big5 alt-font black-text">'.$background_slide_subtitle_text.'</span>';
                            }
                            if($background_slide_subtitle){
                                $output .= '<span class="slider-subtitle5 black-text" '.$background_slide_subtitle_color.'>'.$background_slide_subtitle.'</span>';
                            }
                            $output .= '<div class="separator-line bg-yellow no-margin-lr sm-margin-bottom-eight"></div>';
                            if($hcode_slider_content){
                                $output .= '<div class="col-md-8 no-padding">';
                                    $output .= '<p class="text-large">'.$hcode_slider_content.'</p>';
                                $output .= '</div>';
                            }
                        $output .= '</div>';
                        $output .= '<div class="col-md-8 col-sm-12 text-med no-padding margin-five no-margin-bottom xs-no-margin-top">';
                            $output .= '<div class="col-md-4 col-sm-4 col-xs-4 text-med no-padding"><div class="spend-year no-border text-left black-text width-auto"><span>'.$background_slide_title1.'</span>'.$background_slide_subtitle1.'</div></div>';
                            $output .= '<div class="col-md-4 col-sm-4 col-xs-4 text-med no-padding"><div class="spend-year no-border text-left black-text width-auto"><span>'.$background_slide_title2.'</span>'.$background_slide_subtitle2.'</div></div>';
                            $output .= '<div class="col-md-4 col-sm-4 col-xs-4 text-med no-padding"><div class="spend-year no-border text-left black-text width-auto"><span>'.$background_slide_title3.'</span>'.$background_slide_subtitle3.'</div></div>';
                        $output .= '</div>';
                    $output .= '</div>';
            break;

            case 'hcode-bootstrap-slider1':
                $output .= '<div id="'.$slider_id.'" class="carousel no-padding slide carousel-'.$transition_style.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                    if($show_pagination && $show_pagination == 1){
                        // Slider Indicators
                        ($show_pagination_style == 1) ? $pagination_class = ' arrow-style-line' : $pagination_class = '';
                        $output .= '<ol class="carousel-indicators'.$pagination_class.'">';
                        $output .= hcode_slider_pagination($content, $slider_id);
                        $output .= '</ol>';
                    }
                // Slider Items
                $output .= '<div class="carousel-inner">';
                    $output .= do_shortcode($content);
                $output .= '</div>';

                if($show_navigation && $show_navigation == 1){
                    // Slider Next / Previous
                    if($show_navigation_style == 1){
                        $output .= '<a class="left carousel-control" href="#'.$slider_id.'" data-slide="prev"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-white-bg.png" alt="" /></a>';
                        $output .= '<a class="right carousel-control" href="#'.$slider_id.'" data-slide="next"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-white-bg.png" alt="" /></a>';
                    }else{
                        $output .= '<a class="left carousel-control" href="#'.$slider_id.'" data-slide="prev"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre.png" alt="" /></a>';
                        $output .= '<a class="right carousel-control" href="#'.$slider_id.'" data-slide="next"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-next.png" alt="" /></a>';                                      
                    }
                    $output .= '<!-- end slider next / previous -->';
                }
                $output .= '</div>';
            break;

            case 'hcode-bootstrap-slider2':
                $output .= '<div id="'.$slider_id.'" class="carousel slide no-padding carousel-'.$transition_style.$pagination.$pagination_style.$navigation.$show_cursor_color_style.' '.$hcode_slider_class.'">';
                    if($show_pagination && $show_pagination == 1){
                        // Slider Indicators
                        ($show_pagination_style == 1) ? $pagination_class = ' arrow-style-line' : $pagination_class = '';
                        $output .= '<ol class="carousel-indicators'.$pagination_class.'">';
                        $output .= hcode_slider_pagination($content, $slider_id);
                        $output .= '</ol>';
                    }
                // Slider Items
                $output .= '<div class="carousel-inner">';
                    $output .= do_shortcode($content);
                $output .= '</div>';

                if($show_navigation && $show_navigation == 1){
                    // Slider Next / Previous
                    if($show_navigation_style == 1){
                        $output .= '<a class="left carousel-control" href="#'.$slider_id.'" data-slide="prev"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-white-bg.png" alt="" /></a>';
                        $output .= '<a class="right carousel-control" href="#'.$slider_id.'" data-slide="next"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-white-bg.png" alt="" /></a>';
                    }else{
                        $output .= '<a class="left carousel-control" href="#'.$slider_id.'" data-slide="prev"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre.png" alt="" /></a>';
                        $output .= '<a class="right carousel-control" href="#'.$slider_id.'" data-slide="next"><img src="'.HCODE_THEME_IMAGES_URI.'/arrow-next.png" alt="" /></a>';                                      
                    }
                }
                $output .= '</div>';
            break;
        }
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

        // For Bootstrape Slider 
        $bootstrap_slider_config = '';
        $slidespeed = ( $slidespeed ) ? $slidespeed : '3000'; 
        ( $autoplay == 1 ) ? $bootstrap_slider_config .= 'interval: '.$slidespeed.', ' : $bootstrap_slider_config .= 'interval: false, ';
        ( $stoponhover == 1) ? $bootstrap_slider_config .= 'pause: "hover" ' : $bootstrap_slider_config .= 'pause: false, ';
        
    	ob_start();?>
        <script type="text/javascript">jQuery(document).ready(function () { jQuery("<?php echo '#'.$slider_id;?>").owlCarousel({ <?php echo $slider_config;?> }); });</script>
    	<?php 
    	$script = ob_get_contents();
    	ob_end_clean();
        ob_start();?>
        <script type="text/javascript">jQuery(document).ready(function () { jQuery("<?php echo '#'.$slider_id;?>").carousel({ <?php echo $bootstrap_slider_config; ?> });});</script>
        <?php 
        $script_bootstrap = ob_get_contents();
        ob_end_clean();
        if(!in_array($hcode_slider_parent_type, array('hcode-bootstrap-slider1','hcode-bootstrap-slider2','hcode-bootstrap-slider3'))){
    	   $output .= $script;
        }else{
            $output .= $script_bootstrap;
        }
    	/* Add custom script End*/
        return $output;
    }
}
add_shortcode( 'hcode_slider', 'hcode_slider_shortcode' );

if ( ! function_exists( 'hcode_slider_content_shortcode' ) ) {
    function hcode_slider_content_shortcode( $atts, $content = null) {
    	global $hcode_slider_parent_type;
        extract( shortcode_atts( array(
        			'small_image' => '',
                            'title' => '',
                            'subtitle' => '',
                            'image' => '',
                            'slide_number' => '',
                            'subtitle_position' => '',
                            'no_button' => '',
                            'first_button_config' => '',
                            'second_button_config' => '',
                            'hcode_title_color' => '',
                ), $atts ) );
        $output = $urltarget = $background_image = '';
        ob_start();
        
        $title        = ( $title ) ? str_replace('||', '<br />',$title) : '';
        $subtitle_position = ($subtitle_position) ? $subtitle_position : '';
        $slide_number = ($slide_number) ? $slide_number : '';
        $hcode_title_color = ($hcode_title_color) ? 'style="color:'.$hcode_title_color.' !important "' : '';
        
        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($image);
        $img_title = hcode_option_image_title($image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';

        $thumb = wp_get_attachment_image_src($image, 'full');
        $small_image = wp_get_attachment_image_src($small_image, 'full');

        if($thumb[0]):
            $background_image = ' style="background-image:url('.$thumb[0].')"';
        endif;

        $first_button_config = ( $first_button_config ) ? $first_button_config : '';
        $second_button_config = ( $second_button_config ) ? $second_button_config : '';

        /* Slide button */
        if ( (function_exists('vc_parse_multi_attribute') && $first_button_config)) {
            //First button
            $first_button_parse_args = vc_parse_multi_attribute($first_button_config);
            $first_button_link     = ( isset($first_button_parse_args['url']) ) ? $first_button_parse_args['url'] : '#';
            $first_button_title    = ( isset($first_button_parse_args['title']) ) ? $first_button_parse_args['title'] : 'sample button';
            $first_button_target   = ( isset($first_button_parse_args['target']) ) ? trim($first_button_parse_args['target']) : '_self';
        }
        if ( (function_exists('vc_parse_multi_attribute') && $second_button_config != '')) {
            $second_button_parse_args = vc_parse_multi_attribute($second_button_config);
            $second_button_link     = ( isset($second_button_parse_args['url']) ) ? $second_button_parse_args['url'] : '#';
            $second_button_title    = ( isset($second_button_parse_args['title']) ) ? $second_button_parse_args['title'] : 'sample button';
            $second_button_target   = ( isset($second_button_parse_args['target']) ) ? trim($second_button_parse_args['target']) : '_self';
        }

        switch($hcode_slider_parent_type){
        	case 'hcode-owl-slider1':
    		    $output .= '<div class="item owl-bg-img" '.$background_image.'>';
    		        $output .= '<div class="opacity-full bg-dark-gray"></div>';
    		        $output .= '<div class="container full-screen position-relative">';
    		            $output .= '<div class="slider-typography text-center">';
    		                $output .= '<div class="slider-text-middle-main">';
    		                    $output .= '<div class="slider-text-middle slider-text-middle6 padding-left-right-px wow fadeInUp">';
    		                        if($title){
                                        $output .= '<span class="slider-title-big6 white-text text-uppercase font-weight-700 letter-spacing-3" '.$hcode_title_color.'>'.$title.'</span>';
                                    }
                                    if($content){
    		                            $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                    }
    		                    $output .= '</div>';
    		                $output .= '</div>';
    		            $output .= '</div>';
    		        $output .= '</div>';
    		    $output .= '</div>';
        	break;

        	case 'hcode-owl-slider2':
                // Set the Background Image Using Inline CSS Below.
                $output .= '<div class="item owl-bg-img" '.$background_image.'>';
                    $output .= '<div class="opacity-light bg-black"></div>';
                    $output .= '<div class="container full-screen position-relative" >';
                        $output .= '<div class="slider-typography margin-five no-margin-bottom">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-middle">';
                                    if($content){
                                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                    }
                                    if($title){
                                        $output .= '<h1 class="letter-spacing-2 white-text margin-three no-margin-bottom" '.$hcode_title_color.'>'.$title.'</h1>';
                                    }
                                    if($first_button_config && $no_button){
                                        $output .= '<a class="btn-small-white btn btn-medium margin-four no-margin-bottom no-margin-right" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                                    }
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
        	break;

        	case 'hcode-owl-slider3':
                // Set the Background Image Using Inline CSS Below.
                $output .= '<div class="item owl-bg-img" '.$background_image.'>';
                    $output .= '<div class="opacity-medium bg-black"></div>';
                    $output .= '<div class="container full-screen position-relative" >';
                        $output .= '<div class="slider-typography">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-middle">';
                                    if($title != '' || $content != ''){
                                        $title_check = '<span class="font-weight-600 letter-spacing-2" '.$hcode_title_color.'>'.$title.'</span>';
                                        $output .= '<h1 class="white-text font-weight-400 margin-five no-margin-bottom">'.$title_check.'</h1>';
                                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                    }
                                    if($first_button_config && $no_button){
                                        $output .= '<a class="starting text-med text-uppercase font-weight-600 letter-spacing-2 black-text margin-two bg-golden-yellow display-inline-block" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                                    }
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'hcode-owl-slider4':
                if($thumb[0]){
        	       $output .= '<div class="item owl-bg-img full-screen" '.$background_image.'></div>';
               }
            break;

            case 'hcode-owl-slider5':
                $output .= '<div class="item owl-bg-img" '.$background_image.'>';
                    $output .= '<div class="opacity-medium bg-dark-gray"></div>';
                    $output .= '<div class="container position-relative">';
                        $output .= '<div class="slider-typography text-center">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-middle padding-left-right-px wow fadeIn">';
                                    if($title){
                                        $output .= '<p class="text-small font-weight-600 text-uppercase white-text letter-spacing-7 margin-three no-margin-top bg-deep-red highlight-link-text xs-line-height-18" '.$hcode_title_color.'>'.$title.'</p>';
                                    }
                                    if($content){
                                        $output .= '<h1 class="white-text font-weight-100 letter-spacing-2">'.do_shortcode( $content ).'</h1>';
                                    }
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'hcode-owl-slider6':
                $output .= '<div class="item owl-bg-img" '.$background_image.'>';
                    $output .= '<div class="container position-relative">';
                        $output .= '<div class="slider-typography slider-typography-shop text-left">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-middle padding-left-right-px animated fadeInUp">';
                                    if($content){
                                        $output .= '<span class="owl-subtitle black-text">'.do_shortcode( $content ).'</span>';
                                    }
                                    if($title){
                                        $output .= '<span class="owl-title black-text xs-margin-bottom-seven" '.$hcode_title_color.'>'.$title.'</span>';
                                    }
                                    if($first_button_config && $no_button){
                                        $output .= '<a class="highlight-button-dark btn margin-four" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                                    }
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'hcode-owl-slider7':
                if($thumb[0]){
                    $output .= '<div class="item owl-bg-img full-screen" '.$background_image.'></div>';
                }
            break;

            case 'hcode-owl-slider8':
                $output .= '<div class="item owl-bg-img" '.$background_image.'>';
                $output .= '<div class="slider-overlay bg-slider"></div>';
                    $output .= '<div class="container full-screen position-relative">';
                        $output .= '<div class="slider-typography">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-middle animated fadeInUp">';
                                    if($content){
                                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                    }
                                    if($title){
                                        $output .= '<span class="owl-title-big white-text" '.$hcode_title_color.'>'.$title.'</span><br>';
                                    }
                                    if($first_button_config && $no_button){
                                        $output .= '<a class="btn-small-white btn margin-five-top no-margin-bottom inner-link margin-lr-10px" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                                    }
                                    if($second_button_config && $no_button){
                                        $output .= '<a class="btn-small-white btn margin-five-top no-margin-bottom inner-link margin-lr-10px" href="'.$second_button_link.'" target="'.$second_button_target.'">'.$second_button_title.'</a>';
                                    }
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'hcode-owl-slider9':
                $output .= '<div class="item owl-bg-img" '.$background_image.'>';
                    $output .= '<div class="container position-relative">';
                        $output .= '<div class="slider-typography text-left">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-middle padding-left-right-px animated fadeInUp">';
                                    if($content){
                                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                    }
                                    if($title){
                                        $output .= '<span class="owl-title black-text" '.$hcode_title_color.'>'.$title.'</span>';
                                    }
                                    if($first_button_config && $no_button){
                                        $output .= '<a class="highlight-button-black-border btn btn-small" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                                    }
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'hcode-owl-slider10':
                    $output .= '<div class="item owl-bg-img full-screen" '.$background_image.'></div>';
            break;

            case 'hcode-owl-slider11':
                $output .= '<div class="item owl-bg-img" '.$background_image.'><div class="bg-slider"></div>';
                    $output .= '<div class="slider-headline">';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="slider-text-middle">';
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                    $output .= '<div class="full-screen architecture-full-screen position-relative">';
                        $output .= '<div class="slider-typography bg-light-gray3">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-middle">';
                                    $output .= '<div class="separator-line bg-yellow margin-three sm-margin-bottom-five"></div>';
                                    if($title):
                                        $output .= '<span class="owl-title black-text col-xs-12 lg-margin-bottom-five" '.$hcode_title_color.'>'.$title.'</span>';
                                    endif;
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'hcode-owl-slider12':
                $output .= '<div class="item owl-bg-img" '.$background_image.'>';
                    $output .= '<div class="slider-overlay bg-black"></div>';
                    $output .= '<div class="container full-screen position-relative">';
                        $output .= '<div class="col-md-12 slider-typography">';
                            $output .= '<div class="slider-text-middle-main pull-left text-left">';
                                $output .= '<div class="slider-text-middle">';
                                    if($title){
                                        $output .= '<h1 class="white-text margin-five" '.$hcode_title_color.'>'.$title.'</h1>';
                                    }
                                    if($content != '' || ($first_button_config != '' || $no_button)){
                                        $output .= '<span class="text-large white-text text-uppercase starting-from">'.do_shortcode( $content ).' <a class="black-text font-weight-600 bg-yellow" href="'.$first_button_link.'" target="'.$first_button_target.'"><span class="black-text font-weight-600">'.$first_button_title.'</span></a></span>';
                                    }
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'hcode-owl-slider13':
                $output .='<div class="item owl-bg-img" '.$background_image.'><div class="slider-overlay bg-slider"></div>';
                    $output .='<div class="container full-screen position-relative">';
                        $output .='<div class="slider-typography">';
                            $output .='<div class="slider-text-middle-main">';
                                $output .='<div class="slider-text-middle">';
                                    if($title){
                                        $output .='<h1 class="white-text" '.$hcode_title_color.'>'.$title.'</h1>';
                                    }
                                    if($content){
                                        $output .='<p class="text-large light-gray-text letter-spacing-3 margin-three">'.do_shortcode( $content ).'</p>';
                                    }
                                    if($first_button_config && $no_button){
                                        $output .='<a class="btn-small-white-background btn btn-small no-margin" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                                    }
                                $output .='</div>';
                            $output .='</div>';
                        $output .='</div>';
                    $output .='</div>';
                $output .='</div>';
            break;

            case 'hcode-owl-slider14':
                $output .= '<div class="item owl-bg-img full-screen" '.$background_image.'></div>';
            break;

            case 'hcode-owl-slider15':
                $output .= '<div class="item owl-bg-img" '.$background_image.'><div class="slider-overlay bg-slider"></div>';
                    $output .= '<div class="container full-screen position-relative">';
                        $output .= '<div class="slider-typography">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-middle">';
                                    if($content){
                                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                    }
                                    if($title){
                                        $output .= '<span class="owl-title white-text" '.$hcode_title_color.'>'.$title.'</span>';
                                    }
                                    if($first_button_config  && $no_button){
                                        $output .= '<a class="btn-small-white btn margin-five-top no-margin-bottom inner-link margin-lr-10px" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                                    }
                                    if($second_button_config){
                                        $output .= '<a class="btn-small-white btn margin-five-top no-margin-bottom inner-link margin-lr-10px" href="'.$second_button_link.'" target="'.$second_button_target.'">'.$second_button_title.'</a>';
                                    }
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'hcode-owl-slider16':
                $output .= '<div class="item owl-bg-img" '.$background_image.'>';
                    $output .= '<div class="opacity-full bg-slider"></div>';
                    $output .= '<div class="container position-relative">';
                        $output .= '<div class="slider-typography text-center">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-middle padding-left-right-px animated fadeInUp">';
                                    if($title):
                                        $output .= '<span class="owl-subtitle white-text" '.$hcode_title_color.'>'.$title.'</span>';
                                    endif;
                                    if($content):
                                        $output .= '<span class="owl-title white-text center-col">'.do_shortcode( $content ).'</span>';
                                    endif;
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'hcode-owl-slider17':
                $output .= '<div class="item owl-bg-img full-screen" '.$background_image.'></div>';
            break;

            case 'hcode-owl-slider18':
                // Set the Background Image Using Inline CSS Below.
                $output .= '<div class="item owl-bg-img" '.$background_image.'>';
                    $output .= '<div class="container full-screen position-relative" >';
                        $output .= '<div class="slider-typography">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-middle slider-text-middle2 text-left animated fadeInUp">';
                                    $output .= '<div class="separator-line bg-black no-margin-lr sm-margin-bottom-ten"></div>';
                                    if($title):
                                        $output .= '<span class="slider-subtitle2 alt-font black-text" '.$hcode_title_color.'>'.str_replace("||", "<br/>", $title).'</span>';
                                    endif;
                                    if($first_button_config):
                                        $output .= '<a class="highlight-button-black-border btn margin-five-top no-margin-bottom inner-link" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                                    endif;
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;
            
            case 'hcode-owl-slider19':
                if( $thumb[0] ):
                        $output .= '<div style="background: #f1f1f1" class="item text-center"><img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"></div>';
                endif;
            break;

            case 'hcode-owl-slider20':
                $output .= '<div class="item col-md-6 col-xs-10 bg-white padding-seven great-result center-col text-center">';
                    if($title):
                        $output .= '<h6 class="margin-five no-margin-top text-uppercase black-text" '.$hcode_title_color.'><strong>'.$title.'</strong></h6>';
                    endif;
                    $output .= '<div class="separator-line bg-yellow margin-ten"></div>';
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                $output .= '</div>';
            break;

            case 'hcode-owl-slider21':
                $output .= '<div class="item owl-bg-img half-project-img-slider" '.$background_image.'>';
                    $output .= '<div class="slider-overlay bg-slider"></div>';
                $output .= '</div>';
            break;
            
            case 'hcode-owl-slider22':
                if($thumb[0]){
                    $output .= '<div class="item owl-bg-img full-screen" '.$background_image.'></div>';
                }
            break;

            case 'hcode-bootstrap-slider1':
                    $output .= '<div class="item full-screen">';
                        // Set the First Background Image Using Inline CSS Below.
                        $output .= '<div class="fill" '.$background_image.'></div>';
                        $output .= '<div class="opacity-full bg-white display-none xs-display-block"></div>';
                        $output .= '<div class="container">';
                            $output .= '<div class="row">';
                                $output .= '<div class="container full-screen position-relative">';
                                    $output .= '<div class="slider-typography">';
                                        $output .= '<div class="slider-text-middle-main">';
                                            $output .= '<div class="slider-text-middle slider-text-middle6 padding-left-right-px wow fadeInUp slider-text">';
                                                $output .= '<div class="col-md-3 col-sm-5 col-xs-6 text-left animated fadeInUp no-padding">';
                                                    if($title){
                                                        $output .= '<h1 class="alt-font" '.$hcode_title_color.'>'.$title.'</h1>';
                                                    }
                                                    $output .= '<div class="separator-line bg-yellow no-margin-lr"></div>';
                                                    if($content){
                                                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                                    }
                                                    if($first_button_config):
                                                        $output .= '<a class="highlight-button btn inner-link no-margin-lr no-margin-bottom" href="'.$first_button_link.'" target="'.$first_button_target.'">'.$first_button_title.'</a>';
                                                    endif;
                                                $output .= '</div>';
                                            $output .= '</div>';
                                        $output .= '</div>';
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
            break;

            case 'hcode-bootstrap-slider2':
                $output .= '<div class="item full-screen">';
                // Set the Background Image Using Inline CSS Below.
                    $output .= '<div class="fill" '.$background_image.'></div>';
                    $output .= '<div class="container full-screen position-relative">';
                        $output .= '<div class="slider-typography">';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-bottom slider-text-middle5 text-left animated fadeInUp">';
                                if($slide_number){
                                    $output .= '<span class="slider-number alt-font black-text border-color-black">'.$slide_number.'</span>';
                                }
                                if($subtitle_position == 'titletop'){
                                    if($title):
                                        $output .= '<span class="slider-title-big5 alt-font black-text" '.$hcode_title_color.'>'.$title.'</span>';
                                    endif;
                                    if($content):
                                        $output .= '<span class="slider-subtitle5 black-text">'.do_shortcode( $content ).'</span><br>';
                                    endif;
                                }else{
                                    if($content):
                                        $output .= '<span class="slider-title-big5 alt-font black-text">'.do_shortcode( $content ).'</span>';
                                    endif;
                                    if($title):
                                        $output .= '<span class="slider-subtitle5 black-text" '.$hcode_title_color.'>'.$title.'</span><br>';
                                    endif;
                                }
                                $output .= '<div class="separator-line bg-black no-margin-lr no-margin-top sm-margin-bottom-ten"></div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            break;
        }
        return $output;
    }
}
add_shortcode( 'hcode_slide_content', 'hcode_slider_content_shortcode' );
?>