<?php
/**
 * Footer Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'el-icon-website icon-rotate',
    'title' => esc_html__('Footer', 'H-Code'),
    'desc' => esc_html__('Footer section configuration settings', 'H-Code'),
    'fields' => array(
    	array(
            'id'       => 'hcode_enable_page_footer',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Footer', 'H-Code'),
            'default'  => true,
            '1'       => 'On',
            '0'      => 'Off',
        ),
        array(
            'id'       => 'hcode_enable_sidebar_section',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Footer Information Links Block', 'H-Code'),
            'default'  => false,
            '1'       => 'On',
            '0'      => 'Off',
        ),
        array(
            'id'        => 'hcode_footer_sidebar_1',
            'type'      => 'select',
            'title'     => esc_html__('Information Block', 'H-Code'),
            'subtitle'  => esc_html__('Select custom sidebar', 'H-Code'),
            'data'      => 'sidebar',
            'default'   => '',
            'required'  => array('hcode_enable_sidebar_section', 'equals', '1'),
        ),
		
		array(
			'id'        => 'hcode_footer_sidebar_2',
			'type'      => 'select',
			'title'     => esc_html__('Link Block 1', 'H-Code'),
			'subtitle'  => esc_html__('Select custom sidebar', 'H-Code'),
            'data'      => 'sidebar',
			'default'   => '',
			'required'  => array('hcode_enable_sidebar_section', 'equals', '1'),
		),
		
		array(
			'id'        => 'hcode_footer_sidebar_3',
			'type'      => 'select',
			'title'     => esc_html__('Link Block 2', 'H-Code'),
			'subtitle'  => esc_html__('Select custom sidebar', 'H-Code'),
            'data'      => 'sidebar',
			'default'   => '',
			'required'  => array('hcode_enable_sidebar_section', 'equals', '1'),
		),
		array(
			'id'        => 'hcode_footer_sidebar_4',
			'type'      => 'select',
			'title'     => esc_html__('Link Block 3', 'H-Code'),
			'subtitle'  => esc_html__('Select custom sidebar', 'H-Code'),
            'data'      => 'sidebar',
			'default'   => '',
			'required'  => array('hcode_enable_sidebar_section', 'equals', '1'),
		),
        array(
            'id'        => 'hcode_footer_sidebar_5',
            'type'      => 'select',
            'title'     => esc_html__('Link Block 4', 'H-Code'),
            'subtitle'  => esc_html__('Select custom sidebar', 'H-Code'),
            'data'      => 'sidebar',
            'default'   => '',
            'required'  => array('hcode_enable_sidebar_section', 'equals', '1'),
        ),
        array(
            'id'       => 'hcode_enable_footer_menu',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Footer Menu', 'H-Code'),
            'default'  => false,
            '1'       => 'On',
            '0'      => 'Off',
        ),
        array(
            'id'       => 'hcode_footer_menu',
            'type'     => 'select',
            'data'     => 'menus',
            'title'    => esc_html__( 'Select Footer Menu', 'H-Code' ),
            'required'  => array('hcode_enable_footer_menu', 'equals', '1'),
        ),
		array(
            'id'       => 'hcode_enable_footer_logo',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Footer Logo', 'H-Code'),
            'default'  => false,
            '1'       => 'On',
            '0'      => 'Off',
        ),
        array(
            'id'       => 'hcode_footer_logo',
            'type'     => 'media',
            'required'  => array('hcode_enable_footer_logo', 'equals', '1'),
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__( 'Footer Logo', 'H-Code' ),
        ),
        array(
            'id'       => 'hcode_enable_social_icons',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Social Icons', 'H-Code'),
            'default'  => false,
            '1'       => 'On',
            '0'      => 'Off',
        ),
        array(
            'id'        => 'hcode_social_sidebar',
            'type'      => 'select',
            'title'     => esc_html__('Social Sidebar', 'H-Code'),
            'subtitle'  => esc_html__('Select custom sidebar', 'H-Code'),
            'data'      => 'sidebar',
            'default'   => 'footer-social-icons',
            'required'  => array('hcode_enable_social_icons', 'equals', '1'),
        ),
        array(
            'id'       => 'hcode_enable_footer_copyright',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Footer Copyright', 'H-Code'),
            'default'  => false,
            '1'       => 'On',
            '0'      => 'Off',
        ),
        array(
            'id'       => 'hcode_footer_copyright',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Copyright', 'H-Code' ),
            'required'  => array('hcode_enable_footer_copyright', 'equals', '1'),
            'subtitle' => esc_html__( 'Add copyright content here', 'H-Code' ),
        ),
        array(
            'id'       => 'hcode_enable_scrolltotop_button',
            'type'     => 'switch',
            'title'    => esc_html__('Enable ScrollToTop Button', 'H-Code'),
            'default'  => true,
            '1'       => 'On',
            '0'      => 'Off',
        ),
    )
);
?>