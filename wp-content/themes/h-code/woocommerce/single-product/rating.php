<?php
/**
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) : ?>
	<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">		
		<div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'woocommerce' ), $average ); ?>">
			<span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'woocommerce' ), '<span>', '</span>' ); ?>
				<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'woocommerce' ), '<span itemprop="reviewCount" class="rating">' . $rating_count . '</span>' ); ?>
			</span>
		</div>
		<?php if ( comments_open() ) : ?>
			<span class="rating-text text-uppercase">
				<?php printf( _n( '%s review', '%s reviews', $review_count, 'woocommerce' ), $review_count); ?>
			</span>
		<?php endif ?>
	</div>

<?php endif; ?>
