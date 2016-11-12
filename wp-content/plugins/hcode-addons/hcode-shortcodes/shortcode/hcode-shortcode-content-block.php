<?php
/**
 * Shortcode For Special Content Block.
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Content Block */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_content_block_shortcode' ) ) {
    function hcode_content_block_shortcode( $atts, $content = null ) {
    	extract( shortcode_atts( array(
        	'id' => '',
        	'class' => '',
        	'hcode_block_premade_style' => '',
        	'hcode_block_preview_image' => '',
        	'hcode_block_position_right' => '',
        	'hcode_block_image' => '',
        	'hcode_block_icon' => '',
        	'hcode_block_title' => '',
        	'hcode_block_subtitle' => '',
        	'hcode_block_title_url' => '',
        	'hcode_block_gifts_off' => '',
        	'hcode_block_image_position' => '',
        	'hcode_block_show_separator' => '',
        	'button_config' =>'',
        	'hcode_block_telephone' => '',
        	'hcode_block_telephone_number' => '',
        	'hcode_block_email' => '',
        	'hcode_block_email_url' => '',
            'hcode_block_icon_list' => '',
            'hcode_animation_style' => '',
            'hcode_image_position' => '',
            'hcode_block_icon_size' => '',
            'hcode_block_icon_color' => '',
            'hcode_block_title_color' => '',
            'hcode_block_subtitle_color' => '',
            'hcode_block_number' => '',
            'hcode_block_hover_title' => '',
            'hcode_block_hover_color' =>'',
            'hcode_block_facebook' =>'',
            'hcode_block_facebook_url' =>'',
            'hcode_block_twitter' =>'',
            'hcode_block_twitter_url' =>'',
            'hcode_block_googleplus' =>'',
            'hcode_block_googleplus_url' =>'',
            'hcode_block_dribbble' =>'',
            'hcode_block_dribbble_url' =>'',
            'hcode_block_event_date' => '',
            'hcode_block_event_time' => '',
            'hcode_block_title_font_size' => '',
            'hcode_block_title_line_height' => '',
            'hcode_stars' => '',
            'hcode_block_price' => '',
            'hcode_block_button_color' => '',
            'hcode_block_button_arrow_color' => '',
            'hcode_block_button_text_color' => '',
            'hcode_block_button_border_color' => '',
            'hcode_border_class' => '',
            'hcode_block_bg_color' => '',
            'hcode_block_hover_icon1' => '',
            'hcode_block_hover_title1' => '',
            'hcode_block_hover_subtitle1' => '',
            'hcode_block_hover_icon2' => '',
            'hcode_block_hover_title2' => '',
            'hcode_block_hover_subtitle2' => '',
            'hcode_block_hover_content' => '',
            'hover_button_config' => '',
            'hcode_block_hover_destinations_small_title' => '',
            'hcode_block_hover_destinations_image1' => '',
            'hcode_block_hover_destinations_title1' => '',
            'hcode_block_hover_destinations_url1' => '',
            'hcode_block_hover_destinations_subtitle1' => '',
            'hcode_block_hover_destinations_image2' => '',
            'hcode_block_hover_destinations_title2' => '',
            'hcode_block_hover_destinations_url2' => '',
            'hcode_block_hover_destinations_subtitle2' => '',
            'hcode_block_hover_destinations_image3' => '',
            'hcode_block_hover_destinations_title3' => '',
            'hcode_block_hover_destinations_url3' => '',
            'hcode_block_hover_destinations_subtitle3' => '',
        ), $atts ) );

    	$output = $image_position_class = $content_position_class = $style_att = $button_style = $title_color = '';
    	$id = ( $id ) ? ' id="'.$id.'"' : '';
    	$class = ( $class ) ? $class : '';
        $hcode_border_class = ($hcode_border_class == 1) ? ' corporate-border' : '';
    	$hcode_block_premade_style = ( $hcode_block_premade_style ) ? $hcode_block_premade_style : '';
    	$hcode_block_image = ( $hcode_block_image ) ? $hcode_block_image : '';
    	$thumb = wp_get_attachment_image_src($hcode_block_image, 'full');
    	$hcode_block_position_right = ( $hcode_block_position_right == 1 ) ? ' position-right-15px xs-position-right' : ' position-left-15px xs-position-left';
    	$hcode_block_icon = ( $hcode_block_icon ) ? $hcode_block_icon : '';
    	$hcode_block_title = ( $hcode_block_title ) ? str_replace('||', '<br />',$hcode_block_title) : '';
    	$hcode_block_subtitle = ( $hcode_block_subtitle ) ? str_replace('||', '<br />',$hcode_block_subtitle) : '';
    	$hcode_block_title_url = ( $hcode_block_title_url ) ? $hcode_block_title_url : '';
        $hcode_block_gifts_off = ( $hcode_block_gifts_off ) ? $hcode_block_gifts_off : '';
    	$hcode_block_show_separator = ( $hcode_block_show_separator ) ? $hcode_block_show_separator : '';
    	$hcode_block_telephone = ( $hcode_block_telephone ) ? $hcode_block_telephone : '';
    	$hcode_block_telephone_number = ( $hcode_block_telephone_number ) ? $hcode_block_telephone_number : '';
        $hcode_block_email = ( $hcode_block_email ) ? $hcode_block_email : '';
        $hcode_block_email_url = ( $hcode_block_email_url ) ? $hcode_block_email_url : '';
        $hcode_block_icon_list = ( $hcode_block_icon_list ) ? $hcode_block_icon_list : '';
        $hcode_animation_style = ( $hcode_animation_style ) ? ' wow '.$hcode_animation_style : '';
        $hcode_image_position = ($hcode_image_position) ? $hcode_image_position : '';
        $hcode_block_title_font_size = ($hcode_block_title_font_size) ? ' font-size:'.$hcode_block_title_font_size.' !important;' : '';
        $hcode_block_title_line_height = ( $hcode_block_title_line_height ) ? ' line-height:'.$hcode_block_title_line_height.';' : '';
        if($hcode_block_title_color || $hcode_block_title_font_size || $hcode_block_title_line_height):
            $title_color = ' color:'.$hcode_block_title_color.' !important;';
            $style_att .= ' style="'.$hcode_block_title_font_size.$hcode_block_title_line_height.$title_color.'"';
        endif;
        
        /* Social */
        $hcode_block_facebook_url = ( $hcode_block_facebook_url ) ? $hcode_block_facebook_url : '#';
        $hcode_block_twitter_url = ( $hcode_block_twitter_url ) ? $hcode_block_twitter_url : '#';
        $hcode_block_googleplus_url = ( $hcode_block_googleplus_url ) ? $hcode_block_googleplus_url : '#';
        $hcode_block_dribbble_url = ( $hcode_block_dribbble_url ) ? $hcode_block_dribbble_url : '#';
        
        /* For block 20 hover */
        $hcode_block_number = ( $hcode_block_number ) ? $hcode_block_number : '';
        $hcode_block_hover_title = ( $hcode_block_hover_title ) ? $hcode_block_hover_title : '';
        $hcode_block_hover_color = ( $hcode_block_hover_color ) ? ' style="color:'.$hcode_block_hover_color.'"' : '';
        
        /* For Block 49 */
        $hcode_block_hover_icon1 = ( $hcode_block_hover_icon1 ) ? $hcode_block_hover_icon1 : '';
        $hcode_block_hover_title1 = ( $hcode_block_hover_title1 ) ? $hcode_block_hover_title1 : '';
        $hcode_block_hover_subtitle1 = ( $hcode_block_hover_subtitle1 ) ? $hcode_block_hover_subtitle1 : '';
        $hcode_block_hover_icon2 = ( $hcode_block_hover_icon2 ) ? $hcode_block_hover_icon2 : '';
        $hcode_block_hover_title2 = ( $hcode_block_hover_title2 ) ? $hcode_block_hover_title2 : '';
        $hcode_block_hover_subtitle2 = ( $hcode_block_hover_subtitle2 ) ? $hcode_block_hover_subtitle2 : '';
        $hcode_block_hover_content = ( $hcode_block_hover_content ) ? $hcode_block_hover_content : '';
        
        /* For Block 50*/
        $hcode_block_hover_destinations_small_title = ( $hcode_block_hover_destinations_small_title ) ? $hcode_block_hover_destinations_small_title : '';
        $hcode_block_hover_destinations_image1 = ( $hcode_block_hover_destinations_image1 ) ? $hcode_block_hover_destinations_image1 : '';
        $hcode_block_hover_destinations_image1 = wp_get_attachment_image_src($hcode_block_hover_destinations_image1, 'full');
        $hcode_block_hover_destinations_title1 = ( $hcode_block_hover_destinations_title1 ) ? $hcode_block_hover_destinations_title1 : '';
        $hcode_block_hover_destinations_url1 = ( $hcode_block_hover_destinations_url1 ) ? $hcode_block_hover_destinations_url1 : '';
        $hcode_block_hover_destinations_subtitle1 = ( $hcode_block_hover_destinations_subtitle1 ) ? $hcode_block_hover_destinations_subtitle1 : '';
        $hcode_block_hover_destinations_image2 = ( $hcode_block_hover_destinations_image2 ) ? $hcode_block_hover_destinations_image2 : '';
        $hcode_block_hover_destinations_image2 = wp_get_attachment_image_src($hcode_block_hover_destinations_image2, 'full');
        $hcode_block_hover_destinations_title2 = ( $hcode_block_hover_destinations_title2 ) ? $hcode_block_hover_destinations_title2 : '';
        $hcode_block_hover_destinations_url2 = ( $hcode_block_hover_destinations_url2 ) ? $hcode_block_hover_destinations_url2 : '';
        $hcode_block_hover_destinations_subtitle2 = ( $hcode_block_hover_destinations_subtitle2 ) ? $hcode_block_hover_destinations_subtitle2 : '';
        $hcode_block_hover_destinations_image3 = ( $hcode_block_hover_destinations_image3 ) ? $hcode_block_hover_destinations_image3 : '';
        $hcode_block_hover_destinations_image3 = wp_get_attachment_image_src($hcode_block_hover_destinations_image3, 'full');
        $hcode_block_hover_destinations_title3 = ( $hcode_block_hover_destinations_title3 ) ? $hcode_block_hover_destinations_title3 : '';
        $hcode_block_hover_destinations_url3 = ( $hcode_block_hover_destinations_url3 ) ? $hcode_block_hover_destinations_url3 : '';
        $hcode_block_hover_destinations_subtitle3 = ( $hcode_block_hover_destinations_subtitle3 ) ? $hcode_block_hover_destinations_subtitle3 : '';
                
        $hcode_block_icon_size = ( $hcode_block_icon_size ) ? ' '.$hcode_block_icon_size : ' medium-icon';
        $hcode_block_icon_color = ( $hcode_block_icon_color ) ? ' style="color:'.$hcode_block_icon_color.' !important"' : '';
        $hcode_block_title_color = ( $hcode_block_title_color ) ? ' style="color:'.$hcode_block_title_color.' !important"' : '';
        $hcode_block_subtitle_color = ( $hcode_block_subtitle_color ) ? ' style="color:'.$hcode_block_subtitle_color.' !important"' : '';
        
        $hcode_block_button_border_color = ( $hcode_block_button_border_color ) ? 'border-color:'.$hcode_block_button_border_color.' !important;' : '';
        $hcode_block_button_text_color = ( $hcode_block_button_text_color ) ? 'color:'.$hcode_block_button_text_color.' !important;' : '';
        $hcode_block_button_color = ( $hcode_block_button_color ) ? ' background:'.$hcode_block_button_color.';' : '';
        $hcode_block_button_arrow_color = ( $hcode_block_button_arrow_color ) ? ' style="color:'.$hcode_block_button_arrow_color.' !important"' : '';
        $hcode_block_bg_color = ( $hcode_block_bg_color ) ? ' style="background:'.$hcode_block_bg_color.';"' : '';

        if($hcode_block_button_color || $hcode_block_button_text_color || $hcode_block_button_border_color):
            $button_style .= 'style="'.$hcode_block_button_color.$hcode_block_button_text_color.$hcode_block_button_border_color.'"';
        endif;

        /* Event date and time */
        $hcode_block_event_date = ( $hcode_block_event_date ) ? $hcode_block_event_date : '';
        $hcode_block_event_time = ( $hcode_block_event_time ) ? $hcode_block_event_time : '';
        if (function_exists('vc_parse_multi_attribute')) {
            // For Button
            $button_parse_args = vc_parse_multi_attribute($button_config);
            $button_link     = ( isset($button_parse_args['url']) ) ? $button_parse_args['url'] : '#';
            $button_title    = ( isset($button_parse_args['title']) ) ? $button_parse_args['title'] : '';
            $button_target   = ( isset($button_parse_args['target']) ) ? trim($button_parse_args['target']) : '_self';
            
            $hover_button_parse_args = vc_parse_multi_attribute($hover_button_config);
            $hover_button_link     = ( isset($hover_button_parse_args['url']) ) ? $hover_button_parse_args['url'] : '#';
            $hover_button_title    = ( isset($hover_button_parse_args['title']) ) ? $hover_button_parse_args['title'] : '';
            $hover_button_target   = ( isset($hover_button_parse_args['target']) ) ? trim($hover_button_parse_args['target']) : '_self'; 
        }

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($hcode_block_image);
        $img_title = hcode_option_image_title($hcode_block_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';

        
    	switch ($hcode_block_premade_style) {
    		case 'block-1':
    			if( $id || $class ):
    				$output .= '<div class="'.$class.'"'.$id.'>';
    			endif;
    			if( $thumb[0] || $button_title ):
    				$output .= '<div class="position-relative">';
    					if( $thumb[0] ):
                            $output .= '<a href="'.$button_link.'" target="'.$button_target.'"><img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"></a>';
    					endif;
    					if( $button_title ):
    						$output .= '<a class="highlight-button-dark btn btn-very-small view-map no-margin bg-black white-text" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
    					endif;
    				$output .= '</div>';
    			endif;
    			if( $hcode_block_title ):
                    $output .= '<p class="text-med black-text letter-spacing-1 margin-ten no-margin-bottom text-uppercase font-weight-600 xs-margin-top-five" '.$hcode_block_title_color.'>'.$hcode_block_title.'</p>';
                endif;
            	if($content):
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
                if( $hcode_block_show_separator ):
                	$output .= '<div class="wide-separator-line bg-mid-gray no-margin-lr"></div>';
                endif;
                if( $hcode_block_telephone == 1 ):
                	$output .= '<p class="black-text no-margin-bottom"><strong>T.</strong> '.$hcode_block_telephone_number.'</p>';
            	endif;
            	if( $hcode_block_email ):
                	$output .= '<p class="black-text"><strong>E.</strong> <a href="mailto:'.$hcode_block_email_url.'">'.$hcode_block_email_url.'</a></p>';
               	endif;
               	if( $id || $class ):
    				$output .= '</div>';
    			endif;
    		break;

    		case 'block-2':
    			$output .= '<div class="corporate-standards-text '.$class.'"'.$id.'>';
                    $output .= '<div class="img-border-small-fix border-gray"></div>';
                    if( $hcode_block_icon ):
                    	$output .= '<i class="'.$hcode_block_icon.$hcode_block_icon_size.'"'.$hcode_block_icon_color.'></i>';
                    endif;
                    if( $hcode_block_title ):
                    	$output .= '<h1 class="margin-ten no-margin-bottom"'.$hcode_block_title_color.'>'.$hcode_block_title.'</h1>';
                    endif;
                    if($content):
                    	$output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                    if( $button_title ):
                    	$output .= '<a class="text-small highlight-link text-uppercase bg-black white-text" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.' <i class="fa fa-long-arrow-right extra-small-icon white-text"></i></a>';
                    endif;
                $output .= '</div>';
    		break;

    		case 'block-3':
    			if( $id || $class ):
    				$output .= '<div class="'.$class.'"'.$id.'>';
    			endif;
                    if( $hcode_block_subtitle ):
                        $output .= '<span class="margin-five no-margin-top display-block letter-spacing-2" '.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                    endif;
                    if( $hcode_block_title ):
                    	$output .= '<h1'.$hcode_block_title_color.'>'.$hcode_block_title.'</h1>';
                    endif;
                    if( $content ):
                    	$output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                if( $id || $class ):
    				$output .= '</div>';
    			endif;
    		break;

    		case 'block-4':
    			$output .= '<div class="clearfix '.$class.'"'.$id.'>';
    				if($hcode_block_image_position == 1):
    					$content_position_class .= ' pull-right sm-pull-left';
    					$image_position_class .= ' pull-left sm-pull-right';
    				else:
    					$content_position_class .= ' pull-left sm-pull-right';
    					$image_position_class .= ' pull-right sm-pull-left';
    				endif;

    				if( $thumb[0] ):
    	                $output .= '<div class="col-md-6 col-sm-12 col-xs-12 no-padding'.$image_position_class.'">';
    	                    $output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
    	                $output .= '</div>';
    	            endif;
                    $output .= '<div class="col-md-6 col-sm-12 col-xs-12 no-padding '.$content_position_class.'">';
                        $output .= '<div class="model-details-text">';
                        	if( $hcode_block_show_separator ):
    	                        $output .= '<div class="separator-line bg-black no-margin-lr margin-ten"></div>';
    	                        $output .= '<span class="margin-ten display-block clearfix xs-margin-0auto sm-display-none"></span>';
                            endif;
                            if( $hcode_block_title ):
                            	$output .= '<span class="text-uppercase font-weight-600 black-text letter-spacing-2" '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                            endif;
                            if( $hcode_block_subtitle ):
                            	$output .= '<span class="text-uppercase text-small letter-spacing-2 margin-three display-block" '.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                        	endif;
                        	if( $content ):
                            	$output .= do_shortcode( hcode_remove_wpautop( $content ) );
                            endif;
                            if( $button_title):
                            	$output .= '<span class="margin-ten display-block clearfix xs-margin-0auto"></span>';
                            	$output .= '<a class="highlight-button-dark btn btn-very-small no-margin" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                           	endif;
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
    		break;

    		case 'block-5':
    			if( $id || $class ):
    				$output .= '<div class="'.$class.'"'.$id.'>';
    			endif;
        			if( $thumb[0] ):
                    	$output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
                    endif;
                    if( $hcode_block_title ):
                    	$output .= '<p class="text-uppercase letter-spacing-2 black-text font-weight-600 margin-ten no-margin-bottom" '.$hcode_block_title_color.'>'.$hcode_block_title.'</p>';
                    endif;
                    if( $content ):
                    	$output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                if( $id || $class ):
    				$output .= '</div>';
    			endif;
            break;

            case 'block-6':
            	if( $id || $class ):
    				$output .= '<div class="'.$class.'"'.$id.'>';
    			endif;
                    if( $hcode_block_title ):
                    	$output .= '<h3 class="title-med no-padding-bottom letter-spacing-2" '.$hcode_block_title_color.'>'.$hcode_block_title.'</h3>';
                    endif;
                    if( $content ):
                    	$output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                    if( $button_title):
                    	$output .= '<a class="highlight-button-dark btn btn-small button" '.$button_style.' href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                   	endif;
               	if( $id || $class ):
    				$output .= '</div>';
    			endif;
            break;

            case 'block-7':
            	if( $id || $class ):
    				$output .= '<div class="'.$class.'"'.$id.'>';
    			endif;
                	if( $thumb[0] ):
                    	$output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
                    endif;
                    if( $hcode_block_title ):
                    	$output .= '<h5 class="margin-ten no-margin-bottom xs-margin-top-five" '.$hcode_block_title_color.'>'.$hcode_block_title.'</h5>';
                    endif;
                if( $id || $class ):
    				$output .= '</div>';
    			endif;
            break;

            case 'block-8':
            	if( $id || $class ):
    				$output .= '<div class="'.$class.'"'.$id.'>';
    			endif;
        			if( $hcode_block_subtitle ):
                		$output .= '<span class="text-large display-block" '.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                    endif;
                    if( $hcode_block_title ):
                	    $output .= '<span class="title-large text-uppercase letter-spacing-1 font-weight-600 black-text" '.$style_att.'>'.$hcode_block_title.'</span>';
                	endif;
                	if( $hcode_block_show_separator ):
        				$output .= '<div class="separator-line-thick bg-fast-pink no-margin-lr"></div>';
        			endif;
        			if( $content ):
                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                   	endif;
                   	if( $button_title ):
                    	$output .= '<a class="highlight-button-black-border btn btn-small no-margin-bottom inner-link sm-margin-bottom-ten" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                    endif;
                if( $id || $class ):
    				$output .= '</div>';
    			endif;
            break;

            case 'block-9':
                $output .= '<div class="special-gifts-box '.$class.'" '.$id.'>';
                	if( $hcode_block_subtitle ):
                    	$output .= '<span class="text-uppercase text-small letter-spacing-1" '.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                    endif;
                    if( $hcode_block_title ):
                    	$output .= '<span class="text-uppercase font-weight-600 letter-spacing-1 black-text display-block" '.$hcode_block_title_color.'>';
                    		if( $hcode_block_title_url ):
    	                		$output .= '<a href="'.$hcode_block_title_url.'">';
    	                	endif;
    	                		$output .= $hcode_block_title;
    	                		
    	                	if( $hcode_block_title_url ):
    	                		$output .= '</a>';
    	                	endif;
                    	$output .= '</span>';
                    endif;
                    if( $hcode_block_gifts_off ):
                    	$output .= '<span class="gifts-off bg-fast-pink white-text">'.$hcode_block_gifts_off.'</span>';
                    endif;
                $output .= '</div>';
            break;

            case 'block-10':
                if( $hcode_block_title || $hcode_block_subtitle ):
                    $output .= '<div class="text-large '.$class.'" '.$id.'>';
                        if( $hcode_block_title ):
                            $output .= '<h6 class="no-margin-top '.$hcode_animation_style.'"'.$hcode_block_title_color.'>'.$hcode_block_title.'</h6>';
                        endif;
                        if( $hcode_block_subtitle ):
                            $output .= '<p class="no-margin-bottom '.$hcode_animation_style.'"'.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</p>';
                        endif;
                    $output .= '</div>';
                endif;
            break;

            case 'block-11':
                if( $hcode_block_title || $hcode_block_subtitle ):
                    $output .= '<div class="about-year text-uppercase white-text">';
                    if( $hcode_block_title ):
                    $output .= '<span class="clearfix" '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                    endif;
                    if($hcode_block_subtitle):
                        $output .= '<div class="about-year-text" '.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</div>';
                    endif;
                    $output .= '</div>';
                endif;
                if( $content ):
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
            break;

            case 'block-12':
                if ( $hcode_block_title ):
                    $output .= '<p class="title-large white-text text-uppercase letter-spacing-2" '.$hcode_block_title_color.'><strong>'.$hcode_block_title.'</strong></p>';
                endif;
                if( $content ):
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
            break;

            case 'block-13':
                $output .= '<div class="testimonial-style2'.$class.'"'.$id.'>';
                    if ( $hcode_block_icon_list ):
                        $output .= '<i class="'.$hcode_block_icon_list.$hcode_block_icon_size.' margin-five no-margin-top"'.$hcode_block_icon_color.'></i>';
                    endif;
                    if ( $content ):
                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                    if ( $hcode_block_title ):
                        $output .= '<span class="name light-gray-text2"'.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                    endif;
                $output .= '</div>';
            break;

            case 'block-14': 
                if ( $hcode_block_title ):
                    $output .= '<div class="team-plus text-uppercase'.$class.'"'.$id.' '.$hcode_block_title_color.'><span class="clearfix">'.$hcode_block_title.'</span></div>';
                endif;
            break;

            case 'block-15':
                if ( $hcode_block_title ):
                    $output .= '<p class="title-large text-uppercase letter-spacing-1 black-text font-weight-600" '.$hcode_block_title_color.'>'.$hcode_block_title.'</p>';
                endif;
                if ( $content ):
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
            break;
            
            case 'block-16':
                if ( $hcode_block_title ):
                    $output .= '<h1 class="white-text sm-small-text" '.$hcode_block_title_color.'>'.$hcode_block_title.'</h1>';
                endif;
                if ( $content ):
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
            break;
            
            case 'block-17':
                if ( $hcode_block_title ):
                    $output .= '<h1 class="title-med text-uppercase letter-spacing-1 white-text font-weight-600" '.$hcode_block_title_color.'>'.$hcode_block_title.'</h1>';
                endif;
                if ( $content ):
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
            break;
            
            case 'block-18':
                $output .= '<div class="client-main position-relative overflow-hidden '.$class.'" '.$id.'>';
                    if( $thumb[0] ):
                        $output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
                    endif;
                    if( $content || $button_title ):
                        $output .= '<div class="client-text position-absolute display-block bg-white text-center">';
                        if( $content ):
                            $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                        endif;
                        if( $button_title ):
                            $output .= '<a class="highlight-button-dark btn btn-very-small margin-three no-margin" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                        endif;
                        $output .= '</div>';
                    endif;
                $output .= '</div>';
            break;

            case 'block-19':
                $output .= '<div class="spa-treatments xs-no-float '.$class.'" '.$id.'>';
                    if($hcode_image_position == 1):
                        if($thumb[0]):
                            $output .='<div class="col-lg-6 col-md-12 no-padding md-display-none pull-left text-center">';
                                $output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
                            $output .='</div>';
                        endif;
                    endif;
                    if($hcode_block_title || $content):
                        $output .= '<div class="right-content col-lg-6 col-md-12">';
                        if($hcode_block_title):
                            $output .= '<span class="title-large text-uppercase white-text font-weight-600 letter-spacing-1" '.$hcode_block_title_color.'>';
                                $output .= $hcode_block_title;
                            $output .= '</span>';
                        endif;
                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                        $output .= '</div>';
                    endif;
                    if($hcode_image_position == 0):
                        if($thumb[0]):
                            $output .='<div class="col-lg-6 col-md-12 no-padding md-display-none pull-right text-center">';
                                $output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
                            $output .='</div>';
                        endif;
                    endif;
                $output .= '</div>';
                
            break;
            
            case 'block-20':
                $output .= '<div class="services-box '.$class.'" '.$id.'>';
                if( $hcode_block_icon || $hcode_block_icon_color ):
                    $output .= '<i class="'.$hcode_block_icon.$hcode_block_icon_size.'"'.$hcode_block_icon_color.'></i>';
                endif;
                if( $hcode_block_title || $hcode_block_title_color ):
                    $output .= '<h6 class="margin-five font-weight-600 letter-spacing-2"'.$hcode_block_title_color.'>'.$hcode_block_title.'</h6>';
                endif;
                if( $hcode_block_subtitle || $hcode_block_subtitle_color ):
                    $output .= '<p'.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</p>';
                endif;
                if( $hcode_block_number || $hcode_block_hover_title || $hcode_block_hover_color ):
                    $output .= '<figure class="text-uppercase bg-black"'.$hcode_block_hover_color.'>';
                    if( $hcode_block_number ):
                        $output .= '<span>'.$hcode_block_number.'</span>';
                    endif;
                    $output .= $hcode_block_hover_title;
                    $output .= '</figure>';
                endif;
                $output .= '</div>';
            break;
            
            case 'block-21':
                if( $hcode_block_number ):
                    $output .= '<span class="parallax-number alt-font white-text letter-spacing-2 bg-black margin-five no-margin-top">'.$hcode_block_number.'</span>';
                endif;
                if( $hcode_block_title || $hcode_block_title_color ):
                    $output .= '<h6 class="margin-two font-weight-600 letter-spacing-2 no-margin-top"'.$hcode_block_title_color.'>'.$hcode_block_title.'</h6>';
                endif;
                if( $content ):
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
            break;
            
            case 'block-22':
                if( $id || $class ):
                    $output .= '<div class="'.$class.'"'.$id.'>';
                endif;
                    if( $thumb[0] ):
                        $output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
                        $output .= '<br><br>';
                    endif;
                    if( $hcode_block_title || $hcode_block_title_color ):
                        $output .= '<p class="text-large"'.$hcode_block_title_color.'>'.$hcode_block_title.'</p>';
                    endif;
                    if( $hcode_block_show_separator ):
                        $output .= '<div class="wide-separator-line no-margin-lr"></div>';
                    endif;
                    if( $content ):
                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                if( $id || $class ):
                    $output .= '</div>';
                endif;
            break;
            
            case 'block-23':
                $output .= '<div class="about-onepage '.$class.'"'.$id.'>';
                    $output .= '<div class="col-md-3 col-sm-12 border-right about-onepage-number position-relative overflow-hidden sm-no-border-right xs-text-center">';
                        $output .= '<span class="about-onepage-number-default fast-yellow-text font-weight-100 position-absolute xs-position-inherit">'.$hcode_block_number.'</span>';
                        $output .= '<span class="about-onepage-number-hover gray-text font-weight-100 position-absolute xs-display-none">'.$hcode_block_number.'</span>';
                    $output .= '</div>';
                if( $hcode_block_title || $content ):
                    $output .= '<div class="col-md-9 col-sm-12 about-onepage-text">';
                        $output .= '<div class="about-onepage-text-sub sm-no-margin-left xs-text-center">';
                            if( $hcode_block_title ):
                                $output .= '<span class="black-text" '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                            endif;
                            if( $content ):
                                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                            endif;
                        $output .= '</div>';
                    $output .= '</div>';
                endif;
                $output .= '</div>';
            break;
            
            case 'block-24':
                if( $id || $class ):
                    $output .= '<div class="'.$class.'"'.$id.'>';
                endif;
                    if( $hcode_block_icon || $hcode_block_icon_color ):
                        $output .= '<i class="'.$hcode_block_icon.$hcode_block_icon_size.' margin-ten-bottom"'.$hcode_block_icon_color.'></i>';
                    endif;
                    if( $hcode_block_title || $hcode_block_title_color ):
                        $output .= '<span class="parallax-title alt-font"'.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                    endif;
                    if( $content):
                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                    if( $hcode_block_show_separator == 1 ):
                        $output .= '<div class="separator-line bg-white"></div>';
                    endif;
                if( $id || $class ):
                    $output .= '</div>';
                endif;
            break;

            case 'block-25':
                $output .= '<div class="restaurant-features-main bg-white '.$class.'" '.$id.'>';
                    $output .= '<div class="restaurant-features text-center">';
                    if( $thumb[0] || $button_title ):
                        $output .= '<img src="'.$thumb[0].'" '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'" />';
                    endif;
                    if($hcode_block_title):
                        $output .= '<span class="text-uppercase font-weight-600 letter-spacing-1 black-text margin-ten display-block no-margin-bottom" '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                    endif;
                    if($hcode_block_subtitle):
                        $output .= '<span class="text-small letter-spacing-1 text-uppercase" '.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                    endif;
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'block-26':
                if($thumb[0]):
                    $output .= '<img src="'.$thumb[0].'" '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'"/>';
                endif;
                if($hcode_block_title):
                    $output .= '<h1 class="margin-ten no-margin-bottom" '.$style_att.'>'.$hcode_block_title.'</h1>';
                endif;
                if($hcode_block_subtitle):
                    $output .='<span class="text-small text-uppercase letter-spacing-3" '.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                endif;
                if($content):
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
            break;

            case 'block-27':
                if($thumb[0]):
                    $output .='<div class="cover-background" style="background-image:url('.$thumb[0].');">';
                endif;
                if($hcode_block_title || $hcode_block_subtitle):
                    $output .='<div class="food-services-inner">';
                        $output .='<div class="food-services-border text-center">';
                            if($hcode_block_title):
                                $output .='<span class="text-extra-large text-uppercase letter-spacing-2 white-text display-block font-weight-600 margin-one no-margin-top" '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                            endif;
                            if($hcode_block_subtitle):
                                $output .='<span class="food-time text-small white-text display-inline-block text-uppercase letter-spacing-2" '.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                            endif;
                        $output .='</div>';
                    $output .='</div>';
                endif;
                if($thumb[0]):
                    $output .='</div>';
                endif;
            break;              
        
            case 'block-28':
                if( $hcode_block_number ):
                    $output .= '<span class="services-number-landing font-weight-100 gray-text bg-light-yellow">'.$hcode_block_number.'</span>';
                endif;
                if( $hcode_block_title || $hcode_block_title_color ):
                    $output .= '<p class="text-med font-weight-600 margin-five no-margin-bottom"'.$hcode_block_title_color.'>'.$hcode_block_title.'</p>';
                endif;
                if( $content ):
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
            break;
            
            case 'block-29':
                $output .= '<div class="about-couple '.$class.'" '.$id.'>';
                    $output .= '<div class="about-couple-sub bg-white">';
                        if( $thumb[0] ):
                            $output .= '<div class="margin-five no-margin-top"><img class="white-round-border no-border" '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"></div>';
                        endif;
                        if( $hcode_block_title || $hcode_block_title_color ):
                            $output .= '<span class="title-small text-uppercase letter-spacing-3 font-weight-600 display-block"'.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                        endif;
                        if( $hcode_block_subtitle || $hcode_block_subtitle_color ):
                            $output .= '<span class="text-uppercase margin-one display-block letter-spacing-2"'.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                        endif;
                        if( $hcode_block_show_separator == 1):
                            $output .= '<div class="wide-separator-line bg-mid-gray margin-five no-margin-lr"></div>';
                        endif;
                        if( $content ):
                            $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                        endif;
                        if( $hcode_block_show_separator == 1):
                            $output .= '<div class="wide-separator-line bg-mid-gray margin-five no-margin-lr"></div>';
                        endif;
                        if( $hcode_block_facebook ):
                            $output .= '<a target="_blank" href="'.$hcode_block_facebook_url.'" class="black-text-link"><i class="fa fa-facebook extra-small-icon"></i></a>';
                        endif;
                        if( $hcode_block_twitter ):
                        $output .= '<a target="_blank" href="'.$hcode_block_twitter_url.'" class="black-text-link"><i class="fa fa-twitter extra-small-icon"></i></a>';
                        endif;
                        if( $hcode_block_googleplus ):
                        $output .= '<a target="_blank" href="'.$hcode_block_googleplus_url.'" class="black-text-link"><i class="fa fa-google-plus extra-small-icon"></i></a>';
                        endif;
                        if( $hcode_block_dribbble ):
                        $output .= '<a target="_blank" href="'.$hcode_block_dribbble_url.'" class="black-text-link"><i class="fa fa-dribbble extra-small-icon"></i></a>';
                        endif;
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'block-30':
                $output .= '<div class="event-box '.$class.'" '.$id.'>';
                    if ( $hcode_block_icon ):
                        $output .= '<i class="'.$hcode_block_icon.$hcode_block_icon_size.' margin-five"'.$hcode_block_icon_color.'></i>';
                    endif;

                    if( $hcode_block_title || $hcode_block_title_color ):
                        $output .= '<span class="text-med text-uppercase letter-spacing-2 font-weight-600 display-block"'.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                    endif;
                    if( $hcode_block_show_separator == 1 ):
                        $output .= '<div class="wide-separator-line bg-mid-gray margin-ten no-margin-lr"></div>';
                    endif;
                    if( $hcode_block_event_date ):
                        $output .= '<span class="text-uppercase letter-spacing-2 display-block black-text">'.$hcode_block_event_date.'</span>';
                    endif;
                    if( $hcode_block_event_time ):
                        $output .= '<span class="event-time">'.$hcode_block_event_time.'</span>';
                    endif;
                    if( $hcode_block_show_separator == 1 ):
                        $output .= '<div class="wide-separator-line bg-mid-gray margin-ten no-margin-lr"></div>';
                    endif;
                    if( $content ):
                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                    if( $button_title ):
                        $output .= '<a class="highlight-button-dark btn btn-small button no-margin-right inner-link" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                    endif;
                $output .= '</div>';
            break;

            case 'block-31':
                if ( $hcode_block_icon || $hcode_block_icon_size || $hcode_block_icon_color ):
                    $output .= '<div class="award-box clearfix bg-white'.$class.'"'.$id.'>';
                        if ( $hcode_block_icon || $hcode_block_icon_size || $hcode_block_icon_color ):
                            $output .= '<div class="col-md-4 col-sm-12 text-center">';
                                $output .= '<i class="'.$hcode_block_icon.$hcode_block_icon_size.'"'.$hcode_block_icon_color.'></i>';
                            $output .= '</div>';
                        endif;
                        if( $hcode_block_title || $hcode_block_title_color ):
                            $output .= '<div class="col-md-8 col-sm-12 text-left position-relative text-uppercase letter-spacing-1 top-6 sm-text-center sm-margin-top-five"'.$hcode_block_title_color.'>'.$hcode_block_title.'</div>';
                        endif;
                    $output .= '</div>';
                endif;

            break;

            case 'block-32':
                $output .= '<div class="grid-border'.$class.'"'.$id.'>';
                    $output .= '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 no-padding grid-border-box bg-gray text-center">';
                        if ( $hcode_block_icon || $hcode_block_icon_size || $hcode_block_icon_color ):
                            $output .= '<i class="'.$hcode_block_icon.$hcode_block_icon_size.$hcode_block_icon_color.'"></i>';
                        endif;
                        if( $hcode_block_title || $hcode_block_title_color ):
                            $output .= '<span class="text-uppercase letter-spacing-2 black-text font-weight-600 display-block margin-ten no-margin-bottom xs-margin-top-five" '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                        endif;
                    $output .= '</div>';
                $output .= '</div>';
            break;
           
            case 'block-33':
                $output .= '<div class="client-logo-outer'.$hcode_border_class.$class.'" '.$id.'>';
                    $output .= '<div class="client-logo-inner">';
                        $output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
                    $output .= '</div>';
                $output .= '</div>';
            break;

            case 'block-34':
                $output .='<div class="travel-adventure overflow-hidden position-relative '.$class.'" '.$id.'>';
                    if($thumb[0]):
                        $output .='<a href="'.$hcode_block_title_url.'"><img src="'.$thumb[0].'" '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'"/></a>';
                    endif;
                    if($hcode_block_title):
                        $output .='<figure class="text-large letter-spacing-3" '.$hcode_block_title_color.'>'.$hcode_block_title.'</figure>';
                    endif;
                $output .='</div>';
            break;

            case 'block-35':
                $output .='<div class="special-offers '.$class.'" '.$id.'>';
                    $output .='<div class="img-border-full border-color-black"></div>';
                    $output .='<div class="special-offers-sub">';
                        if($thumb[0]):
                            $output .='<img src="'.$thumb[0].'" '.$image_alt.$image_title.' class="margin-ten no-margin-top" width="'.$thumb[1].'" height="'.$thumb[2].'"/>';
                        endif;
                        if($hcode_block_title):
                            $output .='<span class="title-small text-uppercase font-weight-600 letter-spacing-3 display-block margin-ten no-margin-top" '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                        endif;
                    $output .='</div>';
                $output .='</div>';
            break;

            case 'block-36':
                if($thumb[0]):
                    $output .='<a href="'.$hcode_block_title_url.'"><img src="'.$thumb[0].'" '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'"/></a>';
                endif;
                $output .='<div class="white-box bg-white '.$class.'" '.$id.'>';
                    if( $hcode_block_title ):
                        $output .='<span class="destinations-name text-uppercase font-weight-600 letter-spacing-3 display-block"><a href="'.$hcode_block_title_url.'" '.$hcode_block_title_color.'>'.$hcode_block_title.'</a></span>';
                    endif;
                    if( $hcode_block_subtitle ):
                        $output .='<span class="destinations-place text-uppercase font-weight-400 letter-spacing-2 display-block" '.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                    endif;
                    if($hcode_stars):
                            $output .='<div class="no-margin-bottom">';
                            for($i=1; $i <= 5; $i++){
                                if($i <= $hcode_stars):
                                    $output .='<i class="fa fa-star-o " '.$hcode_block_icon_color.'></i>';
                                else:
                                    $output .='<i class="fa fa-star-o "></i>';
                                endif;
                            }
                            $output .='</div>';
                        endif;
                $output .='</div>  ';
            break;

            case 'block-37':
                if($thumb[0]):
                    $output .='<div class="cover-background best-hotels-img" style="background-image:url('.$thumb[0].');">';
                endif;
                    $output .='<div class="col-md-6 col-sm-9 text-center best-hotels-text bg-white pull-right '.$class.'" '.$id.'>';
                        $output .='<div>';
                            for($i=1; $i <= 5; $i++){
                                if($i <= $hcode_stars):
                                    $output .='<i class="fa fa-star-o small-icon" '.$hcode_block_icon_color.'></i>';
                                else:
                                    $output .='<i class="fa fa-star-o small-icon"></i>';
                                endif;
                            }
                        $output .='</div>';
                        if($hcode_block_title):
                            $output .='<span class="text-uppercase font-weight-600 display-block margin-ten no-margin-bottom letter-spacing-2" '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                        endif;
                        if($hcode_block_subtitle):
                            $output .='<span class="text-uppercase letter-spacing-2 margin-ten display-block no-margin-top" '.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                        endif;
                        if($button_link || $button_link || $button_title):
                            $output .='<a href="'.$button_link.'" class="highlight-button-dark btn btn-small button no-margin-lr" target="'.$button_target.'">'.$button_title.'</a>';
                        endif;
                    $output .='</div>';
                    if( $content ):
                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                if($thumb[0]):
                    $output .='</div>';
                endif;
            break;

            case 'block-38':
                if( $hcode_block_title || $hcode_block_title_color ):
                    $output .='<span class="title-small text-uppercase font-weight-700 letter-spacing-1 margin-seven-top margin-five-bottom display-block" '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                endif;
                if( $content ):
                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
                if($button_link || $button_title):
                    $output .='<a href="'.$button_link.'" class="highlight-link text-uppercase white-text" '.$button_style.' target="'.$button_target.'">'.$button_title.' <i class="fa fa-long-arrow-right extra-small-icon white-text" '.$hcode_block_button_arrow_color.'></i></a>';
                endif;
            break;

            case 'block-39':
                $output .= '<div class="fashion-person fashion-right'.$class.'"'.$id.'>';
                    if($thumb[0]):
                        $output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
                    endif;
                    $output .= '<div class="right-content"'.$hcode_block_bg_color.'>';
                        if( $hcode_block_title || $hcode_block_title_color ):
                            $output .= '<span class="title-large text-uppercase letter-spacing-2 display-block"'.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                        endif;
                        if( $hcode_block_subtitle || $hcode_block_subtitle_color ):
                            $output .= '<span class="owl-subtitle sm-margin-top-five sm-margin-bottom-five"'.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                        endif;
                        if( $hcode_block_show_separator ):
                            $output .= '<div class="separator-line bg-white"></div>';
                        endif;
                        if( $content ):
                            $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                        endif;
                        if( $button_title || $button_link ):
                            $output .= '<a class="btn btn-small-white-background margin-seven margin-four-bottom" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                        endif;
                    $output .= '</div>';
                $output .= '</div>';
                break;

                case 'block-40':
                    if($thumb[0]):
                        $output .= '<div class="icon-bg"><img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"></div>';
                    endif;
                    if( $hcode_block_title || $hcode_block_title_color ):
                        $output .='<span class="display-block margin-ten work-process-title no-margin-bottom gray-text" '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                    endif;
                    if( $content ):
                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                    if( $hcode_block_show_separator == 1):
                        $output .='<div class="thin-separator-line bg-dark-gray"></div>';
                    endif;
                break;

                case 'block-41':
                    if( $hcode_block_title || $hcode_block_title_color ):
                        $output .= '<div class="slider-typography container position-relative '.$class.'" '.$id.'>';
                            $output .= '<div class="slider-text-middle-main">';
                                $output .= '<div class="slider-text-middle text-center slider-text-middle1 center-col wow fadeIn">';
                                    $output .= '<span class="fashion-subtitle text-uppercase font-weight-700 border-color-white text-center " '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    endif;
                break;

                case 'block-42':
                $output .= '<div class="person-grid '.$class.'" '.$id.'>';
                    $output .= '<div class="grid bg-black">';
                        if($thumb[0]):
                            $output .= '<div class="gallery-img">';
                                $output .= '<a href="'.$button_link.'" class="inner-link"><img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'></a>';
                            $output .= '</div>';
                        endif;
                        $output .= '<figure>';
                            $output .= '<figcaption class="md-bottom-10">';
                                if($hcode_block_title || $hcode_block_title_color):
                                    $output .= '<span class="owl-title white-text position-relative margin-five" '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                                endif;
                                if($content):
                                    $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                endif;
                                if($button_title):
                                    $output .= '<a class="btn-small-white btn btn-medium position-relative no-margin-right margin-five inner-link" href="'.$button_link.'" target='.$button_target.'>'.$button_title.'</a>';
                                endif;
                                $output .= '<span class="margin-ten display-block"></span>';
                            $output .= '</figcaption>';
                        $output .= '</figure>';
                    $output .= '</div>';
                $output .= '</div>';
                break;

                case 'block-43':
                $output .= '<div class="position-relative '.$class.'" '.$id.'>';
                    if($thumb[0]):
                        $output .= '<img src="'.$thumb[0].'" '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'">';
                    endif;
                    if($hcode_block_price):
                        $output .= '<span class="special-dishes-price bg-white red-text alt-font">'.$hcode_block_price.'</span>';
                    endif;
                $output .= '</div>';
                if($hcode_block_title || $hcode_block_title_color):
                    $output .= '<p class="text-uppercase letter-spacing-2 font-weight-600 margin-ten no-margin-bottom" '.$hcode_block_title_color.'>'.$hcode_block_title.'</p>';
                endif;
                if($content):
                $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                endif;
                $output .= '<div class="thin-separator-line bg-dark-gray no-margin-lr"></div>';
                break;

                case 'block-44':
                    $output .= '<div class="no-padding-bottom reasons '.$class.'"'.$id.'>';
                        $output .= '<span class="slider-title-big2"'.$hcode_block_title_color.'>';
                        $output .= $hcode_block_number;
                        if( $hcode_block_title):
                            $output .='<span '.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                        endif;
                        $output .= '</span>';
                        if( $content ):
                            $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                        endif;
                        if($thumb[0]):
                            $output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
                        endif;
                    $output .= '</div>';
                    break;
                    
                case 'block-45':
                    $output .= '<div class="text-block '.$class.'" '.$id.'>';
                        $output .= '<div class="text-block-inner bg-white">';
                            if( $hcode_block_title || $hcode_block_title_color ):
                                $output .= '<p class="text-large text-uppercase no-margin-bottom"'.$hcode_block_title_color.'>'.$hcode_block_title.'</p>';
                            endif;
                            if( $hcode_block_subtitle || $hcode_block_subtitle_color ):
                                $output .= '<p class="title-small text-uppercase font-weight-600 letter-spacing-1"'.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</p>';
                            endif;
                            if($button_title):
                                $output .= '<a class="highlight-button btn btn-small no-margin" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                            endif;
                        $output .= '</div>';
                    $output .= '</div>';
                    break;

                case 'block-46':
                	$output .= '<div class="slider-typography text-left '.$class.'" '.$id.'>';
                        $output .= '<div class="slider-text-middle-main">';
                            $output .= '<div class="col-md-6 col-sm-8 col-xs-10 contant-box position-absolute no-padding'.$hcode_block_position_right.'"'.$hcode_block_bg_color.'>';
                                $output .= '<div class="position-relative overflow-hidden padding-ten no-padding-bottom">';
                                	if( $hcode_block_title || $hcode_block_title_color ):
                                    	$output .= '<h5 class="text-big alt-font position-absolute"'.$hcode_block_title_color.'>'.$hcode_block_title.'</h5>';
                                    endif;
                                    $output .= '<div class="separator-line bg-white margin-bottom-eleven no-margin-top no-margin-lr xs-margin-bottom-ten"></div>';
                                    if( $content ):
                                    	$output .= do_shortcode( hcode_remove_wpautop( $content ) );
                                	endif;
                                    if( $hcode_block_title || $hcode_block_title_color ):
                                    	$output .= '<h5 class="text-big-title alt-font word-wrap-normal"'.$hcode_block_title_color.'>'.$hcode_block_title.'</h5>';
                                	endif;
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                break;
                
                case 'block-47':
                    if( $hcode_block_subtitle || $hcode_block_subtitle_color ):
                        $output .= '<p class="text-large no-margin-bottom"'.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</p>';
                    endif;
                    if( $hcode_block_title || $hcode_block_title_color ):
                        $output .= '<h1 class="margin-five no-margin-top"'.$hcode_block_title_color.'>'.$hcode_block_title.'</h1>';
                    endif;
                    if( $content ):
                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                    break;

                case 'block-48':
                    if($hcode_block_number):
                        $output .='<span class="services-number font-weight-100 gray-text">'.$hcode_block_number.'</span>';
                    endif;
                    if($hcode_block_title || $hcode_block_title_color):
                        $output .='<p class="text-uppercase letter-spacing-2 font-weight-600 margin-five no-margin-bottom"'.$hcode_block_title_color.'>'.$hcode_block_title.'</p>';
                    endif;
                    if($content):
                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                    break;
                    
                case 'block-49':
                    $output .= '<div class="popular-destinations position-relative '.$class.'" '.$id.'>';
                        if($thumb[0]):
                            $output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
                        endif;
                        if($hcode_block_title || $hcode_block_subtitle || $button_title):
                            $output .= '<div class="popular-destinations-text">';
                                if( $hcode_block_title || $hcode_block_title_color ):
                                    $output .= '<span class="destinations-name text-med text-uppercase font-weight-600 letter-spacing-3 display-block"'.$hcode_block_title_color.'>'.$hcode_block_title.'</span>';
                                endif;
                                if( $hcode_block_subtitle || $hcode_block_subtitle_color ):
                                    $output .= '<span class="destinations-place text-uppercase font-weight-400 letter-spacing-3 display-block"'.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                                endif;
                                if( $button_title ):
                                    $output .= '<a class="highlight-button btn btn-small no-margin-right no-margin-bottom" href="'.$button_link.'" target="'.$button_target.'">'.$button_title.'</a>';
                                endif;
                            $output .= '</div>';
                        endif;
                        $output .= '<div class="popular-destinations-highlight bg-white">';
                            if( $hcode_block_hover_icon2 || $hcode_block_hover_title2 || $hcode_block_hover_subtitle2 ):
                                $output .= '<div class="popular-destinations-highlight-sub">';
                                    if( $hcode_block_hover_icon1 ):
                                        $output .= '<i class="'.$hcode_block_hover_icon1.' medium-icon"></i>';
                                    endif;
                                    if( $hcode_block_hover_title1 ):
                                        $output .= '<span class="display-block text-med font-weight-600 black-text text-uppercase letter-spacing-2">'.$hcode_block_hover_title1.'</span>';
                                    endif;
                                    if( $hcode_block_hover_subtitle1 ):
                                        $output .= '<span class="text-uppercase font-weight-400 letter-spacing-2 black-text">'.$hcode_block_hover_subtitle1.'</span>';
                                    endif;
                                $output .= '</div>';
                            endif;
                            if( $hcode_block_hover_icon2 || $hcode_block_hover_title2 || $hcode_block_hover_subtitle2 ):
                                $output .= '<div class="popular-destinations-highlight-sub">';
                                    if( $hcode_block_hover_icon2 ):
                                        $output .= '<i class="'.$hcode_block_hover_icon2.' medium-icon"></i>';
                                    endif;
                                    if( $hcode_block_hover_title2 ):
                                        $output .= '<span class="display-block text-med font-weight-600 black-text text-uppercase letter-spacing-2">'.$hcode_block_hover_title2.'</span>';
                                    endif;
                                    if( $hcode_block_hover_subtitle2 ):
                                        $output .= '<span class="text-uppercase font-weight-400 letter-spacing-2 black-text">'.$hcode_block_hover_subtitle2.'</span>';
                                    endif;
                                $output .= '</div>';
                            endif;
                            if( $hcode_block_hover_content || $hover_button_title ):
                                $output .= '<div class="popular-destinations-highlight-sub">';
                                    if( $hcode_block_hover_content ):
                                        $output .= '<p class="no-margin-bottom">'.$hcode_block_hover_content.'</p>';
                                    endif;
                                    if( $hover_button_title ):
                                        $output .= '<a class="highlight-button-dark btn btn-small no-margin-right no-margin-bottom inner-link" href="'.$hover_button_link.'" target="'.$hover_button_target.'">'.$hover_button_title.'</a>';
                                    endif;
                                $output .= '</div>';
                            endif;
                        $output .= '</div>';
                    $output .= '</div>';
                    break;
                    
                case 'block-50':
                    $output .= '<div class="agency-enjoy-right'.$class.'"'.$id.'>';
                        if( $thumb[0] ):
                            $output .= '<div class="center-img sm-display-none"><img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'"></div>';
                        endif;
                        if( $hcode_block_title || $hcode_block_title_color || $hcode_block_subtitle || $hcode_block_subtitle_color ):
                            $output .= '<div class="title-top sm-no-margin-left yellow-text alt-font"'.$hcode_block_title_color.'>';
                            if( $hcode_block_title || $hcode_block_title_color ):
                                $output .= $hcode_block_title;
                            endif;
                            if( $hcode_block_subtitle || $hcode_block_subtitle_color ):
                                $output .= '<span class="white-text"'.$hcode_block_subtitle_color.'>'.$hcode_block_subtitle.'</span>';
                            endif;
                            $output .= '</div>';
                        endif;
                        if( $hcode_block_show_separator ):
                            $output .= '<div class="separator-line bg-yellow no-margin-lr sm-margin-bottom-five"></div>';
                        endif;
                        if( $hcode_block_hover_destinations_small_title ):
                            $output .= '<h3 class="title-small white-text no-padding-bottom margin-five-bottom font-weight-400 letter-spacing-3 xs-margin-bottom-ten">'.$hcode_block_hover_destinations_small_title.'</h3>';
                        endif;
                        $output .= '<div class="row">';
                            $output .= '<div class="col-md-4 col-sm-4 text-center xs-margin-ten-bottom">';
                                if($hcode_block_hover_destinations_image1[0]):
                                    $output .= '<a href="'.$hcode_block_hover_destinations_url1.'"><img '.$image_alt.$image_title.' src="'.$hcode_block_hover_destinations_image1[0].'" width="'.$hcode_block_hover_destinations_image1[1].'" height="'.$hcode_block_hover_destinations_image1[2].'"></a>';
                                endif;
                                $output .= '<div class="white-box bg-white">';
                                    if($hcode_block_hover_destinations_title1):
                                        $output .= '<span class="destinations-name text-uppercase font-weight-600 letter-spacing-1 black-text display-block"><a href="'.$hcode_block_hover_destinations_url1.'">'.$hcode_block_hover_destinations_title1.'</a></span>';
                                    endif;
                                    if($hcode_block_hover_destinations_subtitle1):
                                        $output .= '<span class="destinations-place text-uppercase font-weight-400 letter-spacing-1 display-block">'.$hcode_block_hover_destinations_subtitle1.'</span>';
                                    endif;
                                $output .= '</div>  ';
                            $output .= '</div>';
                            $output .= '<div class="col-md-4 col-sm-4 text-center xs-margin-ten-bottom">';
                                if($hcode_block_hover_destinations_image2[0]):
                                    $output .= '<a href="'.$hcode_block_hover_destinations_url2.'"><img '.$image_alt.$image_title.' src="'.$hcode_block_hover_destinations_image2[0].'" width="'.$hcode_block_hover_destinations_image2[1].'" height="'.$hcode_block_hover_destinations_image2[2].'"></a>';
                                endif;
                                $output .= '<div class="white-box bg-white">';
                                    if($hcode_block_hover_destinations_title2):
                                        $output .= '<span class="destinations-name text-uppercase font-weight-600 letter-spacing-1 black-text display-block"><a href="'.$hcode_block_hover_destinations_url2.'">'.$hcode_block_hover_destinations_title2.'</a></span>';
                                    endif;
                                    if($hcode_block_hover_destinations_subtitle2):
                                        $output .= '<span class="destinations-place text-uppercase font-weight-400 letter-spacing-1 display-block">'.$hcode_block_hover_destinations_subtitle2.'</span>';
                                    endif;
                                $output .= '</div>';
                            $output .= '</div>';
                            $output .= '<div class="col-md-4 col-sm-4 text-center">';
                                if($hcode_block_hover_destinations_image3[0]):
                                    $output .= '<a href="'.$hcode_block_hover_destinations_url3.'"><img '.$image_alt.$image_title.' src="'.$hcode_block_hover_destinations_image3[0].'" width="'.$hcode_block_hover_destinations_image3[1].'" height="'.$hcode_block_hover_destinations_image3[2].'"></a>';
                                endif;
                                $output .= '<div class="white-box bg-white">';
                                    if($hcode_block_hover_destinations_title3):
                                        $output .= '<span class="destinations-name text-uppercase font-weight-600 letter-spacing-1 black-text display-block"><a href="'.$hcode_block_hover_destinations_url3.'">'.$hcode_block_hover_destinations_title3.'</a></span>';
                                    endif;
                                    if($hcode_block_hover_destinations_title3):
                                        $output .= '<span class="destinations-place text-uppercase font-weight-400 letter-spacing-1 display-block">'.$hcode_block_hover_destinations_subtitle2.'</span>';
                                    endif;
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div> ';
                    $output .= '</div>';
                    break;
            }
        return $output;
    }
}
add_shortcode('hcode_content_block','hcode_content_block_shortcode');
?>