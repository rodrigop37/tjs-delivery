<?php
/**
 * displaying content for archive pages layout
 *
 * @package H-Code
 */
?>
<?php
$output = $class_column = '';
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_excerpt_length = (isset($hcode_options['hcode_blog_page_excerpt_length'])) ? $hcode_options['hcode_blog_page_excerpt_length'] : '';
$hcode_blog_page_layout = (isset($hcode_options['hcode_blog_page_grid_layout'])) ? $hcode_options['hcode_blog_page_grid_layout'] : '';
$hcode_blog_page_column = (isset($hcode_options['hcode_blog_page_grid_column'])) ? $hcode_options['hcode_blog_page_grid_column'] : '';
$hcode_show_post_meta = (isset($hcode_options['hcode_blog_page_show_post_meta'])) ? $hcode_options['hcode_blog_page_show_post_meta'] : '';
$hcode_show_excerpt = (isset($hcode_options['hcode_blog_page_show_excerpt'])) ? $hcode_options['hcode_blog_page_show_excerpt'] : '';
$hcode_show_category = (isset($hcode_options['hcode_blog_page_show_category'])) ? $hcode_options['hcode_blog_page_show_category'] : '';
$hcode_show_comments = (isset($hcode_options['hcode_blog_page_show_comments'])) ? $hcode_options['hcode_blog_page_show_comments'] : '';
$hcode_show_social_icon = (isset($hcode_options['hcode_blog_page_show_social_icon'])) ? $hcode_options['hcode_blog_page_show_social_icon'] : '';
$hcode_show_button = (isset($hcode_options['hcode_blog_page_show_button'])) ? $hcode_options['hcode_blog_page_show_button'] : '';
$hcode_button_text = (isset($hcode_options['hcode_blog_page_button_text'])) ? $hcode_options['hcode_blog_page_button_text'] : 'Continue';
$hcode_date_format = (isset($hcode_options['hcode_blog_page_date_format'])) ? $hcode_options['hcode_blog_page_date_format'] : '';

// no image
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';

