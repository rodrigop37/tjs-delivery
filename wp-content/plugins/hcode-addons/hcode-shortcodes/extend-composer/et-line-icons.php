<?php
/**
 * ET-Line List.
 *
 * @package H-Code
 */
?>
<?php 
if ( ! function_exists( 'hcode_custom_et_line_icon' ) ) :
  function hcode_custom_et_line_icon($settings, $value) {
    $css_option = vc_get_dropdown_option( $settings, $value );
    $counter_icons_list = hcode_get_et_line_icon();
   
    $value = explode( ',', $value );

    $output  = '<select name="'. $settings['param_name'] .'" data-placeholder="'. $settings['placeholder'] .'" class="wpb_vc_param_value icon-select wpb-input wpb-rs-select '.$settings['icon_type'].' '. $settings['param_name'] .' '. $settings['type'] .' '. $css_option .'" data-option="'. $css_option .'" data-icon-type="'.$icon_type.'">';
      foreach ( $counter_icons_list as $icon => $val ) {
        $selected = ( in_array( $val, $value ) ) ? ' selected="selected"' : '';
        
        $output .= '<option data-icon="'. $icon .'" value="'. $val .'"'. $selected .'>'.htmlspecialchars( $val ).'</option>';
      }
    $output .= '</select>' . "\n";
    return $output;
  }
endif;
vc_add_shortcode_param('hcode_et_line_icon', 'hcode_custom_et_line_icon');

if( !function_exists('hcode_get_et_line_icon')):
  function hcode_get_et_line_icon() {
    $icons = array('icon-mobile','icon-laptop','icon-desktop','icon-tablet','icon-phone','icon-document','icon-documents','icon-search','icon-clipboard','icon-newspaper','icon-notebook','icon-book-open','icon-browser','icon-calendar','icon-presentation','icon-picture','icon-pictures','icon-video','icon-camera','icon-printer','icon-toolbox','icon-briefcase','icon-wallet','icon-gift','icon-bargraph','icon-grid','icon-expand','icon-focus','icon-edit','icon-adjustments','icon-ribbon','icon-hourglass','icon-lock','icon-megaphone','icon-shield','icon-trophy','icon-flag','icon-map','icon-puzzle','icon-basket','icon-envelope','icon-streetsign','icon-telescope','icon-gears','icon-key','icon-paperclip','icon-attachment','icon-pricetags','icon-lightbulb','icon-layers','icon-pencil','icon-tools','icon-tools-2','icon-scissors','icon-paintbrush','icon-magnifying-glass','icon-circle-compass','icon-linegraph','icon-mic','icon-strategy','icon-beaker','icon-caution','icon-recycle','icon-anchor','icon-profile-male','icon-profile-female','icon-bike','icon-wine','icon-hotairballoon','icon-globe','icon-genius','icon-map-pin','icon-dial','icon-chat','icon-heart','icon-cloud','icon-upload','icon-download','icon-target','icon-hazardous','icon-piechart','icon-speedometer','icon-global','icon-compass','icon-lifesaver','icon-clock','icon-aperture','icon-quote','icon-scope','icon-alarmclock','icon-refresh','icon-happy','icon-sad','icon-facebook','icon-twitter','icon-googleplus','icon-rss','icon-tumblr','icon-linkedin','icon-dribbble');
    return $icons;
  }
endif;
?>