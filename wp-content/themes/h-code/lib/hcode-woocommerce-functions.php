<?php
/**
 * WooCommerce Extra Function.
 *
 * @package H-Code
 */
?>
<?php
if ( class_exists( 'WooCommerce' ) ){

    // Add Hcode Custom Product Tabs
    if (file_exists( HCODE_THEME_INC . '/hcode-product-tabs.php' )) 
    {
        require_once( HCODE_THEME_INC . '/hcode-product-tabs.php');
    }
    
    // Remove Woocommerce setup screen.
    remove_action( 'admin_init', 'setup_wizard' );
    if ( ! function_exists( 'hcode_remove_woocommerce_admin_notice' ) ) {
        function hcode_remove_woocommerce_admin_notice() {
            if ( class_exists( 'WC_Admin_Notices' ) ) {
                // Remove the "you have outdated template files" nag
                WC_Admin_Notices::remove_notice( 'template_files' );
                
                // Remove the "install pages" nag
                WC_Admin_Notices::remove_notice( 'install' );
            }
        }
    }
    add_action( 'wp_loaded', 'hcode_remove_woocommerce_admin_notice', 99 );
    
    // Hide the "install the WooThemes Updater"
    remove_action( 'admin_notices', 'woothemes_updater_notice' );

    // To Remove woocommerce_breadcrumb Action And Add New Action For Breadcrumb
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    add_action( 'hcode_woocommerce_breadcrumb', 'hcode_woocommerce_breadcrumb', 20, 0 );
    /* Woocommerce Breadcrumb*/
    if ( ! function_exists( 'hcode_woocommerce_breadcrumb' ) ) {
    	function hcode_woocommerce_breadcrumb( $args = array() ) {
    		$args = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
    			'delimiter'   => '',
    			'wrap_before' => '',
    			'wrap_after'  => '',
    			'before'      => '',
    			'after'       => '',
    			'home'        => __( 'Home', 'H-Code' )
    		) ) );

    		$breadcrumbs = new WC_Breadcrumb();

    		if ( $args['home'] ) {
    			$breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
    		}

    		$args['breadcrumb'] = $breadcrumbs->generate();
            
    		wc_get_template( 'global/breadcrumb.php', $args );
    	}
    }

    /* Naxt and Prev button on product pages */
    if ( ! function_exists( 'hcode_woocommerce_next_prev' ) ) {
    	function hcode_woocommerce_next_prev( $args = array() ) {

    		global $post;

            if( is_shop() ) return;
    		$current_url = get_permalink( $post->ID );
    		$output = $next = $previous = '';
    			
    		// Get the previous and next product links
    		$previous_link = get_permalink(get_adjacent_post(false,'',false)); 
    		$next_link = get_permalink(get_adjacent_post(false,'',true));
    			
    		// Create the two links provided the product exists
    		if ( $next_link != $current_url ) {
    			$next = '<a rel="next" class="black-text-link" href="' . $next_link . '">'.esc_html__('Next','H-code').'<i class="fa fa-angle-right"></i></a>';
    		}
    		if ( $previous_link != $current_url ) {
    			$previous = '<a rel="previous" class="black-text-link" href="' . $previous_link . '"><i class="fa fa-angle-left"></i> '.esc_html__("Previous",'H-Code').'</a>';
    		}
    		
    		// Create HTML Output
    		if ( $previous != '' )
    			$output .= $previous;
    		if ( $next != '' )
    			$output .= $next;
    		
    		// Display the final output
    		echo $output;
    		
    	}
    }

    remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta',40);
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
    add_action('hcode_woocommerce_product_single_rating_sku','woocommerce_template_single_rating',10);
    // Show price after woocommerce_template_single_excerpt
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
    add_action('woocommerce_single_product_summary','woocommerce_template_single_price',20);
    // TO remove rating in related product
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    // To remove Sale! from product
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
    add_action( 'hcode_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10 );

    // related product config
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    add_action( 'woocommerce_after_single_product_summary', 'hcode_related_products', 20 );
    if ( ! function_exists( 'hcode_related_products' ) ) {
    	
    	function hcode_related_products() {
    		$args = array(
    			'posts_per_page' => ( hcode_option('related_product_show_no') ) ? hcode_option('related_product_show_no') : 7,
    			'orderby' => 'rand'
    		);
    		woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
    	}
    }

    add_action('hcode_woocommerce_product_single_rating_sku', 'hcode_woocommerce_product_single_sku',40);
    if ( ! function_exists( 'hcode_woocommerce_product_single_sku' ) ) {
        function hcode_woocommerce_product_single_sku(){
        	global $post, $product;
        	if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
        			<div class="product_meta">
        				<span class="rating-text text-uppercase pull-right">
        					<?php echo __( 'SKU:', 'H-Code' ); ?>
        					<span class="sku black-text" itemprop="sku">
        						<?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'H-Code' ); ?>
        					</span>
        				</span>
        			</div>
        	<?php endif;
        }
    }

    /* TO remove default parice for variation. solution for woocommerce2.3.7 */
    remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
    /* To Add icon in variable product submit button */
    remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
    add_action( 'woocommerce_single_variation', 'hcode_woocommerce_single_variation_add_to_cart_button_with_icon', 20 );

    if ( ! function_exists( 'hcode_woocommerce_single_variation_add_to_cart_button_with_icon' ) ) {

        /**
         * Output the add to cart button for variations.
         */
        function hcode_woocommerce_single_variation_add_to_cart_button_with_icon() {
            global $product;
            ?>
            <div class="variations_button">
                <?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
                <button type="submit" class="single_add_to_cart_button highlight-button-dark btn-medium button btn alt"><i class="icon-basket"></i><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
                <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
                <input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
                <input type="hidden" name="variation_id" class="variation_id" value="" />
            </div>
            <?php
        }
    }

    /* Product Title And Stock Action For Responsive Version Start */
    add_action ('woocommerce_product_title_responsive', 'woocommerce_template_single_title',5);
    add_action ('woocommerce_product_title_responsive', 'hcode_woocommerce_template_single_stock_and_shipping_available',5);
    /* Product Title And Stock Action For Responsive Version End */


    remove_action ('woocommerce_single_product_summary', 'woocommerce_template_single_title',5);

    add_action( 'woocommerce_product_list_excerpt', 'woocommerce_template_single_excerpt', 20 );
    add_action ('woocommerce_product_title_stock', 'hcode_woocommerce_template_single_stock_and_shipping_available',5);
    if ( ! function_exists( 'hcode_woocommerce_template_single_stock_and_shipping_available' ) ) {
        function hcode_woocommerce_template_single_stock_and_shipping_available(){
        	global $post, $product;
        	$stock = $shipping_available = $separatorline = '';
        	$enable_product_stock_status = hcode_option( 'enable_product_stock_status' );
        	$enable_product_shipping = hcode_option( 'enable_product_shipping' );
        	$hcode_shipping_available_text = hcode_option( 'hcode_shipping_available_text' );
        	$availability = $product->get_availability();
		    if ( $product->product_type == 'simple' && $availability['availability'] && $enable_product_stock_status ) :
		        $stock = apply_filters( 'woocommerce_stock_html', esc_html( $availability['availability'] ), $availability['availability'] );
		    endif;
		    if( $product->product_type == 'simple' && $enable_product_stock_status ) :
		    	$stock = ( $stock ) ? $stock : __( 'In stock', 'H-Code' );
		    endif;
		    if( get_option('woocommerce_calc_shipping') == 'yes' && $enable_product_shipping ) :
		    	$shipping_available = $hcode_shipping_available_text;
		    endif;
		    if( $stock && $shipping_available ):
		    	$separatorline = ' / ';
		    endif;
        	//$shipping_available = (get_option('woocommerce_calc_shipping') == 'yes' && $enable_product_shipping) ? 'Shipping Available':'';
        	echo '<p class="text-uppercase letter-spacing-2 margin-two product-available">'.$stock.$separatorline.$shipping_available.'</p>';
        	echo '<div class="separator-line bg-black no-margin-lr margin-five"></div>';
        }
    }

    // check for empty-cart get param to clear the cart
    add_action( 'init', 'hcode_woocommerce_clear_cart_url' );
    if ( ! function_exists( 'hcode_woocommerce_clear_cart_url' ) ) {
        function hcode_woocommerce_clear_cart_url() {
          global $woocommerce;
        	
        	if ( isset( $_GET['empty-cart'] ) ) {
        		$woocommerce->cart->empty_cart(); 
        	}
        }
    }

    /* Remove Woocommerce Default style */
    add_filter( 'woocommerce_enqueue_styles', 'hcode_dequeue_woocommerce_styles' );
    if ( ! function_exists( 'hcode_dequeue_woocommerce_styles' ) ) {
        function hcode_dequeue_woocommerce_styles( $enqueue_styles ) {
            
        	unset( $enqueue_styles['woocommerce-general'] );
        	unset( $enqueue_styles['woocommerce-layout'] );
        	unset( $enqueue_styles['woocommerce-smallscreen'] );
            unset( $enqueue_styles['select2'] );
        	return $enqueue_styles;
        }
    }

    // To add custom color field in taxonomy "pa_color"
    if ( ! function_exists( 'hcode_edit_color_field' ) ) {
        function hcode_edit_color_field($term) {
        	// put the term ID into a variable
                
                $t_id = $term->term_id;
         
        	// retrieve the existing value(s) for this meta field. This returns an array
        	$term_meta = get_option( "taxonomy_$t_id" ); ?>
        	<tr class="form-field">
        	<th scope="row" valign="top"><label for="term_meta[custom_color]"><?php esc_html_e( 'Add color code with #', 'H-Code' ); ?></label></th>
        		<td>
        			<input type="text" name="term_meta[custom_color]" id="term_meta[custom_color]" value="<?php echo esc_attr( $term_meta['custom_color'] ) ? esc_attr( $term_meta['custom_color'] ) : ''; ?>">
        			<p class="description"><?php esc_html_e( 'Enter a color code. ex. for white = #FFFFFF','H-Code' ); ?></p>
        		</td>
        	</tr>
        <?php
        }
    }

    if ( ! function_exists( 'hcode_add_color_field' ) ) {
        function hcode_add_color_field( $term ){ ?>
            <tr class="form-field">
        	<th scope="row" valign="top"><label for="term_meta[custom_color]"><?php esc_html_e( 'Add color code with #', 'H-Code' ); ?></label></th>
        		<td>
        			<input type="text" name="term_meta[custom_color]" id="term_meta[custom_color]" value="">
        			<p class="description"><?php esc_html_e( 'Enter a color code. ex. for white = #FFFFFF','H-Code' ); ?></p>
        		</td>
        	</tr>
        <?php
        }
    }

    // Save extra taxonomy fields callback function.
    if ( ! function_exists( 'hcode_save_taxonomy_custom_field_color' ) ) {
        function hcode_save_taxonomy_custom_field_color( $term_id ) {
            if ( isset( $_POST['term_meta'] ) ) {
                $t_id = $term_id;
                $term_meta = get_option( "taxonomy_$t_id" );
                $cat_keys = array_keys( $_POST['term_meta'] );
                foreach ( $cat_keys as $key ) {
                    if ( isset ( $_POST['term_meta'][$key] ) ) {
                        $term_meta[$key] = $_POST['term_meta'][$key];
                    }
                }
                // Save the option array.
                update_option( "taxonomy_$t_id", $term_meta );
            }
        } 
    }

    add_action( 'widgets_init', 'hcode_override_woocommerce_cart_widget', 15 );
    if ( ! function_exists( 'hcode_override_woocommerce_cart_widget' ) ) {
        function hcode_override_woocommerce_cart_widget() { 
          if ( class_exists( 'WC_Widget_Cart' ) ) {
            unregister_widget( 'WC_Widget_Cart' ); 
            include_once( HCODE_THEME_DIR.'/woocommerce/cart/hcode-widget-cart.php' );
            register_widget( 'Hcode_Widget_Cart' );
          } 
          include_once( HCODE_THEME_DIR.'/woocommerce/hcode-widget-color-attribute.php' );
          register_widget( 'Hcode_Widget_Color_Attribute' );
          
        }
    }

    add_filter('add_to_cart_fragments', 'hcode_add_to_cart_fragments'); 
    if ( ! function_exists( 'hcode_add_to_cart_fragments' ) ) {
        function hcode_add_to_cart_fragments( $fragments ) {
        	global $woocommerce;       
        	ob_start();
        	?>
        	<div class="hcode_shopping_cart_content">
        		<?php wc_get_template( 'cart/mini-cart.php');?>
        	</div>
        	<?php
        	$fragments['.hcode_shopping_cart_content'] = ob_get_clean();
        	return $fragments;
        }
    }

    /* For Grid and List view in Woocommerce */

    if ( ! function_exists( 'hcode_woocommerce_category_view' ) ) :

        function hcode_woocommerce_category_view() {
            $product_view_type = '';
            $hcode_woocommerce_category_view_type = hcode_option( 'hcode_woocommerce_category_view_type' );
            if( $hcode_woocommerce_category_view_type == 1 ):
                $product_view_type = ' product-grid-view';
            elseif( $hcode_woocommerce_category_view_type == 2 ):
                $product_view_type = ' product-list-view';
            else:
            endif;
            echo $product_view_type;
        }
    endif;

    /* For Woocommerce product Tabs */
    add_filter( 'woocommerce_product_tabs', 'hcode_woo_rename_tabs', 10 );
    if ( ! function_exists( 'hcode_woo_rename_tabs' ) ) {
        function hcode_woo_rename_tabs( $tabs ) {
            global $product, $post;

            // Description Additional Information First Tab
            if ( $post->post_content ) :
                $tabs['description'] = array(
                'title'     => esc_html__( 'Details', 'H-Code' ),
                'priority'  => 25,
                'callback'  => 'woocommerce_product_description_tab'
               );
            endif;

            // Adds Washing Instructions Second Tab
            $hcode_washing_instruction = get_post_meta($post->ID, 'hcode_washing_instruction', true);
            if( $hcode_washing_instruction ):
                $tabs['washing_instructions'] = array(
            	'title' 	=> esc_html__( 'Washing Instructions', 'H-Code' ),
            	'priority' 	=> 30,
            	'callback' 	=> 'hcode_woocommerce_product_tab_instructions'
                );
            endif;

            // Adds Sizing Third Tab
            $hcode_size_tab = get_post_meta($post->ID, 'hcode_size_tab', true);
            if ($hcode_size_tab):
                $tabs['sizing'] = array(
            	'title' 	=> esc_html__( 'Sizing', 'H-Code' ),
            	'priority' 	=> 35,
            	'callback' 	=> 'hcode_woocommerce_product_tab_sizing'
                );
            endif;
            
            // Reviews Last Tab
            $tabs['reviews']['priority'] = 40;

        	return $tabs;
        }
    }

    if ( ! function_exists( 'hcode_woocommerce_product_tab_instructions' ) ) {
        function hcode_woocommerce_product_tab_instructions() {
            global $post;
            
            $meta_value = get_post_meta($post->ID, 'hcode_product_tabs_options', true);
            
            if( !empty($meta_value) ):
            
                $hcode_washing_instruction = ( $meta_value[0]['hcode_washing_instruction'] ) ? $meta_value[0]['hcode_washing_instruction'] : '';
                // Washing Instructions Content
                echo '<div class="col-md-12 col-sm-12 col-xs-12">';
                echo $hcode_washing_instruction;
                echo '</div>';
            else:
            endif;
        	
        }
    }

    if ( ! function_exists( 'hcode_woocommerce_product_tab_sizing' ) ) {
        function hcode_woocommerce_product_tab_sizing() {
            global $post;
            
            $meta_value = get_post_meta($post->ID, 'hcode_product_tabs_options', true);
            if( !empty($meta_value) ):
            
                $hcode_size_tab = ( $meta_value[0]['hcode_size_tab'] ) ? $meta_value[0]['hcode_size_tab'] : '';
                // Sizing Content
                echo '<div class="col-md-12 col-sm-12 col-xs-12">';
                echo $hcode_size_tab;
                echo '</div>';
            else:
            endif;
        }
    }

    /* Product single Title setup */
    if ( ! function_exists( 'hcode_woocommerce_product_single_title' ) ) {
        function hcode_woocommerce_product_single_title(){
            global $post;
            $output = '';

            ob_start();
            do_action('woocommerce_product_title_responsive');
            $output = ob_get_contents();
            ob_end_clean();
            return $output;
            
        }
    }
    
    /* To Remove Placehoder From Checkout Form */
    add_filter('woocommerce_default_address_fields', 'hcode_override_address_fields');
    if ( ! function_exists( 'hcode_override_address_fields' ) ) {
        function hcode_override_address_fields( $address_fields ) {
          $address_fields['address_1']['placeholder'] = '';
          $address_fields['address_2']['placeholder'] = '';
          $address_fields['city']['placeholder'] = '';
          $address_fields['state']['placeholder'] = '';
          $address_fields['postcode']['placeholder'] = '';
          return $address_fields;
        }
    }
}
?>