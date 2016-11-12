<?php
/**
 * Shortcode For Team Member
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Team Member */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_team_member_shortcode' ) ) {
	function hcode_team_member_shortcode( $atts, $content = null ) {

		extract( shortcode_atts( array(
	        	'id' => '',
	        	'class' => '',
	        	'hcode_team_member_premade_style' => '',
	        	'hcode_team_member_preview_image' => '',
	        	'hcode_team_member_image_position' => '',
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
	        	'hcode_title_color' => '',
	                'hcode_separator_color' => '',
	        	'hcode_designation_color' => '',
	                'hcode_team_bg_color' => '',
	    ), $atts ) );

		$output = $image_position_class = $content_position_class = '';

		$id = ( $id ) ? ' id="'.$id.'"' : '';
		$class = ( $class ) ? ' '.$class : '';

		$hcode_team_member_premade_style = ( $hcode_team_member_premade_style ) ? $hcode_team_member_premade_style : '';
		$hcode_team_member_image = ( $hcode_team_member_image ) ? $hcode_team_member_image : '';
		
		/* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($hcode_team_member_image);
        $img_title = hcode_option_image_title($hcode_team_member_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';

		$thumb = wp_get_attachment_image_src($hcode_team_member_image, 'full');
		$hcode_team_member_image_position = ( $hcode_team_member_image_position ) ? $hcode_team_member_image_position : '';
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
	    $hcode_team_bg_color = ( $hcode_team_bg_color ) ? 'style="background: '.$hcode_team_bg_color.' !important;"' : '';
	    $hcode_separator_color = ( $hcode_separator_color ) ? 'style="background: '.$hcode_separator_color.' !important;"' : '';

		$target = 'target="_BLANK"';

		switch ($hcode_team_member_premade_style) {
			case 'team-style-1':
				$output .= '<div class="key-person '.$class.'" '.$id.'>';
					if( $thumb[0] ):
	            		$output .= '<div class="key-person-img"><img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'" ></div>';
	            	endif;
	                $output .= '<div class="key-person-details bg-white">';
	                	if( $hcode_team_member_title ):
	                    $output .= '<span class="person-name black-text" '.$hcode_title_color.'>'.$hcode_team_member_title.'</span>';
	                	endif;
	                	if( $hcode_team_member_designation ):
	                    $output .= '<span class="person-post" '.$hcode_designation_color.'>'.$hcode_team_member_designation.'</span>';
	                	endif;
	                    if( $hcode_team_member_separator ):
	                    	$output .= '<div class="separator-line bg-yellow"></div>';
	                	endif;
	                	if( $hcode_team_member_fb || $hcode_team_member_tw || $hcode_team_member_googleplus ):
	                    $output .= '<div class="person-social">';
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
	                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
	                $output .= '</div>';
	            $output .= '</div>';
			break;

			case 'team-style-2':
				$output .= '<div class="key-person '.$class.'" '.$id.'>';
					if( $thumb[0] ):
	            		$output .= '<div class="key-person-img"><img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"></div>';
	            	endif;
	                $output .= '<div class="key-person-details bg-gray no-border no-padding-bottom">';
	                	if( $hcode_team_member_title ):
	                    $output .= '<h5 '.$hcode_title_color.'>'.$hcode_team_member_title.'</h5>';
	                	endif;
	                    if( $hcode_team_member_separator ):
	                    	$output .= '<div class="separator-line bg-black"></div>';
	                	endif;
	                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
	                $output .= '</div>';
	            $output .= '</div>';
			break;

			case 'team-style-3':
				$output .= '<div class="team-member position-relative agency-team '.$class.'" '.$id.'>';
					$output .= '<div class="'.$class.'"'.$id.'>';
						if( $thumb[0] ):
		            		$output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'">';
		            	endif;
		                $output .= '<div class="team-details bg-blck-overlay">';
		                	if( $hcode_team_member_headline ):
		                    	$output .= '<h5 class="team-headline white-text text-uppercase font-weight-600">'.$hcode_team_member_headline.'</h5>';
		                	endif;
		                	if($content):
		                		$output .= '<p class="width-60 center-col light-gray-text margin-five">'.do_shortcode( $content ).'</p>';
		                	endif;
		                	if( $hcode_team_member_fb || $hcode_team_member_tw || $hcode_team_member_googleplus ):
			                    $output .= '<div class="person-social margin-five">';
	                                            if( $hcode_team_member_fb ):
	                                            $output .= '<a '.$target.' href="'.$hcode_team_member_fb_url.'" class="white-text-link"><i class="fa fa-facebook"></i></a>';
	                                            endif;
	                                            if( $hcode_team_member_tw ):
	                                            $output .= '<a '.$target.' href="'.$hcode_team_member_tw_url.'" class="white-text-link"><i class="fa fa-twitter"></i></a>';
	                                            endif;
	                                            if( $hcode_team_member_googleplus ):
	                                            $output .= '<a '.$target.' href="'.$hcode_team_member_googleplus_url.'" class="white-text-link"><i class="fa fa-google-plus"></i></a>';
	                                            endif;
			                    $output .= '</div>';
		                    endif;
		                    $output .= '<figure class="position-absolute bg-fast-yellow">';
			                	if( $hcode_team_member_title ):
			                    $output .= '<span class="team-name text-uppercase black-text letter-spacing-2 display-block font-weight-600" '.$hcode_title_color.'>'.$hcode_team_member_title.'</span>';
			                	endif;
			                    if( $hcode_team_member_designation ):
			                    	$output .= '<span class="team-post text-uppercase black-text letter-spacing-2 display-block" '.$hcode_designation_color.'>'.$hcode_team_member_designation.'</span>';
			                	endif;
			                $output .= '</figure>';

		                $output .= '</div>';
		            $output .= '</div>';
		        $output .= '</div>';
			break;

			case 'team-style-4':
				$output .= '<div class="fashion-team key-person-fashion '.$class.'" '.$id.'>';
	                $output .= '<div class="key-person">';
	                	if( $thumb[0] ):
	                    	$output .= '<div class="key-person-img"><img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"></div>';
	                    endif;
	                    $output .= '<div class="key-person-details bg-white">';
	                    	if( $hcode_team_member_title ):
	                    		$output .= '<span class="person-name black-text" '.$hcode_title_color.'>'.$hcode_team_member_title.'</span>';
	                    	endif;
	                    	if( $hcode_team_member_designation ):
	                    		$output .= '<span class="person-post black-text" '.$hcode_designation_color.'>'.$hcode_team_member_designation.'</span>';
	                    	endif;
	                    	if( $hcode_team_member_separator ):
								$output .= '<div class="separator-line" '.$hcode_separator_color.'></div>';
							endif;
	                        if( $hcode_team_member_fb || $hcode_team_member_tw || $hcode_team_member_googleplus ):
			                    $output .= '<div class="person-social">';
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
		                    if( $content ):
								$output .= '<p class="margin-three black-text">'.do_shortcode( $content ).'</p>';
							endif;
	                    $output .= '</div>';
	                $output .= '</div>';
				$output .= '</div>';
			break;

			case 'team-style-5':
				$output .= '<div class="key-person '.$class.'" '.$id.'>';
	                if( $thumb[0] ):
		            	$output .= '<div class="key-person-img"><img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"></div>';
		            endif;
		            if( $hcode_team_member_title || $content || $hcode_team_member_separator ):
		                $output .='<div class="key-person-details no-border bg-white">';
		                	if( $hcode_team_member_title ):
			                	$output .='<span class="person-name black-text margin-five no-margin-top" '.$hcode_title_color.'>'.$hcode_team_member_title.'</span>';
			                endif;
			                if( $content ):
			                	$output .= do_shortcode( hcode_remove_wpautop( $content ) );
			            	endif;
			            	if( $hcode_team_member_separator ):
				                $output .='<div class="thin-separator-line bg-black"></div>';
			            	endif;
		                $output .='</div>';
	                endif;
	            $output .='</div>';
			break;

			case 'team-style-6':
				if($hcode_team_member_image_position == 1):
					if( $thumb[0] ):
		            	$output .= '<div class="col-lg-6 col-md-5 col-sm-6 no-padding'.$image_position_class.'"><img class="xs-img-full" '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"></div>';
		        	endif;
					$output .= '<div class="col-lg-6 col-md-7 col-sm-6 xs-margin-ten-top no-padding '.$class.'" '.$id.'>';
						$output .= '<div class="architecture-team team-member xs-no-padding">';
							if( $hcode_team_member_title ):
		                    	$output .= '<span class="team-name text-uppercase black-text letter-spacing-2 display-block font-weight-600" '.$hcode_title_color.'>'.$hcode_team_member_title.'</span>';
		                    endif;
		                    if( $hcode_team_member_designation ):
		                    	$output .= '<span class="team-post text-uppercase letter-spacing-2 display-block" '.$hcode_designation_color.'>'.$hcode_team_member_designation.'</span>';
		                	endif;
		                    if( $hcode_team_member_separator ):
			                    $output .= '<div class="separator-line bg-black no-margin-lr margin-ten"></div>';
			                endif;
		                    $output .= '<span class="margin-ten display-block clearfix xs-margin-0auto"></span>';
		                    if( $content ):
			                	$output .= '<p class="margin-ten xs-no-margin-top">'.do_shortcode( $content ).'</p>';
			            	endif;
		                    $output .= '<span class="margin-ten display-block clearfix xs-margin-0auto"></span>';
		                    if( $hcode_team_member_fb || $hcode_team_member_tw || $hcode_team_member_googleplus ):
			                    $output .= '<div class="person-social margin-ten xs-margin-0auto">';
			                		if( $hcode_team_member_fb ):
				                    	$output .= '<a '.$target.' href="'.$hcode_team_member_fb_url.'" class="black-text-link"><i class="fa fa-facebook no-margin-left"></i></a>';
				                	endif;
				                	if( $hcode_team_member_tw ):
				                    	$output .= '<a '.$target.' href="'.$hcode_team_member_tw_url.'" class="black-text-link"><i class="fa fa-twitter"></i></a>';
				                	endif;
				                	if( $hcode_team_member_googleplus ):
				                    	$output .= '<a '.$target.' href="'.$hcode_team_member_googleplus_url.'" class="black-text-link"><i class="fa fa-google-plus"></i></a>';
				                	endif;
			                    $output .= '</div>';
		                    endif;
		                $output .= '</div>';
		            $output .= '</div>';
				else:
					$output .= '<div class="col-lg-6 col-md-7 col-sm-6 no-padding'.$class.'"'.$id.'>';
						$output .= '<div class="architecture-team team-member xs-no-padding">';
							if( $hcode_team_member_title ):
		                    	$output .= '<span class="team-name text-uppercase black-text letter-spacing-2 display-block font-weight-600" '.$hcode_title_color.'>'.$hcode_team_member_title.'</span>';
		                    endif;
		                    if( $hcode_team_member_designation ):
		                    	$output .= '<span class="team-post text-uppercase letter-spacing-2 display-block" '.$hcode_designation_color.'>'.$hcode_team_member_designation.'</span>';
		                	endif;
		                    if( $hcode_team_member_separator ):
			                    $output .= '<div class="separator-line bg-black no-margin-lr margin-ten"></div>';
			                endif;
		                    $output .= '<span class="margin-ten display-block clearfix xs-margin-0auto"></span>';
		                    if( $content ):
			                	$output .= '<p class="margin-ten xs-no-margin-top">'.do_shortcode( $content ).'</p>';
			            	endif;
		                    $output .= '<span class="margin-ten display-block clearfix xs-margin-0auto"></span>';
		                    if( $hcode_team_member_fb || $hcode_team_member_tw || $hcode_team_member_googleplus ):
			                    $output .= '<div class="person-social margin-ten xs-margin-0auto">';
			                		if( $hcode_team_member_fb ):
				                    	$output .= '<a '.$target.' href="'.$hcode_team_member_fb_url.'" class="black-text-link"><i class="fa fa-facebook no-margin-left"></i></a>';
				                	endif;
				                	if( $hcode_team_member_tw ):
				                    	$output .= '<a '.$target.' href="'.$hcode_team_member_tw_url.'" class="black-text-link"><i class="fa fa-twitter"></i></a>';
				                	endif;
				                	if( $hcode_team_member_googleplus ):
				                    	$output .= '<a '.$target.' href="'.$hcode_team_member_googleplus_url.'" class="black-text-link"><i class="fa fa-google-plus"></i></a>';
				                	endif;
			                    $output .= '</div>';
		                    endif;
		                $output .= '</div>';
		            $output .= '</div>';
		            if( $thumb[0] ):
		            	$output .= '<div class="col-lg-6 col-md-5 col-sm-6 no-padding '.$image_position_class.'"><img class="xs-img-full" '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"></div>';
		        	endif;
	        	endif;
			break;

			case 'team-style-7':
				$output .= '<div class="team-member'.$class.'"'.$id.'>';
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
		            $output .= '<div class="team-details bg-blck-overlay position-left-right-zero" '.$hcode_team_bg_color.'>';
		            	if( $hcode_team_member_headline ):
		            		$output .= '<h5 class="team-headline white-text text-uppercase font-weight-600">'.$hcode_team_member_headline.'</h5>';
		            	endif;
		            	if( $content ):
		                	$output .= '<p class="width-70 center-col light-gray-text margin-five">'.do_shortcode( $content ).'</p>';
		            	endif;
		                if( $hcode_team_member_separator ):
		                	$output .= '<div class="separator-line-thick bg-white"></div>';
		               	endif;
		            $output .= '</div>';
		        $output .= '</div>';
			break;
		}
	    return $output;
	}
}
add_shortcode('hcode_team_member','hcode_team_member_shortcode');
?>