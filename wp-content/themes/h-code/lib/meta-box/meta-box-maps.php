<?php
/**
 * Metabox Map
 *
 * @package H-Code 
 */
?>
<?php
if ( ! function_exists( 'hcode_meta_box_text' ) ) {
	function hcode_meta_box_text($id, $label, $desc = '', $short_desc = '',$extra='')
	{
		global $post;
		

		$html = '';
			$html .= '<div class="'.$id.'_box description_box">';
			$html .= '<div class="left-part">';
				$html .= $label;
				if($desc) {
					$html .= '<span class="description">' . $desc . '</span>';
				}
			$html .='</div>';
			$html .= '<div class="right-part">';
				$html .= '<input type="text" id="' . $id . '" name="' . $id . '" value="' . get_post_meta($post->ID, $id, true) . '" />';
				if($short_desc) {
					$html .= '<span class="short-description">' . $short_desc . '</span>';
				}
				if(!empty($extra) && get_post_meta($post->ID, $id, true) != ''){
					$html .= '<input name="hcode_hidden_val_'.$extra.'" id="hcode_hidden_val_'.$extra.'" type="hidden" value="1" />';
				}
			$html .= '</div>';
			$html .= '</div>';

		echo $html;
	}
}

if ( ! function_exists( 'hcode_meta_box_dropdown' ) ) {
	function hcode_meta_box_dropdown($id, $label, $options, $desc = '',$extra='')
	{
		global $post;

		$html = $select_class = '';

	            $html .= '<div class="'.$id.'_box description_box">';
	                    $html .= '<div class="left-part">';
	                            $html .= $label;
	                            if($desc) {
	                                    $html .= '<span class="description">' . $desc . '</span>';
	                            }
	                    $html .='</div>';
	                    $html .= '<div class="right-part">';
	                            $html .= '<select id="' . $id . '" class="'.$select_class.'" name="' . $id . '">';
	                            foreach($options as $key => $option) {
	                                    if(get_post_meta($post->ID, $id, true) == (string)$key && get_post_meta($post->ID, $id, true) != '') {
	                                            $selected = 'selected="selected"';
	                                    }else {
	                                                    $selected = '';
	                                    }

	                                    $html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';

	                            }
	                            $html .= '</select>';

                            if(!empty($extra) && get_post_meta($post->ID, $id, true) != '')
								$html .= '<input name="hcode_hidden_val_'.$extra.'" id="hcode_hidden_val_'.$extra.'" type="hidden" value="1" />';

	                    $html .='</div>';	
			$html .= '</div>';
		echo $html;
	}
}

if ( ! function_exists( 'hcode_meta_box_dropdown_sidebar' ) ) {
	function hcode_meta_box_dropdown_sidebar($id, $label, $options, $desc = '', $child_hidden = '')
	{
		global $post;

		$html = $select_class = '';
		$flag = false;
			$child_hidden = ( $child_hidden ) ? ' hide-child '.$child_hidden : '';
			$html .= '<div class="'.$id.'_box description_box'.$child_hidden.'">';
				$html .= '<div class="left-part">';
					$html .= $label;
					if($desc) {
						$html .= '<span class="description">' . $desc . '</span>';
					}
				$html .='</div>';
				$html .= '<div class="right-part">';
					$html .= '<select id="' . $id . '" class="'.$select_class.'" name="' . $id . '">';
					foreach($options as $key => $option) {
						if(get_post_meta($post->ID, $id, true) == $key && get_post_meta($post->ID, $id, true) != '') {
							$selected = 'selected="selected"';
						}else {
								$selected = '';
						}

						$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';

					}
					$html .= '</select>';
				$html .='</div>';	
			$html .= '</div>';
		echo $html;
	}
}

/* menu dropdown */

if ( ! function_exists( 'hcode_meta_box_dropdown_menu' ) ) {
	function hcode_meta_box_dropdown_menu($id, $label, $options, $desc = '')
	{
		global $post;

		$html = $select_class = '';
		$flag = false;

		
			$html .= '<div class="'.$id.'_box description_box">';
				$html .= '<div class="left-part">';
					$html .= $label;
					if($desc) {
						$html .= '<span class="description">' . $desc . '</span>';
					}
				$html .='</div>';
				$html .= '<div class="right-part">';
					$html .= '<select id="' . $id . '" class="'.$select_class.'" name="' . $id . '">';
					$html .= '<option value="">Default</option>';
					$menus = wp_get_nav_menus();
					$menu_array = array();
					foreach ($menus as $key => $value) {
						if(get_post_meta($post->ID, $id, true) == $value->slug && get_post_meta($post->ID, $id, true) != '') {
							$selected = 'selected="selected"';
						}else {
								$selected = '';
						}

						$html .= '<option ' . $selected . 'value="' . $value->slug . '">' . $value->name . '</option>';
					}
					$html .= '</select>';
				$html .='</div>';	
			$html .= '</div>';
		echo $html;
	}
}

