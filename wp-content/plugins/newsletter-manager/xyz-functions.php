<?php

/* Local time Insert */
if(!function_exists('xyz_local_date_time_create')){
	function xyz_local_date_time_create($timestamp){
		return $timestamp - ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
	}
}


/* Local time formating */
if(!function_exists('xyz_local_date_time')){
	function xyz_local_date_time($format,$timestamp){
		return gmdate($format, $timestamp + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ));
	}
}

/* new file name creation*/
if(!function_exists('xyz_insert_file')){
	function xyz_insert_file($path, $fileName, $i, $extension){
		$firstFileName=$fileName;
		if($i != 0){
			$fileName = $fileName.$i;
		}
		if (!file_exists($path."/".$fileName.".".$extension)) {
			return $fileName.".".$extension;
		} else {
			$j = $i + 1;
			return xyz_insert_file($path, $firstFileName, $j, $extension);
		}
	}

}
/* new file name creation*/

if(!function_exists('esc_textarea'))
{
function esc_textarea($text)
	{
		$safe_text = htmlspecialchars( $text, ENT_QUOTES );
		return $safe_text;
	}
}
if(!function_exists('xyz_trim_deep'))
{

function xyz_trim_deep($value) {
	if ( is_array($value) ) {
		$value = array_map('xyz_trim_deep', $value);
	} elseif ( is_object($value) ) {
		$vars = get_object_vars( $value );
		foreach ($vars as $key=>$data) {
			$value->{$key} = xyz_trim_deep( $data );
		}
	} else {
		$value = trim($value);
	}

	return $value;
}

}


if(!function_exists('xyz_em_plugin_get_version'))
{
	function xyz_em_plugin_get_version() 
	{
		if ( ! function_exists( 'get_plugins' ) )
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$plugin_folder = get_plugins( '/' . plugin_basename( dirname( XYZ_EM_PLUGIN_FILE ) ) );
		// 		print_r($plugin_folder);
		return $plugin_folder['newsletter-manager.php']['Version'];
	}
}



if(!function_exists('xyz_em_links')){
function xyz_em_links($links, $file) {
	$base = plugin_basename(XYZ_EM_PLUGIN_FILE);
	if ($file == $base) {

		$links[] = '<a href="http://kb.xyzscripts.com/wordpress-plugins/newsletter-manager/"  title="FAQ">FAQ</a>';
		$links[] = '<a href="http://docs.xyzscripts.com/wordpress-plugins/newsletter-manager/"  title="Read Me">README</a>';
		$links[] = '<a href="http://xyzscripts.com/donate/1" title="Donate">Donate</a>';
		$links[] = '<a href="http://xyzscripts.com/support/" class="xyz_support" title="Support"></a>';
		$links[] = '<a href="http://twitter.com/xyzscripts" class="xyz_twitt" title="Follow us on Twitter"></a>';
		$links[] = '<a href="https://www.facebook.com/xyzscripts" class="xyz_fbook" title="Like us on Facebook"></a>';
		$links[] = '<a href="https://plus.google.com/+Xyzscripts/" class="xyz_gplus" title="+1 us on Google+"></a>';
		$links[] = '<a href="http://www.linkedin.com/company/xyzscripts" class="xyz_linkedin" title="Follow us on LinkedIn"></a>';
	}
	return $links;
}
}
add_filter( 'plugin_row_meta','xyz_em_links',10,2);

?>