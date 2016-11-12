<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

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


$hcode_category_product_row = hcode_option( 'hcode_category_product_row_column' );

switch ( $hcode_category_product_row ) {
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
        $classes[] = 'col-md-4 col-sm-6 col-xs-12';
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
        break;
}

if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}

?>
<div <?php post_class( $classes ); ?>>
	<div class="home-product text-center position-relative overflow-hidden">
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
				?>
				<?php
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
			<?php 
				/**
				* hcode_sale_flash hook
				*
				* @hooked hcode_sale_flash - 10
				*
				*/
				do_action ( 'hcode_sale_flash' );
			?>
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
			<?php do_action('woocommerce_product_title_stock'); ?>

			<?php 
				/* Show Product Excerpt For List View */
			do_action('woocommerce_product_list_excerpt'); ?>
			<!-- <a href="<?php the_permalink(); ?>"> -->
				<?php
					/**
					 * woocommerce_after_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
			<!-- </a> -->
		
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