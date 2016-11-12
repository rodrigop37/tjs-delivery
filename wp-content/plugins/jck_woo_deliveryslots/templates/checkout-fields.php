<?php if( !empty( $fields ) ) { ?>

    <div id="jckwds-fields" <?php if( !$active ) echo 'class="jckwds-fields-inactive"'; ?>>

        <h3><?php _e('Delivery Details', 'jckwds'); ?></h3>

        <?php do_action('jckwds_after_delivery_details_title'); ?>

        <?php foreach( $fields as $field_name => $field_data ) { ?>

            <div id="<?php echo $field_name; ?>-wrapper">

                <?php $field_data = apply_filters('jckwds_checkout_field_data', $field_data); ?>

                <?php woocommerce_form_field( $field_name, $field_data['field_args'], $field_data['value'] ); ?>

            </div>

        <?php } ?>

        <?php do_action('jckwds_after_delivery_details_fields'); ?>

    </div>

<?php } ?>