<?php
/**
 * Shortcode For Image gallery
 *
 * @package H-Code
 */
?>
<?php 
/*-----------------------------------------------------------------------------------*/
/* Image gallery */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_image_gallery_shortcode' ) ) {
	function hcode_image_gallery_shortcode( $atts, $content = null ) { 
		extract( shortcode_atts( array(
	        	'image_gallery_type' => '',
	        	'simple_image_type' => '',
	        	'lightbox_type' => '',
	        	'column' => '',
	        	'image_gallery' => '',
	        	'hcode_column_animation_style' => '',
	        	'padding_setting' => '',
		        'desktop_padding' => '',
		        'custom_desktop_padding' => '',
		        'ipad_padding' => '',
		        'mobile_padding' => '',
		        'margin_setting' => '',
		        'desktop_margin' => '',
		        'custom_desktop_margin' => '',
		        'ipad_margin' => '',
		        'mobile_margin' => '',
		        'hide_lightbox_gallery' => '',
		        'id' => '',
		        'class' => '',
	    ), $atts ) );

		$explode_image = explode(",",$image_gallery);
		//$image_url = wp_get_attachment_url( $image_gallery );
		$image_url = wp_get_attachment_image_src($image_gallery, 'full');
		$output = $classes_desktop = $classes_ipad = $classes_masonry = $padding = $padding_style = $margin = $margin_style = $style_attr = $style ='';  
		$popup_id = ( $id ) ? $id : 'default'; 
		$id = ( $id ) ? 'id="'.$id.'"' : '';
		$class_main = ( $class ) ? $class.' ' : '';
		$hcode_column_animation_style = ($hcode_column_animation_style) ? " wow ".$hcode_column_animation_style : '';
		$hide_lightbox = ( $hide_lightbox_gallery == 1 ) ? '' : 'lightbox-gallery';
		$hide_lightbox_zoom = ( $hide_lightbox_gallery == 1 ) ? '' : 'zoom-gallery';
		// Column Padding settings
		$padding_setting = ( $padding_setting ) ? $padding_setting : '';
		$desktop_padding = ( $desktop_padding ) ? ' '.$desktop_padding : '';
		$ipad_padding = ( $ipad_padding ) ? ' '.$ipad_padding : '';
		$mobile_padding = ( $mobile_padding ) ? ' '.$mobile_padding : '';
		$custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
		if($desktop_padding == ' custom-desktop-padding' && $custom_desktop_padding){
			$padding_style .= " padding: ".$custom_desktop_padding.";";
		}else{
			$padding .= $desktop_padding;
		}
		$padding .= $ipad_padding.$mobile_padding;

		// Column Margin settings
		$margin_setting = ( $margin_setting ) ? $margin_setting : '';
		$desktop_margin = ( $desktop_margin ) ? ' '.$desktop_margin : '';
		$ipad_margin = ( $ipad_margin ) ? ' '.$ipad_margin : '';
		$mobile_margin = ( $mobile_margin ) ? ' '.$mobile_margin : '';
		$custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
		if($desktop_margin == ' custom-desktop-margin' && $custom_desktop_margin){
			$margin_style .= " margin: ".$custom_desktop_margin.";";
		}else{
			$margin .= $desktop_margin;
		}
		$margin .= $ipad_margin.$mobile_margin;

		// Padding and Margin Style Combine
		if($padding_style){
			$style_attr .= $padding_style;
		}
		if($margin_style){
			$style_attr .= $margin_style;
		}
		if($style_attr){
			$style .= ' style="'.$style_attr.'"';
		}
		switch ($column) {
	        case '1':
				$classes_desktop .= '12';
	            $classes_ipad .= '12';
				$classes_masonry .= 'work-1col';
			break;   
			case '2':
				$classes_desktop .= '6';
	            $classes_ipad .= '6';
				$classes_masonry .= 'work-2col';
			break;
			case '3':
				$classes_desktop .= '4';
	            $classes_ipad .= '6';
				$classes_masonry .= 'work-3col';
			break;
			case '4':
				$classes_desktop .= '3';
	            $classes_ipad .= '6';
				$classes_masonry .= 'work-4col';
			break;       
	       	case '6':
				$classes_desktop .= '2';
	            $classes_ipad .= '6';
				$classes_masonry .= 'work-6col';
			break;
		}
		$class = 'col-md-'.$classes_desktop.' col-sm-'.$classes_ipad.$padding.$margin;

		/* Image Alt, Title, Caption */
		$img_alt = hcode_option_image_alt($image_gallery);
		$img_title = hcode_option_image_title($image_gallery);
		$img_lightbox_caption = hcode_option_image_caption($image_gallery);
		$img_lightbox_title = hcode_option_lightbox_image_title($image_gallery);
		$image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
		$image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
		$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
		$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 

		switch ($image_gallery_type) {
		     	case 'simple-image-lightbox':
		     		switch ($simple_image_type) {
						case 'zoom':

							if($image_url[0]):
									$output .= '<div '.$id.' class="'.$class_main.$hcode_column_animation_style.$padding.$margin.'" '.$style.'>';
									if( $hide_lightbox_gallery == 1 ){
							            $output .= '<a href="#" class="default-cursor">';
							        }else{
							        	$output .= '<a class="image-popup-no-margins" href="'.$image_url[0].'" '.$image_lightbox_title.$image_lightbox_caption.'>';
							        }
									 		$output .= '<img src="'.$image_url[0].'" '.$image_alt.$image_title.' width="'.$image_url[1].'" height="'.$image_url[2].'" class="project-img-gallery">';
									 	$output .= '</a>';
							        $output .='</div>';
						    endif;
						break;
						case 'feet':
							if($image_url[0]):
									$output .= '<div '.$id.' class="'.$class_main.$hcode_column_animation_style.$padding.$margin.'" '.$style.'>';
									if( $hide_lightbox_gallery == 1 ){
							            $output .= '<a href="#" class="default-cursor">';
							        }else{
							            $output .= '<a class="image-popup-vertical-fit" href="'.$image_url[0].'" '.$image_lightbox_title.$image_lightbox_caption.'>';
							        }
											$output .= '<img src="'.$image_url[0].'" '.$image_alt.$image_title.' width="'.$image_url[1].'" height="'.$image_url[2].'" class="project-img-gallery">';
										$output .= '</a>';
							        $output .='</div>';
						    endif;
						break;
					}
		     	break;
		     	case 'lightbox-gallery':
		     		switch ($lightbox_type) {
						case 'grid':
							if($explode_image):
									$output .='<div '.$id.' class="'.$class_main.$hide_lightbox.'">';
									foreach ($explode_image as $key => $value) {

										/* Image Alt, Title, Caption */
										$img_alt = hcode_option_image_alt($value);
										$img_title = hcode_option_image_title($value);
										$img_lightbox_caption = hcode_option_image_caption($value);
										$img_lightbox_title = hcode_option_lightbox_image_title($value);
										$image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
										$image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
										$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
										$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 


										$image_url = wp_get_attachment_image_src($value, 'full');
										$output .= '<div class="'.$class.' '.$hcode_column_animation_style.'" '.$style.'>';
										if( $hide_lightbox_gallery == 1 ){
								            $output .= '<a href="#" class="default-cursor">';
								        }else{
								            $output .='<a href="'.$image_url[0].'" class="lightboxgalleryitem" data-group="'.$popup_id.'" '.$image_lightbox_title.$image_lightbox_caption.'>';
								        }
								            	$output .='<img src="'.$image_url[0].'" '.$image_alt.$image_title.' width="'.$image_url[1].'" height="'.$image_url[2].'" class="project-img-gallery" >';
								            $output .='</a>';
								        $output .='</div>';
								    }
							        $output .='</div>';
						    endif;
						break;
						case 'masonry':
							if($explode_image):
								$output .= '<div '.$id.' class="'.$class_main.$classes_masonry.'">';
									$output .='<div class="col-md-12 grid-gallery overflow-hidden '.$padding.$margin.'" '.$style.'>';
										$output .='<ul class="grid masonry-items '.$hide_lightbox.'">';
										foreach ($explode_image as $key => $value) {

											/* Image Alt, Title, Caption */
											$img_alt = hcode_option_image_alt($value);
											$img_title = hcode_option_image_title($value);
											$img_lightbox_caption = hcode_option_image_caption($value);
											$img_lightbox_title = hcode_option_lightbox_image_title($value);
											$image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
											$image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
											$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
											$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 

											$image_url = wp_get_attachment_image_src($value, 'full');
												$output .='<li class="'.$hcode_column_animation_style.'">';
												if( $hide_lightbox_gallery == 1 ){
										            $output .= '<a href="#" class="default-cursor">';
										        }else{
					                                $output .='<a href="'.$image_url[0].'" class="lightboxgalleryitem" data-group="'.$popup_id.'" '.$image_lightbox_title.$image_lightbox_caption.'>';
					                            }
					                                	$output .='<img src="'.$image_url[0].'" '.$image_alt.$image_title.' width="'.$image_url[1].'" height="'.$image_url[2].'" >';
					                                $output .='</a>';
					                            $output .='</li>';
									    }
								        $output .='</ul>';
							        $output .='</div>';
							    $output .='</div>';
						    endif;
						break;
					}
		     	break;
	     		case 'zoom-gallery':
	 				if($image_url[0]):
							$output .= '<div '.$id.' class="'.$class_main.$hide_lightbox_zoom.' '.$hcode_column_animation_style.'">';
							if( $hide_lightbox_gallery == 1 ){
					            $output .= '<a href="#" class="default-cursor">';
					        }else{
					            $output .= '<a href="'.$image_url[0].'" class="lightboxzoomgalleryitem" data-group="'.$popup_id.'" '.$image_lightbox_title.$image_lightbox_caption.'>';
					        }
				     				$output .= '<img src="'.$image_url[0].'" '.$image_alt.$image_title.' width="'.$image_url[1].'" height="'.$image_url[2].'" class="project-img-gallery '.$padding.$margin.'" '.$style.'>';
				     			$output .= '</a>';
					        $output .='</div>';
				    endif;
	     		break;

		     } 
		     return $output;   
	}
}
add_shortcode( 'hcode_image_gallery', 'hcode_image_gallery_shortcode' );
?>