if ( ! function_exists( 'hcode_meta_box_textarea' ) ) {
	function hcode_meta_box_textarea($id, $label, $desc = '', $default = '' )
	{
		global $post;
		$html = '';
		$html .= '<div class="'.$id.'_box description_box">';
		$html .= '<div class="left-part">';
			$html .= $label;
			if($desc) {
				$html .= '<span class="description">' . $desc . '</span>';
			}
		$html .='</div>';
		
		if( get_post_meta($post->ID, $id, true)) {
			$value = get_post_meta($post->ID, $id, true);
			
		} else {
			$value = '';
			
		}
		$html .= '<div class="right-part">';
			$html .= '<textarea cols="120" id="' . $id . '" name="' . $id . '">' . $value . '</textarea>';
		$html .='</div>';
		$html .= '</div>';

		echo $html;
	}
}

if ( ! function_exists( 'hcode_meta_box_upload' ) ) {
	function hcode_meta_box_upload($id, $label, $desc = '')
	{
		global $post;

		$html = '';
		$html .= '<div class="'.$id.'_box description_box">';
		$html .= '<div class="left-part">';
			$html .= $label;
			if($desc) {
				$html .= '<span class="description">' . $desc . '</span>';
			}
		$html .='</div>';
		$html .= '<div class="right-part">';
			$html .= '<input name="' . $id . '" class="upload_field" id="hcode_upload" type="text" value="' . get_post_meta($post->ID,  $id, true) . '" />';
			$html .= '<input name="'. $id.'_thumb" class="'. $id.'_thumb" id="'. $id.'_thumb" type="hidden" value="'.get_post_meta($post->ID,  $id, true).'" />';
	                $html .= '<img class="upload_image_screenshort" src="'.get_post_meta($post->ID,  $id, true).'" />';
			$html .= '<input class="hcode_upload_button" id="hcode_upload_button" type="button" value="Browse" />';
			$html .= '<span class="hcode_remove_button button">'.__("Remove", "H-Code").'</span>';      
		$html .='</div>';
		$html .= '</div>';
		echo $html;
	}
}

if ( ! function_exists( 'hcode_meta_box_upload_multiple' ) ) {
	function hcode_meta_box_upload_multiple($id, $label, $desc = '',$extra='')
	{
		global $post;

		$html = '';
		$html .= '<div class="'.$id.'_box description_box">';
			$html .= '<div class="left-part">';
				$html .= $label;
				if($desc) {
					$html .= '<span class="description">' . $desc . '</span>';
				}
			$html .='</div>';
			$html .= '<div class="right-part">';
				$html .= '<input name="' . $id . '" class="upload_field" id="hcode_upload" type="hidden" value="'.get_post_meta($post->ID,  $id, true).'" />';

				$html .= '<div class="multiple_images">';
				$val = explode(",",get_post_meta($post->ID,  $id, true));
				
				foreach ($val as $key => $value) {
					if(!empty($value)):
						$image_url = wp_get_attachment_url( $value );
						$html .='<div id='.$value.'>';
		                	$html .= '<img class="upload_image_screenshort_multiple" src="'.$image_url.'" style="width:100px;" />';
		                	$html .= '<a href="javascript:void(0)" class="remove">'.__("Remove", "H-Code").'</a>';
		            	$html .= '</div>';
		            endif;
				}
		        $html .= '</div>';
				$html .= '<input class="hcode_upload_button_multiple" id="hcode_upload_button_multiple" type="button" value="Browse" />'.__(" Select Files", "H-Code");
		        if(!empty($extra) && get_post_meta($post->ID, $id, true) != '')
						$html .= '<input name="hcode_hidden_val_'.$extra.'" id="hcode_hidden_val_'.$extra.'" type="hidden" value="1" />';

			$html .='</div>';
		$html .= '</div>';
		echo $html;
	}
}
?>