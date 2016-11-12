<?php
/**
 * Shortcode For Portfolio
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Portfolio */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_portfolio_shortcode' ) ) {
    function hcode_portfolio_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'hcode_portfolio_style' => '',
            'hcode_portfolio_columns' =>'',
            'hcode_post_per_page' => '15',
            'orderby' => 'date',
            'order' => 'ASC',
            'hcode_categories_list' => '',
            'hcode_enable_lightbox' => '',
            'hcode_show_filter' => '',
            'hcode_show_separator' => '',
            'hcode_sep_color' => '',
            'seperator_height' => '2px',
            'hcode_filter_color' => '',
            'hcode_filter_custom_color' => '',
            'hcode_animation_style' => '',
            'padding_setting' => '',
            'desktop_padding' => '',
            'custom_desktop_padding' => '',
            'ipad_padding' => '',
            'mobile_padding' => '',
            'margin_setting' => '',
            'desktop_margin' => '',
            'custom_desktop_margin' => '',
            'ipad_margin' => '',
            'mobile_margin' => '',
            'hcode_show_button' => '',
            'button_text' => '',
        ), $atts ) );

        //global $enable_lightbox;
        $icon = $output = $container_class = $no_padding = $padding = $padding_style = $margin = $margin_style = $style_attr = $style = $classes = $seperator = $portfolio_columns = '';
        $id = ( $id ) ? ' id="'.$id.'"' : '';
        $class = ( $class ) ? ' '.$class : '';
        $hcode_portfolio_settings = hcode_post_meta('hcode_portfolio_settings');
        $hcode_post_per_page = ($hcode_post_per_page) ? $hcode_post_per_page : '-1';
        $orderby = ($orderby) ? $orderby : '"date"';
        $order = ($order) ? $order : 'ASC';
        $enable_lightbox = ($hcode_enable_lightbox == 1) ? 'lightbox-gallery' : '';
        $hcode_filter_color = ( $hcode_filter_color ) ? $hcode_filter_color : '';
        $hcode_filter_custom_color = ( $hcode_filter_custom_color ) ? $hcode_filter_custom_color : '';
        $hcode_animation_style = ( $hcode_animation_style ) ? ' wow '.$hcode_animation_style : '';
        $hcode_sep_color = ($hcode_sep_color) ? 'background:'.$hcode_sep_color.';' : '';
        $seperator_height = ($seperator_height) ? 'height:'.$seperator_height.';' : '';
        $button_text = ($button_text) ? $button_text : '';
        $hcode_portfolio_columns = ($hcode_portfolio_columns) ? $hcode_portfolio_columns : '';
        $filter_class = $filter_class_style = '';

        if($hcode_sep_color || $seperator_height):
            $seperator = 'style="'.$hcode_sep_color.$seperator_height.'"';
        endif;

        // Column Padding settings
        $padding_setting = ( $padding_setting ) ? $padding_setting : '';
        $desktop_padding = ( $desktop_padding ) ? ' '.$desktop_padding : '';
        $ipad_padding = ( $ipad_padding ) ? ' '.$ipad_padding : '';
        $mobile_padding = ( $mobile_padding ) ? ' '.$mobile_padding : '';
        $custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
        if($desktop_padding == ' custom-desktop-padding' && $custom_desktop_padding){
            $padding_style .= " padding: ".$custom_desktop_padding.";";
        }else{
            $padding .= $desktop_padding;
        }
        $padding .= $ipad_padding.$mobile_padding;

        // Column Margin settings
        $margin_setting = ( $margin_setting ) ? $margin_setting : '';
        $desktop_margin = ( $desktop_margin ) ? ' '.$desktop_margin : '';
        $ipad_margin = ( $ipad_margin ) ? ' '.$ipad_margin : '';
        $mobile_margin = ( $mobile_margin ) ? ' '.$mobile_margin : '';
        $custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
        if($desktop_margin == ' custom-desktop-margin' && $custom_desktop_margin){
            $margin_style .= " margin: ".$custom_desktop_margin.";";
        }else{
            $margin .= $desktop_margin;
        }
        $margin .= $ipad_margin.$mobile_margin;

        // Padding and Margin Style Combine
        if($padding_style){
            $style_attr .= $padding_style;
        }
        if($margin_style){
            $style_attr .= $margin_style;
        }

        if($style_attr){
            $style .= ' style="'.$style_attr.'"';
        }
        // no image
        $hcode_options = get_option( 'hcode_theme_setting' );
        $hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
        switch ($hcode_filter_color) {
            case 'nav-tabs-black':
            case 'nav-tabs-gray':
                    $filter_class = $hcode_filter_color;
                    $filter_class_style = '';
                break;

            case 'custom':
                    $filter_class = '';
                    $filter_class_style .= 'style="color:'.$hcode_filter_custom_color.'"';
                break;
            
            default:
                break;
        }

        switch ($hcode_portfolio_style) {
            case 'grid':
                    $classes .= '';
                    $container_class .= 'container';
                    $no_padding .= '';
                    break;
            case 'grid-gutter':
                     $classes .= 'gutter';
                     $container_class .= 'container';
                     $no_padding .= '';
                     break;
            case 'grid-with-title':
                     $classes .= 'gutter work-with-title';
                     $container_class .= 'container';
                     $no_padding .= '';
                     break;
            case 'wide':
                    $classes .= 'wide';
                    $container_class .= 'container-fluid position-relative';
                    $no_padding .= 'no-padding';
                    break;
            case 'wide-gutter':
                    $classes .= 'gutter wide';
                    $container_class .= 'container-fluid position-relative';
                    $no_padding .= '';
                    break;
            case 'wide-with-title':
                    $classes .= 'gutter work-with-title wide wide-title';
                    $container_class .= 'container-fluid position-relative';
                    $no_padding .= 'no-padding';
                    break;
            case 'masonry':
                    $classes .= 'masonry wide';
                    $container_class .= 'container-fluid position-relative';
                    $no_padding .= 'no-padding';
                    break;
        }
        $categories_to_display_ids = explode(",",$hcode_categories_list);
        if ( is_array( $categories_to_display_ids ) && $categories_to_display_ids[0] == '0' ) {
            unset( $categories_to_display_ids[0] );
            $categories_to_display_ids = array_values( $categories_to_display_ids );
        }
        // If no categories are chosen or "All categories", we need to load all available categories
        if ( ! is_array( $categories_to_display_ids ) || count( $categories_to_display_ids ) == 0 ) {
            $terms = get_terms( 'portfolio-category' );
            
            if ( ! is_array( $categories_to_display_ids ) ) {
                $categories_to_display_ids = array();
            }
            foreach ( $terms as $term ) {
                $categories_to_display_ids[] = $term->slug;
            }
        }
        if($hcode_show_filter == 1):
            $output .='<div class="col-md-12 text-center" >';
                $output .='<div class="text-center">';
                    $output .='<ul class="portfolio-filter nav nav-tabs '.$filter_class.$hcode_animation_style.'">';
                        $output .= '<li class="nav active"><a href="#" '.$filter_class_style.' data-filter="*">All</a></li>';
                    $taxonomy = 'portfolio-category';
                    $args = array(
                    	'orderby' => 'id',
                    	'order' => 'ASC',
                        'hide_empty'        => 0, 
                        'slug'           => $categories_to_display_ids,
                    );
                    $tax_terms = get_terms($taxonomy, $args);
                    foreach ($tax_terms as $tax_term) {
                        $output .='<li class="nav"><a href="#" '.$filter_class_style.' data-filter=".portfolio-filter-'.$tax_term->term_id.'">'.$tax_term->name.'</a></li>';
                    }
                    $output .='</ul>';
                $output .='</div>';
            $output .='</div>';
        endif;
        $portfolio_columns = ( $hcode_portfolio_columns ) ? 'work-'.$hcode_portfolio_columns.'col' : '';
        if($hcode_portfolio_columns || $id || $classes || $class):
            $output .='<div '.$id.' class="'.$portfolio_columns.' '.$classes.' '.$class.'">';
        endif;
        
        $output .='<div class="col-md-12 '.$padding.$margin.' grid-gallery overflow-hidden '.$no_padding.' content-section" '.$style.'>';
            $output .='<div class="tab-content">';
                $output .='<ul class="grid masonry-items '.$enable_lightbox.'">';
                    $args = array(
                        'post_type' => 'portfolio',
                        'posts_per_page' => $hcode_post_per_page,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'portfolio-category',
                                'field' => 'slug',
                                'terms' => $categories_to_display_ids
                           ),
                        ),
                        'orderby' => $orderby,
                        'order' => $order,
                    );
                    $portfolio_posts = new WP_Query( $args );
                    while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();

                        /* Image Alt, Title, Caption */
                        $img_alt = hcode_option_image_alt(get_post_thumbnail_id());
                        $img_title = hcode_option_image_title(get_post_thumbnail_id());
                        $img_lightbox_caption = hcode_option_image_caption(get_post_thumbnail_id());
                        $img_lightbox_title = hcode_option_lightbox_image_title(get_post_thumbnail_id());
                        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
                        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                        $image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
                        $image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 


                    	$popup_id = 'portfolio-'.get_the_ID();
                        $cat_slug = '';
                        $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                        foreach ($cat as $key => $c) {
                            $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                        }
                        $output .='<li class="'.$cat_slug.'">';
                            $output .='<figure>';
                                $portfolio_image = hcode_post_meta('hcode_image');;
                                $portfolio_gallery = hcode_post_meta('hcode_gallery');
                                $portfolio_link = hcode_post_meta('hcode_link_type');
                                $portfolio_video = hcode_post_meta('hcode_video');
                                $portfolio_subtitle = hcode_post_meta('hcode_subtitle');
                                if(!empty($portfolio_image)){
                                
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                    $url = $thumb['0'];
                                    if($url):
                                        $output .= '<div class="gallery-img">';
                                            if($enable_lightbox == 'lightbox-gallery'):
                                                $output .= '<a href="'.$url.'" '.$image_lightbox_title.$image_lightbox_caption.' class="lightboxgalleryitem" data-group="general">';
                                            else:
                                                $output .= '<a href="'.get_permalink().'">';
                                            endif;
                                                $output .= '<img '.$image_alt.$image_title.' src="' . $url . '" width="'.$thumb[1].'" height="'.$thumb[2].'"/>';
                                            $output .= '</a>';
                                        $output .= '</div>';
                                    else : 
                                        $output .= '<div class="gallery-img">';
                                            if($enable_lightbox == 'lightbox-gallery'):
                                                $output .= '<a href="'.$hcode_no_image['url'].'" width="900" height="600" alt="" class="lightboxgalleryitem" data-group="general"/>';
                                            else:
                                                $output .= '<a href="'.get_permalink().'">';
                                            endif;
                                                $output .= '<img src="'.$hcode_no_image['url'].'" width="900" height="600" alt="" />';
                                            $output .= '</a>';
                                        $output .= '</div>';
                                    endif;
                                   
                                    $output .= '<figcaption>';
                                        if($enable_lightbox == 'lightbox-gallery'):
                                            $output .= '<h3>'.get_the_title().'</h3>';
                                        else:
                                            $output .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                        endif;
                                        
                                        $output .= '<p>'.$portfolio_subtitle.'</p>';
                                        if($hcode_show_separator == 1):
                                            $output .= '<div class="separator-line-thick display-block no-margin-bottom" '.$seperator.'></div>';
                                        endif;
                                        if($hcode_show_button == 1):
                                            if($enable_lightbox == 'lightbox-gallery'):
                                                $output .='<span class="btn inner-link btn-black btn-small">'.$button_text.'</span>';
                                            else:
                                                $output .='<a class="btn inner-link btn-black btn-small" href="'.get_permalink().'">'.$button_text.'</a>';
                                            endif;
                                        endif;
                                    $output .= '</figcaption>';
                                }
                                elseif(!empty($portfolio_gallery)){

                                    $portfolio_gallery = hcode_post_meta('hcode_gallery');
                                    $gallery = explode(",",$portfolio_gallery);
                                    $i=1;
                                    $image = '';
                                    if(is_array($gallery)):
                                        foreach ($gallery as $k => $value) {

                                            /* Image Alt, Title, Caption */
                                            $img_alt_gallery = hcode_option_image_alt($value);
                                            $img_title_gallery = hcode_option_image_title($value);
                                            $img_lightbox_caption_gallery = hcode_option_image_caption($value);
                                            $img_lightbox_title_gallery = hcode_option_lightbox_image_title($value);
                                            $image_alt_gallery = ( isset($img_alt_gallery['alt']) && !empty($img_alt_gallery['alt']) ) ? 'alt="'.$img_alt_gallery['alt'].'"' : 'alt=""' ; 
                                            $image_title_gallery = ( isset($img_title_gallery['title']) && !empty($img_title_gallery['title']) ) ? ' title="'.$img_title_gallery['title'].'"' : '';
                                            $image_lightbox_caption_gallery = ( isset($img_lightbox_caption_gallery['caption']) && !empty($img_lightbox_caption_gallery['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption_gallery['caption'].'"' : '' ;
                                            $image_lightbox_title_gallery = ( isset($img_lightbox_title_gallery['title']) && !empty($img_lightbox_title_gallery['title']) ) ? ' title="'.$img_lightbox_title_gallery['title'].'"' : '' ; 

                                            $thumb_gallery = wp_get_attachment_image_src( $value, 'full' );
                                            if($i == 1):
                                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                                $url = $thumb['0'];
                                                    if($url):
                                                        $image .='<a '.$image_lightbox_title.$image_lightbox_caption.' href="'.$url.'" class="lightboxgalleryitem" data-group="'.$popup_id.'">';
                                                            $image .= '<img src="'.$url.'" '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'" >';
                                                        $image .= '</a>';
                                                        $image .= '<a href="'.$thumb_gallery[0].'" '.$image_lightbox_title_gallery.$image_lightbox_caption_gallery.' class="lightboxgalleryitem" data-group="'.$popup_id.'"></a>';
                                                    else:
                                                        $image .= '<a href="'.$thumb_gallery[0].'" '.$image_lightbox_title_gallery.$image_lightbox_caption_gallery.' class="lightboxgalleryitem" data-group="'.$popup_id.'">';
                                                            $image .= '<img src="'.$thumb_gallery[0].'" width="'.$thumb_gallery[1].'" height="'.$thumb_gallery[2].'" '.$image_alt_gallery.$image_title_gallery.'>';
                                                        $image .= '</a>';
                                                    endif;
                                            else :
                                                $image .= '<a href="'.$thumb_gallery[0].'" '.$image_lightbox_title_gallery.$image_lightbox_caption_gallery.' class="lightboxgalleryitem" data-group="'.$popup_id.'"></a>';
                                            endif;
                                            $i++;
                                        }
                                    endif;
                                    $output .= '<div class="gallery-img lightbox-gallery">';
                                        $output .= $image;
                                    $output .= '</div>';

                                    $output .= '<figcaption>';
                                        if($enable_lightbox == 'lightbox-gallery'):
                                            $output .= '<h3>'.get_the_title().'</h3>';
                                        else:
                                            $output .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                        endif;
                                        $output .= '<p>'.$portfolio_subtitle.'</p>';
                                        if($hcode_show_separator == 1):
                                            $output .= '<div class="separator-line-thick display-block no-margin-bottom" '.$seperator.'></div>';
                                        endif;
                                        if($hcode_show_button == 1):
                                            if($enable_lightbox == 'lightbox-gallery'):
                                                $output .='<span class="btn inner-link btn-black btn-small" href="'.get_permalink().'">'.$button_text.'</span>';
                                            else:
                                                $output .='<a class="btn inner-link btn-black btn-small" href="'.get_permalink().'">'.$button_text.'</a>';
                                            endif;

                                        endif;
                                    $output .= '</figcaption>';
                                }
                                elseif(!empty($portfolio_video)){

                                    $video_url = hcode_post_meta('hcode_video');
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                    $url = $thumb['0'];
                                    $output .= '<div class="gallery-img">';
                                        if($enable_lightbox == 'lightbox-gallery'):
                                            $output .= '<a href="'.$url.'" '.$image_lightbox_title.$image_lightbox_caption.' class="lightboxgalleryitem" data-group="general">';
                                        else:
                                            $output .= '<a class="popup-vimeo" href="'.$video_url.'">';
                                        endif;
                                        if ( $url ) {
                                            $output .= '<img src="' . $url . '" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'/>';
                                        }
                                        else {
                                            $output .= '<img src="'.$hcode_no_image['url'].'" width="900" height="600" alt="" />';
                                        }
                                    $output .= '</a></div>';

                                    $output .= '<figcaption>';

                                        if($enable_lightbox == 'lightbox-gallery'):
                                            $output .= '<h3>'.get_the_title().'</h3>';
                                        else:
                                            $output .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                        endif;

                                        $output .= '<p>'.$portfolio_subtitle.'</p>';
                                        if($hcode_show_separator == 1):
                                            $output .= '<div class="separator-line-thick display-block no-margin-bottom" '.$seperator.'></div>';
                                        endif;
                                        if($hcode_show_button == 1):
                                            if($enable_lightbox == 'lightbox-gallery'):
                                                $output .='<span class="btn inner-link btn-black btn-small">'.$button_text.'</span>';
                                            else:
                                                $output .='<a class="btn inner-link btn-black btn-small" href="'.get_permalink().'">'.$button_text.'</a>';
                                            endif;
                                            
                                        endif;
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
                                            break;

                                        case 'ajax-popup':
                                            $ajax_popup_class .= 'class="simple-ajax-popup-align-top"';
                                            $link .= $link_url;
                                            break;
                                    }
                                    $output .= '<div class="gallery-img">';
                                            if($enable_lightbox == 'lightbox-gallery'):
                                                $output .= '<a href="'.$url.'" '.$image_lightbox_title.$image_lightbox_caption.' class="lightboxgalleryitem" data-group="general">';
                                            else:
                                                $output .= '<a href="'.$link.'" '.$ajax_popup_class.'>';
                                            endif;
                                            if ( $url ) {
                                                $output .= '<img '.$image_alt.$image_title.' src="' . $url . '" width="'.$thumb[1].'" height="'.$thumb[2].'" />';
                                            }
                                            else {
                                                $output .= '<img alt="" src="'.$hcode_no_image['url'].'" width="900" height="600" />';
                                            }
                                        $output .= '</a>';
                                    $output .= '</div>';


                                    $output .= '<figcaption>';

                                        if($enable_lightbox == 'lightbox-gallery'):
                                            $output .= '<h3>'.get_the_title().'</h3>';
                                        else:
                                            $output .= '<h3><a href="'.$link_url.'">'.get_the_title().'</a></h3>';
                                        endif;
                                        $output .= '<p>'.$portfolio_subtitle.'</p>';
                                        if($hcode_show_separator == 1):
                                            $output .= '<div class="separator-line-thick display-block no-margin-bottom" '.$seperator.'></div>';
                                        endif;
                                        if($hcode_show_button == 1):
                                            if($enable_lightbox == 'lightbox-gallery'):
                                                $output .='<span class="btn inner-link btn-black btn-small">'.$button_text.'</span>';
                                            else:
                                                $output .='<a class="btn inner-link btn-black btn-small" href="'.$link_url.'">'.$button_text.'</a>';
                                            endif;
                                            
                                        endif;
                                    $output .= '</figcaption>';
                                }else{
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                    $url = $thumb['0'];
                                    if($url):
                                        $output .= '<div class="gallery-img">';
                                            if($enable_lightbox == 'lightbox-gallery'):
                                                $output .= '<a href="'.$url.'" '.$image_lightbox_title.$image_lightbox_caption.' class="lightboxgalleryitem" data-group="general">';
                                            else:
                                                $output .= '<a href="'.get_permalink().'">';
                                            endif;
                                                $output .= '<img src="'.$url.'" width="'.$thumb[1].'" height="'.$thumb[2].'" '.$image_alt.$image_title.'>';
                                            $output .= '</a>';
                                        $output .= '</div>';
                                    else : 
                                        $output .= '<div class="gallery-img">';
                                            if($enable_lightbox == 'lightbox-gallery'):
                                                $output .= '<a href="'.$hcode_no_image['url'].'" width="900" height="600" class="lightboxgalleryitem" data-group="general">';
                                            else:
                                                $output .= '<a href="'.get_permalink().'">';
                                            endif;
                                                $output .= '<img src="'.$hcode_no_image['url'].'" width="900" height="600" alt=""/>';
                                            $output .= '</a>';
                                        $output .= '</div>';
                                    endif;
                                    $output .= '<figcaption>';
                                        if($enable_lightbox == 'lightbox-gallery'):
                                            $output .= '<h3>'.get_the_title().'</h3>';
                                        else:
                                            $output .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                        endif;
                                        $output .= '<p>'.$portfolio_subtitle.'</p>';
                                        if($hcode_show_separator == 1):
                                            $output .= '<div class="separator-line-thick display-block no-margin-bottom" '.$seperator.'></div>';
                                        endif;
                                        if($hcode_show_button == 1):
                                            if($enable_lightbox == 'lightbox-gallery'):
                                                $output .='<span class="btn inner-link btn-black btn-small">'.$button_text.'</span>';
                                            else:
                                                $output .='<a class="btn inner-link btn-black btn-small" href="'.get_permalink().'">'.$button_text.'</a>';
                                            endif;
                                            
                                        endif;
                                    $output .= '</figcaption>';
                                }
                            $output .='</figure>';
                        $output .='</li>';
                    endwhile;
                    wp_reset_postdata();
                $output .='</ul>';
            $output .='</div>';
        $output .='</div>';
        if($hcode_portfolio_columns || $id || $classes || $class):
            $output .='</div>';
        endif;
        return $output;
    }
}
add_shortcode( 'hcode_portfolio', 'hcode_portfolio_shortcode' );
?>