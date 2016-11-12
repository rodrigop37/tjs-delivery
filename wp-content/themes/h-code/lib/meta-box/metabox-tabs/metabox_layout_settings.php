<?php
/**
 * Metabox For Layout Setting.
 *
 * @package H-Code
 */
?>
<?php
hcode_meta_box_dropdown(	'hcode_layout_settings_single',
				esc_html__('Sidebar Settings', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  'hcode_layout_left_sidebar' => esc_html__('Two Columns Left', 'H-Code'),
					  'hcode_layout_right_sidebar' => esc_html__('Two Columns Right', 'H-Code'),
					  'hcode_layout_both_sidebar' => esc_html__('Three Columns', 'H-Code'),
					  'hcode_layout_full_screen' => esc_html__('One Column', 'H-Code')
					 )
			);

$sidebar_array = hcode_registered_sidebars_array();

hcode_meta_box_dropdown_sidebar(	'hcode_layout_left_sidebar_single',
				esc_html__('Left Sidebar', 'H-Code'),
				$sidebar_array,
				esc_html__('Select sidebar to display in left column of page', 'H-Code')
			);
hcode_meta_box_dropdown_sidebar(	'hcode_layout_right_sidebar_single',
				esc_html__('Right Sidebar', 'H-Code'),
				$sidebar_array,
				esc_html__('Select sidebar to display in right column of page', 'H-Code')
			);

hcode_meta_box_dropdown('hcode_enable_container_fluid_single',
				esc_html__('Enable Container Fluid', 'H-Code'),
					  array('default' => esc_html__('Default', 'H-Code'),
					  	'0' => esc_html__('No', 'H-Code'),
					    '1' => esc_html__('Yes', 'H-Code'),
					 )
			);
?>