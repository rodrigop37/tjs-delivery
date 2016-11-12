<?php
/**
 * WooCommerce Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'fa fa-shopping-cart',
    'title' => esc_html__('WooCommerce', 'H-Code'),
    'fields' => array(
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Product Page', 'H-Code'),
            'subtitle'  => esc_html__('Set product page layout with breadcrumb and navigation options', 'H-Code'),
            'position'  => 'start',
        ),
        array(
            'id'       => 'product_sidebar_position',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Page Layout', 'H-Code' ),
            'options'  => array(
                '1' => array(
                    'alt' => 'One Column',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png',
                    'val' => '1'
                ),
                '2' => array(
                    'alt' => 'Two Columns Left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png',
                    'val' => '2'
                ),
                '3' => array(
                    'alt' => 'Two Columns Right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png',
                    'val' => '3'
                ),
                '4' => array(
                    'alt' => 'Three Columns',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png',
                    'val' => '4'
                ),
            ),
            'default'  => '1'
        ),
        array(
            'id'        => 'hcode_product_left_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Left Sidebar', 'H-Code'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in left column of page', 'H-Code'),
            'required'  => array('product_sidebar_position', 'equals', array('2', '4') ),
        ),
        array(
            'id'        => 'hcode_product_right_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Right Sidebar', 'H-Code'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle' => esc_html__('Select sidebar to display in right column of page', 'H-Code'),
            'required'  => array('product_sidebar_position', 'equals', array('3', '4') ),
        ),
        array(
            'id'       => 'enable_product_breadcrumb',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Breadcrumb', 'H-Code'),
            'default'  => true,
            'subtitle' => esc_html__('If on, breadcrumb will display on product page', 'H-Code'),
        ),
        array(
            'id'       => 'enable_product_next_prev_button',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Next/Previous Product Button', 'H-Code'),
            'default'  => true,
        ),
        array(
            'id'       => 'enable_product_stock_status',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Product Stock Status Message', 'H-Code'),
            'default'  => true,
        ),
        array(
            'id'       => 'enable_product_shipping',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Product Shipping Available Message', 'H-Code'),
            'default'  => true,
        ),
        array(
            'id' => 'hcode_shipping_available_text',
            'type' => 'text',
            'title' => esc_html__('Shipping Available Text', 'H-Code'),
            'required'  => array( 'enable_product_shipping','equals',array('1') ),
            'default'   => 'Shipping Available',
        ),
        array(
            'id'       => 'enable_readmore_woocommenrce',
            'type'     => 'switch',
            'title'    => esc_html__('Read More In Short Description', 'H-Code'),
            'default'  => false,
        ),
        array(
            'id' => 'hcode_readmore_button_text',
            'type' => 'text',
            'title' => esc_html__('Read More Button Text', 'H-Code'),
            'required'  => array( 'enable_readmore_woocommenrce','equals',array('1') ),
            'default'   => 'Read More',
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Shop / Category / Brand / Product Listing Page', 'H-Code'),
            'subtitle'  => esc_html__('Set product listing type, page layout and configurations', 'H-Code'),
            'position'  => 'start',
        ),
        array(
            'id'=>'hcode_woocommerce_category_view_type',
            'type' => 'select',
            'title' => esc_html__('Listing Type', 'H-Code'),
            'subtitle' => esc_html__('Select default listing type', 'H-Code'),
            'options' => array(
                '1' => esc_html__('Grid View', 'H-Code'),
                '2' => esc_html__('List View', 'H-Code'),
            ),
            'default' => '1',
        ),
        array(
            'id'       => 'product_category_sidebar_position',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Page Layout', 'H-Code' ),
            'options'  => array(
                '1' => array(
                    'alt' => 'One Column',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png',
                    'val' => '1'
                ),
                '2' => array(
                    'alt' => 'Two Columns Left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png',
                    'val' => '2'
                ),
                '3' => array(
                    'alt' => 'Two Columns Right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png',
                    'val' => '3'
                ),
                '4' => array(
                    'alt' => 'Three Columns',
                    'img' => ReduxFramework::$_url . 'assets/img/3cm.png',
                    'val' => '4'
                ),
            ),
            'default'  => '2'
        ),
        array(
            'id'        => 'hcode_product_category_left_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Left Sidebar', 'H-Code'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle'  => esc_html__('Select sidebar to display in left column of page', 'H-Code'),
            'required'  => array('product_category_sidebar_position', 'equals', array('2', '4') ),
        ),
        array(
            'id'        => 'hcode_product_category_right_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Right Sidebar', 'H-Code'),
            'data'      => 'sidebar',
            'default'   => '',
            'subtitle'  => esc_html__('Select sidebar to display in right column of page', 'H-Code'),
            'required'  => array('product_category_sidebar_position', 'equals', array('3', '4') ),
        ),
        array(
            'id'       => 'enable_category_breadcrumb',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Breadcrumb', 'H-Code'),
            'default'  => true,
        ),
        array(
            'id'=>'hcode_category_product_row_column',
            'type' => 'select',
            'title' => esc_html__('No. of columns per row', 'H-Code'),
            'options' => array(
                '1' => esc_html__('1', 'H-Code'),
                '2' => esc_html__('2', 'H-Code'),
                '3' => esc_html__('3', 'H-Code'),
                '4' => esc_html__('4', 'H-Code'),
                '6' => esc_html__('6', 'H-Code'),
            ),
            'default' => '2',
            'required'  => array( 'hcode_woocommerce_category_view_type','equals',array('1') ),
        ),
        array(
          'id' => 'hcode_category_product_per_page',
          'type' => 'text',
          'title' => esc_html__('No. of items per page', 'H-Code'),
          'default' => '10',
          'required'  => array( 'hcode_woocommerce_category_view_type','equals',array('1','2') ),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Related Products', 'H-Code'),
            'subtitle'  => esc_html__('Set related products display style and settings', 'H-Code'),
            'position'  => 'start',
        ),
        array(
            'id'=>'hcode_layout_woocommerce_settings',
            'type' => 'select',
            'title' => esc_html__('Related Product Display Style', 'H-Code'),
            'options' => array(
                'slider' => esc_html__('Slider', 'H-Code'),
                'grid' => esc_html__('Grid', 'H-Code'),
                'remove' => esc_html__('Remove Related product Block', 'H-Code'),
            ),
            'default' => 'slider',
        ),
         array(
          'id' => 'related_product_grid_per_row',
          'title' => esc_html__('No. of items per row', 'H-Code'),
          'type' => 'select',
          'options' => array(
                '1' => esc_html__('1', 'H-Code'),
                '2' => esc_html__('2', 'H-Code'),
                '3' => esc_html__('3', 'H-Code'),
                '4' => esc_html__('4', 'H-Code'),
                '6' => esc_html__('6', 'H-Code'),
          ),
          'default' => '3',
          'required'  => array( 'hcode_layout_woocommerce_settings','equals',array('grid') ),
        ),
        array(
          'id' => 'related_product_desktop_per_page',
          'title' => esc_html__('No. of items per slide ( Desktop View )', 'H-Code'),
          'type' => 'select',
          'options' => array(
                '1' => esc_html__('1', 'H-Code'),
                '2' => esc_html__('2', 'H-Code'),
                '3' => esc_html__('3', 'H-Code'),
                '4' => esc_html__('4', 'H-Code'),
                '6' => esc_html__('6', 'H-Code'),
          ),
          'default' => '3',
          'required'  => array( 'hcode_layout_woocommerce_settings','equals',array('slider') ),
        ),
        array(
          'id' => 'related_product_ipad_per_page',
          'type' => 'select',
          'title' => esc_html__('No. of items per slide ( iPad/Tablet View )', 'H-Code'),
          'options' => array(
                '1' => esc_html__('1', 'H-Code'),
                '2' => esc_html__('2', 'H-Code'),
                '3' => esc_html__('3', 'H-Code'),
          ),
          'default' => '3',
          'required'  => array( array('hcode_layout_woocommerce_settings','equals','slider')),
        ),
        array(
          'id' => 'related_product_mobile_per_page',
          'type' => 'select',
          'title' => esc_html__('No. of items per slide ( Mobile View )', 'H-Code'),
          'options' => array(
                '1' => esc_html__('1', 'H-Code'),
                '2' => esc_html__('2', 'H-Code'),
          ),
          'default' => '1',
          'required'  => array( array('hcode_layout_woocommerce_settings','equals','slider')),
        ),
        array(
          'id' => 'related_product_show_no',
          'type' => 'text',
          'title' => esc_html__('Display number of maximum products in slider / Grid', 'H-Code'),
          'default' => '10',
          'required'  => array('hcode_layout_woocommerce_settings', '!=', 'remove'),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Product Attributes', 'H-Code'),
            'subtitle'  => esc_html__('Set color/size attribute and enable/disable it', 'H-Code'),
            'position'  => 'start',
        ),
        array(
            'id'       => 'hcode_enable_color_attribute',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Color Attribute', 'H-Code'),
            'default'  => false,
        ),
        array(
            'id'=>'hcode_color_attributele',
            'type' => 'select',
            'data' => 'special_attribute',
            'title' => esc_html__('Select Color Attribute', 'H-Code'),
            'required'  => array('hcode_enable_color_attribute', 'equals', '1'),
        ),
        array(
            'id'       => 'hcode_enable_size_attribute',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Size Attribute', 'H-Code'),
            'default'  => false,
        ),
        array(
            'id'=>'hcode_size_attributele',
            'type' => 'select',
            'data' => 'special_attribute',
            'title' => esc_html__('Select Size Attribute', 'H-Code'),
            'required'  => array('hcode_enable_size_attribute', 'equals', '1'),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),

        /* woocommerce category header */
        
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Header Settings', 'H-Code'),
            'subtitle'  => esc_html__('Header settings only for Single Product, Product Category, Product Tag, Product Brand Pages', 'H-Code'),
            'position'  => 'start',
        ),
        array(
            'id'       => 'hcode_enable_header_woocommerce',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Header', 'H-Code'),
            'default'  => true,
          ),
          array(
            'id'       => 'hcode_header_layout_woocommerce',
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
            'default' => 'headertype6',
            'validate'  => 'not_empty'
          ),
          array(
            'id'       => 'hcode_header_text_color_woocommerce',
            'type'     => 'select',
            'title'    => esc_html__('Header Text Color', 'H-Code'),
            'options' => array(
                'nav-black' => esc_html__('Black', 'H-Code'),
                'nav-white' => esc_html__('White', 'H-Code'),
            ),
            'default' => 'nav-black',
          ),
          array(
            'id'       => 'hcode_header_menu_woocommerce',
            'type'     => 'select',
            'title'    => esc_html__('Header menu', 'H-Code'),
            'data'    => 'menus',
          ),
          array(
            'id' => 'hcode_logo_setting_woocommerce',
            'type' => 'info_title',
            'title' => esc_html__('Logo Settings', 'H-Code'),
        ),
          array(
            'id'       => 'hcode_header_logo_woocommerce',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Logo', 'H-Code' ),
            'subtitle' => esc_html__( 'Upload the logo that will be displayed in the header', 'H-Code' ),
          ),
          array(
            'id'       => 'hcode_header_light_logo_woocommerce',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Logo (Light)', 'H-Code' ),
            'subtitle' => esc_html__( 'Upload a light version of logo used in dark backgrounds header template', 'H-Code' ),
          ),
          array(
            'id'       => 'hcode_retina_logo_woocommerce',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Logo Retina', 'H-Code' ),
            'subtitle' => esc_html__( 'Optional retina version displayed in devices with retina display (high resolution display).', 'H-Code' ),
          ),
          array(
            'id'       => 'hcode_retina_logo_light_woocommerce',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Logo Retina (Light)', 'H-Code' ),
            'subtitle' => esc_html__( '(Upload a light version of logo) optional retina version displayed in devices with retina display (high resolution display).', 'H-Code' ),
          ),
          array(
              'id' => 'hcode_retina_logo_width_woocommerce',
              'type' => 'text',
              'title' => esc_html__('Retina logo Width', 'H-Code'),
              'default' => '109px',
              'subtitle' => esc_html__('Specify the width in pixel eg. 15px', 'H-Code'),
            ),
          array(
              'id' => 'hcode_retina_logo_height_woocommerce',
              'type' => 'text',
              'title' => esc_html__('Retina logo Height', 'H-Code'),
              'default' => '34px',
              'subtitle' => esc_html__('Specify the height in pixel eg. 15px', 'H-Code'),
            ),
          array(
            'id'       => 'hcode_header_search_woocommerce',
            'type'     => 'switch',
            'title'    => esc_html__('Search', 'H-Code'),
            'default'  => true,
            'subtitle' => esc_html__('If on, a search module will be displayed in header section', 'H-Code'),
        ), 
        array(
            'id'       => 'hcode_header_cart_woocommerce',
            'type'     => 'switch',
            'title'    => esc_html__('Cart', 'H-Code'),
            'default'  => true,
            'subtitle' => esc_html__('If on, a cart module will be displayed in header section. It will only work if WooCommerce plugin is installed and active.', 'H-Code'),
        ),
        array(
            'id'       => 'hcode_header_mini_cart_woocommerce',
            'type'     => 'select',
            'title'    => esc_html__('Header Mini cart', 'H-Code'),
            'data'     => 'sidebars',
            'default' => 'hcode-mini-cart',
            'required'  => array('hcode_header_cart_woocommerce', 'equals', '1'),
          ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
));
?>