<?php
/**
 * displaying portfolio single posts in gallery for portfolio
 *
 * @package H-Code
 */
?>
<?php
$portfolio_gallery = hcode_post_meta('hcode_gallery');
$gallery = explode(",",$portfolio_gallery);
$popup_id = 'portfolio-'.get_the_ID();
$i=1;
$image = '';
// no image
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
if(is_array($gallery)):
	foreach ($gallery as $k => $value) {

		/* Image Alt, Title, Caption */
		$img_alt = hcode_option_image_alt($value);
		$img_title = hcode_option_image_title($value);
		$img_lightbox_caption = hcode_option_image_caption($value);
		$img_lightbox_title = hcode_option_lightbox_image_title($value);
		$image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
		$image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
		$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
		$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 

		$thumb_gallery = wp_get_attachment_image_src( $value, 'full' );
		if($i == 1):
			$image .= '<a href="'.$thumb_gallery[0].'" '.$image_lightbox_title.$image_lightbox_caption.' class="lightboxgalleryitem" data-group="'.$popup_id.'">';
				$image .= '<img src="'.$thumb_gallery[0].'" width="'.$thumb_gallery[1].'" height="'.$thumb_gallery[2].'" '.$image_alt.$image_title.'>';
			$image .= '</a>';
		else :
			$image .= '<a href="'.$thumb_gallery[0].'" '.$image_lightbox_title.$image_lightbox_caption.' class="lightboxgalleryitem" data-group="'.$popup_id.'"></a>';
		endif;
		$i++;
	}
endif;
echo '<div class="gallery-img lightbox-gallery margin-bottom-30px">';
	echo $image;
echo '</div>';

$portfolio_image=hcode_post_meta('hcode_featured_image');
if($portfolio_image == 1){
	/* Image Alt, Title, Caption */
	$img_alt = hcode_option_image_alt(get_post_thumbnail_id());
	$img_title = hcode_option_image_title(get_post_thumbnail_id());
	$image_alt = ( isset($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
	$image_title = ( isset($img_title['title']) ) ? $img_title['title'] : '';
	
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
	$url = $thumb['0'];
    if($url):
        echo '<div class="gallery-img margin-bottom-30px">';
            echo '<img src="' . $url . '" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'/>';
        echo '</div>';
    else:
    	echo '<img src="'.$hcode_no_image['url'].'" width="900" height="600" alt="" />';
    endif;
}
?>