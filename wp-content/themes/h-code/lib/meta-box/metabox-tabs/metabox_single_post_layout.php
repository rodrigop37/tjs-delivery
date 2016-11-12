<?php
/**
 * Metabox For Single Post Layout.
 *
 * @package H-Code
 */
?>
<?php 
if($post->post_type == 'post'){
	hcode_meta_box_dropdown('hcode_single_layout_settings_single',
				esc_html__('Single Post Layout Settings', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  'hcode_single_layout_standard' => esc_html__('Standard', 'H-Code'),
					  'hcode_single_layout_full_width' => esc_html__('Full width header', 'H-Code'),
					  'hcode_single_layout_full_width_image_slider' => esc_html__('Full width with image slider', 'H-Code'),
					  'hcode_single_layout_full_width_lightbox' => esc_html__('Full width with lightbox gallery', 'H-Code')
					 ),
				esc_html__('Select main content and sidebar alignment. Choose between 1 or 2 column layout.', 'H-Code')
			);

	hcode_meta_box_dropdown('hcode_enable_related_posts_single',
				esc_html__('Enable Recent Post', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Enable recent post', 'H-Code')
			);

	hcode_meta_box_dropdown('hcode_enable_navigation_single',
				esc_html__('Enable Navigation Post', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Enable navigation post', 'H-Code')
			);
	hcode_meta_box_dropdown('hcode_enable_meta_tags_single',
				esc_html__('Enable Post Meta Tags', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					'1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Enable post meta tags', 'H-Code')
			);
	hcode_meta_box_dropdown('hcode_enable_post_author_single',
				esc_html__('Enable Post Author', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Enable post author', 'H-Code')
			);
	hcode_meta_box_dropdown('hcode_social_icons_single',
				esc_html__('Enable Social Icons', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Enable social icons', 'H-Code')
			);
}else{
	hcode_meta_box_dropdown('hcode_enable_related_portfolio_posts_single',
			esc_html__('Enable Recent Project', 'H-Code'),
				  array('default' => esc_html__('Default', 'H-Code'),
				  '0' => esc_html__('No', 'H-Code'),
				  '1' => esc_html__('Yes', 'H-Code'),
				 ),
			esc_html__('Enable recent project', 'H-Code')
		);

	hcode_meta_box_dropdown('hcode_enable_navigation_portfolio_single',
				esc_html__('Enable Navigation Portfolio', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Enable navigation portfolio', 'H-Code')
			);
	hcode_meta_box_dropdown('hcode_enable_meta_tags_portfolio_single',
				esc_html__('Enable Post Meta Tags', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					'1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Enable post meta tags', 'H-Code')
			);
	hcode_meta_box_dropdown('hcode_enable_post_author_portfolio_single',
				esc_html__('Enable Post Author', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Enable post author', 'H-Code')
			);
	hcode_meta_box_dropdown('hcode_social_icons_portfolio_single',
				esc_html__('Enable Social Icons', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Enable social icons', 'H-Code')
			);
}
?>