<?php
/**
 * Shortcode For Time Counter
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Time Counter */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_time_counter_shortcode' ) ) {
    function hcode_time_counter_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'hcode_time_counter_date' => '',
            'hcode_time_counter_color' => '',
        ), $atts ) );
        
        $output = '';
        $id = ($id) ? 'id='.$id : '';
        $class = ($class) ? ' '.$class : '';
        $hcode_time_counter_date = ( $hcode_time_counter_date ) ? $hcode_time_counter_date : '';
        $hcode_time_counter_color = ( $hcode_time_counter_color ) ? ' style="color:'.$hcode_time_counter_color.'"' : '';
        
        // Time
        $output .= '<div id="hcode-time-counter" class="hcode-time-counter"'.$hcode_time_counter_color.'></div>';
        if($hcode_time_counter_date):
            $output .= '<span class="hide hcode-time-counter-date counter-hidden">'.$hcode_time_counter_date.'</span>';
        endif;
        return $output;
    }
}
add_shortcode( 'hcode_time_counter', 'hcode_time_counter_shortcode' );
?>