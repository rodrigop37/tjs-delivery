<?php
/**
 * Add new tab in product detail for WooCommerce.
 *
 * @package H-Code
 */
?>
<?php
if ( ! function_exists( 'hcode_custom_tab_options_tab' ) ) :
	function hcode_custom_tab_options_tab() {
	?>
		<li class="custom_tab wc-special-product"><a href="#custom_tab_data"><?php esc_html_e('Special Product', 'H-Code'); ?></a></li>
		<li class="custom_tab wc-washing-instruction"><a href="#washing_instruction"><?php esc_html_e('Washing Instructions', 'H-Code'); ?></a></li>
		<li class="custom_tab wc-sizes"><a href="#sizes_tab"><?php esc_html_e('Sizes', 'H-Code'); ?></a></li>
	<?php
	}
endif;
add_action('woocommerce_product_write_panel_tabs', 'hcode_custom_tab_options_tab'); 

if ( ! function_exists( 'hcode_custom_tab_options' ) ) :
	function hcode_custom_tab_options() {
		global $post;
		$hcode_feature_product_order = array(
			'hcode_feature_product_order' => get_post_meta($post->ID, 'hcode_feature_product_order', true),
		);
		$hcode_feature_product_shop = array(
			'hcode_feature_product_shop' => get_post_meta($post->ID, 'hcode_feature_product_shop', true),
		);
		$hcode_new_product_shop = array(
			'hcode_new_product_shop' => get_post_meta($post->ID, 'hcode_new_product_shop', true),
		);
	?>
	<div id="custom_tab_data" class="panel woocommerce_options_panel">
		<div class="options_group custom_tab_options">                								
			<p class="form-field">
				<label><?php esc_html_e('Order:', 'H-Code'); ?></label>
				<input type="text" name="hcode_feature_product_order" placeholder="<?php esc_html_e('Enter your Order', 'H-Code'); ?>" value="<?php echo $hcode_feature_product_order['hcode_feature_product_order']; ?>">
			</p>
			<p class="form-field">
				<label><?php esc_html_e('Feature:', 'H-Code'); ?></label>
				<?php 
					$features_prod=$hcode_feature_product_shop['hcode_feature_product_shop'];
				?>
				<select name="hcode_feature_product_shop" class="hcode_feature_product" id="feature_product">
					<option value="">Select One</option>
					<option value="yes" <?php echo $f_prod=($features_prod=='yes') ? 'selected' : '' ?>>Yes</option>
					<option value="no" <?php echo $f_prod=($features_prod=='no') ? 'selected' : '' ?>>No</option>
				</select>
			</p>
			<p class="form-field">
				<label><?php esc_html_e('New Product:', 'H-Code'); ?></label>
				<?php 
					$new_prod=$hcode_new_product_shop['hcode_new_product_shop'];
				?>
				<select name="hcode_new_product_shop" class="hcode_feature_product" id="new_product">
					<option value="">Select One</option>
					<option value="yes" <?php echo $f_prod=($new_prod=='yes') ? 'selected' : '' ?>>Yes</option>
					<option value="no" <?php echo $f_prod=($new_prod=='no') ? 'selected' : '' ?>>No</option>
				</select>
			</p>
	    </div>	
	</div>
	<?php
	}
endif;
add_action('woocommerce_product_write_panels', 'hcode_custom_tab_options');

if ( ! function_exists( 'hcode_sizes_tab' ) ) :
	function hcode_sizes_tab() {
		global $post;
	    $hcode_size_tab = '';
	    $meta_size_tab = get_post_meta($post->ID, 'hcode_product_tabs_options', true);   
	    if(isset($meta_size_tab[0]['hcode_size_tab'])):
	    	$breaks = array("<br />","<br>","<br/>");
	    	$hcode_size_tab = ( $meta_size_tab[0]['hcode_size_tab'] ) ? str_ireplace($breaks, " ",$meta_size_tab[0]['hcode_size_tab']) : '';
		endif;
	?>
	<div id="sizes_tab" class="panel woocommerce_options_panel">
		<div class="options_group custom_tab_options">
			<p class="form-field">
				<label><?php esc_html_e('Sizes Description:', 'H-Code'); ?></label>
				<textarea class="theEditor" rows="10" cols="40" name="hcode_size_tab" placeholder="<?php esc_html_e('Enter your sizes content', 'H-Code'); ?>" style="height:250px"><?php echo $hcode_size_tab; ?></textarea>
			</p>
	    </div>
	</div>
	<?php
	}
endif;
add_action('woocommerce_product_write_panels', 'hcode_sizes_tab');

if ( ! function_exists( 'hcode_washing_instruction' ) ) :
	function hcode_washing_instruction() {
		global $post;
		$hcode_washing_instruction = '';
	    $metabox_washing_instruction = get_post_meta($post->ID, 'hcode_product_tabs_options', true);
	    if(isset($metabox_washing_instruction[0]['hcode_washing_instruction'])):
	    	$breaks = array("<br />","<br>","<br/>");
	    	$hcode_washing_instruction = ( $metabox_washing_instruction[0]['hcode_washing_instruction'] ) ? str_ireplace($breaks, " ", $metabox_washing_instruction[0]['hcode_washing_instruction']) : '';
		endif;
	?>
	<div id="washing_instruction" class="panel woocommerce_options_panel">
		<div class="options_group custom_tab_options">                								
			<p class="form-field">
				<label><?php esc_html_e('Washing Instruction:', 'H-Code'); ?></label>
				<textarea class="theEditor" rows="10" cols="40" name="hcode_washing_instruction" placeholder="<?php esc_html_e('Enter your washing instruction', 'H-Code'); ?>" style="height:250px"><?php echo $hcode_washing_instruction; ?></textarea>
			</p>
	    </div>	
	</div>
	<?php
	}
endif;
add_action('woocommerce_product_write_panels', 'hcode_washing_instruction');

if ( ! function_exists( 'hcode_process_product_meta_custom_tab' ) ) :
	function hcode_process_product_meta_custom_tab( $post_id ) {
	    
		update_post_meta( $post_id, 'hcode_feature_product_order', $_POST['hcode_feature_product_order']);
		update_post_meta( $post_id, 'hcode_feature_product_shop', $_POST['hcode_feature_product_shop']);
	        
	    /* field array */
	    $data_args = $options_value = array();
	        
		/* sizes */
	    if( $_POST['hcode_size_tab'] ):
	        $data_args['hcode_size_tab'] = stripslashes(nl2br($_POST['hcode_size_tab']));
	        update_post_meta( $post_id, 'hcode_size_tab',  $_POST['hcode_size_tab']);
	    endif;

		/* washing instruction */
	    if( $_POST['hcode_washing_instruction'] ):
	        update_post_meta( $post_id, 'hcode_washing_instruction', serialize( $_POST['hcode_washing_instruction']) );
	        $data_args['hcode_washing_instruction'] = stripslashes( nl2br($_POST['hcode_washing_instruction']) );
	    endif;
	        
	    $options_value[] = $data_args;
	    update_post_meta($post_id, 'hcode_product_tabs_options', $options_value);
	}
endif;
add_action('woocommerce_process_product_meta', 'hcode_process_product_meta_custom_tab');
?>