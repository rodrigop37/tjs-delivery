<?php
/**
 * Shortcode For Blog Post Slider
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Blog Post Slider */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_blog_post_slider_shortcode' ) ) {
    function hcode_blog_post_slider_shortcode( $atts, $content = null ) {
    	extract( shortcode_atts( array(
                    'show_blog_slider_style' => '',
                    'hcode_post_slider_id' => '',
            	    'hcode_post_slider_class' => '',
                    'hcode_categories_list' => '',
                    'hcode_show_post_title' => '',
                    'hcode_show_excerpt' => '1',
                    'hcode_excerpt_length' => '55',
                    'hcode_show_date' => '',
                    'hcode_day_format' => '',
                    'hcode_month_format' => '',
                    'hcode_year_format' => '',
                    'hcode_title_color' => '',
                    'hcode_subtitle_color' => '',
                    'hcode_day_color' => '',
                    'hcode_month_color' => '',
                    'hcode_year_color' => '',
                    'hcode_seperator_color' => '',
                    'hcode_seperator_height' => '',
                    'hcode_items_per_slider' => '5',
                    'hcode_post_per_page_desktop' => '3',
                    'hcode_post_per_page_ipad' => '2',
                    'hcode_post_per_page_mobile' => '1',
                    'show_pagination' => '',
                    'show_pagination_style' => '',
                    'show_pagination_color_style' => '',
                    'show_navigation' => '',
                    'show_navigation_style' => '',
                    'show_cursor_color_style' => '',
                    'autoplay' => '',
                    'orderby' => '',
                    'order' => '',
        ), $atts ) );


        $output  = $slider_config = $slider_id = $seperator = $blog_post = '';
        $hcode_post_slider_id = ( $hcode_post_slider_id ) ? 'blog-post-slider-'.$hcode_post_slider_id : 'blog-post-slider-demo';
        $hcode_post_slider_class = ( $hcode_post_slider_class ) ? ' '.$hcode_post_slider_class : '';
        
        $hcode_categories_list = ( $hcode_categories_list ) ? $hcode_categories_list : '';
        $pagination = ($show_pagination_style) ? hcode_owl_pagination_slider_classes($show_pagination_style) : hcode_owl_pagination_slider_classes('default');
        $pagination_style = ($show_pagination_color_style) ? hcode_owl_pagination_color_classes($show_pagination_color_style) : hcode_owl_pagination_color_classes('default');
        $navigation = ( $show_navigation_style ) ? hcode_owl_navigation_slider_classes( $show_navigation_style) : hcode_owl_navigation_slider_classes('default') ;
        $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' cursor-black';

        $hcode_items_per_slider = ( $hcode_items_per_slider ) ? $hcode_items_per_slider : '';
        
        $hcode_post_per_page_desktop = ( $hcode_post_per_page_desktop ) ? $hcode_post_per_page_desktop : '3';
        $hcode_post_per_page_ipad = ( $hcode_post_per_page_ipad ) ? $hcode_post_per_page_ipad : '2';
        $hcode_post_per_page_mobile = ( $hcode_post_per_page_mobile ) ? $hcode_post_per_page_mobile : '1';

        $hcode_title_color = ($hcode_title_color) ? 'style="color:'.$hcode_title_color.' !important"' : '';
        $hcode_subtitle_color = ($hcode_subtitle_color) ? 'style="color:'.$hcode_subtitle_color.' !important"' : '';
        $hcode_day_color = ($hcode_day_color) ? 'style="color:'.$hcode_day_color.' !important"' : '';
        $hcode_month_color = ($hcode_month_color) ? 'style="color:'.$hcode_month_color.' !important"' : '';
        $hcode_year_color = ($hcode_year_color) ? 'style="color:'.$hcode_year_color.' !important"' : '';
        $hcode_seperator_color = ($hcode_seperator_color) ? 'background:'.$hcode_seperator_color.' !important;' : '';
        $hcode_seperator_height = ($hcode_seperator_height) ? 'height:'.$hcode_seperator_height.';' : '';
        
        // no image
        $hcode_options = get_option( 'hcode_theme_setting' );
        $hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
        if($hcode_seperator_color || $hcode_seperator_height):
            $seperator .= 'style = "'.$hcode_seperator_color.$hcode_seperator_height.'"';
        endif;
        $orderby = ( $orderby ) ? $orderby : 'date';
        $order = ( $order ) ? $order : 'DESC';
          
        $args = array('post_type' => 'post',
                    'posts_per_page' => $hcode_items_per_slider,
                   'category_name' => $hcode_categories_list,
                   'orderby' => $orderby,
                   'order' => $order,
    		       );
        $hcode_post_slider = new WP_Query( $args );

        // For Added Extra class
        if($show_blog_slider_style == 'blog-slider-3'):
            $blog_post .= 'blog-post-slider';
        elseif($show_blog_slider_style == 'blog-slider-2'):
            $blog_post .= 'blog-slider';
        elseif($show_blog_slider_style == 'blog-slider-1'):
            $blog_post .= 'blog-slider blog-slider-padding';
        else : 
            $blog_post .= 'blog-slider';
        endif;

        $output .= '<div class="'.$blog_post.' position-relative">';
        if($show_blog_slider_style == 'blog-slider-1'):
            $output .= '<div class="container">';
                $output .= '<div class="row">';
        endif;

        $output .= '<div id="'.$hcode_post_slider_id.'" class="owl-carousel owl-theme '.$hcode_post_slider_class.$navigation.$pagination.$pagination_style.$show_cursor_color_style.'">';
            while ( $hcode_post_slider->have_posts() ) : $hcode_post_slider->the_post();

                /* Image Alt, Title, Caption */
                $img_alt = hcode_option_image_alt(get_post_thumbnail_id());
                $img_title = hcode_option_image_title(get_post_thumbnail_id());
                $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
                $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? $img_title['title'] : '';

                $img_attr = array(
                    'title' => $image_title,
                    'alt' => $image_alt,
                );

                $hcode_show_post_title = ( $hcode_show_post_title ) ? $hcode_show_post_title : '';
                $show_excerpt = ( $hcode_excerpt_length ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : wpautop(hcode_get_the_excerpt_theme(55));
                $hcode_show_date = ( $hcode_show_date ) ? $hcode_show_date : '';
                $_hcode_day_format = ( $hcode_day_format ) ? get_the_date( $hcode_day_format, get_the_ID() ) : get_the_date('d', get_the_ID());
                $_hcode_month_format = ( $hcode_month_format ) ? get_the_date( $hcode_month_format, get_the_ID() ) : get_the_date('m', get_the_ID());
                $_hcode_year_format = ( $hcode_year_format ) ? get_the_date( $hcode_year_format, get_the_ID()) : get_the_date( 'Y', get_the_ID());
                
                $post_author = get_post_field( 'post_author', get_the_ID() );
                $author = '<a class="light-gray-text2" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'.get_the_author_meta( 'user_nicename', $post_author).'</a>';
                $blog_quote = get_post_meta(get_the_ID(),'hcode_quote_single',true);
                $blog_image = get_post_meta(get_the_ID(),'hcode_image_single',true);
                $blog_gallery = get_post_meta(get_the_ID(),'hcode_gallery_single',true);
                $blog_video = get_post_meta(get_the_ID(),'hcode_video_type_single',true);

                switch ($show_blog_slider_style) {
                case "blog-slider-1" :
                        if(!empty($blog_image)){
                            $output .='<div class="blog-post">';
                                ob_start();
                                get_template_part('loop/loop','image');
                                $output .= ob_get_contents();  
                                ob_end_clean();  
                        }
                        elseif(!empty($blog_gallery)){
                            $output .='<div class="blog-post blog-post-gallery">';
                                ob_start();
                                get_template_part('loop/loop','gallery');
                                $output .= ob_get_contents();  
                                ob_end_clean();  
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
                                    $output .= get_the_post_thumbnail( get_the_ID(), 'full',$img_attr );
                                }
                                else {
                                        $output .= '<img src="'.$hcode_no_image['url'].'" width="900" height="600" alt=""/>';
                                }
                                $output .='</a></div>';
                        }
                        $output .='<div class="post-details">';
                            if($hcode_show_post_title == 1):
                                $output .='<a href="'.get_permalink(get_the_ID()).'" class="post-title sm-margin-top-ten xs-no-margin-top" '.$hcode_title_color.'>'.get_the_title(get_the_ID()).'</a>';
                            endif;
                            $output .='<span class="post-author light-gray-text2">'.esc_html__('Posted by ','hcode-addons').$author.' | '.get_the_date('d F Y', get_the_ID()).'</span>';
                            if( $hcode_show_excerpt == 1 ):
                                $output .= $show_excerpt;
                            endif;
                        $output .='</div>';
                    $output .='</div>';
                    break;

                case "blog-slider-2" :
                    $output .='<div class="item">';
                        $output .='<div class="blog-slider-con">';
                            $output .='<figure>';
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
                                                $output .= '<img src="' . $hcode_no_image['url'] . '" width="900" height="600" alt=""/>';
                                        }
                                        $output .='</a></div>';
                                }
                                $output .='<figcaption>';
                                    if($hcode_show_post_title == 1):
                                        $output .='<h3><a class="white-text-link" href="'.get_permalink(get_the_ID()).'" '.$hcode_title_color.'>'.get_the_title().'</a></h3>';
                                    endif;
                                    $output .='<span class="post-author light-gray-text">'.esc_html__('Posted by ','hcode-addons').$author.' | '.get_the_date('d F Y', get_the_ID()).'</span>';
                                    $output .='<a href="'.get_permalink(get_the_ID()).'" class="btn-small-white btn margin-five-top no-margin-bottom inner-link">Continue Reading</a>';
                                $output .='</figcaption>';
                            $output .='</figure>';
                        $output .='</div>';
                    $output .='</div>';
                    break;

                case "blog-slider-3" :
                     $output .='<div class="item">';
                        $output .='<div class="blog-slider-grid">';
                            $output .='<figure>';
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
                                                $output .= '<img src="'.$hcode_no_image['url'].'" width="900" height="600" alt=""/>';
                                        }
                                        $output .='</a></div>';
                                }
                                $output .='<figcaption>';
                                    if($hcode_show_post_title == 1):
                                        $output .='<h3><a class="white-text-link" href="'.get_permalink(get_the_ID()).'" '.$hcode_title_color.'>'.get_the_title().'</a></h3>';
                                    endif;
                                    $output .='<span class="post-author light-gray-text2">'.esc_html__('Posted by ','hcode-addons').$author.' | '.get_the_date('d F Y', get_the_ID()).'</span>';
                                $output .='</figcaption>';
                            $output .='</figure>';
                        $output .='</div>';
                    $output .='</div>';
                    break;

                case "blog-slider-4" :
                    if( ( $hcode_show_date == 1 ) || ( $_hcode_day_format || $_hcode_month_format || $_hcode_year_format || $hcode_show_post_title == 1 || $show_excerpt ) ):
                        $output .='<div class="item">';
                            if( ( $hcode_show_date == 1 ) && ( $_hcode_day_format || $_hcode_month_format || $_hcode_year_format ) ):
                                $output .='<div class="col-md-2 col-sm-3 col-xs-3 col-md-offset-1 text-center">';
                                    if( $_hcode_day_format ):
                                        $output .='<span class="timeline-number alt-font bg-white black-text display-inline-block" '.$hcode_day_color.'>'.$_hcode_day_format.'</span>';
                                    endif;
                                    if( $_hcode_month_format ):
                                        $output .='<span class="text-large white-text display-block margin-ten-top" '.$hcode_month_color.'>'.$_hcode_month_format.'</span>';
                                    endif;
                                    if( $_hcode_year_format ):
                                        $output .='<span class="text-large white-text display-block margin-ten-bottom" '.$hcode_year_color.'>'.$_hcode_year_format.'</span>';
                                    endif;
                                    $output .='<div class="thin-separator-line bg-yellow" '.$seperator.'></div>';
                                $output .='</div>';
                            endif;
                            if( $hcode_show_post_title == 1 || $hcode_show_excerpt == 1 ):
                                $output .='<div class="col-md-9 col-sm-8 col-xs-9 border-right border-transperent-light xs-no-border">';
                                    if( $hcode_show_post_title == 1 ):
                                        $output .='<h5 class="title-small text-uppercase font-weight-700 letter-spacing-1 white-text"><a href="'.get_permalink().'" '.$hcode_title_color.'>'.get_the_title().'</a></h5>';
                                    endif;
                                    if( $hcode_show_excerpt == 1 ):
                                        $output .='<div class="text-med margin-three width-80 gray-text xs-width-100 float-left post-slider-no-margin" '.$hcode_subtitle_color.'>'.$show_excerpt.'</div>';
                                    endif;
                                $output .='</div>';
                            endif;
                        $output .='</div>';
                    endif;
                    break;
                }
            endwhile;
            wp_reset_postdata();
        $output .='</div>';
        if($show_blog_slider_style == 'blog-slider-1'):
                $output .= '</div>';
            $output .= '</div>';
        endif;
        $output .='</div>';
        // For Navigation
        switch ($show_blog_slider_style) {
                case 'blog-slider-1':
                    if( $show_navigation == 1 ):
                        if($show_navigation_style == 1):
                            $output .= '<div class="feature_nav">';
                                $output .= '<a class="prev left carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre.png" width="96" height="96"></a>';
                                $output .= '<a class="next right carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next.png" width="96" height="96"></a>';
                            $output .= '</div>';
                        else:
                            $output .= '<div class="feature_nav">';
                                $output .= '<a class="prev left carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-white-bg.png" width="96" height="96"></a>';
                                $output .= '<a class="next right carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-white-bg.png" width="96" height="96"></a>';
                            $output .= '</div>';
                        endif;
                    endif;
                    break;

                case 'blog-slider-2':
                    if( $show_navigation == 1 ):
                        if($show_navigation_style == 1):
                            $output .= '<div class="feature_nav">';
                                $output .= '<a class="prev left carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre.png" width="96" height="96"></a>';
                                $output .= '<a class="next right carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next.png" width="96" height="96"></a>';
                            $output .= '</div>';
                        else:
                            $output .= '<div class="feature_nav">';
                                $output .= '<a class="prev left carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-white-bg.png" width="96" height="96"></a>';
                                $output .= '<a class="next right carousel-control"><img alt="" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-white-bg.png" width="96" height="96"></a>';
                            $output .= '</div>';
                        endif;
                    endif;
                    break;
                    
                case 'blog-slider-3':
                    ( $show_navigation == 1 ) ? $slider_config .= 'navigation: true,' : $slider_config .= 'navigation: false,';
                    break;
                }
            
    	/* Add custom script Start*/
    	( $show_pagination == 1 ) ? $slider_config .= 'pagination: true,' : $slider_config .= 'pagination: false,';
    	( $autoplay ) ? $slider_config .= 'autoPlay: '.$autoplay.',' : '';
    	$slider_config .= 'items: '.$hcode_post_per_page_desktop.',';
        $slider_config .= 'itemsDesktop: [1200, '.$hcode_post_per_page_desktop.'],';
        $slider_config .= 'itemsTablet: [991, '.$hcode_post_per_page_ipad.'],';
        $slider_config .= 'itemsMobile: [700, '.$hcode_post_per_page_mobile.'],';
    	$slider_config .= 'navigationText: ["<i class=\'fa fa-angle-left\'></i>", "<i class=\'fa fa-angle-right\'></i>"]';
    	ob_start();?>
    <script type="text/javascript">jQuery(document).ready(function () { jQuery("<?php echo '#'.$hcode_post_slider_id;?>").owlCarousel({ <?php echo $slider_config;?> }); }); </script>

    	<?php 
    	$script = ob_get_contents();
    	ob_end_clean();
    	$output .= $script;
    	/* Add custom script End*/

    	return $output;
    }
}
add_shortcode('hcode_blog_post_slider','hcode_blog_post_slider_shortcode');
?>