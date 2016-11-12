<?php
/**
 * Shortcode For Parallax
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Parallax */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_parallax_shortcode' ) ) {
    function hcode_parallax_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'hcode_parallax_style' => '',
            'hcode_button_link' => '',
            'hcode_seperater' => '',
            'hcode_animation_style' => '',
            'hcode_categories_list' => '',
            'hcode_post_per_page' => '10',
            'hcode_show_excerpt' => '',
            'hcode_excerpt_length' => '15',
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
            'orderby' => '',
            'order' => '',
        ), $atts ) );
        $output = $padding = $padding_style = $margin = $margin_style = $style_attr = $style = '';
        $id = ( $id ) ? ' id="'.$id.'"' : '';
        $class = ( $class ) ? ' '.$class : '';
        $orderby = ( $orderby ) ? $orderby : '';
        $order = ( $order ) ? $order : '';
        // For Button
        $first_button_parse_args = vc_parse_multi_attribute($hcode_button_link);
        $first_button_link     = ( isset($first_button_parse_args['url']) ) ? $first_button_parse_args['url'] : '#';
        $first_button_title    = ( isset($first_button_parse_args['title']) ) ? $first_button_parse_args['title'] : 'sample button';
        $hcode_animation_style = ( $hcode_animation_style ) ? ' wow '.$hcode_animation_style : '';

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
        if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
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
            'paged' => $paged,
        );
        $portfolio_posts = new WP_Query( $args );
        while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();
            $excerpt = get_the_content();
            $excerpt = do_shortcode($excerpt);
            $show_excerpt = ( $hcode_show_excerpt == 1 ) ? hcode_get_the_excerpt_theme($hcode_excerpt_length) : hcode_get_the_excerpt_theme(55);
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
            $url = $thumb['0'];
            if($url):
                $parallax = ' style="background-image: url('.$url.')"';
            endif;
            $portfolio_subtitle = hcode_post_meta('hcode_subtitle');
            $portfoliowithdesc_class = '';
            switch ($hcode_parallax_style) {
                case 'parallax':
                    $output .='<div '.$id.' class="parallax-portfolio" '.$class.$parallax.' >';
                        $output .='<a href="'.get_permalink().'" class="text-uppercase"><div class="opacity-light bg-slider"></div></a>';
                        $output .='<figure>';
                            $output .='<figcaption class="bg-black">';
                                if(get_the_title()):
                                    $output .='<h3>'.get_the_title().'</h3>';
                                endif;
                                $output .='<p>'.$portfolio_subtitle.'</p>';
                            $output .='</figcaption>';
                            if($first_button_title):
                                $output .='<div class="look-project wow fadeInUp"><a href="'.get_permalink().'" class="text-uppercase">+ '.$first_button_title.'</a></div>';
                            endif;
                        $output .='</figure>';
                    $output .='</div>';
                break;

                case 'portfolio-with-desc':
                    $portfoliowithdesc_class = ' no-padding-top';
                    $output .='<div '.$id.' class="portfolio-short-description col-md-12 col-sm-12 col-xs-12 '.$class.$padding.$margin.'" '.$style.'>';
                        $output .='<div class="portfolio-short-description-bg pull-left" '.$parallax.'>';
                            $output .='<figure class="pull-right '.$hcode_animation_style.'">';
                                $output .='<figcaption>';
                                if($hcode_seperater == '1'){
                                    $output .='<div class="separator-line bg-yellow no-margin-lr margin-ten no-margin-top"></div>';
                                }
                                    if(get_the_title()):
                                        $output .='<h3 class="white-text">'.get_the_title().'</h3>';
                                    endif;
                                    $output .= '<p class="light-gray-text margin-seven">'.$show_excerpt.'</p>';
                                    if($first_button_title):
                                        $output .='<a href="'.get_permalink().'" class="btn-small-white-background btn margin-ten no-margin-bottom">'.$first_button_title.'</a>';
                                    endif;
                                $output .='</figcaption>';
                            $output .='</figure>';
                        $output .='</div>';
                    $output .='</div>';
                break;
            }
        endwhile;
        wp_reset_postdata();
            
        // Pagination
        if($portfolio_posts->max_num_pages > 1):
            $output .='<section class="clear-both'.$portfoliowithdesc_class.'">';
                $output .='<div class="container">';
                    $output .='<div class="row">';
                        $output .='<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInUp">';
                            $output .='<div class="pagination margin-top-20px">';
                                $output .= paginate_links( array(
                                    'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
                                    'format'       => '',
                                    'add_args'     => '',
                                    'current'      => max( 1, get_query_var( 'paged' ) ),
                                    'total'        => $portfolio_posts->max_num_pages,
                                    'prev_text'    => '<img alt="Previous" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-small.png" width="20" height="13">',
                                    'next_text'    => '<img alt="Next" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-small.png" width="20" height="13">',
                                    'type'         => 'plain',
                                    'end_size'     => 2,
                                    'mid_size'     => 2
                                ) );
                            $output .='</div>';
                        $output .='</div>';
                    $output .='</div>';
                $output .='</div>';
            $output .='</section>';
        endif;
    return $output;
    }
}
add_shortcode( 'hcode_parallax', 'hcode_parallax_shortcode' );
?>