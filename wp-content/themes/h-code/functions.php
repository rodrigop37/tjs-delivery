<?php
/**
 * This file use for define custom function
 * Also include required files.
 *
 * @package H-Code
 *
 */

/*
 *	H-Code Theme namespace
 */

define('HCODE_THEME', 'H-Code');
define('HCODE_THEME_SLUG', 'hcode');
define('HCODE_THEME_VERSION', '1.6.1');

/*
 *	H-Code Theme Folders
 */

define('HCODE_THEME_DIR',         				get_template_directory());
define('HCODE_THEME_LANGUAGES',   				HCODE_THEME_DIR . '/languages');
define('HCODE_THEME_ASSETS',      				HCODE_THEME_DIR . '/assets');
define('HCODE_THEME_JS',         				HCODE_THEME_ASSETS . '/js');
define('HCODE_THEME_CSS',        				HCODE_THEME_ASSETS . '/css');
define('HCODE_THEME_IMAGES',      				HCODE_THEME_ASSETS . '/images');
define('HCODE_THEME_LIB',         				HCODE_THEME_DIR . '/lib');
define('HCODE_THEME_INC',         				HCODE_THEME_DIR . '/inc');
define('HCODE_THEME_ADMIN',       				HCODE_THEME_LIB . '/admin');
define('HCODE_THEME_IMPORTER',       			HCODE_THEME_LIB . '/importer');
define('HCODE_THEME_IMPORTER_SAMPLEDATA',       HCODE_THEME_IMPORTER . '/sample-data');
define('HCODE_THEME_MEGA_MENU',   				HCODE_THEME_LIB . '/mega-menu');
define('HCODE_THEME_MEGA_MENU_JS',				HCODE_THEME_MEGA_MENU . '/js'); 
define('HCODE_THEME_MEGA_MENU_CSS', 			HCODE_THEME_MEGA_MENU . '/css');
define('HCODE_THEME_METABOX',					HCODE_THEME_LIB. '/meta-box');
define('HCODE_THEME_METABOX_JS',				HCODE_THEME_METABOX. '/js');
define('HCODE_THEME_METABOX_CSS',				HCODE_THEME_METABOX. '/css');


/*
 *  H-Code Theme Folder URI
 */
define('HCODE_THEME_URI',             				get_template_directory_uri());
define('HCODE_THEME_LANGUAGES_URI',   				HCODE_THEME_URI . '/languages');
define('HCODE_THEME_ASSETS_URI',      				HCODE_THEME_URI     . '/assets');
define('HCODE_THEME_JS_URI',          				HCODE_THEME_ASSETS_URI . '/js');
define('HCODE_THEME_CSS_URI',         				HCODE_THEME_ASSETS_URI . '/css');
define('HCODE_THEME_IMAGES_URI',      				HCODE_THEME_ASSETS_URI . '/images');
define('HCODE_THEME_LIB_URI',         				HCODE_THEME_URI . '/lib');
define('HCODE_THEME_INC_URI',         				HCODE_THEME_URI . '/inc');
define('HCODE_THEME_IMPORTER_URI',       			HCODE_THEME_LIB_URI . '/importer');
define('HCODE_THEME_IMPORTER_SAMPLEDATA_URI',       HCODE_THEME_IMPORTER_URI . '/sample-data');
define('HCODE_THEME_MEGA_MENU_URI',   				HCODE_THEME_LIB_URI . '/mega-menu');
define('HCODE_THEME_MEGA_MENU_JS_URI',				HCODE_THEME_MEGA_MENU_URI . '/js'); 
define('HCODE_THEME_MEGA_MENU_CSS_URI', 			HCODE_THEME_MEGA_MENU_URI . '/css');
define('HCODE_THEME_METABOX_URI',					HCODE_THEME_LIB_URI. '/meta-box');
define('HCODE_THEME_METABOX_JS_URI',				HCODE_THEME_METABOX_URI. '/js');
define('HCODE_THEME_METABOX_CSS_URI',				HCODE_THEME_METABOX_URI. '/css');

/*
 *   Text Domain
 */

load_theme_textdomain( 'H-Code', get_template_directory() . '/languages' );

