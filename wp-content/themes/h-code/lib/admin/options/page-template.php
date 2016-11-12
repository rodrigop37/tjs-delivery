<?php
/**
 * Page or Template Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'fa fa-file-text-o',
    'title' => esc_html__('Page/Template', 'H-Code'),
    'fields' => array(
        
        /*  Under Construction */
        array(
            'id'        => 'opt-accordion-begin-under-construction',
            'type'      => 'accordion',
            'title'     => esc_html__('Under Construction Page', 'H-Code'),
            'subtitle'  => esc_html__('Select page to display when site is in under construction mode', 'H-Code'),
            'position'  => 'start',
        ),
        array(
            'id'=>'under_construction_page',
            'type' => 'select',
            'title' => esc_html__('Under Construction Page', 'H-Code'),
            'data' => 'pages'
        ),
        array(
            'id'        => 'opt-accordion-end-under-construction',
            'type'      => 'accordion',
            'position'  => 'end'
        ),

        /*  Comment */
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Comments Settings', 'H-Code'),
            'subtitle'  => esc_html__('Enable/Disable comments in post or portfolio page', 'H-Code'),
            'position'  => 'start',
        ),
        array(
            'id'=>'hcode_enable_page_comment',
            'type' => 'switch', 
            'title' => esc_html__('Enable Comments in Page', 'H-Code'),
            'default'  => false,
        ),
        array(
            'id'=>'hcode_enable_post_comment',
            'type' => 'switch', 
            'title' => esc_html__('Enable Comments in Post', 'H-Code'),
            'default' => true,
        ),
        array(
            'id'=>'hcode_enable_portfolio_comment',
            'type' => 'switch', 
            'title' => esc_html__('Enable Comments in Portfolio', 'H-Code'),
            'default' => false,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),

        /*  404 Page */
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('404 Page Settings', 'H-Code'),
            'subtitle'  => esc_html__('Set title, content, image, button text and button URL for 404 / page not found page', 'H-Code'),
            'position'  => 'start',
        ),
        array(
            'id'       => '404_title_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Title Text', 'H-Code' ),
            'default'  => '404!'
        ),
        array(
            'id'       => '404_content_text',
            'type'     => 'textarea',
            'title'    => esc_html__( '404 Content Text', 'H-Code' ),
            'default'  => 'The page you were looking<br/>for could not be found.'
        ),
        array(
            'id'       => '404_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( '404 Background Image', 'H-Code' ),
            'subtitle' => esc_html__( 'Upload image', 'H-Code' ),
        ),
        array(
            'id'=>'404_enable_text_button',
            'type' => 'switch', 
            'title' => esc_html__('Enable Button', 'H-Code'),
            'default' => true,
            '1'       => 'On',
            '0'      => 'Off',
        ),
        array(
            'id'       => '404_button',
            'type'     => 'text',
            'title'    => esc_html__( 'Button Text', 'H-Code' ),
            'required' => array('404_enable_text_button', 'equals', '1'),
            'default'  => 'Go to home page'
        ),
        array(
            'id'=>'404_button_url',
            'type' => 'select',
            'title' => esc_html__('Button Url', 'H-Code'),
            'data' => 'pages',
            'required'  => array('404_enable_text_button', 'equals', '1'),
        ),
        array(
            'id'=>'404_enable_search',
            'type' => 'switch', 
            'title' => esc_html__('Enable Search', 'H-Code'),
            'default' => true,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
    )
);
?>