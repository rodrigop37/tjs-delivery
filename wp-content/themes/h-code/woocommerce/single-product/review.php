<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
?>

<div itemscope itemtype="http://schema.org/Review" <?php comment_class('review'); ?> id="li-comment-<?php comment_ID() ?>">
	<div itemprop="itemReviewed" class="display-none">
		<span itemprop="name"><?php the_title(); ?></span>
	</div>
	<div id="comment-<?php comment_ID(); ?>" class="comment_container">
				
		<?php if ( $comment->comment_approved == '0' ) : ?>

			<p class="letter-spacing-2 text-uppercase review-name"><em><?php esc_html_e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></p>

		<?php else : ?>
			
			<p class="letter-spacing-2 text-uppercase review-name">
				<strong itemprop="author"><?php comment_author(); ?></strong><?php

					if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
						if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
							echo '<em class="verified">(' . esc_html__( 'verified owner', 'woocommerce' ) . ')</em> ';

				?>&sbquo; <span itemprop="datePublished"><?php echo get_comment_date( wc_date_format() ); ?></span>
			</p>

		<?php endif; ?>
		<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
			<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'woocommerce' ), $rating ) ?>">
					<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%">
						<strong itemprop="ratingValue"><?php echo $rating; ?></strong> <?php esc_html_e( 'out of 5', 'woocommerce' ); ?>
					</span>
				</div>
			

		<?php endif; ?>

		<div class="review-text" itemprop="description"><?php comment_text(); ?></div>

	</div>
