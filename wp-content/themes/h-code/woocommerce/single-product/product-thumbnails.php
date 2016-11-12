<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>
	<div class="hcode-single-product-thumbnail-carousel thumbnails owl-small-arrow <?php echo 'columns-' . $columns; ?>"><?php
		// Get product feature image
		if ( has_post_thumbnail() ) {

			/* Image Alt, Title, Caption */
			$img_alt = hcode_option_image_alt( get_post_thumbnail_id() );
			$img_lightbox_caption = hcode_option_image_caption( get_post_thumbnail_id() );
			$img_lightbox_title = hcode_option_lightbox_image_title( get_post_thumbnail_id() );


			$image_alt = ( isset($img_alt['alt']) && !empty($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
			$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
			$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 


			$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_thumbnail' ), array(
				'title'	=> $image_title,
				'alt'	=> $image_alt
				) );
			$attachment_count = count( $product->get_gallery_attachment_ids() );
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="item">%s</div>', $image ), $post->ID );
		}

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array();

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			/* Image Alt, Title, Caption */
			$img_alt1 = hcode_option_image_alt( $attachment_id );
			$img_lightbox_caption = hcode_option_image_caption( $attachment_id );
			$img_lightbox_title = hcode_option_lightbox_image_title( $attachment_id );


			$image_alt1 = ( isset($img_alt1['alt']) && !empty($img_alt1['alt']) ) ? $img_alt1['alt'] : '' ; 
			$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
			$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ;
							
			$image_title 	= esc_attr( get_the_title( $attachment_id ) );
			$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
				'title'	=> $image_title,
				'alt'	=> $image_alt1
				) );

			$image_class = esc_attr( implode( ' ', $classes ) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item">%s</div>', $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		}

	?></div>
	<?php
}
