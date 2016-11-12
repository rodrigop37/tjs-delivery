<?php

// For Slider Preview Image.
require_once( HCODE_SHORTCODE_ADDONS_EXTEND_COMPOSER . '/hcode-preview-image.php' );
// For Switch Option.
require_once( HCODE_SHORTCODE_ADDONS_EXTEND_COMPOSER . '/switch-option.php' );
// For Icons List.
require_once( HCODE_SHORTCODE_ADDONS_EXTEND_COMPOSER . '/icons-shortcode.php' );
// For Font Awesome Icons List.
require_once( HCODE_SHORTCODE_ADDONS_EXTEND_COMPOSER . '/font-awesome-icons.php' );
// For ET-Line Icons List.
require_once( HCODE_SHORTCODE_ADDONS_EXTEND_COMPOSER . '/et-line-icons.php' );
// For Post Featurebox.
require_once( HCODE_SHORTCODE_ADDONS_EXTEND_COMPOSER . '/hcode-posts-list.php' );
// For Multi-select Option In Post Category.
require_once( HCODE_SHORTCODE_ADDONS_EXTEND_COMPOSER . '/hcode-multiple-select-option.php' );
// For Multi-select Option In Portfolio Category.
require_once( HCODE_SHORTCODE_ADDONS_EXTEND_COMPOSER . '/hcode-multiple-portfolio-categories.php' );
// For Animation.
require_once( HCODE_SHORTCODE_ADDONS_EXTEND_COMPOSER . '/animation-style.php' );
// For Custom Padding And Margin.
require_once( HCODE_SHORTCODE_ADDONS_EXTEND_COMPOSER . '/padding-margin.php' );

/*-----------------------------------------------------------------------------------*/
/* Map Element Id And Class Start */
/*-----------------------------------------------------------------------------------*/

$hcode_vc_extra_id = array(
  'type'        => 'textfield',
  'heading'     => 'Extra ID',
  'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
  'param_name'  => 'id',
  'group'       => 'Extras'
);

$hcode_vc_extra_class = array(
  'type'        => 'textfield',
  'heading'     => 'Extra Class',
  'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
  'param_name'  => 'class',
  'group'       => 'Extras'
);

$hcode_vc_column =array(
  __('inherit from smaller', 'hcode-addons') => '',
  __('1 column - 1/12', 'hcode-addons') => '1/12',
  __('2 columns - 1/6', 'hcode-addons') => '1/6',
  __('3 columns - 1/4', 'hcode-addons') => '1/4',
  __('4 columns - 1/3', 'hcode-addons') => '1/3',
  __('5 columns - 5/12', 'hcode-addons') => '5/12',
  __('6 columns - 1/2', 'hcode-addons') => '1/2',
  __('7 columns - 7/12', 'hcode-addons') => '7/12',
  __('8 columns - 2/3', 'hcode-addons') => '2/3',
  __('9 columns - 3/4', 'hcode-addons') => '3/4',
  __('10 columns - 5/6', 'hcode-addons') => '5/6',
  __('11 columns - 11/12', 'hcode-addons') => '11/12',
  __('12 columns - 1/1', 'hcode-addons') => '1/1'
);

/*-----------------------------------------------------------------------------------*/
/* Map Element Id And Class End */
/*-----------------------------------------------------------------------------------*/

if (class_exists('Vc_Manager')) {

$cf7 = get_posts( 'post_type=wpcf7_contact_form&numberposts=-1' );

$contact_forms = array();
if ( $cf7 ) {
  foreach ( $cf7 as $cform ) {
    $contact_forms[ $cform->post_title ] = $cform->ID;
  }
} else {
  $contact_forms[ __( 'No contact forms found', 'hcode-addons' ) ] = 0;
}

/*-----------------------------------------------------------------------------------*/
/* Vc_row change Start */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
      'name' => __( 'Row' , 'hcode-addons' ),
      'base' => 'vc_row',
      'description' => __( 'Place content elements inside the section','hcode-addons' ),
      'icon' => 'fa fa-th h-code-shortcode-icon',
      'is_container' => true,
      'js_view' => 'VcRowView',
      'category' => 'H-Code',
      'params' => array(
          array(
            'type' => 'checkbox',
            'heading' => __( 'Equal height', 'hcode-addons' ),
            'param_name' => 'equal_height',
            'description' => __( 'If checked columns will be set to equal height.', 'hcode-addons' ),
            'value' => array( __( 'Yes', 'hcode-addons' ) => 'yes' )
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Content Position', 'hcode-addons' ),
            'param_name' => 'content_placement',
            'value' => array(
              __( 'Default', 'hcode-addons' ) => '',
              __( 'Top', 'hcode-addons' ) => 'top',
              __( 'Middle', 'hcode-addons' ) => 'middle',
              __( 'Bottom', 'hcode-addons' ) => 'bottom',
            ),
            'description' => __( 'Select content position within columns.', 'hcode-addons' ),
            'dependency' => array( 'element' => 'equal_height', 'value' => array('yes') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_row_style',
            'heading' => __( 'Please Select Row Style','hcode-addons' ),
            'value' => array(__('Please Select Row Style', 'hcode-addons') => '',
                             __('Color', 'hcode-addons') => 'color',
                             __('Image', 'hcode-addons') => 'image',
                            ),
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Background Color', 'hcode-addons' ),
            'param_name' => 'hcode_row_bg_color',
            'dependency' => array( 'element' => 'hcode_row_style', 'value' => array('color') ),
          ),
          array(
            'type' => 'attach_image',
            'heading' => __( 'Background Image', 'hcode-addons' ),
            'param_name' => 'hcode_row_bg_image',
            'dependency' => array( 'element' => 'hcode_row_style', 'value' => array('image') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_row_image_type',
            'heading' => __( 'Background Image Type', 'hcode-addons' ),
            'value' => array(__('Select Background Image Type', 'hcode-addons') => '',
                             __('Parallax', 'hcode-addons') => 'parallax',
                             __('Background Image', 'hcode-addons') => 'background-image',
                            ),
            'dependency' => array( 'element' => 'hcode_row_style', 'value' => array('image') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_bg_image_type', 
            'heading' => __( 'Background Image Type', 'hcode-addons' ),
            'value' => array(__('Select Background Image Type', 'hcode-addons') => '',
                             __('Fix Background', 'hcode-addons') => 'fix-background',
                             __('Cover Background', 'hcode-addons') => 'cover-background',
                             __('Fill Background', 'hcode-addons') => 'fill',
                            ),
            'dependency' => array( 'element' => 'hcode_row_image_type', 'value' => array('background-image') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_parallax_image_type',
            'heading' => __('Parallax Type', 'hcode-addons' ),
            'value' => array(__('no parallax', 'hcode-addons') => '',
                             __('Parallax1', 'hcode-addons') => 'parallax1',
                             __('Parallax2', 'hcode-addons') => 'parallax2',
                             __('Parallax3', 'hcode-addons') => 'parallax3',
                             __('Parallax4', 'hcode-addons') => 'parallax4',
                             __('Parallax5', 'hcode-addons') => 'parallax5',
                             __('Parallax6', 'hcode-addons') => 'parallax6',
                             __('Parallax7', 'hcode-addons') => 'parallax7',
                             __('Parallax8', 'hcode-addons') => 'parallax8',
                             __('Parallax9', 'hcode-addons') => 'parallax9',
                             __('Parallax10', 'hcode-addons') => 'parallax10',
                             __('Parallax11', 'hcode-addons') => 'parallax11',
                             __('Parallax12', 'hcode-addons') => 'parallax12',
                            ),
            'dependency' => array( 'element' => 'hcode_row_image_type', 'value' => array('parallax') ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Column Without Row', 'hcode-addons'),
                'param_name' => 'column_without_row',
                'value' => array(__('NO', 'hcode-addons') => '0', 
                                 __('YES', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show Column without Row', 'hcode-addons' ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('100% Full-width, Without Container', 'hcode-addons'),
                'param_name' => 'show_full_width',
                'value' => array(__('NO', 'hcode-addons') => '0', 
                                 __('YES', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select YES to show fullwidth in row', 'hcode-addons' ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Container Fluid', 'hcode-addons'),
                'param_name' => 'show_container_fluid',
                'value' => array(__('NO', 'hcode-addons') => '0', 
                                 __('YES', 'hcode-addons') => '1'
                                ),
                'dependency' => array( 'element' => 'show_full_width', 'value' => array('0', '') ),
                'description' => __( 'Select YES to show container fluid in row', 'hcode-addons' ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Fullscreen Class', 'hcode-addons'),
                'param_name' => 'fullscreen',
                'value' => array(__('NO', 'hcode-addons') => '0', 
                                 __('YES', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select YES to add (fullscreen) class in section', 'hcode-addons' ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Overlay Div', 'hcode-addons'),
                'param_name' => 'show_overlay',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'dependency' => array( 'element' => 'hcode_row_style', 'value' => array('image') ),
                'description' => __( 'Select ON to show overlay in row', 'hcode-addons' ),
                'group' => 'Opacity',
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Hide Background For Mobile Device', 'hcode-addons'),
                'param_name' => 'hide_background',
                'value' => array(__('NO', 'hcode-addons') => '0', 
                                 __('YES', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select Yes to hide background in mobile device', 'hcode-addons' ),
                'dependency' => array( 'element' => 'hcode_row_style', 'value' => array('image') ),
                'group' => 'Hide Background',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_overlay_opacity',
            'heading' => __('Overlay Opacity', 'hcode-addons'),
            'value' => array(__('no opacity', 'hcode-addons') => '',
                             __('0.1', 'hcode-addons') => '0.1',
                             __('0.2', 'hcode-addons') => '0.2',
                             __('0.3', 'hcode-addons') => '0.3',
                             __('0.4', 'hcode-addons') => '0.4',
                             __('0.5', 'hcode-addons') => '0.5',
                             __('0.6', 'hcode-addons') => '0.6',
                             __('0.7', 'hcode-addons') => '0.7',
                             __('0.8', 'hcode-addons') => '0.8',
                             __('0.9', 'hcode-addons') => '0.9',
                             __('1.0', 'hcode-addons') => '1.0',
                            ),
            'dependency' => array( 'element' => 'show_overlay', 'value' => array('1') ),
            'group' => 'Opacity',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Overlay Color', 'hcode-addons' ),
            'param_name' => 'hcode_row_overlay_color',
            'dependency' => array( 'element' => 'show_overlay', 'value' => array('1') ),
            'group' => 'Opacity',
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Z Index', 'hcode-addons'),
            'param_name' => 'hcode_z_index',
            'dependency' => array( 'element' => 'show_overlay', 'value' => array('1') ),
            'group' => 'Opacity',
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Position Relative', 'hcode-addons'),
              'param_name' => 'position_relative',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Overflow Hidden', 'hcode-addons'),
              'param_name' => 'overflow_hidden',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Min Height', 'hcode-addons'),
            'param_name' => 'hcode_min_height',
            'description' => __( 'Define min height like 500px', 'hcode-addons' ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_row_border_position',
            'heading' => __('Row Border Position', 'hcode-addons' ),
            'value' => array(__('No Border', 'hcode-addons') => '',
                             __('Border Top', 'hcode-addons') => 'border-top',
                             __('Border Bottom', 'hcode-addons') => 'border-bottom',
                            ),
            'group' => 'Style',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Border Color', 'hcode-addons' ),
            'param_name' => 'hcode_row_border_color',
            'dependency' => array( 'element' => 'hcode_row_border_position', 'value' => array('border-top','border-bottom') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Border Size', 'hcode-addons' ),
            'param_name' => 'hcode_border_size',
            'dependency' => array( 'element' => 'hcode_row_border_position', 'value' => array('border-top','border-bottom') ),
            'description' => __( 'Define border size like 2px', 'hcode-addons' ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_border_type',
            'heading' => __( 'Border Type', 'hcode-addons' ),
            'value' => array(__('no border', 'hcode-addons') => '',
                             __('Dotted', 'hcode-addons') => 'dotted',
                             __('Dashed', 'hcode-addons') => 'dashed',
                             __('Solid', 'hcode-addons') => 'solid',
                             __('Double', 'hcode-addons') => 'double',
                            ),
            'dependency' => array( 'element' => 'hcode_row_border_position', 'value' => array('border-top','border-bottom') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Padding Setting?', 'hcode-addons'),
            'param_name' => 'padding_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_padding',
            'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_padding',
            'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
            'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_padding',
            'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_padding',
            'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Margin Setting?', 'hcode-addons'),
            'param_name' => 'margin_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
              'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_margin',
            'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_margin',
            'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
            'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_margin',
            'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_margin',
            'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Scroll To Down', 'hcode-addons'),
              'param_name' => 'scroll_to_down',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Set Scroll To Down in section', 'hcode-addons' ),
              'group' => 'Scroll To Down',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'scroll_to_down_color',
            'heading' => __('Cursor Color', 'hcode-addons' ),
            'value' => array(__('Select Cursor Color', 'hcode-addons') => '',
                             __('Black Cursor', 'hcode-addons') => 'scroll-to-down',
                             __('White Cursor', 'hcode-addons') => 'scroll-to-down-white',
                            ),

            'dependency' => array( 'element' => 'scroll_to_down', 'value' => array('1') ),
            'group' => 'Scroll To Down',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Scroll Id', 'hcode-addons' ),
            'param_name' => 'scroll_to_down_id',
            'dependency' => array( 'element' => 'scroll_to_down', 'value' => array('1') ),
            'description' => __( 'Scroll to down section id ex. #about', 'hcode-addons' ),
            'group' => 'Scroll To Down',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_row_animation_style',
            'heading' => __('Animation Style', 'hcode-addons' ),
            'value' => hcode_animation_style(),
            'group' => 'Animation',
          ),
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,
      ),
  )
);

/*-----------------------------------------------------------------------------------*/
/* Vc_row change End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* vc_row_inner change Start */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
      'name' => __( 'Inner Row' , 'hcode-addons' ),
      'base' => 'vc_row_inner',
      'content_element' => false,
      'description' => __( 'Place content elements inside the inner row','hcode-addons' ),
      'icon' => 'fa fa-th h-code-shortcode-icon',
      'is_container' => true,
      'js_view' => 'VcRowView',
      'category' => 'H-Code',
      'params' => array(
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_row_style',
            'heading' => __( 'Please Select Row Style','hcode-addons' ),
            'value' => array(__('Please Select Row Style', 'hcode-addons') => '',
                             __('Color', 'hcode-addons') => 'color',
                             __('Image', 'hcode-addons') => 'image',
                            ),
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Background Color', 'hcode-addons' ),
            'param_name' => 'hcode_row_bg_color',
            'dependency' => array( 'element' => 'hcode_row_style', 'value' => array('color') ),
          ),
          array(
            'type' => 'attach_image',
            'heading' => __( 'Background Image', 'hcode-addons' ),
            'param_name' => 'hcode_row_bg_image',
            'dependency' => array( 'element' => 'hcode_row_style', 'value' => array('image') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_row_image_type',
            'heading' => __( 'Background Image Type', 'hcode-addons' ),
            'value' => array(__('Select Background Image Type', 'hcode-addons') => '',
                             __('Parallax', 'hcode-addons') => 'parallax',
                             __('Background Image', 'hcode-addons') => 'background-image',
                            ),
            'dependency' => array( 'element' => 'hcode_row_style', 'value' => array('image') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_bg_image_type', 
            'heading' => __( 'Background Image Type', 'hcode-addons' ),
            'value' => array(__('Select Background Image Type', 'hcode-addons') => '',
                             __('Fix Background', 'hcode-addons') => 'fix-background',
                             __('Cover Background', 'hcode-addons') => 'cover-background',
                             __('Fill Background', 'hcode-addons') => 'fill',
                            ),
            'dependency' => array( 'element' => 'hcode_row_image_type', 'value' => array('background-image') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_parallax_image_type',
            'heading' => __('Parallax Type', 'hcode-addons' ),
            'value' => array(__('no parallax', 'hcode-addons') => '',
                             __('Parallax1', 'hcode-addons') => 'parallax1',
                             __('Parallax2', 'hcode-addons') => 'parallax2',
                             __('Parallax3', 'hcode-addons') => 'parallax3',
                             __('Parallax4', 'hcode-addons') => 'parallax4',
                             __('Parallax5', 'hcode-addons') => 'parallax5',
                             __('Parallax6', 'hcode-addons') => 'parallax6',
                             __('Parallax7', 'hcode-addons') => 'parallax7',
                             __('Parallax8', 'hcode-addons') => 'parallax8',
                             __('Parallax9', 'hcode-addons') => 'parallax9',
                             __('Parallax10', 'hcode-addons') => 'parallax10',
                             __('Parallax11', 'hcode-addons') => 'parallax11',
                             __('Parallax12', 'hcode-addons') => 'parallax12',
                            ),
            'dependency' => array( 'element' => 'hcode_row_image_type', 'value' => array('parallax') ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Overlay Div', 'hcode-addons'),
                'param_name' => 'show_overlay',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'dependency' => array( 'element' => 'hcode_row_style', 'value' => array('image') ),
                'description' => __( 'Select ON to show overlay in row', 'hcode-addons' ),
                'group' => 'Opacity',
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Hide Background For Mobile Device', 'hcode-addons'),
                'param_name' => 'hide_background',
                'value' => array(__('NO', 'hcode-addons') => '0', 
                                 __('YES', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select Yes to hide background in mobile device', 'hcode-addons' ),
                'dependency' => array( 'element' => 'hcode_row_style', 'value' => array('image') ),
                'group' => 'Hide Background',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_overlay_opacity',
            'heading' => __('Overlay Opacity', 'hcode-addons'),
            'value' => array(__('no opacity', 'hcode-addons') => '',
                             __('0.1', 'hcode-addons') => '0.1',
                             __('0.2', 'hcode-addons') => '0.2',
                             __('0.3', 'hcode-addons') => '0.3',
                             __('0.4', 'hcode-addons') => '0.4',
                             __('0.5', 'hcode-addons') => '0.5',
                             __('0.6', 'hcode-addons') => '0.6',
                             __('0.7', 'hcode-addons') => '0.7',
                             __('0.8', 'hcode-addons') => '0.8',
                             __('0.9', 'hcode-addons') => '0.9',
                             __('1.0', 'hcode-addons') => '1.0',
                            ),
            'dependency' => array( 'element' => 'show_overlay', 'value' => array('1') ),
            'group' => 'Opacity',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Overlay Color', 'hcode-addons' ),
            'param_name' => 'hcode_row_overlay_color',
            'dependency' => array( 'element' => 'show_overlay', 'value' => array('1') ),
            'group' => 'Opacity',
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Z Index', 'hcode-addons'),
            'param_name' => 'hcode_z_index',
            'dependency' => array( 'element' => 'show_overlay', 'value' => array('1') ),
            'group' => 'Opacity',
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Position Relative', 'hcode-addons'),
              'param_name' => 'position_relative',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Overflow Hidden', 'hcode-addons'),
              'param_name' => 'overflow_hidden',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Min Height', 'hcode-addons'),
            'param_name' => 'hcode_min_height',
            'description' => __( 'Define min height like 500px', 'hcode-addons' ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_row_border_position',
            'heading' => __('Row Border Position', 'hcode-addons' ),
            'value' => array(__('No Border', 'hcode-addons') => '',
                             __('Border Top', 'hcode-addons') => 'border-top',
                             __('Border Bottom', 'hcode-addons') => 'border-bottom',
                            ),
            'group' => 'Style',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Border Color', 'hcode-addons' ),
            'param_name' => 'hcode_row_border_color',
            'dependency' => array( 'element' => 'hcode_row_border_position', 'value' => array('border-top','border-bottom') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Border Size', 'hcode-addons' ),
            'param_name' => 'hcode_border_size',
            'dependency' => array( 'element' => 'hcode_row_border_position', 'value' => array('border-top','border-bottom') ),
            'description' => __( 'Define border size like 2px', 'hcode-addons' ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_border_type',
            'heading' => __( 'Border Type', 'hcode-addons' ),
            'value' => array(__('no border', 'hcode-addons') => '',
                             __('Dotted', 'hcode-addons') => 'dotted',
                             __('Dashed', 'hcode-addons') => 'dashed',
                             __('Solid', 'hcode-addons') => 'solid',
                             __('Double', 'hcode-addons') => 'double',
                            ),
            'dependency' => array( 'element' => 'hcode_row_border_position', 'value' => array('border-top','border-bottom') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Padding Setting?', 'hcode-addons'),
            'param_name' => 'padding_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_padding',
            'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_padding',
            'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
            'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_padding',
            'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_padding',
            'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Margin Setting?', 'hcode-addons'),
            'param_name' => 'margin_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
              'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_margin',
            'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_margin',
            'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
            'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_margin',
            'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_margin',
            'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_row_animation_style',
            'heading' => __('Animation Style', 'hcode-addons' ),
            'value' => hcode_animation_style(),
            'group' => 'Animation',
          ),
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,
      ),
  )
);

/*-----------------------------------------------------------------------------------*/
/* Vc_row change End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Vc_column change Start */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
      'name' => __( 'Column' , 'hcode-addons' ),
      'base' => 'vc_column',
      'description' => __( 'Place content elements inside the column', 'hcode-addons' ),
      'icon' => 'fa fa-columns h-code-shortcode-icon',
      'is_container' => true,
      'category' => 'H-Code',
      'js_view' => 'VcColumnView',
      'params' => array(
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Alignment Setting', 'hcode-addons'),
            'param_name' => 'alignment_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select Yes to set div in alignment of column', 'hcode-addons' ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_alignment',
            'heading' => __('Alignment (For Desktop Device)', 'hcode-addons' ),
            'value' => array(__('No Align', 'hcode-addons') => '',
                             __('Left Align', 'hcode-addons') => 'text-left',
                             __('Right Align', 'hcode-addons') => 'text-right',
                             __('Center Align', 'hcode-addons') => 'text-center',
                            ),
            'dependency' => array( 'element' => 'alignment_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_alignment',
            'heading' => __('Alignment (For iPad/Tablet Device)', 'hcode-addons' ),
            'value' => array(__('No Align', 'hcode-addons') => '',
                             __('Left Align', 'hcode-addons') => 'sm-text-left',
                             __('Right Align', 'hcode-addons') => 'sm-text-right',
                             __('Center Align', 'hcode-addons') => 'sm-text-center',
                            ),
            'dependency' => array( 'element' => 'alignment_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_alignment',
            'heading' => __('Alignment (For Mobile Device)', 'hcode-addons' ),
            'value' => array(__('No Align', 'hcode-addons') => '',
                             __('Left Align', 'hcode-addons') => 'xs-text-left',
                             __('Right Align', 'hcode-addons') => 'xs-text-right',
                             __('Center Align', 'hcode-addons') => 'xs-text-center',
                            ),
            'dependency' => array( 'element' => 'alignment_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Padding Setting?', 'hcode-addons'),
            'param_name' => 'padding_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_padding',
            'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_padding',
            'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
            'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_padding',
            'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_padding',
            'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Margin Setting?', 'hcode-addons'),
            'param_name' => 'margin_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_margin',
            'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_margin',
            'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
            'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_margin',
            'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_margin',
            'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Display Settings?', 'hcode-addons'),
            'param_name' => 'display_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_display',
            'heading' => __('Display Setting (For Desktop Device)', 'hcode-addons' ),
            'value' => array(__('Select Display Type', 'hcode-addons') => '',
                             __('Block', 'hcode-addons') => 'display-block',
                             __('Inline', 'hcode-addons') => 'display-inline',
                             __('Inline Block', 'hcode-addons') => 'display-inline-block',
                             __('None', 'hcode-addons') => 'display-none',
                            ),
            'dependency' => array( 'element' => 'display_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_display',
            'heading' => __('Display Setting (For iPad/Tablet Device)', 'hcode-addons' ),
            'value' => array(__('Select Display Type', 'hcode-addons') => '',
                             __('Block', 'hcode-addons') => 'sm-display-block',
                             __('Inline', 'hcode-addons') => 'sm-display-inline',
                             __('Inline Block', 'hcode-addons') => 'sm-display-inline-block',
                             __('None', 'hcode-addons') => 'sm-display-none',
                            ),
            'dependency' => array( 'element' => 'display_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_display',
            'heading' => __('Display Setting (For Mobile Device)', 'hcode-addons' ),
            'value' => array(__('Select Display Type', 'hcode-addons') => '',
                             __('Block', 'hcode-addons') => 'xs-display-block',
                             __('Inline', 'hcode-addons') => 'xs-display-inline',
                             __('Inline Block', 'hcode-addons') => 'xs-display-inline-block',
                             __('None', 'hcode-addons') => 'xs-display-none',
                            ),
            'dependency' => array( 'element' => 'display_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Centralized Div', 'hcode-addons'),
            'param_name' => 'centralized_div',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select Yes to show div in center of column', 'hcode-addons' ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Column with Clear both', 'hcode-addons'),
            'param_name' => 'clear_both',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select Yes to mark as clear both', 'hcode-addons' ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Column Pull Right', 'hcode-addons'),
            'param_name' => 'pull_right',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select yes to set float right', 'hcode-addons' ),
          ),
          array(
            'type' => 'textfield',
            'param_name' => 'min_height',
            'heading' => __('Set Min Height', 'hcode-addons' ),
            'value' => '',
            'description' => __( 'Define min height like 500px', 'hcode-addons' ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __('SM Width', 'hcode-addons' ),
            'param_name' => 'width',
            'value' => $hcode_vc_column,
            'group' => 'Responsive Options',
            'description' => 'Select column width',
          ),
          array(
            'type' => 'column_offset',
            'heading' => __('Responsiveness', 'hcode-addons' ),
            'param_name' => 'offset',
            'group' => 'Responsive Options',
            'description' => 'Adjust column for different screen sizes. Control width, offset and visibility settings.',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Column BackGround Color', 'hcode-addons' ),
            'param_name' => 'hcode_column_bg_color',
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_column_animation_style',
            'heading' => __('Animation Style', 'hcode-addons' ),
            'value' => hcode_animation_style(),
            'group' => 'Animation',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Animation Duration', 'hcode-addons' ),
            'param_name' => 'hcode_column_animation_duration',
            'dependency' => array( 'element' => 'hcode_column_animation_style', 'not_empty' => true ),
            'description' => __( 'Add duration like 300ms', 'hcode-addons' ),
            'group' => 'Animation',
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Fullscreen Class', 'hcode-addons'),
              'param_name' => 'fullscreen',
              'value' => array(__('NO', 'hcode-addons') => '0', 
                               __('YES', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select Yes to add (fullscreen) class in section', 'hcode-addons' ),
          ),
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,
      ),
  )
);

/*-----------------------------------------------------------------------------------*/
/* Vc_column change End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Vc_column change Start */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
      'name' => __( 'Inner Column' , 'hcode-addons' ),
      'base' => 'vc_column_inner',
      'description' => __( 'Place content elements inside the inner column', 'hcode-addons' ),
      'icon' => 'fa fa-columns h-code-shortcode-icon',
      'allowed_container_element' => false,
      'content_element' => false,
      'is_container' => true,
      'category' => 'H-Code',
      'js_view' => 'VcColumnView',
      'params' => array(
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Alignment Setting', 'hcode-addons'),
            'param_name' => 'alignment_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select Yes to set div in alignment of column', 'hcode-addons' ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_alignment',
            'heading' => __('Alignment (For Desktop Device)', 'hcode-addons' ),
            'value' => array(__('No Align', 'hcode-addons') => '',
                             __('Left Align', 'hcode-addons') => 'text-left',
                             __('Right Align', 'hcode-addons') => 'text-right',
                             __('Center Align', 'hcode-addons') => 'text-center',
                            ),
            'dependency' => array( 'element' => 'alignment_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_alignment',
            'heading' => __('Alignment (For iPad/Tablet Device)', 'hcode-addons' ),
            'value' => array(__('No Align', 'hcode-addons') => '',
                             __('Left Align', 'hcode-addons') => 'sm-text-left',
                             __('Right Align', 'hcode-addons') => 'sm-text-right',
                             __('Center Align', 'hcode-addons') => 'sm-text-center',
                            ),
            'dependency' => array( 'element' => 'alignment_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_alignment',
            'heading' => __('Alignment (For Mobile Device)', 'hcode-addons' ),
            'value' => array(__('No Align', 'hcode-addons') => '',
                             __('Left Align', 'hcode-addons') => 'xs-text-left',
                             __('Right Align', 'hcode-addons') => 'xs-text-right',
                             __('Center Align', 'hcode-addons') => 'xs-text-center',
                            ),
            'dependency' => array( 'element' => 'alignment_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Padding Setting?', 'hcode-addons'),
            'param_name' => 'padding_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_padding',
            'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_padding',
            'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
            'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_padding',
            'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_padding',
            'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Margin Setting?', 'hcode-addons'),
            'param_name' => 'margin_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_margin',
            'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_margin',
            'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
            'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_margin',
            'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_margin',
            'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Display Settings?', 'hcode-addons'),
            'param_name' => 'display_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_display',
            'heading' => __('Display Setting (For Desktop Device)', 'hcode-addons' ),
            'value' => array(__('Select Display Type', 'hcode-addons') => '',
                             __('Block', 'hcode-addons') => 'display-block',
                             __('Inline', 'hcode-addons') => 'display-inline',
                             __('Inline Block', 'hcode-addons') => 'display-inline-block',
                             __('None', 'hcode-addons') => 'display-none',
                            ),
            'dependency' => array( 'element' => 'display_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_display',
            'heading' => __('Display Setting (For iPad/Tablet Device)', 'hcode-addons' ),
            'value' => array(__('Select Display Type', 'hcode-addons') => '',
                             __('Block', 'hcode-addons') => 'sm-display-block',
                             __('Inline', 'hcode-addons') => 'sm-display-inline',
                             __('Inline Block', 'hcode-addons') => 'sm-display-inline-block',
                             __('None', 'hcode-addons') => 'sm-display-none',
                            ),
            'dependency' => array( 'element' => 'display_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_display',
            'heading' => __('Display Setting (For Mobile Device)', 'hcode-addons' ),
            'value' => array(__('Select Display Type', 'hcode-addons') => '',
                             __('Block', 'hcode-addons') => 'xs-display-block',
                             __('Inline', 'hcode-addons') => 'xs-display-inline',
                             __('Inline Block', 'hcode-addons') => 'xs-display-inline-block',
                             __('None', 'hcode-addons') => 'xs-display-none',
                            ),
            'dependency' => array( 'element' => 'display_setting', 'value' => array('1') ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Centralized Div', 'hcode-addons'),
            'param_name' => 'centralized_div',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select Yes to show div in center of column', 'hcode-addons' ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Column with Clear both', 'hcode-addons'),
            'param_name' => 'clear_both',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select Yes to mark as clear both', 'hcode-addons' ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Column Pull Right', 'hcode-addons'),
            'param_name' => 'pull_right',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select yes to set float right', 'hcode-addons' ),
          ),
          array(
            'type' => 'textfield',
            'param_name' => 'min_height',
            'heading' => __('Set Min Height', 'hcode-addons' ),
            'value' => '',
            'description' => __( 'Define min height like 500px', 'hcode-addons' ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __('SM Width', 'hcode-addons' ),
            'param_name' => 'width',
            'value' => $hcode_vc_column,
            'group' => 'Responsive Options',
            'description' => 'Select column width',
          ),
          array(
            'type' => 'column_offset',
            'heading' => __('Responsiveness', 'hcode-addons' ),
            'param_name' => 'offset',
            'group' => 'Responsive Options',
            'description' => 'Adjust column for different screen sizes. Control width, offset and visibility settings.',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Column BackGround Color', 'hcode-addons' ),
            'param_name' => 'hcode_column_bg_color',
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_column_animation_style',
            'heading' => __('Animation Style', 'hcode-addons' ),
            'value' => hcode_animation_style(),
            'group' => 'Animation',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Animation Duration', 'hcode-addons' ),
            'param_name' => 'hcode_column_animation_duration',
            'dependency' => array( 'element' => 'hcode_column_animation_style', 'not_empty' => true ),
            'description' => __( 'Add duration like 300ms', 'hcode-addons' ),
            'group' => 'Animation',
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Fullscreen Class', 'hcode-addons'),
              'param_name' => 'fullscreen',
              'value' => array(__('NO', 'hcode-addons') => '0', 
                               __('YES', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select Yes to add (fullscreen) class in section', 'hcode-addons' ),
          ),
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,
      ),
  )
);

/*-----------------------------------------------------------------------------------*/
/* Vc_column change End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Vc_column_text change Start */
/*-----------------------------------------------------------------------------------*/
vc_map( array(
  'name' => __( 'Text Block', 'hcode-addons' ),
  'base' => 'vc_column_text',
  'icon' => 'fa fa-text-width h-code-shortcode-icon',
  'wrapper_class' => 'clearfix',
  'category' => 'H-Code',
  'description' => __( 'A block of text with WYSIWYG editor', 'hcode-addons' ),
  'params' => array(
                  array(
                    'type' => 'textarea_html',
                    'holder' => 'div',
                    'heading' => __( 'Text', 'hcode-addons' ),
                    'param_name' => 'content',
                    'value' => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'hcode-addons' )
                  ),
                  array(
                    'type' => 'hcode_custom_switch_option',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => __('Required Padding Setting?', 'hcode-addons'),
                    'param_name' => 'padding_setting',
                    'value' => array(__('No', 'hcode-addons') => '0', 
                                     __('Yes', 'hcode-addons') => '1'
                                    ),
                    'group' => 'Style',
                  ),
                array(
                  'type' => 'dropdown',
                  'param_name' => 'desktop_padding',
                  'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
                  'value' => $hcode_desktop_padding,
                  'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
                  'group' => 'Style',
                ),
                array(
                  'type' => 'textfield',
                  'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
                  'param_name' => 'custom_desktop_padding',
                  'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
                  'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

                    'group' => 'Style',
                ),
                array(
                  'type' => 'dropdown',
                  'param_name' => 'ipad_padding',
                  'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
                  'value' => $hcode_ipad_padding,
                  'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
                    'group' => 'Style',
                ),
                array(
                  'type' => 'dropdown',
                  'param_name' => 'mobile_padding',
                  'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
                  'value' => $hcode_mobile_padding,
                  'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
                    'group' => 'Style',
                ),
                array(
                  'type' => 'hcode_custom_switch_option',
                  'holder' => 'div',
                  'class' => '',
                  'heading' => __('Required Margin Setting?', 'hcode-addons'),
                  'param_name' => 'margin_setting',
                  'value' => array(__('No', 'hcode-addons') => '0', 
                                   __('Yes', 'hcode-addons') => '1'
                                  ),
                    'group' => 'Style',
                ),
                array(
                  'type' => 'dropdown',
                  'param_name' => 'desktop_margin',
                  'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
                  'value' => $hcode_desktop_margin,
                  'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
                    'group' => 'Style',
                ),
                array(
                  'type' => 'textfield',
                  'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
                  'param_name' => 'custom_desktop_margin',
                  'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
                  'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
                    'group' => 'Style',
                ),
                array(
                  'type' => 'dropdown',
                  'param_name' => 'ipad_margin',
                  'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
                  'value' => $hcode_ipad_margin,
                  'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
                    'group' => 'Style',
                ),
                array(
                  'type' => 'dropdown',
                  'param_name' => 'mobile_margin',
                  'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
                  'value' => $hcode_mobile_margin,
                  'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
                    'group' => 'Style',
                ),
                $hcode_vc_extra_id,
                $hcode_vc_extra_class,
  )
) );
/*-----------------------------------------------------------------------------------*/
/* Vc_column_text change End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Main Slider Start */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
      'name' => __( 'Image Slider' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
      'base' => 'hcode_slider', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
      'description' => __( 'Place an image slider', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
      'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
      'as_parent' => array('only' => 'hcode_slide_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      'icon' => 'fa fa-picture-o h-code-shortcode-icon', //URL or CSS class with icon image.
      'js_view' => 'VcColumnView',
      'category' => 'H-Code',
      'params' => array( //List of shortcode attributes. Array which holds your shortcode params, these params will be editable in shortcode settings page
          array(
              'type' => 'dropdown',
              'heading' => __('Image Slider Style', 'hcode-addons'),
              'param_name' => 'slider_premade_style',
              'admin_label' => true,
              'value' => array(__('Select a Slider Style', 'hcode-addons') => '',
                               __('Slider Style 1 - Owl Carousel Full Screen', 'hcode-addons') => 'hcode-owl-slider1', 
                               __('Slider Style 2 - Owl Carousel Full Screen', 'hcode-addons') => 'hcode-owl-slider2', 
                               __('Slider Style 3 - Owl Carousel Full Screen', 'hcode-addons') => 'hcode-owl-slider3', 
                               __('Slider Style 4 - Owl Carousel Full Screen', 'hcode-addons') => 'hcode-owl-slider4', 
                               __('Slider Style 5 - Owl Carousel Half Screen', 'hcode-addons') => 'hcode-owl-slider5', 
                               __('Slider Style 6 - Owl Carousel Half Screen', 'hcode-addons') => 'hcode-owl-slider6',
                               __('Slider Style 7 - Owl Carousel Full Screen Background Slider', 'hcode-addons') => 'hcode-owl-slider7',
                               __('Slider Style 8 - Owl Carousel Full Screen', 'hcode-addons') => 'hcode-owl-slider8',
                               __('Slider Style 9 - Owl Carousel Half Screen', 'hcode-addons') => 'hcode-owl-slider9',
                               __('Slider Style 10 - Owl Carousel Full Screen Background Slider', 'hcode-addons') => 'hcode-owl-slider10',
                               __('Slider Style 11 - Owl Carousel Full Screen', 'hcode-addons') => 'hcode-owl-slider11',
                               __('Slider Style 12 - Owl Carousel Full Screen', 'hcode-addons') => 'hcode-owl-slider12',
                               __('Slider Style 13 - Owl Carousel Full Screen', 'hcode-addons') => 'hcode-owl-slider13',
                               __('Slider Style 14 - Owl Carousel Full Screen Background Slider', 'hcode-addons') => 'hcode-owl-slider14',
                               __('Slider Style 15 - Owl Carousel Full Screen', 'hcode-addons') => 'hcode-owl-slider15',
                               __('Slider Style 16 - Owl Carousel Half Screen', 'hcode-addons') => 'hcode-owl-slider16',
                               __('Slider Style 17 - Owl Carousel Fix Background', 'hcode-addons') => 'hcode-owl-slider17',
                               __('Slider Style 18 - Owl Carousel Full Screen', 'hcode-addons') => 'hcode-owl-slider18',
                               __('Slider Style 19 - Owl Carousel Full Screen image tag', 'hcode-addons') => 'hcode-owl-slider19',
                               __('Slider Style 20 - Owl Carousel Content slider', 'hcode-addons') => 'hcode-owl-slider20',
                               __('Slider Style 21 - Owl Carousel project page', 'hcode-addons') => 'hcode-owl-slider21',
                               __('Slider Style 22 - Owl Carousel project page Background Slider', 'hcode-addons') => 'hcode-owl-slider22',
                               __('Bootstrap Slider Style 1 - Bootstrap Full Screen', 'hcode-addons') => 'hcode-bootstrap-slider1',
                               __('Bootstrap Slider Style 2 - Bootstrap Full Screen', 'hcode-addons') => 'hcode-bootstrap-slider2',
                              ),
              'description' => __('Choose a pre-made Image Slider Style', 'hcode-addons'),
          ),
          array(
              'type' => 'hcode_preview_image',
              'heading' => __('Select pre-made style', 'hcode-addons'),
              'param_name' => 'slider_preview_image',
              'admin_label' => true,
              'value' => array(__('Slider image', 'hcode-addons') => '',
                               __('Slider image1', 'hcode-addons') => 'hcode-owl-slider1',
                               __('Slider image2', 'hcode-addons') => 'hcode-owl-slider2',
                               __('Slider image3', 'hcode-addons') => 'hcode-owl-slider3',
                               __('Slider image4', 'hcode-addons') => 'hcode-owl-slider4', 
                               __('Slider image5', 'hcode-addons') => 'hcode-owl-slider5', 
                               __('Slider image6', 'hcode-addons') => 'hcode-owl-slider6',
                               __('slider image7', 'hcode-addons') => 'hcode-owl-slider7',
                               __('slider image8', 'hcode-addons') => 'hcode-owl-slider8',
                               __('slider image9', 'hcode-addons') => 'hcode-owl-slider9',
                               __('slider image10', 'hcode-addons') => 'hcode-owl-slider10',
                               __('slider image11', 'hcode-addons') => 'hcode-owl-slider11',
                               __('slider image12', 'hcode-addons') => 'hcode-owl-slider12',
                               __('slider image13', 'hcode-addons') => 'hcode-owl-slider13',
                               __('slider image14', 'hcode-addons') => 'hcode-owl-slider14',
                               __('slider image15', 'hcode-addons') => 'hcode-owl-slider15',
                               __('slider image16', 'hcode-addons') => 'hcode-owl-slider16',
                               __('slider image17', 'hcode-addons') => 'hcode-owl-slider17',
                               __('slider image18', 'hcode-addons') => 'hcode-owl-slider18',
                               __('slider image19', 'hcode-addons') => 'hcode-owl-slider19',
                               __('slider image20', 'hcode-addons') => 'hcode-owl-slider20',
                               __('slider image21', 'hcode-addons') => 'hcode-owl-slider21',
                               __('slider image22', 'hcode-addons') => 'hcode-owl-slider22',
                               __('Bootstrap Slider image1', 'hcode-addons') => 'hcode-bootstrap-slider1', 
                               __('Bootstrap Slider image2', 'hcode-addons') => 'hcode-bootstrap-slider2',
                              ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Pagination', 'hcode-addons'),
                'param_name' => 'show_pagination',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
                'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider1','hcode-owl-slider2','hcode-owl-slider3','hcode-owl-slider4','hcode-owl-slider5','hcode-owl-slider6','hcode-owl-slider7','hcode-owl-slider8','hcode-owl-slider9','hcode-owl-slider10','hcode-owl-slider11','hcode-owl-slider12','hcode-owl-slider13','hcode-owl-slider14','hcode-owl-slider15','hcode-owl-slider16','hcode-owl-slider17','hcode-owl-slider18','hcode-owl-slider19','hcode-owl-slider20','hcode-owl-slider21','hcode-owl-slider22','hcode-bootstrap-slider1','hcode-bootstrap-slider2') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Style', 'hcode-addons'),
              'param_name' => 'show_pagination_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                               __('Dot Style', 'hcode-addons') => '0',
                               __('Line Style', 'hcode-addons') => '1',
                               __('Round Style', 'hcode-addons') => '2',
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Color Style', 'hcode-addons'),
              'param_name' => 'show_pagination_color_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                               __('Dark Style', 'hcode-addons') => '0',
                               __('Light Style', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Navigation', 'hcode-addons'),
                'param_name' => 'show_navigation',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
                'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider1','hcode-owl-slider2','hcode-owl-slider3','hcode-owl-slider4','hcode-owl-slider5','hcode-owl-slider6','hcode-owl-slider7','hcode-owl-slider8','hcode-owl-slider9','hcode-owl-slider10','hcode-owl-slider11','hcode-owl-slider12','hcode-owl-slider13','hcode-owl-slider14','hcode-owl-slider15','hcode-owl-slider16','hcode-owl-slider17','hcode-owl-slider18','hcode-owl-slider19','hcode-owl-slider20','hcode-owl-slider21','hcode-owl-slider22','hcode-bootstrap-slider1','hcode-bootstrap-slider2') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Navigation Style', 'hcode-addons'),
              'param_name' => 'show_navigation_style',
              'admin_label' => true,
              'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                               __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                               __('Next/Prev White Arrow', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Cursor Color Style', 'hcode-addons'),
              'param_name' => 'show_cursor_color_style',
              'admin_label' => true,
              'value' => array(__('Select Cursor Color Style', 'hcode-addons') => '',
                               __('White Cursor', 'hcode-addons') => 'white-cursor',
                               __('Black Cursor', 'hcode-addons') => 'black-cursor',
                               __('Default Cursor', 'hcode-addons') => 'no-cursor',
                              ),
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider1','hcode-owl-slider2','hcode-owl-slider3','hcode-owl-slider4','hcode-owl-slider5','hcode-owl-slider6','hcode-owl-slider7','hcode-owl-slider8','hcode-owl-slider9','hcode-owl-slider10','hcode-owl-slider11','hcode-owl-slider12','hcode-owl-slider13','hcode-owl-slider14','hcode-owl-slider15','hcode-owl-slider16','hcode-owl-slider17','hcode-owl-slider18','hcode-owl-slider19','hcode-owl-slider20','hcode-owl-slider21','hcode-owl-slider22','hcode-bootstrap-slider1','hcode-bootstrap-slider2') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Number Text', 'hcode-addons'),
              'param_name' => 'background_slide_number',
              'admin_label' => true,
              'value' => array(__('Please Select Number Text', 'hcode-addons')  => '',
                               __('01', 'hcode-addons')  => '1',
                               __('02', 'hcode-addons')  => '2',
                               __('03', 'hcode-addons')  => '3',
                               __('04', 'hcode-addons')  => '4',
                               __('05', 'hcode-addons')  => '5',
                               __('06', 'hcode-addons')  => '6',
                               __('07', 'hcode-addons')  => '7',
                               __('08', 'hcode-addons')  => '8',
                               __('09', 'hcode-addons')  => '9',
                               __('10', 'hcode-addons') => '10',

                               
                              ),
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider7','hcode-owl-slider22') ),
              'group' => 'Background Slider Data',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Title', 'hcode-addons'),
              'param_name' => 'background_slide_title',
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider7','hcode-owl-slider10','hcode-owl-slider14','hcode-owl-slider22') ),
              'group' => 'Background Slider Data',
          ),
          array(
              'type' => 'textarea',
              'heading' => __('Subtitle', 'hcode-addons'),
              'param_name' => 'background_slide_subtitle',
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider7','hcode-owl-slider14','hcode-owl-slider22') ),
              'group' => 'Background Slider Data',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Subtitle 2', 'hcode-addons'),
              'param_name' => 'background_slide_subtitle_text',
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider14','hcode-owl-slider22') ),
              'group' => 'Background Slider Data',
          ),
          array(
              'type' => 'textarea',
              'heading' => __('Content', 'hcode-addons'),
              'param_name' => 'hcode_slider_content',
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider22') ),
              'group' => 'Background Slider Data',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Specification Title 1', 'hcode-addons'),
              'param_name' => 'background_slide_title1',
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider22') ),
              'group' => 'Background Slider Data',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Specification Subtitle 1', 'hcode-addons'),
              'param_name' => 'background_slide_subtitle1',
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider22') ),
              'group' => 'Background Slider Data',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Specification Title 2', 'hcode-addons'),
              'param_name' => 'background_slide_title2',
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider22') ),
              'group' => 'Background Slider Data',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Specification Subtitle 2', 'hcode-addons'),
              'param_name' => 'background_slide_subtitle2',
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider22') ),
              'group' => 'Background Slider Data',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Specification Title 3', 'hcode-addons'),
              'param_name' => 'background_slide_title3',
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider22') ),
              'group' => 'Background Slider Data',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Specification Subtitle 3', 'hcode-addons'),
              'param_name' => 'background_slide_subtitle3',
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider22') ),
              'group' => 'Background Slider Data',
          ),
          array(
              'type' => 'attach_image',
              'heading' => __('Overlay Image', 'hcode-addons'),
              'param_name' => 'modeling_image',
              'holder' => 'div',
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider10') ),
              'group' => 'Background Slider Data',
          ),  
          
          array(
              'type' => 'dropdown',
              'heading' => __('Transition Style', 'hcode-addons'),
              'param_name' => 'transition_style',
              'admin_label' => true,
              'value' => array(__('Select Transition Style', 'hcode-addons') => '',
                               __('Slide Style', 'hcode-addons') => 'slide',
                               __('Fade Style', 'hcode-addons') => 'fade',
                               __('BackSlide Style', 'hcode-addons') => 'backSlide',
                               __('GoDown Style', 'hcode-addons') => 'goDown',
                               __('FadeUp Style', 'hcode-addons') => 'fadeUp'
                               
                              ),
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider1','hcode-owl-slider2','hcode-owl-slider3','hcode-owl-slider4','hcode-owl-slider5','hcode-owl-slider6','hcode-owl-slider7','hcode-owl-slider8','hcode-owl-slider9','hcode-owl-slider10','hcode-owl-slider11','hcode-owl-slider12','hcode-owl-slider13','hcode-owl-slider14','hcode-owl-slider15','hcode-owl-slider16','hcode-owl-slider17','hcode-owl-slider18','hcode-owl-slider19','hcode-owl-slider20','hcode-owl-slider21','hcode-owl-slider22') ),
              'group' => 'Slider Configuration',
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Autoplay', 'hcode-addons'),
                'param_name' => 'autoplay',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
                'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider1','hcode-owl-slider2','hcode-owl-slider3','hcode-owl-slider4','hcode-owl-slider5','hcode-owl-slider6','hcode-owl-slider7','hcode-owl-slider8','hcode-owl-slider9','hcode-owl-slider10','hcode-owl-slider11','hcode-owl-slider12','hcode-owl-slider13','hcode-owl-slider14','hcode-owl-slider15','hcode-owl-slider16','hcode-owl-slider17','hcode-owl-slider18','hcode-owl-slider19','hcode-owl-slider20','hcode-owl-slider21','hcode-owl-slider22','hcode-bootstrap-slider1','hcode-bootstrap-slider2') ),
                'group' => 'Slider Configuration',
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Stop On Hover', 'hcode-addons'),
                'param_name' => 'stoponhover',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
                'dependency'  => array( 'element' => 'autoplay', 'value' => array('1') ),
                'group' => 'Slider Configuration',
          ),
          
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Delay Time', 'hcode-addons'),
              'param_name' => 'slidespeed',
              'admin_label' => true,
              'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                               __('500', 'hcode-addons') => '500',
                               __('600', 'hcode-addons') => '600',
                               __('700', 'hcode-addons') => '700',
                               __('800', 'hcode-addons') => '800',
                               __('900', 'hcode-addons') => '900',
                               __('1000', 'hcode-addons') => '1000',
                               __('1100', 'hcode-addons') => '1100',
                               __('1200', 'hcode-addons') => '1200',
                               __('1300', 'hcode-addons') => '1300',
                               __('1400', 'hcode-addons') => '1400',
                               __('1500', 'hcode-addons') => '1500',
                               __('2000', 'hcode-addons') => '2000',
                               __('3000', 'hcode-addons') => '3000',
                               __('4000', 'hcode-addons') => '4000',
                               __('5000', 'hcode-addons') => '5000',
                               __('6000', 'hcode-addons') => '6000',
                               __('7000', 'hcode-addons') => '7000',
                               __('8000', 'hcode-addons') => '8000',
                               __('9000', 'hcode-addons') => '9000',
                               __('10000', 'hcode-addons') => '10000',
                              ),
              'std' => '3000',
              'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
              'dependency'  => array( 'element' => 'autoplay', 'value' => array('1') ),
              'group' => 'Slider Configuration',
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'heading' => __('Add Active Class', 'hcode-addons'),
              'param_name' => 'addclassactive',
              'admin_label' => true,
              'value' => array(__('False', 'hcode-addons') => '0', 
                               __('True', 'hcode-addons') => '1'
                              ),
              'description' => __('Select TRUE to add active class', 'hcode-addons'),
              'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider1','hcode-owl-slider2','hcode-owl-slider3','hcode-owl-slider4','hcode-owl-slider5','hcode-owl-slider6','hcode-owl-slider7','hcode-owl-slider8','hcode-owl-slider9','hcode-owl-slider10','hcode-owl-slider11','hcode-owl-slider12','hcode-owl-slider13','hcode-owl-slider14','hcode-owl-slider15','hcode-owl-slider16','hcode-owl-slider17','hcode-owl-slider18','hcode-owl-slider19','hcode-owl-slider20','hcode-owl-slider21','hcode-owl-slider22') ),
              'group' => 'Slider Configuration',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Color', 'hcode-addons' ),
            'param_name' => 'background_slide_title_color',
            'description' => __( 'Choose Title Color', 'hcode-addons' ),
            'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider7','hcode-owl-slider10','hcode-owl-slider14','hcode-owl-slider22') ),
            'group' => 'Color',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Subtitle Color', 'hcode-addons' ),
            'param_name' => 'background_slide_subtitle_color',
            'description' => __( 'Choose Subtitle Color', 'hcode-addons' ),
            'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider7','hcode-owl-slider14','hcode-owl-slider22') ),
            'group' => 'Color',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Background Color', 'hcode-addons' ),
            'param_name' => 'background_slide_bg_color',
            'description' => __( 'Choose Background Color', 'hcode-addons' ),
            'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider10', 'hcode-owl-slider22') ),
            'group' => 'Color',
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider ID', 'hcode-addons' ),
             'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
             'param_name'  => 'hcode_slider_id',
             'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider1','hcode-owl-slider2','hcode-owl-slider3','hcode-owl-slider4','hcode-owl-slider5','hcode-owl-slider6','hcode-owl-slider7','hcode-owl-slider8','hcode-owl-slider9','hcode-owl-slider10','hcode-owl-slider11','hcode-owl-slider12','hcode-owl-slider13','hcode-owl-slider14','hcode-owl-slider15','hcode-owl-slider16','hcode-owl-slider17','hcode-owl-slider18','hcode-owl-slider19','hcode-owl-slider20','hcode-owl-slider21','hcode-owl-slider22','hcode-bootstrap-slider1','hcode-bootstrap-slider2') ),
             'group'       => 'Slider ID & Class'
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider Extra Class', 'hcode-addons' ),
             'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
             'param_name'  => 'hcode_slider_class',
             'dependency' => array( 'element' => 'slider_premade_style', 'value' => array('hcode-owl-slider1','hcode-owl-slider2','hcode-owl-slider3','hcode-owl-slider4','hcode-owl-slider5','hcode-owl-slider6','hcode-owl-slider7','hcode-owl-slider8','hcode-owl-slider9','hcode-owl-slider10','hcode-owl-slider11','hcode-owl-slider12','hcode-owl-slider13','hcode-owl-slider14','hcode-owl-slider15','hcode-owl-slider16','hcode-owl-slider17','hcode-owl-slider18','hcode-owl-slider19','hcode-owl-slider20','hcode-owl-slider21','hcode-owl-slider22','hcode-bootstrap-slider1','hcode-bootstrap-slider2') ),
             'group'       => 'Slider ID & Class'
          ),
      ),
  )
);
vc_map( 
  array(
      'name' => __('Add Slide', 'hcode-addons'),
      'base' => 'hcode_slide_content',
      'description' => __( 'A slide for the image slider', 'hcode-addons' ),
      'as_child' => array('only' => 'hcode_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
      'icon' => 'fa fa-picture-o h-code-shortcode-icon', //URL or CSS class with icon image.
      'params' => array(
          array(
              'type' => 'attach_image',
              'heading' => __('Slide Image', 'hcode-addons'),
              'param_name' => 'image',
              'holder' => 'div'
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Title', 'hcode-addons'),
              'param_name' => 'title',
              'description' => __('Notes: It will only apply if your selected image slider style contains the title', 'hcode-addons'),
          ),
          array(
              'type' => 'textarea_html',
              'heading' => __('Content', 'hcode-addons'),
              'param_name' => 'content',
              'description' => __('Notes: It will only apply if your selected image slider style contains the content', 'hcode-addons'),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Choose Button', 'hcode-addons'),
              'param_name' => 'no_button',
              'admin_label' => true,
              'value' => array(__('No Button', 'hcode-addons') => 'nobutton',
                               __('One Button', 'hcode-addons') => 'singlebutton',
                               __('Two Buttons', 'hcode-addons') => 'twobutton',
                              ),
              'description' => __('Hide/show buttons in slide (Notes: It will only apply if your selected image slider style contains the button)', 'hcode-addons'),
          ),
          array(
            'type'        => 'vc_link',
            'heading'     => __('Button 1 Configuration', 'hcode-addons' ),
            'param_name'  => 'first_button_config',
            'admin_label' => true,
            'dependency'  => array( 'element' => 'no_button', 'value' => array('singlebutton','twobutton') ),
          ),

          array(
            'type'        => 'vc_link',
            'heading'     => __('Button 2 Configuration', 'hcode-addons' ),
            'param_name'  => 'second_button_config',
            'admin_label' => true,
            'dependency'  => array( 'element' => 'no_button', 'value' => array('twobutton') ),
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Color', 'hcode-addons' ),
            'param_name' => 'hcode_title_color',
            'description' => __( 'Choose Title Color', 'hcode-addons' ),
            'group' => 'Color',
          ),
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,

        ),
    ) 
);
/* Main Slider class*/
if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_slider extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_slide_content extends WPBakeryShortCode { }
}

/*-----------------------------------------------------------------------------------*/
/* Main Slider End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Content Slider Start */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
      'name' => __( 'Content Slider' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
      'base' => 'hcode_content_slider', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
      'description' => __( 'Place a content slider', 'hcode-addons' ), //Short description of your element, it will be visible in "Add element" window
      'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
      'as_parent' => array('only' => 'hcode_special_slide_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      'icon' => 'fa fa-align-center h-code-shortcode-icon', //URL or CSS class with icon image.
      'js_view' => 'VcColumnView',
      'category' => 'H-Code',
      'params' => array( //List of shortcode attributes. Array which holds your shortcode params, these params will be editable in shortcode settings page
          array(
              'type' => 'dropdown',
              'heading' => __('Content Slider Style', 'hcode-addons'),
              'param_name' => 'slider_content_premade_style',
              'admin_label' => true,
              'value' => array(__('Select a Content Slider Style', 'hcode-addons') => '',
                               __('Owl Carousel Content Slider Style 1', 'hcode-addons') => 'hcode-owl-content-slider1', 
                               __('Bootstrap Content Slider Style 1', 'hcode-addons') => 'hcode-bootstrap-content-slider1',
                               __('Spa Case Study', 'hcode-addons') => 'hcode-bootstrap-content-slider2',
                               __('Agency Case Study', 'hcode-addons') => 'hcode-bootstrap-content-slider3',
                              ),
              'description' => __('Choose a pre-made content slider style', 'hcode-addons'),
          ),
          array(
              'type' => 'hcode_preview_image',
              'heading' => __('Select pre-made style', 'hcode-addons'),
              'param_name' => 'slider_content_preview_image',
              'admin_label' => true,
              'value' => array(__('Slider image', 'hcode-addons') => '',
                               __('Owl Carousel Content Slider image1', 'hcode-addons') => 'hcode-owl-content-slider1',
                               __('Bootstrap Content Slider image1', 'hcode-addons') => 'hcode-bootstrap-content-slider1',
                               __('Bootstrap Content Slider image2', 'hcode-addons') => 'hcode-bootstrap-content-slider2',
                               __('Bootstrap Content Slider image3', 'hcode-addons') => 'hcode-bootstrap-content-slider3',
                              ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Pagination', 'hcode-addons'),
                'param_name' => 'show_pagination',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
                'dependency' => array( 'element' => 'slider_content_premade_style', 'value' => array('hcode-owl-content-slider1','hcode-bootstrap-content-slider1','hcode-bootstrap-content-slider2','hcode-bootstrap-content-slider3') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Style', 'hcode-addons'),
              'param_name' => 'show_pagination_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                               __('Dot Style', 'hcode-addons') => '0',
                               __('Line Style', 'hcode-addons') => '1',
                               __('Round Style', 'hcode-addons') => '2',
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Color Style', 'hcode-addons'),
              'param_name' => 'show_pagination_color_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                               __('Dark Style', 'hcode-addons') => '0',
                               __('Light Style', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Navigation', 'hcode-addons'),
                'param_name' => 'show_navigation',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
                'dependency' => array( 'element' => 'slider_content_premade_style', 'value' => array('hcode-owl-content-slider1','hcode-bootstrap-content-slider1','hcode-bootstrap-content-slider2','hcode-bootstrap-content-slider3') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Navigation Style', 'hcode-addons'),
              'param_name' => 'show_navigation_style',
              'admin_label' => true,
              'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                               __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                               __('Next/Prev White Arrow', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Cursor Color Style', 'hcode-addons'),
              'param_name' => 'show_cursor_color_style',
              'admin_label' => true,
              'value' => array(__('Select Cursor Color Style', 'hcode-addons') => '',
                               __('White Cursor', 'hcode-addons') => 'white-cursor',
                               __('Black Cursor', 'hcode-addons') => 'black-cursor',
                               __('Default Cursor', 'hcode-addons') => 'no-cursor',
                              ),
              'dependency' => array( 'element' => 'slider_content_premade_style', 'value' => array('hcode-owl-content-slider1') ),
          ),       
          array(
              'type' => 'dropdown',
              'heading' => __('Transition Style', 'hcode-addons'),
              'param_name' => 'transition_style',
              'admin_label' => true,
              'value' => array(__('Select Transition Style', 'hcode-addons') => '',
                               __('Slide Style', 'hcode-addons') => 'slide',
                               __('Fade Style', 'hcode-addons') => 'fade',
                               __('BackSlide Style', 'hcode-addons') => 'backSlide',
                               __('GoDown Style', 'hcode-addons') => 'goDown',
                               __('FadeUp Style', 'hcode-addons') => 'fadeUp'
                               
                              ),
              'dependency' => array( 'element' => 'slider_content_premade_style', 'value' => array('hcode-owl-content-slider1') ),
              'group' => 'Slider Configuration',
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Autoplay', 'hcode-addons'),
                'param_name' => 'autoplay',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
                'dependency' => array( 'element' => 'slider_content_premade_style', 'value' => array('hcode-owl-content-slider1','hcode-bootstrap-content-slider1','hcode-bootstrap-content-slider2','hcode-bootstrap-content-slider3') ),
                'group' => 'Slider Configuration',
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Stop On Hover', 'hcode-addons'),
                'param_name' => 'stoponhover',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
                'dependency'  => array( 'element' => 'autoplay', 'value' => array('1') ),
                'group' => 'Slider Configuration',
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Delay Time', 'hcode-addons'),
              'param_name' => 'slidespeed',
              'admin_label' => true,
              'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                               __('500', 'hcode-addons') => '500',
                               __('600', 'hcode-addons') => '600',
                               __('700', 'hcode-addons') => '700',
                               __('800', 'hcode-addons') => '800',
                               __('900', 'hcode-addons') => '900',
                               __('1000', 'hcode-addons') => '1000',
                               __('1100', 'hcode-addons') => '1100',
                               __('1200', 'hcode-addons') => '1200',
                               __('1300', 'hcode-addons') => '1300',
                               __('1400', 'hcode-addons') => '1400',
                               __('1500', 'hcode-addons') => '1500',
                               __('2000', 'hcode-addons') => '2000',
                               __('3000', 'hcode-addons') => '3000',
                               __('4000', 'hcode-addons') => '4000',
                               __('5000', 'hcode-addons') => '5000',
                               __('6000', 'hcode-addons') => '6000',
                               __('7000', 'hcode-addons') => '7000',
                               __('8000', 'hcode-addons') => '8000',
                               __('9000', 'hcode-addons') => '9000',
                               __('10000', 'hcode-addons') => '10000',
                              ),
              'std' => '3000',
              'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
               'dependency'  => array( 'element' => 'autoplay', 'value' => array('1') ),
              'group' => 'Slider Configuration',
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'heading' => __('Add Active Class', 'hcode-addons'),
              'param_name' => 'addclassactive',
              'admin_label' => true,
              'value' => array(__('False', 'hcode-addons') => '0', 
                               __('True', 'hcode-addons') => '1'
                              ),
              'description' => __('Select TRUE to add active class', 'hcode-addons'),
              'dependency' => array( 'element' => 'slider_content_premade_style', 'value' => array('hcode-owl-content-slider1') ),
              'group' => 'Slider Configuration',
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider ID', 'hcode-addons' ),
             'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
             'param_name'  => 'hcode_slider_id',
             'dependency' => array( 'element' => 'slider_content_premade_style', 'value' => array('hcode-owl-content-slider1','hcode-bootstrap-content-slider1','hcode-bootstrap-content-slider2','hcode-bootstrap-content-slider3') ),
             'group'       => 'Slider ID & Class'
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider Extra Class', 'hcode-addons' ),
             'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
             'param_name'  => 'hcode_slider_class',
             'dependency' => array( 'element' => 'slider_content_premade_style', 'value' => array('hcode-owl-content-slider1','hcode-bootstrap-content-slider1','hcode-bootstrap-content-slider2','hcode-bootstrap-content-slider3') ),
             'group'       => 'Slider ID & Class'
          ),
      ),
  )
);
vc_map( 
  array(
      'name' => __('Add Slide', 'hcode-addons'),
      'base' => 'hcode_special_slide_content',
      'description' => __( 'A slide for the content slider.', 'hcode-addons' ),
      'as_child' => array('only' => 'hcode_content_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
      'icon' => 'fa fa-align-center h-code-shortcode-icon', //URL or CSS class with icon image.
      'params' => array(
          array(
              'type' => 'attach_image',
              'heading' => __('Background Slide Image', 'hcode-addons'),
              'param_name' => 'hcode_content_slider_image',
              'holder' => 'div'
          ),
          array(
              'type' => 'attach_image',
              'heading' => __('Discount Image', 'hcode-addons'),
              'param_name' => 'hcode_content_discount_image',
              'holder' => 'div',
              'description' => __( 'Work only for Spa Case Study Slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Number', 'hcode-addons'),
              'param_name' => 'hcode_content_slider_number',
              'description' => __('Number will not apply for Spa Case Study Slider', 'hcode-addons'),
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Title', 'hcode-addons'),
              'param_name' => 'hcode_content_slider_title'
          ),
          array(
              'type' => 'textfield',
              'heading' => __('SubTitle', 'hcode-addons'),
              'param_name' => 'hcode_content_slider_subtitle'
          ),
          array(
              'type' => 'textarea_html',
              'heading' => __('Content', 'hcode-addons'),
              'param_name' => 'content'
          ),
          array(
            'type'        => 'vc_link',
            'heading'     => __('Button config', 'hcode-addons' ),
            'param_name'  => 'button_config',
            'admin_label' => true,
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Number Color', 'hcode-addons' ),
            'param_name' => 'number_color',
            'group' => 'Configuration',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Color', 'hcode-addons' ),
            'param_name' => 'title_color',
            'group' => 'Configuration',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Subtitle Color', 'hcode-addons' ),
            'param_name' => 'subtitle_color',
            'group' => 'Configuration',
          ),
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,
        ),
    ) 
);
/* Content Slider class*/
if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_content_slider extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_special_slide_content extends WPBakeryShortCode { }
}

/*-----------------------------------------------------------------------------------*/
/* Content Slider End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Counter And Skills Start */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
    'name' => __('Counter & Skills', 'hcode-addons'),
    'base' => 'hcode_counter_or_skill',
    'category' => 'H-Code',
    'description' => __( 'Place a counter & skills', 'hcode-addons' ),
    'icon' => 'fa fa-clock-o h-code-shortcode-icon', //URL or CSS class with icon image.
    'params' => array(
      array(
          'type' => 'dropdown',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Counter or Skill', 'hcode-addons'),
          'param_name' => 'counter_or_chart',
          'value' => array(__('Select Counter or Skill', 'hcode-addons') => '',
                           __('Counter', 'hcode-addons') => 'counter',
                           __('Skill', 'hcode-addons') => 'skill',
                          ),
      ),
      array(
          'type' => 'hcode_preview_image',
          'heading' => __('Select pre-made style', 'hcode-addons'),
          'param_name' => 'hcode_counter_skill_preview_image',
          'admin_label' => true,
           'value' => array(__('Select Counter or Skill', 'hcode-addons') => '',
                           __('Counter', 'hcode-addons') => 'counter',
                           __('Skill', 'hcode-addons') => 'skill',
                          ),
      ),
      array(
          'type' => 'hcode_icon',
          'heading' => __('Select Counter Icon', 'hcode-addons'),
          'param_name' => 'counter_icon',
          'admin_label' => true,
          'value' => '',
          'dependency'  => array( 'element' => 'counter_or_chart', 'value' => array('counter') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Percentage', 'hcode-addons'),
          'param_name' => 'skill_percent',
          'admin_label' => true,
          'dependency'  => array( 'element' => 'counter_or_chart', 'value' => array('skill') ),
          'description' => __( 'Percentage, add numeric value only like 75 for 75%', 'hcode-addons' ),

      ),
      array(
          'type' => 'textfield',
          'heading' => __('Counter Number', 'hcode-addons'),
          'param_name' => 'counter_number',
          'admin_label' => true,
          'dependency'  => array( 'element' => 'counter_or_chart', 'value' => array('counter') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Title', 'hcode-addons'),
          'param_name' => 'title',
          'admin_label' => true,
          'dependency'  => array( 'element' => 'counter_or_chart', 'value' => array('skill', 'counter') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Subtitle', 'hcode-addons'),
          'param_name' => 'subtitle',
          'admin_label' => true,
          'dependency'  => array( 'element' => 'counter_or_chart', 'value' => array('skill') ),
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Counter Number style', 'hcode-addons'),
        'param_name' => 'counter_number_style',
        'admin_label' => true,
        'value' => array(__('Default', 'hcode-addons') => '',
                         __('White', 'hcode-addons') => 'white-text',
                         __('Black', 'hcode-addons') => 'black-text',
                         __('Custom Color', 'hcode-addons') => 'custom',
                        ),
        'dependency' => array( 'element' => 'counter_or_chart', 'value' => array('counter') ),
        'group' => 'Configuration',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Counter Number Color', 'hcode-addons' ),
        'param_name' => 'counter_number_color',
        'dependency' => array( 'element' => 'counter_number_style', 'value' => array('custom') ),
        'description' => __( 'Specify counter number color', 'hcode-addons' ),
        'group' => 'Configuration',
      ),
      array(
          'type' => 'dropdown',
          'heading' => __('Icon Size', 'hcode-addons'),
          'param_name' => 'counter_icon_size',
          'admin_label' => true,
          'value' => array(__('Default', 'hcode-addons') => '',
                           __('Extra Large', 'hcode-addons') => 'extra-large-icon', 
                           __('Large', 'hcode-addons') => 'large-icon',
                           __('Medium', 'hcode-addons') => 'medium-icon',
                           __('Small', 'hcode-addons') => 'small-icon',
                           __('Extra Small', 'hcode-addons') => 'extra-small-icon',
                          ),
          'dependency' => array( 'element' => 'counter_or_chart', 'value' => array('counter') ),
          'group' => 'Configuration',
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Title Style', 'hcode-addons'),
        'param_name' => 'title_style',
        'admin_label' => true,
        'value' => array(__('Default', 'hcode-addons') => '',
                         __('White', 'hcode-addons') => 'white-text',
                         __('Black', 'hcode-addons') => 'black-text',
                         __('Custom Color', 'hcode-addons') => 'custom',
                        ),
        'dependency' => array( 'element' => 'counter_or_chart', 'value' => array('counter','skill') ),
        'group' => 'Configuration',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Title Color', 'hcode-addons' ),
        'param_name' => 'title_color',
        'dependency' => array( 'element' => 'title_style', 'value' => array('custom') ),
        'description' => __( 'Specify title color', 'hcode-addons' ),
        'group' => 'Configuration',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Icon Color', 'hcode-addons' ),
        'param_name' => 'icon_color',
        'dependency' => array( 'element' => 'counter_or_chart', 'value' => array('counter') ),
        'group' => 'Configuration',
      ),
      array(
          'type' => 'dropdown',
          'heading' => __('Animation Duration Time', 'hcode-addons'),
          'param_name' => 'counter_animation_duration',
          'admin_label' => true,
          'value' => array(__('Default', 'hcode-addons') => '',
                           __('100ms', 'hcode-addons') => '100', 
                           __('200ms', 'hcode-addons') => '200',
                           __('300ms', 'hcode-addons') => '300',
                           __('400ms', 'hcode-addons') => '400',
                           __('500ms', 'hcode-addons') => '500',
                          ),
          'dependency' => array( 'element' => 'counter_or_chart', 'value' => array('counter') ),
          'group' => 'Animation',
      ),
      /* Skill settings */
      array(
        'type' => 'dropdown',
        'heading' => __('Percentage Style', 'hcode-addons'),
        'param_name' => 'skill_percent_style',
        'admin_label' => true,
        'value' => array(__('Default', 'hcode-addons') => '',
                         __('White', 'hcode-addons') => 'white-text',
                         __('Black', 'hcode-addons') => 'black-text',
                         __('Custom Color', 'hcode-addons') => 'custom',
                        ),
        'dependency' => array( 'element' => 'counter_or_chart', 'value' => array('skill') ),
        'group' => 'Configuration',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Percentage Color', 'hcode-addons' ),
        'param_name' => 'skill_percent_color',
        'dependency' => array( 'element' => 'skill_percent_style', 'value' => array('custom') ),
        'group' => 'Configuration',
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Line Width', 'hcode-addons'),
        'param_name' => 'skill_line_width',
        'admin_label' => true,
        'dependency'  => array( 'element' => 'counter_or_chart', 'value' => array('skill') ),
        'description' => __( 'Specify line width eg. 2', 'hcode-addons' ),
        'group' => 'Configuration',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Bar Color', 'hcode-addons' ),
        'param_name' => 'skill_barcolor_color',
        'dependency' => array( 'element' => 'counter_or_chart', 'value' => array('skill') ),
        'group' => 'Configuration',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Track Color', 'hcode-addons' ),
        'param_name' => 'skill_trackcolor_color',
        'dependency' => array( 'element' => 'counter_or_chart', 'value' => array('skill') ),
        'group' => 'Configuration',
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Animation Duration Time', 'hcode-addons'),
        'param_name' => 'animate_duration',
        'admin_label' => true,
        'value' => array(__('Select Animation Duration Time', 'hcode-addons') => '',
                         __('1000', 'hcode-addons') => '1000',
                         __('2000', 'hcode-addons') => '2000',
                        __('3000', 'hcode-addons') => '3000',
                        __('4000', 'hcode-addons') => '4000',
                        __('5000', 'hcode-addons') => '5000',
                        __('6000', 'hcode-addons') => '6000',
                        __('7000', 'hcode-addons') => '7000',
                        __('8000', 'hcode-addons') => '8000',
                        __('9000', 'hcode-addons') => '9000',
                        __('10000', 'hcode-addons') => '10000',
                        ),
        'description' => __('Select animation duration time (1s = 1000)', 'hcode-addons'),
        'dependency' => array( 'element' => 'counter_or_chart', 'value' => array('skill') ),
        'std' => '2000',
        'group' => 'Animation',
      ),
      $hcode_vc_extra_id,
      $hcode_vc_extra_class,
    ),
  ) 
);
/*-----------------------------------------------------------------------------------*/
/* Counter And Skills End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Alert Massage Start */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
    'name' => __('Alert Message', 'hcode-addons'),
    'base' => 'hcode_alert_massage',
    'category' => 'H-Code',
    'description' => __( 'Create an alert message', 'hcode-addons' ),
    'icon' => 'fa fa-exclamation-triangle h-code-shortcode-icon', //URL or CSS class with icon image.
    'params' => array(
    array(
      'type' => 'dropdown',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Alert Message Style', 'hcode-addons'),
        'param_name' => 'hcode_alert_massage_premade_style',
        'value' => array(__('Select Alert Message Style', 'hcode-addons') => '',
                 __('Select Alert Style1', 'hcode-addons') => 'alert-massage-style-1',
                         __('Select Alert Style2', 'hcode-addons') => 'alert-massage-style-2',
                         __('Select Alert Style3', 'hcode-addons') => 'alert-massage-style-3',
                         __('Select Alert Style4', 'hcode-addons') => 'alert-massage-style-4',
                         __('Select Alert Style5', 'hcode-addons') => 'alert-massage-style-5',
                         __('Select Alert Style6', 'hcode-addons') => 'alert-massage-style-6',
                         __('Select Alert Style7', 'hcode-addons') => 'alert-massage-style-7',
                         __('Select Alert Style8', 'hcode-addons') => 'alert-massage-style-8',
                      ),
    ),
    array(
          'type' => 'hcode_preview_image',
          'heading' => __('Style for tab', 'hcode-addons'),
          'param_name' => 'alert_massage_preview_image',
          'admin_label' => true,
          'value' => array(__('Alert image', 'hcode-addons') => '',
                           __('Alert image1', 'hcode-addons') => 'alert-massage-style-1',
                           __('Alert image2', 'hcode-addons') => 'alert-massage-style-2',
                           __('Alert image3', 'hcode-addons') => 'alert-massage-style-3',
                           __('Alert image4', 'hcode-addons') => 'alert-massage-style-4',
                           __('Alert image5', 'hcode-addons') => 'alert-massage-style-5',
                           __('Alert image6', 'hcode-addons') => 'alert-massage-style-6',
                           __('Alert image7', 'hcode-addons') => 'alert-massage-style-7',
                           __('Alert image8', 'hcode-addons') => 'alert-massage-style-8',
                          ),
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Alert Message Type', 'hcode-addons'),
        'param_name' => 'hcode_alert_massage_type',
        'admin_label' => true,
        'value' => array(__('Select Alert Message Type', 'hcode-addons') => '',
                 __('Success Message', 'hcode-addons') => 'success',
                         __('Info Message', 'hcode-addons') => 'info',
                         __('Warning Message', 'hcode-addons') => 'warning',
                         __('Danger Message', 'hcode-addons') => 'danger',
                        ),
      'dependency'  => array( 'element' => 'hcode_alert_massage_premade_style', 'value' => array('alert-massage-style-1','alert-massage-style-2','alert-massage-style-3','alert-massage-style-4','alert-massage-style-5','alert-massage-style-6','alert-massage-style-7','alert-massage-style-8')),
    ),
    array(
      'type' => 'hcode_icon',
        'heading' => __('Select Icon', 'hcode-addons'),
        'param_name' => 'hcode_message_icon',
        'admin_label' => true,
        'dependency'  => array( 'element' => 'hcode_alert_massage_premade_style', 'value' => array('alert-massage-style-1','alert-massage-style-2','alert-massage-style-3')),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Title (Highlighted in bold)', 'hcode-addons'),
        'param_name' => 'hcode_highliget_title',
        'admin_label' => true,
        'dependency'  => array( 'element' => 'hcode_alert_massage_premade_style', 'value' => array('alert-massage-style-1','alert-massage-style-2','alert-massage-style-3','alert-massage-style-4','alert-massage-style-5','alert-massage-style-6','alert-massage-style-7','alert-massage-style-8')),
    ),
    array(
        'type' => 'textarea',
        'heading' => __('Subtitle', 'hcode-addons'),
        'param_name' => 'hcode_subtitle',
        'admin_label' => true,
        'dependency'  => array( 'element' => 'hcode_alert_massage_premade_style', 'value' => array('alert-massage-style-1','alert-massage-style-2','alert-massage-style-3','alert-massage-style-4','alert-massage-style-5','alert-massage-style-6','alert-massage-style-7','alert-massage-style-8')),
    ),
    array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Close Button', 'hcode-addons'),
          'param_name' => 'show_close_button',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
          'description' => __( 'Select YES to show close button in Message', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'hcode_alert_massage_premade_style', 'value' => array('alert-massage-style-2','alert-massage-style-3','alert-massage-style-4','alert-massage-style-5','alert-massage-style-6','alert-massage-style-7','alert-massage-style-8')),
    ),
    $hcode_vc_extra_id,
    $hcode_vc_extra_class,
    ),
  ) 
);

/*-----------------------------------------------------------------------------------*/
/* Alert Massage End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Icons Start */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
    'name' => __('Font Icons', 'hcode-addons'),
    'base' => 'hcode_font_icons',
    'category' => 'H-Code',
    'description' => __( 'Add font awesome/et-line icons', 'hcode-addons' ),
    'icon' => 'fa fa-flag h-code-shortcode-icon', //URL or CSS class with icon image.
    'params' => array(
        array(
            'type' => 'dropdown',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Font Icon Type', 'hcode-addons'),
            'param_name' => 'hcode_font_icon_type',
            'value' => array(__('Select Font Icon Type', 'hcode-addons') => '',
                     __('Font Awesome Icons', 'hcode-addons') => 'hcode_font_awesome_icons',
                             __('Et-line Icons', 'hcode-addons') => 'hcode_et_line_icons',
                            ),
        ),
        array(
            'type' => 'dropdown',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Font Awesome Style', 'hcode-addons'),
            'param_name' => 'hcode_font_icon_premade_style',
            'value' => array(__('Select Font Awesome style', 'hcode-addons') => '',
                     __('Font Style1', 'hcode-addons') => 'font-awesome-icons-1',
                             __('Font Style2', 'hcode-addons') => 'font-awesome-icons-2',
                             __('Font Style3', 'hcode-addons') => 'font-awesome-icons-3',
                             __('Font Style4', 'hcode-addons') => 'font-awesome-icons-4',
                             __('Font Style5', 'hcode-addons') => 'font-awesome-icons-5',
                          ),
            'dependency'  => array( 'element' => 'hcode_font_icon_type', 'value' => array('hcode_font_awesome_icons')),
        ),
        array(
            'type' => 'hcode_preview_image',
            'heading' => __('Select pre-made style for tab', 'hcode-addons'),
            'param_name' => 'hcode_font_icon_preview_image',
            'admin_label' => true,
            'value' => array(__('Font image', 'hcode-addons') => '',
                             __('Font image1', 'hcode-addons') => 'font-awesome-icons-1',
                             __('Font image2', 'hcode-addons') => 'font-awesome-icons-2',
                             __('Font image3', 'hcode-addons') => 'font-awesome-icons-3',
                             __('Font image4', 'hcode-addons') => 'font-awesome-icons-4',
                             __('Font image5', 'hcode-addons') => 'font-awesome-icons-5',
                            ),
            'dependency'  => array( 'element' => 'hcode_font_icon_type', 'value' => array('hcode_font_awesome_icons')),
        ),
        array(
            'type' => 'dropdown',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Et-Line Style', 'hcode-addons'),
            'param_name' => 'hcode_et_icon_premade_style',
            'value' => array(__('Select Et-Line Style', 'hcode-addons') => '',
                     __('Font Style1', 'hcode-addons') => 'et-line-icons-1',
                             __('Font Style2', 'hcode-addons') => 'et-line-icons-2',
                             __('Font Style3', 'hcode-addons') => 'et-line-icons-3',
                             __('Font Style4', 'hcode-addons') => 'et-line-icons-4',
                             __('Font Style5', 'hcode-addons') => 'et-line-icons-5',
                             __('Font Style6', 'hcode-addons') => 'et-line-icons-6',
                             __('Font Style7', 'hcode-addons') => 'et-line-icons-7',
                             __('Font Style8', 'hcode-addons') => 'et-line-icons-8',
                             __('Font Style9', 'hcode-addons') => 'et-line-icons-9',
                             __('Font Style10', 'hcode-addons') => 'et-line-icons-10',
                             __('Font Style11', 'hcode-addons') => 'et-line-icons-11',
                             __('Font Style12', 'hcode-addons') => 'et-line-icons-12',
                          ),
            'dependency'  => array( 'element' => 'hcode_font_icon_type', 'value' => array('hcode_et_line_icons')),
        ),
        array(
            'type' => 'hcode_preview_image',
            'heading' => __('Select pre-made style for tab', 'hcode-addons'),
            'param_name' => 'hcode_et_icon_preview_image',
            'admin_label' => true,
            'value' => array(__('Font image', 'hcode-addons') => '',
                             __('Font image1', 'hcode-addons') => 'et-line-icons-1',
                             __('Font image2', 'hcode-addons') => 'et-line-icons-2',
                             __('Font image3', 'hcode-addons') => 'et-line-icons-3',
                             __('Font image4', 'hcode-addons') => 'et-line-icons-4',
                             __('Font image5', 'hcode-addons') => 'et-line-icons-5',
                             __('Font image6', 'hcode-addons') => 'et-line-icons-6',
                             __('Font image7', 'hcode-addons') => 'et-line-icons-7',
                             __('Font image8', 'hcode-addons') => 'et-line-icons-8',
                             __('Font image9', 'hcode-addons') => 'et-line-icons-9',
                             __('Font image10', 'hcode-addons') => 'et-line-icons-10',
                             __('Font image11', 'hcode-addons') => 'et-line-icons-11',
                             __('Font image12', 'hcode-addons') => 'et-line-icons-12',
                            ),
            'dependency'  => array( 'element' => 'hcode_font_icon_type', 'value' => array('hcode_et_line_icons')),
        ),
        array(
          'type' => 'hcode_fontawesome_icon',
          'heading' => __('Font Awesome Icon Type', 'hcode-addons'),
          'param_name' => 'hcode_font_awesome_icon_list',
          'admin_label' => true,
          'dependency'  => array( 'element' => 'hcode_font_icon_premade_style', 'not_empty' => true),
        ),
        array(
          'type' => 'hcode_etline_icon',
          'heading' => __('Et-Line Icon Type', 'hcode-addons'),
          'param_name' => 'hcode_et_line_icon_list',
          'admin_label' => true,
          'dependency'  => array( 'element' => 'hcode_et_icon_premade_style', 'not_empty' => true),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __('Icon Size', 'hcode-addons'),
          'param_name' => 'hcode_font_icon_size',
          'admin_label' => true,
          'value' => array(__('Select Icon Size', 'hcode-addons') => '',
                     __('Extra Large', 'hcode-addons') => 'extra-large-icon', 
                           __('Large', 'hcode-addons') => 'large-icon',
                           __('Medium', 'hcode-addons') => 'medium-icon',
                           __('Small', 'hcode-addons') => 'small-icon',
                           __('Extra Small', 'hcode-addons') => 'extra-small-icon',
                          ),
          'dependency'  => array( 'element' => 'hcode_font_icon_premade_style', 'value' => array('font-awesome-icons-1')),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Border', 'hcode-addons'),
            'param_name' => 'show_border',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select YES to show border in icon', 'hcode-addons' ),
            'dependency'  => array( 'element' => 'hcode_font_icon_premade_style', 'value' => array('font-awesome-icons-2','font-awesome-icons-3')),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Rounded Border', 'hcode-addons'),
            'param_name' => 'show_border_rounded',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select YES to show rounded border in icon', 'hcode-addons' ),
            'dependency'  => array( 'element' => 'hcode_font_icon_premade_style', 'value' => array('font-awesome-icons-2','font-awesome-icons-4','font-awesome-icons-5')),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __('Icon Box Size', 'hcode-addons'),
          'param_name' => 'hcode_icon_box_size',
          'admin_label' => true,
          'value' => array(__('Select Icon Box Size', 'hcode-addons') => '',
                           __('Large', 'hcode-addons') => 'i-large-box',
                           __('Medium', 'hcode-addons') => 'i-medium-box',
                           __('Small', 'hcode-addons') => 'i-small-box',
                           __('Extra Small', 'hcode-addons') => 'i-extra-small-box',
                          ),
          'dependency'  => array( 'element' => 'hcode_font_icon_premade_style', 'value' => array('font-awesome-icons-2','font-awesome-icons-3','font-awesome-icons-4','font-awesome-icons-5')),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __('Icon Box Decoration', 'hcode-addons'),
          'param_name' => 'hcode_icon_box_decoration',
          'admin_label' => true,
          'value' => array(__('Select Icon Box Decoration', 'hcode-addons') => '',
                     __('Light', 'hcode-addons') => 'i-light', 
                           __('3d', 'hcode-addons') => 'i-3d',
                           __('3d Border', 'hcode-addons') => 'i-3d-border',
                          ),
          'dependency'  => array( 'element' => 'hcode_font_icon_premade_style', 'value' => array('font-awesome-icons-3','font-awesome-icons-4','font-awesome-icons-5')),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __('Icon Box Background Color', 'hcode-addons'),
          'param_name' => 'hcode_icon_box_background_color',
          'admin_label' => true,
          'value' => array(__('Select Icon Box Background Color', 'hcode-addons') => '',
                     __('Orange', 'hcode-addons') => 'bg-orange', 
                     __('Yellow', 'hcode-addons') => 'bg-yellow',
                     __('Yellow Ochre', 'hcode-addons') => 'bg-yellow-ochre',
                     __('Green', 'hcode-addons') => 'bg-green',
                     __('Dark Blue', 'hcode-addons') => 'bg-dark-blue',
                     __('Dark Gray', 'hcode-addons') => 'bg-dark-gray',
                    ),
          'dependency'  => array( 'element' => 'hcode_font_icon_premade_style', 'value' => array('font-awesome-icons-5')),
        ),

        // For Et line icons
        array(
          'type' => 'dropdown',
          'heading' => __('Icon Box Size', 'hcode-addons'),
          'param_name' => 'hcode_et_icon_box_size',
          'admin_label' => true,
          'value' => array(__('Select Icon Box Size', 'hcode-addons') => '',
                           __('Large', 'hcode-addons') => 'i-large-box',
                           __('Medium', 'hcode-addons') => 'i-medium-box',
                           __('Small', 'hcode-addons') => 'i-small-box',
                           __('Extra Small', 'hcode-addons') => 'i-extra-small-box',
                          ),
          'dependency'  => array( 'element' => 'hcode_et_icon_premade_style', 'not_empty' => true),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Border', 'hcode-addons'),
            'param_name' => 'et_show_border',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select YES to show border in icon', 'hcode-addons' ),
            'dependency'  => array( 'element' => 'hcode_et_icon_premade_style', 'value' => array('et-line-icons-2','et-line-icons-4','et-line-icons-8','et-line-icons-10')),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Rounded Border', 'hcode-addons'),
            'param_name' => 'show_et_border_rounded',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select YES to show rounded border in icon', 'hcode-addons' ),
            'dependency'  => array( 'element' => 'hcode_et_icon_premade_style', 'value' => array('et-line-icons-2','et-line-icons-3','et-line-icons-4','et-line-icons-5','et-line-icons-6','et-line-icons-8','et-line-icons-9','et-line-icons-10','et-line-icons-11','et-line-icons-12')),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Plain Icons', 'hcode-addons'),
            'param_name' => 'et_plain',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select Yes to show plain icon', 'hcode-addons' ),
            'dependency'  => array( 'element' => 'hcode_et_icon_premade_style', 'value' => array('et-line-icons-1','et-line-icons-7')),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Circled Icon', 'hcode-addons'),
            'param_name' => 'circled',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select YES to show circled icon', 'hcode-addons' ),
            'dependency'  => array( 'element' => 'hcode_et_icon_premade_style', 'value' => array('et-line-icons-7','et-line-icons-8','et-line-icons-9','et-line-icons-10','et-line-icons-11','et-line-icons-12')),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __('Icon Box Decoration', 'hcode-addons'),
          'param_name' => 'hcode_et_icon_box_decoration',
          'admin_label' => true,
          'value' => array(__('Select Icon Box Decoration', 'hcode-addons') => '',
                     __('Light', 'hcode-addons') => 'i-light', 
                     __('3d', 'hcode-addons') => 'i-3d',
                     __('3d Border', 'hcode-addons') => 'i-3d-border',
                    ),
          'dependency'  => array( 'element' => 'hcode_et_icon_premade_style', 'value' => array('et-line-icons-4','et-line-icons-5','et-line-icons-6','et-line-icons-10','et-line-icons-11','et-line-icons-12')),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __('Icon Box Background Color', 'hcode-addons'),
          'param_name' => 'hcode_et_icon_box_background_color',
          'admin_label' => true,
          'value' => array(__('Select Icon Box Background Color', 'hcode-addons') => '',
                           __('Orange', 'hcode-addons') => 'bg-orange', 
                           __('Yellow', 'hcode-addons') => 'bg-yellow',
                           __('Yellow Ochre', 'hcode-addons') => 'bg-yellow-ochre',
                           __('Green', 'hcode-addons') => 'bg-green',
                           __('Dark Blue', 'hcode-addons') => 'bg-dark-blue',
                           __('Dark Gray', 'hcode-addons') => 'bg-dark-gray',
                          ),
          'dependency'  => array( 'element' => 'hcode_et_icon_premade_style', 'value' => array('et-line-icons-6','et-line-icons-12')),
        ),
        $hcode_vc_extra_id,
        $hcode_vc_extra_class,
        ),
    ) 
);

/*-----------------------------------------------------------------------------------*/
/* Font Awesome Icons End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Font Icons Class List Start */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
    'name' => __('Font Icons List', 'hcode-addons'),
    'base' => 'hcode_font_class_list',
    'category' => 'H-Code',
    'description' => __( 'Add list of all font icons', 'hcode-addons' ),
    'icon' => 'fa fa-flag-checkered h-code-shortcode-icon', //URL or CSS class with icon image.
    'params' => array(
          array(
              'type' => 'dropdown',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Icon List', 'hcode-addons'),
              'param_name' => 'hcode_font_icon_class_type',
              'value' => array(__('Select Icon List', 'hcode-addons') => '',
                       __('Font Awesome Icons', 'hcode-addons') => 'hcode_font_awesome_icons',
                               __('Et-line Icons', 'hcode-addons') => 'hcode_et_line_icons',
                              ),
          ),
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,
        ),
    ) 
);

/*-----------------------------------------------------------------------------------*/
/* Font Icons Class List End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Parallax Shortcode
/*-----------------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Parallax', 'hcode-addons'),
  'icon' => 'fa fa-exchange h-code-shortcode-icon',
  'base' => 'hcode_parallax',
  'category' => 'H-Code',
  'description' => __( 'Create a parallax section', 'hcode-addons' ),
  'params' => array(
      array(
        'type' => 'dropdown',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Style', 'hcode-addons'),
        'param_name' => 'hcode_parallax_style',
        'value' => array(__('Select Style', 'hcode-addons') => '',
                         __('Parallax', 'hcode-addons') => 'parallax',
                         __('Parallax with Description', 'hcode-addons') => 'portfolio-with-desc',
        ),
      ),
      array(
          'type' => 'hcode_preview_image',
          'heading' => __('Select pre-made style', 'hcode-addons'),
          'param_name' => 'slider_parallax_preview_image',
          'admin_label' => true,
          'value' => array(__('Slider Style', 'hcode-addons') => '',
                           __('Parallax', 'hcode-addons') => 'parallax',
                           __('Parallax with Description', 'hcode-addons') => 'portfolio-with-desc',
                          ),
      ),
      array(
        'type' => 'hcode_multiple_portfolio_categories',
        'heading' => __('Select Categories', 'hcode-addons'),
        'param_name' => 'hcode_categories_list',
         'dependency'  => array( 'element' => 'hcode_parallax_style', 'value' => array('parallax','portfolio-with-desc') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('No. of Post Per Page', 'hcode-addons'),
          'param_name' => 'hcode_post_per_page',
          'value'     => '10',
          'dependency'  => array( 'element' => 'hcode_parallax_style', 'value' => array('parallax','portfolio-with-desc') ),
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Excerpt', 'hcode-addons'),
          'param_name' => 'hcode_show_excerpt',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select Yes to show excerpt, no to show full content', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'hcode_parallax_style', 'value' => array('portfolio-with-desc')),
      ),
      array(
          'type'        => 'textfield',
          'heading'     => __('Excerpt Length', 'hcode-addons' ),
          'description' => __( 'Enter numaric value like 20', 'hcode-addons' ),
          'param_name'  => 'hcode_excerpt_length',
          'value'     => '15',
          'dependency'  => array( 'element' => 'hcode_show_excerpt', 'value' => array('1') ),
      ),
      array(
          'type'        => 'vc_link',
          'heading'     => __('Button Link', 'hcode-addons' ),
          'param_name'  => 'hcode_button_link',
          'admin_label' => true,
          'dependency'  => array( 'element' => 'hcode_parallax_style', 'value' => array('parallax','portfolio-with-desc') ),
      ),
      array(
          'type'        => 'checkbox',
          'heading'     => __('Enable Separator', 'hcode-addons' ),
          'param_name'  => 'hcode_seperater',
          'value'       => array( 'Enable Separator' => '1'),
          'dependency'  => array( 'element' => 'hcode_parallax_style', 'value' => array('portfolio-with-desc') )
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Display Items Order by', 'hcode-addons' ),
        'param_name' => 'orderby',
        'value' => array(__('Select Order by', 'hcode-addons') => '',
                         __( 'Date', 'hcode-addons' ) => 'date',
                         __( 'ID', 'hcode-addons' ) => 'ID',
                         __( 'Author', 'hcode-addons' ) => 'author',
                         __( 'Title', 'hcode-addons' ) => 'title',
                         __( 'Modified', 'hcode-addons' ) => 'modified',
                         __( 'Random', 'hcode-addons' ) => 'rand',
                         __( 'Comment count', 'hcode-addons' ) => 'comment_count',
                         __( 'Menu order', 'hcode-addons' ) => 'menu_order',
                        ),
        'dependency'  => array( 'element' => 'hcode_parallax_style', 'value' => array('parallax','portfolio-with-desc') ),
        'group' => 'Order'
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Display Items Sort by', 'hcode-addons' ),
        'param_name' => 'order',
        'value' => array(__('Select Sort by', 'hcode-addons') => '',
                         __( 'Descending', 'hcode-addons' ) => 'DESC',
                         __( 'Ascending', 'hcode-addons' ) => 'ASC',
                        ),
        'dependency'  => array( 'element' => 'hcode_parallax_style', 'value' => array('parallax','portfolio-with-desc') ),
        'group' => 'Order'
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Required Padding Setting?', 'hcode-addons'),
          'param_name' => 'padding_setting',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'dependency'  => array( 'element' => 'hcode_parallax_style', 'value' => array('portfolio-with-desc') ),
          'group' => 'Style',
      ),
      array(
          'type' => 'dropdown',
          'param_name' => 'desktop_padding',
          'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
          'value' => $hcode_desktop_padding,
          'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
          'group' => 'Style',
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
          'param_name' => 'custom_desktop_padding',
          'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
          'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
          'group' => 'Style',
      ),
      array(
          'type' => 'dropdown',
          'param_name' => 'ipad_padding',
          'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
          'value' => $hcode_ipad_padding,
          'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
          'group' => 'Style',
      ),
      array(
          'type' => 'dropdown',
          'param_name' => 'mobile_padding',
          'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
          'value' => $hcode_mobile_padding,
          'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
          'group' => 'Style',
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Required Margin Setting?', 'hcode-addons'),
          'param_name' => 'margin_setting',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'dependency'  => array( 'element' => 'hcode_parallax_style', 'value' => array('portfolio-with-desc') ),
          'group' => 'Style',
      ),
      array(
          'type' => 'dropdown',
          'param_name' => 'desktop_margin',
          'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
          'value' => $hcode_desktop_margin,
          'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
          'group' => 'Style',
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
          'param_name' => 'custom_desktop_margin',
          'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
          'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
          'group' => 'Style',
      ),
      array(
          'type' => 'dropdown',
          'param_name' => 'ipad_margin',
          'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
          'value' => $hcode_ipad_margin,
          'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
          'group' => 'Style',
      ),

      array(
          'type' => 'dropdown',
          'param_name' => 'mobile_margin',
          'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
          'value' => $hcode_mobile_margin,
          'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
          'group' => 'Style',
      ),
      array(
          'type' => 'dropdown',
          'param_name' => 'hcode_animation_style',
          'heading' => __('Animation Type', 'hcode-addons' ),
          'value' => hcode_animation_style(),
          'group' => 'Animation',
          'dependency'  => array( 'element' => 'hcode_parallax_style', 'value' => array('portfolio-with-desc') )
      ),
      $hcode_vc_extra_id,
      $hcode_vc_extra_class,
  )
) );

/*-----------------------------------------------------------------------------------*/
/*  Portfolio Shortcode
/*-----------------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Portfolio', 'hcode-addons'),
  'description' => __( 'Place portfolio items list', 'hcode-addons' ),
  'icon' => 'fa fa-briefcase h-code-shortcode-icon',
  'base' => 'hcode_portfolio',
  'category' => 'H-Code',
  'params' => array(
      array(
          'type' => 'dropdown',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Portfolio Type', 'hcode-addons'),
          'param_name' => 'hcode_portfolio_style',
          'value' => array(__('Select Portfolio Type', 'hcode-addons') => '',
                           __('Grid', 'hcode-addons') => 'grid',
                           __('Grid Gutter', 'hcode-addons') => 'grid-gutter',
                           __('Grid With Title', 'hcode-addons') => 'grid-with-title',
                           __('Wide', 'hcode-addons') => 'wide',
                           __('Wide Gutter', 'hcode-addons') => 'wide-gutter',
                           __('Wide With Title', 'hcode-addons') => 'wide-with-title',
                           __('Masonry', 'hcode-addons') => 'masonry',
          ),
      ),
      array(
          'type' => 'dropdown',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Column Type', 'hcode-addons'),
          'param_name' => 'hcode_portfolio_columns',
          'value' => array(__('Select Column Type', 'hcode-addons') => '',
                           __('2 Columns', 'hcode-addons') => '2',
                           __('3 Columns', 'hcode-addons') => '3',
                           __('4 Columns', 'hcode-addons') => '4',
                           __('5 Columns', 'hcode-addons') => '5',
          ),
          'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid','grid-gutter','grid-with-title','wide','wide-gutter','wide-with-title','masonry') ),
      ),
      array(
          'type' => 'hcode_multiple_portfolio_categories',
          'heading' => __('Select Categories', 'hcode-addons'),
          'param_name' => 'hcode_categories_list',
          'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid','grid-gutter','grid-with-title','wide','wide-gutter','wide-with-title','masonry') ),
      ),
      array(
            'type' => 'hcode_custom_switch_option',
            'heading' => __('Show Filter', 'hcode-addons'),
            'param_name' => 'hcode_show_filter',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select YES to show filter above portfolio', 'hcode-addons' ),
            'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid','grid-gutter','grid-with-title','wide','wide-gutter','wide-with-title','masonry') ),
            'group' => 'Settings',
      ),
      array(
        'type' => 'hcode_custom_switch_option',
        'heading' => __('Show Separator', 'hcode-addons'),
        'param_name' => 'hcode_show_separator',
        'value' => array(__('No', 'hcode-addons') => '0', 
                         __('Yes', 'hcode-addons') => '1'
                        ),
        'description' => __( 'Select YES to show Separator', 'hcode-addons' ),
        'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid','grid-gutter','grid-with-title','wide','wide-gutter','wide-with-title','masonry') ),
        'group' => 'Settings',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Separator Color', 'hcode-addons' ),
        'param_name' => 'hcode_sep_color',
        'dependency' => array( 'element' => 'hcode_show_separator', 'value' => array('1') ),
        'group' => 'Settings',
      ),  
      array(
        'type' => 'textfield',
        'heading' => __('Separator Height', 'hcode-addons' ),
        'param_name' => 'seperator_height',
        'value'     => '2px',
        'dependency' => array( 'element' => 'hcode_show_separator', 'value' => array('1') ),
        'description' => __( 'Define custom separator height in px like 2px', 'hcode-addons' ),
        'group' => 'Settings',
      ), 
      array(
        'type' => 'hcode_custom_switch_option',
        'heading' => __('Show Button', 'hcode-addons'),
        'param_name' => 'hcode_show_button',
        'value' => array(__('No', 'hcode-addons') => '0', 
                         __('Yes', 'hcode-addons') => '1'
                        ),
        'description' => __( 'Select YES to show button', 'hcode-addons' ),
        'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid-with-title','wide-with-title') ),
        'group' => 'Settings',
      ),
      array(
        'type'        => 'textfield',
        'heading'     => __('Button Text', 'hcode-addons' ),
        'param_name'  => 'button_text',
        'admin_label' => true,
        'dependency' => array( 'element' => 'hcode_show_button', 'value' => array('1') ),
        'group' => 'Settings',
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Display Items Order by', 'hcode-addons' ),
        'param_name' => 'orderby',
        'value' => array(__('Select Order by', 'hcode-addons') => '',
                         __( 'Date', 'hcode-addons' ) => 'date',
                         __( 'ID', 'hcode-addons' ) => 'ID',
                         __( 'Author', 'hcode-addons' ) => 'author',
                         __( 'Title', 'hcode-addons' ) => 'title',
                         __( 'Modified', 'hcode-addons' ) => 'modified',
                         __( 'Random', 'hcode-addons' ) => 'rand',
                         __( 'Comment count', 'hcode-addons' ) => 'comment_count',
                         __( 'Menu order', 'hcode-addons' ) => 'menu_order',
                        ),
        'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid','grid-gutter','grid-with-title','wide','wide-gutter','wide-with-title','masonry') ),
        'group' => 'Order'
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Display Items Sort by', 'hcode-addons' ),
        'param_name' => 'order',
        'value' => array(__('Select Sort by', 'hcode-addons') => '',
                         __( 'Descending', 'hcode-addons' ) => 'DESC',
                         __( 'Ascending', 'hcode-addons' ) => 'ASC',
                        ),
        'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid','grid-gutter','grid-with-title','wide','wide-gutter','wide-with-title','masonry') ),
        'group' => 'Order'
      ),
      array(
        'type' => 'textfield',
        'heading' => __('No. of Post Per Page', 'hcode-addons'),
        'param_name' => 'hcode_post_per_page',
        'value'     => '15',
        'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid','grid-gutter','grid-with-title','wide','wide-gutter','wide-with-title','masonry') ),
      ),
      array(
        'type' => 'hcode_custom_switch_option',
        'heading' => __('Enable Lightbox Popup', 'hcode-addons'),
        'param_name' => 'hcode_enable_lightbox',
        'value' => array(__('No', 'hcode-addons') => '0', 
                         __('Yes', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid','grid-gutter','grid-with-title','wide','wide-gutter','wide-with-title','masonry') ),
      ),
      array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Required Padding Setting?', 'hcode-addons'),
        'param_name' => 'padding_setting',
        'value' => array(__('No', 'hcode-addons') => '0', 
                         __('Yes', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid','grid-gutter','grid-with-title','wide','wide-gutter','wide-with-title','masonry') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'desktop_padding',
        'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
        'value' => $hcode_desktop_padding,
        'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
        'param_name' => 'custom_desktop_padding',
        'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
        'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'ipad_padding',
        'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
        'value' => $hcode_ipad_padding,
        'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'mobile_padding',
        'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
        'value' => $hcode_mobile_padding,
        'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Required Margin Setting?', 'hcode-addons'),
        'param_name' => 'margin_setting',
        'value' => array(__('No', 'hcode-addons') => '0', 
                         __('Yes', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid','grid-gutter','grid-with-title','wide','wide-gutter','wide-with-title','masonry') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'desktop_margin',
        'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
        'value' => $hcode_desktop_margin,
        'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
          'group' => 'Style',
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
        'param_name' => 'custom_desktop_margin',
        'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
        'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
          'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'ipad_margin',
        'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
        'value' => $hcode_ipad_margin,
        'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
          'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'mobile_margin',
        'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
        'value' => $hcode_mobile_margin,
        'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
          'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Filter Color', 'hcode-addons'),
        'param_name' => 'hcode_filter_color',
        'value' => array(__('Select Filter Color', 'hcode-addons') => '',
                         __('Black', 'hcode-addons') => 'nav-tabs-black',
                         __('Gray', 'hcode-addons') => 'nav-tabs-gray',
                         __('Custom', 'hcode-addons') => 'custom',
                ),
        'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid','grid-gutter','grid-with-title','wide','wide-gutter','wide-with-title','masonry') ),
        'group' => 'Filter Style',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Custom Filter Color', 'hcode-addons' ),
        'param_name' => 'hcode_filter_custom_color',
        'dependency' => array( 'element' => 'hcode_filter_color', 'value' => array('custom') ),
        'group' => 'Filter Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'hcode_animation_style',
        'heading' => __('Animation Style', 'hcode-addons' ),
        'value' => hcode_animation_style(),
        'dependency' => array( 'element' => 'hcode_portfolio_style', 'value' => array('grid','grid-gutter','grid-with-title','wide','wide-gutter','wide-with-title','masonry') ),
        'group' => 'Animation',
      ),
      $hcode_vc_extra_id,
      $hcode_vc_extra_class,
  )
) );

/*---------------------------------------------------------------------------*/
/* Video Sound */
/*---------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Video & Sound', 'hcode-addons'),
  'description' => __( 'Add vimeo/youtube/sound cloud', 'hcode-addons' ),
  'icon' => 'fa fa-video-camera h-code-shortcode-icon',
  'base' => 'hcode_video_sound',
  'category' => 'H-Code',
  'params' => array(
    array(
      'type' => 'dropdown',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Video Type', 'hcode-addons'),
      'param_name' => 'hcode_video_type',
      'value' => array(__('Select Video Type', 'hcode-addons') => '',
                       __('Vimeo', 'hcode-addons') => 'vimeo',
                       __('Youtube', 'hcode-addons') => 'youtube',
                       __('Sound Cloud', 'hcode-addons') => 'sound-cloud',
      ),
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Vimeo ID', 'hcode-addons'),
      'description' => __( 'Add VIMEO ID like xxxxxxxxx of vimeo url - https://vimeo.com/xxxxxxxxx', 'hcode-addons' ),      
      'param_name' => 'hcode_vimeo_id',
      'dependency'  => array( 'element' => 'hcode_video_type', 'value' => array('vimeo') ),
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Youtube Embed URL', 'hcode-addons'),
      'description' => __( 'Add YOUTUBE VIDEO EMBED URL like https://www.youtube.com/embed/xxxxxxxxxx, you will get this from youtube embed iframe src code', 'hcode-addons' ),            
      'param_name' => 'hcode_youtube_url',
      'dependency'  => array( 'element' => 'hcode_video_type', 'value' => array('youtube') ),
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Track ID', 'hcode-addons'),
      'description' => __( 'Add TRACK ID like XXXXXXXX, you will get it from embed code like api.soundcloud.com/tracks/XXXXXXXX', 'hcode-addons' ),                  
      'param_name' => 'hcode_track_id',
      'dependency'  => array( 'element' => 'hcode_video_type', 'value' => array('sound-cloud') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => __('Width', 'hcode-addons' ),
      'description' => __( 'Define IFRAME width like 500', 'hcode-addons' ),                        
      'param_name'  => 'width',
      'dependency'  => array( 'element' => 'hcode_video_type', 'value' => array('vimeo','youtube','sound-cloud') ),
      'group'       => 'Width & Height'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => __('Height', 'hcode-addons' ),
      'param_name'  => 'height',
      'description' => __( 'Define IFRAME height like 400', 'hcode-addons' ),                              
      'dependency'  => array( 'element' => 'hcode_video_type', 'value' => array('vimeo','youtube','sound-cloud') ),
      'group'       => 'Width & Height'
    )
  )
) );

/*---------------------------------------------------------------------------*/
/* Section Heading */
/*---------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Section Heading', 'hcode-addons'),
  'description' => __( 'Add styled section heading', 'hcode-addons' ),  
  'icon' => 'fa fa-header h-code-shortcode-icon',
  'base' => 'hcode_section_heading',
  'category' => 'H-Code',
  'params' => array(
    array(
      'type' => 'dropdown',
      'heading' => __('Heading Style', 'hcode-addons'),
      'param_name' => 'hcode_heading_type',
      'value' => array(__('Select Heading Style', 'hcode-addons') => '',
                       __('Heading Style1', 'hcode-addons') => 'heading-style1',
                       __('Heading Style2', 'hcode-addons') => 'heading-style2',
                       __('Heading Style3', 'hcode-addons') => 'heading-style3',
                       __('Heading Style4', 'hcode-addons') => 'heading-style4',
                       __('Heading Style5', 'hcode-addons') => 'heading-style5',
                       __('Heading Style6', 'hcode-addons') => 'heading-style6',
              ),
      ),
    array(
      'type' => 'hcode_preview_image',
      'heading' => __('Select pre-made style for Heading', 'hcode-addons'),
      'param_name' => 'heading_preview_image',
      'admin_label' => true,
      'value' => array(__('Select Heading Type', 'hcode-addons') => '',
                 __('Heading Style1', 'hcode-addons') => 'heading-style1',
                 __('Heading Style2', 'hcode-addons') => 'heading-style2',
                 __('Heading Style3', 'hcode-addons') => 'heading-style3',
                 __('Heading Style4', 'hcode-addons') => 'heading-style4',
                 __('Heading Style5', 'hcode-addons') => 'heading-style5',
                 __('Heading Style6', 'hcode-addons') => 'heading-style6',
        ),
    ),
    array(
      'type' => 'hcode_etline_icon',
      'heading' => __('Select Et-Line Icon Type', 'hcode-addons'),
      'param_name' => 'hcode_et_line_icon_list',
      'admin_label' => true,
      'description' => __('Selet Font Type', 'hcode-addons'),
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style2','heading-style5') ),
    ),
    array(
      'type' => 'dropdown',
      'heading' => __('Heading Tag', 'hcode-addons'),
      'param_name' => 'hcode_heading_tag',
      'value' => array(__('Select Heading Tag', 'hcode-addons') => '',
                       __('h1', 'hcode-addons') => 'h1',
                       __('h2', 'hcode-addons') => 'h2',
                       __('h3', 'hcode-addons') => 'h3',
                       __('h4', 'hcode-addons') => 'h4',
                       __('h5', 'hcode-addons') => 'h5',
                       __('h6', 'hcode-addons') => 'h6',
                                      ),
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style1','heading-style2','heading-style3','heading-style4','heading-style5','heading-style6') ),
      'group' => 'Heading Style',
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Heading Number', 'hcode-addons'),
      'param_name' => 'hcode_heading_number',
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style6') ),
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Heading Title', 'hcode-addons'),
      'param_name' => 'hcode_heading',
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style1','heading-style2','heading-style3','heading-style4','heading-style5','heading-style6') ),
    ),
    array(
      'type' => 'textarea',
      'heading' => __('Subtitle', 'hcode-addons'),
      'param_name' => 'subtitle',
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style2') ),
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'heading' => __('Add Separator', 'hcode-addons'),
      'param_name' => 'hcode_seperator',
      'admin_label' => true,
      'value' => array(__('False', 'hcode-addons') => '0', 
                       __('True', 'hcode-addons') => '1'
                      ),
      'description' => __('Select TRUE to add Separator.', 'hcode-addons'),
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style1','heading-style6') ),
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'heading' => __('Double Line', 'hcode-addons'),
      'param_name' => 'hcode_double_line',
      'admin_label' => true,
      'value' => array(__('False', 'hcode-addons') => '0', 
                       __('True', 'hcode-addons') => '1'
                      ),
      'description' => __('Select TRUE to add double line with both the side.', 'hcode-addons'),
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style2','heading-style3') ),
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Text BG Color', 'hcode-addons' ),
      'param_name' => 'hcode_heading_text_bg_color',
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style2') ),
      'group' => 'Heading Style',
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Number Text Color', 'hcode-addons' ),
      'param_name' => 'hcode_heading_number_text_color',
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style6') ),
      'group' => 'Heading Style',
    ),
    array(
      'type' => 'dropdown',
      'heading' => __('Text Color', 'hcode-addons'),
      'param_name' => 'hcode_text_color',
      'value' => array(__('Select Text Color', 'hcode-addons') => '',
                       __('Black', 'hcode-addons') => 'black-text',
                       __('White', 'hcode-addons') => 'white-text',
                       __('Custom', 'hcode-addons') => 'custom',
              ),
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style1','heading-style2','heading-style3','heading-style4','heading-style5','heading-style6') ),
      'group' => 'Heading Style',
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Text Color', 'hcode-addons' ),
      'param_name' => 'hcode_heading_text_color',
      'dependency' => array( 'element' => 'hcode_text_color', 'value' => array('custom') ),
      'group' => 'Heading Style',
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Separator Color', 'hcode-addons' ),
      'param_name' => 'hcode_heading_sep_color',
      'group' => 'Heading Style',
      'dependency' => array( 'element' => 'hcode_seperator', 'value' => array('1') ),
    ),
    array(
      'type' => 'dropdown',
      'heading' => __('Select Icon Size', 'hcode-addons'),
      'param_name' => 'icon_size',
      'admin_label' => true,
      'value' => array(__('Default', 'hcode-addons') => '',
                       __('Extra Large', 'hcode-addons') => 'extra-large-icon', 
                       __('Large', 'hcode-addons') => 'large-icon',
                       __('Medium', 'hcode-addons') => 'medium-icon',
                       __('Small', 'hcode-addons') => 'small-icon',
                       __('Extra Small', 'hcode-addons') => 'extra-small-icon',
                      ),
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style2','heading-style5') ),
      'group' => 'Heading Style',
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Icon Color', 'hcode-addons' ),
      'param_name' => 'hcode_heading_icon_color',
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style2','heading-style5') ),
      'group' => 'Heading Style',
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'heading' => __('Required Margin Setting?', 'hcode-addons'),
      'param_name' => 'margin_setting',
      'value' => array(__('No', 'hcode-addons') => '0', 
                       __('Yes', 'hcode-addons') => '1'
                      ),
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style1','heading-style2','heading-style3','heading-style4','heading-style5','heading-style6') ),
      'group' => 'Css Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'desktop_margin',
      'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
      'value' => $hcode_desktop_margin,
      'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
      'group' => 'Css Style',
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
      'param_name' => 'custom_desktop_margin',
      'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
      'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
      'group' => 'Css Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'ipad_margin',
      'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
      'value' => $hcode_ipad_margin,
      'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
      'group' => 'Css Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'mobile_margin',
      'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
      'value' => $hcode_mobile_margin,
      'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
      'group' => 'Css Style',
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Required Padding Setting?', 'hcode-addons'),
      'param_name' => 'padding_setting',
      'value' => array(__('No', 'hcode-addons') => '0', 
                       __('Yes', 'hcode-addons') => '1'
                      ),
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style1','heading-style2','heading-style3','heading-style4','heading-style5','heading-style6') ),
      'group' => 'Css Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'desktop_padding',
      'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
      'value' => $hcode_desktop_padding,
      'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
      'group' => 'Css Style',
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
      'param_name' => 'custom_desktop_padding',
      'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
      'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
      'group' => 'Css Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'ipad_padding',
      'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
      'value' => $hcode_ipad_padding,
      'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
      'group' => 'Css Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'mobile_padding',
      'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
      'value' => $hcode_mobile_padding,
      'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
      'group' => 'Css Style',
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Font Size', 'hcode-addons' ),
      'param_name' => 'font_size',
      'description' => __( 'Define font size like 12px', 'hcode-addons' ),
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style1','heading-style2','heading-style3','heading-style4','heading-style5','heading-style6') ),
      'group' => 'Css Style',
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Line Height', 'hcode-addons' ),
      'param_name' => 'line_height',
      'description' => __( 'Define line height like 20px', 'hcode-addons' ),
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style1','heading-style2','heading-style3','heading-style4','heading-style5','heading-style6') ),
      'group' => 'Css Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'font_weight',
      'heading' => __('Font Weight', 'hcode-addons' ),
      'value' => array(__('Select Font Weight', 'hcode-addons') => '', 
                       __('Font weight 300', 'hcode-addons') => '300',
                       __('Font weight 400', 'hcode-addons') => '400',
                       __('Font weight 500', 'hcode-addons') => '500',
                       __('Font weight 600', 'hcode-addons') => '600',
                       __('Font weight 700', 'hcode-addons') => '700',
                       __('Font weight 800', 'hcode-addons') => '800',
                       __('Font weight 900', 'hcode-addons') => '900',
                      ),
      'dependency' => array( 'element' => 'hcode_heading_type', 'value' => array('heading-style1','heading-style2','heading-style3','heading-style4','heading-style5','heading-style6') ),
      'group' => 'Css Style',
    ),
    $hcode_vc_extra_id,
    $hcode_vc_extra_class,
    )
) );

/*---------------------------------------------------------------------------*/
/* Feature Box Start*/
/*---------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Features Box', 'hcode-addons'),
  'description' => __('Place a features box', 'hcode-addons'),
  'icon' => 'fa fa-building h-code-shortcode-icon',
  'base' => 'hcode_feature_box',
  'category' => 'H-Code',
  'params' => array(
    array(
      'type' => 'dropdown',
      'heading' => __('Feature Style', 'hcode-addons'),
      'param_name' => 'hcode_feature_type',
      'value' => array(__('Select Feature Style', 'hcode-addons') => '',
                       __('Feature Style 1', 'hcode-addons') => 'featurebox1',
                       __('Feature Style 2', 'hcode-addons') => 'featurebox2',
                       __('Feature Style 3', 'hcode-addons') => 'featurebox3',
                       __('Feature Style 4', 'hcode-addons') => 'featurebox4',
                       __('Feature Style 5', 'hcode-addons') => 'featurebox5',
                       __('Feature Style 6', 'hcode-addons') => 'featurebox6',
                       __('Feature Style 7', 'hcode-addons') => 'featurebox7',
                       __('Feature Style 8', 'hcode-addons') => 'featurebox8',
                       __('Feature Style 9', 'hcode-addons') => 'featurebox9',
                       __('Feature Style 10', 'hcode-addons') => 'featurebox10',
                      ),
    ),
    array(
      'type' => 'hcode_preview_image',
      'heading' => __('Select pre-made style for Feature', 'hcode-addons'),
      'param_name' => 'feature_box_preview_image',
      'admin_label' => true,
      'value' => array(__('Select Feature Type', 'hcode-addons') => '',
                       __('Feature Style 1', 'hcode-addons') => 'featurebox1',
                       __('Feature Style 2', 'hcode-addons') => 'featurebox2',
                       __('Feature Style 3', 'hcode-addons') => 'featurebox3',
                       __('Feature Style 4', 'hcode-addons') => 'featurebox4',
                       __('Feature Style 5', 'hcode-addons') => 'featurebox5',
                       __('Feature Style 6', 'hcode-addons') => 'featurebox6',
                       __('Feature Style 7', 'hcode-addons') => 'featurebox7',
                       __('Feature Style 8', 'hcode-addons') => 'featurebox8',
                       __('Feature Style 9', 'hcode-addons') => 'featurebox9',
                       __('Feature Style 10', 'hcode-addons') => 'featurebox10',
                      ),
      ),
    array(
      'type' => 'hcode_etline_icon',
      'heading' => __('Select Et-Line Icon Type', 'hcode-addons'),
      'param_name' => 'hcode_et_line_icon_list',
      'admin_label' => true,
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox1','featurebox2','featurebox3','featurebox7','featurebox9')),
    ),
    array(
      'type' => 'attach_image',
      'heading' => __('Image', 'hcode-addons' ),
      'param_name' => 'hcode_feature_image',
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox8','featurebox10')),
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Number Text', 'hcode-addons' ),
      'param_name' => 'hcode_process_no',
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox1')),
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Number Text', 'hcode-addons' ),
      'param_name' => 'hcode_number',
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox9')),
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Title', 'hcode-addons' ),
      'param_name' => 'hcode_feature_title',
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox1','featurebox2','featurebox3','featurebox6','featurebox7','featurebox8','featurebox9','featurebox10')),
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Subtitle', 'hcode-addons' ),
      'param_name' => 'hcode_feature_subtitle',
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox6')),
    ),
    array(
      'type' => 'textarea_html',
      'heading' => __('Description', 'hcode-addons'),
      'param_name' => 'content',
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox1','featurebox2','featurebox3','featurebox6','featurebox7','featurebox8', 'featurebox10')),
    ),
    array(
      'type' => 'hcode_posts_list',
      'heading' => __('Blog Post', 'hcode-addons'),
      'param_name' => 'hcode_posts_list',
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox5','featurebox4')),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => __('Excerpt Length', 'hcode-addons' ),
      'description' => __( 'Enter numaric value like 20', 'hcode-addons' ),
      'param_name'  => 'hcode_excerpt_length',
      'value'       => '15',
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox5')),
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Currency Symbol', 'hcode-addons' ),
      'param_name' => 'hcode_feature_currency',
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox6')),
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Price', 'hcode-addons' ),
      'param_name' => 'hcode_feature_price',
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox6')),
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Enter Per Month Text', 'hcode-addons' ),
      'param_name' => 'hcode_feature_per_month_text',
      'value' => '/mo',
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox6')),
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => __('Button Link', 'hcode-addons' ),
      'param_name'  => 'hcode_feature_button_link',
      'admin_label' => true,
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox6')),
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Enable Separator', 'hcode-addons'),
      'param_name' => 'hcode_enable_seperator',
      'value' => array(__('NO', 'hcode-addons') => '0', 
                       __('YES', 'hcode-addons') => '1'
                      ),
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox1','featurebox3','featurebox5','featurebox7')),
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Active Feature', 'hcode-addons'),
      'param_name' => 'hcode_active_feature',
      'value' => array(__('NO', 'hcode-addons') => '0', 
                       __('YES', 'hcode-addons') => '1'
                      ),
      'description' => __( 'Select YES to mark as active feature', 'hcode-addons' ),
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox6')),
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Enable Icon', 'hcode-addons'),
      'param_name' => 'hcode_feature_icon',
      'value' => array(__('NO', 'hcode-addons') => '0', 
                       __('YES', 'hcode-addons') => '1'
                      ),
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox8')),
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Enable Star', 'hcode-addons'),
      'param_name' => 'hcode_feature_star',
      'value' => array(__('NO', 'hcode-addons') => '0', 
                       __('YES', 'hcode-addons') => '1'
                      ),
      'dependency'  => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox8')),
    ),
    array(
      'type' => 'dropdown',
      'heading' => __('Stars', 'hcode-addons'),
      'param_name' => 'hcode_stars',
      'admin_label' => true,
      'value' => array(__('Select Stars', 'hcode-addons') => '',
                       __('Star 1', 'hcode-addons') => '1',
                       __('Star 2', 'hcode-addons') => '2', 
                       __('Star 3', 'hcode-addons') => '3',
                       __('Star 4', 'hcode-addons') => '4',
                       __('Star 5', 'hcode-addons') => '5',
                      ),
      'dependency' => array( 'element' => 'hcode_feature_star', 'value' => array('1') ),
    ),
    array(
      'type' => 'dropdown',
      'heading' => __('Select Icon Size', 'hcode-addons'),
      'param_name' => 'counter_icon_size',
      'admin_label' => true,
      'value' => array(__('Default', 'hcode-addons') => '',
                       __('Extra Large', 'hcode-addons') => 'extra-large-icon', 
                       __('Large', 'hcode-addons') => 'large-icon',
                       __('Medium', 'hcode-addons') => 'medium-icon',
                       __('Small', 'hcode-addons') => 'small-icon',
                       __('Extra Small', 'hcode-addons') => 'extra-small-icon',
                      ),
      'dependency' => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox1','featurebox2','featurebox3','featurebox7','featurebox8','featurebox9') ),
      'group' => 'Configuration',
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Icon Color', 'hcode-addons' ),
      'param_name' => 'hcode_icon_color',
      'dependency' => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox1','featurebox2','featurebox3','featurebox7','featurebox8','featurebox9') ),
      'group' => 'Configuration',
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Star Color', 'hcode-addons' ),
      'param_name' => 'hcode_star_color',
      'dependency' => array( 'element' => 'hcode_feature_star', 'value' => array('1') ),
      'group' => 'Configuration',
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Number Color', 'hcode-addons' ),
      'param_name' => 'hcode_number_color',
      'dependency' => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox9') ),
      'group' => 'Configuration',
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Title Color', 'hcode-addons' ),
      'param_name' => 'hcode_title_color',
      'group' => 'Configuration',
      'dependency' => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox1','featurebox2','featurebox3','featurebox4','featurebox5','featurebox6','featurebox7','featurebox8','featurebox9','featurebox10') ),
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Subtitle Color', 'hcode-addons' ),
      'param_name' => 'hcode_subtitle_color',
      'group' => 'Configuration',
      'dependency' => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox6') ),
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Required Padding Setting?', 'hcode-addons'),
      'param_name' => 'padding_setting',
      'value' => array(__('No', 'hcode-addons') => '0', 
                       __('Yes', 'hcode-addons') => '1'
                      ),
      'group' => 'Style',
      'dependency' => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox1','featurebox2','featurebox3','featurebox6','featurebox7','featurebox8','featurebox9','featurebox10') ),
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'desktop_padding',
      'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
      'value' => $hcode_desktop_padding,
      'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
      'group' => 'Style',
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
      'param_name' => 'custom_desktop_padding',
      'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
      'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
      'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'ipad_padding',
      'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
      'value' => $hcode_ipad_padding,
      'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
      'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'mobile_padding',
      'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
      'value' => $hcode_mobile_padding,
      'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
      'group' => 'Style',
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Required Margin Setting?', 'hcode-addons'),
      'param_name' => 'margin_setting',
      'value' => array(__('No', 'hcode-addons') => '0', 
                       __('Yes', 'hcode-addons') => '1'
                      ),
      'group' => 'Style',
      'dependency' => array( 'element' => 'hcode_feature_type', 'value' => array('featurebox1','featurebox2','featurebox3','featurebox6','featurebox7','featurebox8','featurebox9','featurebox10') ),
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'desktop_margin',
      'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
      'value' => $hcode_desktop_margin,
      'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
      'group' => 'Style',
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
      'param_name' => 'custom_desktop_margin',
      'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
      'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
      'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'ipad_margin',
      'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
      'value' => $hcode_ipad_margin,
      'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
      'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'mobile_margin',
      'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
      'value' => $hcode_mobile_margin,
      'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
      'group' => 'Style',
    ), 
    $hcode_vc_extra_id,
    $hcode_vc_extra_class,
    )
) );

/*---------------------------------------------------------------------------*/
/* Feature Box End*/
/*---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Blockquote Start */
/*---------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Blockquote', 'hcode-addons'),
  'description' => __( 'Create a blockquote', 'hcode-addons' ),  
  'icon' => 'h-code-shortcode-icon fa fa-quote-left',
  'base' => 'hcode_blockquote',
  'category' => 'H-Code',
  'params' => array(
        array(
          'type' => 'textarea_html',
          'heading' => __('Content', 'hcode-addons'),
          'param_name' => 'content',
        ),
        array(
          'type' => 'textfield',
          'heading' => __('Heading Title', 'hcode-addons'),
          'param_name' => 'hcode_blockquote_heading',
        ),
       array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Blockquote Icon', 'hcode-addons'),
          'param_name' => 'blockquote_icon',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
        ),
        array(
          'type' => 'colorpicker',
          'class' => '',
          'heading' => __( 'Blockquote Background Color', 'hcode-addons' ),
          'param_name' => 'hcode_blockquote_bg_color',
          'group' => 'Blockquote Style',
        ),
        array(
          'type' => 'colorpicker',
          'class' => '',
          'heading' => __( 'Blockquote Text Color', 'hcode-addons' ),
          'param_name' => 'hcode_blockquote_color',
          'group' => 'Blockquote Style',
        ),
        array(
          'type' => 'dropdown',
          'param_name' => 'hcode_border_position',
          'heading' => __('Border Position', 'hcode-addons' ),
          'value' => array(__('No Border', 'hcode-addons') => '',
                           __('Border Top', 'hcode-addons') => 'border-top',
                           __('Border Bottom', 'hcode-addons') => 'border-bottom',
                           __('Border Left', 'hcode-addons') => 'border-left',
                           __('Border Right', 'hcode-addons') => 'border-right',
                          ),
          'group' => 'Blockquote Style',
        ),
        array(
          'type' => 'colorpicker',
          'class' => '',
          'heading' => __( 'Border Color', 'hcode-addons' ),
          'param_name' => 'hcode_border_color',
          'dependency' => array( 'element' => 'hcode_border_position', 'not_empty' => true ),
          'group' => 'Blockquote Style',
        ),
        array(
          'type' => 'textfield',
          'heading' => __('Border Size', 'hcode-addons' ),
          'param_name' => 'hcode_border_size',
          'dependency' => array( 'element' => 'hcode_border_position', 'not_empty' => true ),
          'description' => __( 'Define border size like 2px', 'hcode-addons' ),
          'group' => 'Blockquote Style',
        ),
        array(
          'type' => 'dropdown',
          'param_name' => 'hcode_border_type',
          'heading' => __('Border Type', 'hcode-addons' ),
          'value' => array(__('no border', 'hcode-addons') => '',
                           __('Dotted', 'hcode-addons') => 'dotted',
                           __('Dashed', 'hcode-addons') => 'dashed',
                           __('Solid', 'hcode-addons') => 'solid',
                           __('Double', 'hcode-addons') => 'double',
                          ),
          'dependency' => array( 'element' => 'hcode_border_position', 'not_empty' => true ),
          'group' => 'Blockquote Style',
        ),
        array(
          'type' => 'textfield',
          'heading' => __('Font Size', 'hcode-addons'),
          'description' => __( 'Define font size like 12px', 'hcode-addons' ),
          'param_name' => 'hcode_blockquote_font_size',
          'group' => 'Blockquote Style',
        ),
          array(
          'type' => 'textfield',
          'heading' => __('Line Height', 'hcode-addons'),
          'description' => __( 'Define line height like 20px', 'hcode-addons' ),
          'param_name' => 'hcode_blockquote_line_height',
          'group' => 'Blockquote Style',
        ),
        array(
          'type' => 'dropdown',
          'param_name' => 'desktop_padding',
          'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
          'value' => $hcode_desktop_padding,
          'group' => 'Blockquote Style',
        ),
        array(
          'type' => 'textfield',
          'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
          'param_name' => 'custom_desktop_padding',
          'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
          'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
          'group' => 'Blockquote Style',
        ),
        array(
          'type' => 'dropdown',
          'param_name' => 'desktop_margin',
          'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
          'value' => $hcode_desktop_margin,
          'group' => 'Blockquote Style',
          ),
        array(
          'type' => 'textfield',
          'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
          'param_name' => 'custom_desktop_margin',
          'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
          'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
          'group' => 'Blockquote Style',
        ),
        $hcode_vc_extra_id,
        $hcode_vc_extra_class,
    )
) );

/*---------------------------------------------------------------------------*/
/* Blockquote End */
/*---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Featured Slider Start */
/*---------------------------------------------------------------------------*/

vc_map( 
    array(
        'name' => __( 'Features Box Slider' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
        'base' => 'hcode_feature_slider', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
        'description' => __( 'Place a features box slider', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
        'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
        'as_parent' => array('only' => 'hcode_feature_slide_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-building-o', //URL or CSS class with icon image.
        'category' => 'H-Code',
        'js_view' => 'VcColumnView',
        'params' => array(
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Show Pagination', 'hcode-addons'),
              'param_name' => 'show_pagination',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Style', 'hcode-addons'),
              'param_name' => 'show_pagination_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                               __('Dot Style', 'hcode-addons') => '0',
                               __('Line Style', 'hcode-addons') => '1',
                               __('Round Style', 'hcode-addons') => '2',
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Color Style', 'hcode-addons'),
              'param_name' => 'show_pagination_color_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                               __('Dark Style', 'hcode-addons') => '0',
                               __('Light Style', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Navigation', 'hcode-addons'),
                'param_name' => 'show_navigation',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Navigation Style', 'hcode-addons'),
              'param_name' => 'show_navigation_style',
              'admin_label' => true,
              'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                               __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                               __('Next/Prev White Arrow', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Cursor Color Style', 'hcode-addons'),
              'param_name' => 'show_cursor_color_style',
              'admin_label' => true,
              'value' => array(__('Select Cursor Color Style', 'hcode-addons') => '',
                               __('White Cursor', 'hcode-addons') => 'white-cursor',
                               __('Black Cursor', 'hcode-addons') => 'black-cursor',
                               __('Default Cursor', 'hcode-addons') => 'no-cursor',
                              ),
          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For Desktop Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 3', 'hcode-addons' ),                
                'param_name' => 'hcode_image_carousel_itemsdesktop',
                'group'       => 'Slider Configuration',
                'value'     => '3',
          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For iPad/Tablet Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 3', 'hcode-addons' ),                                
                'param_name' => 'hcode_image_carousel_itemstablet',
                'group'       => 'Slider Configuration',
                'value'     => '3',

          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For Mobile Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 1', 'hcode-addons' ),   
                'param_name' => 'hcode_image_carousel_itemsmobile',
                'group'       => 'Slider Configuration',
                'value'     => '1',
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Autoplay', 'hcode-addons'),
                'param_name' => 'hcode_image_carousel_autoplay',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
                'group'       => 'Slider Configuration'  
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Stop On Hover', 'hcode-addons'),
                'param_name' => 'stoponhover',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
                'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
                'group' => 'Slider Configuration',
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Delay Time', 'hcode-addons'),
              'param_name' => 'slidespeed',
              'admin_label' => true,
              'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                               __('500', 'hcode-addons') => '500',
                               __('600', 'hcode-addons') => '600',
                               __('700', 'hcode-addons') => '700',
                               __('800', 'hcode-addons') => '800',
                               __('900', 'hcode-addons') => '900',
                               __('1000', 'hcode-addons') => '1000',
                               __('1100', 'hcode-addons') => '1100',
                               __('1200', 'hcode-addons') => '1200',
                               __('1300', 'hcode-addons') => '1300',
                               __('1400', 'hcode-addons') => '1400',
                               __('1500', 'hcode-addons') => '1500',
                               __('2000', 'hcode-addons') => '2000',
                               __('3000', 'hcode-addons') => '3000',
                               __('4000', 'hcode-addons') => '4000',
                               __('5000', 'hcode-addons') => '5000',
                               __('6000', 'hcode-addons') => '6000',
                               __('7000', 'hcode-addons') => '7000',
                               __('8000', 'hcode-addons') => '8000',
                               __('9000', 'hcode-addons') => '9000',
                               __('10000', 'hcode-addons') => '10000',
                              ),
              'std' => '3000',
              'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
              'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
              'group' => 'Slider Configuration',
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider ID', 'hcode-addons' ),
             'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
             'param_name'  => 'hcode_slider_id',
             'group'       => 'Slider ID & Class'
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider Extra Class', 'hcode-addons' ),
             'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
             'param_name'  => 'hcode_slider_class',
             'group'       => 'Slider ID & Class'
          ),
          )
      )
  );
  vc_map( 
    array(
        'name' => __('Add Feature Block', 'hcode-addons'),
        'base' => 'hcode_feature_slide_content',
        'description' => __( 'A slide for the image slider.', 'hcode-addons' ),
        'as_child' => array('only' => 'hcode_feature_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-building-o', //URL or CSS class with icon image.
        'params' => array(
            array(
                'type' => 'hcode_etline_icon',
                'heading' => __('Select Et-Line Icon Type', 'hcode-addons'),
                'param_name' => 'hcode_et_line_icon_list',
                'admin_label' => true,
                'description' => __('Selet Font Type', 'hcode-addons'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title', 'hcode-addons'),
                'param_name' => 'title'
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __('Content', 'hcode-addons'),
                'param_name' => 'content'
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Icon Color style', 'hcode-addons'),
                'param_name' => 'icon_color_style',
                'admin_label' => true,
                'value' => array(__('Default', 'hcode-addons') => '',
                                 __('White', 'hcode-addons') => 'white-text',
                                 __('Black', 'hcode-addons') => 'black-text',
                                 __('Custom Color', 'hcode-addons') => 'custom',
                                ),
                'group' => 'Configuration',
            ),
            array(
              'type' => 'colorpicker',
              'class' => '',
              'heading' => __( 'Icon Color', 'hcode-addons' ),
              'param_name' => 'hcode_icon_color',
              'dependency' => array( 'element' => 'icon_color_style', 'value' => array('custom') ),
              'description' => __( 'Icon Color', 'hcode-addons' ),
              'group' => 'Configuration',
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Title Color style', 'hcode-addons'),
                'param_name' => 'title_color_style',
                'admin_label' => true,
                'value' => array(__('Default', 'hcode-addons') => '',
                                 __('White', 'hcode-addons') => 'white-text',
                                 __('Black', 'hcode-addons') => 'black-text',
                                 __('Custom Color', 'hcode-addons') => 'custom',
                                ),
                'group' => 'Configuration',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => __( 'Title Color', 'hcode-addons' ),
                'param_name' => 'hcode_title_color',
                'dependency' => array( 'element' => 'title_color_style', 'value' => array('custom') ),
                'description' => __( 'Title Color', 'hcode-addons' ),
                'group' => 'Configuration',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => __( 'Content Color', 'hcode-addons' ),
                'param_name' => 'hcode_content_color',
                'description' => __( 'Content Color', 'hcode-addons' ),
                'group' => 'Configuration',
            ),
            array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Required Margin Setting?', 'hcode-addons'),
                'param_name' => 'margin_setting',
                'value' => array(__('No', 'hcode-addons') => '0', 
                                 __('Yes', 'hcode-addons') => '1'
                                ),
                'group' => 'Style',
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'desktop_margin',
                'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
                'value' => $hcode_desktop_margin,
                'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
                'group' => 'Style',
            ),

            array(
                'type' => 'textfield',
                'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
                'param_name' => 'custom_desktop_margin',
                'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
                'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
                'group' => 'Style',
            ),

            array(
                'type' => 'dropdown',
                'param_name' => 'ipad_margin',
                'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
                'value' => $hcode_ipad_margin,
                'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
                'group' => 'Style',
            ),

            array(
                'type' => 'dropdown',
                'param_name' => 'mobile_margin',
                'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
                'value' => $hcode_mobile_margin,
                'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
                'group' => 'Style',
            ),
            $hcode_vc_extra_id,
            $hcode_vc_extra_class,
          ),
      ) 
  );

if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_feature_slider extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_feature_slide_content extends WPBakeryShortCode { }
}

/*---------------------------------------------------------------------------*/
/* Featured Slider End */
/*---------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Blog Shortcode Start */
/*-----------------------------------------------------------------------------------*/
    
vc_map( array(
    'name' => __('Blog List', 'hcode-addons'),
    'description' => __( 'Create a blog list', 'hcode-addons' ),    
    'icon' => 'h-code-shortcode-icon fa fa-list',
    'base' => 'hcode_blog',
    'category' => 'H-Code',
    'params' => array(
      array(
          'type' => 'dropdown',
          'heading' => __('Style', 'hcode-addons'),
          'param_name' => 'hcode_blog_premade_style',
          'value' => array(__('Please Select Style', 'hcode-addons') => '',
                           __('Modern', 'hcode-addons') => 'modern',
                           __('Classic', 'hcode-addons') => 'classic',
                           __('Grid', 'hcode-addons') => 'grid',
                           __('Masonry', 'hcode-addons') => 'masonry',
                          ),
      ),
      array(
          'type' => 'dropdown',
          'heading' => __('Column Type', 'hcode-addons'),
          'param_name' => 'hcode_blog_columns',
          'value' => array(__('Please Select Column Type', 'hcode-addons') => '',
                           __('2 Columns', 'hcode-addons') => '2',
                           __('3 Columns', 'hcode-addons') => '3',
                           __('4 Columns', 'hcode-addons') => '4',
                          ),
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('grid','masonry') ),
      ),
      array(
          'type' => 'hcode_multiple_select_option',
          'heading' => __('Categories', 'hcode-addons'),
          'param_name' => 'hcode_categories_list',
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('No. of Posts per Page', 'hcode-addons'),
          'description' => __( 'Enter numeric value like 8', 'hcode-addons' ),
          'param_name' => 'hcode_post_per_page',
          'value'     => '15',
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Pagination', 'hcode-addons'),
          'param_name' => 'hcode_show_pagination',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'std' => '1',
          'description' => __( 'Select Yes to show pagination', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Post Title', 'hcode-addons'),
          'param_name' => 'hcode_show_post_title',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select YES to show post title', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
          'group' => 'Settings',
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Thumbnail', 'hcode-addons'),
          'param_name' => 'hcode_show_thumbnail',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select Yes to show thumbnail', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
          'group' => 'Settings',
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Author Name', 'hcode-addons'),
          'param_name' => 'hcode_show_author_name',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select Yes to show author name', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
          'group' => 'Settings',
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Date', 'hcode-addons'),
          'param_name' => 'hcode_show_date',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select Yes to show date', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
          'group' => 'Settings',
      ),
      array(
          'type'        => 'textfield',
          'heading'     => __('Date Format', 'hcode-addons' ),
          'param_name'  => 'hcode_date_format',
          'description' => __( 'Date format should be like mm/dd/yyyy, <a target="_blank" href="https://codex.wordpress.org/Formatting_Date_and_Time">click here</a> to see other date formates', 'hcode-addons' ),
          'value'     => 'd m Y',
          'dependency'  => array( 'element' => 'hcode_show_date', 'value' => array('1') ),
          'group' => 'Settings',
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Categories', 'hcode-addons'),
          'param_name' => 'hcode_show_categories',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select Yes to show categories', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
          'group' => 'Settings',
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Excerpt', 'hcode-addons'),
          'param_name' => 'hcode_show_excerpt',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select Yes to show excerpt, no to show full content', 'hcode-addons' ),
          'std'         => '1',
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
          'group' => 'Settings',
      ),
      array(
          'type'        => 'textfield',
          'heading'     => __('Excerpt Length', 'hcode-addons' ),
          'description' => __( 'Enter numeric value like 20', 'hcode-addons' ),
          'param_name'  => 'hcode_excerpt_length',
          'value'     => '55',
          'dependency'  => array( 'element' => 'hcode_show_excerpt', 'value' => array('1') ),
          'group' => 'Settings',
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Content White Background', 'hcode-addons'),
          'param_name' => 'hcode_show_white_bg',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select Yes to show white background', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
          'group' => 'Settings',
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Like', 'hcode-addons'),
          'param_name' => 'hcode_show_like',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select Yes to show like', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
          'group' => 'Settings',
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Comment', 'hcode-addons'),
          'param_name' => 'hcode_show_comment',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select Yes to show comment', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
          'group' => 'Settings',
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Continue Button', 'hcode-addons'),
          'param_name' => 'hcode_show_continue_button',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select Yes to show continue button', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
          'group' => 'Settings',
      ),
      array(
          'type'        => 'textfield',
          'heading'     => __('Button Text', 'hcode-addons' ),
          'param_name'  => 'hcode_button_config',
          'admin_label' => true,
          'dependency'  => array( 'element' => 'hcode_show_continue_button', 'value' => array('1') ),
          'group' => 'Settings',
      ),
      array(
          'type' => 'dropdown',
          'heading' => __( 'Display Items Order by', 'hcode-addons' ),
          'param_name' => 'orderby',
          'value' => array(__('Select Order by', 'hcode-addons') => '',
                           __( 'Date', 'hcode-addons' ) => 'date',
                           __( 'ID', 'hcode-addons' ) => 'ID',
                           __( 'Author', 'hcode-addons' ) => 'author',
                           __( 'Title', 'hcode-addons' ) => 'title',
                           __( 'Modified', 'hcode-addons' ) => 'modified',
                           __( 'Random', 'hcode-addons' ) => 'rand',
                           __( 'Comment count', 'hcode-addons' ) => 'comment_count',
                           __( 'Menu order', 'hcode-addons' ) => 'menu_order',
                          ),
        'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
        'group' => 'Order',
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Display Items Sort by', 'hcode-addons' ),
        'param_name' => 'order',
        'value' => array(__('Select Sort by', 'hcode-addons') => '',
                         __( 'Descending', 'hcode-addons' ) => 'DESC',
                         __( 'Ascending', 'hcode-addons' ) => 'ASC',
                        ),
        'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
        'group' => 'Order',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'hcode_animation_style',
        'heading' => __('Animation Style', 'hcode-addons' ),
        'value' => hcode_animation_style(),
        'dependency'  => array( 'element' => 'hcode_blog_premade_style', 'value' => array('modern','classic','grid','masonry') ),
        'group' => 'Animation',
      ),
      $hcode_vc_extra_id,
      $hcode_vc_extra_class,
    ),
) );

/*-----------------------------------------------------------------------------------*/
/* Page Title Shortcode End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Accordion Start */
/*-----------------------------------------------------------------------------------*/
$current_date = date('Y-m-d H:i:s'); ## Get current date
$timestamp = strtotime($current_date); ## Get timestamp of current date
$acc_id = $timestamp;
vc_map( 
array(
    'icon' => 'h-code-shortcode-icon fa fa-indent',
    'name' => __( 'Accordion' , 'hcode-addons' ),
    'base' => 'hcode_accordian',
    'category' => 'H-Code',
    'description' => __( 'Create an accordion', 'hcode-addons' ),
    'as_parent' => array('only' => 'hcode_accordian_content'),
    'content_element' => true,
    'show_settings_on_create' => true,
    'params'   => array(
        array(
            'type' => 'dropdown',
            'heading' => __( 'Accordion Pre-define style', 'hcode-addons' ),
            'param_name' => 'accordian_pre_define_style',
            'value' => array(__('Select Pre-define Style', 'hcode-addons') => '',
                      __('Accordion Style 1', 'hcode-addons') => 'accordion-style1',
                      __('Accordion Style 2', 'hcode-addons') => 'accordion-style2',
                      __('Accordion Style 3', 'hcode-addons') => 'accordion-style3',
                      __('Accordion Style 4', 'hcode-addons') => 'accordion-style4',
                      __('Toggle Style 1', 'hcode-addons') => 'toggles-style1',
                      __('Toggle Style 2', 'hcode-addons') => 'toggles-style2',
                      __('Toggle Style 3', 'hcode-addons') => 'toggles-style3',
            ),
            
        ),
        array(
              'type' => 'hcode_preview_image',
              'heading' => __('Select pre-made style', 'hcode-addons'),
              'param_name' => 'accordion_preview_image',
              'admin_label' => true,
              'value' => array(__('Accordion image', 'hcode-addons') => '',
                               __('Accordion image1', 'hcode-addons') => 'accordion-style1',
                               __('Accordion image2', 'hcode-addons') => 'accordion-style2',
                               __('Accordion image3', 'hcode-addons') => 'accordion-style3',
                               __('Accordion image4', 'hcode-addons') => 'accordion-style4',
                               __('Toggle image1', 'hcode-addons') => 'toggles-style1',
                               __('Toggle image2', 'hcode-addons') => 'toggles-style2',
                               __('Toggle image3', 'hcode-addons') => 'toggles-style3',
                              ),
              //'description' => __('Select pre-made slider type.', 'hcode-addons'),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Toggle without border', 'hcode-addons'),
            'param_name' => 'without_border',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select yes to add toggle without left / right border', 'hcode-addons' ),
            'dependency'  => array( 'element' => 'accordian_pre_define_style', 'value' => array('toggles-style3') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Id', 'hcode-addons' ),
          'param_name' => 'accordian_id',
          'value' => $acc_id,
        ),
    ),
    'js_view' => 'VcColumnView'
) );
vc_map( 
array(
    'icon' => 'h-code-shortcode-icon fa fa-indent',
    'name' => __('Add Accordion slides', 'hcode-addons'),
    'base' => 'hcode_accordian_content',
    'description' => __( 'A slide for the Accordion.', 'hcode-addons' ),
    'content_element' => true,
    'as_child' => array('only' => 'hcode_accordian'),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __('Active Slide', 'hcode-addons'),
            'param_name' => 'accordian_active',
            'value' => array(__('Select Active Slide', 'hcode-addons') => '',
                      __('No', 'hcode-addons') => '0',
                      __('Yes', 'hcode-addons') => '1',
          ),
        ),
        array(
          'type' => 'hcode_etline_icon',
          'heading' => __('Title Icon', 'hcode-addons' ),
          'param_name' => 'accordian_title_icon',
          'description' => __( 'select icon then it shows', 'hcode-addons' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Title', 'hcode-addons' ),
          'param_name' => 'accordian_title',
        ),
        array(
            'type' => 'textarea_html',
            'heading' => __('Description', 'hcode-addons'),
            'param_name' => 'content'
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('Image', 'hcode-addons' ),
            'param_name' => 'accordian_bg_image',
        ),
        array(
            'type'        => 'vc_link',
            'heading'     => __('Button config', 'hcode-addons' ),
            'param_name'  => 'button_text',
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Icon Color', 'hcode-addons' ),
            'param_name' => 'hcode_icon_color',
            'description' => __( 'Choose Icon Color', 'hcode-addons' ),
            'group' => 'Color Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Color', 'hcode-addons' ),
            'param_name' => 'hcode_title_color',
            'description' => __( 'Choose Title Color', 'hcode-addons' ),
            'group' => 'Color Style',
        ),
      )  
  ) );
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_hcode_accordian extends WPBakeryShortCodesContainer {}
}
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_hcode_accordian_content extends WPBakeryShortCode {}
}
/*-----------------------------------------------------------------------------------*/
/* Accordion End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Progress bar Start */
/*-----------------------------------------------------------------------------------*/

vc_map( 
array(
    'icon' => 'h-code-shortcode-icon fa fa-ellipsis-h',
    'name' => __( 'ProgressBar' , 'hcode-addons' ),
    'base' => 'hcode_progress',
    'category' => 'H-Code',
    'description' => __( 'Place a ProgressBar', 'hcode-addons' ),
    'as_parent' => array('only' => 'hcode_progress_content'),
    'content_element' => true,
    'show_settings_on_create' => true,
    'params'   => array(
        array(
            'type' => 'checkbox',
            'heading' => __('Show Width', 'hcode-addons'),
            'param_name' => 'progress_show_width',
            'value'       => array( 'Show Width of ProgressBar' => '1', )
        ),
        array(
          'type' => 'checkbox',
          'heading' => __('Title Inside ProgressBar', 'hcode-addons'),
          'param_name' => 'progress_show_inside_title',
          'value'       => array( 'Show Title Inside ProgressBar' => '1', )
        ),
    ),
    'js_view' => 'VcColumnView'
    ) );

vc_map( 
array(
    'icon' => 'h-code-shortcode-icon fa fa-ellipsis-h',
    'name' => __('Add ProgressBar', 'hcode-addons'),
    'description' => __( 'Add new ProgressBar', 'hcode-addons' ),
    'base' => 'hcode_progress_content',
    'content_element' => true,
    'as_child' => array('only' => 'hcode_progress'),
    'params' => array(
         array(
          'type' => 'textfield',
          'heading' => __( 'Title', 'hcode-addons' ),
          'param_name' => 'progress_title',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Subtitle', 'hcode-addons'),
            'param_name' => 'progress_subtitle'
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Height', 'hcode-addons'),
            'description' => __( 'Define Height of Progressbar in numeric value like 2', 'hcode-addons' ),
            'param_name' => 'progress_height'
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Width', 'hcode-addons'),
            'description' => __( 'Define Width of Progressbar in numeric value like 80', 'hcode-addons' ),
            'param_name' => 'progress_width'
        ),
        array(
          'type' => 'colorpicker',
          'class' => '',
          'heading' => __( 'ProgressBar Color', 'hcode-addons' ),
          'param_name' => 'progress_color',
       ),
      array(
          'type' => 'checkbox',
          'heading' => __('Gradient', 'hcode-addons'),
          'param_name' => 'progress_show_gradient',
          'value'       => array( 'Show Gradient in ProgressBar' => '1', )
      ),
      )  
  ) );
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_hcode_progress extends WPBakeryShortCodesContainer {}
}
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_hcode_progress_content extends WPBakeryShortCode {}
}

/*-----------------------------------------------------------------------------------*/
/* Progress bar End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Button Shortcode Start
/*-----------------------------------------------------------------------------------*/

vc_map( array(
  'icon' => 'h-code-shortcode-icon fa fa-stop',
  'name' => __('Button', 'hcode-addons'),
  'description' => __( 'Add an awesome button', 'hcode-addons' ),  
  'base' => 'hcode_button',
  'category' => 'H-Code',
  'content_element' => true,
  'params' => array(
      array(
        'type' => 'dropdown',
        'heading' => __('Button Style', 'hcode-addons'),
        'param_name' => 'button_style',
        'value' => array(__('Select Button Style', 'hcode-addons') => '',
                  __('Style 1', 'hcode-addons') => 'style1',
                  __('Style 2', 'hcode-addons') => 'style2',
                  __('Style 3', 'hcode-addons') => 'style3',
                  __('Style 4', 'hcode-addons') => 'style4',
                  __('Style 5', 'hcode-addons') => 'style5',
                  __('Style 6', 'hcode-addons') => 'style6',
                  __('Style 7', 'hcode-addons') => 'style7',
                  __('Style 8', 'hcode-addons') => 'style8',
                  __('Style 9', 'hcode-addons') => 'style9',
                  __('Style 10', 'hcode-addons') => 'style10',
                  __('Style 11', 'hcode-addons') => 'style11',
                  __('Style 12', 'hcode-addons') => 'style12',
                  __('Style 13', 'hcode-addons') => 'style13',
                  __('Style 14', 'hcode-addons') => 'style14',
                  __('Style 15', 'hcode-addons') => 'style15',
                  __('Style 16', 'hcode-addons') => 'style16',
                  __('Style 17', 'hcode-addons') => 'style17',
                  __('Style 18', 'hcode-addons') => 'style18',
                  __('Style 19', 'hcode-addons') => 'style19',
                  __('Style 20', 'hcode-addons') => 'style20',
                  __('Style 21', 'hcode-addons') => 'style21',
                  __('Style 22', 'hcode-addons') => 'style22',
                  __('Style 23', 'hcode-addons') => 'style23',
                  __('Style 24', 'hcode-addons') => 'style24',
                  __('Style 25', 'hcode-addons') => 'style25',
        ),
      ),  
      array(
          'type' => 'hcode_preview_image',
          'heading' => __('Select pre-made style', 'hcode-addons'),
          'param_name' => 'hcode_button_preview_image',
          'admin_label' => true,
          'value' => array(__('Please select style', 'hcode-addons') => '',
                            __('Style 1', 'hcode-addons') => 'style1',
                            __('Style 2', 'hcode-addons') => 'style2',
                            __('Style 3', 'hcode-addons') => 'style3',
                            __('Style 4', 'hcode-addons') => 'style4',
                            __('Style 5', 'hcode-addons') => 'style5',
                            __('Style 6', 'hcode-addons') => 'style6',
                            __('Style 7', 'hcode-addons') => 'style7',
                            __('Style 8', 'hcode-addons') => 'style8',
                            __('Style 9', 'hcode-addons') => 'style9',
                            __('Style 10', 'hcode-addons') => 'style10',
                            __('Style 11', 'hcode-addons') => 'style11',
                            __('Style 12', 'hcode-addons') => 'style12',
                            __('Style 13', 'hcode-addons') => 'style13',
                            __('Style 14', 'hcode-addons') => 'style14',
                            __('Style 15', 'hcode-addons') => 'style15',
                            __('Style 16', 'hcode-addons') => 'style16',
                            __('Style 17', 'hcode-addons') => 'style17',
                            __('Style 18', 'hcode-addons') => 'style18',
                            __('Style 19', 'hcode-addons') => 'style19',
                            __('Style 20', 'hcode-addons') => 'style20',
                            __('Style 21', 'hcode-addons') => 'style21',
                            __('Style 22', 'hcode-addons') => 'style22',
                            __('Style 23', 'hcode-addons') => 'style23',
                            __('Style 24', 'hcode-addons') => 'style24',
                            __('Style 25', 'hcode-addons') => 'style25',
                          ),
      ),
      array(
          'type' => 'dropdown',
          'heading' => __('Button Size', 'hcode-addons'),
          'param_name' => 'button_type',
          'value' => array(__('Select Button Size', 'hcode-addons') => '',
                    __('Large', 'hcode-addons') => 'large',
                    __('Medium', 'hcode-addons') => 'medium',
                    __('Small', 'hcode-addons') => 'small',
                    __('Very Small', 'hcode-addons') => 'vsmall',
        ),
          'dependency'  => array( 'element' => 'button_style', 'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9','style10','style11','style12','style13','style14','style15','style16','style17','style18','style19','style20','style21','style24','style25') ),
      ),
      array(
          'type' => 'dropdown',
          'heading' => __('Button Version Type', 'hcode-addons'),
          'param_name' => 'button_version_type',
          'value' => array(__('Select Button Version Type', 'hcode-addons') => '',
                    __('Primary', 'hcode-addons') => 'primary',
                    __('Success', 'hcode-addons') => 'success',
                    __('Info', 'hcode-addons') => 'info',
                    __('Warning', 'hcode-addons') => 'warning',
                    __('Danger', 'hcode-addons') => 'danger',
        ),
          'dependency'  => array( 'element' => 'button_style', 'value' => array('style21','style24','style25') ),
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Add Extra Large Class', 'hcode-addons'),
          'param_name' => 'extra_large',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'dependency'  => array( 'element' => 'button_style', 'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9','style10','style11','style12','style13','style14','style15','style16','style17','style18','style19','style20','style21','style22','style23','style24','style25') ),
          'description' => __( 'Select yes to add extra large class', 'hcode-addons' ),
      ),
      array(
        'type' => 'hcode_fontawesome_icon',
        'heading' => __('Select Font Awesome Icon Type', 'hcode-addons'),
        'param_name' => 'button_icon',
        'admin_label' => true,
        'dependency'  => array( 'element' => 'button_style', 'value' => array('style16','style17','style18','style19','style20','style22','style23') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Button Sub Text', 'hcode-addons'),
          'param_name' => 'button_sub_text',
          'dependency'  => array( 'element' => 'button_style', 'value' => array('style24') ),
      ),
      array(
          'type'        => 'vc_link',
          'heading'     => __('Button Config', 'hcode-addons' ),
          'param_name'  => 'button_text',
          'admin_label' => true,
          'dependency'  => array( 'element' => 'button_style', 'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9','style10','style11','style12','style13','style14','style15','style16','style17','style18','style19','style20','style21','style22','style23','style24','style25') ),
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Required Padding Setting?', 'hcode-addons'),
          'param_name' => 'padding_setting',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'dependency'  => array( 'element' => 'button_style', 'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9','style10','style11','style12','style13','style14','style15','style16','style17','style18','style19','style20','style21','style22','style23','style24','style25') ),
          'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'desktop_padding',
        'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
        'value' => $hcode_desktop_padding,
        'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
        'param_name' => 'custom_desktop_padding',
        'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
        'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'ipad_padding',
        'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
        'value' => $hcode_ipad_padding,
        'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'mobile_padding',
        'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
        'value' => $hcode_mobile_padding,
        'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Required Margin Setting?', 'hcode-addons'),
        'param_name' => 'margin_setting',
        'value' => array(__('No', 'hcode-addons') => '0', 
                         __('Yes', 'hcode-addons') => '1'
                        ),
        'dependency'  => array( 'element' => 'button_style', 'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9','style10','style11','style12','style13','style14','style15','style16','style17','style18','style19','style20','style21','style22','style23','style24','style25') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'desktop_margin',
        'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
        'value' => $hcode_desktop_margin,
        'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
        'param_name' => 'custom_desktop_margin',
        'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
        'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
        'group' => 'Style',
      ),

      array(
        'type' => 'dropdown',
        'param_name' => 'ipad_margin',
        'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
        'value' => $hcode_ipad_margin,
        'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),

      array(
        'type' => 'dropdown',
        'param_name' => 'mobile_margin',
        'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
        'value' => $hcode_mobile_margin,
        'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
          'type' => 'dropdown',
          'param_name' => 'hcode_column_animation_style',
          'heading' => __('Animation Style', 'hcode-addons' ),
          'value' => hcode_animation_style(),
          'dependency'  => array( 'element' => 'button_style', 'value' => array('style1','style2','style3','style4','style5','style6','style7','style8','style9','style10','style11','style12','style13','style14','style15','style16','style17','style18','style19','style20','style21','style22','style23','style24','style25') ),
          'group' => 'Animation',
      ),
      $hcode_vc_extra_id,
      $hcode_vc_extra_class,
  )
) );

/*-----------------------------------------------------------------------------------*/
/*  Button Shortcode End
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Shop Top Five Start */
/*-----------------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Special Product Block', 'hcode-addons'),
  'description' => __( 'Place a special product block', 'hcode-addons' ),  
  'icon' => 'h-code-shortcode-icon fa fa-th-large',
  'base' => 'hcode_shop_top_five',
  'category' => 'H-Code',
  'params' => array(
    $hcode_vc_extra_id,
    $hcode_vc_extra_class,
  )
) );

/*-----------------------------------------------------------------------------------*/
/* Shop Top Five End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Recent Product Start */
/*-----------------------------------------------------------------------------------*/
vc_map( array(
      'name' => __( 'New Arrival Products', 'hcode-addons' ),
      'base' => 'hcode_recent_products',
      'category' => 'H-Code',
      'icon' => 'h-code-shortcode-icon fa fa-rocket',
      'description' => __( 'Place new arrival products block', 'hcode-addons' ),
      'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __('Products Block Style', 'hcode-addons'),
            'param_name' => 'recent_product_type',
            'value' => array(__('Select Products Block Style', 'hcode-addons') => '',
                             __('Slider', 'hcode-addons') => 'slider',
                             __('Grid', 'hcode-addons') => 'grid',
          ),
        ), 
        array(
          'type' => 'textfield',
          'heading' => __( 'Show No. of Total Products', 'hcode-addons' ),
          'description' => __( 'Enter numeric value like 6', 'hcode-addons' ),
          'value' => 6,
          'param_name' => 'per_page',
          'dependency'  => array( 'element' => 'recent_product_type', 'not_empty' => true ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Column Type', 'hcode-addons' ),
          'value' => array(__('Select Column Type', 'hcode-addons') => '',
                           __( '1 Column', 'hcode-addons' ) => '1',
                           __( '2 Columns', 'hcode-addons' ) => '2',
                           __( '3 Columns', 'hcode-addons' ) => '3',
                           __( '4 Columns', 'hcode-addons' ) => '4',
                           __( '6 Columns', 'hcode-addons' ) => '6',
                          ),
          'param_name' => 'columns',
          'dependency'  => array( 'element' => 'recent_product_type', 'value' => array('grid') ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Display Products Order by', 'hcode-addons' ),
          'param_name' => 'orderby',
          'value' => array(__('Select Order by', 'hcode-addons') => '',
                           __( 'Date', 'hcode-addons' ) => 'date',
                           __( 'ID', 'hcode-addons' ) => 'ID',
                           __( 'Author', 'hcode-addons' ) => 'author',
                           __( 'Title', 'hcode-addons' ) => 'title',
                           __( 'Modified', 'hcode-addons' ) => 'modified',
                           __( 'Random', 'hcode-addons' ) => 'rand',
                           __( 'Comment count', 'hcode-addons' ) => 'comment_count',
                           __( 'Menu order', 'hcode-addons' ) => 'menu_order',
                          ),
          'dependency'  => array( 'element' => 'recent_product_type', 'not_empty' => true ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Display Products Sort by', 'hcode-addons' ),
          'param_name' => 'order',
          'value' => array(__('Select Sort by', 'hcode-addons') => '',
                           __( 'Descending', 'hcode-addons' ) => 'DESC',
                           __( 'Ascending', 'hcode-addons' ) => 'ASC',
                          ),
          'dependency'  => array( 'element' => 'recent_product_type', 'not_empty' => true ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'No. of Products Per Page (For Desktop Device)', 'hcode-addons' ),
          'description' => __( 'Enter numeric value like 3', 'hcode-addons' ),          
          'value' => '3',
          'param_name' => 'desktop_per_page',
          'dependency'  => array( 'element' => 'recent_product_type', 'value' => array('slider') ),
          'group'       => 'Slider Config'
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'No. of Products Per Page (For iPad/Tablet Device)', 'hcode-addons' ),
          'description' => __( 'Enter numeric value like 3', 'hcode-addons' ),          
          'value' => '3',
          'param_name' => 'ipad_per_page',
          'dependency'  => array( 'element' => 'recent_product_type', 'value' => array('slider') ),
          'group'       => 'Slider Config'
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'No. of Products Per Page (For Mobile Device)', 'hcode-addons' ),
          'description' => __( 'Enter numeric value like 1', 'hcode-addons' ),          
          'value' => '1',
          'param_name' => 'mobile_per_page',
          'dependency'  => array( 'element' => 'recent_product_type', 'value' => array('slider') ),
          'group'       => 'Slider Config'
        ),
        $hcode_vc_extra_id,
        $hcode_vc_extra_class,
      )
    ) );
/*---------------------------------------------------------------------------*/
/* Recent Product Start */
/*---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Recent Product Start */
/*---------------------------------------------------------------------------*/
vc_map( array(
      'name' => __( 'Featured Products', 'hcode-addons' ),
      'base' => 'hcode_featured_products',
      'category' => 'H-Code',
      'icon' => 'h-code-shortcode-icon fa fa-star-o',
      'description' => __( 'Place a featured products block', 'hcode-addons' ),
      'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __('Products Block Style', 'hcode-addons'),
            'param_name' => 'recent_product_type',
            'value' => array(__('Select Products Block Style', 'hcode-addons') => '',
                             __('Slider', 'hcode-addons') => 'slider',
                             __('Grid', 'hcode-addons') => 'grid',
          ),
        ), 
        array(
          'type' => 'textfield',
          'heading' => __( 'Show No. of Total Products', 'hcode-addons' ),
          'value' => '6',
          'param_name' => 'per_page',
          'description' => __( 'Enter numeric value like 6', 'hcode-addons' ),
          'dependency'  => array( 'element' => 'recent_product_type', 'not_empty' => true ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Column Type', 'hcode-addons' ),
          'value' => array(__('Select Column Type', 'hcode-addons') => '',
                           __( '1 Column', 'hcode-addons' ) => '1',
                           __( '2 Columns', 'hcode-addons' ) => '2',
                           __( '3 Columns', 'hcode-addons' ) => '3',
                           __( '4 Columns', 'hcode-addons' ) => '4',
                           __( '6 Columns', 'hcode-addons' ) => '6',
                          ),
          'param_name' => 'columns',
          'dependency'  => array( 'element' => 'recent_product_type', 'value' => array('grid') ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Display Products Order by', 'hcode-addons' ),
          'param_name' => 'orderby',
          'value' => array(__('Select Order by', 'hcode-addons') => '',
                           __( 'Date', 'hcode-addons' ) => 'date',
                           __( 'ID', 'hcode-addons' ) => 'ID',
                           __( 'Author', 'hcode-addons' ) => 'author',
                           __( 'Title', 'hcode-addons' ) => 'title',
                           __( 'Modified', 'hcode-addons' ) => 'modified',
                           __( 'Random', 'hcode-addons' ) => 'rand',
                           __( 'Comment count', 'hcode-addons' ) => 'comment_count',
                           __( 'Menu order', 'hcode-addons' ) => 'menu_order',
                          ),
          'dependency'  => array( 'element' => 'recent_product_type', 'not_empty' => true ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Display Products Sort by', 'hcode-addons' ),
          'param_name' => 'order',
          'value' => array(__('Select Sort by', 'hcode-addons') => '',
                           __( 'Descending', 'hcode-addons' ) => 'DESC',
                           __( 'Ascending', 'hcode-addons' ) => 'ASC',
                          ),
          'dependency'  => array( 'element' => 'recent_product_type', 'not_empty' => true ),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Pagination', 'hcode-addons'),
            'param_name' => 'show_pagination',
            'value' => array(__('OFF', 'hcode-addons') => '0', 
                             __('ON', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
            'dependency'  => array( 'element' => 'recent_product_type', 'value' => array('slider') ),
            'group'       => 'Slider Config'
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Pagination Style', 'hcode-addons'),
            'param_name' => 'show_pagination_style',
            'admin_label' => true,
            'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                             __('Dot Style', 'hcode-addons') => '0',
                             __('Line Style', 'hcode-addons') => '1',
                             __('Round Style', 'hcode-addons') => '2',
                            ),
            'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
            'group'       => 'Slider Config'
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Pagination Color Style', 'hcode-addons'),
            'param_name' => 'show_pagination_color_style',
            'admin_label' => true,
            'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                             __('Dark Style', 'hcode-addons') => '0',
                             __('Light Style', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
            'group'       => 'Slider Config'
        ),
        array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Show Navigation', 'hcode-addons'),
              'param_name' => 'show_navigation',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
              'dependency'  => array( 'element' => 'recent_product_type', 'value' => array('slider') ),
              'group'       => 'Slider Config'
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Navigation Style', 'hcode-addons'),
            'param_name' => 'show_navigation_style',
            'admin_label' => true,
            'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                             __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                             __('Next/Prev White Arrow', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
            'group'       => 'Slider Config'
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Cursor Color Style', 'hcode-addons'),
            'param_name' => 'show_cursor_color_style',
            'admin_label' => true,
            'value' => array(__('Select Cursor Color Style', 'hcode-addons') => '',
                             __('White Cursor', 'hcode-addons') => 'white-cursor',
                             __('Black Cursor', 'hcode-addons') => 'black-cursor',
                             __('Default Cursor', 'hcode-addons') => 'no-cursor',
                            ),
            'dependency'  => array( 'element' => 'recent_product_type', 'value' => array('slider') ),
            'group'       => 'Slider Config'
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'No. of Products Per Page (For Desktop Device)', 'hcode-addons' ),
          'value' => '3',
          'param_name' => 'desktop_per_page',
          'description' => __( 'Enter numeric value like 3', 'hcode-addons' ),          
          'dependency'  => array( 'element' => 'recent_product_type', 'value' => array('slider') ),
          'group'       => 'Slider Config'
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'No. of Products Per Page (For iPad/Tablet Device)', 'hcode-addons' ),
          'value' => '3',
          'param_name' => 'ipad_per_page',
          'description' => __( 'Enter numeric value like 3', 'hcode-addons' ),          
          'dependency'  => array( 'element' => 'recent_product_type', 'value' => array('slider') ),
          'group'       => 'Slider Config'
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'No. of Products Per Page (For Mobile Device)', 'hcode-addons' ),
          'value' => '1',
          'param_name' => 'mobile_per_page',
          'description' => __( 'Enter numeric value like 1', 'hcode-addons' ),          
          'dependency'  => array( 'element' => 'recent_product_type', 'value' => array('slider') ),
          'group'       => 'Slider Config'
        ),
        array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Autoplay', 'hcode-addons'),
              'param_name' => 'hcode_image_carousel_autoplay',
              'value' => array(__('False', 'hcode-addons') => '0', 
                               __('True', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
              'dependency'  => array( 'element' => 'recent_product_type', 'value' => array('slider') ),
              'group'       => 'Slider Config' 
        ),
        array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Stop On Hover', 'hcode-addons'),
              'param_name' => 'stoponhover',
              'value' => array(__('False', 'hcode-addons') => '0', 
                               __('True', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
              'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
              'group'       => 'Slider Config'
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Slide Delay Time', 'hcode-addons'),
            'param_name' => 'slidespeed',
            'admin_label' => true,
            'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                             __('500', 'hcode-addons') => '500',
                             __('600', 'hcode-addons') => '600',
                             __('700', 'hcode-addons') => '700',
                             __('800', 'hcode-addons') => '800',
                             __('900', 'hcode-addons') => '900',
                             __('1000', 'hcode-addons') => '1000',
                             __('1100', 'hcode-addons') => '1100',
                             __('1200', 'hcode-addons') => '1200',
                             __('1300', 'hcode-addons') => '1300',
                             __('1400', 'hcode-addons') => '1400',
                             __('1500', 'hcode-addons') => '1500',
                             __('2000', 'hcode-addons') => '2000',
                             __('3000', 'hcode-addons') => '3000',
                             __('4000', 'hcode-addons') => '4000',
                             __('5000', 'hcode-addons') => '5000',
                             __('6000', 'hcode-addons') => '6000',
                             __('7000', 'hcode-addons') => '7000',
                             __('8000', 'hcode-addons') => '8000',
                             __('9000', 'hcode-addons') => '9000',
                             __('10000', 'hcode-addons') => '10000',
                            ),
            'std' => '3000',
            'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
            'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
            'group'       => 'Slider Config'
        ),
        $hcode_vc_extra_id,
        $hcode_vc_extra_class,
      )
    ) );
/*---------------------------------------------------------------------------*/
/* Recent Product Start */
/*---------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Single Image Shortcode Start */
/*-----------------------------------------------------------------------------------*/
    
vc_map( array(
    'name' => __('Image/Video Content Block', 'hcode-addons'),
    'description' => __( 'Create an image/video content block', 'hcode-addons' ),    
    'icon' => 'fa fa-file-video-o h-code-shortcode-icon',
    'base' => 'hcode_single_image',
    'category' => 'H-Code',
    'params' => array(
      array(
          'type' => 'dropdown',
          'heading' => __('Image/Video Content Block Style', 'hcode-addons'),
          'param_name' => 'hcode_single_image_premade_style',
          'value' => array(__('Select Image/Video Content Block Style', 'hcode-addons') => '',
                           __('Style1', 'hcode-addons') => 'single-image-style1',
                           __('Style2', 'hcode-addons') => 'single-image-style2',
                           __('Style3', 'hcode-addons') => 'single-image-style3',
                           __('Style4', 'hcode-addons') => 'single-image-style4',
                           __('Style5', 'hcode-addons') => 'single-image-style5',
                           __('Style6', 'hcode-addons') => 'single-image-style6',
                           __('Style7', 'hcode-addons') => 'single-image-style7',
                           __('Style8', 'hcode-addons') => 'single-image-style8',
                           __('Style9', 'hcode-addons') => 'single-image-style9',
                           __('Style10', 'hcode-addons') => 'single-image-style10',
                           __('Style11', 'hcode-addons') => 'single-image-style11',
                           __('Style12', 'hcode-addons') => 'single-image-style12',
                           __('Style13', 'hcode-addons') => 'single-image-style13',
                           __('Style14', 'hcode-addons') => 'single-image-style14',
                           __('Style15', 'hcode-addons') => 'single-image-style15',
                           __('Style16', 'hcode-addons') => 'single-image-style16',
                           __('Style17', 'hcode-addons') => 'single-image-style17',
                           __('Style18', 'hcode-addons') => 'single-image-style18',
                           __('Style19', 'hcode-addons') => 'single-image-style19',
                           __('Style20', 'hcode-addons') => 'single-image-style20',
                           __('Style21', 'hcode-addons') => 'single-image-style21',
                           __('Style22', 'hcode-addons') => 'single-image-style22',
                          ),
      ),
      array(
          'type' => 'hcode_preview_image',
          'heading' => __('Select pre-made style', 'hcode-addons'),
          'param_name' => 'hcode_single_image_preview_image',
          'admin_label' => true,
          'value' => array(__('Please select style', 'hcode-addons') => '',
                           __('Style1', 'hcode-addons') => 'single-image-style1',
                           __('Style2', 'hcode-addons') => 'single-image-style2',
                           __('Style3', 'hcode-addons') => 'single-image-style3',
                           __('Style4', 'hcode-addons') => 'single-image-style4',
                           __('Style5', 'hcode-addons') => 'single-image-style5',
                           __('Style6', 'hcode-addons') => 'single-image-style6',
                           __('Style7', 'hcode-addons') => 'single-image-style7',
                           __('Style8', 'hcode-addons') => 'single-image-style8',
                           __('Style9', 'hcode-addons') => 'single-image-style9',
                           __('Style10', 'hcode-addons') => 'single-image-style10',
                           __('Style11', 'hcode-addons') => 'single-image-style11',
                           __('Style12', 'hcode-addons') => 'single-image-style12',
                           __('Style13', 'hcode-addons') => 'single-image-style13',
                           __('Style14', 'hcode-addons') => 'single-image-style14',
                           __('Style15', 'hcode-addons') => 'single-image-style15',
                           __('Style16', 'hcode-addons') => 'single-image-style16',
                           __('Style17', 'hcode-addons') => 'single-image-style17',
                           __('Style18', 'hcode-addons') => 'single-image-style18',
                           __('Style19', 'hcode-addons') => 'single-image-style19',
                           __('Style20', 'hcode-addons') => 'single-image-style20',
                           __('Style21', 'hcode-addons') => 'single-image-style21',
                           __('Style22', 'hcode-addons') => 'single-image-style22',
                          ),
      ),
      array(
          'type' => 'attach_image',
          'heading' => __('Image', 'hcode-addons' ),
          'param_name' => 'single_image_bg_image',
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style2','single-image-style3','single-image-style4','single-image-style12','single-image-style15') ),
        ),
      array(
          'type' => 'attach_image',
          'heading' => __('Background Image', 'hcode-addons' ),
          'param_name' => 'single_image_bg_image_spa',
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style12') ),
        ),
      array(
          'type' => 'textfield',
          'heading' => __('Title', 'hcode-addons'),
          'param_name' => 'single_image_title',
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style1','single-image-style2','single-image-style3','single-image-style4','single-image-style6','single-image-style7','single-image-style8','single-image-style9','single-image-style10','single-image-style11','single-image-style12','single-image-style13','single-image-style14','single-image-style15','single-image-style16','single-image-style18','single-image-style19','single-image-style20','single-image-style22') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Small Title 1', 'hcode-addons'),
          'param_name' => 'single_image_title1',
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style19') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Small Title 2', 'hcode-addons'),
          'param_name' => 'single_image_title2',
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style19') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Small Title 3', 'hcode-addons'),
          'param_name' => 'single_image_title3',
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style19') ),
      ),
      array(
          'type' => 'textarea_html',
          'heading' => __('Content', 'hcode-addons'),
          'param_name' => 'content',
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style2','single-image-style3','single-image-style4','single-image-style5','single-image-style6','single-image-style8','single-image-style9','single-image-style10','single-image-style11','single-image-style12','single-image-style13','single-image-style14','single-image-style15','single-image-style17','single-image-style18','single-image-style20','single-image-style21','single-image-style22') ),
      ),
      array(
          'type' => 'textarea',
          'heading' => __('Extra Content', 'hcode-addons'),
          'param_name' => 'extra_content',
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style20')),
      ),
      array(
          'type' => 'dropdown',
          'heading' => __( 'Video Type', 'hcode-addons' ),
          'param_name' => 'video_type',
          'value' => array(__('Select Video Type', 'hcode-addons') => '',
                           __( 'Self', 'hcode-addons' ) => 'self',
                           __( 'External', 'hcode-addons' ) => 'external',
                          ),
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style4','single-image-style15')),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('MP4 Video URL', 'hcode-addons'),
          'param_name' => 'single_image_mp4_video',
          'dependency'  => array( 'element' => 'video_type', 'value' => array('self') ),
      ), 
      array(
          'type' => 'textfield',
          'heading' => __('OGG Video URL', 'hcode-addons'),
          'param_name' => 'single_image_ogg_video',
          'dependency'  => array( 'element' => 'video_type', 'value' => array('self') ),
      ), 
      array(
          'type' => 'textfield',
          'heading' => __('WEBM Video URL', 'hcode-addons'),
          'param_name' => 'single_image_webm_video',
          'dependency'  => array( 'element' => 'video_type', 'value' => array('self') ),
      ), 
      array(
          'type' => 'textfield',
          'heading' => __('Youtube / Vimeo Video Embed URL', 'hcode-addons'),
          'description' => __( 'Add YOUTUBE VIDEO EMBED URL like https://www.youtube.com/embed/xxxxxxxxxx, you will get this from youtube embed iframe src code. or add VIMEO VIDEO EMBED URL like https://player.vimeo.com/video/xxxxxxxx, you will get this from vimeo embed iframe src code', 'hcode-addons' ),            
          'param_name' => 'external_video_url',
          'dependency'  => array( 'element' => 'video_type', 'value' => array('external') ),
      ),
      array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Enable Loop', 'hcode-addons'),
            'param_name' => 'enable_loop',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'std' => '1',  
            'dependency'  => array( 'element' => 'video_type', 'value' => array('self') ),
      ),
      array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Enable Autoplay', 'hcode-addons'),
            'param_name' => 'enable_autoplay',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'std' => '1',  
            'dependency'  => array( 'element' => 'video_type', 'value' => array('self') ),
      ),
      array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Enable Controls', 'hcode-addons'),
            'param_name' => 'enable_controls',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'std' => '1',  
            'dependency'  => array( 'element' => 'video_type', 'value' => array('self') ),
      ),
      array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Enable Mute', 'hcode-addons'),
            'param_name' => 'enable_mute',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),  
            'dependency'  => array( 'element' => 'video_type', 'value' => array('self') ),
      ),
      array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Full Screen', 'hcode-addons'),
            'param_name' => 'video_fullscreen',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),  
            'dependency'  => array( 'element' => 'video_type', 'value' => array('external') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Youtube Video URL', 'hcode-addons'),
          'description' => __( 'Add YOUTUBE VIDEO URL like https://www.youtube.com/watch?v=xxxxxxxxxx, you will get this from youtube', 'hcode-addons' ),
          'param_name' => 'youtube_video_url',
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style13') ),
      ),
      array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Position Relative', 'hcode-addons'),
            'param_name' => 'position_relative',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),  
            'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style1','single-image-style2','single-image-style3','single-image-style4','single-image-style5','single-image-style6','single-image-style7','single-image-style8','single-image-style9','single-image-style10','single-image-style11','single-image-style12','single-image-style13','single-image-style16','single-image-style17','single-image-style19','single-image-style21','single-image-style22') ),
      ),
      array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Add Container Class', 'hcode-addons'),
            'param_name' => 'hcode_container',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style1','single-image-style2','single-image-style3','single-image-style4','single-image-style5','single-image-style6','single-image-style7','single-image-style8','single-image-style9','single-image-style10','single-image-style11','single-image-style12','single-image-style13','single-image-style16','single-image-style17','single-image-style19','single-image-style21','single-image-style22') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Slide Number Text', 'hcode-addons'),
          'description' => __( 'Slide Number.', 'hcode-addons' ),
          'param_name' => 'single_image_slide_number',
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style11','single-image-style20') ),
      ),
      array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Scroll To Section', 'hcode-addons'),
            'param_name' => 'scroll_to_section',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style1','single-image-style2','single-image-style3','single-image-style4','single-image-style5','single-image-style6','single-image-style7','single-image-style8','single-image-style9','single-image-style10','single-image-style11','single-image-style12','single-image-style13','single-image-style14','single-image-style15','single-image-style16','single-image-style17','single-image-style21','single-image-style22') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Scroll To Section Id', 'hcode-addons'),
          'description' => __( 'Enter Section id like #features', 'hcode-addons' ),
          'param_name' => 'single_image_scroll_to_sectionid',
          'dependency'  => array( 'element' => 'scroll_to_section', 'value' => array('1') ),
      ), 
      array(
          'type' => 'colorpicker',
          'class' => '',
          'heading' => __( 'Text Color', 'hcode-addons' ),
          'param_name' => 'hcode_text_color',
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style1','single-image-style2','single-image-style3','single-image-style4','single-image-style5','single-image-style6','single-image-style7','single-image-style8','single-image-style9','single-image-style10','single-image-style11','single-image-style12','single-image-style13','single-image-style14','single-image-style15','single-image-style16','single-image-style17','single-image-style18','single-image-style19','single-image-style20','single-image-style22') ),
          'group' => 'Color',
      ),
      array(
          'type' => 'colorpicker',
          'class' => '',
          'heading' => __( 'Separator Color', 'hcode-addons' ),
          'param_name' => 'hcode_sep_color',
          'group' => 'Color',
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style5','single-image-style6','single-image-style7','single-image-style8','single-image-style10','single-image-style11','single-image-style12','single-image-style16','single-image-style17','single-image-style20','single-image-style21') ),
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Add FullScreen Class', 'hcode-addons'),
          'param_name' => 'fullscreen',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style1','single-image-style2','single-image-style3','single-image-style4','single-image-style5','single-image-style6','single-image-style7','single-image-style8','single-image-style9','single-image-style10','single-image-style11','single-image-style12','single-image-style13','single-image-style16','single-image-style17','single-image-style19','single-image-style21','single-image-style22') ),
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Do you want to show custom newsletter?', 'hcode-addons'),
          'param_name' => 'hcode_coming_soon_custom_newsletter',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style13') ),
      ),
      array(
          'type' => 'textarea',
          'heading' => __('Add Custom Newsletter Shortcode', 'hcode-addons'),
          'param_name' => 'hcode_custom_newsletter',
          'dependency' => array( 'element' => 'hcode_coming_soon_custom_newsletter', 'value' => array('1') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Placeholder Text', 'hcode-addons'),
          'param_name' => 'hcode_newsletter_placeholder',
          'admin_label' => true,
          'dependency' => array( 'element' => 'hcode_coming_soon_custom_newsletter', 'value' => array('0') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('Subscribe Button Text', 'hcode-addons'),
          'param_name' => 'hcode_newsletter_button_text',
          'admin_label' => true,
          'dependency' => array( 'element' => 'hcode_coming_soon_custom_newsletter', 'value' => array('0') ),
      ),
      array(
        'type'        => 'vc_link',
        'heading'     => __('First Button Config', 'hcode-addons' ),
        'param_name'  => 'first_button_config',
        'admin_label' => true,
        'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style5','single-image-style7','single-image-style9','single-image-style12','single-image-style16','single-image-style21','single-image-style22') ),
      ),
      array(
        'type'        => 'vc_link',
        'heading'     => __('Second Button Config', 'hcode-addons' ),
        'param_name'  => 'second_button_config',
        'admin_label' => true,
        'dependency'  => array( 'element' => 'hcode_single_image_premade_style', 'value' => array('single-image-style5','single-image-style7','single-image-style9','single-image-style16','single-image-style21','single-image-style22') ),
      ),
      $hcode_vc_extra_id,
      $hcode_vc_extra_class,
    ),
) );

/*-----------------------------------------------------------------------------------*/
/* Single Image Shortcode End */
/*-----------------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Product Brand Start */
/*---------------------------------------------------------------------------*/
vc_map( array(
      'name' => __( 'Product Brand Slider/Grid', 'hcode-addons' ),
      'base' => 'hcode_product_brands',
      'category' => 'H-Code',
      'icon' => 'h-code-shortcode-icon fa fa-arrows-h',
      'description' => __( 'Add product brand slider/grid', 'hcode-addons' ),
      'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __('Products Block Style', 'hcode-addons'),
            'param_name' => 'product_brand_type',
            'value' => array(__('Select Products Block Style', 'hcode-addons') => '',
                             __('Slider', 'hcode-addons') => 'slider',
                             __('Grid', 'hcode-addons') => 'grid',
          ),
        ), 
        array(
          'type' => 'dropdown',
          'heading' => __( 'Column Type', 'hcode-addons' ),
          'value' => array(__('Select Column Type', 'hcode-addons') => '',
                           __( '1 Column', 'hcode-addons' ) => '1',
                           __( '2 Columns', 'hcode-addons' ) => '2',
                           __( '3 Columns', 'hcode-addons' ) => '3',
                           __( '4 Columns', 'hcode-addons' ) => '4',
                           __( '6 Columns', 'hcode-addons' ) => '6',
                          ),
          'param_name' => 'columns',
          'dependency'  => array( 'element' => 'product_brand_type', 'value' => array('grid') ),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Brand Title', 'hcode-addons'),
            'param_name' => 'show_brand_title',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'dependency'  => array( 'element' => 'product_brand_type', 'value' => array('slider','grid') ),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Pagination', 'hcode-addons'),
            'param_name' => 'show_pagination',
            'value' => array(__('OFF', 'hcode-addons') => '0', 
                             __('ON', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
            'dependency'  => array( 'element' => 'product_brand_type', 'value' => array('slider') ),
            'group'       => 'Slider Config'
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Pagination Style', 'hcode-addons'),
            'param_name' => 'show_pagination_style',
            'admin_label' => true,
            'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                             __('Dot Style', 'hcode-addons') => '0',
                             __('Line Style', 'hcode-addons') => '1',
                             __('Round Style', 'hcode-addons') => '2',
                            ),
            'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
            'group'       => 'Slider Config'
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Pagination Color Style', 'hcode-addons'),
            'param_name' => 'show_pagination_color_style',
            'admin_label' => true,
            'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                             __('Dark Style', 'hcode-addons') => '0',
                             __('Light Style', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
            'group'       => 'Slider Config'
        ),
        array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Show Navigation', 'hcode-addons'),
              'param_name' => 'show_navigation',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
              'dependency'  => array( 'element' => 'product_brand_type', 'value' => array('slider') ),
              'group'       => 'Slider Config'
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Navigation Style', 'hcode-addons'),
            'param_name' => 'show_navigation_style',
            'admin_label' => true,
            'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                             __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                             __('Next/Prev White Arrow', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
            'group'       => 'Slider Config'
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'No. of Products Per Page (For Desktop Device)', 'hcode-addons' ),
          'value' => '3',
          'param_name' => 'desktop_per_page',
          'description' => __( 'Enter numeric value like 3', 'hcode-addons' ),          
          'dependency'  => array( 'element' => 'product_brand_type', 'value' => array('slider') ),
          'group'       => 'Slider Config'
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'No. of Products Per Page (For iPad/Tablet Device)', 'hcode-addons' ),
          'value' => '3',
          'param_name' => 'ipad_per_page',
          'description' => __( 'Enter numeric value like 3', 'hcode-addons' ),          
          'dependency'  => array( 'element' => 'product_brand_type', 'value' => array('slider') ),
          'group'       => 'Slider Config'
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'No. of Products Per Page (For Mobile Device)', 'hcode-addons' ),
          'value' => '1',
          'param_name' => 'mobile_per_page',
          'description' => __( 'Enter numeric value like 1', 'hcode-addons' ),          
          'dependency'  => array( 'element' => 'product_brand_type', 'value' => array('slider') ),
          'group'       => 'Slider Config'
        ),
        array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Autoplay', 'hcode-addons'),
              'param_name' => 'hcode_image_carousel_autoplay',
              'value' => array(__('False', 'hcode-addons') => '0', 
                               __('True', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
              'dependency'  => array( 'element' => 'product_brand_type', 'value' => array('slider') ),
              'group'       => 'Slider Config' 
        ),
        array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Stop On Hover', 'hcode-addons'),
              'param_name' => 'stoponhover',
              'value' => array(__('False', 'hcode-addons') => '0', 
                               __('True', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
              'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
              'group'       => 'Slider Config'
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Slide Delay Time', 'hcode-addons'),
            'param_name' => 'slidespeed',
            'admin_label' => true,
            'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                             __('500', 'hcode-addons') => '500',
                             __('600', 'hcode-addons') => '600',
                             __('700', 'hcode-addons') => '700',
                             __('800', 'hcode-addons') => '800',
                             __('900', 'hcode-addons') => '900',
                             __('1000', 'hcode-addons') => '1000',
                             __('1100', 'hcode-addons') => '1100',
                             __('1200', 'hcode-addons') => '1200',
                             __('1300', 'hcode-addons') => '1300',
                             __('1400', 'hcode-addons') => '1400',
                             __('1500', 'hcode-addons') => '1500',
                             __('2000', 'hcode-addons') => '2000',
                             __('3000', 'hcode-addons') => '3000',
                             __('4000', 'hcode-addons') => '4000',
                             __('5000', 'hcode-addons') => '5000',
                             __('6000', 'hcode-addons') => '6000',
                             __('7000', 'hcode-addons') => '7000',
                             __('8000', 'hcode-addons') => '8000',
                             __('9000', 'hcode-addons') => '9000',
                             __('10000', 'hcode-addons') => '10000',
                            ),
            'std' => '3000',
            'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
            'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
            'group'       => 'Slider Config'
        ),
        $hcode_vc_extra_id,
        $hcode_vc_extra_class,
      )
    ) );
/*---------------------------------------------------------------------------*/
/* Product Brand Start */
/*---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Team Member Start */
/*---------------------------------------------------------------------------*/
vc_map( array(
      'name' => __( 'Team Member', 'hcode-addons' ),
      'base' => 'hcode_team_member',
      'category' => 'H-Code',
      'icon' => 'h-code-shortcode-icon fa fa-users',
      'description' => __( 'Add team members', 'hcode-addons' ),
      'params' => array(
        array(
          'type' => 'dropdown',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Team Style', 'hcode-addons'),
          'param_name' => 'hcode_team_member_premade_style',
          'value' => array(__('Select Team Style', 'hcode-addons') => '',
                           __('Team Style1', 'hcode-addons') => 'team-style-1',
                           __('Team Style2', 'hcode-addons') => 'team-style-2',
                           __('Team Style3', 'hcode-addons') => 'team-style-3',
                           __('Team Style4', 'hcode-addons') => 'team-style-4',
                           __('Team Style5', 'hcode-addons') => 'team-style-5',
                           __('Team Style6', 'hcode-addons') => 'team-style-6',
                           __('Team Style7', 'hcode-addons') => 'team-style-7',
                          ),
        ),
        array(
          'type' => 'hcode_preview_image',
          'heading' => __('Select pre-made style for tab', 'hcode-addons'),
          'param_name' => 'hcode_team_member_preview_image',
          'admin_label' => true,
          'value' => array(__('Team image', 'hcode-addons') => '',
                           __('Team image1', 'hcode-addons') => 'team-style-1',
                           __('Team image2', 'hcode-addons') => 'team-style-2',
                           __('Team image3', 'hcode-addons') => 'team-style-3',
                           __('Team image4', 'hcode-addons') => 'team-style-4',
                           __('Team image5', 'hcode-addons') => 'team-style-5',
                           __('Team image6', 'hcode-addons') => 'team-style-6',
                           __('Team image7', 'hcode-addons') => 'team-style-7',
                          ),
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Image Position', 'hcode-addons'),
          'param_name' => 'hcode_team_member_image_position',
          'value' => array(__('Right', 'hcode-addons') => '0', 
                           __('Left', 'hcode-addons') => '1'
                          ),
          'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'value' => array('team-style-6') ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => 'Team Image',
          'param_name' => 'hcode_team_member_image',
          'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'not_empty' => true ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Team Member Title', 'hcode-addons' ),
          'param_name' => 'hcode_team_member_title',
          'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'not_empty' => true ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Team Member Designation', 'hcode-addons' ),
          'param_name' => 'hcode_team_member_designation',
          'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'value' => array('team-style-1','team-style-3','team-style-4','team-style-6','team-style-7') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Team Member Headline', 'hcode-addons' ),
          'param_name' => 'hcode_team_member_headline',
          'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'value' => array('team-style-3','team-style-7') ),
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Separator', 'hcode-addons'),
          'param_name' => 'hcode_team_member_separator',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'value' => array('team-style-1','team-style-2','team-style-4','team-style-5','team-style-6','team-style-7') ),
        ),
        array(
          'type' => 'textarea_html',
          'heading' => __('Short Content', 'hcode-addons'),
          'param_name' => 'content',
          'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'not_empty' => true ),
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Text Color', 'hcode-addons' ),
            'param_name' => 'hcode_title_color',
            'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'value' => array('team-style-1','team-style-2','team-style-3','team-style-4','team-style-5','team-style-6','team-style-7') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Separator Color', 'hcode-addons' ),
            'param_name' => 'hcode_separator_color',
            'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'value' => array('team-style-4') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Designation Text Color', 'hcode-addons' ),
            'param_name' => 'hcode_designation_color',
            'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'value' => array('team-style-1','team-style-3','team-style-4','team-style-6','team-style-7') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Background Color', 'hcode-addons' ),
            'param_name' => 'hcode_team_bg_color',
            'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'value' => array('team-style-7') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Facebook Icon', 'hcode-addons'),
            'param_name' => 'hcode_team_member_fb',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'value' => array('team-style-1','team-style-3','team-style-4','team-style-6','team-style-7','team-style-7') ),
            'group'       => 'Social Icons',
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Facebook URL', 'hcode-addons' ),
            'param_name' => 'hcode_team_member_fb_url',
            'dependency' => array( 'element' => 'hcode_team_member_fb', 'value' => array('1') ),
            'group'       => 'Social Icons',
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Twitter Icon', 'hcode-addons'),
            'param_name' => 'hcode_team_member_tw',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'value' => array('team-style-1','team-style-3','team-style-4','team-style-6','team-style-7') ),
            'group'       => 'Social Icons',
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Twitter URL', 'hcode-addons' ),
            'param_name' => 'hcode_team_member_tw_url',
            'dependency' => array( 'element' => 'hcode_team_member_tw', 'value' => array('1') ),
            'group'       => 'Social Icons',
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Google-plus Icon', 'hcode-addons'),
            'param_name' => 'hcode_team_member_googleplus',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'hcode_team_member_premade_style', 'value' => array('team-style-1','team-style-3','team-style-4','team-style-6','team-style-7') ),
            'group'       => 'Social Icons',
        ),
        array(
          'type' => 'textfield',
            'heading' => __( 'Google-plus URL', 'hcode-addons' ),
            'param_name' => 'hcode_team_member_googleplus_url',
            'dependency' => array( 'element' => 'hcode_team_member_googleplus', 'value' => array('1') ),
            'group'       => 'Social Icons',
        ),
        $hcode_vc_extra_id,
        $hcode_vc_extra_class,
      )
    ) );
/*---------------------------------------------------------------------------*/
/* Team Member Start */
/*---------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Team Slider Start */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
      'name' => __( 'Team Member Slider' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
      'base' => 'hcode_team_slider', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
      'category' => 'H-Code',
      'description' => __( 'Place a team members slider', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
      'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
      'as_parent' => array('only' => 'hcode_team_slide_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      'icon' => 'fa fa-arrows-h h-code-shortcode-icon', //URL or CSS class with icon image.
      'js_view' => 'VcColumnView',
      'params' => array( //List of shortcode attributes. Array which holds your shortcode params, these params will be editable in shortcode settings page
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Pagination', 'hcode-addons'),
                'param_name' => 'show_pagination',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Style', 'hcode-addons'),
              'param_name' => 'show_pagination_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                               __('Dot Style', 'hcode-addons') => '0',
                               __('Line Style', 'hcode-addons') => '1',
                               __('Round Style', 'hcode-addons') => '2',
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Color Style', 'hcode-addons'),
              'param_name' => 'show_pagination_color_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                               __('Dark Style', 'hcode-addons') => '0',
                               __('Light Style', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Navigation', 'hcode-addons'),
                'param_name' => 'show_navigation',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Navigation Style', 'hcode-addons'),
              'param_name' => 'show_navigation_style',
              'admin_label' => true,
              'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                               __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                               __('Next/Prev White Arrow', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Cursor Color Style', 'hcode-addons'),
              'param_name' => 'show_cursor_color_style',
              'admin_label' => true,
              'value' => array(__('Select Cursor Color Style', 'hcode-addons') => '',
                               __('White Cursor', 'hcode-addons') => 'white-cursor',
                               __('Black Cursor', 'hcode-addons') => 'black-cursor',
                               __('Default Cursor', 'hcode-addons') => 'no-cursor',
                              ),
          ),
          array(
                'type' => 'textfield',
                'heading' => __( 'No. of Items Per Slide (For Desktop Device)', 'hcode-addons' ),
                'description' => __( 'Enter numeric value like 3', 'hcode-addons' ),
                'param_name' => 'hcode_image_carousel_itemsdesktop',
                'group'       => 'Slider Configuration',
                'value'     => '3',
          ),
          array(
                'type' => 'textfield',
                'heading' => __( 'No. of Items Per Slide (For iPad/Tablet Device)', 'hcode-addons' ),
                'description' => __( 'Enter numeric value like 3', 'hcode-addons' ),
                'param_name' => 'hcode_image_carousel_itemstablet',
                'group'       => 'Slider Configuration',
                'value'     => '3',

          ),
          array(
                'type' => 'textfield',
                'heading' => __( 'No. of Items Per Slide (For Mobile Device)', 'hcode-addons' ),
                'description' => __( 'Enter numeric value like 1', 'hcode-addons' ),
                'param_name' => 'hcode_image_carousel_itemsmobile',
                'group'       => 'Slider Configuration',
                'value'     => '1',
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Autoplay', 'hcode-addons'),
                'param_name' => 'hcode_image_carousel_autoplay',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
                'group'       => 'Slider Configuration'  
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Stop On Hover', 'hcode-addons'),
                'param_name' => 'stoponhover',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
                'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
                'group' => 'Slider Configuration',
          ), 
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Delay Time', 'hcode-addons'),
              'param_name' => 'slidespeed',
              'admin_label' => true,
              'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                               __('500', 'hcode-addons') => '500',
                               __('600', 'hcode-addons') => '600',
                               __('700', 'hcode-addons') => '700',
                               __('800', 'hcode-addons') => '800',
                               __('900', 'hcode-addons') => '900',
                               __('1000', 'hcode-addons') => '1000',
                               __('1100', 'hcode-addons') => '1100',
                               __('1200', 'hcode-addons') => '1200',
                               __('1300', 'hcode-addons') => '1300',
                               __('1400', 'hcode-addons') => '1400',
                               __('1500', 'hcode-addons') => '1500',
                               __('2000', 'hcode-addons') => '2000',
                               __('3000', 'hcode-addons') => '3000',
                               __('4000', 'hcode-addons') => '4000',
                               __('5000', 'hcode-addons') => '5000',
                               __('6000', 'hcode-addons') => '6000',
                               __('7000', 'hcode-addons') => '7000',
                               __('8000', 'hcode-addons') => '8000',
                               __('9000', 'hcode-addons') => '9000',
                               __('10000', 'hcode-addons') => '10000',
                              ),
              'std' => '3000',
              'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
              'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
              'group' => 'Slider Configuration',
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider ID', 'hcode-addons' ),
             'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
             'param_name'  => 'hcode_slider_id',
             'group'       => 'Slider ID & Class'
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider Extra Class', 'hcode-addons' ),
             'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
             'param_name'  => 'hcode_slider_class',
             'group'       => 'Slider ID & Class'
          ),
      ),
  )
);
vc_map( 
  array(
      'name' => __('Add Team Member Slide', 'hcode-addons'),
      'base' => 'hcode_team_slide_content',
      'description' => __( 'Add Team Member Slide Data', 'hcode-addons' ),
      'as_child' => array('only' => 'hcode_team_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
      'icon' => 'fa fa-arrows-h h-code-shortcode-icon', //URL or CSS class with icon image.
      'params' => array(
        array(
          'type' => 'attach_image',
          'heading' => __('Team Image', 'hcode-addons' ),
          'param_name' => 'hcode_team_member_image',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Team Member Title', 'hcode-addons' ),
          'param_name' => 'hcode_team_member_title',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Team Member Designation', 'hcode-addons' ),
          'param_name' => 'hcode_team_member_designation',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Team Member Headline', 'hcode-addons' ),
          'param_name' => 'hcode_team_member_headline',
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Separator', 'hcode-addons'),
          'param_name' => 'hcode_team_member_separator',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
        ),
        array(
          'type' => 'textarea_html',
          'heading' => __('Short Content', 'hcode-addons'),
          'description' => __( 'Short Content.', 'hcode-addons' ),
          'param_name' => 'content',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Text Color', 'hcode-addons' ),
            'param_name' => 'hcode_title_color',
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Designation Text Color', 'hcode-addons' ),
            'param_name' => 'hcode_designation_color',
            'group' => 'Style',
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Facebook Icon', 'hcode-addons'),
          'param_name' => 'hcode_team_member_fb',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'group'       => 'Social Icons',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Facebook URL', 'hcode-addons' ),
          'param_name' => 'hcode_team_member_fb_url',
          'dependency' => array( 'element' => 'hcode_team_member_fb', 'value' => array('1') ),
          'group'       => 'Social Icons',
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Twitter Icon', 'hcode-addons'),
          'param_name' => 'hcode_team_member_tw',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'group'       => 'Social Icons',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Twitter URL', 'hcode-addons' ),
          'param_name' => 'hcode_team_member_tw_url',
          'dependency' => array( 'element' => 'hcode_team_member_tw', 'value' => array('1') ),
          'group'       => 'Social Icons',
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Google-plus Icon', 'hcode-addons'),
          'param_name' => 'hcode_team_member_googleplus',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'group'       => 'Social Icons',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Google-plus URL', 'hcode-addons' ),
          'param_name' => 'hcode_team_member_googleplus_url',
          'dependency' => array( 'element' => 'hcode_team_member_googleplus', 'value' => array('1') ),
          'group'       => 'Social Icons',
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'hcode_column_animation_style',
            'heading' => __('Animation Style', 'hcode-addons' ),
            'value' => hcode_animation_style(),
            'group' => 'Animation',
        ),
        array(
          'type' => 'textfield',
          'heading' => __('Animation Duration', 'hcode-addons' ),
          'param_name' => 'hcode_column_animation_duration',
          'dependency' => array( 'element' => 'hcode_column_animation_style', 'not_empty' => true ),
          'description' => __( 'Add duration like 300ms', 'hcode-addons' ),
          'group' => 'Animation',
        ),
        $hcode_vc_extra_id,
        $hcode_vc_extra_class,
        ),
    ) 
);
if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_team_slider extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_team_slide_content extends WPBakeryShortCode { }
}
/*-----------------------------------------------------------------------------------*/
/* Team Slider End */
/*-----------------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Block Start */
/*---------------------------------------------------------------------------*/
vc_map( array(
      'name' => __( 'Special Content Block', 'hcode-addons' ),
      'base' => 'hcode_content_block',
      'category' => 'H-Code',
      'icon' => 'fa fa-list-alt h-code-shortcode-icon',
      'description' => __( 'Create a special content block', 'hcode-addons' ),
      'params' => array(
        array(
          'type' => 'dropdown',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Content Block Style', 'hcode-addons'),
          'param_name' => 'hcode_block_premade_style',
          'value' => array(__('Select Content Block Style', 'hcode-addons') => '',
                           __('Block Style1', 'hcode-addons') => 'block-1',
                           __('Block Style2', 'hcode-addons') => 'block-2',
                           __('Block Style3', 'hcode-addons') => 'block-3',
                           __('Block Style4', 'hcode-addons') => 'block-4',
                           __('Block Style5', 'hcode-addons') => 'block-5',
                           __('Block Style6', 'hcode-addons') => 'block-6',
                           __('Block Style7', 'hcode-addons') => 'block-7',
                           __('Block Style8', 'hcode-addons') => 'block-8',
                           __('Block Style9', 'hcode-addons') => 'block-9',
                           __('Block Style10', 'hcode-addons') => 'block-10',
                           __('Block Style11', 'hcode-addons') => 'block-11',
                           __('Block Style12', 'hcode-addons') => 'block-12',
                           __('Block Style13', 'hcode-addons') => 'block-13',
                           __('Block Style14', 'hcode-addons') => 'block-14',
                           __('Block Style15', 'hcode-addons') => 'block-15',
                           __('Block Style16', 'hcode-addons') => 'block-16',
                           __('Block Style17', 'hcode-addons') => 'block-17',
                           __('Block Style18', 'hcode-addons') => 'block-18',
                           __('Block Style19', 'hcode-addons') => 'block-19',
                           __('Block Style20', 'hcode-addons') => 'block-20',
                           __('Block Style21', 'hcode-addons') => 'block-21',
                           __('Block Style22', 'hcode-addons') => 'block-22',
                           __('Block Style23', 'hcode-addons') => 'block-23',
                           __('Block Style24', 'hcode-addons') => 'block-24',
                           __('Block Style25', 'hcode-addons') => 'block-25',
                           __('Block Style26', 'hcode-addons') => 'block-26',
                           __('Block Style27', 'hcode-addons') => 'block-27',
                           __('Block Style28', 'hcode-addons') => 'block-28',
                           __('Block Style29', 'hcode-addons') => 'block-29',
                           __('Block Style30', 'hcode-addons') => 'block-30',
                           __('Block Style31', 'hcode-addons') => 'block-31',
                           __('Block Style32', 'hcode-addons') => 'block-32',
                           __('Block Style33', 'hcode-addons') => 'block-33',
                           __('Block Style34', 'hcode-addons') => 'block-34',
                           __('Block Style35', 'hcode-addons') => 'block-35',
                           __('Block Style36', 'hcode-addons') => 'block-36',
                           __('Block Style37', 'hcode-addons') => 'block-37',
                           __('Block Style38', 'hcode-addons') => 'block-38',
                           __('Block Style39', 'hcode-addons') => 'block-39',
                           __('Block Style40', 'hcode-addons') => 'block-40',
                           __('Block Style41', 'hcode-addons') => 'block-41',
                           __('Block Style42', 'hcode-addons') => 'block-42',
                           __('Block Style43', 'hcode-addons') => 'block-43',
                           __('Block Style44', 'hcode-addons') => 'block-44',
                           __('Block Style45', 'hcode-addons') => 'block-45',
                           __('Block Style46', 'hcode-addons') => 'block-46',
                           __('Block Style47', 'hcode-addons') => 'block-47',
                           __('Block Style48', 'hcode-addons') => 'block-48',
                           __('Block Style49', 'hcode-addons') => 'block-49',
                           __('Block Style50', 'hcode-addons') => 'block-50',
                          ),
        ),
        array(
          'type' => 'hcode_preview_image',
          'heading' => __('Select pre-made style for block', 'hcode-addons'),
          'param_name' => 'hcode_block_preview_image',
          'admin_label' => true,
          'value' => array(__('Block image', 'hcode-addons') => '',
                           __('Block image1', 'hcode-addons') => 'block-1',
                           __('Block image2', 'hcode-addons') => 'block-2',
                           __('Block image3', 'hcode-addons') => 'block-3',
                           __('Block image4', 'hcode-addons') => 'block-4',
                           __('Block image5', 'hcode-addons') => 'block-5',
                           __('Block image6', 'hcode-addons') => 'block-6',
                           __('Block image7', 'hcode-addons') => 'block-7',
                           __('Block image8', 'hcode-addons') => 'block-8',
                           __('Block image9', 'hcode-addons') => 'block-9',
                           __('Block image10', 'hcode-addons') => 'block-10',
                           __('Block image11', 'hcode-addons') => 'block-11',
                           __('Block image12', 'hcode-addons') => 'block-12',
                           __('Block image13', 'hcode-addons') => 'block-13',
                           __('Block image14', 'hcode-addons') => 'block-14',
                           __('Block image15', 'hcode-addons') => 'block-15',
                           __('Block image16', 'hcode-addons') => 'block-16',
                           __('Block image17', 'hcode-addons') => 'block-17',
                           __('Block image18', 'hcode-addons') => 'block-18',
                           __('Block image19', 'hcode-addons') => 'block-19',
                           __('Block image20', 'hcode-addons') => 'block-20',
                           __('Block image21', 'hcode-addons') => 'block-21',
                           __('Block image22', 'hcode-addons') => 'block-22',
                           __('Block image23', 'hcode-addons') => 'block-23',
                           __('Block image24', 'hcode-addons') => 'block-24',
                           __('Block image25', 'hcode-addons') => 'block-25',
                           __('Block image26', 'hcode-addons') => 'block-26',
                           __('Block image27', 'hcode-addons') => 'block-27',
                           __('Block image28', 'hcode-addons') => 'block-28',
                           __('Block image29', 'hcode-addons') => 'block-29',
                           __('Block image30', 'hcode-addons') => 'block-30',
                           __('Block image31', 'hcode-addons') => 'block-31',
                           __('Block image32', 'hcode-addons') => 'block-32',
                           __('Block image33', 'hcode-addons') => 'block-33',
                           __('Block image34', 'hcode-addons') => 'block-34',
                           __('Block image35', 'hcode-addons') => 'block-35',
                           __('Block image36', 'hcode-addons') => 'block-36',
                           __('Block image37', 'hcode-addons') => 'block-37',
                           __('Block image38', 'hcode-addons') => 'block-38',
                           __('Block image39', 'hcode-addons') => 'block-39',
                           __('Block image40', 'hcode-addons') => 'block-40',
                           __('Block image41', 'hcode-addons') => 'block-41',
                           __('Block image42', 'hcode-addons') => 'block-42',
                           __('Block image43', 'hcode-addons') => 'block-43',
                           __('Block image44', 'hcode-addons') => 'block-44',
                           __('Block image45', 'hcode-addons') => 'block-45',
                           __('Block image46', 'hcode-addons') => 'block-46',
                           __('Block image47', 'hcode-addons') => 'block-47',
                           __('Block image48', 'hcode-addons') => 'block-48',
                           __('Block image49', 'hcode-addons') => 'block-49',
                           __('Block image50', 'hcode-addons') => 'block-50',
                          ),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Set Block Position Right', 'hcode-addons'),
            'param_name' => 'hcode_block_position_right',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-46') ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __('Block Image', 'hcode-addons' ),
          'param_name' => 'hcode_block_image',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-1','block-4','block-5','block-7','block-18','block-19','block-22','block-25','block-26','block-27','block-29','block-33','block-34','block-35','block-36','block-37','block-39','block-40','block-42','block-43','block-44','block-49','block-50') ),
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Set Image Position', 'hcode-addons'),
          'param_name' => 'hcode_image_position',
          'value' => array(__('Right', 'hcode-addons') => '0', 
                           __('Left', 'hcode-addons') => '1'
                          ),
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-19') ),
        ),
        array(
          'type' => 'hcode_etline_icon',
          'heading' => __('Icon', 'hcode-addons' ),
          'param_name' => 'hcode_block_icon',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-2', 'block-20', 'block-24', 'block-30', 'block-31', 'block-32') ),
        ),
        array(
          'type' => 'hcode_icon',
          'heading' => __('Icon', 'hcode-addons' ),
          'param_name' => 'hcode_block_icon_list',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-13') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Block Title', 'hcode-addons' ),
          'param_name' => 'hcode_block_title',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-1','block-2','block-3','block-4','block-5','block-6','block-7','block-8','block-9','block-10','block-11', 'block-12', 'block-13','block-14','block-15', 'block-16', 'block-17','block-19','block-20','block-21', 'block-22', 'block-23', 'block-24','block-25','block-26','block-27','block-28','block-29', 'block-30', 'block-31', 'block-32','block-34','block-35','block-36','block-37','block-38','block-39','block-40','block-41','block-42','block-43','block-44', 'block-45', 'block-46', 'block-47', 'block-48','block-49','block-50') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Block Subtitle', 'hcode-addons' ),
          'param_name' => 'hcode_block_subtitle',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-3','block-4','block-8','block-9','block-10','block-11','block-20','block-25','block-26','block-27','block-29','block-36','block-37','block-39', 'block-45', 'block-47','block-49','block-50') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Block Number', 'hcode-addons' ),
          'param_name' => 'hcode_block_number',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-20','block-21', 'block-23','block-28','block-44', 'block-48') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Block Hover Title', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_title',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-20') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Block Price', 'hcode-addons' ),
          'param_name' => 'hcode_block_price',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-43') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Block Title URL', 'hcode-addons' ),
          'param_name' => 'hcode_block_title_url',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-9','block-34','block-36') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Block Discount off Text', 'hcode-addons' ),
          'param_name' => 'hcode_block_gifts_off',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-9') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Event Date', 'hcode-addons' ),
          'param_name' => 'hcode_block_event_date',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-30') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Event Time', 'hcode-addons' ),
          'param_name' => 'hcode_block_event_time',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-30') ),
        ),
        array(
          'type' => 'textarea_html',
          'heading' => __( 'Content', 'hcode-addons' ),
          'param_name' => 'content',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-1','block-2','block-3','block-4','block-5','block-6','block-8','block-11', 'block-12', 'block-13','block-15', 'block-16', 'block-17', 'block-18','block-19','block-21','block-22', 'block-23', 'block-24','block-26','block-28','block-29', 'block-30','block-37','block-38','block-39','block-40','block-42','block-43','block-44', 'block-46', 'block-47', 'block-48') ),
        ),
        array(
        'type' => 'dropdown',
        'heading' => __('Stars', 'hcode-addons'),
        'param_name' => 'hcode_stars',
        'admin_label' => true,
        'value' => array(__('Select Stars', 'hcode-addons') => '',
                         __('Star 1', 'hcode-addons') => '1',
                         __('Star 2', 'hcode-addons') => '2', 
                         __('Star 3', 'hcode-addons') => '3',
                         __('Star 4', 'hcode-addons') => '4',
                         __('Star 5', 'hcode-addons') => '5',
                        ),
        'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-36','block-37') ),
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Image Position', 'hcode-addons'),
          'param_name' => 'hcode_block_image_position',
          'value' => array(__('Right', 'hcode-addons') => '0', 
                           __('Left', 'hcode-addons') => '1'
                          ),
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-4') ),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Separator', 'hcode-addons'),
            'param_name' => 'hcode_block_show_separator',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-1','block-4','block-8','block-22', 'block-24','block-29','block-30','block-39','block-40', 'block-46', 'block-50') ),
        ),
        array(
          'type'        => 'vc_link',
          'heading'     => __('Button Config', 'hcode-addons' ),
          'param_name'  => 'button_config',
          'admin_label' => true,
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-1','block-2','block-4','block-6','block-8', 'block-18','block-30','block-37','block-38','block-39','block-42', 'block-45','block-49') ),
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Add Border', 'hcode-addons'),
          'param_name' => 'hcode_border_class',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-33') ),
        ),
        array(
          'type' => 'hcode_etline_icon',
          'heading' => __('Hover Icon1', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_icon1',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-49') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Hover Title1', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_title1',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-49') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Hover Subtitle1', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_subtitle1',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-49') ),
        ),
        array(
          'type' => 'hcode_etline_icon',
          'heading' => __('Hover Icon2', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_icon2',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-49') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Hover Title2', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_title2',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-49') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Hover Subtitle2', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_subtitle2',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-49') ),
        ),
        array(
          'type' => 'textarea',
          'heading' => __( 'Hover Content', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_content',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-49') ),
        ),
        array(
          'type' => 'textarea',
          'heading' => __( 'Small Title', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_small_title',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __('Destinations Image1', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_image1',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Destinations Title1', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_title1',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Destinations Block URL', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_url1',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Destinations SubTitle1', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_subtitle1',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __('Destinations Image2', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_image2',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Destinations Title2', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_title2',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Destinations Block URL2', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_url2',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Destinations SubTitle2', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_subtitle2',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __('Destinations Image3', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_image3',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Destinations Title3', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_title3',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Destinations Block URL3', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_url3',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Destinations SubTitle3', 'hcode-addons' ),
          'param_name' => 'hcode_block_hover_destinations_subtitle3',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-50') ),
        ),
        array(
          'type'        => 'vc_link',
          'heading'     => __('Hover Button Config', 'hcode-addons' ),
          'param_name'  => 'hover_button_config',
          'admin_label' => true,
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-49') ),
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Telephone', 'hcode-addons'),
          'param_name' => 'hcode_block_telephone',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-1') ),
          'group'       => 'Other Settings',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Telephone', 'hcode-addons' ),
          'param_name' => 'hcode_block_telephone_number',
          'dependency' => array( 'element' => 'hcode_block_telephone', 'value' => array('1') ),
          'group'       => 'Other Settings',
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Email', 'hcode-addons'),
          'param_name' => 'hcode_block_email',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-1') ),
          'group'       => 'Other Settings',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Email', 'hcode-addons' ),
          'param_name' => 'hcode_block_email_url',
          'dependency' => array( 'element' => 'hcode_block_email', 'value' => array('1') ),
          'group'       => 'Other Settings',
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Facebook Icon', 'hcode-addons'),
          'param_name' => 'hcode_block_facebook',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-29') ),
          'group'       => 'Other Settings',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Facebook URL', 'hcode-addons' ),
          'param_name' => 'hcode_block_facebook_url',
          'dependency' => array( 'element' => 'hcode_block_facebook', 'value' => array('1') ),
          'group'       => 'Other Settings',
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Twitter Icon', 'hcode-addons'),
          'param_name' => 'hcode_block_twitter',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-29') ),
          'group'       => 'Other Settings',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Twitter URL', 'hcode-addons' ),
          'param_name' => 'hcode_block_twitter_url',
          'dependency' => array( 'element' => 'hcode_block_twitter', 'value' => array('1') ),
          'group'       => 'Other Settings',
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Google-plus Icon', 'hcode-addons'),
          'param_name' => 'hcode_block_googleplus',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-29') ),
          'group'       => 'Other Settings',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Google-plus URL', 'hcode-addons' ),
          'param_name' => 'hcode_block_googleplus_url',
          'dependency' => array( 'element' => 'hcode_block_googleplus', 'value' => array('1') ),
          'group'       => 'Other Settings',
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Dribbble Icon', 'hcode-addons'),
          'param_name' => 'hcode_block_dribbble',
          'value' => array(__('NO', 'hcode-addons') => '0', 
                           __('YES', 'hcode-addons') => '1'
                          ),
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-29') ),
          'group'       => 'Other Settings',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Dribbble URL', 'hcode-addons' ),
          'param_name' => 'hcode_block_dribbble_url',
          'dependency' => array( 'element' => 'hcode_block_dribbble', 'value' => array('1') ),
          'group'       => 'Other Settings',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Title Font Size', 'hcode-addons' ),
          'description' => __( 'Define font size like 12px', 'hcode-addons' ),
          'param_name' => 'hcode_block_title_font_size',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-8','block-26') ),
          'group'       => 'Style',
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Title Line height', 'hcode-addons' ),
          'description' => __( 'Define line height like 20px', 'hcode-addons' ),
          'param_name' => 'hcode_block_title_line_height',
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-8','block-26') ),
          'group'       => 'Style',
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Select Icon Size', 'hcode-addons'),
            'param_name' => 'hcode_block_icon_size',
            'admin_label' => true,
            'value' => array(__('Default', 'hcode-addons') => '',
                             __('Extra Large', 'hcode-addons') => 'extra-large-icon', 
                             __('Large', 'hcode-addons') => 'large-icon',
                             __('Medium', 'hcode-addons') => 'medium-icon',
                             __('Small', 'hcode-addons') => 'small-icon',
                             __('Extra Small', 'hcode-addons') => 'extra-small-icon',
                            ),
            'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-2','block-13', 'block-20', 'block-24', 'block-30', 'block-31', 'block-32') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Icon Color', 'hcode-addons' ),
            'param_name' => 'hcode_block_icon_color',
            'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-2','block-13', 'block-20', 'block-24', 'block-30', 'block-31','block-32','block-36','block-37') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Text Color', 'hcode-addons' ),
            'param_name' => 'hcode_block_title_color',
            'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-1','block-2','block-3','block-4','block-5','block-6','block-7','block-8','block-9','block-10','block-11','block-12','block-13','block-14','block-15','block-16','block-17','block-19', 'block-20', 'block-21', 'block-22','block-23', 'block-24','block-25','block-27','block-28','block-29', 'block-30', 'block-31','block-32', 'block-34','block-35','block-36','block-37','block-38','block-39','block-40','block-41','block-42','block-43','block-44', 'block-45', 'block-46', 'block-47', 'block-48','block-49','block-50') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'SubTitle Text Color', 'hcode-addons' ),
            'param_name' => 'hcode_block_subtitle_color',
            'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-3','block-4','block-8','block-9','block-10','block-11','block-20','block-25','block-26','block-27','block-29','block-36','block-37','block-39', 'block-45', 'block-47','block-49','block-50') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Button Background Color', 'hcode-addons' ),
            'param_name' => 'hcode_block_button_color',
            'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-6','block-38') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Button Text Color', 'hcode-addons' ),
            'param_name' => 'hcode_block_button_text_color',
            'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-6','block-38') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Border Color', 'hcode-addons' ),
            'param_name' => 'hcode_block_button_border_color',
            'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-6') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Button Arrow Color', 'hcode-addons' ),
            'param_name' => 'hcode_block_button_arrow_color',
            'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-38') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Block Hover Color', 'hcode-addons' ),
            'param_name' => 'hcode_block_hover_color',
            'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-20') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Block BackGround color', 'hcode-addons' ),
            'param_name' => 'hcode_block_bg_color',
            'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-39', 'block-46') ),
            'group' => 'Style',
        ),
        array(
          'type' => 'dropdown',
          'param_name' => 'hcode_animation_style',
          'heading' => __('Animation Style', 'hcode-addons' ),
          'value' => hcode_animation_style(),
          'dependency' => array( 'element' => 'hcode_block_premade_style', 'value' => array('block-10') ),
          'group' => 'Animation',
        ),
        $hcode_vc_extra_id,
        $hcode_vc_extra_class,
      )
    ) );
/*---------------------------------------------------------------------------*/
/* Block End */
/*---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Single Image Start */
/*---------------------------------------------------------------------------*/

vc_map( array(
      'name' => __( 'Simple Image', 'hcode-addons' ),
      'base' => 'hcode_simple_image',
      'category' => 'H-Code',
      'icon' => 'h-code-shortcode-icon fa fa-picture-o',
      'description' => __( 'Add an image with different options', 'hcode-addons' ),
      'params' => array(
          array(
            'type' => 'attach_image',
            'heading' => __('Block Image', 'hcode-addons' ),
            'param_name' => 'hcode_image',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Full Image in Mobile Device', 'hcode-addons'),
            'param_name' => 'hcode_mobile_full_image',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Show Image With Border', 'hcode-addons'),
            'param_name' => 'hcode_image_with_border',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Url', 'hcode-addons' ),
            'param_name' => 'hcode_url',
            'description' => __( 'Define url of image', 'hcode-addons' ),
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __( 'Target Blank', 'hcode-addons'),
            'param_name' => 'hcode_target_blank',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
          ),
          /* Add image caption in H-Code v1.5 */
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __( 'Show Image Caption', 'hcode-addons'),
            'param_name' => 'hcode_show_image_caption',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Image Caption Position', 'hcode-addons' ),
            'param_name' => 'hcode_image_caption_position',
            'value' => array(__( 'Select Caption Position', 'hcode-addons' ) => '',
                             __( 'Top', 'hcode-addons' ) => 'image-caption-top',
                             __( 'Bottom', 'hcode-addons' ) => 'image-caption-bottom',
                            ),
            'dependency' => array( 'element' => 'hcode_show_image_caption', 'value' => array('1') ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Caption Text Alignment', 'hcode-addons' ),
            'param_name' => 'hcode_image_caption_text_alignment',
            'value' => array(__( 'None', 'hcode-addons' ) => '',
                             __( 'Left', 'hcode-addons' ) => 'text-left',
                             __( 'Center', 'hcode-addons' ) => 'text-center',
                             __( 'Right', 'hcode-addons' ) => 'text-right',
                            ),
            'dependency' => array( 'element' => 'hcode_show_image_caption', 'value' => array('1') ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Min Height', 'hcode-addons' ),
            'param_name' => 'hcode_min_height',
            'dependency' => array( 'element' => 'hcode_image_with_border', 'value' => array('1') ),
            'description' => __( 'Define Min height like 500px', 'hcode-addons' ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'heading' => __('Min Height For Mobile Device', 'hcode-addons' ),
            'param_name' => 'hcode_mobile_min_height',
            'value' => array(__('Select Min Height For Mobile Device', 'hcode-addons') => '',
                             __('min-height 100px', 'hcode-addons') => 'min-height-100', 
                             __('min-height 150px', 'hcode-addons') => 'min-height-150', 
                             __('min-height 200px', 'hcode-addons') => 'min-height-200', 
                             __('min-height 250px', 'hcode-addons') => 'min-height-250',
                             __('min-height 300px', 'hcode-addons') => 'min-height-300', 
                             __('min-height 350px', 'hcode-addons') => 'min-height-350', 
                             __('min-height 400px', 'hcode-addons') => 'min-height-400', 
                             __('min-height 450px', 'hcode-addons') => 'min-height-450',
                             __('min-height 500px', 'hcode-addons') => 'min-height-500', 
                             __('min-height 550px', 'hcode-addons') => 'min-height-550', 
                             __('min-height 600px', 'hcode-addons') => 'min-height-600', 
                             __('min-height 650px', 'hcode-addons') => 'min-height-650',

                            ),
            'dependency' => array( 'element' => 'hcode_image_with_border', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Alignment Setting', 'hcode-addons'),
            'param_name' => 'alignment_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select Yes to set div in alignment of column', 'hcode-addons' ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_alignment',
            'heading' => __('Alignment (For Desktop Device)', 'hcode-addons' ),
            'value' => array(__('No Align', 'hcode-addons') => '',
                             __('Left Align', 'hcode-addons') => 'alignleft',
                             __('Right Align', 'hcode-addons') => 'alignright',
                             __('Center Align', 'hcode-addons') => 'aligncenter',
                            ),
            'dependency' => array( 'element' => 'alignment_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_alignment',
            'heading' => __('Alignment (For iPad/Tablet Device)', 'hcode-addons' ),
            'value' => array(__('No Align', 'hcode-addons') => '',
                             __('Left Align', 'hcode-addons') => 'sm-alignleft',
                             __('Right Align', 'hcode-addons') => 'sm-alignright',
                             __('Center Align', 'hcode-addons') => 'sm-aligncenter',
                            ),
            'dependency' => array( 'element' => 'alignment_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_alignment',
            'heading' => __('Alignment (For Mobile Device)', 'hcode-addons' ),
            'value' => array(__('No Align', 'hcode-addons') => '',
                             __('Left Align', 'hcode-addons') => 'xs-alignleft',
                             __('Right Align', 'hcode-addons') => 'xs-alignright',
                             __('Center Align', 'hcode-addons') => 'xs-aligncenter',
                            ),
            'dependency' => array( 'element' => 'alignment_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Padding Setting?', 'hcode-addons'),
            'param_name' => 'padding_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_padding',
            'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_padding',
            'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
            'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

              'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_padding',
            'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
              'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_padding',
            'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
              'group' => 'Style',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Margin Setting?', 'hcode-addons'),
            'param_name' => 'margin_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
              'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_margin',
            'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
              'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_margin',
            'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
            'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
              'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_margin',
            'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
              'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_margin',
            'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
              'group' => 'Style',
          ),
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,
      )
    ) );

/*---------------------------------------------------------------------------*/
/* Single Image End */
/*---------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Tabs Start */
/*-----------------------------------------------------------------------------------*/

$tab_id_1 = time() . '-1-' . rand( 0, 100 );
$tab_id_2 = time() . '-2-' . rand( 0, 100 );
vc_map( array(
  'name' => __( 'Tabs', 'hcode-addons' ),
  'base' => 'vc_tabs',
  'category' => 'H-Code',
  'show_settings_on_create' => false,
  'is_container' => true,
  'icon' => 'icon-wpb-ui-tab-content',
  //'category' => __( 'Content', 'hcode-addons' ),
  'description' => __( 'Place Tabbed Content', 'hcode-addons' ),
  'params' => array(
    array(
        'type' => 'dropdown',
        'heading' => __('Tabs Style', 'hcode-addons'),
        'param_name' => 'tabs_style',
        'admin_label' => true,
        'class' => 'hcode_select_preview_image',
        'value' => array(__('Select Tabs Style', 'hcode-addons') => '',
                         __('Tab Style1', 'hcode-addons') => 'tab-style1',
                         __('Tab Style2', 'hcode-addons') => 'tab-style2', 
                         __('Tab Style3', 'hcode-addons') => 'tab-style3', 
                         __('Tab Style4', 'hcode-addons') => 'tab-style4',
                         __('Tab Style5', 'hcode-addons') => 'tab-style5',
                         __('Animated Tab1', 'hcode-addons') => 'animated-tab1',
                         __('Animated Tab2', 'hcode-addons') => 'animated-tab2',
                         __('Animated Tab3', 'hcode-addons') => 'animated-tab3',
                         __('Animated Tab4', 'hcode-addons') => 'animated-tab4',
                        ),
    ),
    array(
        'type' => 'hcode_preview_image',
        'heading' => __('Select pre-made style for tab', 'hcode-addons'),
        'param_name' => 'tab_preview_image',
        'admin_label' => true,
        'value' => array(__('Tab image', 'hcode-addons') => '',
                         __('Tab image1', 'hcode-addons') => 'tab-style1',
                         __('Tab image2', 'hcode-addons') => 'tab-style2',
                         __('Tab image3', 'hcode-addons') => 'tab-style3',
                         __('Tab image4', 'hcode-addons') => 'tab-style4',
                         __('Tab image5', 'hcode-addons') => 'tab-style5',
                         __('Animated image1', 'hcode-addons') => 'animated-tab1',
                         __('Animated image2', 'hcode-addons') => 'animated-tab2',
                         __('Animated image3', 'hcode-addons') => 'animated-tab3',
                         __('Animated image4', 'hcode-addons') => 'animated-tab4',
                        ),
    ),
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Show Separator', 'hcode-addons'),
        'param_name' => 'hcode_tab_show_separator',
        'value' => array(__('OFF', 'hcode-addons') => '0', 
                         __('ON', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'tabs_style', 'value' => array('animated-tab4') ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __( 'Active Tab', 'hcode-addons' ),
        'param_name' => 'active_tab',
        'value' => '1',
        'group' => 'Tab Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'tabs_alignment',
      'heading' => __('Tabs Alignment', 'hcode-addons' ),
      'value' => array(__('No Align', 'hcode-addons') => '',
                       __('Left Align', 'hcode-addons') => 'text-left',
                       __('Right Align', 'hcode-addons') => 'text-right',
                       __('Center Align', 'hcode-addons') => 'text-center',
                      ),
      'description' => __( 'Alignment', 'hcode-addons' ),
      'group' => 'Tab Style',
    ),
    $hcode_vc_extra_id,
    $hcode_vc_extra_class,
  ),
  'custom_markup' => '<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
                      <ul class="tabs_controls">
                      </ul>
                      %content%
                      </div>',
  'default_content' => '[vc_tab title="' . __( 'Tab 1', 'hcode-addons' ) . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
                        [vc_tab title="' . __( 'Tab 2', 'hcode-addons' ) . '" tab_id="' . $tab_id_2 . '"][/vc_tab]',
  'js_view' => 'VcTabsView'
) );

vc_map( array(
  'name' => __( 'Tab', 'hcode-addons' ),
  'base' => 'vc_tab',
  'category' => 'H-Code',
  'allowed_container_element' => 'vc_row',
  'is_container' => true,
  'content_element' => false,
  'params' => array(
    array(
        'type' => 'tab_id',
        'heading' => __( 'Tab ID', 'hcode-addons' ),
        'param_name' => 'tab_id'
    ),
    array(
        'type' => 'textfield',
        'heading' => __( 'Tab Title', 'hcode-addons' ),
        'param_name' => 'title',
        'value' => '',
    ),
    array(
        'type' => 'hcode_icon',
        'heading' => __('Select Tab Icon', 'hcode-addons'),
        'param_name' => 'tab_icon',
        'admin_label' => true,
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'heading' => __('Show Tab Title', 'hcode-addons'),
      'param_name' => 'show_title',
      'value' => array(__('NO', 'hcode-addons') => '0',
                       __('YES', 'hcode-addons') => '1'
                      ),
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'heading' => __('Show Tab Icon', 'hcode-addons'),
      'param_name' => 'show_icon',
      'value' => array(__('NO', 'hcode-addons') => '0',
                       __('YES', 'hcode-addons') => '1'
                      ),
    ),
  ),
  'js_view' => 'VcTabView'
) );

/*-----------------------------------------------------------------------------------*/
/* Tabs End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Tab Content Shortcode Start */
/*-----------------------------------------------------------------------------------*/
    
vc_map( array(
    'name' => __('Tab Content Block', 'hcode-addons'),
    'description' => __( 'Create a tab content block', 'hcode-addons' ),    
    'icon' => 'fa fa-list-alt h-code-shortcode-icon',
    'base' => 'hcode_tab_content',
    'category' => 'H-Code',
    'params' => array(
      array(
        'type' => 'dropdown',
        'heading' => __('Tab Content Style', 'hcode-addons'),
        'param_name' => 'hcode_tab_content_premade_style',
        'value' => array(__('Select Tab Content Style', 'hcode-addons') => '',
                         __('Tab Content1', 'hcode-addons') => 'tab-content1',
                         __('Tab Content2', 'hcode-addons') => 'tab-content2',
                         __('Tab Content3', 'hcode-addons') => 'tab-content3',
                         __('Tab Content4', 'hcode-addons') => 'tab-content4',
                         __('Tab Content5 ( Spa Treatments )', 'hcode-addons') => 'tab-content5',
                        ),
      ),
      array(
        'type' => 'hcode_preview_image',
        'heading' => __('Select pre-made style', 'hcode-addons'),
        'param_name' => 'hcode_tab_content_preview_image',
        'admin_label' => true,
        'value' => array(__('Tab content image', 'hcode-addons') => '',
                         __('Tab content image1', 'hcode-addons') => 'tab-content1',
                         __('Tab content image2', 'hcode-addons') => 'tab-content2',
                         __('Tab content image3', 'hcode-addons') => 'tab-content3',
                         __('Tab content image4', 'hcode-addons') => 'tab-content4',
                         __('Tab content image5', 'hcode-addons') => 'tab-content5',
                        ),
      ),
      /* Tab content left part */
      array(
        'type' => 'attach_image',
        'heading' => __('Left Background Image', 'hcode-addons'),
        'param_name' => 'hcode_tab_content_left_bgimage',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1','tab-content5') ),
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'hcode_tab_content_left_bgimage_type',
        'heading' => __('Background Image Type', 'hcode-addons' ),
        'value' => array(__('Select Background Image Type', 'hcode-addons') => '',
                         __('Fix Background', 'hcode-addons') => 'fix-background',
                         __('Cover Background', 'hcode-addons') => 'cover-background',
                        ),
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1','tab-content5') ),
      ),
      array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Overlay Div', 'hcode-addons'),
        'param_name' => 'hcode_tab_content_left_bgimage_show_overlay',
        'value' => array(__('OFF', 'hcode-addons') => '0', 
                         __('ON', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1') ),
        'description' => __( 'Select ON to show overlay on Image', 'hcode-addons' ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Number Text', 'hcode-addons'),
        'param_name' => 'hcode_tab_content_left_number',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1') ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Title', 'hcode-addons'),
        'param_name' => 'hcode_tab_content_left_title',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'not_empty' => true ),
      ),
      array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Show Separator', 'hcode-addons'),
        'param_name' => 'hcode_tab_content_left_title_show_separator',
        'value' => array(__('OFF', 'hcode-addons') => '0', 
                         __('ON', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content2') ),
      ),
      array(
        'type' => 'textarea',
        'heading' => __('Left Content', 'hcode-addons'),
        'param_name' => 'hcode_tab_content_left_content',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content2') ),
      ),
      /* Tab content right part */
      array(
        'type' => 'hcode_etline_icon',
        'heading' => __('Icon', 'hcode-addons' ),
        'param_name' => 'hcode_tab_content_right_icon',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1') ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Right Title', 'hcode-addons' ),
        'param_name' => 'hcode_tab_content_right_title',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1', 'tab-content2', 'tab-content3') ),
      ),
      array(
        'type' => 'textarea_html',
        'heading' => __( 'Content', 'hcode-addons' ),
        'param_name' => 'content',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1','tab-content2','tab-content3','tab-content4','tab-content5') ),
      ),
      array(
        'type'        => 'vc_link',
        'heading'     => __('Button Config', 'hcode-addons' ),
        'param_name'  => 'hcode_tab_content_right_button_config',
        'admin_label' => true,
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1','tab-content5') ),
      ),
      array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Show Separator Line', 'hcode-addons'),
        'param_name' => 'hcode_tab_content_left_title_show_separator_line',
        'value' => array(__('OFF', 'hcode-addons') => '0', 
                         __('ON', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content2', 'tab-content3') ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Bottom Title', 'hcode-addons' ),
        'param_name' => 'hcode_tab_content_bottom_title',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1', 'tab-content2', 'tab-content3') ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Counter Number1', 'hcode-addons' ),
        'param_name' => 'hcode_tab_content_counter_number1',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content2', 'tab-content4') ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Counter Text1', 'hcode-addons' ),
        'param_name' => 'hcode_tab_content_counter_text1',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content2', 'tab-content4') ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Counter Number2', 'hcode-addons' ),
        'param_name' => 'hcode_tab_content_counter_number2',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content2', 'tab-content4') ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Counter Text2', 'hcode-addons' ),
        'param_name' => 'hcode_tab_content_counter_text2',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content2', 'tab-content4') ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Counter Number3', 'hcode-addons' ),
        'param_name' => 'hcode_tab_content_counter_number3',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content2', 'tab-content4') ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Counter Text3', 'hcode-addons' ),
        'param_name' => 'hcode_tab_content_counter_text3',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content2', 'tab-content4') ),
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Number Color', 'hcode-addons' ),
        'param_name' => 'hcode_number_color',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Title Color', 'hcode-addons' ),
        'param_name' => 'hcode_title_color',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Icon Color', 'hcode-addons' ),
        'param_name' => 'hcode_icon_color',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Content Color', 'hcode-addons' ),
        'param_name' => 'hcode_content_color',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Button Color', 'hcode-addons' ),
        'param_name' => 'hcode_button_color',
        'dependency' => array( 'element' => 'hcode_tab_content_premade_style', 'value' => array('tab-content1') ),
        'group' => 'Style',
      ),
    ),
) );

/*-----------------------------------------------------------------------------------*/
/* Tab Content Shortcode End */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Image Gallery Shortcode
/*-----------------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Image Gallery', 'hcode-addons'),
  'description' => __( 'Simple/lightbox/zoom image gallery', 'hcode-addons' ),  
  'icon' => 'h-code-shortcode-icon fa fa-picture-o',
  'base' => 'hcode_image_gallery',
  'category' => 'H-Code',
  'params' => array(
    array(
        'type' => 'dropdown',
        'heading' => __('Image Gallery Type', 'hcode-addons'),
        'param_name' => 'image_gallery_type',
        'value' => array(__('Select Image Gallery Type', 'hcode-addons') => '',
                  __('Simple Image Lightbox', 'hcode-addons') => 'simple-image-lightbox',
                  __('Lightbox Gallery', 'hcode-addons') => 'lightbox-gallery',
                  __('Zoom Gallery', 'hcode-addons') => 'zoom-gallery',
      ),
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Style', 'hcode-addons'),
        'param_name' => 'simple_image_type',
        'value' => array(__('Select Style', 'hcode-addons') => '',
                  __('Zoom', 'hcode-addons') => 'zoom',
                  __('Feet Horizontal-vertical', 'hcode-addons') => 'feet',
        ),
        'dependency'  => array( 'element' => 'image_gallery_type', 'value' => array('simple-image-lightbox','lightbox-gallery','zoom-gallery')),
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Lightbox Type', 'hcode-addons'),
        'param_name' => 'lightbox_type',
        'value' => array(__('Select Lightbox Type', 'hcode-addons') => '',
                  __('Grid', 'hcode-addons') => 'grid',
                  __('Masonry', 'hcode-addons') => 'masonry',
        ),
        'dependency'  => array( 'element' => 'image_gallery_type', 'value' => array('lightbox-gallery') )
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Column Type', 'hcode-addons'),
        'param_name' => 'column',
        'value' => array(__('Select Column Type', 'hcode-addons') => '',
                  __('1 column', 'hcode-addons') => '1',
                  __('2 columns', 'hcode-addons') => '2',
                  __('3 columns', 'hcode-addons') => '3',
                  __('4 columns', 'hcode-addons') => '4',
                  __('6 columns', 'hcode-addons') => '6',
        ),
        'dependency'  => array( 'element' => 'image_gallery_type', 'value' => array('lightbox-gallery') )
    ),
    array(
        'type' => 'attach_images',
        'heading' => __('Image', 'hcode-addons'),
        'param_name' => 'image_gallery',
        'holder' => 'div',
        'dependency'  => array( 'element' => 'image_gallery_type', 'value' => array('simple-image-lightbox','lightbox-gallery','zoom-gallery')),
    ),
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Hide Lightbox Gallery?', 'hcode-addons'),
        'param_name' => 'hide_lightbox_gallery',
        'value' => array(__('No', 'hcode-addons') => '0', 
                         __('Yes', 'hcode-addons') => '1'
                        ),
        'dependency'  => array( 'element' => 'image_gallery_type', 'value' => array('simple-image-lightbox','lightbox-gallery','zoom-gallery')),
      ),
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Required Padding Setting?', 'hcode-addons'),
        'param_name' => 'padding_setting',
        'value' => array(__('No', 'hcode-addons') => '0', 
                         __('Yes', 'hcode-addons') => '1'
                        ),
        'dependency'  => array( 'element' => 'image_gallery_type', 'value' => array('simple-image-lightbox','lightbox-gallery','zoom-gallery')),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'desktop_padding',
        'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
        'value' => $hcode_desktop_padding,
        'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
        'param_name' => 'custom_desktop_padding',
        'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
        'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'ipad_padding',
        'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
        'value' => $hcode_ipad_padding,
        'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'mobile_padding',
        'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
        'value' => $hcode_mobile_padding,
        'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Required Margin Setting?', 'hcode-addons'),
        'param_name' => 'margin_setting',
        'value' => array(__('No', 'hcode-addons') => '0', 
                         __('Yes', 'hcode-addons') => '1'
                        ),
        'dependency'  => array( 'element' => 'image_gallery_type', 'value' => array('simple-image-lightbox','lightbox-gallery','zoom-gallery')),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'desktop_margin',
        'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
        'value' => $hcode_desktop_margin,
        'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),

      array(
        'type' => 'textfield',
        'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
        'param_name' => 'custom_desktop_margin',
        'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
        'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'ipad_margin',
        'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
        'value' => $hcode_ipad_margin,
        'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'mobile_margin',
        'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
        'value' => $hcode_mobile_margin,
        'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        'group' => 'Style',
      ),
      array(
      'type' => 'dropdown',
      'param_name' => 'hcode_column_animation_style',
      'heading' => __('Animation Style', 'hcode-addons' ),
      'value' => hcode_animation_style(),
      'dependency'  => array( 'element' => 'image_gallery_type', 'value' => array('simple-image-lightbox','lightbox-gallery','zoom-gallery')),
      'group' => 'Animation',
    ),
      $hcode_vc_extra_id,
      $hcode_vc_extra_class,
  )
) );

/*-----------------------------------------------------------------------------------*/
/*  Image Gallery Shortcode End
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Start Popup Shortcode
/*-----------------------------------------------------------------------------------*/

$date = date('Y-m-d H:i:s'); ## Get current date
$time = strtotime($date); ## Get timestamp of current date
vc_map( array(
  'name' => __('Popup', 'hcode-addons'),
  'description' => __('Add a popup with content ', 'hcode-addons'),
  'icon' => 'fa fa-files-o h-code-shortcode-icon',
  'base' => 'hcode_popup',
  'category' => 'H-Code',
  'params' => array(
      array(
          'type' => 'dropdown',
          'heading' => __('Popup Type', 'hcode-addons'),
          'param_name' => 'popup_type',
          'value' => array(__('Select Popup Type', 'hcode-addons') => '',
                    __('Popup Form 1', 'hcode-addons') => 'popup-form-1',
                    __('Popup Form 2', 'hcode-addons') => 'popup-form-2',
                    __('Simple Modal Popup', 'hcode-addons') => 'modal-popup',
                    __('Popup With Zoom', 'hcode-addons') => 'popup-with-zoom-anim',
                    __('Popup with Fade', 'hcode-addons') => 'popup-with-move-anim',
                    __('Ajax Popup', 'hcode-addons') => 'simple-ajax-popup-align-top',
                    __('Youtube Video 1', 'hcode-addons') => 'youtube-video-1',
                    __('Youtube Video 2', 'hcode-addons') => 'youtube-video-2',
                    __('Vimeo Video 1', 'hcode-addons') => 'vimeo-video-1',
                    __('Vimeo Video 2', 'hcode-addons') => 'vimeo-video-2',
                    __('Google Map 1', 'hcode-addons') => 'google-map-1',
                    __('Google Map 2', 'hcode-addons') => 'google-map-2',
        ),
      ),
      array(
          'type' => 'hcode_preview_image',
          'heading' => __('Select pre-made style for Popup', 'hcode-addons'),
          'param_name' => 'popup_preview_image',
          'admin_label' => true,
          'value' => array(__('Select Popup', 'hcode-addons') => '',
                    __('Popup Form 1', 'hcode-addons') => 'popup-form-1',
                    __('Popup Form 2', 'hcode-addons') => 'popup-form-2',
                    __('Simple Modal Popup', 'hcode-addons') => 'modal-popup',
                    __('Popup With Zoom', 'hcode-addons') => 'popup-with-zoom-anim',
                    __('Popup with Fade', 'hcode-addons') => 'popup-with-move-anim',
                    __('Ajax Popup', 'hcode-addons') => 'simple-ajax-popup-align-top',
                    __('Youtube Video 1', 'hcode-addons') => 'youtube-video-1',
                    __('Youtube Video 2', 'hcode-addons') => 'youtube-video-2',
                    __('Vimeo Video 1', 'hcode-addons') => 'vimeo-video-1',
                    __('Vimeo Video 2', 'hcode-addons') => 'vimeo-video-2',
                    __('Google Map 1', 'hcode-addons') => 'google-map-1',
                    __('Google Map 2', 'hcode-addons') => 'google-map-2',
        ),
      ),
      array(
          'type' => 'hcode_etline_icon',
          'heading' => __('Select Et-Line Icon Type', 'hcode-addons'),
          'param_name' => 'hcode_et_line_icon_list',
          'admin_label' => true,
          'dependency'  => array( 'element' => 'popup_type', 'value' => array('youtube-video-2','vimeo-video-2','google-map-2')),
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Title', 'hcode-addons'),
        'param_name' => 'popup_title',
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('modal-popup','popup-with-zoom-anim','popup-with-move-anim','simple-ajax-popup-align-top','youtube-video-2','vimeo-video-2','google-map-2') ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Inside Popup Title', 'hcode-addons'),
        'param_name' => 'inside_popup_title',
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('modal-popup','popup-with-zoom-anim','popup-with-move-anim') ),
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Select Contact Form', 'hcode-addons' ),
        'param_name' => 'contact_forms_shortcode',
        'value' => $contact_forms,
        'description' => __( 'Choose previously created contact form from the drop down list.', 'hcode-addons' ),
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('popup-form-1','popup-form-2') ),
      ),
      array(
        'type' => 'textarea_html',
        'heading' => __('Content', 'hcode-addons'),
        'param_name' => 'content',
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('popup-form-1','popup-form-2','modal-popup','popup-with-zoom-anim','popup-with-move-anim','youtube-video-1','youtube-video-2','vimeo-video-1','vimeo-video-2','google-map-1','google-map-2') ),
      ),
      array(
        'type'        => 'vc_link',
        'heading'     => __('Button Config', 'hcode-addons'),
        'param_name'  => 'popup_button_config',
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('popup-form-1','popup-form-2','modal-popup','popup-with-zoom-anim','popup-with-move-anim','simple-ajax-popup-align-top','vimeo-video-1','google-map-1') ),
      ),
      array(
        'type'        => 'vc_link',
        'heading'     => __('Button Config', 'hcode-addons'),
        'param_name'  => 'popup_button_config_youtube',
        'description' => __( 'Add YOUTUBE VIDEO URL like https://www.youtube.com/watch?v=xxxxxxxxxx, you will get this from youtube.', 'hcode-addons' ),            
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('youtube-video-1') ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __('External URL', 'hcode-addons'),
        'param_name' => 'popup_external_url',
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('vimeo-video-2','google-map-2')),
      ),
      array(
        'type' => 'textfield',
        'heading' => __('External URL', 'hcode-addons'),
        'param_name' => 'popup_external_url_youtube',
        'description' => __( 'Add YOUTUBE VIDEO URL like https://www.youtube.com/watch?v=xxxxxxxxxx, you will get this from youtube.', 'hcode-addons' ),            
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('youtube-video-2')),
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Form Id', 'hcode-addons'),
        'param_name' => 'popup_form_id',
        'value' => $time,
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('popup-form-1','popup-form-2','modal-popup','popup-with-zoom-anim','popup-with-move-anim') ),
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Title Text Color', 'hcode-addons' ),
        'param_name' => 'hcode_title_color',
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('modal-popup','popup-with-zoom-anim','popup-with-move-anim','simple-ajax-popup-align-top','youtube-video-2','vimeo-video-2','google-map-2') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Icon Color', 'hcode-addons' ),
        'param_name' => 'hcode_icon_color',
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('youtube-video-2','vimeo-video-2','google-map-2')),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('SM Width', 'hcode-addons' ),
        'param_name' => 'width',
        'value' => $hcode_vc_column,
        'group' => 'Responsive Options',
        'description' => 'Select column width',
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('popup-form-1','popup-form-2','modal-popup','popup-with-zoom-anim','popup-with-move-anim') ),
      ),
      array(
        'type' => 'column_offset',
        'heading' => __('Responsiveness', 'hcode-addons' ),
        'param_name' => 'offset',
        'group' => 'Responsive Options',
        'description' => 'Adjust column for different screen sizes. Control width, offset and visibility settings.',
        'dependency'  => array( 'element' => 'popup_type', 'value' => array('popup-form-1','popup-form-2','modal-popup','popup-with-zoom-anim','popup-with-move-anim') ),
      ),
  )
) );

/*-----------------------------------------------------------------------------------*/
/*  End Popup Shortcode
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Start Space Shortcode
/*-----------------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Blank Space', 'hcode-addons'),
  'description' => __( 'Add blank space with padding/margin', 'hcode-addons' ),  
  'icon' => 'fa fa-square-o h-code-shortcode-icon',
  'base' => 'hcode_space',
  'category' => 'H-Code',
  'params' => array(
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Required Padding Setting?', 'hcode-addons'),
          'param_name' => 'padding_setting',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
        ),
        array(
          'type' => 'dropdown',
          'param_name' => 'desktop_padding',
          'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
          'value' => $hcode_desktop_padding,
          'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
          'param_name' => 'custom_desktop_padding',
          'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
          'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
        ),
        array(
          'type' => 'dropdown',
          'param_name' => 'ipad_padding',
          'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
          'value' => $hcode_ipad_padding,
          'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        ),
        array(
          'type' => 'dropdown',
          'param_name' => 'mobile_padding',
          'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
          'value' => $hcode_mobile_padding,
          'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        ),
        array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Required Margin Setting?', 'hcode-addons'),
          'param_name' => 'margin_setting',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
        ),
        array(
          'type' => 'dropdown',
          'param_name' => 'desktop_margin',
          'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
          'value' => $hcode_desktop_margin,
          'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
          'param_name' => 'custom_desktop_margin',
          'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
          'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
        ),
        array(
          'type' => 'dropdown',
          'param_name' => 'ipad_margin',
          'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
          'value' => $hcode_ipad_margin,
          'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        ),
        array(
          'type' => 'dropdown',
          'param_name' => 'mobile_margin',
          'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
          'value' => $hcode_mobile_margin,
          'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        ),
  )
) );

/*-----------------------------------------------------------------------------------*/
/*  End Space Shortcode
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Start Divider Shortcode
/*-----------------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Divider', 'hcode-addons'),
  'description' => __( 'Add a divider with different options', 'hcode-addons' ),  
  'icon' => 'fa fa-arrows-v h-code-shortcode-icon',
  'base' => 'hcode_divider',
  'category' => 'H-Code',
  'params' => array(
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_row_border_position',
            'heading' => __('Row Border Position', 'hcode-addons' ),
            'value' => array(__('No Border', 'hcode-addons') => '',
                             __('Border Top', 'hcode-addons') => 'border-top',
                             __('Border Bottom', 'hcode-addons') => 'border-bottom',
                            ),
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Border Color', 'hcode-addons' ),
            'param_name' => 'hcode_row_border_color',
            'dependency' => array( 'element' => 'hcode_row_border_position', 'value' => array('border-top','border-bottom') ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Border Size', 'hcode-addons' ),
            'param_name' => 'hcode_border_size',
            'dependency' => array( 'element' => 'hcode_row_border_position', 'value' => array('border-top','border-bottom') ),
            'description' => __( 'Define border size like 2px', 'hcode-addons' ),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'hcode_border_type',
            'heading' => __('Border Type', 'hcode-addons' ),
            'value' => array(__('no border', 'hcode-addons') => '',
                             __('Dotted', 'hcode-addons') => 'dotted',
                             __('Dashed', 'hcode-addons') => 'dashed',
                             __('Solid', 'hcode-addons') => 'solid',
                             __('Double', 'hcode-addons') => 'double',
                            ),
            'dependency' => array( 'element' => 'hcode_row_border_position', 'value' => array('border-top','border-bottom') ),
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Required Padding Setting?', 'hcode-addons'),
              'param_name' => 'padding_setting',
              'value' => array(__('No', 'hcode-addons') => '0', 
                               __('Yes', 'hcode-addons') => '1'
                              ),
              'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_padding',
            'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_padding',
            'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
            'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_padding',
            'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_padding',
            'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Margin Setting?', 'hcode-addons'),
            'param_name' => 'margin_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_margin',
            'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_margin',
            'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
            'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
            'group' => 'Style',
          ),

          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_margin',
            'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_margin',
            'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
  )
) );

/*-----------------------------------------------------------------------------------*/
/*  End Divider Shortcode
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Start Testimonial Slider */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
      'name' => __( 'Testimonials Slider' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
      'base' => 'hcode_testimonial', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
      'category' => 'H-Code',
      'description' => __( 'Place a testimonials slider', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
      'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
      'as_parent' => array('only' => 'hcode_testimonial_slide_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
      'js_view' => 'VcColumnView',
      'params' => array( //List of shortcode attributes. Array which holds your shortcode params, these params will be editable in shortcode settings page
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Show Pagination', 'hcode-addons'),
              'param_name' => 'show_pagination',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Style', 'hcode-addons'),
              'param_name' => 'show_pagination_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                               __('Dot Style', 'hcode-addons') => '0',
                               __('Line Style', 'hcode-addons') => '1',
                               __('Round Style', 'hcode-addons') => '2',
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Color Style', 'hcode-addons'),
              'param_name' => 'show_pagination_color_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                               __('Dark Style', 'hcode-addons') => '0',
                               __('Light Style', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Cursor Color Style', 'hcode-addons'),
              'param_name' => 'show_cursor_color_style',
              'admin_label' => true,
              'value' => array(__('Select Cursor Color Style', 'hcode-addons') => '',
                               __('White Cursor', 'hcode-addons') => 'white-cursor',
                               __('Black Cursor', 'hcode-addons') => 'black-cursor',
                               __('Default Cursor', 'hcode-addons') => 'no-cursor',
                              ),
          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For Desktop Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 3', 'hcode-addons' ), 
                'param_name' => 'hcode_image_carousel_itemsdesktop',
                'group'       => 'Slider Configuration',
                'value'     => '3',
                'dependency'  => array( 'element' => 'hcode_image_carousel_singleitem', 'value' => array('0') ),
          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For iPad/Tablet Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 3', 'hcode-addons' ),
                'param_name' => 'hcode_image_carousel_itemstablet',
                'group'       => 'Slider Configuration',
                'value'     => '3',
                'dependency'  => array( 'element' => 'hcode_image_carousel_singleitem', 'value' => array('0') ),

          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For Mobile Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 1', 'hcode-addons' ), 
                'param_name' => 'hcode_image_carousel_itemsmobile',
                'group'       => 'Slider Configuration',
                'value'     => '1',
                'dependency'  => array( 'element' => 'hcode_image_carousel_singleitem', 'value' => array('0') ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Single Item', 'hcode-addons'),
                'param_name' => 'hcode_image_carousel_singleitem',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select True to show single item', 'hcode-addons' ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Autoplay', 'hcode-addons'),
                'param_name' => 'hcode_image_carousel_autoplay',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
                'group'       => 'Slider Configuration'  
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Stop On Hover', 'hcode-addons'),
                'param_name' => 'stoponhover',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
                'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
                'group' => 'Slider Configuration',
          ),
          
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Delay Time', 'hcode-addons'),
              'param_name' => 'slidespeed',
              'admin_label' => true,
              'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                               __('500', 'hcode-addons') => '500',
                               __('600', 'hcode-addons') => '600',
                               __('700', 'hcode-addons') => '700',
                               __('800', 'hcode-addons') => '800',
                               __('900', 'hcode-addons') => '900',
                               __('1000', 'hcode-addons') => '1000',
                               __('1100', 'hcode-addons') => '1100',
                               __('1200', 'hcode-addons') => '1200',
                               __('1300', 'hcode-addons') => '1300',
                               __('1400', 'hcode-addons') => '1400',
                               __('1500', 'hcode-addons') => '1500',
                               __('2000', 'hcode-addons') => '2000',
                               __('3000', 'hcode-addons') => '3000',
                               __('4000', 'hcode-addons') => '4000',
                               __('5000', 'hcode-addons') => '5000',
                               __('6000', 'hcode-addons') => '6000',
                               __('7000', 'hcode-addons') => '7000',
                               __('8000', 'hcode-addons') => '8000',
                               __('9000', 'hcode-addons') => '9000',
                               __('10000', 'hcode-addons') => '10000',
                              ),
              'std' => '3000',
              'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
              'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
              'group' => 'Slider Configuration',
          ),
          array(
               'type'        => 'textfield',
               'heading'     => __('Slider ID', 'hcode-addons' ),
               'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
               'param_name'  => 'hcode_slider_id',
               'group'       => 'Slider ID & Class'
          ),
          array(
               'type'        => 'textfield',
               'heading'     => __('Slider Extra Class', 'hcode-addons' ),
               'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
               'param_name'  => 'hcode_slider_class',
               'group'       => 'Slider ID & Class'
          ),
      ),
  )
);
vc_map( 
  array(
      'name' => __('Add Testimonial', 'hcode-addons'),
      'base' => 'hcode_testimonial_slide_content',
      'description' => __( 'Add testimonial details', 'hcode-addons' ),
      'as_child' => array('only' => 'hcode_testimonial'), // Use only|except attributes to limit parent (separate multiple values with comma)
      'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
      'params' => array(
          array(
              'type' => 'attach_image',
              'heading' => __('Testimonial Image', 'hcode-addons'),
              'param_name' => 'image',
              'holder' => 'div',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Testimonial Title', 'hcode-addons'),
              'param_name' => 'title'
          ),
          array(
            'type' => 'textarea_html',
            'heading' => __('Content', 'hcode-addons'),
            'description' => __( 'Content.', 'hcode-addons' ),
            'param_name' => 'content',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Enable Icon', 'hcode-addons'),
            'param_name' => 'hcode_icon',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'description' => __( 'Select Yes to show Icon', 'hcode-addons' ),
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Color', 'hcode-addons' ),
            'param_name' => 'hcode_title_color',
            'group' => 'Style',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Icon Color', 'hcode-addons' ),
            'param_name' => 'hcode_icon_color',
            'dependency'  => array( 'element' => 'hcode_icon', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'heading' => __('Icon Size', 'hcode-addons'),
            'param_name' => 'hcode_icon_size',
            'admin_label' => true,
            'value' => array(__('Select Icon Size', 'hcode-addons') => '',
                             __('Extra Large', 'hcode-addons') => 'extra-large-icon', 
                             __('Large', 'hcode-addons') => 'large-icon',
                             __('Medium', 'hcode-addons') => 'medium-icon',
                             __('Small', 'hcode-addons') => 'small-icon',
                             __('Extra Small', 'hcode-addons') => 'extra-small-icon',
                            ),
            'dependency'  => array( 'element' => 'hcode_icon', 'value' => array('1') ),
            'group' => 'Style',
          ),
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,

        ),
    ) 
);
/* Main Slider class*/
if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_testimonial extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_testimonial_slide_content extends WPBakeryShortCode { }
}

/*-----------------------------------------------------------------------------------*/
/* End Testimonial Slider */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Start Careers
/*-----------------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Career Content Block', 'hcode-addons'),
  'description' => __( 'Place a career content block', 'hcode-addons' ),  
  'icon' => 'fa fa-list-alt h-code-shortcode-icon',
  'base' => 'hcode_career',
  'category' => 'H-Code',
  'params' => array(
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Show Left Section', 'hcode-addons'),
        'param_name' => 'hcode_career_left',
        'value' => array(__('OFF', 'hcode-addons') => '0', 
                         __('ON', 'hcode-addons') => '1',
                        ),
        'description' => __( 'Select ON to show left section', 'hcode-addons' ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Number Text', 'hcode-addons'),
        'param_name' => 'hcode_career_number',
        'dependency'  => array( 'element' => 'hcode_career_left', 'value' => array('1') ),
    ),
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Show Separator', 'hcode-addons'),
        'param_name' => 'hcode_career_show_separator',
        'value' => array(__('OFF', 'hcode-addons') => '0', 
                         __('ON', 'hcode-addons') => '1'
                        ),
        'dependency'  => array( 'element' => 'hcode_career_left', 'value' => array('1') ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Job Title', 'hcode-addons'),
        'param_name' => 'hcode_career_job_title',
        'dependency'  => array( 'element' => 'hcode_career_left', 'value' => array('1') ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Job Experience', 'hcode-addons'),
        'param_name' => 'hcode_career_job_experince',
        'dependency'  => array( 'element' => 'hcode_career_left', 'value' => array('1') ),
    ),
    array(
        'type'        => 'vc_link',
        'heading'     => __('Button Config', 'hcode-addons' ),
        'param_name'  => 'hcode_career_apply_now',
        'admin_label' => true,
        'dependency'  => array( 'element' => 'hcode_career_left', 'value' => array('1') ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Urgent Job Text', 'hcode-addons'),
        'param_name' => 'hcode_career_urgent_job',
        'dependency'  => array( 'element' => 'hcode_career_left', 'value' => array('1') ),
    ),  
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Show Middle Section', 'hcode-addons'),
        'param_name' => 'hcode_career_right',
        'value' => array(__('OFF', 'hcode-addons') => '0', 
                         __('ON', 'hcode-addons') => '1'
                        ),
        'description' => __( 'Select ON to show middle section', 'hcode-addons' ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Overview Title', 'hcode-addons'),
        'param_name' => 'hcode_career_overview_title',
        'dependency'  => array( 'element' => 'hcode_career_right', 'value' => array('1') ),
    ),
    array(
        'type' => 'textarea',
        'heading' => __('Overview Content', 'hcode-addons'),
        'param_name' => 'hcode_career_overview_content',
        'dependency'  => array( 'element' => 'hcode_career_right', 'value' => array('1') ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Responsibilities', 'hcode-addons'),
        'param_name' => 'hcode_career_responsibilities_title',
        'dependency'  => array( 'element' => 'hcode_career_right', 'value' => array('1') ),
    ),
    
    array(
        'type' => 'textarea',
        'heading' => __('Responsibilities Content', 'hcode-addons'),
        'param_name' => 'hcode_career_responsibilities_content',
        'dependency'  => array( 'element' => 'hcode_career_right', 'value' => array('1') ),
    ),
    array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Number Text Color', 'hcode-addons' ),
        'param_name' => 'hcode_career_number_color',
        'group' => 'Style',
    ),
    array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Separator Color', 'hcode-addons' ),
        'param_name' => 'hcode_career_show_separator_color',
        'group' => 'Style',
    ),
    array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Job Title Color', 'hcode-addons' ),
        'param_name' => 'hcode_career_job_title_color',
        'group' => 'Style',
    ),
    array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Job Experience Color', 'hcode-addons' ),
        'param_name' => 'hcode_career_job_experince_color',
        'group' => 'Style',
    ),
    array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Urgent Job Color', 'hcode-addons' ),
        'param_name' => 'hcode_career_urgent_job_color',
        'group' => 'Style',
    ),
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Show Bottom Separator', 'hcode-addons'),
        'param_name' => 'hcode_career_bottom_separator',
        'value' => array(__('OFF', 'hcode-addons') => '0', 
                         __('ON', 'hcode-addons') => '1'
                        ),
    ),
    $hcode_vc_extra_id,
    $hcode_vc_extra_class,
  )
) );

/*-----------------------------------------------------------------------------------*/
/*  End Careers
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Start Login Form
/*-----------------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Forms', 'hcode-addons'),
  'description' => __('Place a form with options', 'hcode-addons'), 
  'icon' => 'fa fa-pencil-square-o h-code-shortcode-icon',
  'base' => 'hcode_login_form',
  'category' => 'H-Code',
  'params' => array(
    array(
        'type' => 'dropdown',
        'heading' => __('Form Type', 'hcode-addons'),
        'param_name' => 'hcode_login_form_style',
        'admin_label' => true,
        'value' => array(__('Select Form Type', 'hcode-addons') => '',
                         __('Login Form With box', 'hcode-addons') => 'login-style1',
                         __('Login Form', 'hcode-addons') => 'login-style2',
                         __('Register', 'hcode-addons') => 'register'   
                        ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Username Label Text', 'hcode-addons' ),
        'param_name' => 'uname',
        'dependency' => array( 'element' => 'hcode_login_form_style', 'value' => array('login-style1','login-style2','register') ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Password Label Text', 'hcode-addons' ),
        'param_name' => 'password',
        'dependency' => array( 'element' => 'hcode_login_form_style', 'value' => array('login-style1','login-style2') ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Email Label Text', 'hcode-addons' ),
        'param_name' => 'email',
        'dependency' => array( 'element' => 'hcode_login_form_style', 'value' => array('register') ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Remember Me Label Text', 'hcode-addons' ),
        'param_name' => 'remember',
        'dependency' => array( 'element' => 'hcode_login_form_style', 'value' => array('login-style1') ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Button Text', 'hcode-addons' ),
        'param_name' => 'button_text',
        'dependency' => array( 'element' => 'hcode_login_form_style', 'value' => array('login-style1','login-style2','register') ),
    ),
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Required Padding Setting?', 'hcode-addons'),
        'param_name' => 'padding_setting',
        'value' => array(__('No', 'hcode-addons') => '0', 
                         __('Yes', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_login_form_style', 'value' => array('login-style1','login-style2','register') ),
        'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'desktop_padding',
      'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
      'value' => $hcode_desktop_padding,
      'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
      'group' => 'Style',
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
      'param_name' => 'custom_desktop_padding',
      'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
      'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

        'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'ipad_padding',
      'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
      'value' => $hcode_ipad_padding,
      'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'mobile_padding',
      'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
      'value' => $hcode_mobile_padding,
      'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        'group' => 'Style',
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Required Margin Setting?', 'hcode-addons'),
      'param_name' => 'margin_setting',
      'value' => array(__('No', 'hcode-addons') => '0', 
                       __('Yes', 'hcode-addons') => '1'
                      ),
      'dependency' => array( 'element' => 'hcode_login_form_style', 'value' => array('login-style1','login-style2','register') ),
        'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'desktop_margin',
      'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
      'value' => $hcode_desktop_margin,
      'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        'group' => 'Style',
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
      'param_name' => 'custom_desktop_margin',
      'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
      'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
        'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'ipad_margin',
      'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
      'value' => $hcode_ipad_margin,
      'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'mobile_margin',
      'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
      'value' => $hcode_mobile_margin,
      'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        'group' => 'Style',
    ),
    $hcode_vc_extra_id,
    $hcode_vc_extra_class,
  )
) );

/*-----------------------------------------------------------------------------------*/
/*  End Login form
/*-----------------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Start Image Carousel Slider */
/*---------------------------------------------------------------------------*/

vc_map( 
    array(
        'name' => __( 'Image Carousel' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
        'base' => 'hcode_image_carousel', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
        'category' => 'H-Code',
        'description' => __( 'Create an image carousel', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
        'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
        'as_parent' => array('only' => 'hcode_image_carousel_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
        'js_view' => 'VcColumnView',
        'params' => array(
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Pagination', 'hcode-addons'),
                'param_name' => 'show_pagination',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
          ),
          array(
                'type' => 'dropdown',
                'heading' => __('Pagination Style', 'hcode-addons'),
                'param_name' => 'show_pagination_style',
                'admin_label' => true,
                'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                                 __('Dot Style', 'hcode-addons') => '0',
                                 __('Line Style', 'hcode-addons') => '1',
                                 __('Round Style', 'hcode-addons') => '2',
                                ),
                'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
                'type' => 'dropdown',
                'heading' => __('Pagination Color Style', 'hcode-addons'),
                'param_name' => 'show_pagination_color_style',
                'admin_label' => true,
                'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                                 __('Dark Style', 'hcode-addons') => '0',
                                 __('Light Style', 'hcode-addons') => '1'
                                ),
                'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Navigation', 'hcode-addons'),
                'param_name' => 'show_navigation',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Navigation Style', 'hcode-addons'),
              'param_name' => 'show_navigation_style',
              'admin_label' => true,
              'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                               __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                               __('Next/Prev White Arrow', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Cursor Color Style', 'hcode-addons'),
              'param_name' => 'show_cursor_color_style',
              'admin_label' => true,
              'value' => array(__('Select Cursor Color Style', 'hcode-addons') => '',
                               __('White Cursor', 'hcode-addons') => 'white-cursor',
                               __('Black Cursor', 'hcode-addons') => 'black-cursor',
                               __('Default Cursor', 'hcode-addons') => 'no-cursor',
                              ),
          ),
          array(
              'type' => 'textfield',
              'heading' => __('No. of Items Per Slide (For Desktop Device)', 'hcode-addons'),
              'description' => __( 'Enter only numeric value like 3', 'hcode-addons' ),  
              'param_name' => 'hcode_image_carousel_itemsdesktop',
              'group'       => 'Slider Configuration',
              'value'     => '3',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('No. of Items Per Slide (For iPad/Tablet Device)', 'hcode-addons'),
              'description' => __( 'Enter only numeric value like 3', 'hcode-addons' ),   
              'param_name' => 'hcode_image_carousel_itemstablet',
              'group'       => 'Slider Configuration',
              'value'     => '3',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('No. of Items Per Slide (For Mobile Device)', 'hcode-addons'),
              'description' => __( 'Enter only numeric value like 1', 'hcode-addons' ), 
              'param_name' => 'hcode_image_carousel_itemsmobile',
              'group'       => 'Slider Configuration',
              'value'     => '1',
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Autoplay', 'hcode-addons'),
              'param_name' => 'hcode_image_carousel_autoplay',
              'value' => array(__('False', 'hcode-addons') => '0', 
                               __('True', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
              'group'       => 'Slider Configuration'  
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Stop On Hover', 'hcode-addons'),
                'param_name' => 'stoponhover',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
                'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
                'group' => 'Slider Configuration',
          ), 
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Delay Time', 'hcode-addons'),
              'param_name' => 'slidespeed',
              'admin_label' => true,
              'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                               __('500', 'hcode-addons') => '500',
                               __('600', 'hcode-addons') => '600',
                               __('700', 'hcode-addons') => '700',
                               __('800', 'hcode-addons') => '800',
                               __('900', 'hcode-addons') => '900',
                               __('1000', 'hcode-addons') => '1000',
                               __('1100', 'hcode-addons') => '1100',
                               __('1200', 'hcode-addons') => '1200',
                               __('1300', 'hcode-addons') => '1300',
                               __('1400', 'hcode-addons') => '1400',
                               __('1500', 'hcode-addons') => '1500',
                               __('2000', 'hcode-addons') => '2000',
                               __('3000', 'hcode-addons') => '3000',
                               __('4000', 'hcode-addons') => '4000',
                               __('5000', 'hcode-addons') => '5000',
                               __('6000', 'hcode-addons') => '6000',
                               __('7000', 'hcode-addons') => '7000',
                               __('8000', 'hcode-addons') => '8000',
                               __('9000', 'hcode-addons') => '9000',
                               __('10000', 'hcode-addons') => '10000',
                              ),
              'std' => '3000',
              'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
              'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
              'group' => 'Slider Configuration',
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider ID', 'hcode-addons' ),
             'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
             'param_name'  => 'hcode_slider_id',
             'group'       => 'Slider ID & Class'
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider Extra Class', 'hcode-addons' ),
             'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
             'param_name'  => 'hcode_slider_class',
             'group'       => 'Slider ID & Class'
          ),
          )
      )
  );
  vc_map( 
    array(
        'name' => __('Add Image Block', 'hcode-addons'),
        'base' => 'hcode_image_carousel_content',
        'description' => __( 'A slide for the image slider', 'hcode-addons' ),
        'as_child' => array('only' => 'hcode_image_carousel'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
        'params' => array(
            array(
              'type' => 'attach_image',
              'heading' => __('Image', 'hcode-addons' ),
              'param_name' => 'hcode_image_carousel_content_image',
            ),
            array(
              'type' => 'textfield',
              'heading' => __('Enter Image URl', 'hcode-addons'),
              'param_name' => 'hcode_image_carousel_content_image_url',
              'value'     => '#',
            ),
            array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __( 'Target Blank', 'hcode-addons'),
              'param_name' => 'hcode_image_carousel_content_image_url_target_blank',
              'value' => array(__('NO', 'hcode-addons') => '0', 
                               __('YES', 'hcode-addons') => '1'
                              ),
            ),
            $hcode_vc_extra_id,
            $hcode_vc_extra_class,
          ),
      ) 
  );

if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_image_carousel extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_image_carousel_content extends WPBakeryShortCode { }
}


/*---------------------------------------------------------------------------*/
/* End Image Carousel Slider */
/*---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Start Popular Dishes */
/*---------------------------------------------------------------------------*/

vc_map( 
    array(
        'name' => __( 'Popular Dishes Block' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
        'base' => 'hcode_popular_dishes', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
        'category' => 'H-Code',
        'description' => __( 'Add a popular dishes block', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
        'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
        'as_parent' => array('only' => 'hcode_popular_dishes_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-th', //URL or CSS class with icon image.
        'js_view' => 'VcColumnView',
        'show_settings_on_create' => false,
        'params' => array(
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,
        )
      )
  );
  vc_map( 
    array(
        'name' => __('Add Dishes', 'hcode-addons'),
        'base' => 'hcode_popular_dishes_content',
        'description' => __( 'Add Dishes Content', 'hcode-addons' ),
        'as_child' => array('only' => 'hcode_popular_dishes'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'icon-ui-splitter-horizontal', //URL or CSS class with icon image.
        'params' => array(
          array(
            'type' => 'dropdown',
            'heading' => __('Content Type', 'hcode-addons'),
            'param_name' => 'show_content',
            'admin_label' => true,
            'value' => array(__('Select Content Type', 'hcode-addons') => '',
                             __('Image', 'hcode-addons') => 'image',
                             __('Content', 'hcode-addons') => 'content',
                            ),
          ),
          array(
            'type' => 'attach_image',
            'heading' => __('BackGround Image', 'hcode-addons' ),
            'param_name' => 'hcode_bg_image',
            'dependency' => array( 'element' => 'show_content', 'value' => array('content') ),
          ),
          array(
            'type' => 'attach_image',
            'heading' => __('Image', 'hcode-addons' ),
            'param_name' => 'hcode_image',
            'dependency' => array( 'element' => 'show_content', 'value' => array('image','content') ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Block Title', 'hcode-addons' ),
            'param_name' => 'hcode_dishes_title',
            'dependency' => array( 'element' => 'show_content', 'value' => array('content') ),
          ),
          array(
            'type' => 'textarea_html',
            'heading' => __( 'Block Subtitle', 'hcode-addons' ),
            'param_name' => 'content',
            'dependency' => array( 'element' => 'show_content', 'value' => array('content') ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Block URL', 'hcode-addons' ),
            'param_name' => 'hcode_dishes_url',
            'dependency' => array( 'element' => 'show_content', 'value' => array('image','content') ),
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Color', 'hcode-addons' ),
            'param_name' => 'hcode_title_color',
            'description' => __( 'Title Color', 'hcode-addons' ),
            'dependency' => array( 'element' => 'show_content', 'value' => array('content') ),
            'group' => 'Configuration',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'SubTitle Color', 'hcode-addons' ),
            'param_name' => 'hcode_subtitle_color',
            'description' => __( 'SubTitle Color', 'hcode-addons' ),
            'dependency' => array( 'element' => 'show_content', 'value' => array('content') ),
            'group' => 'Configuration',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Padding Setting?', 'hcode-addons'),
            'param_name' => 'padding_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'show_content', 'value' => array('image','content') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_padding',
            'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_padding',
            'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
            'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_padding',
            'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_padding',
            'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Margin Setting?', 'hcode-addons'),
            'param_name' => 'margin_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'show_content', 'value' => array('image','content') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_margin',
            'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
              'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_margin',
            'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
            'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_margin',
            'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_margin',
            'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
         
          ),
      ) 
  );

if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_popular_dishes extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_popular_dishes_content extends WPBakeryShortCode { }
}

/*---------------------------------------------------------------------------*/
/* End Popular Dishes */
/*---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Start Education Slider */
/*---------------------------------------------------------------------------*/

vc_map( 
    array(
        'name' => __( 'Education Slider' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
        'base' => 'hcode_education_slider', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
        'category' => 'H-Code',
        'description' => __( 'Create an education slider', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
        'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
        'as_parent' => array('only' => 'hcode_education_slide_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
        'js_view' => 'VcColumnView',
        'params' => array(
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Show Pagination', 'hcode-addons'),
              'param_name' => 'show_pagination',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Style', 'hcode-addons'),
              'param_name' => 'show_pagination_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                               __('Dot Style', 'hcode-addons') => '0',
                               __('Line Style', 'hcode-addons') => '1',
                               __('Round Style', 'hcode-addons') => '2',
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Color Style', 'hcode-addons'),
              'param_name' => 'show_pagination_color_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                               __('Dark Style', 'hcode-addons') => '0',
                               __('Light Style', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Navigation', 'hcode-addons'),
                'param_name' => 'show_navigation',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Navigation Style', 'hcode-addons'),
              'param_name' => 'show_navigation_style',
              'admin_label' => true,
              'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                               __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                               __('Next/Prev White Arrow', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Cursor Color Style', 'hcode-addons'),
              'param_name' => 'show_cursor_color_style',
              'admin_label' => true,
              'value' => array(__('Select Cursor Color Style', 'hcode-addons') => '',
                               __('White Cursor', 'hcode-addons') => 'white-cursor',
                               __('Black Cursor', 'hcode-addons') => 'black-cursor',
                               __('Default Cursor', 'hcode-addons') => 'no-cursor',
                              ),
          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For Desktop Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 4', 'hcode-addons' ),  
                'param_name' => 'hcode_image_carousel_itemsdesktop',
                'group'       => 'Slider Configuration',
                'value'     => '4',
            ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For iPad/Tablet Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 3', 'hcode-addons' ), 
                'param_name' => 'hcode_image_carousel_itemstablet',
                'group'       => 'Slider Configuration',
                'value'     => '3',

          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For Mobile Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 1', 'hcode-addons' ), 
                'param_name' => 'hcode_image_carousel_itemsmobile',
                'group'       => 'Slider Configuration',
                'value'     => '1',
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Autoplay', 'hcode-addons'),
                'param_name' => 'hcode_image_carousel_autoplay',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
                'group'       => 'Slider Configuration'  
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Stop On Hover', 'hcode-addons'),
                'param_name' => 'stoponhover',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
                'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
                'group' => 'Slider Configuration',
          ),
          
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Delay Time', 'hcode-addons'),
              'param_name' => 'slidespeed',
              'admin_label' => true,
              'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                               __('500', 'hcode-addons') => '500',
                               __('600', 'hcode-addons') => '600',
                               __('700', 'hcode-addons') => '700',
                               __('800', 'hcode-addons') => '800',
                               __('900', 'hcode-addons') => '900',
                               __('1000', 'hcode-addons') => '1000',
                               __('1100', 'hcode-addons') => '1100',
                               __('1200', 'hcode-addons') => '1200',
                               __('1300', 'hcode-addons') => '1300',
                               __('1400', 'hcode-addons') => '1400',
                               __('1500', 'hcode-addons') => '1500',
                               __('2000', 'hcode-addons') => '2000',
                               __('3000', 'hcode-addons') => '3000',
                               __('4000', 'hcode-addons') => '4000',
                               __('5000', 'hcode-addons') => '5000',
                               __('6000', 'hcode-addons') => '6000',
                               __('7000', 'hcode-addons') => '7000',
                               __('8000', 'hcode-addons') => '8000',
                               __('9000', 'hcode-addons') => '9000',
                               __('10000', 'hcode-addons') => '10000',
                              ),
              'std' => '3000',
              'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
              'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
              'group' => 'Slider Configuration',
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider ID', 'hcode-addons' ),
             'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
             'param_name'  => 'hcode_slider_id',
             'group'       => 'Slider ID & Class'
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider Extra Class', 'hcode-addons' ),
             'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
             'param_name'  => 'hcode_slider_class',
             'group'       => 'Slider ID & Class'
          ),
          )
      )
  );
  vc_map( 
    array(
        'name' => __('Add Education Block', 'hcode-addons'),
        'base' => 'hcode_education_slide_content',
        'description' => __( 'Add education block content', 'hcode-addons' ),
        'as_child' => array('only' => 'hcode_education_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
        'params' => array(
            array(
                'type' => 'hcode_etline_icon',
                'heading' => __('Select Et-Line Icon Type', 'hcode-addons'),
                'param_name' => 'hcode_et_line_icon_list',
                'admin_label' => true,
                'description' => __('Selet Font Type', 'hcode-addons'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title', 'hcode-addons'),
                'param_name' => 'title'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Year', 'hcode-addons'),
                'param_name' => 'year'
            ),        
            array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Separator', 'hcode-addons'),
                'param_name' => 'hcode_show_separator',
                'value' => array(__('NO', 'hcode-addons') => '0', 
                                 __('YES', 'hcode-addons') => '1'
                                ),
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Education Name', 'hcode-addons'),
              'param_name' => 'education_name'
          ),
          array(
              'type' => 'textarea_html',
              'heading' => __('Content', 'hcode-addons'),
              'param_name' => 'content'
          ),
          array(
              'type'        => 'textfield',
              'heading'     => __('Grade Button Title', 'hcode-addons' ),
              'param_name'  => 'grade_button',
              'admin_label' => true,
          ),
          array(
              'type' => 'colorpicker',
              'class' => '',
              'heading' => __( 'Icon Color', 'hcode-addons' ),
              'param_name' => 'hcode_icon_color',
              'group' => 'Configuration',
          ),
          array(
              'type' => 'colorpicker',
              'class' => '',
              'heading' => __( 'Year Color', 'hcode-addons' ),
              'param_name' => 'year_color',
              'group' => 'Configuration',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Color', 'hcode-addons' ),
            'param_name' => 'hcode_title_color',
            'group' => 'Configuration',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Education Name Color', 'hcode-addons' ),
            'param_name' => 'education_name_color',
            'group' => 'Configuration',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Content Color', 'hcode-addons' ),
            'param_name' => 'hcode_content_color',
            'group' => 'Configuration',
          ),
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,
          ),
      ) 
  );

if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_education_slider extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_education_slide_content extends WPBakeryShortCode { }
}


/*---------------------------------------------------------------------------*/
/* End Education Slider */
/*---------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/* Start Restaurant Menu Slider */
/*-----------------------------------------------------------------------------------*/

vc_map( 
  array(
      'name' => __( 'Restaurant Menu Slider' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
      'base' => 'hcode_restaurant_menu', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
      'category' => 'H-Code',
      'description' => __( 'Create a restaurant menu slider', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
      'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
      'as_parent' => array('only' => 'hcode_restaurant_menu_slide_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
      'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
      'js_view' => 'VcColumnView',
      'params' => array( //List of shortcode attributes. Array which holds your shortcode params, these params will be editable in shortcode settings page      
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Show Pagination', 'hcode-addons'),
              'param_name' => 'show_pagination',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Style', 'hcode-addons'),
              'param_name' => 'show_pagination_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                               __('Dot Style', 'hcode-addons') => '0',
                               __('Line Style', 'hcode-addons') => '1',
                               __('Round Style', 'hcode-addons') => '2',
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Color Style', 'hcode-addons'),
              'param_name' => 'show_pagination_color_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                               __('Dark Style', 'hcode-addons') => '0',
                               __('Light Style', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Show Navigation', 'hcode-addons'),
              'param_name' => 'show_navigation',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Navigation Style', 'hcode-addons'),
              'param_name' => 'show_navigation_style',
              'admin_label' => true,
              'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                               __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                               __('Next/Prev White Arrow', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Transition Style', 'hcode-addons'),
              'param_name' => 'transition_style',
              'admin_label' => true,
              'value' => array(__('Select Transition Style', 'hcode-addons') => '',
                               __('Slide Style', 'hcode-addons') => 'slide',
                               __('Fade Style', 'hcode-addons') => 'fade',
                               __('BackSlide Style', 'hcode-addons') => 'backSlide',
                               __('GoDown Style', 'hcode-addons') => 'goDown',
                               __('FadeUp Style', 'hcode-addons') => 'fadeUp'
                               
                              ),
              'group' => 'Slider Configuration',
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Autoplay', 'hcode-addons'),
              'param_name' => 'autoplay',
              'value' => array(__('False', 'hcode-addons') => '0', 
                               __('True', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
              'group' => 'Slider Configuration',
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Stop On Hover', 'hcode-addons'),
              'param_name' => 'stoponhover',
              'value' => array(__('False', 'hcode-addons') => '0', 
                               __('True', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
              'dependency'  => array( 'element' => 'autoplay', 'value' => array('1') ),
              'group' => 'Slider Configuration',
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Delay Time', 'hcode-addons'),
              'param_name' => 'slidespeed',
              'admin_label' => true,
              'value' => array(__('Slide Delay Time', 'hcode-addons') => '',
                               __('500', 'hcode-addons') => '500',
                               __('600', 'hcode-addons') => '600',
                               __('700', 'hcode-addons') => '700',
                               __('800', 'hcode-addons') => '800',
                               __('900', 'hcode-addons') => '900',
                               __('1000', 'hcode-addons') => '1000',
                               __('1100', 'hcode-addons') => '1100',
                               __('1200', 'hcode-addons') => '1200',
                               __('1300', 'hcode-addons') => '1300',
                               __('1400', 'hcode-addons') => '1400',
                               __('1500', 'hcode-addons') => '1500',
                               __('2000', 'hcode-addons') => '2000',
                               __('3000', 'hcode-addons') => '3000',
                               __('4000', 'hcode-addons') => '4000',
                               __('5000', 'hcode-addons') => '5000',
                               __('6000', 'hcode-addons') => '6000',
                               __('7000', 'hcode-addons') => '7000',
                               __('8000', 'hcode-addons') => '8000',
                               __('9000', 'hcode-addons') => '9000',
                               __('10000', 'hcode-addons') => '10000',
                              ),
              'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
              'group' => 'Slider Configuration',
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'heading' => __('Add Active Class', 'hcode-addons'),
              'param_name' => 'addclassactive',
              'admin_label' => true,
              'value' => array(__('False', 'hcode-addons') => '0', 
                               __('True', 'hcode-addons') => '1'
                              ),
              'description' => __('Select TRUE to add active class', 'hcode-addons'),
              'group' => 'Slider Configuration',
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider ID', 'hcode-addons' ),
             'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
             'param_name'  => 'hcode_slider_id',
             'group'       => 'Slider ID & Class'
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider Extra Class', 'hcode-addons' ),
             'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
             'param_name'  => 'hcode_slider_class',
             'group'       => 'Slider ID & Class'
          ),
      ),
  )
);
vc_map( 
  array(
      'name' => __('Add Menu', 'hcode-addons'),
      'description' => 'Add Menu Content',
      'base' => 'hcode_restaurant_menu_slide_content',
      'as_child' => array('only' => 'hcode_restaurant_menu'), // Use only|except attributes to limit parent (separate multiple values with comma)
      'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
      'params' => array(
          array(
              'type' => 'attach_image',
              'heading' => __('Menu Image', 'hcode-addons'),
              'param_name' => 'image',
              'holder' => 'div'
          ),
          array(
              'type' => 'attach_image',
              'heading' => __('Content Image', 'hcode-addons'),
              'param_name' => 'content_image',
              'holder' => 'div'
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Title', 'hcode-addons'),
              'description' => __( 'Title', 'hcode-addons' ),
              'param_name' => 'title',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('Subtitle', 'hcode-addons'),
              'description' => __( 'SubTitle', 'hcode-addons' ),
              'param_name' => 'subtitle',
          ),
          array(
              'type' => 'textarea_html',
              'heading' => __('Content', 'hcode-addons'),
              'description' => __( 'Content.', 'hcode-addons' ),
              'param_name' => 'content',
          ),
        ),
    ) 
);
/* Main Slider class*/
if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_restaurant_menu extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_restaurant_menu_slide_content extends WPBakeryShortCode { }
}


/*-----------------------------------------------------------------------------------*/
/* End Restaurant Menu Slider */
/*-----------------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Start Onepage Spa Packages Slider */
/*---------------------------------------------------------------------------*/

vc_map( 
    array(
        'name' => __( 'Spa Packages Slider' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
        'base' => 'hcode_spa_packages_slider', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
        'category' => 'H-Code',
        'description' => __( 'Create a spa packages slider', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
        'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
        'as_parent' => array('only' => 'hcode_spa_slide_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
        'js_view' => 'VcColumnView',
        'params' => array(
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Show Pagination', 'hcode-addons'),
              'param_name' => 'show_pagination',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Style', 'hcode-addons'),
              'param_name' => 'show_pagination_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                               __('Dot Style', 'hcode-addons') => '0',
                               __('Line Style', 'hcode-addons') => '1',
                               __('Round Style', 'hcode-addons') => '2',
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Color Style', 'hcode-addons'),
              'param_name' => 'show_pagination_color_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                               __('Dark Style', 'hcode-addons') => '0',
                               __('Light Style', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Show Navigation', 'hcode-addons'),
              'param_name' => 'show_navigation',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Navigation Style', 'hcode-addons'),
              'param_name' => 'show_navigation_style',
              'admin_label' => true,
              'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                               __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                               __('Next/Prev White Arrow', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Cursor Color Style', 'hcode-addons'),
              'param_name' => 'show_cursor_color_style',
              'admin_label' => true,
              'value' => array(__('Select Cursor Color Style', 'hcode-addons') => '',
                               __('White Cursor', 'hcode-addons') => 'white-cursor',
                               __('Black Cursor', 'hcode-addons') => 'black-cursor',
                               __('Default Cursor', 'hcode-addons') => 'no-cursor',
                              ),
          ),
          array(
              'type' => 'textfield',
              'heading' => __('No. of Items Per Slide (For Desktop Device)', 'hcode-addons'),
              'description' => __( 'Enter only numeric value like 4', 'hcode-addons' ), 
              'param_name' => 'hcode_image_carousel_itemsdesktop',
              'group'       => 'Slider Configuration',
              'value'     => '4',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('No. of Items Per Slide (For iPad/Tablet Device)', 'hcode-addons'),
              'description' => __( 'Enter only numeric value like 3', 'hcode-addons' ),  
              'param_name' => 'hcode_image_carousel_itemstablet',
              'group'       => 'Slider Configuration',
              'value'     => '3',
          ),
          array(
              'type' => 'textfield',
              'heading' => __('No. of Items Per Slide (For Mobile Device)', 'hcode-addons'),
              'description' => __( 'Enter only numeric value like 1', 'hcode-addons' ), 
              'param_name' => 'hcode_image_carousel_itemsmobile',
              'group'       => 'Slider Configuration',
              'value'     => '1',
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Autoplay', 'hcode-addons'),
              'param_name' => 'hcode_image_carousel_autoplay',
              'value' => array(__('False', 'hcode-addons') => '0', 
                               __('True', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
              'group'       => 'Slider Configuration'  
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Stop On Hover', 'hcode-addons'),
                'param_name' => 'stoponhover',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
                'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
                'group' => 'Slider Configuration',
          ), 
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Delay Time', 'hcode-addons'),
              'param_name' => 'slidespeed',
              'admin_label' => true,
              'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                               __('500', 'hcode-addons') => '500',
                               __('600', 'hcode-addons') => '600',
                               __('700', 'hcode-addons') => '700',
                               __('800', 'hcode-addons') => '800',
                               __('900', 'hcode-addons') => '900',
                               __('1000', 'hcode-addons') => '1000',
                               __('1100', 'hcode-addons') => '1100',
                               __('1200', 'hcode-addons') => '1200',
                               __('1300', 'hcode-addons') => '1300',
                               __('1400', 'hcode-addons') => '1400',
                               __('1500', 'hcode-addons') => '1500',
                               __('2000', 'hcode-addons') => '2000',
                               __('3000', 'hcode-addons') => '3000',
                               __('4000', 'hcode-addons') => '4000',
                               __('5000', 'hcode-addons') => '5000',
                               __('6000', 'hcode-addons') => '6000',
                               __('7000', 'hcode-addons') => '7000',
                               __('8000', 'hcode-addons') => '8000',
                               __('9000', 'hcode-addons') => '9000',
                               __('10000', 'hcode-addons') => '10000',
                              ),
              'std' => '3000',
              'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
              'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
              'group' => 'Slider Configuration',
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider ID', 'hcode-addons' ),
             'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
             'param_name'  => 'hcode_slider_id',
             'group'       => 'Slider ID & Class'
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider Extra Class', 'hcode-addons' ),
             'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
             'param_name'  => 'hcode_slider_class',
             'group'       => 'Slider ID & Class'
          ),
          )
      )
  );
  vc_map( 
    array(
        'name' => __('Add Spa Block', 'hcode-addons'),
        'base' => 'hcode_spa_slide_content',
        'description' => __( 'Add spa block content', 'hcode-addons' ),
        'as_child' => array('only' => 'hcode_spa_packages_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
        'params' => array(
            array(
                'type' => 'attach_image',
                'heading' => __('Slide Image', 'hcode-addons'),
                'param_name' => 'slide_image',
                'holder' => 'div'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title', 'hcode-addons'),
                'param_name' => 'title'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Price text', 'hcode-addons'),
                'param_name' => 'price_text'
            ),        
            array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show separator', 'hcode-addons'),
                'param_name' => 'hcode_show_separator',
                'value' => array(__('NO', 'hcode-addons') => '0', 
                                 __('YES', 'hcode-addons') => '1'
                                ),
          ),
          array(
              'type' => 'textarea_html',
              'heading' => __('Content', 'hcode-addons'),
              'param_name' => 'content'
          ),
          array(
              'type'        => 'vc_link',
              'heading'     => __('Grade Button', 'hcode-addons' ),
              'param_name'  => 'grade_button',
              'admin_label' => true,
          ),
          array(
              'type' => 'colorpicker',
              'class' => '',
              'heading' => __( 'Title Color', 'hcode-addons' ),
              'param_name' => 'hcode_title_color',
              'description' => __( 'Title Color', 'hcode-addons' ),
              'group' => 'Configuration',
          ),          
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,
          ),
      ) 
  );

if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_spa_packages_slider extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_spa_slide_content extends WPBakeryShortCode { }
}

/*---------------------------------------------------------------------------*/
/* End Onepage Spa Packages Slider */
/*---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Start Onepage Restaurant Popular dish Slider */
/*---------------------------------------------------------------------------*/

vc_map( 
    array(
        'name' => __( 'Popular Dishes Slider' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
        'base' => 'hcode_restaurant_popular_dish_slider', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
        'category' => 'H-Code',
        'description' => __( 'Create a popular dishes slider', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
        'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
        'as_parent' => array('only' => 'hcode_restaurant_popular_dish_slide_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
        'js_view' => 'VcColumnView',
        'params' => array(
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Show Pagination', 'hcode-addons'),
              'param_name' => 'show_pagination',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Style', 'hcode-addons'),
              'param_name' => 'show_pagination_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                               __('Dot Style', 'hcode-addons') => '0',
                               __('Line Style', 'hcode-addons') => '1',
                               __('Round Style', 'hcode-addons') => '2',
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Color Style', 'hcode-addons'),
              'param_name' => 'show_pagination_color_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                               __('Dark Style', 'hcode-addons') => '0',
                               __('Light Style', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Show Navigation', 'hcode-addons'),
              'param_name' => 'show_navigation',
              'value' => array(__('OFF', 'hcode-addons') => '0', 
                               __('ON', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Navigation Style', 'hcode-addons'),
              'param_name' => 'show_navigation_style',
              'admin_label' => true,
              'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                               __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                               __('Next/Prev White Arrow', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For Desktop Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 4', 'hcode-addons' ), 
                'param_name' => 'hcode_image_carousel_itemsdesktop',
                'group'       => 'Slider Configuration',
                'value'     => '4',
          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For iPad/Tablet Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 3', 'hcode-addons' ), 
                'param_name' => 'hcode_image_carousel_itemstablet',
                'group'       => 'Slider Configuration',
                'value'     => '3',

          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For Mobile Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 1', 'hcode-addons' ), 
                'param_name' => 'hcode_image_carousel_itemsmobile',
                'group'       => 'Slider Configuration',
                'value'     => '1',
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Autoplay', 'hcode-addons'),
                'param_name' => 'hcode_image_carousel_autoplay',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
                'group'       => 'Slider Configuration'  
          ),
          array(
              'type' => 'hcode_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => __('Stop On Hover', 'hcode-addons'),
              'param_name' => 'stoponhover',
              'value' => array(__('False', 'hcode-addons') => '0', 
                               __('True', 'hcode-addons') => '1'
                              ),
              'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
              'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
              'group' => 'Slider Configuration',
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Delay Time', 'hcode-addons'),
              'param_name' => 'slidespeed',
              'admin_label' => true,
              'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                               __('500', 'hcode-addons') => '500',
                               __('600', 'hcode-addons') => '600',
                               __('700', 'hcode-addons') => '700',
                               __('800', 'hcode-addons') => '800',
                               __('900', 'hcode-addons') => '900',
                               __('1000', 'hcode-addons') => '1000',
                               __('1100', 'hcode-addons') => '1100',
                               __('1200', 'hcode-addons') => '1200',
                               __('1300', 'hcode-addons') => '1300',
                               __('1400', 'hcode-addons') => '1400',
                               __('1500', 'hcode-addons') => '1500',
                               __('2000', 'hcode-addons') => '2000',
                               __('3000', 'hcode-addons') => '3000',
                               __('4000', 'hcode-addons') => '4000',
                               __('5000', 'hcode-addons') => '5000',
                               __('6000', 'hcode-addons') => '6000',
                               __('7000', 'hcode-addons') => '7000',
                               __('8000', 'hcode-addons') => '8000',
                               __('9000', 'hcode-addons') => '9000',
                               __('10000', 'hcode-addons') => '10000',
                              ),
              'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
              'group' => 'Slider Configuration',
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider ID', 'hcode-addons' ),
             'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
             'param_name'  => 'hcode_slider_id',
             'group'       => 'Slider ID & Class'
          ),
          
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider Extra Class', 'hcode-addons' ),
             'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
             'param_name'  => 'hcode_slider_class',
             'group'       => 'Slider ID & Class'
          ),
          )
      )
  );
  vc_map( 
    array(
        'name' => __('Add Popular Dish', 'hcode-addons'),
        'base' => 'hcode_restaurant_popular_dish_slide_content',
        'description' => __( 'Add popular dish content', 'hcode-addons' ),
        'as_child' => array('only' => 'hcode_restaurant_popular_dish_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
        'params' => array(
            array(
                'type' => 'attach_image',
                'heading' => __('Slide Image', 'hcode-addons'),
                'param_name' => 'slide_image',
                'holder' => 'div'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title', 'hcode-addons'),
                'param_name' => 'title'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Price text', 'hcode-addons'),
                'param_name' => 'price_text'
            ),        
            array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Separator', 'hcode-addons'),
                'param_name' => 'hcode_show_separator',
                'value' => array(__('NO', 'hcode-addons') => '0', 
                                 __('YES', 'hcode-addons') => '1'
                                ),
          ),
            array(
                'type' => 'textarea_html',
                'heading' => __('Content', 'hcode-addons'),
                'param_name' => 'content'
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => __( 'Title Color', 'hcode-addons' ),
                'param_name' => 'hcode_title_color',
                'group' => 'Configuration',
            ),          
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => __( 'Content Color', 'hcode-addons' ),
                'param_name' => 'hcode_content_color',
                'group' => 'Configuration',
            ),
            $hcode_vc_extra_id,
            $hcode_vc_extra_class,
          ),
      ) 
  );

if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_restaurant_popular_dish_slider extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_restaurant_popular_dish_slide_content extends WPBakeryShortCode { }
}


/*---------------------------------------------------------------------------*/
/* End Onepage Restaurant Popular dish Slider */
/*---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Start Onepage Architecture Slider */
/*---------------------------------------------------------------------------*/

vc_map( 
    array(
        'name' => __( 'Architecture Featured Projects Slider' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
        'base' => 'hcode_architecture_featured_projects_slider', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
        'category' => 'H-Code',
        'description' => __( 'Create an architecture featured projects slider', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
        'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
        'as_parent' => array('only' => 'hcode_architecture_featured_projects_slide_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
        'js_view' => 'VcColumnView',
        'params' => array(
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Pagination', 'hcode-addons'),
                'param_name' => 'show_pagination',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
          ),
          array(
                'type' => 'dropdown',
                'heading' => __('Pagination Style', 'hcode-addons'),
                'param_name' => 'show_pagination_style',
                'admin_label' => true,
                'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                                 __('Dot Style', 'hcode-addons') => '0',
                                 __('Line Style', 'hcode-addons') => '1',
                                 __('Round Style', 'hcode-addons') => '2',
                                ),
                'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
              'type' => 'dropdown',
              'heading' => __('Pagination Color Style', 'hcode-addons'),
              'param_name' => 'show_pagination_color_style',
              'admin_label' => true,
              'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                               __('Dark Style', 'hcode-addons') => '0',
                               __('Light Style', 'hcode-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),

          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Navigation', 'hcode-addons'),
                'param_name' => 'show_navigation',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
          ),
          array(
                'type' => 'dropdown',
                'heading' => __('Navigation Style', 'hcode-addons'),
                'param_name' => 'show_navigation_style',
                'admin_label' => true,
                'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                                 __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                                 __('Next/Prev White Arrow', 'hcode-addons') => '1'
                                ),
                'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
          ),
          array(
                'type' => 'dropdown',
                'heading' => __('Cursor Color Style', 'hcode-addons'),
                'param_name' => 'show_cursor_color_style',
                'admin_label' => true,
                'value' => array(__('Select Cursor Color Style', 'hcode-addons') => '',
                                 __('White Cursor', 'hcode-addons') => 'white-cursor',
                                 __('Black Cursor', 'hcode-addons') => 'black-cursor',
                                 __('Default Cursor', 'hcode-addons') => 'no-cursor',
                                ),
          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For Desktop Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 4', 'hcode-addons' ),
                'param_name' => 'hcode_image_carousel_itemsdesktop',
                'group'       => 'Slider Configuration',
                'value'     => '4',
          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For iPad/Tablet Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 3', 'hcode-addons' ), 
                'param_name' => 'hcode_image_carousel_itemstablet',
                'group'       => 'Slider Configuration',
                'value'     => '3',
          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For Mobile Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 1', 'hcode-addons' ), 
                'param_name' => 'hcode_image_carousel_itemsmobile',
                'group'       => 'Slider Configuration',
                'value'     => '1',
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Autoplay', 'hcode-addons'),
                'param_name' => 'hcode_image_carousel_autoplay',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
                'group'       => 'Slider Configuration'  
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Stop On Hover', 'hcode-addons'),
                'param_name' => 'stoponhover',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
                'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
                'group' => 'Slider Configuration',
          ), 
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Delay Time', 'hcode-addons'),
              'param_name' => 'slidespeed',
              'admin_label' => true,
              'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                               __('500', 'hcode-addons') => '500',
                               __('600', 'hcode-addons') => '600',
                               __('700', 'hcode-addons') => '700',
                               __('800', 'hcode-addons') => '800',
                               __('900', 'hcode-addons') => '900',
                               __('1000', 'hcode-addons') => '1000',
                               __('1100', 'hcode-addons') => '1100',
                               __('1200', 'hcode-addons') => '1200',
                               __('1300', 'hcode-addons') => '1300',
                               __('1400', 'hcode-addons') => '1400',
                               __('1500', 'hcode-addons') => '1500',
                               __('2000', 'hcode-addons') => '2000',
                               __('3000', 'hcode-addons') => '3000',
                               __('4000', 'hcode-addons') => '4000',
                               __('5000', 'hcode-addons') => '5000',
                               __('6000', 'hcode-addons') => '6000',
                               __('7000', 'hcode-addons') => '7000',
                               __('8000', 'hcode-addons') => '8000',
                               __('9000', 'hcode-addons') => '9000',
                               __('10000', 'hcode-addons') => '10000',
                              ),
              'std' => '3000',
              'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
              'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
              'group' => 'Slider Configuration',
          ),
          array(
               'type'        => 'textfield',
               'heading'     => __('Slider ID', 'hcode-addons' ),
               'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
               'param_name'  => 'hcode_slider_id',
               'group'       => 'Slider ID & Class'
          ),
          array(
               'type'        => 'textfield',
               'heading'     => __('Slider Extra Class', 'hcode-addons' ),
               'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
               'param_name'  => 'hcode_slider_class',
               'group'       => 'Slider ID & Class'
          ),
          )
      )
  );
  vc_map( 
    array(
        'name' => __('Add Architecture Featured Project', 'hcode-addons'),
        'base' => 'hcode_architecture_featured_projects_slide_content',
        'description' => __( 'Add architecture featured project content', 'hcode-addons' ),
        'as_child' => array('only' => 'hcode_architecture_featured_projects_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
        'params' => array(
            array(
                'type' => 'attach_image',
                'heading' => __('Slide Image', 'hcode-addons'),
                'param_name' => 'slide_image',
                'holder' => 'div'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title', 'hcode-addons'),
                'param_name' => 'title'
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => __( 'Title Color', 'hcode-addons' ),
                'param_name' => 'hcode_title_color',
                'group' => 'Style',
            ),          
            array(
                'type' => 'textfield',
                'heading' => __('URL', 'hcode-addons'),
                'param_name' => 'img_url'
            ),
            $hcode_vc_extra_id,
            $hcode_vc_extra_class,
          ),
      ) 
  );

if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_architecture_featured_projects_slider extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_architecture_featured_projects_slide_content extends WPBakeryShortCode { }
}


/*---------------------------------------------------------------------------*/
/* End Onepage Architecture Slider */
/*---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Start Onepage Travel Agency Slider Special Offers */
/*---------------------------------------------------------------------------*/

vc_map( 
    array(
        'name' => __( 'Travel Agency Special Offer Slider' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
        'base' => 'hcode_travel_special_offers_slider', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
        'category' => 'H-Code',
        'description' => __( 'Create a travel agency special offer slider', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
        'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
        'as_parent' => array('only' => 'hcode_travel_special_offers_slide_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
        'js_view' => 'VcColumnView',
        'params' => array(
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Pagination', 'hcode-addons'),
                'param_name' => 'show_pagination',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
          ),
          array(
                'type' => 'dropdown',
                'heading' => __('Pagination Style', 'hcode-addons'),
                'param_name' => 'show_pagination_style',
                'admin_label' => true,
                'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                                 __('Dot Style', 'hcode-addons') => '0',
                                 __('Line Style', 'hcode-addons') => '1',
                                 __('Round Style', 'hcode-addons') => '2',
                                ),
                'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),
          array(
                'type' => 'dropdown',
                'heading' => __('Pagination Color Style', 'hcode-addons'),
                'param_name' => 'show_pagination_color_style',
                'admin_label' => true,
                'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                                 __('Dark Style', 'hcode-addons') => '0',
                                 __('Light Style', 'hcode-addons') => '1'
                                ),
                'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
          ),

          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Show Navigation', 'hcode-addons'),
                'param_name' => 'show_navigation',
                'value' => array(__('OFF', 'hcode-addons') => '0', 
                                 __('ON', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
          ),
          array(
                'type' => 'dropdown',
                'heading' => __('Navigation Style', 'hcode-addons'),
                'param_name' => 'show_navigation_style',
                'admin_label' => true,
                'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                                 __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                                 __('Next/Prev White Arrow', 'hcode-addons') => '1'
                                ),
                'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
          ),
          array(
                'type' => 'dropdown',
                'heading' => __('Cursor Color Style', 'hcode-addons'),
                'param_name' => 'show_cursor_color_style',
                'admin_label' => true,
                'value' => array(__('Select Cursor Color Style', 'hcode-addons') => '',
                                 __('White Cursor', 'hcode-addons') => 'white-cursor',
                                 __('Black Cursor', 'hcode-addons') => 'black-cursor',
                                 __('Default Cursor', 'hcode-addons') => 'no-cursor',
                                ),
          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For Desktop Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 4', 'hcode-addons' ),
                'param_name' => 'hcode_image_carousel_itemsdesktop',
                'group'       => 'Slider Configuration',
                'value'     => '4',
          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For iPad/Tablet Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 3', 'hcode-addons' ), 
                'param_name' => 'hcode_image_carousel_itemstablet',
                'group'       => 'Slider Configuration',
                'value'     => '3',

          ),
          array(
                'type' => 'textfield',
                'heading' => __('No. of Items Per Slide (For Mobile Device)', 'hcode-addons'),
                'description' => __( 'Enter only numeric value like 1', 'hcode-addons' ),   
                'param_name' => 'hcode_image_carousel_itemsmobile',
                'group'       => 'Slider Configuration',
                'value'     => '1',
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Autoplay', 'hcode-addons'),
                'param_name' => 'hcode_image_carousel_autoplay',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to autoplay slider', 'hcode-addons' ),
                'group'       => 'Slider Configuration'  
          ),
          array(
                'type' => 'hcode_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => __('Stop On Hover', 'hcode-addons'),
                'param_name' => 'stoponhover',
                'value' => array(__('False', 'hcode-addons') => '0', 
                                 __('True', 'hcode-addons') => '1'
                                ),
                'description' => __( 'Select TRUE to stop autoplay when hover on slider', 'hcode-addons' ),
                'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
                'group' => 'Slider Configuration',
          ), 
          array(
              'type' => 'dropdown',
              'heading' => __('Slide Delay Time', 'hcode-addons'),
              'param_name' => 'slidespeed',
              'admin_label' => true,
              'value' => array(__('Select Slide Delay Time', 'hcode-addons') => '',
                               __('500', 'hcode-addons') => '500',
                               __('600', 'hcode-addons') => '600',
                               __('700', 'hcode-addons') => '700',
                               __('800', 'hcode-addons') => '800',
                               __('900', 'hcode-addons') => '900',
                               __('1000', 'hcode-addons') => '1000',
                               __('1100', 'hcode-addons') => '1100',
                               __('1200', 'hcode-addons') => '1200',
                               __('1300', 'hcode-addons') => '1300',
                               __('1400', 'hcode-addons') => '1400',
                               __('1500', 'hcode-addons') => '1500',
                               __('2000', 'hcode-addons') => '2000',
                               __('3000', 'hcode-addons') => '3000',
                               __('4000', 'hcode-addons') => '4000',
                               __('5000', 'hcode-addons') => '5000',
                               __('6000', 'hcode-addons') => '6000',
                               __('7000', 'hcode-addons') => '7000',
                               __('8000', 'hcode-addons') => '8000',
                               __('9000', 'hcode-addons') => '9000',
                               __('10000', 'hcode-addons') => '10000',
                              ),
              'std' => '3000',
              'description' => __('Select slide delay time (1ms = 100)', 'hcode-addons'),
              'dependency'  => array( 'element' => 'hcode_image_carousel_autoplay', 'value' => array('1') ),
              'group' => 'Slider Configuration',
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider ID', 'hcode-addons' ),
             'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
             'param_name'  => 'hcode_slider_id',
             'group'       => 'Slider ID & Class'
          ),
          array(
             'type'        => 'textfield',
             'heading'     => __('Slider Extra Class', 'hcode-addons' ),
             'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
             'param_name'  => 'hcode_slider_class',
             'group'       => 'Slider ID & Class'
          ),
          )
      )
  );
  vc_map( 
    array(
        'name' => __('Add Travel Agency Special Offer', 'hcode-addons'),
        'base' => 'hcode_travel_special_offers_slide_content',
        'description' => __( 'Add travel agency special offer content', 'hcode-addons' ),
        'as_child' => array('only' => 'hcode_travel_special_offers_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'h-code-shortcode-icon fa fa-arrows-h', //URL or CSS class with icon image.
        'params' => array(
            array(
                'type' => 'attach_image',
                'heading' => __('Slide Image', 'hcode-addons'),
                'param_name' => 'slide_image',
                'holder' => 'div'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title', 'hcode-addons'),
                'param_name' => 'title'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Subtitle', 'hcode-addons'),
                'param_name' => 'subtitle'
            ),
            array(
                'type'        => 'vc_link',
                'heading'     => __('Button config', 'hcode-addons' ),
                'param_name'  => 'button_config',
                'admin_label' => true,
              ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => __( 'Title Color', 'hcode-addons' ),
                'param_name' => 'title_color',
                'group' => 'Style',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => __( 'Subtitle Color', 'hcode-addons' ),
                'param_name' => 'subtitle_color',
                'group' => 'Style',
            ),
            $hcode_vc_extra_id,
            $hcode_vc_extra_class,
          ),
      ) 
  );

if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_travel_special_offers_slider extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_travel_special_offers_slide_content extends WPBakeryShortCode { }
}

/*---------------------------------------------------------------------------*/
/* End Onepage Travel Agency Slider Special Offers */
/*---------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Start Coming Soon
/*-----------------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Coming Soon Block', 'hcode-addons'),
  'description' => __( 'Create a coming soon content block', 'hcode-addons' ),
  'icon' => 'fa fa-list-alt h-code-shortcode-icon',
  'base' => 'hcode_coming_soon',
  'category' => 'H-Code',
  'params' => array(
    array(
        'type' => 'dropdown',
        'heading' => __('Content Type', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_type',
        'value' => array(__('Select Content Type', 'hcode-addons') => '',
                  __('Background Image', 'hcode-addons') => 'hcode-coming-soon-type1',
                  __('Background video', 'hcode-addons') => 'hcode-coming-soon-type2',
      ),
    ),
    array(
        'type' => 'attach_image',
        'heading' => __('Logo image', 'hcode-addons' ),
        'param_name' => 'hcode_coming_soon_logo',
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
    ),  
    array(
        'type' => 'textfield',
        'heading' => __('MP4 Video URL', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_mp4',
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type2') ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('OGG Video URL', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_ogg',
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type2') ),
    ),
      array(
        'type' => 'textfield',
        'heading' => __('Webm Video URL', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_webm',
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type2') ),
    ),
    array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Enable Loop', 'hcode-addons'),
          'param_name' => 'enable_loop',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'std' => '1',  
          'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type2') ),
    ),
    array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Enable Autoplay', 'hcode-addons'),
          'param_name' => 'enable_autoplay',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'std' => '1',  
          'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type2') ),
    ),
    array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Enable Controls', 'hcode-addons'),
            'param_name' => 'enable_controls',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'std' => '1',  
            'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type2') ),
      ),
    array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Enable Mute', 'hcode-addons'),
            'param_name' => 'enable_mute',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),  
            'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type2') ),
      ),
    array(
        'type' => 'textfield',
        'heading' => __('Title', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_title',
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
    ),
    
    array(
        'type' => 'textfield',
        'heading' => __('Enter Date', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_date',
        'description' => __( 'Enter date like 12/31/2016 in date format mm/dd/yyyy', 'hcode-addons' ),
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
    ),
    
    array(
        'type' => 'textarea_html',
        'heading' => __('Content', 'hcode-addons'),
        'param_name' => 'content',
    ),

    array(
        'type' => 'textfield',
        'heading' => __('Notify Me Title', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_notify_me_title',
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Notify Me Subtitle', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_notify_me_subtitle',
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
    ),
    
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Show Newsletter', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_notify_me_show_form',
        'value' => array(__('NO', 'hcode-addons') => '0', 
                         __('YES', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
    ),
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Do you want to show custom newsletter?', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_custom_newsletter',
        'value' => array(__('NO', 'hcode-addons') => '0', 
                         __('YES', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_coming_soon_notify_me_show_form', 'value' => array('1') ),
    ),
    array(
        'type' => 'textarea',
        'heading' => __('Add Custom Newsletter Shortcode', 'hcode-addons'),
        'param_name' => 'hcode_custom_newsletter',
        'dependency' => array( 'element' => 'hcode_coming_soon_custom_newsletter', 'value' => array('1') ),
    ),
    array(
        'type' => 'textfield',
        'heading' => __('Notify Me Button Text', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_notify_me_button_text',
        'value' => 'Get Notified',
        'dependency' => array( 'element' => 'hcode_coming_soon_custom_newsletter', 'value' => array('0') ),
    ),

    array(
        'type' => 'textfield',
        'heading' => __('Newsletter Placeholder Text', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_notify_placeholder',
        'value' => 'ENTER YOUR EMAIL ADDRESS',
        'dependency' => array( 'element' => 'hcode_coming_soon_custom_newsletter', 'value' => array('0') ),
    ),
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Show Facebook Icon', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_notify_me_fb',
        'value' => array(__('NO', 'hcode-addons') => '0', 
                         __('YES', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
        'group'       => 'Social',
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Facebook URL', 'hcode-addons' ),
      'param_name' => 'hcode_coming_soon_notify_me_fb_url',
      'dependency' => array( 'element' => 'hcode_coming_soon_notify_me_fb', 'value' => array('1') ),
      'group'       => 'Social',
    ),
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Show Twitter Icon', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_notify_me_tw',
        'value' => array(__('NO', 'hcode-addons') => '0', 
                         __('YES', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
        'group'       => 'Social',
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Twitter URL', 'hcode-addons' ),
      'param_name' => 'hcode_coming_soon_notify_me_tw_url',
      'dependency' => array( 'element' => 'hcode_coming_soon_notify_me_tw', 'value' => array('1') ),
      'group'       => 'Social',
    ),
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Show Google-plus Icon', 'hcode-addons'),
        'param_name' => 'hcode_coming_soon_notify_me_gp',
        'value' => array(__('NO', 'hcode-addons') => '0', 
                         __('YES', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
        'group'       => 'Social',
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Google-plus URL', 'hcode-addons' ),
      'param_name' => 'hcode_coming_soon_notify_me_gp_url',
      'dependency' => array( 'element' => 'hcode_coming_soon_notify_me_gp', 'value' => array('1') ),
      'group'       => 'Social',
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Show Dribbble Icon', 'hcode-addons'),
      'param_name' => 'hcode_coming_soon_notify_me_dr',
      'value' => array(__('NO', 'hcode-addons') => '0', 
                       __('YES', 'hcode-addons') => '1'
                      ),
      'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
      'group'       => 'Social',
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Dribbble URL', 'hcode-addons' ),
      'param_name' => 'hcode_coming_soon_notify_me_dr_url',
      'dependency' => array( 'element' => 'hcode_coming_soon_notify_me_dr', 'value' => array('1') ),
      'group'       => 'Social',
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Show Youtube Icon', 'hcode-addons'),
      'param_name' => 'hcode_coming_soon_notify_me_yt',
      'value' => array(__('NO', 'hcode-addons') => '0', 
                       __('YES', 'hcode-addons') => '1'
                      ),
      'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
      'group'       => 'Social',
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Youtube URL', 'hcode-addons' ),
      'param_name' => 'hcode_coming_soon_notify_me_yt_url',
      'dependency' => array( 'element' => 'hcode_coming_soon_notify_me_yt', 'value' => array('1') ),
      'group'       => 'Social',
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Show Linkedin Icon', 'hcode-addons'),
      'param_name' => 'hcode_coming_soon_notify_me_li',
      'value' => array(__('NO', 'hcode-addons') => '0', 
                       __('YES', 'hcode-addons') => '1'
                      ),
      'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
      'group'       => 'Social',
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Linkedin URL', 'hcode-addons' ),
      'param_name' => 'hcode_coming_soon_notify_me_li_url',
      'dependency' => array( 'element' => 'hcode_coming_soon_notify_me_li', 'value' => array('1') ),
      'group'       => 'Social',
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Show Instagram Icon', 'hcode-addons'),
      'param_name' => 'hcode_coming_soon_notify_me_in',
      'value' => array(__('NO', 'hcode-addons') => '0', 
                       __('YES', 'hcode-addons') => '1'
                      ),
      'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
      'group'       => 'Social',
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Instagram URL', 'hcode-addons' ),
      'param_name' => 'hcode_coming_soon_notify_me_in_url',
      'dependency' => array( 'element' => 'hcode_coming_soon_notify_me_in', 'value' => array('1') ),
      'group'       => 'Social',
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Show Pinterest Icon', 'hcode-addons'),
      'param_name' => 'hcode_coming_soon_notify_me_pi',
      'value' => array(__('NO', 'hcode-addons') => '0', 
                       __('YES', 'hcode-addons') => '1'
                      ),
      'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
      'group'       => 'Social',
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Pinterest URL', 'hcode-addons' ),
      'param_name' => 'hcode_coming_soon_notify_me_pi_url',
      'dependency' => array( 'element' => 'hcode_coming_soon_notify_me_pi', 'value' => array('1') ),
      'group'       => 'Social',
    ),
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Required Padding Setting?', 'hcode-addons'),
        'param_name' => 'padding_setting',
        'value' => array(__('No', 'hcode-addons') => '0', 
                         __('Yes', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
        'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'desktop_padding',
      'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
      'value' => $hcode_desktop_padding,
      'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
      'group' => 'Style',
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
      'param_name' => 'custom_desktop_padding',
      'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
      'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

        'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'ipad_padding',
      'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
      'value' => $hcode_ipad_padding,
      'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
      'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'mobile_padding',
      'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
      'value' => $hcode_mobile_padding,
      'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
        'group' => 'Style',
    ),
    array(
      'type' => 'hcode_custom_switch_option',
      'holder' => 'div',
      'class' => '',
      'heading' => __('Required Margin Setting?', 'hcode-addons'),
      'param_name' => 'margin_setting',
      'value' => array(__('No', 'hcode-addons') => '0', 
                       __('Yes', 'hcode-addons') => '1'
                      ),
      'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
        'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'desktop_margin',
      'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
      'value' => $hcode_desktop_margin,
      'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        'group' => 'Style',
    ),
    array(
      'type' => 'textfield',
      'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
      'param_name' => 'custom_desktop_margin',
      'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
      'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
        'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'ipad_margin',
      'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
      'value' => $hcode_ipad_margin,
      'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        'group' => 'Style',
    ),
    array(
      'type' => 'dropdown',
      'param_name' => 'mobile_margin',
      'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
      'value' => $hcode_mobile_margin,
      'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
        'group' => 'Style',
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Title Color', 'hcode-addons' ),
      'param_name' => 'hcode_coming_soon_title_color',
      'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
      'group' => 'Style',
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Notify Me Title Color', 'hcode-addons' ),
      'param_name' => 'hcode_coming_soon_notify_me_title_color',
      'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
      'group' => 'Style',
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Notify Me BackGround Color', 'hcode-addons' ),
      'param_name' => 'hcode_coming_soon_notify_me_bgcolor',
      'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
      'group' => 'Style',
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Notify Me Counter Color', 'hcode-addons' ),
      'param_name' => 'hcode_coming_soon_notify_me_counter_color',
      'dependency' => array( 'element' => 'hcode_coming_soon_type', 'value' => array('hcode-coming-soon-type1','hcode-coming-soon-type2') ),
      'group' => 'Style',
    ),
    $hcode_vc_extra_id,
    $hcode_vc_extra_class,
  )
) );


/*-----------------------------------------------------------------------------------*/
/*  End Coming Soon
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Start Counter
/*-----------------------------------------------------------------------------------*/

vc_map( array(
  'name' => __('Countdown Timer', 'hcode-addons'),
  'description' => __( 'Add a countdown timer', 'hcode-addons' ),
  'icon' => 'fa fa-clock-o h-code-shortcode-icon',
  'base' => 'hcode_time_counter',
  'category' => 'H-Code',
  'params' => array(
    
    array(
      'type' => 'textfield',
      'heading' => __('Enter Date', 'hcode-addons'),
      'param_name' => 'hcode_time_counter_date',
      'description' => __( 'Enter date like 12/31/2016 in date format mm/dd/yyyy', 'hcode-addons' ),
    ),
    array(
      'type' => 'colorpicker',
      'class' => '',
      'heading' => __( 'Counter Color', 'hcode-addons' ),
      'param_name' => 'hcode_time_counter_color',
    ),
    $hcode_vc_extra_id,
    $hcode_vc_extra_class,
  )
) );


/*-----------------------------------------------------------------------------------*/
/*  End Coming Soon
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Start Blog Post Slider */
/*-----------------------------------------------------------------------------------*/
$date = date('Y-m-d H:i:s'); ## Get current date
$post_slider_time = strtotime($date); ## Get timestamp of current date 
vc_map( array(
    'name' => __('Blog Post Slider', 'hcode-addons'),
    'description' => __( 'Place a blog post slider', 'hcode-addons' ),
    'icon' => 'h-code-shortcode-icon fa fa-arrows-h',
    'base' => 'hcode_blog_post_slider',
    'category' => 'H-Code',
    'params' => array(
      array(
          'type' => 'dropdown',
          'heading' => __('Slider Style', 'hcode-addons'),
          'param_name' => 'show_blog_slider_style',
          'admin_label' => true,
          'value' => array(__('Select Slider Style', 'hcode-addons') => '',
                           __('Slider Carousal', 'hcode-addons') => 'blog-slider-1',
                           __('Owl Slider', 'hcode-addons') => 'blog-slider-2',
                           __('Owl Blog Slider Grid', 'hcode-addons') => 'blog-slider-3',
                           __('Blog Post Slider', 'hcode-addons') => 'blog-slider-4',
                          ),
      ),
      array(
          'type' => 'hcode_preview_image',
          'heading' => __('Select pre-made style', 'hcode-addons'),
          'param_name' => 'slider_photography_preview_image',
          'admin_label' => true,
          'value' => array(__('Select Blog Slider Style', 'hcode-addons') => '',
                             __('Slider Carousal', 'hcode-addons') => 'blog-slider-1',
                             __('Owl Slider', 'hcode-addons') => 'blog-slider-2',
                             __('Owl Blog Slider Grid', 'hcode-addons') => 'blog-slider-3',
                             __('Blog Post Slider', 'hcode-addons') => 'blog-slider-4',
                          ),
      ),
      array(
          'type' => 'hcode_multiple_select_option',
          'heading' => __('Categories', 'hcode-addons'),
          'param_name' => 'hcode_categories_list',
          'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Title', 'hcode-addons'),
          'param_name' => 'hcode_show_post_title',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select Yes to show post title', 'hcode-addons' ),
          'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Excerpt', 'hcode-addons'),
          'param_name' => 'hcode_show_excerpt',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'std' => '1',
          'description' => __( 'Select Yes to show excerpt, no to show full content', 'hcode-addons' ),
          'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-4') ),
      ),
      array(
          'type'        => 'textfield',
          'heading'     => __('Excerpt Length', 'hcode-addons' ),
          'description' => __( 'Enter numaric value like 20', 'hcode-addons' ),
          'param_name'  => 'hcode_excerpt_length',
          'value'     => '55',
          'dependency'  => array( 'element' => 'hcode_show_excerpt', 'value' => array('1') ),
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'heading' => __('Show Date', 'hcode-addons'),
          'param_name' => 'hcode_show_date',
          'value' => array(__('No', 'hcode-addons') => '0', 
                           __('Yes', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select Yes to show date', 'hcode-addons' ),
          'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-4') ),
      ),
      array(
          'type'        => 'textfield',
          'heading'     => __('Day Format', 'hcode-addons' ),
          'param_name'  => 'hcode_day_format',
          'value'     => 'd',
          'dependency'  => array( 'element' => 'hcode_show_date', 'value' => array('1') ),
          'description' => __( 'Day format should be like dd, <a target="_blank" href="https://codex.wordpress.org/Formatting_Date_and_Time">click here</a> to see other formates', 'hcode-addons' ),
      ),
      array(
          'type'        => 'textfield',
          'heading'     => __('Month Format', 'hcode-addons' ),
          'param_name'  => 'hcode_month_format',
          'value'     => 'm',
          'dependency'  => array( 'element' => 'hcode_show_date', 'value' => array('1') ),
          'description' => __( 'Month format should be like mm, <a target="_blank" href="https://codex.wordpress.org/Formatting_Date_and_Time">click here</a> to see other formates', 'hcode-addons' ),
      ),
      array(
          'type'        => 'textfield',
          'heading'     => __('Year Format', 'hcode-addons' ),
          'param_name'  => 'hcode_year_format',
          'value'     => 'Y',
          'dependency'  => array( 'element' => 'hcode_show_date', 'value' => array('1') ),
          'description' => __( 'Year format should be like yyyy, <a target="_blank" href="https://codex.wordpress.org/Formatting_Date_and_Time">click here</a> to see other formates', 'hcode-addons' ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('No. of Items Per Slider', 'hcode-addons'),
          'description' => __( 'Define value like 3', 'hcode-addons' ),
          'param_name' => 'hcode_items_per_slider',
          'value' => '5',
          'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
      ),
      array(
          'type' => 'textfield',
          'heading' => __('No. of Post Per Page (For Desktop Device)', 'hcode-addons'),
          'description' => __( 'Define value like 3', 'hcode-addons' ),
          'param_name' => 'hcode_post_per_page_desktop',
          'value' => '3',
          'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
          'group' => 'Slider Configuration',
      ),
      array(
          'type' => 'textfield',
          'heading' => __('No. of Post Per Page (For iPad/Tablet Device)', 'hcode-addons'),
          'description' => __( 'Define value like 2', 'hcode-addons' ),
          'param_name' => 'hcode_post_per_page_ipad',
          'value' => '2',
          'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
          'group' => 'Slider Configuration',
      ),
      array(
          'type' => 'textfield',
          'heading' => __('No. of Post Per Page (For Mobile Device)', 'hcode-addons'),
          'description' => __( 'Define value like 1', 'hcode-addons' ),
          'param_name' => 'hcode_post_per_page_mobile',
          'value' => '1',
          'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
          'group' => 'Slider Configuration',
      ),
      array(
          'type' => 'hcode_custom_switch_option',
          'holder' => 'div',
          'class' => '',
          'heading' => __('Show Pagination', 'hcode-addons'),
          'param_name' => 'show_pagination',
          'value' => array(__('OFF', 'hcode-addons') => '0', 
                           __('ON', 'hcode-addons') => '1'
                          ),
          'description' => __( 'Select ON to show pagination in slider', 'hcode-addons' ),
          'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-4') ),
          'group' => 'Slider Configuration',
      ),
    array(
        'type' => 'dropdown',
        'heading' => __('Pagination Style', 'hcode-addons'),
        'param_name' => 'show_pagination_style',
        'admin_label' => true,
        'value' => array(__('Select Pagination Style', 'hcode-addons') => '',
                         __('Dot Style', 'hcode-addons') => '0',
                         __('Line Style', 'hcode-addons') => '1',
                         __('Round Style', 'hcode-addons') => '2',
                        ),
        'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
        'group' => 'Slider Configuration',
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Pagination Color Style', 'hcode-addons'),
        'param_name' => 'show_pagination_color_style',
        'admin_label' => true,
        'value' => array(__('Select Pagination Color Style', 'hcode-addons') => '',
                         __('Dark Style', 'hcode-addons') => '0',
                         __('Light Style', 'hcode-addons') => '1',
                        ),
        'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
        'group' => 'Slider Configuration',
    ),
    array(
        'type' => 'hcode_custom_switch_option',
        'holder' => 'div',
        'class' => '',
        'heading' => __('Show Navigation', 'hcode-addons'),
        'param_name' => 'show_navigation',
        'value' => array(__('OFF', 'hcode-addons') => '0', 
                         __('ON', 'hcode-addons') => '1'
                        ),
        'description' => __( 'Select ON to show navigation in slider', 'hcode-addons' ),
        'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3') ),
        'group' => 'Slider Configuration',
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Navigation Style', 'hcode-addons'),
        'param_name' => 'show_navigation_style',
        'admin_label' => true,
        'value' => array(__('Select Navigation Style', 'hcode-addons') => '',
                         __('Next/Prev Black Arrow', 'hcode-addons') => '0',
                         __('Next/Prev White Arrow', 'hcode-addons') => '1'
                        ),
        'dependency' => array( 'element' => 'show_navigation', 'value' => array('1') ),
        'group' => 'Slider Configuration',
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Cursor Color Style', 'hcode-addons'),
        'param_name' => 'show_cursor_color_style',
        'admin_label' => true,
        'value' => array(__('Select Cursor Color Style', 'hcode-addons') => '',
                         __('White Cursor', 'hcode-addons') => 'white-cursor',
                         __('Black Cursor', 'hcode-addons') => 'black-cursor',
                         __('Default Cursor', 'hcode-addons') => 'no-cursor',
                        ),
        'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
        'group' => 'Slider Configuration',
    ),
    array(
        'type' => 'dropdown',
        'heading' => __('Slide Delay Time', 'hcode-addons'),
        'param_name' => 'autoplay',
        'admin_label' => true,
        'value' => array(__('Slide Delay Time', 'hcode-addons') => '',
                         __('1000', 'hcode-addons') => '1000',
                         __('2000', 'hcode-addons') => '2000',
                          __('3000', 'hcode-addons') => '3000',
                          __('4000', 'hcode-addons') => '4000',
                          __('5000', 'hcode-addons') => '5000',
                          __('6000', 'hcode-addons') => '6000',
                          __('7000', 'hcode-addons') => '7000',
                          __('8000', 'hcode-addons') => '8000',
                          __('9000', 'hcode-addons') => '9000',
                          __('10000', 'hcode-addons') => '10000',
                          ),
        'description' => __('Select slide delay time (1s = 1000)', 'hcode-addons'),
        'std' => '3000',
        'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
        'group' => 'Slider Configuration',
    ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Title Color', 'hcode-addons' ),
        'param_name' => 'hcode_title_color',
        'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Subtitle Color', 'hcode-addons' ),
        'param_name' => 'hcode_subtitle_color',
        'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-4') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Day Color', 'hcode-addons' ),
        'param_name' => 'hcode_day_color',
        'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-4') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Month Color', 'hcode-addons' ),
        'param_name' => 'hcode_month_color',
        'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-4') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Year Color', 'hcode-addons' ),
        'param_name' => 'hcode_year_color',
        'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-4') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'colorpicker',
        'class' => '',
        'heading' => __( 'Separator Color', 'hcode-addons' ),
        'param_name' => 'hcode_seperator_color',
        'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-4') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'textfield',
        'heading' => __('Separator Height', 'hcode-addons'),
        'description' => __( 'Define height like 2px', 'hcode-addons' ),
        'param_name' => 'hcode_seperator_height',
        'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-4') ),
        'group' => 'Style',
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Display Items Order by', 'hcode-addons' ),
        'param_name' => 'orderby',
        'value' => array(__('Select Order by', 'hcode-addons') => '',
                         __( 'Date', 'hcode-addons' ) => 'date',
                         __( 'ID', 'hcode-addons' ) => 'ID',
                         __( 'Author', 'hcode-addons' ) => 'author',
                         __( 'Title', 'hcode-addons' ) => 'title',
                         __( 'Modified', 'hcode-addons' ) => 'modified',
                         __( 'Random', 'hcode-addons' ) => 'rand',
                         __( 'Comment count', 'hcode-addons' ) => 'comment_count',
                         __( 'Menu order', 'hcode-addons' ) => 'menu_order',
                        ),
        'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
        'group' => 'Order'
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Display Items Sort by', 'hcode-addons' ),
        'param_name' => 'order',
        'value' => array(__('Select Sort by', 'hcode-addons') => '',
                         __( 'Descending', 'hcode-addons' ) => 'DESC',
                         __( 'Ascending', 'hcode-addons' ) => 'ASC',
                        ),
        'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
        'group' => 'Order'
      ),
      array(
       'type'        => 'textfield',
       'heading'     => __('Slider ID', 'hcode-addons' ),
       'param_name'  => 'hcode_post_slider_id',
       'description' => 'Optional - Define element id (The id attribute specifies a unique id for an HTML element)',
       'value'       => $post_slider_time,
       'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
       'group'       => 'Slider ID & Class'
      ),  
      array(
       'type'        => 'textfield',
       'heading'     => __('Slider Extra Class', 'hcode-addons' ),
       'description' => 'Optional - add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2"',
       'param_name'  => 'hcode_post_slider_class',
       'dependency' => array( 'element' => 'show_blog_slider_style', 'value' => array('blog-slider-1','blog-slider-2','blog-slider-3','blog-slider-4') ),
       'group'       => 'Slider ID & Class'
      ),
    ),
) );
/*-----------------------------------------------------------------------------------*/
/* End Blog Post Slider */
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Separator Start */
/*-----------------------------------------------------------------------------------*/

vc_map( array(
    'name' => __('Separator', 'hcode-addons'),
    'description' => __( 'Add a separator in content', 'hcode-addons' ),
    'icon' => 'fa fa-long-arrow-up h-code-shortcode-icon fa fa-arrows-h',
    'base' => 'hcode_separator',
    'category' => 'H-Code',
    'params' => array(
        array(
            'type' => 'dropdown',
            'param_name' => 'hcode_sep_style',
            'heading' => __('Separator Size', 'hcode-addons' ),
            'value' => array(__('Select Separator Size', 'hcode-addons') => '',
                             __('Large', 'hcode-addons') => 'large',
                             __('Small', 'hcode-addons') => 'small',
                            ),
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Background Color', 'hcode-addons' ),
            'param_name' => 'hcode_sep_bg_color',
            'dependency' => array( 'element' => 'hcode_sep_style', 'value' => array('large','small') ),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Set Margin Left Right None', 'hcode-addons'),
            'param_name' => 'margin_lt_none',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'hcode_sep_style', 'value' => array('large','small') ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __('Height', 'hcode-addons'),
          'description' => __( 'Define height like 20px', 'hcode-addons' ),
          'param_name' => 'hcode_height',
          'dependency' => array( 'element' => 'hcode_sep_style', 'value' => array('large','small') ),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Padding Setting?', 'hcode-addons'),
            'param_name' => 'padding_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'hcode_sep_style', 'value' => array('large','small') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'desktop_padding',
            'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_padding',
            'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
            'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
            'group' => 'Style',
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'ipad_padding',
            'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'mobile_padding',
            'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Margin Setting?', 'hcode-addons'),
            'param_name' => 'margin_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'hcode_sep_style', 'value' => array('large','small') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'desktop_margin',
            'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_margin',
            'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
            'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
            'group' => 'Style',
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'ipad_margin',
            'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'mobile_margin',
            'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
        ),
        $hcode_vc_extra_id,
        $hcode_vc_extra_class, 
    ),
) );

/*-----------------------------------------------------------------------------------*/
/* Blog Post Slider End */
/*-----------------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Photography Grid Start */
/*---------------------------------------------------------------------------*/

vc_map( 
    array(
        'name' => __( 'Photography Content Block' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
        'base' => 'hcode_photography_grid', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
        'category' => 'H-Code',
        'description' => __( 'Create a photography content block', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
        'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
        'as_parent' => array('only' => 'hcode_photography_grid_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        'icon' => 'fa fa-list-alt h-code-shortcode-icon', //URL or CSS class with icon image.
        'js_view' => 'VcColumnView',
        'show_settings_on_create' => false,
      )
  );
  vc_map( 
    array(
        'name' => __('Add Photography', 'hcode-addons'),
        'base' => 'hcode_photography_grid_content',
        'description' => __( 'Add photography content', 'hcode-addons' ),
        'as_child' => array('only' => 'hcode_photography_grid'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'fa fa-list-alt h-code-shortcode-icon', //URL or CSS class with icon image.
        'params' => array(
            array(
              'type' => 'dropdown',
              'heading' => __('Content Type', 'hcode-addons'),
              'param_name' => 'show_content',
              'admin_label' => true,
              'value' => array(__('Select Content Type', 'hcode-addons') => '',
                               __('Image', 'hcode-addons') => 'image',
                               __('Content with title', 'hcode-addons') => 'content-with-title',
                               __('Content with Image button', 'hcode-addons') => 'content-with-img-button',
                               __('Simple Content', 'hcode-addons') => 'simple-content',
                              ),
            ),
           array(
              'type' => 'hcode_preview_image',
              'heading' => __('Select pre-made style', 'hcode-addons'),
              'param_name' => 'slider_photography_preview_image',
              'admin_label' => true,
              'value' => array(__('Select Content', 'hcode-addons') => '',
                               __('Image', 'hcode-addons') => 'image',
                               __('Content with title', 'hcode-addons') => 'content-with-title',
                               __('Content with Image button', 'hcode-addons') => 'content-with-img-button',
                               __('Simple Content', 'hcode-addons') => 'simple-content',
                              ),
          ),
          array(
            'type' => 'attach_image',
            'heading' => __('Image', 'hcode-addons' ),
            'param_name' => 'hcode_image',
            'dependency' => array( 'element' => 'show_content', 'value' => array('image','content-with-title','content-with-img-button','simple-content') ),
          ),
          array(
            'type' => 'attach_image',
            'heading' => __('Button Image', 'hcode-addons' ),
            'param_name' => 'hcode_btn_image',
            'dependency' => array( 'element' => 'show_content', 'value' => array('content-with-img-button') ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Block Title', 'hcode-addons' ),
            'param_name' => 'hcode_title',
            'dependency' => array( 'element' => 'show_content', 'value' => array('content-with-title') ),
          ),
          array(
            'type' => 'textarea_html',
            'heading' => __( 'Content', 'hcode-addons' ),
            'param_name' => 'content',
            'dependency' => array( 'element' => 'show_content', 'value' => array('content-with-img-button','simple-content') ),
          ),
           array(
            'type' => 'textfield',
            'heading' => __( 'URL', 'hcode-addons' ),
            'param_name' => 'hcode_url',
            'dependency' => array( 'element' => 'show_content', 'value' => array('content-with-title','content-with-img-button') ),
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Color', 'hcode-addons' ),
            'param_name' => 'hcode_title_color',
            'dependency' => array( 'element' => 'show_content', 'value' => array('content-with-title') ),
            'group' => 'Configuration',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Padding Setting?', 'hcode-addons'),
            'param_name' => 'padding_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'show_content', 'value' => array('image','content-with-title','content-with-img-button','simple-content') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_padding',
            'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_padding',
            'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
            'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_padding',
            'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_padding',
            'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Margin Setting?', 'hcode-addons'),
            'param_name' => 'margin_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'show_content', 'value' => array('image','content-with-title','content-with-img-button','simple-content') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_margin',
            'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_margin',
            'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
            'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
              'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_margin',
            'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_margin',
            'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,
          ),
      ) 
  );

if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_photography_grid extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_photography_grid_content extends WPBakeryShortCode { }
}

/*---------------------------------------------------------------------------*/
/* Photography Grid End */
/*---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Photography Services Start */
/*---------------------------------------------------------------------------*/
vc_map( 
    array(
        'name' => __( 'Photography Services' , 'hcode-addons' ), //Name of your shortcode for human reading inside element list
        'base' => 'hcode_photography_services', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
        'category' => 'H-Code',
        'description' => __( 'Add a photography services', 'hcode-addons' ), //Short description of your element, it will be visible in 'Add element' window
        'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
        'as_parent' => array('only' => 'hcode_photography_services_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        'icon' => 'fa fa-list-alt h-code-shortcode-icon', //URL or CSS class with icon image.
        'js_view' => 'VcColumnView',
        'show_settings_on_create' => false,
      )
  );
  vc_map( 
    array(
        'name' => __('Add Photography Service', 'hcode-addons'),
        'base' => 'hcode_photography_services_content',
        'description' => __( 'Add photography service content', 'hcode-addons' ),
        'as_child' => array('only' => 'hcode_photography_services'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'fa fa-list-alt h-code-shortcode-icon', //URL or CSS class with icon image.
        'params' => array(
          array(
            'type' => 'attach_image',
            'heading' => __('Image', 'hcode-addons' ),
            'param_name' => 'hcode_image',
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Block Title', 'hcode-addons' ),
            'param_name' => 'hcode_title',
          ),
          array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Color', 'hcode-addons' ),
            'param_name' => 'hcode_title_color',
            'group' => 'Configuration',
            ),
          array(
            'type'        => 'vc_link',
            'heading'     => __('Button Config', 'hcode-addons' ),
            'param_name'  => 'button_config',
            'admin_label' => true,
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Padding Setting?', 'hcode-addons'),
            'param_name' => 'padding_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_padding',
            'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_padding',
            'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
            'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_padding',
            'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_padding',
            'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Margin Setting?', 'hcode-addons'),
            'param_name' => 'margin_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_margin',
            'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_margin',
            'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
            'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_margin',
            'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_margin',
            'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          $hcode_vc_extra_id,
          $hcode_vc_extra_class,
          ),
      ) 
);
if(class_exists('WPBakeryShortCodesContainer')){ 
  class WPBakeryShortCode_hcode_photography_services extends WPBakeryShortCodesContainer { }
}
if(class_exists('WPBakeryShortCode')){
  class WPBakeryShortCode_hcode_photography_services_content extends WPBakeryShortCode { }
}

/*---------------------------------------------------------------------------*/
/* Photography Grid End */
/*---------------------------------------------------------------------------*/

/*---------------------------------------------------------------------------*/
/* Newsletter Start */
/*---------------------------------------------------------------------------*/
vc_map( array(
  'name' => __('Newsletter Block', 'hcode-addons'),
  'description' => __('Place a newsletter block', 'hcode-addons'),
  'icon' => 'fa fa-list-alt h-code-shortcode-icon',
  'base' => 'hcode_newsletter',
  'category' => 'H-Code',
  'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __('Block Style', 'hcode-addons'),
            'param_name' => 'hcode_newsletter_premade_style',
            'admin_label' => true,
            'value' => array(__('Select Block Style', 'hcode-addons') => '',
                             __('Newsletter Block 1', 'hcode-addons') => 'hcode-newsletter-block1',
                             __('Newsletter Block 2', 'hcode-addons') => 'hcode-newsletter-block2',
                            ),
        ),
        array(
            'type' => 'hcode_preview_image',
            'heading' => __('Select pre-made style', 'hcode-addons'),
            'param_name' => 'hcode_newsletter_preview_image',
            'admin_label' => true,
            'value' => array(__('Newsletter image', 'hcode-addons') => '',
                             __('Newsletter image1', 'hcode-addons') => 'hcode-newsletter-block1',
                             __('Newsletter image2', 'hcode-addons') => 'hcode-newsletter-block2',
                            ),
        ),
        array(
            'type' => 'hcode_etline_icon',
            'heading' => __('Select Icon', 'hcode-addons'),
            'param_name' => 'hcode_newsletter_icon',
            'admin_label' => true,
            'dependency'  => array( 'element' => 'hcode_newsletter_premade_style', 'value' => array('hcode-newsletter-block1')),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Title', 'hcode-addons'),
            'param_name' => 'hcode_newsletter_title',
            'admin_label' => true,
            'dependency'  => array( 'element' => 'hcode_newsletter_premade_style', 'value' => array('hcode-newsletter-block1')),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Subtitle', 'hcode-addons'),
            'param_name' => 'hcode_newsletter_subtitle',
            'admin_label' => true,
            'dependency'  => array( 'element' => 'hcode_newsletter_premade_style', 'value' => array('hcode-newsletter-block1')),
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Do you want to show custom newsletter?', 'hcode-addons'),
            'param_name' => 'hcode_coming_soon_custom_newsletter',
            'value' => array(__('NO', 'hcode-addons') => '0', 
                             __('YES', 'hcode-addons') => '1'
                            ),
            'dependency' => array( 'element' => 'hcode_newsletter_premade_style', 'value' => array('hcode-newsletter-block1','hcode-newsletter-block2') ),
        ),
        array(
            'type' => 'textarea',
            'heading' => __('Add Custom Newsletter Shortcode', 'hcode-addons'),
            'param_name' => 'hcode_custom_newsletter',
            'dependency' => array( 'element' => 'hcode_coming_soon_custom_newsletter', 'value' => array('1') ),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Placeholder Text', 'hcode-addons'),
            'param_name' => 'hcode_newsletter_placeholder',
            'admin_label' => true,
            'value' => 'ENTER YOUR EMAIL...',
            'dependency' => array( 'element' => 'hcode_coming_soon_custom_newsletter', 'value' => array('0') ),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Subscribe Button Text', 'hcode-addons'),
            'param_name' => 'hcode_newsletter_button_text',
            'admin_label' => true,
            'value' => 'Start Your Trial',
            'dependency' => array( 'element' => 'hcode_coming_soon_custom_newsletter', 'value' => array('0') ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Icon Size', 'hcode-addons'),
            'param_name' => 'hcode_newsletter_icon_size',
            'admin_label' => true,
            'value' => array(__('Select icon size', 'hcode-addons') => '',
                             __('Extra Large', 'hcode-addons') => 'extra-large-icon', 
                             __('Large', 'hcode-addons') => 'large-icon',
                             __('Medium', 'hcode-addons') => 'medium-icon',
                             __('Small', 'hcode-addons') => 'small-icon',
                             __('Extra Small', 'hcode-addons') => 'extra-small-icon',
                            ),
            'dependency'  => array( 'element' => 'hcode_newsletter_premade_style', 'value' => array('hcode-newsletter-block1')),
            'group' => 'Color',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Icon Color', 'hcode-addons' ),
            'param_name' => 'hcode_newsletter_icon_color',
            'dependency'  => array( 'element' => 'hcode_newsletter_premade_style', 'value' => array('hcode-newsletter-block1')),
            'group' => 'Color',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Title Color', 'hcode-addons' ),
            'param_name' => 'hcode_newsletter_title_color',
            'dependency'  => array( 'element' => 'hcode_newsletter_premade_style', 'value' => array('hcode-newsletter-block1')),
            'group' => 'Color',
        ),
        array(
            'type' => 'colorpicker',
            'class' => '',
            'heading' => __( 'Subtitle Color', 'hcode-addons' ),
            'param_name' => 'hcode_newsletter_subtitle_color',
            'dependency'  => array( 'element' => 'hcode_newsletter_premade_style', 'value' => array('hcode-newsletter-block1')),
            'group' => 'Color',
        ),
        array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Padding Setting?', 'hcode-addons'),
            'param_name' => 'padding_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'dependency'  => array( 'element' => 'hcode_newsletter_premade_style', 'value' => array('hcode-newsletter-block1','hcode-newsletter-block2')),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_padding',
            'heading' => __('Padding (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Padding (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_padding',
            'dependency' => array( 'element' => 'desktop_padding', 'value' => array('custom-desktop-padding') ),
            'description' => __( 'Specify padding like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),

            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_padding',
            'heading' => __('Padding (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_padding',
            'heading' => __('Padding (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_padding,
            'dependency' => array( 'element' => 'padding_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'hcode_custom_switch_option',
            'holder' => 'div',
            'class' => '',
            'heading' => __('Required Margin Setting?', 'hcode-addons'),
            'param_name' => 'margin_setting',
            'value' => array(__('No', 'hcode-addons') => '0', 
                             __('Yes', 'hcode-addons') => '1'
                            ),
            'dependency'  => array( 'element' => 'hcode_newsletter_premade_style', 'value' => array('hcode-newsletter-block1','hcode-newsletter-block2')),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'desktop_margin',
            'heading' => __('Margin (For Desktop Device)', 'hcode-addons' ),
            'value' => $hcode_desktop_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Custom Margin (For All Devices)', 'hcode-addons' ),
            'param_name' => 'custom_desktop_margin',
            'dependency' => array( 'element' => 'desktop_margin', 'value' => array('custom-desktop-margin') ),
            'description' => __( 'Specify margin like (10px 12px 10px 12px or 10px or 10%...)', 'hcode-addons' ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'ipad_margin',
            'heading' => __('Margin (For iPad Device)', 'hcode-addons' ),
            'value' => $hcode_ipad_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'mobile_margin',
            'heading' => __('Margin (For Mobile Device)', 'hcode-addons' ),
            'value' => $hcode_mobile_margin,
            'dependency' => array( 'element' => 'margin_setting', 'value' => array('1') ),
            'group' => 'Style',
          ),
        $hcode_vc_extra_id,
        $hcode_vc_extra_class,
  ),
) );
/*---------------------------------------------------------------------------*/
/* Newsletter End */
/*---------------------------------------------------------------------------*/ 
}
?>