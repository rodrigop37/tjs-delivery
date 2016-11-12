<?php
/**
 * H-Code Slider Preview Image For Slider Shortcode In VC.
 *
 * @package H-Code
 */
?>
<?php 
// For slider Shortcode "hcode_preview_image"
vc_add_shortcode_param( 'hcode_preview_image', 'hcode_custom_slider_image_settings_field', HCODE_ADDONS_ROOT_DIR . '/hcode-shortcodes/js/custom.js');
if ( ! function_exists( 'hcode_custom_slider_image_settings_field' ) ) :
  function hcode_custom_slider_image_settings_field( $settings, $value ) {
      $output = $default_show = '';
      $css_option = vc_get_dropdown_option( $settings, $value );
      
      $output .= '<div class="hcode-preview-image-main">';
      foreach ( $settings['value'] as $index => $data ) {
        if($value == $data){
          $default_show = ' preview-image-show';
        }
        if($data){
          $output .= '<div class="preview-image-hide '.$data.$default_show.'"><img style="width:100%;" src="'.HCODE_SHORTCODE_ADDONS_PREVIEW_IMAGE.'/'.$data.'.jpg" alt="'.$index.'" /></div>';
        }
        $default_show = '';
      }
      $output .= '</div>';

      $output .= '<select style="display:none;" name="'. $settings['param_name']. '" class="wpb_vc_param_value wpb-input wpb-select hcode_preview_image_select '. $settings['param_name']
                 . ' ' . $settings['type']
                 . ' ' . $css_option
                 . '" data-option="' . $css_option . '">';
      if ( is_array( $value ) ) {
        $value = isset( $value['value'] ) ? $value['value'] : array_shift( $value );
      }
      foreach ( $settings['value'] as $index => $data ) {
        if ( is_numeric( $index ) && ( is_string( $data ) || is_numeric( $data ) ) ) {
          $option_label = $data;
          $option_value = $data;
        } elseif ( is_numeric( $index ) && is_array( $data ) ) {
          $option_label = isset( $data['label'] ) ? $data['label'] : array_pop( $data );
          $option_value = isset( $data['value'] ) ? $data['value'] : array_pop( $data );
        } else {
          $option_value = $data;
          $option_label = $index;
        }
        $option_label = esc_attr( $option_label, 'hcode-addons' );
        
        $selected = '';
        if ( $value !== '' && (string) $option_value === (string) $value ) {
          $selected = ' selected="selected"';
        }
        $output .= '<option class="' . $option_value . '" value="' . $option_value . '" title="'.$option_value.'"' . $selected . '>'.$option_value.'</option>';
      }
      $output .= '</select>';

    return $output;
  }
endif;
?>