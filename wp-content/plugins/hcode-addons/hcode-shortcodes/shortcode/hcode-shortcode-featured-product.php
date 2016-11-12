<?php
/**
 * Shortcode For Feature Product
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Featured Product Block */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_featured_products_shortcode' ) ) {
    function hcode_featured_products_shortcode( $atts, $content = null ) {
        if(!class_exists( 'WooCommerce' )){
            return false;
        }
        $atts = shortcode_atts( array(
                'class' =>'',
                'id' => '',
                'recent_product_type' => '',
                'per_page'  => '6',
                'columns'   => '3',
                'orderby'   => 'date',
                'order'     => 'desc',
                'show_pagination' => '',
                'show_pagination_style' => '',
                'show_navigation' => '',
                'show_navigation_style' => '',
                'show_pagination_color_style' => '',
                'show_cursor_color_style' => '',
                'desktop_per_page' => '3',
                'ipad_per_page' => '3',
                'mobile_per_page' => '1',
                'hcode_image_carousel_autoplay' => '',
                'stoponhover' => '',
                'slidespeed' => '3000',

        ), $atts );
        $meta_query   = WC()->query->get_meta_query();
        $meta_query[] = array(
            'key'   => '_featured',
            'value' => 'yes'
        );

        $query_args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $atts['per_page'],
            'orderby'             => $atts['orderby'],
            'order'               => $atts['order'],
            'meta_query'          => $meta_query
        );
        global $woocommerce_loop;

        $products                    = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts ) );
        $columns                     = absint( $atts['columns'] );
        $woocommerce_loop['columns'] = $columns;
        $loop_name                   = 'recent_products';
        $id = ( $atts['id'] ) ? ' id= "'.$atts['id'].'"': '';
        $class = ( $atts['class'] ) ? $atts['class']: '';
        
        ob_start();


        if ( $products->have_posts() ) : ?>

            <?php do_action( "woocommerce_shortcode_before_{$loop_name}_loop" ); ?>

                <?php if($atts['recent_product_type'] == 'slider'):
                $pagination = ( $atts['show_pagination'] == 1 ) ? hcode_owl_pagination_slider_classes($atts['show_pagination_style']) : '';
                $pagination_style = ( $atts['show_pagination'] == 1 ) ? hcode_owl_pagination_color_classes($atts['show_pagination_color_style']) : '';
                $navigation = ( $atts['show_navigation'] == 1 ) ? hcode_owl_navigation_slider_classes($atts['show_navigation_style']) : '' ;
                $show_cursor_color_style = ( $atts['show_cursor_color_style'] ) ? ' '.$atts['show_cursor_color_style'] : ' black-cursor';
                ?>
                <div class="owl-carousel owl-prev-next-simple <?php echo $class.$show_cursor_color_style.$pagination.$navigation.$pagination_style ?> hcode-featured-<?php echo $atts['recent_product_type']?> owl-theme" <?php echo $id;?>>
                <?php endif;?>
                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                        <?php

                        if ( ! defined( 'ABSPATH' ) ) {
                            exit; // Exit if accessed directly
                        }

                        global $product, $woocommerce_loop;

                        // Store loop count we're currently on
                        if ( empty( $woocommerce_loop['loop'] ) ) {
                            $woocommerce_loop['loop'] = 0;
                        }

                        // Store column count for displaying the grid
                        if ( empty( $woocommerce_loop['columns'] ) ) {
                            $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
                        }

                        // Ensure visibility
                        if ( ! $product || ! $product->is_visible() ) {
                            return;
                        }
                        
                        // Increase loop count
                        $woocommerce_loop['loop']++;

                        // Extra post classes
                        $classes = array();
                        if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
                            $classes[] = 'first';
                        }
                        if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
                            $classes[] = 'last';
                        }

                        if($atts['recent_product_type'] == 'slider'){
                            $classes[] = 'item';
                        }else{
                            // For Column
                            switch ($woocommerce_loop['columns']) {
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
                                    # code...
                                    break;
                            }
                            $classes[] = 'col-md-'.$set_column.' col-sm-'.$set_column;
                        }
                        ?>
                        <div <?php post_class( $classes ); ?>>
                            <div class="home-product text-center position-relative overflow-hidden margin-ten no-margin-top">
                                <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

                                <div class="product-image-wrapper">
                                    <a href="<?php the_permalink(); ?>">

                                        <?php
                                            /**
                                             * woocommerce_before_shop_loop_item_title hook
                                             *
                                             * @hooked woocommerce_template_loop_product_thumbnail - 10
                                             */
                                            //do_action( 'woocommerce_before_shop_loop_item_title' );

                                            /* Image Alt, Title, Caption */
                                            $img_alt = hcode_option_image_alt(get_post_thumbnail_id());
                                            $img_title = hcode_option_image_title(get_post_thumbnail_id());
                                            $image_alt = ( isset($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
                                            $image_title = ( isset($img_title['title']) ) ? $img_title['title'] : '';

                                            $img_attr = array(
                                                'title' => $image_title,
                                                'alt' => $image_alt,
                                            );
                                            if ( has_post_thumbnail() ) {
                                                the_post_thumbnail( 'shop_catalog', $img_attr);
                                            }elseif ( wc_placeholder_img_src() ) {
                                                echo wc_placeholder_img( 'shop_catalog' );
                                            }
                                        ?>
                                    </a>
                                    <?php do_action ( 'hcode_sale_flash' ); ?>
                                </div>
                                <div class="product-content-wrapper">
                                    <span class="product-name text-uppercase">
                                        <a href="<?php the_permalink(); ?>">    
                                            <?php
                                                /**
                                                 * woocommerce_shop_loop_item_title hook
                                                 *
                                                 * @hooked woocommerce_template_loop_product_title - 10
                                                 */
                                                wc_get_template( 'loop/title.php' );
                                            ?>
                                        </a>
                                    </span>
                                    <?php
                                        /**
                                         * woocommerce_after_shop_loop_item_title hook
                                         *
                                         * @hooked woocommerce_template_loop_rating - 5
                                         * @hooked woocommerce_template_loop_price - 10
                                         */
                                        do_action( 'woocommerce_after_shop_loop_item_title' );
                                    ?>
                                    <div class="quick-buy">
                                        <div class="product-share">
                                            <?php

                                                /**
                                                 * woocommerce_after_shop_loop_item hook
                                                 *
                                                 * @hooked woocommerce_template_loop_add_to_cart - 10
                                                 */
                                                do_action( 'woocommerce_after_shop_loop_item' );
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php endwhile; // end of the loop. ?>
                <?php if($atts['recent_product_type'] == 'slider'):?>
                    </div>
                <?php endif;?>

            <?php do_action( "woocommerce_shortcode_after_{$loop_name}_loop" ); ?>

        <?php endif;

        woocommerce_reset_loop();
        wp_reset_postdata();
    if($atts['recent_product_type'] == 'slider'):
        $slider_config = '';
        $slidespeed = ( $atts['slidespeed'] ) ? $atts['slidespeed'] : '3000'; 
        ( $atts['show_pagination'] == 1 ) ? $slider_config .= 'pagination: true,' : $slider_config .= 'pagination: false,';
        ( $atts['hcode_image_carousel_autoplay'] == 1 ) ? $slider_config .= 'autoPlay: '.$slidespeed.',' : $slider_config .= 'autoPlay: false,';
        ( $atts['stoponhover'] == 1) ? $slider_config .= 'stopOnHover: true, ' : $slider_config .= 'stopOnHover: false, ';
        ( $atts['desktop_per_page'] ) ? $slider_config .= 'items: '.$atts['desktop_per_page'].',' : $slider_config .= 'items: 3,';
        ( $atts['desktop_per_page'] ) ? $slider_config .= 'itemsDesktop: [1200,'.$atts['desktop_per_page'].'],' : $slider_config .= 'itemsDesktop: [1200, 3],';
        ( $atts['ipad_per_page'] ) ? $slider_config .= 'itemsTablet: [800,'.$atts['ipad_per_page'].'],' : $slider_config .= 'itemsTablet: [800, 2],';
        ( $atts['mobile_per_page'] ) ? $slider_config .= 'itemsMobile: [700,'.$atts['mobile_per_page'].'],' : $slider_config .= 'itemsMobile: [700, 1],';
        $slider_config .= 'navigationText: ["<i class=\'fa fa-angle-left\'></i>", "<i class=\'fa fa-angle-right\'></i>"]';
    ?>
    <script type="text/javascript">jQuery(document).ready(function(){ jQuery(".hcode-featured-slider").owlCarousel({ navigation: true, <?php echo $slider_config; ?> }); }); </script>
    <?php
    endif;
    return ob_get_clean();
    }
}
add_shortcode( 'hcode_featured_products', 'hcode_featured_products_shortcode' );
?>