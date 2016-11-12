<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( ! woocommerce_products_will_display() )
	return;
?>
<div class="col-md-8 col-sm-12 grid-nav sm-text-center">
	<?php 
		$woocommerce_enable_grid_list = hcode_option('hcode_woocommerce_category_view_type');
		$output = '';
		if( $woocommerce_enable_grid_list ){
			$output .= '<div class="hcode-product-grid-list-wrapper">';
			
			if ( $woocommerce_enable_grid_list == '1' ) {
				$output .= '<a class="hcode-grid-view active" href="javascript:void(0);"><i class="fa fa-th"></i></a>';
			}else{
				$output .= '<a class="hcode-grid-view" href="javascript:void(0);"><i class="fa fa-th"></i></a>';
			}
			if ( $woocommerce_enable_grid_list == '2' ) {
				$output .= '<a class="hcode-list-view active" href="javascript:void(0);"><i class="fa fa-bars"></i></a>';
			}else{
				$output .= '<a class="hcode-list-view" href="javascript:void(0);"><i class="fa fa-bars"></i></a>';
			}

			$output .= '</div>';
			echo $output;
		}
	?>

    <p class="text-uppercase letter-spacing-1">
		<?php
		$paged    = max( 1, $wp_query->get( 'paged' ) );
		$per_page = $wp_query->get( 'posts_per_page' );
		$total    = $wp_query->found_posts;
		$first    = ( $per_page * $paged ) - $per_page + 1;
		$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

		if ( $total <= $per_page || -1 === $per_page ) {
			printf( _n( 'Showing the single result', 'Showing all %d results', $total, 'woocommerce' ), $total );
		} else {
			printf( _nx( 'Showing the single result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, '%1$d = first, %2$d = last, %3$d = total', 'woocommerce' ), $first, $last, $total );
		}
		?>
	</p>
</div>