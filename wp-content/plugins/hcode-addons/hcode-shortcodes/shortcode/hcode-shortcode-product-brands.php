<?php
/**
 * Shortcode For Product Brand Block
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Product Brand Block */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_product_brands_shortcode' ) ) {
    function hcode_product_brands_shortcode( $atts, $content = null ) {
        if(!class_exists( 'WooCommerce' )){
            return false;
        }
        extract(shortcode_atts( array(
            'class' =>'',
            'id' => '',
            'product_brand_type' => '',
            'show_brand_title' => '',
            'columns'   => '4',
            'order'     => 'desc',
            'show_pagination' => '',
            'show_pagination_style' => '',
            'show_navigation' => '',
            'show_navigation_style' => '',
            'show_pagination_color_style' => '',            
            'desktop_per_page' => '4',
            'ipad_per_page' => '4',
            'mobile_per_page' => '1',
            'hcode_image_carousel_autoplay' => '',
            'stoponhover' => '',
            'slidespeed' => '3000',

        ), $atts ) );

        $id = ( $id ) ? ' id= "'.$id.'"': '';
        $class = ( $class ) ? ' '.$class : '';
        $product_brand_type = $product_brand_type ? $product_brand_type : '';
        $show_brand_title = ( $show_brand_title ) ? $show_brand_title : '';
        $columns = ( $columns ) ? $columns : '';
        $desktop_per_page = ( $desktop_per_page ) ? $desktop_per_page : '';
        $ipad_per_page = ( $ipad_per_page ) ? $ipad_per_page : '';
        $mobile_per_page = ( $mobile_per_page ) ? $mobile_per_page : '';
        $output = $set_column = '';
        switch ($columns) {
            case '6':
                $set_column = '2';
                break;
            case '4':
                $set_column = '3';
                break;
            case '3':
                $set_column = '4';
                break;
            case '2':
                $set_column = '6';
                break;
            case '1':
                $set_column = '12';
                break;
            default:
                $set_column = '12';
                break;
        }
        $col_class = ' class="text-center col-md-'.$set_column.' col-sm-'.$set_column.'"';
        $product_brand = get_terms( 'product_brand', 'orderby=name' );

        if ( ! empty( $product_brand ) ) {
            if($product_brand_type == 'slider'):
                $pagination = ( $show_pagination == 1 ) ? hcode_owl_pagination_slider_classes($show_pagination_style) : '';
                $pagination_style = ( $show_pagination == 1 ) ? hcode_owl_pagination_color_classes($show_pagination_color_style) : '';
                $navigation = ( $show_navigation == 1 ) ? hcode_owl_navigation_slider_classes($show_navigation_style) : '' ;
                $output .= '<div class="owl-carousel owl-prev-next-simple owl-demo-brand owl-theme'.$class.$pagination.$navigation.$pagination_style.'" '.$id.'>';
                    foreach( (array) $product_brand as $brand ) { 
                        // get the thumbnail id user the term_id
                        $logo_id = get_woocommerce_term_meta( $brand->term_id, 'logo_id', true ); 

                        /* Image Alt, Title, Caption */
                        $img_alt = hcode_option_image_alt($logo_id);
                        $img_title = hcode_option_image_title($logo_id);
                        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
                        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

                        $product_brand_image = wp_get_attachment_image_src($logo_id, 'full');
                        $brand_image = ( $product_brand_image[0] ) ? '<img class="parallax-background-img" src="'.$product_brand_image[0].'" width="'.$product_brand_image[1].'" height="'.$product_brand_image[2].'" '.$image_alt.$image_title.' />' : '';

                        $output .= '<div class="item">';
                            $output .= '<div class="home-product text-center position-relative overflow-hidden">';
                            $output .= '<a href="'.get_term_link( $brand ).'">'.$brand_image.'</a>';
                            if($show_brand_title == 1){
                                $output .= '<span class="text-uppercase"><a href="'.get_term_link( $brand ).'">'.esc_html( $brand->name ).'</a></span>';
                            }
                            $output .= '</div>';
                        $output .= '</div>';
                    }
                $output .= '</div>';
            else:
                $output .= '<div class="product-brands-grid'.$class.'"'.$id.'>';
                foreach( (array) $product_brand as $brand ) {
                    // get the thumbnail id user the term_id
                        $logo_id = get_woocommerce_term_meta( $brand->term_id, 'logo_id', true ); 
                        // get the image URL
                        //$product_brand_image = wp_get_attachment_url( $logo_id ); 

                        /* Image Alt, Title, Caption */
                        $img_alt = hcode_option_image_alt($logo_id);
                        $img_title = hcode_option_image_title($logo_id);
                        $image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? 'alt="'.$img_alt['alt'].'"' : 'alt=""' ; 
                        $image_title = ( isset($img_title['title']) && !empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                        
                        $product_brand_image = wp_get_attachment_image_src($logo_id, 'full');
                        $brand_image = ( $product_brand_image[0] ) ? '<img class="parallax-background-img" src="'.$product_brand_image[0].'" width="'.$product_brand_image[1].'" height="'.$product_brand_image[2].'" '.$image_alt.$image_title.' />' : '';
                    $output .= '<div '.$col_class.'>';
                    $output .= '<a href="'.get_term_link( $brand ).'">'.$brand_image.'</a>';
                        if($show_brand_title == 1){
                            $output .= '<span class="text-uppercase"><a href="'.get_term_link( $brand ).'">'.esc_html( $brand->name ).'</a></span>';
                        }
                    $output .= '</div>';
                }
                $output .= '</div>';
            endif;
        }
        if($product_brand_type == 'slider'):
        $slider_config = '';
        $slidespeed = ( $slidespeed ) ? $slidespeed : '3000'; 
        ( $show_pagination == 1 ) ? $slider_config .= 'pagination: true,' : $slider_config .= 'pagination: false,';
        ( $hcode_image_carousel_autoplay == 1 ) ? $slider_config .= 'autoPlay: '.$slidespeed.',' : $slider_config .= 'autoPlay: false,';
        ( $stoponhover == 1) ? $slider_config .= 'stopOnHover: true, ' : $slider_config .= 'stopOnHover: false, ';
        ( $desktop_per_page ) ? $slider_config .= 'items: '.$desktop_per_page.',' : $slider_config .= 'items: 3,';
        ( $desktop_per_page ) ? $slider_config .= 'itemsDesktop: [1200,'.$desktop_per_page.'],' : $slider_config .= 'itemsDesktop: [1200, 3],';
        ( $ipad_per_page ) ? $slider_config .= 'itemsTablet: [800,'.$ipad_per_page.'],' : $slider_config .= 'itemsTablet: [800, 2],';
        ( $mobile_per_page ) ? $slider_config .= 'itemsMobile: [700,'.$mobile_per_page.'],' : $slider_config .= 'itemsMobile: [700, 1],';
        $slider_config .= 'navigationText: ["<i class=\'fa fa-angle-left\'></i>", "<i class=\'fa fa-angle-right\'></i>"]';
        ob_start();?>
        <script type="text/javascript">jQuery(document).ready(function(){ jQuery(".owl-demo-brand").owlCarousel({ navigation: true, <?php echo $slider_config; ?> }); }); </script>
        <?php
        $script = ob_get_contents();
        $output .= $script;
        endif;
        return $output;
    }
}
add_shortcode( 'hcode_product_brands', 'hcode_product_brands_shortcode' );
?>