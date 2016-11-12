<?php
/**
 * Metabox For Footer.
 *
 * @package H-Code
 */
?>
<?php 
hcode_meta_box_dropdown('hcode_enable_page_footer_single',
				esc_html__('Enable Footer?', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 )
			);
hcode_meta_box_dropdown('hcode_enable_sidebar_section_single',
				esc_html__('Enable Footer Information Links Block', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 )
			);

$sidebar_array = hcode_registered_sidebars_array();

hcode_meta_box_dropdown_sidebar(	'hcode_footer_sidebar_1_single',
				esc_html__('Information Block', 'H-Code'),
				$sidebar_array,
				esc_html__('Select custom sidebar', 'H-Code')
			);
hcode_meta_box_dropdown_sidebar(	'hcode_footer_sidebar_2_single',
				esc_html__('Link Block 1', 'H-Code'),
				$sidebar_array,
				esc_html__('Select custom sidebar', 'H-Code')
			);
hcode_meta_box_dropdown_sidebar(	'hcode_footer_sidebar_3_single',
				esc_html__('Link Block 2', 'H-Code'),
				$sidebar_array,
				esc_html__('Select custom sidebar', 'H-Code')
			);
hcode_meta_box_dropdown_sidebar(	'hcode_footer_sidebar_4_single',
				esc_html__('Link Block 3', 'H-Code'),
				$sidebar_array,
				esc_html__('Select custom sidebar', 'H-Code')
			);
hcode_meta_box_dropdown_sidebar(	'hcode_footer_sidebar_5_single',
				esc_html__('Link Block 4', 'H-Code'),
				$sidebar_array,
				esc_html__('Select custom sidebar', 'H-Code')
			);
hcode_meta_box_dropdown('hcode_enable_footer_menu_single',
				esc_html__('Enable Footer Menu', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 )
			);
hcode_meta_box_dropdown_menu(	'hcode_footer_menu_single',
				esc_html__('Select Footer Menu', 'H-Code'),
				''
			);
hcode_meta_box_dropdown('hcode_enable_social_icons_single',
				esc_html__('Enable Social Icons', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 )
			);
?>