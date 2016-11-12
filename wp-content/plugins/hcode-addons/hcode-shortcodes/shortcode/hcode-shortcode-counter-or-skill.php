<?php
/**
 * Shortcode For Counter or Skill
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Hcode Counter or Skill */
/*-----------------------------------------------------------------------------------*/
$count = 1;
if ( ! function_exists( 'hcode_counter_or_skill_shortcode' ) ) {
    function hcode_counter_or_skill_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'counter_or_chart' => '',
            'counter_icon' =>'',
            'counter_number' => '',
            'counter_number_style' => '',
            'counter_number_color' => '',
            'title' => '',
            'title_style' => '',
            'title_color' => '',
            'icon_color' => '',
            'subtitle' => '',
            'subtitle_style' => '',
            'subtitle_color' => '',
            'counter_icon_size' => '',
            'counter_animation_duration' => '',
            'hcode_row_animation_style' => '',
            'skill_percent'=>'',
            'skill_percent_style' =>'',
            'skill_percent_color' => '',
            'skill_line_width' => '',
            'skill_barcolor_color' => '',
            'skill_trackcolor_color' => '',
            'animate_duration' => '',
        ), $atts ) );

        $output = '';    
    	global $count, $skill;
    	
    	$counter_style_attr = $counter_class_attr = $title_style_attr = $title_class_attr = $skill_style_attr = $skill_class_attr = '';
    	$counter_icon = ( $counter_icon ) ? $counter_icon : '' ;
    	$counter_icon_size = ( $counter_icon_size ) ? ' '.$counter_icon_size : ' medium-icon';
    	$counter_animation_duration = ( $counter_animation_duration ) ? $counter_animation_duration : '';
    	$hcode_row_animation_style = ( $hcode_row_animation_style ) ? ' wow '.$hcode_row_animation_style : '';
    	$counter_number = ( $counter_number ) ? $counter_number : '';
    	$icon_color = ($icon_color) ? 'style ="color: '.$icon_color.'"' : '';
    	// For Counter Style
    	if($counter_number_style == 'custom'){
    		$counter_style_attr = ( $counter_number_color ) ? 'style ="color: '.$counter_number_color.'"' : '';
    	}else{
    		$counter_class_attr = ( $counter_number_style ) ? ' '.$counter_number_style : '';
    	}
    	// For Title Style
    	if($title_style == 'custom'){
    		$title_style_attr = ( $title_color ) ? 'style="color: '.$title_color.'"' : '';
    	}else{
    		$title_class_attr = ( $title_style ) ? ' '.$title_style : '';
    	}

    	/* Skill */
    	$skill_percent = ( $skill_percent ) ? $skill_percent : '';

    	if($skill_percent_style == 'custom'){
    		$skill_style_attr = ( $skill_percent_color ) ? 'style:"color: '.$skill_percent_color.'"' : '';
    		$skill_style_attr .= ' style= "color: '.$skill_percent_color.'" ';
    	}else{
    		$skill_class_attr = ( $skill_percent_style ) ? ' '.$skill_percent_style : '';
    	}
        // Skill config
        $skill_line_width = ( $skill_line_width ) ? $skill_line_width : '1';
        $skill_barcolor_color = ( $skill_barcolor_color ) ? $skill_barcolor_color : '#FFF';
        $skill_trackcolor_color = ( $skill_trackcolor_color ) ? $skill_trackcolor_color : '#535353';
        $animate_duration = ( $animate_duration ) ? $animate_duration : '2000';
            

        switch ($counter_or_chart) {
            case 'counter':
    			$count++;
          		$counter_id = '#counter_'.$count;
    			$output .= '<div class="counter-section">';
            		if($counter_icon):
                    	$output .= '<i class="'.$counter_icon.$counter_icon_size.'" '.$icon_color.'></i>';
                            endif;
                    if($counter_number):
                    	$output .= '<span id="counter_'.$count.'" data-to="'.$counter_number.'" class="counter-number'.$counter_class_attr.'" '.$counter_style_attr.'>'.$counter_number.'</span>';
                	endif;
                	if($title):
                    	$output .= '<span class="counter-title'.$title_class_attr.'" '.$title_style_attr.'>'.$title.'</span>';
                	endif;
               	$output .= '</div>'; 
            break;
            case 'skill':
                $skill++;
            	$output .= '<div class="chart-style2">';
            		if($skill_percent):
    					$output .= '<div class="chart-percent">';
    						$output .= '<span data-percent="'.$skill_percent.'" class="chart chart-'.$skill.$title_class_attr.'" '.$skill_style_attr.'>';
    							$output .= '<span class="percent alt-font">'.$skill_percent.'</span>';
    						$output .= '</span>';
    					$output .= '</div>';
    				endif;
    				if(!empty($title) || !empty($subtitle)):
    	                $output .= '<div class="chart-text">';
    	                	if($title):
    	                    	$output .= '<h5 class="'.$title_class_attr.'" '.$title_style_attr.'>'.$title.'</h5>';
    	                	endif;
    	                	if($subtitle):
    	                    	$output .= '<p>'.$subtitle.'</p>';
    	                    endif;
    	                $output .= '</div>';
                    endif;
                $output .= '</div>';

            ob_start();?>
            <script type="text/javascript">jQuery(function() { jQuery('<?php echo '.chart-'.$skill ;?>').easyPieChart({ barColor: '<?php echo $skill_barcolor_color;?>', trackColor: '<?php echo $skill_trackcolor_color;?>', scaleColor: false, easing: 'easeOutBounce', scaleLength: 1, lineCap: 'round', lineWidth: <?php echo $skill_line_width; ?>, size: 120, animate: { duration: <?php echo $animate_duration; ?>, enabled: true }, onStep: function (from, to, percent) {  $(this.el).find('.percent').text(Math.round(percent)); } }); }); </script>
            <?php 
            $script = ob_get_contents();
            ob_end_clean();
            $output .= $script;
            break;
        }
        return $output;        
    }
}
add_shortcode( 'hcode_counter_or_skill', 'hcode_counter_or_skill_shortcode' );
?>