<?php
/**
 * Shortcode For Career
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Career */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_career_shortcode' ) ) {
    function hcode_career_shortcode($atts, $content = null){
    	extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'hcode_career_left' => '',
            'hcode_career_number' => '',
            'hcode_career_show_separator' =>'',
            'hcode_career_job_title' => '',
            'hcode_career_job_experince' => '',
            'hcode_career_apply_now' => '',
            'hcode_career_urgent_job' => '',
            'hcode_career_number_color' => '',
            'hcode_career_show_separator_color' => '',
            'hcode_career_job_title_color' => '',
            'hcode_career_job_experince_color' => '',
            'hcode_career_urgent_job_color' => '',
            'hcode_career_right' => '',
            'hcode_career_overview_title' => '',
            'hcode_career_overview_content' => '',
            'hcode_career_responsibilities_title' => '',
            'hcode_career_responsibilities_content' => '',
            'hcode_career_bottom_separator' => '',
        ), $atts ) );
            
    	$output = '';

    	$id = ( $id ) ? ' id="'.$id.'"' : '';
    	$class = ( $class ) ? ' '.$class : '';
    	
        $hcode_career_left = ( $hcode_career_left ) ? $hcode_career_left : '';
        $hcode_career_number = ( $hcode_career_number ) ? $hcode_career_number : '';
        $hcode_career_show_separator = ( $hcode_career_show_separator ) ? $hcode_career_show_separator : '';
        $hcode_career_job_title = ( $hcode_career_job_title ) ? $hcode_career_job_title : '';
        $hcode_career_job_experince = ( $hcode_career_job_experince ) ? $hcode_career_job_experince : '';
        $hcode_career_apply_now = ( $hcode_career_apply_now ) ? $hcode_career_apply_now : '';
        $hcode_career_urgent_job = ( $hcode_career_urgent_job ) ? $hcode_career_urgent_job : '';
        $hcode_career_number_color = ( $hcode_career_number_color ) ? ' style=" color:'.$hcode_career_number_color.'"' : '';
        $hcode_career_show_separator_color = ( $hcode_career_show_separator_color ) ? ' style=" background:'.$hcode_career_show_separator_color.'"' : '';
        $hcode_career_job_title_color = ( $hcode_career_job_title_color ) ? ' style=" color:'.$hcode_career_job_title_color.'"' : '';
        $hcode_career_job_experince_color = ( $hcode_career_job_experince_color ) ? ' style=" color:'.$hcode_career_job_experince_color.'"' : '';
        $hcode_career_urgent_job_color = ( $hcode_career_urgent_job_color ) ? ' style=" color:'.$hcode_career_urgent_job_color.'"' : '';
        $hcode_career_right = ( $hcode_career_right ) ? $hcode_career_right : '';
        $hcode_career_overview_title = ( $hcode_career_overview_title ) ? $hcode_career_overview_title : '';
        $hcode_career_overview_content = ( $hcode_career_overview_content ) ? $hcode_career_overview_content : '';
        $hcode_career_responsibilities_title = ( $hcode_career_responsibilities_title ) ? $hcode_career_responsibilities_title : '';
        $hcode_career_responsibilities_content = ( $hcode_career_responsibilities_content ) ? $hcode_career_responsibilities_content : '';
        $hcode_career_bottom_separator = ( $hcode_career_bottom_separator ) ? $hcode_career_bottom_separator : '';
        
        if (function_exists('vc_parse_multi_attribute')) {
            // For Button
            $hcode_career_apply_now_args = vc_parse_multi_attribute($hcode_career_apply_now);
            $hcode_career_apply_now_link     = ( isset($hcode_career_apply_now_args['url']) ) ? $hcode_career_apply_now_args['url'] : '#';
            $hcode_career_apply_now_title    = ( isset($hcode_career_apply_now_args['title']) ) ? $hcode_career_apply_now_args['title'] : '';
            $hcode_career_apply_now_target   = ( isset($hcode_career_apply_now_args['target']) ) ? trim($hcode_career_apply_now_args['target']) : '_self';
        }
        $output .= '<div class="clearfix">';
            if( $hcode_career_left == 1 ):
                $output .= '<div class="col-md-6 col-sm-12 no-padding-left position-relative">';
                    if( $hcode_career_number ):
                        $output .= '<h2 class="font-weight-600"'.$hcode_career_number_color.'>'.$hcode_career_number.'</h2>';
                    endif;
                    if( $hcode_career_show_separator ):
                        $output .= '<div class="separator-line no-margin-lr"'.$hcode_career_show_separator_color.'></div>';
                    endif;
                    if( $hcode_career_job_title ):
                        $output .= '<p class="text-large letter-spacing-2 no-margin-bottom"'.$hcode_career_job_title_color.'>'.$hcode_career_job_title.'</p>';
                    endif;
                    if( $hcode_career_job_experince ):
                        $output .= '<p class="text-uppercase letter-spacing-1"'.$hcode_career_job_experince_color.'>'.$hcode_career_job_experince.'</p>';
                    endif;
                    if( $hcode_career_apply_now_title ):
                        $output .= '<a class="highlight-button-black-border btn btn-medium" href="'.$hcode_career_apply_now_link.'" target="'.$hcode_career_apply_now_target.'">'.$hcode_career_apply_now_title.'</a>';
                    endif;
                    if( $hcode_career_urgent_job ):
                        $output .= '<span class="urgent-job text-uppercase letter-spacing-1 font-weight-600 bg-red"'.$hcode_career_urgent_job_color.'>'.$hcode_career_urgent_job.'</span>';
                    endif;
                $output .= '</div>';
            endif;
            if( $hcode_career_right == 1 ):
                $output .= '<div class="col-md-6 col-sm-12 no-padding-left">';
                    if( $hcode_career_overview_title ):
                        $output .= '<p class="black-text no-margin"><strong>'.$hcode_career_overview_title.'</strong></p>';
                    endif;
                    if( $hcode_career_overview_content ):
                        $output .= '<p class="margin-one">'.$hcode_career_overview_content.'</p>';
                    endif;
                    if( $hcode_career_responsibilities_title ):
                        $output .= '<p class="black-text margin-ten no-margin-bottom"><strong>'.$hcode_career_responsibilities_title.'</strong></p>';
                    endif;
                    if( $hcode_career_responsibilities_content ):
                        $output .= '<p class="margin-one">'.$hcode_career_responsibilities_content.'</p>';
                    endif;
                $output .= '</div>';
            endif;
        $output .= '</div>';
        if( $hcode_career_bottom_separator == 1 ):
            $output .= '<div class="wide-separator-line no-margin-lr margin-ten"></div>';
        endif;

    	return $output;
    }
}
add_shortcode( 'hcode_career', 'hcode_career_shortcode' );
?>