<?php
/**
 * Theme Require Files Class.
 *
 * @package H-Code
 */
?>
<?php
if( !class_exists('Hcode_Require_Files_Class') ){
  class Hcode_Require_Files_Class {
      /*
       * Includes all (require_once) php file(s) inside selected folder using class.
       */
      public function __construct()
      {
          
      }
      public static function Hcode_Theme_Require_Files($path, $fileName)
      {

          if(is_array($fileName))
          {
              foreach($fileName as $name)
              {
                  require_once($path.'/'.$name.'.php');
              }
          }
          else
          {
              throw new Exception('File is not found in folder as you given');
          }
      }

  }
}
 
$Hcode_Require_Files_Class = new Hcode_Require_Files_Class();


/*
 *  Includes all required files for hcode Theme.
 */
Hcode_Require_Files_Class::Hcode_Theme_Require_Files( HCODE_THEME_LIB,
    array(
          'hcode-scripts',
          'hcode-extra-functions',
          'hcode-woocommerce-functions',
          'hcode-excerpt',
          'tgm/tgm-init',
          'importer/importer',
          'mega-menu/mega-menu',
          'admin/admin_option',
          'meta-box/meta-box',
          'hcode-breadcrumb',
    ));

Hcode_Require_Files_Class::Hcode_Theme_Require_Files( HCODE_THEME_INC,
    array(
          'hcode-recent-post-widget',
          'hcode-custom-menu-widget',
    ));