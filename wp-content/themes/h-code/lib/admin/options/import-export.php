<?php
/**
 * Import / Export Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$message = '';
if( isset($_GET['show-message'])){
	$message = 'class="demo-show-message"';
}else{
	$message = 'class="demo-hide-message"';
}
$this->sections[] = array(
	'title' => esc_html__('Import/Export', 'H-Code'),
	'desc' => esc_html__('Import/Export options', 'H-Code'),
	'icon' => 'fa fa-exchange icon-rotate-90',
	'fields' => array(
		
		array(
			'id'            => 'hcode_import_sample_data',
			'type'			=> 'raw',
			'title'         => '',
			'content'		=> '
				<strong>'.esc_html__('Import Demo Content', 'H-Code').'</strong>
				<p class="description">'.esc_html__('Import demo content data including posts, pages, portfolio, theme options, widgets, images, sliders etc… It may take several minutes, so please have some patience.', 'H-Code').'</p><br/>
				<strong>'.esc_html__('Warning', 'H-Code').'</strong>
				<p class="description">'.esc_html__('Importing demo content will import sliders, pages, posts, portfolio, theme options, widgets, sidebars and other settings. Your existing setup will be replaced with new demo data and settings from the installed theme version demo content and configurations. So we recommend you take the backup of your existing WordPress setup and database for your safety.', 'H-Code').'</p></br>
				<strong>'.esc_html__('Demo Import Requirements', 'H-Code').'</strong>
				<ul class="import-export-desc">
					<li><i class="fa fa-check"></i>'.esc_html__('Memory Limit of 256 MB and max execution time (php time limit) of 300 seconds.', 'H-Code').'</li>
					<li><i class="fa fa-check"></i>'.esc_html__('Hcode Addon must be activated for Custom post type and Shortcodes to import.', 'H-Code').'</li>
					<li><i class="fa fa-check"></i>'.esc_html__('Visual Composer and Revolution Slider must be activated for content and sliders to import.', 'H-Code').'</li>
					<li><i class="fa fa-check"></i>'.esc_html__('WooCommerce must be activated for shop data to import.', 'H-Code').'</li>
					<li><i class="fa fa-check"></i>'.esc_html__('Contact Form 7 must be activated for form data to import.', 'H-Code').'</li>
					<li><i class="fa fa-check"></i>'.esc_html__('Newsletter Manager must be activated for newsletter form data to import.', 'H-Code').'</li>
				</ul>		
				<div class="import-button-box"><span id="hcode-import-sample-data" class="button button-primary">'.esc_html__('Import Demo Data', 'H-Code').'</span>
				<div id="import-loader-img" class="hidden"><i class="dashicons dashicons-admin-generic fa-spin"></i></div>
				</div>
				<p>'.__('( Note: Please check <a href="http://wpdemos.themezaa.com/h-code/documentation/" target="_blank">H-Code documentation</a> to import intro demo content in Slider Revolution. )').'</p>
				<div id="run-regenerate-thumbnails" '.$message.'><div class="hcode-importer-notice"><p><strong>'.__('Demo data successfully imported. Now, please install and run <a title="Regenerate Thumbnails" class="thickbox" href="'.home_url().'/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=regenerate-thumbnails&amp;TB_iframe=true&amp;width=830&amp;height=472">Regenerate Thumbnails</a> plugin once.').'</strong></p></div></div>
				<div class="import-ajax-message"></div>'
		),
		
		array(
			'id'            => 'opt-import-export',
			'type'          => 'import_export',
			'title'         => esc_html__('Import / Export', 'H-Code'),
			'subtitle'      => esc_html__('Save and restore your H-Code options', 'H-Code'),
			'full_width'    => false
		)
	),
);
?>