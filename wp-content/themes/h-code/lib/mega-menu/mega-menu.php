<?php
/**
 * H-Code Mega Menu Class.
 *
 * @package H-Code
 */
?>
<?php
/**
 * Defind Mega Menu Class 
 */
if(!class_exists('Hcode_Mega_Menu'))
{
  /**
   * Main Hcode_Mega_Menu class
   */
  class Hcode_Mega_Menu
  {


  /**
   * Construct
   */
    public function __construct()
    {
    	add_action('init', array($this,'hcode_mega_menu_init'),40);
    	add_action( 'admin_enqueue_scripts', array($this,'hcode_mega_menu_admin_scripts') );
      add_action( 'admin_enqueue_scripts', array($this,'load_custom_wp_admin_style') );
      add_action( 'admin_print_scripts-post.php',   array($this, 'load_custom_wp_admin_style'), 99);
      add_action( 'admin_print_scripts-post-new.php', array($this, 'load_custom_wp_admin_style'), 99);
    }
    public function load_custom_wp_admin_style() {
      // Register Style For WP Admin.
      wp_register_style( 'custom_wp_admin_css', HCODE_THEME_MEGA_MENU_CSS_URI . '/custom-admin-style.css', false, '1.0.0' );
      // Enqueue Style For WP Admin.
      wp_enqueue_style( 'custom_wp_admin_css' );
    }

    public function hcode_mega_menu_init()
    {
      require_once( HCODE_THEME_MEGA_MENU . '/mega-menu-addon.php' );
    }

    public function hcode_mega_menu_admin_scripts(){
    	wp_register_script( 'hcode-select2-jquery', HCODE_THEME_JS_URI . '/select2.full.min.js',array('jquery'),HCODE_THEME_VERSION,true);
      wp_register_script( 'hcode-custom-megamenu-jquery', HCODE_THEME_MEGA_MENU_JS_URI . '/megamenu.js',array('jquery'),HCODE_THEME_VERSION,true);
      wp_register_style( 'hcode-select2-css', HCODE_THEME_CSS_URI . '/select2.min.css', false, HCODE_THEME_VERSION );
      wp_register_style( 'hcode-mega-menu-style', HCODE_THEME_MEGA_MENU_CSS_URI . '/megamenu.css',null, HCODE_THEME_VERSION);
      wp_register_style( 'hcode-font-awesome-style', HCODE_THEME_CSS_URI . '/font-awesome.min.css',null, HCODE_THEME_VERSION);

      wp_enqueue_script( 'hcode-select2-jquery' );
      wp_enqueue_script( 'hcode-custom-megamenu-jquery' );
      wp_enqueue_style( 'hcode-select2-css' );
      wp_enqueue_style( 'hcode-font-awesome-style' );
      wp_enqueue_style( 'hcode-mega-menu-style' );

      // Added in v1.5
      wp_register_style( 'hcode-admin-et-line-icons-style', HCODE_THEME_CSS_URI . '/et-line-icons.css',null, HCODE_THEME_VERSION);
  
      wp_enqueue_style( 'hcode-admin-et-line-icons-style' );
    }  
} // end of class

$Hcode_Mega_Menu = new Hcode_Mega_Menu();
} // end of class_exists
?>