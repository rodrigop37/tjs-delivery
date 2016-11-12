<?php
/**
 * Metabox For Post Setting.
 *
 * @package H-Code
 */
?>
<?php 
hcode_meta_box_dropdown('hcode_image_single',
				esc_html__('Featured Image in Post Page', 'H-Code'),
				array('' => esc_html__('Select a image', 'H-Code'),
					'no' => esc_html__('No', 'H-Code'),
					'1' => esc_html__('Yes', 'H-Code'),
					 ),
				esc_html__('Select No if you do not want to show featured image in the post detail page', 'H-Code')
			);
hcode_meta_box_dropdown('hcode_featured_image_single',
				esc_html__('Featured Image in Post Page', 'H-Code'),
				array('no' => esc_html__('No', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					 ),
				esc_html__('Select No if you do not want to show featured image in the post detail page.', 'H-Code')
			);
hcode_meta_box_textarea('hcode_quote_single',
				esc_html__('Blockquote', 'H-Code'),
				esc_html__('Add block quote content', 'H-Code')
			);
hcode_meta_box_dropdown('hcode_lightbox_image_single',
				esc_html__('List Type', 'H-Code'),
				array('1' => esc_html__('Lightbox', 'H-Code'),
					  '0' => esc_html__('Slider', 'H-Code'),
					 ),
				esc_html__('Select listing type', 'H-Code')
			);
hcode_meta_box_upload_multiple('hcode_gallery_single', 
				esc_html__('Images', 'H-Code'),
				esc_html__('Upload / select multiple images to build a gallery', 'H-Code')
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
				esc_html__('Add external link', 'H-Code')
			);
hcode_meta_box_dropdown('hcode_video_type_single',
				esc_html__('Video Type', 'H-Code'),
				array('' => esc_html__('Select Video Type', 'H-Code'),
					'self' => esc_html__('Self Hosted', 'H-Code'),
					  'external' => esc_html__('External Url', 'H-Code'),
					 ),
				esc_html__('Select video type', 'H-Code')
			);
hcode_meta_box_dropdown('hcode_enable_mute_single',
				esc_html__('Enable Video Mute', 'H-Code'),
				array('0' => esc_html__('No', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					 ),
				esc_html__('Select yes to mute video sound.', 'H-Code')
			);
hcode_meta_box_dropdown('hcode_enable_loop_single',
				esc_html__('Enable Video Loop', 'H-Code'),
				array('1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code'),
					 ),
				esc_html__('Select yes to loop video.', 'H-Code')
			);
hcode_meta_box_dropdown('hcode_enable_autoplay_single',
				esc_html__('Enable Video Autoplay', 'H-Code'),
				array('1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code'),
					 ),
				esc_html__('Select yes to autoplay video.', 'H-Code')
			);
hcode_meta_box_dropdown('hcode_enable_controls_single',
				esc_html__('Enable Video Controls', 'H-Code'),
				array('1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code'),
					 ),
				esc_html__('Select yes to add controls in video.', 'H-Code')
			);
hcode_meta_box_text('hcode_video_mp4_single',
				esc_html__('MP4 Video URL', 'H-Code'),
				esc_html__('Video url is required here if self hosted option is selected', 'H-Code'),
				esc_html__('', 'H-Code')
			);
hcode_meta_box_text('hcode_video_ogg_single',
				esc_html__('OGG Video URL', 'H-Code'),
				esc_html__('Video url is required here if self hosted option is selected', 'H-Code'),
				esc_html__('', 'H-Code')
			);
hcode_meta_box_text('hcode_video_webm_single',
				esc_html__('WEBM Video URL', 'H-Code'),
				esc_html__('Video url is required here if self hosted option is selected', 'H-Code'),
				esc_html__('', 'H-Code')
			);
hcode_meta_box_text('hcode_video_single',
				esc_html__('Add Youtube/Vimeo Embed Url', 'H-Code'),
				'Video url is required here if external url option is selected.',
				esc_html__('Add YOUTUBE VIDEO EMBED URL like https://www.youtube.com/embed/xxxxxxxxxx, you will get this from youtube embed iframe src code. or add VIMEO VIDEO EMBED URL like https://player.vimeo.com/video/xxxxxxxx, you will get this from vimeo embed iframe src code.', 'H-Code')
			);
?>