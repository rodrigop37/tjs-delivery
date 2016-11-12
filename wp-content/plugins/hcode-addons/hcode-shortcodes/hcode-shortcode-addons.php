<?php
/**
 * The main template file For H-Code Theme Addons.
 *
 * @package H-Code
 */
?>
<?php
/**
 * Defind Class 
 */

defined('HCODE_SHORTCODE_ADDONS_URI') or define('HCODE_SHORTCODE_ADDONS_URI', HCODE_ADDONS_ROOT.'/hcode-shortcodes');
defined('HCODE_SHORTCODE_ADDONS_EXTEND_COMPOSER') or define('HCODE_SHORTCODE_ADDONS_EXTEND_COMPOSER', HCODE_SHORTCODE_ADDONS_URI.'/extend-composer');
defined('HCODE_SHORTCODE_ADDONS_SHORTCODE_URI') or define('HCODE_SHORTCODE_ADDONS_SHORTCODE_URI', HCODE_SHORTCODE_ADDONS_URI.'/shortcode');
defined('HCODE_SHORTCODE_ADDONS_PREVIEW_IMAGE') or define('HCODE_SHORTCODE_ADDONS_PREVIEW_IMAGE', HCODE_ADDONS_ROOT_DIR.'/hcode-shortcodes/images/preview-images');

if(!class_exists('Hcode_Shortcodes_Addons'))
{
  class Hcode_Shortcodes_Addons
  {

    // Construct
    public function __construct()
    {
      // Load Required Style For Addons.
      add_action('init', array($this, 'init'));
    }
    public function init(){

      require_once( HCODE_ADDONS_ROOT.'/hcode-shortcodes/hcode-shortcode-addons-share.php' );
      require_once( HCODE_ADDONS_ROOT.'/hcode-shortcodes/hcode-shortcode-addons-post-like.php' );

      add_action( 'admin_enqueue_scripts', array($this,'load_custom_wp_admin_style') );
      add_action( 'admin_print_scripts-post.php',   array($this, 'load_custom_wp_admin_style'), 99);
      add_action( 'admin_print_scripts-post-new.php', array($this, 'load_custom_wp_admin_style'), 99);
      if(class_exists('Vc_Manager')){
        // Action For Remove VC Elements.
        add_action('admin_init', array($this, 'vc_remove_elements'), 10);
        // Action For Add H-Code Maps And Shortcode In VC.
        add_action('init', array($this,'hcode_addons_init'),40);
      }
    }

    public function load_custom_wp_admin_style() {
      // Enqueue Custom JS For WP Admin.
      wp_enqueue_script( 'hcode-custom-script',   HCODE_ADDONS_ROOT_DIR . '/hcode-shortcodes/js/custom.js' , array('jquery'), '1.0.0', true );
    }
    
    public function hcode_addons_init() {
        // Load Shortcode For H-Code Theme.
        $this->hcode_addons_vc_load_shortcodes();
        // Init VC For Post Type In H-Code Theme.
        $this->hcode_addons_init_vc();
        // Load Custom Maps.php For VC.
        $this->hcode_addons_vc_integration();
        $s_elemets = array( 'tta_tabs', 'toggle', 'tta_tour', 'tta_accordion', 'tta_pageable', 'raw_html', 'round_chart', 'line_chart', 'icon', 'masonry_media_grid', 'masonry_grid', 'basic_grid', 'media_grid', 'custom_heading', 'empty_space', 'clients', 'widget_sidebar', 'images_carousel', 'carousel', 'tour', 'gallery', 'posts_slider', 'posts_grid', 'teaser_grid', 'separator', 'text_separator', 'message', 'facebook', 'tweetmeme', 'googleplus', 'pinterest', 'single_image', 'btn', 'toogle', 'button2', 'cta_button', 'cta_button2', 'video', 'gmaps', 'flickr', 'progress_bar', 'raw_js', 'pie', 'wp_meta', 'wp_recentcomments', 'wp_text', 'wp_calendar', 'wp_pages', 'wp_custommenu', 'wp_posts', 'wp_links', 'wp_categories', 'wp_archives', 'wp_rss', 'cta', 'wp_search', 'wp_tagcloud', 'button', 'accordion' );
        vc_remove_element('client', 'testimonial');
        // Remove VC elements.
        $this->vc_remove_elements( $s_elemets );
    }


    public function vc_remove_elements( $e = array() ) {
      if ( !empty( $e ) ) {
        foreach ( $e as $key => $r_this ) {
          vc_remove_element( 'vc_'.$r_this );
        }
      }
    }
    

    public function hcode_addons_init_vc()
    {
      global $vc_manager;
      $vc_manager->setIsAsTheme();
      $vc_manager->disableUpdater();
      $list = array( 'page', 'post', 'portfolio');
      $vc_manager->setEditorDefaultPostTypes( $list );
      $vc_manager->setEditorPostTypes( $list ); //this is required after VC update (probably from vc 4.5 version)
      $vc_manager->automapper()->setDisabled();
    }

    public function hcode_addons_vc_load_shortcodes()
    {
      require_once( HCODE_SHORTCODE_ADDONS_URI . '/shortcodes.php' );
    }

    public function hcode_addons_vc_integration()
    {
      require_once( HCODE_SHORTCODE_ADDONS_URI . '/maps.php' );
      
    }

  
} // end of class
$Hcode_Shortcodes_Addons = new Hcode_Shortcodes_Addons();
} // end of class_exists
?>