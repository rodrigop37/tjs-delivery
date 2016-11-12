<?php
/**
 * Metabox For Portfolio Setting.
 *
 * @package H-Code
 */
?>
<?php 
hcode_meta_box_text('hcode_subtitle_single',
				esc_html__('Title on Hover', 'H-Code'),
				esc_html__('This title will be displayed on hover of the portfolio image', 'H-Code')
			);
hcode_meta_box_dropdown('hcode_enable_ajax_popup_single',
				esc_html__('Enable Ajax Popup', 'H-Code'),
				array('no' => esc_html__('No', 'H-Code'),
					  'yes' => esc_html__('Yes', 'H-Code'),
					 )
			);
hcode_meta_box_textarea('hcode_quote_single',
				esc_html__('Blockquote', 'H-Code'),
				esc_html__('Add block quote content', 'H-Code')
			);
hcode_meta_box_dropdown(	'hcode_image_single',
				esc_html__('Featured Image in Portfolio Page', 'H-Code'),
				array('' => esc_html__('Select a image', 'H-Code'),
					'no' => esc_html__('No', 'H-Code'),
					'1' => esc_html__('Yes', 'H-Code'),
					 ),
				esc_html__('Select No if you do not want to show featured image in the portfolio detail page.', 'H-Code'),
				esc_html__('select_image', 'H-Code')
			);
hcode_meta_box_dropdown(	'hcode_featured_image_single',
				esc_html__('Featured Image in Portfolio Page', 'H-Code'),
				array('no' => esc_html__('No', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					 ),
				esc_html__('Select No if you do not want to show featured image in the portfolio detail page.', 'H-Code')
			);

hcode_meta_box_upload_multiple('hcode_gallery_single', 
				esc_html__('Images', 'H-Code'),
				esc_html__('Upload / select multiple images to build a gallery', 'H-Code'),
				esc_html__('select_gallery', 'H-Code')
			);
hcode_meta_box_dropdown('hcode_link_type_single',
				esc_html__('Link Type', 'H-Code'),
				array('external' => esc_html__('External Url', 'H-Code'),
					  'ajax-popup' => esc_html__('Ajax Popup', 'H-Code'),
					 ),
				esc_html__('Select link type', 'H-Code')
			);
hcode_meta_box_text('hcode_link_single',
				esc_html__('External Link', 'H-Code'),
				esc_html__('Add external link', 'H-Code'),
				'',
				esc_html__('select_link', 'H-Code')
			);
hcode_meta_box_text('hcode_video_single',
				esc_html__('Add Youtube/Vimeo Url', 'H-Code'),
				esc_html__('Video url is required here if external url option is selected.', 'H-Code'),
				esc_html__('Add YOUTUBE VIDEO URL like https://www.youtube.com/watch?v=xxxxxxxxxx, you will get this from youtube video url. or add VIMEO VIDEO EMBED URL like https://player.vimeo.com/video/xxxxxxxx, you will get this from vimeo embed iframe src code', 'H-Code'),
				esc_html__('select_video', 'H-Code')
			);
?>