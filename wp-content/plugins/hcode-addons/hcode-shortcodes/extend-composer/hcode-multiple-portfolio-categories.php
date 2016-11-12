<?php
/**
 * Multiple Category For Portfolio Shortcode.
 *
 * @package H-Code
 */
?>
<?php
vc_add_shortcode_param( 'hcode_multiple_portfolio_categories', 'hcode_portfolio_category');
if ( ! function_exists( 'hcode_portfolio_category' ) ) :
  function hcode_portfolio_category($settings, $value) {
    $value = explode( ',', $value );
    $output = $value1 = '';
    foreach ($value as $k => $v) {
        $value1 .= $v;
      }

    $taxonomy = 'portfolio-category';
    $args = array(
      'hide_empty'  => false,
    ); 
    $terms = get_terms($taxonomy,$args);
    $output .= '<select multiple="multiple" name="'. $settings['param_name'] .'" class="wpb_vc_param_value icon-select wpb-input wpb-rs-select '. $settings['param_name'] .' '. $settings['type'] .'">';
    
    if(!empty($value1)):
      $selected_all = ( in_array( '0' , $value ) ) ? ' selected="selected"' : '';
      $output .= '<option value="0" '.$selected_all.'>'.__('All Categories', 'hcode-addons').'</option>';
    else:
      $output .= '<option value="0" selected="selected">'.__('All Categories', 'hcode-addons').'</option>';
    endif;
        foreach ( $terms as $term ) {  
        	$selected = ( in_array( $term->slug, $value ) ) ? ' selected="selected"' : '';
        	$output .= '<option value="'. $term->slug .'"'. $selected .'>'.htmlspecialchars( $term->name." - (".$term->slug." - ".$term->term_id.")").'</option>';
      	}
    $output .= '</select>' . "\n";
     
    return $output;
  }
endif;
?>