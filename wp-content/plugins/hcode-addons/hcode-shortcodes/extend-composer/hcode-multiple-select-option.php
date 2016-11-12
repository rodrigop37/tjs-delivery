<?php
/**
 * Multiple Category For Post Shortcode.
 *
 * @package H-Code
 */
?>
<?php
vc_add_shortcode_param( 'hcode_multiple_select_option', 'hcode_multiple_select_option');
if ( ! function_exists( 'hcode_multiple_select_option' ) ) :
  function hcode_multiple_select_option($settings, $value) {

    $value = explode( ',', $value );
    $value1 = '';
    foreach ($value as $k => $v) {
        $value1 .= $v;
      }
    
    $args = array(
  	  'hide_empty' => 0,
  	  'orderby' => 'name',
  	  'order' => 'ASC'
    );
    $categories = get_categories( $args );

    $output  = '<select multiple="multiple" name="'. $settings['param_name'] .'" class="wpb_vc_param_value icon-select wpb-input wpb-rs-select '. $settings['param_name'] .' '. $settings['type'] .'">';

      if(!empty($value1)):
        $selected_all = ( in_array( '0' , $value ) ) ? ' selected="selected"' : '';
        $output .= '<option value="0" '.$selected_all.'>'.__('All Categories', 'hcode-addons').'</option>';
      else:
        $output .= '<option value="0" selected="selected">'.__('All Categories', 'hcode-addons').'</option>';
      endif;
        
    	foreach ( $categories as $index => $data ) {
      	$selected = ( in_array( $data->slug, $value ) ) ? ' selected="selected"' : '';
      	$output .= '<option value="'. $data->slug .'"'. $selected .'>'.htmlspecialchars( $data->name."- (".$data->slug." - ".$data->term_id.")" ).'</option>';
    	}
    $output .= '</select>' . "\n";
     
    return $output;
  }
endif;
?>