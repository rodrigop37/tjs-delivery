<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shopping Cart Widget
 *
 * Displays shopping cart widget
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.3.0
 * @extends  WC_Widget
 */
if( !class_exists('Hcode_Widget_Cart') ) {
	class Hcode_Widget_Cart extends WC_Widget {

		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_cssclass    = 'woocommerce widget_shopping_cart';
			$this->widget_description = esc_html__( "Display the user's Cart in the sidebar.", 'woocommerce' );
			$this->widget_id          = 'woocommerce_widget_cart';
			$this->widget_name        = esc_html__( 'WooCommerce Cart', 'woocommerce' );
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'std'   => esc_html__( 'Cart', 'woocommerce' ),
					'label' => esc_html__( 'Title', 'woocommerce' )
				),
				'hide_if_empty' => array(
					'type'  => 'checkbox',
					'std'   => 0,
					'label' => esc_html__( 'Hide if cart is empty', 'woocommerce' )
				)
			);


			parent::__construct();
		}

		/**
		 * widget function.
		 *
		 * @see WP_Widget
		 *
		 * @param array $args
		 * @param array $instance
		 *
		 * @return void
		 */
		public function widget( $args, $instance ) {

			$hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;

			$this->widget_start( $args, $instance );

			if ( $hide_if_empty ) {
				echo '<div class="hide_cart_widget_if_empty">';
			}
			// Insert cart widget placeholder - code in woocommerce.js will update this on page load
			echo '<div class="hcode_shopping_cart_content">';
				wc_get_template( 'cart/mini-cart.php');
			echo '</div>';

			if ( $hide_if_empty ) {
				echo '</div>';
			}

			$this->widget_end( $args );
		}
	}
}