<?php
/**
 * displaying single posts in gallery for blog
 *
 * @package H-Code
 */
?>
<?php
$blog_lightbox_gallery = hcode_post_meta('hcode_lightbox_image');
$blog_gallery = hcode_post_meta('hcode_gallery');
$gallery = explode(",",$blog_gallery);
$popup_id = 'blog-'.get_the_ID();
$image = '';
// no image
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';

if($blog_lightbox_gallery == 1){
	if(is_array($gallery)):
		foreach ($gallery as $key => $value) {

			/* Image Alt, Title, Caption */
			$img_alt = hcode_option_image_alt($value);
			$img_title = hcode_option_image_title($value);
			$img_lightbox_caption = hcode_option_image_caption($value);
			$img_lightbox_title = hcode_option_lightbox_image_title($value);
			$image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
			$image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
			$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
			$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 

			$thumb = wp_get_attachment_image_src( $value, 'full' );
			if($thumb[0]):
                $image .='<div class="col-md-4 col-sm-6 col-xs-12 no-padding">';
                    $image .='<a '.$image_lightbox_title.$image_lightbox_caption.' href="'.$thumb[0].'" class="lightboxgalleryitem" data-group="'.$popup_id.'"><img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'/></a>';
                $image .='</div>';
            endif;
		}
	endif;
	echo '<div class="blog-image bg-transparent lightbox-gallery margin-bottom-30px">';
        echo $image;
    echo '</div>';
}else{
	if(is_array($gallery)):
		foreach ($gallery as $key => $value) {

			/* Image Alt, Title, Caption */
			$img_alt = hcode_option_image_alt($value);
			$img_title = hcode_option_image_title($value);

			$image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
			$image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
			
			$thumb = wp_get_attachment_image_src( $value, 'full' );
			if($thumb[0]):
	            $image .='<div class="item"><img src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'/></div>';
	        endif;
		}
	endif;
	echo '<div class="blog-image bg-transparent margin-bottom-30px">';
        echo '<div id="owl-demo" class="blog-gallery owl-carousel owl-theme dark-pagination">';
			echo $image;
        echo '</div>';
    echo '</div>';
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
        }else {
            echo '<img src="'.$hcode_no_image['url'].'" width="900" height="600" alt=""/>';
        }
	echo '</div>';
}	
?>