<?php
/**
 * Metabox For Footer Wrapper.
 *
 * @package H-Code
 */
?>
<?php
hcode_meta_box_dropdown(	'hcode_enable_footer_wrapper_single',
				esc_html__('Enable Footer Wrapper', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Select enable footer wrapper', 'H-Code')
			);
?>