if ( ! function_exists( 'hcode_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hcode_theme_setup() {

	/*
	 *   Content Width (Set the content width based on the theme's design and stylesheet.)
	 */

	if ( !isset( $content_width ) ) $content_width = 1170;

	/*
	 * To add default posts and comments RSS feed links to theme head.
	 */

	add_theme_support( 'automatic-feed-links' );
    
    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/* This theme styles the visual editor with editor-style.css to match the theme style. */
	add_editor_style();
        
	/**
	 * Custom image sizes for posts, pages, port, portfolio, gallery, slider.
	 */
	add_theme_support( 'post-thumbnails');
	set_post_thumbnail_size( 825, 510, true );
	add_image_size( 'hcode-navigation-img', 133, 83, true );
	add_image_size( 'hcode-related-post', 374, 234, true );

	// Register menu for hcode theme.
	register_nav_menus( array(
		'hcodemegamenu' => esc_html__( 'H-Code Mega Menu', 'H-Code' ),
		'hcodefootermenu'  => esc_html__( 'Footer Menu', 'H-Code' ),
	) );


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	 
	add_theme_support( 'post-formats', array(
		'image', 'video', 'gallery', 'quote', 'link',
	) );
	
	/*
	 * woocommerce support
	 */
	add_theme_support( 'woocommerce' );
}
endif;
add_action( 'after_setup_theme', 'hcode_theme_setup' );

/**
 * Register H-code theme required widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 *
 */
if ( ! function_exists( 'hcode_widgets_init' ) ) :
	function hcode_widgets_init() 
	{
		register_sidebar( array(
			'name'          => esc_html__( 'Main Sidebar', 'H-Code' ),
			'id'            => 'hcode-sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
			'before_widget' => '<!-- sidebar --><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div><!-- end sidebar -->',
			'before_title'  => '<!-- headline --><h5 class="widget-title">',
			'after_title'   => '</h5><div class="thin-separator-line bg-dark-gray no-margin-lr"></div><!-- end headline -->',
		) );

		if( class_exists( 'WooCommerce' ) ){
			register_sidebar( array(
				'name'          => esc_html__( 'Shop Sidebar', 'H-Code' ),
				'id'            => 'hcode-shop-1',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
				'before_widget' => '<!-- sidebar --><div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div><!-- end sidebar -->',
				'before_title'  => '<!-- headline --><h5 class="widget-title font-alt">',
				'after_title'   => '</h5><div class="thin-separator-line bg-dark-gray no-margin-lr margin-ten"></div><!-- end headline -->',
			) );
			register_sidebar( array(
				'name'          => esc_html__( 'Mini Cart', 'H-Code' ),
				'id'            => 'hcode-mini-cart',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
				'before_widget' => '<!-- sidebar --><div id="%1$s" class="widget %2$s no-margin">',
				'after_widget'  => '</div><!-- end sidebar -->',
				'before_title'  => '<!-- heading --><h5 class="widget-title font-alt">',
				'after_title'   => '</h5><!-- end heading -->',
			) );
		}
		register_sidebar( array(
			'name'          => esc_html__( 'Page Left Sidebar', 'H-Code' ),
			'id'            => 'hcode-page-left-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
			'before_widget' => '<!-- sidebar --><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div><!-- end sidebar -->',
			'before_title'  => '<!-- heading --><h5 class="widget-title font-alt">',
			'after_title'   => '</h5><div class="thin-separator-line bg-dark-gray no-margin-lr"></div><!-- end heading -->',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Page Right Sidebar', 'H-Code' ),
			'id'            => 'hcode-page-right-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
			'before_widget' => '<!-- sidebar --><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div><!-- end sidebar -->',
			'before_title'  => '<!-- heading --><h5 class="widget-title font-alt">',
			'after_title'   => '</h5><div class="thin-separator-line bg-dark-gray no-margin-lr"></div><!-- end heading -->',
		) );
	        register_sidebar( array(
			'name'          => esc_html__( 'Post Left Sidebar', 'H-Code' ),
			'id'            => 'hcode-post-left-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
			'before_widget' => '<!-- sidebar --><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div><!-- end sidebar -->',
			'before_title'  => '<!-- heading --><h5 class="widget-title font-alt">',
			'after_title'   => '</h5><div class="thin-separator-line bg-dark-gray no-margin-lr"></div><!-- end heading -->',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Post Right Sidebar', 'H-Code' ),
			'id'            => 'hcode-post-right-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
			'before_widget' => '<!-- sidebar --><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div><!-- end sidebar -->',
			'before_title'  => '<!-- heading --><h5 class="widget-title font-alt">',
			'after_title'   => '</h5><div class="thin-separator-line bg-dark-gray no-margin-lr"></div><!-- end heading -->',
		) );

		/*
		 * Register h-code theme Banner widgets. 
		 */
		if( class_exists( 'WooCommerce' ) ){
			
				register_sidebar( array(
					'name'          => esc_html__( 'Shop Banner Widget 1', 'H-Code' ),
					'id'            => 'hcode-banner-1',
					'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
					'before_widget' => '<!-- sidebar --><div id="%1$s" class="%2$s">',
					'after_widget'  => '</div><!-- end sidebar -->',
					'before_title'  => '<!-- headline --><h5 class="sidebar-title">',
					'after_title'   => '</h5><!-- end headline -->',
				) );

				register_sidebar( array(
					'name'          => esc_html__( 'Shop Banner Widget 2', 'H-Code' ),
					'id'            => 'hcode-banner-2',
					'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
					'before_widget' => '<!-- sidebar --><div id="%1$s" class="%2$s">',
					'after_widget'  => '</div><!-- end sidebar -->',
					'before_title'  => '<!-- headline --><h5 class="sidebar-title">',
					'after_title'   => '</h5><!-- end headline -->',
				) );

				register_sidebar( array(
					'name'          => esc_html__( 'Shop Banner Widget 3', 'H-Code' ),
					'id'            => 'hcode-banner-3',
					'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
					'before_widget' => '<!-- sidebar --><div id="%1$s" class="%2$s">',
					'after_widget'  => '</div><!-- end sidebar -->',
					'before_title'  => '<!-- headline --><h5 class="sidebar-title">',
					'after_title'   => '</h5><!-- end headline -->',
				) );

				register_sidebar( array(
					'name'          => esc_html__( 'Shop Banner Widget 4', 'H-Code' ),
					'id'            => 'hcode-banner-4',
					'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
					'before_widget' => '<!-- sidebar --><div id="%1$s" class="%2$s">',
					'after_widget'  => '</div><!-- end sidebar -->',
					'before_title'  => '<!-- headline --><h5 class="sidebar-title">',
					'after_title'   => '</h5><!-- end headline -->',
				) );
			
		}
		/*
		 * Register h-code theme footer widgets. 
		 */
		
			register_sidebar( array(
				'name'          => esc_html__( 'Footer Sidebar 1', 'H-Code' ),
				'id'            => 'hcode-footer-1',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
				'before_widget' => '<!-- sidebar --><div id="%1$s" class="%2$s">',
				'after_widget'  => '</div><!-- end sidebar -->',
				'before_title'  => '<!-- headline --><h5 class="sidebar-title">',
				'after_title'   => '</h5><!-- end headline -->',
			) );

			register_sidebar( array(
				'name'          => esc_html__( 'Footer Sidebar 2', 'H-Code' ),
				'id'            => 'hcode-footer-2',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
				'before_widget' => '<!-- sidebar --><div id="%1$s" class="%2$s">',
				'after_widget'  => '</div><!-- end sidebar -->',
				'before_title'  => '<!-- headline --><h5 class="sidebar-title">',
				'after_title'   => '</h5><!-- end headline -->',
			) );

			register_sidebar( array(
				'name'          => esc_html__( 'Footer Sidebar 3', 'H-Code' ),
				'id'            => 'hcode-footer-3',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
				'before_widget' => '<!-- sidebar --><div id="%1$s" class="%2$s">',
				'after_widget'  => '</div><!-- end sidebar -->',
				'before_title'  => '<!-- headline --><h5 class="sidebar-title">',
				'after_title'   => '</h5><!-- end headline -->',
			) );

			register_sidebar( array(
				'name'          => esc_html__( 'Footer Sidebar 4', 'H-Code' ),
				'id'            => 'hcode-footer-4',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
				'before_widget' => '<!-- sidebar --><div id="%1$s" class="%2$s">',
				'after_widget'  => '</div><!-- end sidebar -->',
				'before_title'  => '<!-- headline --><h5 class="sidebar-title">',
				'after_title'   => '</h5><!-- end headline -->',
			) );

			register_sidebar( array(
				'name'          => esc_html__( 'Footer Sidebar 5', 'H-Code' ),
				'id'            => 'hcode-footer-5',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'H-Code' ),
				'before_widget' => '<!-- sidebar --><div id="%1$s" class="%2$s">',
				'after_widget'  => '</div><!-- end sidebar -->',
				'before_title'  => '<!-- headline --><h5 class="sidebar-title">',
				'after_title'   => '</h5><!-- end headline -->',
			) );
		

	}
