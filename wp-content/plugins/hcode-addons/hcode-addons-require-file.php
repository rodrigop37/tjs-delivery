<?php
if(!class_exists('Hcode_Set_attribute_taxonomies'))
{
  class Hcode_Set_attribute_taxonomies
  {

	public function add_woocommerce_attribute_taxonomies(){
		global $wpdb;
		$transient_name = 'wc_attribute_taxonomies';
		delete_transient( $transient_name );
		$wpdb->insert( $wpdb->prefix.'woocommerce_attribute_taxonomies', array( 'attribute_name' => 'colors', 'attribute_label' => 'Colors', 'attribute_type' => 'select', 'attribute_orderby' => 'menu_order', 'attribute_public' => '0'  ), array( '%s', '%s', '%s', '%s', '%s' ) ); 
		$wpdb->insert( $wpdb->prefix.'woocommerce_attribute_taxonomies', array( 'attribute_name' => 'size', 'attribute_label' => 'Size', 'attribute_type' => 'select', 'attribute_orderby' => 'menu_order', 'attribute_public' => '0'  ), array( '%s', '%s', '%s', '%s', '%s' ) );
		register_taxonomy(
	        'pa_colors',
	        'product',
	        array(
	            'label' => __( 'Product','hcode-addons'),
	            'rewrite' => array( 'slug' => 'pa_colors' ),
	            'hierarchical' => true,
	        )
	    );
	    register_taxonomy(
	        'pa_size',
	        'product',
	        array(
	            'label' => __( 'Size','hcode-addons'),
	            'rewrite' => array( 'slug' => 'pa_size' ),
	            'hierarchical' => true,
	        )
	    );
		$attribute_taxonomies = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies" );
		set_transient( $transient_name, $attribute_taxonomies );
	}

} // end of class
$Hcode_Set_attribute_taxonomies = new Hcode_Set_attribute_taxonomies();
} // end of class_exists
?>