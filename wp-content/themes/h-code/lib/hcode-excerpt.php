<?php
/**
 * Excerpt Class.
 *
 * @package H-Code
 */
?>
<?php
if(!class_exists('hcode_Excerpt')){
  class hcode_Excerpt {

    public static $length = 55;

    /**
     * Sets the length for the excerpt 
     *
     * @param string $new_length 
     * @return void
     */
    public static function hcode_get_by_length($new_length = 55) {
      return hcode_Excerpt::hcode_get( $new_length );
    }

    public static function hcode_get($new_length) {
      $hcode_output_data = '';
      $hcode_output_data = apply_filters( 'the_content', get_the_content() );
      if( $new_length > 0 ){
        $hcode_output_data = wp_trim_words( $hcode_output_data, $new_length, '...' );
      }else{
        $hcode_output_data = wp_trim_words( $hcode_output_data, $new_length, '' );
      }
      return $hcode_output_data;
    }

  }
}