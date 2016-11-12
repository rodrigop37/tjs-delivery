<?php
/**
 * Shortcode For Alert Message
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Alert Message */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_alert_massage_shortcode' ) ) {
	function hcode_alert_massage_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
	        	'id' => '',
	        	'class' => '',
	        	'hcode_alert_massage_premade_style' => '',
	        	'alert_massage_preview_image' => '',
	        	'hcode_alert_massage_type' => '',
	        	'hcode_message_icon' => '',
	        	'hcode_highliget_title' => '',
	        	'hcode_subtitle' => '',
	        	'show_close_button' => '',
	        ), $atts ) );
		$output = '';

		$id = ( $id ) ? ' id="'.$id.'"' : '';
		$class = ( $class ) ? ' '.$class : '';
		$hcode_alert_massage_premade_style = ( $hcode_alert_massage_premade_style ) ? $hcode_alert_massage_premade_style : '';
		$hcode_alert_massage_type = ( $hcode_alert_massage_type ) ? 'alert-'.$hcode_alert_massage_type : '';
		$hcode_message_icon = ( $hcode_message_icon ) ? $hcode_message_icon : '';
		$hcode_highliget_title = ( $hcode_highliget_title ) ? $hcode_highliget_title : '';
		$hcode_subtitle = ( $hcode_subtitle ) ? $hcode_subtitle : '';
		$show_close_button = ( $show_close_button ) ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' : '';

		switch ($hcode_alert_massage_premade_style) {
			case 'alert-massage-style-1':
				$output .= '<div class="alert-style6">';
					$output .= '<div role="alert" class="alert '.$hcode_alert_massage_type.'">';
						if($hcode_message_icon):
							$output .= '<i class="'.$hcode_message_icon.'"></i>';
						endif;
						if($hcode_highliget_title || $hcode_subtitle):
							$output .= '<span>';
								if($hcode_highliget_title):
									$output .= '<strong>'.$hcode_highliget_title.'</strong> ';
								endif;
								$output .= $hcode_subtitle;
							$output .= '</span>';
						endif;
		            $output .= '</div>';
	            $output .= '</div>';
			break;
			case 'alert-massage-style-2':
				$output .= '<div role="alert" class="alert '.$hcode_alert_massage_type.' fade in">';
					if($hcode_message_icon):
						$output .= '<i class="'.$hcode_message_icon.' '.$hcode_alert_massage_type.'"></i>';
					endif;
					if($hcode_highliget_title || $hcode_subtitle):
		                $output .= ' <span>';
			                $output .= '<strong>'.$hcode_highliget_title.'</strong> ';
			                $output .= $hcode_subtitle;
		                $output .= '</span>';
	                endif;
	                $output .= $show_close_button;
	            $output .= '</div>';
			break;
			case 'alert-massage-style-3':
				$output .= '<div class="alert-style5">';
					$output .= '<div role="alert" class="alert '.$hcode_alert_massage_type.'">';
					if($hcode_message_icon):
						$output .= '<i class="'.$hcode_message_icon.' '.$hcode_alert_massage_type.'"></i>';
					endif;
					if($hcode_highliget_title || $hcode_subtitle):
						$output .= '<span>';
							if($hcode_highliget_title):
								$output .= '<strong>'.$hcode_highliget_title.'</strong> ';
							endif;
							$output .= $hcode_subtitle;
						$output .= '</span>';
					endif;
					$output .= $show_close_button;
		            $output .= '</div>';
	            $output .= '</div>';
			break;
			case 'alert-massage-style-4':
				$output .= '<div role="alert" class="alert '.$hcode_alert_massage_type.'">';
					if($hcode_highliget_title || $hcode_subtitle):
						$output .= '<span>';
							if($hcode_highliget_title):
								$output .= '<strong>'.$hcode_highliget_title.'</strong> ';
							endif;
							$output .= $hcode_subtitle;
						$output .= '</span>';
					endif;
					$output .= $show_close_button;
	            $output .= '</div>';
			break;
			case 'alert-massage-style-5':
				$output .='<div class="alert-style2">';
					$output .= '<div role="alert" class="alert '.$hcode_alert_massage_type.'">';
						if($hcode_highliget_title || $hcode_subtitle):
							$output .= '<span>';
								if($hcode_highliget_title):
									$output .= '<strong>'.$hcode_highliget_title.'</strong> ';
								endif;
								$output .= $hcode_subtitle;
							$output .= '</span>';
						endif;
						$output .= $show_close_button;
		            $output .= '</div>';
				$output .= '</div>';
			break;
			case 'alert-massage-style-6':
				$output .='<div class="alert-style3">';
					$output .= '<div role="alert" class="alert '.$hcode_alert_massage_type.'">';
						if($hcode_highliget_title || $hcode_subtitle):
							$output .= '<span>';
								if($hcode_highliget_title):
									$output .= '<strong>'.$hcode_highliget_title.'</strong> ';
								endif;
								$output .= $hcode_subtitle;
							$output .= '</span>';
						endif;
						$output .= $show_close_button;
		            $output .= '</div>';
				$output .= '</div>';
			break;
			case 'alert-massage-style-7':
				$output .='<div class="alert-style4">';
					$output .= '<div role="alert" class="alert '.$hcode_alert_massage_type.'">';
						if($hcode_highliget_title || $hcode_subtitle):
							$output .= '<span>';
								if($hcode_highliget_title):
									$output .= '<strong>'.$hcode_highliget_title.'</strong> ';
								endif;
								$output .= $hcode_subtitle;
							$output .= '</span>';
						endif;
						$output .= $show_close_button;
		            $output .= '</div>';
				$output .= '</div>';
			break;
			case 'alert-massage-style-8':
				$output .= '<div role="alert" class="alert alert-block fade in '.$hcode_alert_massage_type.'">';
					$output .= $show_close_button;
					if($hcode_highliget_title):
						$output .= '<h3 class="'.$hcode_alert_massage_type.' margin-two no-margin-top">'.$hcode_highliget_title.'</h3>';
					endif;
					if($hcode_subtitle):
						$output .= '<p>'.$hcode_subtitle.'</p>';
					endif;
		        $output .= '</div>';
			break;
			default:
			break;
		}
	    return $output;
	}
}
add_shortcode('hcode_alert_massage','hcode_alert_massage_shortcode');
?>