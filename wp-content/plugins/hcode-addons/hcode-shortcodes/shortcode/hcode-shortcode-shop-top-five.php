<?php
/**
 * Shortcode For Shop Top Five
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Shop Top Five Block */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_shop_top_five_shortcode' ) ) {
    function hcode_shop_top_five_shortcode( $atts, $content = null ) {

    if(!class_exists( 'WooCommerce' )){
        return false;
    }
    extract( shortcode_atts( array(
                'id' => '',
                'class' => '',
            ), $atts ) );

    $id = ( $id ) ? 'id="'.$id.'"' : '';
    $class = ( $class ) ? $class : '';
    $query_args = array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page'      => 2,
        'meta_query' => array(
            'relation' => 'AND',
            'hcode_feature_product_order' => array(
                'key' => 'hcode_feature_product_order',
                'value' => '',
                'compare' => '!='
            ), 
            'hcode_feature_product_shop' => array(
                        'key'   => 'hcode_feature_product_shop',
                        'value' => 'yes',
                        'compare' => '!='
                        ),
        ),
        'orderby' => 'meta_value_num',
        'order'   => 'asc',
    );
    $products = new WP_Query( $query_args );

    $pr_count = count($products);
    ob_start();
    wc_print_notices();
    $count = 1;
    if ( $products->have_posts() ) : ?>
            <div <?php echo $id; ?> class="col-md-4 col-sm-4 col-xs-12 <?php echo $class;?>">
                <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    <?php 
                    global $product, $woocommerce_loop;
                    // Store loop count we're currently on
                    if ( empty( $woocommerce_loop['loop'] ) ) {
                        $woocommerce_loop['loop'] = 0;
                    }
                    // Store column count for displaying the grid
                    if ( empty( $woocommerce_loop['columns'] ) ) {
                        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 2 );
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
                        $classes[] = 'home-product text-center position-relative overflow-hidden margin-ten no-margin-top';
                        
                    }
                    if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
                        $classes[] = 'last';
                        $classes[] ='home-product text-center position-relative overflow-hidden margin-ten no-margin-bottom';
                    }
                    ?>
                    <div <?php post_class($classes);?>>
                        <div class="product-image-wrapper">
                            <a href="<?php the_permalink(); ?>">
                                <?php //do_action( 'woocommerce_before_shop_loop_item_title' );
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
                                    <?php wc_get_template( 'loop/title.php' ); ?>
                                </a>
                            </span>
                            <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
                            <div class="quick-buy">
                                <div class="product-share">
                                    <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                                </div>
                            </div>  
                        </div>        
                    </div>                
                <?php endwhile; // end of the loop. ?>    
        </div>
    <?php endif;

    woocommerce_reset_loop();
    wp_reset_postdata();

    // Get Special Feature product
    $meta_query   = WC()->query->get_meta_query();
    $meta_query[] = array(
        'key'   => 'hcode_feature_product_shop',
        'value' => 'yes'
    );

    $query_args = array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page'      => 1,
        'orderby'             => 'meta_value_num',
        'meta_query' => array(
            'relation' => 'AND',
            'hcode_feature_product_shop' => array(
                'key' => 'hcode_feature_product_shop',
                'value' => 'yes',
                'compare' => '=='
            ), 
        )
    );

    $special_products = new WP_Query( $query_args );
    if ( $special_products->have_posts() ) : ?>
        <?php while ( $special_products->have_posts() ) : $special_products->the_post(); ?>
        <?php global $post, $product, $woocommerce; ?>
                
            <?php 
                $attachment_ids = $product->get_gallery_attachment_ids();

                if ( has_post_thumbnail() ) {
                    $attachment_ids = array_merge (array(get_post_thumbnail_id()), $attachment_ids);
                }

                if ( $attachment_ids ) {
                    $loop       = 0;
                    $columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
                    echo '<div class="col-md-4 col-sm-4 col-xs-12 exclusive-style no-padding xs-margin-top-ten">';
                    echo '<!-- shop item slider -->
                        <div id="owl-demo-small" class="owl-carousel owl-theme owl-half-slider dark-pagination dark-pagination-without-next-prev-arrow">';
                        foreach ( $attachment_ids as $attachment_id ) {

                            $classes = array( 'zoom' );

                            if ( $loop == 0 || $loop % $columns == 0 )
                                $classes[] = 'first';

                            if ( ( $loop + 1 ) % $columns == 0 )
                                $classes[] = 'last';

                            $image_link = wp_get_attachment_url( $attachment_id );

                            if ( ! $image_link )
                                continue;

                            /* Image Alt, Title, Caption */
                            $img_alt = hcode_option_image_alt(get_post_thumbnail_id());
                            $img_title = hcode_option_image_title(get_post_thumbnail_id());
                            $image_alt = ( isset($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
                            $image_title = ( isset($img_title['title']) ) ? $img_title['title'] : '';

                            $img_attr = array(
                                'title' => $image_title,
                                'alt' => $image_alt,
                            );

                            $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'full' ), false , $img_attr );
                            $image_class = esc_attr( implode( ' ', $classes ) );
                            $image_title = esc_attr( get_the_title( $attachment_id ) );

                                echo '<div class="item text-center">';
                                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', get_permalink(), $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );
                                echo '</div>';
                                
                            $loop++;
                        }

                        echo '</div>';

                        echo '<div class="exclusive-style-text text-center">';
                        do_action ( 'hcode_sale_flash' );
                            echo '<p class="text-med font-weight-600 black-text text-uppercase letter-spacing-2">';
                                echo '<a href="'.get_the_permalink().'">';
                                    wc_get_template( 'loop/title.php' );
                                echo '</a>';
                            echo '</p>';
                            do_action( 'woocommerce_after_shop_loop_item_title' );
                            wc_get_template( 'single-product/short-description.php' );
                            do_action( 'woocommerce_after_shop_loop_item' );
                          echo '</div>';
                        echo '</div>';

                }
        endwhile; // end of the loop.
    endif;
    woocommerce_reset_loop();
    wp_reset_postdata();


    // for 3 & 4 product
    $query_args2 = array(
        'post_type'           => 'product',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page'      => 4,
        'meta_query' => array(
            'relation' => 'AND',
            'hcode_feature_product_order' => array(
                'key' => 'hcode_feature_product_order',
                'value' => '',
                'compare' => '!='
            ), 
            'hcode_feature_product_shop' => array(
                        'key'   => 'hcode_feature_product_shop',
                        'value' => 'yes',
                        'compare' => '!='
                        ),
        ),
        'orderby' => 'meta_value_num',
        'order'   => 'asc',
    );

    $second_products = new WP_Query( $query_args2 );
    $count = 1;

    if ( $second_products->have_posts() ) : ?>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <?php while ( $second_products->have_posts() ) : $second_products->the_post(); ?>

                <?php 
                if($count > 2){
                    
                global $product, $woocommerce_loop;

                // Store loop count we're currently on
                if ( empty( $woocommerce_loop['loop'] ) ) {
                    $woocommerce_loop['loop'] = 0;
                }

                // Store column count for displaying the grid
                if ( empty( $woocommerce_loop['columns'] ) ) {
                    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 2 );
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
                    $classes[] = 'home-product text-center position-relative overflow-hidden margin-ten no-margin-top';
                    
                }
                if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
                    $classes[] = 'last';
                    $classes[] ='home-product text-center position-relative overflow-hidden margin-ten no-margin-bottom';
                }
                ?>
                <div <?php post_class($classes);?>>
                    <div class="product-image-wrapper">
                        <a href="<?php the_permalink(); ?>">
                            <?php //do_action( 'woocommerce_before_shop_loop_item_title' );
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
                                <?php wc_get_template( 'loop/title.php' ); ?>
                            </a>
                        </span>

                        <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>

                        <div class="quick-buy">
                            <div class="product-share">
                                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
            }
            $count++; 
            endwhile; // end of the loop. ?>    
        </div>
    <?php endif;

    woocommerce_reset_loop();
    wp_reset_postdata();
    return ob_get_clean();
    }
}
add_shortcode( 'hcode_shop_top_five', 'hcode_shop_top_five_shortcode' );
?>