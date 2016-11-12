<?php
/**
 * Metabox For Header.
 *
 * @package H-Code
 */
?>
<?php 
hcode_meta_box_dropdown(	'hcode_enable_header_single',
				esc_html__('Enable Header', 'H-Code'),
				array('2' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 )
			);
hcode_meta_box_dropdown(	'hcode_header_layout_single',
				esc_html__('Select a Header Style', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),			
								'headertype1' => esc_html__('Light Header', 'H-Code'),
                                'headertype2' => esc_html__('Dark Header', 'H-Code'),
                                'headertype3' => esc_html__('Dark Transparent Header', 'H-Code'),
                                'headertype4' => esc_html__('Light Transparent Header', 'H-Code'),
                                'headertype5' => esc_html__('Static Sticky Header', 'H-Code'),
                                'headertype6' => esc_html__('White Sticky Header', 'H-Code'),
                                'headertype7' => esc_html__('Gray Header', 'H-Code'),
                                'headertype8' => esc_html__('Non Sticky Header', 'H-Code'),
                                   )
			);
hcode_meta_box_dropdown_menu(	'hcode_header_menu_single',
				esc_html__('Select Menu', 'H-Code'),
				'',
				esc_html__('You can manage menu using Appearance > Menus', 'H-Code')
			);
hcode_meta_box_dropdown(	'hcode_header_text_color_single',
				esc_html__('Header Text Color', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  'nav-black' => esc_html__('Black', 'H-Code'),
					  'nav-white' => esc_html__('White', 'H-Code'),
					 )
			);
hcode_meta_box_upload(	'hcode_header_logo_single', 
				esc_html__('Logo', 'H-Code'),
				esc_html__('Upload the logo that will be displayed in the header', 'H-Code')
			);
hcode_meta_box_upload(	'hcode_header_light_logo_single', 
				esc_html__('Logo (Light)', 'H-Code'),
				esc_html__('Upload a light version of logo used in dark backgrounds header template.', 'H-Code')
			);
hcode_meta_box_upload(	'hcode_retina_logo_single', 
				esc_html__('Retina Logo', 'H-Code'),
				esc_html__('Optional retina version displayed in devices with retina display (high resolution display).', 'H-Code')
			);
hcode_meta_box_upload(	'hcode_retina_logo_light_single', 
				esc_html__('Retina Logo (Light)', 'H-Code'),
				esc_html__('(Upload a light version of logo) optional retina version displayed in devices with retina display (high resolution display).', 'H-Code')
			);
hcode_meta_box_dropdown(	'hcode_header_search_single',
				esc_html__('Search Modules', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('If on, a search module will be displayed in header section.', 'H-Code')
			);
hcode_meta_box_dropdown(	'hcode_header_cart_single',
				esc_html__('Cart Module', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('If on, a cart module will be displayed in header section. It will only work if Woocommerce plugin is installed and active.', 'H-Code')
			);
?>