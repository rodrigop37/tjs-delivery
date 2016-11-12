<?php
/*
Plugin Name: H-Code Addons
Plugin URI: http://www.themezaa.com
Description: A part of H-Code theme
Version: 1.6.1
Author: Themezaa Team
Author URI: http://www.themezaa.com
Text Domain: hcode-addons
*/

defined('HCODE_ADDONS_ROOT') or define('HCODE_ADDONS_ROOT', dirname(__FILE__));
defined('HCODE_ADDONS_CUSTOM_POST_TYPE') or define('HCODE_ADDONS_CUSTOM_POST_TYPE', dirname(__FILE__).'/custom-post-type');

defined('HCODE_ADDONS_ROOT_DIR') or define('HCODE_ADDONS_ROOT_DIR', plugins_url().'/hcode-addons');


if(!class_exists('Hcode_Addons_Post_Type'))
{
  class Hcode_Addons_Post_Type
  {

    // Construct
    public function __construct()
    {
    	
      	// Action For Register Custom Post Type "Portfolio".
      	add_action('setup_theme', array($this,'hcode_addons_register_custom_post_type') );

      	require_once( HCODE_ADDONS_ROOT.'/hcode-shortcodes/hcode-shortcode-addons.php' );
      	
      	// Plugin Load Action.
      	add_action( 'plugins_loaded', array($this,'hcode_addons_load_plugin_textdomain') );

      	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	      	// Action For Register "Brands".
	      	add_action( 'init', array( $this, 'create_taxonomies' ), 0);
			
			// Action For Detete Taxonomie.
			add_action( "delete_term", array( $this, 'delete_term' ), 5 );

			// Action Add Brand Field.
			add_action( 'product_brand_add_form_fields', array( $this, 'add_brands_fields' ) );
			// Action Edit Brand Field.
			add_action( 'product_brand_edit_form_fields', array( $this, 'edit_brands_fields' ), 10, 2 );
			// Action Save Brand Fields.
			add_action( 'created_term', array( $this, 'save_brands_fields' ), 10, 3 );
			add_action( 'edit_term', array( $this, 'save_brands_fields' ), 10, 3 );

			// Action For Add Brand Column.
			add_filter( 'manage_edit-product_brand_columns', array( $this, 'brands_columns' ) );
			add_filter( 'manage_product_brand_custom_column', array( $this, 'brands_column' ), 10, 3 );
			// Action Add Script.
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			// Action Add Brand Widget.
			add_action( 'widgets_init', array( $this, 'hcode_brand_widget_include' ) );
		}
    }

	/* Load plugin textdomain. */
	public function hcode_addons_load_plugin_textdomain() {
	  load_plugin_textdomain( 'hcode-addons', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' ); 
	}

    /**
     * Load custom post types
     */
    public function hcode_addons_register_custom_post_type()
    {
      require_once( HCODE_ADDONS_CUSTOM_POST_TYPE .'/hcode-theme-portfolio.php'); 
    }

  	// create two taxonomies, genres and writers for the post type "product"
		public function create_taxonomies() {

			// Add new taxonomy, make it hierarchical (like categories)
			$shop_page_id = woocommerce_get_page_id( 'shop' );
			$base_slug = $shop_page_id > 0 && get_page( $shop_page_id ) ? get_page_uri( $shop_page_id ) : 'shop';
			$category_base = get_option('woocommerce_prepend_shop_page_to_urls') == "yes" ? trailingslashit( $base_slug ) : '';
			$cap = version_compare( WOOCOMMERCE_VERSION, '2.0', '<' ) ? 'manage_woocommerce_products' : 'edit_products';		
			$labels = array(
				'name'              => __( 'Brands', 'hcode-addons' ),
				'singular_name'     => __( 'Brands', 'hcode-addons' ),
				'search_items'      => __( 'Search Genres', 'hcode-addons' ),
				'all_items'         => __( 'All Brands', 'hcode-addons' ),
				'parent_item'       => __( 'Parent Brands', 'hcode-addons'),
				'parent_item_colon' => __( 'Parent Brands:', 'hcode-addons' ),
				'edit_item'         => __( 'Edit Brands', 'hcode-addons'),
				'update_item'       => __( 'Update Brands', 'hcode-addons'),
				'add_new_item'      => __( 'Add New Brands', 'hcode-addons'),
				'new_item_name'     => __( 'New Brands Name', 'hcode-addons'),
				'menu_name'         => 'Brand',
			);
			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui' 				=> true,
				'show_in_nav_menus' 	=> true,
				'capabilities'			=> array(
					'manage_terms' 		=> $cap,
					'edit_terms' 		=> $cap,
					'delete_terms' 		=> $cap,
					'assign_terms' 		=> $cap
				),
				'rewrite' 				=> array( 'slug' => $category_base . __( 'brand', 'hcode-addons' ), 
				'with_front'             => false, 
				'hierarchical' => true )
			);
			register_taxonomy( 'product_brand', array('product'), apply_filters( 'register_taxonomy_product_brand',$args ));	
		}  

		public function delete_term( $term_id ) {

			$term_id = (int) $term_id;

			if ( ! $term_id )
				return;

			global $wpdb;
			$wpdb->query( "DELETE FROM {$wpdb->woocommerce_termmeta} WHERE `woocommerce_term_id` = " . $term_id );
		}

		public function admin_scripts() {
			wp_enqueue_media();
		}
		
		public function add_brands_fields() { ?>
			<div class="form-field product_brand_thumbnail_main">
				<label><?php _e( 'Thumbnail', 'hcode-addons' ); ?></label>
				<div id="product_brand_thumbnail" class="thumb_img_preview" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" alt=""/></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="product_brand_thumbnail_id" class="product_brand_thumb_id" name="product_brand_thumbnail_id" />
					<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'hcode-addons' ); ?></button>
					<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'hcode-addons' ); ?></button>
				</div>
	            <div class="clear"></div>
			</div>
	        <div class="form-field product_brand_logo_main">
				<label><?php _e( 'Logo', 'hcode-addons' ); ?></label>
				<div id="product_brand_logo" class="thumb_img_preview" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" alt="" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="product_brand_logo_id" class="product_brand_thumb_id" name="product_brand_logo_id" />
					<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'hcode-addons' ); ?></button>
					<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'hcode-addons' ); ?></button>
				</div>
	            <div class="clear"></div>
			</div>
	        <script type="text/javascript">
	            // Only show the "remove image" button when needed
	            if ( !jQuery( '.product_brand_thumbnail_main #product_brand_thumbnail_id' ).val() ) {
	                    jQuery( '.product_brand_thumbnail_main .remove_image_button' ).hide();
	            }
	            if ( !jQuery( '.product_brand_logo_main #product_brand_logo_id' ).val() ) {
	                    jQuery( '.product_brand_logo_main .remove_image_button' ).hide();
	            }
	            jQuery( document ).on( 'click', '.upload_image_button', function( event ) {
	                // Uploading files
	                var file_frame;
	                    event.preventDefault();
	                    var currentdiv = jQuery(this).parent().parent();
	                    
	                    // If the media frame already exists, reopen it.
	                    if ( file_frame ) {
	                            file_frame.open();
	                            return;
	                    }

	                    // Create the media frame.
	                    file_frame = wp.media.frames.downloadable_file = wp.media({
	                            title: '<?php _e( "Choose an image", "hcode-addons" ); ?>',
	                            button: {
	                                    text: '<?php _e( "Use image", "hcode-addons" ); ?>'
	                            },
	                            multiple: false
	                    });

	                    // When an image is selected, run a callback.
	                    file_frame.on( 'select', function() {
	                            var attachment = file_frame.state().get( 'selection' ).first().toJSON();
	                            currentdiv.find( '.product_brand_thumb_id' ).val( attachment.id );
	                            currentdiv.find( '.thumb_img_preview img' ).attr( 'src', attachment.url );
	                            currentdiv.find( '.remove_image_button' ).show();
	                    });

	                    // Finally, open the modal.
	                    file_frame.open();
	            });

	            jQuery( document ).on( 'click', '.remove_image_button', function() {
	                var currentdiv = jQuery(this).parent().parent();
	                    currentdiv.find( '.thumb_img_preview img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
	                    currentdiv.find( '.product_brand_thumb_id   ' ).val( '' );
	                    currentdiv.find( '.remove_image_button' ).hide();
	                    return false;
	            });
	        </script>
		<?php
		}

		public function edit_brands_fields( $term, $taxonomy ) {
			$display_type	= get_woocommerce_term_meta( $term->term_id, 'featured', true );
			$image = $image_logo = '';
			$thumbnail_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
	        $logo_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'logo_id', true ) );
			if ( $thumbnail_id ){
				$image = wp_get_attachment_thumb_url( $thumbnail_id );
	        } else {
				$image = wc_placeholder_img_src();	
			}
	                
	        if($logo_id){
	            $image_logo = wp_get_attachment_thumb_url( $logo_id );
	        } else {
				$image_logo = wc_placeholder_img_src();	
			}
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php _e( 'Thumbnail', 'hcode-addons' ); ?></label></th>
				<td>
	                <div class="product_brand_thumbnail_main">
						<div id="product_brand_thumbnail" class="thumb_img_preview" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" alt="" /></div>
						<div style="line-height: 60px;">
							<input type="hidden" id="product_brand_thumbnail_id" name="product_brand_thumbnail_id" class="product_brand_thumb_id" value="<?php echo $thumbnail_id; ?>" />
							<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'hcode-addons' ); ?></button>
							<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'hcode-addons' ); ?></button>
						</div>
						<div class="clear"></div>
	                </div>
				</td>
	        </tr>
	        <tr class="form-field">
	            <th scope="row" valign="top"><label><?php _e( 'Logo', 'hcode-addons' ); ?></label></th>
	            <td>
	                <div class="product_brand_logo_main">
					<div id="product_brand_logo" class="thumb_img_preview" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image_logo ); ?>" width="60px" height="60px" alt="" /></div>
					<div style="line-height: 60px;">
						<input type="hidden" id="product_brand_thumb_id" name="product_brand_logo_id" class="product_brand_thumb_id" value="<?php echo $logo_id; ?>" />
						<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'hcode-addons' ); ?></button>
						<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'hcode-addons' ); ?></button>
					</div>
					<div class="clear"></div>
	                </div>
				</td>
	            <script type="text/javascript">
	                // Only show the "remove image" button when needed
	                if ( '0' === jQuery( '.product_brand_thumbnail_main #product_brand_thumbnail_id' ).val() ) {
	                    jQuery( '.product_brand_thumbnail_main .remove_image_button' ).hide();
	                }

	                if ( '0' === jQuery( '.product_brand_logo_main #product_brand_thumb_id' ).val() ) {
	                    jQuery( '.product_brand_logo_main .remove_image_button' ).hide();
	                    jQuery( '.product_brand_logo_main #product_brand_thumb_id .thumb_img_preview img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
	                }

	                jQuery( document ).on( 'click', '.upload_image_button', function( event ) {
	                    // Uploading files
	                    var file_frame;
	                    event.preventDefault();
	                    var currentdiv = jQuery(this).parent().parent();

	                    // If the media frame already exists, reopen it.
	                    if ( file_frame ) {
	                            file_frame.open();
	                            return;
	                    }

	                    // Create the media frame.
	                    file_frame = wp.media.frames.downloadable_file = wp.media({
	                            title: '<?php _e( "Choose an image", "hcode-addons" ); ?>',
	                            button: {
	                                    text: '<?php _e( "Use image", "hcode-addons" ); ?>'
	                            },
	                            multiple: false
	                    });

	                    // When an image is selected, run a callback.
	                    file_frame.on( 'select', function() {
	                            var attachment = file_frame.state().get( 'selection' ).first().toJSON();
	                            currentdiv.find( '.product_brand_thumb_id' ).val( attachment.id );
	                            currentdiv.find( '.thumb_img_preview img' ).attr( 'src', attachment.url );
	                            currentdiv.find( '.remove_image_button' ).show();
	                    });

	                    // Finally, open the modal.
	                    file_frame.open();
	                });

	                jQuery( document ).on( 'click', '.remove_image_button', function() {
		                var currentdiv = jQuery(this).parent().parent();
	                    currentdiv.find( '.thumb_img_preview img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
	                    currentdiv.find( '.product_brand_thumb_id   ' ).val( '' );
	                    currentdiv.find( '.remove_image_button' ).hide();
	                    return false;
	                });
	            </script>
			</tr>
		<?php
		}

		public function save_brands_fields( $term_id, $tt_id, $taxonomy ) {
			if ( isset( $_POST['product_brand_thumbnail_id'] ) && 'product_brand' === $taxonomy ) {
				update_woocommerce_term_meta( $term_id, 'thumbnail_id', absint( $_POST['product_brand_thumbnail_id'] ) );
			}
	        if ( isset( $_POST['product_brand_logo_id'] ) && 'product_brand' === $taxonomy ) {
				update_woocommerce_term_meta( $term_id, 'logo_id', absint( $_POST['product_brand_logo_id'] ) );
			}
			delete_transient( 'wc_term_counts' );
		}

		public function brands_columns( $columns ) {
				
			$new_columns          = array();
			$new_columns['cb']    = $columns['cb'];
			$new_columns['thumb'] = __( 'Logo', 'hcode-addons' );
	        $new_columns['banner_thumb'] = __( 'Banner', 'hcode-addons' );

			unset( $columns['cb'] );

			return array_merge( $new_columns, $columns );
			
		}

		public function brands_column( $columns, $column, $id ) {
			if ( 'thumb' == $column ) {

				$thumbnail_id = get_woocommerce_term_meta( $id, 'logo_id', true );

				if ( $thumbnail_id ) {
					$image = wp_get_attachment_thumb_url( $thumbnail_id );
				} else {
					$image = wc_placeholder_img_src();
				}

				// Prevent esc_url from breaking spaces in urls for image embeds
				// Ref: http://core.trac.wordpress.org/ticket/23605
				$image = str_replace( ' ', '%20', $image );

				$columns .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr__( 'Thumbnail', 'hcode-addons' ) . '" class="wp-post-image" height="48" width="48" />';

			}
	                if ( 'banner_thumb' == $column ) {

				$thumbnail_id = get_woocommerce_term_meta( $id, 'thumbnail_id', true );

				if ( $thumbnail_id ) {
					$image = wp_get_attachment_thumb_url( $thumbnail_id );
				} else {
					$image = wc_placeholder_img_src();
				}

				// Prevent esc_url from breaking spaces in urls for image embeds
				// Ref: http://core.trac.wordpress.org/ticket/23605
				$image = str_replace( ' ', '%20', $image );

				$columns .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr__( 'Thumbnail', 'hcode-addons' ) . '" class="wp-post-image" height="48" width="48" />';

			}

			return $columns;
		}

		public function hcode_brand_widget_include(){
			include_once( HCODE_ADDONS_ROOT.'/hcode-brand/hcode-brand-widget.php' );
			register_widget( 'Hcode_Brand_Addons_Widget' );
		}

} // end of class
$Hcode_Addons_Post_Type = new Hcode_Addons_Post_Type();
} // end of class_exists
?>