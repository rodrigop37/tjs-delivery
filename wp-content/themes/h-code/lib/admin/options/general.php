<?php
/**
 * General Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'el-icon-adjust-alt',
    'title' => esc_html__('General', 'H-Code' ),
    'fields' => array(
        array(
            'id'       => 'enable_under_construction',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Under Construction', 'H-Code' ),
            'default'  => false,
            'desc' => esc_html__('Select on to put the site under construction. Only administrator will be able to see frontend site. Please logout to check under construction mode is enabled or not.', 'H-Code'),
        ),
        array(
            'id'       => 'sidebar_creation',
            'type'     => 'multi_text',
            'title'    => esc_html__( 'Custom Sidebars', 'H-Code' ),
            'subtitle' => esc_html__( 'Custom sidebars can be assigned to any post or pages ', 'H-Code' ),
            'desc' => esc_html__('You can add multiple custom sidebars', 'H-Code' ),
        ),
        array(
            'id'       => 'general_css_code',
            'type'     => 'ace_editor',
            'title'    => esc_html__('CSS Code', 'H-Code' ),
            'subtitle' => esc_html__('Add your custom CSS code here', 'H-Code' ),
            'mode'     => 'css',
            'desc'     => '',
            'default'  => ""
        ),
        array(
            'id' => 'tracking',
            'type' => 'info_title',
            'title' => esc_html__('Any Tracking Code / Space Before Head End Tag / Space Before Body End Tag', 'H-Code' ),
        ),
        array(
            'id'       => 'tracking_code',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Any Tracking Code', 'H-Code' ),
            'subtitle' => esc_html__( 'Paste your google analytics (GA) or other tracking code here. This will be added into the &lt;/head&gt; tag. Please put code with script tags.', 'H-Code' ),
        ),
        array(
            'id'       => 'space_before_head',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Space Before &lt;/head&gt;', 'H-Code' ),
            'subtitle' => esc_html__( 'Code that you want to add before the &lt;/head&gt; tag', 'H-Code' ),
        ),
        array(
            'id'       => 'space_before_body',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Space Before &lt;/body&gt;', 'H-Code' ),
            'subtitle' => esc_html__( 'Code that you want to add before the &lt;/body&gt; tag', 'H-Code' ),
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Favicon Settings', 'H-Code' ),
            'subtitle'  => esc_html__('Set favicon for general desktop, Apple iPhone, Apple iPhone Retina, Apple iPad, Apple iPad Retina ', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'default_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Favicon', 'H-Code' ),
            'subtitle' => esc_html__( 'Favicon for your website (32px x 32px)', 'H-Code' ),
        ),
        array(
            'id'       => 'apple_iPhone_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Apple iPhone Icon', 'H-Code' ),
            'subtitle' => esc_html__( 'Favicon for apple iPhone (57px x 57px)', 'H-Code' ),
        ),
        array(
            'id'       => 'apple_iPhone_retina_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Apple iPhone Retina Icon', 'H-Code' ),
            'subtitle' => esc_html__( 'Favicon for apple iPhone retina version (149px x 149px)', 'H-Code' ),
        ),
        array(
            'id'       => 'apple_iPad_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Apple iPad Icon', 'H-Code' ),
            'subtitle' => esc_html__( 'Favicon for apple iPad (72px x 72px)', 'H-Code' ),
        ),
        array(
            'id'       => 'apple_iPad_retina_favicon',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,  
            'title'    => esc_html__( 'Apple iPad Retina Icon', 'H-Code' ),
            'subtitle' => esc_html__( 'Favicon for apple iPad retina version (149px x 149px)', 'H-Code' ),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Image Meta Data Settings', 'H-Code' ),
            'subtitle'  => esc_html__('Set visibility for image alt, title and caption ', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'enable_image_alt',
            'type'     => 'switch',
            'title'    => esc_html__('Render Image Alt', 'H-Code' ),
            'default'  => true,
        ),
        array(
            'id'       => 'enable_image_title',
            'type'     => 'switch',
            'title'    => esc_html__('Render Image Title', 'H-Code' ),
            'default'  => false,
        ),
        array(
            'id'       => 'enable_lightbox_title',
            'type'     => 'switch',
            'title'    => esc_html__('Show Image Title in Lightbox Popup', 'H-Code' ),
            'default'  => false,
        ),
        array(
            'id'       => 'enable_lightbox_caption',
            'type'     => 'switch',
            'title'    => esc_html__('Show Image Caption in Lightbox Popup', 'H-Code' ),
            'default'  => false,
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('Search Block Settings', 'H-Code' ),
            'subtitle'  => esc_html__('Set search placeholder text.', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'hcode_search_placeholder_text',
            'type'     => 'text',
            'title'    => esc_html__('Placeholder Text', 'H-Code' ),
            'default'  => 'Enter your keywords...',
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
        array(
            'id'        => 'opt-accordion-begin-general',
            'type'      => 'accordion',
            'title'     => esc_html__('No Image Settings', 'H-Code' ),
            'subtitle'  => esc_html__('Upload no-image.', 'H-Code' ),
            'position'  => 'start',
        ),
        array(
            'id'       => 'hcode_no_image',
            'type'     => 'media',
            'preview'  => true,
            'url'      => true,
            'title'    => esc_html__('Upload Image', 'H-Code' ),
            'default'  => array(
                'url'=>   HCODE_THEME_ASSETS_URI . '/images/no-image.jpg',
            ),
        ),
        array(
            'id'        => 'opt-accordion-end-general',
            'type'      => 'accordion',
            'position'  => 'end'
        ),
    )
);
?>