<?php
if (!class_exists('Hcode_Require_Shortcode_Files')) {
    class Hcode_Require_Shortcode_Files {
        /*
         * Includes all (require_once) php file(s) inside selected folder using class.
         */
        public function __construct()
        {
            $this->Theme_Require_Shortcode_File( HCODE_SHORTCODE_ADDONS_SHORTCODE_URI, array('row', 'inner-row', 'column', 'tab', 'slider', 'content-slider', 'counter-or-skill','portfolio','parallax','video-sound','section-heading', 'alert-massage', 'icons', 'icon-list','feature-box', 'featured-owl', 'blockquote','blog','accordian','progressbar','button','shop-top-five', 'releted-product', 'featured-product','text-block','single-image', 'product-brands', 'team-member','team-slider', 'content-block', 'image', 'tab-content','image-gallery','popup','space','divider', 'testimonial', 'career', 'post-slider', 'separator', 'search-form', 'login-form', 'image-carousel', 'education-slider','popular-dishes','restaurant-menu','photography-grid','photography-services', 'spa-package-slider','restaurant-popular-dishes', 'newsletter', 'coming-soon', 'featured-projects-slider', 'travel-agency-special-offer-slider','time-counter'));
        }
        public function Theme_Require_Shortcode_File($path, $fileName)
        {

            if(is_array($fileName))
            {
                foreach($fileName as $name)
                {
                    require_once($path.'/hcode-shortcode-'.$name.'.php');
                }
            }
            else
            {
                throw new Exception('File is not found in folder as you given');
            }
        }

    }
    $Hcode_Require_Shortcode_Files = new Hcode_Require_Shortcode_Files();
}
?>