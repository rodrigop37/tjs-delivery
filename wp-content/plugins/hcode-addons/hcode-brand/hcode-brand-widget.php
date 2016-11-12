<?php
/**
 * WooCommerce Product Brand Widget.
 *
 * @package H-Code
 */
?>
<?php
if (!class_exists('Hcode_Brand_Addons_Widget')) {
	class Hcode_Brand_Addons_Widget extends WP_Widget {

		/**
		 * Register hcode brand widget.
		 */
		function __construct() {
			//Shop By Brand
			if(!class_exists( 'WooCommerce' )){
		        return false;
		    }
			parent::__construct(
				'Hcode_Brand_Widget', // Base ID
				__('H-Code WooCommerce Brands', 'hcode-brands'), // Name
				array( 'description' => __( 'Display a list of your Brands on your site.', 'hcode-brands' ), ) // Args
			);
		}

		public function widget( $args, $instance ) {
			global $wp_query, $post;
	                
	        if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) ) {
	            return;
	        }
	            
			$current_brand_obj = false;
			$title = apply_filters( 'widget_title', $instance['title'] );
			echo $args['before_widget'];
				if ( ! empty( $title ) )
					echo $args['before_title'] . $title . $args['after_title'];
					$get_terms="product_brand";
				
				if ( is_tax( 'product_brand' ) ) {
					$current_brand_obj = $wp_query->queried_object;
				}	
				if ( is_tax( 'product_cat' ) ) {

					$current_brand_obj = $wp_query->queried_object;

				} elseif ( is_singular( 'product' ) ) {

					$product_brand = wc_get_product_terms( $post->ID, 'product_brand', array( 'orderby' => 'parent' ) );

					if ( $product_brand ) {
						$current_brand_obj   = end( $product_brand );
					}

				}
				$categories = get_terms( 'product_brand', 'orderby=name&hide_empty=0' );
					
				if ( ! empty( $categories ) ) {
					echo '<ul class="category-list">';
				 	foreach( (array) $categories as $term ) { 
				  	$count = $current_brand = '';
	                    if( $current_brand_obj != false ){
	                        $current_brand = ( $current_brand_obj->term_id == $term->term_id ) ? ' class="active"' : '';
	                    }
				  	if($instance['post_counts']==1)
				   	$count='<span class="light-gray-text"> / '. esc_html( $term->count ) .'</span>';
					echo'<li'.$current_brand.'><a href="'.get_term_link( $term ).'">'.esc_html( $term->name ).'</a>'.$count.'</li>';
					}
					echo '</ul>';
					
				}
			echo $args['after_widget'];
		}

		public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
			?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','woocommerce-brands'); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
			<?php 
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['post_counts'] = isset($new_instance['post_counts'] ) ? (int) $new_instance['post_counts'] : 0;				
			return $instance;
		}
	}
}

?>