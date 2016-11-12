<?php
/*
Plugin Name: WooCommerce Delivery Slots
Plugin URI: https://iconicwp.com
Description: Allow your customers to select a delivery slot for their order
Version: 1.7.2
Author: Iconic
Author Email: support@iconicwp.com
Text Domain: jckwds
*/

class jckWooDeliverySlots {

    public $name = 'WooCommerce Delivery Slots';
    public $shortname = 'Delivery Slots';
    public $slug = 'jckwds';
    public $version = "1.7.2";
    public $db_version = "1.6";
    public $plugin_path;
    public $plugin_url;
    public $settings_framework;
    public $settings;
    public $guest_user_id_cookie_name = "jckwds-guest-user-id";
    public $option_group;
    public $user_id;
    public $timeslot_meta_key = "jckwds_timeslot";
    public $date_meta_key = "jckwds_date";
    public $timestamp_meta_key = "jckwds_timestamp";
    public $reservations_db_table_name;
    public $timeslot_data_transient_name;
    public $current_timestamp;
    public $current_day_number;
    public $current_ymd;
    public $timeslots_allowed_for_postcode = array();
    public $holidays_formatted = array();

    /**
     * Available shipping methods
     */
    public $shipping_methods = array();

    /**
     * Constructor
     */
    public function __construct() {

        if( !$this->is_plugin_active( 'woocommerce/woocommerce.php') )
            return;

        // check PHP version
        if (version_compare(PHP_VERSION, '5.3.0') < 0) {
            add_action( 'admin_notices', array( $this, 'php_version_error' ) );
            return false;
        }

        $this->setup_constants();

        // register an activation hook for the plugin
        register_activation_hook( __FILE__, array( $this, 'install' ) );

        // Hook up to the init action
        add_action( 'init', array( $this, 'initiate' ) );
    }

    /**
     * Setup Constants
     */
    public function setup_constants() {

        global $wpdb;

        $this->plugin_path = plugin_dir_path( __FILE__ );
        $this->plugin_url = plugin_dir_url( __FILE__ );
        $this->reservations_db_table_name = $wpdb->prefix . $this->slug;
        $this->timeslot_data_transient_name = sprintf('%s-timeslot-data', $this->slug);
        $this->current_timestamp = current_time('timestamp');
        $this->current_day_number = current_time('w');
        $this->current_ymd = current_time('Ymd');

    }

    /**
     * PHP Version Error Message
     */
    public function php_version_error() {

        $class = "error";
        $message = sprintf(__("You need to be running PHP 5.3+ for Delivery Slots to work. You're on %s.", 'jckwds'), PHP_VERSION);

        echo '<div class="error"><p>'.$message.'</p></div>';

    }

    /**
     * Runs when the plugin is activated
     */
    public function install() {

        $this->install_reservations_db();

    }

