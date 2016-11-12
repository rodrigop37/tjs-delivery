<?php
/**
 * Metabox For Content.
 *
 * @package H-Code
 */
?>
<?php 
if($post->post_type == 'post'){
	hcode_meta_box_dropdown(	'hcode_enable_post_comment_single',
				esc_html__('Enable Comments', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Select enable post comments', 'H-Code')
			);
}elseif($post->post_type == 'portfolio'){

	hcode_meta_box_dropdown(	'hcode_enable_portfolio_comment_single',
				esc_html__('Enable Comments', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Select enable portfolio comments', 'H-Code')
			);
}else{
	hcode_meta_box_dropdown(	'hcode_enable_page_comment_single',
				esc_html__('Enable Comments', 'H-Code'),
				array('default' => esc_html__('Default', 'H-Code'),
					  '1' => esc_html__('Yes', 'H-Code'),
					  '0' => esc_html__('No', 'H-Code')
					 ),
				esc_html__('Select enable page comments.', 'H-Code')
			);
}
?>