<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

if ( ! $related = $product->get_related( $posts_per_page ) ) {
    return;
}

/* Check related product config from admin options */
$related_product_grid_per_row = ( hcode_option('related_product_grid_per_row') ) ? hcode_option('related_product_grid_per_row') : 3;
$related_product_desktop_per_page = ( hcode_option('related_product_desktop_per_page') ) ? hcode_option('related_product_desktop_per_page') : 3;
$related_product_ipad_per_page = ( hcode_option('related_product_ipad_per_page') ) ? hcode_option('related_product_ipad_per_page') : 3;
$related_product_mobile_per_page = ( hcode_option('related_product_mobile_per_page') ) ? hcode_option('related_product_mobile_per_page') : 1;

$related_product_type = hcode_option( 'hcode_layout_woocommerce_settings' );
$related_product_classes = '';
switch ( $related_product_type ){
    case 'slider':
        $related_product_classes .= 'owl-carousel owl-theme dark-pagination owl-no-pagination owl-prev-next-simple';
        break;
    case 'grid':
        $related_product_classes .= 'related-product-grid product-'.$related_product_grid_per_row;
        break;
    case 'remove':
        return;
        break;
}

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products                    = new WP_Query( $args );
$woocommerce_loop['name']    = 'related';
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $columns );

if ( $products->have_posts() ) : ?>
<div class="wpb_column vc_column_container col-md-12 col-sm-12 col-xs-12"><div class="wide-separator-line  margin-eight no-margin-lr"></div></div>
    <div class="product-deails-related">
        
    	<div class="col-md-12 text-center">
    		<h3 class="section-title"><?php esc_html_e( 'Related Products', 'woocommerce' ); ?></h3>
    	</div>
            
	            <!-- related products slider -->
	            <div id="related-products" class="<?php echo $related_product_classes;?>">
                        <?php while ( $products->have_posts() ) : $products->the_post();
                                global $product, $woocommerce_loop;

                                // Store loop count we're currently on
                                if ( empty( $woocommerce_loop['loop'] ) ) {
                                        $woocommerce_loop['loop'] = 0;
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
                                
                                switch ( $related_product_type  ) {
                                    case 'slider':
                                        // add item class
                                        $classes[] = 'item';
                                    break;
                                    
                                    case 'grid':
                                        switch ($related_product_grid_per_row){
                                            case '6':
                                                $classes[] = 'col-md-2 col-sm-6 col-xs-12';
                                                $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 6 );
                                                break;
                                            case '4':
                                                $classes[] = 'col-md-3 col-sm-6 col-xs-12';
                                                $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
                                                break;
                                            case '3':
                                                $classes[] = 'col-md-4 col-sm-6 col-xs-12';
                                                $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
                                                break;
                                            case '2':
                                                $classes[] = 'col-md-6 col-sm-6 col-xs-12';
                                                $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 2 );
                                                break;
                                            case '1':
                                                $classes[] = 'col-md-12 col-sm-12 col-xs-12';
                                                $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 1 );
                                                break;
                                            default:
                                                $classes[] = 'col-md-3 col-sm-4 col-xs-12';
                                                $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
                                                break;
                                        }
                                    break;
                                }
                                
                                ?>
                                <div <?php post_class( $classes ); ?>>
                                    <div class="home-product text-center position-relative overflow-hidden">
                                        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

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
                                </div>
                        <?php endwhile; // end of the loop. ?>

                    </div>
    </div>

<?php endif;
wp_reset_postdata();
if($related_product_type == 'slider'):    
ob_start(); ?>
<script type="text/javascript">jQuery(document).ready(function () { jQuery("#related-products").owlCarousel({ navigation: true, pagination: false, items: <?php echo $related_product_desktop_per_page;?>, itemsDesktop: [1200, <?php echo $related_product_desktop_per_page;?>], itemsTablet: [800, <?php echo $related_product_ipad_per_page;?>], itemsMobile: [700, <?php echo $related_product_mobile_per_page;?>],navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"] }); }); </script>
<?php 
$script = ob_get_contents();
ob_end_clean();
echo $script;
?>
<?php endif; ?>