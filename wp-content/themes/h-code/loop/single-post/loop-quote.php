<?php
/**
 * displaying single posts quote for blog
 *
 * @package H-Code
 */
?>
<?php
// no image
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';

$blog_quote = hcode_post_meta('hcode_quote');
echo '<div class="blog-image margin-bottom-30px">';
    if($blog_quote):
        echo '<blockquote class="bg-gray">';
            echo '<p>'.$blog_quote.'</p>';
        echo '</blockquote>';
    endif;
echo '</div>';

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
        }else {
            echo '<img src="'.$hcode_no_image['url'].'" width="900" height="600" alt="" />';
        }
    echo '</div>';
}	
?>