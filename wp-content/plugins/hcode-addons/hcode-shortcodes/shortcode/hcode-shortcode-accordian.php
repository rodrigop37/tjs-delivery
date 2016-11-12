<?php
/**
 * Shortcode For Accordian
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Accordian */
/*-----------------------------------------------------------------------------------*/

$global_accordian_id = $i = $pre_define_style =''; 
if ( ! function_exists( 'hcode_accordian_shortcode' ) ) {
    function hcode_accordian_shortcode( $atts, $content = null ) {
    	extract( shortcode_atts( array(
    	            'accordian_pre_define_style' => '',
    	            'accordian_id' => '',
    	            'no_padding' => '',
    	            'without_border' => '',
    	        ), $atts ) );
    	global $global_accordian_id,$i,$pre_define_style;
    	$output = '';

    	$accordian_id = ($accordian_id) ? $accordian_id : '';
    	$global_accordian_id = $accordian_id;
    	$ac_id = ($accordian_pre_define_style == 'accordion-style1' || $accordian_pre_define_style == 'accordion-style2' || $accordian_pre_define_style == 'accordion-style3' || $accordian_pre_define_style == 'accordion-style4' ) ? 'id="'.$accordian_id.'"' : '';
    	$no_pad = ($no_padding=='0') ? 'toggles-style3' : '';
    	$without_border = ($without_border == 1) ? ' no-border' : '';
        $extra_class_style4 = ( $accordian_pre_define_style == 'accordion-style4' ) ? ' about-tab-right' : '';
        $pre_define_style = $accordian_pre_define_style;
        
        $i .= 1;
       	$output .='<div class="panel-group '.$pre_define_style.$without_border.$extra_class_style4.'" '.$ac_id.' >';
            $output .= do_shortcode($content);
        $output .='</div>';

        return $output;
    }
}
add_shortcode( 'hcode_accordian', 'hcode_accordian_shortcode' );
 
if ( ! function_exists( 'hcode_accordian_content_shortcode' ) ) {
    function hcode_accordian_content_shortcode( $atts, $content = null ) {
       	extract( shortcode_atts( array(
                    'accordian_active' => '',
                    'accordian_title_icon' => '',
                    'accordian_title' => '',
                    'accordian_bg_image' => '',
                    'button_text' => '',
                    'hcode_icon_color' => '',
                    'hcode_title_color' => '',
                ), $atts,'hcode_accordian' ) );
       	global $global_accordian_id,$i,$pre_define_style;

       	$output = $active = $icon_class = $class = $image_alt = $image_title = '';
       	$thumb = wp_get_attachment_image_src($accordian_bg_image, 'full');
       	$hcode_icon_color = ( $hcode_icon_color ) ? 'style=color:'.$hcode_icon_color.';' : '';
       	$hcode_title_color = ( $hcode_title_color ) ? 'style=color:'.$hcode_title_color.';' : '';
       	$accordian_icon = ( $accordian_title_icon ) ? '<i class="'.$accordian_title_icon.' extra-small-icon vertical-align-middle" '.$hcode_icon_color.'></i> ' : '';
      	

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($accordian_bg_image);
        $img_title = hcode_option_image_title($accordian_bg_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

      	// For Button
       	$button_parse_args = vc_parse_multi_attribute($button_text);
        $button_link     = ( isset($button_parse_args['url']) ) ? $button_parse_args['url'] : '#';
        $button_title    = ( isset($button_parse_args['title']) ) ? $button_parse_args['title'] : '';
        $button_target   = ( isset($button_parse_args['target']) ) ? trim($button_parse_args['target']) : '_self';
       
       
       	switch ($pre_define_style) {
            case 'accordion-style1':
                if($accordian_active=='1'){
                    $active="active-accordion";
                    $class="in";
                    $icon_class="fa-minus";
                }else{
                    $active=$class='';
                    $icon_class="fa-plus";
                }
            break;
            case 'accordion-style2':
                 if($accordian_active=='1'){
                    $active="active-accordion";
                    $class="in";
                    $icon_class="fa-angle-up";
                }else{
                    $active=$class='';
                    $icon_class="fa-angle-down";
                }
            break;
            case 'accordion-style3':
                 if($accordian_active=='1'){
                    $active="active-accordion";
                    $class="in";
                    $icon_class="fa-angle-up";
                }else{
                    $active=$class='';
                    $icon_class="fa-angle-down";
                }
            break;
            case 'accordion-style4':
                if($accordian_active=='1'){
                    $active="active-accordion";
                    $class="in";
                    $icon_class="fa-minus";
                }else{
                    $active=$class='';
                    $icon_class="fa-plus";
                }
            break;
            case 'toggles-style1':
                 if($accordian_active=='1'){
                    $active="active-accordion";
                    $class="in";
                    $icon_class="fa-minus";
                }else{
                    $active=$class='';
                    $icon_class="fa-plus";
                }
            break;
            case 'toggles-style2':
                 if($accordian_active=='1'){
                    $active="active-accordion";
                    $class="in";
                    $icon_class="fa-angle-up";
                }else{
                    $active=$class='';
                    $icon_class="fa-angle-down";
                }
            break;
            case 'toggles-style3':
                 if($accordian_active=='1'){
                    $active="active-accordion";
                    $class="in";
                    $icon_class="fa-minus";
                }else{
                    $active=$class='';
                    $icon_class="fa-plus";
                }
            break;
        } 
        $output .='<div class="panel panel-default">';
            $output .='<div class="panel-heading '.$active.'">';
                $output .='<a data-toggle="collapse" data-parent="#'.$global_accordian_id.'" href="#accordian-panel-'.$i.'">';
                    $output .='<h4 class="panel-title" '.$hcode_title_color.'>';
                        $output .= $accordian_icon.$accordian_title;
                        $output .='<span class="pull-right">';
                            $output .='<i class="fa '.$icon_class.'"></i>';
                        $output .='</span>';
                    $output .='</h4>';
                $output .='</a>';
            $output .='</div>';
            $output .='<div id="accordian-panel-'.$i.'" class="panel-collapse collapse '.$class.'">';
                $output .='<div class="panel-body">';
                    if($thumb[0]):
                        $output .='<div class="col-md-2 col-sm-2 col-xs-6 no-padding xs-margin-bottom-five">';
                            $output .='<img src="'.$thumb[0].'" '.$image_alt.$image_title.' class="white-round-border no-border spa-packages-img" width="'.$thumb[1].'" height="'.$thumb[2].'" />';
                        $output .='</div>';
                        $output .='<div class="col-md-9 col-sm-9 col-xs-12 sm-pull-right col-md-offset-1 no-padding">';
                            if( $content ):
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                            endif;
                            if($button_title):
                                $output .='<a class="highlight-button-dark btn btn-very-small button" target="'.$button_target.'" href="'.$button_link.'">'.$button_title.'</a>';
                            endif;
                        $output .='</div>';
                    else:
                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                $output .='</div>';
            $output .='</div>';
        $output .='</div>';

        $i++;
    	return $output;
    }
}
add_shortcode( 'hcode_accordian_content', 'hcode_accordian_content_shortcode' );
?>