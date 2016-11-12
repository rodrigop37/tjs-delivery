<?php
/**
 * Metabox For Title Wrapper.
 *
 * @package H-Code
 */
?>
<?php
hcode_meta_box_dropdown('hcode_enable_title_wrapper_single',
				esc_html__('Enable Title', 'H-Code'),
				array('1' => esc_html__('Default', 'H-Code'),
					  '2' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('If on, a title will display in page', 'H-Code')
			);
hcode_meta_box_dropdown( 'hcode_page_title_premade_style_single',
				esc_html__('Title Template Style', 'H-Code'),
					array(esc_html__('default', 'H-Code') => esc_html__('Default', 'H-Code'),
                           'title-white' => esc_html__('Title White', 'H-Code'),
                           'title-gray' => esc_html__('Title Gray', 'H-Code'),
                           'title-dark-gray' => esc_html__('Title Dark Gray', 'H-Code'),
                           'title-black' => esc_html__('Title Black', 'H-Code'),
                           'title-with-image' => esc_html__('Title With Image', 'H-Code'),
                           'title-large' => esc_html__('Title Large', 'H-Code'),
                           'title-large-without-overlay' => esc_html__('Title Large Without Overlay', 'H-Code'),
                           'title-small-white' => esc_html__('Title Small White', 'H-Code'),
                           'title-small-gray' => esc_html__('Title Small Gray', 'H-Code'),
                           'title-small-dark-gray' => esc_html__('Title Small Dark Gray', 'H-Code'),
                           'title-small-black' => esc_html__('Title Small Black', 'H-Code'),
                           'title-center-align' => esc_html__('Title Center Align', 'H-Code'),
                          ),
				esc_html__('Choose template style for the title', 'H-Code')
			);
hcode_meta_box_text('hcode_header_subtitle_single',
				esc_html__('Subtitle', 'H-Code')
			);
hcode_meta_box_upload(	'hcode_title_background_single', 
				esc_html__('Title Background Image', 'H-Code'),
				esc_html__('Recommended image size (1920px X 700px) for better result.', 'H-Code')
			);
hcode_meta_box_dropdown( 'hcode_title_parallax_effect_single',
				esc_html__('Parallax effect', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  'no-effect' => esc_html__('No Effect', 'H-Code'),
					  'parallax1' => esc_html__('parallax-effect-1', 'H-Code'),
					  'parallax2' => esc_html__('parallax-effect-2', 'H-Code'),
					  'parallax3' => esc_html__('parallax-effect-3', 'H-Code'),
					  'parallax4' => esc_html__('parallax-effect-4', 'H-Code'),
					  'parallax5' => esc_html__('parallax-effect-5', 'H-Code'),
					  'parallax6' => esc_html__('parallax-effect-6', 'H-Code'),
					  'parallax7' => esc_html__('parallax-effect-7', 'H-Code'),
					  'parallax8' => esc_html__('parallax-effect-8', 'H-Code'),
					  'parallax9' => esc_html__('parallax-effect-9', 'H-Code'),
					  'parallax10' => esc_html__('parallax-effect-10', 'H-Code'),
					  'parallax11' => esc_html__('parallax-effect-11', 'H-Code'),
					  'parallax12' => esc_html__('parallax-effect-12', 'H-Code')
					 ),
				esc_html__('Choose parallax effect', 'H-Code')
			);
hcode_meta_box_dropdown(	'hcode_page_title_show_breadcrumb_single',
				esc_html__('Enable Breadcrumb', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('If on, breadcrumb will display in title section', 'H-Code')
			);
hcode_meta_box_dropdown(	'hcode_page_title_show_separator_single',
				esc_html__('Enable Separator', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('If on, separator will display in title section', 'H-Code')
			);
?>