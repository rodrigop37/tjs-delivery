<?php
/**
 * displaying single posts video for blog
 *
 * @package H-Code
 */
?>
<?php
// no image
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';

$video_type = hcode_post_meta('hcode_video_type');
$video = hcode_post_meta('hcode_video');
if($video_type == 'self'){
	$video_mp4 = hcode_post_meta('hcode_video_mp4');
	$video_ogg = hcode_post_meta('hcode_video_ogg');
	$video_webm = hcode_post_meta('hcode_video_webm');
    $mute = hcode_post_meta('hcode_enable_mute');
    $loop = (hcode_post_meta('hcode_enable_loop') != '' ) ? hcode_post_meta('hcode_enable_loop') : '1';
    $autoplay = (hcode_post_meta('hcode_enable_autoplay') != '' ) ? hcode_post_meta('hcode_enable_autoplay') : '1';
    $controls = (hcode_post_meta('hcode_enable_controls') != '' ) ? hcode_post_meta('hcode_enable_controls') : '1';
    $enable_mute = ($mute == 1) ? 'muted ' : '';
    $enable_loop = ($loop == 1) ? 'loop ' : '';
    $enable_autoplay = ($autoplay == 1) ? 'autoplay ' : '';
    $enable_controls = ($controls == 1) ? 'controls' : '';
    if($video_mp4 || $video_ogg || $video_webm):
        echo '<div class="blog-image bg-transparent text-center margin-bottom-30px">';
            echo '<video '.$enable_mute.$enable_loop.$enable_autoplay.$enable_controls.'>';
                if(!empty($video_mp4)){
                        echo '<source src="'.$video_mp4.'" type="video/mp4">';
                }
                if(!empty($video_ogg)){
                        echo '<source src="'.$video_ogg.'" type="video/ogg">';
                }
                if(!empty($video_webm)){
                        echo '<source src="'.$video_webm.'" type="video/webm">';
                }
            echo '</video>';
        echo '</div>';
    endif;
	
}else{
	$video_url = hcode_post_meta('hcode_video');
    if($video_url):
        echo '<div class="blog-image bg-transparent fit-videos margin-bottom-30px">';
            echo '<iframe src="'.$video_url.'" width="640" height="360"></iframe>';
        echo '</div>';
    endif;
}

$blog_image=hcode_post_meta("hcode_featured_image");
if($blog_image == 1){
    /* Image Alt, Title, Caption */
    $img_alt = hcode_option_image_alt(get_post_thumbnail_id());
    $img_title = hcode_option_image_title(get_post_thumbnail_id());
    $image_alt = ( isset($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
    $image_title = ( isset($img_title['title']) ) ? $img_title['title'] : '';

    $img_attr = array(
        'title' => $image_title,
        'alt' => $image_alt,
    );
    echo '<div class="blog-image bg-transparent">';
        if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'full',$img_attr );
        }
        else {
                echo '<img src="'.$hcode_no_image['url'].'" width="900" height="600" alt="" />';
        }
    echo '</div>';
}
?>