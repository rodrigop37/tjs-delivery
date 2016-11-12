<?php
/**
 * Shortcode For Video & Sound
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Video & Sound */
/*-----------------------------------------------------------------------------------*/
 
if ( ! function_exists( 'hcode_video_sound' ) ) {
    function hcode_video_sound( $atts, $content = null ) {
        extract( shortcode_atts( array(
        	'hcode_video_type' => '',
            'hcode_vimeo_id' => '',
            'hcode_youtube_url' => '',
            'hcode_track_id' =>'',
            'width' => '',
            'height' => '',
        ), $atts ) );
        $output = '';
        $width = ( $width ) ? 'width="'.$width.'"' : '';
        $height = ( $height ) ? 'height="'.$height.'"' : '';
        switch ($hcode_video_type) {
        	case 'vimeo':
                if($hcode_vimeo_id):
                    $output .= '<div class="fit-videos">';
        		      $output .='<iframe src="https://player.vimeo.com/video/'.$hcode_vimeo_id.'?color=bb9b44&amp;title=0&amp;byline=0&amp;portrait=0" '.$width.' '.$height.'></iframe>';
                    $output .= '</div>';
                endif;
        	break;

        	case 'youtube':
                if($hcode_youtube_url):
                    $output .= '<div class="fit-videos">';
            		  $output .='<iframe '.$width.' '.$height.' src="'.$hcode_youtube_url.'"></iframe>';
                    $output .= '</div>';
                endif;
        	break;

        	case 'sound-cloud':
                if($hcode_track_id):
        		  $output .='<div class="sound"><iframe '.$width.' '.$height.' src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/'.$hcode_track_id.'&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe></div>';
                endif;
        	break;
        }
        return $output;
    }
}
add_shortcode( 'hcode_video_sound', 'hcode_video_sound' );
?>