    /**
     * Install the reservations database table
     */
    private function install_reservations_db() {

        global $wpdb;

        $installed_ver = get_option( $this->slug."_db_version" );

        if( $installed_ver != $this->db_version ) {

            $sql = "CREATE TABLE {$this->reservations_db_table_name} (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            datetimeid text,
            processed tinyint(1),
            order_id mediumint(9),
            user_id text,
            expires text,
            date datetime,
            starttime mediumint(9),
            endtime mediumint(9),
            UNIQUE KEY id (id)
            );";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            update_option( $this->slug."_db_version", $this->db_version );

        }

    }

    /**
     * Runs when the plugin is initialized
     */
    public function initiate() {

        // Setup localization
        load_plugin_textdomain( 'jckwds', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

        // Settings framework
        $this->load_settings_framework();

        // Setup user
        $this->set_user_id();

        if ( is_admin() ) {

            // Add WordPress Admin Menu
            add_action( 'admin_menu',                                            array( $this, 'setup_settings_page' ) );
            add_action( 'admin_menu',                                            array( $this, 'setup_deliveries_page' ) );
            add_filter( 'option_page_capability_'.$this->option_group,           array( $this, 'option_page_capability' ) );

            // Validate Settings
            add_filter( $this->option_group .'_settings_validate',               array( $this, 'validate_settings' ), 10, 1 );

            // Ajax Functions
            add_action( 'wp_ajax_'.$this->slug.'_reserve_slot',                  array( $this, 'ajax_reserve_slot' ) );
            add_action( 'wp_ajax_nopriv_'.$this->slug.'_reserve_slot',           array( $this, 'ajax_reserve_slot' ) );
            add_action( 'wp_ajax_'.$this->slug.'_remove_reserved_slot',          array( $this, 'ajax_remove_reservation' ) );
            add_action( 'wp_ajax_nopriv_'.$this->slug.'_remove_reserved_slot',   array( $this, 'ajax_remove_reservation' ) );
            add_action( 'wp_ajax_'.$this->slug.'_slots_on_date',                 array( $this, 'ajax_slots_on_date' ) );
            add_action( 'wp_ajax_nopriv_'.$this->slug.'_slots_on_date',          array( $this, 'ajax_slots_on_date' ) );
            add_action( 'wp_ajax_'.$this->slug.'_get_upcoming_bookable_dates',                 array( $this, 'ajax_get_upcoming_bookable_dates' ) );
            add_action( 'wp_ajax_nopriv_'.$this->slug.'_get_upcoming_bookable_dates',          array( $this, 'ajax_get_upcoming_bookable_dates' ) );

            // Shop Order functions
            add_filter( 'manage_edit-shop_order_columns',                        array( $this, 'shop_order_columns' ) );
            add_action( 'manage_shop_order_posts_custom_column',                 array( $this, 'render_shop_order_columns' ), 2 );
            add_filter( 'manage_edit-shop_order_sortable_columns',               array( $this, 'sortable_shop_order_columns' ) );
            add_filter( 'request',                                               array( $this, 'orderby_shop_order_columns' ) );

            add_action( 'woocommerce_admin_order_data_after_billing_address',    array( $this, 'display_admin_order_meta' ), 10, 1 );
            add_action( 'woocommerce_cancelled_order', array( $this, 'cancel_order' ), 10, 1 );
            add_action( 'deleted_post', array( $this, 'cancel_order' ), 10, 1 );
            add_action( 'wc-cancelled_shop_order', array( $this, 'cancel_order' ), 10, 1 );

        } else {

            add_action( 'wp_enqueue_scripts',                                    array( $this, 'register_scripts_and_styles' ) );
            add_action( 'wp_head',                                               array( $this, 'dynamic_css' ) );

            add_shortcode( 'jckwds',                                             array( $this, 'reservation_table_shortcode' ) );

        }

        add_action( 'transition_post_status',  array( $this, 'status_transition' ), 10, 3 );

        // WooCommerce Actions and Hooks

        // greater than 2.3.0
        if( version_compare($this->get_woo_version_number(), '2.3.0') >= 0 ) {

            add_filter( 'woocommerce_email_order_meta', array( $this, 'email_order_delivery_details' ), 10, 4 );

        // less than 2.3.0
        } else {

            add_filter( 'woocommerce_email_order_meta_keys', array( $this, 'email_order_meta_keys' ) );

        }

        // Save values to order
        add_action( 'woocommerce_checkout_update_order_meta',                array( $this, 'update_order_meta' ) );
        // Checkout field validation
        add_action( 'woocommerce_checkout_process',                          array( $this, 'validate_checkout_fields' ) );
        // Show on order detail page (frontend)
        add_action( 'woocommerce_order_details_after_order_table',           array( $this, 'frontend_order_timedate' ) );
        // Add fee at checkout, if required
        add_action( 'woocommerce_checkout_update_order_review',              array( $this, 'check_fee'), 10 );
        // Add fee
        add_action( 'woocommerce_cart_calculate_fees',                       array( $this, 'add_timeslot_fee' ), 10 );

        $this->position_checkout_fields();

    }

    /**
     * Load settings framework
     */
    public function load_settings_framework() {

        require_once( $this->plugin_path .'inc/admin/wp-settings-framework/wp-settings-framework.php' );

        $this->option_group = $this->slug;

        $this->settings_framework = new WordPressSettingsFramework( $this->plugin_path .'inc/admin/settings.php', $this->option_group );

        $this->transition_settings();

        $this->settings = wpsf_get_settings( $this->option_group );

    }

    /**
     * Transition settings
     */
    public function transition_settings() {

        $new_settings = get_option('jckwds_settings');
        $old_settings = get_option('jckdeliveryslots_settings');

        if( !$new_settings && $old_settings ) {

            $old_settings_formatted = array();

            foreach( $old_settings as $setting_name => $value ) {

                $old_settings_formatted[$setting_name] = $value;

                if( $setting_name === "timesettings_timesettings_timeslots" ) {

                    if( !empty( $value ) ) {
                        foreach( $value as $index => $timeslot ) {

                            $old_settings_formatted[$setting_name][$index]['timefrom'] = $timeslot['timefrom']['time'];
                            $old_settings_formatted[$setting_name][$index]['timeto'] = $timeslot['timeto']['time'];

                        }
                    }

                }

                if( $setting_name === "holidays_holidays_holidays" ) {

                    if( !empty( $value ) ) {
                        foreach( $value as $index => $holiday ) {

                            $old_settings_formatted[$setting_name][$index]['date'] = $holiday['date']['date'];

                        }
                    }

                }

                if( $setting_name === "datesettings_datesettings_sameday_cutoff" || $setting_name === "datesettings_datesettings_nextday_cutoff" ) {

                    if( !empty( $value ) ) {
                        $old_settings_formatted[$setting_name] = $value['time'];
                    }

                }

            }

            update_option('jckwds_settings', $old_settings_formatted);

        }

    }

    /**
     * Admin: Add settings menu item
     */
    public function setup_settings_page() {

        $this->settings_framework->add_settings_page( array(
            'parent_slug' => 'woocommerce',
            'page_title' => $this->name,
            'menu_title' => $this->shortname,
            'capability' => 'manage_woocommerce'
        ) );

    }

    /**
     * Admin: Allow shop managers to save options
     */
    function option_page_capability( $capability ) {

        return 'manage_woocommerce';

    }

    /**
     * Admin: Setup Deliveries page
     */
    public function setup_deliveries_page() {

        $deliveriesPage = add_submenu_page( 'woocommerce', __('Deliveries', 'jckwds'), __('Deliveries', 'jckwds'), 'manage_woocommerce', $this->slug.'-deliveries', array( $this, 'deliveries_page_display' ) );

        if(isset($_GET['page']) && $_GET['page'] == $this->slug.'-deliveries'){

            // woo styles
            wp_enqueue_style( 'admin_enqueue_styles-'.$deliveriesPage, WC()->plugin_url() . '/assets/css/admin.css', array(), WC_VERSION );

            // woo scripts register
            wp_register_script( 'woocommerce_admin', WC()->plugin_url() . '/assets/js/admin/woocommerce_admin.min.js', array( 'jquery', 'jquery-blockui', 'jquery-ui-sortable', 'jquery-ui-widget', 'jquery-ui-core', 'jquery-tiptip' ), WC_VERSION );
            wp_register_script( 'jquery-tiptip', WC()->plugin_url() . '/assets/js/jquery-tiptip/jquery.tipTip.min.js', array( 'jquery' ), WC_VERSION, true );

            // woo scripts enqueue
            wp_enqueue_script( 'jquery-tiptip' );
            wp_enqueue_script( 'woocommerce_admin' );

        }

    }

    /**
     * Admin: Display Deliveries page
     */
    public function deliveries_page_display() {

        if ( !current_user_can( 'manage_woocommerce' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.', 'jckwds' ) );
        }

        require_once('inc/admin/deliveries.php');

    }

    /**
     * Frontend: Position the checkout fields
     */
    public function position_checkout_fields() {

        add_action( $this->settings['general_setup_position'], array( $this, 'display_checkout_fields' ), $this->settings['general_setup_position_priority'] );

    }

	/**
     * Helper: Get all reservations
     *
     * @param int $processed 1/0
     * @param str $operator
     * @param str $order
     * @return arr
	 */
    public function get_reservations($processed = 1, $operator = '>=', $order = 'ASC'){

        global $wpdb;

        $return = array(
            'processed' => $processed,
            'results' => $wpdb->get_results( "
            SELECT * FROM {$this->reservations_db_table_name}
            WHERE date $operator CURDATE()
            AND processed = $processed
            ORDER BY date $order, starttime ASC
            ", OBJECT )
        );

        return $return;

    }

    /**
     * Helper: Format reservations in an array, ready for displaying
     *
     * @param arr $reservations
     * @return arr
     */
    public function format_reservations_for_display($reservations) {

        $timeFormat = $this->settings['timesettings_timesettings_setup_timeformat'];

        $reservations_array = array();

        foreach($reservations['results'] as $key => $reservation) {

            if( $reservation->order_id ) {

                // get the order details, if an id is set
                $order = new WC_Order( $reservation->order_id );

                // if the order is x, don't show it
                if(
                    $order->status == 'completed' ||
                    $order->status == 'cancelled' ||
                    $order->status == 'failed' ||
                    $order->status == 'refunded' ||
                    $order->status == 'trash'
                ) { continue; }

            }

            /* Setup array */
            $reservations_array[$key] = array(
                'date' => '',
                'starttime' => false,
                'endtime' => false,
                'has_order' => false,
                'order_id' => '',
                'order_link' => '',
                'order_shipping_address' => '',
                'order_status' => '',
                'user_id' => '',
                'user_name' => '',
                'user_email' => ''
            );

            /* Order */
            if($reservation->order_id){

                $reservations_array[$key]['has_order'] = true;
                $reservations_array[$key]['order_status'] = '<mark data-tip="'.esc_attr($order->status).'" class="'.esc_attr($order->status).' tips">'.$order->status.'</mark>';
                $reservations_array[$key]['order_id'] = $reservation->order_id;
                $reservations_array[$key]['order_link'] = '<a href="'.admin_url('post.php?post='.$reservation->order_id.'&action=edit').'" target="_blank">#'.$reservation->order_id.'</a>';

                $stripped_and_formatted_shipping_address = preg_replace( '#<br\s*/?>#i', ', ', $order->get_formatted_shipping_address() );

                $reservations_array[$key]['order_shipping_address'] = '<a target="_blank" href="' . esc_url( 'http://maps.google.com/maps?&q=' . urlencode( $stripped_and_formatted_shipping_address ) . '&z=16' ) . '">'. esc_html( $stripped_and_formatted_shipping_address ) .'</a>';

                /* user */
                $reservations_array[$key]['user_name'] = ($order->billing_first_name && $order->billing_first_name != "") ? $order->billing_first_name.' '.$order->billing_last_name : "";
                $reservations_array[$key]['user_email'] = '<a href="mailto:'.esc_attr($order->billing_email).'" target="_blank">'.$order->billing_email.'</a>';

            }

            /* Date */
            $date = new DateTime($reservation->date);
            $reservations_array[$key]['date'] = '<strong>'.$date->format('l jS, M').'</strong>';

            /* Starttime */
            if( $reservation->starttime ) {
                $starttime = DateTime::createFromFormat('Hi', str_pad($reservation->starttime, 4, "0", STR_PAD_LEFT));
                $reservations_array[$key]['starttime'] = $starttime->format($timeFormat);
            }

            /* Endtime */
            if( $reservation->endtime ) {
                $endtime = DateTime::createFromFormat('Hi', str_pad($reservation->endtime, 4, "0", STR_PAD_LEFT));
                $reservations_array[$key]['endtime'] = $endtime->format($timeFormat);
            }

            /* User */
            if( is_numeric($reservation->user_id) && !$reservation->order_id ) {

                $reservations_array[$key]['user_id'] = $reservation->user_id;
                $customer = get_userdata( $reservation->user_id );
                $reservations_array[$key]['user_name'] = ($customer->first_name && $customer->first_name != "") ? $customer->first_name.' '.$customer->last_name: $customer->user_login;
                $reservations_array[$key]['user_email'] = '<a href="mailto:'.esc_attr($customer->user_email).'" target="_blank">'.$customer->user_email.'</a>';

            }

        }

        return $reservations_array;

    }

    /**
     * Helper: Display reservations in a table
     *
     * @param arr $reservations
     */
	public function reservations_layout($reservations){

		if(!is_array($reservations['results']) || empty($reservations['results'])) {
			if($reservations['processed']){
				echo '<p>'.__('There are currently no upcoming deliveries.', 'jckwds').'</p>';
			} else {
				echo '<p>'.__('There are currently no active reservations.', 'jckwds').'</p>';
			}
			return;
		}

		$reservations_array = $this->format_reservations_for_display($reservations);

        // table layout

        echo '<table class="wp-list-table widefat fixed" cellspacing="0">';

            echo '<thead>';
                echo '<tr>';
                    if($reservations['processed']) echo '<th id="order_status" class="manage-column column-order_status" scope="col"><span data-tip="'.esc_attr__('Status', $this->slug).'" class="status_head tips">'.__('Status', $this->slug).'</span></th>';
                    echo '<th scope="col">'.__('Date', $this->slug).'</th>';
                    echo '<th scope="col">'.__('Time Slot', $this->slug).'</th>';
                    if($reservations['processed']) echo '<th scope="col">'.__('Order #', $this->slug).'</th>';
                    if($reservations['processed']) echo '<th scope="col">'.__('Order Overview', $this->slug).'</th>';
                    echo '<th scope="col">'.__('Customer Name', $this->slug).'</th>';
                    echo '<th scope="col">'.__('Customer Email', $this->slug).'</th>';
                echo '</tr>';
            echo '</thead>';

            echo '<tbody>';
                $row_i = 0; foreach($reservations_array as $reservation){
                $rowClass = ($row_i%2 == 0) ? 'alternate' : '';
                echo '<tr class="'.esc_attr($rowClass).'">';
                    if($reservations['processed']) echo '<td class="order_status column-order_status">'.$reservation['order_status'].'</td>';
                    echo '<td>'.$reservation['date'].'</td>';
                    echo '<td>'.$reservation['starttime'].' &mdash; '.$reservation['endtime'].'</td>';
                    if($reservations['processed']) echo '<td>'.$reservation['order_link'].'</td>';
                    if($reservations['processed']) echo '<td>'.$reservation['order_shipping_address'].'</td>';
                    echo '<td>'.$reservation['user_name'].'</td>';
                    echo '<td>'.$reservation['user_email'].'</td>';
                echo '</tr>';
                $row_i++; }
            echo '<tbody>';

        echo '</table>';

    }

    /**
     * Admin: Validate Settings
     *
     * @param arr $settings Un-validated settings
     * @return arr $validated_settings
     */
    public function validate_settings( $settings ) {

        // validate cutoff

        if( isset( $settings['timesettings_timesettings_cutoff'] ) ) {

            if( $settings['timesettings_timesettings_cutoff'] < 0 || !is_numeric( $settings['timesettings_timesettings_cutoff'] ) ) {

                $settings['timesettings_timesettings_cutoff'] = 0;

                $message = __( '"Allow Bookings Up To (x) Minutes Before Slot" should be a positive integer. It has defaulted to 0.', 'jckwds' );

                add_settings_error( 'timesettings_timesettings_cutoff', esc_attr( 'jckwds-error' ), $message, 'error' );

            }

        }

        // validate same day cutoff

        if( isset( $settings['datesettings_datesettings_sameday_cutoff'] ) ) {

            if( $settings['datesettings_datesettings_sameday_cutoff'] != "" && !$this->validate_time_format( $settings['datesettings_datesettings_sameday_cutoff'] ) ) {

                $settings['datesettings_datesettings_sameday_cutoff'] = "";

                $message = __( 'The Same Day cutoff should be a valid time format (00:00), try using the time picker instead.', 'jckwds' );

                add_settings_error( 'datesettings_datesettings_sameday_cutoff', esc_attr( 'jckwds-error' ), $message, 'error' );

            }

        }

        // validate next day cutoff

        if( isset( $settings['datesettings_datesettings_nextday_cutoff'] ) ) {

            if( $settings['datesettings_datesettings_nextday_cutoff'] != "" && !$this->validate_time_format( $settings['datesettings_datesettings_nextday_cutoff'] ) ) {

                $settings['datesettings_datesettings_nextday_cutoff'] = "";

                $message = __( 'The Next Day cutoff should be a valid time format (00:00), try using the time picker instead.', 'jckwds' );

                add_settings_error( 'datesettings_datesettings_nextday_cutoff', esc_attr( 'jckwds-error' ), $message, 'error' );

            }

        }

        // validate timeslots

        if( $settings['timesettings_timesettings_setup_enable'] ) {

            if( is_array($settings['timesettings_timesettings_timeslots']) ) {

                $default_cutoff = "";
                $default_lockout = 10;
                $cutoff_numeric = true;
                $lockout_numeric = true;
                $empty_days = false;
                $valid_time_format = true;

                $i = 0; foreach( $settings['timesettings_timesettings_timeslots'] as $timeslot ) {

                    // validate cutoff

                    if( isset( $timeslot['cutoff'] ) ) {

                        if( !empty( $timeslot['cutoff'] ) && ( $timeslot['cutoff'] <= 0 || !is_numeric( $timeslot['cutoff'] ) ) ) {

                            $settings['timesettings_timesettings_timeslots'][$i]['cutoff'] = $default_cutoff;

                            $cutoff_numeric = false;

                        }

                    }

                    // validate lockout

                    if( isset( $timeslot['lockout'] ) ) {

                        if( $timeslot['lockout'] <= 0 || !is_numeric( $timeslot['lockout'] ) ) {

                            $settings['timesettings_timesettings_timeslots'][$i]['lockout'] = $default_lockout;

                            $lockout_numeric = false;

                        }

                    }

                    // validate days

                    if( isset( $timeslot['days'] ) && $timeslot['days'] == "" ) {

                        $settings['timesettings_timesettings_timeslots'][$i]['days'] = array(0,1,2,3,4,5,6);

                        $empty_days = true;

                    }

                    // validate time formats

                    if( isset( $timeslot['timefrom'] ) ) {

                        $validated_time_format = $this->validate_time_format($timeslot['timefrom']);

                        if( $validated_time_format == false ) {

                            $settings['timesettings_timesettings_timeslots'][$i]['timefrom'] = '01:00';

                            $valid_time_format = false;

                        }

                    }

                    if( isset( $timeslot['timeto'] ) ) {

                        $validated_time_format = $this->validate_time_format($timeslot['timeto']);

                        if( $validated_time_format == false ) {

                            $settings['timesettings_timesettings_timeslots'][$i]['timeto'] = '23:00';

                            $valid_time_format = false;

                        }

                    }

                $i++; }

                // validate cutoff

                if( !$cutoff_numeric ) {

                    $message = __( 'The "Allow Bookings Up To (x) Minutes Before Slot" time slot setting should be a positive integer. It has been removed.', 'jckwds' );

                    add_settings_error( 'timesettings_timesettings_timeslots_cutoff', esc_attr( 'jckwds-error' ), $message, 'error' );

                }

                // validate lockout

                if( !$lockout_numeric ) {

                    $message = __( 'The "Lockout After" time slot setting should be a positive integer. It has defaulted to 10.', 'jckwds' );

                    add_settings_error( 'timesettings_timesettings_timeslots_lockout', esc_attr( 'jckwds-error' ), $message, 'error' );

                }

                // validate days

                if( $empty_days ) {

                    $message = __( 'You should select at least one active day for your time slot. All days have now been selected.', 'jckwds' );

                    add_settings_error( 'timesettings_timesettings_timeslots_days', esc_attr( 'jckwds-error' ), $message, 'error' );

                }

                // validate time format

                if( !$valid_time_format ) {

                    $message = __( 'One of the time slots you entered had an invalid format. Try using the time picker instead. A default has been added in its place.', 'jckwds' );

                    add_settings_error( 'timesettings_timesettings_timeslots_format', esc_attr( 'jckwds-error' ), $message, 'error' );

                }


            }

        }

        // clear transients

        delete_transient( $this->timeslot_data_transient_name );

        return $settings;

    }

    /**
     * Helper: Validate Time Format
     *
     * @param str $time
     * @return bool
     */
    public function validate_time_format( $time ) {

        if( $time === false || $time == "" )
            return false;

        if ( preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", $time) == false )
            return false;

        return true;

    }

	/**
	 * Helper: Get Checkout fields data
     *
     * @return arr
	 */
    public function get_checkout_fields_data() {

        $fields = array();
        $reserved = $this->get_reserved_slot();

        $fields['jckwds-delivery-date'] = array(
            'value' => '',
            'field_args' => array(
                'type' => 'text',
                'label' => __('Delivery Date', 'jckwds'),
                'required' => $this->settings['datesettings_datesettings_setup_mandatory'],
                'class' => array('jckwds-delivery-date', 'form-row-wide'),
                'placeholder' => __('Select a delivery date', 'jckwds'),
                'custom_attributes' => array( 'readonly' => 'true' ),
                'description' => $this->settings['datesettings_datesettings_setup_show_description'] ? __('Please choose a date for your delivery.', 'jckwds') : false
            )
        );

        if( $reserved ) {
            $fields['jckwds-delivery-date']['value'] = $reserved['date']['formatted'];
        }

        if( $this->settings['timesettings_timesettings_setup_enable'] ) {

            $fields['jckwds-delivery-time'] = array(
                'value' => '',
                'field_args' => array(
                    'type' => 'select',
                    'label' => __('Time Slot', 'jckwds'),
                    'required' => $this->settings['timesettings_timesettings_setup_mandatory'],
                    'class' => array('jckwds-delivery-time', 'form-row-wide'),
                    'options' => array(
                        0 => __('Please select a date first...', 'jckwds')
                    ),
                    'description' => $this->settings['timesettings_timesettings_setup_show_description'] ? __('Please choose a time slot for your delivery.', 'jckwds') : false
                )
            );

            if( $reserved ) {

                $fields['jckwds-delivery-time']['value'] = $this->get_timeslot_value( $reserved['time'] );
                $fields['jckwds-delivery-time']['field_args']['class'][] = "jckwds-delivery-time--has-reservation";
                $fields['jckwds-delivery-time']['field_args']['options'][0] = __('Please select a time slot...', 'jckwds');

                $available_slots = $this->slots_available_on_date( $reserved['date']['id'] );

                if( $available_slots && !empty( $available_slots ) ) {
                    foreach( $available_slots as $available_slot ) {
                        $fields['jckwds-delivery-time']['field_args']['options'][$available_slot['value']] = $available_slot['formatted_with_fee'];
                    }
                }

            }

        }

        return $fields;

    }

    /**
     * Helper: Get timeslot select value
     *
     * Format a timeslot for use in a select field
     *
     * @param arr $timeslot
     * @return str
     */

        public function get_timeslot_value( $timeslot ) {
            return sprintf( '%d|%01.2f', $timeslot['id'], $timeslot['fee']['value'] == "" ? 0 : $timeslot['fee']['value'] );
        }

    /**
     * Frontend: Display the checkout fields
     */
    public function display_checkout_fields( $checkout ) {

        $fields = $this->get_checkout_fields_data();
        $active = $this->is_active_for_current_shipping_method();

        include('templates/checkout-fields.php');

    }

    /**
     * Helper: Check if date/time fields should be active
     * for the current shipping method
     */
    public function is_active_for_current_shipping_method() {

        $chosen_shipping = $this->get_chosen_shipping_method();

        $allowed_methods = $this->settings['general_setup_shipping_methods'];

        if( $allowed_methods && !empty( $allowed_methods ) ) {

            if( in_array('any', $allowed_methods) ) { return true; }

            foreach( $allowed_methods as $allowed_method ) {

                $allowed_method = str_replace('wc_shipping_', '', $allowed_method);

                if( $chosen_shipping == $allowed_method ) { return true; }

            }
        }

        return false;

    }

    /**
     * Helper: Validate the checkout fields on form submission
     */
    function validate_checkout_fields(){

        global $woocommerce;

        if( isset($_POST['jckwds-delivery-date'])) {

            // Check if set, if its not set add an error.

            if ((!$_POST['jckwds-delivery-date'] || $_POST['jckwds-delivery-date'] == '') && $this->settings['datesettings_datesettings_setup_mandatory']) {
                if( function_exists('wc_add_notice') ) {
                    wc_add_notice( __('Please select a valid delivery date.', 'jckwds'), 'error' );
                } else {
                    $woocommerce->add_error( __('Please select a valid delivery date.', 'jckwds') );
                }
            }

        }

        if( isset($_POST['jckwds-delivery-time'])) {

            $timeslot_id = $this->extract_timeslot_id_from_option_value( $_POST['jckwds-delivery-time'] );

            // Check if set, if its not set add an error.

            if( !is_numeric($timeslot_id) && $this->settings['timesettings_timesettings_setup_mandatory'] ) {
                if( function_exists('wc_add_notice') ) {
                    wc_add_notice( __('Please select a time slot.', 'jckwds'), 'error' );
                } else {
                    $woocommerce->add_error( __('Please select a time slot.', 'jckwds') );
                }
            }

        }

    }

    /**
     * Helper: Update order meta on successful checkout submission
     *
     * @param str $order_id
     */
    function update_order_meta( $order_id ) {

        $date = false;
        $timeslot = false;

        if( isset($_POST['jckwds-delivery-date'])) {

            // add date data to the order

            if ($_POST['jckwds-delivery-date'] && $_POST['jckwds-delivery-date'] != '') {

                $date = $_POST['jckwds-delivery-date'];

                update_post_meta( $order_id, $this->date_meta_key, esc_attr(htmlspecialchars($date)));

            }

        }

        if( isset($_POST['jckwds-delivery-time'])) {

            $timeslot_id = $this->extract_timeslot_id_from_option_value( $_POST['jckwds-delivery-time'] );

            // add time data to the order

            if ( is_numeric( $timeslot_id ) ) {

                $timeslot = $this->get_timeslot_data( $timeslot_id );
                update_post_meta( $order_id, $this->timeslot_meta_key, esc_attr(htmlspecialchars($timeslot['formatted'])));

            }

        }

        if( $date ) {

            // update slot to processed
            if( $timeslot ) {

                $date_id = $this->convert_date_to_id( $date );
                $slot_id = sprintf('%s_%s', $date_id, $timeslot['id']);

                if( $this->has_reservation() ) {

                    $update = $this->update_reservation($slot_id, $order_id);

                } else {

                    $this->add_reservation(array(
                        'datetimeid' => $slot_id,
                        'date' => $this->convert_date_for_database( $date ),
                        'starttime' =>  $timeslot['timefrom']['stripped'],
                        'endtime' =>  $timeslot['timeto']['stripped'],
                        'order_id' => $order_id,
                        'processed' => 1
                    ));

                }

            } else {

                $this->add_reservation(array(
                    'date' => $this->convert_date_for_database( $date ),
                    'order_id' => $order_id,
                    'processed' => 1
                ));

            }

        }

        $this->add_timestamp_order_meta( $date, $timeslot, $order_id );

    }

    /**
     * Helper: Add timestamp order meta
     *
     * @param str $date d/m/Y
     * @param arr $timeslot get_timeslot_data()
     * @param int $order_id
     * @return bool
     */
    public function add_timestamp_order_meta( $date, $timeslot, $order_id ) {

        if( !$date )
            return false;

        $time = "10:00";

        if( $timeslot ) {
            $time = $timeslot['timefrom']['time'];
        }

        // add meta to order for "ordering"
        $datetime = DateTime::createFromFormat('d/m/Y H:i', sprintf('%s %s', $date, $time));

        if( !$datetime )
            return false;

        $timestamp = $datetime->getTimestamp();

        update_post_meta( $order_id, $this->timestamp_meta_key, $timestamp );

        return true;

    }

    /**
     * Helper: Display Date and Timeslot
     *
     * @param obj $order
     * @param bool $plain_text
     */
    public function display_date_and_timeslot( $order, $show_title = false, $plain_text = false ) {

        $date_time = $this->has_date_or_time( $order );

        if( !$date_time )
            return;

        if( $plain_text ) {

            echo "\n\n==========\n\n";

            if( $show_title ) {
                printf( "%s \n", strtoupper( __('Delivery Details', 'jckwds') ) );
            }

            if( $date_time['date'] ){
                printf( "\n%s: %s", __('Delivery Date', 'jckwds'), $date_time['date'] );
            }

            if( $date_time['time'] ){
                printf( "\n%s: %s", __('Time Slot', 'jckwds'), $date_time['time'] );
            }

            echo "\n\n==========\n\n";

        } else {

            if( $show_title ) {
                printf( '<h2>%s</h2>', __('Delivery Details', 'jckwds') );
            }

            if( $date_time['date'] ){
                printf( "<p><strong>%s</strong> <br>%s</p>", __('Delivery Date', 'jckwds'), $date_time['date'] );
            }

            if( $date_time['time'] ){
                printf( "<p><strong>%s</strong> <br>%s</p>", __('Time Slot', 'jckwds'), $date_time['time'] );
            }

        }

    }

    /**
     * Admin: Display date and timeslot on the admin order page
     *
     * @param obj $order
     */
    function display_admin_order_meta( $order ) {

        $this->display_date_and_timeslot( $order );

    }

    /**
     * Admin: Add Columns to orders tab
     *
     * @param arr $columns
     * @return arr
     */
    public function shop_order_columns( $columns ) {

        $columns['jckwds_delivery'] = __( 'Delivery', 'jckwds' );

        return $columns;

    }

    /**
     * Admin: Output date and timeslot columns on orders tab
     *
     * @param str $column
     */
    public function render_shop_order_columns( $column ) {

        global $post, $woocommerce, $the_order;

        if ( empty( $the_order ) || $the_order->id != $post->ID ) {
            $the_order = wc_get_order( $post->ID );
        }

        switch ( $column ) {
            case 'jckwds_delivery' :

                $this->display_date_and_timeslot( $the_order );

                break;
        }
    }

    /**
     * Admin: Make delivery column sortable
     */
    public function sortable_shop_order_columns( $columns ) {

        $columns['jckwds_delivery'] = 'jckwds_delivery';

        return $columns;

    }

    /**
     * Admin: Delivery columns orderby
     */
    public function orderby_shop_order_columns( $vars ) {

        if ( isset( $vars['orderby'] ) && 'jckwds_delivery' == $vars['orderby'] ) {

            $vars = array_merge( $vars, array(
                'meta_key' => 'jckwds_timestamp',
                'orderby' => 'meta_value_num'
            ));

        }

        return $vars;

    }

    /**
     * Frontend: Add date and timeslot to order email
     *
     * @param arr $keys
     * @return arr
     */
    public function email_order_meta_keys( $keys ) {

        $keys[__('Delivery Date', 'jckwds')] = $this->date_meta_key;
        $keys[__('Time Slot', 'jckwds')] = $this->timeslot_meta_key;

        return $keys;

    }

    /**
     * Frontend: Add date and timeslot to order email
     *
     * @param obj $order
     * @param bool $sent_to_admin
     * @param bool $plain_text
     * @param obj $email
     */
    function email_order_delivery_details( $order, $sent_to_admin, $plain_text, $email ) {

        if( !$this->has_date_or_time( $order ) )
            return;

        if( $plain_text ) {

            $this->display_date_and_timeslot( $order, true, true );

        } else {

            $this->display_date_and_timeslot( $order, true );

        }

    }

    /**
     * Helper: Check if order has date or time
     *
     * @param obj $order
     * @return bool
     */
    function has_date_or_time( $order ) {

        $meta = array(
            'date' => false,
            'time' => false
        );
        $has_meta = false;
        $date = get_post_meta( $order->id, $this->date_meta_key, true);
        $time = get_post_meta( $order->id, $this->timeslot_meta_key, true);

        if( ( $date && $date != "" ) ) {

            $meta['date'] = $date;
            $has_meta = true;

        }

        if( ( $time && $time != "" ) ) {

            $meta['time'] = $time;
            $has_meta = true;

        }

        if( $has_meta ) {
            return $meta;
        }

        return false;

    }

    /**
     * Frontend: Add date and timeslot to frontend order overview
     *
     * @param obj $order
     */
    function frontend_order_timedate( $order ){

        if( !$this->has_date_or_time( $order ) )
            return;

        $this->display_date_and_timeslot( $order, true );

    }

	/**
	 * Ajax: Get available timeslots
	 */
	function ajax_slots_on_date() {

		header('Content-Type: application/json');

		$response = array('success' => false, 'reservation' => false);

		$dateTime = DateTime::createFromFormat($this->date_format(), $_POST['date']);
		$ymd = $dateTime->format('Ymd');

		$timeslots = $this->slots_available_on_date($ymd);

		if( $timeslots ){

			$response['success'] = true;

			$response['html'] = '';

			$available_slots = array();

			foreach( $timeslots as $timeslot ) {

				if( $timeslot['available'] ) {

					$response['html'] .= '<option value="'.esc_attr($timeslot['value']).'">'.$timeslot['formatted_with_fee'].'</option>';
					$available_slots[] = $timeslot;

				}

			}

			$response['slots'] = $available_slots;

		}

		if( $reservation = $this->has_reservation() ) {

			$slot_id_exploded = explode('_', $reservation->datetimeid);
			$timeslot_id = $slot_id_exploded[1];
			$timeslot = $this->get_timeslot_data( $timeslot_id );

			$response['reservation'] = $timeslot['value'];

		}

		echo json_encode($response);

		die;

	}

	/**
	 * Ajax: Get upcoming bookable dates
	 */
    public function ajax_get_upcoming_bookable_dates() {

        $response = array(
            'success' => true,
            'bookable_dates' => $this->get_upcoming_bookable_dates("d/m/Y")
        );

        wp_send_json( $response );

    }

	/**
	 * Helper: Validate post code for slot
     *
     * Checkes whether a postcode is allowed for a specific time slot
     *
     * @param str $postcode
     * @param arr $slot
     * @return bool
	 */
    public function validate_slot_for_postcode( $postcode, $slot ) {

        if( !isset( $slot['postcodes'] ) || $slot['postcodes'] == "" )
            return true;

        $postcode = $this->format_postcode( $postcode );
        $allowed_postcodes = $this->format_postcode( $slot['postcodes'] );
        $allowed_postcodes = explode(',', $allowed_postcodes);

        $allowed = false;

        if( $allowed_postcodes && !empty( $allowed_postcodes ) ) {

            foreach( $allowed_postcodes as $allowed_postcode ) {

                if( strpos( $allowed_postcode, '*') !== false ) {

                    if( strpos( $postcode, str_replace('*', '', $allowed_postcode) ) === 0 ) {

                        $allowed = true;

                    }

                } elseif ( strpos($allowed_postcode,'-') !== false ) {

                    $range = explode("-", $allowed_postcode);
                    $range[0] = preg_replace('/\s+/', '', $range[0]);
                    $range[1] = preg_replace('/\s+/', '', $range[1]);

                    if($range[0] > $range[1]) {

                        if ( $postcode >= $range[1] && $postcode <= $range[0] ) {

                            $allowed = true;

                        }

                    } else {

                        if ( $postcode >= $range[0] && $postcode <= $range[1] ) {

                            $allowed = true;

                        }

                    }

                } else {

                    if( $postcode == $allowed_postcode ) {

                        $allowed = true;

                    }

                }

            }

        }

        return $allowed;

    }

    /**
     * Helper: Format postcode
     *
     * Remove spaces and whitespace so all postcodes are consistent for matching
     *
     * @param str $postcode
     * @return str
     */
    public function format_postcode( $postcode ) {

        return $this->strip_whitespace( strtolower( $postcode ) );

    }

    /**
     * Helper: Check if a timeslot is allowed postcode
     *
     * Remove spaces and whitespace so all postcodes are consistent for matching
     *
     * @param str $timeslot
     * @return bool
     */
    public function is_timeslot_allowed_for_postcode( $timeslot ) {

        if( isset( $this->timeslots_allowed_for_postcode[$timeslot['id']] ) ) {

            $allowed = $this->timeslots_allowed_for_postcode[$timeslot['id']];

        } else {

            $allowed = true;

            $shipping_destination = get_option( 'woocommerce_ship_to_destination' );

            $shipping_postcode = get_user_meta($this->user_id, 'shipping_postcode', true);
            if( !$shipping_postcode || $shipping_destination == "billing_only" ) $shipping_postcode = get_user_meta($this->user_id, 'billing_postcode', true);

            if( $shipping_postcode ) {
                $allowed = $this->validate_slot_for_postcode( $shipping_postcode, $timeslot );
            }

            if( isset( $_REQUEST['postcode'] ) && $_REQUEST['postcode'] != "" ) {
                $allowed = $this->validate_slot_for_postcode( $_REQUEST['postcode'], $timeslot );
            }

            $this->timeslots_allowed_for_postcode[$timeslot['id']] = $allowed;

        }

        return $allowed;

    }

    /**
     * Helper: Strip whitespace
     *
     * @param str $str
     * @return str
     */
    public function strip_whitespace( $str ) {

        return preg_replace('/\s+/', '', $str);

    }

    /**
     * Helper: Get formatted holidays
     *
     * @return arr
     */
    public function get_formatted_holidays() {

        if( !empty( $this->holidays_formatted ) )
            return $this->holidays_formatted;

        $holidays           = $this->settings['holidays_holidays_holidays'];
        $holidays_formatted = array();

        if( !empty( $holidays ) ){

            foreach( $holidays as $holiday ) {

                if( empty($holiday['date']) )
                    continue;

                $range = false;
                $holiday_from = DateTime::createFromFormat('d/m/Y', $holiday['date']);

                if( !empty($holiday['date_to']) ) {

                    $holiday_to = DateTime::createFromFormat('d/m/Y', $holiday['date_to']);

                    $range = $this->create_timestamp_range($holiday_from->getTimestamp(), $holiday_to->getTimestamp());

                }

                if( $range && !empty( $range ) ) {

                    foreach( $range as $timestamp ) {

                        $holidays_formatted[] = date_i18n('D, jS M', $timestamp);

                    }

                } else {

                    $holidays_formatted[] = date_i18n('D, jS M', $holiday_from->getTimestamp());

                }

            }

        }

        $this->holidays_formatted = $holidays_formatted;

        return $holidays_formatted;

    }

    /**
     * Helper: Get upcoming bookable dates
     *
     * @return arr
     */
    public function get_upcoming_bookable_dates( $format = "array" ) {

        $holidays        = $this->get_formatted_holidays();
        $min             = $this->get_minmax_delivery_date("min");
        $max             = $this->get_minmax_delivery_date("max");
        $date_range      = $this->create_timestamp_range($min['timestamp'], $max['timestamp']);
        $available_dates = array();
        $allow_same_day  = $this->is_same_day_allowed();
        $allow_next_day  = $this->is_next_day_allowed();

        foreach( $date_range as $timestamp ) {

            $date = date_i18n('D, jS M', $timestamp);
            $ymd = date_i18n('Ymd', $timestamp);
            $slots_available = $this->slots_available_on_date( $ymd );

            if( !in_array( $date, $holidays ) && ( !$this->settings['timesettings_timesettings_setup_enable'] || !empty($slots_available) ) && $allow_next_day !== $date && $allow_same_day !== $date ) {

                if( $format == "array" ) {

                    $available_dates[] = array(
                        "formatted"        => $date,
                        "header_formatted" => date_i18n($this->settings['reservations_reservations_dateformat'], $timestamp),
                        "timestamp"        => $timestamp,
                        "ymd"              => date_i18n('Ymd', $timestamp),
                        "weekday_number"   => date_i18n('w', $timestamp)
                    );

                } else {

                    $available_dates[] = date_i18n($format, $timestamp);

                }

            }

        }

        return $available_dates;

    }

    /**
     * Helper: Check if same day delivery is allowed
     *
     * @return mixed Returns true if allowed, or today's date if not
     */
    public function is_same_day_allowed() {

        $same_day_cutoff = isset( $this->settings['datesettings_datesettings_sameday_cutoff'] ) ? $this->settings['datesettings_datesettings_sameday_cutoff'] : "";

        if( empty( $same_day_cutoff ) )
            return true;

        $same_day_cutoff_formatted = DateTime::createFromFormat('Ymd H:i', sprintf('%s %s', $this->current_ymd, $same_day_cutoff));
        $in_past = ($this->current_timestamp >= $same_day_cutoff_formatted->getTimestamp()) ? true : false;

        if( $in_past ) {

            $todays_date = date_i18n('D, jS M', $this->current_timestamp);

            return $todays_date;

        } else {

            return true;

        }

    }

    /**
     * Helper: Check if next day delivery is allowed
     *
     * @return mixed Returns true if allowed, or tomorrow's date if not
     */
    public function is_next_day_allowed() {

        $next_day_cutoff = isset( $this->settings['datesettings_datesettings_nextday_cutoff'] ) ? $this->settings['datesettings_datesettings_nextday_cutoff'] : "";

        if( empty( $next_day_cutoff ) )
            return true;

        $next_day_cutoff_formatted = DateTime::createFromFormat('Ymd H:i', sprintf('%s %s', $this->current_ymd, $next_day_cutoff));
        $in_past = ($this->current_timestamp >= $next_day_cutoff_formatted->getTimestamp()) ? true : false;

        if( $in_past ) {

            $current_date = DateTime::createFromFormat('Ymd', $this->current_ymd);
            $tommorrows_date_timestamp = $current_date->add(new DateInterval("P1D"))->getTimestamp();
            $tommorrows_date = date_i18n('D, jS M', $tommorrows_date_timestamp);

            return $tommorrows_date;

        } else {

            return true;

        }

    }

    /**
     * Helper: Get allowed delivery date (x) days from now
     *
     * @param str $type min/max
     * @return arr timestamp, days_to_add
     */
    public function get_minmax_delivery_date( $type = "min" ) {

        $days = ($type == "min") ? $this->settings['datesettings_datesettings_minimum'] : $this->settings['datesettings_datesettings_maximum'];
        $mixmax_method = isset( $this->settings['datesettings_datesettings_minmaxmethod'] ) ? $this->settings['datesettings_datesettings_minmaxmethod'] : false;

        if( $type == "max" && $this->settings['datesettings_datesettings_week_limit'] ) {

            $last_day_of_week = strtotime(sprintf('next %s', $this->settings['datesettings_datesettings_last_day_of_week']), $this->current_timestamp);
            $difference = $last_day_of_week - $this->current_timestamp;
            $days_until_end_of_week = ceil($difference/60/60/24);

            $days_to_add = $days > $days_until_end_of_week ? $days_until_end_of_week : $days;

            return array(
                'days_to_add' => $days_to_add,
                'timestamp' => strtotime("+".$days_to_add." day", $this->current_timestamp)
            );

        }

        if( $mixmax_method == "all" ) {

            $allowed_days = array(
                0 => true,
                1 => true,
                2 => true,
                3 => true,
                4 => true,
                5 => true,
                6 => true
            );

        } elseif( $mixmax_method == "weekdays" ) {

            $allowed_days = array(
                0 => false,
                1 => true,
                2 => true,
                3 => true,
                4 => true,
                5 => true,
                6 => false
            );

        } else {

            // default to allowed days only

            $default_allowed_days = array(
                0 => false,
                1 => false,
                2 => false,
                3 => false,
                4 => false,
                5 => false,
                6 => false
            );

            $chosen_days = $this->settings['datesettings_datesettings_days'];

            if( $chosen_days && !empty( $chosen_days ) ) {
                foreach( $chosen_days as $day ) {
                    $default_allowed_days[$day] = true;
                }
            }

            $allowed_days = $default_allowed_days;

        }

        $days_to_add = 0;
        $allowed_i = 0;
        $started = false;
        $first_day = true;
        $complete = false;

        foreach (range(1, 1000) as $i) {

            foreach ($allowed_days as $day => $allowed) {

                if( $day < $this->current_day_number && $started == false )
                    continue;

                $started = true;

                if( $allowed !== false || $first_day ) {

                    $first_day = false;

                    if( $allowed_i == $days ) {
                        $complete = true;
                        break;
                    }

                    $allowed_i++;
                }

                $days_to_add++;

            }

            if( $complete )
                break;

        }

        return array(
            'days_to_add' => $days_to_add,
            'timestamp' => strtotime("+".$days_to_add." day", $this->current_timestamp)
        );

    }

    /**
     * Helper: Get timeslot data
     *
     * @param int $timeslot_id If an Id is passed, get a single timeslot, else get all
     * @return arr Returns timeslots with some additional data, like formatted times and values
     */
    public function get_timeslot_data( $timeslot_id = false ) {

        if( !$this->settings['timesettings_timesettings_setup_enable'] )
            return false;

        if ( false === ( $timeslots = get_transient( $this->timeslot_data_transient_name ) ) ) {

            $timeslots = $this->settings['timesettings_timesettings_timeslots'];

            if( $timeslots && !empty( $timeslots ) ) {

                foreach( $timeslots as $slot_id => $timeslot ) {

                    $start_time_formatted = $this->format_time($timeslot['timefrom'], "H:i");
                    $end_time_formatted = $this->format_time($timeslot['timeto'], "H:i");

                    $timeslots[$slot_id]["id"]                   = $slot_id;
                    $timeslots[$slot_id]['timefrom']             = array(
                        'time' => $timeslots[$slot_id]['timefrom'],
                        'stripped' => str_replace(':', '', $timeslot['timefrom'])
                    );
                    $timeslots[$slot_id]['timeto']               = array(
                        'time' => $timeslots[$slot_id]['timeto'],
                        'stripped' => str_replace(':', '', $timeslot['timeto'])
                    );
                    $timeslots[$slot_id]["time_id"]              = $timeslots[$slot_id]['timefrom']['stripped'].$timeslots[$slot_id]['timeto']['stripped'];
                    $timeslots[$slot_id]['fee']                  = array( "value" => $timeslot['fee'], "formatted" => wc_price($timeslot['fee']) );
                    $timeslots[$slot_id]["formatted"]            = sprintf("%s - %s", $start_time_formatted, $end_time_formatted);
                    $timeslots[$slot_id]["formatted_with_fee"]   = $timeslots[$slot_id]['fee']['value'] > 0 ? sprintf("%s (+%s)", $timeslots[$slot_id]["formatted"], strip_tags( $timeslots[$slot_id]['fee']['formatted'] ) ) : $timeslots[$slot_id]["formatted"];
                    $timeslots[$slot_id]['value']                = $this->get_timeslot_value( $timeslots[$slot_id] );

                }

            }

            set_transient( $this->timeslot_data_transient_name, $timeslots, 24 * HOUR_IN_SECONDS );

        }

        // If a specific timeslot is not being grabbed,
        // loop through each one and add any dynamic data

        if( $timeslot_id === false ) {

            foreach( $timeslots as $slot_id => $timeslot ) {

                $timeslots[$slot_id]['available'] = $this->is_timeslot_allowed_for_postcode( $timeslots[$slot_id] );

            }

        // If a specific timeslot IS being grabbed,
        // add dynamic data for that slot only

        } else {

            if( isset( $timeslots[$timeslot_id] ) ) {

                $timeslots[$timeslot_id]['available'] = $this->is_timeslot_allowed_for_postcode( $timeslots[$timeslot_id] );
                return apply_filters( 'jckwds-timeslot', $timeslots[$timeslot_id] );

            } else {

                return false;

            }

        }

        return apply_filters( 'jckwds-timeslots', $timeslots );

    }

    /**
     * Helper: Get reservation table data
     *
     * Gets an array to use for outputting the reservation table
     *
     * @return arr array("headers" => array(), "body" => array())
     */
    public function get_reservation_table_data() {

        $table_data            = array();
        $table_data['headers'] = array();
        $table_data['body']    = array();
        $bookable_dates        = $this->get_upcoming_bookable_dates();
        $timeslots             = $this->get_timeslot_data();
        $column_count          = (int)$this->settings['reservations_reservations_columns'];
        $column_visible_class  = "colVis";
        $reserved              = $this->get_reserved_slot();

        // headers

        $i = 0; foreach( $bookable_dates as $bookable_date ) {

            $classes = array(
                sprintf("%s-reservation-date", $this->slug),
                $i < $column_count ? $column_visible_class : ""
            );

            $table_data['headers'][] = array(
                "cell"    => $bookable_date['header_formatted'],
                "classes" => $this->implode_classes( $classes )
            );

        $i++; }

        // body

        if( $timeslots && !empty( $timeslots ) ) {

            $row = 0; foreach( $timeslots as $timeslot ) {

                $row = $timeslot['time_id'];

                $classes = array(
                    sprintf("%s-reservation-action", $this->slug),
                    $i < $column_count ? $column_visible_class : ""
                );

                if( !isset( $table_data['body'][$row] ) ) {

                    $table_data['body'][$row]   = array();
                    $table_data['body'][$row][] = array(
                        "cell_type"  => "th",
                        "cell"       => $timeslot['formatted'],
                        "attributes" => "",
                        "classes"    => $this->implode_classes( $classes )
                    );

                }

                $i = 0; foreach( $bookable_dates as $bookable_date ) {

                    if( isset($table_data['body'][$row][$bookable_date['ymd']]) && $table_data['body'][$row][$bookable_date['ymd']]['active']  ) {
                        $i++;
                        continue;
                    }

                    $slot_id = sprintf('%s_%s', $bookable_date['ymd'], $timeslot['id'] );
                    $slots_available = $this->get_slots_available_count( $timeslot, $bookable_date['ymd'] );
                    $timeslot_allowed_on_date = $this->is_timeslot_available_on_day($bookable_date['timestamp'], $timeslot);
                    $in_past = $this->is_timeslot_in_past( $timeslot, $bookable_date['ymd'] );
                    $classes = array(
                        sprintf("%s-reservation-action", $this->slug),
                        $i < $column_count ? $column_visible_class : "",
                        $reserved['id'] == $slot_id ? "jckwds-reserved" : ""
                    );
                    $attributes = array(
                        "data-timeslot-id"         => esc_html( $slot_id ),
                        "data-timeslot-date"       => esc_html( $bookable_date['ymd'] ),
                        "data-timeslot-start-time" => esc_html( $timeslot['timefrom']['stripped'] ),
                        "data-timeslot-end-time"   => esc_html( $timeslot['timeto']['stripped'] ),
                        "data-fee"                 => esc_html( $timeslot['fee']['formatted'] )
                    );

                    if( !$timeslot['available'] || $slots_available <= 0 || !$timeslot_allowed_on_date || $in_past ) {

                        $cell_data = '<i class="jckwds-icn-lock"></i>';
                        $classes[] = "jckwds_full";

                        $active = false;

                    } else {

                        $cell_data = '<a href="javascript: void(0);" class="jckwds-reserve-slot">%s</a>';

                        if( $this->settings['reservations_reservations_selection_type'] == "fee" ) {

                            $cell_data = sprintf($cell_data, $timeslot['fee']['formatted']);

                        } else {

                            $cell_data = sprintf($cell_data, '<i class="jckwds-icn-unchecked"></i><i class="jckwds-icn-checked"></i>');

                        }

                        $active = true;

                    }

                    $table_data['body'][$row][$bookable_date['ymd']] = array(
                        "cell_type"     => "td",
                        "cell"          => $cell_data, // show price or button or padlock, depending on settings
                        "attributes"    => $this->implode_attributes( $attributes ),
                        "classes"       => $this->implode_classes( $classes ),
                        "active"        => $active
                    );

                $i++; }

            $row++; }

        }

        return $table_data;

    }

    /**
     * Helper: Implode classes
     *
     * @param arr $classes
     * @return str
     */
    public function implode_classes( $classes ) {

        if( empty($classes) )
            return "";

        return sprintf( 'class="%s"', implode(' ', $classes) );

    }

    /**
     * Helper: Implode attributes
     *
     * @param arr $attribute Key value pairs of data attributes
     * @return str
     */
    public function implode_attributes( $attributes ) {

        if( empty($attributes) )
            return "";

        $data_attributes = array_map(function($value, $key) {
            return sprintf('%s="%s"', $key, $value);
        }, array_values($attributes), array_keys($attributes));

        return implode(' ', $data_attributes);

    }

    /**
     * Helper: Is timeslot in past?
     *
     * Checks whether the satrt time of the timeslot has already passed for the current day
     *
     * @param arr $timeslot
     * @param str $date Ymd
     * @return bool
     */
    public function is_timeslot_in_past( $timeslot, $date = false ) {

        $date = $date ? $date : $this->current_ymd;

        $cutoff = isset( $timeslot['cutoff'] ) && !empty( $timeslot['cutoff'] ) ? $timeslot['cutoff'] : $this->settings['timesettings_timesettings_cutoff'];

        $timeslot_ymdgi = $date.$timeslot['timefrom']['stripped'];
        $timeslot_date_time = DateTime::createFromFormat('YmdGi', $timeslot_ymdgi);

        $timeslot_date_time->sub(new DateInterval('PT'.$cutoff.'M'));
        $in_past = ($this->current_timestamp >= $timeslot_date_time->getTimestamp()) ? true : false;

        return $in_past;

    }

    /**
     * Helper: Check if a timeslot is allowed on a specific day of the week
     *
     * @param str $timestamp
     * @param arr $timeslot
     * @return bool
     */
    function is_timeslot_available_on_day($timestamp, $timeslot) {

        $day_number = date_i18n('w', $timestamp);

        if( !is_array($timeslot['days']) )
            return false;

        $allowed = (isset($timeslot['days']) && in_array($day_number, $timeslot['days'])) ? true : false;

        return $allowed;

    }

    /**
     * Frontend: Generate the reservation table
     */
    public function generate_reservation_table() {

        $return = '';

        $this->remove_outdated_reservations();
        $reservation_table_data = $this->get_reservation_table_data();

        ob_start();
        include('templates/reservation-table.php');
        $return .= ob_get_clean();

        return $return;

    }

    /**
     * Frontend: Reservation Table Shortcode
     *
     * @param arr $atts
     */
    public function reservation_table_shortcode( $atts ) {
        return $this->generate_reservation_table();
    }

    /**
     * Frontend: Register scripts and styles
     */
    public function register_scripts_and_styles() {

        $uitheme = $this->settings['datesettings_datesettings_setup_uitheme'];

        if ( !is_admin() ) {

            if($uitheme != 'none' && is_checkout()){

                wp_enqueue_style(
                    $this->slug . 'admin-ui-css',
                    '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/'.$uitheme.'/jquery-ui.css',
                    false,
                    $this->version,
                    false
                );

            }

            $this->load_file( $this->slug . '-script', '/assets/frontend/js/main.min.js', true, array('jquery-ui-datepicker'), true );
            $this->load_file( $this->slug . '-style', '/assets/frontend/css/main.min.css' );

        }

        $script_vars = array(
            'settings' => $this->settings,
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'ajax_nonce' => wp_create_nonce( $this->slug ),
            'strings' => array(
                'selectslot' => __('Please select a time slot...', 'jckwds'),
                'noslots'  => __('Sorry, no slots available...', 'jckwds'),
                'not_available' => __('Sorry, the time slot you reserved is not available for your postcode.', 'jckwds'),
                'loading' =>  __('Loading...', 'jckwds'),
                'days' =>  array(
                    __("Sunday", 'jckwds'),
                    __("Monday", 'jckwds'),
                    __("Tuesday", 'jckwds'),
                    __("Wednesday", 'jckwds'),
                    __("Thursday", 'jckwds'),
                    __("Friday", 'jckwds'),
                    __("Saturday", 'jckwds')
                ),
                'days_short'    =>  array(
                    __("Su", 'jckwds'),
                    __("Mo", 'jckwds'),
                    __("Tu", 'jckwds'),
                    __("We", 'jckwds'),
                    __("Th", 'jckwds'),
                    __("Fr", 'jckwds'),
                    __("Sa", 'jckwds')
                ),
                'months'        =>  array(
                    __("January", 'jckwds'),
                    __("February", 'jckwds'),
                    __("March", 'jckwds'),
                    __("April", 'jckwds'),
                    __("May", 'jckwds'),
                    __("June", 'jckwds'),
                    __("July", 'jckwds'),
                    __("August", 'jckwds'),
                    __("September", 'jckwds'),
                    __("October", 'jckwds'),
                    __("November", 'jckwds'),
                    __("December", 'jckwds')
                ),
                'months_short'  =>  array(
                    __("Jan", 'jckwds'),
                    __("Feb", 'jckwds'),
                    __("Mar", 'jckwds'),
                    __("Apr", 'jckwds'),
                    __("May", 'jckwds'),
                    __("Jun", 'jckwds'),
                    __("Jul", 'jckwds'),
                    __("Aug", 'jckwds'),
                    __("Sep", 'jckwds'),
                    __("Oct", 'jckwds'),
                    __("Nov", 'jckwds'),
                    __("Dec", 'jckwds')
                )
            )
        );

        if( is_checkout() ) {
            $script_vars['bookable_dates'] = $this->get_upcoming_bookable_dates("d/m/Y");
            $script_vars['reserved_slot'] = $this->get_reserved_slot();
        }

        wp_localize_script( $this->slug . '-script', $this->slug.'_vars', $script_vars );

    }


    /**
     * Frontend: Add dynamic styles to head tag
     */
	public function dynamic_css() {

		include_once( $this->plugin_path . "assets/frontend/css/user.css.php" );

	}

    /**
     * Ajax: Reserve a slot
     */
    public function ajax_reserve_slot() {

        header('Content-Type: application/json');

        $this->add_reservation(array(
            'datetimeid' => $_POST['slot_id'],
            'date' => $_POST['slot_date'],
            'starttime' => $_POST['slot_start_time'],
            'endtime' => $_POST['slot_end_time']
        ));

        echo json_encode(array('success' => true));

        die;
    }

    /**
     * Helper: Add reservation to database
     *
     * @param arr [$data]
     * @return bool
     */
    public function add_reservation( $data ) {

        global $wpdb;

        $insert = false;

        $defaults = array (
            'datetimeid' => false,
            'processed' => 0,
            'date' => false,
            'starttime' => '',
            'endtime' => '',
            'order_id' => ''
        );

        $data = wp_parse_args( $data, $defaults );

        $expire = ( $data['processed'] ) ? NULL : strtotime('+'.$this->settings['reservations_reservations_expires'].' minutes', $this->current_timestamp);

        if( $data['date'] ) {

            $insert = $wpdb->insert(
                $this->reservations_db_table_name,
                array(
                    'datetimeid' => $data['datetimeid'],
                    'processed' => $data['processed'],
                    'user_id' => $this->user_id,
                    'expires' => $expire,
                    'date' => $data['date'],
                    'starttime' => $data['starttime'],
                    'endtime' => $data['endtime'],
                    'order_id' => $data['order_id']
                ),
                array(
                    '%s',
                    '%d',
                    '%s',
                    '%s',
                    '%s',
                    '%s',
                    '%s'
                )
            );

        }

        return $insert;

    }

    /**
     * Helper: Set User ID
     *
     * If cookie is set, use that, otherwise use logged in suer id,
     * otherwise set cookie and use it.
     */
    public function set_user_id() {

        // if the cookie is set

        if( isset( $_COOKIE[$this->guest_user_id_cookie_name] )  ) {

            // set the cookie as the user id

            $this->user_id = $_COOKIE[$this->guest_user_id_cookie_name];

            // if the user already has a reservation, we'll leave it there
            // this means if a user sets a reservation, then logs in
            // their reservation will be maintained

            if( $this->has_reservation() ) {

                return;

            }

        }

        // if they didn't have a reservation, we'll proceed here

        if( is_user_logged_in() ) {

            $this->user_id = get_current_user_id();

        } else {

            if( isset( $_COOKIE[$this->guest_user_id_cookie_name] ) ) {

                $this->user_id = $_COOKIE[$this->guest_user_id_cookie_name];

            } else {

                $this->user_id = uniqid($this->slug);
                setcookie($this->guest_user_id_cookie_name, $this->user_id, 0, '/', COOKIE_DOMAIN);

            }

        }

    }

    /**
     * Ajax: Remove a reserved slot
     */
    function ajax_remove_reservation() {

        header('Content-Type: application/json');

        global $wpdb;

        $wpdb->delete(
            $this->reservations_db_table_name,
            array(
                'processed' => 0,
                'user_id' => $this->user_id
            ),
            array(
                '%d',
                '%s'
            )
        );

        echo json_encode(array('success' => true));

        die;

    }

    /**
     * Helper: Update a reserved slot
     *
     * @param str [$slot_id] e.g: Ymd_0
     * @param int [$order_id]
     * @return [mixed]
     */
    function update_reservation($slot_id, $order_id){
        global $wpdb;

        $current_user = wp_get_current_user();

        $update = $wpdb->update(
            $this->reservations_db_table_name,
            array(
                'processed' => 1,
                'order_id' => $order_id
            ),
            array(
                'user_id' => $this->user_id,
                'datetimeid' => $slot_id,
                'order_id' => 0
            ),
            array(
                '%d',
                '%d'
            ),
            array(
                '%s',
                '%s',
                '%d'
            )
        );

        return $update;
    }

    /**
     * Helper: Check if current user has a reservation
     *
     * @return [arr/bool]
     */
    public function has_reservation() {

        global $wpdb;

        $reservation = $wpdb->get_row(
            $wpdb->prepare(
                "
                SELECT *
                FROM {$this->reservations_db_table_name}
                WHERE processed = 0
                AND user_id = %s
                ",
                $this->user_id
            )
        );

        return ($reservation) ? $reservation : false;

    }

    /**
     * Helper: Register and enqueue scripts and styles
     *
     * @param str $name
     * @param str $file_path
     * @param bool $is_script
     * @param arr $deps
     * @param bool $inFooter
     */
    private function load_file( $name, $file_path, $is_script = false, $deps = array('jquery'), $inFooter = true ) {

        $url = plugins_url($file_path, __FILE__);
        $file = plugin_dir_path(__FILE__) . $file_path;

        if( file_exists( $file ) ) {

            if( $is_script ) {
                wp_register_script( $name, $url, $deps, $this->version, $inFooter ); //depends on jquery
                wp_enqueue_script( $name );
            } else {
                wp_register_style( $name, $url, array(), $this->version );
                wp_enqueue_style( $name );
            }
        }

    }

    /**
     * Helper: Create a timestamp range
     *
     * @param str $timestamp_from
     * @param str $timestamp_to
     * @return arr
     */
    private function create_timestamp_range($timestamp_from, $timestamp_to){

        $range = array();

        if ( $timestamp_to >= $timestamp_from ) {

            if( $this->is_date_allowed( $timestamp_from ) )
                array_push($range, $timestamp_from);

            while ( $timestamp_from < $timestamp_to ) {

                $timestamp_from+=86400; // add 24 hours

                if( $this->is_date_allowed( $timestamp_from ) )
                    array_push($range, $timestamp_from);

            }

        }

        return $range;

    }

    /**
     * Helper: Is date allowed
     *
     * @param str $timestamp
     * @return bool
     */
    private function is_date_allowed( $timestamp ){

        $allowedDays = $this->settings['datesettings_datesettings_days'];

        $theDay = date_i18n('w',$timestamp);

        return in_array($theDay, $allowedDays);

    }

    /**
     * Helper: Get number of of slots available for a specific date/time
     *
     * @param arr $timeslot
     * @param str $ymd
     * @return int
     */
    function get_slots_available_count( $timeslot, $ymd ){

        global $wpdb;

        $slot_id = sprintf('%s_%s', $ymd, $timeslot['id']);

        $reserved_slots = $wpdb->get_var("
            SELECT COUNT(*)
            FROM {$this->reservations_db_table_name}
            WHERE datetimeid = '{$slot_id}'
            AND (user_id != '{$this->user_id}' OR processed != '0')
        ");

        return $timeslot['lockout'] - $reserved_slots;

    }

    /**
     * Helper: Get all slots available on a specific date
     *
     * @param str $date Ymd
     * @return arr
     */
    function slots_available_on_date( $date ) {

        global $wpdb;

        $timeslots = $this->get_timeslot_data();
        $datetime = DateTime::createFromFormat('Ymd', $date);
        $date_timestamp = $datetime->getTimestamp();

        $available_timeslots = array();

        if( !$timeslots )
            return $available_timeslots;

        foreach( $timeslots as $timeslot ) {

            $slot_id = sprintf('%s_%s', $date, $timeslot['id']);

            $slot_allowed_on_day = $this->is_timeslot_available_on_day( $date_timestamp, $timeslot );
            $in_past = $this->is_timeslot_in_past( $timeslot, $date );
            $slot_allowed_for_method = $this->is_timeslot_allowed_for_method( $timeslot );

            if( !$slot_allowed_on_day || $in_past || !$timeslot['available'] || !$slot_allowed_for_method )
                continue;

            $slots_available_count = $this->get_slots_available_count( $timeslot, $date );

            if( $slots_available_count <= 0 )
                continue;

            $timeslot['slot_id'] = $slot_id;
            $available_timeslots[] = $timeslot;

        }

        return $available_timeslots;

    }

    /**
     * Helper: Get date format based on settings
     *
     * @return str
     */
    function date_format() {

        $trans = array(
            //days
            'dd'	=>	'd',
            'd'		=>	'j',
            'DD'	=>	'l',
            'o'		=>	'z',

            //months
            'MM'	=>	'F',
            'M'		=>	'M',
            'mm'	=>	'm',
            'm'		=>	'n',

            //years
            'yy'	=>	'Y',
            'y'		=>	'y'
        );

        return strtr($this->settings['datesettings_datesettings_dateformat'], $trans);
    }

    /**
     * Helper: Format time
     *
     * Give a time id, format it according to the admin settings
     *
     * @param str $time_id "Hi" format e.g. "0100" or "1430"
     * @param str $start_format "Hi" by default - PHP time format
     * @param str $end_format Defined in the admin settings - probably something like "H:i"
     * @return str End formatted time
     */
    public function format_time($time_id, $start_format = 'Hi', $end_format = false) {

        $end_format = ($end_format) ? $end_format : $this->settings['timesettings_timesettings_setup_timeformat'];

        if($end_format){

            if($start_format == 'Hi')
                $time = str_pad($time_id, 4, "0", STR_PAD_LEFT);

            $time = DateTime::createFromFormat($start_format, $time_id);

            return $time->format($end_format);

        }

        return $time;

    }


    /**
     * Helper: Get reserved slot data
     *
     * @return bool/arr
     */
    function get_reserved_slot() {

        global $wpdb;

        $slot_id = $wpdb->get_var("SELECT datetimeid FROM {$this->reservations_db_table_name} WHERE user_id = '{$this->user_id}' AND processed = '0'");

        if( $slot_id != null ) {

            $reserved_slot = array();
            $slot_id_exploded = explode('_', $slot_id);
            $reserved_date = DateTime::createFromFormat('Ymd', $slot_id_exploded[0]);
            $reserved_date = array(
                'formatted' => $reserved_date->format( $this->date_format() ),
                'id'        => $reserved_date->format('Ymd')
            );
            $reserved_slot['id'] = $slot_id;
            $reserved_slot['date'] = $reserved_date;
            $reserved_slot['time'] = $this->get_timeslot_data( $slot_id_exploded[1] );

            return $reserved_slot;

        } else {

            return false;

        }

    }

    /**
     * Helper: Remove outdated pending slots
     */
    function remove_outdated_reservations() {

        global $wpdb;

        $outdated = $wpdb->query( "DELETE FROM {$this->reservations_db_table_name} WHERE expires <= UNIX_TIMESTAMP(NOW()) AND processed = 0" );

        // @to-do: if outdated had an order ID - delete the meta from the order
        // Also need to add fields to admin order screen so new date/time can be selected

    }

    /**
     * Helper: Convert date to date id (Ymd)
     *
     * @param str $date
     * @return str
     */
    function convert_date_to_id($date) {
        $dformat = DateTime::createFromFormat( $this->date_format(), $date );
        return $dformat->format('Ymd');
    }

    /**
     * Helper: Convert date to database format (Y-m-d)
     *
     * @param str $date
     * @return str
     */
    function convert_date_for_database( $date ) {
        $dformat = DateTime::createFromFormat($this->date_format(), $date);
        return $dformat->format('Y-m-d');
    }

    /**
     * Helper: get shipping method options
     *
     * Also checks whether zones exist, as per the latest WooCommerce (2.6.0)
     *
     * @return arr
     */
    public function get_shipping_method_options() {

        if( !empty( $this->shipping_methods ) )
            return $this->shipping_methods;

        $shipping_method_options = array(
            'any' => __('Any Method','jckwds')
        );

        if( class_exists('WC_Shipping_Zones') ) {

            $shipping_zones = $this->get_shipping_zones();

            if( !empty( $shipping_zones ) ) {

                foreach( $shipping_zones as $shipping_zone ) {

                    $methods = $shipping_zone->get_shipping_methods( true );

                    if( !$methods )
                        continue;

                    foreach( $methods as $method ) {

                        $title = empty( $method->method_title ) ? ucfirst( $method->id ) : $method->method_title;
                        $class = str_replace('wc_shipping_', '', strtolower( get_class( $method ) ) );

                        if( $class === "table_rate" ) {

                            $trs_methods = $this->get_trs_methods_zones( $method, $class, $shipping_zone );

                            $shipping_method_options = $shipping_method_options + $trs_methods;

                        } else {

                            $value = sprintf('%s:%d', $class, $method->instance_id);

                            $shipping_method_options[ $value ] = esc_html( sprintf( '%s: %s', $shipping_zone->get_zone_name(), $title ) );

                        }

                    }

                }

            }

        }

        $shipping_methods = WC()->shipping->load_shipping_methods();

        foreach ( $shipping_methods as $method ) {

            if ( ! $method->has_settings() )
                continue;

            $title = empty( $method->method_title ) ? ucfirst( $method->id ) : $method->method_title;
            $class = get_class( $method );

            if( $class == "WAS_Advanced_Shipping_Method" ) {

                $was_methods = $this->get_was_methods();

                $shipping_method_options = $shipping_method_options + $was_methods;

            } elseif( $class == "BE_Table_Rate_Shipping" ) {

                $trs_methods = $this->get_trs_methods();

                $shipping_method_options = $shipping_method_options + $trs_methods;

            } elseif( $class == "WC_Shipping_WooShip" ) {

                $wooship_methods = $this->get_wooship_methods();

                $shipping_method_options = $shipping_method_options + $wooship_methods;

            } elseif( $class == "MH_Table_Rate_Plus_Shipping_Method" ) {

                $table_rate_plus_methods = $this->get_table_rate_plus_methods( $method );

                $shipping_method_options = $shipping_method_options + $table_rate_plus_methods;

            } else {

                $shipping_method_options[ strtolower( $class ) ] = esc_html( $title );

            }

        }

        $this->shipping_methods = $shipping_method_options;

        return $this->shipping_methods;

    }

    /**
     * Helper: Get all shipping zones
     *
     * @return arr
     */
    public function get_shipping_zones() {

        $shipping_zones = WC_Shipping_Zones::get_zones();

        if( $shipping_zones ) {
            foreach( $shipping_zones as $index => $shipping_zone ) {
                $shipping_zones[$index] = new WC_Shipping_Zone( $shipping_zone['zone_id'] );
            }
        }

        $shipping_zones[] = new WC_Shipping_Zone( 0 );

        return $shipping_zones;

    }

    /**
     * Helper: Get "WooCommerce Advanced Shipping" methods
     *
     * @return arr
     */
    public function get_was_methods() {

        $methods_array = array();
        $methods = get_posts( array( 'posts_per_page' => '-1', 'post_type' => 'was', 'post_status' => array( 'draft', 'publish' ), 'orderby' => 'menu_order', 'order' => 'ASC' ) );

		foreach ( $methods as $method ) {

			$method_details = get_post_meta( $method->ID, '_was_shipping_method', true );
			$conditions 	= get_post_meta( $method->ID, '_was_shipping_method_conditions', true );
			$priority		= get_post_meta( $method->ID, '_priority', true );

			if ( empty( $method_details['shipping_title'] ) ) :
				$methods_array[$method->ID] = __( 'Shipping', 'woocommerce-advanced-shipping' );
			else :
				$methods_array[$method->ID] = wp_kses_post( $method_details['shipping_title'] );
			endif;

        }

        return $methods_array;

    }

    /**
     * Helper: Get "WooCommerce Table Rate Shipping" methods
     *
     * @return arr
     */
    public function get_trs_methods() {

        $methods_array = array();
        $table_rates = array_filter( (array) get_option( "woocommerce_table_rates" ) );

        if( $table_rates && !empty( $table_rates ) ) {
            foreach( $table_rates as $table_rate ) {
                $methods_array[ sprintf('table_rate_shipping_%s', $table_rate['identifier']) ] = esc_html( $table_rate['title'] );
            }
        }

        return $methods_array;

    }

    /**
     * Helper: Get "WooCommerce Table Rate Shipping" methods for Zone based shipping
     *
     * @since 1.7.1
     * @param $method
     * @param str $class Name of the method's class
     * @param $shipping_zone
     * @retrun arr
     */
    public function get_trs_methods_zones( $method, $class, $shipping_zone ) {

        $methods_array = array();
        $rates = $method->get_shipping_rates();

        if( !$rates || empty( $rates ) )
            return $methods_array;

        $title = !empty( $method->title ) ? $method->title : ucfirst( $method->id );

        foreach( $rates as $rate ) {

            $value = sprintf('%s:%d', $class, $method->instance_id);

            if( isset( $methods_array[ $value ] ) )
                continue;

            $methods_array[ $value ] = esc_html( sprintf( '%s: %s', $shipping_zone->get_zone_name(), $title ) );

        }

        return $methods_array;

    }

    /**
     * Helper: Get "WooShip" methods
     *
     * @return arr
     */
    public function get_wooship_methods() {

        $methods_array = array();
        $wooship = WooShip::get_instance();

        if ($wooship && ( !empty($wooship->config['shipping_methods']) && is_array($wooship->config['shipping_methods']) )) {

            foreach ($wooship->config['shipping_methods'] as $method_key => $method) {

                $methods_array[ sprintf('wooship_%d', $method_key) ] = esc_html( $method['title'] );

            }
        }

        return $methods_array;

    }

    /**
     * Helper: Get "Table Rate Plus" methods
     *
     * @param MH_Table_Rate_Plus_Shipping_Method $method
     * @return arr
     */
    public function get_table_rate_plus_methods( $method ) {

        $methods_array = array();
        $zones = $method->zones;
        $services = $method->services;
        $rates = $method->table_rates;

        if ($rates && !empty($rates) ) {

            foreach ($rates as $rate) {

                $zone = isset( $zones[ $rate['zone'] - 1 ]['name'] ) ? $zones[ $rate['zone'] - 1 ]['name'] : __('Everywhere Else', 'jckwds');
                $service = $services[ $rate['service'] - 1 ]['name'];

                $title = sprintf('%s: %s', $zone, $service);

                $methods_array[ sprintf('mh_wc_table_rate_plus_%d', $rate['id']) ] = esc_html( $title );

            }
        }

        return $methods_array;

    }

    /**
     * Check fee
     *
     * When WooCommerce runs the update_order_review AJAX function,
     * check if our slot has a fee applied to it, then add/remove it
     *
     * @param array $post_data
     */
    public function check_fee( $post_data ) {

        parse_str( $post_data, $checkout_fields );

        if( isset( $checkout_fields['jckwds-delivery-time'] ) ) {

            $timeslot_fee = $this->extract_fee_from_option_value($checkout_fields['jckwds-delivery-time']);

            if( $timeslot_fee > 0 ) {

                WC()->session->set( 'jckwds_timeslot_fee', $timeslot_fee );

            } else {

                WC()->session->__unset( 'jckwds_timeslot_fee' );

            }

        } else {

            WC()->session->__unset( 'jckwds_timeslot_fee' );

        }

    }

    /**
     * Add timeslot fee at checkout
     */
    public function add_timeslot_fee() {

        if( WC()->session->get( 'jckwds_timeslot_fee' ) && WC()->session->get( 'jckwds_timeslot_fee' ) > 0 ) {

            WC()->cart->add_fee(__('Time Slot Fee','jckwds'), WC()->session->get( 'jckwds_timeslot_fee' ));
        }

    }

    /**
     * Helper: Extract timeslot id from option value
     *
     * In order to add fees, timeslot options at checkout have a |fee added to their values
     * This functions let's us extract the timeslot id from that string
     *
     * @param str $option_value
     * @return str
     */
    public function extract_timeslot_id_from_option_value( $option_value = false ) {

        if( !$option_value )
            return  false;

        $option_value_exploded = explode('|', $option_value);

        return (int)$option_value_exploded[0];

    }

    /**
     * Helper: Extract fee from option value
     *
     * As above, but for the fee
     *
     * @param str $option_value
     * @return str
     */
    public function extract_fee_from_option_value( $option_value = false ) {

        if( !$option_value )
            return  false;

        $option_value_exploded = explode('|', $option_value);
        $fee = ( isset( $option_value_exploded[1] ) ) ? (float) $option_value_exploded[1] : 0;

        return $fee;

    }

    /**
     * Get Woo Version Number
     *
     * @return mixed bool/str NULL or Woo version number
     */
    public function get_woo_version_number() {

        // If get_plugins() isn't available, require it
        if ( ! function_exists( 'get_plugins' ) )
            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        // Create the plugins folder and file variables
        $plugin_folder = get_plugins( '/' . 'woocommerce' );
        $plugin_file = 'woocommerce.php';

        // If the plugin version number is set, return it
        if ( isset( $plugin_folder[$plugin_file]['Version'] ) ) {
            return $plugin_folder[$plugin_file]['Version'];

        } else {
            // Otherwise return null
            return NULL;
        }

    }

    /**
     * Check whether the plugin is inactive.
     *
     * Reverse of is_plugin_active(). Used as a callback.
     *
     * @since 3.1.0
     * @see is_plugin_active()
     *
     * @param string $plugin Base plugin path from plugins directory.
     * @return bool True if inactive. False if active.
     */
    public function is_plugin_active( $plugin ) {

        return in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) || $this->is_plugin_active_for_network( $plugin );

    }

    /**
     * Check whether the plugin is active for the entire network.
     *
     * Only plugins installed in the plugins/ folder can be active.
     *
     * Plugins in the mu-plugins/ folder can't be "activated," so this function will
     * return false for those plugins.
     *
     * @since 3.0.0
     *
     * @param string $plugin Base plugin path from plugins directory.
     * @return bool True, if active for the network, otherwise false.
     */
    public function is_plugin_active_for_network( $plugin ) {
    	if ( !is_multisite() )
    		return false;
    	$plugins = get_site_option( 'active_sitewide_plugins');
    	if ( isset($plugins[$plugin]) )
    		return true;
    	return false;
    }

    /**
     * Status Transition
     *
     * On order status transition, update slot in database
     *
     * @since 1.6.3
     * @to-do
     */
    public function status_transition( $new_status, $old_status, $post ) {

        if( $post->post_type != "shop_order" )
            return;

        if( $new_status == "wc-processing" || $new_status == "wc-completed" ) {

            // update reservation to processed, if it exists

        } else {

            // update reservation to not processed

        }

    }

    /**
     * Get selected shipping method
     */
    public function get_chosen_shipping_method() {

        if( isset( $_POST['selected_shipping_method'] ) )
            return $_POST['selected_shipping_method'];

        $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );

        if( !$chosen_methods || empty( $chosen_methods ) )
            return false;

        return $chosen_methods[0];

    }

    /**
     * Is timeslot allowed for selected shipping method
     *
     * @param arr $timeslot
     * @return bool
     */
    public function is_timeslot_allowed_for_method( $timeslot ) {

        if( !class_exists('WC_Shipping_Zones') )
            return true;

        if( !$timeslot['shipping_methods'] )
            return false;

        if( in_array('any', $timeslot['shipping_methods']) )
            return true;

        $chosen_method = $this->get_chosen_shipping_method();

        if( in_array($chosen_method, $timeslot['shipping_methods']) )
            return true;

        foreach( $timeslot['shipping_methods'] as $timeslot_shipping_method ) {
            if( strpos($chosen_method, $timeslot_shipping_method, 0) === 0 )
                return true;
        }

        return false;

    }

    /**
     * Cancel order
     *
     * If an order is cancelled, delete the time slot, too
     *
     * @param int $order_id
     */
    public function cancel_order( $order_id ) {

        $post_type = get_post_type( $order_id );

        if( $post_type !== "shop_order" ) { return; }

        global $wpdb;

        $delete = $wpdb->delete(
            $this->reservations_db_table_name,
            array(
                'order_id' => $order_id
            ),
            array(
                '%d'
            )
        );

        if( !$delete ) { return; }

        delete_post_meta( $order_id, $this->date_meta_key );
        delete_post_meta( $order_id, $this->timeslot_meta_key );
        delete_post_meta( $order_id, $this->timestamp_meta_key );

    }

} // end class

$jckwds = new jckWooDeliverySlots();