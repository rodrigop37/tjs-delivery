<?php
/**
 * Shortcode For Tab Content
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Tab Content */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_tab_content_shortcode' ) ) {
    function hcode_tab_content_shortcode( $atts, $content = null ) {
    	extract( shortcode_atts( array(
            	'id' => '',
            	'class' => '',
            	'hcode_tab_content_premade_style' => '',
            	'hcode_tab_content_left_bgimage' => '',
            	'hcode_tab_content_left_bgimage_type' => '',
            	'hcode_tab_content_left_bgimage_show_overlay' => '',
            	'hcode_tab_content_left_number' => '',
            	'hcode_tab_content_left_title' => '',
            	'hcode_tab_content_left_title_show_separator' => '',
            	'hcode_tab_content_left_content' => '',
            	'hcode_tab_content_right_icon' => '',
            	'hcode_tab_content_right_title' => '',
            	'hcode_tab_content_right_button_config' => '',
            	'hcode_tab_content_left_title_show_separator_line' => '',
            	'hcode_tab_content_bottom_title' => '',
                'hcode_tab_content_counter_number1' => '',
                'hcode_tab_content_counter_text1' => '',
                'hcode_tab_content_counter_number2' => '',
                'hcode_tab_content_counter_text2' => '',
                'hcode_tab_content_counter_number3' => '',
                'hcode_tab_content_counter_text3' => '',
                'hcode_number_color' => '',
                'hcode_title_color' => '',
                'hcode_icon_color' => '',
                'hcode_content_color' => '',
                'hcode_button_color' => '',
            ), $atts ) );
    	$output = $button_color = $button_class = '';

    	$id = ( $id ) ? ' id="'.$id.'"' : '';
    	$class = ( $class ) ? ' '.$class : '';
    	$hcode_tab_content_premade_style = ( $hcode_tab_content_premade_style ) ? $hcode_tab_content_premade_style : '';
    	$hcode_tab_content_left_bgimage = ( $hcode_tab_content_left_bgimage ) ? $hcode_tab_content_left_bgimage : '';
    	$thumb = wp_get_attachment_image_src($hcode_tab_content_left_bgimage, 'full');
        $hcode_tab_content_left_bgimage_type = ( $hcode_tab_content_left_bgimage_type ) ? $hcode_tab_content_left_bgimage_type : '';
    	$hcode_tab_content_left_bgimage_show_overlay = ( $hcode_tab_content_left_bgimage_show_overlay ) ? $hcode_tab_content_left_bgimage_show_overlay : '';
    	$hcode_tab_content_left_number = ( $hcode_tab_content_left_number ) ? $hcode_tab_content_left_number : '';
    	$hcode_tab_content_left_title = ( $hcode_tab_content_left_title ) ? $hcode_tab_content_left_title : '';
    	$hcode_tab_content_left_title_show_separator = ( $hcode_tab_content_left_title_show_separator ) ? $hcode_tab_content_left_title_show_separator : '';
    	$hcode_tab_content_left_content = ( $hcode_tab_content_left_content ) ? $hcode_tab_content_left_content : '';
    	$hcode_tab_content_right_icon = ( $hcode_tab_content_right_icon ) ? $hcode_tab_content_right_icon : '';
    	$hcode_tab_content_right_title = ( $hcode_tab_content_right_title ) ? $hcode_tab_content_right_title : '';
    	$hcode_tab_content_right_button_config = ( $hcode_tab_content_right_button_config ) ? $hcode_tab_content_right_button_config : '';
    	$hcode_tab_content_left_title_show_separator_line = ( $hcode_tab_content_left_title_show_separator_line ) ? $hcode_tab_content_left_title_show_separator_line : '';
    	$hcode_tab_content_bottom_title = ( $hcode_tab_content_bottom_title ) ? $hcode_tab_content_bottom_title : '';
    	$bg_image = ( $thumb[0] ) ? ' style="background-image:url('.$thumb[0].');"' : '';
        $hcode_number_color = ($hcode_number_color) ? 'style="color:'.$hcode_number_color.' !important"' : '';
        $hcode_title_color = ($hcode_title_color) ? 'style="color:'.$hcode_title_color.' !important"' : '';
        $hcode_icon_color = ($hcode_icon_color) ? 'style="color:'.$hcode_icon_color.' !important"' : '';
        $hcode_content_color = ($hcode_content_color) ? 'style="color:'.$hcode_content_color.' !important"' : '';
        if($hcode_button_color):
            $button_color .= 'style="background:'.$hcode_button_color.' !important"';
            $button_class .= ' button-hover-color';
        endif;
    	if (function_exists('vc_parse_multi_attribute')) {
            // For Button
            $button_parse_args = vc_parse_multi_attribute($hcode_tab_content_right_button_config);
            $button_link     = ( isset($button_parse_args['url']) ) ? $button_parse_args['url'] : '#';
            $button_title    = ( isset($button_parse_args['title']) ) ? $button_parse_args['title'] : '';
            $button_target   = ( isset($button_parse_args['target']) ) ? trim($button_parse_args['target']) : '_self';
        }
    	switch ($hcode_tab_content_premade_style) {
    		case 'tab-content1':
    			if( $bg_image || $hcode_tab_content_left_title || $hcode_tab_content_left_number ):
    				$output .= '<div class="col-lg-6 col-md-6 no-padding corporate-standards-img position-relative '.$hcode_tab_content_left_bgimage_type.'" '.$bg_image.'>';
    					if( $hcode_tab_content_left_bgimage_show_overlay ):
    	                	$output .= '<div class="opacity-medium bg-dark-gray"></div>';
    	                endif;
    	                if( $hcode_tab_content_left_title || $hcode_tab_content_left_number ):
    		                $output .= '<p class="title-small text-uppercase corporate-standards-title white-text letter-spacing-7">';
    		                	if( $hcode_tab_content_left_number ):
    		                		$output .= '<span class="title-extra-large no-letter-spacing yellow-text" '.$hcode_number_color.'>'.$hcode_tab_content_left_number.'</span><br>';
    		                	endif;
    		                $output .= $hcode_tab_content_left_title.'</p>';
    	                endif;
    				$output .= '</div>';
    			endif;
                $output .= '<div class="col-lg-6 col-md-6 corporate-standards-text sm-margin-lr-four sm-margin-top-four xs-padding-tb-ten">';
                    $output .= '<div class="img-border-small-fix border-gray"></div>';
                    if( $hcode_tab_content_right_icon ):
                    	$output .= '<i class="'.$hcode_tab_content_right_icon.' large-icon yellow-text" '.$hcode_icon_color.'></i>';
                    endif;
                    if( $hcode_tab_content_right_title ):
                    	$output .= '<h1 class="margin-ten no-margin-bottom" '.$hcode_title_color.'>'.$hcode_tab_content_right_title.'</h1>';
                    endif;
                    if( $content ):
                    	$output .= '<p class="text-med margin-ten width-80 center-col xs-width-100" '.$hcode_content_color.'>'.do_shortcode( $content ).'</p>';
                    endif;
                    if( $button_title ):
                    	$output .= '<a class="text-small highlight-link text-uppercase bg-black white-text'.$button_class.'" '.$button_color.' href="'.$button_link.'" target="'.$button_target.'">'.$button_title.' <i class="fa fa-long-arrow-right extra-small-icon white-text"></i></a>';
                    endif;
                $output .= '</div>';
    		break;

    		case 'tab-content2':
    			$output .= '<div class="row">';
    				if( $hcode_tab_content_left_title || $hcode_tab_content_left_title_show_separator || $hcode_tab_content_left_content ):
    	                $output .= '<div class="col-md-6 col-sm-12 text-left gray-text">';
    	                	if( $hcode_tab_content_left_title ):
    	                    	$output .= '<h5>'.$hcode_tab_content_left_title.'</h5>';
    	                    endif;
    	                    if( $hcode_tab_content_left_title_show_separator ):
    	                    	$output .= '<div class="separator-line bg-yellow no-margin-lr sm-margin-five"></div>';
    	                    endif;
    	                    if( $hcode_tab_content_left_content ):
    	                    	$output .= '<p class="text-large margin-five margin-right-ten">'.$hcode_tab_content_left_content.'</p>';
    	                    endif;
    	                $output .= '</div>';
    	            endif;
    	            if( $hcode_tab_content_right_title || $content ):
    	                $output .= '<div class="col-md-6 col-sm-12 text-left text-med gray-text">';
    	                	if( $hcode_tab_content_right_title ):
    	                    	$output .= '<p class="text-uppercase">'.$hcode_tab_content_right_title.'</p>';
    	                    endif;
    	                    if( $content ):
    	                    	$output .= do_shortcode( hcode_remove_wpautop( $content ) );
    	                    endif;
    	                $output .= '</div>';
    	            endif;
                $output .= '</div>';
                if( $hcode_tab_content_left_title_show_separator_line == 1 ):
    	            $output .= '<div class="row"> ';
    	                $output .= '<div class="wide-separator-line"></div>';
    	            $output .= '</div>';
                endif;
                if( $hcode_tab_content_bottom_title ):
    	            $output .= '<div class="row">';
    	                $output .= '<div class="col-md-12 col-sm-12 text-center service-year black-text">'.$hcode_tab_content_bottom_title.'</div>';
    	            $output .= '</div>';
                endif;
                if( $hcode_tab_content_left_title_show_separator_line == 1 ):
                    $output .= '<div class="row"> ';
                        $output .= '<div class="wide-separator-line"></div>';
                    $output .= '</div>';
                endif;
                $output .= '<div class="row">';
                    if($hcode_tab_content_counter_number1 || $hcode_tab_content_counter_text1):
                        $output .= '<div class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-margin-ten-bottom">';
                            if($hcode_tab_content_counter_number1):
                                $output .= '<span class="counter-number black-text" data-to="'.$hcode_tab_content_counter_number1.'">'.$hcode_tab_content_counter_number1.'</span>';
                            endif;
                            if($hcode_tab_content_counter_text1):
                                $output .= '<span class="counter-title">'.$hcode_tab_content_counter_text1.'</span>';
                            endif;
                        $output .= '</div>';
                    endif;
                    if($hcode_tab_content_counter_number2 || $hcode_tab_content_counter_text2):
                        $output .= '<div class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-margin-ten-bottom">';
                            if($hcode_tab_content_counter_number2):
                                $output .= '<span class="counter-number black-text" data-to="'.$hcode_tab_content_counter_number2.'">'.$hcode_tab_content_counter_number2.'</span>';
                            endif;
                            if($hcode_tab_content_counter_text2):
                                $output .= '<span class="counter-title">'.$hcode_tab_content_counter_text2.'</span>';
                            endif;
                        $output .= '</div>';
                    endif;
                    if($hcode_tab_content_counter_number3 || $hcode_tab_content_counter_text3):
                        $output .= '<div class="col-md-4 col-sm-4 bottom-margin text-center counter-section">';
                            if($hcode_tab_content_counter_number3):
                                $output .= '<span class="counter-number black-text"  data-to="'.$hcode_tab_content_counter_number3.'">'.$hcode_tab_content_counter_number3.'</span>';
                            endif;
                            if($hcode_tab_content_counter_text3):
                                $output .= '<span class="counter-title">'.$hcode_tab_content_counter_text3.'</span>';
                            endif;
                        $output .= '</div>';
                    endif;
                $output .= '</div>'; 
    		break;

    		case 'tab-content3':
                $output .= '<div class="row">';
                    if( $hcode_tab_content_left_title ):
                        $output .= '<div class="col-md-6 col-sm-12 text-left gray-text">';
                            $output .= '<p class="text-large margin-right-ten">'.$hcode_tab_content_left_title.'</p>';
                        $output .= '</div>';
                    endif;
                    if( $hcode_tab_content_right_title || $content ):
                        $output .= '<div class="col-md-6 col-sm-12 text-left text-med gray-text">';
                            if( $hcode_tab_content_right_title ):
                                $output .= '<p class="text-uppercase">'.$hcode_tab_content_right_title.'</p>';
                            endif;
                            if( $content ):
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                            endif;
                        $output .= '</div>';
                    endif;
                $output .= '</div>';
                if( $hcode_tab_content_left_title_show_separator_line == 1 ):
                    $output .= '<div class="row"> ';
                        $output .= '<div class="col-md-12 col-sm-12">';
                            $output .= '<div class="wide-separator-line no-margin-lr"></div>';
                        $output .= '</div>';
                    $output .= '</div>';
                endif;
                if( $hcode_tab_content_bottom_title ):
                    $output .= '<div class="row">';
                        $output .= '<div class="col-md-12 col-sm-12 text-center service-year black-text">';
                            $output .= '<strong>'.$hcode_tab_content_bottom_title.'</strong>';
                        $output .= '</div>';
                    $output .= '</div>';
                endif;
    		break;

            case 'tab-content4':
                if( $hcode_tab_content_left_title || $content ):
                    $output .= '<div class="row margin-four-bottom">';
                        $output .= '<div class="col-md-12 col-sm-12 text-center gray-text">';
                            if( $hcode_tab_content_left_title ):
                                $output .= '<p class="text-large margin-five">'.$hcode_tab_content_left_title.'</p>';
                            endif;
                            if( $content ):
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                            endif;
                        $output .= '</div>';
                    $output .= '</div>';
                endif;
                if( $hcode_tab_content_counter_number1 || $hcode_tab_content_counter_text1 || $hcode_tab_content_counter_number2 || $hcode_tab_content_counter_text2 || $hcode_tab_content_counter_number3 || $hcode_tab_content_counter_text3 ):
                    $output .= '<div class="row border-top padding-four no-padding-bottom">';
                        $output .= '<div class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-margin-ten-bottom">';
                            if( $hcode_tab_content_counter_number1 ):
                                $output .= '<span class="counter-number black-text" data-to="'.$hcode_tab_content_counter_number1.'">'.$hcode_tab_content_counter_number1.'</span>';
                            endif;
                            if( $hcode_tab_content_counter_text1 ):
                                $output .= '<span class="counter-title">'.$hcode_tab_content_counter_text1.'</span>';
                            endif;
                        $output .= '</div>';
                        $output .= '<div class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-margin-ten-bottom">';
                            if( $hcode_tab_content_counter_number2 ):
                                $output .= '<span class="counter-number black-text" data-to="'.$hcode_tab_content_counter_number2.'">'.$hcode_tab_content_counter_number2.'</span>';
                            endif;
                            if( $hcode_tab_content_counter_text2 ):
                                $output .= '<span class="counter-title">'.$hcode_tab_content_counter_text2.'</span>';
                            endif;
                        $output .= '</div>';
                        $output .= '<div class="col-md-4 col-sm-4 bottom-margin text-center counter-section xs-no-margin-bottom">';
                            if( $hcode_tab_content_counter_number3 ):
                                $output .= '<span class="counter-number black-text" data-to="'.$hcode_tab_content_counter_number3.'">'.$hcode_tab_content_counter_number3.'</span>';
                            endif;
                            if( $hcode_tab_content_counter_text2 ):
                                $output .= '<span class="counter-title">'.$hcode_tab_content_counter_text3.'</span>';
                            endif;
                        $output .= '</div>';
                    $output .= '</div>';
                endif;
            break;

            case 'tab-content5':
                $output .= '<div class="text-left spa-treatments position-relative '.$hcode_tab_content_left_bgimage_type.'" '.$bg_image.'>';
                    $output .= '<div class="col-md-6 col-sm-6 bg-white pull-right no-padding"> ';
                        $output .= '<div class="pull-right right-content">';
                            if( $hcode_tab_content_left_title ):
                                $output .= '<span class="text-extra-large font-weight-600 letter-spacing-2 text-uppercase black-text margin-three no-margin-top display-block">'.$hcode_tab_content_left_title.'</span>';
                            endif;
                            if( $content ):
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                            endif;
                            if( $button_title || $button_link ):
                                $output .= '<a class="btn inner-link btn-black btn-small no-margin" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                            endif;
                        $output .= '</div>   ';
                    $output .= '</div>';
                $output .= '</div>';
            break;
    	}
        return $output;
    }
}
add_shortcode('hcode_tab_content','hcode_tab_content_shortcode');
?>