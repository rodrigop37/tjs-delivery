<?php
/**
 * Font Settings Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'fa fa-font',
    'title' => esc_html__('Font Settings', 'H-Code'),
    'desc' => esc_html__('Font Setting', 'H-Code'),
    'fields' => array(
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Font Family', 'H-Code'),
            'subtitle'  => esc_html__('Set font family', 'H-Code'),
            'position'  => 'start',
        ),
        array(
            'id'       => 'main_font',
            'type'     => 'typography',
            'title'    => esc_html__( 'Main Font', 'H-Code' ),
            'font-size'=> false,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'default'  => array(
                'font-family' => 'Open Sans',
            ),
            'output' => array('body, input, textarea, select')
        ),
        array(
            'id'       => 'alt_font',
            'type'     => 'typography',
            'title'    => esc_html__( 'Alt Font', 'H-Code' ),
            'font-size'=> false,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'default'  => array(
                'font-family' => 'Oswald, sans-serif'
            ),
            'output' => array('.alt-font')
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        
        /* Font Size and Line Height */ 
        
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Font Size', 'H-Code'),
            'subtitle'  => esc_html__('Set font size', 'H-Code'),
            'position'  => 'start',
        ),
        array(
            'id'       => 'body_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Body Font Size', 'H-Code' ),
            'line-height'=> true,
            'font-size'=> true,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '13px',
                'line-height' => '23px',
            ),
            'output' => array('body')
        ),
        array(
            'id'       => 'header_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Header Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '11px',
            ),
            'output' => array('.navbar .navbar-nav > li > a, .search-cart-header .subtitle'),
        ),
        array(
            'id'       => 'header_icon_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Header Icon Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '13px',
            ),
            'output' => array('.top-cart .fa-shopping-cart, .search-cart-header i')
        ),
        array(
            'id'       => 'header_dropdown_menu_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Header Dropdown Menu Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '11px',
            ),
            'output' => array('.dropdown-header, .dropdown-menu, .simple-dropdown > ul.dropdown-menu > li a')
        ),
        array(
            'id'       => 'h2_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Heading h2 Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '24px',
            ),
            'output' => array('h2')
        ),
        array(
            'id'       => 'h3_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Heading h3 Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '14px',
            ),
            'output' => array('h3')
        ),
        array(
            'id'       => 'h4_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Heading h4 Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '16px',
            ),
            'output' => array('h4')
        ),
        array(
            'id'       => 'h5_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Heading h5 Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '11px',
            ),
            'output' => array('h5')
        ),
        array(
            'id'       => 'h6_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Heading h6 Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '13px',
            ),
            'output' => array('h6')
        ),
        array(
            'id'       => 'section_title_h1_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Section Title h1 Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '36px',
            ),
            'output' => array('h1.section-title')
        ),
        array(
            'id'       => 'section_title_h2_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Section Title h2 Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '24px',
            ),
            'output' => array('h2.section-title')
        ),
        array(
            'id'       => 'section_title_h3_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Section Title h3 Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '20px',
            ),
            'output' => array('h3.section-title')
        ),
        array(
            'id'       => 'section_title_h5_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Section Title h5 Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '14px',
            ),
            'output' => array('h5.section-title')
        ),
        array(
            'id'       => 'section_title_h6_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Section Title h6 Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '13px',
            ),
            'output' => array('h6.section-title')
        ),
        array(
            'id'       => 'text_small_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Small Text Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> true,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '11px',
                'line-height' => '15px',
            ),
            'output' => array('.text-small')
        ),
        array(
            'id'       => 'text_medium_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Medium Text Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> true,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '14px',
                'line-height' => '26px',
            ),
            'output' => array('.text-med')
        ),
        array(
            'id'       => 'text_large_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Large Text Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> true,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '15px',
                'line-height' => '24px',
            ),
            'output' => array('.text-large')
        ),
        array(
            'id'       => 'text_extra_large_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Extra Large Text Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> true,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '16px',
                'line-height' => '28px',
            ),
            'output' => array('.text-extra-large')
        ),
        array(
            'id'       => 'text_small_title_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Small Title Text Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> true,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '20px',
                'line-height' => '30px',
            ),
            'output' => array('.title-small')
        ),
        array(
            'id'       => 'text_medium_title_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Medium Title Text Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> true,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '24px',
                'line-height' => '34px',
            ),
            'output' => array('.title-med')
        ),
        array(
            'id'       => 'text_large_title_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Large Title Text Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> true,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '28px',
                'line-height' => '41px',
            ),
            'output' => array('.title-large')
        ),
        array(
            'id'       => 'text_extra_large_title_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Extra Large Title Text Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> true,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '35px',
                'line-height' => '43px',
            ),
            'output' => array('.title-extra-large')
        ),
        array(
            'id'       => 'text_page_title_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Page Title Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '20px',
            ),
            'output' => array('.page-title h1')
        ),
        array(
            'id'       => 'text_page_subtitle_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Page Subtitle Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '14px',
            ),
            'output' => array('.page-title span')
        ),
        array(
            'id'       => 'text_page_breadcrumb_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Page Breadcrumb Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '11px',
            ),
            'output' => array('.breadcrumb ul li')
        ),
        array(
            'id'       => 'text_page_breadcrumb_pipe_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Page Breadcrumb Pipe Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '8px',
            ),
            'output' => array('.breadcrumb ul > li+li:before')
        ),
        array(
            'id'       => 'text_page_title_shop_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Page Title Shop Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '35px',
            ),
            'output' => array('.page-title-shop h1')
        ),
        array(
            'id'       => 'text_page_title_small_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Page Title Small Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '18px',
            ),
            'output' => array('.page-title-small h1')
        ),
        array(
            'id'       => 'text_footer_font_size',
            'type'     => 'typography',
            'title'    => esc_html__( 'Footer Font Size', 'H-Code' ),
            'font-size'=> true,
            'line-height'=> false,
            'color' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight'=> false,
            'subsets' => false,
            'font-family' => false,
            'preview'     => false,
            'default'     => array(
                'font-size'   => '11px',
            ),
            'output' => array('footer ul li a, .copyright')
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
    ),
);
?>