switch ($hcode_blog_page_column) {
    case '2':
        $class_column .= ' col-md-6 col-sm-6 col-xs-12';
    break;
    case '3':
        $class_column .= ' col-md-4 col-sm-6 col-xs-12 margin-four-bottom xs-margin-seven-bottom';
    break;
    case '4':
        $class_column .= ' col-md-3 col-sm-6 col-xs-12';
    break;
}
if( have_posts() ){
    switch ($hcode_blog_page_layout) {
        case 'grid':
            $blog_columns = ( $hcode_blog_page_column ) ? 'blog-'.$hcode_blog_page_column.'col' : '';
            if($hcode_blog_page_column):
               $output .='<div class="'.$blog_columns.'">';
            endif;
               
            while ( have_posts() ) : the_post();
            /* Image Alt, Title, Caption */
            $img_alt = hcode_option_image_alt(get_post_thumbnail_id());
            $img_title = hcode_option_image_title(get_post_thumbnail_id());
            $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
            $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? $img_title['title'] : '';

                $img_attr = array(
                    'title' => $image_title,
                    'alt' => $image_alt,
                );

                $post_cat = array();
                $categories = get_the_category();
                foreach ($categories as $k => $cat) {
                    $cat_link = get_category_link($cat->cat_ID);
                    $post_cat[]='<a href="'.$cat_link.'">'.$cat->name.'</a>';
                }
                $post_category=implode(", ",$post_cat);
                $show_excerpt = ( $hcode_show_excerpt == 1 ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : '';
                $hcode_show_author = esc_html__('Posted by ','hcode-addons'). '<a href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a> | ';
                $show_date = ( $hcode_show_post_meta == 1 ) ? get_the_date( $hcode_date_format, get_the_ID()) : '';
                $hcode_categories_list = $post_cat;
                $show_like = ( $hcode_show_post_meta == 1 ) ? get_simple_likes_button( get_the_ID() ) : '';                     
                $show_categories = ($hcode_show_category == 1) ? '| '.$post_category : '';

                $output .='<div class="'.$class_column.' blog-listing">';
                    $blog_quote = hcode_post_meta('hcode_quote');
                    $blog_image = hcode_post_meta('hcode_image');
                    $blog_gallery = hcode_post_meta('hcode_gallery');
                    $blog_video = hcode_post_meta('hcode_video_type');
                    if(!empty($blog_image)){
                        $output .='<div class="blog-post">';
                        ob_start();
                        get_template_part('loop/loop','image');
                        $output .= ob_get_contents();  
                        ob_end_clean();  
                    }
                    elseif(!empty($blog_gallery)){
                        $output .='<div class="blog-post blog-post-gallery">';
                        $blog_lightbox_gallery = hcode_post_meta('hcode_lightbox_image');
                        if($blog_lightbox_gallery == 1):
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                            $url = $thumb['0'];
                            $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                            if ( has_post_thumbnail() ) {
                                $output .= get_the_post_thumbnail( get_the_ID(), 'full',$img_attr );
                            }
                            else {
                                    $output .= '<img src="' . $hcode_no_image['url'] . '" width="900" height="600" alt="" />';
                            }
                            $output .='</a></div>';
                        else:
                            ob_start();
                            get_template_part('loop/loop','gallery');
                            $output .= ob_get_contents();  
                            ob_end_clean();  
                        endif;
                    }
                    elseif(!empty($blog_video)){
                        $output .='<div class="blog-post blog-post-video">';
                        ob_start();
                        get_template_part('loop/loop','video');
                        $output .= ob_get_contents();  
                        ob_end_clean();  
                    }
                    elseif(!empty($blog_quote)){
                        $output .='<div class="blog-post">';
                        ob_start();
                        get_template_part('loop/loop','quote');
                        $output .= ob_get_contents();  
                        ob_end_clean();  
                    }else{
                        $output .='<div class="blog-post">';
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                        $url = $thumb['0'];
                        $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                        if ( has_post_thumbnail() ) {
                                $output .= get_the_post_thumbnail( get_the_ID(), 'full', $img_attr );
                        }
                        else {
                                $output .= '<img src="' . $hcode_no_image['url'] . '" width="900" height="600" alt="" />';
                        }
                        $output .='</a></div>';
                    }
                    $output .='<div class="blog-details">';
                        if($hcode_show_author || $show_date || $show_categories):
                            $output .='<div class="blog-date">'.$hcode_show_author.$show_date.$show_categories.'</div>';
                        endif;
                        $output .='<div class="blog-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
                        if($show_excerpt):
                           $output .='<div class="blog-short-description">'.$show_excerpt.'</div>';
                        endif;
                        $output .='<div class="separator-line bg-black no-margin-lr"></div>';
                        $output .='<div>'.$show_like;
                            if( $hcode_show_comments == 1 && (comments_open() || get_comments_number())){
                                ob_start();
                                    comments_popup_link( __( '<i class="fa fa-comment-o"></i>Leave a comment', 'hcode-addons' ), __( '<i class="fa fa-comment-o"></i>1 Comment', 'hcode-addons' ), __( '<i class="fa fa-comment-o"></i>% Comment(s)', 'hcode-addons' ), 'comment' );
                                    $output .= ob_get_contents();  
                                ob_end_clean();
                            }
                        $output .= '</div>';
                        if($hcode_show_button == 1){
                            $output .='<a class="highlight-button btn btn-small xs-no-margin-bottom" href="'.get_permalink().'">'.$hcode_button_text.'</a>';
                        }
                    $output .='</div>';
                    $output .='</div>';
                $output .='</div>';
            endwhile;
            wp_reset_postdata();
            if( $wp_query->max_num_pages > 1 ){
                $output .='<div class="pagination">';
                    $output .= paginate_links( array(
                        'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
                        'format'       => '',
                        'add_args'     => '',
                        'current'      => max( 1, get_query_var( 'paged' ) ),
                        'total'        => $wp_query->max_num_pages,
                        'prev_text'    => '<img alt="Previous" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-small.png" width="20" height="13">',
                        'next_text'    => '<img alt="Next" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-small.png" width="20" height="13">',
                        'type'         => 'plain',
                        'end_size'     => 2,
                        'mid_size'     => 2
                    ) );
                $output .='</div>';  
            }
            if($hcode_blog_page_column):
               $output .='</div>';
            endif;
        break;
        case 'masonry':
            $blog_columns = ( $hcode_blog_page_column ) ? 'blog-'.$hcode_blog_page_column.'col' : '';
            $output .='<div class="blog-masonry '.$blog_columns.'">';
                while ( have_posts() ) : the_post();
                    /* Image Alt, Title, Caption */
                    $img_alt = hcode_option_image_alt(get_post_thumbnail_id());
                    $img_title = hcode_option_image_title(get_post_thumbnail_id());
                    $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
                    $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? $img_title['title'] : '';

                    $img_attr = array(
                        'title' => $image_title,
                        'alt' => $image_alt,
                    );
                    $post_cat = array();
                    $categories = get_the_category();
                    foreach ($categories as $k => $cat) {
                        $cat_link = get_category_link($cat->cat_ID);
                        $post_cat[]='<a href="'.$cat_link.'">'.$cat->name.'</a>';
                    }
                    $post_category=implode(", ",$post_cat);

                    $show_excerpt = ( $hcode_show_excerpt == 1 ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : '';
                    $hcode_show_author = ( $hcode_show_post_meta == 1 ) ? esc_html__('Posted by ','hcode-addons'). '<a href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a> | ' : '';
                    $show_date = ( $hcode_show_post_meta == 1 ) ? get_the_date( $hcode_date_format, get_the_ID()) : '';
                    $hcode_categories_list = $post_cat;
                    $show_like = ( $hcode_show_post_meta == 1 ) ? get_simple_likes_button( get_the_ID() ) : '';
                    $show_categories = ($hcode_show_category == 1) ? '| '.$post_category : '';

                    $output .='<div class="'.$class_column.' blog-listing">';
                        $blog_quote = hcode_post_meta('hcode_quote');
                        $blog_image = hcode_post_meta('hcode_image');
                        $blog_gallery = hcode_post_meta('hcode_gallery');
                        $blog_link = hcode_post_meta('hcode_link');
                        $blog_video = hcode_post_meta('hcode_video_type');

                        if(!empty($blog_image)){
                                $output .='<div class="blog-post">';
                                ob_start();
                                    get_template_part('loop/loop','image');
                                    $output .= ob_get_contents();  
                                    ob_end_clean();  
                            }
                            elseif(!empty($blog_gallery)){
                                $output .='<div class="blog-post blog-post-gallery">';
                                $blog_lightbox_gallery = hcode_post_meta('hcode_lightbox_image');
                                if($blog_lightbox_gallery == 1):
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                    $url = $thumb['0'];
                                    $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                                    if ( has_post_thumbnail() ) {
                                        $output .= get_the_post_thumbnail( get_the_ID(), 'full', $img_attr );
                                    }
                                    else {
                                            $output .= '<img src="' . $hcode_no_image['url'] . '" width="900" height="600" alt="" />';
                                    }
                                    $output .='</a></div>';
                                else:
                                    ob_start();
                                    get_template_part('loop/loop','gallery');
                                    $output .= ob_get_contents();  
                                    ob_end_clean();  
                                endif;
                            }
                            elseif(!empty($blog_video)){
                                $output .='<div class="blog-post blog-post-video">';
                                ob_start();
                                    get_template_part('loop/loop','video');
                                    $output .= ob_get_contents();  
                                    ob_end_clean();  
                            }
                            elseif(!empty($blog_quote)){
                                $output .='<div class="blog-post">';
                                ob_start();
                                    get_template_part('loop/loop','quote');
                                    $output .= ob_get_contents();  
                                    ob_end_clean();  
                            }else{
                                $output .='<div class="blog-post">';
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                $url = $thumb['0'];
                                $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                                if ( has_post_thumbnail() ) {
                                    $output .= get_the_post_thumbnail( get_the_ID(), 'full', $img_attr );
                                }
                                else {
                                        $output .= '<img src="' . $hcode_no_image['url'] . '" width="900" height="600" alt="" />';
                                }
                                $output .='</a></div>';
                            }
                            $output .='<div class="blog-details">';
                                if($hcode_show_author || $show_date || $show_categories):
                                    $output .='<div class="blog-date">'.$hcode_show_author.$show_date.$show_categories.' </div>';
                                endif;
                                $output .='<div class="blog-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
                                if($show_excerpt):
                                   $output .='<div class="blog-short-description">'.$show_excerpt.'</div>';
                                endif;
                                $output .='<div class="separator-line bg-black no-margin-lr"></div>';
                                $output .='<div>'.$show_like;
                                    if( $hcode_show_comments == 1 && (comments_open() || get_comments_number())){
                                        ob_start();
                                            comments_popup_link( __( '<i class="fa fa-comment-o"></i>Leave a comment', 'hcode-addons' ), __( '<i class="fa fa-comment-o"></i>1 Comment', 'hcode-addons' ), __( '<i class="fa fa-comment-o"></i>% Comment(s)', 'hcode-addons' ), 'comment' );
                                            $output .= ob_get_contents();  
                                        ob_end_clean();
                                    }
                                $output .= '</div>';
                                if($hcode_show_button == 1){
                                    $output .='<a class="highlight-button btn btn-small xs-no-margin-bottom" href="'.get_permalink().'">'.$hcode_button_text.'</a>';
                                }
                            $output .='</div>';
                            $output .='</div>';
                    $output .='</div>';
                endwhile;
                wp_reset_postdata();
            $output .='</div>';
            if( $wp_query->max_num_pages > 1 ){
                $output .='<div class="pagination">';
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
                $output .='</div>';
            }
        break;
        case 'classic':
                while ( have_posts() ) : the_post();
                    /* Image Alt, Title, Caption */
                    $img_alt = hcode_option_image_alt(get_post_thumbnail_id());
                    $img_title = hcode_option_image_title(get_post_thumbnail_id());
                    $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
                    $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? $img_title['title'] : '';

                    $img_attr = array(
                        'title' => $image_title,
                        'alt' => $image_alt,
                    );

                    $post_cat = array();
                    $categories = get_the_category();
                    foreach ($categories as $k => $cat) {
                        $cat_link = get_category_link($cat->cat_ID);
                        $post_cat[]='<a href="'.$cat_link.'">'.$cat->name.'</a>';
                    }
                    $post_category=implode(", ",$post_cat);

                    $show_excerpt = ( $hcode_show_excerpt == 1 ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : '';
                    $hcode_show_author = ( $hcode_show_post_meta == 1 ) ? esc_html__('Posted by ','hcode-addons'). '<a href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a> | ' : '';
                    $show_date = ( $hcode_show_post_meta == 1 ) ? get_the_date( $hcode_date_format, get_the_ID()) : '';
                    $show_categories = ($hcode_show_category == 1) ? '| '.$post_category : '';
                    $show_like = ( $hcode_show_post_meta == 1 ) ? get_simple_likes_button( get_the_ID() ) : '';

                    $output .='<div class="blog-listing blog-listing-classic">';
                        $blog_quote = hcode_post_meta('hcode_quote');
                        $blog_image = hcode_post_meta('hcode_image');
                        $blog_gallery = hcode_post_meta('hcode_gallery');
                        $blog_link = hcode_post_meta('hcode_link');
                        $blog_video = hcode_post_meta('hcode_video_type');

                        if(!empty($blog_image)){
                            ob_start();
                                get_template_part('loop/loop','image');
                                $output .= ob_get_contents();  
                                ob_end_clean();  
                        }
                        elseif(!empty($blog_gallery)){
                            ob_start();
                                get_template_part('loop/loop','gallery');
                                $output .= ob_get_contents();  
                                ob_end_clean();  
                        }
                        elseif(!empty($blog_video)){
                            ob_start();
                                get_template_part('loop/loop','video');
                                $output .= ob_get_contents();  
                                ob_end_clean();  
                        }
                        elseif(!empty($blog_quote)){
                            ob_start();
                                get_template_part('loop/loop','quote');
                                $output .= ob_get_contents();  
                                ob_end_clean();  
                        }else{
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                $url = $thumb['0'];
                                $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                                if ( has_post_thumbnail() ) {
                                    $output .= get_the_post_thumbnail( get_the_ID(), 'full',$img_attr );
                                }
                                else {
                                        $output .= '<img src="' . $hcode_no_image['url'] . '" width="900" height="600" alt="" />';
                                }
                                $output .='</a></div>';
                        }
                        $output .='<div class="blog-details">';
                            if($hcode_show_author || $show_date || $show_categories):
                                $output .='<div class="blog-date">'.$hcode_show_author.$show_date.$show_categories.' </div>';
                            endif;
                            $output .='<div class="blog-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
                            if($show_excerpt):
                               $output .='<div class="margin-four-bottom">'.$show_excerpt.'</div>';
                            endif;
                            $output .='<div class="separator-line bg-black no-margin"></div>';
                            if( $hcode_show_comments == 1 ):
                                $output .='<div class="margin-four-top">'.$show_like;
                                if( $hcode_show_comments == 1 && (comments_open() || get_comments_number())){
                                    ob_start();
                                        comments_popup_link( __( '<i class="fa fa-comment-o"></i>Leave a comment', 'hcode-addons' ), __( '<i class="fa fa-comment-o"></i>1 Comment', 'hcode-addons' ), __( '<i class="fa fa-comment-o"></i>% Comment(s)', 'hcode-addons' ), 'comment' );
                                        $output .= ob_get_contents();  
                                    ob_end_clean();
                                }
                                $output .= '</div>';
                            endif;
                            if($hcode_show_button == 1){
                                $output .='<a class="highlight-button btn btn-small xs-no-margin-bottom" href="'.get_permalink().'">'.$hcode_button_text.'</a>';
                            }
                        $output .='</div>';
                    $output .='</div>';
                endwhile;
                wp_reset_postdata();
                if( $wp_query->max_num_pages > 1 ){
                    $output .='<div class="pagination pull-left">';
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
                    $output .='</div>';
                }
        break;
        case 'modern':
               $i = 1;
                while ( have_posts() ) : the_post();
                /* Image Alt, Title, Caption */
                $img_alt = hcode_option_image_alt(get_post_thumbnail_id());
                $img_title = hcode_option_image_title(get_post_thumbnail_id());
                $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
                $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? $img_title['title'] : '';

                $img_attr = array(
                    'title' => $image_title,
                    'alt' => $image_alt,
                );
                $post_cat = array();
                $categories = get_the_category();
                foreach ($categories as $k => $cat) {
                    $cat_link = get_category_link($cat->cat_ID);
                    $post_cat[]='<a href="'.$cat_link.'">'.$cat->name.'</a>';
                }
                $post_category=implode(", ",$post_cat);

                if($i < 10){
                    $i = '0'.$i;
                }
                $show_excerpt = ( $hcode_show_excerpt == 1 ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : '';
                $hcode_show_author = ( $hcode_show_post_meta == 1 ) ? '<div class="blog-date-right light-gray-text2">'.esc_html__('Posted by ','hcode-addons'). '<a href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a></div><div class="separator-line bg-black no-margin-lr no-margin xs-margin-ten-bottom"></div>' : '';
                $show_date = ( $hcode_show_post_meta == 1 ) ? '<div class="blog-date-right light-gray-text2 no-padding-bottom">'.get_the_date( $hcode_date_format, get_the_ID()).'</div>' : '';
                $show_like = ( $hcode_show_post_meta == 1 ) ? get_simple_likes_button( get_the_ID() ) : '';
                
                $output .= '<div class="blog-listing blog-listing-classic blog-listing-full">';
                    $output .='<div class="col-md-2 col-sm-2 col-xs-12 clearfix text-center no-padding-right xs-padding-right">';
                        $output .='<div class="avtar text-left xs-width-100px"><a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">';
                                $output .= get_avatar( get_the_author_meta( 'ID' ), 300 );
                                $output .='</a>';
                        $output .='</div>';
                       
                        $output .=$show_date;
                        $output .=$hcode_show_author;
                    $output .='</div>';
                    $output .='<div class="col-md-10 col-sm-10 col-xs-12 no-padding-left xs-padding-left">';
                    $output .='<div class="blog-number bg-white black-text text-center alt-font">'.$i.'</div>';
                        $blog_quote = hcode_post_meta('hcode_quote');
                        $blog_image = hcode_post_meta('hcode_image');
                        $blog_gallery = hcode_post_meta('hcode_gallery');
                        $blog_link = hcode_post_meta('hcode_link');
                        $blog_video = hcode_post_meta('hcode_video_type');

                        if(!empty($blog_image)){
                            ob_start();
                                get_template_part('loop/loop','image');
                                $output .= ob_get_contents();  
                                ob_end_clean();  
                        }
                        elseif(!empty($blog_gallery)){
                            ob_start();
                                get_template_part('loop/loop','gallery');
                                $output .= ob_get_contents();  
                                ob_end_clean();  
                        }
                        elseif(!empty($blog_video)){
                            ob_start();
                                get_template_part('loop/loop','video');
                                $output .= ob_get_contents();  
                                ob_end_clean();  
                        }
                        elseif(!empty($blog_quote)){
                            ob_start();
                                get_template_part('loop/loop','quote');
                                $output .= ob_get_contents();  
                                ob_end_clean();  
                        }else{
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                            $url = $thumb['0'];
                            $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                            if ( has_post_thumbnail() ) {
                                $output .= get_the_post_thumbnail( get_the_ID(), 'full',$img_attr );
                            }
                            else {
                                    $output .= '<img src="' . $hcode_no_image['url'] . '" width="900" height="600" alt="" />';
                            }
                            $output .='</a></div>';
                        }
                    $output .='<div class="blog-details">';
                            if($hcode_show_category == 1):
                                $output .='<div class="blog-date no-padding-top alt-font">'.$post_category.'</div>';
                            endif;
                            $output .='<div class="blog-title"><a class="alt-font" href="'.get_permalink().'">'.get_the_title().'</a></div>';
                            if( $hcode_show_comments==1 ):
                                $output .='<div>';
                                    $output .= $show_like;
                                    if( $hcode_show_comments == 1 && (comments_open() || get_comments_number())){
                                        ob_start();
                                            comments_popup_link( __( '<i class="fa fa-comment-o"></i>Leave a comment', 'hcode-addons' ), __( '<i class="fa fa-comment-o"></i>1 Comment', 'hcode-addons' ), __( '<i class="fa fa-comment-o"></i>% Comment(s)', 'hcode-addons' ), 'comment' );
                                            $output .= ob_get_contents();  
                                        ob_end_clean();
                                    }
                                $output .='</div>';
                            endif;
                            $output .='<div class="separator-line bg-black no-margin-lr margin-four"></div>';
                            if($show_excerpt):
                                $output .='<div>'.$show_excerpt.'</div>';
                            endif;
                            if($hcode_show_button == 1){
                                 $output .='<a class="highlight-button-black-border btn btn-medium margin-five no-margin-bottom" href="'.get_permalink().'">'.$hcode_button_text.'</a>';
                            }
                        $output .='</div>';
                    $output .='</div>';
                $output .='</div>';
                $i++;
                endwhile;
                wp_reset_postdata();
                if( $wp_query->max_num_pages > 1 ){
                    $output .='<div class="pagination pull-left">';
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
                    $output .='</div>';
                }
        break;
    }
}else{
    get_template_part('templates/content','none');
}
echo $output;
?>