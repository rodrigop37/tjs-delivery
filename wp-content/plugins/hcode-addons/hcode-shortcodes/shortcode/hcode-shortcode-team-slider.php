<?php
/**
 * Shortcode For Team Member Slider
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Team Member Slider */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_team_slider_shortcode' ) ) {
	function hcode_team_slider_shortcode( $atts, $content = null ) {

		extract( shortcode_atts( array(
	        	 'show_pagination' => '',
	                'show_pagination_style' => '',
	                'show_navigation' => '',
	                'show_navigation_style' => '',
	                'show_pagination_color_style' => '',
	                'hcode_image_carousel_itemsdesktop' => '3',
	                'hcode_image_carousel_itemstablet' => '3',
	                'hcode_image_carousel_itemsmobile' => '1',
	                'hcode_image_carousel_autoplay' => '',
	                'hcode_slider_id' => '',
	                'hcode_slider_class' => '',
	                'show_cursor_color_style' => '',
	                'stoponhover' => '',
                    'slidespeed' => '3000',
	    ), $atts ) );

		$output = $slider_config = '';
	    $navigation = ( $show_navigation_style ) ? hcode_owl_navigation_slider_classes( $show_navigation_style) : hcode_owl_navigation_slider_classes('default') ;
	    $pagination = hcode_owl_pagination_slider_classes($show_pagination_style);
	    $pagination_style = hcode_owl_pagination_color_classes($show_pagination_color_style);
	    $hcode_slider_id = ( $hcode_slider_id ) ? $hcode_slider_id : 'team-agency';
	    $hcode_slider_class  = ( $hcode_slider_class ) ? ' '.$hcode_slider_class : '';
	    $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' cursor-black';
	            
		$output .= '<div class="team-agency-owl position-relative">';
	        $output .= '<div class="container">';
	            $output .= '<div class="row">';
					$output .= '<div id="'.$hcode_slider_id.'" class="owl-carousel owl-theme team-agency '.$show_cursor_color_style.$pagination.$navigation.$pagination_style.$navigation.$hcode_slider_class.'">';
							$output .= do_shortcode($content);
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			if( $show_navigation == 1 ):
	            if($show_navigation_style == 1):
	                $output .= '<div class="feature_nav">';
	                    $output .= '<a class="prev left carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre.png" width="96" height="96"></a>';
	                    $output .= '<a class="next right carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next.png" width="96" height="96"></a>';
	                $output .= '</div>';
	            else:
	                $output .= '<div class="feature_nav">';
	                    $output .= '<a class="prev left carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-white-bg.png" width="96" height="96"></a>';
	                    $output .= '<a class="next right carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-white-bg.png" width="96" height="96"></a>';
	                $output .= '</div>';
	            endif;
	        endif;
	    $output .= '</div>';

		/* Add custom script Start*/
		$slidespeed = ( $slidespeed ) ? $slidespeed : '3000'; 
	    ( $show_pagination == 1 ) ? $slider_config .= 'pagination: true,' : $slider_config .= 'pagination: false,';
	    ( $hcode_image_carousel_autoplay == 1 ) ? $slider_config .= 'autoPlay: '.$slidespeed.',' : $slider_config .= 'autoPlay: false,';
        ( $stoponhover == 1) ? $slider_config .= 'stopOnHover: true, ' : $slider_config .= 'stopOnHover: false, ';
	    ( $hcode_image_carousel_itemsdesktop ) ? $slider_config .= 'items: '.$hcode_image_carousel_itemsdesktop.',' : $slider_config .= 'items: 3,';
	    ( $hcode_image_carousel_itemsdesktop ) ? $slider_config .= 'itemsDesktop: [1200,'.$hcode_image_carousel_itemsdesktop.'],' : $slider_config .= 'itemsDesktop: [1200, 3],';
	    ( $hcode_image_carousel_itemstablet ) ? $slider_config .= 'itemsTablet: [991,'.$hcode_image_carousel_itemstablet.'],' : $slider_config .= 'itemsTablet: [991, 2],';
	    ( $hcode_image_carousel_itemsmobile ) ? $slider_config .= 'itemsMobile: [700,'.$hcode_image_carousel_itemsmobile.'],' : $slider_config .= 'itemsMobile: [700, 1],';

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
add_shortcode('hcode_team_slider','hcode_team_slider_shortcode');

if ( ! function_exists( 'hcode_team_slide_content_shortcode' ) ) {
	function hcode_team_slide_content_shortcode( $atts, $content = null ) {

		extract( shortcode_atts( array(
				'id' => '',
	        	'class' => '',
	        	'hcode_team_member_image' => '',
	        	'hcode_team_member_title' => '',
	        	'hcode_team_member_designation' => '',
	        	'hcode_team_member_headline' => '',
	        	'hcode_team_member_separator' => '',
	        	'hcode_team_member_fb' => '',
	        	'hcode_team_member_fb_url' => '',
	        	'hcode_team_member_tw' => '',
	        	'hcode_team_member_tw_url' => '',
	        	'hcode_team_member_googleplus' => '',
	        	'hcode_team_member_googleplus_url' => '',
	        	'hcode_column_animation_style' => '',
	        	'hcode_column_animation_duration' => '',
	        	'hcode_title_color' => '',
	        	'hcode_designation_color' => '',
	    ), $atts ) );

	    $id = ( $id ) ? ' id="'.$id.'"' : '';
		$class = ( $class ) ? ' '.$class : '';

		/* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($hcode_team_member_image);
        $img_title = hcode_option_image_title($hcode_team_member_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';
        
		$hcode_team_member_image = ( $hcode_team_member_image ) ? $hcode_team_member_image : '';
		$thumb = wp_get_attachment_image_src($hcode_team_member_image, 'full');
		$hcode_team_member_title = ( $hcode_team_member_title ) ? $hcode_team_member_title : '';
		$hcode_team_member_designation = ( $hcode_team_member_designation ) ? $hcode_team_member_designation : '';
		$hcode_team_member_separator = ( $hcode_team_member_separator ) ? $hcode_team_member_separator : '';
		$hcode_team_member_headline = ( $hcode_team_member_headline ) ? $hcode_team_member_headline : '';
		$hcode_team_member_fb = ( $hcode_team_member_fb ) ? $hcode_team_member_fb : '';
		$hcode_team_member_fb_url = ( $hcode_team_member_fb_url ) ? $hcode_team_member_fb_url : '#';
		$hcode_team_member_tw = ( $hcode_team_member_tw ) ? $hcode_team_member_tw : '';
		$hcode_team_member_tw_url = ( $hcode_team_member_tw_url ) ? $hcode_team_member_tw_url : '#';
		$hcode_team_member_googleplus = ( $hcode_team_member_googleplus ) ? $hcode_team_member_googleplus : '';
		$hcode_team_member_googleplus_url = ( $hcode_team_member_googleplus_url ) ? $hcode_team_member_googleplus_url : '#';
		$hcode_designation_color = ( $hcode_designation_color ) ? 'style="color: '.$hcode_designation_color.' !important;"' : '';
		$hcode_title_color = ( $hcode_title_color ) ? 'style="color: '.$hcode_title_color.' !important;"' : '';

		$target = 'target="_BLANK"';

		$hcode_column_animation_style = ( $hcode_column_animation_style ) ? ' wow '.$hcode_column_animation_style : '';
	    $hcode_column_animation_duration = ( $hcode_column_animation_duration ) ? ' data-wow-duration= '.$hcode_column_animation_duration.'ms' : '';

		$output = '';
		$output .= '<div class="text-center team-member'.$class.$hcode_column_animation_style.'"'.$id.' '.$hcode_column_animation_duration.'>';
					if( $thumb[0] ):
		            	$output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
		        	endif;
					$output .= '<figure class="position-relative bg-white">';
						if( $hcode_team_member_title ):
		                	$output .= '<span class="team-name text-uppercase black-text letter-spacing-2 display-block font-weight-600" '.$hcode_title_color.'>'.$hcode_team_member_title.'</span>';
		                endif;
		                if( $hcode_team_member_designation ):
		                	$output .= '<span class="team-post text-uppercase letter-spacing-2 display-block" '.$hcode_designation_color.'>'.$hcode_team_member_designation.'</span>';
		            	endif;
		                            
		                if( $hcode_team_member_fb || $hcode_team_member_tw || $hcode_team_member_googleplus ):
		                    $output .= '<div class="person-social margin-five no-margin-bottom">';
		                		if( $hcode_team_member_fb ):
			                    	$output .= '<a '.$target.' href="'.$hcode_team_member_fb_url.'" class="black-text-link"><i class="fa fa-facebook"></i></a>';
			                	endif;
			                	if( $hcode_team_member_tw ):
			                    	$output .= '<a '.$target.' href="'.$hcode_team_member_tw_url.'" class="black-text-link"><i class="fa fa-twitter"></i></a>';
			                	endif;
			                	if( $hcode_team_member_googleplus ):
			                    	$output .= '<a '.$target.' href="'.$hcode_team_member_googleplus_url.'" class="black-text-link"><i class="fa fa-google-plus"></i></a>';
			                	endif;
		                    $output .= '</div>';
		                endif;
		            $output .= '</figure>';
		            $output .= '<div class="team-details bg-blck-overlay">';
		            	if( $hcode_team_member_headline ):
		            		$output .= '<h5 class="team-headline white-text text-uppercase font-weight-600">'.$hcode_team_member_headline.'</h5>';
		            	endif;
		            	if( $content ):
		                	$output .= do_shortcode( hcode_remove_wpautop( $content ) );
		            	endif;
		                if( $hcode_team_member_separator ):
		                	$output .= '<div class="separator-line-thick bg-white"></div>';
		               	endif;
		            $output .= '</div>';
		        $output .= '</div>';
		        return $output;
	}
}
add_shortcode('hcode_team_slide_content','hcode_team_slide_content_shortcode');
?>