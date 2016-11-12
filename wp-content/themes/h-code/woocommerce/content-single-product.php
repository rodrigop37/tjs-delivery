<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }

	$classes = array();
	$classes[] = 'single-product-wrapper no-transition';

?>

<?php /* Start sidebar Div */
wc_get_template_part( 'content', 'before-product' ); 
?>
<?php
$product_sidebar_position = hcode_option('product_sidebar_position');
	
$hcode_product_main_top_classes = $hcode_product_main_bottom_classes = $hcode_product_top_title_classes = $hcode_product_bottom_title_classes = '';
switch ($product_sidebar_position) {
	case '1':
		$hcode_product_main_top_classes .= 'col-md-6 col-sm-12';
		$hcode_product_main_bottom_classes .= 'col-md-5 col-sm-12 col-md-offset-1';
		$hcode_product_top_title_classes .= '<div class="product-title-responsive-wrapper col-md-12 col-sm-12 sm-display-block display-none">'.hcode_woocommerce_product_single_title().'</div>';
		$hcode_product_bottom_title_classes .= '<div class="product-title-wrapper sm-display-none display-block">'.hcode_woocommerce_product_single_title().'</div>';
	break;
		
	case '2':
	case '3':
		$hcode_product_main_top_classes .= 'col-md-6 col-sm-12';
		$hcode_product_main_bottom_classes .= 'col-md-6 col-sm-12 detail-right';
		$hcode_product_top_title_classes .= '<div class="product-title-responsive-wrapper col-md-12 col-sm-12 sm-display-block display-none">'.hcode_woocommerce_product_single_title().'</div>';
		$hcode_product_bottom_title_classes .= '<div class="product-title-wrapper sm-display-none display-block">'.hcode_woocommerce_product_single_title().'</div>';
	break;

	case '4':
		$hcode_product_main_top_classes .= 'col-md-12 col-sm-12 margin-ten-bottom';
		$hcode_product_main_bottom_classes .= 'col-md-12 col-sm-12';

		$hcode_product_top_title_classes .= '<div class="product-title-responsive-wrapper col-md-12 col-sm-12">'.hcode_woocommerce_product_single_title().'</div>';
		$hcode_product_bottom_title_classes .= '';
	break;

	default:
	break;
}
?>
<?php echo $hcode_product_top_title_classes; ?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class( $classes); ?>>
	<div class="wpb_column vc_column_container sm-margin-bottom-ten <?php echo $hcode_product_main_top_classes;?>">
		<?php
			/**
			 * woocommerce_before_single_product_summary hook
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>
	</div>
	<div class="<?php echo $hcode_product_main_bottom_classes;?>">
		<div class="rating margin-five no-margin-top light-gray-text2">
			<?php
				/**
				 * hcode_woocommerce_product_single_rating_sku hook
				 *
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_meta - 40
				 *	
				 */

				do_action( 'hcode_woocommerce_product_single_rating_sku');
			?>
		</div>

		<?php echo $hcode_product_bottom_title_classes; ?>
		<meta itemprop="name" content="<?php the_title(); ?>" />
		<meta itemprop="url" content="<?php the_permalink(); ?>" />
		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>
	</div>
</div><!-- #product-<?php the_ID(); ?> -->

<?php
	/**
	 * woocommerce_after_single_product_summary hook
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
?>

<?php 
/* End sidebar Div*/
wc_get_template_part( 'content', 'after-product' ); 
?>

<?php do_action( 'woocommerce_after_single_product' ); ?>