<?php
/**
 * displaying content for portfolio category, tag page
 *
 * @package H-Code
 */
?>
<?php
$output = $no_padding = $classes = $container_class = '';  
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_portfolio_style = (isset($hcode_options['hcode_portfolio_cat_layout_settings'])) ? $hcode_options['hcode_portfolio_cat_layout_settings'] : '';
$hcode_columns_settings = (isset($hcode_options['hcode_portfolio_cat_columns_settings'])) ? $hcode_options['hcode_portfolio_cat_columns_settings'] : '';
// no image
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
switch ($hcode_portfolio_style) {
    case 'grid':
            $classes .= '';
            $container_class .= 'container';
            $no_padding .= '';
            break;
    case 'grid-gutter':
             $classes .= ' gutter';
             $container_class .= 'container';
             $no_padding .= '';
             break;
    case 'grid-with-title':
             $classes .= ' gutter work-with-title';
             $container_class .= 'container';
             $no_padding .= '';
             break;
    case 'wide':
            $classes .= ' wide';
            $container_class .= ' container-fluid position-relative';
            $no_padding .= ' no-padding';
            break;
    case 'wide-gutter':
            $classes .= ' gutter wide';
            $container_class .= 'container-fluid position-relative';
            $no_padding .= ' no-padding';
            break;
    case 'wide-with-title':
            $classes .= ' gutter work-with-title wide wide-title';
            $container_class .= 'container-fluid position-relative';
            $no_padding .= ' no-padding';
            break;
    case 'masonry':
            $classes .= ' masonry wide';
            $container_class .= 'container-fluid position-relative';
            $no_padding .= ' no-padding';
            break;
}
$portfolio_columns = ( $hcode_columns_settings ) ? 'work-'.$hcode_columns_settings.'col' : '';
if( have_posts() ):
    if($hcode_columns_settings || $no_padding || $classes):
        $output .='<div class="'.$portfolio_columns.$classes.'">';
    endif;
    $output .='<div class="col-md-12 grid-gallery overflow-hidden content-section '.$no_padding.'">';
        $output .='<div class="tab-content">';
            $output .='<ul class="grid masonry-items">';
        while ( have_posts() ) : the_post();
            $output .='<li>';
                $output .='<figure>';
                    $portfolio_image = hcode_post_meta('hcode_image');
                    $portfolio_gallery = hcode_post_meta('hcode_gallery');
                    $portfolio_link = hcode_post_meta('hcode_link_type');
                    $portfolio_video = hcode_post_meta('hcode_video');
                    $portfolio_subtitle = hcode_post_meta('hcode_subtitle');
                    if(!empty($portfolio_image)){
                            
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                            $url = $thumb['0'];
                            if($url):
                                $output .= '<div class="gallery-img">';
                                    $output .= '<a href="'.get_permalink().'">';
                                        $output .= '<img alt="" src="' . $url . '" width="'.$thumb[1].'" height="'.$thumb[2].'"/>';
                                    $output .= '</a>';
                                $output .= '</div>';
                            else : 
                                $output .= '<div class="gallery-img">';
                                    $output .= '<a href="'.get_permalink().'">';
                                        $output .= '<img alt="" src="' . $hcode_no_image['url'] . '" width="900" height="600" alt="" />';
                                    $output .= '</a>';
                                $output .= '</div>';
                            endif;
                           
                            $output .= '<figcaption>';
                                $output .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                $output .= '<p>'.$portfolio_subtitle.'</p>';
                            $output .= '</figcaption>';
                    }
                    elseif(!empty($portfolio_gallery)){

                            $portfolio_gallery = hcode_post_meta('hcode_gallery');
                            $gallery = explode(",",$portfolio_gallery);
                            $i=1;
                            $image = '';
                            if(is_array($gallery)):
                                foreach ($gallery as $k => $value) {
                                    $thumb_gallery = wp_get_attachment_image_src( $value, 'full' );
                                    if($i == 1):
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                        $url = $thumb['0'];
                                            if($url):
                                                $image .='<a href="'.$url.'" title="'.get_the_title().'">';
                                                    $image .= '<img src="'.$url.'" alt="'.get_the_title().'" width="'.$thumb[1].'" height="'.$thumb[2].'" alt="">';
                                                $image .= '</a>';
                                                $image .= '<a href="'.$thumb_gallery[0].'" title="'.get_the_title().'"></a>';
                                            else:
                                                $image .= '<a href="'.$thumb_gallery[0].'" title="'.get_the_title().'">';
                                                    $image .= '<img src="'.$thumb_gallery[0].'" width="'.$thumb_gallery[1].'" height="'.$thumb_gallery[2].'" alt="'.get_the_title().'">';
                                                $image .= '</a>';
                                            endif;
                                    else :
                                        $image .= '<a href="'.$thumb_gallery[0].'" title="'.get_the_title().'"></a>';
                                    endif;
                                    $i++;
                                }
                            else:
                                $output .= '<img alt="" src="' . $hcode_no_image['url'] . '" width="900" height="600" alt="" />';
                            endif;
                            $output .= '<div class="gallery-img lightbox-gallery">';
                                $output .= $image;
                            $output .= '</div>';

                            $output .= '<figcaption>';
                                $output .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                $output .= '<p>'.$portfolio_subtitle.'</p>';
                            $output .= '</figcaption>';
                    }
                    elseif(!empty($portfolio_video)){

                            $video_url = hcode_post_meta('hcode_video');
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                            $url = $thumb['0'];
                            $output .= '<div class="gallery-img">';
                                $output .= '<a class="popup-vimeo" href="'.$video_url.'">';
                                if ( $url ) {
                                    $output .= '<img src="' . $url . '" width="'.$thumb[1].'" height="'.$thumb[2].'" alt=""/>';
                                }
                                else {
                                    $output .= '<img alt="" src="' . $hcode_no_image['url'] . '" width="900" height="600" alt="" />';
                                }
                            $output .= '</a></div>';

                            $output .= '<figcaption>';
                                $output .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                $output .= '<p>'.$portfolio_subtitle.'</p>';
                            $output .= '</figcaption>'; 
                    }
                    elseif(!empty($portfolio_link)){

                            $link_url = hcode_post_meta('hcode_link');
                            $link_type = hcode_post_meta('hcode_link_type');
                            $ajax_popup_class = $link = $icon = '';
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                            $url = $thumb['0'];
                            switch ($link_type) {
                                case 'external':
                                    $ajax_popup_class .= '';
                                    $link .= $link_url;
                                    $icon .= 'class="icon-attachment"';
                                    break;

                                case 'ajax-popup':
                                    $ajax_popup_class .= 'class="simple-ajax-popup-align-top"';
                                    $link .= $link_url;
                                    $icon .= 'class="icon-browser"';
                                    break;
                            }
                            $output .= '<div class="gallery-img">';
                                    $output .= '<a href="'.$link.'" '.$ajax_popup_class.'>';
                                    if ( $url ) {
                                        $output .= '<img alt="" src="' . $url . '" width="'.$thumb[1].'" height="'.$thumb[2].'" />';
                                    }
                                    else {
                                        $output .= '<img alt="" src="' . $hcode_no_image['url'] . '" width="900" height="600" alt="" />';
                                    }
                                $output .= '</a>';
                            $output .= '</div>';

                            $output .= '<figcaption>';
                                $output .= '<h3><a href="'.$link_url.'">'.get_the_title().'</a></h3>';
                                $output .= '<p>'.$portfolio_subtitle.'</p>';
                            $output .= '</figcaption>';
                    }else{
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                            $url = $thumb['0'];
                            if($url):
                                $output .= '<div class="gallery-img">';
                                    $output .= '<a href="'.get_permalink().'">';
                                        $output .= '<img src="'.$url.'" width="'.$thumb[1].'" height="'.$thumb[2].'" alt="">';
                                    $output .= '</a>';
                                $output .= '</div>';
                            else : 
                                $output .= '<div class="gallery-img">';
                                    $output .= '<a href="'.get_permalink().'">';
                                        $output .= '<img alt="" src="' . $hcode_no_image['url'] . '" width="900" height="600" alt="" />';
                                    $output .= '</a>';
                                $output .= '</div>';
                            endif;
                            $output .= '<figcaption>';
                                $output .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                $output .= '<p>'.$portfolio_subtitle.'</p>';
                            $output .= '</figcaption>';
                    }
                $output .='</figure>';
            $output .='</li>';
        endwhile;
            $output .='</ul>';
        $output .='</div>';
    $output .='</div>';

    if($hcode_columns_settings):
        $output .='</div>';
    endif;
    if($wp_query->max_num_pages > 1):
        $output .= '<div class="pagination">';
                $output .= paginate_links( array(
                    'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
                    'format'       => '',
                    'add_args'     => '',
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                    'total'        => $wp_query->max_num_pages,
                    'prev_text'    => '<img alt="Previous" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-small.png" width="20" height="13">',
                    'next_text'    => '<img alt="Next" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-small.png" width="20" height="13">',
                    'type'         => 'plain',
                    'end_size'     => 3,
                    'mid_size'     => 3
                ) );
        $output .= '</div>';
    endif;
else:
    get_template_part('templates/content','none');
endif;
echo $output;
?>