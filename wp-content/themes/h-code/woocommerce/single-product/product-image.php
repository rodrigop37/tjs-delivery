<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>
	<div class="single-product-image-wrapper">
		<?php
			if ( has_post_thumbnail() ) {

				$product_title = get_the_title();
				$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
				$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );

				/* Image Alt, Title, Caption */
				$img_alt = hcode_option_image_alt( get_post_thumbnail_id() );
				$img_lightbox_caption = hcode_option_image_caption( get_post_thumbnail_id() );
				$img_lightbox_title = hcode_option_lightbox_image_title( get_post_thumbnail_id() );


				$image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
				$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
				$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 


				$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title'	=> $image_title,
					'alt'	=> $image_alt
					) );

				$attachment_count = count( $product->get_gallery_attachment_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}
				echo '<div class="hcode-single-big-product-thumbnail-carousel product-zoom-gallery owl-small-arrow">';
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="item"><a itemprop="image" href="%s" class="woocommerce-main-image zoom" data-source="%s" data-rel="prettyPhoto' . $gallery . '" '.$image_lightbox_caption.$image_lightbox_title.'>%s</a></div>', $image_link, $image_link, $image ), $post->ID );

				$attachment_ids = $product->get_gallery_attachment_ids();

				if ( $attachment_ids ) {
					$loop 		= 0;
					$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
					?>
					<?php

						foreach ( $attachment_ids as $attachment_id ) {

							$classes = array();

							$image_link = wp_get_attachment_url( $attachment_id );

							if ( ! $image_link )
								continue;

							$image_title 	= esc_attr( get_the_title( $attachment_id ) );
							$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

							/* Image Alt, Title, Caption */
							$img_alt1 = hcode_option_image_alt( $attachment_id );
							$img_lightbox_caption = hcode_option_image_caption( $attachment_id );
							$img_lightbox_title = hcode_option_lightbox_image_title( $attachment_id );


							$image_alt1 = ( isset($img_alt1['alt']) && !empty($img_alt1['alt']) ) ? $img_alt1['alt'] : '' ; 
							$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
							$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ;

							$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ), 0, $attr = array(
								'title'	=> $image_title,
								'alt'	=> $image_alt1
								) );

							$image_class = esc_attr( implode( ' ', $classes ) );

							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item"><a href="%s" class="%s" data-source="%s" data-rel="prettyPhoto[product-gallery]" '.$image_lightbox_caption.$image_lightbox_title.'>%s</a></div>', $image_link, $image_class, $image_link, $image ), $attachment_id, $post->ID, $image_class );

							$loop++;
						}
				}
				
				echo '</div>';
				
			} else {

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'woocommerce' ) ), $post->ID );

			}
		?>
		<?php //do_action ( 'hcode_sale_flash' ); ?>
		<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	</div>