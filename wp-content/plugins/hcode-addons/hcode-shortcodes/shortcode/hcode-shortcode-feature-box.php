<?php
/**
 * Shortcode For Feature Box
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Feature Box */
/*-----------------------------------------------------------------------------------*/
$breadcrumb_text = NULL;
if ( ! function_exists( 'hcode_feature_box_shortcode' ) ) {
    function hcode_feature_box_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'hcode_feature_type' => '',
            'hcode_et_line_icon_list' =>'',
            'hcode_process_no' => '',
            'hcode_feature_title' => '',
            'hcode_feature_subtitle' => '',
            'hcode_feature_no_of_posts' => '',
            'hcode_feature_price' => '',
            'hcode_feature_per_month_text' => '/mo',
            'hcode_feature_currency' => '',
            'hcode_feature_button_link' => '',
            'hcode_feature_image' => '',
            'hcode_active_feature' => '',
            'hcode_posts_list' => '',
            'hcode_number' => '',
            'counter_icon_size' => '',
            'hcode_title_color' => '',
            'hcode_subtitle_color' => '',
            'hcode_icon_color' => '',
            'hcode_feature_icon' => '',
            'hcode_feature_star' => '',
            'hcode_stars' => '',
            'hcode_star_color' => '',
            'hcode_number_color' => '',
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
            'hcode_enable_seperator' =>'',
            'hcode_excerpt_length' => '15',
        ), $atts ) );
        $output = $btn_class = $padding = $padding_style = $margin = $margin_style = $style_attr = $style = '';

        $id = ( $id ) ? ' id="'.$id.'"' : '';
        $class = ( $class ) ? ' '.$class : '';
        $icon_size = ( $counter_icon_size ) ? ' '.$counter_icon_size : ' medium-icon';
        $hcode_title_color = ( $hcode_title_color ) ? 'color:'.$hcode_title_color.';' : '';
        $hcode_subtitle_color = ( $hcode_subtitle_color ) ? 'style="color:'.$hcode_subtitle_color.';"' : '';
        $hcode_icon_color = ( $hcode_icon_color ) ? 'style="color:'.$hcode_icon_color.';"' : '';
        $hcode_star_color = ( $hcode_star_color ) ? 'style="color:'.$hcode_star_color.';"' : '';
        $hcode_number_color = ( $hcode_number_color ) ? 'style="color:'.$hcode_number_color.';"' : '';
        $hcode_et_line_icon_list = ( $hcode_et_line_icon_list ) ? $hcode_et_line_icon_list : '';
        $hcode_process_no = ( $hcode_process_no ) ? $hcode_process_no : '';
        $hcode_feature_title = ( $hcode_feature_title ) ? $hcode_feature_title : '';
        $hcode_feature_subtitle = ( $hcode_feature_subtitle ) ? $hcode_feature_subtitle : '';

        $hcode_feature_no_of_posts = ( $hcode_feature_no_of_posts ) ? $hcode_feature_no_of_posts : '';
        $hcode_feature_price = ( $hcode_feature_price ) ? $hcode_feature_price : '';
        $hcode_feature_currency = ( $hcode_feature_currency ) ? $hcode_feature_currency : '';
        $hcode_feature_per_month_text = ( $hcode_feature_per_month_text ) ? $hcode_feature_per_month_text : '';
        $hcode_feature_button_link = ( $hcode_feature_button_link ) ? $hcode_feature_button_link : '';
        $first_button_parse_args = vc_parse_multi_attribute($hcode_feature_button_link);
        $first_button_link     = ( isset($first_button_parse_args['url']) ) ? $first_button_parse_args['url'] : '#';
        $first_button_title    = ( isset($first_button_parse_args['title']) ) ? $first_button_parse_args['title'] : '';
        $hcode_excerpt_length = ($hcode_excerpt_length) ? $hcode_excerpt_length : '15';

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
        
        if($style_attr || $hcode_title_color){
            $style .= ' style="'.$style_attr.$hcode_title_color.'"';
        }

        /* Image Alt, Title, Caption */
        $img_alt = hcode_option_image_alt($hcode_feature_image);
        $img_title = hcode_option_image_title($hcode_feature_image);
        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? 'title="'.$img_title['title'].'"' : '';
        $hcode_options = get_option( 'hcode_theme_setting' );
        $hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';

        switch ($hcode_feature_type) {
            case 'featurebox1':
            		$output .='<div '.$id.' class="work-process-sub position-relative overflow-hidden'.$class.'" >';
    	    			$output .='<div class="work-process-text">';
                            if($hcode_process_no):
    	                       $output .='<span class="work-process-number font-weight-100 display-block yellow-text2">'.$hcode_process_no.'</span>';
                            endif;
                            if($hcode_feature_title):
    	                       $output .='<span class="text-uppercase letter-spacing-2 font-weight-600 '.$margin.$padding.'" '.$style.'>'.$hcode_feature_title.'</span>';
                            endif;
                            if($hcode_enable_seperator == 1):
    	                       $output .='<div class="separator-line-thick bg-mid-gray margin-three"></div>';
                            endif;
    	                $output .='</div>';
    	                $output .='<div class="work-process-details position-absolute display-block">';
                            if($hcode_et_line_icon_list):
    	                       $output .='<i class="'.$hcode_et_line_icon_list.$icon_size.' display-block" '.$hcode_icon_color.'></i>';
                            endif;
                            if($content):
    	                       $output .='<span class="text-small text-uppercase">'.do_shortcode( $content ).'</span>';
                            endif;
    	                $output .='</div>';
                    $output .='</div>';
            break;
            case 'featurebox2':
            		$output .= '<div '.$id.' class="features-box-style1'.$class.'">';
                        if($hcode_et_line_icon_list):
    	            	  $output .= '<i class="'.$hcode_et_line_icon_list.$icon_size.'" '.$hcode_icon_color.'></i>';
                        endif;
                        if($hcode_feature_title):
    	                   $output .= '<h5 class="'.$margin.$padding.'" '.$style.'>'.$hcode_feature_title.'</h5>';
                        endif;
                        if($content):
    	                   $output .= '<div class="no-margin">'.do_shortcode( hcode_remove_wpautop( $content ) ).'</div>';
                        endif;
                    $output .='</div>';
            break;
            case 'featurebox3':
            		$output .='<div '.$id.' class="features-box-style2'.$class.'">';
                        if($hcode_et_line_icon_list):
    	            	  $output .='<i class="'.$hcode_et_line_icon_list.$icon_size.' margin-ten no-margin-top" '.$hcode_icon_color.'></i>';
                        endif;
                        if($hcode_feature_title):
    	                   $output .='<h5 class="'.$margin.$padding.'" '.$style.'>'.$hcode_feature_title.'</h5>';
                        endif;
                        if($hcode_enable_seperator == 1):
    	                   $output .='<div class="separator-line bg-yellow no-margin-lr margin-ten"></div>';
                        endif;
                        if($content):
    	                   $output .= '<div class="no-margin">'.do_shortcode( hcode_remove_wpautop( $content ) ).'</div>';
                        endif;
                   	$output .='</div>';
            break;
            case 'featurebox4':
                    $args = array('post_type' => 'post',
                        'name'=> $hcode_posts_list,
                    );
                    $query = new WP_Query( $args );
                    while ( $query->have_posts() ) : $query->the_post();

                        /* Image Alt, Title, Caption */
                        $img_alt_post = hcode_option_image_alt(get_post_thumbnail_id());
                        $img_title_post = hcode_option_image_title(get_post_thumbnail_id());
                        $image_alt_post = ( isset($img_alt_post['alt']) && !empty($img_alt_post['alt']) ) ? $img_alt_post['alt'] : '' ; 
                        $image_title_post = ( isset($img_title_post['title']) && !empty($img_title_post['title']) ) ? $img_title_post['title'] : '';

                        $img_attr_post = array(
                                        'title' => $image_title_post,
                                        'alt' => $image_alt_post,
                                    );
                        $post_author = get_post_field( 'post_author', get_the_ID() );
                        $author = '<a class="light-gray-text2" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'.get_the_author_meta( 'user_nicename', $post_author).'</a>';
                        $blog_quote = hcode_post_meta('hcode_quote');
                        $blog_image = hcode_post_meta('hcode_image');
                        $blog_gallery = hcode_post_meta('hcode_gallery');
                        $blog_video = hcode_post_meta('hcode_video_type');

                        $output .='<div class="blog-slider-right  wow fadeInUp" data-wow-duration="600ms">';
                            $output .='<div class="blog-slider-grid">';
                                $output .='<figure>';
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
                                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($hcode_posts_list), 'full' );
                                            $url = $thumb['0'];
                                            $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                                            if ( has_post_thumbnail() ) {
                                                $output .= get_the_post_thumbnail(get_the_ID(), 'full',$img_attr_post);
                                            }
                                            else {
                                                    $output .= '<img src="'.$hcode_no_image['url'].'" width="900" height="600" alt="" />';
                                            }
                                            $output .='</a></div>';
                                    }
                                    $output .='</div>';
                                    $output .='<figcaption>';
                                        if(get_the_title()):
                                            $output .='<h3><a class="white-text-link" href="'.get_permalink().'" '.$style.'>'.get_the_title().'</a></h3>';
                                        endif;
                                        if($author):
                                            $output .='<span class="light-gray-text2">'.esc_html__('Posted by ','hcode-addons').$author.'</span>';
                                        endif;
                                    $output .='</figcaption>';
                                $output .='</figure>';
                            $output .='</div>';
                        $output .='</div>';

                    endwhile;
                    wp_reset_postdata();
            break;
            case 'featurebox5':
                    $args = array('post_type' => 'post',
                        'name' => $hcode_posts_list,
                    );
                    $query = new WP_Query( $args );
                    while ( $query->have_posts() ) : $query->the_post();

                        /* Image Alt, Title, Caption */
                        $img_alt_post = hcode_option_image_alt(get_post_thumbnail_id());
                        $img_title_post = hcode_option_image_title(get_post_thumbnail_id());
                        $image_alt_post = ( isset($img_alt_post['alt']) && !empty($img_alt_post['alt']) ) ? $img_alt_post['alt'] : '' ; 
                        $image_title_post = ( isset($img_title_post['title']) && !empty($img_title_post['title']) ) ? $img_title_post['title'] : '';

                        $img_attr_post = array(
                                        'title' => $image_title_post,
                                        'alt' => $image_alt_post,
                                    );

                        $post_author = get_post_field( 'post_author', get_the_ID() );
                        $author = '<a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" class="light-gray-text2">'.get_the_author_meta( 'user_nicename', $post_author).'</a>';
                        $blog_quote = hcode_post_meta('hcode_quote');
                        $blog_image = hcode_post_meta('hcode_image');
                        $blog_gallery = hcode_post_meta('hcode_gallery');
                        $blog_video = hcode_post_meta('hcode_video_type');
                        $show_excerpt = ( $hcode_excerpt_length ) ? hcode_get_the_excerpt_theme($hcode_excerpt_length) : hcode_get_the_excerpt_theme(55);
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
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($hcode_posts_list), 'full' );
                                $url = $thumb['0'];
                                $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                                if ( has_post_thumbnail() ) {
                                    $output .= get_the_post_thumbnail( get_the_ID(), 'full',$img_attr_post );
                                }
                                else {
                                        $output .= '<img src="'.$hcode_no_image['url'].'" width="900" height="600" alt="" />';
                                }
                                $output .='</a></div>';
                        }
                        $output .='<div class="post-details">';
                            if(get_the_title()):
                                $output .='<a href="'.get_permalink().'" class="post-title sm-margin-top-ten xs-no-margin-top" '.$style.'>'.get_the_title().'</a>';
                            endif;
                            $output .='<span class="post-author light-gray-text2">'.esc_html__('Posted by ','hcode-addons').$author.' | '.get_the_date('d F Y', get_the_ID()).'</span>';
                            if($show_excerpt):
                                $output .= '<p>'.$show_excerpt.'</p>';
                            endif;
                            if( $hcode_enable_seperator == 1 ):
                                $output .= '<div class="separator-line bg-black no-margin-lr no-margin-bottom xs-no-margin-top"></div>';
                            endif;
                        $output .='</div>';
                    $output .='</div>';
                    endwhile;
                    wp_reset_postdata();
            break;
            case 'featurebox6':
                $h3_class = $pricing_price = '';
                        if($hcode_active_feature == 1){
                            $output .='<div class="pricing-box best-price xs-margin-0auto light-gray-text2 bg-black">';
                            $btn_class .='btn-small-white-background';
                            $h3_class = 'white-text ';
                        }else{
                            $output .='<div class="pricing-box  bg-white">';
                            $btn_class .='highlight-button';
                            $h3_class = 'black-text ';
                            $pricing_price = ' black-text';
                        }
                        if( $hcode_feature_title || $hcode_feature_subtitle ):
                            $output .='<div class="pricing-title">';
                                if( $hcode_feature_title ):
                                    $output .='<h3 class="'.$h3_class.$margin.$padding.'" '.$style.'>'.$hcode_feature_title.'</h3>';
                                endif;
                                if( $hcode_feature_subtitle || $hcode_subtitle_color ):
                                    $output .='<span class="light-gray-text2" '.$hcode_subtitle_color.'>'.$hcode_feature_subtitle.'</span>';
                                endif;
                            $output .='</div>';
                        endif;
                        if( $hcode_feature_price ):
                            $output .='<div class="pricing-price'.$pricing_price.'">';
                                $output .='<span class="price-unit">'.$hcode_feature_currency.'</span>'.$hcode_feature_price.'<span class="price-tenure">'.$hcode_feature_per_month_text.'</span>';
                            $output .='</div>';
                        endif;
                        if( $content ):
                            $output .='<div class="pricing-features">';
                            $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                            $output .='</div>';
                        endif;
                        if( $first_button_title ):
                            $output .='<div class="pricing-action">';
                                $output .='<a href="'.$first_button_link.'" class="'.$btn_class.' btn btn-small button no-margin ">'.$first_button_title.'</a>';
                            $output .='</div>';
                        endif;
                    $output .='</div>'; 
            break;
            case 'featurebox7':
            		$output .='<div '.$id.' class="col-md-12 no-padding'.$class.'">';
                        if($hcode_et_line_icon_list):
                            $output .='<div class="col-md-3 col-sm-2 col-xs-2 no-padding">';
                            	$output .='<i class="'.$hcode_et_line_icon_list.$icon_size.'" '.$hcode_icon_color.'></i>';
                            $output .='</div>';
                        endif;
                        $output .='<div class="col-md-9 col-sm-9 col-xs-9 no-padding text-left f-right">';
                            if($hcode_feature_title):
                                $output .='<h5 class="'.$margin.$padding.'" '.$style.'>'.$hcode_feature_title.'</h5>';
                            endif;
                            if($hcode_enable_seperator == 1):
                                $output .='<div class="separator-line bg-yellow no-margin-lr"></div>';
                            endif;
                            $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                        $output .='</div>';
                    $output .='</div>';
            break;
            case 'featurebox8':
                    $stars='';
                    $thumb = wp_get_attachment_image_src( $hcode_feature_image, 'full' );
            		//$image_url = wp_get_attachment_url( $hcode_feature_image );
            		$output .='<div '.$id.' class="testimonial-style2'.$class.'">';
            			if($thumb[0]){
    	        			$output .='<img src="'.$thumb[0].'" '.$image_alt.$image_title.' width="'.$thumb[1].'" height="'.$thumb[2].'"/>';
    	        		}
                        if($content):
    	                   $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                        endif;
                            if($hcode_feature_star == 1):
                                for($i=1; $i <= $hcode_stars; $i++){
                                        $stars.='<i class="fa fa-star" '.$hcode_star_color.'></i>';
                                }
                                if($stars):
                                    $output .= '<div class="margin-two">';
                                        $output .= $stars;
                                    $output .='</div>';
                                endif;
                            endif;
                        if($hcode_feature_title):
    	                   $output .='<span class="name light-gray-text2" '.$style.'>'.$hcode_feature_title.'</span>';
                        endif;
                        if($hcode_feature_icon):
                            $output .='<i class="fa fa-quote-left'.$icon_size.' display-block margin-five no-margin-bottom" '.$hcode_icon_color.'></i>';
                        endif;
                    $output .='</div>';
            break;
            case 'featurebox9':
                    if($hcode_et_line_icon_list):
                        $output .= '<i class="'.$hcode_et_line_icon_list.$icon_size.' display-block" '.$hcode_icon_color.'></i>';
                    endif;
                    if($hcode_number):
                        $output .= '<h1 class="font-weight-600 margin-five no-margin-bottom" '.$hcode_number_color.'>'.$hcode_number.'</h1>';
                    endif;
                    if($hcode_feature_title):
                        $output .= '<p class="text-uppercase letter-spacing-2 text-small margin-three"'.$style.'>'.$hcode_feature_title.'</p>';
                    endif;
            break;
            case 'featurebox10':
                $thumb = wp_get_attachment_image_src($hcode_feature_image, 'full');
                $output .= '<div class="col-md-5 col-sm-5 xs-margin-bottom-20px">';
                    if( $thumb[0] ):
                        $output .= '<img '.$image_alt.$image_title.' src="'.$thumb[0].'" width="'.$thumb[1].'" height="'.$thumb[2].'">';
                    endif;
                $output .= '</div>';
                $output .= '<div class="col-md-7 col-sm-7">';
                    if($hcode_feature_title):
                        $output .= '<h3 class="margin-bottom-15px font-weight-600 line-height-20"'.$style.'>'.$hcode_feature_title.'</h3>';
                    endif;
                    if($content):
                        $output .= do_shortcode( hcode_remove_wpautop( $content ) );
                    endif;
                $output .= '</div>';
            break;
        }
        return $output;        
    }
}
add_shortcode( 'hcode_feature_box', 'hcode_feature_box_shortcode' );
?>