<?php
add_filter( 'wpsf_register_settings_jckwds', 'jckwds_settings' );

/**
 * Delivery Slots Settings
 *
 * @param arr $wpsf_settings
 * @return arr
 */
function jckwds_settings( $wpsf_settings ) {

    global $jckwds;

    if( !$jckwds )
        return;

    $wpsf_settings = array(

        /**
         * Define: Tabs
         *
         * Define the tabs and their IDs
         */
        'tabs' => array(

            array(
                'id' => 'general',
                'title' => __('General Settings', 'jckwds')
            ),
            array(
                'id' => 'datesettings',
                'title' => __('Date Settings', 'jckwds')
            ),
            array(
                'id' => 'timesettings',
                'title' => __('Time Settings', 'jckwds')
            ),
            array(
                'id' => 'holidays',
                'title' => __('Holidays', 'jckwds')
            ),
            array(
                'id' => 'reservations',
                'title' => __('Reservation Table', 'jckwds')
            )

        ),

        /**
         * Define: Sections
         *
         * Define the sections within our tabs, and give each
         * section a related tab ID
         */
        'sections' => array(

            array(
                'tab_id' => 'general',
                'section_id' => 'setup',
                'section_title' => __('General Setup', 'jckwds'),
                'section_description' => '',
                'section_order' => 0,
                'fields' => array(
                    array(
                        'id' => 'position',
                        'title' => __('Checkout Fields Position', 'jckwds'),
                        'subtitle' => __('Where should the date and time fields show on the checkout page?', 'jckwds'),
                        'type' => 'select',
                        'default' => 'woocommerce_checkout_after_customer_details',
                        'choices' => array(
                            'woocommerce_checkout_before_customer_details' => __('Before Customer Details', 'jckwds'),
                            'woocommerce_checkout_billing' => __('Within Billing Fields', 'jckwds'),
                            'woocommerce_checkout_shipping' => __('Within Shipping Fields', 'jckwds'),
                            'woocommerce_checkout_after_customer_details' => __('After Customer Details', 'jckwds'),
                            'woocommerce_checkout_before_order_review' => __('Before Order Review', 'jckwds'),
                            'woocommerce_checkout_order_review' => __('Within Order Review', 'jckwds'),
                            'woocommerce_checkout_after_order_review' => __('After Order Review', 'jckwds'),
                        )
                    ),
                    array(
                        'id' => 'position_priority',
                        'title' => __('Checkout Fields Position Priority', 'jckwds'),
                        'subtitle' => __('Enter a number of priority, e.g. 10 is early/before, 50 is late/after', 'jckwds'),
                        'type' => 'text',
                        'default' => '10',
                        'placeholder' => '',
                    ),
                    array(
                        'id' => 'shipping_methods',
                        'title' => __('Shipping Methods', 'jckwds'),
                        'subtitle' => __('Enable delivery slots for the following shipping methods.', 'jckwds'),
                        'type' => 'checkboxes',
                        'placeholder' => '',
                        'choices' => $jckwds->get_shipping_method_options()
                    ),
                )
            ),

            array(
                'tab_id' => 'datesettings',
                'section_id' => 'datesettings_setup',
                'section_title' => __('Date Setup', 'jckwds'),
                'section_description' => '',
                'section_order' => 0,
                'fields' => array(
                    array(
                        'id' => 'mandatory',
                        'title' => __('Mandatory Field?', 'jckwds'),
                        'subtitle' => __('Is the delivery date a required field at checkout?', 'jckwds'),
                        'type' => 'checkbox',
                        'default' => 1,
                        'placeholder' => '',
                    ),
                    array(
                        'id' => 'show_description',
                        'title' => __('Show Description?', 'jckwds'),
                        'type' => 'checkbox',
                        'default' => 1,
                        'placeholder' => '',
                    ),
                    array(
                        'id' => 'uitheme',
                        'title' => __('Theme', 'jckwds'),
                        'subtitle' => __('Select a theme for the front-end calendar at checkout. If you already have a jQuery UI theme installed, select "None". Themes can be viewed <a href="http://jqueryui.com/themeroller/" target="_blank">here</a>, in the "Gallery" section.', 'jckwds'),
                        'type' => 'select',
                        'default' => 'none',
                        'placeholder' => '',
                        'choices' => array(
                            'none' => 'None',
                            'black-tie' => 'Black Tie',
                            'blitzer' => 'Blitzer',
                            'cupertino' => 'Cupertino',
                            'dark-hive' => 'Dark Hive',
                            'dot-luv' => 'Dot Luv',
                            'eggplant' => 'Eggplant',
                            'excite-bike' => 'Excite Bike',
                            'flick' => 'Flick',
                            'hot-sneaks' => 'Hot Sneaks',
                            'humanity' => 'Humanity',
                            'le-frog' => 'Le Frog',
                            'mint-choc' => 'Mint Choc',
                            'overcast' => 'Overcast',
                            'pepper-grinder' => 'Pepper Grinder',
                            'redmond' => 'Redmond',
                            'smoothness' => 'Smoothness',
                            'south-street' => 'South Street',
                            'start' => 'Start',
                            'sunny' => 'Sunny',
                            'swanky-purse' => 'Swanky Purse',
                            'trontastic' => 'Trontastic',
                            'ui-darkness' => 'Darkness',
                            'ui-lightness' => 'Lightness',
                            'vader' => 'Vade',
                        ),
                    )
                )
            ),

            array(
                'tab_id' => 'datesettings',
                'section_id' => 'datesettings',
                'section_title' => __('Date Settings', 'jckwds'),
                'section_description' => '',
                'section_order' => 10,
                'fields' => array(
                    array(
                        'id' => 'days',
                        'title' => __('Delivery Days', 'jckwds'),
                        'type' => 'checkboxes',
                        'default' => array('4', '5', '6'),
                        'placeholder' => '',
                        'choices' => array(
                            '0' => __('Sunday', 'jckwds'),
                            '1' => __('Monday', 'jckwds'),
                            '2' => __('Tuesday', 'jckwds'),
                            '3' => __('Wednesday', 'jckwds'),
                            '4' => __('Thursday', 'jckwds'),
                            '5' => __('Friday', 'jckwds'),
                            '6' => __('Saturday', 'jckwds')
                        )
                    ),
                    array(
                        'id' => 'minmaxmethod',
                        'title' => __('Minimum/Maximum Selectable Date Method', 'jckwds'),
                        'subtitle' => __('Choose whether the minimum and maximum selectable date applies to all days of the week, allowed days only, or weekdays only.', 'jckwds'),
                        'type' => 'select',
                        'default' => 'allowed',
                        'placeholder' => '',
                        'choices' => array(
                            'allowed' => 'Allowed Days Only',
                            'all' => 'All Days',
                            'weekdays' => 'Weekdays Only'
                        ),
                    ),
                    array(
                        'id' => 'minimum',
                        'title' => __('Minimum Selectable Date', 'jckwds'),
                        'subtitle' => __('Days from now. Enter "0" for same day.', 'jckwds'),
                        'type' => 'text',
                        'default' => '2',
                        'placeholder' => '',
                    ),
                    array(
                        'id' => 'maximum',
                        'title' => __('Maximum Selectable Date', 'jckwds'),
                        'subtitle' => __('Days from now.', 'jckwds'),
                        'type' => 'text',
                        'default' => '14',
                        'placeholder' => '',
                    ),
                    array(
                        'id' => 'sameday_cutoff',
                        'title' => __('Disable Same Day Delivery if Current Time is After (x)', 'jckwds'),
                        'type' => 'time',
                        'timepicker' => array(
                            'amPmText' => array(
                                __('AM', 'jckwds'),
                                __('PM', 'jckwds')
                            )
                        )
                    ),
                    array(
                        'id' => 'nextday_cutoff',
                        'title' => __('Disable Next Day Delivery if Current Time is After (x)', 'jckwds'),
                        'type' => 'time',
                        'timepicker' => array(
                            'amPmText' => array(
                                __('AM', 'jckwds'),
                                __('PM', 'jckwds')
                            )
                        )
                    ),
                    array(
                        'id' => 'week_limit',
                        'title' => __('Only allow deliveries within the current week?', 'jckwds'),
                        'type' => 'checkbox',
                        'default' => 0,
                        'placeholder' => '',
                    ),
                    array(
                        'id' => 'last_day_of_week',
                        'title' => __('Last Day of the Week', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'select',
                        'placeholder' => '',
                        'choices' => array(
                            'sunday' => __('Sunday', 'jckwds'),
                            'monday' => __('Monday', 'jckwds'),
                            'tuesday' => __('Tuesday', 'jckwds'),
                            'wednesday' => __('Wednesday', 'jckwds'),
                            'thursday' => __('Thursday', 'jckwds'),
                            'friday' => __('Friday', 'jckwds'),
                            'saturday' => __('Saturday', 'jckwds')
                        ),
                        'default' => 'sunday',
                    ),
                    array(
                        'id' => 'dateformat',
                        'title' => __('Date Format', 'jckwds'),
                        'subtitle' => __('Available formats can be found <a href="http://api.jqueryui.com/datepicker/#utility-formatDate" target="_blank">here</a>.', 'jckwds'),
                        'type' => 'text',
                        'default' => 'dd/mm/yy',
                        'placeholder' => '',
                    )
                )
            ),

            array(
                'tab_id' => 'timesettings',
                'section_id' => 'timesettings_setup',
                'section_title' => __('Time Setup', 'jckwds'),
                'section_description' => '',
                'section_order' => 0,
                'fields' => array(
                    array(
                        'id' => 'enable',
                        'title' => __('Enable Time Slots', 'jckwds'),
                        'subtitle' => __('Check this box to enable time slots at checkout.', 'jckwds'),
                        'type' => 'checkbox',
                        'default' => 1,
                        'placeholder' => '',
                    ),
                    array(
                        'id' => 'mandatory',
                        'title' => __('Mandatory Field?', 'jckwds'),
                        'subtitle' => __('Is the time slot a required field at checkout?', 'jckwds'),
                        'type' => 'checkbox',
                        'default' => 1,
                        'placeholder' => '',
                    ),
                    array(
                        'id' => 'show_description',
                        'title' => __('Show Description?', 'jckwds'),
                        'type' => 'checkbox',
                        'default' => 1,
                        'placeholder' => '',
                    ),
                    array(
                        'id' => 'timeformat',
                        'title' => __('Time Format', 'jckwds'),
                        'subtitle' => __('Select a time format for the frontend.', 'jckwds'),
                        'type' => 'select',
                        'default' => 'H:i A',
                        'placeholder' => '',
                        'choices' => array(
                            'H:i A' => '13:30 PM',
                            'H:i' => '13:30',
                            'h:i A' => '01:30 PM'
                        ),
                    )
                )
            ),

            'timesettings' => array(
                'tab_id' => 'timesettings',
                'section_id' => 'timesettings',
                'section_title' => __('Time Slot Configuration', 'jckwds'),
                'section_description' => '',
                'section_order' => 10,
                'fields' => array(
                    array(
                        'id' => 'cutoff',
                        'title' => __('Allow Bookings Up To (x) Minutes Before Slot', 'jckwds'),
                        'subtitle' => __('This option will prevent bookings being made too close to the delivery time. Can be overridden on an individual time slot basis. (Check your timezone in WordPress Settings).', 'jckwds'),
                        'type' => 'text',
                        'default' => '30',
                        'placeholder' => '',
                    ),
                    'timeslots' => array(
                        'id' => 'timeslots',
                        'title' => __('Time Slots', 'jckwds'),
                        'type' => 'group',
                        'row_title' => __('Time Slot', 'jckwds'),
                        'format' => 'table',
                        'default' => array(
                            array(
                                'timefrom' => '02:30',
                                'timeto' => '10:45',
                                'lockout' => '4'
                            ),
                            array(
                                'timefrom' => '12:30',
                                'timeto' => '13:45',
                                'lockout' => '2'
                            ),
                            array(
                                'timefrom' => '14:30',
                                'timeto' => '18:45',
                                'lockout' => '6'
                            )
                        ),
                        'subfields' => array(
                            array(
                                'id' => 'timefrom',
                                'title' => __('From', 'jckwds'),
                                'type' => 'time',
                                'timepicker' => array(
                                    'amPmText' => array(
                                        __('AM', 'jckwds'),
                                        __('PM', 'jckwds')
                                    )
                                )
                            ),
                            array(
                                'id' => 'timeto',
                                'title' => __('To', 'jckwds'),
                                'type' => 'time',
                                'timepicker' => array(
                                    'amPmText' => array(
                                        __('AM', 'jckwds'),
                                        __('PM', 'jckwds')
                                    )
                                )
                            ),
                            array(
                                'id' => 'cutoff',
                                'title' => __('Allow Bookings Up To (x) Minutes Before Slot', 'jckwds'),
                                'subtitle' => '',
                                'type' => 'text',
                                'placeholder' => ''
                            ),
                            array(
                                'id' => 'lockout',
                                'title' => __('Lockout', 'jckwds'),
                                'subtitle' => '',
                                'type' => 'text',
                                'placeholder' => ''
                            ),
                            'postcodes' => array(
                                'id' => 'postcodes',
                                'title' => __('Postcodes', 'jckwds'),
                                'type' => 'text',
                                'placeholder' => ''
                            ),
                            array(
                                'id' => 'fee',
                                'title' => sprintf(__('Fee (%s)', 'jckwds'), get_woocommerce_currency_symbol()),
                                'subtitle' => '',
                                'type' => 'text',
                                'placeholder' => 'E.g. 3.00'
                            ),
                            array(
                                'id' => 'days',
                                'title' => __('Days', 'jckwds'),
                                'subtitle' => '',
                                'type' => 'checkboxes',
                                'placeholder' => '',
                                'choices' => array(
                                    '0' => __('Sunday', 'jckwds'),
                                    '1' => __('Monday', 'jckwds'),
                                    '2' => __('Tuesday', 'jckwds'),
                                    '3' => __('Wednesday', 'jckwds'),
                                    '4' => __('Thursday', 'jckwds'),
                                    '5' => __('Friday', 'jckwds'),
                                    '6' => __('Saturday', 'jckwds')
                                )
                            )
                        )
                    )
                )
            ),

            array(
                'tab_id' => 'holidays',
                'section_id' => 'holidays',
                'section_title' => __('Holidays', 'jckwds'),
                'section_description' => __('Please add any holidays where deliveries should not be made.', 'jckwds'),
                'section_order' => 0,
                'fields' => array(
                    array(
                        'id' => 'holidays',
                        'title' => __('Holidays', 'jckwds'),
                        'subtitle' => __('For single days, just enter a date in the "From" field. For ranges, enter a "From" and "To" date. Ranges are up to and including the dates you enter.', 'jckwds'),
                        'type' => 'group',
                        'row_title' => __('Holiday', 'jckwds'),
                        'format' => 'table',
                        'subfields' => array(
                            array(
                                'id' => 'date',
                                'title' => __('From', 'jckwds'),
                                'type' => 'date',
                                'datepicker' => array(
                                    'dateFormat' => 'dd/mm/yy'
                                )
                            ),
                            array(
                                'id' => 'date_to',
                                'title' => __('To', 'jckwds'),
                                'type' => 'date',
                                'datepicker' => array(
                                    'dateFormat' => 'dd/mm/yy'
                                )
                            ),
                            array(
                                'id' => 'name',
                                'title' => __('Name', 'jckwds'),
                                'subtitle' => '',
                                'type' => 'text',
                                'default' => '',
                                'placeholder' => __('e.g. Christmas', 'jckwds')
                            )
                        )
                    )
                )
            ),

            array(
                'tab_id' => 'reservations',
                'section_id' => 'reservations',
                'section_title' => __('Reservations', 'jckwds'),
                'section_description' => __('You can insert a reservation table using the shortcode <strong>[jckwds]</strong>. This allows your customers to reserve a delivery time and date while they shop. <br><strong>Note:</strong> Time Slots should be enabled if you want to use the reservation table.', 'jckwds'),
                'section_order' => 0,
                'fields' => array(
                    array(
                        'id' => 'expires',
                        'title' => __('Expiration', 'jckwds'),
                        'subtitle' => __('Reservations expire after (x) Minutes.', 'jckwds'),
                        'type' => 'text',
                        'default' => '30',
                        'placeholder' => '30'
                    ),
                    array(
                        'id' => 'columns',
                        'title' => __('Date Columns', 'jckwds'),
                        'subtitle' => __('How many date columns should the reservation table display?', 'jckwds'),
                        'type' => 'text',
                        'default' => '3',
                        'placeholder' => '3'
                    ),
                    array(
                        'id' => 'selection_type',
                        'title' => __('Selection Type', 'jckwds'),
                        'subtitle' => __('Choose the selection type for the time slots in the table.', 'jckwds'),
                        'type' => 'select',
                        'default' => 'fee',
                        'placeholder' => '',
                        'choices' => array(
                            'checkbox' => __('Checkbox','jckwds'),
                            'fee' => __('Fee','jckwds')
                        ),
                    ),
                    array(
                        'id' => 'dateformat',
                        'title' => __('Header Date Format', 'jckwds'),
                        'subtitle' => __('Available formats can be found <a href="http://api.jqueryui.com/datepicker/#utility-formatDate" target="_blank">here</a>.', 'jckwds'),
                        'type' => 'text',
                        'default' => 'j D',
                        'placeholder' => '',
                    )
                )
            ),

            array(
                'tab_id' => 'reservations',
                'section_id' => 'styling',
                'section_title' => __('Table Styling', 'jckwds'),
                'section_description' => __('Customise the look of your reservation table to match your website.', 'jckwds'),
                'section_order' => 0,
                'fields' => array(
                    array(
                        'id' => 'thbgcol',
                        'title' => __('Header Cell Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#333333'
                    ),
                    array(
                        'id' => 'thbordercol',
                        'title' => __('Header Cell Border Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#2A2A2A'
                    ),
                    array(
                        'id' => 'thfontcol',
                        'title' => __('Header Cell Font Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#FFFFFF'
                    ),
                    array(
                        'id' => 'tharrcol',
                        'title' => __('Arrow Icon Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#CCCCCC'
                    ),
                    array(
                        'id' => 'tharrhovcol',
                        'title' => __('Arrow Icon Hover Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#FFFFFF'
                    ),
                    array(
                        'id' => 'reservebgcol',
                        'title' => __('Reserve Cell Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#FFFFFF'
                    ),
                    array(
                        'id' => 'reservebordercol',
                        'title' => __('Reserve Cell Border Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#EAEAEA'
                    ),
                    array(
                        'id' => 'reserveiconcol',
                        'title' => __('Reserve Icon Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#B7B7B7'
                    ),
                    array(
                        'id' => 'reserveiconhovcol',
                        'title' => __('Reserve Icon Hover Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#848484'
                    ),
                    array(
                        'id' => 'unavailcell',
                        'title' => __('Unavailable Cell Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#F7F7F7'
                    ),
                    array(
                        'id' => 'reservedbgcol',
                        'title' => __('Reserved Cell Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#15b374'
                    ),
                    array(
                        'id' => 'reservedbordercol',
                        'title' => __('Reserved Cell Border Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#108556'
                    ),
                    array(
                        'id' => 'reservediconcol',
                        'title' => __('Reserved Icon Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#FFFFFF'
                    ),
                    array(
                        'id' => 'loadingiconcol',
                        'title' => __('Loading Icon Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#666666'
                    ),
                    array(
                        'id' => 'lockiconcol',
                        'title' => __('Lock Icon Colour', 'jckwds'),
                        'subtitle' => '',
                        'type' => 'color',
                        'default' => '#666666'
                    ),
                )
            )

        )

    );

    if( class_exists('WC_Shipping_Zones') ) {

        $wpsf_settings['sections']['timesettings']['fields']['timeslots']['subfields']['postcodes'] = array(
            'id' => 'shipping_methods',
            'title' => __('Shipping Methods', 'jckwds'),
            'subtitle' => '',
            'type' => 'checkboxes',
            'placeholder' => '',
            'choices' => $jckwds->get_shipping_method_options()
        );

    }

    return $wpsf_settings;

}