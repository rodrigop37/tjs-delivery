<?php
/**
 * Register Custom Post Type Portfolio.
 *
 * @package H-Code
 */
?>
<?php
/**
 * Portfolio custom post type
 */
$labels = array(
	'name'               => _x( 'Portfolio', 'Projects','hcode-addons' ),
	'singular_name'      => _x( 'Portfolio', 'Project','hcode-addons' ),
	'add_new'            => _x( 'Add New', 'Project','hcode-addons' ),
	'add_new_item'       => __( 'Add New Project','hcode-addons' ),
	'edit_item'          => __( 'Edit Project','hcode-addons' ),
	'new_item'           => __( 'New Project','hcode-addons' ),
	'all_items'          => __( 'All Projects','hcode-addons' ),
	'view_item'          => __( 'View Project','hcode-addons' ),
	'search_items'       => __( 'Search Projects','hcode-addons' ),
	'not_found'          => __( 'No Projects found','hcode-addons' ),
	'not_found_in_trash' => __( 'No Projects found in the Trash','hcode-addons' ),
	'parent_item_colon'  => '',
	'menu_name'          => __('Portfolio', 'hcode-addons' )
);
$args = array(
	'labels'        => $labels,
	'description'   => __('Holds our products and product specific data', 'hcode-addons' ),
	'public'        => true,
	'menu_icon'     => 'dashicons-portfolio',
	'menu_position' => 21,
	'supports'      => array( 'title', 'thumbnail','editor','post-formats', 'comments', 'revisions','page-attributes' ),
	'has_archive'   => true,
	'hierarchical' => true,

);
register_post_type( 'portfolio', $args );

/**
 * Portflio Category
 */
$labels = array(
	'name'              => _x( 'Categories', 'taxonomy general name', 'hcode-addons' ),
	'singular_name'     => _x( 'Category', 'taxonomy singular name', 'hcode-addons' ),
	'search_items'      => __( 'Search categories', 'hcode-addons' ),
	'all_items'         => __( 'All Categories', 'hcode-addons' ),
	'parent_item'       => __( 'Parent Category', 'hcode-addons' ),
	'parent_item_colon' => __( 'Parent Category:', 'hcode-addons' ),
	'edit_item'         => __( 'Edit Category', 'hcode-addons' ),
	'update_item'       => __( 'Update Category', 'hcode-addons' ),
	'add_new_item'      => __( 'Add New Category', 'hcode-addons' ),
	'new_item_name'     => __( 'New Category Name', 'hcode-addons' ),
	'menu_name'         => __( 'Categories','hcode-addons'),
);
$args = array( 'labels' => $labels, 'hierarchical' => true);

register_taxonomy( 'portfolio-category', 'portfolio', $args );

/**
 * Portflio Tag
 */

$args = array('hierarchical' => false, 'label' => 'Tags', 'query_var' => true, 'rewrite' => true);

register_taxonomy( 'portfolio-tags', 'portfolio', $args );
?>