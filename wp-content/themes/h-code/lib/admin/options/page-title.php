<?php
/**
 * Page Title Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'el-icon-website',
    'title' => esc_html__('Page Title', 'H-Code'),
    'fields' => array(
                  	  array(
                          'id'       => 'hcode_enable_title_wrapper',
                          'type'     => 'switch',
                          'title'    => esc_html__('Enable Title', 'H-Code'),
                          'default'  => true,
                          'subtitle' => esc_html__('If on, a title will display in page', 'H-Code'),
                          '2'       => 'On',
                          '0'      => 'Off',
                      ),
                      array(
                          'id'       => 'hcode_page_title_premade_style',
                          'type'     => 'select',
                          'title'    => esc_html__( 'Title Style', 'H-Code' ),
                          'options'  => array(esc_html__('', 'H-Code') => esc_html__('Please select style', 'H-Code'),
                                         'title-white' => esc_html__('Title White', 'H-Code'),
                                         'title-gray' => esc_html__('Title Gray', 'H-Code'),
                                         'title-dark-gray' => esc_html__('Title Dark Gray', 'H-Code'),
                                         'title-black' => esc_html__('Title Black', 'H-Code'),
                                         'title-with-image' => esc_html__('Title With Image', 'H-Code'),
                                         'title-large' => esc_html__('Title Large', 'H-Code'),
                                         'title-large-without-overlay' => esc_html__('Title Large Without Overlay', 'H-Code'),
                                         'title-small-white' => esc_html__('Title Small White', 'H-Code'),
                                         'title-small-gray' => esc_html__('Title Small Gray', 'H-Code'),
                                         'title-small-dark-gray' => esc_html__('Title Small Dark Gray', 'H-Code'),
                                         'title-small-black' => esc_html__('Title Small Black', 'H-Code'),
                                         'title-center-align' => esc_html__('Title Center Align', 'H-Code'),
                                        ),
                          'subtitle' => esc_html__( 'Choose style for the title', 'H-Code' ),
                          'default'  => 'title-small-gray',
                      ),
                      array(
                        'id' => 'hcode_header_subtitle',
                        'type' => 'text',
                        'title' => esc_html__('Subtitle', 'H-Code'),
                        'default' => '',
                        'required'  => array('hcode_page_title_premade_style', '=', array('title-white','title-gray','title-dark-gray','title-black','title-with-image','title-large','title-large-without-overlay','title-center-align')),
                      ),
                      array(
                          'id'       => 'hcode_title_background',
                          'type'     => 'media',
                          'preview'  => true,
                          'url'      => true,  
                          'title'    => esc_html__( 'Title Background Image', 'H-Code' ),
                          'subtitle' => esc_html__('Recommended image size (1920px X 700px) for better result.', 'H-Code'),
                          'required'  => array('hcode_page_title_premade_style', '=', array('title-with-image','title-large','title-large-without-overlay')),
                      ),
                      array(
                          'id'       => 'hcode_title_parallax_effect',
                          'type'     => 'select',
                          'title'    => esc_html__( 'Parallax effect', 'H-Code' ),
                          'options'  => array('no-effect' => esc_html__('No Effect', 'H-Code'),
                                    'parallax1' => esc_html__('parallax-effect-1', 'H-Code'),
                                    'parallax2' => esc_html__('parallax-effect-2', 'H-Code'),
                                    'parallax3' => esc_html__('parallax-effect-3', 'H-Code'),
                                    'parallax4' => esc_html__('parallax-effect-4', 'H-Code'),
                                    'parallax5' => esc_html__('parallax-effect-5', 'H-Code'),
                                    'parallax6' => esc_html__('parallax-effect-6', 'H-Code'),
                                    'parallax7' => esc_html__('parallax-effect-7', 'H-Code'),
                                    'parallax8' => esc_html__('parallax-effect-8', 'H-Code'),
                                    'parallax9' => esc_html__('parallax-effect-9', 'H-Code'),
                                    'parallax10' => esc_html__('parallax-effect-10', 'H-Code'),
                                    'parallax11' => esc_html__('parallax-effect-11', 'H-Code'),
                                    'parallax12' => esc_html__('parallax-effect-12', 'H-Code')
                                   ),
                          'subtitle' => esc_html__( 'Choose parallax effect', 'H-Code' ),
                          'required'  => array('hcode_page_title_premade_style', '=', array('title-with-image','title-large','title-large-without-overlay')),
                      ),
                      array(
                          'id'       => 'hcode_page_title_show_breadcrumb',
                          'type'     => 'switch',
                          'title'    => esc_html__('Enable Breadcrumb', 'H-Code'),
                          'default'  => true,
                          'subtitle' => esc_html__('If on, breadcrumb will display in title section', 'H-Code'),
                          '1'       => 'Yes',
                          '2'      => 'No',
                          'required'  => array('hcode_page_title_premade_style', '=', array('title-white','title-gray','title-dark-gray','title-black','title-with-image','title-small-white','title-small-gray','title-small-dark-gray','title-small-black')),
                      ),
                      array(
                          'id'       => 'hcode_page_title_show_separator',
                          'type'     => 'switch',
                          'title'    => esc_html__('Enable Separator', 'H-Code'),
                          'default'  => false,
                          'subtitle' => esc_html__('If on, separator will display in title section', 'H-Code'),
                          '1'       => 'On',
                          '0'      => 'Off',
                          'required'  => array('hcode_page_title_premade_style', '=', array('title-white','title-gray','title-dark-gray','title-black','title-with-image','title-large','title-large-without-overlay','title-small-white','title-small-gray','title-small-dark-gray','title-small-black','title-center-align')),
                      ),
    )
);
?>