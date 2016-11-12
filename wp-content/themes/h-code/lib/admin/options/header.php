<?php
/**
 * Header Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'fa fa-header',
    'title' => esc_html__('Header', 'H-Code'),
    'desc' => esc_html__('Header section configuration settings', 'H-Code'),
    'fields' => array(
          array(
            'id'       => 'hcode_enable_header',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Header', 'H-Code'),
            'default'  => true,
            '1'       => 'On',
            '0'      => 'Off',
          ),
          array(
            'id'       => 'hcode_header_layout',
            'type'     => 'images',
            'title'    => esc_html__('Select a Header Style', 'H-Code'),
            'options' => array(
                "headertype1" => get_template_directory_uri()."/assets/images/header1.jpg",
                "headertype2" => get_template_directory_uri()."/assets/images/header2.jpg",
                "headertype3" => get_template_directory_uri()."/assets/images/header3.jpg",
                "headertype4" => get_template_directory_uri()."/assets/images/header4.jpg",
                "headertype5" => get_template_directory_uri()."/assets/images/header5.jpg",
                "headertype6" => get_template_directory_uri()."/assets/images/header6.jpg",
                "headertype7" => get_template_directory_uri()."/assets/images/header7.jpg",
                "headertype8" => get_template_directory_uri()."/assets/images/header6.jpg",
            ),
            'imgtitle' => array(
                "imgtitle1" => "Light Header",
                "imgtitle2" => "Dark Header",
                "imgtitle3" => "Dark Transparent Header",
                "imgtitle4" => "Light Transparent Header",
                "imgtitle5" => "Static Sticky Header",
                "imgtitle6" => "White Sticky Header",
                "imgtitle7" => "Gray Header",
                "imgtitle8" => "Non Sticky Header",
            ),
            'default' => 'headertype1',
            'validate'  => 'not_empty'
          ),
          array(
            'id'       => 'hcode_header_text_color',
            'type'     => 'select',
            'title'    => esc_html__('Header Text Color', 'H-Code'),
            'options' => array(
                'nav-black' => esc_html__('Black', 'H-Code'),
                'nav-white' => esc_html__('White', 'H-Code'),
            ),
            'default' => 'nav-black',
          ),
          array(
            'id' => 'hcode_logo_setting',
            'type' => 'info_title',
            'title' => esc_html__('Logo Settings', 'H-Code'),
          ),
          array(
            'id'       => 'hcode_header_logo',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Logo', 'H-Code' ),
            'subtitle' => esc_html__( 'Upload the logo that will be displayed in the header', 'H-Code' ),
          ),
          array(
            'id'       => 'hcode_header_light_logo',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Logo (Light)', 'H-Code' ),
            'subtitle' => esc_html__( 'Upload a light version of logo used in dark backgrounds header template', 'H-Code' ),
          ),
          array(
            'id'       => 'hcode_retina_logo',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Logo Retina', 'H-Code' ),
            'subtitle' => esc_html__( 'Optional retina version displayed in devices with retina display (high resolution display).', 'H-Code' ),
          ),
          array(
            'id'       => 'hcode_retina_logo_light',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Logo Retina (Light)', 'H-Code' ),
            'subtitle' => esc_html__( '(Upload a light version of logo) optional retina version displayed in devices with retina display (high resolution display).', 'H-Code' ),
          ),
          array(
              'id' => 'hcode_retina_logo_width',
              'type' => 'text',
              'title' => esc_html__('Retina logo Width', 'H-Code'),
              'default' => '109px',
              'subtitle' => esc_html__('Specify the width in pixel eg. 15px', 'H-Code'),
          ),
          array(
              'id' => 'hcode_retina_logo_height',
              'type' => 'text',
              'title' => esc_html__('Retina logo Height', 'H-Code'),
              'default' => '34px',
              'subtitle' => esc_html__('Specify the height in pixel eg. 15px', 'H-Code'),
          ),
          array(
            'id' => 'hcode_module_setting',
            'type' => 'info_title',
            'title' => esc_html__('Modules Settings', 'H-Code'),
          ),
          array(
            'id'       => 'hcode_header_search',
            'type'     => 'switch',
            'title'    => esc_html__('Search Modules', 'H-Code'),
            'default'  => false,
            'subtitle' => esc_html__('If on, a search module will be displayed in header section', 'H-Code'),
            '1'       => 'On',
            '0'      => 'Off',
          ), 
          array(
              'id'       => 'hcode_header_cart',
              'type'     => 'switch',
              'title'    => esc_html__('Cart Module', 'H-Code'),
              'default'  => false,
              'subtitle' => esc_html__('If on, a cart module will be displayed in header section. It will only work if WooCommerce plugin is installed and active.', 'H-Code'),
              '1'       => 'On',
              '0'      => 'Off',
          ),
          array(
            'id'       => 'hcode_header_mini_cart',
            'type'     => 'select',
            'title'    => esc_html__('Header Mini cart', 'H-Code'),
            'data'     => 'sidebars',
            'default' => 'hcode-mini-cart',
            'required'  => array('hcode_header_cart', 'equals', '1'),
          ),
    )
);
?>