endif;
add_action( 'widgets_init', 'hcode_widgets_init' );

if (file_exists( HCODE_THEME_LIB . '/hcode-require-files.php' )) 
{
	require_once( HCODE_THEME_LIB . '/hcode-require-files.php');
}

// Shortcode in widget
add_filter('widget_text', 'do_shortcode');

if ( class_exists( 'WooCommerce' ) ){

	/* For Woocommerce Color Attributele */
	$hcode_color_attributele = hcode_option( 'hcode_color_attributele' );
	if( $hcode_color_attributele && ( hcode_option( 'hcode_enable_color_attribute' ) == 1) ):
	    add_action( 'pa_'.$hcode_color_attributele.'_add_form_fields', 'hcode_add_color_field', 10, 2 );
	    add_action( 'pa_'.$hcode_color_attributele.'_edit_form_fields', 'hcode_edit_color_field', 10, 2 );
	    add_action( 'edited_pa_'.$hcode_color_attributele, 'hcode_save_taxonomy_custom_field_color', 10, 2 );  
	    add_action( 'create_pa_'.$hcode_color_attributele, 'hcode_save_taxonomy_custom_field_color', 10, 2 );
	endif;
}
if ( ! function_exists( 'hcode_post_format_parameter' ) ) :
	function hcode_post_format_parameter( $url ) {
		$url = remove_query_arg( 'post_format', $url );
	    return $url;
	}
	add_filter( 'preview_post_link', 'hcode_post_format_parameter' );
endif;
?>